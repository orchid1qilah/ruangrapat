<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-card {
            background: #F6FBF9;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .login-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .login-subtitle {
            text-align: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .form-control {
            border-radius: 8px;

            
        }

        .btn-primary {
            border-radius: 8px;
            background-color: #33c4c8;
            border-color: #33c4c8;
        }

        .btn-primary:hover {
            background-color: #2da6a8;
            border-color: #2da6a8;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h1 class="login-title">Login</h1>
            <p class="login-subtitle">Peminjaman Ruang Rapat</p>
            <form action="/login/authenticate" method="post">
    <div class="mb-3">
        <input type="text" class="form-control" name="nik" placeholder="Nik" required>
    </div>
    <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
    <div class="mb-3">
        <select class="form-select" name="company" required>
            <option value="" selected disabled>Company</option>
            <option value="Company 1">Company 1</option>
            <option value="Company 2">Company 2</option>
            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
        </select>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>

            <div class="footer">© 2024 Group of Manifacture</div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>