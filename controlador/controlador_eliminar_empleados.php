<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $conexion->query("DELETE FROM empleado WHERE id_empleado = $id");
    if ($sql == true) { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'CORRECTO',
                    text: 'Se ha eliminado el empleado',
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
                    text: 'Error al eliminar el empleado',
                    type: 'error',
                    styling: 'bootstrap3',
                    addclass: 'dagger',
                    icon: 'fa fa-times',
                 
                });
            });
        </script>
    <?php } ?>
      <script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
      </script>

<?php } ?>
