<?php
   session_start();
   if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
       header('location:login/login.php');
   }

   $id = $_SESSION['id'];

?>
<style> 
  ul li:nth-child(6) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class= "text-center text-secundary">CAMBIAR CONTRASEÑA</h4>


    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_cambiar_password.php";
    $sql = $conexion->query("SELECT * FROM usuario WHERE id_usuario = $id");
    ?>
    <div class="row">
        <form action="" method = "POST">
            <?php while($datos = $sql->fetch_object()){ ?>
                
          <input type="hidden" name="txtid" value="<?= $datos->id_usuario ?>">
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="password" class="input input__text" placeholder="Contaseña Actual" name="txtclave" value = "">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 ">
                <input type="password" class="input input__text" placeholder="Contraseña nueva" name="txtclaveNueva" value = "">
            </div>

`           
            <div class="text-right p-4">
                <button type="submit" value= "ok" name= "btnactualizar" class="btn btn-primary btn-rounded">Actualizar</button>
            </div>

            <?php }?>
        </form>
    </div>


</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>