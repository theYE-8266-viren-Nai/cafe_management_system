@extends('admin.layouts.master')
@section('title', 'Change Password')
@section('content')

<style>
    /* Card and Container Styles */
    .content-wrapper {
        padding: 20px;
    }

    .main-card {
        border: none !important;
        box-shadow: 0 0 15px rgba(0,0,0,0.1) !important;
        border-radius: 10px !important;
        overflow: hidden !important;
    }

    .card-header-custom {
        background-color: #6c5ce7 !important;
        border: none !important;
        padding: 20px !important;
    }

    .card-header-custom h3 {
        color: white !important;
        margin: 0 !important;
        font-size: 1.5rem !important;
    }

    .card-body-custom {
        background-color: #f8f9fa !important;
        padding: 40px !important;
    }

    /* Form Input Styles */
    .form-label-custom {
        color: #6c5ce7 !important;
        font-weight: 600 !important;
        margin-bottom: 10px !important;
        font-size: 1.1rem !important;
    }

    .input-custom {
        border: none !important;
        border-radius: 10px !important;
        padding: 15px !important;
        background: white !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important;
        margin-bottom: 20px !important;
        transition: all 0.3s ease !important;
    }

    .input-custom:focus {
        box-shadow: 0 3px 15px rgba(108, 92, 231, 0.2) !important;
        outline: none !important;
        border: 1px solid rgba(108, 92, 231, 0.3) !important;
    }

    /* Button Styles */
    .btn-custom {
        background-color: #6c5ce7 !important;
        color: white !important;
        border: none !important;
        padding: 12px 30px !important;
        border-radius: 50px !important;
        transition: all 0.3s ease !important;
        font-weight: 500 !important;
    }

    .btn-custom:hover {
        opacity: 0.9 !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 3px 10px rgba(108, 92, 231, 0.2) !important;
    }

    /* Password Field Container */
    .password-field {
        position: relative !important;
    }

    .password-toggle {
        position: absolute !important;
        right: 15px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        cursor: pointer !important;
        color: #6c5ce7 !important;
        opacity: 0.7 !important;
        transition: all 0.3s ease !important;
    }

    .password-toggle:hover {
        opacity: 1 !important;
    }

    /* Error Messages */
    .invalid-feedback {
        color: #ff6b6b !important;
        font-size: 0.875rem !important;
        margin-top: 5px !important;
    }
</style>

<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card main-card">
                    <div class="card-header card-header-custom">
                        <h3 class="text-center">
                            <i class="fas fa-key me-2"></i>Change Password
                        </h3>
                    </div>

                    <div class="card-body card-body-custom">
                        <form action="{{ route('admin.changePassword') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label class="form-label-custom">
                                    <i class="fas fa-lock me-2"></i>Old Password
                                </label>
                                <div class="password-field">
                                    <input type="password"
                                           name="oldPassword"
                                           class="form-control input-custom @error('oldPassword') is-invalid @enderror"
                                           placeholder="Enter your current password">
                                    <i class="fas fa-eye password-toggle"></i>
                                </div>
                                @error('oldPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label-custom">
                                    <i class="fas fa-key me-2"></i>New Password
                                </label>
                                <div class="password-field">
                                    <input type="password"
                                           name="newPassword"
                                           class="form-control input-custom @error('newPassword') is-invalid @enderror"
                                           placeholder="Enter your new password">
                                    <i class="fas fa-eye password-toggle"></i>
                                </div>
                                @error('newPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label-custom">
                                    <i class="fas fa-check-circle me-2"></i>Confirm Password
                                </label>
                                <div class="password-field">
                                    <input type="password"
                                           name="confirmPassword"
                                           class="form-control input-custom @error('confirmPassword') is-invalid @enderror"
                                           placeholder="Confirm your new password">
                                    <i class="fas fa-eye password-toggle"></i>
                                </div>
                                @error('confirmPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="mt-4 text-end">
                                <a href="{{ route('category#list') }}" class="btn btn-custom me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save me-2"></i>Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>

@endsection
