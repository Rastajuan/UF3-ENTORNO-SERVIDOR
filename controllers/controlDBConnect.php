<!-- CONEXIÓN A LA BASE DE DATOS -->

<!-- Conectamos con la base de datos con la función mysqli_connect y guardamos los datos de conexión en variables para poder usarlas más adelante en el código php: Lo colocamos en un bloque try-catch para que nos muestre los errores de MySQLi. -->

<?php
function crearConexionBD(){
    try {

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //Esto es para que nos muestre los errores de MySQLi en el navegador
        $conexion = new mysqli("localhost", "root", "", "ifpdb"); //Creamos la conexión con la base de datos

    } catch (mysqli_sql_exception $e) {

        error_log($e->getMessage()); //Esto es para que nos muestre los errores de MySQLi en el navegador
        die("Error al conectar con la base de datos <br> Contacte con el administrador del sistema mediante correo <a href='mailto:jbellof@gmail.com'> Enviar correo</a>"); //Si hay algún error en la conexión con la base de datos, se mostrará este mensaje.Serviria igual con exit(); en lugar de die();
    }
    return $conexion; //Devolvemos la conexión para poder usarla en el resto del código
}
