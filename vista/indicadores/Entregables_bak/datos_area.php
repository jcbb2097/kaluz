<?php
$id_eje = $_POST["id"];
$tipo = $_POST["tipo"];
$periodo = $_POST["periodo"];
$where_tipo = "";
$where_ano="";

include_once('../../../WEB-INF/Classes/Catalogo.class.php');

$catalogo = new Catalogo();
if ($tipo != 1) {
    $where_tipo = " AND d.id_tipo=" . $tipo;
}
if ($periodo !='todos') {
    $where_ano = " and d.anio=".$periodo; 
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
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="datosarea">
                    <thead>
                    <tr>
                            <th>Eje</th>
                            <th>Actividad</th>
                            <th>Nombre-entregable</th>
                            <?php if ($tipo == 1) { ?>
                                <th>Entregable preeliminar</th>
                                <th>Entregable Proceso</th>
                                <th>Entregable final</th>
                            <?php } elseif ($tipo == 9) { ?>
                                <th>Entregable preeliminar</th>
                            <?php } elseif ($tipo == 10) { ?>
                                <th>Entregable final</th>
                            <?php } elseif ($tipo == 14) { ?>
                                <th>Entregable Proceso</th>
                            <?php  } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT d.id_documento,d.descripcion,CONCAT(e.orden,'.-',e.Nombre)as eje,per.Periodo,t.tipo,
                        CONCAT(ac.Numeracion,ac.Nombre) AS actividad,d.id_tipo,d.pdf,d.ruta
                    FROM c_documento AS d
                        INNER JOIN c_area AS a ON a.Id_Area = d.id_area
                        INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
                        LEFT JOIN k_archivoactividad k_ar ON d.id_documento = k_ar.id_archivo
                        LEFT JOIN c_exposicionTemporal expo ON k_ar.id_exposicion = expo.idExposicion
                        LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo 
                        LEFT JOIN c_actividad ac on ac.IdActividad=k_ar.id_actividad
                        LEFT JOIN c_eje e on e.idEje=k_ar.id_proyecto
                    WHERE d.id_tipo IN ( 9, 10, 14 ) AND a.Id_Area=" . $id_eje . $where_tipo.$where_ano;
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            if ($row['id_tipo'] == 9) $color_texto = "#dfa739";
                            if ($row['id_tipo'] == 10) $color_texto = "#33ab15";
                            if ($row['id_tipo'] == 14) $color_texto = "#dbd909";
                            $ruta = '../../../resources/aplicaciones/imagenes/ArchivosCompartidos/' . $row['pdf'];
                            echo '<tr>';

                            echo '<td>' . $row['eje'] . '</td>';
                            echo '<td>' . $row['actividad'] . '</td>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                            if ($tipo == 1) {
                                if ($row['id_tipo'] == 9) {
                                    if ($row['pdf'] == "link") { //si es un link a un archivo
                                        echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                    } else {
                                        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                    }
                                } else {
                                    echo '<td></td>';
                                }
                                if ($row['id_tipo'] == 14) {
                                    if ($row['pdf'] == "link") { //si es un link a un archivo
                                        echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                    } else {
                                        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                    }
                                } else {
                                    echo '<td></td>';
                                }
                                if ($row['id_tipo'] == 10) {
                                    if ($row['pdf'] == "link") { //si es un link a un archivo
                                        echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                    } else {
                                        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                    }
                                } else {
                                    echo '<td></td>';
                                }
                            } elseif ($tipo == 9) {
                                if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                                    if ($row['pdf'] == "link") { //si es un link a un archivo
                                        echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                    } else {
                                        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                    }
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            } elseif ($tipo == 10) {
                                if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                                    if ($row['pdf'] == "link") { //si es un link a un archivo
                                        echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                    } else {
                                        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                    }
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            } elseif ($tipo == 14) {
                                if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                                    if ($row['pdf'] == "link") { //si es un link a un archivo
                                        echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                    } else {
                                        echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                    }
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</body>
<script>
    $(document).ready(function() {

        // DataTable
        var table = $('#datosarea').DataTable();
        table.destroy();
        table = $('#datosarea').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "scrollX": true,
            responsive: false,
            pageLength: 100,
            "scrollY": "370px",
            "scrollCollapse": true,
            "paging": true
        });

    });
</script>

</html>