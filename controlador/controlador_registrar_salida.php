<?php
if (!empty($_POST['btn_salida'])) {
    if (!empty($_POST['txtdni'])) { 
        $dni = $conexion->real_escape_string($_POST['txtdni']);

        // Verificar si el DNI existe
        $consulta = $conexion->query("SELECT COUNT(*) as total FROM empleado WHERE dni = '$dni'");
        $id = $conexion->query("SELECT id_empleado FROM empleado WHERE dni = '$dni'");
        
        if ($consulta && $id) {
            $resultado = $consulta->fetch_object();
            if ($resultado->total > 0) {
                $fechaActual = date("Y-m-d H:i:s");
                $id_empleado = $id->fetch_object()->id_empleado;

                // Buscar la última asistencia del día (si existe)
                $busqueda = $conexion->query("
                    SELECT id_asistencia, entrada, salida 
                    FROM asistencia 
                    WHERE id_empleado = $id_empleado 
                      AND DATE(entrada) = CURDATE()
                    ORDER BY id_asistencia DESC 
                    LIMIT 1
                ");

                if ($busqueda && $busqueda->num_rows > 0) {
                    $ultimaAsistencia = $busqueda->fetch_object();

                    if (!is_null($ultimaAsistencia->salida)) {
                        // Ya se registró la salida hoy
                        ?>
                        <script>
                            $(function notificacion() {
                                new PNotify({
                                    title: 'ADVERTENCIA',
                                    text: 'Ya registraste tu salida hoy',
                                    type: 'error',
                                    styling: 'bootstrap3',
                                    addclass: 'dagger',
                                    icon: 'fa fa-exclamation',
                                });
                            });
                        </script>
                        <?php
                    } else {
                        // Registrar la salida
                        $id_asistencia = $ultimaAsistencia->id_asistencia;
                        $update = $conexion->query("UPDATE asistencia SET salida = '$fechaActual' WHERE id_asistencia = $id_asistencia");

                        if ($update === true) {
                            ?>
                            <script>
                                $(function notificacion() {
                                    new PNotify({
                                        title: 'CORRECTO',
                                        text: 'Se ha registrado la salida',
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
                                        text: 'No se pudo registrar la salida',
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
                    // No hay entrada registrada hoy
                    ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: 'ADVERTENCIA',
                                text: 'No se encontró una entrada registrada para hoy',
                                type: 'error',
                                styling: 'bootstrap3',
                                addclass: 'dagger',
                                icon: 'fa fa-info-circle',
                            });
                        });
                    </script>
                    <?php
                }
            } else {
                // DNI no existe
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: 'ERROR',
                            text: 'El DNI ingresado no existe',
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
            echo "Error en la consulta SQL";
        }
    } else {
        ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: 'ERROR',
                    text: 'Ingrese el DNI',
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
// Limpiar el historial para evitar reenvíos
setTimeout(() => {
    window.history.replaceState(null, null, window.location.pathname);
}, 0);
</script>
