@extends('admin.layouts.master')
@section('title','orderList')
@section('content')
<div class="section__content">
    <div class="container-fluid">
        <!-- Page Header with custom styling -->
        <div class="mb-4 shadow-sm card">
            <div class="p-3 card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="mb-0 h3 font-weight-bold" style="color: #6c5ce7">Admin Dashboard Panel</h1>
                    <div class="d-flex align-items-center">
                        <!-- Notifications -->

                        <!-- User Profile -->
                        <div class="dropdown">
                            <button class="btn btn-link" type="button" id="userDropdown" data-toggle="dropdown">
                                <span class="mr-2 text-dark">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                         class="rounded-circle"
                                         width="32"
                                         height="32">
                                @else
                                    <i class="fas fa-user-circle" style="font-size: 1.5rem; color: #6c5ce7;"></i>
                                @endif
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.account_view') }}">
                                    <i class="mr-2 fas fa-user"></i>Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="mr-2 fas fa-sign-out-alt"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include alerts -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('update_password'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('update_password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session('delSuccess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('delSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

<!-- Navigation Cards -->
<div class="mb-4 row">
            <div class="col-md-3">
                <div class="shadow-sm card nav-card">
                    <div class="text-center card-body">
                        <a href="{{ route('category#list') }}" class="text-decoration-none">
                            <i class="mb-3 fas fa-list nav-icon" style="font-size: 2rem; color: #6c5ce7;"></i>
                            <h5 class="mb-0 nav-title" style="color: #2d3436;">Categories</h5>
                            <p class="text-muted">Manage product categories</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="shadow-sm card nav-card">
                    <div class="text-center card-body">
                        <a href="{{ route('admin.product.list') }}" class="text-decoration-none">
                        <i class="mb-3 fas fa-mug-hot nav-icon" style="font-size: 2rem; color: #6c5ce7;"></i>

                            <h5 class="mb-0 nav-title" style="color: #2d3436;">Products</h5>
                            <p class="text-muted">Manage products</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="shadow-sm card nav-card active">
                    <div class="text-center card-body">
                        <a href="{{ url('/admin/orderList/orderList') }}" class="text-decoration-none">
                            <i class="mb-3 fas fa-shopping-cart nav-icon" style="font-size: 2rem; color: #6c5ce7;"></i>
                            <h5 class="mb-0 nav-title" style="color: #2d3436;">Orders</h5>
                            <p class="text-muted">View and manage orders</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="shadow-sm card nav-card">
                    <div class="text-center card-body">
                        <a href="{{ route('admin.blogs.viewBlogs') }}" class="text-decoration-none">
                            <i class="mb-3 fas fa-blog nav-icon" style="font-size: 2rem; color: #6c5ce7;"></i>
                            <h5 class="mb-0 nav-title" style="color: #2d3436;">Blogs</h5>
                            <p class="text-muted">Manage blog posts</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .nav-card {
                transition: all 0.3s ease;
                border: none;
                background: white;
            }

            .nav-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 10px 20px rgba(108, 92, 231, 0.2) !important;
                background: linear-gradient(145deg, #ffffff, #f5f5f5);
            }

            .nav-card:hover .nav-icon {
                color: #a55eea !important;
                transform: scale(1.1);
            }

            .nav-card:hover .nav-title {
                color: #6c5ce7 !important;
            }

            .nav-card.active {
                background: linear-gradient(145deg, #6c5ce7, #a55eea);
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(108, 92, 231, 0.3) !important;
            }

            .nav-card.active .nav-icon,
            .nav-card.active .nav-title {
                color: white !important;
            }

            .nav-card.active p {
                color: rgba(255, 255, 255, 0.8) !important;
            }

            .nav-icon {
                transition: all 0.3s ease;
            }

            .nav-title {
                transition: color 0.3s ease;
            }

            .nav-card .card-body {
                padding: 2rem 1.5rem;
            }
        </style>

        <div class="table-responsive table-responsive-data2">
            <table class="table table-bordered">
                <thead>
                    <tr style="background: linear-gradient(45deg, #dff9fb, #c7ecee)">
                        <th style="color: #6c5ce7">Order Code</th>
                        <th style="color: #6c5ce7">User Name</th>
                        <th style="color: #6c5ce7">Item</th>
                        <th style="color: #6c5ce7">Qty</th>
                        <th style="color: #6c5ce7">Total</th>
                        <th style="color: #6c5ce7">Order Status</th>
                        <th style="color: #6c5ce7">Stock</th>
                        <th style="color: #6c5ce7">Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($orderList) != 0)
                        @php
                            $lastOrderCode = null;
                        @endphp
                        @foreach($orderList as $order)
                            @if ($order->order_code !== $lastOrderCode)
                                <tr>
                                    <td colspan="8" class="bg-light">
                                        <form action="{{ route('admin.order.updateStatus') }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <strong>Order Code: {{ $order->order_code }}</strong>
                                            <select name="status" class="w-auto ml-3 form-select d-inline">
                                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Confirm</option>
                                                <option value="-1" {{ $order->status == -1 ? 'selected' : '' }}>Reject</option>
                                            </select>
                                            <input type="hidden" name="order_code" value="{{ $order->order_code }}">
                                            <button type="submit" class="ml-2 btn btn-sm btn-primary" style="background-color: #6c5ce7; border-color: #6c5ce7;">Update</button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $lastOrderCode = $order->order_code;
                                @endphp
                            @endif

                            <tr class="tr-shadow">
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order->status == 0 ? 'Pending' : 'Confirmed' }}</td>
                                <td>{{ $order->stock }}</td>
                                <td>{{ $order->payment_method }}</td>
                            </tr>
                            @if ($order->stock < $order->qty)
                                <tr>
                                    <td colspan="8" class="text-center text-danger">
                                        <strong>⚠ Warning: Stock is not enough for {{ $order->product_name }}!</strong>
                                    </td>
                                </tr>
                            @endif
                            <tr class="spacer"></tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">
                                <h5>There is no order list here</h5>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
