@extends('user.layouts.master')
@section('title', 'Edit Profile')
@section('container')

<style>
    /* Card and Container Styles */
    .content-wrapper { padding: 20px; }
    .main-card { border: none !important; box-shadow: 0 0 15px rgba(0,0,0,0.1) !important; border-radius: 10px !important; overflow: hidden !important; background-color: #fff !important; }
    .card-header-custom { background-color: #8B4513 !important; border: none !important; padding: 20px !important; }
    .card-header-custom h2 { color: white !important; margin: 0 !important; font-size: 1.5rem !important; }
    .card-body-custom { background-color: #f8f9fa !important; padding: 40px !important; }
    .profile-image { width: 200px !important; height: 200px !important; object-fit: cover !important; border-radius: 15px !important; border: 3px solid #8B4513 !important; box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important; margin-bottom: 20px !important; }
    .form-group { background: white !important; border-radius: 10px !important; padding: 20px !important; margin-bottom: 15px !important; box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important; transition: all 0.3s ease !important; }
    .form-group:hover { transform: translateY(-2px) !important; box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1) !important; }
    .form-label { color: #8B4513 !important; font-weight: 600 !important; font-size: 0.9rem !important; margin-bottom: 5px !important; display: flex !important; align-items: center !important; gap: 8px !important; }
    .form-control { border: 1px solid #e1e1e1 !important; padding: 10px !important; border-radius: 8px !important; }
    .form-control:focus { border-color: #8B4513 !important; box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25) !important; }
    .form-control.is-invalid { border-color: #dc3545 !important; }
    .btn-custom { background-color: #8B4513 !important; color: white !important; border: none !important; padding: 12px 30px !important; border-radius: 50px !important; transition: all 0.3s ease !important; font-weight: 500 !important; }
    .btn-custom:hover { opacity: 0.9 !important; transform: translateY(-1px) !important; box-shadow: 0 3px 10px rgba(139, 69, 19, 0.2) !important; }
    .error-message { display: none; color: #dc3545; font-size: 0.85rem; margin-top: 5px; }
</style>

<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card main-card">
                    <div class="card-header card-header-custom">
                        <h2 class="text-center">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </h2>
                    </div>

                    <div class="card-body card-body-custom">
                        <form action="{{ route('user.accountUpdate') }}" method="POST" enctype="multipart/form-data" id="profileForm" novalidate>
                            @csrf
                            <div class="row">
                                <!-- Profile Image Section -->
                                <div class="text-center col-md-4">
                                    <div class="form-group">
                                        <label for="profilePicture" class="form-label">
                                            <i class="fas fa-camera me-2"></i>Profile Picture
                                        </label>
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                                 alt="Profile Image"
                                                 class="profile-image">
                                        </div>
                                        <input type="file" class="form-control" id="profilePicture" name="image" accept="image/*">
                                        @error('image')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="image-error"></div>
                                    </div>
                                </div>

                                <!-- Form Fields Section -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user me-2"></i>Full Name
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name', Auth::user()->name) }}" placeholder="Enter your full name" required>
                                        @error('name')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="name-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email Address
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email', Auth::user()->email) }}" placeholder="Enter your email address" required>
                                        @error('email')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="email-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            <i class="fas fa-phone me-2"></i>Phone Number
                                        </label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                               value="{{ old('phone', Auth::user()->phone) }}" placeholder="Enter your phone number">
                                        @error('phone')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="phone-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="form-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Address
                                        </label>
                                        <textarea class="form-control" id="address" name="address"
                                                  rows="3" placeholder="Enter your address">{{ old('address', Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="address-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>New Password (Optional)
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Enter new password (leave blank to keep current)">
                                        @error('password')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="password-error"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Confirm New Password
                                        </label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" placeholder="Confirm your new password">
                                        @error('password_confirmation')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="error-message" id="password_confirmation-error"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 text-end">
                                <a href="{{ route('user.account') }}" class="btn btn-custom me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="mt-4 alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scriptSource')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#profileForm').on('submit', function(e) {
        let isValid = true;
        $('.error-message').hide(); // Hide all previous error messages
        $('.form-control').removeClass('is-invalid'); // Remove invalid class

        // Name validation
        const name = $('#name').val().trim();
        if (!name) {
            $('#name-error').text('Full name is required.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        } else if (name.length < 2) {
            $('#name-error').text('Full name must be at least 2 characters long.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        } else if (name.length > 50) {
            $('#name-error').text('Full name cannot exceed 50 characters.').show();
            $('#name').addClass('is-invalid');
            isValid = false;
        }

        // Email validation
        const email = $('#email').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            $('#email-error').text('Email address is required.').show();
            $('#email').addClass('is-invalid');
            isValid = false;
        } else if (!emailRegex.test(email)) {
            $('#email-error').text('Please enter a valid email address.').show();
            $('#email').addClass('is-invalid');
            isValid = false;
        } else if (email.length > 255) {
            $('#email-error').text('Email address cannot exceed 255 characters.').show();
            $('#email').addClass('is-invalid');
            isValid = false;
        }

        // Phone validation
        const phone = $('#phone').val().trim();
        const phoneRegex = /^\+?[\d\s-]{10,15}$/; // Basic phone number regex (allows + and spaces/dashes)
        if (phone && !phoneRegex.test(phone)) {
            $('#phone-error').text('Please enter a valid phone number (e.g., +1234567890 or 123-456-7890).').show();
            $('#phone').addClass('is-invalid');
            isValid = false;
        } else if (phone.length > 20) {
            $('#phone-error').text('Phone number cannot exceed 20 characters.').show();
            $('#phone').addClass('is-invalid');
            isValid = false;
        }

        // Address validation
        const address = $('#address').val().trim();
        if (address && address.length > 255) {
            $('#address-error').text('Address cannot exceed 255 characters.').show();
            $('#address').addClass('is-invalid');
            isValid = false;
        }

        // Password validation (optional)
        const password = $('#password').val();
        const passwordConfirmation = $('#password_confirmation').val();
        if (password) {
            if (password.length < 8) {
                $('#password-error').text('Password must be at least 8 characters long.').show();
                $('#password').addClass('is-invalid');
                isValid = false;
            } else if (password.length > 50) {
                $('#password-error').text('Password cannot exceed 50 characters.').show();
                $('#password').addClass('is-invalid');
                isValid = false;
            } else if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
                $('#password-error').text('Password must contain at least one uppercase letter and one number.').show();
                $('#password').addClass('is-invalid');
                isValid = false;
            }

            if (password !== passwordConfirmation) {
                $('#password_confirmation-error').text('Passwords do not match.').show();
                $('#password_confirmation').addClass('is-invalid');
                isValid = false;
            } else if (!passwordConfirmation) {
                $('#password_confirmation-error').text('Please confirm your password.').show();
                $('#password_confirmation').addClass('is-invalid');
                isValid = false;
            }
        } else if (passwordConfirmation) {
            $('#password-error').text('Please enter a new password to confirm.').show();
            $('#password').addClass('is-invalid');
            isValid = false;
        }

        // Image validation
        const image = $('#profilePicture')[0].files[0];
        if (image) {
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const maxSize = 2 * 1024 * 1024; // 2MB
            if (!validImageTypes.includes(image.type)) {
                $('#image-error').text('Only JPEG, PNG, or GIF files are allowed.').show();
                $('#profilePicture').addClass('is-invalid');
                isValid = false;
            } else if (image.size > maxSize) {
                $('#image-error').text('Image size must not exceed 2MB.').show();
                $('#profilePicture').addClass('is-invalid');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Real-time validation feedback
    $('#name, #email, #phone, #address, #password, #password_confirmation, #profilePicture').on('input change', function() {
        const $this = $(this);
        const value = $this.val().trim();
        const errorDiv = $this.nextAll('.error-message').first();
        $this.removeClass('is-invalid');
        errorDiv.hide();

        // Real-time checks
        if ($this.attr('id') === 'name') {
            if (!value) errorDiv.text('Full name is required.').show();
            else if (value.length < 2) errorDiv.text('Full name must be at least 2 characters long.').show();
            else if (value.length > 50) errorDiv.text('Full name cannot exceed 50 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!value) errorDiv.text('Email address is required.').show();
            else if (!emailRegex.test(value)) errorDiv.text('Please enter a valid email address.').show();
            else if (value.length > 255) errorDiv.text('Email address cannot exceed 255 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'phone') {
            const phoneRegex = /^\+?[\d\s-]{10,15}$/;
            if (value && !phoneRegex.test(value)) errorDiv.text('Please enter a valid phone number (e.g., +1234567890 or 123-456-7890).').show();
            else if (value.length > 20) errorDiv.text('Phone number cannot exceed 20 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'address') {
            if (value.length > 255) errorDiv.text('Address cannot exceed 255 characters.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'password') {
            const password = value;
            const confirmation = $('#password_confirmation').val();
            if (password) {
                if (password.length < 8) errorDiv.text('Password must be at least 8 characters long.').show();
                else if (password.length > 50) errorDiv.text('Password cannot exceed 50 characters.').show();
                else if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) errorDiv.text('Password must contain at least one uppercase letter and one number.').show();
                if (confirmation && password !== confirmation) {
                    $('#password_confirmation-error').text('Passwords do not match.').show();
                    $('#password_confirmation').addClass('is-invalid');
                }
            }
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'password_confirmation') {
            const password = $('#password').val();
            if (password && !value) errorDiv.text('Please confirm your password.').show();
            else if (password && value !== password) errorDiv.text('Passwords do not match.').show();
            if (errorDiv.is(':visible')) $this.addClass('is-invalid');
        }

        if ($this.attr('id') === 'profilePicture') {
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
