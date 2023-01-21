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

$auth = new Auth(new UserRepository($connection), $session);

# Define variables and initialize with empty values
$email = $password = $username = $password_confirm = $type = "";
$email_err = $password_err = $username_err = $password_confirm_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim(htmlspecialchars($_POST["username"])))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim(htmlspecialchars($_POST["username"]));
    }

    # Check if email is empty
    if (empty(trim(htmlspecialchars($_POST["email"])))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim(htmlspecialchars($_POST["email"]));
    }

    #Check if password is empty
    if (empty(trim(htmlspecialchars($_POST["password"])))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim(htmlspecialchars($_POST["password"]));
    }

    #Check if password confirmation is empty
    if (empty(trim(htmlspecialchars($_POST["password"])))) {
        $password_confirm_err = "Please confirm your password.";
    } else {
        $password_confirm = trim(htmlspecialchars($_POST["password"]));
    }

    #Check if passwords match
    if ($password != $password_confirm) {
        $password_confirm_err = "Passwords do not match.";
    }

    # Set $type
    if (isset($_POST["type"])) {
        $type = $_POST["type"];
    }

    # Validate credentials
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($password_confirm_err)) {
        try {
            $auth->register($username, $email, $password, $type);
            include "../app/views/login/index.php";
            exit;
        } catch (Exception $e) {
            $password_err = $e->getMessage();
        }
    }
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
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <button class="btn btn-dark m-2" style="width: 64px;" type="button"><a class="text-white" href="/login/index"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                                </svg></a></button>
                        <div class="card-body p-4 px-5">
                            <div class="mb-md-2 mt-md-1">
                                <h2 class="fw-bold mb-1 text-uppercase text-center"><a href="home" class="text-decoration-none text-light">Dungeons and Dates</a></h2>
                                <p class="text-white-50 mb-2 text-center">Please enter your login and password!</p>
                                <form method="post">
                                    <div class="form-outline form-white mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="username">Username</label>
                                        <input name="username" type="text" id="username" class="form-control form-control-lg" value="<?php echo $username; ?>" />
                                        <span class="help-block text-danger"><?php echo $username_err; ?></span>
                                    </div>
                                    <div class="form-outline form-white mb-3 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="email">Email</label>
                                        <input name="email" type="email" id="email" class="form-control form-control-lg" value="<?php echo $email; ?>" />
                                        <span class="help-block text-danger"><?php echo $email_err; ?></span>
                                    </div>
                                    <div class="form-outline form-white mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="new-password">Password</label>
                                        <input name="password" type="password" id="password" autocomplete="new-password" class="form-control form-control-lg" inputmode="verbatim" />
                                        <span class="help-block text-danger"><?php echo $password_err; ?></span>
                                    </div>
                                    <div class="form-outline form-white mb-3 <?php echo (!empty($password_confirm_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="new-pasword">Confirm Password</label>
                                        <input name="password" type="password" id="password" autocomplete="new-password" class="form-control form-control-lg" inputmode="verbatim" />
                                        <span class="help-block text-danger"><?php echo $password_confirm_err; ?></span>
                                    </div>
                                    <div class="form-outline form-white mb-3">
                                        <label class="form-label" for="type">Role</label>
                                        <select name="type" id="type" class="form-control form-control-lg">
                                            <option value="0">Player</option>
                                            <option value="1">Dungeon Master</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-outline-light btn-lg" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>