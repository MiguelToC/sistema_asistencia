<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="vista/login/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="vista/login/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    <title>Inicio de sesión</title>
</head>

<body>
    <img class="wave" src="vista/login/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="vista/login/img/estudiantes.png">
        </div>
        <div class="login-content">
            <form method="POST" action="">
                <img src="vista/login/img/logo-uni.png">
                <h2 class="title">BIENVENIDO</h2>
                <?php
                include "modelo/conexion.php";
                include "controlador/login.php";

                ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="usuario" type="text" class="input" name="usuario" title="ingrese su nombre de usuario" autocomplete="usuario" value="">


                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" id="input" class="input" name="password" title="ingrese su clave para ingresar" autocomplete="current-password">


                    </div>
                </div>
                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>
                <input name="btningresar" class="btn" title="click para ingresar" type="submit" value="INICIAR SESION">
            </form>

        </div>
    </div>
    <script src="vista/login/js/fontawesome.js"></script>
    <script src="vista/login/js/main.js"></script>
    <script src="vista/login/js/main2.js"></script>
    <script src="vista/login/js/jquery.min.js"></script>
    <script src="vista/login/js/bootstrap.js"></script>
    <script src="vista/login/js/bootstrap.bundle.js"></script>

</body>

</html>