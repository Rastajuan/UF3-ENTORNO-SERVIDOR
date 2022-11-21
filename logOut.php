<?php 
//hay que iniciar siempre sesión para poder cerrarla
session_start();

//Con esto cancelamos o cerramos la sesión
session_destroy();

//Con la función unset()bastaría para eliminar la variable de sesión, pero no la sesión en sí
unset($_COOKIE["cookieDeUsuario"]);

//Con esto redirigimos a la página de logIn y elmiminamos el tiempo de la cookie, esto es solo un metodo redundante del primero para asegurarnos de que se elimina la cookie
setcookie("cookieDeUsuario", $usuario, time() -3600, '/');

//Redirigimos a la pagina de logIN.php
header('Location: logIn_es.php');
exit();

?>