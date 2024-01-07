<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/LogroResumenActividadPlan.class.php");
include_once("../../Classes/LogrosResumenPlan.class.php");
include_once("../../Classes/ChechList.class.php");
include_once __DIR__ . "/Validacion.php";
$catalogo = new Catalogo();
$obj = new Logro_actividad();
$obj2 = new Plan_resumen();
$obj3 = new check_list();
$num_resum = "";
$variable = "";
$variable2 = "";
$array_check = array();
$accion = "";
if ($_POST['accion'] != "") {
    $accion =  Validacion::sanearCadena($_POST['accion']);
}else{
    $accion =  Validacion::sanearCadena($_POST['action']);
}

if (isset($_POST['accion']) && $_POST['accion'] != "" || $accion != '') {
    switch ($accion) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $variable = $parametros['check_num'];
            $check;
            if ($variable > 0) {
                for ($i = 0; $i < $variable; $i++) {
                    $check = $obj3->check_existe($parametros['check' . $i]);
                    if ($check > 0) {
                        array_push($array_check, $check);
                    } else {
                        $obj3->setNombre($parametros['check' . $i]);
                        $obj3->nuevo_checklist();
                        $IDcheck = $obj3->getIdCheckList();
                        array_push($array_check, $IDcheck);
                    }
                }
                foreach ($array_check as $key => $value) {
                    $obj3->anadir_check_actividad($value, $parametros['actividad_global'], $parametros['Periodo']);
                }
            }
            $obj->setIdEje($parametros['eje']);
            $obj->setTitulo($parametros['titulo']);
            $obj->setResumen($parametros['logro']);
            $obj->setIdActividad($parametros['actividad_global']);
            $obj->setFecha_objetiva($parametros['fecha_check']);


            $obj->setIdArea($parametros['area']);
            $obj->setUsuarioCreacion("SIE");
            $obj->setUsuarioUltimaModificacion("SIE");
            $obj->setPantalla('Alta_logro_modal');
            $num_resum = $parametros['reumenes_num'];
            if ($obj->nuevoLogro()) {
                $IDIndicador = $obj->getIdLogroAct();
                $obj2->setId_planeacion($IDIndicador);
                $obj2->setResumen($parametros['logro']);
                $obj2->setOrden(1);
                if ($obj2->nuevoResumen()) {
                    echo "Planeación guardada correctamente";
                }
                if ($num_resum != 0) {
                    $orden = 2;
                    for ($i = 0; $i < $num_resum; $i++) {
                        $obj2->setId_planeacion($IDIndicador);
                        $obj2->setResumen($parametros['descripcion' . $i]);
                        $obj2->setOrden($orden);
                        $orden++;
                        if ($obj2->nuevoResumen()) {
                        }
                    }
                }
            } else {
                echo 'Error al guardar';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $variable = $parametros['check_num'];
            $check;
            if ($variable > 0) {
                $obj3->eliminar_check_actividad($parametros['actividad_global'], $parametros['Periodo']);
                for ($i = 0; $i < $variable; $i++) {
                    $check = $obj3->check_existe($parametros['check' . $i]);
                    if ($check > 0) {
                        array_push($array_check, $check);
                    } else {
                        $obj3->setNombre($parametros['check' . $i]);
                        $obj3->nuevo_checklist();
                        $IDcheck = $obj3->getIdCheckList();
                        array_push($array_check, $IDcheck);
                    }
                }
                foreach ($array_check as $key => $value) {
                    $obj3->anadir_check_actividad($value, $parametros['actividad_global'], $parametros['Periodo']);
                }
            }
            $obj->setIdLogroAct($_POST['id']);
            $obj->setTitulo($parametros['titulo']);

            $obj->setUsuarioUltimaModificacion("SIE");
            $num_resum = $parametros['reumenes_num'];
            if ($obj->editarLogro()) {
                for ($i = 1; $i <= $num_resum; $i++) {
                    $obj2->setId_resumen($parametros['resumen' . $i]);
                    $obj2->setResumen($parametros['descripcion' . $i]);
                    if ($obj2->editarResuemn()) {
                    }
                }
                echo "Planeación editada correctamente";
            } else {
                echo 'Error al editar';
            }
            break;
        case 'eliminar':
            $obj->setIdLogroAct($_POST['id']);
            if ($obj->eliminarLogro()) {
                echo "Planeación eliminada correctamente";
            } else {
                echo 'Error al eliminar';
            }
            break;
        case 'activar':
            $accion = $obj->Activa_padre($_POST['id'], $_POST['tipo']);
            $accion2 = $obj->Activa_hijo($_POST['id'], $_POST['tipo']);
            if ($accion == true && $_POST['tipo'] == 1) {
                echo "Activada correctamente";
            } elseif ($accion == true && $_POST['tipo'] == 2) {
                echo "Desactivada correctamente";
            } else {
                echo "Error: contacta al equipo de sistemas";
            }

            break;
        case 'eliminar-check':
            $idacheck = $_POST['Id_check'];
            $idactividad = $_POST['Id_actividad'];
            $periodo = $_POST['Periodo'];
            if (isset($_POST['Hijos']) && $_POST['Hijos'] != "" && $_POST['Hijos'] > 0) {
                if ($obj3->eliminar_check_con_hijos($idactividad, $periodo, $idacheck)) {
                    echo "Éxito: El check y sus subchecks han sido desvinculados";
                } else {
                    echo "Error: contacta al equipo de sistemas";
                }
            } else {
                if ($obj3->eliminar_check($idactividad, $periodo, $idacheck)) {
                    echo "Éxito: El check  han sido desvinculado";
                } else {
                    echo "Error: contacta al equipo de sistemas";
                }
            }

            break;
        case 'actualizar-avance':
            $check_a_actualizar = array();
            $consula = "SELECT
 ch.IdCheckList,ch.Avance 
FROM k_checklist_actividad ch
 INNER JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList 
 INNER JOIN c_actividad a on a.IdActividad=ch.IdActividad
WHERE
 ch.IdActividad = " . $_POST['id_actividad'] . "
 AND ch.Id_Periodo = " . $_POST['periodo'] . "
 AND c.Nivel = 1
 AND c.Tipo = 2
 AND a.Idcategoria=" . $_POST['categoria'] . "
ORDER BY
 ch.Orden";
            $resul = $catalogo->obtenerLista($consula);

            while ($row = mysqli_fetch_array($resul)) {
                array_push($check_a_actualizar, $row['IdCheckList']);
            }
            for ($i = 0; $i < count($check_a_actualizar); $i++) {
                $avance = $obj->avance_subchecks($_POST['id_actividad'], $_POST['periodo'], $_POST['categoria'], $check_a_actualizar[$i]);
                $obj->Actualiza_avance($avance, $_POST['periodo'], $check_a_actualizar[$i], $_POST['id_actividad']);
            }

            break;
    }
}
