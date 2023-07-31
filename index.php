<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="public/estilos/index.css"> -->
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap" rel="stylesheet">

  <!-- pNotify -->
  <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
  <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
  <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />

  <!-- pnotify -->
  <script src="public/pnotify/js/jquery.min.js">
  </script>
  <script src="public/pnotify/js/pnotify.js">
  </script>
  <script src="public/pnotify/js/pnotify.buttons.js">
  </script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Nunito", sans-serif;
      background-color: rgb(151, 174, 255);
    }

    h1 {
      text-align: center;
      padding: 20px;
      font-size: 40px;
    }

    #fecha {
      text-align: center;
      color: rgb(9, 9, 9);
      font-size: 40px;
      font-weight: normal;
      margin-bottom: 20px;
    }

    .container {
      max-width: 700px;
      width: 90%;
      background-color: white;
      padding: 40px;
      margin: auto;
    }

    .ingresarsis {
      color: rgb(29, 29, 255);
      font-size: 20px;
      background-color: rgb(201, 224, 244);
      padding: 10px;
      border-radius: 5px;
      text-decoration: none;
    }

    .ingresarsis:hover{
      color: white;
    }

    .ingresardni {
      text-align: center;
      font-size: 40px;
      padding: 30px;
    }

    input {
      width: 100%;
      padding: 15px;
      outline: none;
      font-size: 20px;
    }

    .botones {
      display: flex;
      margin-top: 20px;
    }

    .entrada {
      background-color: rgb(23, 195, 23);
      flex-grow: 1;
      padding: 15px;
      color: white;
      text-align: center;
      text-decoration: none;
      border-color: rgb(23, 195, 23);
      margin: 5px;
      font-size: 20px;
      font-family: "Nunito", sans-serif;
      font-weight: bold;
      cursor: pointer;
    }

    .salida {
      background-color: red;
      flex-grow: 1;
      padding: 15px;
      color: white;
      text-align: center;
      text-decoration: none;
      border-color: red;
      margin: 5px;
      font-size: 20px;
      font-family: "Nunito", sans-serif;
      font-weight: bold;
      cursor: pointer;

    }
    .entrada:hover {
      background-color: rgb(43, 110, 28);
    }

    .salida:hover {
      background-color: rgb(161, 37, 37);
    }
    @media screen and (max-width: 500px) {
      .container {
        padding: 20px;
      }

      .ingresardni {
        font-size: 30px;
        padding: 20px;
      }
      .ingresarsis{
        padding: 8px;
      }
      input {
        padding: 10px;
      }

      .entrada,
      .salida {
        padding: 10px;
        font-size: 16px;
      }

      #fecha {
        font-size: 30px;
      }
      .title{
        font-size: 30px;
      }
    }
  </style>
</head>

<body>
  <?php
  date_default_timezone_set("America/Lima");
  ?>
  <h1 class="title">UNIVERSIDAD NACIONAL DE INGENIERIA - ALUMNOS</h1>
  <h2 id="fecha"><?= date("d/m/Y, h:i:s") ?></h2>
  <?php
  include "modelo/conexion.php";
  include "../sis_asistencia/controlador/controlador_registrar_entrada.php";
  ?>
  <div class="container">
    <a class="ingresarsis" href="vista/login/login.php">Ingresar al sistema</a>
    <p class="ingresardni">INGRESE SU DNI</p>
    <form action="" method="POST">
      <input type="number" placeholder="Ingresar su DNI" name="txtdni" id="txtdni">
      <div class="botones">
        <button class="entrada" type="submit" name="btnentrada" value="ok">ENTRADA</button>
        <button class="salida" type="submit" name="btnsalida" value="ok">SALIDA</button>

      </div>
    </form>
  </div>
  <script>
    setInterval(() => {
      let fecha = new Date();
      let fechahora = fecha.toLocaleString();
      document.getElementById("fecha").textContent = fechahora;
    }, 1000);
  </script>
  <script>
    let dni = document.getElementById("txtdni");
    dni.addEventListener("input", function() {
      if (this.value.length > 8) {
        this.value = this.value.slice(0, 8)
      }
    })
  </script>

</body>

</html>