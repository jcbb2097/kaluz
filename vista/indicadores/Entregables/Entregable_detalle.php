<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$where_periodo = "";
$where_categoria = "";
$where_tipo = "";
$where_eje = "";

if (isset($_POST['estatus']) && $_POST['estatus'] != "") {
    $estatus = $_POST['estatus'];
    if ($estatus == 9 || $estatus == 10 || $estatus == 14) {
        $where_tipo = " AND d.id_tipo in($estatus)";
    } elseif ($estatus == 1) {
        $where_tipo = " AND d.id_tipo in(9,10,14)";
    }
}
if (isset($_POST['eje']) && $_POST['eje'] != "") {
    $Id_eje = $_POST['eje'];
}
if (isset($_POST['cate']) && $_POST['cate'] != "") {
    $Categoria = $_POST['cate'];
}
if (isset($_POST['anio']) && $_POST['anio'] != "") {
    $Periodo = $_POST['anio'];
}
if (isset($_POST['Id_area']) && $_POST['Id_area'] != "") {
    $Id_area = $_POST['Id_area'];
}
if ($Periodo != 'todos') {
    $where_periodo = " AND d.anio=$Periodo";
}
if ($Categoria > 0) {
    $where_categoria = " AND d.IdCategoriadeEje=$Categoria";
}


?>
<!DOCTYPE html>
<html lang="es">

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
                <table id="datos" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Área</th>
                            <th>Eje</th>
                            <th>Actividad/Meta</th>
                            <th>Año</th>
                            <th>Fecha</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT
                        d.id_documento,
                        d.descripcion,
                        td.id_tipo,
                        td.tipo,
                        CONCAT( e.orden, '.-', e.Nombre ) eje,
                        a.Nombre AS area,
                        ac.IdTipoActividad,
                        CONCAT( ac.Numeracion, ac.Nombre ) actividad,
                        p.Periodo,
                        ca.descCategoria,
                        d.ruta,
	                    d.pdf,
                        d.fechaCreacion
                    FROM
                        c_documento d
                        INNER JOIN c_area a ON a.Id_Area = d.id_area
                        LEFT JOIN k_archivoactividad ka ON ka.id_archivo = d.id_documento
                        INNER JOIN c_tipo_documento td ON td.id_tipo = d.id_tipo
                        INNER JOIN c_eje e ON e.idEje = ka.id_proyecto
                        LEFT JOIN c_actividad ac ON ac.IdActividad = ka.id_actividad
                        INNER JOIN c_periodo p ON p.Id_Periodo = d.anio
                        LEFT JOIN c_categoriasdeejes ca ON ca.idCategoria = d.IdCategoriadeEje
                        WHERE a.Id_Area=$Id_area AND e.idEje=$Id_eje $where_periodo $where_categoria $where_tipo";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        //echo $consulta;
                        while ($row = mysqli_fetch_array($resultConsulta)) {
                            $id_archivo = $row['id_documento'];
                            if ($row['id_tipo'] == 9) $color_texto = "#dfa739";
                            if ($row['id_tipo'] == 10) $color_texto = "#33ab15";
                            if ($row['id_tipo'] == 14) $color_texto = "#dbd909";
                            echo '<tr>';
                            echo '<td>' . $row['descripcion'] . '</td>';
                            $ruta = '../../../resources/aplicaciones/imagenes/ArchivosCompartidos/' . $row['pdf'];
                            if ($row['id_tipo'] == 3) {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                            } else if ($row['id_tipo'] == 4) {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-book"></i></a></td>';
                            } else if ($row['id_tipo'] == 5) {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-film"></i></a></td>';
                            } else if ($row['id_tipo'] == 6) {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-volume-up"></i></a></td>';
                            } else if ($row['id_tipo'] == 7) {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-tasks"></i></a></td>';
                            } else if ($row['id_tipo'] == 8) {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-picture"></i></a></td>';
                            } else if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                                if ($row['pdf'] == "link") { //si es un link a un archivo
                                    echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                                } else {
                                    echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                                }
                            } else {
                                echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:' . $color_texto . ';">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                            }
                            echo '<td>' . $row['area'] . '</td>';

                            echo '<td>' . $row['eje'] . '</td>';
                            echo '<td>';
                            if ($row['IdTipoActividad'] == 1) {
                                echo "A-";
                            } else {
                                echo "M-";
                            }
                            echo $row["actividad"] . "<br>";
                            echo '</td>';
                            echo '<td>' . $row['Periodo'] . '</td>';
                            echo '<td>' . $row['fechaCreacion'] . '</td>';
                            echo '<td>';
                            echo  $row['descCategoria'];
                            echo '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
<script>
     $(document).ready(function() {

        // DataTable
        var table = $('#datos').DataTable();
        table.destroy();
        table = $('#datos').DataTable({
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