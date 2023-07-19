<?php
if (!empty($_POST["btneditar"])) {
  if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {
    $nombre = $_POST["txtnombre"];
    $apellido = $_POST["txtapellido"];
    $usuario = $_POST["txtusuario"];
    $id = $_POST["txtid"];

    $sql = $conexion->query(" UPDATE usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario' where id_usuario=$id");

    if ($sql) { ?>
      <script>
        $(function notification() {
          new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "Asistencia eliminada correctamente",
            styling: "bootstrap3"
          })
        })
      </script>
    <?php } else { ?>
      <script>
        $(function notification() {
          new PNotify({
            title: "INCORRECTO",
            type: "error",
            text: "Error al actualizar",
            styling: "bootstrap3"
          })
        })
      </script>
    <?php }
  } else { ?>
    <script>
      $(function notification() {
        new PNotify({
          title: "INCORRECTO",
          type: "error",
          text: "Completar los campos",
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
