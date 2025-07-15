@extends('admin.layouts.master')
@section('title','Add Category')
@section('content')
<div class="px-4 container-fluid">
    <!-- Back to List Button -->
    <div class="mb-4 row">
        <div class="col-12 text-end">
            <a href="{{ route('category#list') }}" class="text-white btn"
               style="background-color: #6c5ce7 !important;">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="border-0 card" style="box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                <!-- Card Header -->
                <div class="border-0 card-header" style="background-color: #6c5ce7 !important;">
                    <h3 class="py-3 m-0 text-center text-white">
                        <i class="fas fa-folder-plus me-2"></i>Add New Category
                    </h3>
                </div>

                <div class="p-5 card-body" style="background-color: #f8f9fa !important;">
                    <form action="{{ route('category#create') }}" method="post" novalidate="novalidate">
                        @csrf
                        <!-- Category Name Input -->
                        <div class="mb-4 form-group">
                            <label for="category_name" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-tag me-2"></i>Category Name
                            </label>
                            <input id="category_name"
                                   name="category_name"
                                   type="text"
                                   class="form-control form-control-lg @error('category_name') is-invalid @enderror"
                                   placeholder="Enter category name..."
                                   value="{{ old('category_name') }}"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   autofocus>

                            @error('category_name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Category Description Input -->

          <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="px-5 py-3 text-white btn btn-lg"
                                    style="background-color: #6c5ce7 !important; border-radius: 50px !important; min-width: 200px !important;">
                                <i class="fas fa-plus-circle me-2"></i>
                                <span>Create Category</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #6c5ce7 !important;
        box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25) !important;
    }

    .btn:hover {
        opacity: 0.9 !important;
    }
</style>
@endsection
