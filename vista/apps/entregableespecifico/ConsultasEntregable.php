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


$ActividadObtenida="";
if ((isset($_GET['Actividad']) && $_GET['Actividad'] != ""))
{   if ($_GET['Actividad']!="0") {$ActividadObtenida =$_GET['Actividad'];
    $consultacategoria = "SELECT en.IdEntregable as IdEntregable, en.Nombre AS nom_entre,ac.IdActividad, CONCAT(ac.Numeracion,' ',ac.Nombre) AS Nombre
    FROM c_entregableEspecifico AS ene
    LEFT JOIN c_entregable AS en ON en.IdEntregable=ene.IdEntregable
    LEFT JOIN c_actividad AS ac ON ac.IdActividad=en.idActividad 
    WHERE ac.IdActividad=$ActividadObtenida";
    $resultado3 = $catalogo->obtenerLista($consultacategoria);
    echo '<option>Selecciona una opción</option>';
    while ($row = mysqli_fetch_array($resultado3)) {
    echo '<option value="' . $row['IdEntregable'] . '" ' . $s . '>' . $row['nom_entre'] . ' </option>';
}
}}
    