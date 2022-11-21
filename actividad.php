<?php 
// Creacion de la clase Actividad
class Actividad{
    //Declaración de las variables de la clase
    public $titulo;
    public $tipo;
    public $fecha;
    public $ciudad;
    public $precio;
    public $usuario;

    //Creacion de la funcion constructora del objeto mediante parámetros (las variables creadas anteriormente)
    function __construct($titulo, $tipo, $fecha, $ciudad, $precio, $usuario){
        $this->titulo=$titulo;
        $this->tipo=$tipo;
        $this->fecha=$fecha;
        $this->ciudad=$ciudad;
        $this->precio=$precio;
        $this->usuario= $usuario;
    }
}
?>