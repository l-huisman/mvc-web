<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home-stylesheet.css">
    <link rel="shortcut icon" href="favicons/d&d-favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Login</title>
</head>

<body class="bg-image body-background" style="height: 100vh;">

    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark pt-5 pb-4">
        <div class="container-xxl">
            <a class="navbar-brand" href="#intro">
                <span class="text-light fw-bold">
                    Dungeons & Dates
                </span>
            </a>
            <!-- toggle button for mobile nav -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- navbar links -->
            <div class="collapse navbar-collapse justify-content-end align-center" id="main-nav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#topics">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item d-md-none">
                        <a class="nav-link" href="login">Sign In</a>
                    </li>
                    <li class="nav-item ms-2 d-none d-md-inline">
                        <a class="btn btn-outline-light bg-dark" href="login">Sign In</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- intro -->

    <section id="intro">
        <div class="container-lg mt-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5 text-center text-md-start text-light">
                    <h1>
                        <div class="display-2">Dungeons & Dates</div>
                        <div class="display-5">Session schedular</div>
                    </h1>
                    <p class="lead my-4">Never miss another session again!</p>
                    <a href="login" class="btn btn-outline-light bg-dark btn-lg">Sign In</a>
                </div>
                <div class="col-md-5 text-center d-none d-md-block">
                </div>
            </div>
        </div>
    </section>

    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>