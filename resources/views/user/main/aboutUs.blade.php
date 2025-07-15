@extends('user.layouts.master')

@section('container')
<div style="background-color: #f5e8d8;">

    <div class="container py-5">
        <!-- Hero Section -->
        <div class="mb-5 text-center">
            <h1 class="fw-bold">About Us</h1>
            <p class="text-muted">Discover our journey and passion for coffee</p>
        </div>

        <!-- About Content -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/aboutUs.jpg') }}" class="rounded img-fluid" alt="About Us">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold">Our Story</h2>
                <p class="text-muted">
                    We started with a passion for delivering the finest coffee experience. Our beans are carefully sourced, roasted to perfection, and brewed with love.
                </p>
                <p class="text-muted">
                    Quality and customer satisfaction are at the heart of everything we do. Join us for a cup of excellence!
                </p>
                <a href="{{ route('user.menu') }}" class="btn btn-dark">Explore Our Products</a>
            </div>
        </div>

        <!-- Customer Reviews Section -->
        <div class="mt-5 text-center">
            <h2 class="fw-bold">Our Happy Customers</h2>
            <p class="text-muted">See what our customers have to say about us</p>
        </div>

        <div class="row g-4">
            @foreach ($reviews as $index => $review)
            <div class="col-md-12 col-lg-6">
                <div class="shadow-sm card h-100 cafe-card">
                    <div class="row g-0">
                        <!-- Product Image (Now Above Text) -->
                        <div class="col-12">
                            <div class="overflow-hidden image-container rounded-top" style="height: 200px; width: 100%;">
                                <img src="{{ asset('storage/' . $review->product_image) }}" class="img-fluid w-100 h-100" alt="{{ $review->product_name }}" style="object-fit: cover;">
                            </div>
                        </div>

                        <!-- Review Content (Below Image) -->
                        <div class="col-12">
                            <div class="p-4 card-body">
                                <div class="mb-2 d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-semibold text-dark">{{ $review->user_name }}</h5>
                                    <span class="text-muted fst-italic">{{ $review->job_title ?? 'Customer' }}</span>
                                </div>
                                <p class="mb-3 text-dark">{{ $review->content }}</p>
                                <small class="text-muted">Reviewed on {{ $review->created_at->format('F j, Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection