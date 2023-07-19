<?php
if (!empty($_POST["btnregistrar"])) {
  if (!empty($_POST["txtnombre"])) {
    $nom_cargo = $_POST["txtnombre"];

    $sql = $conexion->query(" INSERT INTO cargo (nom_cargo) values ('$nom_cargo')");

    if ($sql) { ?>
      <script>
        $(function notification() {
          new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "El cargo se registro correctamente!",
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
            text: "Error al registrar cargo",
            styling: "bootstrap3"
          })
        })
      </script>
<?php }
  } else { ?>
    <script>
        $(function notification() {
          new PNotify({
            title: "ERROR",
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
?>