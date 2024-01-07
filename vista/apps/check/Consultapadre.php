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
include_once('Check.class.php');

$catalogo = new Catalogo();
$checkList = new Check();
$subcategoria = "";
$IdGeneral = "";
$padre = "";

$global="";
if ((isset($_GET['global']) && $_GET['global'] != ""))
{   if ($_GET['global']!="0") {$global =$_GET['global'];
    $consultapadre = "SELECT che.IdCheckList as IdCheckList,che.Nombre as Nombre FROM c_checkList AS che 
JOIN k_checklist_actividad chea ON chea.IdCheckList=che.IdCheckList
WHERE che.Nivel = 1 AND chea.IdActividad=$global
ORDER BY che.Nombre asc";
$resultado = $catalogo->obtenerLista($consultapadre);
while ($row = mysqli_fetch_array($resultado)) {
$s = '';
if ($row['IdCheckList'] == $padre) {
$s = 'selected = "selected"';
}
echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'].'</option>';
}
}}


$general="";
if ((isset($_GET['general']) && $_GET['general'] != ""))
{   if ($_GET['general']!="0") {$general =$_GET['general'];
    $consultapadre = "SELECT che.IdCheckList as IdCheckList,che.Nombre as Nombre FROM c_checkList AS che 
JOIN k_checklist_actividad chea ON chea.IdCheckList=che.IdCheckList
WHERE che.Nivel = 1 AND chea.IdActividad=$general
ORDER BY che.Nombre asc";
$resultado = $catalogo->obtenerLista($consultapadre);
while ($row = mysqli_fetch_array($resultado)) {
$s = '';
if ($row['IdCheckList'] == $padre) {
$s = 'selected = "selected"';
}
echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'].'</option>';
}
}}

?>

