<!-- REGISTRO DE ENTRADA -->

<?php
if (!empty($_POST["btnentrada"])) {
  if (!empty($_POST["txtdni"])) {
    //CAPTURAMOS EL DNI DESDE EL INPUT LLAMADO TXTDNI
    $dni = $_POST["txtdni"];
    //CONSULTAMOS SI EL DNI EXISTE O NO
    $sql = $conexion->query(" SELECT COUNT(*) as TOTAL FROM empleado where dni='$dni'");
    $id = $conexion->query(" SELECT id_empleado from empleado where dni='$dni'");
    if ($sql->fetch_object()->TOTAL > 0) {
      //CAPTURAMOS LA FECHA Y HORA EXACTA
      $fecha = date("Y-m-d h:i:s");
      //OBTENEMOS EL ID DEL EMPLEADO
      $id_empleado = $id->fetch_object()->id_empleado;

      $consultaFecha = $conexion->query(" SELECT entrada from asistencia where id_empleado = $id_empleado order by id_asistencia desc limit 1");

      $fechaBD = $consultaFecha->fetch_object()->entrada;
      if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
        <script>
          $(function notification() {
            new PNotify({
              title: "INCORRECTO",
              type: "alert",
              text: "Ya registraste tu entrada",
              styling: "bootstrap3"
            })
          })
        </script>
        <?php } else {
        $sql = $conexion->query(" INSERT INTO asistencia(id_empleado,entrada) values ($id_empleado,'$fecha') ");
        //HACEMOS LA CONSULTA PARA OBTENER EL NOMBRE DEL EMPLEADO MEDIANTE EL DNI
        $sql_nombre = $conexion->query(" SELECT nombre FROM empleado where id_empleado = $id_empleado");
        $nombre_emp = $sql_nombre->fetch_object()->nombre;
        if ($sql) { ?>
          <script>
            $(function notification() {
              new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "Bievenido <?= $nombre_emp ?>",
                styling: "bootstrap3"
              })
            })
          </script>
        <?php } else { ?>
          <script>
            $(function notification() {
              new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "Error al registrar entrada",
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
            text: "El dni <?= $dni ?> no existe",
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




<?php
if (!empty($_POST["btnsalida"])) {
  if (!empty($_POST["txtdni"])) {
    //CAPTURAMOS EL DNI DESDE EL INPUT LLAMADO TXTDNI
    $dni = $_POST["txtdni"];
    //CONSULTAMOS SI EL DNI EXISTE O NO
    $sql = $conexion->query(" SELECT COUNT(*) as TOTAL FROM empleado where dni='$dni'");
    $id = $conexion->query(" SELECT id_empleado from empleado where dni='$dni'");
    if ($sql->fetch_object()->TOTAL > 0) {
      //CAPTURAMOS LA FECHA Y HORA EXACTA
      $fecha = date("Y-m-d h:i:s");
      //OBTENEMOS EL ID DEL EMPLEADO
      $id_empleado = $id->fetch_object()->id_empleado;

      $busqueda = $conexion->query(" SELECT id_asistencia,entrada from asistencia where id_empleado=$id_empleado order by id_asistencia desc limit 1");

      while ($datos = $busqueda->fetch_object()) {
        $id_asistencia = $datos->id_asistencia;
        $entradaDB = $datos->entrada;
      }
      if (substr($fecha, 0, 10) != substr($entradaDB, 0, 10)) { ?>
        <script>
          $(function notification() {
            new PNotify({
              title: "INCORRECTO",
              type: "alert",
              text: "Primero registre su entrada",
              styling: "bootstrap3"
            })
          })
        </script>
        <?php } else {
        $consultaFecha = $conexion->query(" SELECT salida from asistencia where id_empleado = $id_empleado order by id_asistencia desc limit 1");

        $fechaBD = $consultaFecha->fetch_object()->salida;

        if (substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
          <script>
            $(function notification() {
              new PNotify({
                title: "INCORRECTO",
                type: "alert",
                text: "Ya registraste tu salida",
                styling: "bootstrap3"
              })
            })
          </script>
          <?php } else {
          $sql = $conexion->query(" UPDATE asistencia set salida='$fecha' where id_asistencia=$id_asistencia");
          //HACEMOS LA CONSULTA PARA OBTENER EL NOMBRE DEL EMPLEADO MEDIANTE EL DNI
          $sql_nombre = $conexion->query(" SELECT nombre FROM empleado where id_empleado = $id_empleado");
          $nombre_emp = $sql_nombre->fetch_object()->nombre;
          if ($sql) { ?>
            <script>
              $(function notification() {
                new PNotify({
                  title: "CORRECTO",
                  type: "success",
                  text: "Hasta mañana <?= $nombre_emp ?>",
                  styling: "bootstrap3"
                })
              })
            </script>
          <?php } else { ?>
            <script>
              $(function notification() {
                new PNotify({
                  title: "CORRECTO",
                  type: "success",
                  text: "Error al registrar salida",
                  styling: "bootstrap3"
                })
              })
            </script>
      <?php }
        }
      }
    } else { ?>
      <script>
        $(function notification() {
          new PNotify({
            title: "INCORRECTO",
            type: "error",
            text: "El dni <?= $dni ?> no existe",
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
