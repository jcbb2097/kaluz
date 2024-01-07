<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once('../../Classes/HoraExtra.class.php');
$catalogo = new Catalogo();
$obj = new Horasextras();

if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
                $obj->setIdEquipoTrabajo($parametros['Personal']);
                $obj->setIdConcepto($parametros['ActvGlobal']);
                $obj->setIdProyecto($parametros['Eje']);

                if (isset($parametros['categoria']) && $parametros['categoria'] != "") {
                $obj->setcategoria($parametros['categoria']);
                }else {
                $obj->setcategoria('NULL');
                }  

                if (isset($parametros['subcategoria']) && $parametros['subcategoria'] != "") {
                $obj->setsubcategoria($parametros['subcategoria']);
                }else {
                $obj->setsubcategoria('NULL');
                }

                if (isset($parametros['actividadmeta']) && $parametros['actividadmeta'] != "") {
                $obj->settipoactividad($parametros['actividadmeta']);
                }else {
                $obj->settipoactividad('NULL');
                }


                $obj->setIdArea($parametros['Area']);

                if ($parametros['ActvGeneral'] != "") {
                    $obj->setIdConcepto2($parametros['ActvGeneral']);
                } else {
                    $obj->setIdConcepto2("NULL");
                }
                if (isset($parametros['ActvParticular']) && $parametros['ActvParticular'] != "") {
                    $obj->setIdConcepto3($parametros['ActvParticular']);
                } else {
                    $obj->setIdConcepto3("NULL");
                }
                if (isset($parametros['SubActividad']) && $parametros['SubActividad'] != "") {
                    $obj->setIdConcepto4($parametros['SubActividad']);
                } else {
                    $obj->setIdConcepto4("NULL");
                }
                if ($parametros['expo'] != "") {
                    $obj->setExpo($parametros['expo']);
                } else {
                    $obj->setExpo("NULL");
                }
                
                $obj->setJustificación($parametros['Justificacion']);
                $obj->setTiempo($parametros['time']);
                $obj->setCostos($parametros['Costos']);
                $obj->setFecha($parametros['fecha']);
                $obj->setPantalla("Controlador Horas Extra");
                $obj->setUsuariocreacion("SIE");
                $obj->setUsuarioultimacreacion("SIE");
                $obj->setPeriodo($parametros['ano']);
                if ($obj->agregarHorasextras()) {
                    echo "El registro se guardo correctamente";
                } else {
                    echo 'El registro no se ha podido agregar';
                }
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setId_horasextras($_POST['id']);
            $obj->setIdEquipoTrabajo($parametros['Personal']);
            $obj->setIdConcepto($parametros['ActvGlobal']);
            $obj->setIdProyecto($parametros['Eje']);

            if (isset($parametros['categoria']) && $parametros['categoria'] != "") {
                $obj->setcategoria($parametros['categoria']);
                }else {
                $obj->setcategoria('NULL');
                }  

                if (isset($parametros['subcategoria']) && $parametros['subcategoria'] != "") {
                $obj->setsubcategoria($parametros['subcategoria']);
                }else {
                $obj->setsubcategoria('NULL');
                }

                if (isset($parametros['actividadmeta']) && $parametros['actividadmeta'] != "") {
                $obj->settipoactividad($parametros['actividadmeta']);
                }else {
                $obj->settipoactividad('NULL');
                }

            $obj->setIdArea($parametros['Area']);
            if ($parametros['ActvGeneral'] != "") {
                $obj->setIdConcepto2($parametros['ActvGeneral']);
            } else {
                $obj->setIdConcepto2("NULL");
            }
            if (isset($parametros['ActvParticular']) && $parametros['ActvParticular'] != "") {
                    $obj->setIdConcepto3($parametros['ActvParticular']);
                } else {
                    $obj->setIdConcepto3("NULL");
                }
                if (isset($parametros['SubActividad']) && $parametros['SubActividad'] != "") {
                    $obj->setIdConcepto4($parametros['SubActividad']);
                } else {
                    $obj->setIdConcepto4("NULL");
                }
            if ($parametros['expo'] != "") {
                $obj->setExpo($parametros['expo']);
            } else {
                $obj->setExpo("NULL");
            }

            $obj->setPeriodo($parametros['ano']);
            $obj->setJustificación($parametros['Justificacion']);
            $obj->setTiempo($parametros['time']);
            $obj->setCostos($parametros['Costos']);
            $obj->setFecha($parametros['fecha']);
            $obj->setUsuarioultimacreacion("SIE");
            if ($obj->editarHorasextras()) {
                echo 'Éxito: El registro ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el registro';
            }
            break;
        case 'eliminar':
            $obj->setId_horasextras($_POST['id']);
            if ($obj->eliminarHorasextras()) {
                echo 'Éxito: Se ha eliminado el registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
}
