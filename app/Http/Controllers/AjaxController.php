<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Milon\Barcode\DNS2D;
use App\Models\OrderList;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\Writer\PngWriter;

class AjaxController extends Controller
{
    public function pizzaList(request $request)
    {
        // dd($request->all());
        logger($request->all());
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();

        } else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }
        return $data;
    }
    public function menuSort(request $request){
        logger($request->all());
        $categoryName = $request->query('category_name');

        if ($categoryName) {
            // Assuming you have a relationship or column for category name
            $products = Product::whereHas('category', function ($query) use ($categoryName) {
                $query->where('name', $categoryName);
            })->get();
        } else {
            // Return all products if no category is selected
            $products = Product::all();
        }

        return response()->json($products);
    }
    // cart
    public function cart(request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => "added to cart successfully",
            'status' => "success"
        ];
        return response()->json($response, 200);
    }
    public function order(request $request)
    {
        logger($request->all());
        foreach ($request->all() as $item) {
            try {
                logger($request->all());

                foreach ($request->order_list as $item) {
                    logger('Inserting Order:', $item);
                    OrderList::create([
                        'user_id' => $item['user_id'],
                        'product_id' => $item['product_id'],
                        'qty' => $item['qty'],
                        'total' => $item['total_value'], // Use the total value from the request
                        'order_code' => $request->order_code,
                        'payment_method' =>  $request->payment_method
                    ]);
                }
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->stock -= $item['qty']; // Deduct ordered quantity
                    $product->save();
                }
                Cart::where('user_id', $request->order_list[0]['user_id'])->delete();
                return response()->json([
                    'message' => "Order placed successfully!",
                    'status' => "success",
                ], 200);

            } catch (\Exception $e) {
                Log::error("Order placement error: " . $e->getMessage());

                return response()->json([
                    'message' => "An error occurred while placing the order.",
                    'error' => $e->getMessage(),
                ], 500);
            }
        }
    }

    //     Cart::where('user_id', Auth::user()->id)->delete();

    public function update(Request $request){
        $data = $request->toArray();
        $cart_id = $data['cart_id'];
        $qty =  $data['qty'];
        logger($cart_id);
        logger($qty);
        $updated = Cart::where('card_id', $cart_id)->update(['qty' => $qty]);

        if ($updated) {
            // Log a message indicating the update was successful
            logger("Cart item with ID {$cart_id} updated successfully.");

            // Return a success response
            return response()->json(['message' => 'Cart updated successfully.']);
        } else {
            // Log a message indicating the cart item was not found
            logger("Cart item with ID {$cart_id} not found.");

            // Return an error response
            return response()->json(['message' => 'Cart item not found.'], 404);
        }


    }
    public function remove(Request $request){
        $cartId = $request->input('cart_id');
        logger($cartId);
        // Validate that cart_id is provided
        if (!$cartId) {
            return response()->json(['message' => 'Cart ID is required.'], 400);
        }

        // Attempt to find and delete the cart item
        $removed = Cart::where('card_id', $cartId)->delete();
        if ($removed) {

            // Log a message indicating the removal was successful
            logger("Cart item with ID {$cartId} removed successfully.");
            // Return a success response
            return response()->json(['message' => 'Cart item removed successfully.']);
        } else {
            // Log a message indicating the cart item was not found
            logger("Cart item with ID {$cartId} not found.");
            // Return an error response
            return response()->json(['message' => 'Cart item not found.'], 404);
        }
    }
    public function generateQR(Request $request)
    {
        Log::info('QR Code Data:', ['order_data' => $request->order_data]);

        if (!$request->order_data) {
            return response()->json(['error' => 'No order data provided'], 400);
        }

        // Instantiate DNS2D class
        $barcode = new DNS2D();
        $qrCode = $barcode->getBarcodeHTML(json_encode($request->order_data), 'QRCODE');

        return response()->json(['qr_code' => $qrCode]);
    }
    public function qrHasBeenScanned(request $request){
        $id = $request->orderListId;
        // logger($id);
        $removed = OrderList::where('id', $id)->delete();
    }
    //private functions
    private function getOrderData($data)
    {
        return [
            'user_id' => $data->userId,
            'product_id' => $data->pizzaId,
            'qty' => $data->count
        ];
    }
}

