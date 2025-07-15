@extends('user.layouts.master')

@section('container')
<div style="background-color: #f5e8d8;">

    <div class="container py-5">
        <!-- Hero Section -->
        <div class="mb-5 text-center">
            <h1 class="fw-bold text-dark" style="font-family: 'Playfair Display', serif; letter-spacing: 1px;">
                Our Café Blog
            </h1>
            <p class="text-muted">Stay updated with our latest stories and insights</p>
        </div>

        <!-- Blog Posts -->
        @foreach ($blogs as $index => $blog)
        <div class="row align-items-center mb-5 blog-post {{ $index % 2 === 0 ? 'flex-md-row' : 'flex-md-row-reverse' }}">
            <!-- Blog Image -->
            <div class="col-md-6">
                <div class="blog-image-container">
                    <img src="{{ asset('storage/' . $blog->image) }}"
                         class="rounded shadow-sm img-fluid"
                         alt="{{ $blog->title }}"
                         style="object-fit: cover; max-height: 300px; width: 100%; border-radius: 8px;">
                </div>
            </div>

            <!-- Blog Content -->
            <div class="col-md-6">
                <div class="p-4 shadow-sm blog-content" style="background-color: #fff; border-radius: 10px;">
                    <h2 class="mb-2 fw-semibold text-dark">{{ $blog->title }}</h2>
                    <p class="text-muted">By <span class="fw-semibold">{{ $blog->author }}</span> · {{ $blog->created_at->format('F j, Y') }}</p>
                    <p class="mb-3 text-dark fs-5">{{ Str::words($blog->description, 20, '...') }}</p>
                    <a href="{{ route('user.menu.lookMore', $blog->id) }}" class="btn btn-dark elegant-btn">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Custom Styles for Medium-Like Aesthetic with "About Us" Theme -->
<style>
    body {
        background-color: #f5e8d8;
    }

    .blog-post {
        background: #fff;
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-post:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .blog-content {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    .blog-image-container img {
        transition: transform 0.3s ease;
    }

    .blog-image-container:hover img {
        transform: scale(1.03);
    }

    .elegant-btn {
        background-color: #343a40; /* Dark button color matching "About Us" */
        text-transform: uppercase;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .elegant-btn:hover {
        background-color: #23272b; /* Slightly darker on hover */
        color: white;
    }

    @media (max-width: 767px) {
        .blog-post {
            flex-direction: column !important;
        }
        .blog-content {
            text-align: center;
        }
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection