// auth.js

document.addEventListener("DOMContentLoaded", function() {
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    // Ocultar el formulario de registro al cargar la página
    registerForm.style.display = 'none';

    // Manejar clic en el botón de login
    loginBtn.addEventListener('click', function() {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    });

    // Manejar clic en el botón de registro
    registerBtn.addEventListener('click', function() {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });
});
