@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-dark">
    <div class="p-5 bg-white shadow-lg rounded-lg" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <h1 class="text-primary font-weight-bold" style="font-size: 2.5rem;">Food Ordering System</h1>
            <p class="text-muted mb-4" style="font-size: 1.2rem;">Please login to continue your food journey.</p>
        </div>

        <form action="{{ route('login') }}" method="post" class="needs-validation" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label text-dark font-weight-semibold">Email Address</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-dark font-weight-semibold">Password</label>
                <div class="input-group input-group-lg">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="invalid-feedback">Password cannot be empty.</div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg font-weight-bold" style="transition: 0.3s;">
                    Sign In
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="mb-1">Don't have an account?</p>
            <a href="{{ route('auth#register') }}" class="text-decoration-none text-primary font-weight-semibold">Sign Up Here</a>
        </div>
    </div>
</div>

@endsection

@section('scriptSource')
<script>
    // Example for handling form validation
    (function() {
        'use strict'
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    ();
</script>
@endsection
