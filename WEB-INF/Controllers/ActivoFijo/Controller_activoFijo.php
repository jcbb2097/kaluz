<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../Classes/ActivoFijo.class.php');
include_once("../../Classes/Catalogo.class.php");
//echo "accion".$_POST['accion'];
$catalogo = new Catalogo();
$obj = new ActivoFijo();
if (isset($_POST['accion']) && $_POST['accion'] != "") {

    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

           //echo "desc:".$parametros['descripcion'];
           $obj->setEstadoactivo(1);
           $obj->setSecuencia(0);
           $obj->setDescripcion($parametros['descripcion']);
           $obj->setNoinventarioanterior($parametros['noInventarioAnt']);
           $obj->setNoinventarioactual($parametros['noInventarioAct']);
           $obj->setNoserie($parametros['noSerie']);
           $obj->setFecharesguardo($parametros['fecha']);
           $obj->setValor($parametros['valor']);
           $obj->setSituacionactivo($parametros['situacionA']);
           $obj->setProyarea($parametros['eje']);
           $obj->setArea($parametros['area']);
           $obj->setEmpleadoresguardo($parametros['empRes']);
           $obj->setEmpleadousa($parametros['empUsa']);
           $obj->setObservaciones($parametros['observaciones']);
           $obj->setPuesto($parametros['puesto']);
           //$obj->setImagen("");
           $obj->setPantalla("Controller_activoFijo.php");
           $obj->setUsuariocreacion($_POST['usuario']);
           $obj->setUsuarioUltimaModificacion($_POST['usuario']);

           $obj->setAct($parametros['actividad']);
           $obj->setExpo($parametros['expo']);

           $rutaimg = "resources/aplicaciones/imagenes/ActivoFijo/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

                    /*if($archivo == $namesoloimagen){
                        $namesoloimagen = explode('_',  $resultado);
                         = intval($namesoloimagen[0]);
                    }*/
                } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setImagen($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setImagen("");
            }

            if ($obj->agregarActivoFijo()) {
                echo "Éxito:El registro se guardo correctamente";

            } else {
                echo 'Error: El registro no se ha podido guardar';
            }

            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            //echo "Entra controller editar";
           $obj->setIdactivofijo($_POST['id']);
           $obj->setEstadoactivo(1);
           $obj->setSecuencia(0);
           $obj->setDescripcion($parametros['descripcion']);
           $obj->setNoinventarioanterior($parametros['noInventarioAnt']);
           $obj->setNoinventarioactual($parametros['noInventarioAct']);
           $obj->setNoserie($parametros['noSerie']);
           $obj->setFecharesguardo($parametros['fecha']);
           $obj->setValor($parametros['valor']);
           $obj->setSituacionactivo($parametros['situacionA']);
           $obj->setProyarea($parametros['eje']);
           $obj->setArea($parametros['area']);
           $obj->setEmpleadoresguardo($parametros['empRes']);
           $obj->setEmpleadousa($parametros['empUsa']);
           $obj->setObservaciones($parametros['observaciones']);
           $obj->setPuesto($parametros['puesto']);
           //$obj->setImagen("");
           $obj->setPantalla("Controller_activoFijo.php");
           $obj->setUsuarioUltimaModificacion($_POST['usuario']);

           $obj->setAct($parametros['actividad']);
           $obj->setExpo($parametros['expo']);

          $rutaimg = "resources/aplicaciones/imagenes/ActivoFijo/";
            if (isset($_FILES[0])) {
                //echo '1';
                if (file_exists("../../../" . $rutaimg . $_FILES[0]['name'])) {
                    //echo '<br>2<br>';
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.',  $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg . "(1)" . $archivo;
                    //$count =1;
                    $namesoloimagen= "(1)".$archivo;

                    /*if($archivo == $namesoloimagen){
                        $namesoloimagen = explode('_',  $resultado);
                         = intval($namesoloimagen[0]);
                    }*/
                } else {

                    //echo "<br>3<br>";
                    $archivo = $_FILES[0]['name'];
                    $resultado = str_replace(" ", "_",$archivo);
                    $explode = explode('.', $resultado);
                    $extension = array_pop($explode);

                    $nombre = $_FILES[0]['name'];

                    $nameimg = $rutaimg .  $resultado;
                    $namesoloimagen= $resultado;
                }
                //echo '<br>4<br>';
                $obj->setImagen($namesoloimagen);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameimg);
            } else {
                //echo '5';
                $obj->setImagen("");
            }

           if ($obj->editarActivoFijo()) {
                echo "Éxito: El registro se modifico correctamente";

            }else {
                echo 'Error: El registro no se ha podido modificar';
            }
            break;
        case 'eliminar':
          //echo "Entra controller eliminar";
            $obj->setIdactivofijo($_POST['id']);

            if ($obj->eliminarActivoFijo()) {
                echo 'Éxito: Se ha eliminado el registro';
            } else {
                echo 'Error: No se ha podido eliminar el registro';
            }
            break;
    }
} else if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
  $eje = "";
  echo "Entro";

  $eje = $_POST['eje'];
  echo "string  " . $eje;
  $Actividad = "";
  if ($eje != 0) {
            $consulta = "SELECT
                            cc.IdActividad,
                            CASE
                        WHEN cc.IdNivelActividad = 1 THEN
                            CONCAT(
                                cp.orden,
                                '.',
                                cc.Orden,
                                '. ',
                                cc.Nombre
                            )
                        WHEN cc.IdNivelActividad = 2 THEN
                            CONCAT(
                                cp.orden,
                                '.',
                                ccDos.Orden,
                                '.',
                                cc.Orden,
                                '. ',
                                cc.Nombre
                            )
                        WHEN cc.IdNivelActividad = 3 THEN
                            CONCAT(
                                cp.orden,
                                '.',
                                ccTres.Orden,
                                '.',
                                ccDos.Orden,
                                '.',
                                cc.Orden,
                                '. ',
                                cc.Nombre
                            )
                        WHEN cc.IdNivelActividad = 5 THEN
                            CONCAT(
                                cp.orden,
                                '.',
                                ccCuatro.Orden,
                                '.',
                                ccTres.Orden,
                                '.',
                                ccDos.Orden,
                                '.',
                                cc.Orden,
                                '. ',
                                cc.Nombre
                            )
                        END AS Actividad,
                         cnc.Nombre AS Nivel,
                         cnc.IdNivel
                        FROM
                            `c_actividad` AS cc
                        INNER JOIN c_eje AS cp ON cp.idEje = cc.IdEje
                        LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = cc.IdActividadSuperior
                        LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
                        LEFT JOIN c_actividad AS ccCuatro ON ccCuatro.IdActividad = ccTres.IdActividadSuperior
                        LEFT JOIN c_nivelActividadMeta AS cnc ON cnc.IdNivel = cc.IdNivelActividad
                        LEFT JOIN c_tipoActividadMeta AS ctc ON ctc.IdTipo = cc.IdTipoActividad
                        INNER JOIN c_periodo AS cper ON cper.Id_Periodo = cc.Periodo
                        WHERE cper.Actual = 1 AND cc.IdEje=".$eje." AND cc.IdTipoActividad=1
                        GROUP BY cc.IdActividad ORDER BY Actividad;";
            
            echo "<br> ACTIVIDAD: " . $consulta;
            $resultado = $catalogo->obtenerLista($consulta);
            echo '<option value="">Seleccione una opción</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                $s = '';
                if ($row['IdActividad'] == $Actividad) {

                    $s = 'selected="selected"';
                } echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Actividad'] . '</option>';
             }
         }
  
}