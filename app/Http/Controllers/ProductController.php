<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function list(){

        $pizzaData = Product::
        select('products.*', 'categories.name AS category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like' , '%'.request('key') . '%');
        })->
        leftJoin('categories', 'products.category_id' , 'categories.category_id')
        ->orderBy('product_id','desc')->paginate(4);;
        // dd($pizzaData);
        return view('admin.products.list',compact('pizzaData'));
    }
    public function createPizza(){
        $categories = Category::all()->toArray();
        // foreach($categories as $category){
        //     echo ($category['name']);
        // }
        // dd($categories);
        return view('admin.products.create' ,compact('categories'));
    }
    public function pizzaData(Request $request){
        // dd($request->toArray());
        $this->dataSaveMethod($request);
        $pizzaData = Product::all()->toArray();

        // dd($pizzaData);
        // Step 3: Optional: Return a response or redirect
        return redirect()->route('admin.product.list')->with('success', 'Pizza data saved successfully!');

    }
    // this is for delete
    public function delete($id){
        Product::where('product_id',$id)->delete();
        return back()->with('delSuccess', 'Category deleted successfully!');
    }
    //view Pizza
    public function view($id) {
        $pizza = Product::select('products.*', 'categories.name AS category_name')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
        ->where('products.product_id', $id)
        ->firstOrFail()
        ->toArray();
        // dd($pizza);
        return view('admin.products.view', compact('pizza'));
    }
    //updateData
    public function editPizza($id){
        $categories = Category::all()->toArray();
        $pizza = Product::where('product_id',$id)->firstOrFail()->toArray();
        return view('admin.products.viewUpdate' , ['pizza' => $pizza ,  'categories' => $categories]);
    }
    public function editPizzaData(Request $request ){
        // dd($request->toArray());
        $id = $request['product_id'];
        // $pizza = Product::where('product_id',$id)->first();
        $pizza = Product::findOrFail($id);
        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->price = $request->price;
        // Handle profile picture upload
        if ($request->hasFile('image')) {
            // Check if the user already has a profile picture
            if ($pizza->image) {
                // Delete the existing profile image from storage
                Storage::delete('public/' . $pizza->image);
            }

            // Generate a unique name for the new image
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

            // Store the new profile image in the 'public' folder
            $request->file('image')->storeAs('public/images', $fileName);

            // Update the user's profile picture path
            $pizza->image = 'images/' . $fileName; // Save the file path with the folder name
        }
        $pizza->save();
        return redirect()->route('admin.product.list');
    }
    // validation
    private function  validation ($request){
        $request->validate([
            'name' => 'required|string|max:255', // Name is required and must be a string with a max length of 255
            'category_id' => 'required', // Category is required and must exist in the categories table
            'description' => 'required|string|min:5', // Description is required, must be a string with a minimum length of 10
            'price' => 'required|numeric|min:0', // Price is required, must be numeric, and at least 0
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048', // Image is required, must be an image, and max 2MB
        ]);
    }
    private function dataSaveMethod($request){
        $pizza = new Product();
        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->price = $request->price;
        $pizza->category_id = $request->category_id;
        $pizza->stock = $request->stock;
        // Handle image upload
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('public/images', $fileName);
            $pizza->image = 'images/' . $fileName; // Save relative path to database
        }

        // Save the pizza data to the database
        $pizza->save();
    }
}
