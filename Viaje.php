<?php
class Viaje{
    //Informacion de viajes
    //Los atributos son el codigo del viaje, el destino, persona responsable del viaje
    // la cantidad maxima de pasajeros y un array de objetos clase Pasajero
    private $codigo;
    private $destino;
    private $responsableViaje;  //objeto clase ResponsableV
    private $maxCPas;
    private $arrPasajeros ;//arraay de objetos clase Pasajero

    public function __construct($cod,$dest,$resp,$max){   
        //Metodo constructor de la clase Viaje
        $this->codigo = $cod;
        $this->destino = $dest;
        $this->responsableViaje = $resp;
        $this->maxCPas = $max;
        $this->arrPasajeros = array();
    }

    //Metodo para obtener los datos del viaje
    public function getCodigoViaje(){
        return $this->codigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getResponsableViaje(){
        return $this->responsableViaje;
    }
    public function getMaxCantPasajeros(){
        return $this->maxCPas;
    }
    public function getColPasajeros(){
        return $this->arrPasajeros;
    } 

    //Metodos para modificar los datos del viaje
    public function setCodigoViaje($cod){
        $this->codigo = $cod;
    }
    public function setDestino($dest){
        $this->destino = $dest;
    }
    public function setResponsableViaje($resp){
        $this->responsableViaje = $resp;
    }
    public function setMaxCantPasajeros($max){
        $this->maxCPas = $max;
    }
    public function setColPasajeros($arrPasajeros){
        $this->arrPasajeros = $arrPasajeros;
    }

    //Metodos especiales de la clase
    /**
     * Metodo que agrega un pasajero al arreglo de pasajeros
     * @param array
     */
    public function setAgregarPasajero($pasajeroNuevo){
        array_push($this->arrPasajeros, $pasajeroNuevo);

    }
    /**
     * Metodo que devuelve la cantidad actual de pasajeros
     * cargados en el viaje
     * @return array
     */
    public function getCantPasajeros(){
        return count($this->arrPasajeros);
    }
    /**
     * Metodo que modifica los datos del viaje, no la lista de pasajeros
     * @param $cod
     * @param $dest
     * @param $resp
     * @param $max
     */
    public function setModificarViaje($cod, $dest, $resp, $max){
        $this->setCodigoViaje($cod);
        $this->setDestino($dest);
        $this->setResponsableViaje($resp);
        $this->setMaxCantPasajeros($max);
    }
    /**
     * Metodo para saber si hay cargado algun pasajero en el viaje
     * devuelve false si el viaje esta vacio
     * @return boolean
     */
    public function getHayPasajeros(){
        $hay = true;
        if (count($this->arrPasajeros) == 0){
            $hay = false;
        }
        return $hay;
    }
    /**
     * Metodo recibe por parametros los datos de un pasajero,
     * recorrre el arreglo de pasajeros buscando si ya esta cargado
     * devuelve falso si no esta cargado el pasajero
     * @param $pasajero
     * @return boolean
     */
    public function existePasajero($pasajero){
        $existe = false;
        $i = 0;
        if ($this->getHayPasajeros()){
            do{
               $existe = ($pasajero->compararPasajero($this->getColPasajeros()[$i]));
               $i++;
            }while (($existe == false) && ($this->getCantPasajeros() > $i));
        }
        return $existe;
    }

    /**
     * Metodo para borrar un pasajero mediante el DNI
     * retorna true si se borro un pasajero
     * @param $dni
     * @return
     */
    public function borrarPasajero($dni){
        $exito = false;
        $i = 0;
        $arregloPasajeros = [];
        $arregloPasajeros = $this->getColPasajeros();
        do{
            if ($arregloPasajeros[$i]->getDni() == $dni){
                unset($arregloPasajeros[$i]);
                $this->setColPasajeros($arregloPasajeros);
                $exito = true;
            }
            $i++;
        }while(($exito == false) && ($this->getCantPasajeros() > $i));
        return $exito;
    }

    //Metodo para mostrar los datos de los atributos como string
	public function __toString(){
        $cadena = "";
        $cadena = "Codigo : ". $this->getCodigoViaje(). "\n".
                "Destino: ". $this->getDestino(). "\n".
                $this->getResponsableViaje()."\n".
                "Cant Maxima Pasajeros: ". $this->getMaxCantPasajeros(). "\n";
		return $cadena;
	}
    
}