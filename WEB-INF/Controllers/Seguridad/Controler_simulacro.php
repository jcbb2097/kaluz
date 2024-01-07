<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/Simulacro.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Simulacro();
     if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $obj->setEstatus(0);
    if(isset($parametros['tipo_S'])){
        $obj->settipo_S($parametros['tipo_S']);
        $obj->setubicacion($parametros['ubicacion']);
        $obj->setfecha($parametros['fecha']);
        $obj->setPersonase($parametros['Personase']);
        $obj->setPersonasne($parametros['Personasne']);
        $obj->setPersonasp($parametros['Personasp']);
        $obj->setTiempoe($parametros['Tiempoe']);
    }
    switch ($_POST['accion']) {
        case 'guardar':
            if($obj->corroborarSimulacro()){
                if ($obj->nuevoSimulacro()) {
                    echo "Éxito: Simulacro guardado correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar el Simulacro.';
                }
            }
            else{
                echo "Error: El Simulacro ya se encuentra registrado";
            }
            break;
        case 'editar':
            $obj->setSimulacroid($_POST['id']);
            if ($obj->editarSimulacro()) {
                echo 'Éxito: Simulacro guardado correctamente.';
            } else {
                echo 'Error: No se ha podido guardar el Simulacro.';
            }
            break;
        case 'eliminar':
            $obj->setSimulacroid($_POST['id']);
           
            if ($obj->eliminarSimulacro()) {
                echo 'Éxito: Se ha eliminado el Simulacro.';
            } else {
                echo 'Error: No se ha podido eliminar el Simulacro.';
            }
            break;
    }
}