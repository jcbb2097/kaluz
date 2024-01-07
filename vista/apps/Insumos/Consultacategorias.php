<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";

if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}

include_once('../../../WEB-INF/Classes/Catalogo.class.php');


$catalogo = new Catalogo();
$categoria = "";
$IdGlobal = "";
$subcategoria = "";
$IdGeneral = "";
$globalentregable = "";
$Particular = "";

//Busqueda por Categoria
$Ano=""; //Se inicializa la variable
if ((isset($_GET['Ano']) && $_GET['Ano'] != "")) //Si el parametro existe se procesa
{   if ($_GET['Ano']!="0") {$Ano =$_GET['Ano'];}} //Si el parametro es diferente de 0 se busca el valor

$Eje="";
if ((isset($_GET['Eje']) && $_GET['Eje'] != ""))
{   if ($_GET['Eje']!="0") {$Eje =$_GET['Eje'];
    $consultacategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce 
        LEFT JOIN k_categoriasdeejes_anios kca ON kca.idCategoria=ce.idCategoria
        LEFT JOIN c_periodo p on p.Periodo=kca.Anio 
        WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$Ano AND ce.idEje=$Eje AND kca.Visible=1 ORDER BY ce.orden ";
    $resultado3 = $catalogo->obtenerLista($consultacategoria);
    echo '<option>Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado3)) {
    $s = '';
    if ($row['idCategoria'] == $categoria) {
    $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
}
}}
    



//Busqueda pora Subcategoria
$Categoria="";
if ((isset($_GET['Categoria']) && $_GET['Categoria'] != ""))
{   if ($_GET['Categoria']!="0") {$Categoria =$_GET['Categoria'];
    $consultasubcategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce LEFT JOIN k_categoriasdeejes_anios kca ON kca.idCategoria=ce.idCategoria
        LEFT JOIN c_periodo p on p.Periodo=kca.Anio 
        WHERE kca.Visible=1 AND p.Id_Periodo=$Ano and ce.idCategoriaPadre=$Categoria 
        ORDER BY ce.orden";
    $resultado4 = $catalogo->obtenerLista($consultasubcategoria);
    echo '<option>Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado4)) {
    $s = '';
    if ($row['idCategoria'] == $subcategoria) {
    $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
    }
}}


//Busqueda por Global por Eje
$AnoGlobal=""; //Se inicializa la variable
if ((isset($_GET['AnoGlobal']) && $_GET['AnoGlobal'] != "")) //Si el parametro existe se procesa
{   if ($_GET['AnoGlobal']!="0") {$AnoGlobal =$_GET['AnoGlobal'];}}

