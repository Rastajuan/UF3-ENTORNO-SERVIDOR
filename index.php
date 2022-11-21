<!--=====================================================================================================================================================
                                                BLOQUE PHP
=======================================================================================================================================================-->

<!-- Iniciamos la sesión con la función session_start();-->
<?php
session_start();


//ARCHIVOS REQUERIDOS
require "actividad.php"; //  Requerimos la carga del archivo donde hemos creado la clase php 'Acitvidad'

//CONEXIÓN A LA BASE DE DATOS
//Conectamos con la base de datos con la función mysqli_connect y guardamos los datos de conexión en variables para poder usarlas más adelante en el código php: Lo colocamos en un bloque try-catch para que nos muestre los errores de MySQLi.
try {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //Esto es para que nos muestre los errores de MySQLi en el navegador
    $conexion = new mysqli("localhost", "root", "", "ifpdb"); //Creamos la conexión con la base de datos

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage()); //Esto es para que nos muestre los errores de MySQLi en el navegador
    die("Error al conectar con la base de datos <br> Contacte con el administrador del sistema mediante correo <a href='mailto:jbellof@gmail.com'> Enviar correo</a>"); //Si hay algún error en la conexión con la base de datos, se mostrará este mensaje.Serviria igual con exit(); en lugar de die();
}

//FUNCIONES PARA EL MANEJO DE LA BASE DE DATOS

//Función para RECUPERAR los datos en la bbdd: Creamos una funcion que nos devuelva un array con los datos de la tabla actividades de la base de datos en la que se encuentran las actividades que se van a mostrar en la página principal
function listarActividades()
{
    //Esto es para que no nos muestre los errores de MySQLi en el navegador
    error_reporting(0);
    mysqli_report(MYSQLI_REPORT_OFF);

    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $sql = "SELECT * FROM actividades"; //Creamos la consulta sql

    $resultado = $conexion->query($sql); //Ejecutamos la consulta sql y guardamos el resultado en la variable $resultado

    $actividades = []; //Creamos un array vacío para guardar los datos de la consulta sql

    if ($resultado->num_rows > 0) { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while
        while ($fila = $resultado->fetch_assoc()) { //Recorremos el resultado de la consulta sql y lo guardamos en la variable $fila. Esto añadirá un array con los datos de cada fila a la variable $actividades hasta que no haya más filas en la tabla actividades de la base de datos. El bucle while se ejecutará mientras haya datos en la tabla actividades de la base de datos. Usamos la función fetch_assoc() para que nos devuelva un array asociativo con los datos de la consulta sql en lugar de un array numérico que es el que devuelve por defecto la función fetch_array()
            $actividades[] = new Actividad(
                // $fila['id'],
                $fila['titulo'], //el nombre de la columna de la tabla actividades de la base de datos ha de coincidir con el nombre del atributo de la clase 'Actividad'
                $fila['tipo'],
                $fila['fecha'],
                $fila['ciudad'],
                ($fila['precio'] == 0)? "Gratuito" : "De pago", //Si el precio es 0, se mostrará "Gratuito" en lugar del precio. Si el precio es mayor que 0, se mostrará De pago
                $fila['usuario'],
            ); //Guardamos los datos de la consulta sql en el array $actividades

            // array_push($actividades, $fila); //Esta es la forma en la que se añadia en la vc, pero igualando el array $actividades a la creación de un nuevo objeto de la clase Actividad con los datos de la consulta sql en lugar de añadir un array con los datos de la consulta sql a la variable $actividades es más eficiente
        }
    }

    return $actividades; //Devolvemos el array $actividades con los datos de la consulta sql
}



//Función para INSERTAR los datos en la bbdd: Creamos una función que nos permita insertar los datos de la actividad creada en la base de datos
function insertarActividad($actividad)
{
    error_reporting(0); //Esto es para que no nos muestre los errores de MySQLi en el navegador
    mysqli_report(MYSQLI_REPORT_OFF); //Esto es para que no nos muestre los errores de MySQLi en el navegado

    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $sql = "INSERT INTO actividades (titulo, tipo, fecha, ciudad, precio, usuario) VALUES (?,?,?,?,?,?)"; //Creamos la consulta sql con una consulta preparada. Al no tomar directamente los datos de la variable $actividad, sino que los pasamos como parámetros, evitamos que se puedan introducir inyecciones sql en la consulta sql

    $stmt = $conexion->prepare($sql); //Preparamos la consulta sql para que sea más segura y no se pueda inyectar código sql en la consulta sql

    //El primer parametro de la función bind_param() es una cadena de caracteres que indica el tipo de dato de cada uno de los parametros que se van a pasar a la consulta sql. Los tipos de datos que se pueden pasar a la consulta sql son: i (entero), d (double), s (string), b (blob). El número de caracteres de la cadena de caracteres ha de coincidir con el número de parametros que se van a pasar a la consulta sql. bind_param() devuelve true si se ha podido pasar los parametros a la consulta sql y false si no se ha podido pasar los parametros a la consulta sql y evita que se ejecute la consulta sql, lo que evita la inyección de código sql en la consulta sql
    $stmt->bind_param(
        "ssssds",
        $actividad->titulo,
        $actividad->tipo,
        $actividad->fecha,
        $actividad->ciudad,
        $actividad->precio,
        $actividad->usuario
    ); //Añadimos los parámetros a la consulta sql

    $stmt->execute(); //Ejecutamos la consulta sql

}


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

/* Cada vez que se crea un objeto e la clase Actividad mediante el botón enviar, incluiremos la nueva actividad en el array $_SESSION["actividades_creadas"] creado anteriormente el método array_push()
Como lo almacenamos para la sesión, debemos serializar el nuevo elemento del array con serialize()
Creamos una nueva variable $actividad_serializada solamente para mejorar la visualización del código, pero serviría igualemnte array_push($_SESSION["actividades_creadas"], serialize($actividad));*/
if (isset($_POST["botonEnviar"])) {
    $actividad = new Actividad(
        $_POST["titulo"],
        $_POST["tipo"],
        $_POST["fecha"],
        $_POST["ciudad"],
        $_POST["precio"],
        $_SESSION["usuario"]
    );

    $actividad_serializada = serialize($actividad);

    array_push($_SESSION["actividades_creadas"], $actividad_serializada);

    insertarActividad($actividad); //Llamamos a la función insertarActividad() y le pasamos como parámetro el objeto $actividad que hemos creado con los datos de la actividad que se ha creado
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