<?php
   session_start();
   if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
       header('location:login/login.php');
   }

?>
<style> 
  ul li:nth-child(5) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class= "text-center text-secundary">DATOS DE LA EMPRESA</h4>


    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_actualizar_empresa.php";
    $sql = $conexion->query("SELECT * FROM empresa");
    ?>
    <div class="row">
        <form action="" method = "POST">
            <?php while($datos = $sql->fetch_object()){ ?>
                
          <input type="hidden" name="txtid" value="<?= $datos->id_empresa ?>">
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" class="input input__text" placeholder="Nombre" name="txtnombre" value = "<?= $datos->nombre ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" class="input input__text" placeholder="Telefono" name="txttelefono" value = "<?= $datos->telefono ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" class="input input__text" placeholder="Ubicacion" name="txtubicacion" value = "<?= $datos->ubicacion ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="te" class="input input__text" placeholder="Ruc" name="txtruc" value = "<?= $datos->ruc ?>">
            </div>
           
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