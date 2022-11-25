<?php 

require 'controllers/control_db.php';


function runQuery($consulta)
{
    global $conexion;

    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        printf("Error: %s\n", $conexion->error);
    }

    return $resultado;
}

function checkLogin()
{
    if(!isset($_SESSION["usuario"]) &&
        isset($_COOKIE["cookie_usuario"]))
    {
        $_SESSION["usuario"] = gettingUser($_COOKIE["cookie_usuario"]);
    }

    if(!isset($_SESSION["usuario"]))
    {
        header("Location: login.php");
        exit();
    }
}

function getUser($usuario, $contraseña)
{
    $consulta  = "SELECT id, nombre, correo FROM usuarios 
                  WHERE id = '$usuario' AND contraseña = '$contraseña'";

    $resultado = runQuery($consulta);

    if($resultado)
    {
        $usuario_db = mysqli_fetch_assoc($resultado);
        return $usuario_db;
    }
}

function gettingUser($usuario)
{
    $consulta  = "SELECT Id, Nombre, Correo FROM usuarios 
                  WHERE Id = '$usuario'";

    $resultado = runQuery($consulta);

    if($resultado)
    {
        $usuario_db = mysqli_fetch_assoc($resultado);
        return $usuario_db;
    }
}

function loginUser($usuario)
{
    $_SESSION["usuario"] = $usuario;
    setcookie('cookie_usuario', $usuario["id"], time() + 3600, '/');

    header("Location: index.php");
    exit();
}

function registerUser($id, $nombre, $correo, $contraseña)
{
    global $conexion;

    try {
        $consulta  = "INSERT INTO usuarios (id, nombre, correo, contraseña)  
    VALUES (?, ?, ?, ?)";

        $resultado = $conexion->prepare($consulta);
        $resultado->bind_param(
            'ssss',
            $id,
            $nombre,
            $correo,
            $contraseña
        );

        $resultado->execute();
    } catch (\Throwable $th) {
        echo' El usuario ya existe';
    }
}
