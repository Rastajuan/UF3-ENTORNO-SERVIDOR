<?php 
// Creacion de la clase Actividad
class Actividad{
    //Declaración de las variables de la clase
    public $titulo;
    public $tipo;
    public $fecha;
    public $ciudad;
    public $precio;
    Public $usuario;

    //Creacion de la funcion constructora del objeto mediante parámetros (las variables creadas anteriormente)
    function __construct($titulo,$ciudad, $tipo, $fecha,  $precio, $usuario){
        $this->titulo=$titulo;
        $this->ciudad = $ciudad;
        $this->tipo=$tipo;
        $this->fecha=$fecha;
       
        $this->precio=$precio;
        $this->usuario=$usuario;
    }

    //Metodos get. Devuelven el valor de las variables de la clase con una funcion
    function getTitulo(){
        return $this->titulo;
    }
    function getCiudad(){
        return $this->ciudad;
    }
    function getTipo(){
        return $this->tipo;
    }
    function getFecha(){
        return $this->fecha;
    }
    function getPrecio(){
        return $this->precio;
    }
    function getUsuario(){
        return $this->usuario;
    }

    //Metodos set. Asignan un valor a las variables de la clase con una funcion
    function setTitulo($titulo){
        $this->titulo=$titulo;
    }
    function setCiudad($ciudad){
        $this->ciudad=$ciudad;
    }
    function setTipo($tipo){
        $this->tipo=$tipo;
    }

    function setFecha($fecha){
        $this->fecha=$fecha;
    }
    function setPrecio($precio){
        $this->precio=$precio;
    }
    function setUsuario($usuario){
        $this->usuario=$usuario;
    }
}
