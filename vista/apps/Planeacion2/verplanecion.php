<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$AnioActual = date("Y"); //Año actual para mostrar por default

$miAnio = "";
$miAnio = $_POST["ano"];
$miEje = "";
$miEje = $_POST["IdEje"];
$miPeriodo = "";
$miPeriodo = $_POST["periodo"]; //9=2021, 14=2022
$miTipoACME = "";
$miTipoACME = $_POST["Tipo"]; //1=Actividad, 2=Meta
$persona = "0";

$idcheckAnterior = "";

$Id_usuario = $_POST["Id_usuario"];
$Nombre_usuario = $_POST["nombreUsuario"];

if (isset($_POST["persona"])) {
    $persona = $_POST["persona"];
}
$area = "0";
if (isset($_POST["area"])) {
    $area = $_POST["area"];
}

$avanceGlobalPersona = 0;
$contadorEntregable = 0;
$contadorEntregableC = 1;
if ($persona != "0") {
    $filtroPersona = false;
} else {
    $filtroPersona = true;
}

if ($area != "0") {
    $filtroArea = false;
} else {
    $filtroArea = true;
}

//echo "Año:" . $miAnio . " - ";
//echo "Eje:" . $miEje;
//echo "Periodo:" . $miPeriodo . " - ";
//echo "ACME:" . $miTipoACME . " - ";
if (isset($_POST["area"])) {
    // echo "Id Area:" . $area . " <br>";
} else {
    // echo "Id Persona:" . $persona . " <br>";
}


?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="../../../resources/js/sweetAlert.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="Alta_check.js"></script>
    <title>::.Ver Planeación.::</title>
</head>

<style type="text/css" media="screen">
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<body>
    <?php

    //echo "<br>INICIA<br>";
    echo "<table class='table table-striped table-bordered no-footer dataTable'>";
    echo "<tr style='background-color: #5a274f; color: #ffffff;'>";
    //  echo "  <th style='width: 65px;'>Nivel</th>";
    echo "  <th style='width: 300px;'>Ubicación</th>";
    // echo "  <th>ActGen</th>";
    echo "  <th>Entregable</th>";
    // echo "  <th>Entregable de Subcheck</th>";
    echo "</tr>";

    $consulta = "SELECT cat.idEje as Eje, cat.orden as OrdenCat,
      CONCAT(upper(cat.descCategoria),'[',cat.idCategoria,']') as Categoria,
      cat.descCategoria as CategoriaS,
      kcatan.Anio AS Anio, kcatan.Visible AS VisibleCat, cat.idCategoria
      FROM k_categoriasdeejes_anios kcatan
      JOIN c_categoriasdeejes cat ON cat.idCategoria=kcatan.idCategoria
      JOIN c_periodo p ON p.Id_Periodo=cat.anio
      WHERE cat.nivelCategoria=1 AND cat.idEje=" . $miEje . " AND kcatan.Anio=" . $miAnio . " AND kcatan.ACME=" . $miTipoACME . "
      ORDER BY cat.idEje, cat.orden";

    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {
        if ($row['VisibleCat'] == "1") {
            //  echo "<tr style='background-color: #854d79;'>";
        } else {
            //  echo "<tr style='background-color: #c9c9c9;'>";
        }
        //  echo "  <td>1-Categoria</td>";
        // echo "  <td >" . $row['CategoriaS'] . "</td>";
        // echo "  <td></td>";
        // echo "  <td></td>";
        // echo "</tr>";
        ImprimeSubCat($row['idCategoria'], $row['CategoriaS']);
        ImprimeAcGlo($row['idCategoria'], $row['CategoriaS'], "", "");
    } //while

    echo "</table>";
    ?>

</body>

</html>

