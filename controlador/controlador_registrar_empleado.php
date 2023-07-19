<?php
if (!empty($_POST["btnregistrar"])) {
  if (!empty($_POST["txtnombre"] and !empty($_POST["txtapellido"]) and !empty($_POST["txtdni"]) and !empty($_POST["txtcargo"]))) {
    $nombre = $_POST["txtnombre"];
    $apellido = $_POST["txtapellido"];
    $dni = $_POST["txtdni"];
    $cargo = $_POST["txtcargo"];



    $sql_dni = $conexion->query(" SELECT count(*) AS DNI FROM empleado where dni = $dni");

    if ($sql_dni->fetch_object()->DNI > 0) { ?>
      <script>
        $(function notification() {
          new PNotify({
            title: "ERROR",
            type: "error",
            text: "El DNI <?= $dni ?> ya existe",
            styling: "bootstrap3"
          })
        })
      </script>
      <?php } else {
      $registrar = $conexion->query(" INSERT INTO empleado (nombre,apellido,dni,cargo) values ('$nombre','$apellido',$dni,$cargo)");
      if ($registrar) { ?>
        <script>
          $(function notification() {
            new PNotify({
              title: "CORRECTO",
              type: "success",
              text: "El empleado ha sido registrado existosamente!",
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
              text: "Ha ocurrido un error intente de nuevo",
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