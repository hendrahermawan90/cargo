<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            background-image: url('https://i.pinimg.com/736x/c5/dd/ad/c5ddade72459420a66db7f16ae72c81f.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .card {
        background-color: rgba(255, 243, 243, 0.47);; /* Medium blue background with 80% opacity */
        color: rgba(17, 70, 143, 0.9); /* Set text inside card to white */
        border-radius: 15px; /* Rounded corners for a smoother look */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Add shadow for better visibility */
    }

    .card-header {
        background-color: rgba(255, 243, 243, 0.47);; /* Slightly less transparent for the header */
        color: rgba(17, 70, 143, 0.9); /* Set text inside card header to white */
        text-align: center; /* Center-align the text */
        font-size: 1.5rem; /* Increase font size for better readability */
        font-weight: bold; /* Make the text bold */
        padding: 15px; /* Add padding for spacing */
    }

        .card-header img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color:rgba(17, 70, 143, 0.9);
            border-color:rgba(17, 70, 143, 0.9)
            font-size: 1rem;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color:rgb(255, 255, 255);
            border-color:rgb(255, 255, 255);
            transform: scale(1.05);
        }

        .btn-link {
            color:rgb(255, 255, 255);
            font-weight: bold;
            text-decoration: none;
        }

        .btn-link:hover {
            color:rgb(255, 255, 255);
            text-decoration: underline;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                       
                        Log-in
                    </div>
                    <div class="card-body">
                        <?php if (session('success')): ?>
                            <div class="alert alert-success">
                                <?= session('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors->all() as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                            <div class="text-center mt-3">
                                <a href="<?= route('register') ?>" class="btn btn-link">Don't have an account? Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>