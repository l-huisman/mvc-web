function toggleTab(button, form) {
    // If the button is not active, make it active
    if (!button.classList.contains('active-tab')) {
        button.classList.add('active-tab');
    }
    // If the form is not active, make it active
    if (!form.classList.contains('active-form')) {
        form.classList.add('active-form');
    }
}

function switchTabs(activeButton, inactiveButton, activeForm, inactiveForm) {
    // Make the active button and form active
    toggleTab(activeButton, activeForm);
    // Make the inactive button and form inactive
    inactiveButton.classList.remove('active-tab');
    inactiveForm.classList.remove('active-form');
}

window.onload = function() {
    // Get the sign in and sign up buttons
    const signInButton = document.querySelector('.sign-in-tab');
    const signUpButton = document.querySelector('.sign-up-tab');
    const signInForm = document.querySelector('.sign-in-form');
    const signUpForm = document.querySelector('.sign-up-form');

    // Add click event listeners to the buttons
    signInButton.addEventListener('click', () => {
        switchTabs(signInButton, signUpButton, signInForm, signUpForm);
    });

    signUpButton.addEventListener('click', () => {
        switchTabs(signUpButton, signInButton, signUpForm, signInForm);
    });
};
