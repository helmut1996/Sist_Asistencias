<?php

if (!empty($_POST['btnregistrar'])) {
    if (!empty($_POST['txtnombre']) and !empty($_POST['txtapellido']) and !empty($_POST['txtusuario']) and !empty($_POST['txtpassword'])) {
    $nombre = $_POST['txtnombre'];
    $apellido = $_POST['txtapellido'];
    $usuario = $_POST['txtusuario'];
    $password = md5($_POST['txtpassword']);
    
    echo $nombre;


    $sql = $conexion -> query("SELECT count(*) as 'total' FROM usuario WHERE usuario = '$usuario'");
    if ($sql->fetch_object()->total > 0) { ?>

        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'El Usuario <?= $usuario ?> ya Existe ',
                    type: 'error',
                    styling: 'bootstrap3',
                    addclass: 'dagger',
                    icon: 'fa fa-times',
                 
                });
            });
        </script>


  <?php  } else {

    $registro = $conexion->query("INSERT INTO usuario (nombre, apellido, usuario, password) VALUES ('$nombre', '$apellido', '$usuario', '$password')");
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
