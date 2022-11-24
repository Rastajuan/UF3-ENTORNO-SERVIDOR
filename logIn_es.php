<?php
session_start();

require "controllers/controlUsuario.php";

if (isset($_POST['botonEntrar'])) {
    $usuario = getUser($_POST["usuario"], $_POST["contraseña"]);

    if ($usuario) {
        loginUser($usuario);
    } else {
        $error = '<div class="contError"><img class = "icon" src = "imgs/alertaError.jpg"/>Usuario o contraseña incorrectos</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Usuarios</title>
    <link rel="stylesheet" href="../css/logIn_css.css">
    <noscript>
        Para utilizar las funcionalidades completas de este sitio es necesario tener
        JavaScript habilitado. Aquí están las
        <a href="https://www.enable-javascript.com/es/">
            instrucciones para habilitar JavaScript en tu navegador web
        </a>
    </noscript>

</head>

<body>

    <header>
        <h1>ACCESO AGENDA CULTURAL</h1>
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
                        <td><input class="sinBorde" type="password" name="contraseña" placeholder="****" />
                        </td>

                    </tr>

                </table>
                <div class="registrarse">
                    <p> <a style="color:red" href="#">¿Has olvidado tu contraseña?</a></p>
                </div>
                <input class="boton botonLog" type="submit" value="Entrar" name="botonEntrar" />
            </form>
            <!-- Imprimimos la variable del error de login solamente si existe el error definido en el else inicial-->
            <?php
            if (isset($error)) {

                echo $error;
            }
            ?>
        </fieldset>

        <div class="registrarse">
            <p>¿No tienes una cuenta? <a style="color:darkblue" href="registro.php"><strong>Regístrate</strong></a></p>
        </div>


    </section>


    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fern&aacute;ndez</strong> </br> Trabajo perteneciente a la UF3 de Diseño Web en Entorno Servidor. 2º DAW</p>
    </footer>
</body>

</html>