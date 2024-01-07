<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$Actividad = "";
$where_actividad = "";
$tipo = "";
$title = "Entregables";
$titulo = "";

if (isset($_POST['Id_actividad']) && $_POST['Id_actividad'] != "") {
    $Actividad = $_POST["Id_actividad"];
    $tipo = $_POST["tipo"];
    $where_actividad = " AND ac.IdActividad=" . $Actividad;
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
    <link rel="stylesheet" type="text/css" href="../../../resources/css/Indicador_entregables.css" />

</head>

<body>
    <div style="background-color: #5d2852;position: relative;top: -36px;font-size: 10.6px;font-family: 'Muli-SemiBold';color: white;text-align: left;padding-left: 16px;"><?php echo $title . $titulo; ?></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="datos" class="table table-principal">
                    <thead class="table-header">
                        <tr>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Área</th>
                            <th>Eje</th>
                            <th>Actividad/Meta</th>
                            <th>Año</th>
                            <th>Fecha</th>
                            <th>Exposición</th>
                        </tr>
                    </thead>
                    <tbody class="table-body " id="table_principal_body">
                        <?php

                        $consulta = "SELECT d.id_documento,ac.IdTipoActividad,td.id_tipo,
                        d.descripcion,td.tipo,d.id_documento,d.descripcion,d.ruta,d.pdf,a.Nombre area,
                        CONCAT( e.orden, '.-', e.Nombre ) eje,CONCAT( ac.Numeracion, ac.Nombre ) actividad,per.Periodo,expo.tituloFinal AS expo,
                        d.fechaCreacion
                    FROM
                        c_documento d
                        INNER JOIN c_tipo_documento td ON td.id_tipo = d.id_tipo
                        INNER JOIN c_area a ON a.Id_Area = d.id_area
                        LEFT JOIN k_archivoactividad ka ON ka.id_archivo = d.id_documento
                        INNER JOIN c_eje e ON e.idEje = ka.id_proyecto
                        LEFT JOIN c_exposicionTemporal expo ON ka.id_exposicion = expo.idExposicion
                        LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo
                        INNER JOIN c_actividad ac ON ac.IdActividad = ka.id_actividad 
                    WHERE d.id_tipo IN ( 9, 10, 14 )  $where_actividad";
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
                            echo  $row['expo'];
                            echo '</td>';
                            echo '</tr>';
                        }

                        ?>
                    </tbody>
                    <tfoot class="table-header">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
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
            }
        });

    });
</script>

</html>