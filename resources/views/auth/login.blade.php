<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">Login</div>
                    <div class="card-body">

                        <p class="text-center">Akses Lebih Mudah Dengan Akun Google</p>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

             

                        <hr>

                        <!-- Form Login Biasa -->
                        <form method="POST" action="{{ url('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>


                                   <!-- Tombol Login Dengan Google -->
                                   <div class="d-grid mb-3 mt-1">
                            <a href="{{ url('auth/google') }}" class="btn btn-danger">
                                <i class="bi bi-google"></i> Login with Google
                            </a>
                        </div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('register') }}">Don't have an account? Register</a>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons (bi bi-google) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>
