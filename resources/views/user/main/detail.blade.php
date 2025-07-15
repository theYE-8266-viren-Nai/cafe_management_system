@extends('user.layouts.master')

@section('container')
<!-- Breadcrumb Section -->
<div class="py-4 container-fluid" style="background-color: #f5e8d8;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <a href="javascript:history.back()" class="mb-3 shadow-sm btn btn-outline-dark rounded-pill mb-md-0" style="border-color: #8B4513; color: #8B4513;">← Go Back</a>
            </div>
            <div class="col-12 col-md-6">
                <nav class="p-0 bg-transparent breadcrumb justify-content-md-end">
                    <a class="breadcrumb-item text-dark" href="/" style="color: #8B4513;">Home</a>
                    <a class="breadcrumb-item text-dark" href="/shop" style="color: #8B4513;">Shop</a>
                    <span class="breadcrumb-item active text-muted">Menu Detail</span>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Product Detail Section -->
<div class="container py-5">
    <div class="row g-5">
        <!-- Product Image -->
        <div class="col-lg-6">
            <div class="overflow-hidden rounded shadow-lg image-container">
                <img src="{{ asset('storage/' . $pizza[0]['image']) }}" class="img-fluid w-100" alt="{{ $pizza[0]['name'] }}" style="object-fit: cover; max-height: 450px;">
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="p-4 rounded shadow-sm cafe-card" style="background-color: #fff;">
                <h1 class="mb-3 fw-bold cafe-title" style="color: #8B4513;">{{ $pizza[0]['name'] }}</h1>
                <div class="mb-3 d-flex align-items-center">
                    <div class="text-warning me-2">
                        {{--  @for ($i = 0; $i < 5; $i++) <i class="bi bi-star-fill"></i> @endfor  --}}
                    </div>
                    <small class="text-muted">({{ $reviewCount }} reviews)</small>
                </div>
                <h3 class="mb-4 fw-semibold" style="color: #D2B48C;">{{ number_format($pizza[0]['price'], 0) }} Kyats</h3>
                <p class="mb-4 text-dark fs-5">{{ $pizza[0]['description'] }}</p>

                <!-- Quantity and Buttons -->
                <div class="flex-wrap gap-3 mb-4 d-flex align-items-center">
                    <div class="input-group quantity" style="width: 130px;">
                        <input type="text" class="text-center border-0 form-control bg-light" value="1" id="orderCount" readonly>
                    </div>
                    <button type="button" class="px-4 shadow-sm btn rounded-pill" id="addCart" style="background-color: #8B4513; color: #fff; border: none;">
                        <i class="bi bi-cart me-2"></i>Add to Cart
                    </button>
                    <button type="button" class="px-4 shadow-sm btn rounded-pill" id="review" style="background-color: #D2B48C; color: #fff; border: none;">
                        <i class="bi bi-chat-dots me-2"></i>Review
                    </button>
                    <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" value="{{ $pizza[0]['product_id'] }}" id="pizzaId">
                </div>

                <!-- Share Section -->
                {{--  <div class="d-flex align-items-center">
                    <strong class="text-dark me-3" style="color: #8B4513;">Share:</strong>
                    <a href="#" class="text-dark me-2" style="color: #8B4513;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-dark me-2" style="color: #8B4513;"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-dark me-2" style="color: #8B4513;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-dark" style="color: #8B4513;"><i class="bi bi-linkedin"></i></a>
                </div>  --}}
            </div>
        </div>
    </div>
</div>

