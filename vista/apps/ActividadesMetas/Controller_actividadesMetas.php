<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/ActividadesMetas.class.php');
include_once ('../../Classes/Entregable.class.php');
include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new ActividadesMetas();
$objE = new Entregable();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           //echo "Entra:";
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

          $obj->setNumeracion($parametros['numeracion']);
          $obj->setIdcategoria($parametros['categoría']);
          if(isset($parametros['scategoría'])){
            $obj->setIdscategoria($parametros['scategoría']);
          }else{
            $obj->setIdscategoria("");
          }
          $obj->setOrden($parametros['orden']);
          $obj->setUsuarioUltimaModificacion($_POST['usuario']);
          $obj->setUsuarioCreacion($_POST['usuario']);
          $obj->setPantalla('Controller_actividadesMetas');

          $objE->setNombre($parametros['entregable']);
          $objE->setUsuarioModificacion($_POST['usuario']);
          $objE->setUsuarioCreacion($_POST['usuario']);
          $objE->setPantalla('Controller_actividadesMetas.php');

          //$IdActividad = $obj->agregarActividadMeta();
          //$IdEntregable= $objE->agregarEntregable();
            if ($obj->agregarActividadMeta()) {
                 $IdActividad = $obj->getIdActividad();
                  if(isset($parametros['entregable']) && $parametros['entregable'] != ""){
                    if($objE->agregarEntregable()){
                      $objE->setIdActividad($IdActividad);
                      $IdEntregable = $objE->getIdEntregable();
                      if($objE->agregarActividadEntregable()){
                         echo "Éxito:El registro se guardo correctamente";
                      }else {
                        echo 'Error: El registro no se ha podido guardar';
                      }
                    }else{
                      echo 'Error: El registro no se ha podido guardar';
                    }
                  }else{
                    echo "Éxito:El registro se guardo correctamente";
                  }
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
            $obj->setIdActividad($_POST['id']);
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

          $obj->setNumeracion($parametros['numeracion']);
          $obj->setIdcategoria($parametros['categoría']);
          if(isset($parametros['scategoría'])){
            $obj->setIdscategoria($parametros['scategoría']);
          }else{
            $obj->setIdscategoria("");
          }
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
                  	//echo "<br>Entra en que ya esta entre<br>";

                       echo "Éxito: El registro se modifico correctamente";

                  }else{
                    echo 'Error: El registro no se ha podido modificar ';
                  }
                }else{
                	//echo "<br>Entra en nuevo entre<br>";
                	if($objE->agregarEntregable()){
                		$objE->setIdActividad($_POST['id']);
                		$objE->setUsuarioCreacion($_POST['usuario']);
                    $IdEntregable = $objE->getIdEntregable();
	                    if($objE->agregarActividadEntregable()){
	                      echo "Éxito:El registro se modifico correctamente";
	                    }else {
	                      echo 'Error: El registro no se ha podido modificar';
	                    }
                      //echo "Éxito:El registro se guardo correctamente";
                  }else {
                    echo 'Error: El registro no se ha podido modificar';
                  } 
                }
            }else{
                  echo 'Error: El registro no se ha podido modificar1';
            }

            break;
        case 'eliminar':
          //echo "Entra controller eliminar";
            $obj->setIdActividad($_POST['id']);
            $objE->setIdActividad($_POST['id']);

            if (isset($_POST['IdEntregable']) && $_POST['IdEntregable'] != 0){

                $objE->setIdEntregable($_POST['IdEntregable']);
                if($objE->eliminarEntregableActividad()){
                  if ($objE->eliminarEntregable()) {
                    if($obj->eliminarActividadMeta()){
                        echo "Éxito: El registro se elimino correctamente";
                    }else{
                      echo 'Error: No se ha podido eliminar el registro';
                    }

                  }else{
                    echo 'Error: No se ha podido eliminar (Su entregable sa asocia con otras actividades o insumos)';
                  }

                } else {
                    echo 'Error: No se ha podido eliminar el registro';
                }
            }else{

              if($obj->eliminarActividadMeta()){
                        echo "Éxito: El registro se elimino correctamente";
                    }else{
                      echo 'Error: No se ha podido eliminar el registro';
                    }
            }



            break;
    }
}