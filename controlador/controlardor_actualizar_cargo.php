<?php
if (!empty($_POST['btnactualizar'])) {
    if (!empty($_POST['txtid']) && !empty($_POST['txtnombre'])) {
        include "../modelo/conexion.php"; // Asegúrate de tener $conexion definido

        $id = $_POST['txtid'];
        $nombre = $_POST['txtnombre'];

        $sql = $conexion->query("UPDATE cargo SET nombre = '$nombre' WHERE id_cargo = '$id'");

        if ($sql === true) {
            ?>
            <script>
                $(function() {
                    new PNotify({
                        title: 'CORRECTO',
                        text: 'Cargo actualizado correctamente',
                        type: 'success',
                        styling: 'bootstrap3',
                        addclass: 'dark',
                        icon: 'fa fa-check',
                    });
                });
            </script>
            <?php
        } else {
            ?>
            <script>
                $(function() {
                    new PNotify({
                        title: 'ERROR',
                        text: 'Error al actualizar el cargo',
                        type: 'error',
                        styling: 'bootstrap3',
                        addclass: 'dagger',
                        icon: 'fa fa-times',
                    });
                });
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            $(function() {
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
        <?php
    }
}
?>

<!-- Limpiar URL al recargar -->
<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>
