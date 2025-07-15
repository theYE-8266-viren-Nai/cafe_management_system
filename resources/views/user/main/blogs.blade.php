@extends('user.layouts.master')

@section('container')
<div class="container ">
    <h1 class="text-center mb-4 pt-3">Café Menu</h1>

    <!-- Search Result Message (if applicable) -->
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @elseif (!empty($query))
        <div class="alert alert-info" role="alert">
            Search results for "{{ $query }}".
        </div>
    @endif

    <!-- Category Filter (Dropdown) -->
    <div class="mb-4">
        <select id="categoryFilter" name="categoryFilter" class="form-select w-25">
            <option value="">All Categories</option>
            @foreach ($categories ?? [] as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Products Container -->
    <div class="row" id="productsContainer">
        @if (!empty($products) && $products->isNotEmpty())
            @foreach ($products as $product)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fluid object-fit-cover" style="height: 400px;" alt="{{ $product->name ?? 'Menu Item' }}">
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->name ?? 'Item Name' }}</h2>
                            <p class="card-text text-muted">Price: {{ $product->price ?? 'N/A' }}</p>
                            <p class="card-text">{{ Str::words($product->description ?? 'A delightful menu item to enjoy at our café.', 21, '...') }}</p>
                            <a href="{{ route('user.blogs.seeMore', ['id' => $product->product_id ?? 1]) }}" class="btn btn-outline-primary">Read More</a>
                            <a href="{{ route('user.pizza.detail', ['id' => $product->product_id ?? 1]) }}" class="btn btn-outline-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @foreach ($products ?? [] as $product)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="ratio ratio-4x3">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fluid object-fit-cover" style="height: 400px;" alt="{{ $product->name ?? 'Menu Item' }}">
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->name ?? 'Item Name' }}</h2>
                            <p class="card-text text-muted">Price: {{ $product->price ?? 'N/A' }}</p>
                            <p class="card-text">{{ Str::words($product->description ?? 'A delightful menu item to enjoy at our café.', 21, '...') }}</p>
                            <a href="{{ route('user.blogs.seeMore', ['id' => $product->product_id ?? 1]) }}" class="btn btn-outline-primary">Read More</a>
                            <a href="{{ route('user.pizza.detail', ['id' => $product->product_id ?? 1]) }}" class="btn btn-outline-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#categoryFilter').on('change', function() {
                const categoryName = $(this).val(); // Get the selected category name
                const url = '{{ url('/ajax/productList') }}'; // Laravel URL helper for the AJAX endpoint
                const storageUrl = '{{ asset('storage') }}'; // Base URL for images

                console.log('Selected category:', categoryName);

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    data: { category_name: categoryName }, // Send category name as a parameter
                    success: function(response) {
                        let productList = '';
                        response.forEach((product) => {
                            productList += `
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <div class="ratio ratio-4x3">
                                            <img src="${storageUrl}/${product.image}" class="card-img-top img-fluid object-fit-cover" style="height: 400px;" alt="${product.name || 'Menu Item'}">
                                        </div>
                                        <div class="card-body">
                                            <h2 class="card-title">${product.name || 'Item Name'}</h2>
                                            <p class="card-text text-muted">Price: ${product.price || 'N/A'}</p>
                                            <p class="card-text">${truncateWords(product.description || 'A delightful menu item to enjoy at our café.', 21)}</p>
                                            <a href="${generateSeeMoreUrl(product.product_id || 1)}" class="btn btn-outline-primary">Read More</a>
                                            <a href="{{ route('user.pizza.detail', ['id' => ':id']) }}".replace(':id', product.product_id || 1)" class="btn btn-outline-primary">Add to Cart</a>
                                        </div>
                                    </div>
                                </div>`;
                        });
                        $('#productsContainer').html(productList); // Update the products container
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            });

            // Helper function to truncate words (similar to Str::words)
            function truncateWords(text, limit) {
                const words = text.split(' ');
                return words.length > limit ? words.slice(0, limit).join(' ') + '...' : text;
            }

            // Helper function to generate the "Read More" URL
            function generateSeeMoreUrl(productId) {
                const baseUrl = '{{ route('user.blogs.seeMore', ['id' => ':id']) }}'; // Use a placeholder
                return baseUrl.replace(':id', productId); // Replace the placeholder with the actual ID
            }
        });
    </script>
@endsection
