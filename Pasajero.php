<?php

class Pasajero{

    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

        //Metodo constructor de la clase
        public function __construct($nom, $ape, $dni, $tel){
            $this->nombre = $nom;
            $this->apellido = $ape;
            $this->dni = $dni;
            $this->telefono = $tel;
        }
        //Metodos de acceso a los datos de la clase
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getDni(){
            return $this->dni;
        }
        public function getTelefono(){
            return $this->telefono;
        }
        //Metodos de escritura de los atributos de la clase
        public function setNombre($nom){
            $this->nombre = $nom;
        }
        public function setApellido($ape){
            $this->apellido = $ape;
        }
        public function setDni($dni){
            $this->dni = $dni;
        }
        public function setTelefono($tel){
            $this->telefono = $tel;
        }
        /**
         * Metodo que compara dos pasajeros a traves del numero de DNI
         * Devuelve True si son iguales
         * @param $pasNuevo objeto
         * @return boolean
         */
        public function compararPasajero($pasNuevo){
            $igual = false;
            if ($pasNuevo->getDni() == $this->getDni()){
                $igual = true;
            }
            return $igual;
        }

        //Metodo para mostrar los datos de los atributos como string
        public function __toString(){
            $cadena = "";
            $cadena = "Pasajero: ". $this->getNombre()." ".$this->getApellido()."\tDNI: ".$this->getDni().
            "\t Tel: ".$this->getTelefono();
            return $cadena;
        }
}