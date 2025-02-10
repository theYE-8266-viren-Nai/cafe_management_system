<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // "%{$query}%"
    public function list()  {
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like' , '%'.request('key') . '%');
        })->
        orderBy('category_id','desc')->paginate(4);
        return view('admin.category.list',compact('categories'));
    }
    public function createPage()  {
        return view('admin.category.create');
    }
    public function create(request $request){
        $this->validateCreate($request);
        $category_name  =  $this->reformatCategory_name($request);
        Category::create($category_name);
        session()->flash('success', 'Category created successfully!');
        return redirect()->route('category#list');
        // dd($request->all());
    }
    public function delete($id){
        Category::where('category_id',$id)->delete();
        return back()->with('delSuccess', 'Category deleted successfully!');
    }
    public function viewUpdate($id){
            return view('admin.category.viewUpdate', ['id' => $id]);
    }
    public function edit(request $request){
        $category_id = $request->toArray()['id'];
        $name = $request->toArray()['category_name'];
        // dd($category_id);
        $category = Category::findOrFail($category_id);
        $category->name = $name;

        // Save the changes to the database
        $category->save();
        session()->flash('updateSuccess', 'Category updated successfully!');
        return redirect()->route('category#list');
}
    // private
    private function validateCreate(Request $request)
    {
        // Validation rules
        $request->validate([
            'category_name' => 'required|unique:categories,name',

        ]);
    }
    private function reformatCategory_name( $request)
    {
        // Example: Change the format of the array
        return [
            'name' => $request->category_name
            // Add more transformation logic as needed
        ];
    }
}
