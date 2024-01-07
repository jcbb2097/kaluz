<?php
if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../../../index.php");
}
include_once '../WEB-INF/Classes/Catalogo.class.php';
include_once '../WEB-INF/Classes/Indicadores.2.class.php';
$obj = new Indicadores2();
$catalogo = new Catalogo();
$periodo = 42;
if (isset($_GET['Periodo']) && $_GET['Periodo'] != "") {
    $periodo = $_GET['Periodo'];
}
$total = 0;
$consultaTotal = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores;";
$resultTotal = $catalogo->obtenerLista($consultaTotal);

while ($row3 = mysql_fetch_array($resultTotal)) {
    $total = $row3['Total'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .parpadea {
  
  animation-name: parpadeo;
  animation-duration: 2s;
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
        <script type="text/javascript" language="javascript" src="resources/js/paginas/indicadores/Carga.js" ></script>
    </head>
    <body>
        <h1>Indicadores(<?php echo $total; ?>)</h1> 
        <div class="row"> 
        </div>
        <div class="row">

            <div class="form-group col-md-6">
                <label for="inputState">Periodo:</label>
                <select id="Periodo" class="form-control" name="Periodo" onchange="Filtroindicador2();">
                    <?php
                    $consulta = "SELECT cc.CPE_ID_PERIODO,cc.CPE_PERIODO
FROM sie_cat_periodos AS cc
WHERE cc.CPE_ID_PERIODO >= 39 AND cc.CPE_ID_PERIODO <= 42
ORDER BY
cc.CPE_PERIODO ASC
;";
                    $resultado = $catalogo->obtenerLista($consulta);
                    echo '<option value="">Seleccione una opción</option>';
                    while ($row = mysql_fetch_array($resultado)) {

                        $s = '';
                        if ($row['CPE_ID_PERIODO'] == $periodo) {
                            $s = 'selected="selected"';
                        }echo '<option value="' . $row['CPE_ID_PERIODO'] . '" ' . $s . '>' . $row['CPE_PERIODO'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div id="recargar">

            <?php
            if ($periodo != "") {
                $consultaTotal = " SELECT a.Nombre AS datos,(SELECT COUNT(ac.IdIndicador)  FROM k_indicadores AS ac WHERE ac.IdProyecto = a.IdProyecto)as series FROM c_proyecto AS a WHERE id_periodo_proyecto=$periodo";
        $resultTotal = $catalogo->obtenerLista($consultaTotal);
        $total = 0;
        while ($row3 = mysql_fetch_array($resultTotal)) {
            $total = $total+$row3['series'];
        }
        ?>
        <br>
        <span class="glyphicon glyphicon-signal"> Indicadores(<?php echo $total; ?>)</span>
        <hr>
        
        <div class="bs-example">
                <?php 
                $consultaTipo = "SELECT IdProyecto,Nombre as Descripcion
FROM c_proyecto 
INNER JOIN sie_cat_periodos AS scp ON scp.CPE_ID_PERIODO = c_proyecto.id_periodo_proyecto
WHERE scp.CPE_ID_PERIODO=$periodo
";
                $resultTipo = $catalogo->obtenerLista($consultaTipo);
                $columna = 0;
                echo '<table width="100%" style="border-collapse: separate; border-spacing: 10px;">';
                while ($row = mysql_fetch_array($resultTipo)) {
                    if($columna == 0){
                        echo '<tr>';
                    }
                    echo '<td width="25%">';
                    echo '<div class="dropdown">';
                    $consultaTotalTipo = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores AS c LEFT JOIN c_proyecto AS a ON c.IdProyecto = a.IdProyecto WHERE c.IdProyecto=".$row['IdProyecto'];
                    $resultTotalTipo = $catalogo->obtenerLista($consultaTotalTipo);
                    $tip = 0;
                    while ($row4 = mysql_fetch_array($resultTotalTipo)) {
                        $tip = $row4['Total'];
                    }
                    echo '<button class="btn btn-primary dropdown-toggle" style="width:350px;" type="button" data-toggle="dropdown">'.$row['Descripcion'].' ('.$tip.') <span style="float:right;" class="glyphicon glyphicon-chevron-down parpadea"></span></button>';
                    echo '<ul class="dropdown-menu">';
                    $consultaAp = "SELECT IdProyecto,Nombre FROM c_proyecto WHERE IdProyecto =  ".$row['IdProyecto'];
                    $resultAp = $catalogo->obtenerLista($consultaAp);
                    while ($row1 = mysql_fetch_array($resultAp)) {
                        
                        $consultaTotalAp = "SELECT COUNT(IdIndicador) as Total FROM k_indicadores AS c LEFT JOIN c_proyecto AS a ON c.IdProyecto = a.IdProyecto WHERE a.IdProyecto=".$row['IdProyecto']." ;";
                        $resultTotalAp = $catalogo->obtenerLista($consultaTotalAp);
                        $totalAp = 0;
                        while ($row5 = mysql_fetch_array($resultTotalAp)) {
                            $totalAp = $row5['Total'];
                        }
                        
                       echo '<li class="dropdown-header">'.$row1['Nombre'].' ('.$totalAp.')</li>';
                        $consultaIn = 'SELECT IdIndicador,Descripcion FROM k_indicadores WHERE IdProyecto ='.$row1['IdProyecto'].' ORDER BY Descripcion';
                        $resultIn = $catalogo->obtenerLista($consultaIn);
                        while ($row2 = mysql_fetch_array($resultIn)) {
                             echo '<li><a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'Indicadores2.0/VistaIndicadores2.php?indicador='.$row2['IdIndicador'].'&regreso=1&Periodo='.$periodo.'\');">'.$row2['Descripcion'].'</a></li>';
                        }
                        echo '<li class="divider"></li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '</td>';
                    $columna++;
                    if($columna == 3){
                        echo '</tr>';
                        $columna = 0;
                    }
                }
                echo '</table>';

                echo" </div>";
                echo" <li role=\"presentation\"><a href=\"#\" onclick=\"cambiarContenidos('#contenidos', 'aplicaciones/MenuAplicaciones.php');\" ><span class=\"glyphicon glyphicon-arrow-left\"></span>Regresar</a></li>";
            }
            ?>
        </div>






    </body>
</html>