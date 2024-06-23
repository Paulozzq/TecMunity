<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro - TecMunity</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="relative flex flex-col m-6 space-y-8 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0">
            <!-- Left side -->

            <div class="flex flex-col justify-center p-8 md:p-14">
                <span class="mb-3 text-4xl font-bold">Registro en TecMunity</span>
                <span class="font-light text-gray-400 mb-8">
                    Únete a TecMunity hoy mismo!
                </span>
             <form action='/register' method="POST">
                @csrf
                <div class="py-4">
                    <span class="mb-2 text-md">Nombre de usuario</span>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Nombre de usuario" name="username" value="{{ old('username') }}" />
                </div>
                <div class="py-4">
                    <span class="mb-2 text-md">Correo electrónico</span>
                    <input type="email" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Correo electrónico" name="email" value="{{ old('email') }}" />
                </div>
                <div class="py-4">
                    <span class="mb-2 text-md">Contraseña</span>
                    <input type="password" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Contraseña" name="password"  />
                </div>
                <div class="py-4">
                    <span class="mb-2 text-md">Confirmar contraseña</span>
                    <input type="password" class="w-full p-2 border border-gray-300 rounded-md placeholder-gray-500" placeholder="Confirmar contraseña" name="password_confirmation" />
                </div>
                <button class="w-full bg-black text-white p-2 rounded-lg mb-6 hover:bg-white hover:text-black hover:border hover:border-gray-300" >
                    Registrarse
                </button>
             </form>
                <div class="text-center text-gray-400">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}"> <b class="text-black">Inicia sesión aquí</b></a>
                </div>
                
             
            </div>
            <!-- Right side -->
            <div class="relative">
                <img src="img/Tecmunity_Logo.png" alt="TecMunity Logo" class="w-[400px] h-full hidden rounded-r-2xl md:block object-cover" />
                <!-- Text on image -->
                <div class="absolute hidden bottom-10 right-6 p-6 bg-white bg-opacity-30 backdrop-blur-sm rounded drop-shadow-lg md:block">
                    <!-- You can add any text or content here if needed -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
