@extends('user.layouts.master')

@section('container')
<div class="container my-5" style="max-width: 750px; font-family: 'Georgia', serif;">
    <!-- Blog Title -->
    <h1 class="fw-bold text-center mb-3">{{ $blog->title }}</h1>

    <!-- Author & Date -->
    <div class="d-flex align-items-center justify-content-center mb-4">
        {{--  <img src="{{ asset('images/author.png') }}" class="rounded-circle me-2" width="40" height="40" alt="Author">  --}}
        <div>
            <p class="mb-0"><strong>{{ $blog->author ?? 'Unknown' }}</strong> · {{ $blog->created_at->format('F d, Y') }}</p>
        </div>
    </div>

    <!-- Blog Image -->
    @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}"
            class="img-fluid rounded shadow-sm mb-4"
            alt="{{ $blog->title }}"
            style="max-height: 500px; width: 100%; object-fit: cover; border-radius: 8px;">
    @endif

    <!-- Blog Content -->
    <div class="blog-content" style="line-height: 1.8; font-size: 18px; color: #333;">
        <p>{{ $blog->description }}</p>
        <p>{{ $blog->full_description }}</p>
    </div>

    <!-- Back to Blogs -->
    <div class="text-center mt-5">
        <a href="{{ route('user.menu') }}" class="btn btn-outline-dark">Back to Blogs</a>
    </div>
</div>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
