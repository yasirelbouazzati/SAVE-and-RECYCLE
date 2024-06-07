<?php
require_once 'classes/conexionDB.php';
session_start();

$conexionDB = new ConexionDB();


if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $conexionDB->conectar();

    $verificacion = $conexionDB->verificarCredenciales($usuario, $contraseña);

    $info = $conexionDB->get($_POST['usuario']);

    $_SESSION['id'] = $info['id'];
    $_SESSION['user'] = $_POST['usuario'];
    $_SESSION['password'] = $_POST['contraseña'];
    $_SESSION['email'] = $info['email'];
    $_SESSION['puntos'] = $info['puntos'];

    if ($verificacion) {
        header('Location: index.php');
    }

    $conexionDB->desconectar();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="imagenes/favicon.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(./imagenes/fondo1.png);
            /* Cambia el color de fondo si lo deseas */
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            /* Ajusta el ancho máximo según sea necesario */
            margin: 0 auto;
            /* Esto centra el contenedor horizontalmente */
            position: relative;
            /* Añade posición relativa */
            overflow: hidden;
            /* Añade overflow hidden */
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        .input-field {
            width: 70%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            border-color: #555;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
            /* Cambia el color de fondo al pasar el ratón */
        }

        .signup-link {
            text-align: center;
            margin-top: 15px;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        /* Animación de bordes */
        .container::before,
        .container::after,
        .container>*::before,
        .container>*::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            pointer-events: none;
            animation: border-animation 4s infinite alternate;
        }

        .container::before {
            top: 0;
            left: 0;
        }

        .container::after {
            bottom: 0;
            right: 0;
        }

        .container>*::before {
            top: 0;
            right: 0;
        }

        .container>*::after {
            bottom: 0;
            left: 0;
        }

        @keyframes border-animation {
            0% {
                border-color: #8a2be2;
                /* Lila */
            }

            25% {
                border-color: #ffa500;
                /* Naranja */
            }

            50% {
                border-color: #ff007f;
                /* Rosa */
            }

            75% {
                border-color: #ffd700;
                /* Amarillo */
            }

            100% {
                border-color: #8a2be2;
                /* Lila */
            }
        }
    </style>



</head>

<body class="fondo">


  <a href="options.html" class="cerrar-link">
      <img src="imagenes/xxx.png" alt="Cerrar" style="
            width: 100px;
            height: 100px;
            margin-top: -349px;
            float: left;
            margin-left: -10px;
          " />
    </a>
    <div class="container">
        
        <h2>Login</h2>
        <form action="" method="POST" class="login-form">
            <input type="hidden" name="login" value="1">

            <label for="usuario">User Name:</label><br>
            <input type="text" id="usuario" name="usuario" required class="input-field"><br><br>

            <label for="contraseña">Password:</label><br>
            <input type="password" id="contraseña" name="contraseña" required class="input-field"><br><br>
            <input type="submit" value="Log in" class="submit-btn">

            <div class="signup-link">i don't have acount? <a href="registro.php">Sign up</a></div>
        </form>
    </div>
</body>

</html>