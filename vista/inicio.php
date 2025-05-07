<?php
   session_start();
   if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
       header('location:login/login.php');
   }

?>

<style> 
  ul li:nth-child(1) .activo{
    background: rgb(11, 150, 214) !important;
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

    <h4 class= "text-center text-secundary">ASISTENCIA DE EMPLEADOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_eliminar_asistencia.php";
    $sql = $conexion->query("SELECT asistencia.id_asistencia, 
    asistencia.id_empleado, 
    asistencia.salida,
    asistencia.entrada, 
    empleado.id_empleado,
     empleado.nombre, 
     empleado.apellido, 
     empleado.dni, 
     empleado.cargo, 
   cargo.id_cargo,
    cargo.nombre as nom_cargo
      FROM asistencia 
INNER JOIN empleado ON asistencia.id_empleado= empleado.id_empleado 
INNER JOIN cargo ON empleado.cargo = cargo.id_cargo;");
    ?>





    <table class="table table-bordered table-hover col-12" id = "example">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">EMPLEADO</th>
      <th scope="col">DNI</th>
      <th scope="col">CARGO</th>
      <th scope="col">ENTRADA</th>
      <th scope="col">SALIDA</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php 
  while($datos = $sql->fetch_object()){ ?>

<tr>
      <td><?= $datos->id_asistencia ?></td>
      <td><?= $datos->nombre." ".$datos->apellido ?></td>
      <td><?= $datos->dni ?></td>
      <td><?= $datos->nom_cargo ?></td>
      <td><?= $datos->entrada ?></td>
      <td><?= $datos->salida ?></td>
      <td><a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar<?= $datos->id_asistencia ?>"><i class="fa-solid fa-trash"></i></a>  </td>
    
    </tr>


    <div class="modal fade" id="modalEliminar<?= $datos->id_asistencia ?>" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel<?= $datos->id_usuario ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalEliminarLabel<?= $datos->id_asistencia ?>">Confirmar eliminación</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
       <p>¿Estás seguro de eliminar ?</p>
        <p>¡No podrá recuperar este registro!'</P>
      </div>

      <div class="modal-footer">
        <form method="POST" action="usuario.php">
          <input type="hidden" name="eliminar_id" value="<?= $datos->id_asistencia ?>">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a href="inicio.php?id=<?= $datos->id_asistencia ?>" class="btn btn-danger">Eliminar</a>
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