<?php
//-------------------------------------------------------------------------------------------------
function ImprimeSubCat($IdCat, $CategoriaS)
{
    global $miAnio, $miTipoACME;
    $catalogo = new Catalogo();
    $consulta = "SELECT cat.orden AS OrdenSubCat, CONCAT(cat.descCategoria,'[',cat.idCategoria,']') AS SubCat ,
    cat.descCategoria AS SubCatS,
    kcatan.Visible AS VisibleSubCat,
    cat.idCategoria as idSubCategoria
    FROM k_categoriasdeejes_anios kcatan
    join c_categoriasdeejes cat ON cat.idCategoria=kcatan.idCategoria
    WHERE cat.idCategoriaPadre=" . $IdCat . " AND kcatan.Anio=" . $miAnio . " AND kcatan.ACME=" . $miTipoACME . "
    ORDER BY cat.orden";
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {
        //  echo "<tr style='background-color: #854d79ad;'>";
        // echo "  <td>2-SubCat</td>";
        // echo "  <td>" . $row['SubCatS'] . "</td>";
        // echo "  <td></td>";
        // echo "  <td></td>";
        // echo "</tr>";
        ImprimeAcGlo($row['idSubCategoria'], $CategoriaS, $row['SubCatS'], $IdCat);
    } //while
} //function ImprimeSubCat
//-------------------------------------------------------------------------------------------------
function ImprimeAcGlo($IdSubCategoria, $CategoriaS, $SubCatS, $IdCat)
{
    global $miTipoACME, $miPeriodo;
    $catalogo = new Catalogo();
    $consulta = "SELECT distinct kaccat.Orden AS OrdenAcGlo,
    CONCAT(kaccat.Numeracion,a.Nombre,'[',a.IdActividad,']') AS AcGlo,
    CONCAT(kaccat.Numeracion,a.Nombre) AS AcGloS,
     kaccat.Activo AS VisibleAcGlo, a.IdActividad as idAcGlo
    FROM k_actividad_categoria kaccat
    JOIN c_actividad a ON a.IdActividad=kaccat.IdActividad
    WHERE kaccat.IdCategoria=" . $IdSubCategoria . " AND kaccat.IdPeriodo=" . $miPeriodo . " AND a.IdTipoActividad=" . $miTipoACME . "
    ORDER BY kaccat.Orden";
    //echo $consulta;
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {
        // echo "<tr style='background-color: #854d7970;'>";
        // echo "  <td>3-ActGlo</td>";
        // echo "  <td>" . $row['AcGloS'] . "</td>";
        // echo "  <td></td>";
        // echo "  <td></td>";
        // echo "</tr>";
        //   ImprimeAcGen($row['idAcGlo'], $IdSubCategoria, $CategoriaS, $SubCatS, $row['AcGloS']);
        ImprimeCheck($row['idAcGlo'], $CategoriaS, $SubCatS, $row['AcGloS'],$IdCat,$IdSubCategoria);
    } //while
} //function ImprimeAcGlo
//-------------------------------------------------------------------------------------------------
function ImprimeAcGen($IdAcGlo, $IdSubCategoria, $CategoriaS, $SubCatS, $AcGloS)
{
    global $miTipoACME, $miPeriodo;
    $catalogo = new Catalogo();
    $consulta = "SELECT kaccat.Orden AS OrdenAcGlo,
    CONCAT(kaccat.Numeracion,a.Nombre,'[',a.IdActividad,']') AS AcGlo, kaccat.Activo AS VisibleAcGlo, a.IdActividad as idAcGlo,
    CONCAT(asu.IdActividadSuperior,a.Nombre) AS ActividadGeneral
    FROM k_actividad_categoria kaccat
    JOIN c_actividad a ON a.IdActividad=kaccat.IdActividad
    JOIN c_actividad asu ON asu.IdActividadSuperior = kaccat.IdActividad
    WHERE kaccat.IdCategoria=" . $IdSubCategoria . " AND kaccat.IdPeriodo=" . $miPeriodo . " AND a.IdTipoActividad=" . $miTipoACME . " AND asu.IdActividadSuperior IS NOT NULL
    ORDER BY kaccat.Orden";
    //echo $consulta;
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {
        //  echo "<tr style='background-color: #854d794a;'>";
        //   echo "  <td>4-ActGen</td>";
        //  echo "  <td>" . $row['AcGlo'] . "</td>";
        //  echo "  <td></td>";
        //  echo "  <td></td>";
        //  echo "</tr>";
        // ImprimeAcGen($row['idAcGlo']);
      //  ImprimeCheck($row['idAcGlo'],  $CategoriaS, $SubCatS, $AcGloS);
    } //while
} //function ImprimeAcGen
//-------------------------------------------------------------------------------------------------
function ImprimeCheck($IdAcGlo, $CategoriaS, $SubCatS, $AcGloS, $IdCat,$IdSubCategoria)
{
    global $miTipoACME, $miPeriodo, $persona, $contadorEntregable, $avanceGlobalPersona, $filtroPersona, $area, $filtroArea, $miEje, $contadorEntregableC, $Nombre_usuario, $Id_usuario, $idcheckAnterior;

    if (isset($_POST["area"])) {
        if($miEje == "7"){
            $condicionPersonaArea = "and ar.Id_Area = " . $area;
            $consultaCategoria = "";
        } else {
            $condicionPersonaArea = "";
            $consultaCategoria = "kcha.IdCategoria,";
        }
    }else {
        if($miEje == "7"){
            $condicionPersonaArea = "and per.id_Personas = " . $persona;
          //  echo "-- " . $IdAcGlo . " - " .$CategoriaS . " - " . $SubCatS . " - " . $AcGloS . " - " . $IdCat . " - " . $IdSubCategoria . "-- ";
          //  echo "-- " . $IdAcGlo . " - " . $IdCat . " - " . $IdSubCategoria . "-- ";
            $consultaCategoria = "";
        } else {
            $condicionPersonaArea = "";
            $consultaCategoria = "kcha.IdCategoria,";
        }
       
    }

    if($idcheckAnterior != ""){

    }
    
    if ($SubCatS != "") {
        $SubCatSTitulo = "<p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -12px;'> <span style='font-weight: bold;'> SubCat: </span>" . $SubCatS . "</p>";
    } else {
        $SubCatSTitulo = "";
    }

    $catalogo = new Catalogo();

   $consulta = "SELECT distinct
    kcha.Orden AS OrdenCh,
    CONCAT(ch.Nombre,'<br>',per.Nombre,' ',per.Apellido_Paterno,'') AS NomCheck,
    ch.Nombre as nombreEntregable,
    kcha.Avance as avanceS,
    ch.Nivel,
    kcha.IdCheckList as idCheck,
    kcha.Inicial, kcha.Proceso, kcha.Final, kcha.Archivo, kcha.Avance as avancePersona, kcha.Visible as VisibleCh, per.Nombre as nombrePersona, per.id_Personas as idPersonaFiltro, ar.Id_Area as areaFiltro,
    ".$consultaCategoria." kcha.IdEncargado, ar.Id_Area, kcha.Entregable, ch.Tipo as tipo, d.ruta,d.pdf, ch.automatico, kcha.Avance, ch.IdCheckListPadre, kcha.IdActividad,d.id_tipo,
    CASE WHEN kcha.Nombre_alterno != '' THEN kcha.Nombre_alterno ELSE ch.Nombre END AS Nombre
    FROM k_checklist_actividad kcha
    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
    JOIN c_area ar ON ar.Id_Area=per.idArea
    LEFT JOIN c_documento d ON d.id_documento = kcha.Archivo
    WHERE kcha.IdActividad=" . $IdAcGlo . " AND kcha.Id_Periodo=" . $miPeriodo . " AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3)) and kcha.Visible = '1'
    ".$condicionPersonaArea." 
    ORDER BY ch.Nivel DESC, kcha.Orden";
    //echo $consulta;
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {
        
        if($miEje == "7") {
            $categoriaDatos = $IdCat;
        }else {
            $categoriaDatos = $row['IdCategoria'];
        }
        

        $onclick_asunto2 = "";
        $onclick_asunto2 = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=1&nombreUsuario=' . $row['nombrePersona'] . '&idUsuario=' . $row['idPersonaFiltro'] . '&plan=1&Id_eje=' . $miEje . '&ACME=' .
            $miTipoACME . '&cate=' . $categoriaDatos . '&subcate=' . $categoriaDatos . '&AGBL=' . $IdAcGlo . '&AGENE=' . $IdAcGlo . '&periodo=' .
            $miPeriodo . '&check=' . $row['idCheck'] . '&subcheck=0&regreso=2&tipo_entregable=9&id_encargado=' . $row['IdEncargado'] . '&id_area=' . $row['Id_Area'] . '"';

        $onclick_form2 = '../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=1&nombreUsuario=1&idUsuario=1&plan=1&Id_eje=1&ACME=1&cate=1&subcate=1&AGBL=1&AGENE=1&periodo=14&check=1&subcheck=1&regreso=2&tipo_entregable=1&check_global=1';

        if (isset($_POST["area"])) {
            if ($row['areaFiltro'] == $area or $filtroArea) {
                if ($row['Nivel'] == "2") {
                    $tituloCheck = "Sub Check: ";

                    $IdCheckListPadre = $row['IdCheckListPadre'];

                    $consultaPadre = "SELECT
                    kcha.Orden AS OrdenCh,
                    CONCAT(ch.Nombre,'<br>',per.Nombre,' ',per.Apellido_Paterno,'') AS NomCheck,
                    ch.Nombre as nombreEntregable,
                    kcha.Avance as avanceS,
                    ch.Nivel,
                    kcha.IdCheckList as idCheck,
                    kcha.Inicial, kcha.Proceso, kcha.Final, kcha.Archivo, kcha.Avance as avancePersona, kcha.Visible as VisibleCh, per.Nombre as nombrePersona, per.id_Personas as idPersonaFiltro, ar.Id_Area as areaFiltro,
                    kcha.IdCategoria, kcha.IdEncargado, ar.Id_Area, kcha.Entregable, ch.Tipo as tipo, d.ruta,d.pdf, ch.automatico, kcha.Avance, ch.IdCheckListPadre
                    FROM k_checklist_actividad kcha
                    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
                    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
                    JOIN c_area ar ON ar.Id_Area=per.idArea
                    LEFT JOIN c_documento d ON d.id_documento = kcha.Archivo
                    WHERE kcha.IdActividad=" . $IdAcGlo . " AND kcha.Id_Periodo=" . $miPeriodo . " AND kcha.Visible = '1' and kcha.IdCheckList = ".$IdCheckListPadre."
                    
                    ORDER BY ch.Nivel DESC, kcha.Orden";
                    $resultConsultaPadre = $catalogo->obtenerLista($consultaPadre);
                    $rowPadre = mysqli_fetch_array($resultConsultaPadre);

                    $checkPadre = $rowPadre['nombreEntregable'];

                    $tituloCheckPadre = "<p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -2px; margin-bottom: -10px;'><span style='font-weight: bold;'> Check: </span>"  . $checkPadre . "</p>";

                } else {
                    $tituloCheck = "Check: ";
                    $tituloCheckPadre = "";
                }

                echo "<tr >";
                // echo "  <td></td>";
                echo "  <td style='background-color: #854d792e;'>
                <p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -7px;'> <span style='font-weight: bold; font-size: 10px;'>" . $contadorEntregableC . "</span> <span style='font-weight: bold;'> Cat: </span>" . $CategoriaS .  "</p>" .
                    $SubCatSTitulo .
                    "
                    <p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -11px; margin-bottom: 0px;'> <span style='font-weight: bold;'>AcGlo: </span>" . $AcGloS . "</p>" .
                    $tituloCheckPadre .
                    "</td>";

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red; padding-left: 18px; font-size: .8em;' ";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green; padding-left: 18px; font-size: .8em;'";
                } else  $miColor = " style='color:orange; padding-left: 18px; font-size: .8em;'";

                $ruta = $row['ruta'] . $row['pdf'];

                if ($row['tipo'] != 2) {
                    if ($row['automatico'] == 0) {
                        $icono = '<i class="fas fa-file-archive" data-toggle="tooltip" data-placement="top" data-original-title="Último archivo"></i>';
                    } else {
                        $icono = '<i class="fas fa-laptop-code" data-toggle="tooltip" data-placement="top" data-original-title="BD"></i>';
                    }
                    if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                        $onclick_check = 'target="_blank" href="' . $row['ruta'] . '"';
                    } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                        $onclick_check = 'target="_blank" href="' . $ruta . '"';
                    } else {
                        $onclick_check = "";
                    }
                }

                $avance_checklist = intval($row['Avance']);

                $n_check_v = $row['Nombre'];
                $nombrecheck = "'" . $n_check_v . "'";
                $idcheck = $row['idCheck'];
                $Id_Actividad = $row['IdActividad'];
                $cate = $categoriaDatos;
                $Id_categoria = $IdCat;
                $Id_subcategoria = $IdSubCategoria;
                $AGLOBAL = $IdAcGlo;
                $AGENEREAL = "";

                if ($avance_checklist >= 1 && $avance_checklist <= 24) {
                    $color = "dfa739";
                    $tipo_entregable = 9;
                } elseif ($avance_checklist >= 25 && $avance_checklist <= 49) {
                    $color = "#dfa739";
                    $tipo_entregable = 14;
                } elseif ($avance_checklist >= 50 && $avance_checklist <= 99) {
                    $color = "#dbd909";
                    $tipo_entregable = 10;
                } elseif ($avance_checklist >= 100) {
                    $color = "#33ab15";
                } else {
                    $color = "red";
                    $tipo_entregable = 9;
                }

                if ($miTipoACME == "1") {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #800080;font-size:10px;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                } else {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #2132c8;font-size:10px;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                }

                $onclick_versiones = ' onclick="muestraversiones(' . $nombrecheck . ',' . $idcheck . ',' . $miTipoACME . ',' . $Id_Actividad . ',' . $cate . ',' . $miPeriodo . ');"';
              //  $onclick_form = 'href="../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=1&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $miEje . '&ACME=' . $miTipoACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' . $miPeriodo . '&check=' . $idcheck . '&subcheck=&regreso=2&tipo_entregable=' . $tipo_entregable . '"';

                echo " <p style='padding-left: 18px; font-size: 8px; margin-bottom: -14px;'> <span style='font-weight: bold;font-size: 8px;'>" . $tituloCheck . "</span>" . $row['nombreEntregable'] . "</p><br>";

                echo "  <progress style='margin-left: 18px;' id='file' max='100' value='" . $row['avanceS'] . "' class='padre'></progress>" . $row['avanceS'] . " %" . "";

                echo " <span style='margin-left: 7px;'><a style='color: purple;display: inline-block;' href='" . $onclick_form2 . "'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Añadir entregable' class='fas fa-plus-circle'></i></a></span>";
                echo "<span><a " . $onclick_asunto2 . "style='display: inline-block;color:purple'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Redactar asunto' class='far fa-edit'></i><a></span>";
                // echo "<span><a target='_blank' href='https://docs.google.com/presentation/d/19boD6vnR6reqNgIbDihl4a2hdGwmbQ0q/mobilepresent?slide=id.p1' style='display: inline-block;color:#33ab15;'><i class='fas fa-file-archive' data-toggle='tooltip' data-placement='bottom' data-original-title='Último archivo'></i></a></span>";
                if ($row['Archivo'] != '' && $row['tipo'] == 1) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . '">' . $icono . '</a></span>';
                } elseif ($row['Archivo'] == '' && $row['tipo'] == 1) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . ';">' . $icono . '</a></span>';
                } elseif ($row['Archivo'] == '' && $row['tipo'] == 2) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . '">' . $icono . '</a></span>';
                } elseif ($row['Archivo'] != '' && $row['tipo'] == 2) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . '">' . $icono . '</a></span>';
                }
                if ($row['tipo'] == 1) { 
                   echo '<span '. $onclick_versiones . 'style="display: inline-block; margin-left: 2px; color:purple"><i data-toggle="tooltip" data-placement="top" data-original-title="Versiones" class="fas fa-archive"></i></span>';
                    if ($row['id_tipo'] != 10) { 
                     // echo '<span><a style="color: purple;display: inline-block; margin-left: 2px;" '. $onclick_form .'><i data-toggle="tooltip" data-placement="top" data-original-title="Añadir entregable" class="fas fa-plus-circle"></i></a></span>';
                    } 
                } 
                echo "</td>";
                echo "</tr>";

                $contadorEntregableC++;
                // ImprimeSubCheck($row['idCheck'], $IdAcGlo, $CategoriaS, $SubCatS, $AcGloS, $row['nombreEntregable']);

                $avanceGlobalPersona += $row['avanceS'];
                $contadorEntregable++;
            }
        } else {
            if ($row['idPersonaFiltro'] == $persona or $filtroPersona) {
              //  echo "idc : " . $idcheckAnterior;
                if ($row['Nivel'] == "2") {
                    $tituloCheck = "Sub Check: ";

                    $IdCheckListPadre = $row['IdCheckListPadre'];

                    $consultaPadre = "SELECT
                    kcha.Orden AS OrdenCh,
                    CONCAT(ch.Nombre,'<br>',per.Nombre,' ',per.Apellido_Paterno,'') AS NomCheck,
                    ch.Nombre as nombreEntregable,
                    kcha.Avance as avanceS,
                    ch.Nivel,
                    kcha.IdCheckList as idCheck,
                    kcha.Inicial, kcha.Proceso, kcha.Final, kcha.Archivo, kcha.Avance as avancePersona, kcha.Visible as VisibleCh, per.Nombre as nombrePersona, per.id_Personas as idPersonaFiltro, ar.Id_Area as areaFiltro,
                    kcha.IdCategoria, kcha.IdEncargado, ar.Id_Area, kcha.Entregable, ch.Tipo as tipo, d.ruta,d.pdf, ch.automatico, kcha.Avance, ch.IdCheckListPadre
                    FROM k_checklist_actividad kcha
                    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
                    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
                    JOIN c_area ar ON ar.Id_Area=per.idArea
                    LEFT JOIN c_documento d ON d.id_documento = kcha.Archivo
                    WHERE kcha.IdActividad=" . $IdAcGlo . " AND kcha.Id_Periodo=" . $miPeriodo . " AND kcha.Visible = '1' and kcha.IdCheckList = ".$IdCheckListPadre."
                    
                    ORDER BY ch.Nivel DESC, kcha.Orden";
                    $resultConsultaPadre = $catalogo->obtenerLista($consultaPadre);
                    $rowPadre = mysqli_fetch_array($resultConsultaPadre);

                    $checkPadre = $rowPadre['nombreEntregable'];

                    $tituloCheckPadre = "<p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -2px; margin-bottom: -10px;'><span style='font-weight: bold;'> Check: </span>"  . $checkPadre . "</p>";

                } else {
                    $tituloCheck = "Check: ";
                    $tituloCheckPadre = "";
                }

                echo "<tr >";
                // echo "  <td></td>";
                echo "  <td style='background-color: #854d792e;'>
                <p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -7px;'> <span style='font-weight: bold; font-size: 10px;'>" . $contadorEntregableC . "</span> <span style='font-weight: bold;'> Cat: </span>" . $CategoriaS .  "</p>" .
                    $SubCatSTitulo .
                    "
                    <p style='padding-left: 18px; color: #000000; font-size: .8em; margin-top: -11px; margin-bottom: 0px;'> <span style='font-weight: bold;'>AcGlo: </span>" . $AcGloS . "</p>" .
                    $tituloCheckPadre .
                    "</td>";

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red; padding-left: 18px; font-size: .8em;' ";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green; padding-left: 18px; font-size: .8em;'";
                } else  $miColor = " style='color:orange; padding-left: 18px; font-size: .8em;'";

                $ruta = $row['ruta'] . $row['pdf'];

                if ($row['tipo'] != 2) {
                    if ($row['automatico'] == 0) {
                        $icono = '<i class="fas fa-file-archive" data-toggle="tooltip" data-placement="top" data-original-title="Último archivo"></i>';
                    } else {
                        $icono = '<i class="fas fa-laptop-code" data-toggle="tooltip" data-placement="top" data-original-title="BD"></i>';
                    }
                    if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                        $onclick_check = 'target="_blank" href="' . $row['ruta'] . '"';
                    } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                        $onclick_check = 'target="_blank" href="' . $ruta . '"';
                    } else {
                        $onclick_check = "";
                    }
                }

                $avance_checklist = intval($row['Avance']);

                $n_check_v = $row['Nombre'];
                $nombrecheck = "'" . $n_check_v . "'";
                $idcheck = $row['idCheck'];
                $Id_Actividad = $row['IdActividad'];
                $cate = $categoriaDatos;
                $Id_categoria = $IdCat;
                $Id_subcategoria = $IdSubCategoria;
                $AGLOBAL = $IdAcGlo;
                $AGENEREAL = "";

                if ($avance_checklist >= 1 && $avance_checklist <= 24) {
                    $color = "dfa739";
                    $tipo_entregable = 9;
                } elseif ($avance_checklist >= 25 && $avance_checklist <= 49) {
                    $color = "#dfa739";
                    $tipo_entregable = 14;
                } elseif ($avance_checklist >= 50 && $avance_checklist <= 99) {
                    $color = "#dbd909";
                    $tipo_entregable = 10;
                } elseif ($avance_checklist >= 100) {
                    $color = "#33ab15";
                } else {
                    $color = "red";
                    $tipo_entregable = 9;
                }

                if ($miTipoACME == "1") {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #800080;font-size:10px;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                } else {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #2132c8;font-size:10px;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                }

                $onclick_versiones = ' onclick="muestraversiones(' . $nombrecheck . ',' . $idcheck . ',' . $miTipoACME . ',' . $Id_Actividad . ',' . $cate . ',' . $miPeriodo . ');"';
              //  $onclick_form = 'href="../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=1&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $miEje . '&ACME=' . $miTipoACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' . $miPeriodo . '&check=' . $idcheck . '&subcheck=&regreso=2&tipo_entregable=' . $tipo_entregable . '"';

                echo " <p style='padding-left: 18px; font-size: 8px; margin-bottom: -14px;'> <span style='font-weight: bold;font-size: 8px;'>" . $tituloCheck . "</span>" . $row['idCheck'] . "-". $row['nombreEntregable'] . "</p><br>";

                echo "  <progress style='margin-left: 18px;' id='file' max='100' value='" . $row['avanceS'] . "' class='padre'></progress>" . $row['avanceS'] . " %" . "";

                echo " <span style='margin-left: 7px;'><a style='color: purple;display: inline-block;' href='" . $onclick_form2 . "'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Añadir entregable' class='fas fa-plus-circle'></i></a></span>";
                echo "<span><a " . $onclick_asunto2 . "style='display: inline-block;color:purple'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Redactar asunto' class='far fa-edit'></i><a></span>";
                // echo "<span><a target='_blank' href='https://docs.google.com/presentation/d/19boD6vnR6reqNgIbDihl4a2hdGwmbQ0q/mobilepresent?slide=id.p1' style='display: inline-block;color:#33ab15;'><i class='fas fa-file-archive' data-toggle='tooltip' data-placement='bottom' data-original-title='Último archivo'></i></a></span>";
                if ($row['Archivo'] != '' && $row['tipo'] == 1) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . '">' . $icono . '</a></span>';
                } elseif ($row['Archivo'] == '' && $row['tipo'] == 1) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . ';">' . $icono . '</a></span>';
                } elseif ($row['Archivo'] == '' && $row['tipo'] == 2) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . '">' . $icono . '</a></span>';
                } elseif ($row['Archivo'] != '' && $row['tipo'] == 2) {
                    echo '<span><a ' . $onclick_check . ' style="display: inline-block; margin-left: 2px; color:' . $color . '">' . $icono . '</a></span>';
                }
                if ($row['tipo'] == 1) { 
                   echo '<span '. $onclick_versiones . 'style="display: inline-block; margin-left: 2px; color:purple"><i data-toggle="tooltip" data-placement="top" data-original-title="Versiones" class="fas fa-archive"></i></span>';
                    if ($row['id_tipo'] != 10) { 
                     // echo '<span><a style="color: purple;display: inline-block; margin-left: 2px;" '. $onclick_form .'><i data-toggle="tooltip" data-placement="top" data-original-title="Añadir entregable" class="fas fa-plus-circle"></i></a></span>';
                    } 
                } 
                echo "</td>";
                echo "</tr>";

                $contadorEntregableC++;
                // ImprimeSubCheck($row['idCheck'], $IdAcGlo, $CategoriaS, $SubCatS, $AcGloS, $row['nombreEntregable']);

                $avanceGlobalPersona += $row['avanceS'];
                $contadorEntregable++;
            }
        }
           $idcheckAnterior = $row['idCheck'];
    } //while
} //function ImprimeCheck
echo "+" . "Entregables: " . $contadorEntregable;
if ($contadorEntregable != 0) {
    echo "+" . "Avance Personal: " . number_format($avanceGlobalPersona / $contadorEntregable, 1, '.', '') . " %";
} else {
    echo "+" . "Avance Personal: 0%";
}
/*
if ($contadorEntregable != 0) {
    $_POST["persona"] echo "<label class='col-md-12 col-sm-12 col-xs-12  control-label' for='descripcion' style='font-size: 11px;'>Avance Personal: " . number_format($avanceGlobalPersona / $contadorEntregable, 1, '.', '') . " % </label>";
    // echo "Avance Personal: " . number_format($avanceGlobalPersona / $contadorEntregable, 1, '.', '') . "%";
} else {
    // echo "Avance Personal: 0%";
    echo "<label class='col-md-12 col-sm-12 col-xs-12  control-label' for='descripcion' style='font-size: 11px;'>Avance Personal: 0% </label>";
}
//-------------------------------------------------------------------------------------------------
/*function ImprimeSubCheck($IdCheck, $IdActividad, $CategoriaS, $SubCatS, $AcGloS, $NomCheck)
{
    global $miTipoACME, $miPeriodo, $persona, $contadorEntregable, $avanceGlobalPersona, $filtroPersona, $area, $filtroArea, $contadorEntregableC;
   
    $catalogo = new Catalogo();
    $consulta = "SELECT
    kcha.Orden AS OrdenCh,
    CONCAT(ch.Nombre,'[',kcha.IdCheckList,']<br>',per.Nombre,' ',per.Apellido_Paterno,'(',ar.Nombre,')') AS NomCheck,
    kcha.Avance as avanceS,
    ch.Nivel,
    kcha.IdCheckList as idCheck,
    kcha.Inicial, kcha.Proceso, kcha.Final, kcha.Archivo, kcha.Avance as avancePersona, kcha.Visible as VisibleCh, per.Nombre as nombrePersona, per.id_Personas as idPersonaFiltro, ar.Id_Area as areaFiltro,
    kcha.IdCategoria, kcha.IdEncargado, ar.Id_Area, kcha.Entregable
    FROM k_checklist_actividad kcha
    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
    JOIN c_area ar ON ar.Id_Area=per.idArea
    WHERE ch.IdCheckListPadre=" . $IdCheck . " AND kcha.Id_Periodo=" . $miPeriodo . " AND (ch.Nivel=2) and kcha.Visible = '1' and kcha.IdActividad=" . $IdActividad . " 
    ORDER BY ch.Nivel DESC, kcha.Orden";
    //echo $consulta;
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {

        $onclick_asunto2 = "";
        $onclick_asunto2 = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=1&nombreUsuario=' . $row['nombrePersona'] . '&idUsuario=' . $row['idPersonaFiltro'] . '&plan=1&Id_eje=1&ACME=' .
            $miTipoACME . '&cate=' . $row['IdCategoria'] . '&subcate=' . $row['IdCategoria'] . '&AGBL=' . $IdActividad . '&AGENE=' . $IdActividad . '&periodo=' .
            $miPeriodo . '&check=' . $row['idCheck'] . '&subcheck=0&regreso=2&tipo_entregable=9&id_encargado=' . $row['IdEncargado'] . '&id_area=' . $row['Id_Area'] . '"';

        $onclick_form2 = '../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=1&nombreUsuario=1&idUsuario=1&plan=1&Id_eje=1&ACME=1&cate=1&subcate=1&AGBL=1&AGENE=1&periodo=14&check=1&subcheck=1&regreso=2&tipo_entregable=1&check_global=1';

        if (isset($_POST["area"])) {
            if ($row['areaFiltro'] == $area or $filtroArea) {
                echo "<tr style='background-color: #854d790a;'>";
                //  echo "  <td></td>";
                echo "  <td>
                         <p style='padding-left: 18px; color: #000000; font-size: .8em;'> <span style='font-weight: bold; font-size: 10px;'>".$contadorEntregableC ."</span> Cat:" . $CategoriaS . "</p>" .
                    "
                    <p style='padding-left: 18px; color: #000000; font-size: .8em;'> SubCat:" . $SubCatS . "</p>" .
                    "
                    <p style='padding-left: 18px; color: #000000; font-size: .8em;'> AcGlo:" . $AcGloS . "</p>" .
                    "</td>";
                echo "  <td> <p style='padding-left: 18px; color: #000000; font-size: .8em;'>" . $NomCheck . "</p> </td>";

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red; padding-left: 18px; font-size: .8em;'";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green; padding-left: 18px; font-size: .8em;'";
                } else                            $miColor = " style='color:orange; padding-left: 18px; font-size: .8em;'";

                if ($miTipoACME == "1") {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #800080;font-size:.8em;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                } else {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #2132c8;font-size:.8em;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                }

                echo "" . $row['NomCheck'] . "<br>";
               

                echo "  <progress id='file' max='100' value='" . $row['avanceS'] . "' class='padre'></progress>" . $row['avanceS'] . " %" . "<br>";

                echo " <span><a style='color: purple;display: inline-block;' href='" . $onclick_form2 . "'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Añadir entregable' class='fas fa-plus-circle'></i></a></span>";
                echo "<span><a " . $onclick_asunto2 . "style='display: inline-block;color:purple'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Redactar asunto' class='far fa-edit'></i><a></span>";
                echo "</td>";
                echo "</tr>";

                $avanceGlobalPersona += $row['avancePersona'];
                $contadorEntregable++;
                $contadorEntregableC++;
            }
        } else {
            if ($row['idPersonaFiltro'] == $persona or $filtroPersona) {
                echo "<tr style='background-color: #854d790a;'>";
                //  echo "  <td></td>";
                echo "  <td>
                         <p style='padding-left: 18px; color: #000000; font-size: .8em;'> <span style='font-weight: bold; font-size: 10px;'>".$contadorEntregableC ."</span> Cat:" . $CategoriaS . "</p>" .
                    "
                    <p style='padding-left: 18px; color: #000000; font-size: .8em;'> SubCat:" . $SubCatS . "</p>" .
                    "
                    <p style='padding-left: 18px; color: #000000; font-size: .8em;'> AcGlo:" . $AcGloS . "</p>" .
                    "</td>";
                echo "  <td> <p style='padding-left: 18px; color: #000000; font-size: .8em;'>" . $NomCheck . "</p> </td>";

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red; padding-left: 18px; font-size: .8em;'";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green; padding-left: 18px; font-size: .8em;'";
                } else                            $miColor = " style='color:orange; padding-left: 18px; font-size: .8em;'";

                if ($miTipoACME == "1") {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #800080;font-size:.8em;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                } else {
                    echo "<td" . $miColor . "> <span class='numcheck_glob' data-toggle='tooltip' data-placement='bottom' style='padding-left: 18px;color: #2132c8;font-size:.8em;' data-original-title='entregable de prueba' aria-describedby='tooltip365946'>" . $row['Entregable'] . "</span> <br>";
                }

                echo "" . $row['NomCheck'] . "<br>";
                
                echo "  <progress id='file' max='100' value='" . $row['avanceS'] . "' class='padre'></progress>" . $row['avanceS'] . " %" . "<br>";

                echo " <span><a style='color: purple;display: inline-block;' href='" . $onclick_form2 . "'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Añadir entregable' class='fas fa-plus-circle'></i></a></span>";
                echo "<span><a " . $onclick_asunto2 . "style='display: inline-block;color:purple'><i data-toggle='tooltip' data-placement='bottom' data-original-title='Redactar asunto' class='far fa-edit'></i><a></span>";
                echo "</td>";
                echo "</tr>";

                $avanceGlobalPersona += $row['avancePersona'];
                $contadorEntregable++;
                $contadorEntregableC++;
            }
        }
    } //while
} //function ImprimeSubCheck
//-------------------------------------------------------------------------------------------------
*/
?>