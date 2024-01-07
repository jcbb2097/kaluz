<?php
ini_set("memory_limit", "1024M");
set_time_limit(0);
if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../index.php");
}
include_once("../../Classes/Catalogo.class.php");
include_once ('../../Classes/CaracteristicasEntregable.class.php');
$catalogo = new Catalogo();
//echo 'Controller';
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new CaracteristicasEntregable();
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setIdEntregable($_POST['IdEntregable']);
            $obj->setIdCaracteristicas($parametros['caracteristica']);
            $obj->setIdResponsableVbo($parametros['responsable']);
            $obj->setFechaVbo($parametros['fechaRevisado']);
           if (isset($parametros['cumple']) && $parametros['cumple'] == 'on') {
                        
                $obj->setVbo(1); /*NOTA*/
            } else {
                        
                $obj->setVbo(0); /*NOTA*/
            }
            if($obj->nuevoRegistro()){
           
                echo 'Éxito: La característica se agregó correctamente al entregable';
                    
            } else {
                echo 'Error: No se pudo agregar la característica al entregable, ya existe';
            }
                
            
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
          
           $obj->setIdEntregableCaracteristicas($_POST['IdEntregableCaracteristicas']); 
           $obj->setIdEntregable($_POST['IdEntregable']);
            $obj->setIdCaracteristicas($parametros['caracteristica']);
            $obj->setIdResponsableVbo($parametros['responsable']);
            $obj->setFechaVbo($parametros['fechaRevisado']);
           if (isset($parametros['cumple']) && $parametros['cumple'] == 'on') {
                        
                $obj->setVbo(1); /*NOTA*/
            } else {
                        
                $obj->setVbo(0); /*NOTA*/
            }
            
            if($obj->editarRegistro()){
                    
                echo 'Éxito: La característica del entregable se editó correctamente';
                    
            } else {
                echo 'Error: No se pudo editar la característica del entregable, ya existe';
            }
            break;
            
        case 'eliminar':
            $obj->setIdEntregableCaracteristicas($_POST['IdEntregableCaracteristicas']); 
            if($obj->eliminarRegistro()){
                
                    echo 'Éxito: La característica del entregable se eliminó';
               
            }else{
                    echo 'Error: No se pudo eliminar la característica del entregable';
            }
        break;    
    }       
}

