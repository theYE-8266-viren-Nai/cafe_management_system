@extends('admin.layouts.master')
@section('title', 'Product/Update')
@section('content')
<div class="px-4 container-fluid">
    <!-- Back to List Button -->
    <div class="mb-4 row">
        <div class="col-12 text-end">
            <a href="{{ route('admin.product.list') }}" class="text-white btn"
               style="background-color: #6c5ce7 !important;">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="border-0 card" style="box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                <!-- Card Header -->
                <div class="border-0 card-header" style="background-color: #6c5ce7 !important;">
                    <h3 class="py-3 m-0 text-center text-white">
                        <i class="fas fa-edit me-2"></i>Update Product
                    </h3>
                </div>

                <div class="p-5 card-body" style="background-color: #f8f9fa !important;">
                    <form action="{{ route('admin.product.editPizzaData') }}" method="post" enctype="multipart/form-data" id="updateProductForm" novalidate>
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $pizza['product_id'] }}">

                        <!-- Name Input -->
                        <div class="mb-4 form-group">
                            <label for="name" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-tag me-2"></i>Product Name
                            </label>
                            <input id="name"
                                   name="name"
                                   type="text"
                                   class="form-control form-control-lg @error('name') is-invalid @enderror"
                                   placeholder="Enter product name..."
                                   value="{{ old('name', $pizza['name'] ?? '') }}"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   required>

                            @error('name')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="name-error"></div>
                        </div>

                        <!-- Category Select Dropdown -->
                        <div class="mb-4 form-group">
                            <label for="category_id" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-layer-group me-2"></i>Category
                            </label>
                            <select name="category_id" id="category_id" class="form-control form-control-lg @error('category_id') is-invalid @enderror"
                                    style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                    required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['category_id'] }}" {{ old('category_id', $pizza['category_id'] ?? '') == $category['category_id'] ? 'selected' : '' }}>
                                        {{ $category['name'] }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="category_id-error"></div>
                        </div>

                        <!-- Description Textarea -->
                        <div class="mb-4 form-group">
                            <label for="description" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-align-left me-2"></i>Description
                            </label>
                            <textarea name="description" class="form-control form-control-lg @error('description') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Enter product description..."
                                      style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                      required>{{ old('description', $pizza['description'] ?? '') }}</textarea>

                            @error('description')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="description-error"></div>
                        </div>

                        <!-- Full Description Textarea -->
                        <div class="mb-4 form-group">
                            <label for="full_description" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-align-left me-2"></i>Full Description
                            </label>
                            <textarea name="full_description" class="form-control form-control-lg @error('full_description') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Enter full product description..."
                                      style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                      required>{{ old('full_description', $pizza['full_description'] ?? '') }}</textarea>

                            @error('full_description')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="full_description-error"></div>
                        </div>

                        <!-- Nutrition Input -->
                        <div class="mb-4 form-group">
                            <label for="nutrition" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-utensils me-2"></i>Nutrition
                            </label>
                            <input id="nutrition"
                                   name="nutrition"
                                   type="text"
                                   class="form-control form-control-lg @error('nutrition') is-invalid @enderror"
                                   placeholder="Enter nutrition information..."
                                   value="{{ old('nutrition', $pizza['nutrition'] ?? '') }}"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   required>

                            @error('nutrition')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="nutrition-error"></div>
                        </div>

                        <!-- Ingredient Input -->
                        <div class="mb-4 form-group">
                            <label for="ingredient" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-leaf me-2"></i>Ingredient
                            </label>
                            <input id="ingredient"
                                   name="ingredient"
                                   type="text"
                                   class="form-control form-control-lg @error('ingredient') is-invalid @enderror"
                                   placeholder="Enter ingredient..."
                                   value="{{ old('ingredient', $pizza['ingredient'] ?? '') }}"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   required>

                            @error('ingredient')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="ingredient-error"></div>
                        </div>

                        <!-- Preparation Input -->
                        <div class="mb-4 form-group">
                            <label for="preparation" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-fire me-2"></i>Preparation
                            </label>
                            <input id="preparation"
                                   name="preparation"
                                   type="text"
                                   class="form-control form-control-lg @error('preparation') is-invalid @enderror"
                                   placeholder="Enter preparation details..."
                                   value="{{ old('preparation', $pizza['preparation'] ?? '') }}"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   required>

                            @error('preparation')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="preparation-error"></div>
                        </div>

                        <!-- Price Input -->
                        <div class="mb-4 form-group">
                            <label for="price" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-dollar-sign me-2"></i>Price
                            </label>
                            <input id="price"
                                   name="price"
                                   type="number"
                                   class="form-control form-control-lg @error('price') is-invalid @enderror"
                                   placeholder="Enter price..."
                                   value="{{ old('price', $pizza['price'] ?? '') }}"
                                   step="0.01"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   required>

                            @error('price')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="price-error"></div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4 form-group">
                            <label for="image" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-camera me-2"></i>Image
                            </label>
                            <input id="image"
                                   name="image"
                                   type="file"
                                   class="form-control form-control-lg @error('image') is-invalid @enderror"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   accept="image/*">

                            @error('image')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="image-error"></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-5 text-center">
                            <button type="submit" class="px-5 py-3 text-white btn btn-lg"
                                    style="background-color: #6c5ce7 !important; border-radius: 50px !important; min-width: 200px !important;">
                                <i class="fas fa-save me-2"></i>
                                <span>Update Product</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #6c5ce7 !important;
        box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25) !important;
    }

    .form-control.is-invalid {
        border-color: #dc3545 !important;
    }

    .btn:hover {
        opacity: 0.9 !important;
        transform: translateY(-1px) !important;
        transition: all 0.3s !important;
    }

    .invalid-feedback,
    .error-message {
        font-size: 0.875rem !important;
        margin-top: 0.5rem !important;
        color: #ff6b6b !important;
    }

    .error-message {
        display: none;
    }
