@extends('user.layouts.master')
@section('container')
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">

            <div class="p-4 bg-light mb-30">
                <h5 class="mb-3 section-title position-relative text-uppercase">
                    <span class="pr-3 bg-secondary">Filter by Category</span>
                </h5>
                <form>
                    <!-- Display Pizza Categories -->
                    <div class="mb-3 custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        {{--  <input type="checkbox" class="custom-control-input" checked id="category-all">  --}}
                        <a  class="text-yellow-400 " href="{{ route('user.home') }}"><label class="text-yellow-100 " for="category-all">All Categories</label></a>
                        <span class="border badge font-weight-normal">{{ count($pizzaData) }}</span>
                    </div>

                    <!-- Loop through pizza categories -->
                    @foreach ($categories as $category)
                    {{--  @dd($pizza);  --}}
                    <div class="mb-3 custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        {{--  <input type="checkbox" class="custom-control-input" id="pizza-{{ $pizza->id }}" value="{{ $pizza->id }}">  --}}
                        <a  href="{{ route('user.viewViaCategory', $category['category_id']) }}" class="btn btn-warning artwork-button">
                            <label class="artwork-label" for="pizza-{{ $category->id }}">
                                {{ $category['name']  }} {{ $category['category_id'] }}
                            </label>
                        </a>

                    </div>
                    @endforeach

                </form>
            </div>

            {{--  <button class="btn btn-warning w-100">Order</button>  --}}
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->

        <div class="col-lg-9 col-md-8">
            <div class="pb-3 row">
                <div class="pb-1 col-12">
                    <!-- Filter and Sort Controls -->
                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div>
                            <!-- Wishlist Icon -->
                            <a href="{{ route('user.history') }}" class="px-2 text-white btn position-relative">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge badge-light position-absolute rounded-circle"
                                      style="top: -8px; right: -8px; padding-bottom: 2px;">History</span>
                            </a>

                            <!-- User Name Display -->

                            <!-- Cart Icon -->
                            <a href="{{ route('user.cartList') }}" class="px-2 ml-3 text-white btn position-relative">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge badge-light position-absolute rounded-circle"
                                      style="top: -8px; right: -8px; padding-bottom: 2px;">@if($cart)
                                      {{ count($cart->toArray()) }}
                                      @endif</span>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Choose Option</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            <div class="ml-2 btn-group">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Show</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Display -->
                    <div class="row" id="product-list">
                      @if(count($pizzaData) != 0)
                      @foreach ($pizzaData as $pizza)
                      {{--  @dd($pizza);  --}}
                      <div class="mb-4 col-lg-4 col-md-6 col-sm-12 product-item" >
                          <div class="border-0 shadow-sm card bg-light">
                              <div class="overflow-hidden product-img position-relative">
                                  <img class="card-img-top img-fluid" src="{{ asset('storage/' . $pizza['image']) }}" alt="{{ $pizza['name'] }}" style="height: 200px; object-fit: cover;">
                                  <div class="product-action position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                                       style="top: 0; left: 0; background: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease;">
                                      <a class="m-1 btn btn-outline-light btn-square" href="{{ route('user.cartList') }}"><i class="fa fa-shopping-cart"></i></a>
                                      <a class="m-1 btn btn-outline-light btn-square" href="{{ route('user.pizza.detail' ,  $pizza['product_id'] ) }}"><i class="fa fa-info"></i></a>
                                  </div>
                              </div>
                              <div class="text-center card-body">
                                  <h5 class="card-title text-truncate">{{ $pizza['name'] }}</h5>
                                  <p class="card-text text-muted" style="height: 50px; overflow: hidden;">{{ Str::limit($pizza['description'], 50) }}</p>
                                  <h5 class="text-danger">{{ number_format($pizza['price'], 0) }} Kyats</h5>
                                  <div class="mt-2 d-flex align-items-center justify-content-center">
                                      <small class="mr-1 fa fa-star text-primary"></small>
                                      <small class="mr-1 fa fa-star text-primary"></small>
                                      <small class="mr-1 fa fa-star text-primary"></small>
                                      <small class="mr-1 fa fa-star text-primary"></small>
                                      <small class="mr-1 fa fa-star text-primary"></small>
                                  </div>
                              </div>
                          </div>
                      </div>
                      @endforeach
                      @else
                        There is no pizza Data
                      @endif
                    </div>
                </div>
            </div>
        </div>
       @if(count($pizzaData) != 0)
       <div class="mt-4 d-flex justify-content-center">
        {{ $pizzaData->links() }}
    </div>
       @endif

        <!-- Shop Product End -->
    </div>
</div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function() {
        $('#sortingOption').change(function() {
            const eventOption = $('#sortingOption').val();
            const url = 'http://127.0.0.1:8000/ajax/pizzaList';
            console.log(eventOption);
            $(document).ready(function() {
                const storageUrl = '{{ asset('storage') }}'; // Define the base URL

                if (eventOption) {
                    $.ajax({
                        type: 'get',
                        url: url,
                        dataType: 'json',
                        data: { status: eventOption },
                        success: function(response) {
                            let list = '';
                            response.forEach((pizza) => {
                                list += `<div class="mb-4 col-lg-4 col-md-6 col-sm-12 product-item">
                                    <div class="border-0 shadow-sm card bg-light">
                                        <div class="overflow-hidden product-img position-relative">
                                            <img class="card-img-top img-fluid" src="${storageUrl}/${pizza.image}" alt="${pizza.name}" style="height: 200px; object-fit: cover;">
                                            <div class="product-action position-absolute w-100 h-100 d-flex align-items-center justify-content-center"
                                                 style="top: 0; left: 0; background: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease;">
                                                <a class="m-1 btn btn-outline-light btn-square" href="#"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="m-1 btn btn-outline-light btn-square" href="#"><i class="fa fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center card-body">
                                            <h5 class="card-title text-truncate">${pizza.name}</h5>
                                            <p class="card-text text-muted" style="height: 50px; overflow: hidden;">${pizza.description.substring(0, 50)}</p>
                                            <h5 class="text-danger">${Number(pizza.price).toLocaleString()} Kyats</h5>
                                            <div class="mt-2 d-flex align-items-center justify-content-center">
                                                <small class="mr-1 fa fa-star text-primary"></small>
                                                <small class="mr-1 fa fa-star text-primary"></small>
                                                <small class="mr-1 fa fa-star text-primary"></small>
                                                <small class="mr-1 fa fa-star text-primary"></small>
                                                <small class="mr-1 fa fa-star text-primary"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                            $('#product-list').html(list);
                        }
                    });
                }
            });

        });
    });
</script>
@endsection

<style>
    /* Hover effect for product action buttons */
    .product-item:hover .product-action {
        opacity: 1 !important;
    }
    .artwork-button {
        border-radius: 8px; /* Rounded corners */
        padding: 10px 20px; /* Padding */
        transition: transform 0.2s ease, box-shadow 0.3s ease;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Soft shadow */
    }

    .artwork-button:hover {
        transform: translateY(-2px); /* Lift effect on hover */
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3); /* Stronger shadow */
    }

    .artwork-label {
        font-weight: bold; /* Bold font for label */
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
</style>
