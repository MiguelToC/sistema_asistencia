<?php 
if (!empty($_GET["id"])) {
  $id = $_GET["id"];
  $sql = $conexion->query(" DELETE FROM empleado WHERE id_empleado = $id");
  if ($sql) { ?>
    <script>
      $(function notification() {
        new PNotify({
          title: "CORRECTO",
          type: "success",
          text: "Empleado eliminado correctamente",
          styling: "bootstrap3"
        })
      })
    </script>
  <?php } else { ?>
    <script>
      $(function notification() {
        new PNotify({
          title: "ERRO",
          type: "error",
          text: "Ocurrio un error :(",
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