<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --light-gray: #e9ecef;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
        }
        
        .container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 500px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), #a5b4fc);
        }
        
        h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 12px;
            text-align: center;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .mb-3 {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #555;
            font-size: 0.9rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid var(--light-gray);
            border-radius: var(--border-radius);
            transition: var(--transition);
            background-color: var(--secondary-color);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .form-control:disabled {
            background-color: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .input-group {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            background: none;
            border: none;
            font-size: 1rem;
        }
        
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            cursor: pointer;
            width: 100%;
        }
        
        .btn-primary {
            color: white;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.3);
        }
        
        .user-info {
            background-color: rgba(67, 97, 238, 0.05);
            border-radius: var(--border-radius);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 3px solid var(--primary-color);
        }
        
        .user-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .user-info-item:last-child {
            margin-bottom: 0;
        }
        
        .user-info-icon {
            color: var(--primary-color);
            margin-right: 0.5rem;
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }
        
        .user-info-text {
            font-weight: 500;
            word-break: break-all;
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        
        <div class="user-info">
            <div class="user-info-item">
                <span class="user-info-icon"><i class="fas fa-user"></i></span>
                <span class="user-info-text">{{ $user->name }}</span>
            </div>
            <div class="user-info-item">
                <span class="user-info-icon"><i class="fas fa-envelope"></i></span>
                <span class="user-info-text">{{ $user->email }}</span>
            </div>
        </div>
        
        <form action="{{ route('admin.updatePassword', $user->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('new_password')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="password-requirements">
                    Password should contain at least 8 characters with letters, numbers, and special characters.
                </div>
            </div>

            <div class="mb-3">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <div class="input-group">
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('new_password_confirmation')">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
    
    <script>
        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>