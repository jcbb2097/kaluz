<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/categoria.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new categorias();
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setTipo($parametros['descripcion']);
            $obj->setActivo(1); /* NOTA */
            $obj->setUsuarioCreacion("SIE");
            $obj->setUsuarioUltimaModificacion("SIE");
            $obj->setPantalla('AltaCategoria.php');
            if ($obj->nuevaCategoria()) {

                echo "Categoría guardada correctamente";
            } else {
                echo 'Error al guardar';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_tipo($_POST['id']);
            $obj->setTipo($parametros['descripcion']);
            $obj->setActivo(1); /* NOTA */

            $obj->setUsuarioUltimaModificacion("SIE");
            if ($obj->editarCategoria()) {

                echo 'Éxito: la categoría a sido modificado';
            } else {
                echo 'Error: No se ha podido modificar la categoría';
            }
            break;
        case 'eliminar':
            $obj->setId_tipo($_POST['id']);
            if ($obj->eliminarCategoria()) {

                echo 'Éxito: Se ha eliminado la categoría';
            } else {
                echo 'Error: No se ha podido eliminar la categoría';
            }


            break;
    }
}
