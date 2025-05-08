<?php
   session_start();
   if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
       header('location:login/login.php');
   }

?>
<style> 
  ul li:nth-child(3) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>



<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class= "text-center text-secundary">LISTA DE CARGOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_eliminar_cargo.php";
    include "../controlador/controlardor_actualizar_cargo.php";
    $sql = $conexion->query("SELECT * FROM cargo");
    ?>


<a href="registrar_cargo.php" class="btn btn-primary btn-rounded"><i class="fa-solid fa-plus"></i> Nuevo Cargo</a>


    <table class="table table-bordered table-hover col-12" id = "example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NOMBRE</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php 
  while($datos = $sql->fetch_object()){ ?>

<tr>
      <td><?= $datos->id_cargo ?></td>
      <td><?= $datos->nombre?></td>
      <td>
     <!-- Botón para abrir modal de edición -->
     <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal<?= $datos->id_cargo ?>">
    <i class="fa-solid fa-pen"></i>
  </a>

  <!-- Botón para abrir modal de eliminar -->
  <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar<?= $datos->id_cargo ?>">
  <i class="fa-solid fa-trash"></i>
</a>   
    </td>
         
    </tr>




    <div class="modal fade" id="modalEliminar<?= $datos->id_cargo ?>" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel<?= $datos->id_cargo ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel<?= $datos->id_cargo ?>">Confirmar eliminación</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
       <p>¿Estás seguro de eliminar ?</p>
        <p>¡No podrá recuperar este registro!'</P>
      </div>

      <div class="modal-footer">
    
          <input type="hidden" name="eliminar_id" value="<?= $datos->id_cargo ?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a href="cargo.php?id=<?= $datos->id_cargo ?>" class="btn btn-danger">Eliminar</a>
        
      </div>

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $datos->id_cargo ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar cargo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form action="" method = "POST">
      <div hidden class="fl-flex-label mb-4 px-2 col-12">
                <input type="text" class="input input__text" placeholder="id" name="txtid" value = " <?= $datos->id_cargo ?>">
            </div>
            
            <div class="fl-flex-label mb-4 px-2 col-12">
            <select name="txtnombre" class="input input__select">
<?php
    $sql2 = $conexion->query("SELECT * FROM cargo");
    while($datos2 = $sql2->fetch_object()){ 
        $selected = ($datos->id_cargo == $datos2->id_cargo) ? "selected" : "";
        ?>
        <option value="<?= $datos2->nombre ?>" <?= $selected ?>><?= $datos2->nombre ?></option>
    <?php } ?>
</select>

            </div>


            <div class="text-right p-4">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" value= "ok" name= "btnactualizar" class="btn btn-primary btn-rounded">Actualizar</button>
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