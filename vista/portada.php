<?php
session_start();
include_once __DIR__ . "/../source/controller/AreaController.php";
include_once __DIR__ . "/../source/controller/EjeController.php";
include_once __DIR__ . "/../source/controller/PortadaController.php";
include_once __DIR__ . "/../WEB-INF/Classes/Mosaicos.class.php";
include_once __DIR__ . "/../WEB-INF/Classes/Catalogo.class.php";
include_once __DIR__ . "/../source/controller/IndicadorController.php";
include_once __DIR__ . "/../source/controller/UsuarioController.php";
include_once('apps/Planeacion/Classes/Planeacion.class.php');
$Planeacion = new Planeacion();


$catalogo = new Catalogo();



$anio = $_GET["anio"];
$AnioActual = date("Y");
$idAreaEje = $_GET["idAreaEje"];
$idUsuario = $_GET["idUsuario"];
$idPerfil = $_GET["idPerfil"];
$idAreaUsuario = $_GET["idAreaUsuario"];

$ejeArea = $_GET["ejeArea"];
$cadenaSubAreas = "";
$Mosaico = new mosaicos();
$prueba = $Mosaico->tipo_publicacion($ejeArea);
$Autores = $Mosaico->Autores();
$Tiraje = $Mosaico->Tiraje();
$Textos = $Mosaico->Textos();
$Producciones = $Mosaico->Producciones2();
$Premios = $Mosaico->Premios_ferias();
$Pz = $Mosaico->tipo_publicacion2($ejeArea);

/**/

$usuarioControllerAct = new UsuarioController();
$usuario = $usuarioControllerAct->mostrarUsuario($idUsuario);

$nombreUsuario = $usuario->getNombreUsuario();


$cadenaAcuerdos = "";
$totalActividad = 0;
$cadenaActividadNivel = "";
$idAreaPadre = 0;

$totalMeta = 0;
$cadenaMetaNivel = "";
$cadenaImprimeFa = "";

if ($ejeArea == 1) {
	$areaControllerAct = new AreaController();
	$area = $areaControllerAct->mostrarArea($idAreaEje);
	$nombreAreaEje = $area->getNombre();
	$idAreaPadre =  $area->getIdArea();

	$subAreaControllerAct = new AreaController();
	$subAreas = $subAreaControllerAct->mostrarSubAreas($idAreaPadre);

	foreach ($subAreas as $subArea) {
		$cadenaSubAreas .= " / <a onclick='notifArea(" . $subArea->getIdArea() . "," . $idUsuario . ",\"" . $subArea->getNombre() . "\")' style='color: #fefefe;' target='_self' href='portada.php?anio=" . $anio . "&idAreaEje=" . $subArea->getIdArea() . "&idUsuario=" . $idUsuario . "&idPerfil=" . $idPerfil . "&idAreaUsuario=" . $idAreaUsuario . "&ejeArea=1&nombreUsuario=" . $nombreUsuario . "' >" . $subArea->getNombre() . "</a>";
	}

	/*acuerdosEscritosArea*/
	$portadaControllerAct = new PortadaController();

	$acuerdos = $portadaControllerAct->mostrarEscritosArea($idAreaPadre);
	foreach ($acuerdos as $acuerdo) {
		//variables para construir href
		$href_portada = "1";
		$href_aplicacion = $nombreAreaEje;

		$ejeaño = "2022";
		$varFiltro = "todos";
		$directo = "1";
		$indicador = "areas";

		//valida si hay registros crea un link
		if ($acuerdo->getTotal() == "0") {
			//no hay resultados. muestra el resultado
			$link_convocados = $acuerdo->getTotal();
		} else {
			//hay resultados. crea un link
			$link_convocados = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
			nombreUsuario=' . $nombreUsuario . '
			&ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=' . $varFiltro . '
			&numeroAcuerdos=' . $acuerdo->getTotal() . '
			&directo=' . $directo . '
			&indicador=' . $indicador . ' ">' . $acuerdo->getTotal() . '</a>';

		}

	/*	if ($acuerdo->getTotalDos() == "0") {
			$link_invitado = $acuerdo->getTotalDos();
		} else {
			$link_invitado = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		 &portada=' . $href_portada . '
		 &aplicacion=' . $href_aplicacion . '
		 &tipo_acuerdo=invitado">' . $acuerdo->getTotalDos() . '</a>';
		} */

		if ($acuerdo->getTotalDos() == "0") {
			$link_realizados = $acuerdo->getTotalDos();
		} else {
			$link_realizados = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
			nombreUsuario=' . $nombreUsuario . '
			&ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=realizado' . '
			&numeroAcuerdos=' . $acuerdo->getTotalDos() . '
			&directo=' . $directo . '
			&indicador=' . $indicador . ' ">' . $acuerdo->getTotalDos() . '</a>';
		}

		if ($acuerdo->getTotalTres() == "0") {
			$link_enproceso = $acuerdo->getTotalTres();
		} else {
			$link_enproceso = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		    &ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=enproceso' . '
			&numeroAcuerdos=' . $acuerdo->getTotalTres() . '
			&directo=' . $directo . '
			&indicador=' . $indicador . ' ">' . $acuerdo->getTotalTres() . '</a>';
		}

		if ($acuerdo->getTotalCuatro() == "0") {
			$link_atendido = $acuerdo->getTotalCuatro();
		} else {
			$link_atendido = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		    &ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=atendido' . '
			&numeroAcuerdos=' . $acuerdo->getTotalCuatro() . '
			&directo=' . $directo . '">' . $acuerdo->getTotalCuatro() . '</a>';
		}

		if ($acuerdo->getTotalCinco() == "0") {
			$link_sinrealizar = $acuerdo->getTotalCinco();
		} else {
			$link_sinrealizar = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		    &ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=sinrealizar' . '
			&numeroAcuerdos=' . $acuerdo->getTotalCinco() . '
			&directo=' . $directo . '">' . $acuerdo->getTotalCinco() . '</a>';
		}

		$cadenaAcuerdos .= "<div style='top: 91px;left: 152px;' class='cuadroSec2'>Total <p class='acuEsc'> " . $link_convocados . " </p></div>"
		. "<div style='top: 117px;left: 152px;' class='cuadroSec2'>Realizado <p class='acuEsc'>" . $link_realizados . "</p></div>"
		. "<div style='top: 143px;left: 152px;' class='cuadroSec2'>En proceso <p class='acuEsc'>" . $link_enproceso . "</p></div>"
		. "<div style='top: 169px;left: 152px;' class='cuadroSec2'>Atendido <p class='acuEsc'>" . $link_atendido . "</p></div>"
		. "<div style='top: 195px;left: 152px;' class='cuadroSec2'>Sin realizar <p class='acuEsc'>" . $link_sinrealizar . "</p></div>";

		/*	//. "<div style='top: 117px;left: 152px;' class='cuadroSec2'>Invitado <p class='acuEsc'>" . $link_invitado . "</p></div>"
			. "<div style='top: 143px;left: 152px;' class='cuadroSec2'>Realizados <p class='acuEsc'>" . $link_realizados . "</p></div>"
			. "<div style='top: 169px;left: 152px;' class='cuadroSec2'>No realizados <p class='acuEsc'>" . $link_norealizados . "</p></div>"
			. "<div style='top: 195px;left: 152px;' class='cuadroSec2'>"
		    . "<div style='top: 195px;left: 152px;' class='cuadroSec2'></div>"; */
	}
	/*actividades*/
	$actividades = $portadaControllerAct->mostrarActividadesArea($idAreaPadre);
	foreach ($actividades as $actividad) {
		$totalActividad = $actividad->getTotal();
	}

	$actividadesNivel = $portadaControllerAct->mostrarActividadesNivelArea($idAreaPadre);
	foreach ($actividadesNivel as $actNivel) {
		$cadenaActividadNivel = "Globales: <div class='totalesAct'>" . $actNivel->getTotal() . "</div>"
			. "<div class='division'></div>"
			. "Generales: <div class='totalesAct'>" . $actNivel->getTotalDos() . "</div>"
			. "<div class='division'></div>"
			. "Particulares: <div class='totalesAct'>" . $actNivel->getTotalTres() . "</div>"
			. "<div class='division'></div>"
			. "Sub: <div class='totalesAct'>" . $actNivel->getTotalCuatro() . "</div>";
	}

	/*metas*/
	$metas = $portadaControllerAct->mostrarMetasArea($idAreaPadre);
	foreach ($metas as $meta) {
		$totalMeta = $meta->getTotal();
	}

	$metasNivel = $portadaControllerAct->mostrarMetasNivelArea($idAreaPadre);
	foreach ($metasNivel as $metaNivel) {
		$cadenaMetaNivel = "Globales: <div class='totalesAct'>" . $metaNivel->getTotal() . "</div>"
			. "<div class='division'></div>"
			. "Generales: <div class='totalesAct'>" . $metaNivel->getTotalDos() . "</div>"
			. "<div class='division'></div>"
			. "Particulares: <div class='totalesAct'>" . $metaNivel->getTotalTres() . "</div>"
			. "<div class='division'></div>"
			. "Sub: <div class='totalesAct'>" . $metaNivel->getTotalCuatro() . "</div>";
	}

	$cadenaImprimeFa = "";
} else {
	$ejeControllerAct =  new EjeController();
	$eje = $ejeControllerAct->mostrarEje($idAreaEje);
	$nombreAreaEje = $eje->getNombre();
	$idAreaEje = $eje->getIdEje();
	/*acuerdos Escritos ejes*/
	$portadaControllerAct = new PortadaController();

	$acuerdos = $portadaControllerAct->mostrarEscritosEje($idAreaEje);
	foreach ($acuerdos as $acuerdo) {
		//variables para construir href
		$href_portada = "2";
		$href_aplicacion = $nombreAreaEje;

		$ejeaño = "2022";
		$varFiltro = "todos";
		$directo = "1";
		//valida si hay registros crea un link
		if ($acuerdo->getTotal() == "0") {
			//no hay resultados. muestra el resultado
			$link_convocados = $acuerdo->getTotal();
		} else {
			//hay resultados. crea un link
		/*	$link_convocados = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
			nombreUsuario=' . $nombreUsuario . '
			&portada=' . $href_portada . '
			&aplicacion=' . $href_aplicacion . '
			&tipo_acuerdo=convocados">' . $acuerdo->getTotal() . '</a>';
*/
			$link_convocados = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
			nombreUsuario=' . $nombreUsuario . '
			&ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=' . $varFiltro . '
			&numeroAcuerdos=' . $acuerdo->getTotal() . '
			&directo=' . $directo . '">' . $acuerdo->getTotal() . '</a>';

		}

		if ($acuerdo->getTotalDos() == "0") {
			$link_realizados = $acuerdo->getTotalDos();
		} else {
			$link_realizados = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
			nombreUsuario=' . $nombreUsuario . '
			&ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=realizado' . '
			&numeroAcuerdos=' . $acuerdo->getTotalDos() . '
			&directo=' . $directo . '">' . $acuerdo->getTotalDos() . '</a>';
		}

		if ($acuerdo->getTotalTres() == "0") {
			$link_enproceso = $acuerdo->getTotalTres();
		} else {
			$link_enproceso = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		    &ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=enproceso' . '
			&numeroAcuerdos=' . $acuerdo->getTotalTres() . '
			&directo=' . $directo . '">' . $acuerdo->getTotalTres() . '</a>';
		}

		if ($acuerdo->getTotalCuatro() == "0") {
			$link_atendido = $acuerdo->getTotalCuatro();
		} else {
			$link_atendido = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		    &ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=atendido' . '
			&numeroAcuerdos=' . $acuerdo->getTotalCuatro() . '
			&directo=' . $directo . '">' . $acuerdo->getTotalCuatro() . '</a>';
		}

		if ($acuerdo->getTotalCinco() == "0") {
			$link_sinrealizar = $acuerdo->getTotalCinco();
		} else {
			$link_sinrealizar = '<a href="apps/AcuerdosEscritos/Lista_acuerdos.php?
		 nombreUsuario=' . $nombreUsuario . '
		    &ejeid=' . $idAreaEje . '
			&ejeaño=' . $ejeaño . '
			&varFiltro=sinrealizar' . '
			&numeroAcuerdos=' . $acuerdo->getTotalCinco() . '
			&directo=' . $directo . '">' . $acuerdo->getTotalCinco() . '</a>';
		}

		$cadenaAcuerdos .= "<div style='top: 91px;left: 152px;' class='cuadroSec2'>Total <p class='acuEsc'>" . $link_convocados . "</p></div>"
			. "<div style='top: 117px;left: 152px;' class='cuadroSec2'>Realizado <p class='acuEsc'>" . $link_realizados . "</p></div>"
			. "<div style='top: 143px;left: 152px;' class='cuadroSec2'>En proceso <p class='acuEsc'>" . $link_enproceso . "</p></div>"
			. "<div style='top: 169px;left: 152px;' class='cuadroSec2'>Atendido <p class='acuEsc'>" . $link_atendido . "</p></div>"
			. "<div style='top: 195px;left: 152px;' class='cuadroSec2'>Sin realizar <p class='acuEsc'>" . $link_sinrealizar . "</p></div>";
	}
	/*actividades*/
	$actividadesEje = $portadaControllerAct->mostrarActividadesEje($idAreaEje);
	foreach ($actividadesEje as $actEje) {
		$totalActividad = $actEje->getTotal();
	}

	$actividadesNivelEje = $portadaControllerAct->mostrarActividadesNivelEje($idAreaEje);
	foreach ($actividadesNivelEje as $actNivelEje) {
		$cadenaActividadNivel = "Globales: <div class='totalesAct'>" . $actNivelEje->getTotal() . "</div>"
			. "<div class='division'></div>"
			. "Generales: <div class='totalesAct'>" . $actNivelEje->getTotalDos() . "</div>"
			. "<div class='division'></div>"
			. "Particulares: <div class='totalesAct'>" . $actNivelEje->getTotalTres() . "</div>"
			. "<div class='division'></div>"
			. "Sub: <div class='totalesAct'>" . $actNivelEje->getTotalCuatro() . "</div>";
	}

	/*metas*/
	$metasEje = $portadaControllerAct->mostrarMetasEje($idAreaEje);
	foreach ($metasEje as $metaEje) {
		$totalMeta = $metaEje->getTotal();
	}

	$metasNivelEje = $portadaControllerAct->mostrarMetasNivelEje($idAreaEje);
	foreach ($metasNivelEje as $metaNivelEje) {
		$cadenaMetaNivel = "Globales: <div class='totalesAct'>" . $metaNivelEje->getTotal() . "</div>"
			. "<div class='division'></div>"
			. "Generales: <div class='totalesAct'>" . $metaNivelEje->getTotalDos() . "</div>"
			. "<div class='division'></div>"
			. "Particulares: <div class='totalesAct'>" . $metaNivelEje->getTotalTres() . "</div>"
			. "<div class='division'></div>"
			. "Sub: <div class='totalesAct'>" . $metaNivelEje->getTotalCuatro() . "</div>";
	}

	$cadenaImprimeFa = "<a href='https://siemuseo.com/sie/vista/apps/ActividadesMetas/lista_actividadesMetas.php?IdEje=" . $idAreaEje . "&IdTipo=1&IdPeriodo=3&nombreUsuario=" . $nombreUsuario . "'><i class='fa fa-list-alt' aria-hidden='true'></i></a>";
}

