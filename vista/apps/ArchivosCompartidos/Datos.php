<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Indicador_entregables.class.php');
$catalogo = new Catalogo();
$tipoPerfil = $_POST["tipoPerfil"];
$nombreUsuario = $_POST["nombreUsuario"];
$idUsuario = $_POST["idUsuario"];
$where_ano = "";
$tot = 0;
$categorias = array();
$Aplicacion = "";
$total = array();
$tipo = $_POST["tipo"];
if (isset($_POST['anio']) && $_POST['anio'] != "") {
    $periodo = $_POST["anio"];
    if ($periodo != 'todos') {
        $where_ano = "AND d.anio=" . $periodo;
    }
}
if ($tipo == 3) {
    $color = '#5ba95d';
    $Aplicacion = 'Tipo';
    $query = "SELECT td.id_tipo as id,COUNT( d.id_tipo ) total,td.tipo AS categorias 
FROM c_documento d INNER JOIN c_tipo_documento td ON td.id_tipo = d.id_tipo 
WHERE d.id_tipo not in(1,2,9,10,11,14) $where_ano 
    GROUP BY d.id_tipo 
    ORDER BY total DESC";
} elseif ($tipo == 1) {
    $color = '#f5c150';
    $Aplicacion = 'Área';
    $query = "SELECT a.Id_Area as id, COUNT( d.id_tipo ) total, a.Nombre AS categorias 
FROM c_documento d INNER JOIN c_area a ON a.Id_Area = d.id_area 
WHERE d.id_tipo not in(1,2,9,10,11,14) $where_ano 
GROUP BY  d.id_area
ORDER BY total DESC";
} else {
    $color = '#b02328';
    $Aplicacion = 'Eje';
    $query = "SELECT e.idEje as id, COUNT( d.id_tipo ) total,CONCAT(e.idEje,'.-',e.Nombre) AS categorias 
FROM c_documento d 
INNER JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento
INNER JOIN c_eje e on e.idEje=ka.id_proyecto	
WHERE d.id_tipo not in(1,2,9,10,11,14) $where_ano
GROUP BY e.idEje
ORDER BY idEje";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title></title>
    <style>
        .my-custom-scrollbar-gen {
            position: relative;
            height: 550px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }


        .my-custom-scrollbar-gen::-webkit-scrollbar {
            -webkit-appearance: none;
        }

        .my-custom-scrollbar-gen::-webkit-scrollbar:vertical {
            width: 10px;
        }

        .my-custom-scrollbar-gen::-webkit-scrollbar-button:increment,
        .my-custom-scrollbar-gen::-webkit-scrollbar-button {
            display: none;
        }

        .my-custom-scrollbar-gen::-webkit-scrollbar:horizontal {
            height: 10px;
        }

        .my-custom-scrollbar-gen::-webkit-scrollbar-thumb {
            /* background-color: #797979;
    border-radius: 20px;
    border: 2px solid #f1f2f3;
	border-radius: 0px;
    border: 2px solid #464456;*/
            background-color: #cbcbca;
            border-radius: 4px;
            border: 1px solid #5a274f;
        }

        .my-custom-scrollbar-gen::-webkit-scrollbar-track {
            border-radius: 10px;
        }

        .camColor {
            background-color: #f3f3f3;
        }

        a {
            color: <?php echo $color; ?>;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-4">
            <div class="table-wrapper-scroll-y my-custom-scrollbar-gen">
                <table id="tEntregable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php if ($tipo == 1) { ?>
                                <th>Tipo</th>
                            <?php      } elseif ($tipo == 2) { ?>
                                <th>Área</th>
                            <?php   } else { ?>
                                <th>Eje</th>
                            <?php    }  ?>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $resulteje = $catalogo->obtenerLista($query);
                        while ($rs = mysqli_fetch_array($resulteje)) {
                            array_push($categorias, $rs['categorias']);
                            array_push($total, $rs['total']);
                            $tot = $tot + $rs['total'];
                            $ID =$rs['id'];
                            $link = "lista_archivo.php?TipoAreaEje=$tipo&anio=$periodo&nombreUsuario=$nombreUsuario&idUsuario=$idUsuario&tipoPerfil=$tipoPerfil&id=$ID";
                            echo '<tr><td>' . $rs['categorias'] . '</td><td><a href="' . $link . '">' . $rs['total'] . '</a></td></tr>';
                        }
                        ?>
                    <tfoot style="background-color: #cbcbca;">
                        <th>Total</th>
                        <th><?php echo $tot; ?></th>
                    </tfoot>
                    </tbody>

                </table>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-8">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div>
    </div>
</body>
<script>
    Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Archivos compartidos por <?php echo $Aplicacion; ?>'
        },
        xAxis: {
            categories: [<?php foreach ($categorias as $clave => $valor) {
                                echo  "'" . $valor . "', ";
                            } ?>]
        },
        yAxis: {
            min: 0,
            title: {
                text: '<?php echo $Aplicacion; ?>'
            }
        },
        legend: {
            reversed: false
        },
        colors: ['<?php echo $color; ?>'],
        plotOptions: {
            series: {
                stacking: 'normal'
            },
            column: {
                colorByPoint: true
            }
        },
        series: [{
            name: '<?php echo $tot; ?> <?php echo $Aplicacion; ?>',
            data: [<?php foreach ($total as $clave => $valor) {
                        echo  $valor . ", ";
                    } ?>]
        }]
    });
</script>

</html>