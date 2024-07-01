<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restablecimiento de Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
        }
        .content p {
            margin: 10px 0;
        }
        .content .password {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
        .footer p {
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Restablecimiento de Contraseña</h1>
        </div>
        <div class="content">
            <p>Hola, <strong>{{ $usuario->username }}</strong></p>
            <p>Tu nueva contraseña es: </p>
            <p class="password">{{ $newPassword }}</p>
            <p>Por favor, inicia sesión y cambia tu contraseña inmediatamente.</p>
        </div>
        <div class="footer">
            <p>Si no solicitaste este cambio, por favor contacta con el soporte técnico.</p>
        </div>
    </div>
</body>
</html>
