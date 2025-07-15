@extends('admin.layouts.master')

@section('title', 'Blog Details')

@section('content')
<div class="px-4 container-fluid">
    <!-- Back to List Button -->
    <div class="mb-4 row">
        <div class="col-12 text-end">
            <a href="{{ route('admin.blogs.viewBlogs') }}" class="text-white btn"
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
                        <i class="fas fa-blog me-2"></i>{{ $blog->title }}
                    </h3>
                </div>

                <div class="p-5 card-body" style="background-color: #f8f9fa !important;">
                    <!-- Author -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #a8e6cf !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-user me-2"></i><strong>Author</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $blog->author ?? 'Unknown Author' }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffd3b6 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-align-left me-2"></i><strong>Description</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $blog->description ?? 'No Description' }}
                        </p>
                    </div>

                    <!-- Full Description -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffaaa5 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-align-left me-2"></i><strong>Full Description</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $blog->full_description ?? 'No Full Description' }}
                        </p>
                    </div>

                    <!-- Image -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #6c5ce7 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-image me-2"></i><strong>Image</strong>
                        </h5>
                        <div class="text-center">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}"
                                     alt="Blog Image"
                                     class="rounded shadow-sm"
                                     style="max-width: 300px; width: 100%; height: auto;">
                            @else
                                <p class="text-muted">No Image Available</p>
                            @endif
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #d4a4eb !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-calendar-alt me-2"></i><strong>Created At</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $blog->created_at ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Updated At -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffccd5 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-calendar-check me-2"></i><strong>Updated At</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $blog->updated_at ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Back to List Button -->
                    <div class="mt-5 text-center">
                        <a href="{{ route('admin.blogs.viewBlogs') }}"
                           class="px-5 py-3 text-white btn btn-lg"
                           style="background-color: #6c5ce7 !important; border-radius: 50px !important; min-width: 200px !important;">
                            <i class="fas fa-list me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn:hover {
        opacity: 0.9 !important;
        transform: translateY(-1px) !important;
        transition: all 0.3s !important;
    }
</style>
@endsection