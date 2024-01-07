<?php
$id_eje = $_POST["id"];
$tipo = $_POST["tipo"];
$where_tipo = "";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$catalogo = new Catalogo();
if ($tipo != 1) {
    $where_tipo = " AND d.id_tipo=" . $tipo;
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
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="myTable">
                    <thead>
                        <tr>
                            <th>Actividad</th>
                            <th>Área</th>
                            <th>Nombre-entregable</th>
                            <th>Entregable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT d.id_documento,d.descripcion,CONCAT(e.orden,'.-',e.Nombre)as eje,per.Periodo,t.tipo,
                        CASE
                    WHEN ISNULL( k_ar.id_actividad4 ) AND ISNULL( k_ar.id_actividad3 ) AND ISNULL( k_ar.id_actividad2 ) THEN k_ar.id_actividad1 
                    WHEN ISNULL( k_ar.id_actividad4 ) AND ISNULL( k_ar.id_actividad3 ) AND k_ar.id_actividad1 !=0 THEN k_ar.id_actividad2 
                    WHEN ISNULL( k_ar.id_actividad4 ) AND k_ar.id_actividad2 !=0 AND k_ar.id_actividad1 !=0 THEN k_ar.id_actividad3
                                ELSE k_ar.id_actividad4 
                            END AS id_actividad,CONCAT(ac.Numeracion,a.Nombre) actividad,d.id_tipo,d.pdf,d.ruta
                    FROM c_documento AS d
                        INNER JOIN c_area AS a ON a.Id_Area = d.id_area
                        INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
                        LEFT JOIN k_archivoactividad k_ar ON d.id_documento = k_ar.id_archivo
                        LEFT JOIN c_exposicionTemporal expo ON k_ar.id_exposicion = expo.idExposicion
                        LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo 
                        LEFT JOIN c_actividad ac on ac.IdActividad=k_ar.id_actividad1
                        LEFT JOIN c_actividad ac1 on ac1.IdActividad=k_ar.id_actividad2
                        LEFT JOIN c_actividad ac2 on ac2.IdActividad=k_ar.id_actividad3
                        LEFT JOIN c_actividad ac3 on ac3.IdActividad=k_ar.id_actividad4
                        LEFT JOIN c_eje e on e.idEje=k_ar.id_proyecto
                    WHERE d.id_tipo IN ( 9, 10, 14 ) AND expo.idExposicion=" . $id_eje . $where_tipo;
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            if ($row['id_tipo'] == 9) $color_texto = "#dfa739";
                            if ($row['id_tipo'] == 10) $color_texto = "#33ab15";
                            if ($row['id_tipo'] == 14) $color_texto = "#dbd909";
                            $ruta = '../../../resources/aplicaciones/imagenes/ArchivosCompartidos/' . $row['pdf'];
                            echo '<tr>';
                            echo '<td>' . $row['actividad'] . '</td>';
                            echo '<td>' . $row['eje'] . '</td>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                            if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            } else {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
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

</html>