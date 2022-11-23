<?php
require "controllers/controlDBConnect.php";

$conexion = crearConexionBD();
//Funcion validacion usuario
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
                ($fila['precio'] == 0) ? "Gratis" : "De pago", //Si el precio es 0, se mostrará "Gratuito" en lugar del precio. Si el precio es mayor que 0, se mostrará De pago
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

function comprobacionCreacionActividad()
{
    if (isset($_POST["botonEnviar"])) { //Si se ha pulsado el botón de crear actividad, se ejecuta el código de la función
        $actividad = new Actividad(
            $_POST['titulo'],
            $_POST['tipo'],
            $_POST['fecha'],
            $_POST['ciudad'],
            $_POST['precio'],
            $_SESSION['usuario']
        ); //Creamos un nuevo objeto de la clase Actividad con los datos de la actividad creada

        insertarActividad($actividad); //Insertamos los datos de la actividad creada en la base de datos

    }
    
}

