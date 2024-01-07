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
$Id_area = "";
$Id_eje = "";
$Id_estado = "";
$Id_periodo = "";
$Id_responsable = "";
$consulta = "";
$tiempo = "";
$estado = "";
$Id_tipo = "";
include_once("../../../WEB-INF/Classes/Catalogo.class.php");
$catalogo = new Catalogo();
if (isset($_REQUEST['Id_area']) && $_REQUEST['Id_area'] != "") {
    $Id_area = $_REQUEST['Id_area'];
    $Id_eje = $_REQUEST['Id_eje'];
    $Id_estado = $_REQUEST['Id_estado'];
    $Id_periodo = $_REQUEST['Id_periodo'];
    $Id_persona = $_REQUEST['Id_persona'];
    $Id_tipo = $_REQUEST['Id_tipo'];
}
if ($Id_periodo != 'Todos') {
    $tiempo = "AND YEAR(op.Fecha)=$Id_periodo";
}
if ($Id_estado == 2) {
    $estado = "AND op.IdEstatusOpinion=4";
} elseif ($Id_estado == 3) {
    $estado = "AND op.IdEstatusOpinion in (1,2,3)";
}
if ($Id_tipo == 3) {
    $consulta = "SELECT
    op.IdOpinion,
    CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', op.Descripcion ) AS Opinion,DATE_FORMAT( op.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ac.Numeracion, ac.Nombre ) AS Actividad,CONCAT(Date_format( op.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,p.id_Personas,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,op.TextoAtencion AS Respuesta
    FROM
    c_opiniones op
    LEFT JOIN c_actividad ac ON ac.IdActividad = op.IdActTurnada
    JOIN c_opinionesOrigen coo ON op.IdOrigenOpinion = coo.IdOpinionOrigen
    JOIN c_opinionesTipo copt ON op.IdTipoOpinion = copt.IdOpinionTipo
    JOIN c_opinionesEstatus coe on coe.IdEstatus=op.IdEstatusOpinion
    JOIN c_eje e ON e.idEje=op.IdEjeTurnado
    LEFT JOIN c_area a on a.Id_Area=ac.IdArea
    LEFT JOIN c_personas p ON p.id_Personas=op.IdPersonaAtendio
    LEFT JOIN c_incidencias_atender c_in ON op.Incidencia_al_atender = c_in.Id_Incidencia 
    WHERE  ( ac.IdArea = $Id_area OR a.idAreaPadre = $Id_area ) $tiempo $estado";
} else {
    $consulta = "SELECT
    op.IdOpinion,
    CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', op.Descripcion ) AS Opinion,DATE_FORMAT( op.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ac.Numeracion, ac.Nombre ) AS Actividad,CONCAT(Date_format( op.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,p.id_Personas,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,op.TextoAtencion AS Respuesta
    FROM
    c_opiniones op
    LEFT JOIN c_actividad ac ON ac.IdActividad = op.IdActTurnada
    JOIN c_opinionesOrigen coo ON op.IdOrigenOpinion = coo.IdOpinionOrigen
    JOIN c_opinionesTipo copt ON op.IdTipoOpinion = copt.IdOpinionTipo
    JOIN c_opinionesEstatus coe on coe.IdEstatus=op.IdEstatusOpinion
    JOIN c_eje e ON e.idEje=op.IdEjeTurnado
    LEFT JOIN c_area a on a.Id_Area=ac.IdArea
    LEFT JOIN c_personas p ON p.id_Personas=op.IdPersonaAtendio
    LEFT JOIN c_incidencias_atender c_in ON op.Incidencia_al_atender = c_in.Id_Incidencia 
    WHERE op.IdEjeTurnado=$Id_eje AND ( ac.IdArea = $Id_area OR a.idAreaPadre = $Id_area ) $tiempo $estado";
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

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Opinión </th>
                            <th>Fecha recibida</th>
                            <th>Estatus</th>
                            <?php if ($Id_tipo == 1) { ?>
                                <th>Eje</th>
                            <?php } else { ?>
                                <th>Área</th>
                            <?php   } ?>
                            <th>Actividad</th>
                            <th>Fecha y usr atención</th>
                            <th>Respuesta</th>
                            <th>Incidencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $catalogo->obtenerLista($consulta);
                        //echo$consulta;
                    while ($row = mysqli_fetch_array($result)) {
                            $id_opinion = $row['IdOpinion'];
                            if ($Id_persona == $row['id_Personas'] && $Id_estado == 3) {
                                $abierta = '<a href="../../apps/Opiniones/OpinionWebDetalle.php?IdEje=' . $Id_eje . '&IdOpinion=' . $id_opinion . '&origen=indicadores">' . $row['Opinion'] . '</a>';
                            } else {
                                $abierta = $row['Opinion'];
                            }
                            echo '<tr>';
                            echo "<td>" . $abierta . "</td>";
                            echo "<td>" . $row['Fecha_opinion'] . "</td>";
                            echo "<td>" . $row['Estatus'] . "</td>";
                            if ($Id_tipo == 1) {
                                echo "<td><p><b>" . $row['Eje'] . "</p></td>";
                            } else {
                                echo "<td><p><b>" . $row['Area'] . "</p></td>";
                            }
                            if ($row['Actividad'] != '') {
                                echo "<td><p>" . $row['Actividad'] . "</p></td>";
                            } else {
                                echo "<td>S / I</td>";
                            }

                            if ($row['Fecha_atencion'] != '') {
                                echo "<td><p>" . $row['Fecha_atencion'] . '</p><p style="color: #3a59d3;";>' . $row['Persona'] . "</p><b>" . $row['Area'] . "</p></td>";
                            } else {
                                echo "<td>Opinion no atendida</td>";
                            }

                            if ($row['Respuesta'] != '') {
                                echo "<td>" . $row['Respuesta'] . "</td>";
                            } else {
                                echo "<td>S / R</td>";
                            }
                            if ($row['Incidencia'] != '') {
                                echo "<td>" . $row['Incidencia'] . "</td>";
                            } else {
                                echo "<td>S / I</td>";
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