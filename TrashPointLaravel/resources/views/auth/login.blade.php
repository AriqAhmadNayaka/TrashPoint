<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TrashPoint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body {
            background-color: #f3f4f6; 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'figtree', sans-serif;
        }

        /* Logo TrashPoint di Tengah Atas */
        .brand-logo {
            font-size: 2.5rem;
            color: #218838;
            margin-bottom: 25px;
            text-decoration: none;
            font-weight: bold;
        }

        /* Kotak Login Putih Bersih */
        .login-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .form-label {
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            padding: 0.6rem;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #38c172;
            box-shadow: 0 0 0 3px rgba(56, 193, 114, 0.2);
            background-color: white;
        }

        /* Tombol Hitam ala Laravel Original */
        .btn-login {
            background-color: #1f2937;
            color: white;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background-color: #374151;
            color: white;
        }

        .form-check-label {
            font-size: 0.875rem;
            color: #6b7280;
        }

        a.forgot-password {
            font-size: 0.875rem;
            color: #6b7280;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <a href="{{ route('landing') }}" class="brand-logo">
        <i class="fas fa-trash-alt"></i> TrashPoint
    </a>

    <div class="login-card">
        <form action="{{ route('login.post') }}" method="POST">
            @csrf 
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="d-flex align-items: center justify-content: flex-end mt-4">
                <a href="#" class="forgot-password me-3">Forgot your password?</a>
                <button type="submit" class="btn btn-login">Log in</button>
            </div>
        </form>
    </div>

</body>
</html>