<?php
$id_eje = $_POST["id"];
$tipo = $_POST["tipo"];
$periodo = $_POST["periodo"];
$where_tipo = "";
$where_ano = "";
$where_ano2 = "";
$query = "";
$total_e = 0;
$columnas = array();
$series = array();
$titulo = "";

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
if ($tipo != 1) {
    $where_tipo = " AND d.id_tipo=" . $tipo;
}
if ($periodo != 'todos') {
    $where_ano = " and d.anio=" . $periodo;
    $where_ano2 = " and d.anio=" . $periodo;
}
if ($id_eje != 7) {
    $query = "SELECT a.Id_Area,ka.id_proyecto,a.Nombre,COUNT( d.id_documento ) total FROM c_documento AS d
	INNER JOIN c_area a ON a.Id_Area = d.id_area LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento
	WHERE d.id_tipo IN ( 9, 10, 14 ) and ka.id_proyecto=$id_eje $where_ano  GROUP BY a.Nombre";
    $titulo = 'Entregables  área';
    //echo$query;
} else {
    $query = "SELECT
	e.tituloFinal as Nombre,
	COUNT( d.id_documento ) total 
FROM
	c_documento AS d
	LEFT JOIN k_archivoactividad ka ON ka.id_archivo = d.id_documento
	INNER JOIN c_exposiciontemporal e ON e.idExposicion = ka.id_exposicion
    WHERE e.estatus=1 $where_ano2
GROUP BY
	e.tituloFinal";
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
    <style type="text/css">
        a:hover {
            cursor: pointer;
        }
    </style>
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 200px;
            max-width: 400px;
            margin: 1em auto;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php if ($id_eje != 7) { ?>

                <div class="col-md-4 col-sm-4 col-xs-4">
                    <table class="table table-striped table-bordered table-responsive" style="width:100%" id="Geje">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th># Entregable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            /*                 $resultConsulta = $catalogo->obtenerLista($query);
                            while ($row = mysqli_fetch_array($resultConsulta)) {
                                array_push($columnas, $row['total']);
                                array_push($series, $row['Nombre']);
                                echo '<tr>';
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td onclick='muestraTab(" . $row['id_proyecto'] . "," . $row['Id_Area'] . ",\"$periodo\")' style='color: rgb(124,181,236); text-decoration: underline;cursor: pointer;'>" . $row['total'] . "</td>";
                                echo '</tr>';
                                $total_e = $total_e + $row['total'];
                            }
                            */
                            $se = "";
                            for ($i = 0; $i < count($series); $i++) {
                                if ($i == 0) {
                                    $a = ',sliced: true,selected: true';
                                } else {
                                    $a = '';
                                }
                                $se = $se . "{name: '" . $series[$i] . "',y:" . $columnas[$i] . $a . "}";
                                if ($i + 1 < count($series)) {
                                    $se = $se . ",";
                                }
                            } 
                            ?>
                        </tbody>
                        <tfoot>
                            <th>Total</th>
                            <th><?php echo $total_e; ?></th>
                        </tfoot>
                    </table>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-8">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            <?php } else { ?>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <table class="table table-striped table-bordered table-responsive" style="width:100%" id="Geje">
                        <thead>
                            <tr>
                                <th>Exposición</th>
                                <th># Entregable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $resultConsulta = $catalogo->obtenerLista($query);
                            while ($row = mysqli_fetch_array($resultConsulta)) {
                                array_push($columnas, $row['total']);
                                array_push($series, $row['Nombre']);
                                echo '<tr>';
                                echo "<td>" . $row['Nombre'] . "</td>";
                                echo "<td>" . $row['total'] . "</td>";
                                echo '</tr>';
                                $total_e = $total_e + $row['total'];
                            }
                            $se = "";
                            for ($i = 0; $i < count($series); $i++) {
                                if ($i == 0) {
                                    $a = ',sliced: true,selected: true';
                                } else {
                                    $a = '';
                                }
                                $se = $se . "{name: '" . $series[$i] . "',y:" . $columnas[$i] . $a . "}";
                                if ($i + 1 < count($series)) {
                                    $se = $se . ",";
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <th>Total</th>
                            <th><?php echo $total_e; ?></th>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            <?php } ?>
        </div>
        <div class="row" id="muestraTabla">

        </div>
    </div>
</body>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#Geje').DataTable();
        table.destroy();
        table = $('#Geje').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "scrollX": true,
            responsive: false,
            "scrollY": "370px",
            "scrollCollapse": true,
            "paging": true,
            "searching": false

        });

    });
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Entregables'
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
            data: [<?php echo $se; ?>]
        }]
    });

    function muestraTab(Eje, Area, Periodo) {
        var Eje = Eje;
        var Area = Area;
        var Periodo = Periodo;
        var title = title;
        $.post("lista_entregables.php", {
            Eje: Eje,
            Area: Area,
            Periodo: Periodo,
            title: title
        }, function(data) {
            $("#muestraTabla").html('');
            $("#muestraTabla").html(data);
        });
    }
</script>


</html>