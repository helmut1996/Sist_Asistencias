<?php
if (!empty($_POST['btnactualizar'])) {
    if (!empty($_POST['txtnombre']) && !empty($_POST['txtapellido']) && !empty($_POST['txtusuario'])) {
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $usuario = $_POST['txtusuario'];
        $id = $_POST['txtid'];

        // Verifica si otro usuario ya tiene ese nombre de usuario
        $sql = $conexion->query("SELECT COUNT(*) AS total FROM usuario WHERE usuario = '$usuario' AND id_usuario != '$id'");
        $result = $sql->fetch_object();

        if ($result && $result->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        text: 'El Usuario <?= $usuario ?> ya existe',
                        type: 'error',
                        styling: 'bootstrap3',
                        addclass: 'dagger',
                        icon: 'fa fa-times',
                    });
                });
            </script>
        <?php } else {
            // Aquí puedes actualizar el usuario
            $update = $conexion->query("UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', usuario = '$usuario' WHERE id_usuario = '$id'");

            if ($update) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'ÉXITO',
                            text: 'Usuario actualizado correctamente',
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
                            text: 'Error al actualizar el usuario',
                            type: 'error',
                            styling: 'bootstrap3',
                            addclass: 'dagger',
                            icon: 'fa fa-times',
                        });
                    });
                </script>
            <?php }
        }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Todos los campos son obligatorios',
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
