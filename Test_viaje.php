<?php
include 'Viaje.php';
// Arreglo para contener todos las instancias Viaje
$arrListaViajes = array();

/*************************************************************************************/
/**
 * Pide al objeto mediante el metodo .... el array de pasajeros y muestra una lista
 * de los datos de los 
 * @param $objViaje
 */
function mostrarListaPasajeros($objViaje){ 
    //int $indice
    //int $valor
    $arrListaPasajeros = $objViaje->getDatosPasajeros();
        foreach ($arrListaPasajeros as $i => $valor) 
        {
            echo "Nombre: ".$arrListaPasajeros[$i]["Nombre"]." ".
                $arrListaPasajeros[$i]["Apellido"]."\t\t\t\t\t"."DNI: ".
                $arrListaPasajeros[$i]["Dni"]."\n";
        } 
    echo "Quedan ". $objViaje->getMaxLugar() - $objViaje->getCantPasajeros()." lugares.\n " ;    
}
//******************************************************************

/**
 * Muestra los datos del viaje, Codigo, destino y cantidad maxima de pasajeros
 * @param $objViaje
 */
function mostrarDatosViaje($objViaje){
    $arrDatViaje = [];
    $arrDatViaje = $objViaje->getDatosViaje();
    echo "\n----------------- Datos del viaje ----------------\n";
    echo "Código: ". $arrDatViaje[0] . "\t";
    echo "Cantidad máxima de pasaje: ". $arrDatViaje[2] . "\t";
    echo "Destino: ". $arrDatViaje[1] . "\n";
    echo "Quedan ". $objViaje->getMaxLugar() - $objViaje->getCantPasajeros()." lugares.\n " ;
    echo "--------------------------------------------------\n";
}

/**
 * Agregar pasajeros al array del objeto
 */
function agregarPasajero($objViaje)
{
    //array arrPasajero
    $arrPasajero = [];
    $flag = "";
    mostrarDatosViaje($objViaje);
    echo "\n--- Ingrese los PASAJEROS del Viaje ---\n";
    do{    
        if(($objViaje->getMaxLugar() - $objViaje->getCantPasajeros()) >= 1){
            echo "Nombre: ";
            $arrPasajero["Nombre"] = trim(fgets(STDIN));
            echo "Apellido: ";
            $arrPasajero["Apellido"] = trim(fgets(STDIN));
            echo "DNI: ";
            $arrPasajero["Dni"] = trim(fgets(STDIN));
            $objViaje->setAgregarPasajero($arrPasajero);
            echo "desea agregar otro pasajero? Si(ENTER) ";
            $flag = trim(fgets(STDIN));
        }else{
            Echo "No hay mas lugar en este viaje. \n";
            $flag = "s";
        }    
    }while ($flag == "");
}
/**
 * Pide los datos del viaje nuevo, los guarda en un array 
 * que retorna para crear la instancia nueva
 */
function crearViaje(){
    //array $arrViaje
    $arrViaje = [];
    echo "\n--- Ingrese los datos del viaje ---\n";
    echo "Codigo: ";
    $arrViaje[0] = trim(fgets(STDIN));
    echo "Destino: ";
    $arrViaje[1] = trim(fgets(STDIN));
    echo "Capacidad maxima de pasajeros: ";
    $arrViaje[2] = trim(fgets(STDIN));
    //$arrObjViajes[$i] = new Viaje($arrViaje);
   // $objViaje->setCrearViaje($arrViaje);  
    return $arrViaje;
}
/**
 * Visualiza el menu de opciones en la pantalla, le solicita al usuario una opcion
 * valida, si la opcion no es valida vuelve a pedirla. Retorna el numero de la opcion
 * No tiene parametros formales
 * @return int
 */
function seleccionarOpcion(){
    //int $opcionMenu

    echo "\n*********MENU DE OPCIONES*********\n
    (1) Nuevo Viaje\t(2) Agregar Pasajero\t(3) Mostrar Viaje\t(4) Mostrar lista pasajeros\t(5) Modificar viaje\t(6) Modificar pasajero
    (7) \t
    (8) Salir\n
    ***********************************************\n";
    echo "    Ingrese una opción del menú: ";
    //$opcionMenu = solicitarNumeroEntre(1,8);
    $opcionMenu = trim(fgets(STDIN));
    return $opcionMenu;
}

