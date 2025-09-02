<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pandu Ciomas - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9f9;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            width: 400px;
            border-radius: 20px;
            box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
        }
        .logo {
            width: 80px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="card login-card p-4">
        <div class="text-center">
            <!-- Ganti logo.png dengan logo sistem Anda -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sistem" class="logo">
            <h3 class="mb-3">PANDU CIOMAS</h3>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email / Username</label>
                <input type="text" name="email" id="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <small>© {{ date('Y') }} Pandu Ciomas</small>
        </div>
    </div>
</body>
</html>