$Total_tirajeCatalogo = 0;
$Total_tirajeCuadernillo = 0;
$Total_tirajeLibrodeautor = 0;
$Total_tirajeMemoria = 0;
$Total_tirajeGuia = 0;
$Total_tirajeFolletoTriptico = 0;
$Total_tirajeFolletoHojadesala = 0;
$Total_tirajeFolletoPeriodico = 0;

$consulta_tiraje2 = "SELECT DISTINCT cl.IdLibro, tp.Nombre, cl.AnioPublicacion,
(SELECT COUNT(g.IdLibro)
FROM c_formatoLibro as g
INNER JOIN c_libro AS cl
ON g.IdLibro=cl.IdLibro
WHERE g.IdTipoPublicacion=tp.IdTipoPublicacion) as totaltipo,
(SELECT SUM(caraclib.TirajeTotal) FROM c_caracTecnicasLibro as caraclib   WHERE caraclib.IdLibro=cl.IdLibro ) AS tiraje
FROM c_libro AS cl
INNER JOIN c_caracTecnicasLibro AS caraclib
ON cl.IdLibro=caraclib.IdLibro
INNER JOIN c_formatoLibro AS g
ON cl.IdLibro=g.IdLibro
INNER JOIN c_tipoPublicacion AS tp
ON g.IdTipoPublicacion=tp.IdTipoPublicacion";

$resul_datos2 = $catalogo->obtenerLista($consulta_tiraje2);

while ($filas = mysqli_fetch_array($resul_datos2)) {
	if ($filas['Nombre'] == "Catálogo") {
		$Total_tirajeCatalogo += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Cuadernillo") {
		$Total_tirajeCuadernillo += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Libro de autor") {
		$Total_tirajeLibrodeautor += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Memoria") {
		$Total_tirajeMemoria += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Guía") {
		$Total_tirajeGuia += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Folleto Tríptico") {
		$Total_tirajeFolletoTriptico += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Folleto Hoja de sala") {
		$Total_tirajeFolletoHojadesala += $filas['tiraje'];
	}
	if ($filas['Nombre'] == "Folleto Periódico") {
		$Total_tirajeFolletoPeriodico += $filas['tiraje'];
	}
}
/*total asuntos recibidos*/
$actAsuntos = new PortadaController();
$asuntosRecibidos = $actAsuntos->mostrarTotalAsuntosRecibidos($idAreaEje);
$totalAsuntosRec = $asuntosRecibidos->getTotal();

$totalDirectosA = $actAsuntos->mostrarTotalAsuntosRecibidosDirectos($idAreaEje);
$asuntosDirectos = $totalDirectosA->getTotal();

$totalAInvitados = $actAsuntos->mostrarTotalAsuntosRecibidosInvitados($idAreaEje);
$asuntosInvitados = $totalAInvitados->getTotal();

$actFocos = new IndicadorController();
$focos = $actFocos->mostrarTotalfocosRecibidos($idAreaEje);
$totalFocos = $focos->getTotal();

$focosEnv = $actFocos->mostrarTotalfocosEnviados($idAreaEje);
$totalFocosEnv = $focosEnv->getTotal();

$actC = new IndicadorController();
$resueltos = $actC->mostrarTotalfocosRecibidosResueltos($idAreaEje);
$totalResueltos = $resueltos->getTotal();

$resueltosEnv = $actC->mostrarTotalfocosEnviadosResueltos($idAreaEje);
$totalResueltosEnv = $resueltosEnv->getTotal();

$percentR = 0;
$bgClassFR = "";

if ($totalFocos > 0) {
	$percentR = ($totalResueltos * 100) / $totalFocos;
	if ($percentR <= 59.9) {
		$bgClassFR = "bg-danger";
	} else if (($percentR >= 60 && $percentR <= 90.9)) {
		$bgClassFR = "bg-warning";
	} else if ($percentR >= 91) {
		$bgClassFR = "bg-success";
	}
}

$percentEnv = 0;
$bgClassFE = "";
if ($totalFocosEnv > 0) {
	$percentEnv = ($totalResueltosEnv * 100) / $totalFocosEnv;
	if ($percentEnv <= 59.9) {
		$bgClassFE = "bg-danger";
	} else if (($percentEnv >= 60 && $percentEnv <= 90.9)) {
		$bgClassFE = "bg-warning";
	} else if ($percentEnv >= 91) {
		$bgClassFE = "bg-success";
	}
}

/*total asuntos enviados*/
$asuntosEnviados = $actAsuntos->mostrarTotalAsuntosEnviados($idAreaEje);
$totalAsuntosEnv = $asuntosEnviados->getTotal();

