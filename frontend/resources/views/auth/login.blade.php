<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 16px;
        }

        .login-wrapper {
            min-height: 100vh;
        }
    </style>
</head>

<body>

<div class="container login-wrapper d-flex justify-content-center align-items-center">

    <div class="col-md-5 col-lg-4">

        <div class="card shadow-lg login-card">

            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <i class="bi bi-box-arrow-in-right fs-1 text-primary"></i>
                    <h3 class="mt-2">Login Sistem Laboratorium</h3>
                    <p class="text-muted mb-0">Silakan masuk untuk melanjutkan</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="/login">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>

                </form>

            </div>
        </div>

        <p class="text-center text-white mt-3 small">
            © {{ date('Y') }} Sistem Laboratorium
        </p>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>