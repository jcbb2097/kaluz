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

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
$catalogo = new Catalogo();
$tipo = "";
$estado = "";
$Ano = "";
$whereO = '';
$tipo2 = "";
$onclick="";
$Id = "";
$indentificador=0;
if (isset($_REQUEST['tipo']) && $_REQUEST['tipo'] != "") {
    $tipo = $_REQUEST["tipo"];
}
if (isset($_REQUEST['Caso']) && $_REQUEST['Caso'] != "") {
    $tipo2 = $_REQUEST["Caso"];
}
if (isset($_REQUEST['IdEstatus_igual']) && $_REQUEST['IdEstatus_igual'] != "") {
    $estado = $_REQUEST["IdEstatus_igual"];
}
if (isset($_REQUEST['Ano']) && $_REQUEST['Ano'] != "") {
    $Ano = $_REQUEST["Ano"];
}
if (isset($_REQUEST['Id']) && $_REQUEST['Id'] != "") {
    $Id = $_REQUEST["Id"];
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
<?php
if ($tipo == 1) {
    if ($tipo2 == 1) {
        $whereO = 'AND co.IdEstatusOpinion in(4)';
    } elseif ($tipo2 == 2) {
        $whereO = 'AND co.IdEstatusOpinion in(1,2,3)';
    }
    if ($Ano == 'Todos') {
        $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,CONCAT(e.orden,'.-',e.Nombre) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT( Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT('[',a.Nombre, ']') AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta 
        FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje=co.IdEjeTurnado
        WHERE coo.IdOpinionOrigen = $Id $whereO  ORDER BY YEAR(co.Fecha) DESC";
    } else {
        $query_lista = " SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,CONCAT(e.orden,'.-',e.Nombre) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT( Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT('[',a.Nombre, ']') AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta 
        FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje=co.IdEjeTurnado
        WHERE coo.IdOpinionOrigen = $Id $whereO and YEAR(co.Fecha)=$Ano ORDER BY YEAR(co.Fecha) DESC";
    }
    //echo $query_lista;
} elseif ($tipo == 2) {
    if ($tipo2 == 1) {
        $whereO = 'AND co.IdEstatusOpinion in(4)';
    } elseif ($tipo2 == 2) {
        $whereO = 'AND co.IdEstatusOpinion in(1,2,3)';
    }
    if ($Ano == 'Todos') {
        $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,CONCAT(e.orden,'.-',e.Nombre) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT( Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT('[',a.Nombre, ']') AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje=co.IdEjeTurnado WHERE co.IdTipoOpinion=$Id $whereO ORDER BY YEAR(co.Fecha) DESC";
    } else {
        $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,CONCAT(e.orden,'.-',e.Nombre) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT( Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT('[',a.Nombre, ']') AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje=co.IdEjeTurnado WHERE co.IdTipoOpinion=$Id $whereO and YEAR(co.Fecha)=$Ano  ORDER BY YEAR(co.Fecha) DESC";
    }
    //echo $query_lista;
} elseif ($tipo == 3) {
    if ($tipo2 == 1) {
        $whereO = 'AND co.IdEstatusOpinion in(4)';
    } elseif ($tipo2 == 2) {
        $whereO = 'AND co.IdEstatusOpinion in(1,2,3)';
    }
    if ($Ano == 'Todos') {
        $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,
        CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta 
    FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
    WHERE co.IdEjeTurnado = $Id $whereO";
    } else {
        $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,
        CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta 
    FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
    WHERE co.IdEjeTurnado = $Id $whereO and YEAR(co.Fecha)=$Ano";
    }
    //echo $query_lista;
} elseif ($tipo == 4) {
    if ($tipo2 == 1) {
        $whereO = 'AND co.IdEstatusOpinion in(4)';
    } elseif ($tipo2 == 2) {
        $whereO = 'AND co.IdEstatusOpinion in(1,2,3)';
    }
    if ($Ano == 'Todos') {
        $query_lista = "
        SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,
            CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta  FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado  WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) $whereO";
    } else {
        $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,
        CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta  FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado  WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) AND YEAR(co.Fecha)=$Ano $whereO";
    }
    //echo$query_lista;
} elseif ($tipo == 5) {
    if ($tipo2 == 1) {
        $whereO = 'AND co.IdEstatusOpinion in(4)';
    } elseif ($tipo2 == 2) {
        $whereO = 'AND co.IdEstatusOpinion in(1,2,3)';
    }
    if ($Ano == 'Todos') {
        if ($Id == '') {
            $where = "WHERE ISNULL(ca.IdResponsable)";
        } else {
            $where = "WHERE ca.IdResponsable=$Id";
        }
        $query_lista = "SELECT
        co.IdOpinion,
        CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,
        DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,
        coe.Descripcion AS Estatus,
        CONCAT( e.orden, '.-', e.Nombre ) Eje,
        concat( ca.Numeracion, ca.Nombre ) AS Actividad,
        CONCAT(
        Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,
        CONCAT( '[', a.Nombre, ']' ) AS Area,
        CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,
        c_in.Descripcion AS Incidencia,
        co.TextoAtencion AS Respuesta 
    FROM
        c_opiniones co
        JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen
        JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo
        JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion
        LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia
        LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad
        LEFT JOIN c_area a ON ca.IdArea = a.Id_Area
        LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario
        LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona
        LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
        $where $whereO";
    } else {
        if ($Id == '') {
            $where = "WHERE ISNULL(ca.IdResponsable) AND YEAR(co.Fecha)=$Ano";
        } else {
            $where = "WHERE ca.IdResponsable=$Id AND YEAR(co.Fecha)=$Ano";
        }
        $query_lista = "SELECT
        co.IdOpinion,
        CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,
        DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,
        coe.Descripcion AS Estatus,
        CONCAT( e.orden, '.-', e.Nombre ) Eje,
        concat( ca.Numeracion, ca.Nombre ) AS Actividad,
        CONCAT(
        Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,
        CONCAT( '[', a.Nombre, ']' ) AS Area,
        CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,
        c_in.Descripcion AS Incidencia,
        co.TextoAtencion AS Respuesta 
    FROM
        c_opiniones co
        JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen
        JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo
        JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion
        LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia
        LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad
        LEFT JOIN c_area a ON ca.IdArea = a.Id_Area
        LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario
        LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona
        LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
        $where $whereO";
    }
    //echo $query_lista;
} elseif ($tipo == 6) {
    if ($Id == 3) {
        $query_lista = "SELECT
        co.IdOpinion,
            CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,
            DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,
            coe.Descripcion AS Estatus,
            CONCAT( e.orden, '.-', e.Nombre ) Eje,
            concat( ca.Numeracion, ca.Nombre ) AS Actividad,
            CONCAT(
            Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,
            CONCAT( '[', a.Nombre, ']' ) AS Area,
            CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,
            c_in.Descripcion AS Incidencia,
            co.TextoAtencion AS Respuesta 
    FROM
        c_opiniones co
        JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen
        JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo
        JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion
        LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia
        LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad
        LEFT JOIN c_area a ON ca.IdArea = a.Id_Area
        LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario
        LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona
        LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
    WHERE
        ISNULL( co.IdEjeTurnado )";
    } elseif ($Id == 4) {
        $query_lista = "SELECT
        co.IdOpinion,
            CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,
            DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,
            coe.Descripcion AS Estatus,
            CONCAT( e.orden, '.-', e.Nombre ) Eje,
            concat( ca.Numeracion, ca.Nombre ) AS Actividad,
            CONCAT(
            Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,
            CONCAT( '[', a.Nombre, ']' ) AS Area,
            CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,
            c_in.Descripcion AS Incidencia,
            co.TextoAtencion AS Respuesta 
    FROM
        c_opiniones co
        JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen
        JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo
        JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion
        LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia
        LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad
        LEFT JOIN c_area a ON ca.IdArea = a.Id_Area
        LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario
        LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona
        LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
 
    WHERE ISNULL(co.IdActTurnada)";
    }
    // echo$query_lista;
} elseif ($tipo == '=2') {
    $query_lista = "SELECT co.IdOpinion,CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion ,DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,coe.Descripcion AS Estatus,
    CONCAT( e.orden, '.-', e.Nombre ) Eje,concat( ca.Numeracion, ca.Nombre ) AS Actividad,CONCAT(Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,CONCAT( '[', a.Nombre, ']' ) AS Area,CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,c_in.Descripcion AS Incidencia,co.TextoAtencion AS Respuesta 
FROM c_opiniones co JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad LEFT JOIN c_area a ON ca.IdArea = a.Id_Area LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado 
WHERE co.IdEjeTurnado = $Ano AND co.IdEstatusOpinion in(2) ";
$indentificador=2;
     //echo$query_lista;
} else {
    $query_lista = "SELECT
co.IdOpinion,
	CONCAT( '(', coo.Descripcion, ' , ', copt.Descripcion, ') ', co.Descripcion ) AS Opinion,
	DATE_FORMAT( co.Fecha, '%d/%m/%Y' ) AS Fecha_opinion,
	coe.Descripcion AS Estatus,
	CONCAT( e.orden, '.-', e.Nombre ) Eje,
	concat( ca.Numeracion, ca.Nombre ) AS Actividad,
	CONCAT(
	Date_format( co.FechaAtencion, '%d/%m/%y' )) AS Fecha_atencion,
	CONCAT( '[', a.Nombre, ']' ) AS Area,
	CONCAT( '[', p.Nombre, ' ', p.Apellido_Paterno, ']' ) AS Persona,
	c_in.Descripcion AS Incidencia,
	co.TextoAtencion AS Respuesta 
FROM
	c_opiniones co
	JOIN c_opinionesOrigen coo ON co.IdOrigenOpinion = coo.IdOpinionOrigen
	JOIN c_opinionesTipo copt ON co.IdTipoOpinion = copt.IdOpinionTipo
	JOIN c_opinionesEstatus coe ON coe.IdEstatus = co.IdEstatusOpinion
	LEFT JOIN c_incidencias_atender c_in ON co.Incidencia_al_atender = c_in.Id_Incidencia
	LEFT JOIN c_actividad ca ON co.IdActTurnada = ca.IdActividad
	LEFT JOIN c_area a ON ca.IdArea = a.Id_Area
	LEFT JOIN c_usuario c_u ON co.IdUsuarioAtendio = c_u.IdUsuario
	LEFT JOIN c_personas p ON p.id_Personas = c_u.IdPersona
	LEFT JOIN c_eje e ON e.idEje = co.IdEjeTurnado  
WHERE
	co.IdEstatusOpinion $tipo 
	AND co.IdOrigenOpinion = $Ano";
    //echo$query_lista;
    $indentificador=1;
   
}

?>

<body bgcolor="#FFFFFF">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered table-responsive" style="width:100%" id="myTable">
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
                        $result = $catalogo->obtenerLista($query_lista);
                        
                        while ($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                            
                            if ($indentificador==1) {
                                $onclick="href='../../apps/Opiniones/CapturaPendiente.php?IdOpinion=".$row['IdOpinion']."&nombreUsuario=".$tipo2."&idUsuario=$Id'";
                            }elseif ($indentificador==2) {
                                $onclick="href='../../apps/Opiniones/CapturaPendienteAct.php?IdEje=".$Ano."&IdOpinion=".$row['IdOpinion']."&nombreUsuario=".$tipo2."&idUsuario=$Id&automatico=0'";
                            }
                            echo "<td><a ".$onclick.">" . $row['Opinion'] . "</a></td>";
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

</html>