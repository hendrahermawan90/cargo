<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Link ke Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/c5/dd/ad/c5ddade72459420a66db7f16ae72c81f.jpg');
            color:rgb(255, 255, 255);
            font-family: 'Poppins', sans-serif; /* Seluruh body pakai Poppins */
        }

        .card {
            background-color: rgba(255, 243, 243, 0.47);
            color:rgba(255, 243, 243, 0.47);
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background-color: rgba(255, 243, 243, 0.47);
            color: #11468F; /* Judul di card-header lebih gelap biar kelihatan */
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            padding: 15px;
        }

        .card-header img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #11468F;
            border-color: #FFFFFF;
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #FFFFFF;
            border-color: #FFFFFF;
            color: #11468F;
        }

        .btn-link {
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        .btn-link:hover {
            color: #FFFFFF;
        }

        .form-label {
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        .form-control {
            color: #FFFFFF;
            background-color: #11468F;
            border: 1px solid #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }

        .form-control::placeholder {
            color: #FFFFFF;
        }

        .alert {
            color: #FFFFFF;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Register
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ url('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                            </div>

                            <div class="mb-4">
                            <label for="password_confirmation" class="form-label"></label>
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </div>              
                                
                            <div class="text-center mt-4">
                                <a href="{{ route('login') }}" class="btn btn-link">Already have an account? Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
