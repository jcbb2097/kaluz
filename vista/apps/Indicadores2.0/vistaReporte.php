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

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("../../../WEB-INF/Classes/Indicadores.2.class.php");
include_once("../../../WEB-INF/Classes/Cron.class.php");
$obj = new Indicadores2();
$obj2 = new CronIndicadores();
$catalogo = new Catalogo();
$Reporte = "";
$time = "";
$fechaf = "";
$fechaf2 = "";
$fechai = "";
$fechai2 = "";
$where = "";
if (isset($_GET['fechaf']) && $_GET['fechaf'] != "undefined") {

    $fechaf = "AND ac.fecha < '" . $_GET['fechaf']."' ";
    $fechaf2 = "AND fecha <= '" . $_GET['fechaf']."' ";
}
if (isset($_GET['Reporte']) && $_GET['Reporte'] != "undefined") {
    $idIndicador = $_GET['Reporte'];
}
if (isset($_GET['time']) && $_GET['time'] != "undefined") {
    $time = $_GET['time'];
}
if (isset($_GET['fechai']) && $_GET['fechai'] != "undefined") {

    $fechai = "AND ac.fecha ='" . $_GET['fechai'] . "' ";
    $fechai2 = "AND fecha >='" . $_GET['fechai'] . "' ";
}
?>

<html>
    <head>
        <title>Indicadores</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../../../resources/js/bootstrap-select.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-3d.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
        <!-- <link rel="stylesheet" href="resources/css/paginas/indicadores/indicadores.css">
        <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/Carga.js"></script>
        <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/AltaIndicadores.js" ></script> -->
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/indicadores.css" />
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/AltaIndicadores.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/reporte.js"></script>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row">

            <?php
            $presentacion = "";
            if ($idIndicador) {
                $obj->setIdIndicador($idIndicador);
                $obj->getRegistro();
                $presentacion = $obj->getIdPresentacion();
            } if ($presentacion == 1) {
                $obj2->setId_indicador($idIndicador);
                $ConsultaQuery = $obj->getQueryConsulta();
                $consultaseries = "SELECT Series,fecha FROM cron_unico WHERE id_indicador=$idIndicador " . $fechai2 . "".$fechaf2.";";
                $result = $catalogo->obtenerLista($consultaseries);
                echo '<br><center><table width="600px" height="150px" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
    <tr class="titulo_tabla" align="center"> 
        <td colspan="2" ><font size="5">' . $obj->getDescripcion() . '</font></td>
        </tr>';
                $total = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td class="contenido_tabla"><font size="5">' . "El " . $row['fecha'] . " se tiene un total de:" . '</font></td>';
                    echo '<td class="contenido_tabla" align="center"><font size="5">' . $row['Series'] . '</font></td>';
                    echo '</tr>';

                    $total = $total + $row['Series'];
                }
                echo '</table></center>';
            } else {
                $obj2->setId_indicador($idIndicador);
                $consultadatos = "SELECT  CONCAT(Datos,'(',DATE_FORMAT(fecha,'%d'),')') as Datos ,Series   FROM cron_multiple WHERE id_indicador=$idIndicador " . $fechai2 . "".$fechaf2.";";
                $result = $catalogo->obtenerLista($consultadatos);
                //echo$consultadatos;
                echo '<table width="400" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
    <tr class="titulo_tabla" align="center"> 
        <td colspan="2" ><font size="3">' . $obj->getDescripcion() . '</font></td>
</tr>';
                $total = 0;
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';

                    echo '<td class="contenido_tabla"><font size="3">' . $row['Datos']. '</font></td>';
                    echo '<td class="contenido_tabla" align="center"><font size="3">' . $row['Series'] . '</font></td>';
                    
                    echo '</tr>';
                    $total = $total + $row['Series'];
                }
                echo '<tr class="titulo_tabla" align="center">';
                echo '<td><font size="3">Total</font></td><td><font size="3">' . $total . '</font></td>';
                echo '</tr>';
                echo '</table></center>';


            }
            ?>

        </div>
    </div>

    </body>
</html>


