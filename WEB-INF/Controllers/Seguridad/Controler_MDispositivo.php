<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/MDispositivo.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new MDispositivo(); 
     if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $obj->setEstatus(0);
    if(isset($parametros['nombre'])){
        $obj->setnombre($parametros['nombre']);
        $obj->setidEje($parametros['Eje']);
        $obj->setidArea($parametros['area']);
        $obj->setidConcepto($parametros['actividadm']);
        $obj->setnumero($parametros['ndispositivo']);
    
    }
    switch ($_POST['accion']) {
        case 'guardar':
            if($obj->corroborarMDispositivo()){
                if ($obj->nuevoMDispositivo()) {
                    echo "Éxito: Meta guardado correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar el Meta.';
                }
            }
            else{
                echo "Error: El Meta ya se encuentra registrado";
            }
            break;
        case 'editar':
            $obj->setMid($_POST['id']);
            if ($obj->editarMDispositivo()) {
                echo 'Éxito: Meta guardado correctamente.';
            } else {
                echo 'Error: No se ha podido guardar el Meta.';
            }
            break;
        case 'eliminar':
            $obj->setMid($_POST['id']);
            if ($obj->eliminarMDispositivo()) {
                echo 'Éxito: Se ha eliminado el Meta.';
            } else {
                echo 'Error: No se ha podido eliminar el Meta.';
            }
            break;
    }
}