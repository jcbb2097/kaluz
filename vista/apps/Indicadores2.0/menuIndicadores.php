<?php
/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../../../index.php");
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

include_once '../../../WEB-INF/Classes/Catalogo.class.php';
include_once '../../../WEB-INF/Classes/Indicadores.2.class.php';
$obj = new Indicadores2();
$catalogo = new Catalogo();
$periodo = "";
$vista = "";
if (isset($_GET['idPeriodo']) && $_GET['idPeriodo'] != "") {
    $periodo = $_GET['idPeriodo'];
    $vista = $_GET['personal'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" href="../resources/css/indicadores.css" />
        <script type="text/javascript" language="javascript" src="../resources/js/funciones.js" ></script> -->
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
        <script src="../../../resources/js/aplicaciones/Indicadores/AltaIndicadores.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/funciones.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">

                <?php
                if ($vista == 1) {
                    $consultaTipo = "SELECT IdProyecto,Nombre as Descripcion
FROM c_proyecto 
INNER JOIN sie_cat_periodos AS scp ON scp.CPE_ID_PERIODO = c_proyecto.id_periodo_proyecto
WHERE scp.CPE_ID_PERIODO=$periodo
                ";
                    $resultTipo = $catalogo->obtenerLista($consultaTipo);
                    $columna = 0;
                    while ($row = mysqli_fetch_array($resultTipo)) {
                        $consultaTotalTipo = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores AS c LEFT JOIN c_proyecto AS a ON c.IdProyecto = a.IdProyecto WHERE c.IdProyecto=" . $row['IdProyecto'];
                        $resultTotalTipo = $catalogo->obtenerLista($consultaTotalTipo);
                        $tip = 0;
                        while ($row4 = mysqli_fetch_array($resultTotalTipo)) {
                            $tip = $row4['Total'];
                        }
                        if ($columna == 0) {
                            echo '<div class="row">';
                        }

                        echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                        echo'<div class="dropdown">';

                        echo'<button class="dropbtn">' . $row['Descripcion'] . ' (' . $tip . ') <span style="float:right;" class="glyphicon glyphicon-chevron-down parpadea"></span></button>';
                        echo'<div class="dropdown-content">';
                        $consultaIn = 'SELECT IdIndicador,Descripcion FROM k_indicadores WHERE IdProyecto =' . $row['IdProyecto'] . ' ORDER BY Descripcion';

                        $resultIn = $catalogo->obtenerLista($consultaIn);
                        while ($row2 = mysqli_fetch_array($resultIn)) {
                            echo '<a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'../Indicadores/VistaIndicadores2.php?indicador=' . $row2['IdIndicador'] . '&regreso=1&Periodo=' . $periodo . '\');">' . $row2['Descripcion'] . '</a>';
                        }
                        echo" </div>";
                        echo" </div>";
                        echo" </div>";
                        $columna++;
                        if ($columna == 4) {
                            echo" </div><br><br>";
                            $columna = 0;
                        }
                    }
                }elseif ($vista==2) {
                    $consultaTipo = "SELECT IdArea,Nombre as Descripcion
FROM c_area 
INNER JOIN sie_cat_periodos AS scp ON scp.CPE_ID_PERIODO = c_area.IdPeriodo
WHERE scp.CPE_ID_PERIODO=$periodo
ORDER BY
Descripcion ASC

                ";
                    $resultTipo = $catalogo->obtenerLista($consultaTipo);
                    $columna = 0;
                    while ($row = mysqli_fetch_array($resultTipo)) {
                        $consultaTotalTipo = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores AS c LEFT JOIN c_area AS a ON c.IdArea = a.IdArea WHERE c.IdArea=" . $row['IdArea'];
                        $resultTotalTipo = $catalogo->obtenerLista($consultaTotalTipo);
                        $tip = 0;
                        while ($row4 = mysqli_fetch_array($resultTotalTipo)) {
                            $tip = $row4['Total'];
                        }
                        if ($columna == 0) {
                            echo '<div class="row">';
                        }

                        echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                        echo'<div class="dropdown">';

                        echo'<button class="dropbtn">' . $row['Descripcion'] . ' (' . $tip . ') <span style="float:right;" class="glyphicon glyphicon-chevron-down parpadea"></span></button>';
                        echo'<div class="dropdown-content">';
                        $consultaIn = 'SELECT IdIndicador,Descripcion FROM k_indicadores WHERE IdArea=' . $row['IdArea'] . ' ORDER BY Descripcion';
                     
                        $resultIn = $catalogo->obtenerLista($consultaIn);
                        while ($row2 = mysqli_fetch_array($resultIn)) {
                            echo '<a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'../Indicadores/VistaIndicadores2.php?indicador=' . $row2['IdIndicador'] . '&regreso=1&Periodo=' . $periodo . '\');">' . $row2['Descripcion'] . '</a>';
                        }
                        echo" </div>";
                        echo" </div>";
                        echo" </div>";
                        $columna++;
                        if ($columna == 4) {
                            echo" </div><br><br>";
                            $columna = 0;
                        }
                    }
                }else{
                    $consultaTipo = "SELECT IdAplicacion,Nombre as Descripcion FROM c_aplicacion WHERE `local` >=0 ORDER BY Nombre  ";
              
                    $resultTipo = $catalogo->obtenerLista($consultaTipo);
                    $columna = 0;
                    while ($row = mysqli_fetch_array($resultTipo)) {
                        $consultaTotalTipo = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores AS c LEFT JOIN c_aplicacion AS a ON c.IdAplicacion = a.IdAplicacion WHERE c.IdAplicacion=" . $row['IdAplicacion'];
                        $resultTotalTipo = $catalogo->obtenerLista($consultaTotalTipo);
                        $tip = 0;
                        while ($row4 = mysql_fetch_array($resultTotalTipo)) {
                            $tip = $row4['Total'];
                        }
                        if ($columna == 0) {
                            echo '<div class="row">';
                        }

                        echo '<div class="col-md-3 col-sm-3 col-xs-12">';
                        echo'<div class="dropdown">';

                        echo'<button class="dropbtn">' . $row['Descripcion'] . ' (' . $tip . ') <span style="float:right;" class="glyphicon glyphicon-chevron-down parpadea"></span></button>';
                        echo'<div class="dropdown-content">';
                        $consultaIn = 'SELECT IdIndicador,Descripcion FROM k_indicadores WHERE IdAplicacion =' . $row['IdAplicacion'] . ' ORDER BY Descripcion';

                        $resultIn = $catalogo->obtenerLista($consultaIn);
                        while ($row2 = mysqli_fetch_array($resultIn)) {
                            echo '<a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'../Indicadores/VistaIndicadores2.php?indicador=' . $row2['IdIndicador'] . '&regreso=1&Periodo=' . $periodo . '\');">' . $row2['Descripcion'] . '</a>';
                        }
                        echo" </div>";
                        echo" </div>";
                        echo" </div>";
                        $columna++;
                        if ($columna == 4) {
                            echo" </div><br><br>";
                            $columna = 0;
                        }
                    }
                }
                ?>

            </div>
    </body>
</html>
