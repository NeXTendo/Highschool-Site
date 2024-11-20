// Add interactive toggling functionality
const container = document.getElementById('container');
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const goToSignUp = document.getElementById('goToSignUp');
const goToSignIn = document.getElementById('goToSignIn');

// Add class for switching to Sign Up
signUpButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
});

goToSignUp.addEventListener('click', () => {
    container.classList.add('right-panel-active');
});

// Remove class for switching to Sign In
signInButton.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
});

goToSignIn.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
});
