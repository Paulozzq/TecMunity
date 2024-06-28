<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <script>{{asset('js/app.js')}}</script>
    <style>
      
    </style>
    <title>Registro TecMunity</title>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 form-container">
            <!-- Imagen -->
          
            <!-- Formulario -->
            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold">Registro en TecMunity</span>
                <form id="registerForm" action="/register" method="POST">
                    @csrf
                    <div class="py-4">
                        <span class="mb-2 text-md">Nombre de usuario</span>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Nombre de usuario" name="username" id="username" value="{{ old('username') }}" />
                        <span id="usernameError" class="error-message hidden">Máximo 10 caracteres.</span>
                    </div>
                    <div class="py-4">
                        <span class="mb-2 text-md">Correo electrónico</span>
                        <input type="email" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="usuario@tecsup.edu.pe" name="email" id="email" value="{{ old('email') }}" />
                        <span id="emailError" class="error-message hidden">Debe ser un correo @tecsup.edu.pe.</span>
                    </div>
                    <div class="py-4">
                        <span class="mb-2 text-md">Contraseña</span>
                        <div class="relative">
                            <input type="password" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Contraseña" name="password" id="password" />
                            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM8 15a5 5 0 0110 0v2a3 3 0 01-3 3H11a3 3 0 01-3-3v-2z" />
                                </svg>
                            </button>
                        </div>
                        <span id="passwordError" class="error-message hidden">Debe tener al menos 8 caracteres.</span>
                    </div>
                    <div class="py-4">
                        <span class="mb-2 text-md">Confirmar contraseña</span>
                        <div class="relative">
                            <input type="password" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Confirmar contraseña" name="password_confirmation" id="password_confirmation" />
                            <button type="button" id="togglePasswordConfirmation" class="absolute inset-y-0 right-0 flex items-center pr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM8 15a5 5 0 0110 0v2a3 3 0 01-3 3H11a3 3 0 01-3-3v-2z" />
                                </svg>
                            </button>
                        </div>
                        <span id="passwordConfirmationError" class="error-message hidden">Las contraseñas no coinciden.</span>
                    </div>
                    
                    <button type="submit" class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300">
                        Registrarse
                    </button>


                </form>

                <div class="text-center text-gray-400">
                    Ya tienes una cuenta? Entonces
                    <a href="{{ route('login') }}"><span class="font-bold text-black">Inicia Sesion</span></a>
                </div>

                
            </div>
          

            <div class="relative">
                <img src="{{ asset('img/Tecmunity_Logo.png') }}" alt="img" class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover" />
            </div>
        </div>
       
    </div>

    

    <script>
        // Real-time validation
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
    </script>
    <script>
        // Función para alternar la visibilidad de la contraseña
        function togglePasswordVisibility(inputField, toggleButton) {
            const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
            inputField.setAttribute('type', type);
            toggleButton.classList.toggle('text-gray-400');
            toggleButton.classList.toggle('text-gray-600');
        }
    
        // Manejadores de eventos para los botones de alternar contraseña
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = this.querySelector('svg');
            togglePasswordVisibility(passwordInput, toggleButton);
        });
    
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordConfirmationInput = document.getElementById('password_confirmation');
            const toggleButton = this.querySelector('svg');
            togglePasswordVisibility(passwordConfirmationInput, toggleButton);
        });
    </script>
    
</body>
</html>
