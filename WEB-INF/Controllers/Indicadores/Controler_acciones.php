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
$obj = new Indicadores2();
$catalogo = new Catalogo();
$indicador = "";
$idindicador = array();
$i = 0;
$consulta = "";
if (isset($_POST['idIndicador']) && $_POST['idIndicador'] != "") {
    $idindicador = $_POST['idIndicador'];
    for ($index = 0; $index < count($idindicador); $index++) {
        echo $idindicador[$i] . ",";
        $i++;
    }
} else if (isset($_POST['periodo']) && $_POST['periodo'] != "") {
    $periodo = $_POST['periodo'];
    $Eje="";
    $consulta = "SELECT
    c_eje.idEje,
    c_eje.Nombre,
    c_eje.orden,
    c_eje.estatus
FROM
    c_eje
";
    $resultado = $catalogo->obtenerLista($consulta);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['idEje'] . '" >' . $row['idEje'] . '.- '. $row['Nombre'] . '</option>';
    }
}


if (isset($_POST['periodo2']) && $_POST['periodo2'] != ""){
    $periodo = $_POST['periodo2'];
      $consulta = "SELECT Id_Area ,Nombre FROM c_area WHERE estatus = 1 ORDER BY Nombre";
    $resultado = $catalogo->obtenerLista($consulta);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['Id_Area'] . '" >' . $row['Nombre'] . '</option>';
    }
}
    
    if (isset($_POST['periodo3']) && $_POST['periodo3'] != ""){
    $periodo = $_POST['periodo3'];
      $consulta = "SELECT IdAplicacion,Descripcion  FROM c_aplicaciones ORDER BY Descripcion ";
    $resultado = $catalogo->obtenerLista($consulta);
    echo '<option value="">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdAplicacion'] . '">' . $row['Descripcion'] . '</option>';
    }
}

