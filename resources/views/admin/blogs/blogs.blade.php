@extends('admin.layouts.master')

@section('title', 'Blog List')

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

<!-- Also add the styles -->
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
<style>
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.3s;
    }

    .table th {
        font-size: 0.95rem;
    }

    .table td {
        vertical-align: middle;
    }

    /* Pagination Styling */
    .pagination .page-item.active .page-link {
        background-color: #ffaaa5 !important;
        border-color: #ffaaa5 !important;
        color: #2d3436 !important;
    }

    .pagination .page-link {
        color: #ffaaa5 !important;
    }

    .pagination .page-link:hover {
        background-color: #ffe3e0 !important;
    }
</style>

        <!-- Search and Actions -->
        <div class="mb-4 row">
            <div class="col-lg-6">

            </div>
            <div class="text-right col-lg-6">
                <a href="{{ route('admin.blogs.create') }}" class="btn me-2" style="background-color: #a8e6cf; color: #2d3436;">
                    <i class="fas fa-plus me-2"></i>Add Blog
                </a>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('delSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('delSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Blog Table -->
        <div class="shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr style="background: linear-gradient(45deg, #dff9fb, #c7ecee);">
                                <th style="color: #6c5ce7; font-weight: bold;">Blog ID</th>
                                <th style="color: #6c5ce7; font-weight: bold;">Title</th>
                                <th style="color: #6c5ce7; font-weight: bold;">Description</th>
                                <th style="color: #6c5ce7; font-weight: bold;">Author</th>
                                <th style="color: #6c5ce7; font-weight: bold;">Image</th>
                                <th style="color: #6c5ce7; font-weight: bold;">Created At</th>
                                <th style="color: #6c5ce7; font-weight: bold;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($blogs->count())
                                @foreach($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->id }}</td>
                                    <td>{{ $blog->description }}</td>
                                    <td>{{ Str::limit($blog->full_description, 50) }}</td>
                                    <td>{{ $blog->author }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $blog->image) }}"
                                             alt="Blog Image"
                                             class="img-thumbnail"
                                             style="width: 80px; height: auto;">
                                    </td>
                                    <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <div class="gap-2 d-flex">
                                            <a href="{{ route('admin.blog.view',$blog->id) }}"
                                               class="btn btn-sm"
                                               style="background-color: #a8e6cf;"
                                               title="View">
                                                <i class="fas fa-eye" style="color: #2d3436;"></i>
                                            </a>
                                            <a href="{{ route('admin.blogs.edit',$blog->id)  }}"
                                               class="btn btn-sm"
                                               style="background-color: #ffd3b6;"
                                               title="Edit">
                                                <i class="fas fa-edit" style="color: #2d3436;"></i>
                                            </a>
                                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this blog?');"
                                                  style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm"
                                                        style="background-color: #ffaaa5;"
                                                        title="Delete">
                                                    <i class="fas fa-trash" style="color: #2d3436;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <h5 class="text-muted">No blogs available.</h5>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
