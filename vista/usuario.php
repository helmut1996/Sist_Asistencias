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

    <h4 class= "text-center text-secundary">USUARIOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_eliminar_asistencia.php";
    $sql = $conexion->query("SELECT * FROM usuario");
    ?>


<a href="registrar_usuarios.php" class="btn btn-primary btn-rounded"><i class="fa-solid fa-plus"></i> Nuevo Usuario</a>


    <table class="table table-bordered table-hover col-12" id = "example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col">APELLIDO</th>
      <th scope="col">USUARIO</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php 
  while($datos = $sql->fetch_object()){ ?>

<tr>
      <td><?= $datos->id_usuario ?></td>
      <td><?= $datos->nombre?></td>
      <td><?= $datos->apellido ?></td>
      <td><?= $datos->usuario ?></td>
      <td>
        <a href="" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal<?= $datos->id_usuario ?>"><i class="fa-solid fa-pen"></i></a>
        <a href="inicio.php?id=<?=$datos->id_usuario?>" onclick = "advertencia(event) " class= "btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a></td>
    
    </tr>


<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $datos->id_usuario ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form action="" method = "POST">
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" class="input input__text" placeholder="Nombre" name="txtnombre" value = " <?= $datos->nombre ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" class="input input__text" placeholder="Apellido" name="txtapellido" value = "<?= $datos->apellido ?>">
            </div>
            <div class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" class="input input__text" placeholder="Usuarios" name="txtusuario" value = "<?= $datos->usuario ?>">
            </div>
            <div class="text-right p-4">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" value= "ok" name= "btnregistrar" class="btn btn-primary btn-rounded">Actualizar</button>
            </div>

        </form>
      </div>

    </div>
  </div>
</div>





    <?php } ?>


  </tbody>
</table>


</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>