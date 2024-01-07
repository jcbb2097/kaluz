<?php
ini_set("memory_limit", "1024M");
set_time_limit(0);
if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../index.php");
}
include_once("../../Classes/Catalogo.class.php");
include_once ('../../Classes/InsumoEntregable.class.php');
$catalogo = new Catalogo();
//echo 'Controller';
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new InsumoEntregable();
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setIdEntregable($_POST['IdEntregable']);
            $obj->setIdInsumo($parametros['nombreInsumo']);
           
           
            if($obj->nuevoRegistro()){
           
                echo 'Éxito: El insumo se agregó correctamente al entregable';
                    
            } else {
                echo 'Error: No se pudo agregar el insumo al entregable, ya existe';
            }
                
            
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setEntregableInsumo($_POST['IdEntregableInsumo']);
            $obj->setIdEntregable($_POST['IdEntregable']);
            $obj->setIdInsumo($parametros['nombreInsumo']);  
            
            
            if($obj->editarRegistro()){
                    
                echo 'Éxito: El insumo del entregable se editó correctamente';
                    
            } else {
                echo 'Error: No se pudo editar el insumo del entregable, ya existe';
            }
            break;
            
        case 'eliminar':
            
            //$obj->setIdEntregable($_POST['IdEntregable']);
            $obj->setEntregableInsumo($_POST['IdEntregableInsumo']);  
           
            if($obj->eliminarRegistro()){
                
                    echo 'Éxito: El insumo del entregable se eliminó';
               
            }else{
                    echo 'Error: No se pudo eliminar el insumo del entregable';
            }
        break;    
    }       
}

