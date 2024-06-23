<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div
          class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0"
        >
       
          <div class="flex flex-col justify-center p-8 md:p-14">
            <span class="mb-3 text-4xl font-bold">TecMunity</span>
            <span class="font-light text-gray-400 mb-8">
              Bienvenido a TecMunity, por favor inicia sesion!
            </span>
            <div class="py-4">
            <form action="/login" method="POST">
              @csrf   
              <span class="mb-2 text-md">Username o correo institucional</span>
              <input
                type="text"
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                name="username"
                id="email"
              />
            </div>
            <div class="py-4">
              <span class="mb-2 text-md">Contraseña</span>
              <input
                type="password"
                name="password"
                id="pass"
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
              />
            </div>
            <div class="flex justify-between w-full py-4">
              <div class="mr-24">
                <input type="checkbox" name="ch" id="ch" class="mr-2" />
                <span class="text-md">Permanecer conectado</span>
              </div>
              <span class="font-bold text-md">Olvide mi contraseña</span>
            </div>
            <button
              class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300"
            >
             Iniciar Sesion
            </button>
            </form>
           
            <div class="text-center text-gray-400">
              No tienes una cuenta?
              <a href="{{ route('registro') }}"><span class="font-bold text-black">Registrate gratis</span></a>
          </div>
          
          </div>
          <!-- {/* right side */} -->
          <div class="relative">
              <img src="{{ asset('img/Tecmunity_Logo.png') }}" alt="img" class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover" />
  
            <!-- text on image  -->
            <div
              class="absolute hidden bottom-10 right-6 p-6 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block"
            >
             
            </div>
          </div>
        </div>
      </div>
    </body>
  @if(session('success') == 'ok')
  <script>
      Swal.fire("Registro con exito!");
  </script>
  @endif
  
  @if(session('login_error'))
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Error de inicio de sesión',
          text: "{{ session('login_error') }}"
      });
  </script>
  @endif
  
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          const signInForm = document.querySelector('.sign-in-form');
  
          signInForm.addEventListener('submit', function (event) {
              const usernameOrEmailInput = signInForm.querySelector('input[name="username"]');
              const passwordInput = signInForm.querySelector('input[name="password"]');
              const value = usernameOrEmailInput.value;
              const isEmail = emailPattern.test(value);
              const isUsername = value.length > 0 && !isEmail;
  
              if (!isEmail && !isUsername) {
                  event.preventDefault();
                  Swal.fire({
                      icon: 'error',
                      title: 'Error en el ingreso de usuario o correo',
                      text: 'Por favor, ingresa un nombre de usuario o un correo electrónico válido de @tecsup.edu.pe'
                  });
              } else if (passwordInput.value.length < 8 || !validatePassword(passwordInput.value)) {
                  event.preventDefault();
                  Swal.fire({
                      icon: 'error',
                      title: 'Error en la contraseña',
                      text: 'La contraseña debe tener al menos 8 caracteres y cumplir con los criterios de seguridad.'
                  });
              }
          });
      });
  
      function validatePassword(password) {
      // Al menos 8 caracteres de longitud
      if (password.length < 8) {
          return false;
      }
  
      // Al menos una letra mayúscula
      if (!/[A-Z]/.test(password)) {
          return false;
      }
  
      // Al menos una letra minúscula
      if (!/[a-z]/.test(password)) {
          return false;
      }
  
      // Al menos un dígito
      if (!/\d/.test(password)) {
          return false;
      }
  
      // Al menos un carácter especial (por ejemplo, !@#$%^&*)
      if (!/[!@#$%^&*]/.test(password)) {
          return false;
      }
  
      // Cumple con todos los criterios
      return true;
  }
  </script>
  
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          const signUpButton = document.getElementById('sign-up-btn');
          const signInButton = document.getElementById('sign-in-btn');
          const container = document.querySelector('.container');
  
          signUpButton.addEventListener('click', () => {
              container.classList.add('sign-up-mode');
          });
  
          signInButton.addEventListener('click', () => {
              container.classList.remove('sign-up-mode');
          });
      });
  </script>
  
  </html>