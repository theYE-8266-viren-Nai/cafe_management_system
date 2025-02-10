@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="w-100" style="max-width: 400px;">
        <!-- Food Ordering System Caption -->
        <h1 class="text-uppercase text-primary text-center font-weight-bold mb-4" style="font-size: 2rem;">
            FOOD ORDERING SYSTEM
        </h1>

        <!-- Register Form -->
        <div class="login-form">
            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input class="au-input au-input--full" type="text" name="name" placeholder="Username" value="{{ old('username') }}">
                    @if($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input class="au-input au-input--full" type="text" name="phone" placeholder="Phone" value="{{ old('number') }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input class="au-input au-input--full" type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                    @if($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" class="au-input au-input--full" id="profile_photo_path" name="profile_photo_path" accept="image/*">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                    @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
                    @if($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Register</button>
            </form>

            <div class="register-link">
                <p>
                    Already have an account?
                    <a href="{{ route('auth#login') }}">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
