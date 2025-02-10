<?php

namespace App\Http\Controllers;

use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderListController extends Controller
{
    public function orderList()
    {
        $orderList = DB::table('order_lists')
            ->join('users', 'order_lists.user_id', '=', 'users.id')
            ->join('products', 'order_lists.product_id', '=', 'products.product_id')
            ->select(
                'order_lists.*', // Select all columns from order_lists
                'users.name as user_name', // Rename user name column
                'products.name as product_name' ,// Rename product name column
                 'products.stock as stock'
            )
            ->orderBy('order_lists.order_code') // Ensure orders are grouped by order_code
            ->get();

        // Debugging: Check the output structure
        // dd($orderList->toArray());
                // $stock = Product::find()
        return view('admin.category.orderList', compact('orderList' ));
    }
    public function updateOrderStatus(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'order_code' => 'required|exists:order_lists,order_code',
        'status' => 'required|in:0,1,-1',
    ]);

    // Update all rows with the same order_code
    OrderList::where('order_code', $validated['order_code'])
        ->update(['status' => $validated['status']]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Order status updated successfully!');
}

}
