@extends('admin.layouts.master')
@section('content')
<form action="{{ route('admin.editProfileData') }}" method="POST" enctype="multipart/form-data" class="container p-4 mt-5 bg-white rounded shadow">
    @csrf

    <h2 class="mb-4 text-center">Edit Profile</h2>

    <!-- Profile Picture Upload with Preview -->
    <div class="mb-3 text-center">
        <label for="profilePicture" class="form-label">Profile Picture</label>
        <div class="mb-3">
            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Image" class="object-cover w-20 h-20 rounded-full">
        </div>
        <input type="file" class="form-control" id="profilePicture" name="image" accept="image/*">
        <!-- Placeholder for validation error -->
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Name Input -->
    <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter your full name" required>
        <!-- Placeholder for validation error -->
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email Input -->
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter your email address" required>
        <!-- Placeholder for validation error -->
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password Input (Optional) -->
    <div class="mb-3">
        <label for="password" class="form-label">New Password (Optional)</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (leave blank to keep current password)">
        <!-- Placeholder for validation error -->
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password Input -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your new password">
        <!-- Placeholder for validation error -->
        @error('password_confirmation')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Success Message (optional, handled by backend) -->
    @if(session('success'))
        <div class="text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Submit Button -->
    <div class="d-grid">
        <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
    </div>
</form>

@endsection
