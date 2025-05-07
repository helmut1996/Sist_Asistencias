<?php
if (isset($_GET['id'])) {
    include "../modelo/conexion.php"; // Asegúrate de tener conexión aquí también
    $id = $_GET['id'];
    $sql = $conexion->query("DELETE FROM usuario WHERE id_usuario = $id");
    if ($sql === true) {
        echo "<script>
            $(function() {
                new PNotify({
                    title: 'CORRECTO',
                    text: 'Se ha eliminado el usuario',
                    type: 'success',
                    styling: 'bootstrap3',
                    addclass: 'dark',
                    icon: 'fa fa-check',
                });
            });
        </script>";
    } else {
        echo "<script>
            $(function() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Error al eliminar el usuario',
                    type: 'error',
                    styling: 'bootstrap3',
                    addclass: 'dagger',
                    icon: 'fa fa-times',
                });
            });
        </script>";
    }

    // Redirige para evitar reenvío al recargar
    echo "<script>
        setTimeout(() => {
            window.location.href = 'usuario.php';
        }, 1500);
    </script>";
}
?>
