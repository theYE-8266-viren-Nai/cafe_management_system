@extends('admin.layouts.master')

@section('title', 'Add Product')

@section('content')
<div class="px-4 cafe-admin-container container-fluid">
    <!-- Back to List Button -->
    <div class="mb-4 row">
        <div class="col-12 text-end">
            <a href="{{ route('admin.product.list') }}" class="text-white cafe-btn-back btn"
               style="background-color: #6c5ce7 !important; border-radius: 10px; transition: background-color 0.3s ease;">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="border-0 card cafe-product-card" style="box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
                <!-- Card Header -->
                <div class="border-0 card-header" style="background-color: #6c5ce7 !important; border-radius: 10px 10px 0 0;">
                    <h3 class="py-3 m-0 text-center text-white cafe-product-title">
                        <i class="fas fa-plus-square me-2"></i>Add New Product
                    </h3>
                </div>

                <div class="p-5 card-body" style="background-color: #f8f9fa !important; border-radius: 0 0 10px 10px;">
                    <form action="{{ route('admin.product.pizzaData') }}" method="post" enctype="multipart/form-data" id="addProductForm" novalidate>
                        @csrf
                        <div class="form-group">
                            <!-- Name Input -->
                            <div class="mb-4">
                                <label for="name" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-tag me-2"></i>Name
                                </label>
                                <input id="name"
                                       name="name"
                                       type="text"
                                       class="form-control form-control-lg cafe-input @error('name') is-invalid @enderror"
                                       placeholder="Product Name"
                                       value="{{ old('name') }}"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;"
                                       autofocus>
                                @error('name')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="name-error"></div>
                            </div>

                            <!-- Category Select Dropdown -->
                            <div class="mb-4">
                                <label for="category_id" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-list-alt me-2"></i>Category
                                </label>
                                <select name="category_id" id="category_id" class="form-control form-control-lg cafe-input @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category['category_id'] }}" {{ old('category_id') == $category['category_id'] ? 'selected' : '' }}>
                                            {{ $category['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="category_id-error"></div>
                            </div>

                            <!-- Description Textarea -->
                            <div class="mb-4">
                                <label for="description" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-align-left me-2"></i>Description
                                </label>
                                <textarea name="description"
                                          class="form-control form-control-lg cafe-input @error('description') is-invalid @enderror"
                                          rows="4"
                                          style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="description-error"></div>
                            </div>

                            <!-- Full Description Textarea -->
                            <div class="mb-4">
                                <label for="full_description" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-align-left me-2"></i>Full Description
                                </label>
                                <textarea name="full_description"
                                          class="form-control form-control-lg cafe-input @error('full_description') is-invalid @enderror"
                                          rows="4"
                                          style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">{{ old('full_description') }}</textarea>
                                @error('full_description')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="full_description-error"></div>
                            </div>

                            <!-- Nutrition Input -->
                            <div class="mb-4">
                                <label for="nutrition" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-leaf me-2"></i>Nutrition
                                </label>
                                <input id="nutrition"
                                       name="nutrition"
                                       type="text"
                                       class="form-control form-control-lg cafe-input @error('nutrition') is-invalid @enderror"
                                       placeholder="Nutrition"
                                       value="{{ old('nutrition') }}"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">
                                @error('nutrition')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="nutrition-error"></div>
                            </div>

                            <!-- Ingredient Input -->
                            <div class="mb-4">
                                <label for="ingredient" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-utensils me-2"></i>Ingredient
                                </label>
                                <input id="ingredient"
                                       name="ingredient"
                                       type="text"
                                       class="form-control form-control-lg cafe-input @error('ingredient') is-invalid @enderror"
                                       placeholder="Ingredient"
                                       value="{{ old('ingredient') }}"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">
                                @error('ingredient')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="ingredient-error"></div>
                            </div>

                            <!-- Preparation Input -->
                            <div class="mb-4">
                                <label for="preparation" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-coffee me-2"></i>Preparation
                                </label>
                                <input id="preparation"
                                       name="preparation"
                                       type="text"
                                       class="form-control form-control-lg cafe-input @error('preparation') is-invalid @enderror"
                                       placeholder="Preparation"
                                       value="{{ old('preparation') }}"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">
                                @error('preparation')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="preparation-error"></div>
                            </div>

                            <!-- Price Input -->
                            <div class="mb-4">
                                <label for="price" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-dollar-sign me-2"></i>Price
                                </label>
                                <input id="price"
                                       name="price"
                                       type="number"
                                       step="0.01"
                                       class="form-control form-control-lg cafe-input @error('price') is-invalid @enderror"
                                       placeholder="Enter price"
                                       value="{{ old('price') }}"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">
                                @error('price')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="price-error"></div>
                            </div>

                            <!-- Stock Input -->
                            <div class="mb-4">
                                <label for="stock" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-box me-2"></i>Stock
                                </label>
                                <input id="stock"
                                       name="stock"
                                       type="number"
                                       class="form-control form-control-lg cafe-input @error('stock') is-invalid @enderror"
                                       placeholder="Enter stock"
                                       value="{{ old('stock') }}"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">
                                @error('stock')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="stock-error"></div>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="mb-3 form-label h5 cafe-label"
                                       style="color: #6c5ce7 !important; font-family: 'Playfair Display', serif;">
                                    <i class="fas fa-image me-2"></i>Image
                                </label>
                                <input id="image"
                                       name="image"
                                       type="file"
                                       class="form-control form-control-lg cafe-input @error('image') is-invalid @enderror"
                                       style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important; font-family: 'Open Sans', sans-serif;">
                                @error('image')
                                <div class="invalid-feedback cafe-feedback">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                                <div class="error-message" id="image-error"></div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="px-5 py-3 text-white cafe-btn-primary btn btn-lg"
                                        style="background-color: #6c5ce7 !important; border-radius: 50px !important; min-width: 200px !important; transition: background-color 0.3s ease, transform 0.3s ease;">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    <span>Create Product</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Scoped styles for cafe admin product form */
    .cafe-admin-container { background-color: #fff; min-height: 100vh; }
    .cafe-product-card { border-radius: 10px; }
    .cafe-product-title { font-family: 'Playfair Display', serif; font-weight: 700; }
    .cafe-label { font-family: 'Playfair Display', serif; color: #6c5ce7; }
    .cafe-input { border: 2px solid #e0e0e0; padding: 12px; border-radius: 10px; font-family: 'Open Sans', sans-serif; }
    .cafe-input:focus { border-color: #6c5ce7 !important; box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25) !important; }
    .cafe-input.is-invalid { border-color: #dc3545 !important; }
    .cafe-btn-back, .cafe-btn-primary { background-color: #6c5ce7; border-radius: 10px; transition: background-color 0.3s ease, transform 0.3s ease; }
    .cafe-btn-back:hover, .cafe-btn-primary:hover { background-color: #5a4ea7 !important; transform: scale(1.05); }
    .cafe-feedback { font-size: 0.875rem; font-family: 'Open Sans', sans-serif; }
    .error-message { display: none; color: #dc3545; font-size: 0.875rem; margin-top: 5px; }
</style>

@endsection

@section('scriptSource')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#addProductForm').on('submit', function(e) {
        let isValid = true;
        $('.error-message').hide();
        $('.cafe-input').removeClass('is-invalid');

        // Name validation
        const name = $('#name').val().trim();
        if (!name) {
            $('#name-error').text('Product name is required.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        } else if (name.length < 2) {
            $('#name-error').text('Name must be at least 2 characters long.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        } else if (name.length > 100) {
            $('#name-error').text('Name cannot exceed 100 characters.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        }

        // Category validation
        const categoryId = $('#category_id').val();
        if (!categoryId) {
            $('#category_id-error').text('Please select a category.').show();
            $('#category_id').addClass('is-invalid');
            isValid = false;
        }

        // Description validation
        const description = $('#description').val().trim();
        if (!description) {
            $('#description-error').text('Description is required.').show();
            $('#description').addClass('is-invalid');
            isValid = false;
        } else if (description.length > 255) {
            $('#description-error').text('Description cannot exceed 255 characters.').show();
            $('#description').addClass('is-invalid');
            isValid = false;
        }

        // Full Description validation
        const fullDescription = $('#full_description').val().trim();
        if (fullDescription && fullDescription.length > 1000) {
            $('#full_description-error').text('Full description cannot exceed 1000 characters.').show();
            $('#full_description').addClass('is-invalid');
            isValid = false;
        }

        // Nutrition validation
        const nutrition = $('#nutrition').val().trim();
        if (nutrition && nutrition.length > 500) {
            $('#nutrition-error').text('Nutrition cannot exceed 500 characters.').show();
            $('#nutrition').addClass('is-invalid');
            isValid = false;
        }

        // Ingredient validation
        const ingredient = $('#ingredient').val().trim();
        if (ingredient && ingredient.length > 500) {
            $('#ingredient-error').text('Ingredient cannot exceed 500 characters.').show();
            $('#ingredient').addClass('is-invalid');
            isValid = false;
        }

        // Preparation validation
        const preparation = $('#preparation').val().trim();
        if (preparation && preparation.length > 500) {
            $('#preparation-error').text('Preparation cannot exceed 500 characters.').show();
            $('#preparation').addClass('is-invalid');
            isValid = false;
        }

        // Price validation
        const price = $('#price').val();
        if (!price) {
            $('#price-error').text('Price is required.').show();
            $('#price').addClass('is-invalid');
            isValid = false;
        } else if (isNaN(price) || price < 0 || price > 999999.99) {
            $('#price-error').text('Price must be a number between 0 and 999,999.99.').show();
            $('#price').addClass('is-invalid');
            isValid = false;
        }

        // Stock validation
        const stock = $('#stock').val();
        if (!stock) {
            $('#stock-error').text('Stock is required.').show();
            $('#stock').addClass('is-invalid');
            isValid = false;
        } else if (isNaN(stock) || stock < 0 || stock > 9999) {
            $('#stock-error').text('Stock must be an integer between 0 and 9999.').show();
            $('#stock').addClass('is-invalid');
            isValid = false;
        }

        // Image validation
        const image = $('#image')[0].files[0];
        if (!image) {
            $('#image-error').text('Image is required.').show();
            $('#image').addClass('is-invalid');
            isValid = false;
        } else {
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (!validImageTypes.includes(image.type)) {
                $('#image-error').text('Only JPEG, PNG, or GIF files are allowed.').show();
                $('#image').addClass('is-invalid');
                isValid = false;
            } else if (image.size > maxSize) {
                $('#image-error').text('Image size must not exceed 2MB.').show();
                $('#image').addClass('is-invalid');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Real-time validation feedback
    $('#name, #category_id, #description, #full_description, #nutrition, #ingredient, #preparation, #price, #stock, #image').on('input change', function() {
        const $this = $(this);
        const value = $this.val().trim();
        const errorDiv = $this.nextAll('.error-message').first();
        $this.removeClass('is-invalid');
        errorDiv.hide();

        if ($this.attr('id') === 'name') {
            if (!value) errorDiv.text('Product name is required.').show();
            else if (value.length < 2) errorDiv.text('Name must be at least 2 characters long.').show();
            else if (value.length > 100) errorDiv.text('Name cannot exceed 100 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'category_id') {
            if (!value) errorDiv.text('Please select a category.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'description') {
            if (!value) errorDiv.text('Description is required.').show();
            else if (value.length > 255) errorDiv.text('Description cannot exceed 255 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'full_description') {
            if (value && value.length > 1000) errorDiv.text('Full description cannot exceed 1000 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'nutrition') {
            if (value && value.length > 500) errorDiv.text('Nutrition cannot exceed 500 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'ingredient') {
            if (value && value.length > 500) errorDiv.text('Ingredient cannot exceed 500 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'preparation') {
            if (value && value.length > 500) errorDiv.text('Preparation cannot exceed 500 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'price') {
            if (!value) errorDiv.text('Price is required.').show();
            else if (isNaN(value) || value < 0 || value > 999999.99) errorDiv.text('Price must be a number between 0 and 999,999.99.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'stock') {
            if (!value) errorDiv.text('Stock is required.').show();
            else if (isNaN(value) || value < 0 || value > 9999) errorDiv.text('Stock must be an integer between 0 and 9999.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'image') {
            const image = $this[0].files[0];
            if (!image) errorDiv.text('Image is required.').show();
            else {
                const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                const maxSize = 2 * 1024 * 1024;
                if (!validImageTypes.includes(image.type)) errorDiv.text('Only JPEG, PNG, or GIF files are allowed.').show();
                else if (image.size > maxSize) errorDiv.text('Image size must not exceed 2MB.').show();
                if (errorDiv.is(':visible')) $this.addClass('is-invalid');
            }
        }
    });
});
</script>
@endsection
