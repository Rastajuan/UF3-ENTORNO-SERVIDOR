<?php
    
require "clases/actividad.php";

function comprobarActividad() 
{
    if (isset($_POST["botonEnviar"]) && $_SERVER["REQUEST_METHOD"] === 'POST') 
    {
        $actividadNueva = new Actividad($_POST["titulo"],
         $_POST["ciudad"],
          $_POST["tipo"], 
          $_POST["fecha"], 
          $_POST["precio"], 
          $_SESSION["usuario"]["id"]);
        
        crearActividad($actividadNueva);
    }
}

function crearActividad($actividad)
{
{
    global $conexion;

    $consulta = "INSERT INTO actividades (titulo, ciudad, tipo,fecha, precio, usuario) VALUES (?, ?, ?, ?, ?, ?)";

    $resultado = $conexion->prepare($consulta);
    $resultado ->bind_param(
        'ssssds',
        $actividad->titulo, 
        $actividad->ciudad, 
        $actividad->tipo,
        $actividad->fecha, 
        $actividad->precio, 
        $actividad->usuario);

        $resultado -> execute();
}

}
//Funcion que devuelve un array con todas las actividades de la base de datos
function listarActividades()
{

    global $conexion; //Para poder usar la variable $conexion en la función, la declaramos como global

    $sql = "SELECT * FROM actividades"; //Creamos la consulta sql

    $resultado = $conexion->query($sql); //Ejecutamos la consulta sql y guardamos el resultado en la variable $resultado

    $actividades = []; //Creamos un array vacío para guardar los datos de la consulta sql

    if ($resultado->num_rows > 0) 
    { //Si el número de filas de la consulta sql es mayor que 0, es decir, si hay datos en la tabla actividades de la base de datos, se ejecuta el bucle while
        while ($fila = $resultado->fetch_assoc()) 
        { //Recorremos el resultado de la consulta sql y lo guardamos en la variable $fila. Esto añadirá un array con los datos de cada fila a la variable $actividades hasta que no haya más filas en la tabla actividades de la base de datos. El bucle while se ejecutará mientras haya datos en la tabla actividades de la base de datos. Usamos la función fetch_assoc() para que nos devuelva un array asociativo con los datos de la consulta sql en lugar de un array numérico que es el que devuelve por defecto la función fetch_array()
            $actividades[] = new Actividad(
                // $fila['id'],
                $fila['titulo'],
                $fila['ciudad'],
                $fila['tipo'],
                $fila['fecha'],
                ($fila['precio'] == 0) ? "Gratis" : "De pago", //Si el precio es 0, se mostrará "Gratuito" en lugar del precio. Si el precio es mayor que 0, se mostrará De pago
                $fila['usuario'],
            ); //Guardamos los datos de la consulta sql en el array $actividades

            // array_push($actividades, $fila); //Esta es la forma en la que se añadia en la vc, pero igualando el array $actividades a la creación de un nuevo objeto de la clase Actividad con los datos de la consulta sql en lugar de añadir un array con los datos de la consulta sql a la variable $actividades es más eficiente
        }
    }

    return $actividades;
}