/**
 * Menu de opciones para el viaje
 * Crear el viaje
 * Agregar pasajero
 * Buscar pasajero
 * Borrar pasajero
 * Mostrar lista completa
 * Salir
 */
    $opcion = "";
    do{
        $opcion = seleccionarOpcion();
         switch ($opcion){
            case 1:
                echo "Opcion 1   *** Elaborar nuevo Viaje ***\n";
                $arrDatosViaje = crearViaje();
                $ViajeNuevo = new Viaje($arrDatosViaje);
                array_push ($arrListaViajes, $ViajeNuevo);
                echo "\n........................";
                //$opcion = trim(fgets(STDIN));
                break; 
            case 2:
                echo "Opcion 2   *** Agregar pasajero ***\n";
                if(count($arrListaViajes)!=0){
                    foreach ($arrListaViajes as $i => $objetoViaje){
                       mostrarDatosViaje($arrListaViajes[$i]);
                    }      
                }else{
                    echo "No hay datos para mostrar";
                    break;
                }
                echo "Seleccione el codigo del viaje: ";
                $codViaje = trim(fgets(STDIN));
                foreach ($arrListaViajes as $i => $objetoViaje){
                    if ($codViaje == $objetoViaje->getCodigoViaje()){
                        agregarPasajero($arrListaViajes[$i]);
                    }
                } 
                echo "\n........................";
                break;  
            case 3:
                echo "Opcion 3   *** Mostrar Viaje ***\n";
                if(count($arrListaViajes)!=0){
                    foreach ($arrListaViajes as $i => $objetoViaje){
                       mostrarDatosViaje($arrListaViajes[$i]);
                    }      
                }else{
                    echo "No hay datos para mostrar";
                }
                echo "\n.....................";
                //$opcion = trim(fgets(STDIN));
                break;   
            case 4:
                echo "Opcion 4   *** Mostrar lista de pasajeros ***\n";
                if(count($arrListaViajes)!=0){
                    foreach ($arrListaViajes as $i => $objetoViaje){
                       mostrarDatosViaje($arrListaViajes[$i]);
                    }      
                }else{
                    echo "No hay datos para mostrar";
                    break;
                }
                echo "Seleccione el codigo del viaje: ";
                $codViaje = trim(fgets(STDIN));
                foreach ($arrListaViajes as $i => $objetoViaje){
                    if ($codViaje == $objetoViaje->getCodigoViaje()){
                        mostrarListaPasajeros($arrListaViajes[$i]);
                    }
                } 
                echo "\n........................";
                break; 
            case 5:
                    echo "Opcion 5   *** Modificar Viaje ***\n";
                    if(count($arrListaViajes)!=0){
                        foreach ($arrListaViajes as $i => $objetoViaje){
                           mostrarDatosViaje($arrListaViajes[$i]);
                        }      
                    }else{
                        echo "No hay datos para mostrar";
                    }
                    echo "Seleccione el codigo del viaje: ";
                $codViaje = trim(fgets(STDIN));
                foreach ($arrListaViajes as $i => $objetoViaje){
                    if ($codViaje == $objetoViaje->getCodigoViaje()){
                        echo "Codigo: ";
                        $arrModifDatos[0] = trim(fgets(STDIN));
                        echo "Destino: ";
                        $arrModifDatos[1] = trim(fgets(STDIN));
                        echo "Pasajeros Maximos: ";
                        $arrModifDatos[2] = trim(fgets(STDIN));
                        $arrListaViajes[$i]->setModificarViaje($arrModifDatos);
                        mostrarDatosViaje($arrListaViajes[$i]);
                    }
                } 
                break;
            case 6:
                echo "Opcion 6   *** Modificar Pasajero ***\n";
                if(count($arrListaViajes)!=0){
                    foreach ($arrListaViajes as $i => $objetoViaje){
                        mostrarDatosViaje($arrListaViajes[$i]);
                    }      
                }else{
                    echo "No hay datos para mostrar";
                    break;
                }
                echo "Seleccione el codigo del viaje: ";
                $codViaje = trim(fgets(STDIN));
                foreach ($arrListaViajes as $i => $objetoViaje){
                    if ($codViaje == $objetoViaje->getCodigoViaje()){
                        mostrarListaPasajeros($arrListaViajes[$i]);
                        echo "Seleccione el dni del pasajero: ";
                        $codDni = trim(fgets(STDIN));
                        $arrayPasajeros = $objetoViaje->getDatosPasajeros();
                        foreach ($arrayPasajeros as $n => $dni){
                            if ($arrayPasajeros[$n]["Dni"] == $codDni){
                                echo "Nombre: ";
                                $arrayPasajeros[$n]["Nombre"] = trim(fgets(STDIN));
                                echo "Apellido: ";
                                $arrayPasajeros[$n]["Apellido"] = trim(fgets(STDIN));
                                echo "DNI: ";
                                $arrayPasajeros[$n]["Dni"] = trim(fgets(STDIN));
                            }
                            //echo "D..... ". $arrayPasajeros[$n]["Dni"];
                        }

                        $objetoViaje->setDatosPasajeros($arrayPasajeros);
                    }
                }
                echo "\n.....................";
                break;
            case 8:
                echo "\nGracias...\n";
                break;                
        }                                              
    } while ($opcion != 8);




//echo "Cant Pax ... " . $viajeFeliz->getCantPasajeros(). "\n";
//echo "\n\n  Saliendo ......" . $viajeFeliz;
//echo $viajeFeliz->getMaxPasajeros();

