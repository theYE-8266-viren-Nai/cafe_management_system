@extends('admin.layouts.master')
@section('title','Category list')
@section('content')
<div class="section__content">
    <div class="container-fluid">
        <!-- Page Header with custom styling -->
        <div class="mb-4 shadow-sm card">
            <div class="p-3 card-body">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="mb-0 h3 font-weight-bold" style="color: #6c5ce7">Admin Dashboard Panel</h1>
                    <div class="d-flex align-items-center">
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

        <!-- Navigation Cards -->
        <div class="mb-4 row">
            <div class="col-md-3">
                <div class="shadow-sm card nav-card active">
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
                <div class="shadow-sm card nav-card">
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

        <!-- Search Box with Enhanced Design -->
        <div class="mb-4 row">
            <div class="col-lg-6">
                <form action="{{ route('category#list') }}" method="GET">
                    @csrf
                    <div class="shadow-sm input-group">
                        <input type="text" name="key" class="border-0 form-control" placeholder="Search categories..." value="{{ request('key') }}">
                        <div class="input-group-append">
                            <button class="btn" style="background-color: #a8e6cf;" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="text-right col-lg-6">
                <a href="{{ route('category#createPage') }}" class="btn me-2" style="background-color: #a8e6cf; color: #2d3436;">
                    <i class="fas fa-plus me-2"></i>Add Category
                </a>

            </div>
        </div>

        <!-- After the navigation cards and search box -->
        <div class="row">
            <!-- Main Content Area (now full width) -->
            <div class="col-12">
                <div class="shadow-sm card">
                    <div class="py-3 bg-white card-header">
                        <h4 class="m-0 font-weight-bold" style="color: #6c5ce7">Category List</h6>
                    </div>

                    <div class="card-body">
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
                        @if(session('delSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('delSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="background: linear-gradient(45deg, #dff9fb, #c7ecee)">
                                        <th style="color: #6c5ce7">Category ID</th>
                                        <th style="color: #6c5ce7">Name</th>
                                        <th style="color: #6c5ce7">Date</th>
                                        <th style="color: #e056fd">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories) != 0)
                                        @foreach($categories as $category)
                                            <tr>
                                                <td class="font-weight-medium">{{ $category->category_id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                       <a href="{{ route('category#view', $category->category_id) }}">
                                                        <button class="btn btn-sm"
                                                        style="background-color: #a8e6cf; color: #2d3436"
                                                        title="View">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                       </a>
                                                        <a href="{{ route('category#viewUpdate', $category->category_id) }}"
                                                           class="btn btn-sm"
                                                           style="background-color: #ffd3b6; color: #2d3436"
                                                           title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('category#delete', $category->category_id) }}"
                                                           class="btn btn-sm"
                                                           style="background-color: #ffaaa5; color: #2d3436"
                                                           title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="py-4 text-center">
                                                <h6 class="text-muted">No categories found</h6>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3" >
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
