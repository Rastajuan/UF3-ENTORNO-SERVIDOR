<?php

session_start();

require "controllers/controlUsuario.php";



if (isset($_POST["botonRegistrar"])) {
    $usuario = registerUser($_POST["id"], $_POST["nombre"], $_POST["correo"],  $_POST["contraseña"]);

    if ($usuario) {
        loginUser($usuario);
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
    <header>
        <h1>REGISTRO NUEVO USUARIO</h1>
    </header>

    <section>
        <fieldset>

            <form role="form" method="post" action="" class="">
                <table>
                    <tr>
                        <td class="negrita">
                            <label for="id">Usuario</label>
                        </td>
                        <td>
                            <input id="id" class="sinBorde" type="text" name="id" placeholder="Escriba su nombre de usuario" autofocus required</td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="nombre">Nombre</label>
                        </td>
                        <td><input id="nombre" class="sinBorde" type="text" name="nombre" placeholder="Escriba su nombre" required />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label id="email" for="correo">Email </label>
                        </td>
                        <td><input class="sinBorde" type="email" name="correo" placeholder="Escriba su correo electrónico" required />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="contraseña"> Password </label>
                        </td>
                        <td><input id="contraseña" class="sinBorde" type="password" name="contraseña" placeholder="Ingrese una contraseña" required />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="contraseña2">Confirme: </label>
                        </td>
                        <td><input id="contraseña2" class="sinBorde" type="password" name="contraseña2" placeholder="Repita contraseña" required />
                        </td>

                    </tr>
                   



                    
                </table>


                <div class="infoForm">
                    <input id="check" class="sinBorde" type="checkbox" name="check" required />
                    <label for="check"> Acepto las <a href="condicionesUso.html" target="_blank"> condiciones de uso</a> </label>

                </div>

                <div class="botonera">
                    <input id="botonRegistrar" class="boton" type="submit" value="Registrar" name="botonRegistrar" />
                    <input class="boton" type="reset" value="Borrar Formulario" name="botonReset" />
                </div>

            </form>

        </fieldset>

        <div class="infoForm">
            <p>* Todos los campos son obligatorios</p>

        </div>

        <div class="registrarse">
            <p class="infoForm">¿Ya tienes una cuenta? <a style="color:red" href="logIn_es.php">Ingresa</a></p>
        </div>
    </section>


    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fern&aacute;ndez</strong> </br> Trabajo perteneciente a la UF3 de Diseño Web en Entorno Servidor. 2º DAW</p>
    </footer>

    <script src="js/registro.js"></script>

</body>

</html>