$embudo="color:#9dfb9d  !important;";
// if($contRojo>0)$embudo="color:red !important;";
// else if($contAmari>0)$embudo="color:yellow !important;;";
// else if($contVerde>0)$embudo="color:#9dfb9d !important;;";
$tool = ': <span style="color:red;">0</span><br>';
// if($rojos[0][1]!='0')
// 	$tool = $rojos[0][0].': <span style="color:red;">'.$rojos[0][1].'</span><br>';
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.PORTADA.::</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../resources/font/index.css" />
	<link rel="stylesheet" type="text/css" href="../resources/css/portada.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link href="../resources/css/bootstrap-select.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../resources/js/bootstrap-select.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
	<script src="../resources/js/funcionesPrincipal.js"></script>
	<style type="text/css">
		a:hover {
			cursor: pointer;
		}
	</style>
	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		});
	</script>
	<style>
		.recf131 {
			font-family: 'Muli-Regular';
			font-size: 9px;
			border: 1px solid #cccac9;
			position: absolute;
			/* right: 0px;*/
			left: 25px;
			width: 17px;
			height: 17px;
			top: 4px;
			background-color: #cccac9;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.recf132 {
			font-family: 'Muli-Regular';
			font-size: 9px;
			border: 1px solid #cccac9;
			position: absolute;
			/* right: 0px;*/
			left: 50px;
			width: 17px;
			height: 17px;
			top: 4px;
			background-color: #cccac9;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.recf133 {
			font-family: 'Muli-Regular';
			font-size: 9px;
			border: 1px solid #cccac9;
			position: absolute;
			/* right: 0px;*/
			left: 75px;
			width: 17px;
			height: 17px;
			top: 4px;
			background-color: #cccac9;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.recf134 {
			font-family: 'Muli-Regular';
			font-size: 9px;
			border: 1px solid #cccac9;
			position: absolute;
			/* right: 0px;*/
			left: 100px;
			width: 17px;
			height: 17px;
			top: 4px;
			background-color: #cccac9;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.recf135 {
			font-family: 'Muli-Regular';
			font-size: 9px;
			border: 1px solid #cccac9;
			position: absolute;
			/* right: 0px;*/
			left: 125px;
			width: 17px;
			height: 17px;
			top: 4px;
			background-color: #cccac9;
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
		}

		.setTooltip+.tooltip>.tooltip-inner {


			font-size: 9.5px;
			font-family: 'Muli-Regular';
		}
		.toolF .tooltipF {
		  visibility: hidden;
		  width: 180px;
		  background-color: black;
		  color: #fff;
		  font-size: 10px;
		  text-align: left;
		  border-radius: 6px;
		  padding: 5px;

		  /* Position the tooltip */
		  position: absolute;
		  top:30px;
		  left: -100px;
		  z-index: 1;
		}

		.toolF:hover .tooltipF {
		  visibility: visible;
		}
	</style>

</head>
<?php
			$eje_area_aux = $ejeArea;?>
