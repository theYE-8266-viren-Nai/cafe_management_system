@extends('admin.layouts.master')
@section('title', 'Product List')
@section('content')
<div class="section__content section__content--p10">
    <div class="container">
        <div class="col-md-12">
            <!-- Header and Actions -->
            <div class="table-data__tool">
                <form action="{{ route('admin.product.list') }}" method="GET" class="p-6" style="max-width: 500px; margin: 0 auto;">
                    @csrf
                    <div class="mb-3 md-form input-group">
                        <input type="text" name="key" id="searchInput" class="form-control" placeholder="Search products..." required>
                        <div class="input-group-append">
                            <button type="submit" class="px-3 m-0 btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List</h2>
                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{ route('admin.product.createPizza') }}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i> Add Product
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV Download
                    </button>
                </div>
            </div>

            <!-- Flash Messages -->
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

            <!-- Product Table -->
            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pizzaData->count())
                            @foreach($pizzaData as $pizza)
                            {{--  @dd($pizza);  --}}
                            <tr class="tr-shadow">
                                <td>{{ $pizza->product_id }}</td>
                                <td>{{ $pizza['category_name'] ?? 'No Category' }}</td>
                                <td>{{ $pizza->name }}</td>
                                <td>{{ Str::limit($pizza->description, 50) }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" alt="Pizza Image" class="img-thumbnail" style="width: 80px; height: auto;">
                                </td>
                                <td>{{ $pizza->stock }}</td>
                                <td>${{ number_format($pizza->price, 2) }}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin.product.view', $pizza->product_id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="zmdi zmdi-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin.product.editPizza', $pizza->product_id) }}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.product.delete', $pizza->product_id) }}" method="GET" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    <h5>No products available.</h5>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $pizzaData->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
