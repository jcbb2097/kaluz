<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/ubicaciones.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Ubicacion();
     if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
        
       

    switch ($_POST['accion']) {
        case 'guardar':
             $obj->setnombre($parametros['nombre']);
            $obj->setdescripcion($parametros['descripcion']);
            $obj->setid_sede($parametros['Sede']);
            if($obj->corroborarUbicacion()){
                if ($obj->nuevoUbicacion()) {
                    echo "Éxito: Ubicación guardada correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar la ubicación.';
                }
            }
            else{
                echo "Error: La ubicación ya se encuentra registrado";
            }
            break;
        case 'editar':
             $obj->setnombre($parametros['nombre']);
            $obj->setdescripcion($parametros['descripcion']);
            $obj->setid_sede($parametros['Sede']);
            $obj->setubicacionid($_POST['id']);
            if ($obj->editarUbicacion()) {
                echo 'Éxito: Ubicación guardada correctamente.';
            } else {
                echo 'Error: No se ha podido guardar la ubicación.';
            }
            break;
        case 'eliminar':
            $obj->setubicacionid($_POST['id']);
           
            if ($obj->eliminarUbicacion()) {
                echo 'Éxito: Se ha eliminado la ubicación.';
            } else {
                echo 'Error: No se ha podido eliminar la ubicación.';
            }
            break;
    }
}