<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
$id=$_SESSION["id"];
?>

<!-- <style>
    ul li:nth-child(5) .activo {
        background: rgb(11, 150, 214) !important;
    }
</style> -->

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class="text-center text-secondary">DATOS DE LA EMPRESA</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_editar_perfil.php";
    $sql = $conexion->query(" SELECT * FROM usuario where id_usuario = $id");
    ?>

    <div class="row">
        <form action="" method="POST">
            <?php
            while ($datos = $sql->fetch_object()) { ?>
                <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_usuario ?>">
                </div>

                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                </div>

                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?= $datos->apellido ?>">
                </div>

                <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario" value="<?= $datos->usuario ?>">
                </div>
                
                <div class="text-right p-2">
                    <button type="submit" value="ok" name="btneditar" class="btn btn-primary btn-rounded"><i class="fa-solid fa-pen-to-square"></i></i> Modificar</button>
                </div>
            <?php }
            ?>

        </form>
    </div>






</div>

<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>