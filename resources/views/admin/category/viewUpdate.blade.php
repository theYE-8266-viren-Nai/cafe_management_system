@extends('admin.layouts.master')
@section('title', 'category/update')
@section('content')
<div class="px-4 container-fluid">
    <!-- Back to List Button -->
    <div class="mb-4 row">
        <div class="col-12 text-end">
            <a href="{{ route('category#list') }}" class="text-white btn"
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
                        <i class="fas fa-edit me-2"></i>Update Category
                    </h3>
                </div>

                <div class="p-5 card-body" style="background-color: #f8f9fa !important;">
                    <form action="{{ route('category#edit') }}" method="post" id="updateCategoryForm" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">

                        <!-- Category Name Input -->
                        <div class="mb-4 form-group">
                            <label for="category_name" class="mb-3 form-label h5"
                                   style="color: #6c5ce7 !important;">
                                <i class="fas fa-tag me-2"></i>Category Name
                            </label>
                            <input id="category_name"
                                   name="category_name"
                                   type="text"
                                   class="form-control form-control-lg @error('category_name') is-invalid @enderror"
                                   placeholder="Enter category name..."
                                   value="{{ old('category_name', $category->name ?? '') }}"
                                   style="border: 2px solid #e0e0e0 !important; padding: 12px !important; border-radius: 10px !important;"
                                   autofocus required>

                            @error('category_name')
                            <div class="invalid-feedback" style="color: #ff6b6b !important;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="error-message" id="category_name-error"></div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-5 text-center">
                            <button type="submit" class="px-5 py-3 text-white btn btn-lg"
                                    style="background-color: #6c5ce7 !important; border-radius: 50px !important; min-width: 200px !important;">
                                <i class="fas fa-save me-2"></i>
                                <span>Update Category</span>
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
    $('#updateCategoryForm').on('submit', function(e) {
        let isValid = true;
        $('.error-message').hide();
        $('.form-control').removeClass('is-invalid');

        // Category Name validation
        const categoryName = $('#category_name').val().trim();
        if (!categoryName) {
            $('#category_name-error').text('Category name is required.').show();
            $('#category_name').addClass('is-invalid');
            isValid = false;
        } else if (categoryName.length < 2) {
            $('#category_name-error').text('Category name must be at least 2 characters long.').show();
            $('#category_name').addClass('is-invalid');
            isValid = false;
        } else if (categoryName.length > 100) {
            $('#category_name-error').text('Category name cannot exceed 100 characters.').show();
            $('#category_name').addClass('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    // Real-time validation feedback
    $('#category_name').on('input', function() {
        const $this = $(this);
        const value = $this.val().trim();
        const errorDiv = $('#category_name-error');
        $this.removeClass('is-invalid');
        errorDiv.hide();

        if (!value) {
            errorDiv.text('Category name is required.').show();
            $this.addClass('is-invalid');
        } else if (value.length < 2) {
            errorDiv.text('Category name must be at least 2 characters long.').show();
            $this.addClass('is-invalid');
        } else if (value.length > 100) {
            errorDiv.text('Category name cannot exceed 100 characters.').show();
            $this.addClass('is-invalid');
        }
    });
});
</script>
@endsection
