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
                            <input class="sinBorde" type="text" name="usuario" placeholder="Username" autofocus required</td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="nombre">Nombre</label>
                        </td>
                        <td><input class="sinBorde" type="text" name="nombre" placeholder="****" />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="email">Email </label>
                        </td>
                        <td><input class="sinBorde" type="email" name="email" placeholder="Email" />
                        </td>

                    </tr>
                    <tr>
                        <td class="negrita">
                            <label for="pasword"> Password </label>
                        </td>
                        <td><input class="sinBorde" type="password" name="password" placeholder="****" />
                        </td>

                    </tr>
                </table>
              
                <div class="botonera">
                    <input class="boton" type="submit" value="Registrar" name="botonRegistrar" />
                    <input class="boton" type="reset" value="Borrar Formulario" name="botonEnviar" />
                </div>
            </form>
        </fieldset>
        <p class="infoForm">* Todos los campos son obligatorios</p>


    </section>


    <footer>
        <p>©Copyleft 2022 <strong>Juan Bello Fern&aacute;ndez</strong> </br> Trabajo perteneciente a la UF3 de Diseño Web en Entorno Servidor. 2º DAW</p>
    </footer>
</body>

</html>