<body style="overflow-y:hidden;overflow-x:hidden;">
	<a href="apps/Asuntos_indicadores/vista.php?ejearea=<?php echo $ejeArea; ?>&idejearea=<?php echo  $idAreaEje; ?>" target="_blank">
	<span style="font-size:15px;cursor:pointer; position:absolute;top:5px; right: 50px; color:white;  width:30px; height:30px; text-align:center; border-radius: 5px 5px 0px 0px; padding-top:5px; "  class="toolF"><i class="fa fa-globe"></i>
	</span></a>

	<div class="well2 "><?php echo $nombreAreaEje; ?><?php echo $cadenaSubAreas; ?></div>
	<?php include_once __DIR__ . "/menu.php"; ?>

	<!--seccion asuntos-->
	<div style="top: 65px;left: 1px;" class="divSec1">
		<!--
		<a class="setTooltip" data-toggle="tooltip" data-placement="top" title="Asuntos" style="cursor: pointer;color: white;border-radius: 50%;background-color: black;width: 15px;height: 15px;" href="apps/Asuntos/index.php?ac=1&idUsuario=< ?php echo $idUsuario; ?>&idArea=< ?php echo $idAreaEje; ?>&anio=< ?php echo $anio; ?>&tipo=4&opcion=recibido&idEje=0&idAreaU=< ?php echo $idAreaUsuario; ?>&nuevo=1">A</a>
		-->
		<img style="left: 1px;top:7px;" class="imgG" src="../resources/img/imgSobre.png" />
		<?php if ($ejeArea == 1) { ?>
			<p data-toggle="tooltip" data-placement="top" title="recibidos directos" style="left: 22px;top: 4px;width: 18px;font-size: 10px;border: .5px solid #8BC34A;" onclick="javascript:location.href='indicadores/asuntos/index.php?idArea=<?php echo $idAreaEje; ?>&nombreArea=<?php echo $nombreAreaEje; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>&totalAsuntosRec=<?php echo $totalAsuntosRec; ?>'" class="recf41 setTooltip"><?php echo $asuntosDirectos; ?> </p>
			<p data-toggle="tooltip" data-placement="top" title="recibidos invitado" style="left: 48px;top: 4px;width: 18px;font-size: 10px;border: .5px solid #f1ca94;" onclick="javascript:location.href='indicadores/asuntos/indexInvitado.php?idArea=<?php echo $idAreaEje; ?>&nombreArea=<?php echo $nombreAreaEje; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>&totalAsuntosRec=<?php echo $totalAsuntosRec; ?>'" class="recf41 setTooltip"><?php echo $asuntosInvitados; ?> </p>

		<?php } else { ?>
			<p style="left: -4px;top: 4px;width: 62px;font-size: 10px;" class="recf41"><?php echo $asuntosDirectos; ?></p>
		<?php } ?>

		<!--enviados-->

		<img style="top: 6px;left: 133px;width: 14px;" class="imgE" src="../resources/img/imgEnviado.png" />
		<?php if ($ejeArea == 1) { ?>
			<p onclick="javascript:location.href='indicadores/asuntos/indexEnviados.php?idArea=<?php echo $idAreaEje; ?>&nombreArea=<?php echo $nombreAreaEje; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>&totalAsuntosEnv=<?php echo $totalAsuntosEnv; ?>'" data-toggle="tooltip" data-placement="bottom" title="enviados" style="font-size: 10px;right: 20px;width: 18px;border: .5px solid white;" class="recf41 setTooltip"><?php echo $totalAsuntosEnv; ?></p>
		<?php } else { ?>
			<p style="font-size: 10px;right: 6px;" class="recf41"><?php echo $totalAsuntosEnv; ?></p>
		<?php } ?>

	</div>
	<?php
	if ($ejeArea == 1) {
	?>
		<div onclick="javascript:location.href='indicadores/focosAsuntos/focoProblematica.php?idArea=<?php echo $idAreaEje; ?>&nombreArea=<?php echo $nombreAreaEje; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" data-html="true" data-toggle="tooltip" data-placement="bottom" title="Focos recibidos<br> <?php echo number_format($percentR, 1, '.', ''); ?>% avance <br>resueltos <?php echo $totalResueltos; ?> de <?php echo $totalFocos; ?>" style="cursor:pointer;top: 91px;left: 1px;" class="cuadroSec1 setTooltip">
			<!--style="cursor:pointer;top: 91px;left: 1px;display: flex;justify-content: left;align-items: center;padding: 11px;"-->

			<i class="far fa-lightbulb fa-2x setTooltip" style="color:red;font-size: 12px;top:2px;cursor:pointer;left: 3px;position:absolute;"></i>
			<!--<a href="indicadores/focosAsuntos/focoProblematica.php?idArea=< ?php echo $idAreaEje; ?>&nombreArea=< ?php echo $nombreAreaEje; ?>">-->
			<p style=" font-size: 8.5px;font-family: 'Muli-Regular';left: 18px;text-align: center;position: absolute;top: 1px;"> <b> <?php echo $totalResueltos; ?> / <?php echo $totalFocos; ?></b>
				<!--<br><div style="font-size: 8.5px;top: 13px;position: absolute;left: 31px;font-family: 'Muli-Regular';">< ?php echo number_format($percentR, 1, '.', '');?>%</div>-->
			</p>
			<div class="progress-group">
				<div style="cursor:pointer;top: 17px;position: relative;height: 10px !important;" class="progress progress-sm ">
					<div class="progress-bar  <?php echo $bgClassFR; ?>" style="line-height: 12px !important;font-size: 8.5px;font-family: 'Muli-Bold';width: <?php echo number_format($percentR, 1, '.', ''); ?>%"><?php echo number_format($percentR, 1, '.', ''); ?>%</div>
				</div>
			</div>
		</div>
	<?php
	} else {
	?>
		<div style="top: 91px;left: 1px;display: flex;justify-content: left;align-items: center;padding: 11px;" class="cuadroSec1">

		</div>
	<?php
	}
	?>




	<?php
	if ($ejeArea == 1) {
	?>
		<div onclick="javascript:location.href='indicadores/focosAsuntos/focoProblematicaEnviados.php?idArea=<?php echo $idAreaEje; ?>&nombreArea=<?php echo $nombreAreaEje; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" data-html="true" data-toggle="tooltip" data-placement="bottom" title="Focos enviados<br> <?php echo number_format($percentEnv, 1, '.', ''); ?>% avance <br>resueltos <?php echo $totalResueltosEnv; ?> de <?php echo $totalFocosEnv; ?>" style="cursor:pointer ;top: 91px;left: 76px;" class="cuadroSec1 setTooltip">

			<i class="far fa-lightbulb fa-2x" style="cursor:pointer;color:red;font-size: 12px;"></i>
			<p style="    font-size: 8.5px;font-family: 'Muli-Regular';left: 14px;text-align: center;position: absolute;top: 1px;"> <b> <?php echo $totalResueltosEnv; ?> / <?php echo $totalFocosEnv; ?></b>
				<!--<br><div style="font-size: 8.5px;top: 13px;position: absolute;left: 35px;font-family: 'Muli-Regular';">< ?php echo number_format($percentEnv, 1, '.', '');?>%</div>-->
			</p>
			<div class="progress-group">
				<div style="cursor:pointer;top: 2px;position: relative;height: 10px !important;" class="progress progress-sm ">
					<div class="progress-bar <?php echo $bgClassFE; ?>" style="line-height: 12px !important;font-size: 8.5px;font-family: 'Muli-Bold';width: <?php echo number_format($percentEnv, 1, '.', ''); ?>%"><?php echo number_format($percentEnv, 1, '.', ''); ?>%</div>
				</div>
			</div>

		</div>
	<?php
	} else {
	?>
		<div style="top: 91px;left: 76px;display: flex;justify-content: left;align-items: center;padding: 11px;" class="cuadroSec1">
		</div>
	<?php } ?>

	<div class="imprimeAsuntos">
		<div style="top: 117px;left: 1px;" class="cuadroSec1">
			<img class="imgS" src="../resources/img/imgSobre.png" />
			<p class="recf11"></p>
			<p class="recf12"></p>
			<p class="recf13"></p>
		</div>
		<div style="top: 117px;left: 76px;" class="cuadroSec1">
			<img class="imgE" src="../resources/img/imgEnviado.png" />
			<p class="envf11"></p>
		</div>

		<div style="top: 143px;left: 1px;" class="cuadroSec1">
			<p class="recf21"></p>
			<p class="recf22"></p>
			<p class="recf23"></p>
			<p class="recf24"></p>
		</div>
		<div style="top: 143px;left: 76px;" class="cuadroSec1">
			<img class="imgE" src="../resources/img/imgConversacion.png" />
			<p class="envf11"></p>
		</div>

		<div style="top: 169px;left: 1px;" class="cuadroSec1">
			<img class="imgS" src="../resources/img/imgTerminado.png" />
			<p class="recf31"></p>
			<p class="recf32"></p>
			<p class="recf33"></p>
		</div>
		<div style="top: 169px;left: 76px;" class="cuadroSec1">
			<img class="imgE" src="../resources/img/imgTerminado.png" />
			<p class="envf11"></p>
		</div>
	</div>
	<div style="top: 195px;left: 1px;" class="cuadroSec1">

		<?php
		if ($ejeArea == 1) {

			$actT = new PortadaController();
			$totalDirectos = $actT->mostrarTotalAsuntosRecibidosDirectos($idAreaEje);
			$directos = $totalDirectos->getTotal();

			$totalDR = $actT->mostrarTotalAsuntosRecibidosDirectosResueltos($idAreaEje);
			$directosR = $totalDR->getTotal();

			$percentResul = 0.0;
			$bgClass = "";
			if ($directos > 0) {
				$percentResul = ($directosR * 100) / $directos;

				if ($percentResul <= 59.9) {
					$bgClass = "bg-danger";
				} else if (($percentResul >= 60 && $percentResul <= 90.9)) {
					$bgClass = "bg-warning";
				} else if ($percentResul >= 91) {
					$bgClass = "bg-success";
				}
			}
		?>
			<div class="progress-group">
				<!--
                <span onclick="entrarResueltos('recibido');" class="progress-text" style="cursor:pointer;font-size: 8.5px;font-family: 'Muli-SemiBold';position: relative;top: -5px;left: 20px;">resueltos</span>
                <span onclick="entrarResueltos('recibido');" style="cursor:pointer;font-size: 8.5px;font-family: 'Muli-Bold';position: absolute;left: 2px;top: 5px;width: 70px;text-align: center;" class="float-right numero"><b></b><?php echo $directosR; ?> / <?php echo $directos; ?></span>
                -->
				<div onclick="entrarResueltos('recibido');" style="cursor:pointer;top: 17px;position: relative;height: 10px !important;" data-html="true" data-toggle="tooltip" data-placement="bottom" title="<?php echo number_format($percentResul, 1, '.', ''); ?>% directos resueltos <?php echo $directosR; ?> de <?php echo $directos; ?> " class="progress progress-sm setTooltip">
					<div class="progress-bar <?php echo $bgClass; ?>" style="line-height: 12px !important;font-size: 8.5px;font-family: 'Muli-Bold';width: <?php echo number_format($percentResul, 1, '.', ''); ?>%"><?php echo number_format($percentResul, 1, '.', ''); ?>%</div>
				</div>
			</div>
		<?php } ?>

	</div>
	<div style="top: 195px;left: 76px;" class="cuadroSec1">

		<?php
		if ($ejeArea == 1) {

			$actTE = new PortadaController();
			$totalEnviados = $actTE->mostrarTotalAsuntosEnviadosResueltos($idAreaEje);
			$enviadosR = $totalEnviados->getTotal();

			$percentResulEr = 0.0;
			$bgClassE = "";
			if ($totalAsuntosEnv > 0) {
				$percentResulEr = ($enviadosR * 100) / $totalAsuntosEnv;

				if ($percentResulEr <= 59.9) {
					$bgClassE = "bg-danger";
				} else if (($percentResulEr >= 60 && $percentResulEr <= 90.9)) {
					$bgClassE = "bg-warning";
				} else if ($percentResulEr >= 91) {
					$bgClassE = "bg-success";
				}
			}
		?>
			<div class="progress-group">
				<!--
				<span onclick="entrarResueltos('enviado');" class="progress-text" style="cursor:pointer;font-size: 8.5px;font-family: 'Muli-SemiBold';position: relative;top: -5px;left: 20px;">resueltos</span>
                <span onclick="entrarResueltos('enviado');" style="cursor:pointer;font-size: 8.5px;font-family: 'Muli-Bold';position: absolute;left: 2px;top: 5px;width: 70px;text-align: center;" class="float-right numero"><b></b><?php echo $enviadosR; ?> / <?php echo $totalAsuntosEnv; ?></span>
                -->
				<div onclick="entrarResueltos('enviado');" style="cursor:pointer;top: 17px;position: relative;height: 10px !important;" data-toggle="tooltip" data-placement="bottom" title="<?php echo number_format($percentResulEr, 1, '.', ''); ?>% enviados resueltos <?php echo $enviadosR; ?> de <?php echo $totalAsuntosEnv; ?> " class="progress progress-sm setTooltip">
					<div class="progress-bar <?php echo $bgClassE; ?>" style="line-height: 12px !important;font-size: 8.5px;font-family: 'Muli-Bold';width: <?php echo number_format($percentResulEr, 1, '.', ''); ?>%"><?php echo number_format($percentResulEr, 1, '.', ''); ?>%</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<!------------------->
	<!--seccion acuerdos escritos-->
	<div style="top: 65px;left: 152px;" class="divSec1">Acuerdos Firmados</div>
	<div class="imprimeAcuerdos">
		<?php echo $cadenaAcuerdos; ?>
		<!--
		<div style="top: 91px;left: 152px;" class="cuadroSec2">Convocados <p class="acuEsc"></p></div>
		<div style="top: 117px;left: 152px;" class="cuadroSec2">Invitado <p class="acuEsc"></p></div>
		<div style="top: 143px;left: 152px;" class="cuadroSec2">Realizados <p class="acuEsc"></p></div>
		<div style="top: 169px;left: 152px;" class="cuadroSec2">No realizados <p class="acuEsc"></p></div>
		<div style="top: 195px;left: 152px;" class="cuadroSec2"></div>
	-->
	</div>
	<!----------------------------->
	<!--seccion presupuesto inbal-->
	<div style="top: 65px;left: 303px;" class="divSec1">Presupuesto</div>
	<div style="top: 91px;left: 303px;font-size: 10px;padding:5px;" class="cuadroSec3">Museo Kaluz<b style='position: absolute;right: 9px;'><?php echo "$000"; ?></b></div>
	<div style="top: 117px;left: 303px;font-size: 10px;padding:5px;" class="cuadroSec3">Inmobiliaria<b style='position: absolute;right: 9px;'><?php echo "$000"; ?></b></div>
	<div style="top: 143px;left: 303px;font-size: 10px;padding:5px;" class="cuadroSec3">OHA<b style='position: absolute;right: 9px;'><?php echo "$000"; ?></b></div>
	<div style="top: 169px;left: 303px;font-size: 10px;padding:5px;" class="cuadroSec3"><b>Total:</b><b style='position: absolute;right: 9px;'><?php echo "$000"; ?></b></div>
	<div style="top: 195px;left: 303px;" class="cuadroSec3"></div>
	<!----------------------------->
	<!--seccion archivos compartidos-->
	<?php
	$parametros = "nombreUsuario=$nombreUsuario&idUsuario=$idUsuario&tipoPerfil=$idPerfil&TipoAreaEje=$ejeArea&IdAreaEje=$idAreaEje&anio=$AnioActual";
	if ($ejeArea == 2) {
		$archivoControllerAct = new PortadaController();
		$archivos = $archivoControllerAct->mostrarArchivos($idAreaEje);
		$archEnt = '<a href="apps/ArchivosEntregables/Lista_entregable.php?' . $parametros . '">' . $archivos->getTotal() . '</a>';
		$archNor = '<a href="apps/ArchivosNormatividad/lista_normatividad.php?' . $parametros . '">' . $archivos->getTotalDos() . '</a>';
		$archCom = '<a href="apps/ArchivosCompartidos/lista_archivo.php?' . $parametros . '">' . $archivos->getTotalTres() . '</a>';
	?>

		<div style="top: 65px;left: 454px;" class="divSec1">Archivos</div>
		<div style="top: 91px;left: 454px;font-size: 10px;padding:5px;" class="cuadroSec4"><a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="" href='indicadores/Entregables/Dashboard_entregables.php?estatus=1&eje=<?php echo $idAreaEje; ?>&anio=todos&cate=0'><i class='fa fa-list-alt' aria-hidden='true'></i></a> Entregables <b style='position: absolute;right: 9px;'><?php echo $archEnt; ?></b></div>
		<div style="top: 117px;left: 454px;" class="cuadroSec4"></div>
		<div style="top: 143px;left: 454px;font-size: 10px;padding:5px;;" class="cuadroSec4"><a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="" href='apps/ArchivosNormatividad/lista_normatividad.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>&TipoAreaEje=<?php echo $ejeArea; ?>&IdAreaEje=<?php echo $idAreaEje; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a> Normatividad <b style='position: absolute;right: 9px;'><?php echo $archNor; ?></b></div>
		<div style="top: 169px;left: 454px;" class="cuadroSec4"></div>
		<div style="top: 195px;left: 454px;font-size: 10px;padding:5px;;" class="cuadroSec4"><a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="" href='apps/ArchivosCompartidos/Lista_archivos.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>&TipoAreaEje=<?php echo $ejeArea; ?>&IdAreaEje=<?php echo $idAreaEje; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a> Compartidos <b style='position: absolute;right: 9px;'><?php echo $archCom; ?></b> </div>
	<?php
	} else {
		$archivoControllerAct = new PortadaController();
		$archivos = $archivoControllerAct->mostrarArchivosArea($idAreaEje);
		$archEnt = '<a href="apps/ArchivosEntregables/Lista_entregable.php?' . $parametros . '">' . $archivos->getTotal() . '</a>';
		$archNor = '<a href="apps/ArchivosNormatividad/lista_normatividad.php?' . $parametros . '">' . $archivos->getTotalDos() . '</a>';
		$archCom = '<a href="apps/ArchivosCompartidos/lista_archivo.php?' . $parametros . '">' . $archivos->getTotalTres() . '</a>';

	?>
		<div style="top: 65px;left: 454px;" class="divSec1">Archivos</div>
		<div style="top: 91px;left: 454px;font-size: 10px;padding:5px;" class="cuadroSec4"><a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="" href='indicadores/Entregables/Dashboard_entregables.php?estatus=1&eje=0&anio=todos&cate=0'><i class='fa fa-list-alt' aria-hidden='true'></i></a> Entregables <b style='position: absolute;right: 9px;'><?php echo $archEnt; ?></b></div>
		<div style="top: 117px;left: 454px;" class="cuadroSec4"></div>
		<div style="top: 143px;left: 454px;font-size: 10px;padding:5px;;" class="cuadroSec4"><a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="" href='apps/ArchivosNormatividad/lista_normatividad.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>&TipoAreaEje=<?php echo $ejeArea; ?>&IdAreaEje=<?php echo $idAreaEje; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a> Normatividad <b style='position: absolute;right: 9px;'><?php echo $archNor; ?></b></div>
		<div style="top: 169px;left: 454px;" class="cuadroSec4"></div>
		<div style="top: 195px;left: 454px;font-size: 10px;padding:5px;;" class="cuadroSec4"><a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="" href='apps/ArchivosCompartidos/Lista_archivos.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>&TipoAreaEje=<?php echo $ejeArea; ?>&IdAreaEje=<?php echo $idAreaEje; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a> Compartidos <b style='position: absolute;right: 9px;'><?php echo $archCom; ?></b> </div><?php
																																																																																																																																														}
																																																																																																																																															?>
	<!-------------------------------->
	<!--seccion servicio social-->
	<?php
	if ($ejeArea == 2) {
		$servControllerAct = new PortadaController();
		$servicio = $servControllerAct->mostrarServicioEje($idAreaEje);
		$solicitado = $servicio->getSolicitado();
		$solicitadoTotal = $servicio->getSolicitadoTotal();
		$asignado = $servicio->getAsignado();
		$asignadoTotal = $servicio->getAsignadoTotal();
		$liberado = $servicio->getLiberado();
		$liberadoTotal = $servicio->getLiberadoTotal();
		$actual = $servicio->getActual();
		$actualTotal = $servicio->getActualTotal();
		$candidatos = $servicio->getCandidatos();

		$percentSolicitado = 0.0;
		if ($solicitadoTotal > 0) {
			$percentSolicitado = ($solicitado * 100) / $solicitadoTotal;
		}
		$percentAsignado = 0.0;
		if ($asignadoTotal > 0) {
			$percentAsignado = ($asignado * 100) / $asignadoTotal;
		}
		$percentLiberado = 0.0;
		if ($liberadoTotal > 0) {
			$percentLiberado = ($liberado * 100) / $liberadoTotal;
		}
		$percentActual = 0.0;
		if ($actualTotal > 0) {
			$percentActual = ($actual * 100) / $actualTotal;
		}

	?>
		<div style="top: 65px;left: 605px;" class="divSec1">Servicio social <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/ServicioSocial/Indicadores.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>
		<div style="top: 91px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Solicitado <b style='position: absolute;right: 9px;'><?php echo $solicitado; ?> / <?php echo $solicitadoTotal; ?> (<?php echo number_format($percentSolicitado, 1, '.', ''); ?>%)</b></div>
		<div style="top: 117px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Asignado <b style='position: absolute;right: 9px;'><?php echo $asignado; ?> / <?php echo $asignadoTotal; ?> (<?php echo number_format($percentAsignado, 1, '.', ''); ?>%)</b></div>
		<div style="top: 143px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Liberado <b style='position: absolute;right: 9px;'><?php echo $liberado; ?> / <?php echo $liberadoTotal; ?> (<?php echo number_format($percentLiberado, 1, '.', ''); ?>%)</b></div>
		<div style="top: 169px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Actual <b style='position: absolute;right: 9px;'><?php echo $actual; ?> / <?php echo $actualTotal; ?> (<?php echo number_format($percentActual, 1, '.', ''); ?>%)</b></div>
		<div style="top: 195px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Candidatos sin asignar<b style='position: absolute;right: 9px;'><?php echo $candidatos; ?></b></div>
	<?php
	} else {
		$servControllerAct = new PortadaController();
		$servicio = $servControllerAct->mostrarServicioArea($idAreaEje);
		$solicitado = $servicio->getSolicitado();
		$solicitadoTotal = $servicio->getSolicitadoTotal();
		$asignado = $servicio->getAsignado();
		$asignadoTotal = $servicio->getAsignadoTotal();
		$liberado = $servicio->getLiberado();
		$liberadoTotal = $servicio->getLiberadoTotal();
		$actual = $servicio->getActual();
		$actualTotal = $servicio->getActualTotal();
		$candidatos = $servicio->getCandidatos();

		$percentSolicitado = 0.0;
		if ($solicitadoTotal > 0) {
			$percentSolicitado = ($solicitado * 100) / $solicitadoTotal;
		}
		$percentAsignado = 0.0;
		if ($asignadoTotal > 0) {
			$percentAsignado = ($asignado * 100) / $asignadoTotal;
		}
		$percentLiberado = 0.0;
		if ($liberadoTotal > 0) {
			$percentLiberado = ($liberado * 100) / $liberadoTotal;
		}
		$percentActual = 0.0;
		if ($actualTotal > 0) {
			$percentActual = ($actual * 100) / $actualTotal;
		}
	?>
		<div style="top: 65px;left: 605px;" class="divSec1">Servicio social <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/ServicioSocial/Indicadores.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>
		<div style="top: 91px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Solicitado <b style='position: absolute;right: 9px;'><?php echo $solicitado; ?> / <?php echo $solicitadoTotal; ?> (<?php echo number_format($percentSolicitado, 1, '.', ''); ?>%)</b></div>
		<div style="top: 117px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Asignado <b style='position: absolute;right: 9px;'><?php echo $asignado; ?> / <?php echo $asignadoTotal; ?> (<?php echo number_format($percentAsignado, 1, '.', ''); ?>%)</b></div>
		<div style="top: 143px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Liberado <b style='position: absolute;right: 9px;'><?php echo $liberado; ?> / <?php echo $liberadoTotal; ?> (<?php echo number_format($percentLiberado, 1, '.', ''); ?>%)</b></div>
		<div style="top: 169px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Actual <b style='position: absolute;right: 9px;'><?php echo $actual; ?> / <?php echo $actualTotal; ?> (<?php echo number_format($percentActual, 1, '.', ''); ?>%)</b></div>
		<div style="top: 195px;left: 605px;font-size: 10px;padding:5px;" class="cuadroSec5">Candidatos sin asignar<b style='position: absolute;right: 9px;'><?php echo $candidatos; ?></b></div>
	<?php
	}
	?>
	<!--------------------------->
	<!--seccion guardias-->
	<?php
	if ($ejeArea == 1) { //Es área
		$actGuardia = new PortadaController();
		$guardia = $actGuardia->mostrarTotalGuardias($idAreaEje);
		$totalGuardias = $guardia->getTotal();
	?>
		<div style="top: 65px;left: 756px;" class="divSec1">Guardias <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/Opiniones/CuestionarioModigliani/retro_guardias.php'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>
		<div style="top: 91px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6"><b>Total :</b> <b style="position: absolute;right: 9px;"><?php echo $totalGuardias; ?></b></div>
		<div style="top: 117px;left: 756px;" class="cuadroSec6"></div>
		<div style="top: 143px;left: 756px;" class="cuadroSec6"></div>
		<div style="top: 169px;left: 756px;" class="cuadroSec6"></div>
		<div style="top: 195px;left: 756px;" class="cuadroSec6"></div>
	<?php
	} else { //Sino es área es eje
		$actividad = $Planeacion->Vista_entregables_eje($idAreaEje, 1, 10, 2022,"","");
    $meta = $Planeacion->Vista_entregables_eje($idAreaEje, 2, 10, 2022,"","");

		$avance_22_act = round($actividad[1],1);
		$avance_22_met = round($meta[1],1);

		$actividad1 = $Planeacion->Vista_entregables_eje($idAreaEje, 1, 9, 2021,"","");
    $meta1 = $Planeacion->Vista_entregables_eje($idAreaEje, 2, 9, 2021,"","");

		$avance_21_act = round($actividad1[1],1);
		$avance_21_met = round($meta1[1],1);


	?>
	<div style="top: 65px;left: 756px;" class="divSec1">Planeación y Avance</div>
	<div style="top: 91px;left: 756px;font-size: 9px;padding:5px;" class="cuadroSec6">
		<a href="./apps/Planeacion/Planeacion_avance_acme.php?IdEje=<?php echo $idAreaEje; ?>&tipo=1&Periodo=10&ano=2022&
		nombreeje=<?php echo $nombreAreaEje; ?>&Id_usuario=999&nombreUsuario=Sn%20usr&Perfil=1&tipoPerfil=1">
		Actividades 2022</a> (<?php echo $avance_22_act!=""?$avance_22_act:"0"; ?>%)</div>
	<div style="top: 117px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">
		<a href="./apps/Planeacion/Planeacion_avance_acme.php?IdEje=<?php echo $idAreaEje; ?>&tipo=2&Periodo=10&ano=2022&
		nombreeje=<?php echo $nombreAreaEje; ?>&Id_usuario=999&nombreUsuario=Sn%20usr&Perfil=1&tipoPerfil=1">
		Metas 2022</a> (<?php echo $avance_22_met!=""?$avance_22_met:"0"; ?>%)</div>
	<div style="top: 143px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">
		<a href="./apps/Planeacion/Planeacion_avance_acme.php?IdEje=<?php echo $idAreaEje; ?>&tipo=1&Periodo=9&ano=2021&
		nombreeje=<?php echo $nombreAreaEje; ?>&Id_usuario=999&nombreUsuario=Sn%20usr&Perfil=1&tipoPerfil=1">
		Actividades 2021</a> (<?php echo $avance_21_act!=""?$avance_21_act:"0"; ?>%)</div>
	<div style="top: 169px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">
		<a href="./apps/Planeacion/Planeacion_avance_acme.php?IdEje=<?php echo $idAreaEje; ?>&tipo=2&Periodo=9&ano=2021&
		nombreeje=<?php echo $nombreAreaEje; ?>&Id_usuario=999&nombreUsuario=Sn%20usr&Perfil=1&tipoPerfil=1">
		Metas 2021</a> (<?php echo $avance_21_met!=""?$avance_21_met:"0"; ?>%)</div>
	<div style="top: 195px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6"></div>
	<!-- <div style="top: 65px;left:  756px;" class="divSec1">Planeación</div>
	<div style="top: 91px;left:  756px;font-size: 10px;padding:5px;" class="cuadroSec6">Categorías... N</div>
	<div style="top: 117px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">Actividades.. N</div>
	<div style="top: 143px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">Metas........ N</div>
	<div style="top: 169px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">Check........ N</div>
	<div style="top: 195px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec6">Avance....... N%</div> -->
	<?php
	}
	?>


	<!-------------------->

	<!--seccion entregables de actividades-->
	<!-- <div style="top: 222px;left: 1px;width: 904px;" class="divSec2">Indicadores asuntos

	</div> -->

	<!-- <div style="top: 248px;left: 1px;" class="cuadroSec7 entregablesMenu">

	</div> -->

	<!-- <div hidden style="top: 248px;left: 1px;" class="cuadroSec7 actividadesMenu">
		<div class="totalesAct"> totales: <?php echo $totalActividad; ?></div>
		<div class="division">|</div>
		<?php echo $cadenaActividadNivel; ?>
		<div class="imprimeFa" style="position: absolute;left: 438px;cursor:pointer"><?php echo $cadenaImprimeFa; ?></div>
	</div>
	<div hidden style="top: 248px;left: 1px;" class="cuadroSec7 metasMenu">
		<div class="totalesAct">totales: <?php echo $totalMeta; ?></div>
		<div class="division">|</div>
		<?php echo $cadenaMetaNivel; ?>
	</div> -- >
	<!--seccion entregables de metas-->

	<!-- <div style="top: 222px;left: 454px;" class="divSec2-1"></div> -->

	<!--<div style="top: 248px;left: 454px;" class="cuadroSec8">
		<div class="totalesAct">Totales: < ?php echo $totalMeta; ?></div>
		<div class="division">|</div>
		< ?php echo $cadenaMetaNivel; ?>
	</div>-->
	<div style="top: 222px;left: 0px;height: 263px;width: 904px;padding-left: 0px !important;" class="cuadroSec8">
		<!--<iframe scrolling="no" name="fr2" id="fr2" src="" style="width: 449px;height: 210px;margin-left: -4px; border:0;margin-top: -1px;"></iframe>-->
		<div name="indicadores_asuntos" id="indicadores_asuntos" style="height: 260px;width: 900px;margin-left: 0px; border:0;margin-top: 0px;overflow: scroll;background-color:white;"></div>
	</div>
	<!--
	<div style="top: 301px;left: 454px;" class="cuadroSec8-1">1.Seguridad</div>
	<div style="top: 316px;left: 454px;" class="cuadroSec8-1">2.Estratégico</div>
	<div style="top: 331px;left: 454px;" class="cuadroSec8-1">3.Infraestructura</div>
	<div style="top: 346px;left: 454px;" class="cuadroSec8-1">4.Administrativa</div>
	<div style="top: 361px;left: 454px;" class="cuadroSec8-1">5.Autogestión</div>
	<div style="top: 376px;left: 454px;" class="cuadroSec8-1">6.Permanente</div>
	<div style="top: 391px;left: 454px;" class="cuadroSec8-1">7.Temporales</div>
	<div style="top: 406px;left: 454px;" class="cuadroSec8-1">8.Bellas Artes</div>
	<div style="top: 421px;left: 454px;" class="cuadroSec8-1">9.Difusión</div>
	<div style="top: 436px;left: 454px;" class="cuadroSec8-1">10.Publicaciones</div>
	<div style="top: 451px;left: 454px;" class="cuadroSec8-1">11.Digital</div>
	<div style="top: 466px;left: 454px;" class="cuadroSec8-1-1"></div>
	-->
	<!-------------------------------------->


	<!--seccion opiniones-->
	<div style="top: 513px;left: 1px;width: 300px;" class="cuadroSec9"></div>
	<div class="imprimeOpiniones">
		<div style="top: 488px;left: 1px;width: 300px;" class="divSec3">Opiniones</div>
		<div style="top: 540px;left: 1px;width: 300px;" class="cuadroSec9">Felicitaciones <p class="opSec9">0</p>
		</div>
		<div style="top: 567px;left: 1px;width: 300px;" class="cuadroSec9">Solicitudes <p class="opSec9">0</p>
		</div>
		<div style="top: 594px;left: 1px;width: 300px;" class="cuadroSec9">Quejas <p class="opSec9">0</p>
		</div>
		<div style="top: 621px;left: 1px;width: 300px;" class="cuadroSec9">
		</div>
		<div style="top: 648px;left: 1px;width: 300px;" class="cuadroSec9"></div>
		<div style="top: 675px;left: 1px;width: 300px;" class="cuadroSec9-1"></div>
	</div>
	<!--------------------->
	<!--seccion total de visitantes-->
	<!--
	<div  style="height: 210px;width: 149px;left: 152px;top: 488px;position: absolute;overflow-y: scroll;" >
		<div style="" class="divSec3">Categorías</div>
		< ?php
			if($ejeArea == 2){


		$consulta_eje = "  SELECT ce.idCategoria,ce.descCategoria
                            FROM c_categoriasdeejes ce
                            WHERE ce.idEje= $idAreaEje AND ce.nivelCategoria = 1  ORDER BY ce.orden  ";

			$resul_cat = $catalogo->obtenerLista($consulta_eje);
			$top_categorias = 26;
			while ($row_cat = mysqli_fetch_array($resul_cat)){

				echo '<div style="top: '.$top_categorias.'px;" class="cuadroSec10">'.$row_cat['descCategoria'].'</div> ';
				$top_categorias += 14;

				$consulta_subcat = "  SELECT ce.idCategoria,ce.descCategoria
		                            FROM c_categoriasdeejes ce
		                            WHERE ce.idCategoriaPadre = ".$row_cat['idCategoria']."  AND ce.nivelCategoria = 2  ORDER BY ce.orden  ";

					$resul_subcat = $catalogo->obtenerLista($consulta_subcat);
					while ($row_subcat = mysqli_fetch_array($resul_subcat)){
						echo '<div style="top: '.$top_categorias.'px;" class="cuadroSec10"> -- '.$row_subcat['descCategoria'].'</div> ';
						$top_categorias += 14;
					}


			}

		}else{
			$top_categorias = 26;
			for ($i=0; $i < 16; $i++) {
				echo '<div style="top: '.$top_categorias.'px;" class="cuadroSec10"></div> ';
				$top_categorias += 14;
			}

		}
		?>


	</div>
	-->
	<!------------------------------->
	<!--seccion cruces-->
	<div style="top: 488px;left: 303px;" class="divSec3-1">Actividades y Metas</div>
	<div style="top: 514px;left: 303px;" class="cuadroSec11">Actividades</div>
	<div style="top: 514px;left: 454px;" class="cuadroSec11">Metas</div>

	<!------------------>
	<!--seccion aplicaciones antes objetivos-->
	<?php
	$parametros =  "?idUsuario=$idUsuario&idusuario=$idUsuario&tipoPerfil=1&perfil=1&nombreUsuario=$nombreUsuario&aplicacion=permanente";
		$applicaciones = array(array("Seguridad"),array("Procesos","Planeacion 2021","Acuerdos Escritos","Logros 2020","Aplicacion de indicadores","Actividades y Metas","Categorias y subcategorias"),array("Activo fijo"),
	array("Ingresos y egresos","Servicio social","Personas","Juridico","Transparencia","Instituciones"),array("Horas extras"),array("Coleccion permanente"),array("Piezas en exposición temporal","Exposiciones temporales"),
	array("Opiniones","Eventos","Cuestionarios","Reporte encuestas","Reporte de guardia","Estadistica de guardias"),array("Noticias portada","Noticias","Sprout social","Eficiencia informativa"),array("Publicaciones"),array("Formulario micrositio modigliani"));
		$links = array(array(1),array(2,3,4,5,6,"apps/ActividadesMetas/lista_actividadesMetas.php",38),array(11),
	array(12,13,14,15,16,17),array(18),array("apps/Piezas/vista/principal.php"),array(19,20),
	array(21,"",22,"",23,24),array(25,26,"https://app.sproutsocial.com/login","https://www.efinf.com/login/index.php?redirect=/site/1727/&error=Sesion+terminada%2C+favor+de+logear+nuevamente"),array(29),array(30));
	 ?>
	 <div style="top: 488px;left: 605px;" class="divSec3">Aplicaciones</div>
	<?php if($ejeArea == 2){ //es eje?>
		<?php
			$cont = 0;
			$espacio = 514;
			foreach ($applicaciones[$idAreaEje-1] as $appeje) {
				$cont++;
				if(is_numeric($links[$idAreaEje-1][$cont-1]))
					echo '<div style="top: '.$espacio.'px;left: 605px;" class="cuadroSec13"><a onclick="Verifica('.$idUsuario.','.$links[$idAreaEje-1][$cont-1].')">'.$appeje.'</a></div>';
				else {
					echo '<div style="top: '.$espacio.'px;left: 605px;" class="cuadroSec13"><a href="'.$links[$idAreaEje-1][$cont-1].$parametros.'" >'.$appeje.'</a></div>';
				}
				if($cont == 1)
					$espacio += 26;
				else
					$espacio += 27;

			}
			//imprime faltantes
			$faltantes = 7 - $cont;
			for ($i=0; $i < $faltantes; $i++) {
				echo '<div style="top: '.$espacio.'px;left: 605px;" class="cuadroSec13"></div>';
				$espacio += 27;
			}
		 ?>


		<!-- <div style="top: 540px;left: 605px;" class="cuadroSec13"></div>
		<div style="top: 567px;left: 605px;" class="cuadroSec13"></div>
		<div style="top: 594px;left: 605px;" class="cuadroSec13"></div>
		<div style="top: 621px;left: 605px;" class="cuadroSec13"></div>
		<div style="top: 648px;left: 605px;" class="cuadroSec13"></div>
		<div style="top: 675px;left: 605px;" class="cuadroSec13"></div> -->
	<?php }else{ ?>
		<?php
		$cont = 0;
		$espacio = 514;
		$consulta_ = "Select * from c_aplicaciones_areas where Id_area = $idAreaEje";

		$result_ = $catalogo->obtenerLista($consulta_);

		while ($r = mysqli_fetch_array($result_)){
				$cont++;
				if(is_numeric($r['Ruta_app']))
					echo '<div style="top: '.$espacio.'px;left: 605px;" class="cuadroSec13"><a onclick="Verifica('.$idUsuario.','.$r['Ruta_app'].')">'.$r['Descripcion_app'].'</a></div>';
				else {
					echo '<div style="top: '.$espacio.'px;left: 605px;" class="cuadroSec13"><a href="'.$r['Ruta_app'].$parametros.'" >'.$r['Descripcion_app'].'</a></div>';
				}


				if($cont == 1)
					$espacio += 26;
				else
					$espacio += 27;
		}

		$faltantes = 7 - $cont;
		for ($i=0; $i < $faltantes; $i++) {
			echo '<div style="top: '.$espacio.'px;left: 605px;" class="cuadroSec13"></div>';
			$espacio += 27;
		}
		?>


	<?php } ?>

	<!--------------------->
	<!--seccion publicaciones-->
	<?php
	if ($ejeArea == 2 && $idAreaEje == 10) {
	?>
		<div id="Todo">
			<div style="top: 488px;left: 756px;" class="divSec3">Publicaciones</div>
			<div style="top: 514px;left: 756px;" class="cuadroSec14"></div>
			<div style="top: 540px;left: 756px;" class="cuadroSec14">
				<b>Filtrar: </b><select name="Ano" id="Ano" onchange="Filtro($('#Ano').val())">
					<option value="Todos" selected>Todos los Años</option>
					<?php
					$consulta = "SELECT DISTINCT SUBSTR(AnioPublicacion,1,4) AS Ano FROM c_libro
				WHERE AnioPublicacion IS  not null
				ORDER BY AnioPublicacion asc";
					$respuesta = $catalogo->obtenerLista($consulta);
					while ($row = mysqli_fetch_array($respuesta)) {
					?>
					<?php
						$select = "";
						if ($row[0] == 2020) {
							$select = "selected";
						}
						echo "<option " . $select . " value='" . $row[0] . "'>" . $row[0] . "</option>";
					}
					?>
				</select>
			</div>
			<div style="top: 567px;left: 756px;" class="cuadroSec14">
				<i class="glyphicon glyphicon-indent-left" style="font-size: 20px;" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Productos"></i>
				<p class="recf131" id="totalcatalogo" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Cátalogos"><?php echo $prueba[0]; ?></p>
				<p class="recf132" id="totalcuadernillo" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Cuadernillo"><?php echo $prueba[1]; ?></p>
				<p class="recf133" id="totalLibroautor" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Libro de autor"><?php echo $prueba[2]; ?></p>
				<p class="recf134" id="totalmemoria" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Memoria"><?php echo $prueba[3]; ?></p>
				<p class="recf135" id="totalguia" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Guía"><?php echo $prueba[4]; ?></p>
			</div>
			<div style="top: 594px;left: 756px;" class="cuadroSec14">
				<i class="glyphicon glyphicon-tasks" style="font-size: 20px;" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Ejemplares"></i>
				<p class="recf131" id="totaltirajecatalogo" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Cátalogos"><?php echo number_format($Total_tirajeCatalogo); ?></p>
				<p class="recf132" id="totaltirajecuadernillo" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Cuadernillo"><?php echo number_format($Total_tirajeCuadernillo); ?></p>
				<p class="recf133" id="totaltirajelibroautor" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Libro de autor"><?php echo number_format($Total_tirajeLibrodeautor); ?></p>
				<p class="recf134" id="totaltirajememoria" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Memoria"><?php echo number_format($Total_tirajeMemoria); ?></p>
				<p class="recf135" id="totaltirajeguia" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Guía"><?php echo number_format($Total_tirajeGuia); ?></p>
			</div>
			<div class="cuadroSec14" style="top: 621px;left: 756px;">
				<div class="cuadroSec14" style=" border-right: 5px solid white; width: 50%">
					<i class="glyphicon glyphicon-send" style="font-size: 20px;" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Tiraje"></i>
					<p class="recf131" id="español" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Tiraje en español"><?php echo number_format($Tiraje[0]); ?></p>
					<p class="recf132" id="ingles" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Tiraje en ingles"><?php echo number_format($Tiraje[1]); ?></p>
				</div>
				<div class="cuadroSec14" style="left: 50%; width: 50%">
					<i class="glyphicon glyphicon-user" style="font-size: 20px;" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Autores"></i>
					<p class="recf131" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" id="AuNacional" onclick="" data-original-title="Nacionales"><?php echo $Autores[0]; ?></p>
					<p class="recf132" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" id="AuInternacional" onclick="" data-original-title="Internacionales"><?php echo $Autores[1]; ?></p>
				</div>
			</div>
			<div class="cuadroSec14" style="top: 648px;left: 756px;">
				<div class="cuadroSec14" style=" border-right: 5px solid white; width: 50%">
					<i class="glyphicon glyphicon-book" style="font-size: 20px;" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Textos"></i>
					<p class="recf131" id="Ineditos" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Ineditos"><?php echo $Textos[0]; ?></p>
					<p class="recf132" id="Publicados" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Publicados"><?php echo $Textos[1]; ?></p>
				</div>
				<div class="cuadroSec14" style="left: 50%; width: 50%">
					<i class="glyphicon glyphicon-facetime-video" style="font-size: 20px;" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Producciones"></i>
					<p class="recf131" id="ProduccionMPBA" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Producción MPBA"><?php echo $Producciones[0]; ?></p>
					<p class="recf132" id="Coproduccion" data-html="true" data-placement="bottom" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Coprodución"><?php echo $Producciones[1]; ?></p>
				</div>
			</div>
			<div style="top: 675px;left: 756px;" class="cuadroSec14">
				<i class=" glyphicon glyphicon-gbp " style="font-size: 20px;" data-html="true" data-placement="top" data-toggle="tooltip" title="" class="toast-header x" onclick="" style="cursor:pointer;background-color: #7f7f7f;color: white;font-size: 9px;" data-original-title="Premios"></i>
				<p class="recf131" id="premios" data-html="true" data-placement="top" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Premios"><?php echo $Premios[1]; ?></p>
				<p class="recf132" id="ferias" data-html="true" data-placement="top" data-toggle="tooltip" title="" class="toast-header x" onclick="" data-original-title="Ferias"><?php echo $Premios[0]; ?></p>
			</div>

		</div>
	<?php
	} else if ($ejeArea == 2 && $idAreaEje == 1) {

		$seguridadControllerAct = new PortadaController();
		$seguridad = $seguridadControllerAct->mostrarSeguridad();

		$cadenaSeguridad = "";
		$ini = 513;

		foreach ($seguridad as $seg) {
			$cadenaSeguridad .= "<div style='top: " . $ini . "px;left: 756px;font-size: 10px;padding:5px;' class='cuadroSec14'>" . $seg->getNombre() . " <b style='position: absolute;right: 9px;'>" . $seg->getTotal() . "</b></div>";
			$ini += 27;
		}
	?>
		<div style="top: 488px;left: 756px;" class="divSec3">Seguridad <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/Seguridad/seguridad.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&menu_seguridad=Indicadores&id_t=Indicadores'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>
		<?php echo $cadenaSeguridad; ?>
	<?php
	} else if ($ejeArea == 2 && $idAreaEje == 2) {
	?>
		<div style="top: 488px;left: 756px;" class="divSec3"> </div>

		<div style="top: 513px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 540px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 567px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 594px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 621px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 648px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 675px;left: 756px;" class="cuadroSec14"></div>

	<?php
	} else if ($ejeArea == 2 && $idAreaEje == 3) {
	?>
		<div style="top: 488px;left: 756px;" class="divSec3">Activo fijo</div>

		<div style="top: 513px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 540px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 567px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 594px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 621px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 648px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 675px;left: 756px;" class="cuadroSec14"></div>
	<?php
	} else if ($ejeArea == 2 && $idAreaEje == 7) {

		$actPiezas = new PortadaController();
		$numExpos = $actPiezas->totalNumeroExpos();
		$totExpos = 0;

		foreach ($numExpos as $expos) {
			$totExpos = $expos->getTotal() - 1;
		}

		$totObras = $actPiezas->totalObras();
		$totP = 0;

		foreach ($totObras as $ob) {
			$totP = $ob->getTotal();
		}

		$totAutores = $actPiezas->totalAutores();
		$totalAutor = 0;

		foreach ($totAutores as $tau) {
			$totalAutor = $tau->getTotal();
		}

		$numColecciones = $actPiezas->totalNumeroColecciones();
		$totColecciones = 0;

		foreach ($numColecciones as $colecc) {
			$totColecciones = $colecc->getTotal();
		}

		$numPaises = $actPiezas->totalPaises();
		$totPaises = 0;

		foreach ($numPaises as $pais) {
			$totPaises = $pais->getTotal();
		}


	?>
		<div style="top: 488px;left: 756px;" class="divSec3">Piezas en exposición temporal <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/Piezas/vista/principal.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>

		<div style="top: 513px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Totales </div>
		<div style="top: 540px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Obras <b style='position: absolute;right: 9px;'><?php echo $totP; ?></b></div>
		<div style="top: 567px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Exposiciones <b style='position: absolute;right: 9px;'><?php echo $totExpos; ?></b></div>
		<div style="top: 594px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Autores <b style='position: absolute;right: 9px;'><?php echo $totalAutor; ?></b></div>
		<div style="top: 621px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Colecciones <b style='position: absolute;right: 9px;'><?php echo $totColecciones; ?></b></div>
		<div style="top: 648px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Países <b style='position: absolute;right: 9px;'><?php echo $totPaises; ?></b></div>
		<div style="top: 675px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14"></div>
	<?php
	} else if ($ejeArea == 2 && $idAreaEje == 9) {

		$noticiaController = new PortadaController();
		$noticias = $noticiaController->mostrarNoticias();

		$cadenaNoticias = "";
		$iniN = 513;

		foreach ($noticias as $not) {
			$cadenaNoticias .= "<div style='top: " . $iniN . "px;left: 756px;font-size: 10px;padding:5px;' class='cuadroSec14'>" . $not->getNombre() . " <b style='position: absolute;right: 9px;'>" . $not->getTotal() . "</b></div>";
			$iniN += 27;
		}
	?>
		<div style="top: 488px;left: 756px;" class="divSec3">Noticias <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/Noticias/Lista_noticias.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>
		<?php echo $cadenaNoticias; ?>
		<div class="cuadroSec14" style="top: 648px;left: 756px;"></div>
		<div style="top: 675px;left: 756px;" class="cuadroSec14"></div>

	<?php
	} else if ($ejeArea == 2 && $idAreaEje == 11) {

		$formController = new PortadaController();
		$formularios = $formController->mostrarFormulario();

		$totalForm = $formularios->getTotal();
		$totalFormN = $formularios->getTotalDos();
		$totalFormE = $formularios->getTotalTres();


	?>
		<div style="top: 488px;left: 756px;" class="divSec3">Formulario micrositio <a data-html="true" data-placement="top" data-toggle="tooltip" title="ver aplicación" style="right: 132px;position: absolute;" href='apps/Opiniones/CuestionarioModigliani/indicadores_encuestas.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&tipoPerfil=<?php echo $idPerfil; ?>'><i class='fa fa-list-alt' aria-hidden='true'></i></a></div>

		<div style="top: 513px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Encuestados totales <b style='position: absolute;right: 9px;'><?php echo $totalForm; ?></b></div>
		<div style="top: 540px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14"> <b style='position: absolute;right: 9px;'></b></b></div>
		<div style="top: 567px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Encuestas a nacionales <b style='position: absolute;right: 9px;'><?php echo $totalFormN; ?></b></div>
		<div style="top: 594px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14"> <b style='position: absolute;right: 9px;'></b></b></div>
		<div style="top: 621px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14">Encuestas a extranjeros <b style='position: absolute;right: 9px;'><?php echo $totalFormE; ?></b></div>
		<div style="top: 648px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14"> <b style='position: absolute;right: 9px;'></b></div>
		<div style="top: 675px;left: 756px;font-size: 10px;padding:5px;" class="cuadroSec14"></div>
	<?php
	} else {
	?>
		<div style="top: 488px;left: 756px;" class="divSec3"></div>
		<div style="top: 514px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 540px;left: 756px;" class="cuadroSec14"></div>

		<div style="top: 567px;left: 756px;" class="cuadroSec14"></div>
		<div style="top: 594px;left: 756px;" class="cuadroSec14"></div>
		<div class="cuadroSec14" style="top: 621px;left: 756px;"></div>
		<div class="cuadroSec14" style="top: 648px;left: 756px;"></div>
		<div style="top: 675px;left: 756px;" class="cuadroSec14"></div>
	<?php
	}
	?>
	<!--------------------->
	<div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content" style="left: -6px;width: 624px;">
				<div class="modal-header h" style="padding: 7px 5px;">
					<button type="button" class="close" data-dismiss="modal" onclick="window.location.reload(true);">&times;</button>
					<center>
						<span style="color:white;"  id="titulo">Asuntos abiertos</span>
					</center>
					 <a style="color:white;text-decoration:none;" class="resul"></a>
				</div>

				<div class="modal-body detalle" style="padding: 5px 5px;">

				</div>

			</div>
			</div>
	</div>
	<div style="top: -5px;" class="modal fade" id="Modal_insumos" role="dialog">
	    <div class="modal-dialog" style="top: 20px;" >
	        <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header h" style="padding: 7px 5px;">
	                <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
	                <span style="font-size: 1.1em;color: white;" id="titulo_modal_insumos">Insumos</span>
	            </div>
	            <div class="modal-body detalleinsumos" style="padding: 10px;"></div>
	        </div>
	    </div>
	</div>
	<div style="top: -5px;" class="modal fade" id="Modal_altaarchivo" role="dialog">
	    <div class="modal-dialog" style="top: 20px;" >
	        <!-- Modal content-->
	        <div class="modal-content" style="width: 770px">
	            <div class="modal-header h" style="padding: 7px 5px;">
	                <button type="button" class="close" data-dismiss="modal" id="cerrar_archivos" style="color: white;">&times;</button>
	                <span style="font-size: 1.1em;color: white;" >Adjuntar archivo</span>
	            </div>

	            <div class="modal-body detallearchivo" style="padding: 10px;">
								<iframe style='display:none;height: 100px;' id='frame' width="100%"  frameborder='0'></iframe>
								<iframe style='display:none;height: 417px;' id='frame_archivos' width="100%"  frameborder='0'></iframe>
	            </div>
	        </div>
	    </div>
	</div>



</body>
<script>
	$('document').ready(function() {
		/*mosaico asuntos*/
		var opcion = "recibido";
		$.post("apps/Asuntos/indexAct.php", {
			action: 'mosaico',
			idArea: '<?php echo $idAreaEje; ?>',
			opcion: opcion,
			anio: '<?php echo $anio; ?>',
			idUsuario: '<?php echo $idUsuario; ?>',
			tipo: 1,
			idEje: 0,
			idAreaU: '<?php echo $idAreaUsuario; ?>'
		}, function(data) {
			$(".imprimeAsuntos").html('');
			$(".imprimeAsuntos").html(data);
		});

		/*mosaico opiniones
		$.post("apps/Opiniones/mosaico.php?idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>&TipoAreaEje=<?php echo $ejeArea; ?>&IdAreaEje=<?php echo $idAreaEje; ?>", {}, function(data) {
			$(".imprimeOpiniones").html('');
			$(".imprimeOpiniones").html(data);
		});
		*/
		$.post("apps/OpinionApp/vista/mosaico.php?idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>&ejeArea=<?php echo $ejeArea; ?>&idEjeArea=<?php echo $idAreaEje; ?>", {}, function(data) {
			$(".imprimeOpiniones").html('');
			$(".imprimeOpiniones").html(data);
		});

		/*grafica actividades*/
		var ejeArea = <?php echo $ejeArea; ?>;
		if (ejeArea == 1) {
			graficaAreas();

		} else {
			graficaEjes();
		}

		$("#entregablesM").click(function() {
			$(".entregablesMenu").attr("hidden", false);
			$(".actividadesMenu").attr("hidden", true);
			$(".metasMenu").attr("hidden", true);
		});

		$("#metasM").click(function() {
			$(".entregablesMenu").attr("hidden", true);
			$(".actividadesMenu").attr("hidden", true);
			$(".metasMenu").attr("hidden", false);
		});

		$("#actividadesM").click(function() {
			$(".entregablesMenu").attr("hidden", true);
			$(".actividadesMenu").attr("hidden", false);
			$(".metasMenu").attr("hidden", true);
		});

		//avancesEntregables();
		muestra_asuntos();

	});
	$("#Modal_altaarchivo").draggable({
	    handle: ".modal-header"
	});
	/***********************************************************************************/
	function entrarResueltos(opcion) {
		location.replace("apps/Asuntos/index.php?ac=10&idUsuario=<?php echo $idUsuario; ?>&idArea=<?php echo $idAreaEje; ?>&anio=<?php echo $anio; ?>&tipo=0&opcion=" + opcion + "&idEje=0&idAreaU=<?php echo $idAreaUsuario; ?>");
	}
	function muestra_asuntos(){

		$('#indicadores_asuntos').load('vista.php?ejearea=<?php echo $eje_area_aux; ?>&idejearea=<?php echo  $idAreaEje; ?>');
	}

	function graficaAreas() {
		var ejeArea = <?php echo $ejeArea; ?>;
		var idAreaEje = <?php echo $idAreaEje; ?>;
		//$('iframe#fr').attr('src','graficasPortada/avances.php?ejeArea='+ejeArea+'&idAreaEje='+idAreaEje);

		$.post("graficasPortada/avances.php", {
			ejeArea: ejeArea,
			idAreaEje: idAreaEje
		}, function(data) {
			$(".frame").html('');
			$(".frame").html(data);
		});



	//	$('iframe#fr2').attr('src', 'graficasPortada/carousel.html');
	}

	function graficaEjes() {
		$('iframe#fr').attr('src', 'graficasPortada/actividades.php?ejeArea=2&idEje=' + <?php echo $idAreaEje; ?>);
		//$('iframe#fr2').attr('src','graficasPortada/metas.php?ejeArea=2&idEje='+<?php echo $idAreaEje; ?>);
	//	$('iframe#fr2').attr('src', 'graficasPortada/carousel.php?idEje=' + <?php echo $idAreaEje; ?>);
	}

	function metasAE(ejeArea) {
		var ejeArea = ejeArea;
		$('iframe#fr').attr('src', 'graficasPortada/metas.php?ejeArea=' + ejeArea + '&idEje=' + <?php echo $idAreaEje; ?>);
	}

	function avancesEntregables() {
		var ejeArea = <?php echo $ejeArea; ?>;
		var idAreaEje = <?php echo $idAreaEje; ?>;
		$.post("graficasPortada/avancesHead.php", {
			tipo: ejeArea,
			idAreaEje: idAreaEje
		}, function(data) {
			$(".entregablesMenu").html('');
			$(".entregablesMenu").html(data);
		});
	}

	/**********************************************************************************/

	function Filtro(valor) {
		var parametros = {
			"valor": valor
		}
		if (isNaN(valor) == true) {
			$("#Todo").load("#cuadroSec14");
		} else {
			$.ajax({
				type: "POST",
				url: "apps/Publicaciones/CambiarDatos.php",
				data: parametros,
				success: function(respuesta) {
					console.log(respuesta);
					var datos = jQuery.parseJSON(respuesta);

					$("#totalcatalogo").text(datos['catalogos']);
					$("#totalcuadernillo").text(datos['cuadernillo']);
					$("#totalLibroautor").text(datos['Librodeautor']);
					$("#totalmemoria").text(datos['Memoria']);
					$("#totalguia").text(datos['Guia']);

					$("#totaltirajecatalogo").text(new Intl.NumberFormat().format(datos['totaltirajeCatalogo']));
					$("#totaltirajecuadernillo").text(new Intl.NumberFormat().format(datos['totaltirajeCuadernillo']));
					$("#totaltirajelibroautor").text(new Intl.NumberFormat().format(datos['totaltirajeLibrodeautor']));
					$("#totaltirajememoria").text(new Intl.NumberFormat().format(datos['totaltirajeMemoria']));
					$("#totaltirajeguia").text(new Intl.NumberFormat().format(datos['totaltirajeGuia']));

					$("#español").text(new Intl.NumberFormat().format(datos['TirajeEspanol']));
					$("#ingles").text(new Intl.NumberFormat().format(datos['TirajeIngles']));

					$("#AuNacional").text(datos['AutorNacional']);
					$("#AuInternacional").text(datos['AutorInternacional']);

					$("#Ineditos").text(datos['Inedito']);
					$("#Publicados").text(datos['PublicadosAnteriormente']);

					$("#ProduccionMPBA").text(parseInt(datos['CONCEPTOINTERNOMPBA']));
					$("#Coproduccion").text(parseInt(datos['COPRODUCCION']));

					$("#ferias").text(datos['ferias']);
					$("#premios").text(datos['premios']);

				},
				error: function() {
					console.log("No se ha podido obtener la información");
					alert('Error: No se pudo obtener la información');
				}
			});
		}
	}

	$(document).ready(function() {

		$('[data-toggle="tooltip"]').tooltip();

		$('.c').click(function(e) {
			e.preventDefault();
			$('.c').removeClass('clMenuAct');
			$(this).addClass('clMenuAct');
		});


	});


	var padre = $(window.parent.document);
	var idAreaUsuario = <?php echo $idAreaUsuario; ?>;
	if (idAreaUsuario == 1 || idAreaUsuario == 5) {

		function notifArea(idAreaNotif, idUsuarioSession, nombreArea) {
			var idAreaNotif = idAreaNotif;
			var idUsuarioSession = idUsuarioSession;
			var nombreArea = nombreArea;


			if (idAreaNotif == 1 && idAreaUsuario == 1 || idAreaNotif == 5 && idAreaUsuario == 5) {
				var idAreaNot = idAreaUsuario;
				var idUsuarioNot = idUsuarioSession;
				$(padre).find('iframe#myiframeNot').attr('src', 'notificaciones/index.php?idArea=' + idAreaNot + '&idUsuario=' + idUsuarioNot);
			} else {
				$(padre).find('iframe#myiframeNot').attr('src', 'notificaciones/indexArea.php?idArea=' + idAreaNotif + '&idUsuario=' + idUsuarioSession + '&nombreArea=' + nombreArea);

			}

		}

	}

	function notifArea() {}

	function Verifica(id_usuario, id_menu) {
		var extra = 'nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&perfil=1&tipoPerfil=1';
		$.post("../WEB-INF/Controllers/Menu/Controler_menu.php", {
				Accion: 'Consulta',
				Id_usuario: id_usuario,
				Id_menu: id_menu
			},
			(data, status) => {
				if (status == "success") {
					let obj = JSON.parse(data);
					if (obj.ruta) {
						url = obj.ruta + extra;
						$(location).attr('href', url);
					} else {
						alert('no cuenta con los permisos necesarios');
					}
				}
			});
	}

</script>

</html>
