<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Login Page</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5, #06b6d4);
            --body-bg: #0f172a;
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Background Animated Blobs */
        .bg-blob {
            position: absolute;
            width: 400px;
            height: 400px;
            background: var(--primary-gradient);
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            z-index: -1;
            animation: float 10s infinite alternate;
        }
        .blob-1 { top: -10%; left: -10%; }
        .blob-2 { bottom: -10%; right: -10%; animation-delay: 5s; }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(50px, 30px) scale(1.1); }
        }

        /* Login Card Custom Styling */
        .login-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            color: #f8fafc;
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease;
        }

        /* Form Inputs */
        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 12px;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #06b6d4;
            box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.15);
            color: #fff;
        }

        .form-floating > label {
            color: #94a3b8;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #06b6d4;
        }

        /* Advanced Input Icon Wrapper */
        .input-group-text {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            border-radius: 12px;
        }

        /* Custom Button */
        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: white;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #4338ca, #0891b2);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
            color: white;
        }

        /* Social Login Buttons */
        .btn-social {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #f8fafc;
            border-radius: 12px;
            padding: 0.6rem;
            transition: all 0.2s ease;
        }

        .btn-social:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #64748b;
            margin: 1.5rem 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .divider:not(:empty)::before { margin-right: .5em; }
        .divider:not(:empty)::after { margin-left: .5em; }

        a {
            color: #06b6d4;
            text-decoration: none;
            transition: color 0.2s;
        }
        a:hover { color: #22d3ee; }
    </style>
</head>
<body>

    <!-- Background Blobs for Visual Depth -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="login-card">

            <!-- Logo / Header -->
            <div class="mb-4 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info rounded-circle" style="width: 60px; height: 60px;">
                    <i class="bi bi-hexagon-fill fs-2"></i>
                </div>
                <h3 class="mb-1 fw-bold">Welcome Back</h3>
                <p class="text-muted small">Please enter your details to sign in</p>
            </div>

            @error('email')
    <div class="mt-2 text-danger">
        {{ $message }}
    </div>
@enderror

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm" autocomplete="off">
                 @csrf

                <!-- Email Field -->
                <div class="mb-3 form-floating">
                    <input type="email" class="form-control" id="emailInput" name="email"  placeholder="name@example.com" required>
                    <label for="emailInput"><i class="bi bi-envelope me-2"></i>Email address</label>
                </div>

                <!-- Password Field -->
                <div class="mb-3 form-floating position-relative">
                    <input type="password" class="form-control" id="passwordInput"  name="password" placeholder="Password" required>
                    <label for="passwordInput"><i class="bi bi-lock me-2"></i>Password</label>
                    <!-- Toggle Password Visibility Icon -->
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; z-index: 10; color: #94a3b8;" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="mb-4 d-flex justify-content-between align-items-center small">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" style="background-color: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                        <label class="form-check-label text-muted" for="rememberMe">Remember me</label>
                    </div>
                     @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="mb-3 btn btn-gradient w-100">
                    Sign In <i class="bi bi-arrow-right ms-2"></i>
                </button>

                <!-- Divider -->
                <div class="divider">Or continue with</div>

                <!-- Social Logins -->
                <div class="mb-4 row g-2">
                    <div class="col-6">
                        <button type="button" class="gap-2 btn btn-social w-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-google text-danger"></i> Google
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="gap-2 btn btn-social w-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-github"></i> Github
                        </button>
                    </div>
                </div>

            </form>

            <!-- Footer Links -->
            <div class="text-center small text-muted">
                Don't have an account? <a href="{{ route('register') }}">Sign up for free</a>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS for interactions -->
    <script>
        // Password visibility toggle logic
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle icons
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
