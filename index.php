<!--=====================================================================================================================================================
                                                BLOQUE PHP
=======================================================================================================================================================-->

<!-- Iniciamos la sesión con la función session_start();-->
<?php
session_start();


//ARCHIVOS REQUERIDOS
require "actividad.php"; //  Requerimos la carga del archivo donde hemos creado la clase php 'Acitvidad'
require "controllers/controlActividad.php"; //  Requerimos la carga del archivo donde hemos creado la función php 'crearConexionBD()'



/*  Si no tenemos la sesión iniciada pero existe la cookie de usuario asignamos a la $_SESSION["usuario"] el vlaor de la cookie con lo que se saltará el siguiente condicional pues ya existe sesión iniciada */
if (!isset($_SESSION["usuario"]) && isset($_COOKIE["cookieDeUsuario"])) {
    $_SESSION["usuario"] = $_COOKIE["cookieDeUsuario"];
}

/* Comprobación loguin usuario
Si no está iniciada la sesión con el usuario redirigimos a la página de logIn, no nos deja continuar con el resto de la web
 */
if (!isset($_SESSION["usuario"])) {
    header('Location: logIn_es.php');
    exit();
}

/* Con un condicional creamos el array únicamente si este no ha sido creado ya (no hemos iniciado sesión) o no hemos abandonado la web*/
if (!isset($_SESSION["actividades_creadas"])) {
    $_SESSION["actividades_creadas"] = array();
}



$actividades_db = listarActividades(); //Llamamos a la función listarActividades() y guardamos el resultado en la variable $actividades_db. Recordar que la función listarActividades() nos devuelve un array con los datos de la tabla actividades de la base de datos. Es importante llamar a la funcion listarActividades() al final del código, ya que si la llamamos antes de insertar los datos de la actividad creada en la base de datos, no nos refrescará la página y no nos mostrará la actividad creada en la tabla de actividades
?>
<!--=====================================================================================================================================================
                                              FIN BLOQUE PHP
=======================================================================================================================================================-->

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
                <p>Usuario actual:<spam> <?php echo $_SESSION["usuario"]; ?></spam>
                </p>
            </div>
            <div class="salir">
                <form>
                    <a href="logOut.php" name="logOut" title="Cierra sesión">Cerrar Sesión</a>
                </form>

            </div>
        </nav>
    </div>


    <!-- Incluimos el formulario desde un archivo externo 'formulario.html' con php -->
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

    <!-- Ahora ya no necesitamos iterar sobre la actividd creada si no sobre el array que nos devuelve la consulta mysql que recogemos de la BBDD y cambiamos la iteracion del foreach-->
    <div id="resultados">
        <?php foreach ($actividades_db as $actividad) :
            // $actividad = unserialize($actividadSerializada);//Al iterar sobre la variable $actividad_db ya no es necesario deserializar
        ?>
            <!-- Incluimos el resultado desde un archivo externeo 'resultado.html' con php -->
            <?php include "resultado.php" ?>

        <?php endforeach; ?>

    </div>

    <div id="resultados2">
        <h1>ACTIVIDADES CREADAS PERO SIN INSERTAR EN BBDD</h1>
        <?php foreach ($_SESSION["actividades_creadas"] as $actividadSerializada) :
            $actividad = unserialize($actividadSerializada);
        ?>
            <!-- Incluimos el resultado desde un archivo externeo 'resultado.html' con php -->
            <?php include "resultado.php" ?>

        <?php endforeach; ?>


    </div>


    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fernández</strong> </br> Trabajo perteneciente a la UF3 de Diseño Web en Entorno Servidor. 2º DAW</p>

        </p>

    </footer>



</body>

</html>