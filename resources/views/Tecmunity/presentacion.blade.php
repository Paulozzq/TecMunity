<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecMunity - Registro</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: black; /* Cambia el color de fondo a negro */
            color: white; /* Cambia el color del texto a blanco */
        }
        .navbar {
            background-color: gray;
            padding: 10px;
            text-align: center;
        }
        .navbar h1 {
            margin: 0;
            color: white;
            font-size: 24px;
        }
        .carousel {
            position: relative;
            max-width: 600px;
            margin: 20px auto;
            overflow: hidden;
            animation: slideAnimation 10s infinite; /* Agrega una animación al carrusel */
        }
        .carousel-slide {
            display: none;
            text-align: center;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .carousel-slide.active {
            display: block;
            opacity: 1;
        }
        .carousel-nav {
            margin-top: 20px;
            text-align: center;
        }
        .carousel-nav button {
    padding: 10px 20px;
    font-size: 16px;
    margin: 5px;
    background-color: black; /* Cambia el color de fondo de los botones */
    color: white; /* Cambia el color del texto de los botones */
    border-color: white;
    cursor: pointer;
    border-radius: 30px;
    position: relative; /* Permite posicionar el contenido adicional */
}

.carousel-nav button:hover::after {
    content: attr(data-tooltip); /* Agrega el contenido especificado en el atributo data-tooltip */
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: black;
    color: white;
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 5px;
}

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .pi-input {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 80%;
            margin: 10px 0;
        }
        .pi-input input, .pi-input select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 5px;
        }
        .pi-input label {
            margin-bottom: 5px;
        }
        .pi-input-double {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
        .pi-input-double input, .pi-input-double select {
            width: 48%;
            margin-top: 0;
        }
        button[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 10px;
            background-color: aliceblue;
            border-radius: 30px;
        }

        /* Define la animación del carrusel */
        @keyframes slideAnimation {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        button[type="submit"] {
        padding: 10px 20px;
        font-size: 16px;
        margin-top: 10px;
        background-color: black;
        color: white;
       
        border-radius: 30px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        border-color:white;
    }

    button[type="submit"]:hover {
        background-color: white; /* Cambia el color de fondo al pasar el cursor */
        transform: scale(1.1); 
        color:black/* Hace que el botón se agrande ligeramente */
    }

    /* Agrega estilos para la animación del botón al hacer clic */
    @keyframes fire {
        0% {
            background-color: #ff5733; /* Rojo */
        }
        25% {
            background-color: #ff8c00; /* Naranja */
        }
        50% {
            background-color: #ffd700; /* Amarillo */
        }
        75% {
            background-color: #32cd32; /* Verde Lima */
        }
        100% {
            background-color: #20b2aa; /* Turquesa */
        }
    }

    button[type="submit"]:active {
        animation: fire 0.5s infinite alternate; /* Aplica la animación al hacer clic */
    }

    .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="navbar" style="background-color: black">
        <h1>TecMunity</h1>
        <hr style="border-top: 1px solid white; margin-top: 5px;">
    </div>
    
    <div class="carousel">
        <div class="carousel-slide active">
            <h1>Bienvenido a TecMunity</h1>
             <h2>Conecta con otros estudiantes y profesionales de Tecsup.</h2> <br>
            <h3>En TecMinity, nuestra misión es proporcionar una plataforma dinámica donde puedas:</h3> <br>
            <ul>
                <li>Conectar con estudiantes y profesores de Tecsup de la sede central (pronto para todas las sedes !!)</li> <br><br>
                <li>Compartir proyectos, ideas y colaborar en proyectos innovadores.</li><br><br>
                <li>Acceder a grupos exclusivos para mejorar tus habilidades técnicas.</li><br><br>
                <li>Participar en debates, eventos y competencias para potenciar tu desarrollo profesional.</li> <br>
            </ul>
            <p>Siendo estudiante, ¡TecMinity es tu comunidad!</p>
        </div>
        
        <div class="carousel-slide">
            <h1>Comparte tus conocimientos</h1> <br>
            <h2>Publica tus proyectos, ideas y colabora con otros.</h2> <br>
            <p>En TecMinity, te ofrecemos un espacio para compartir y colaborar en proyectos innovadores con estudiantes y profesionales de Tecsup.</p><br>
            <h3>Beneficios de compartir en TecMunity:</h3> <br>
            <ul>
                <li>Obtén retroalimentación valiosa de la comunidad sobre tus proyectos.</li> <br>
                <li>Encuentra socios y colaboradores para tus ideas y proyectos.</li><br>
                <li>Participa en desafíos y competencias para destacar tu trabajo.</li><br>
            </ul> <br>
            <p>¡Aprovecha la oportunidad de mostrar tus conocimientos y contribuir al crecimiento de la comunidad!</p>
        </div>
        
        <div class="carousel-slide">
            <h1>Aprende y Crece en TecMinity</h1>
            <br>
            <h2>Accede a recursos exclusivos</h2>
            <br>
            <h3>Descubre una variedad de recursos para potenciar tu aprendizaje:</h3>
            <ul>
                <li>Artículos y tutoriales sobre tecnología, programación, diseño, y más.</li>
                <li>Videos educativos y conferencias de expertos en diferentes áreas.</li>
                <li>Libros y documentos recomendados por la comunidad.</li>
            </ul>
            <br>
            <h2>Mejora tus habilidades</h2>
            <br>
            <h3>Desarrolla nuevas habilidades y mejora las existentes con nuestras herramientas y actividades:</h3>
            <ul>
                <li>Participa en proyectos colaborativos para aplicar lo que aprendes.</li>
                <li>Practica en nuestros laboratorios virtuales con ejercicios prácticos.</li>
                <li>Obtén certificaciones reconocidas en el mundo laboral.</li>
            </ul>
        </div>
        
        <div class="carousel-slide">
            <h2>Regístrate ahora</h2>
            <div class="right_row">
                <div class="row border-radius">
                    <center>
                        <div class="settings shadow">
                            <div class="settings_title">
                                <h3>Personal Information</h3>
                            </div>
                            <div class="settings_content">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                      <div class="pi-input pi-input-lg">
                                        <span>Nombre</span>
                                        <input type="text" name="nombre" value="{{ old('nombre', auth()->user()->nombre) }}" required />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Apellido</span>
                                        <input type="text" name="apellido" value="{{ old('apellido', auth()->user()->apellido) }}" required />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Username</span>
                                        <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Your Email</span>
                                        <input type="text" value="{{ auth()->user()->email }}" readonly />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Carrera</span>
                                        <select name="carrera_id">
                                            @foreach($carreras as $carrera)
                                                <option value="{{ $carrera->id }}" {{ old('carrera_id', auth()->user()->carrera_id) == $carrera->id ? 'selected' : '' }}>
                                                    {{ $carrera->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Fecha de nacimiento</span>
                                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', auth()->user()->fecha_nacimiento) }}" />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Avatar</span>
                                        <input type="file" name="avatar" />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Portada</span>
                                        <input type="file" name="portada" />
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Genero</span>
                                        <select name="sexo">
                                            <option value="Hombre" {{ old('sexo', auth()->user()->sexo) == 'Hombre' ? 'selected' : '' }}>Hombre</option>
                                            <option value="Mujer" {{ old('sexo', auth()->user()->sexo) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                                            <option value="Otro" {{ old('sexo', auth()->user()->sexo) == 'Otro' ? 'selected' : '' }}>Otro</option>
                                        </select>
                                    </div>
                                    <div class="pi-input pi-input-lg">
                                        <span>Perfil</span>
                                        <select name="privado" required>
                                            <option value="0" {{ old('privado', auth()->user()->privado) == 0 ? 'selected' : '' }}>Publico</option>
                                            <option value="1" {{ old('privado', auth()->user()->privado) == 1 ? 'selected' : '' }}>Privado</option>
                                        </select>
                                    </div>
                                    <div class="pi-input pi-input-lgg">
                                        <span>Biografía</span>
                                        <input type="text" name="biografia" value="{{ old('biografia', auth()->user()->biografia) }}" placeholder="Una pequeña info sobre ti..." />
                                    </div>
                                    <button type="submit">Guardar los cambios</button>
                                </form>                        
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
   

    <div class="carousel-nav">
        <button id="prevBtn" data-tooltip="Anterior">&#10094;</button>
        <button id="nextBtn" data-tooltip="Siguiente">&#10095;</button>
    </div>
    
    <script>
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const formCarousel = document.getElementById('formCarousel'); // Referencia al formulario
        let currentSlide = 0;
    
        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            prevBtn.disabled = index === 0;
            nextBtn.disabled = index === slides.length - 1;
    
            // Ocultar el botón de siguiente si el formulario es visible
            if (isInViewport(formCarousel)) {
                nextBtn.classList.add('hidden');
            }
        }
    
        prevBtn.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                showSlide(currentSlide);
            }
        });
    
        nextBtn.addEventListener('click', () => {
            if (currentSlide < slides.length - 1) {
                currentSlide++;
                showSlide(currentSlide);
            } else {
                document.querySelector('form').submit();
            }
        });
    
        showSlide(currentSlide);
    
        // Función para verificar si un elemento está dentro del viewport
        function isInViewport(element) {
            const rect = element.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
    </script>
    
    
</body>
</html>