<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/LogroResumen.class.php");
include_once("../../Classes/LogroResumenEje.class.php");
include_once("../../Classes/LogosEventos.class.php");
include_once('../../Classes/LogroResumenActividad.class.php');
$catalogo = new Catalogo();
$obj = new Logro;
$obj2 = new Logro_eje();
$obj3 = new Logro_evento();
$obj4 = new Logro_actividad();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            if ($parametros['resumen_tipo'] == 1) {
                $obj->setEtapa($parametros['eje']);
                $obj->setTipo($parametros['tipo']);
                $obj->setTitulo($parametros['titulo']);
                $obj->setResumen($parametros['resumen']);
                $obj->setDescripcion($_POST['descripcion']);
                $obj->setFecha_objetiva($parametros['fechac']);
                $obj->setIdArea($parametros['area']);
                $obj->setUsuarioCreacion('sie');
                $obj->setUsuarioUltimaModificacion('sie');
                $obj->setPantalla('AltaLogro.php');
                if ($obj->nuevoLogro()) {
                    echo "Logro guardado correctamente";
                } else {
                    echo 'Error al guardar';
                }
            }elseif ($parametros['resumen_tipo'] == 3) {
                $obj4->setIdEje($parametros['eje']);
                $obj4->setIdActividad($parametros['Actividad']);
                $obj4->setTitulo($parametros['titulo']);
                $obj4->setResumen($parametros['resumen']);
                $obj4->setDescripcion($_POST['descripcion']);
                $obj4->setFecha_objetiva($parametros['fechac']);
                $obj4->setIdArea($parametros['area']);
                $obj4->setUsuarioCreacion($parametros['nombreUsuario']);
                $obj4->setUsuarioUltimaModificacion($parametros['nombreUsuario']);
                $obj4->setPantalla('AltaLogro.php');
                if ($obj4->nuevoLogro()) {
                    echo "Logro guardado correctamente";
                } else {
                    echo 'Error al guardar';
                }
            } else {

                $obj2->setIdEje($parametros['eje']);
                $obj2->setTitulo($parametros['titulo']);
                $obj2->setResumen($parametros['resumen']);
                $obj2->setDescripcion($_POST['descripcion']);
                $obj2->setFecha_objetiva($parametros['fechac']);
                $obj2->setTipo($parametros['tipo']);
                $obj2->setIdArea($parametros['area']);
                $obj2->setUsuarioCreacion('sie');
                $obj2->setUsuarioUltimaModificacion('sie');
                $obj2->setPantalla('AltaLogro.php');

                if ($obj2->nuevoLogro_Eje()) {
                    echo "Logro guardado correctamente";
                } else {
                    echo 'Error al guardar';
                }
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            if ($parametros['resumen_tipo'] == 1) {
                $obj->setIdResumenMuseo($_POST['id']);
                $obj->setEtapa($parametros['eje']);
                $obj->setTipo($parametros['tipo']);
                $obj->setTitulo($parametros['titulo']);
                $obj->setFecha_objetiva($parametros['fechac']);
                $obj->setIdArea($parametros['area']);
                $obj->setDescripcion($_POST['descripcion']);
                $obj->setResumen($parametros['resumen']);
                $obj->setUsuarioUltimaModificacion('sie');
                if ($obj->editarLogro()) {
                    echo "Logro editado correctamente";
                } else {
                    echo 'Error al editar';
                }
            } if ($parametros['resumen_tipo'] == 3){
              $obj4->setIdLogroAct($_POST['id']);
              $obj4->setTitulo($parametros['titulo']);
              $obj4->setResumen($parametros['resumen']);
              $obj4->setDescripcion($_POST['descripcion']);
              $obj4->setUsuarioUltimaModificacion($parametros['nombreUsuario']);
              $obj4->setPantalla('AltaLogro.php');
              if ($obj4->editarLogro()) {
                  echo "Logro editado correctamente";
              } else {
                  echo 'Error al editar';
              }
            }else {
                $obj2->setIdResumenEje($_POST['id']);
                $obj2->setIdEje($parametros['eje']);
                $obj2->setTitulo($parametros['titulo']);
                $obj2->setResumen($parametros['resumen']);
                $obj2->setDescripcion($_POST['descripcion']);
                $obj2->setFecha_objetiva($parametros['fechac']);
                $obj2->setTipo($parametros['tipo']);
                $obj2->setIdArea($parametros['area']);
                $obj2->setUsuarioUltimaModificacion('sie');
                if ($obj2->editarLogro_Eje()) {
                    echo "Logro editado correctamente";
                } else {
                    echo 'Error al editar';
                }
            }
            break;
        case 'eliminar':

            break;
    }
}
