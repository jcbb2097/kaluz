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
include_once('Entregablecheck.class.php');

$catalogo = new Catalogo();
$entregablecheck = new Entregablecheck();
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
    $consultacategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce INNER JOIN c_periodo p on p.Id_Periodo=ce.anio WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$Ano AND ce.idEje=$Eje ORDER BY ce.orden ";
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
    $consultasubcategoria = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Categoria ORDER BY ce.orden";
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
    $consultaperiodo7 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a WHERE a.IdEje=$EjeGlobal AND a.IdNivelActividad=1 AND IdTipoActividad=$ActividadMeta and a.Periodo=$AnoGlobal ORDER BY a.Orden";
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
    $consultaperiodo7 = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a WHERE a.IdEje=$EjeGlobal1 AND a.IdNivelActividad=1 AND IdTipoActividad=$ActividadMeta1 and a.Periodo=$AnoGlobal1 AND a.Idcategoria=$Categoria1 ORDER BY a.Orden";
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
    FROM c_categoriasdeejes ce 
    LEFT JOIN c_periodo p on p.Id_Periodo=ce.anio
    LEFT JOIN c_actividad a ON a.Periodo=p.Id_Periodo
    WHERE a.Idcategoria=$Categoria3 AND a.IdTipoActividad=$ActividadMeta2 and a.IdNivelActividad=1 ORDER BY a.Orden";
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
    FROM c_actividad a 
    WHERE a.IdEje = $Ejeparaglobal AND a.IdNivelActividad = 2 AND a.IdTipoActividad =$actividadmetageneral AND a.IdActividadSuperior=$ActividadGeneral
    ORDER BY a.Orden";
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





//Busqueda por Particular
$Ejeparaparticular=""; //Se inicializa la variable
if ((isset($_GET['ejeparaparticular']) && $_GET['ejeparaparticular'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeparaparticular']!="0") {$Ejeparaparticular =$_GET['ejeparaparticular'];}} //Si el parametro es diferente de 0 se busca el valor

$actividadmetaparticular=""; //Se inicializa la variable
if ((isset($_GET['actividadmetaparticular']) && $_GET['actividadmetaparticular'] != "")) //Si el parametro existe se procesa
{   if ($_GET['actividadmetaparticular']!="0") {$actividadmetaparticular =$_GET['actividadmetaparticular'];}}

$Actividadparticular="";
if ((isset($_GET['actividadparticular']) && $_GET['actividadparticular'] != ""))
{   if ($_GET['actividadparticular']!="0") {$Actividadparticular =$_GET['actividadparticular'];
    $consultaperiodo9 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
    FROM c_actividad a 
    WHERE a.IdEje = $Ejeparaparticular AND a.IdNivelActividad = 3 AND a.IdTipoActividad =$actividadmetaparticular AND a.IdActividadSuperior=$Actividadparticular
    ORDER BY a.Orden";
    $resultado9 = $catalogo->obtenerLista($consultaperiodo9);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado9)) {
    $s = '';
    if ($row['IdActividad'] == $IdGeneral) {
    $s = 'selected = "selected"';
    }
    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
    }
}}





//Busqueda por Subactividad/Meta
$Ejeparasubactividad=""; //Se inicializa la variable
if ((isset($_GET['ejeparasubactividad']) && $_GET['ejeparasubactividad'] != "")) //Si el parametro existe se procesa
{   if ($_GET['ejeparasubactividad']!="0") {$Ejeparasubactividad =$_GET['ejeparasubactividad'];}} //Si el parametro es diferente de 0 se busca el valor

$actividadmetaactividadsub=""; //Se inicializa la variable
if ((isset($_GET['actividadmetaactividadsub']) && $_GET['actividadmetaactividadsub'] != "")) //Si el parametro existe se procesa
{   if ($_GET['actividadmetaactividadsub']!="0") {$actividadmetaactividadsub =$_GET['actividadmetaactividadsub'];}}

$Actividadsubactividad="";
if ((isset($_GET['actividadsubactividad']) && $_GET['actividadsubactividad'] != ""))
{   if ($_GET['actividadsubactividad']!="0") {$Actividadsubactividad =$_GET['actividadsubactividad'];
    $consultaperiodo10 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
    FROM c_actividad a 
    WHERE a.IdEje = $Ejeparasubactividad AND a.IdNivelActividad = 4 AND a.IdTipoActividad =$actividadmetaactividadsub AND a.IdActividadSuperior=$Actividadsubactividad ORDER BY a.Orden";
        $resultado10 = $catalogo->obtenerLista($consultaperiodo10);
        echo $consultaperiodo10;
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado10)) {
        $s = '';
        if ($row['IdActividad'] == $Particular) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
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
        echo '<option value = "">Seleccione</option>';
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
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdEntregable'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
}}




//Busqueda por Particular para Entregable
$EjeEntregableParticular="";
if ((isset($_GET['EjeEntregableParticular']) && $_GET['EjeEntregableParticular'] != ""))
{   if ($_GET['EjeEntregableParticular']!="0") {$EjeEntregableParticular=$_GET['EjeEntregableParticular'];
    $consultaperiodo11 = "SELECT en.IdEntregable,en.Nombre FROM c_entregable en 
JOIN k_entregableActividad ken ON ken.IdEntregable=en.IdEntregable
    WHERE ken.IdActividad=$EjeEntregableParticular
    order BY Nombre asc";
        $resultado11 = $catalogo->obtenerLista($consultaperiodo11);
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdEntregable'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
}}





//Busqueda por SubActividad/Meta para Entregable
$EjeEntregableSubActividad="";
if ((isset($_GET['EjeEntregableSubActividad']) && $_GET['EjeEntregableSubActividad'] != ""))
{   if ($_GET['EjeEntregableSubActividad']!="0") {$EjeEntregableSubActividad=$_GET['EjeEntregableSubActividad'];
    $consultaperiodo11 = "SELECT en.IdEntregable,en.Nombre FROM c_entregable en 
JOIN k_entregableActividad ken ON ken.IdEntregable=en.IdEntregable
    WHERE ken.IdActividad=$EjeEntregableSubActividad
    order BY Nombre asc";
        $resultado11 = $catalogo->obtenerLista($consultaperiodo11);
        echo '<option value = "">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado11)) {
        $s = '';
        if ($row['IdEntregable'] == $globalentregable) {
        $s = 'selected = "selected"';
        }
        echo '<option value = "' . $row['IdEntregable'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        }
}}
?>

