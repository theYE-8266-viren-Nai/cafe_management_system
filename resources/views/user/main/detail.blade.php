@extends('user.layouts.master')

@section('container')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <a href="javascript:history.back()" class="my-3 btn btn-secondary ms-3">Go Back</a>
        <div class="col-12">
            <nav class="p-3 rounded breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="/">Home</a>
                <a class="breadcrumb-item text-dark" href="/shop">Shop</a>
                <span class="breadcrumb-item active">Shop Detail</span>
            </nav>
        </div>
    </div>

    <!-- Review Section -->
    <div class="row px-xl-5">
        <div class="mx-auto col-md-8">
            <h4 class="mb-4">Customer Reviews</h4>

            <!-- Display Reviews -->

            <!-- Review Form -->
            <div class="mt-4 card">
                <div class="card-body">
                    <h5 class="card-title">Leave a Review</h5>
                    <form action="{{ route('user.review') }}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="product_id" value="{{$pizza[0]['product_id'] }}">
                        {{--  $pizza[0]['name']  --}}
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select" name="rating" required>
                                <option value="5">★★★★★ (5)</option>
                                <option value="4">★★★★☆ (4)</option>
                                <option value="3">★★★☆☆ (3)</option>
                                <option value="2">★★☆☆☆ (2)</option>
                                <option value="1">★☆☆☆☆ (1)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Review</label>
                            <textarea class="form-control" name="content" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Breadcrumb End -->

<!-- Shop Detail Start -->
<div class="pb-5 container-fluid">
    <div class="row px-xl-5">
        <!-- Product Image Section -->
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('storage/' . $pizza[0]['image']) }}"
                            alt="{{ $pizza[0]['name'] }}">
                    </div>
                    <!-- Add more carousel items if there are multiple images -->
                </div>
            </div>
        </div>

        <!-- Product Info Section -->
        <div class="col-lg-7 mb-30">
            <div class="p-4 rounded bg-light">
                <h3 class="mb-3">{{ $pizza[0]['name'] }}</h3>
                <div class="mb-3 d-flex">
                    <div class="text-primary">
                        {{--  <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>  --}}
                    </div>
                    <small class="ms-2">{{ $reviewCount }} reviews</small>
                </div>
                <h3 class="mb-4 font-weight-semi-bold">{{ $pizza[0]['price'] }}</h3>
                <p class="mb-4">{{ $pizza[0]['description'] }}</p>
                <div class="pt-2 mb-4 d-flex align-items-center">
                    <div class="mr-3 input-group quantity" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="text-center border-0 form-control bg-secondary" value="1"
                            id="orderCount">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <button type="button" class="px-3 btn btn-primary" id="addCart"><i
                            class="mr-1 fa fa-shopping-cart"></i> Add To
                        Cart</button> ||
                    <button type="button" class="px-3 btn btn-primary" id="review"><i
                            class="mr-1 fa fa-shopping-cart"></i> Review
                    </button>
                    <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" value="{{ $pizza[0]['product_id']  }}" id="pizzaId">
                </div>
                <!-- Product Share Section -->
                <div class="d-flex align-items-center">

                    <div class="d-flex">
                        <strong class="text-dark me-2">Share on:</strong>
                        <a class="px-2 text-dark" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="px-2 text-dark" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="px-2 text-dark" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="px-2 text-dark" href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="reviewSection">
    @foreach ($reviews as $review)
        <div class="mb-3 card">
            <div class="card-body">
                <h5>{{ $review->user->name }}</h5><p class="mb-1">Rating:
                    <strong>
                        @for ($i = 0; $i < $review->rating; $i++)
                            ★
                        @endfor
                    </strong>

                <p>{{ $review->content }}</p>
            </div>
        </div>
    @endforeach
</div>
<!-- "You May Also Like" Section -->
<div class="py-5 container-fluid">
    <h2 class="mb-4 section-title position-relative text-uppercase"><span class="px-3 bg-secondary">You May Also
            Like</span></h2>
    <div class="row px-xl-5">
        <div class="owl-carousel related-carousel">
            @foreach ($relatedProducts as $relatedProduct)
            <div class="rounded product-item bg-light">
                <div class="overflow-hidden position-relative">
                    <img class="img-fluid w-100" src="{{ asset('storage/' . $relatedProduct['image']) }}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href="{{ route('user.cartList') }}"><i
                                class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square"
                            href="{{ route('user.pizza.detail',$relatedProduct['product_id']) }}"><i
                                class="fa fa-info"></i></a>

                    </div>
                </div>
                <div class="py-3 text-center">
                    <a class="h6 text-decoration-none" href="#">{{ $relatedProduct['name'] }}</a>
                    <div class="mt-2 d-flex justify-content-center align-items-center">
                        <h5 class="text-primary">${{ $relatedProduct['price'] }}</h5>
                        <h6 class="text-muted ms-2"><del>${{ $relatedProduct['original_price'] }}</del></h6>
                    </div>
                    <div class="mt-1 text-primary">
                        <small class="fa fa-star"></small>
                        <small class="fa fa-star"></small>
                        <small class="fa fa-star"></small>
                        <small class="fa fa-star"></small>
                        <small class="fa fa-star"></small>
                        <small>(99)</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
<script>
    $(document).ready(function() {
        $('#addCart').click(function(){
            const url = 'http://127.0.0.1:8000/ajax/cart';
            const homeUrl = 'http://127.0.0.1:8000/user/home';
            $source = {
                'userId' : $('#userId').val(),
                'pizzaId' : $('#pizzaId').val(),
                'count' : $('#orderCount').val()
            };
            console.log('hello ');
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json' ,
                data: $source ,
                success: function(response) {
                    if (response.status == 'success'){
                        window.location.href = homeUrl;
                    }
                }
            });
        })
        $('#review').click(function(){
            console.log('HELLO WORLD');
         })
    });
</script>
@endsection
