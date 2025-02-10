@extends('admin.layouts.master')
@section('title', 'Pizza Details')
@section('content')
<div class="container mt-5">
    <div class="border-0 shadow-lg card">
        <div class="py-4 text-center text-white card-header bg-slate-400">
            <h3 class="mb-0">{{ $pizza['name'] }}</h3>
        </div>
        <div class="p-4 card-body">
            <!-- Category -->
            <div class="mb-3">
                <h5><strong>Category:</strong></h5>
                <p class="text-muted">{{ $pizza['category_name'] ?? 'No Category' }}</p>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <h5><strong>Description:</strong></h5>
                <p class="text-muted">{{ $pizza['description'] }}</p>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <h5><strong>Price:</strong></h5>
                <p class="text-success">$ {{ number_format($pizza['price'], 2) }}</p>
            </div>

            <!-- Image -->
            <div class="mb-4 text-center">
                <h5><strong>Image:</strong></h5>
                @if ($pizza['image'])
                    <img src="{{ asset('storage/' . $pizza['image']) }}" alt="Pizza Image" class="rounded img-fluid" width="300">
                @else
                    <p class="text-muted">No Image Available</p>
                @endif
            </div>

            <!-- Back to List Button -->
            <div class="mt-4 text-center">
                <a href="{{ route('admin.product.list') }}" class="btn btn-outline-primary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
