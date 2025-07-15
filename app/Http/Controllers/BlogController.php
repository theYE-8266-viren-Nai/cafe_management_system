<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::paginate(4); // Paginate directly from the query builder
        return view('admin.blogs.blogs', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function createBlogData(Request $request)
    {
        // Validate the request
        $this->validateBlog($request);

        // Save the blog data
        $this->saveBlogData($request);

        // Redirect to the blog list with a success message
        return redirect()->route('admin.blogs.viewBlogs')->with('success', 'Blog created successfully!');
    }

    public function lookMore($id)
    {
        $blog = Blog::where('id', $id)->first();
        return view('user.main.seeMore', compact('blog'));
    }

    public function viewUpdate($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.viewUpdate', ['blog' => $blog]);
    }
    public function view($id){
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.view',compact('blog'));
    }
    public function edit(Request $request)
    {
        $blogId = $request->input('id');
        $title = $request->input('title');
        $description = $request->input('description');
        $full_description = $request->input('full_description');
        $author = $request->input('author');

        $blog = Blog::findOrFail($blogId);
        $blog->title = $title;
        $blog->description = $description;
        $blog->full_description = $full_description;
        $blog->author = $author;

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $this->validateBlog($request); // Re-validate to ensure new image meets requirements
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('public/images', $fileName);
            $blog->image = 'images/' . $fileName;
        }

        // Save the changes to the database
        $blog->save();
        session()->flash('updateSuccess', 'Blog updated successfully!');
        return redirect()->route('admin.blogs.viewBlogs');
    }

    public function delete($id)
    {
        Blog::where('id', $id)->delete();
        return back()->with('delSuccess', 'Blog deleted successfully!');
    }

    private function validateBlog($request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:5',
            'full_description' => 'required|string|min:10',
            'author' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);
    }

    private function saveBlogData($request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->full_description = $request->full_description;
        $blog->author = $request->author;

        // Handle image upload
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('public/images', $fileName);
            $blog->image = 'images/' . $fileName;
        }

        // Save blog data
        $blog->save();
    }
}
