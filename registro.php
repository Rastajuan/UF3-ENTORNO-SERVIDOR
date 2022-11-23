<?php

require "Manejadores/ManejadorUsuario.php"; 

session_start(); 

if(isset($_POST["botonRegistrar"])) {
    $usuario = $_POST["usuario"];
    $correo = $_POST["email"];
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    registrarUsuario($usuario, $nombre, $correo, $password);

    $id_usuario = obtenerUsuarioId($usuario); 

    if($id_usuario) {
        hacerLogin($id_usuario);
    } else {
        echo "El usuario o la contraseña no son válidos"; 
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

            <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="">
                <table>
                    <tr>
                        <td class="negrita">
                            <label for="usuario">Usuario</label>
                        </td>
                        <td>
                            <input id="usuario" class="sinBorde" type="text" name="usuario" placeholder="Username" autofocus required</td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="nombre">Nombre</label>
                        </td>
                        <td><input id="nombre" class="sinBorde" type="text" name="nombre" placeholder="****" required />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label id="email" for="email">Email </label>
                        </td>
                        <td><input class="sinBorde" type="email" name="email" placeholder="Email" required />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="pasword"> Password </label>
                        </td>
                        <td><input id="password" class="sinBorde" type="password" name="password" placeholder="****" required />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="pasword2"> Password </label>
                        </td>
                        <td><input id="password2" class="sinBorde" type="password" name="password2" placeholder="Repita contraseña" required />
                        </td>

                    </tr>
                </table>

                <div class="botonera">
                    <input id="botonRegistrar" class="boton" type="submit" value="Registrar" name="botonRegistrar" />
                    <input class="boton" type="reset" value="Borrar Formulario" name="botonEnviar" />
                </div>
            </form>
        </fieldset>
        <p class="infoForm">* Todos los campos son obligatorios</p>


    </section>


    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fern&aacute;ndez</strong> </br> Trabajo perteneciente a la UF3 de Diseño Web en Entorno Servidor. 2º DAW</p>
    </footer>

    <script src="js/registro.js"></script>

</body>

</html>