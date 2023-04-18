<?php
include_once 'Viaje.php';
include_once 'Pasajero.php';
include_once 'ResponsableV.php';

// Arreglo para contener todos las instancias Viaje
$arrListaViajes = array();
$unResponsable = new ResponsableV(345,"B356F","Ana","Perez");
$unViaje = new Viaje(10,"Lejos",$unResponsable,7);
$pasajeroUno = new Pasajero("Yo","Aaa",22222,2994564565);
$pasajeroDos = new Pasajero("Tu","Bbb",33333,2995000999);
$unViaje->setAgregarPasajero($pasajeroUno);
$unViaje->setAgregarPasajero($pasajeroDos);
$arrListaViajes[]= $unViaje;


/*************************************************************************************/
/**
 * Pide al objeto mediante el metodo .... el array de pasajeros y muestra una lista
 * de los datos de los pasajeros
 */
function mostrarListaPasajeros($objViaje){ 
    //int $indice
    //int $valor
    $arrListaPasajeros = $objViaje->getColPasajeros();
    echo "Lista de Pasajeros.............. \n";
    foreach ($arrListaPasajeros as $i => $valor){
        echo $arrListaPasajeros[$i]."\n";
    } 
    echo "\nQuedan ". $objViaje->getMaxCantPasajeros() - $objViaje->getCantPasajeros()." lugares.\n " ;    
}
//******************************************************************

/**
 * Muestra los datos del viaje, Codigo, destino y cantidad maxima de pasajeros
 * @param $objViaje
 */
function mostrarDatosViaje($objViaje){
    echo "\n----------------- Datos del viaje ----------------\n";
    echo "Código: ". $objViaje->getCodigoViaje() . "\t";
    echo "Cantidad máxima de pasaje: ". $objViaje->getMaxCantPasajeros() . "\t";
    echo "Destino: ". $objViaje->getDestino() . "\n";
    echo $objViaje->getResponsableViaje();
    echo "\nQuedan ". $objViaje->getMaxCantPasajeros() - $objViaje->getCantPasajeros()." lugares.\n " ;
    echo "--------------------------------------------------\n";
}
/**
 * Mostrar todos los viajes
 * @param $arrListaViajes objeto con la lista de viajes
 */
function mostrarListaViajes($arrListaViajes){
    if(count($arrListaViajes)!=0){
        foreach ($arrListaViajes as $i => $objetoViaje){
           mostrarDatosViaje($arrListaViajes[$i]);
        }      
    }else{
        echo "No hay datos para mostrar";
    }
}

/**
 * Agregar pasajeros al array del objeto
 * @param $objViaje objeto
 */
function agregarPasajero($objViaje)
{
    //$unPasajero instancia de clase Pasajero
    //string $nom,  $ape
    //int $dni, $tel
    $flag = "";
    mostrarDatosViaje($objViaje);
    echo "\n--- Ingrese los PASAJEROS del Viaje ---\n";
    do{    
        if(($objViaje->getMaxCantPasajeros() - $objViaje->getCantPasajeros()) >= 1){
            echo "Nombre: ";
            $nom= trim(fgets(STDIN));
            echo "Apellido: ";
            $ape = trim(fgets(STDIN));
            echo "DNI: ";
            $dni = trim(fgets(STDIN));
            echo "Telefono: ";
            $tel = trim(fgets(STDIN));
            $unPasajero = new Pasajero($nom, $ape, $dni, $tel);
            if (!$objViaje->existePasajero($unPasajero)){
                $objViaje->setAgregarPasajero($unPasajero);
                echo "desea agregar otro pasajero? (SI=ENTER)(NO = Cualquier tecla) ";
                $flag = trim(fgets(STDIN));
            }else{
                echo "Ese DNI ya esta cargado en el viaje, NO se cargo nada.\n";
            }
        }else{
            echo "No hay mas lugar en este viaje. \n";
            $flag = "s";
        }    
    }while ($flag == "");
}

/**
 * Pide los datos del viaje nuevo, los guarda en un array 
 * que retorna para crear la instancia nueva
 */
function crearViaje(){
    echo "\n--- Ingrese los datos del viaje ---\n";
    echo "Codigo: ";
    $cod = trim(fgets(STDIN));
    echo "Destino: ";
    $des = trim(fgets(STDIN));
    echo "Responsable: ";
    $res = crearResponsable();
    echo "Capacidad maxima de pasajeros: ";
    $max = trim(fgets(STDIN));
    //$arrObjViajes[$i] = new Viaje($arrViaje);
   // $objViaje->setCrearViaje($arrViaje);  
   $unViaje = new Viaje($cod,$des,$res,$max);
    return $unViaje;
}

