@extends('admin.layouts.master')
@section('title', 'Edit Profile')
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

    /* Profile Image Styles */
    .profile-image {
        width: 200px !important;
        height: 200px !important;
        object-fit: cover !important;
        border-radius: 15px !important;
        border: 3px solid #6c5ce7 !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important;
        margin-bottom: 20px !important;
    }

    /* Form Styles */
    .form-group {
        background: white !important;
        border-radius: 10px !important;
        padding: 20px !important;
        margin-bottom: 15px !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
    }

    .form-group:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.1) !important;
    }

    .form-label {
        color: #6c5ce7 !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        margin-bottom: 5px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .form-control {
        border: 1px solid #e1e1e1 !important;
        padding: 10px !important;
        border-radius: 8px !important;
    }

    .form-control:focus {
        border-color: #6c5ce7 !important;
        box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25) !important;
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
</style>

<div class="content-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card main-card">
                    <div class="card-header card-header-custom">
                        <h3 class="text-center">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </h3>
                    </div>

                    <div class="card-body card-body-custom">
                        <form action="{{ route('admin.editProfileData') }}" method="POST" enctype="multipart/form-data">
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
                                    </div>
                                </div>

                                <!-- Form Fields Section -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-user me-2"></i>Full Name
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email Address
                                        </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>New Password (Optional)
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @error('password')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Confirm New Password
                                        </label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation">
                                        @error('password_confirmation')
                                            <div class="mt-2 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 text-end">
                                <a href="{{ route('admin.account_view') }}" class="btn btn-custom me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <button type="submit" class="btn btn-custom">
                                    <i class="fas fa-save me-2"></i>Save Changes
                                </button>
                            </div>
                        </form>

                        @if(session('success'))
                            <div class="mt-4 alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
