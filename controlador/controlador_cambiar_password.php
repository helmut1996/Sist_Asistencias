<?php
include "../modelo/conexion.php";
if (!empty($_POST['btnactualizar'])) {
    if (!empty($_POST['txtid']) and !empty($_POST['txtclave']) and !empty($_POST['txtclaveNueva'])) {
        $id = $_POST['txtid'];
        $clave = md5( $_POST['txtclave']);
        $claveNueva = md5( $_POST['txtclaveNueva']);
        $verificarClaveActual =$conexion->query("SELECT password from usuario WHERE id_usuario = $id");

        if ($verificarClaveActual->fetch_object()->password == $clave) { 

            $actualizar = $conexion->query("UPDATE usuario SET password = '$claveNueva' WHERE id_usuario = $id");
            if ($actualizar == true) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'ÉXITO',
                            text: 'Contraseña actualizada correctamente',
                            type: 'success',
                            styling: 'bootstrap3',
                            addclass: 'dagger',
                            icon: 'fa fa-check',
                        });
                    });
                </script>
            <?php } else { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'ERROR',
                            text: 'Error al actualizar la contraseña',
                            type: 'error',
                            styling: 'bootstrap3',
                            addclass: 'dagger',
                            icon: 'fa fa-times',
                        });
                    });
                </script>
            <?php }
          
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        text: 'La contraseña actual es incorrecta',
                        type: 'error',
                        styling: 'bootstrap3',
                        addclass: 'dagger',
                        icon: 'fa fa-times',
                    });
                });
            </script>
        <?php }

        
    }else{ ?>
        <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'ERROR',
                            text: 'los campos estan vacios',
                            type: 'error',
                            styling: 'bootstrap3',
                            addclass: 'dagger',
                            icon: 'fa fa-times',
                        });
                    });
                </script>

    <?php }
}
?>

<script>
setTimeout(() => {
    window.history.replaceState(null, null, window.location.pathname);
}, 0);
</script>   