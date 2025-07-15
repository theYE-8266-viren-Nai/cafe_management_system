@extends('admin.layouts.master')

@section('title','blog/create')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('admin.blogs.viewBlogs') }}"><button class="my-3 text-white btn bg-dark">Back</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Create a Blog</h3>
                </div>
                <hr>
                <form action="{{ route('admin.blogs.createBlogData') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <!-- Blog Title -->
                        <label for="title" class="mb-1 control-label">Title</label>
                        <input id="title" name="title" type="text"
                            class="form-control mb-3 @error('title') is-invalid @enderror" placeholder="Enter blog title"
                            value="{{ old('title') }}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Short Description -->
                        <label for="description" class="mb-2 control-label">Short Description</label>
                        <textarea name="description" class="form-control" cols="5" rows="3" placeholder="Enter short description">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Full Description -->
                        <label for="full_description" class="mb-2 control-label">Full Description</label>
                        <textarea name="full_description" class="form-control" cols="5" rows="5" placeholder="Enter full details">{{ old('full_description') }}</textarea>
                        @error('full_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Author -->
                        <label for="author" class="mb-1 control-label">Author</label>
                        <input id="author" name="author" type="text"
                            class="form-control mb-3 @error('author') is-invalid @enderror" placeholder="Enter author name"
                            value="{{ old('author') }}">
                        @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Image Upload -->
                        <label for="image" class="mb-1 control-label">Image</label>
                        <input id="image" name="image" type="file"
                            class="form-control mb-3 @error('image') is-invalid @enderror">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button id="submit-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="submit-button-text">Create Blog</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
