<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            padding: 2rem 0;
        }

        /* Background Animated Blobs */
        .bg-blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary-gradient);
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.12;
            z-index: -1;
            animation: float 12s infinite alternate;
        }
        .blob-1 { top: -10%; right: -10%; }
        .blob-2 { bottom: -10%; left: -10%; animation-delay: 6s; }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(-40px, -40px) scale(1.15); }
        }

        /* Register Card Custom Styling */
        .register-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            color: #f8fafc;
            width: 100%;
            max-width: 550px; /* Thoda wide rakha hai form fields ke liye */
        }

        /* Form Inputs & Select */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 12px;
            padding: 0.75rem 1rem;
        }

        /* Dropdown options fix for dark theme */
        .form-select option {
            background-color: #1e293b;
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #06b6d4;
            box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.15);
            color: #fff;
        }

        .form-floating > label {
            color: #94a3b8;
        }

        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label,
        .form-floating > .form-select ~ label {
            color: #06b6d4;
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

        a {
            color: #06b6d4;
            text-decoration: none;
            transition: color 0.2s;
        }
        a:hover { color: #22d3ee; }
    </style>
</head>

<body>

    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="register-card">

            <div class="mb-4 text-center">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-plus-fill fs-2" style="color: #06b6d4;"></i>
                </div>
                <h3 class="mb-1 fw-bold">Create Account</h3>
                <p class="text-muted small">Join us by creating your new account</p>
            </div>

            <form method="POST" action="{{ route('register') }}" id="registerForm" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="nameInput" name="name"  placeholder="John Doe" required>
                    <label for="nameInput"><i class="bi bi-user me-2"></i>Full Name</label>
                    <div class="invalid-feedback">Please enter your name.</div>
                </div>

                <div class="mb-3 form-floating">
                    <input type="email" class="form-control" id="emailInput" name="email" placeholder="name@example.com" required>
                    <label for="emailInput"><i class="bi bi-envelope me-2"></i>Email address</label>
                    <div class="invalid-feedback">Please enter a valid email.</div>
                </div>

                <div class="mb-3 form-floating">
                   <select class="form-select" id="roleSelect" name="role" required>

    <option value="" selected disabled hidden>
        Choose your role...
    </option>

    <option value="customer">
        Customer
    </option>


    @if(request()->type == 'seller')

        <option value="super-admin">Super Admin</option>
        <option value="admin">Admin</option>
         <option value="vendor">Vendor</option>

    @endif


</select>
                    <label for="roleSelect"><i class="bi bi-shield-lock me-2"></i>Select Role</label>
                    <div class="invalid-feedback">Please select an account type.</div>
                </div>

                <div class="mb-3 form-floating position-relative">
                    <input type="password" class="form-control" id="passwordInput"  name="password" placeholder="Password" required minlength="6">
                    <label for="passwordInput"><i class="bi bi-lock me-2"></i>Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; z-index: 10; color: #94a3b8;" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </span>
                    <div class="invalid-feedback">Password must be at least 6 characters.</div>
                </div>

                 <div class="mb-3 form-floating position-relative">
                    <input type="password" class="form-control"  name="password_confirmation" required autocomplete="new-password" id="passwordConfirmationInput" placeholder="Confirm Password" minlength="6">
                    <label for="passwordConfirmationInput"><i class="bi bi-lock me-2"></i>Confirm Password</label>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer; z-index: 10; color: #94a3b8;" id="togglePasswordConfirmation">
                        <i class="bi bi-eye" id="eyeIconConfirmation"></i>
                    </span>
                    <div class="invalid-feedback">Password must be at least 6 characters.</div>
                </div>

                <div class="mb-4 form-check small">
                    <input class="form-check-input" type="checkbox" id="termsCheck" style="background-color: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);" required>
                    <label class="form-check-label text-muted" for="termsCheck">
                        I agree to the <a href="#">Terms & Conditions</a>
                    </label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                </div>

                <button type="submit" class="mb-3 btn btn-gradient w-100">
                    Register Now <i class="bi bi-check-circle ms-2"></i>
                </button>

            </form>

            <div class="text-center small text-muted">
                Already have an account? <a href="index.html">Sign In</a>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password visibility toggle logic
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passwordInput');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.classList.toggle('bi-eye');
            eyeIcon.classList.toggle('bi-eye-slash');
        });

        // Bootstrap 5 Form Validation
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>
</html>
