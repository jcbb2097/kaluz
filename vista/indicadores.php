<?php

	$tipoPerfil = $_GET["tipoPerfil"];
	$nombreUsuario = $_GET["nombreUsuario"];
	$idUsuario = $_GET["idUsuario"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.INDICADORES.::</title>
	<link rel="stylesheet" type="text/css" href="../resources/font/index.css"/>
	<link rel="stylesheet" type="text/css" href="../resources/css/indicadores.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body >
<div class="well2 ">Indicadores</div>
<div class="well2 wr"><a href="javascript:parent.location.reload();"><img class="imgRegresar" src="../resources/icon/regresarBlanco.png" /></a></div>

	<div style="top: 64px;left: 1px;" class="aplE"><!--a href="apps/Seguridad/inicio.php">Seguridad</a--></div><div style="top: 64px;left: 182px;" class="aplE2"></div><div style="top: 64px;left: 363px;" class="aplE2"></div><div style="top: 64px;left: 544px;" class="aplE2"></div><div style="top: 64px;left: 725px;" class="aplE2"></div>
	<div style="top: 117px;left: 1px;" class="aplE"><!--a href="indicadores/actividadesMetas/index.php">Actividades y Metas</a><br-->
		<!--a href="indicadores/entregablesInsumos/index.php">Entregables</a><br-->
		<!--a href="indicadores/entregablesInsumos/insumos.php">Insumos</a-->
		<a href='cruceskpi.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>'>KPI´s</a>
		</div><div style="top: 117px;left: 182px;" class="aplE"><!--a href="indicadores/logros/index.php">Logros 2020</a--></div><div style="top: 117px;left: 363px;" class="aplE"><!--a href="indicadores/dash/index.php">Asuntos dashboard</a><br--><a href="indicadores/Entregables/Dashboard_entregables.php?estatus=1">Entregables dashboard</a></div><div style="top: 117px;left: 544px;" class="aplE"><!--a href="indicadores/AcuerdosEscritos/portada_acuerdos_indicadores.php">Acuerdos Escritos</a--></div><div style="top: 117px;left: 725px;" class="aplE"><!--a href="indicadores/Archivos_entregables/portada_indicadores_arch_entre.php">Archivos Entregables</a><br><a href="indicadores/Archivos_compartidos/portada_indicadores_arch_compa.php">Archivos Compartidos</a><br><a href="indicadores/Archivos_normatividad/portada_indicadores_arch_norma.php">Archivos Normatividad</a--></div>
	<div style="top: 170px;left: 1px;" class="aplE"></div><div style="top: 170px;left: 182px;" class="aplE2"></div><div style="top: 170px;left: 363px;" class="aplE2"></div><div style="top: 170px;left: 544px;" class="aplE2"></div><div style="top: 170px;left: 725px;" class="aplE2"></div>
	<div style="top: 223px;left: 1px;" class="aplE"></div><div style="top: 223px;left: 182px;" class="aplE"></div><div style="top: 223px;left: 363px;" class="aplE"></div><div style="top: 223px;left: 544px;" class="aplE"><!--a href="indicadores/Juridico/portada_indicadores_juridico.php">Jurídico</a><br><a href="indicadores/Transparencia/portada_indicadores_transparencia.php">Transparencia</a--></div><div style="top: 223px;left: 725px;" class="aplE"></div>
	<div style="top: 276px;left: 1px;" class="aplE"></div><div style="top: 276px;left: 182px;" class="aplE"></div><div style="top: 276px;left: 363px;" class="aplE2"></div><div style="top: 276px;left: 544px;" class="aplE2"></div><div style="top: 276px;left: 725px;" class="aplE2"></div>
	<div style="top: 329px;left: 1px;" class="aplE2"></div><div style="top: 329px;left: 182px;" class="aplE2"></div><div style="top: 329px;left: 363px;" class="aplE2"></div><div style="top: 329px;left: 544px;" class="aplE2"></div><div style="top: 329px;left: 725px;" class="aplE2"></div>
	<div style="top: 382px;left: 1px;" class="aplE"><!--a href="apps/Piezas/vista/principal.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">Piezas en exposición temporal</a--></div><div style="top: 382px;left: 182px;" class="aplE2"></div><div style="top: 382px;left: 363px;" class="aplE2"></div><div style="top: 382px;left: 544px;" class="aplE2"></div><div style="top: 382px;left: 725px;" class="aplE2"></div>
	<div style="top: 435px;left: 1px;" class="aplE"><!--a href="apps/MetricasOpiniones/portada_indicadores.php">Opiniones</a><br><a href="indicadores/Opiniones/indicadores_opiniones.php?nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>&titulo=4&estatus=1">Opiniones globales</a--></div><div style="top: 435px;left: 182px;" class="aplE"></div><div style="top: 435px;left: 363px;" class="aplE"></div><div style="top: 435px;left: 544px;" class="aplE"></div><div style="top: 435px;left: 725px;" class="aplE"></div>
	<div style="top: 488px;left: 1px;" class="aplE"></div><div style="top: 488px;left: 182px;" class="aplE"><!--a href="indicadores/Noticias/portada_indicadores_noticias.php">Noticias</a--></div><div style="top: 488px;left: 363px;" class="aplE"></div><div style="top: 488px;left: 544px;" class="aplE"></div><div style="top: 488px;left: 725px;" class="aplE"></div>
	<div style="top: 541px;left: 1px;" class="aplE"><!--a href="apps/Publicaciones/Vista.php">Publicaciones</a--></div><div style="top: 541px;left: 182px;" class="aplE2"></div><div style="top: 541px;left: 363px;" class="aplE2"></div><div style="top: 541px;left: 544px;" class="aplE2"></div><div style="top: 541px;left: 725px;" class="aplE2"></div>
	<div style="top: 594px;left: 1px;" class="aplE2"></div><div style="top: 594px;left: 182px;" class="aplE2"></div><div style="top: 594px;left: 363px;" class="aplE2"></div><div style="top: 594px;left: 544px;" class="aplE2"></div><div style="top: 594px;left: 725px;" class="aplE2"></div>
</body>
</html>
