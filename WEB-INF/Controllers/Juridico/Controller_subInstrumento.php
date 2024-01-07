<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/InstrumentoJuridico.class.php");
$catalogo = new Catalogo();
$obj = new Instrumento();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setNombre($parametros['subInstrumento']);
            $obj->setTipo(2);
            $obj->setEstatus(1);
            if ($obj->nuevoInstrumento()) {
                echo "Registro guardado correctamente";
            } else {
                echo 'Error al guardar';
            }
           
           

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setIdInstrumento($_POST['id']);
            $obj->setNombre($parametros['subInstrumento']);
            if ($obj->editarInstrumento()) {
                echo "Registro editado correctamente";
            } else {
                echo 'Error al editar';
            }
            break;
        case 'eliminar':

            $obj->setIdInstrumento($_POST['id']);
            if ($obj->eliminarInstrumento()) {

                echo 'Éxito: Se ha eliminado el registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
}
