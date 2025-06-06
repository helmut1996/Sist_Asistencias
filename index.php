<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Bienvenida</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

        <!-- pNotify -->
<link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
<link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
<link href="public/pnotify/css/custom.min.css" rel="styleshee"/>

<!-- pnotify -->
        <script src="public/pnotify/js/jquery.min.js">
        </script>
        <script src="public/pnotify/js/pnotify.js">
        </script>
        <script src="public/pnotify/js/pnotify.buttons.js">
        </script>



</head>
<body>
    <h1>BIENVENIDOS, REGISTRA TU ASISTENCIA</h1>
    <h2 id = "fecha"></h2>
    <?php
    include 'modelo/conexion.php';
    include 'controlador/controlador_registrar_entrada.php';
    include 'controlador/controlador_registrar_salida.php';
    ?>

    <div id = "contenedor">
        <a class="acceso" href="vista/login/login.php">Ingresar al sistema</a>
        <p class ="dni">Ingrese su DNI</p>
        <form action="" method = "POST">
            <input type="number" placeholder="DNI del empleado" name= "txtdni" id = "txtdni"> 
            <div class="botones">

                <button class= "salida" type = "submit" name = "btn_salida" value = "ok">SALIDA</button>
                <BUTTon class= "entrada"type = "submit" name = "btn_entrada" value = "ok">ENTRADA</BUTTon>
           
            </div>
        </form>
    </div>
</body>

<script>
    setInterval(() => {
        let fecha = new Date();
        let fechaHora = fecha.toLocaleString();
    document.getElementById("fecha").textContent = fechaHora; 
    },1000);

</script>

<script>
    let dni = document.getElementById("txtdni").value;
    dni.addEventListener('input', function(){
        if(this.value.length > 8){
            this.value = this.value.slice(0,8);
        }
    })
</script>
</html>