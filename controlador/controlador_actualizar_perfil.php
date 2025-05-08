<?php
if (!empty($_POST['btnactualizar'])) {
    if (!empty($_POST['txtid'])) {
        $id = $_POST['txtid'];
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $usuario = $_POST['txtusuario'];
        
        $sql =$conexion->query("UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario' WHERE id_usuario = $id");

        if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ÉXITO',
                        text: 'Datos actualizados correctamente',
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
                        text: 'Error al actualizar los datos',
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
                            text: 'no se ha envciado el identificador',
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