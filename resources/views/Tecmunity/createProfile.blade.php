<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecMinity - Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #00c0ff;
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
        }
        .carousel-slide {
            display: none;
            text-align: center;
        }
        .carousel-slide.active {
            display: block;
        }
        .carousel-nav {
            margin-top: 20px;
            text-align: center;
        }
        .carousel-nav button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .pi-input {
            width: 80%;
            margin: 10px 0;
        }
        .pi-input span {
            display: block;
            margin-bottom: 5px;
        }
        .pi-input input, .pi-input select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        .pi-input-lg {
            margin-bottom: 15px;
        }
        button[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>TecMinity</h1>
    </div>
    <div class="carousel">
        <div class="carousel-slide active">
            <h2>Bienvenido a TecMinity</h2>
            <p>Conecta con otros estudiantes y profesionales de Tecsup.</p>
        </div>
        <div class="carousel-slide">
            <h2>Comparte tus conocimientos</h2>
            <p>Publica tus proyectos, ideas y colabora con otros.</p>
        </div>
        <div class="carousel-slide">
            <h2>Aprende y Crece</h2>
            <p>Accede a recursos exclusivos y mejora tus habilidades.</p>
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
                                    <div class="pi-input pi-input-lg">
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
        <button id="prevBtn" disabled>Anterior</button>
        <button id="nextBtn">Siguiente</button>
    </div>
    
    <script>
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
            });
            prevBtn.disabled = index === 0;
            nextBtn.disabled = index === slides.length - 1;
            nextBtn.innerText = index === slides.length - 1 ? 'Registrarse' : 'Siguiente';
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
    </script>
</body>
</html>
