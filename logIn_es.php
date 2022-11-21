<?php
session_start();
?>

<!DOCTYPE html>

<?php
if (isset($_POST['botonEntrar'])) {
    if ($_POST['usuario'] == 'ifp'  && $_POST['password'] == '2022') {
        $nombreusuario = $_POST['usuario'];
        $_SESSION['usuario'] = $nombreusuario;
        //Creamos la cookie en el navegador, asignándole un primer nombre cualquiera, seguido del nombre del usuario recogido en $nombreusuario, seguido del tiempo que debe guardar la cookie (momento actual con time() + el tiempo en segundos que la debe guardar (una hora en el ejercicio), seguido de'/' que le indica la raiz o pagina principal de la sesión)
        setcookie('cookieDeUsuario',$nombreusuario,time() + 3600, '/');

        header('Location: index.php');
        exit();
    } else {
        $error = '<div class="contError"><img class = "icon" src = "imgs/alertaError.jpg"/>Usuario o contraseña incorrectos</div>';
    }
}

?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Usuarios</title>
    <link rel="stylesheet" href="../css/logIn_css.css">

</head>

<body>

    <header>
        <h1>ACCESO A CREACI&Oacute;N DE ACTIVIDADES</h1>
    </header>

    <section>
        <fieldset>
            <legend class="negrita">
                Introduzca usuario y contraseña
            </legend>
            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
                <table>
                    <tr>
                        <td class="negrita">
                            <label for="usuario"> Usuario</label>
                        </td>
                        <td>
                            <input class="sinBorde" type="text" name="usuario" placeholder="Introduzca su usuario" autofocus required</td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="pasword"> Password </label>
                        </td>
                        <td><input class="sinBorde" type="password" name="password" placeholder="****" />
                        </td>

                    </tr>

                </table>
                <input class="boton botonLog" type="submit" value="Entrar" name="botonEntrar" />
            </form>
            <!-- Imprimimos la variable del error de login solamente si existe el error definido en el else inicial-->
            <?php
            if (isset($error)) {

                echo $error;
            }
            ?>
        </fieldset>



    </section>


    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fern&aacute;ndez</strong> </br> Trabajo perteneciente a la UF3 de Diseño Web en Entorno Servidor. 2º DAW</p>
    </footer>
</body>

</html>