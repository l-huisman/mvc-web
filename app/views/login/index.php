<?php
require_once '../app/models/User.php';
require_once '../app/repositories/UserRepository.php';
require_once '../app/services/Auth.php';
require_once '../app/services/Session.php';

# Initialize the session
$session = new Session();
$session->start();

# Include config file
require_once "../app/dbconfig.php";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

# Check if the user is already logged in, if yes then redirect him to welcome page
$auth = new Auth(new UserRepository($connection), $session);
if ($auth->isLoggedIn()) {
    include "../app/views/dashboard/index.php";
    exit;
}

# Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

# Processing form data when form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # Check if email is empty
    if (empty(clean($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    #Check if password is empty
    if (empty(clean($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    # Validate credentials
    if (empty($email_err) && empty($password_err)) {
        try {
            $auth->login($email, $password);
        } catch (Exception $e) {
            $password_err = $e->getMessage();
        }
    }
}

function clean($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/login-stylesheet.css">
    <link rel="shortcut icon" href="/favicons/d&d-favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body class="bg-image body-background">
    <section class="vh-100">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <div class="mb-md-3 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase text-center"><a href="home" class="text-decoration-none text-light">Dungeons and Dates</a></h2>
                                <p class="text-white-50 mb-5 text-center">Please enter your login and password!</p>
                                <form method="post">
                                    <div class="form-outline form-white mb-4 align-items-start <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" type="email" id="email" autocomplete="email" class="form-control form-control-lg" value="<?php echo $email; ?>" />
                                        <span class="help-block text-danger"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="form-outline form-white mb-4 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="password">Password</label>
                                        <input name="password" type="password" id="password" autocomplete="current-password" class="form-control form-control-lg current-password" />
                                        <span class="help-block text-danger"><?php echo $password_err; ?></span>
                                    </div>
                                    <p class="small mb-4 pb-lg-2"><a class="text-white-50" href="home">Forgot password?</a></p>
                                    <div class="d-flex justify-content-center ">
                                        <button class="btn btn-outline-light btn-lg" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <p class="mb-0 text-center">Don't have an account? <a href="/login/register" class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>