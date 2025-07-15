@extends('admin.layouts.master')

@section('title', 'Pizza Details')

@section('content')
<div class="px-4 container-fluid">
    <!-- Back to List Button -->
    <div class="mb-4 row">
        <div class="col-12 text-end">
            <a href="{{ route('admin.product.list') }}" class="text-white btn"
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
                        <i class="fas fa-pizza-slice me-2"></i>{{ $pizza['name'] }}
                    </h3>
                </div>

                <div class="p-5 card-body" style="background-color: #f8f9fa !important;">
                    <!-- Category -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #a8e6cf !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-folder me-2"></i><strong>Category</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['category_name'] ?? 'No Category' }}
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffd3b6 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-align-left me-2"></i><strong>Description</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['description'] ?? 'No Description' }}
                        </p>
                    </div>

                    <!-- Full Description -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffaaa5 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-align-left me-2"></i><strong>Full Description</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['full_description'] ?? 'No Full Description' }}
                        </p>
                    </div>

                    <!-- Nutrition -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #fab1a0 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-utensils me-2"></i><strong>Nutrition</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['nutrition'] ?? 'No Nutrition Information' }}
                        </p>
                    </div>

                    <!-- Ingredient -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffccd5 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-seedling me-2"></i><strong>Ingredient</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['ingredient'] ?? 'No Ingredients Listed' }}
                        </p>
                    </div>

                    <!-- Preparation -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #d4a4eb !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-concierge-bell me-2"></i><strong>Preparation</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['preparation'] ?? 'No Preparation Details' }}
                        </p>
                    </div>

                    <!-- Price -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffaaa5 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-tag me-2"></i><strong>Price</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            $ {{ number_format($pizza['price'], 2) }}
                        </p>
                    </div>

                    <!-- Stock -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #a8e6cf !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-warehouse me-2"></i><strong>Stock</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['stock'] ?? 'Out of Stock' }} units
                        </p>
                    </div>



                    <!-- Image -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #6c5ce7 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-image me-2"></i><strong>Image</strong>
                        </h5>
                        <div class="text-center">
                            @if ($pizza['image'])
                                <img src="{{ asset('storage/' . $pizza['image']) }}"
                                     alt="Pizza Image"
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
                            {{ $pizza['created_at'] ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Updated At -->
                    <div class="p-4 mb-4 rounded-3"
                         style="border-left: 5px solid #ffccd5 !important; background-color: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                        <h5 class="mb-3" style="color: #6c5ce7 !important;">
                            <i class="fas fa-calendar-check me-2"></i><strong>Updated At</strong>
                        </h5>
                        <p class="mb-0 ms-4" style="color: #2d3436; font-size: 1.1rem;">
                            {{ $pizza['updated_at'] ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Back to List Button -->
                    <div class="mt-5 text-center">
                        <a href="{{ route('admin.product.list') }}"
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
