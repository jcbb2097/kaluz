<?php
/*ini_set("memory_limit", "1024M");
set_time_limit(0);
if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../index.php");
}*/
include_once("../../Classes/Catalogo.class.php");
include_once ('../../Classes/Entregable.class.php');
$catalogo = new Catalogo();
//echo 'Controller';
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Entregable();
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            
            $obj->setNombre($parametros['nombre']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setIdProyecto($parametros['eje']);
            $obj->setIdConcepto($parametros['actividad']);
            $obj->setFechaInicio($parametros['fechaInicio']);
            $obj->setFechaFinEstimada($parametros['fechaEntregaEstimada']);
            $obj->setIdEstatus($parametros['estatus']);
            $obj->setIdPeriodo($parametros['periodo']);
            $obj->setFechaInicioReal($parametros['fechaInicioReal']);
            $obj->setFechaFinReal($parametros['fechaEntregaReal']);
            $obj->setUsuarioCreacion($_COOKIE['user']);
            $obj->setUsuarioModificacion($_COOKIE['user']);
            $obj->setPantalla('Controler_Entregable.php');
                  
            if($obj->nuevoRegistro()){
           
                echo 'Éxito: El entregable se agregó correctamente';
                    
            } else {
                echo 'Error: No se pudo agregar el entregable';
            }
                
            
            break;
        case 'editar':
            $obj->setIdEntregable($_POST['IdEntregable']);
           
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
          
            
           $obj->setNombre($parametros['nombre']);
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setIdProyecto($parametros['eje']);
            $obj->setIdConcepto($parametros['actividad']);
            $obj->setFechaInicio($parametros['fechaInicio']);
            $obj->setFechaFinEstimada($parametros['fechaEntregaEstimada']);
            $obj->setIdEstatus($parametros['estatus']);
            $obj->setIdPeriodo($parametros['periodo']);
            $obj->setFechaInicioReal($parametros['fechaInicioReal']);
            $obj->setFechaFinReal($parametros['fechaEntregaReal']);
            $obj->setUsuarioCreacion($_COOKIE['user']);
            $obj->setUsuarioModificacion($_COOKIE['user']);
            $obj->setPantalla('Controler_Entregable.php');       
            
            if($obj->editarRegistro()){
                    
                echo 'Éxito: El entregable se editó correctamente';
                    
            } else {
                echo 'Error: No se pudo editar el entregable';
            }
            break;
            
        case 'eliminar':
            $obj->setIdEntregable($_POST['IdEntregable']);
            
            if($obj->eliminarInsumos()){
                if($obj->eliminarAcciones()){
                    if($obj->eliminarCaracteristicas()){
                        if($obj->eliminarRegistro()){

                                echo 'Éxito: El entregable se eliminó';

                        }else{
                                echo 'Error: No se pudo eliminar el entregable';
                        }
                    }else{
                       echo 'Error: No se pudo eliminar el entregable'; 
                    }    
                }else{
                    echo 'Error: No se pudo eliminar el entregable';
                }    
            }else{
                 echo 'Error: No se pudo eliminar el entregable';
            }    
        break;    
    }       
}