</style>

@endsection

@section('scriptSource')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#updateProductForm').on('submit', function(e) {
        let isValid = true;
        $('.error-message').hide();
        $('.form-control').removeClass('is-invalid');

        // Name validation
        const name = $('#name').val().trim();
        if (!name) {
            $('#name-error').text('Product name is required.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        } else if (name.length < 2) {
            $('#name-error').text('Product name must be at least 2 characters long.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        } else if (name.length > 100) {
            $('#name-error').text('Product name cannot exceed 100 characters.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        }

        // Category validation
        const categoryId = $('#category_id').val();
        if (!categoryId) {
            $('#category_id-error').text('Category is required.').show();
            $('#category_id').addClass('is-invalid');
            isValid = false;
        }

        // Description validation
        const description = $('#description').val().trim();
        if (!description) {
            $('#description-error').text('Description is required.').show();
            $('#description').addClass('is-invalid');
            isValid = false;
        } else if (description.length > 500) {
            $('#description-error').text('Description cannot exceed 500 characters.').show();
            $('#description').addClass('is-invalid');
            isValid = false;
        }

        // Full Description validation
        const fullDescription = $('#full_description').val().trim();
        if (!fullDescription) {
            $('#full_description-error').text('Full description is required.').show();
            $('#full_description').addClass('is-invalid');
            isValid = false;
        } else if (fullDescription.length > 1000) {
            $('#full_description-error').text('Full description cannot exceed 1000 characters.').show();
            $('#full_description').addClass('is-invalid');
            isValid = false;
        }

        // Nutrition validation
        const nutrition = $('#nutrition').val().trim();
        if (!nutrition) {
            $('#nutrition-error').text('Nutrition information is required.').show();
            $('#nutrition').addClass('is-invalid');
            isValid = false;
        } else if (nutrition.length > 255) {
            $('#nutrition-error').text('Nutrition cannot exceed 255 characters.').show();
            $('#nutrition').addClass('is-invalid');
            isValid = false;
        }

        // Ingredient validation
        const ingredient = $('#ingredient').val().trim();
        if (!ingredient) {
            $('#ingredient-error').text('Ingredient is required.').show();
            $('#ingredient').addClass('is-invalid');
            isValid = false;
        } else if (ingredient.length > 255) {
            $('#ingredient-error').text('Ingredient cannot exceed 255 characters.').show();
            $('#ingredient').addClass('is-invalid');
            isValid = false;
        }

        // Preparation validation
        const preparation = $('#preparation').val().trim();
        if (!preparation) {
            $('#preparation-error').text('Preparation details are required.').show();
            $('#preparation').addClass('is-invalid');
            isValid = false;
        } else if (preparation.length > 255) {
            $('#preparation-error').text('Preparation cannot exceed 255 characters.').show();
            $('#preparation').addClass('is-invalid');
            isValid = false;
        }

        // Price validation
        const price = $('#price').val().trim();
        if (!price || price <= 0) {
            $('#price-error').text('Price must be greater than 0.').show();
            $('#price').addClass('is-invalid');
            isValid = false;
        }

        // Image validation
        const image = $('#image')[0].files[0];
        if (image) {
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
    $('#name, #category_id, #description, #full_description, #nutrition, #ingredient, #preparation, #price, #image').on('input change', function() {
        const $this = $(this);
        const value = $this.val().trim();
        const errorDiv = $this.nextAll('.error-message').first();
        $this.removeClass('is-invalid');
        errorDiv.hide();

        if ($this.attr('id') === 'name') {
            if (!value) errorDiv.text('Product name is required.').show();
            else if (value.length < 2) errorDiv.text('Product name must be at least 2 characters long.').show();
            else if (value.length > 100) errorDiv.text('Product name cannot exceed 100 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'category_id') {
            if (!value) errorDiv.text('Category is required.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'description') {
            if (!value) errorDiv.text('Description is required.').show();
            else if (value.length > 500) errorDiv.text('Description cannot exceed 500 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'full_description') {
            if (!value) errorDiv.text('Full description is required.').show();
            else if (value.length > 1000) errorDiv.text('Full description cannot exceed 1000 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'nutrition') {
            if (!value) errorDiv.text('Nutrition information is required.').show();
            else if (value.length > 255) errorDiv.text('Nutrition cannot exceed 255 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'ingredient') {
            if (!value) errorDiv.text('Ingredient is required.').show();
            else if (value.length > 255) errorDiv.text('Ingredient cannot exceed 255 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'preparation') {
            if (!value) errorDiv.text('Preparation details are required.').show();
            else if (value.length > 255) errorDiv.text('Preparation cannot exceed 255 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'price') {
            if (!value || value <= 0) errorDiv.text('Price must be greater than 0.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'image') {
            const image = $this[0].files[0];
            if (image) {
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
