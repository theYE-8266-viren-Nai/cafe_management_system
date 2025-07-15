<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Builder\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function search(request $request){
        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('user.blogs')->with('error', 'Please enter a search term.');
        }

        // Search products (adjust the model and columns based on your schema)
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();

        // Fetch all categories for the filter dropdown
        $categories = Category::all();

        // Redirect to user.blog with products and query
        return redirect()->route('user.blogs', ['products' => $products, 'query' => $query])
            ->with('categories', $categories);

    }
    public function anotherPage(){
        $products = DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id') // Adjust 'id' if your category_id column name differs
        ->select(
            'products.image', // Assuming this is the column for product images
            'categories.name as category_name',
            'categories.category_id as category_id',
            'products.description as product_description' // Assuming this is the column for product descriptions
        )
        ->get();

    // Group products by category_id and extract only category_name, one product image, and description per category
    $categories = collect($products)->groupBy('category_id')->map(function ($productsInCategory) {
        $firstProduct = $productsInCategory->first();
        return [
            'name' => $firstProduct->category_name,
            'image' => $firstProduct->image,
            'description' => $firstProduct->product_description ?? 'No description available',
        ];
    })->values()->all();
    // dd($categories);
    // Pass the simplified data to the view
    return view('user.main.anotherPage', compact('categories'));

    }

    public function menu(){
    //     $products = DB::table('products')
    //     ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
    //     ->select(
    //         'products.*',
    //         'categories.name as category_name'
    //     )
    //     ->get();

    // $menu = collect($products)->groupBy('category_id'); // Group by category_id
    $blogs = Blog::get();
    return view('user.main.menu', compact('blogs'));
    }
    public function blogs(){
        $products = Product::get();
        $categories = Category::get();
        return view('user.main.blogs', compact('products' , 'categories'));
    }

    public function getProductsByCategory($id)
    {
        if ($id === '' || $id === null) {
            $products = Product::with('category')->get(); // Return all products for "All Categories"
        } else {
            $products = Product::with('category')->where('category_id', $id)->get();
        }
        return response()->json($products);
    }
    public function more($id){
        $product = Product::where('product_id', $id)->first();
        return view('user.main.more',compact('product'));
    }
    public function home1(){
        return view('user.main.home1');
    }
    public function aboutus(){
        $reviews = Review::join('users', 'reviews.user_id', '=', 'users.id')
        ->join('products', 'reviews.product_id', '=', 'products.product_id')
        ->select('reviews.*', 'users.name as user_name', 'products.name as product_name', 'products.image as product_image')
        ->get();
// dd($reviews->toArray());
        return view('user.main.aboutUs', compact('reviews'));
    }
    public function orderMenu()
    {
        $pizzaData = Product::select('products.*', 'categories.name AS category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.category_id')
            ->paginate(6); // Use paginate instead of get()

        $categories = Category::all();
        $confirmedOrders = OrderList::where('status', 'confirmed')->get();

        // Or, if you want to get data for a specific user:
        $userId = Auth::user()->id; // Assuming you're using authentication
        $confirmedOrdersForUser = OrderList::select('order_lists.*', 'products.name as product_name')
            ->join('products', 'order_lists.product_id', '=', 'products.product_id')
            ->where('order_lists.status', 1)
            ->where('order_lists.user_id', $userId)
            ->get();

        // dd($confirmedOrdersForUser->toArray());
        $cart = Cart::where('user_id', Auth::id())->get();

        return view('user.main.orderMenu', compact('pizzaData', 'categories', 'cart', 'confirmedOrdersForUser'));
    }
    public function home2(){
        return view('user.main.realHome');
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

        return redirect()->route('user.orderMenu')->with('status', 'Password successfully updated');
    }
    public function account()
    {
        return view('user.profile.account');
    }
    public function accountUpdate(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048', // Max 2MB
            'password' => 'nullable|min:8|confirmed', // Password is optional, but if provided, must be at least 8 characters and match confirmation
        ]);

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone; // Update phone if provided
        $user->address = $request->address;
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
        return redirect()->route('user.orderMenu')->with('status', 'Your profile has been updated successfully.');
    }
    public function viewViaCategory($id)
    {
        $pizzaData = Product::where('category_id', $id) // Specify `products.category_id`
            ->paginate(6);

        // dd($pizzaData->toArray());
        $categories = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();

        $confirmedOrdersForUser = OrderList::select('order_lists.*', 'products.name as product_name')
        ->join('products', 'order_lists.product_id', '=', 'products.product_id')
        ->where('order_lists.status', 1)
        ->where('order_lists.user_id', Auth::user()->id)
        ->get();
        // dd($confirmedOrdersForUser);
        return view('user.main.orderMenu', compact('pizzaData', 'categories', 'cart','confirmedOrdersForUser'));

    }
    public function viewThroughCategory($id)
    {
       dd($id);

    }
    public function detail($id)
    {
        $pizza = Product::where('product_id', $id)->get()->toArray();
        $relatedProducts = Product::where('product_id', '!=', $id)->get();
        // dd($relatedProducts);
        $reviews = Review::with('user')->where('product_id', $id)->get();
        $reviewCount = $reviews->count();
        // dd($reviews->toArray());
        return view('user.main.detail', compact('pizza', 'relatedProducts', 'reviews', 'reviewCount'));
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
        return view('user.main.viewCart', compact('cartList', 'totalPrice', 'shipping'));
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
    public function createReview(Request $request)
    {
        $data = $request->toArray();
        Review::create([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'content' => $data['content'],
            'job_title' => $data['job_title']
        ]);
        return back();
    }
}
