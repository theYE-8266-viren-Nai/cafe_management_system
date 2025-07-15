@extends('admin.layouts.master')

@section('title', 'Blog/Update')

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
                    <h3 class="text-center title-2">Update your Blog</h3>
                </div>
                <hr>
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updates -->
                    <div class="form-group">
                        <!-- ID Input (Hidden) -->
                        <input type="hidden" name="id" value="{{ $blog->id }}">

                        <!-- Title Input -->
                        <label for="title" class="mb-1 control-label">Title</label>
                        <input id="title" name="title" type="text"
                            class="form-control mb-3 @error('title') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" placeholder="Blog Title" value="{{ old('title', $blog->title) }}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Description Textarea -->
                        <label for="description" class="mb-2 control-label">Description</label>
                        <textarea name="description" class="form-control mb-3 @error('description') is-invalid @enderror" cols="5" rows="5">{{ old('description', $blog->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Full Description Textarea -->
                        <label for="full_description" class="mt-1 mb-1 control-label">Full Description</label>
                        <textarea name="full_description" class="form-control mb-3 @error('full_description') is-invalid @enderror" cols="5" rows="5">{{ old('full_description', $blog->full_description) }}</textarea>
                        @error('full_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Author Input -->
                        <label for="author" class="mb-1 control-label">Author</label>
                        <input id="author" name="author" type="text"
                            class="form-control mb-3 @error('author') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" placeholder="Author Name" value="{{ old('author', $blog->author) }}">
                        @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Image Upload -->
                        <label for="image" class="mb-1 control-label">Image</label>
                        <input id="image" name="image" type="file"
                            class="form-control mb-3 @error('image') is-invalid @enderror" aria-required="false"
                            aria-invalid="false" value="{{ old('image') }}">
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Blog Image" width="100" class="mt-2 mb-3">
                        @endif
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Update</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
