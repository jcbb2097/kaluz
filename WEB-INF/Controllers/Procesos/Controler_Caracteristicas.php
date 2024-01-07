<?php
ini_set("memory_limit", "1024M");
set_time_limit(0);
if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../index.php");
}
include_once("../../Classes/Catalogo.class.php");
include_once ('../../Classes/Caracteristicas.class.php');
$catalogo = new Catalogo();
//echo 'Controller';
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Caracteristicas();
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            
           
            $obj->setDescripcion($parametros['descripcion']);
          
            $obj->setUsuarioCreacion($_COOKIE['user']);
            $obj->setUsuarioModificacion($_COOKIE['user']);
            $obj->setPantalla('Controler_Caracteristicas.php');
                  
            if($obj->nuevoRegistro()){
           
                echo 'Éxito: La característica se agregó correctamente';
                    
            } else {
                echo 'Error: No se pudo agregar la característica';
            }
                
            
            break;
        case 'editar':
            $obj->setIdCaracteristica($_POST['IdCaracteristicas']);
            //echo '<br><br>'.$_POST['idUsuario'].'<br><br>';
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
          
            
            $obj->setDescripcion($parametros['descripcion']);
          
             $obj->setUsuarioModificacion($_COOKIE['user']);
            $obj->setPantalla('Controler_Caracteristicas.php');
            
            
            if($obj->editarRegistro()){
                    
                echo 'Éxito: La característica se editó correctamente';
                    
            } else {
                echo 'Error: No se pudo editar la caracteística';
            }
            break;
        case 'eliminar':
            $obj->setIdCaracteristica($_POST['IdCaracteristica']);
           
            if($obj->eliminarRegistro()){
                
                    echo 'Éxito: Característica eliminado';
               
            }else{
                    echo 'Error: No se pudo eliminar la característica';
            }
        break;    
    }       
}

