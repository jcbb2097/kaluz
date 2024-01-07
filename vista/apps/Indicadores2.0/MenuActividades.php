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
$periodo = 42;
if (isset($_GET['Periodo']) && $_GET['Periodo'] != "") {
    $periodo = $_GET['Periodo'];
}
$total = 0;
$consultaTotal = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores;";
$resultTotal = $catalogo->obtenerLista($consultaTotal);

while ($row3 = mysqli_fetch_array($resultTotal)) {
    $total = $row3['Total'];
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Indicadores</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            .parpadea {
  
menuIndicadores  animation-duration: 2s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 2s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}

@-webkit-keyframes parpadeo {  
  0% { opacity: 1.0; }
  50% { opacity: 0.0; }
   100% { opacity: 1.0; }
}

@keyframes parpadeo {  
  0% { opacity: 1.0; }
   50% { opacity: 0.0; }
  100% { opacity: 1.0; }
}
        </style>
        <style>
            @import 'https://code.highcharts.com/css/highcharts.css';

            #container {
                height: 400px;
                max-width: 800px;
                min-width: 320px;
                margin: 0 auto;
            }
            .highcharts-pie-series .highcharts-point {
                stroke: #EDE;
                stroke-width: 2px;
            }
            .highcharts-pie-series .highcharts-data-label-connector {
                stroke: silver;
                stroke-dasharray: 2, 2;
                stroke-width: 2px;
            }
        </style>
        <style>
            body{
                font-family: 'Muli-Regular';
            }
            .dropbtn {
                background-color: #495f6f;
                color: white;
                padding: 16px;
                font-size: 12px;
                border: none;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                width: 200px;
                /*border-radius: 19px 19px 19px 19px;
                -moz-border-radius: 19px 19px 19px 19px;
                -webkit-border-radius: 19px 19px 19px 19px;
                */
            }

            .dropdown {
                position: relative;
                display: inline-block;

            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f1f1f1;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                font-size: 11px;
            }

            .dropdown-content a:hover {background-color: #ddd;}

            .dropdown:hover .dropdown-content {display: block;}

            .dropdown:hover .dropbtn {background-color: #919191;}
        </style>
        <!-- <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/Carga.js" ></script> -->
        <script src="../../../resources/js/aplicaciones/Indicadores/Carga.js"></script>
        <script src="../../../resources/js/aplicaciones/Indicadores/funciones.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3 style="text-align:left">Indicadores(<?php echo $total; ?>)<span class="glyphicon glyphicon-stats"></span></h3><br>
                </div>
            </div>
            <div class="row">

                <div class="form-group col-md-2">
                    <label for="inputState">Periodo:</label>
                    <select id="Periodo" class="form-control" name="Periodo" onchange="Filtroindicador2();">
                        <?php
                        $consulta = "SELECT cc.CPE_ID_PERIODO,cc.CPE_PERIODO
FROM `sie_cat_periodos` AS cc
WHERE cc.CPE_ID_PERIODO >38 AND cc.CPE_ID_PERIODO<=42
ORDER BY
cc.CPE_PERIODO ASC
;";
                        $resultado = $catalogo->obtenerLista($consulta);
                        echo '<option value="">Seleccione una opción</option>';
                        while ($row = mysqli_fetch_array($resultado)) {

                            $s = '';
                            if ($row['CPE_ID_PERIODO'] == $periodo) {
                                $s = 'selected="selected"';
                            }echo '<option value="' . $row['CPE_ID_PERIODO'] . '" ' . $s . '>' . $row['CPE_PERIODO'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputState">ver por:</label>
                    <select id="vista" class="form-control" name="vista" onchange="Filtroindicador2();">
                     <option value="1">Eje</option> 
                     <option value="2">Área</option> 
                     <option value="3">Aplicación</option> 
                    </select>
                </div>
            </div>
            <div id="recargar">
            
            <?php
               if($periodo!=""){
            $consultaTipo = "SELECT IdProyecto,Nombre as Descripcion
FROM c_proyecto 
INNER JOIN sie_cat_periodos AS scp ON scp.CPE_ID_PERIODO = c_proyecto.id_periodo_proyecto
WHERE scp.CPE_ID_PERIODO=$periodo
                ";
            $resultTipo = $catalogo->obtenerLista($consultaTipo);
            $columna = 0;
            while ($row = mysqli_fetch_array($resultTipo)) {
                 $consultaTotalTipo = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores AS c LEFT JOIN c_proyecto AS a ON c.IdProyecto = a.IdProyecto WHERE c.IdProyecto=".$row['IdProyecto'];
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
                
                echo'<button class="dropbtn" style="width:250px;">'.$row['Descripcion'].' ('.$tip.') <span style="float:right;" class="glyphicon glyphicon-chevron-down parpadea"></span></button>';
                echo'<div class="dropdown-content">';
                 $consultaIn = 'SELECT IdIndicador,Descripcion FROM k_indicadores WHERE IdProyecto ='.$row['IdProyecto'].' ORDER BY Descripcion';
                        $resultIn = $catalogo->obtenerLista($consultaIn);
                        while ($row2 = mysqli_fetch_array($resultIn)) {
                             echo '<a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'Indicadores2.0/VistaIndicadores2.php?indicador='.$row2['IdIndicador'].'&regreso=1&Periodo='.$periodo.'\');">'.$row2['Descripcion'].'</a>';
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
            <br><br>
        <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12">
        
            <button class="dropbtn" style="width:100px;"><a href="#" onclick="cambiarContenidos('#contenidos', 'aplicaciones/MenuAplicaciones.php');" > Regresar</a></button>
            
        </div> 
            </div>
        </div>
        <div>
            <br>
        </div>
        <div>
            <div class="form-group col-md-6">
                    <label for="inputState">Periodo:</label>
                    <select id="Periodo2" class="form-control" name="Periodo2" onchange="">
                        <?php
                        $consulta = "SELECT cc.CPE_ID_PERIODO,cc.CPE_PERIODO
FROM `sie_cat_periodos` AS cc
WHERE cc.CPE_ID_PERIODO >38
ORDER BY
cc.CPE_PERIODO ASC
;";
                        $resultado = $catalogo->obtenerLista($consulta);
                        echo '<option value="">Seleccione una opción</option>';
                        while ($row = mysqli_fetch_array($resultado)) {

                            $s = '';
                            if ($row['CPE_ID_PERIODO'] == $periodo) {
                                $s = 'selected="selected"';
                            }echo '<option value="' . $row['CPE_ID_PERIODO'] . '" ' . $s . '>' . $row['CPE_PERIODO'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
             <div class="form-group col-md-6">
                    <label for="inputState">Clasificación:</label>
                    <select id="Clasificación" class="form-control" name="Clasificación" onchange="Filtroactividades();">
                        <?php
                        $consulta = "SELECT IdTipoConcepto, Nombre FROM c_tipoConcepto;";
                        $resultado = $catalogo->obtenerLista($consulta);
                        echo '<option value="">Seleccione una opción</option>';
                        while ($row = mysqli_fetch_array($resultado)) {

                            $s = '';
                            if ($row['IdTipoConcepto'] == $periodo) {
                                $s = 'selected="selected"';
                            }echo '<option value="' . $row['IdTipoConcepto'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            <div id="recargar2">
                
            </div>
            
        </div>
        
        
        
        
</html>
</html>
