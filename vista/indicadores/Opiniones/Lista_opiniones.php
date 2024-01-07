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

<?php
include_once("../../../WEB-INF/Classes/Catalogo.class.php");
$catalogo = new Catalogo();
$idusuario = $_REQUEST["id_usuario"];
$IdEje = '';
$IdArea = '';
$actividad = '';
$id_usuario = '';
$IdEstatus_igual = '';
$query_lista = '';
$onclick = '';
$IdTipo = '';
$bandera=0;
$where = '';
$id_opinion='';

if (isset($_REQUEST['IdEje']) && $_REQUEST['IdEje'] != "") {
    $IdEje = $_REQUEST["IdEje"];
}
if (isset($_REQUEST['IdArea']) && $_REQUEST['IdArea'] != "") {
    $IdArea = $_REQUEST["IdArea"];
}
if (isset($_REQUEST['actividad']) && $_REQUEST['actividad'] != "") {
    $actividad = $_REQUEST["actividad"];
}
if (isset($_REQUEST['id_usuario']) && $_REQUEST['id_usuario'] != "") {
    $id_usuario = $_REQUEST["id_usuario"];
}
if (isset($_REQUEST['IdEstatus_igual']) && $_REQUEST['IdEstatus_igual'] != "") {
    $IdEstatus_igual = $_REQUEST["IdEstatus_igual"];
}
if (isset($_REQUEST['IdTipo']) && $_REQUEST['IdTipo'] != "") {
    $IdTipo = $_REQUEST["IdTipo"];
}

if ($IdEstatus_igual == '>1') {
    if ($IdTipo != '') {
        $where = "AND co.IdTipoOpinion=$IdTipo";
    }
    $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus, CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,ca.IdResponsable,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area  LEFT JOIN c_personas p ON p.id_Personas = co.IdPersonaAtendio LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado WHERE co.IdEjeTurnado = $IdEje AND co.IdEstatusOpinion $IdEstatus_igual AND (ca.IdArea =  " . $IdArea . " or a.idAreaPadre = " . $IdArea . ") $where";
} elseif ($IdEstatus_igual == 'in( 3,4)') {
    if ($IdTipo != '') {
        $where = "AND co.IdTipoOpinion=$IdTipo";
    }
    $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus, CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,ca.IdResponsable,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area  LEFT JOIN c_personas p ON p.id_Personas = co.IdPersonaAtendio LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado WHERE co.IdEjeTurnado = $IdEje AND co.IdEstatusOpinion $IdEstatus_igual AND (ca.IdArea =  " . $IdArea . " or a.idAreaPadre = " . $IdArea . ") $where";
} elseif ($IdEstatus_igual == 'in( 3)') {
    if ($IdTipo != '') {
        $where = "AND co.IdTipoOpinion=$IdTipo";
    }
    $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus, CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,ca.IdResponsable,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area  LEFT JOIN c_personas p ON p.id_Personas = co.IdPersonaAtendio LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado WHERE co.IdEjeTurnado = $IdEje AND co.IdEstatusOpinion $IdEstatus_igual AND (ca.IdArea =  " . $IdArea . " or a.idAreaPadre = " . $IdArea . ") $where";
} elseif ($IdEstatus_igual == 'in( 4)') {
    if ($IdTipo != '') {
        $where = "AND co.IdTipoOpinion=$IdTipo";
    }
    $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus, CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,ca.IdResponsable,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area  LEFT JOIN c_personas p ON p.id_Personas = co.IdPersonaAtendio LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado WHERE co.IdEjeTurnado = $IdEje AND co.IdEstatusOpinion $IdEstatus_igual AND (ca.IdArea =  " . $IdArea . ") $where";
}
?>

<body bgcolor="#FFFFFF">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered" style="width:100%" id="myTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Opinión </th>
                            <th>Fecha recibida</th>
                            <th>Estatus</th>
                            <th>Eje/Actividad</th>
                            <th>Fecha y usr atención</th>
                            <th>Respuesta</th>
                            <th>Incidencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //echo$query_lista;
                        $result = $catalogo->obtenerLista($query_lista);
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            if ($id_usuario==$row['IdResponsable']) {
                                $bandera=1;
                            }
                            $id_opinion=$row['IdOpinion'];
                            $onclick = "onclick='comprobar(\"$bandera\");' ";
                            if ($IdEstatus_igual == 'in( 3)') {
                                echo '<td ' . $onclick . 'style="color: rgb(124,181,236); text-decoration: underline;cursor: pointer;">' . $row['Opinion'] . '</td>';
                            }else{
                                echo "<td>" . $row['Opinion'] . "</td>";
                            }
                            
                            echo "<td>" . $row['Fecha_opinion'] . "</td>";
                            echo "<td>" . $row['Estatus'] . "</td>";
                            if ($row['Eje'] != '') {
                                echo "<td><p>" . $row['Eje'] . '</p><p>' . $row['Actividad'] . "</p></td>";
                            } else {
                                echo "<td>S / I</td>";
                            }

                            if ($row['Fecha_atencion'] != '') {
                                echo "<td><p>" . $row['Fecha_atencion'] . '</p><p style="color: #3a59d3;";>' . $row['Persona'] . "</p><p><b>" . $row['Area'] . "</p></td>";
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
<script>
function comprobar(user) {
    if (user==1) {
        var ruta=href="../../apps/Opiniones/OpinionWebDetalle.php?IdEje=<?php echo$IdEje?>&IdOpinion=<?php echo$id_opinion?>&origen=indicadores"
       $(location).attr('href', ruta);
      
    } else {
        alert('Usuario sin permiso');
    }
}
</script>
</html>