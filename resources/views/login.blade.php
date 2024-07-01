<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>TecMunity</title>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold">TecMunity</span>
                <span class="font-light text-gray-400 mb-8">
                    Bienvenido a TecMunity, por favor inicia sesión!
                </span>
              <div class="py-4">
                <form action="{{ route('loginpost') }}" method="POST">
                    @csrf
                    @csrf 
                        <span class="mb-2 text-md">Username o correo institucional</span>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" name="username" id="email" />
                    </div>
                    <div class="py-4">
                      <span class="mb-2 text-md">Contraseña</span>
                     <input type="password" name="password" id="pass" class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
                      <div class="mt-2">
                        <input type="checkbox" id="show-password" onclick="togglePassword()">
                        <label for="show-password" class="text-sm">Mostrar contraseña</label>
                      </div>
                      </div>
                <script>
                    function togglePassword() {
                        var passwordField = document.getElementById("pass");
                        if (passwordField.type === "password") {
                            passwordField.type = "text";
                        } else {
                            passwordField.type = "password";
                        }
                    }
                </script>
                <div class="flex justify-between w-full py-4">
                  <div class="mr-24">
                    <input type="checkbox" name="ch" id="ch" class="mr-2" />
                    <label for="ch" class="text-md">Permanecer conectado</label>
                </div>
             <a href=" {{route('password.request')}}">
                 <span class="font-bold text-md">Olvidé mi contraseña</span></a>
                </div>
                <button class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300">
                    Iniciar Sesión
                </button>
                    </form>
                <div class="text-center text-gray-400">
                    No tienes una cuenta?
                    <a href="{{ route('registro') }}"><span class="font-bold text-black">Regístrate gratis</span></a>
                </div>
            </div>
            <!-- Right side -->
            <div class="relative">
                <img src="{{ asset('img/Tecmunity_Logo.png') }}" alt="img" class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover" />
            </div>

            
        </div>
    </div>
    @if(session('success') == 'ok')
    <script>
        Swal.fire("Registro con éxito!");
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
</body>
</html>
