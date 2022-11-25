<?php
try {

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //Aseguramos que nos muestre los errores de MySQLi
    $conexion = new mysqli("localhost", "root", "", "ifpdb"); //Creamos la conexión con la base de datos

} catch (mysqli_sql_exception $e) {

    error_log($e->getMessage()); //Esto es para que nos muestre los errores de MySQLi en el navegador
    die("Error al conectar con la base de datos <br> Contacte con el administrador del sistema mediante correo <a href='mailto:jbellof@gmail.com'> Enviar correo</a>"); //Si hay algún error en la conexión con la base de datos, se mostrará este mensaje.Serviria igual con exit(); en lugar de die();
}
