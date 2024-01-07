<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('../../Classes/Dispositivos.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Dispositivos();
     if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
    }
    $obj->setEstatusBien(1);
    if(isset($parametros['Tdispositivo'])){
    $obj->setTdispositivo($parametros['Tdispositivo']);
    $obj->setEje($parametros['Eje']);
   
        $obj->setPersonau($parametros['Personau']);

    $obj->setarea($parametros['area']);
    $obj->setPersonar($parametros['Personar']);
    $obj->setActividadM($parametros['ActividadM']);
    if(isset($parametros['Inventario'])){
        $obj->setInventario($parametros['Inventario']);
    }else{
         $obj->setInventario("");
    }
    if(isset($parametros['Ncontrol'])){
        $obj->setNcontrol($parametros['Ncontrol']);
    }else{
         $obj->setNcontrol("");
    }
    if(isset($parametros['Nserie'])){
        $obj->setNserie($parametros['Nserie']);
    }else{
         $obj->setNserie("");
    }
    $obj->setMarca($parametros['Marca']);
    $obj->setModelo($parametros['Modelo']);
    $obj->setEstatus($parametros['Estatus']);
    $obj->setObservacion($parametros['Observacion']);
    $obj->setAdquisicion($parametros['Adquisicion']);
    $obj->setAccesorio($parametros['Accesorio']);
    $obj->setValor($parametros['Valor']);
    $obj->setubicacion($parametros['ubicacion']);
    $obj->setUltimar($parametros['Ultimar']);
    $obj->setProximar($parametros['Proximar']);
    $obj->setiddisp($parametros['id_disp']);
    if($parametros['Tdispositivo']==6){
        $obj->setEstatus($parametros['Estatus']);
        $obj->setAgente($parametros['Agente']);
        $obj->setEstatus($parametros['Estadoe']);
    }else{
        $obj->setAgente(0);
        $obj->setEstadoe(0);
    }
    $obj->setColor($parametros['Color']);

    $obj->setsenalamiento($parametros['senalamiento']);
    $obj->setSoporte($parametros['Soporte']);
    $obj->setEmpresar($parametros['Empresar']);
    $obj->setCapacidad($parametros['Capacidad']);
    $obj->setIncidente($parametros['Incidente']);
    $obj->setReemplazo($parametros['Reemplazo']);
    $obj->setidTipodeincidencia($parametros['Incidencia']);
    $obj->setidMantenimiento($parametros['Mantenimiento']);
    $obj->setid_Trabajosrealizados($parametros['Trabajosr']);
    $obj->setProveedor($parametros['Proovedor']);
    if(isset($parametros['exposicion']) and $parametros['exposicion']!=""){
        $obj->setidExposicion($parametros['exposicion']);
    }else{
        $obj->setidExposicion(0);
    }
    if(isset($parametros['fechaIncidente']) and $parametros['fechaIncidente']!=""){
        $obj->setfechaIncidente($parametros['fechaIncidente']);
    }else{
         $obj->setfechaIncidente("0000-00-00");
    }

    $obj->setfecha_p_hidrostatica($parametros['Ultimarp']);
    $obj->setfecha_pp_hidrostatica($parametros['Proximarp']);
    $obj->setempresaRecargo($parametros['Empresar']);
    $obj->setpresionenzonaverde($parametros['zonaverde']);
    
    }
    
    switch ($_POST['accion']) {
        case 'guardar':
            if($parametros['Tdispositivo']==6){
                if ($obj->nuevoExtintor()) {
                    echo "Éxito: Dispositivo guardado correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar el Dispositivo.';
                }
            }
            else{
                 if ($obj->nuevoDispositivos()) {
                    echo "Éxito: Dispositivo guardado correctamente.";
                } else {
                    echo 'Error: No se ha podido guardar el Dispositivo.';
                }
            }
           
            break;
        case 'editar':
            $obj->setdispositivoid($_POST['id']);
            if($parametros['Tdispositivo']==6){
               if ($obj->editarExtintor()) {
                    echo 'Éxito: Dispositivo editado correctamente.';
                } else {
                    echo 'Error: No se ha podido Editar el Dispositivo.';
                }
            }else{
                
                if ($obj->editarDispositivos()) {
                    echo 'Éxito: Dispositivo editado correctamente.';
                } else {
                    echo 'Error: No se ha podido Editar el Dispositivo.';
                }
            }
            break;
        case 'eliminar':
            $obj->setdispositivoid($_POST['id']);
            if($_POST['dispositivo']==6){
                if ($obj->eliminarExtintores()) {
                    echo 'Éxito: Se ha eliminado el Dispositivo.';
                } else {
                    echo 'Error: No se ha podido eliminar el Dispositivo.';
                }
            }
            else{
                if ($obj->eliminarDispositivos()) {
                    echo 'Éxito: Se ha eliminado el Dispositivo.';
                } else {
                    echo 'Error: No se ha podido eliminar el Dispositivo.';
                }
            }
            break;
    }
}