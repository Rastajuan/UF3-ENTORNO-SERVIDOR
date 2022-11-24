<?php


// require "clases/actividad.php";
require "controllers/controlUsuario.php"; 
require "controllers/controlActividad.php"; 


session_start();

comprobarLogin();

comprobarActividad(); 

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Actividades</title>
    <link rel="stylesheet" href="css/index_css.css">
</head>

<body>
    <header>
        <h1>FORMULARIO DE ACTIVIDADES</h1>
        <BR>
        <h2>RELLENE LOS CAMPOS PARA CREAR UNA NUEVA ACTIVIDAD</h2>
    </header>

    <div id="users">
        <nav class="users">
            <div>
                <p>Usuario actual:<spam> <?php echo $_SESSION["usuario"]["nombre"]; ?></spam>
                </p>
            </div>
            <div class="salir">
                <form>
                    <a href="logOut.php" name="logOut" title="Cierra sesión">Cerrar Sesión</a>
                </form>

            </div>
        </nav>
    </div>

    <div id="formulario">
        <section class="datos">
            <?php include "formulario.html" ?>
        </section>

        <p class="info">Rellene el formulario para añadir actividades a su agenda<br>
            <br>Recuerde que los campos marcados con (*) son obligatorios y que <strong>la actividad se crea como gratuita por defecto</strong>
        </p>
    </div>

    <div class="encabezadoActividades">
        <h2>LISTADO DE ACTIVIDADES</h2>
    </div>
    

    <div id="resultados">
         <?php 
            $actividades = listarActividades(); 
            
            foreach($actividades as $actividad):  ?>

            <?php 
                include "resultado.php";
            ?>

        <?php endforeach; ?>


    </div>

    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fernández</strong> </br> Trabajo perteneciente a la UF2 de Diseño Web en Entorno Servidor. 2º DAW</p>

        </p>

    </footer>



</body>

</html>