$ActividadMeta=""; //Se inicializa la variable
if ((isset($_GET['ActividadMeta']) && $_GET['ActividadMeta'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ActividadMeta']!="0") {$ActividadMeta =$_GET['ActividadMeta'];}}

$EjeGlobal="";
if ((isset($_GET['EjeGlobal']) && $_GET['EjeGlobal'] != ""))
{   if ($_GET['EjeGlobal']!="0") {$EjeGlobal =$_GET['EjeGlobal'];
    $consultaperiodo7 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
        LEFT JOIN c_periodo p on p.Periodo=ka.Anio  WHERE a.IdEje=$EjeGlobal AND a.IdNivelActividad=1 AND IdTipoActividad=$ActividadMeta and p.Id_Periodo=$AnoGlobal AND ka.Visible=1 ORDER BY a.Orden";
        //echo $consultaperiodo7;
        $resultado7 = $catalogo->obtenerLista($consultaperiodo7);
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado7)) {
        $s = '';
        if ($row['IdActividad'] == $IdGlobal) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
        }
}}


//Busqueda por Categoria llenar Global
$AnoGlobal1=""; //Se inicializa la variable
if ((isset($_GET['AnoGlobal1']) && $_GET['AnoGlobal1'] != "")) //Si el parametro existe se procesa
{   if ($_GET['AnoGlobal1']!="0") {$AnoGlobal1 =$_GET['AnoGlobal1'];}}

$EjeGlobal1="";
if ((isset($_GET['EjeGlobal1']) && $_GET['EjeGlobal1'] != ""))
{   if ($_GET['EjeGlobal1']!="0") {$EjeGlobal1 =$_GET['EjeGlobal1'];}}

$ActividadMeta1=""; //Se inicializa la variable
if ((isset($_GET['ActividadMeta1']) && $_GET['ActividadMeta1'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ActividadMeta1']!="0") {$ActividadMeta1 =$_GET['ActividadMeta1'];}}

$Categoria1="";
if ((isset($_GET['Categoria1']) && $_GET['Categoria1'] != ""))
{   if ($_GET['Categoria1']!="0") {$Categoria1 =$_GET['Categoria1'];
    $consultaperiodo7 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
        LEFT JOIN c_periodo p on p.Periodo=ka.Anio WHERE a.IdEje=$EjeGlobal1 AND a.IdNivelActividad=1 AND IdTipoActividad=$ActividadMeta1 and p.Id_Periodo=$AnoGlobal1 AND a.Idcategoria=$Categoria1 AND ka.Visible=1  ORDER BY a.Orden";
        //echo $consultaperiodo7;
        $resultado7 = $catalogo->obtenerLista($consultaperiodo7);
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado7)) {
        $s = '';
        if ($row['IdActividad'] == $IdGlobal) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
        }
}}


//Busqueda por SubCategoria llenar Global
$ActividadMeta2=""; //Se inicializa la variable
if ((isset($_GET['ActividadMeta2']) && $_GET['ActividadMeta2'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ActividadMeta2']!="0") {$ActividadMeta2 =$_GET['ActividadMeta2'];}}

$Categoria3="";
if ((isset($_GET['Categoria3']) && $_GET['Categoria3'] != ""))
{   if ($_GET['Categoria3']!="0") {$Categoria3 =$_GET['Categoria3'];
    $consultaperiodo13 = "SELECT DISTINCT a.IdActividad,CONCAT(a.Numeracion,a.Nombre) as actividad
    FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad 
     LEFT JOIN c_periodo p on p.Periodo=ka.Anio
    WHERE a.Idcategoria=$Categoria3 AND a.IdTipoActividad=$ActividadMeta2 and a.IdNivelActividad=1 AND ka.Visible=1 and p.Id_Periodo=$Ano ORDER BY a.Orden";
    //echo $consultaperiodo13;
        $resultadoidsub = $catalogo->obtenerLista($consultaperiodo13);
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultadoidsub)) {
        $s = '';
        if ($row['IdActividad'] == $IdGlobal) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
        }
}}


//Busqueda por General
$Ejeparaglobal=""; //Se inicializa la variable
if ((isset($_GET['ejeparaglobal']) && $_GET['ejeparaglobal'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeparaglobal']!="0") {$Ejeparaglobal =$_GET['ejeparaglobal'];}} //Si el parametro es diferente de 0 se busca el valor

$actividadmetageneral=""; //Se inicializa la variable
if ((isset($_GET['actividadmetageneral']) && $_GET['actividadmetageneral'] != "")) //Si el parametro existe se procesa
{   if ($_GET['actividadmetageneral']!="0") {$actividadmetageneral =$_GET['actividadmetageneral'];}}

$ActividadGeneral="";
if ((isset($_GET['actividadglobal']) && $_GET['actividadglobal'] != ""))
{   if ($_GET['actividadglobal']!="0") {$ActividadGeneral =$_GET['actividadglobal'];
    $consultaperiodo8 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
    FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad 
     LEFT JOIN c_periodo p on p.Periodo=ka.Anio 
    WHERE a.IdEje = $Ejeparaglobal AND a.IdNivelActividad = 2 AND a.IdTipoActividad =$actividadmetageneral AND a.IdActividadSuperior=$ActividadGeneral AND ka.Visible=1 and p.Id_Periodo=$Ano 
    ORDER BY a.Orden";
    //echo $consultaperiodo8;
    $resultado8 = $catalogo->obtenerLista($consultaperiodo8);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado8)) {
    $s = '';
    if ($row['IdActividad'] == $IdGeneral) {
    $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
    }
}}


//Busqueda por check desde general
$Ejeparaparticular=""; //Se inicializa la variable
if ((isset($_GET['ejeparaparticular']) && $_GET['ejeparaparticular'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeparaparticular']!="0") {$Ejeparaparticular =$_GET['ejeparaparticular'];}} //Si el parametro es diferente de 0 se busca el valor

$actividadmetaparticular=""; //Se inicializa la variable
if ((isset($_GET['actividadmetaparticular']) && $_GET['actividadmetaparticular'] != "")) //Si el parametro existe se procesa
{   if ($_GET['actividadmetaparticular']!="0") {$actividadmetaparticular =$_GET['actividadmetaparticular'];}}

$Actividadparticular="";
if ((isset($_GET['actividadparticular']) && $_GET['actividadparticular'] != ""))
{   if ($_GET['actividadparticular']!="0") {$Actividadparticular =$_GET['actividadparticular'];
    $consultaperiodo9 = "SELECT ca.IdCheckList,che.Nombre AS Nombre, che.Nivel
                            FROM c_actividad a 
                            LEFT JOIN k_checklist_actividad ca ON ca.IdActividad=a.IdActividad
                            LEFT JOIN c_checkList che ON che.IdCheckList=ca.IdCheckList
                            LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=che.IdCheckList
                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                            WHERE a.IdActividad=$Actividadparticular AND che.Nivel=1 AND kche.Visible=1 and p.Id_Periodo=$Ano 
                            ORDER BY a.Orden";
                            //echo $consultaperiodo9;
    $resultado9 = $catalogo->obtenerLista($consultaperiodo9);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado9)) {
    $s = '';
    if ($row['IdCheckList'] == $IdGeneral) {
    $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
    }
}}





//Busqueda por sub check
$Ejeparasubactividad=""; //Se inicializa la variable
if ((isset($_GET['ejeparasubactividad']) && $_GET['ejeparasubactividad'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeparasubactividad']!="0") {$Ejeparasubactividad =$_GET['ejeparasubactividad'];}} //Si el parametro es diferente de 0 se busca el valor

$actividadmetaactividadsub=""; //Se inicializa la variable
if ((isset($_GET['actividadmetaactividadsub']) && $_GET['actividadmetaactividadsub'] != "")) //Si el parametro existe se procesa
{   if ($_GET['actividadmetaactividadsub']!="0") {$actividadmetaactividadsub =$_GET['actividadmetaactividadsub'];}}

$Actividadsubactividad="";
if ((isset($_GET['actividadsubactividad']) && $_GET['actividadsubactividad'] != ""))
{   if ($_GET['actividadsubactividad']!="0") {$Actividadsubactividad =$_GET['actividadsubactividad'];
    $consultaperiodo10 = "SELECT ca.IdCheckList,che.Nombre AS Nombre, che.Nivel
                            FROM c_actividad a 
                            LEFT JOIN k_checklist_actividad ca ON ca.IdActividad=a.IdActividad
                            LEFT JOIN c_checkList che ON che.IdCheckList=ca.IdCheckList
                            LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=che.IdCheckList
                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                            WHERE che.IdCheckListPadre=$Actividadsubactividad AND kche.Visible=1 and p.Id_Periodo=$Ano 
                            ORDER BY a.Orden";
                            //echo $consultaperiodo10;
        $resultado10 = $catalogo->obtenerLista($consultaperiodo10);
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado10)) {
        $s = '';
        if ($row['IdCheckList'] == $Particular) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
}}





//Busqueda por Global para Entregable
$EjeEntregableGlobal="";
if ((isset($_GET['EjeEntregableGlobal']) && $_GET['EjeEntregableGlobal'] != ""))
{   if ($_GET['EjeEntregableGlobal']!="0") {$EjeEntregableGlobal=$_GET['EjeEntregableGlobal'];
    $consultaperiodo11 = "SELECT en.IdEntregable,en.Nombre FROM c_entregable en 
JOIN k_entregableActividad ken ON ken.IdEntregable=en.IdEntregable
    WHERE ken.IdActividad=$EjeEntregableGlobal
    order BY Nombre asc";
        $resultado11 = $catalogo->obtenerLista($consultaperiodo11);
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdEntregable'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
}}



//Busqueda por General para Entregable
$EjeEntregableGeneral="";
if ((isset($_GET['EjeEntregableGeneral']) && $_GET['EjeEntregableGeneral'] != ""))
{   if ($_GET['EjeEntregableGeneral']!="0") {$EjeEntregableGeneral=$_GET['EjeEntregableGeneral'];
    $consultaperiodo11 = "SELECT en.IdEntregable,en.Nombre FROM c_entregable en 
JOIN k_entregableActividad ken ON ken.IdEntregable=en.IdEntregable
    WHERE ken.IdActividad=$EjeEntregableGeneral
    order BY Nombre asc";
        $resultado11 = $catalogo->obtenerLista($consultaperiodo11);
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdEntregable'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
}}




//Busqueda por Check para Entregable
$EjeEntregableParticular="";
if ((isset($_GET['EjeEntregableParticular']) && $_GET['EjeEntregableParticular'] != ""))
{   if ($_GET['EjeEntregableParticular']!="0") {$EjeEntregableParticular=$_GET['EjeEntregableParticular'];
    $consultaperiodo11 = "SELECT ca.IdCheckList AS IdCheckList,ca.Entregable AS Entregable 
    from k_checklist_actividad ca 
    WHERE ca.IdCheckList=$EjeEntregableParticular
    order BY ca.Orden asc";
        $resultado11 = $catalogo->obtenerLista($consultaperiodo11);
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdCheckList'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Entregable'] . '</option>';
        }
}}





//Busqueda por sub check para Entregable
$EjeEntregableSubActividad="";
if ((isset($_GET['EjeEntregableSubActividad']) && $_GET['EjeEntregableSubActividad'] != ""))
{   if ($_GET['EjeEntregableSubActividad']!="0") {$EjeEntregableSubActividad=$_GET['EjeEntregableSubActividad'];
    $consultaperiodo11 = "SELECT ca.IdCheckList AS IdCheckList,ca.Entregable AS Entregable 
    from k_checklist_actividad ca 
    WHERE ca.IdCheckList=$EjeEntregableSubActividad
    order BY ca.Orden asc";
    echo $consultaperiodo11;
        $resultado11 = $catalogo->obtenerLista($consultaperiodo11);
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdCheckList'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Entregable'] . '</option>';
        }
}}


//Busqueda por check desde global
$Actividadparticularglobal="";
if ((isset($_GET['actividadparticularglobal']) && $_GET['actividadparticularglobal'] != ""))
{   if ($_GET['actividadparticularglobal']!="0") {$Actividadparticularglobal =$_GET['actividadparticularglobal'];
    $consultaperiodo9 = "SELECT ca.IdCheckList,che.Nombre AS Nombre, che.Nivel
                            FROM c_actividad a 
                            LEFT JOIN k_checklist_actividad ca ON ca.IdActividad=a.IdActividad
                            LEFT JOIN c_checkList che ON che.IdCheckList=ca.IdCheckList
                            LEFT JOIN k_checkList_anios kche ON kche.IdCheckList=che.IdCheckList
                            LEFT JOIN c_periodo p ON p.Periodo=kche.Anio
                            WHERE a.IdActividad=$Actividadparticularglobal AND che.Nivel=1 AND kche.Visible=1 and p.Id_Periodo=$Ano
                            ORDER BY a.Orden";
    $resultado9 = $catalogo->obtenerLista($consultaperiodo9);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado9)) {
    $s = '';
    if ($row['IdCheckList'] == $IdGeneral) {
    $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
    }
}}
?>