/**
 * Pide los datos de la persona responsable de viaje,
 * crea el objeto $elResponsable y lo retorna
 */
function crearResponsable(){
    echo "Numero de Empleado: ";
    $num = trim(fgets(STDIN));
    echo "Licencia: ";
    $lic = trim(fgets(STDIN));
    echo "Nombre: ";
    $nom = trim(fgets(STDIN));
    echo "Apellido: ";
    $ape = trim(fgets(STDIN));
    $elResponsable = new ResponsableV($num, $lic, $nom, $ape);
    return $elResponsable;
}

/**
 * Pide los datos de la persona responsable de viaje,
 * crea el objeto $elResponsable y lo retorna
 */
function modificarResponsable(){
    echo "Numero de Empleado: ";
    $num = trim(fgets(STDIN));
    echo "Licencia: ";
    $lic = trim(fgets(STDIN));
    echo "Nombre: ";
    $nom = trim(fgets(STDIN));
    echo "Apellido: ";
    $ape = trim(fgets(STDIN));
    $elResponsable = new ResponsableV($num, $lic, $nom, $ape);
    return $elResponsable;
}

/**
 * Buscar y retornar el indice del array de viajes a partir del codigo de viaje
 * retorna -1 si no existe el codigo de viaje
 */
function buscarViaje($cod,$obj){
    $bandera = false;
    $i = 0;
    do{
        if ($cod == $obj[$i]->getCodigoViaje()){
            $bandera = true;}
        $i++;    
    }while(($bandera == false) && ($i < count($obj))) ;
    if ($bandera == true){
        $i = $i-1; //resta 1 para ajustar el indice al array
    }else{
        $i = -1;
    }
    return $i;
}

/**
 * 
 */
function indiceViajes($objViajes){
    mostrarListaViajes($objViajes);
    echo "Seleccione el codigo del viaje: ";
    $cod = trim(fgets(STDIN));
    $ind = buscarViaje($cod, $objViajes);
    return $ind;
}

/**
 * Ingresar una tecla para volver al menu
 */
function volver(){
    $op = "";
    echo "\nPresione ENTER para ir al menu...";
    $op = trim(fgets(STDIN));
    return;
}
/**
 * Visualiza el menu de opciones en la pantalla, le solicita al usuario una opcion
 * valida, si la opcion no es valida vuelve a pedirla. Retorna el numero de la opcion
 * No tiene parametros formales
 * @return int
 */
function seleccionarOpcion(){
    //int $opcionMenu

    echo "\n\t*********MENU DE OPCIONES*********\n";
    echo "- Opciones Viajes              -----> (1) Nuevo           (2) Mostrar     (3) Modificar\n\n";
    echo "- Opciones Pasajeros           -----> (4) Mostrar lista   (5) Agregar     (6) Modificar ó Eliminar\n\n";
    echo "- Opciones Persona Responsable -----> (7) Agregar         (8) Modificar\n";
    echo "(0) Salir\n";
    echo "***********************************************\n";
    echo "    Ingrese una opción del menú: ";
    //$opcionMenu = solicitarNumeroEntre(1,8);
    $opcionMenu = trim(fgets(STDIN));
    return $opcionMenu;
}

