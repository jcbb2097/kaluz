<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/Estatusd.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Estatusd(); 
     if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $obj->setEstatus(0);
    if(isset($parametros['Estatus'])){
        $obj->setEstatustx($parametros['Estatus']);
    }
    switch ($_POST['accion']) {
        case 'guardar':
            if($obj->corroborarEstatusd()){
                if ($obj->nuevoEstatusd()) {
                    echo "Éxito: Estatus guardado correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar el Estatus.';
                }
            }
            else{
                echo "Error: El Estatus ya se encuentra registrado";
            }
            break;
        case 'editar':
            $obj->setdispositivosod($_POST['id']);
            if ($obj->editarEstatusd()) {
                echo 'Éxito: Estatus guardado correctamente.';
            } else {
                echo 'Error: No se ha podido guardar el Estatus.';
            }
            break;
        case 'eliminar':
            $obj->setdispositivosod($_POST['id']);
            if ($obj->eliminarEstatusd()) {
                echo 'Éxito: Se ha eliminado el Estatus.';
            } else {
                echo 'Error: No se ha podido eliminar el Estatus.';
            }
            break;
    }
}