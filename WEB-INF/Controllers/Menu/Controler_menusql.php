<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/Perfil_menu.class.php");
include_once("../../Classes/Perfil_submenu.class.php");

$obj = new Perfil_menu();
$obj2 = new Perfil_submenu();
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //insertamos en la tabla k_perfil_menu
            $obj->setId_perfil($parametros['perfil']);
            $obj->setId_menu($parametros['Menu']);
            if (isset($parametros['cc']) && $parametros['cc'] == 'on') {
                $obj->setConsulta(1);
            } else {
                $obj->setConsulta(0);
            }
            //insertamos en la tabla k_perfil_submenu
            $obj2->setId_perfil($parametros['perfil']);
            $obj2->setId_submenu($parametros['Sub_Menu']);
            if (isset($parametros['a']) && $parametros['a'] == 'on') {
                $obj2->setAlta(1);
            } else {
                $obj2->setAlta(0);
            }
            if (isset($parametros['b']) && $parametros['b'] == 'on') {
                $obj2->setBaja(1);
            } else {
                $obj2->setBaja(0);
            }
            if (isset($parametros['c']) && $parametros['c'] == 'on') {
                $obj2->setCambio(1);
            } else {
                $obj2->setCambio(0);
            }
            $obj2->Nuevo_perfil_submenu();
            if ($obj->Nuevo_perfil_menu()) {
                echo "Permiso guardado correctamente";
            } else {
                echo 'Error: al guardar';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_perfil($parametros['perfil']);
            $obj->setId_menu($parametros['Menu']);
            if (isset($parametros['cc']) && $parametros['cc'] == 'on') {
                $obj->setConsulta(1);
            } else {
                $obj->setConsulta(0);
            }
            $obj2->setId_perfil($parametros['perfil']);
            $obj2->setId_submenu($parametros['Sub_Menu']);
            if (isset($parametros['a']) && $parametros['a'] == 'on') {
                $obj2->setAlta(1);
            } else {
                $obj2->setAlta(0);
            }
            if (isset($parametros['b']) && $parametros['b'] == 'on') {
                $obj2->setBaja(1);
            } else {
                $obj2->setBaja(0);
            }
            if (isset($parametros['c']) && $parametros['c'] == 'on') {
                $obj2->setCambio(1);
            } else {
                $obj2->setCambio(0);
            }
            $obj2->Editar_perfil_submenu();
            if ($obj->Editar_perfil_submenu()) {
                echo "Permiso editado correctamente";
            } else {
                echo 'Error: al editar';
            }
            break;
        case 'eliminar':
            echo 'eliminar';
            break;
    }
}
