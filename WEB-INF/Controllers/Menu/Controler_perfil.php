<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/Perfil.class.php");

$obj = new Perfil();
$catalogo = new Catalogo();


if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setDescripcion($parametros['descripcion']);
            if ($obj->Nuevo_perfil()) {
                echo "Perfil guardado correctamente";
            }else{
                echo 'Error: No se ha podido añadir el perfil';
            }

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setIdPerfil($_POST['id']);
            if ($obj->Editar_perfil()) {
                echo "Perfil editado correctamente";
            }else{
                echo 'Error: No se ha podido editar el perfil';
            }

            break;
        case 'eliminar':
            $obj->setIdPerfil($_POST['id']);
            if ($obj->Eliminar_perfil()) {
                echo 'Éxito: Se ha eliminado el perfil';
            } else {
                echo 'Error: No se ha podido eliminar el perfil';
            }
            break;
    }
}
