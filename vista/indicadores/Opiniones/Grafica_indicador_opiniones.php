<?php
session_start();
if (!isset($_SESSION['user_session'])) {
?>
    <script>
        top.location.href = "../login.php";
        window.reload();
    </script>

<?php
}
$Id_area_eje = "";
$Id_estado = "";
$Id_periodo = "";
$Id_responsable = "";
$consulta = "";
$tiempo = "";
$where = "";
$estado = "";
$Id_tipo = "";
$columnas = array();
$series = array();
include_once("../../../WEB-INF/Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_REQUEST['Id_area_eje']) && $_REQUEST['Id_area_eje'] != "") {
    $Id_area_eje = $_REQUEST['Id_area_eje'];
    $Id_estado = $_REQUEST['Id_estado'];
    $Id_periodo = $_REQUEST['Id_periodo'];
    $Id_tipo = $_REQUEST['Id_tipo'];
}
if ($Id_periodo != 'Todos') {
    $tiempo = "AND YEAR(o.Fecha)=$Id_periodo";
}
if ($Id_tipo ==2) {
    $estado = "AND o.IdEstatusOpinion in (4)";
}elseif($Id_tipo ==3){
    $estado = "AND o.IdEstatusOpinion in (1,2,3)";
}

if ($Id_estado == 1) {
    $consulta = "SELECT
	oo.Descripcion AS series,
	COUNT( o.IdOpinion ) AS datos 
FROM
	c_opinionesOrigen AS oo
	INNER JOIN c_opiniones o ON o.IdOrigenOpinion = oo.IdOpinionOrigen
	LEFT JOIN c_actividad a ON a.IdActividad = o.IdActTurnada 
	WHERE a.IdArea=$Id_area_eje $tiempo $estado

GROUP BY
	oo.Descripcion
    ORDER BY datos DESC";
} else {
    $consulta = "SELECT
	oo.Descripcion AS series,
	COUNT( o.IdOpinion ) AS datos 
FROM
	c_opinionesOrigen AS oo
	INNER JOIN c_opiniones o ON o.IdOrigenOpinion = oo.IdOpinionOrigen
	LEFT JOIN c_actividad a ON a.IdActividad = o.IdActTurnada 
	WHERE IdEjeTurnado=$Id_area_eje $tiempo $estado
GROUP BY
	oo.Descripcion
    ORDER BY datos DESC";
}

?>
<html>

<head>
    <title>Museo del Palacio de Bellas Artes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 320px;
            max-width: 660px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table class="table table-striped table-bordered" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tipo</th>
                            <th> # </th>
                            <!-- <th>Atendidas</th>
                            <th>Sin atender</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $catalogo->obtenerLista($consulta);
                        //echo$consulta;
                        while ($row = mysqli_fetch_array($result)) {
                            array_push($columnas, $row['datos']);
                            array_push($series, $row['series']);
                            echo '<tr>';
                            echo "<td>" . $row['series'] . "</td>";
                            echo "<td>" . $row['datos'] . "</td>";
                            echo '</tr>';
                        }
                        $se = "";
                        for ($i = 0; $i < count($series); $i++) {
                         if ($i==0) {
                            $a=',sliced: true,selected: true';
                         }else{
                             $a='';
                         }
                            $se = $se . "{name: '" . $series[$i] . "',y:" . $columnas[$i] .$a. "}";
                            if ($i + 1 < count($series)) {
                                $se = $se . ",";
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
    </div>
</body>
<script>
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Opiniones'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Porcentaje',
            colorByPoint: true,
            data: [<?php echo$se; ?>]
        }]
    });
</script>

</html>