<!-- Reviews Section -->
<div class="container pb-5">
    <div class="row">
        <div class="mx-auto col-lg-8">
            <h2 class="mb-4 fw-bold cafe-title" style="color: #8B4513;">Customer Reviews</h2>

            <!-- Display Reviews -->
            <div id="reviewSection" class="mb-5">
                @foreach ($reviews as $review)
                <div class="mb-3 shadow-sm card cafe-card" style="background-color: #fff;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-semibold" style="color: #8B4513;">{{ $review->user->name }}</h5>
                            <span class="text-muted fst-italic">{{ $review->job_title ?? 'Customer' }}</span>
                        </div>
                        <p class="mt-2 text-muted">{{ $review->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Review Form -->
            <div class="shadow-sm card cafe-card" style="background-color: #fff;" id="reviewForm">
                <div class="card-body">
                    <h5 class="mb-4 fw-semibold" style="color: #8B4513;">Leave a Review</h5>
                    <form action="{{ route('user.review') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="product_id" value="{{ $pizza[0]['product_id'] }}">
                        <div class="mb-3">
                            <label for="job_title" class="form-label fw-semibold" style="color: #8B4513;">Your Job Title</label>
                            <input type="text" class="rounded shadow-sm form-control" id="job_title" name="job_title" placeholder="e.g., Barista" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label fw-semibold" style="color: #8B4513;">Your Review</label>
                            <textarea class="rounded shadow-sm form-control" id="content" name="content" rows="3" placeholder="Share your thoughts..." required></textarea>
                        </div>
                        <button type="submit" class="shadow-sm btn rounded-pill" style="background-color: #8B4513; color: #fff; border: none;">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Carousel -->
<div class="py-5 container-fluid" style="background-color: #D2B48C;">
    <h2 class="mb-4 text-center fw-bold cafe-title" style="color: #8B4513;">You May Also Like</h2>
    <div class="container">
        <div class="owl-carousel related-carousel">
            @foreach ($relatedProducts as $relatedProduct)
            <div class="text-center rounded shadow-sm product-item bg-light">
                <div class="overflow-hidden image-container">
                    <img src="{{ asset('storage/' . $relatedProduct['image']) }}" class="img-fluid w-100" alt="{{ $relatedProduct['name'] }}" style="object-fit: cover; height: 200px;">
                    <div class="px-2 product-action">
                        <a class="shadow-sm btn btn-outline-dark btn-square" href="{{ route('user.pizza.detail', $relatedProduct['product_id']) }}" style="border-color: #8B4513; color: #8B4513;"><i class="bi bi-cart"></i></a>
                        <a class="shadow-sm btn btn-outline-dark btn-square" href="{{ route('user.blogs.seeMore', $relatedProduct['product_id']) }}" style="border-color: #8B4513; color: #8B4513;"><i class="bi bi-info-circle"></i></a>
                    </div>
                </div>
                <div class="py-3">
                    <a class="h6 text-dark text-decoration-none" href="#" style="color: #8B4513;">{{ $relatedProduct['name'] }}</a>
                    <div class="mt-2 d-flex justify-content-center align-items-center">
                        <h5 style="color: #8B4513;">{{ number_format($relatedProduct['price'], 0) }} Kyats</h5>
                        {{--  <h6 class="text-muted ms-2"><del>{{ number_format($relatedProduct['original_price'], 0) }} Kyats</del></h6>  --}}
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scriptSource')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Add to Cart
        $('#addCart').click(function() {
            const url = 'http://127.0.0.1:8000/ajax/cart';
            const homeUrl = 'http://127.0.0.1:8000/user/orderMenu';
            const source = {
                'userId': $('#userId').val(),
                'pizzaId': $('#pizzaId').val(),
                'count': $('#orderCount').val()
            };
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
                data: source,
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = homeUrl;
                    }
                },
                error: function(xhr) {
                    alert('Error adding to cart: ' + xhr.responseText);
                }
            });
        });

        // Review Button Scrolls to Review Form
        $('#review').click(function() {
            $('html, body').animate({
                scrollTop: $('#reviewForm').offset().top - 100
            }, 800);
            $('#content').focus();
        });

        // Fixed Quantity Controls
        $('.btn-plus').off('click').on('click', function(e) {
            e.preventDefault();
            let count = parseInt($('#orderCount').val()) || 1; // Default to 1 if NaN
            count += 1; // Properly increment
            $('#orderCount').val(count);
        });

        $('.btn-minus').off('click').on('click', function(e) {
            e.preventDefault();
            let count = parseInt($('#orderCount').val()) || 1; // Default to 1 if NaN
            if (count > 1) {
                count -= 1; // Properly decrement
                $('#orderCount').val(count);
            }
        });

        // Button Hover Effects
        $('#addCart, #review').hover(
            function() { $(this).css('background-color', '#A0522D'); },
            function() { $(this).css('background-color', $(this).attr('id') === 'addCart' ? '#8B4513' : '#D2B48C'); }
        );
    });
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

<style>
    .cafe-card {
        background-color: #fff !important;
        border: none !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
    }
    .cafe-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    .cafe-title {
        font-family: 'Playfair Display', serif !important;
        letter-spacing: 1px !important;
    }
    .image-container {
        position: relative !important;
    }
    .image-container img {
        transition: transform 0.3s ease !important;
    }
    .image-container:hover img {
        transform: scale(1.05) !important;
    }
    .btn:hover { opacity: 0.9; }
    .product-action {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        opacity: 0 !important;
        transition: opacity 0.3s ease !important;
    }
    .product-item:hover .product-action {
        opacity: 1 !important;
    }
</style>
