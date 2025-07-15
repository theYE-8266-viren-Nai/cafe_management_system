<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Caffeine Corner</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            overflow-y: auto;
            background-color: #f5e8d8;
            font-family: 'Poppins', sans-serif;
            color: #3d2b23;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 100vh;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .promo-section {
            flex: 1;
            background: url({{ asset('images/cafeBg.jpg') }}) no-repeat center center/cover;
            position: relative;
            padding: 40px;
            color: #fff;
        }
        .promo-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }
        .promo-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }
        .promo-content h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #8B4513;
            margin-bottom: 10px;
        }
        .promo-content p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-section h3 {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #8B4513;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-family: 'Poppins', sans-serif;
            color: #8B4513;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }
        .input-group {
            display: flex;
            align-items: center;
            border: 1px solid #D2B48C;
            border-radius: 5px;
            overflow: hidden;
        }
        .input-group-text {
            background-color: #D2B48C;
            color: #fff;
            border: none;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .form-control {
            flex: 1;
            padding: 10px;
            border: none;
            font-family: 'Poppins', sans-serif;
            outline: none;
        }
        .invalid-feedback {
            color: #8B4513;
            font-size: 0.875rem;
            display: none;
        }
        .form-control:invalid + .invalid-feedback {
            display: block;
        }
        .form-control:invalid {
            border-color: #8B4513;
        }
        .btn {
            background-color: #8B4513;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #6B2F0E;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(139, 69, 19, 0.3);
        }
        .alt-link {
            font-family: 'Playfair Display', serif;
            color: #D2B48C;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
            margin-top: 20px;
            display: block;
        }
        .alt-link:hover {
            color: #A67B5B;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                min-height: auto;
            }
            .promo-section, .form-section {
                flex: none;
                width: 100%;
                padding: 20px;
            }
            .promo-content h2 {
                font-size: 1.5rem;
            }
            .form-section h3 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="promo-section">
            <div class="promo-content">
                <h2>Welcome to Caffeine Corner</h2>
                <p>"We've been using our coffee blends to kick start every day and can’t imagine starting without it."</p>
                <p style="font-style: italic; color: #fff;">- Barista Team, Caffeine Corner</p>
            </div>
        </div>
        <div class="form-section">
            <h3>Create an Account</h3>
            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input class="form-control" type="text" name="name" placeholder="Username" value="{{ old('username') }}" required>
                    </div>
                    <div class="invalid-feedback">Username is required.</div>
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input class="form-control" type="text" name="phone" placeholder="Phone" value="{{ old('number') }}" required>
                    </div>
                    <div class="invalid-feedback">Phone is required.</div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input class="form-control" type="text" name="address" placeholder="Address" value="{{ old('address') }}" required>
                    </div>
                    <div class="invalid-feedback">Address is required.</div>
                </div>

                <div class="form-group">
                    <label>Profile Picture</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-camera"></i></span>
                        <input class="form-control" type="file" id="profile_photo_path" name="profile_photo_path" accept="image/*" required>
                    </div>
                    <div class="invalid-feedback">Profile picture is required.</div>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="invalid-feedback">Please provide a valid email address.</div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="invalid-feedback">Password is required.</div>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="invalid-feedback">Confirm password is required.</div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn">Create Account</button>
                </div>
            </form>
            <a href="{{ route('auth#login') }}" class="alt-link">Already have an account? Log In</a>

            <div class="mt-5" style="max-height: none;">
                <p>Welcome to Caffeine Corner! By registering, you agree to our Terms of Service and Privacy Policy, ensuring a secure and enjoyable experience.</p>
                <p>Create your account to unlock exclusive offers, such as discounts on your favorite coffee blends and early access to new seasonal flavors.</p>
                <p>We prioritize your privacy. Your personal details are used to enhance your shopping experience and will never be shared without your consent.</p>
                <p>Enjoy benefits like a personalized coffee profile and loyalty rewards as a registered member of our community.</p>
                <p>Need help? Contact our support team at support@caffeinecorner.com or visit our FAQ page for more information.</p>
                <p>Thank you for joining Caffeine Corner. We’re excited to brew your perfect coffee experience!</p>
            </div>
        </div>
    </div>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByTagName('form');
                for (var i = 0; i < forms.length; i++) {
                    forms[i].addEventListener('submit', function(event) {
                        var inputs = this.getElementsByTagName('input');
                        var isValid = true;
                        for (var j = 0; j < inputs.length; j++) {
                            if (inputs[j].hasAttribute('required') && !inputs[j].value) {
                                isValid = false;
                                inputs[j].classList.add('invalid');
                                var feedback = inputs[j].nextElementSibling;
                                if (feedback && feedback.classList.contains('invalid-feedback')) {
                                    feedback.style.display = 'block';
                                }
                            } else {
                                inputs[j].classList.remove('invalid');
                                var feedback = inputs[j].nextElementSibling;
                                if (feedback && feedback.classList.contains('invalid-feedback')) {
                                    feedback.style.display = 'none';
                                }
                            }
                        }
                        if (!isValid) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                    }, false);
                }
            }, false);
        })();
    </script>
</body>
</html>
