<?php
if (!empty($_POST["btneditar"])) {
  if (!empty($_POST["txtid"])) {
    $id = $_POST["txtid"];
    $nombre = $_POST["txtnombre"];
    $telefono = $_POST["txttelefono"];
    $ubicacion = $_POST["txtubicacion"];
    $ruc = $_POST["txtruc"];

    $sql = $conexion->query(" UPDATE empresa set nombre='$nombre',telefono='$telefono', ubicacion='$ubicacion', ruc='$ruc' where id_empresa = $id");

    if ($sql) { ?>
        <script>
      $(function notification() {
        new PNotify({
          title: "EXITOSO",
          type: "success",
          text: "Modificacion exitosa",
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
          text: "Error al modificar",
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