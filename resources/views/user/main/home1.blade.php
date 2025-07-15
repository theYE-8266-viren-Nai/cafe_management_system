@extends('user.layouts.master');
@section('container')
<section class="cover-section">
    <div class="cover-content">
        <h2>Welcome!</h2>
        <h1>We serve the richest coffee in the city!</h1>
        <a href="{{ route('user.menu') }}" class="order-btn">Order Now</a>
    </div>
</section>

<!-- Icons Section -->
<section class="icons-section">
    <div class="container">
        <div class="text-center row">
            <div class="col-md-3 col-6 icon-item">
                <img src="{{ asset('images/coffee.jpg') }}" alt="Hot Coffee">
                <p>Coffee</p>
                {{--  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                    </form>  --}}
            </div>
            <div class="col-md-3 col-6 icon-item">
                <img src="{{ asset('images/coffee.jpg') }}" alt="Cold Coffee">
                <p>Tea </p>

            </div>
            <div class="col-md-3 col-6 icon-item">
                <img src="{{ asset('images/coffee.jpg') }}" alt="Cup Coffee">
                <p>Breakfast</p>
            </div>
            <div class="col-md-3 col-6 icon-item">
                <img src="{{ asset('images/coffee.jpg') }}" alt="Dessert">
                <p>Desserts</p>
            </div>
            <div class="col-md-3 col-6 icon-item">
                <img src="{{ asset('images/coffee.jpg') }}" alt="Dessert">
                <p>Drinks</p>
            </div>
            <div class="col-md-3 col-6 icon-item">
                <img src="{{ asset('images/coffee.jpg') }}" alt="Dessert">
                <p>Extras</p>
            </div>
        </div>
    </div>
</section>
@endsection
