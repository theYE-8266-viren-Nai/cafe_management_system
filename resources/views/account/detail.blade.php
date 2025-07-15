@extends('admin.layouts.master')
@section('title', 'Profile Details')
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

    /* Info Card Styles */
    .info-card {
        background: white !important;
        border-radius: 10px !important;
        padding: 20px !important;
        margin-bottom: 15px !important;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1) !important;
        transition: all 0.3s ease !important;
    }

    .info-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(108, 92, 231, 0.1) !important;
    }

    .info-label {
        color: #6c5ce7 !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        margin-bottom: 5px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .info-value {
        font-size: 1.1rem !important;
        color: #2d3436 !important;
        padding-left: 28px !important;
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
                            <i class="fas fa-user-circle me-2"></i>Admin Profile Details
                        </h3>
                    </div>

                    <div class="card-body card-body-custom">
                        <div class="row">
                            <!-- Profile Image -->
                            <div class="text-center col-md-4">
                                {{--  @dd($user_data->toArray());  --}}
                                @if($user_data->profile_photo_url)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="profile-image" alt="Profile Image">
                                @else
                                    <img src="{{ asset('image/default_user.png') }}" class="profile-image" alt="Default Profile">
                                @endif
                            </div>

                            <!-- Profile Information -->
                            <div class="col-md-8">
                                <div class="info-card">
                                    <div class="info-label">
                                        <i class="fas fa-user"></i>
                                        <span>Name</span>
                                    </div>
                                    <div class="info-value">{{ $user_data->name }}</div>
                                </div>

                                <div class="info-card">
                                    <div class="info-label">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email</span>
                                    </div>
                                    <div class="info-value">{{ $user_data->email }}</div>
                                </div>

                                <div class="info-card">
                                    <div class="info-label">
                                        <i class="fas fa-mobile-alt"></i>
                                        <span>Phone</span>
                                    </div>
                                    <div class="info-value">{{ $user_data->phone }}</div>
                                </div>

                                <div class="info-card">
                                    <div class="info-label">
                                        <i class="fas fa-users"></i>
                                        <span>Gender</span>
                                    </div>
                                    <div class="info-value">{{ ucfirst($user_data->gender) }}</div>
                                </div>

                                <div class="info-card">
                                    <div class="info-label">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Address</span>
                                    </div>
                                    <div class="info-value">{{ $user_data->address }}</div>
                                </div>

                                <div class="info-card">
                                    <div class="info-label">
                                        <i class="fas fa-user-shield"></i>
                                        <span>Role</span>
                                    </div>
                                    <div class="info-value">{{ ucfirst($user_data->role) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4 text-end">
                            <a href="{{ route('category#list') }}" class="btn btn-custom me-2">
                                <i class="fas fa-arrow-left me-2"></i>Back
                            </a>
                            <a href="{{ route('admin.editProfile') }}" class="btn btn-custom">
                                <i class="fas fa-edit me-2"></i>Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
