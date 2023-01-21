<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/old-login-stylesheet.css">
    <link rel="shortcut icon" href="/favicons/d&d-favicon.png" type="image/x-icon">
    <title>Login</title>
    <script src="js/switchtab.js"></script>
</head>

<body class="body-background">
    <div class="login-card vertical-center">
        <h1>Dungeons and Dates</h1>
        <div class="sign-up-in-container">
            <button class="sign-in-tab active-tab">Sign In</button>
            <button class="sign-up-tab">Sign Up</button>
        </div>
        <form class="sign-in-form active-form">
            <div
             class="form-header">
                <h2>Login</h2>
            </div>
            <div class="form-body">
                <input type="email" placeholder="Email" autocomplete="email">
                <input type="password" placeholder="Password" autocomplete="current-password">
            </div>
            <button class="login-button">Submit</button>
        </form>
        <form class="sign-up-form">
            <div class="form-header">
                <h2>Sign Up</h2>
            </div>
            <div class="form-body">
                <input type="text" placeholder="Username" autocomplete="username">
                <input type="email" placeholder="Email" autocomplete="email">
                <input type="password" placeholder="Password" autocomplete="new-password" inputmode="verbatim">
                <input type="password" placeholder="Confirm Password" autocomplete="new-password" inputmode="verbatim">
            </div>
            <button class="login-button">Submit</button>
        </form>
    </div>
</body>

</html>