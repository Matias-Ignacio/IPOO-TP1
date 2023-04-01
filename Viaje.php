<?php
class Viaje{
    //Informacion de viajes
    //Los atributos son el codigo del viaje, el destino, la cantidad maxima de pasajeros y sus datos
    private $arrDatosViaje;
    private $arrPasajeros ;//= array (0 => array("Apellido", "Nombre", "Dni"));

    public function __construct($arrViajeNuevo){   
        //Metodo constructor de la clase Viaje
        $this->arrDatosViaje = $arrViajeNuevo;
        $this->arrPasajeros[0]["Apellido"] = "";
        $this->arrPasajeros[0]["Nombre"] = "";  
        $this->arrPasajeros[0]["Dni"] = ""; 
    }
    //Metodo para obtener los datos del viaje
    public function getDatosViaje(){
        return $this->arrDatosViaje;
    }
    public function getDatosPasajeros(){
        return $this->arrPasajeros;
    }
    public function getCantPasajeros(){
        $cantPasajeros = count($this->arrPasajeros);
        return $cantPasajeros;
    }
    public function getMaxLugar(){
        return $this->arrDatosViaje[2];
    }
    //Metodos para modificar los datos del viaje
    public function setDatos($arrViaje, $arrDatosPasajeros){
        $this->arrDatosViaje = $arrViaje;
        $this->arrPasajeros = $arrDatosPasajeros;
    }
    public function setAgregarPasajero($arrPasajeroNuevo){
        if ($this->arrPasajeros[0]["Nombre"] == ""){
            $this->arrPasajeros[0] = $arrPasajeroNuevo;
        }else{
        array_push($this->arrPasajeros, $arrPasajeroNuevo);
        }
    }
    public function setDatosPasajeros($arrDatosPasajeros){
        $this->arrPasajeros = $arrDatosPasajeros;
    }
    public function setModificarViaje($arrViajeNuevo){
        $this->arrDatosViaje = $arrViajeNuevo;
    }
    public function getCodigoViaje(){
        return $this->arrDatosViaje[0];
    }

    //Metodo que busca un pasajero con el numero de DNI retorna el numero de indice del arreglo donde 
    //ubicar el pasajero y la variable booleana indicando si existe este numero de DNI
    /*
    public function buscarDni($dni){
        $indice = count($this->arrPasajeros) -1;
        $existePasajero = FALSE;
    do{
        if ($this->arrPasajeros[$indice]["dni"] == $dni){
            $existePasajero = TRUE;
        }else{
        $indice = $indice -1;
        }
    }while(($existePasajero == FALSE) && ($indice >= 0));
    return $indice , $existePasajero;
    }*/
	public function __toString(){
		return "  \n".$this->arrDatosViaje[0]. " "."\n";
	}
    
}