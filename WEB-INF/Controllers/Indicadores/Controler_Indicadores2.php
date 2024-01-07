<?php

/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../index.php");
}*/
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


include_once ('../../Classes/Indicadores.2.class.php');
include_once("../../Classes/Catalogo.class.php");
include_once("../../Classes/indicadoresUsuarios.class.php");
$catalogo = new Catalogo();
$UsuarioPermiso = $_SESSION["user_session"];
$usuario = "";
$usu = "SELECT IdUsuario, Usuario FROM c_usuario WHERE IdUsuario = $UsuarioPermiso";
$res = $catalogo->obtenerLista($usu);
while ($u = mysqli_fetch_array($res)) {
    $usuario = $u['Usuario'];
}

if (isset($_POST['accion']) && $_POST['accion'] != "") {
    $obj = new Indicadores2();
    $obj2 = new Indicadoresusuarios();

    switch ($_POST['accion']) {

        case 'guardar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }
            $obj->setDescripcion($parametros['descripcion']);
            $obj->setIdProyecto($parametros['Eje']);
            if($parametros['Actividad']!=""){
                $obj->setIdConcepto($parametros['Actividad']);
            }else{
                $obj->setIdConcepto(0);
            }
            $obj->setIdAplicacion($parametros['Aplicación']);
            $obj->setIdTiempo($parametros['Tiempo']);
            $obj->setIdPresentacion($parametros['presentacion']);
            if (isset($parametros['activo']) && $parametros['activo'] == 'on') {
                $obj->setInteres(1); /* NOTA */
            } else {
                $obj->setInteres(0); /* NOTA */
            }

            $obj->setQueryConsulta($parametros['consulta']);
            $obj->setIdArea($parametros['area']);
            if(isset($parametros['expo']) && $parametros['expo'] != ""){
                $obj->setExpo($parametros['expo']);
            }else{
                $obj->setExpo(0);
            }
            $obj->setUsuarioCreacion($usuario);
            $obj->setUsuarioUltimaModificacion($usuario);
            $obj->setPantalla('altaIndicador.php');
            $obj->setPeriodo($parametros['Periodo']);
            if ($obj->nuevoRegistro()) {
                if ($obj->getInteres() == 1) {
                    $IDIndicador = $obj->getIdIndicador();
                    $obj2->setId_indicador($IDIndicador);
                    $obj2->setId_usuario($UsuarioPermiso);

                    if ($obj2->indicadorusuario()) {
                        
                    } else {
                        
                    }
                } else {
                    
                }echo "Indicador guardado correctamente";
            } else {
                echo 'Error al guardar';
            }
            break;
        case 'editar':
            if (isset($_POST['form'])) {
                $parametros = array();
                parse_str($_POST['form'], $parametros);
            }

            $obj->setDescripcion($parametros['descripcion']);
            $obj->setIdProyecto($parametros['Eje']);
            $obj->setIdConcepto($parametros['Actividad']);
            $obj->setIdAplicacion($parametros['Aplicación']);
            $obj->setIdTiempo($parametros['Tiempo']);
            $obj->setIdPresentacion($parametros['presentacion']);
            $obj->setPeriodo($parametros['Periodo']);
            if (isset($parametros['activo']) && $parametros['activo'] == 'on') {
                $obj->setInteres(1); /* NOTA */
            } else {
                $obj->setInteres(0); /* NOTA */
            }
            $obj->setQueryConsulta($parametros['consulta']);
            if(isset($parametros['expo']) && $parametros['expo'] != ""){
                $obj->setExpo($parametros['expo']);
            }else{
                $obj->setExpo(0);
            }
            $obj->setIdArea($parametros['area']);
            $obj->setUsuarioUltimaModificacion($usuario);
            $obj->setIdIndicador($_POST['id']);
            if ($obj->editarRegistro()) {
                if ($obj->getInteres() == 1) {

                    $IDIndicador = $obj->getIdIndicador($_POST['id']);
                    $obj2->setId_indicador($IDIndicador);
                    $obj2->setId_usuario($UsuarioPermiso);

                    if ($obj2->indicadorusuario()) {
                        
                    } else {
                        
                    }
                } else {
                    $IDIndicador = $obj->getIdIndicador($_POST['id']);
                    $obj2->setId_indicador($IDIndicador);
                    $obj2->setId_usuario($UsuarioPermiso);
                    if ($obj2->Eliminarusuarioindicador()) {
                        
                    } else {
                        
                    }
                }echo 'Éxito: El indicador ha sido modificado';
            } else {
                echo 'Error: No se ha podido modificar el indicador';
            }




            break;
        case 'eliminar':
            $obj2->setId_indicador($_POST['id']);
            $obj2->setId_usuario($UsuarioPermiso);
            if ($obj2->Eliminarusuarioindicador()) {
                $obj->setIdIndicador($_POST['id']);
                if ($obj->eliminarRegistro()) {
                    
                } else {
                    
                }
                echo 'Éxito: Se ha eliminado el indicador';
            } else {
                echo 'Error: No se ha podido eliminar el indicador';
            }


            break;
    }
} else if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
$idEje = "";
$idEjeI = "";
$idArea = "";

