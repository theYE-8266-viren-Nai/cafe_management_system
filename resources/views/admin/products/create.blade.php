@extends('admin.layouts.master')
@section('title','category/create')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('admin.product.list') }}"><button class="my-3 text-white btn bg-dark">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Add your item</h3>
                </div>
                <hr>
                <form action="{{ route('admin.product.pizzaData') }}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <!-- Name Input -->
                        <label for="category_name" class="mb-1 control-label">Name</label>
                        <input id="category_name" name="name" type="text"
                            class="form-control mb-3 @error('name') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" placeholder="Product Name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Category Select Dropdown -->
                        <label for="category_id" class="mb-1 control-label">Category</label>
                        <select name="category_id" id="category_id" class="mb-3 form-control">
                           @foreach ($categories as $category)
                               <option value="{{ $category['category_id'] }}">{{ $category['name'] }}</option>
                           @endforeach
                        </select>

                        <!-- Description Textarea -->
                        <label for="description" class="mb-1 control-label">Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <!-- Price Input -->
                        <label for="price" class="mb-1 control-label">Price</label>
                        <input id="price" name="price" type="number"
                            class="form-control mb-3 @error('price') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" placeholder="Enter price" value="{{ old('price') }}">
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <label for="stock" class="mb-1 control-label">Stocks</label>
                        <input id="stock" name="stock" type="number"
                            class="form-control mb-3 @error('price') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" placeholder="Enter stock" value="{{ old('stock') }}">
                        @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <!-- Image Upload -->
                        <label for="image" class="mb-1 control-label">Image</label>
                        <input id="image" name="image" type="file"
                            class="form-control mb-3 @error('image') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" value="{{ old('image') }}">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
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
