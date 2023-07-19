<?php
if (!empty($_POST["btneditar"])) {
  if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"])) {

    $nombre = $_POST["txtnombre"];
    $apellido = $_POST["txtapellido"];
    $usuario = $_POST["txtusuario"];
    $id = $_POST["txtid"];

    $sql = $conexion->query("SELECT COUNT(*) AS TOTAL FROM usuario WHERE usuario = '$usuario' and id_usuario!=$id");

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
      $editar = $conexion->query(" UPDATE usuario set nombre = '$nombre', apellido='$apellido', usuario='$usuario' WHERE id_usuario=$id");
      if ($editar) { ?>
        <script>
          $(function notification() {
            new PNotify({
              title: "CORRECTO",
              type: "success",
              text: "El usuario se ha modificado correctamente",
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
              text: "Error al actualizar usuario",
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
          title: "INCORRECTO",
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

?>