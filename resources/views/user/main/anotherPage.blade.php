@extends('user.layouts.master')

@section('container')
    <!-- Cover Section (Hero) -->
    <!-- Hero Section (Carousel) -->
    <section class="hero-bg">
        <div class="slide-container">
            <div class="slide active" style="background-image: url({{ asset('images/coffee/cappucino.jpg') }});">
                <div class="overlay"></div>
                <div class="container h-100 d-flex align-items-center justify-content-center hero-content">
                    <div class="text-center text-white">
                        <h2 class="mb-3 display-6 fw-bold">Welcome to Caffeine Corner</h2>
                        <h1 class="mb-4 display-3 fw-bold fs-1">We Serve the Richest Coffee in the City!</h1>
                        <a href="{{ route('user.menu') }}" class="px-5 py-3 btn btn-custom btn-lg">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url({{ asset('images/coffee/americano.jpg') }});">
                <div class="overlay"></div>
                <div class="container h-100 d-flex align-items-center justify-content-center hero-content">
                    <div class="text-center text-white">
                        <h2 class="mb-3 display-6 fw-bold">Welcome to Caffeine Corner</h2>
                        <h1 class="mb-4 display-3 fw-bold fs-1">We Serve the Richest Coffee in the City!</h1>
                        <a href="{{ route('user.menu') }}" class="px-5 py-3 btn btn-custom btn-lg">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url({{ asset('images/coffee.jpg') }});">
                <div class="overlay"></div>
                <div class="container h-100 d-flex align-items-center justify-content-center hero-content">
                    <div class="text-center text-white">
                        <h2 class="mb-3 display-6 fw-bold">Welcome to Caffeine Corner</h2>
                        <h1 class="mb-4 display-3 fw-bold fs-1">We Serve the Richest Coffee in the City!</h1>
                        <a href="{{ route('user.menu') }}" class="px-5 py-3 btn btn-custom btn-lg">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Locations Section -->
    <section class="py-5 " style="background-color: #f5e8d8">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">Our Locations</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="border-0 shadow-sm card h-100">
                        <img src="{{ asset('images/locations/12263fbd03865791c137ff6eba779289.jpg') }}" class="card-img-top img-fluid location-image" alt="Yangon Cafe">
                        <div class="text-center card-body">
                            <h5 class="card-title fw-semibold">Yangon Cafe</h5>
                            <p class="card-text text-muted">Visit our Yangon location for the best coffee experience.</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="border-0 shadow-sm card h-100">
                        <img src="{{ asset('images/locations/cafeMandalay.jpg') }}" class="card-img-top img-fluid location-image" alt="Mandalay Cafe">
                        <div class="text-center card-body">
                            <h5 class="card-title fw-semibold">Mandalay Cafe</h5>
                            <p class="card-text text-muted">Visit our Mandalay location for the best coffee experience.</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="border-0 shadow-sm card h-100">
                        <img src="{{ asset('images/locations/pyinOoLwinCafe.jpg') }}" class="card-img-top img-fluid location-image" alt="PyinOoLwin Cafe">
                        <div class="text-center card-body">
                            <h5 class="card-title fw-semibold">PyinOoLwin Cafe</h5>
                            <p class="card-text text-muted">Visit our PyinOoLwin location for the best coffee experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Icons Section (Menu Highlights) -->

    <section class="py-5 icons-section ">
        <div class="container">
            <h2 class="py-2 mb-4 text-center fw-bold">Our Menus</h2>
            <div class="text-center row row-cols-2 row-cols-md-3 g-4">
                @foreach ($categories as $category)
                    <div class="col">
                     <a href="{{ route('user.blogs') }}" class=" text-decoration-none">

                        <div class="border-0 shadow-sm card h-100 position-relative" data-description="{{ $category['description'] ?? 'No description available' }}">
                            <img src="{{ asset('storage/' . $category['image']) }}" class="card-img-top img-fluid rounded-top" alt="{{ $category['name'] }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text fw-semibold text-dark fs-5">{{ $category['name'] }}</p>
                            </div>
                            <!-- Hover Description Overlay -->
                            <div class="top-0 p-3 text-center text-white bg-opacity-75 card-description-overlay position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark" style="z-index: 1;">
                                <p class="mb-0 fs-6">{{ Str::words($category['description'] ?? 'No description available', 20, '...') }}</p>                            </div>
                        </div>
                     </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="my-4 text-center">
        <a href="{{ route('user.blogs') }}" class="steam-cta text-decoration-none animate__animated animate__bounceIn animate__infinite">
            <span class="text-white fw-bold fs-4" style="background-color: #8B4513; padding: 15px 30px; border-radius: 30px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); position: relative; overflow: hidden;">
                Discover Our Menu
                <span class="steam" style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); font-size: 20px; opacity: 0.5;">☕</span>
            </span>
        </a>
    </div>
    <style>
        .steam-cta {
            transition: transform 0.6s ease-in-out; /* Smooth but not instant hover */
            animation: gentleBounce 4s infinite ease-in-out; /* Slow, subtle bounce */
        }
        .steam-cta:hover {
            transform: scale(1.1);
        }
        .steam {
            animation: steamRise 5s infinite ease-in-out; /* Calm, flowing steam */
        }
        @keyframes steamRise {
            0% { opacity: 0.6; top: -10px; }
            50% { opacity: 0.9; top: -25px; } /* Gentle peak */
            100% { opacity: 0; top: -40px; } /* Fades out smoothly */
        }
        @keyframes gentleBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); } /* Subtle lift */
        }
    </style>
    <!-- Logout Button (Optional, Uncomment if Needed) -->
    {{-- <section class="py-3 text-center">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </section> --}}

    <!-- Bootstrap CSS (ensure this is in your master layout) -->
    <!-- In the <head> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- At the end of the <body> -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script>
    document.querySelectorAll('.card').forEach(card => {
        const overlay = card.querySelector('.card-description-overlay');

        card.addEventListener('mouseenter', () => {
            gsap.to(overlay, {
                opacity: 1,
                y: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        card.addEventListener('mouseleave', () => {
            gsap.to(overlay, {
                opacity: 0,
                y: 20,
                duration: 0.3,
                ease: 'power2.in'
            });
        });
    });
</script>
    <script>
        // Initialize the carousel with a 5-second interval (5000 milliseconds)
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    if (i === index) {
                        slide.classList.add('active');
                    }
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            // Start the sliding every 5 seconds
            setInterval(nextSlide, 3000);

            // Optionally, allow manual navigation (e.g., clicking indicators or arrows)
            // You can add this later if desired

        });
    </script>
@endsection
