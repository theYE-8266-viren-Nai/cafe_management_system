@extends('admin.layouts.master')
@section('title','category/update')
@section('content')
<div class="container-fluid">
    <div class="row">

    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Change Your Password</h3>
                </div>

                <hr>
                <form action="{{ route('admin.changePassword') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <!-- Old Password Field -->
                        <label for="oldPassword" class="mb-1 control-label">Old Password</label>
                        <input id="oldPassword" name="old_password" type="password"
                            class="form-control @error('old_password') is-invalid @enderror"
                            aria-required="true" aria-invalid="false" placeholder="Enter Old Password">

                        @error('old_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- New Password Field -->
                        <label for="newPassword" class="mb-1 control-label">New Password</label>
                        <input id="newPassword" name="new_password" type="password"
                            class="form-control @error('new_password') is-invalid @enderror"
                            aria-required="true" aria-invalid="false" placeholder="Enter New Password">

                        @error('new_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Confirm Password Field -->
                        <label for="confirmPassword" class="mb-1 control-label">Confirm Password</label>
                        <input id="confirmPassword" name="confirm_password" type="password"
                            class="form-control @error('confirm_password') is-invalid @enderror"
                            aria-required="true" aria-invalid="false" placeholder="Confirm New Password">

                        @error('confirm_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Change Password</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
