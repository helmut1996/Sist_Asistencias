<?php
if (!empty($_POST['btnregistrar'])) {
    if (!empty($_POST['txtnombre'])) {
        include "../modelo/conexion.php"; // Asegúrate de tener esto si no lo tienes ya
        $cargo = $_POST['txtnombre'];

        // Validación opcional: evita duplicados
        $verificar = $conexion->query("SELECT * FROM cargo WHERE nombre = '$cargo'");
        if ($verificar->num_rows > 0) {
            ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: 'ADVERTENCIA',
                        text: 'Este cargo ya existe',
                        type: 'error',
                        styling: 'bootstrap3',
                        addclass: 'dagger',
                        icon: 'fa fa-exclamation',
                    });
                });
            </script>
            <?php
        } else {
            $registro = $conexion->query("INSERT INTO cargo (nombre) VALUES ('$cargo')");
            if ($registro === true) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'CORRECTO',
                            text: 'Se ha registrado el cargo',
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
                    $(function notificacion() {
                        new PNotify({
                            title: 'ERROR',
                            text: 'No se ha registrado el cargo',
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
    } else {
        ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Los campos están vacíos',
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

<script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>
