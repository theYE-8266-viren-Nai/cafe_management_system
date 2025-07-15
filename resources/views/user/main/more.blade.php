@extends('user.layouts.master')

@section('container')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <article class="p-4 rounded shadow-lg blog-post bg-light">
                <!-- Header with Animated Title -->
                <h1 class="mb-4 text-center text-dark fw-bold animate__animated animate__fadeInDown">{{ $product['name'] ?? 'Menu Item' }}</h1>

                <!-- Image and Nutritional Information Side by Side -->
                <div class="mb-4 row">
                    <!-- Featured Image -->
                    <div class="col-md-6">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $product->image) }}" class="rounded shadow-lg img-fluid" alt="{{ $product['name'] ?? 'Menu Item' }}" style="max-height: 400px; object-fit: cover;">
                            {{-- <div class="top-0 p-2 text-white shadow-sm position-absolute start-0 bg-primary rounded-bottom-right">Featured</div> --}}
                        </div>
                    </div>
                    <!-- Nutritional Information -->
                    <div class="col-md-6">
                        <h3 class="mb-3 text-dark fw-semibold">Nutritional Information</h3>
                        <ul class="list-unstyled text-dark fs-5">
                            @php
                                $nutrition = $product['nutrition'] ?? 'Calories: 150, Caffeine: 75mg, Sugar: 10g, Fat: 5g';
                                $nutritionItems = explode(', ', $nutrition);
                            @endphp
                            @foreach ($nutritionItems as $item)
                                <li class="py-2">{{ $item }}</li>
                            @endforeach
                            <p class="lead text-dark animate__animated animate__fadeInUp">{{ Str::words($product['description'] ?? 'A delightful menu item to enjoy at our café.', 20, '...') }}</p>
                        </ul>
                    </div>
                </div>

                <!-- Introduction with Subtle Animation -->

                <!-- Sections with Elegant Styling -->
                <div class="mt-5">
                    <!-- Full Description -->
                    <h2 class="mb-3 fw-semibold" >About This Item</h2>
                    <p class="text-muted fs-5">{{ $product['full_description'] ?? 'Indulge in the rich flavors and craftsmanship of this menu item, meticulously prepared to bring you the ultimate café experience. Perfect for any time of day, it’s a favorite among our customers.' }}</p>

                    <!-- Ingredients -->
                    <h3 class="mt-4 text-dark fw-semibold">Ingredients</h3>
                    <ul class="py-3 list-group list-group-flush border-top border-bottom">
                        <li class="bg-transparent list-group-item text-dark fs-6">{{ $product['ingredient'] ?? 'Freshly roasted coffee beans, steamed milk, and a touch of love.' }}</li>
                        <!-- Add more ingredients as needed -->
                    </ul>

                    <!-- Preparation -->
                    <h3 class="mt-4 text-dark fw-semibold">How It’s Made</h3>
                    <p class="text-dark fs-5">{{ $product['preparation'] ?? 'Our expert baristas hand-pull the espresso shot, steam the milk to a creamy perfection, and artfully combine them for a smooth, balanced flavor. Served in a classic ceramic cup for the best experience.' }}</p>
                </div>
{{--  @dd($product)  --}}
                <!-- Call to Action with Hover Effects -->
                <div class="mt-5 text-center">
                    <a href="{{ route('user.blogs') }}" class="btn btn-outline-primary me-3 animate__animated animate__pulse animate__infinite">Back to Menu Blog</a>
                    <a href="{{ route('user.pizza.detail', $product['product_id'] )}}" class="btn btn-success animate__animated animate__pulse animate__infinite me-3">Order Now</a>
                    <a href="{{ route('user.orderMenu') }}" class="btn btn-outline-warning me-3 animate__animated animate__pulse animate__infinite">Back to Order</a>

                    {{--  {{ route('user.pizza.detail', $pizza['product_id']) }}  --}}
                </div>

                <!-- Share Buttons with Modern Styling -->
                <div class="mt-5 text-center">
                    <p class="mb-3 text-muted">Share this item:</p>
                    <div class="gap-2 d-flex justify-content-center">
                        <a href="#" class="p-2 shadow-sm btn btn-sm btn-outline-dark rounded-circle hover-scale"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#" class="p-2 shadow-sm btn btn-sm btn-outline-dark rounded-circle hover-scale"><i class="bi bi-twitter fs-5"></i></a>
                        <a href="#" class="p-2 shadow-sm btn btn-sm btn-outline-dark rounded-circle hover-scale"><i class="bi bi-instagram fs-5"></i></a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>

    <!-- Bootstrap CSS (ensure this is in your master layout) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (for social media icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-cz7Ds868L/Agu10+dFFM2nnpzBtQobgYs+boCASI0QhJWAOVD7BeranVHnWt/fzCk+DsLQ5cIWpT8tGPwOYDBog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (optional, if you want icons later) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS for elegance -->
    <style>
        .blog-post {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid #e9ecef;
        }

        .shadow-lg {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .shadow-lg:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.1);
        }

        .rounded-bottom-right {
            border-bottom-right-radius: 0.375rem;
            border-top-left-radius: 0;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }
    </style>
@endsection
