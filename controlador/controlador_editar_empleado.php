<?php
if (!empty($_POST["btneditar"])) {
  if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtdni"]) and !empty($_POST["txtcargo"])) {
    $nombre = $_POST["txtnombre"];
    $apellido = $_POST["txtapellido"];
    $dni = $_POST["txtdni"];
    $cargo = $_POST["txtcargo"];
    $id = $_POST["txtid"];
    
    $editar = $conexion->query(" UPDATE empleado set nombre = '$nombre', apellido = '$apellido', dni = '$dni', cargo = $cargo where id_empleado = $id;");
    if ($editar) { ?>
      <script>
          $(function notification() {
            new PNotify({
              title: "CORRECTO",
              type: "success",
              text: "El empleado se ha modificado correctamente",
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
            text: "Hubo un error :(",
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
            text: "Complete los campos",
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