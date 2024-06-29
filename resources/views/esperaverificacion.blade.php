<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esperando verificación</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
        .slide-in {
            animation: slideIn 1s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto max-w-3xl mt-16 p-8 bg-white rounded-lg shadow-lg text-center fade-in">
        <img src="{{asset('img/Tecmunity_Logo1.png')}}" alt="Tecmunity Logo" class="mx-auto w-32 h-32">
        <h1 class="text-4xl font-semibold text-gray-800 mt-6">Esperando verificación</h1>
        <p class="text-gray-600 mt-4 text-lg">¡Gracias por registrarte! Hemos enviado un correo electrónico a tu dirección de correo electrónico. Por favor, verifica tu correo electrónico para completar el proceso de registro.</p>
        
        <div class="mt-8 space-y-6 slide-in">
            <div class="text-left p-4 bg-gray-50 rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-700">¿Por qué unirse a Tecmunity?</h2>
                <p class="text-gray-600 mt-2">Tecmunity es la plataforma perfecta para conectarte con otros entusiastas de la tecnología. Aquí puedes compartir tus ideas, participar en debates interesantes y mantenerte actualizado con las últimas tendencias tecnológicas.</p>
            </div>
            
            <div class="text-left p-4 bg-gray-50 rounded-lg shadow">
                <h2 class="text-2xl font-bold text-gray-700">Beneficios de ser miembro</h2>
                <ul class="list-disc list-inside text-gray-600 mt-2">
                    <li>Acceso a contenido exclusivo</li>
                    <li>Participación en eventos y webinars</li>
                    <li>Conexión con expertos del sector</li>
                    <li>Recibir noticias y actualizaciones personalizadas</li>
                </ul>
            </div>
        </div>
        
        <a href={{route('login')}} class="mt-8 inline-block px-6 py-3 bg-blue-500 text-white rounded-full hover:bg-blue-700 transition duration-300">
            Regresar a Tecmunity
        </a>
        
        <footer class="mt-12 text-gray-500 text-sm">
            &copy; Autores: Paulo Garcia, Dilan Gutierrez y Stefano Villalva
        </footer>
    </div>
</body>
</html>