//echo "prueba " . $_POST['idAreaI'];
//echo "prueba2 " . $_POST['idEje'];

    if ($_POST['idEje'] == TRUE) {
        $Actividad = "";
        $idEje = $_POST['idEje'];
        /*echo $consulta = "
SELECT
c_concepto.IdConcepto,
c_concepto.IdProyecto,
c_concepto.Nombre,
c_concepto.Periodo,
sie_cat_periodos.CPE_PERIODO
FROM
c_concepto
INNER JOIN sie_cat_periodos ON c_concepto.Periodo = sie_cat_periodos.CPE_ID_PERIODO
WHERE c_concepto.IdProyecto=$idEje AND sie_cat_periodos.CPE_ESTATUS=1 
ORDER BY
c_concepto.Orden ASC;";*/
$consulta = "SELECT
    cc.IdActividad,
CASE
        
        WHEN cc.IdNivelActividad = 1 THEN
        CONCAT( cp.orden, '.', cc.Orden, '. ', cc.Nombre ) 
        WHEN cc.IdNivelActividad = 2 THEN
        CONCAT( cp.orden, '.', ccDos.Orden, '.', cc.Orden, '. ', cc.Nombre ) 
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
WHERE
    cper.Actual = 1 
    AND cc.IdEje = $idEje 
    AND cc.IdTipoActividad = 1 
GROUP BY
    cc.IdActividad 
ORDER BY
    Actividad;";

        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            $s = '';
            if ($row['IdActividad'] == $Actividad) {

                $s = 'selected="selected"';
            } //echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Actividad'] . '(' . $row['Nivel'] . ')' . '</option>';
            echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Actividad'] . '</option>';
        }
    }

    if ($_POST['idEjeI'] == TRUE) {
        //echo "prueba eje " . $_POST['idEjeI'];
        $indicadorEje = "";
        $idEjeI = $_POST['idEjeI'];
        $consulta = "SELECT
c_proyecto.IdProyecto,
k_indicadores.IdIndicador,
k_indicadores.Descripcion
FROM
c_proyecto
INNER JOIN k_indicadores ON k_indicadores.IdProyecto = c_proyecto.IdProyecto
WHERE c_proyecto.IdProyecto=$idEjeI
ORDER BY
k_indicadores.Descripcion ASC
;";

        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {


            $s = '';
            if ($row['IdIndicador'] == $indicadorEje) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['IdIndicador'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
        }
    }


    if ($_POST['idAreaI'] == TRUE) {

        $indicadorArea = "";
        $AreaIndicada = $_POST['idAreaI'];

        $consulta = "SELECT
c_area.Id_Area,
k_indicadores.IdIndicador,
k_indicadores.Descripcion
FROM
c_area
INNER JOIN k_indicadores ON k_indicadores.IdArea = c_area.Id_Area
WHERE c_area.Id_Area=$AreaIndicada
ORDER BY
k_indicadores.Descripcion ASC
;";
        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {

            $s = '';
            if ($row['IdIndicador'] == $indicadorArea) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['IdIndicador'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
        }
    }
    //echo$_POST['idArea'];
    if ($_POST['idArea'] == TRUE) {
        $actividadarea = "";
        $Area = $_POST['idArea'];

        $consulta = "SELECT
c_concepto.IdConcepto,
c_concepto.IdArea,
c_area.Nombre
FROM
c_concepto
INNER JOIN c_area ON c_concepto.IdArea = c_area.Id_Area
WHERE c_concepto.IdConcepto=$Area;";
        $resultado = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {

            $s = '';
            if ($row['IdArea'] == $actividadarea) {

                $s = 'selected="selected"';
            } echo '<option value="' . $row['IdArea'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
    }
} else if (isset($_POST['eje']) && isset($_POST['select']) && $_POST['select'] == "josecarlos1") {
    if ($_POST['eje'] != "") {
        $consulta = "SELECT
c_proyecto.IdProyecto,
k_indicadores.IdIndicador,
k_indicadores.Descripcion
FROM
c_proyecto
INNER JOIN k_indicadores ON k_indicadores.IdProyecto = c_proyecto.IdProyecto
WHERE c_proyecto.IdProyecto=" . $_POST['eje'] . "
ORDER BY
k_indicadores.Descripcion ASC
;";
        $resultSubSubMenuAplicacion = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultSubSubMenuAplicacion)) {
            $s = '';
            if ($row['IdIndicador'] == $_POST['eje']) {
                $s = 'selected = "selected"';
            }
            echo '<option value="' . $row['IdIndicador'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
        }
    }
}else if (isset($_POST['select']) && $_POST['select'] == "cargarindicador") {
    if ($_POST['select'] != "") {
         
         $consulta = "SELECT IdIndicador,Descripcion
FROM k_indicadores
WHERE IdPresentacion=1
ORDER BY
k_indicadores.Descripcion ASC 
;";
        $resultSubSubMenuAplicacion = $catalogo->obtenerLista($consulta);
        echo '<option value="">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultSubSubMenuAplicacion)) {
            $s = '';
            echo '<option value="'. $row['IdIndicador'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
        }
    }
}  