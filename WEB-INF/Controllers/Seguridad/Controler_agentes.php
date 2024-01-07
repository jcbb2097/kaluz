<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/Agentes.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Agentes();
     if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $obj->setEstatus(0);
    if(isset($parametros['nombre'])){
    $obj->setNombre($parametros['nombre']);
    $obj->setDescripcion($parametros['descripcion']);
    $obj->setTf($parametros['tf']);}
    
    switch ($_POST['accion']) {
        case 'guardar':
            if($obj->corroborarAgente()){
                if ($obj->nuevoAgente()) {
                    echo "Éxito: Agente guardado correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar el Agente.';
                }
            }
            else{
                echo "Error: El Agente ya se encuentra registrado";
            }
            break;
        case 'editar':
            $obj->setAgentesid($_POST['id']);
            if ($obj->editarAgente()) {
                echo 'Éxito: Agente guardado correctamente.';
            } else {
                echo 'Error: No se ha podido guardar el Agente.';
            }
            break;
        case 'eliminar':
            $obj->setAgentesid($_POST['id']);
      
            if ($obj->eliminarAgente()) {
                echo 'Éxito: Se ha eliminado el Agente.';
            } else {
                echo 'Error: No se ha podido eliminar el Agente.';
            }
            break;
    }
}