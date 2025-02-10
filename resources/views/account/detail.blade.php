@extends('admin.layouts.master')
@section('content')
<div class="container my-5">
    <div class="container my-5">
        <div class="mx-auto card" style="width: 22rem;">
          <div class="text-center card-body">
            <!-- Profile Image -->
            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Profile Image" class="object-cover w-20 h-20 rounded-full">
            <!-- Username -->
        <h4 class="mb-3 card-title">{{ $user_data->name }}</h4>

            <!-- Address -->
            <p class="mb-3 card-text">
              <i class="fas fa-map-marker-alt me-2"></i>{{ $user_data->address }}
            </p>

            <!-- Phone Number -->
            <p class="mb-3 card-text">
              <i class="fas fa-phone me-2"></i>{{$user_data->phone }}
            </p>

            <!-- Email -->
            <p class="mb-4 card-text">
              <i class="fas fa-envelope me-2"></i> {{ $user_data->email }}
            </p>

            <!-- Action Buttons -->
            <a href="{{route('admin.editProfile')  }}" class="btn btn-primary">
                <button class="text-white ">Edit Profile</button>
            </a>
          </div>
        </div>
      </div>


@endsection
