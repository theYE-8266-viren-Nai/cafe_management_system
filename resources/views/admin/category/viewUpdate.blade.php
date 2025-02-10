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
                    <h3 class="text-center title-2">Update your item</h3>
                </div>

                <hr>
                <form action="{{ route('category#edit') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $id }}">
                        <label for="category_name" class="mb-1 control-label">Name</label>
                        <input id="category_name"
                               name="category_name"
                               type="text"
                               class="form-control @error('category_name') is-invalid @enderror"
                               aria-required="true"
                               aria-invalid="false"
                               placeholder="Seafood..."
                               value="{{ old('category_name') }}"> <!-- Retain old input -->

                        <!-- Error message display -->
                        @error('category_name')
                            <div class="invalid-feedback">
                                {{ $message }} <!-- This will display the error message -->
                            </div>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Create</span>
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
