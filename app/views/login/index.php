<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/css/login-stylesheet.css">
    <link rel="shortcut icon" href="../../../public/favicons/d&d-favicon.png" type="image/x-icon">
    <title>Login</title>
</head>

<body class="body-background">
    <div class="login-card vertical-center">
        <h1>Dungeons and Dates</h1>
        <div class="sign-up-in-container">
            <button class="sign-in-tab active-tab">Sign In</button>
            <button class="sign-up-tab">Sign Up</button>
        </div>
        <form class="sign-in-form active-form">
            <div class="form-header">
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

<script>
    // Get the sign in and sign up buttons
    const signInButton = document.querySelector('.sign-in-tab');
    const signUpButton = document.querySelector('.sign-up-tab');
    const signInForm = document.querySelector('.sign-in-form');
    const signUpForm = document.querySelector('.sign-up-form');

    // Add click event listeners to the buttons
    signInButton.addEventListener('click', () => {
        // If the sign in button is not active, make it active
        if (!signInButton.classList.contains('active-tab')) {
            signUpButton.classList.remove('active-tab');
            signInButton.classList.add('active-tab');
        }
        if (!signInForm.classList.contains('active-form')) {
            signUpForm.classList.remove('active-form');
            signInForm.classList.add('active-form');
        }
    });

    signUpButton.addEventListener('click', () => {
        // If the sign up button is not active, make it active
        if (!signUpButton.classList.contains('active-tab')) {
            signInButton.classList.remove('active-tab');
            signUpButton.classList.add('active-tab');
        }
        if (!signUpForm.classList.contains('active-form')) {
            signInForm.classList.remove('active-form');
            signUpForm.classList.add('active-form');
        }
    });
</script>