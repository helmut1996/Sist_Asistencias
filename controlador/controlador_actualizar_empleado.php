<?php
if (!empty($_POST['btnactualizar'])) {
    if (!empty($_POST['txtnombre']) && !empty($_POST['txtapellido']) && !empty($_POST['txtdni']) && !empty($_POST['txtcargo'])) {
        $nombre = $_POST['txtnombre'];
        $apellido = $_POST['txtapellido'];
        $dni = $_POST['txtdni'];
        $id = $_POST['txtid'];
        $cargo = $_POST['txtcargo'];

        // Verifica si otro usuario ya tiene ese nombre de usuario
        $sql = $conexion->query("SELECT COUNT(*) AS total FROM empleado WHERE dni = '$dni' AND id_empleado != '$id'");
        $result = $sql->fetch_object();

        if ($result && $result->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ERROR',
                        text: 'El Usuario <?= $dni ?> ya existe',
                        type: 'error',
                        styling: 'bootstrap3',
                        addclass: 'dagger',
                        icon: 'fa fa-times',
                    });
                });
            </script>
        <?php } else {
            // Aquí puedes actualizar el usuario
            $update = $conexion->query("UPDATE empleado SET nombre = '$nombre', apellido = '$apellido', dni = '$dni', cargo = '$cargo' WHERE id_empleado = '$id'");

            if ($update) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'ÉXITO',
                            text: 'Empleado actualizado correctamente',
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
                            text: 'Error al actualizar el empleado',
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
