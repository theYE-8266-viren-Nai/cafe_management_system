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
    public function editPizzaData(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id', // Ensure product_id exists in products table
            'name' => 'required|string|min:2|max:100', // Name is required, string, 2-100 chars
            'description' => 'required|string|max:255', // Short description, max 255 chars
            'price' => 'required|numeric|min:0|max:999999.99', // Price is numeric, reasonable range
            'full_description' => 'nullable|string|max:1000', // Optional, max 1000 chars
            'nutrition' => 'nullable|string|max:500', // Optional, max 500 chars
            'ingredient' => 'nullable|string|max:500', // Optional, max 500 chars
            'preparation' => 'nullable|string|max:500', // Optional, max 500 chars
            'image' => 'nullable|image|mimes:jpeg,png,gif|max:2048', // Optional image, specific types, max 2MB
        ]);

        // Find the pizza by product_id
        $pizza = Product::findOrFail($validated['product_id']);

        // Update pizza attributes with validated data
        $pizza->name = $validated['name'];
        $pizza->description = $validated['description'];
        $pizza->price = $validated['price'];
        $pizza->full_description = $validated['full_description'];
        $pizza->nutrition = $validated['nutrition'];
        $pizza->ingredient = $validated['ingredient'];
        $pizza->preparation = $validated['preparation'];

        // Handle profile picture upload
        if ($request->hasFile('image')) {
            // Check if the user already has a profile picture
            if ($pizza->image) {
                // Delete the existing profile image from storage
                Storage::delete('public/' . $pizza->image);
            }

            // Generate a unique name for the new image
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();

            // Store the new profile image in the 'public/images' folder
            $request->file('image')->storeAs('public/images', $fileName);

            // Update the pizza's image path
            $pizza->image = 'images/' . $fileName;
        }

        // Save the updated pizza record
        $pizza->save();

        // Redirect with success message
        return redirect()->route('admin.product.list')->with('success', 'Pizza updated successfully');
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
    private function dataSaveMethod(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'description' => 'required|string|max:255',
            'full_description' => 'nullable|string|max:1000',
            'nutrition' => 'nullable|string|max:500',
            'ingredient' => 'nullable|string|max:500',
            'preparation' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0|max:999999.99',
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048', // Max 2MB
            'category_id' => 'required|exists:categories,category_id', // Assuming you have a categories table
            'stock' => 'required|integer|min:0|max:9999',
        ]);

        // Create a new Product instance
        $pizza = new Product();
        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->price = $request->price;
        $pizza->full_description = $request->full_description;
        $pizza->nutrition = $request->nutrition;
        $pizza->ingredient = $request->ingredient;
        $pizza->preparation = $request->preparation;
        $pizza->category_id = $request->category_id; // Added category_id
        $pizza->stock = $request->stock; // Added stock

        // Handle image upload
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('public/images', $fileName);
            $pizza->image = 'images/' . $fileName; // Save relative path to database
        }

        // Save the pizza data to the database
        $pizza->save();

        return $pizza; // Optional: Return the saved model if needed
    }
}