/**
 * Menu de opciones para el viaje
 */
    $opcion = "";
    $indice = 0;
    $existePasajero = false;
    do{
        $opcion = seleccionarOpcion();
         switch ($opcion){
            case 1:
                echo "Opcion 1   *** Elaborar nuevo Viaje ***\n";
                $ViajeNuevo = crearViaje();
                array_push ($arrListaViajes, $ViajeNuevo);
                echo "Viaje ingresado con exito...\n";
                break; 
            case 2:
                echo "Opcion 2   *** Mostrar Viaje ***\n";
                mostrarListaViajes($arrListaViajes);
                volver();
                break;  
            case 3:
                echo "Opcion 3   *** Modificar Viaje ***\n";
                $indice = indiceViajes($arrListaViajes);
                if ($indice >= 0){
                    echo "Codigo: ";
                    $teclado = trim(fgets(STDIN));
                    $arrListaViajes[$indice]->setCodigoViaje($teclado);
                    echo "Destino: ";
                    $teclado = trim(fgets(STDIN));
                    $arrListaViajes[$indice]->setDestino($teclado);
                    echo "Pasajeros Maximos: ";
                    $teclado = trim(fgets(STDIN));
                    $arrListaViajes[$indice]->setMaxCantPasajeros($teclado);
                    mostrarDatosViaje($arrListaViajes[$indice]);
                }else{
                    echo "No existe el codigo de viaje ...\n";
                }
                volver();
                break;     
            case 4:
                echo "Opcion 4   *** Mostrar lista de pasajeros ***\n";
                $indice = indiceViajes($arrListaViajes);
                if ($indice >= 0){
                    mostrarListaPasajeros($arrListaViajes[$indice]);
                    echo "\n........................";
                }else{
                    echo "No existe el codigo de viaje ...\n";
                }
                volver();
                break;                            
            case 5:
                echo "Opcion 5   *** Agregar pasajero ***\n";
                $indice = indiceViajes($arrListaViajes);
                if ($indice >= 0){
                    agregarPasajero($arrListaViajes[$i]);
                }else{
                    echo "No existe el codigo de viaje ...\n";
                }
                volver();
                break;   
            case 6:
                echo "Opcion 6   *** Modificar ó Eliminar Pasajero ***\n";
                do{
                    echo "Para (M)odificar ó (E)liminar\n";
                    $opcModEli = trim(fgets(STDIN));
                }while(!($opcModEli == "m" || $opcModEli == "e"));
                $indice = indiceViajes($arrListaViajes);
                $existePasajero = $arrListaViajes[$indice]->getHayPasajeros();
                if (($indice >= 0) && ($existePasajero)){
                    mostrarListaPasajeros($arrListaViajes[$indice]);
                    echo "Seleccione el dni del pasajero: ";
                    $codDni = trim(fgets(STDIN));
                    $arrayPasajeros = $arrListaViajes[$indice]->getColPasajeros();
                    if ($opcModEli == "m" || $opcModEli == "M"){
                        $n = 0;
                        $bandera = false;
                        do{
                            if ($arrayPasajeros[$n]->getDni() == $codDni){
                                echo "Nombre: ".$arrayPasajeros[$n]->getNombre().
                                    "  Desea Modificar? (SI=ENTER)(NO = Cualquier tecla)";
                                $teclado = trim(fgets(STDIN));    
                                if ($teclado == ""){
                                    echo "Nombre: ";
                                    $teclado = trim(fgets(STDIN));
                                    $arrayPasajeros[$n]->setNombre($teclado);
                                }    
                                echo "Apellido: ".$arrayPasajeros[$n]->getApellido().
                                "  Desea Modificar? (SI=ENTER)(NO = Cualquier tecla)";
                                $teclado = trim(fgets(STDIN));    
                                if ($teclado == ""){
                                    echo "Apellido: ";
                                    $teclado = trim(fgets(STDIN));
                                    $arrayPasajeros[$n]->setApellido($teclado);
                                } 
                                echo "Telefono: ".$arrayPasajeros[$n]->getTelefono().
                                "  Desea Modificar? (SI=ENTER)(NO = Cualquier tecla)";
                                $teclado = trim(fgets(STDIN));    
                                if ($teclado == ""){
                                    echo "Telefono: ";
                                    $teclado = trim(fgets(STDIN));
                                    $arrayPasajeros[$n]->setTelefono($teclado);
                                } 
                                $bandera = true;
                            }
                            $n++;
                        }while($bandera == false && $n < count($arrayPasajeros));   
                        if ($bandera == false){
                            echo "No se encontro el pasajero...\n";
                        }else{ 
                        $arrListaViajes[$indice]->setColPasajeros($arrayPasajeros);
                        }
                    }else{
                        $arrListaViajes[$indice]->borrarPasajero($codDni);
                    }
                }else if ($indice < 0){
                    echo "No existe el codigo de viaje ...\n";
                }else{
                    echo "No hay pasajeros en este viaje...\n";
                }
                volver();
                break;
            case 7:
                echo "Opcion 7: ***Agregar Responsable de Viaje***\n";
                $indice = indiceViajes($arrListaViajes);
                if ($indice >= 0){
                    $otroResponsable = crearResponsable();
                    $arrListaViajes[$indice]->setResponsableViaje($otroResponsable);
                }else{
                    echo "No existe el codigo de viaje ...\n";
                } 
                volver();  
                break;    
            case 8:
                echo "Opcion 7: ***Modificar el Responsable de Viaje***\n";
                $indice = indiceViajes($arrListaViajes);
                if ($indice >= 0){
                    $otroResponsable = modificarResponsable();
                    $arrListaViajes[$indice]->setResponsableViaje($otroResponsable);
                }else{
                    echo "No existe el codigo de viaje ...\n";
                } 
                volver();
                break;    
            case 0:
                echo "\nGracias...\n";
                break;                
        }                                              
    } while ($opcion != 0);


