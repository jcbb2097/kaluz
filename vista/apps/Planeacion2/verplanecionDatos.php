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
$miTipoACME = $_POST["Tipo"];; //1=Actividad, 2=Meta
$persona = "0";


if (isset($_POST["persona"])) {
    $persona = $_POST["persona"];
}
$area = "0";
if (isset($_POST["area"])) {
    $area = $_POST["area"];
}

$avanceGlobalPersona = 0;
$contadorEntregable = 0;
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
           
        } else {
           
        }
      
        ImprimeSubCat($row['idCategoria']);
        ImprimeAcGlo($row['idCategoria']);
    } //while

   
    ?>

</body>

</html>

<?php
//-------------------------------------------------------------------------------------------------
function ImprimeSubCat($IdCat)
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
       
        ImprimeAcGlo($row['idSubCategoria']);
    } //while
} //function ImprimeSubCat
//-------------------------------------------------------------------------------------------------
function ImprimeAcGlo($IdSubCategoria)
{
    global $miTipoACME, $miPeriodo;
    $catalogo = new Catalogo();
    $consulta = "SELECT kaccat.Orden AS OrdenAcGlo,
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
      
        ImprimeAcGen($row['idAcGlo'], $IdSubCategoria);
        ImprimeCheck($row['idAcGlo']);
    } //while
} //function ImprimeAcGlo
//-------------------------------------------------------------------------------------------------
function ImprimeAcGen($IdAcGlo, $IdSubCategoria)
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
        // ImprimeAcGen($row['idAcGlo']);
        ImprimeCheck($row['idAcGlo']);
    } //while
} //function ImprimeAcGen
//-------------------------------------------------------------------------------------------------
function ImprimeCheck($IdAcGlo)
{
    global $miTipoACME, $miPeriodo, $persona, $contadorEntregable, $avanceGlobalPersona, $filtroPersona, $area, $filtroArea, $miEje;
    $catalogo = new Catalogo();

    $consulta = "SELECT
    kcha.Orden AS OrdenCh,
    CONCAT(ch.Nombre,'<br>',per.Nombre,' ',per.Apellido_Paterno,'') AS NomCheck,
    ch.Nombre as nombreEntregable,
    kcha.Avance as avanceS,
    ch.Nivel,
    kcha.IdCheckList as idCheck,
    kcha.Inicial, kcha.Proceso, kcha.Final, kcha.Archivo, kcha.Avance as avancePersona, kcha.Visible as VisibleCh, per.Nombre as nombrePersona, per.id_Personas as idPersonaFiltro, ar.Id_Area as areaFiltro,
    kcha.IdCategoria, kcha.IdEncargado, ar.Id_Area, kcha.Entregable
    FROM k_checklist_actividad kcha
    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
    JOIN c_area ar ON ar.Id_Area=per.idArea
    WHERE kcha.IdActividad=" . $IdAcGlo . " AND kcha.Id_Periodo=" . $miPeriodo . " AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3)) and kcha.Visible = '1'
    
    ORDER BY ch.Nivel DESC, kcha.Orden";
    //echo $consulta;
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {

        $onclick_asunto2 = "";
        $onclick_asunto2 = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=1&nombreUsuario=' . $row['nombrePersona'] . '&idUsuario=' . $row['idPersonaFiltro'] . '&plan=1&Id_eje=' . $miEje . '&ACME=' .
            $miTipoACME . '&cate=' . $row['IdCategoria'] . '&subcate=' . $row['IdCategoria'] . '&AGBL=' . $IdAcGlo . '&AGENE=' . $IdAcGlo . '&periodo=' .
            $miPeriodo . '&check=' . $row['idCheck'] . '&subcheck=0&regreso=2&tipo_entregable=9&id_encargado=' . $row['IdEncargado'] . '&id_area=' . $row['Id_Area'] . '"';

        $onclick_form2 = '../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=1&nombreUsuario=1&idUsuario=1&plan=1&Id_eje=1&ACME=1&cate=1&subcate=1&AGBL=1&AGENE=1&periodo=14&check=1&subcheck=1&regreso=2&tipo_entregable=1&check_global=1';

        if (isset($_POST["area"])) {
            if ($row['areaFiltro'] == $area or $filtroArea) {
               
                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red';";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green';";
                } else                            $miColor = " style='color:orange'";
              
                ImprimeSubCheck($row['idCheck'], $IdAcGlo);

                $avanceGlobalPersona += $row['avancePersona'];
                $contadorEntregable++;
            }
        } else {
            if ($row['idPersonaFiltro'] == $persona or $filtroPersona) {            

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red';";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green';";
                } else                            $miColor = " style='color:orange'";
               
                ImprimeSubCheck($row['idCheck'], $IdAcGlo);

                $avanceGlobalPersona += $row['avanceS'];
                $contadorEntregable++;
            }
        }
    } //while
} //function ImprimeCheck
//-------------------------------------------------------------------------------------------------
function ImprimeSubCheck($IdCheck, $IdActividad)
{
    global $miTipoACME, $miPeriodo, $persona, $contadorEntregable, $avanceGlobalPersona, $filtroPersona, $area, $filtroArea;

    $catalogo = new Catalogo();
    $consulta = "SELECT
    kcha.Orden AS OrdenCh,
    CONCAT(ch.Nombre,'[',kcha.IdCheckList,']<br>',per.Nombre,' ',per.Apellido_Paterno,'(',ar.Nombre,')') AS NomCheck,
    kcha.Avance as avanceS,
    ch.Nivel,
    kcha.IdCheckList as idCheck,
    kcha.Inicial, kcha.Proceso, kcha.Final, kcha.Archivo, kcha.Avance as avancePersona, kcha.Visible as VisibleCh, per.Nombre as nombrePersona, per.id_Personas as idPersonaFiltro, ar.Id_Area as areaFiltro,
    kcha.IdCategoria, kcha.IdEncargado, ar.Id_Area
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
               

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red'";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green'";
                } else                            $miColor = " style='color:orange'";
            
                $avanceGlobalPersona += $row['avancePersona'];
                $contadorEntregable++;
            }
        } else {
            if ($row['idPersonaFiltro'] == $persona or $filtroPersona) {
              

                $miColor = ""; //se inicializa, es para poner color al avance 0%=Rojo, 100%=Verde y cualquier otra cosa Amarillo
                if ($row['avancePersona'] == 0) {
                    $miColor = " style='color:red'";
                } else if ($row['avancePersona'] == 100) {
                    $miColor = " style='color:green'";
                } else                            $miColor = " style='color:orange'";
              
                $avanceGlobalPersona += $row['avancePersona'];
                $contadorEntregable++;
            }
        }
    } //while
} //function ImprimeSubCheck
//-------------------------------------------------------------------------------------------------

//echo "Número de entregables: " . $contadorEntregable;
echo "<label class='col-md-12 col-sm-12 col-xs-12  control-label' for='descripcion' style='font-size: 11px;'>Número de entregables: ".$contadorEntregable. " </label>";
echo "<BR>";
if ($contadorEntregable != 0) {
   echo "<label class='col-md-12 col-sm-12 col-xs-12  control-label' for='descripcion' style='font-size: 11px;'>Avance Personal: ".number_format($avanceGlobalPersona / $contadorEntregable, 1, '.', ''). " % </label>";
   // echo "Avance Personal: " . number_format($avanceGlobalPersona / $contadorEntregable, 1, '.', '') . "%";
} else {
   // echo "Avance Personal: 0%";
    echo "<label class='col-md-12 col-sm-12 col-xs-12  control-label' for='descripcion' style='font-size: 11px;'>Avance Personal: 0% </label>";
}

?>