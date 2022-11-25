<?php


// require "clases/actividad.php";
require "controllers/controlUsuario.php";
require "controllers/controlActividad.php";
require "controllers/controlActPropias.php";


session_start();

checkLogin();

checkActivity();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades Propias</title>
    <link rel="stylesheet" href="css/actividadesPropias.css">


</head>

<body>
    <header>
        <h1>FORMULARIO DE ACTIVIDADES</h1>
        <BR>
        <h2>MODIFIQUE SUS ACTIVIDADES</h2>
    </header>

    <div id="users">
        <nav class="users">
            <div>
                <p>Usuario actual:<spam> <?php echo $_SESSION["usuario"]["id"]; ?></spam> Nombre:<spam> <?php echo $_SESSION["usuario"]["nombre"]; ?></spam>
                </p>


            </div>
            <div class="salir">
                <form>
                    <a href="logOut.php" name="logOut" title="Cierra sesión">Cerrar Sesión</a>
                </form>

            </div>
        </nav>
    </div>

    <div class="encabezadoActividades">
        <h2>LISTADO DE SUS ACTIVIDADES </h2>
    </div>


    <div id="misActividades">
        <?php
        $user = $_SESSION["usuario"]["id"];

        $actividades = listActivitiesByUser($user);

        foreach ($actividades as $actividad) :  ?>

            <?php
            include "resultadosUsuario.php";
            ?>

        <?php endforeach; ?>


    </div>




    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fernández</strong> </br> Trabajo perteneciente a la UF2 de Diseño Web en Entorno Servidor. 2º DAW</p>

        </p>

    </footer>



</body>

</html>