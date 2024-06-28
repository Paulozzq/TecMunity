const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
document.addEventListener('DOMContentLoaded', function () {
  const togglePasswordIcons = document.querySelectorAll('.toggle-password');
  
  togglePasswordIcons.forEach(icon => {
      icon.addEventListener('click', function () {
          const passwordField = this.previousElementSibling;
          const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordField.setAttribute('type', type);
          this.classList.toggle('fa-eye-slash');
      });
  });
});

document.getElementById('username').addEventListener('input', function() {
    const username = this;
    const usernameError = document.getElementById('usernameError');

    if (username.value.length > 10) {
        username.classList.add('error', 'shake');
        usernameError.classList.remove('hidden');
    } else {
        username.classList.remove('error', 'shake');
        usernameError.classList.add('hidden');
    }
});

document.getElementById('email').addEventListener('input', function() {
    const email = this;
    const emailError = document.getElementById('emailError');
    const tecsupEmailPattern = /^[a-zA-Z0-9._%+-]+@tecsup\.edu\.pe$/;

    if (!tecsupEmailPattern.test(email.value)) {
        email.classList.add('error', 'shake');
        emailError.classList.remove('hidden');
    } else {
        email.classList.remove('error', 'shake');
        emailError.classList.add('hidden');
    }
});

document.getElementById('password').addEventListener('input', function() {
    const password = this;
    const passwordError = document.getElementById('passwordError');

    if (password.value.length < 8) {
        password.classList.add('error', 'shake');
        passwordError.classList.remove('hidden');
    } else {
        password.classList.remove('error', 'shake');
        passwordError.classList.add('hidden');
    }
});

document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password');
    const passwordConfirmation = this;
    const passwordConfirmationError = document.getElementById('passwordConfirmationError');

    if (password.value !== passwordConfirmation.value) {
        passwordConfirmation.classList.add('error', 'shake');
        passwordConfirmationError.classList.remove('hidden');
    } else {
        passwordConfirmation.classList.remove('error', 'shake');
        passwordConfirmationError.classList.add('hidden');
    }
});

// Final validation on form submission
document.getElementById('registerForm').addEventListener('submit', function(event) {
    let isValid = true;

    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');

    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const passwordConfirmationError = document.getElementById('passwordConfirmationError');

    // Username validation
    if (username.value.length > 10) {
        username.classList.add('error', 'shake');
        usernameError.classList.remove('hidden');
        isValid = false;
    }

    // Email validation
    const tecsupEmailPattern = /^[a-zA-Z0-9._%+-]+@tecsup\.edu\.pe$/;
    if (!tecsupEmailPattern.test(email.value)) {
        email.classList.add('error', 'shake');
        emailError.classList.remove('hidden');
        isValid = false;
    }

    // Password validation
    if (password.value.length < 8) {
        password.classList.add('error', 'shake');
        passwordError.classList.remove('hidden');
        isValid = false;
    }

    // Password confirmation validation
    if (password.value !== passwordConfirmation.value) {
        passwordConfirmation.classList.add('error', 'shake');
        passwordConfirmationError.classList.remove('hidden');
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});