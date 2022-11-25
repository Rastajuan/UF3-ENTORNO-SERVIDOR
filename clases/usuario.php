<?php
class Usuario
{

    public $id;
    public $nombre;
    public $correo;
    public $contraseña;



    function __construct($id, $contraseña, $correo, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
    }
}
