<?php

class ResponsableV{

    private $idEmpleado;
    private $licencia;
    private $nombre;
    private $apellido;

    //Metodo constructor de la clase
    public function __construct($id, $lic, $nom, $ape){
        $this->idEmpleado = $id;
        $this->licencia = $lic;
        $this->nombre = $nom;
        $this->apellido = $ape;
    }
    //Metodos de acceso a los datos de la clase
    public function getIdEmpleado(){
        return $this->idEmpleado;
    }
    public function getLicencia(){
        return $this->licencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    //Metodos de escritura de los atributos de la clase
    public function setIdEmpleado($id){
        $this->idEmpleado = $id;
    }
    public function setlicencia($lic){
        $this->licencia = $lic;
    }
    public function setNombre($nom){
        $this->nombre = $nom;
    }
    public function setApellido($ape){
        $this->Apellido = $ape;
    }
    //Metodo para mostrar los datos de los atributos como string
    public function __toString(){
        $cadena = "";
        $cadena = "Responsable del viaje: ". $this->getNombre()." ".$this->getApellido().
        "\tNro Empleado: ".$this->getIdEmpleado().
        "\t Licencia: ".$this->getLicencia();
        return $cadena;
    }
}