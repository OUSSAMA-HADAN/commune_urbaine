<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AUTHENTIFICATION</title>
    <!-- Bootstrap CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Custom Styles -->
    <style>
        .bg-cover {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .form-control {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
            padding: 12px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
            background-color: white;
        }
        
        .btn-primary {
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.2);
        }
        
        .login-title {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .form-floating > label {
            padding: 12px;
        }
        
        .logo-pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body class="overflow-hidden">
    <div class="position-absolute top-0 start-0 m-4 z-3">
        <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="img-fluid logo-pulse" style="height: 80px; filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.5));">
    </div>

    <!-- Background Image with Overlay -->
    <div class="container-fluid vh-100 bg-cover position-relative" style="background-image: url('{{ asset('storage/images/oujda_bg.png') }}');">
        <!-- Overlay with gradient -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);"></div>

        <!-- Content -->
        <div class="position-relative z-2">
            <!-- Title -->
            <h1 class="text-center text-white fw-bold display-3 pt-5 mb-0 login-title" style="font-family: 'Montserrat', sans-serif;">AUTHENTIFICATION</h1>

            <!-- Login Form -->
            <div class="d-flex justify-content-center align-items-center vh-95 mt-4">
                <div class="glass-effect p-4 w-100" style="max-width: 400px;">
                    <h2 class="text-center fw-bold mb-4 text-white">LOGIN</h2>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                                <label for="email">Email address</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="remember">
                            <label class="form-check-label text-white" for="remember">
                                Remember me
                            </label>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary py-3">Sign In</button>
                        </div>
                        
                        <div class="text-center text-white">
                            <a href="#" class="text-white text-decoration-none">Forgot password?</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            
        </div>
        <div class="position-absolute bottom-0 start-0 w-100 text-center text-white pb-3">
                <p class="mb-0">&copy; 2025 All Rights Reserved</p>
            </div>
    </div>
</body>
</html>