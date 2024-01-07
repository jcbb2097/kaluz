<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>  
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php   
}
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once ('../../Classes/Transparencia.class.php');
include_once("../../Classes/Catalogo.class.php");
$catalogo = new Catalogo();

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Transparencia();
    
    $obj->setEstatus(0);
    switch ($_POST['accion']) {
        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            if (isset($parametros['mes']) && $parametros['mes'] != "") {
                $obj->setMes($parametros['mes']);
            } else {
                $obj->setMes(0);
            }
            if (isset($parametros['anio']) && $parametros['anio'] != "") {
                $obj->setAnio($parametros['anio']);
            } else {
                $obj->setAnio(0);
            }
            if (isset($parametros['eje']) && $parametros['eje'] != "") {
                $obj->setEje($parametros['eje']);
            } else {
                $obj->setEje(0);
            }
            if (isset($parametros['actividad']) && $parametros['actividad'] != "") {
                $obj->setActividad($parametros['actividad']);
            } else {
                $obj->setActividad(0);
            }
            if (isset($parametros['expo']) && $parametros['expo'] != "") {
                $obj->setExposicion($parametros['expo']);
            } else {
                $obj->setExposicion(0);
            }
            $obj->setFolio($parametros['folio']);
            $obj->setFolio_sec($parametros['folio_c']);
            $obj->setContratos($parametros['conv']);
            $obj->setFecha_envio($parametros['envio']);
            $obj->setFecha_termino($parametros['termino']);
            $obj->setFecha_respuesta($parametros['respuesta']);
            $obj->setMpba($parametros['mpba']);
            $obj->setInformacion_solicitada($parametros['info']);

            $archivo = "resources/aplicaciones/Transparencia/";
            if (isset($_FILES[0])) {
                if (file_exists("../../../" . $archivo . $_FILES[0]['name'])) {
                    $nameArchivo = $archivo . "(1)" . $_FILES[0]['name'];
                } else {
                    $nameArchivo = $archivo . $_FILES[0]['name'];
                }
                $obj->setArchivo($nameArchivo);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameArchivo);
            } else {
                $obj->setArchivo("");
            }

            if(isset($parametros['estatus']) && $parametros['estatus'] != ""){
                $obj->setEstatus($parametros['estatus']);
            } else {
                $obj->setEstatus(0);
            }
            if (isset($parametros['area']) && $parametros['area'] != "") {
                $obj->setArea($parametros['area']);
            } else {
                $obj->setArea(0);
            }
            $obj->setUsrCreacion($_SESSION['user_session']);
            $obj->setUsrModificacion($_SESSION['user_session']);

            if ($obj->agregarTransparencia()) {
                echo "Se agrego la Solicitud correctamente.";
            } else {
                echo "Error: No se pudo agregar la Solicitud.";
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setId_transparencia($_POST['id']);

            if (isset($parametros['mes']) && $parametros['mes'] != "") {
                $obj->setMes($parametros['mes']);
            } else {
                $obj->setMes(0);
            }
            if (isset($parametros['anio']) && $parametros['anio'] != "") {
                $obj->setAnio($parametros['anio']);
            } else {
                $obj->setAnio(0);
            }
            if (isset($parametros['eje']) && $parametros['eje'] != "") {
                $obj->setEje($parametros['eje']);
            } else {
                $obj->setEje(0);
            }
            if (isset($parametros['actividad']) && $parametros['actividad'] != "") {
                $obj->setActividad($parametros['actividad']);
            } else {
                $obj->setActividad(0);
            }
            if (isset($parametros['expo']) && $parametros['expo'] != "") {
                $obj->setExposicion($parametros['expo']);
            } else {
                $obj->setExposicion(0);
            }
            $obj->setFolio($parametros['folio']);
            $obj->setFolio_sec($parametros['folio_c']);
            $obj->setContratos($parametros['conv']);
            $obj->setFecha_envio($parametros['envio']);
            $obj->setFecha_termino($parametros['termino']);
            $obj->setFecha_respuesta($parametros['respuesta']);
            $obj->setMpba($parametros['mpba']);
            $obj->setInformacion_solicitada($parametros['info']);

            $archivo = "resources/aplicaciones/Transparencia/";
            if (isset($_FILES[0])) {
                if (file_exists("../../../" . $archivo . $_FILES[0]['name'])) {
                    $nameArchivo = $archivo . "(1)" . $_FILES[0]['name'];
                } else {
                    $nameArchivo = $archivo . $_FILES[0]['name'];
                }
                $obj->setArchivo($nameArchivo);

                move_uploaded_file($_FILES[0]['tmp_name'], "../../../" . $nameArchivo);
            } else {
                if(isset($parametros['archivoantes']) and $parametros['archivoantes']!=""){
                    $obj->setArchivo($parametros['archivoantes']);
                }else{
                     $obj->setArchivo("");
                }
            }

            //$obj->setEstatus(0);
            if(isset($parametros['estatus']) && $parametros['estatus'] != ""){
                $obj->setEstatus($parametros['estatus']);
            } else {
                $obj->setEstatus(0);
            }
            if (isset($parametros['area']) && $parametros['area'] != "") {
                $obj->setArea($parametros['area']);
            } else {
                $obj->setArea(0);
            }
            $obj->setUsrModificacion($_SESSION['user_session']);

            if ($obj->editarTransparencia()) {
                echo "Se edito la Solicitud correctamente.";
            } else {
                echo "Error: No se pudo editar la Solicitud.";
            }
            break;
        case 'eliminar':
            $obj->setId_transparencia($_POST['id']);
            if ($obj->eliminarTransparencia()) {
                echo 'Éxito: Se ha eliminado la Solicitud';
            } else {
                echo 'Error: No se ha podido eliminar la Solicitud';
            }
            break;
        }
    } elseif (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
        $expo = "";
        $act = "";
        $Actividad = "";
         $expo = $_POST['expo'];
         $act = $_POST['act'];

        //echo "EXPOSICIÓN:  " . $expo;
        //echo "<br> Actividad::  " . $act;

         if ($expo == 7) {
            $consulta = " SELECT * FROM c_exposicionTemporal WHERE IdEje=$expo";
            //echo "<br> EXPO: " . $consulta;
            $resultado = $catalogo->obtenerLista($consulta);
            echo '<option value="">Seleccione una opción</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                $s = '';
                if ($row['idExposicion'] == $Actividad) {

                    $s = 'selected="selected"';
                } echo '<option value="' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
            }
         } elseif ($expo != 0) {
            $consulta = " SELECT * FROM c_exposicionPermanente WHERE IdEje=$expo";
            //echo "<br> EXPO: " . $consulta;
            $resultado = $catalogo->obtenerLista($consulta);
            echo '<option value="">Seleccione una opción</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                $s = '';
                if ($row['idExposicion'] == $Actividad) {

                    $s = 'selected="selected"';
                } echo '<option value="' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
            }
         }
         elseif ($act != 0) {
             //$consulta = "SELECT * FROM c_actividad WHERE IdEje = $act ORDER BY Nombre ASC";
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
                                        WHERE cper.Actual = 1 AND cc.IdEje=".$act." AND cc.IdTipoActividad=1
                                        GROUP BY cc.IdActividad ORDER BY Actividad;
            ";
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
?>