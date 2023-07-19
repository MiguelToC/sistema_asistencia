<?php

if (!empty($_POST["btnregistrar"])) {
  if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"]) and !empty($_POST["txtpassword"])) {
    $nombre = $_POST["txtnombre"];
    $apellido = $_POST["txtapellido"];
    $usuario = $_POST["txtusuario"];
    $password = md5($_POST["txtpassword"]);

    $sql = $conexion->query("SELECT COUNT(*) AS TOTAL FROM usuario WHERE usuario = '$usuario'");

    if ($sql->fetch_object()->TOTAL > 0) { ?>

      <script>
        $(function notification() {
          new PNotify({
            title: "ERROR",
            type: "error",
            text: "El usuario <?= $usuario ?> ya existe",
            styling: "bootstrap3"
          })
        })
      </script>

    <?php } else {
      $registrar = $conexion->query("INSERT INTO usuario (nombre,apellido,usuario,password) values ('$nombre','$apellido','$usuario','$password') ");
      if ($registrar) { ?>
        
        <script>
        $(function notification() {
          new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "El usuario ha sido registrado existosamente!",
            styling: "bootstrap3"
          })
        })
      </script>

      <?php } else { ?>
        
        <script>
        $(function notification() {
          new PNotify({
            title: "ERROR",
            type: "error",
            text: "Error al registrar el usuario",
            styling: "bootstrap3"
          })
        })
      </script>

      <?php }
      
    }
  } else { ?>

    <script>
      $(function notification() {
        new PNotify({
          title: "ERROR",
          type: "error",
          text: "Los campos están vacios",
          styling: "bootstrap3"
        })
      })
    </script>
  <?php } ?>
  <script>
    setTimeout(() => {
      window.history.replaceState(null, null, window.location.pathname);
    }, 0);
  </script>
<?php }
