<?php
   session_start();
   if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
       header('location:login/login.php');
   }

?>
<style> 
  ul li:nth-child(2) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class= "text-center text-secundary">REGISTRO DE CARGOS</h4>


    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_cargo.php";
    ?>
    <div class="row">
        <form action="" method = "POST">
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input type="text" class="input input__text" placeholder="Nombre" name="txtnombre">
            </div>
          
            <div class="text-right p-4">
                <a href="cargo.php"  class="btn btn-secondary btn-rounded">Atras</a>
                <button type="submit" value= "ok" name= "btnregistrar" class="btn btn-primary btn-rounded">Guardar</button>
            </div>

        </form>
    </div>


</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>