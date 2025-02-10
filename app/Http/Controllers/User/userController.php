<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use Endroid\QrCode\Builder\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function home()
    {
        $pizzaData = Product::select('products.*', 'categories.name AS category_name')
        ->leftJoin('categories', 'products.category_id', 'categories.category_id')
        ->paginate(6); // Use paginate instead of get()

    $categories = Category::all();
    $cart = Cart::where('user_id', Auth::id())->get();

    return view('user.main.home', compact('pizzaData', 'categories', 'cart'));
    }
    public function changePassword()
    {
        return view('user.main.changePassword');
    }
    public function changePasswordData(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('user.home')->with('status', 'Password successfully updated');
    }
    public function account()
    {
        return view('user.profile.account');
    }
    public function accountUpdate(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle profile picture upload
        if ($request->hasFile('image')) {
            // Check if the user already has a profile picture
            if ($user->profile_photo_path) {
                // Delete the existing profile image from storage
                Storage::delete('public/' . $user->profile_photo_path);
            }

            // Generate a unique name for the new image
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

            // Store the new profile image in the 'public' folder
            $request->file('image')->storeAs('public/profile_pictures', $fileName);

            // Update the user's profile picture path
            $user->profile_photo_path = 'profile_pictures/' . $fileName; // Save the file path with the folder name
        }

        // If a new password is provided, update it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the user's changes
        $user->save();

        // Redirect with a success message
        return redirect()->route('user.home')->with('status', 'Your profile has been updated successfully.');
    }
    public function viewViaCategory($id)
    {
        $pizzaData = Product::where('category_id', $id) // Specify `products.category_id`
            ->paginate(6);

        // dd($pizzaData->toArray());
        $categories = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizzaData', 'categories', 'cart'));

    }
    public function detail($id)
    {
        $pizza = Product::where('product_id', $id)->get()->toArray();
        $relatedProducts = Product::where('product_id', '!=', $id)->get();
        // dd($relatedProducts);
        $reviews = Review::with('user')->where('product_id', $id)->get();
        $reviewCount = $reviews->count();
        // dd($reviews->toArray());
        return view('user.main.detail', compact('pizza', 'relatedProducts' ,'reviews','reviewCount'));
    }
    public function viewCart()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
            ->leftJoin('products', 'products.product_id', 'carts.product_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        // dd($cartList->toArray());
        // dd($cartList->toArray());
        $totalPrice = 0;
        $totalQuantity = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c['pizza_price'] * $c['qty'];
            $totalQuantity += $c['qty'];
        }



        $shipping = $totalQuantity * 10;


        // return response($qrCode)->header('Content-Type', 'image/svg+xml');
        // dd($totalPrice);
        // dd($totalQuantity);
        // dd($cartList->toArray());
        return view('user.main.viewCart', compact('cartList', 'totalPrice', 'shipping' ));
    }
    //CART
    public function history()
    {
        $orderList = OrderList::where('user_id', Auth::user()->id)
            ->get()
            ->map(function ($order) {
                // Cast order_code to integer to ensure correct comparison
                $order->status = ((int) $order->status === 0)
                ? 'Pending'
                : (((int) $order->status === 1)
                    ? 'Confirmed'
                    : 'Rejected');

                return $order;
            });

        // dd($orderList->toArray()); // Debugging: Inspect the transformed data

        return view('user.main.history', compact('orderList'));
    }

    public function generateQRCode()
    {
        // Create a QR Code with the Builder
        $result = Builder::create()
            ->data('https://example.com') // The data for the QR Code
            ->size(300)                  // Size of the QR Code
            ->margin(10)                 // Margin around the QR Code
            ->build();

        // Save the QR Code as a file (optional)
        $result->saveToFile(public_path('qrcodes/qrcode.png'));

        // Return the QR Code inline in the browser
        return response($result->getString(), 200, ['Content-Type' => $result->getMimeType()]);
    }
    public function createReview(Request $request){
        $data = $request->toArray();
        Review::create([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'content' => $data['content'],
            'rating' => $data['rating'] // Use the total value from the request
        ]);
        return back();
    }
}
