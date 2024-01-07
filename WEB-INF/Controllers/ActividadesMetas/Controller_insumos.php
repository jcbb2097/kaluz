<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

//include_once ('../../Classes/ActividadesMetas.class.php');
include_once ('../../Classes/Entregable.class.php');
include_once ("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
//$obj = new ActividadesMetas();
$objE = new Entregable();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setIdInsumo($parametros['insumo']);

            if ($objE->agregarInsumoEntregable()) {
                  echo "Éxito: El registro se guardo correctamente";
            }else{
                  echo 'Error: El registro no se ha podido guardar';
            }

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //echo "Entra controller editar";
           /* $obj->setIdActividad($_POST['id']);
            $obj->setIdNivelActividad($parametros['nivel']);

          if(intval($parametros['nivel']) == 1){
              $obj->setIdActividadSuperior("");
            }
          if(intval($parametros['nivel']) == 2){
              $obj->setIdActividadSuperior($parametros['amGlobal']);
            }
          if(intval($parametros['nivel']) == 3){
              $obj->setIdActividadSuperior($parametros['amGeneral']);
            }
          if(intval($parametros['nivel']) == 5){
              $obj->setIdActividadSuperior($parametros['amParticular']);
            }
          $obj->setNombre($parametros['nombreAM']);
          $obj->setPeriodo($parametros['IdPeriodo']);
          $obj->setIdArea($parametros['area']);
          $obj->setIdEje($parametros['IdEje']);
          $obj->setIdResponsable($parametros['responsable']);
          $obj->setIdTipoActividad($parametros['IdTipo']);


          $obj->setOrden($parametros['orden']);
          $obj->setUsuarioUltimaModificacion($_POST['usuario']);
          $obj->setUsuarioCreacion($_POST['usuario']);
          $obj->setPantalla('Controller_actividadesMetas.php');

          //$objE->setUsuarioCreacion($_POST['usuario']);
          $objE->setNombre($parametros['entregable']);
          $objE->setUsuarioModificacion($_POST['usuario']);
          $objE->setPantalla('Controller_actividadesMetas.php');


          if ($obj->editarActividadMeta()) {
          		if(isset($parametros['IdEntregable']) && $parametros['IdEntregable'] != ""){
          			$objE->setIdEntregable($parametros['IdEntregable']);
                  if($objE->editarEntregable()){
                  	echo "<br>Entra en que ya esta entre<br>";

                       echo "Éxito: El registro se modifico correctamente";

                  }else{
                    echo 'Error: El registro no se ha podido modificar 1';
                  }
                }else{
                	echo "<br>Entra en nuevo entre<br>";
                	if($objE->agregarEntregable()){
                		$objE->setIdActividad($_POST['id']);
                		$objE->setUsuarioCreacion($_POST['usuario']);
                    	$IdEntregable = $objE->getIdEntregable();
	                      if($objE->agregarActividadEntregable()){
	                         echo "Éxito:El registro se guardo correctamente";
	                      }else {
	                        echo 'Error: El registro no se ha podido guardar 2';
	                      }
                         echo "Éxito:El registro se guardo correctamente";
                      }else {
                        echo 'Error: El registro no se ha podido guardar 3';
                    }
                }
            }else{
                  echo 'Error: El registro no se ha podido modificar 4';
            }
          /*if(isset($parametros['IdEntregable']) && $parametros['IdEntregable'] != ""){
            $objE->setIdEntregable($parametros['IdEntregable']);
            $objE->setNombre($parametros['entregable']);

            if ($obj->editarActividadMeta()) {

                  if($objE->editarEntregable()){

                       echo "Éxito: El registro se modifico correctamente";

                  }else{
                    echo 'Error: El registro no se ha podido modificar';
                  }

            }else{
                  echo 'Error: El registro no se ha podido modificar';
            }
          }else{
              if ($obj->editarActividadMeta()) {
                echo "Éxito: El registro se modifico correctamente";

            }else {
                echo 'Error: El registro no se ha podido modificar';
            }
          }*/



          /*if ($obj->editarActividadMeta()) {

                  if($objE->editarEntregable()){

                       echo "Éxito: El registro se modifico correctamente";

                  }else{
                    echo 'Error: El registro no se ha podido modificar';
                  }

            }else{
                  echo 'Error: El registro no se ha podido modificar';
            }*/
           /*if ($obj->editarActividadMeta()) {
                echo "Éxito: El registro se modifico correctamente";

            }else {
                echo 'Error: El registro no se ha podido modificar';
            }*/
            break;
        case 'eliminar':
          //echo "Entra controller eliminar";
            $objE->setIdEntregableInsumo($_POST['id']);

            if ($objE->eliminarEntregableDetalleInsumo()) {
                echo 'Éxito: Se ha eliminado el registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
}