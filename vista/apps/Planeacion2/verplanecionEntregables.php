<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$AnioActual = date("Y"); 

$miPeriodo = "";
$miPeriodo = $_POST["periodo"];
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
    echo "<table id='datosTabla' class='table table-striped table-bordered no-footer dataTable'>";
    echo "<thead>";
    echo "<tr style='background-color: #5a274f; color: #ffffff;'>";
    echo "  <th>Persona</th>";
    echo "  <th>Número de entregables</th>";
    echo "</tr>";
    echo "</thead>";
    ImprimePersonas($miPeriodo);

    echo "</table>";
    ?>

</body>

</html>

<?php

//-------------------------------------------------------------------------------------------------
function ImprimePersonas($miPeriodo)
{
    global $miPeriodo;

    $catalogo = new Catalogo();

    $consulta = "SELECT distinct CONCAT(per.Nombre,' ',per.Apellido_Paterno,' [', ar.Nombre, ']') AS NombreEncargado, kcha.IdEncargado AS encargadoiD 
    FROM k_checklist_actividad kcha
    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
    JOIN c_area ar ON ar.Id_Area=per.idArea
    WHERE kcha.Id_Periodo='$miPeriodo' AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3)) and kcha.Visible = '1'
    ORDER BY per.Nombre asc, kcha.Orden";
    //echo $consulta;
    $resultConsulta = $catalogo->obtenerLista($consulta);
    while ($row = mysqli_fetch_array($resultConsulta)) {    
        numeroEntregables($row['encargadoiD'], $miPeriodo, $row['NombreEncargado']);
    } 
} 

function numeroEntregables($encargadoiD, $miPeriodo, $NombreEncargado)
{
    global $miPeriodo;

    $catalogo = new Catalogo();

    $consultaEntregable = "SELECT count(ch.Nombre) as totalEntregable
    FROM k_checklist_actividad kcha
    JOIN c_checkList ch ON ch.IdCheckList=kcha.IdCheckList
    JOIN c_personas per ON per.id_Personas=kcha.IdEncargado
    JOIN c_area ar ON ar.Id_Area=per.idArea
    WHERE kcha.IdEncargado = '$encargadoiD' and kcha.Id_Periodo='$miPeriodo' AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3)) and kcha.Visible = '1'
    ORDER BY ch.Nivel DESC, kcha.Orden";
    //echo $consulta;
    $resultConsultaEntregable = $catalogo->obtenerLista($consultaEntregable);
    while ($rowE = mysqli_fetch_array($resultConsultaEntregable)) {

        echo "<tr>";
        echo "<td style='background-color: #854d792e;'>
                <p style='padding-left: 18px; color: #000000; font-size: .8em;'> <span style='font-weight: bold; font-size: 10px;'>" . $NombreEncargado . "</span> </p>" .
              "</td>";
        echo "<td style='background-color: #854d792e;'>
                <p style='padding-left: 18px; color: #000000; font-size: .8em;'> <span style='font-weight: bold; font-size: 10px;'>" . $rowE['totalEntregable'] . "</span> </p>" .
              "</td>";
        
        echo "</tr>";
    } 
} 

?>