<?php

if (!empty($_POST['btnregistrar'])) {
    if (!empty($_POST['txtnombre']) and !empty($_POST['txtapellido']) and !empty($_POST['txtdni']) and !empty($_POST['txtcargo'])) {
    $nombre = $_POST['txtnombre'];
    $apellido = $_POST['txtapellido'];
    $dni = $_POST['txtdni'];
    $cargo = $_POST['txtcargo'];

    
    echo $nombre;


    $sql = $conexion -> query("SELECT count(*) as 'total' FROM empleado WHERE dni = '$dni'");
    if ($sql->fetch_object()->total > 0) { ?>

        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Este DNI  <?= $dni ?> ya Existe ',
                    type: 'error',
                    styling: 'bootstrap3',
                    addclass: 'dagger',
                    icon: 'fa fa-times',
                 
                });
            });
        </script>


  <?php  } else {

    $registro = $conexion->query("INSERT INTO empleado (nombre, apellido,dni, cargo) VALUES ('$nombre', '$apellido','$dni', '$cargo')");
   if ($registro == true) { ?>

<script>
            $(function notificacion() {
                new PNotify({
                    title: 'CORRECTO',
                    text: 'Se ha registrado el usuario',
                    type: 'success',
                    styling: 'bootstrap3',
                    addclass: 'dark',
                    icon: 'fa fa-check',
                   
                });
            });
        </script>
   
   <?php } else { ?>
    <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Los campos estan vacios',
                    type: 'error',
                    styling: 'bootstrap3',
                    addclass: 'dagger',
                    icon: 'fa fa-times',
                 
                });
            });
        </script>
   
  <?php  }


   }
    
    
    } else { ?>
     <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Los campos estan vacios',
                    type: 'error',
                    styling: 'bootstrap3',
                    addclass: 'dagger',
                    icon: 'fa fa-times',
                 
                });
            });
        </script>

        <?php }?>
        
        <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
      </script>

<?php }
