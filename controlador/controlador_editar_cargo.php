<?php 
if (!empty($_POST["btneditar"])) {
  if (!empty($_POST["txtnombre"])) {
    $nombre = $_POST["txtnombre"];
    $id = $_POST["txtid"];

    $sql = $conexion->query(" UPDATE cargo set nom_cargo = '$nombre' where id_cargo = $id");

    if ($sql) { ?>
      <script>
          $(function notification() {
            new PNotify({
              title: "CORRECTO",
              type: "success",
              text: "El cargo se modifico correctamente",
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
              text: "Hubo un error al modificar",
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