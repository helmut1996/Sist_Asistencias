<?php
if (!empty($_POST['btn_entrada'])) {
    if (!empty($_POST['txtdni'])) { 
        $dni = $_POST['txtdni'];
        


        $consulta = $conexion->query("SELECT count(*) as total FROM empleado WHERE dni = $dni");
        $id = $conexion->query("SELECT id_empleado FROM empleado WHERE dni = $dni");
        
        if ($consulta && $id) {
            $resultado = $consulta->fetch_object();
            if ($resultado->total > 0) {
                $fecha = date("Y-m-d H:i:s"); // Corregido formato
                $id_empleado = $id->fetch_object()->id_empleado;

                $consultaFecha = $conexion->query("SELECT entrada FROM asistencia WHERE id_empleado = $id_empleado ORDER BY id_asistencia DESC limit 1");
                $fechaBD=$consultaFecha->fetch_object()->entrada;
                
                if(substr($fecha,0,10)==substr($fechaBD,0,10)){
                    ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: 'ADVERTENCIA',
                                text: 'Ya registraste tu entrada',
                                type: 'error',
                                styling: 'bootstrap3',
                                addclass: 'dagger',
                                icon: 'fa fa-exclamation',
                            });
                        });
                    </script>
                    <?php

                }else{

                $insert = $conexion->query("INSERT INTO asistencia ( entrada, id_empleado) VALUES ( '$fecha', '$id_empleado')");
                if ($insert === true) {
                    ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: 'CORRECTO',
                                text: 'Se ha registrado la entrada',
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
                                text: 'No se ha registrado la entrada',
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
setTimeout(() => {
    window.history.replaceState(null, null, window.location.pathname);
}, 0);
</script>