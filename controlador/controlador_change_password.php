<?php
if (!empty($_POST["btneditar"])) {
  if (!empty($_POST["txtid"]) and !empty($_POST["txtclaveactual"]) and !empty($_POST["txtclavenueva"])) {
    $id = $_POST["txtid"];
    $clave_actual = md5($_POST["txtclaveactual"]);
    $clave_nueva = md5($_POST["txtclavenueva"]);

    $verificar_clave_actual = $conexion->query(" SELECT password from usuario where id_usuario = $id");

    if ($verificar_clave_actual->fetch_object()->password == $clave_actual) { 
      $sql = $conexion->query(" UPDATE usuario set password='$clave_nueva' where id_usuario = $id ");

      if ($sql) { ?>
        <script>
        $(function notification() {
          new PNotify({
            title: "CORRECTO",
            type: "success",
            text: "La contraseña fue modificada",
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
            text: "Hubo un erro al modificar",
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
            text: "La contraseña no coinciden",
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
?>