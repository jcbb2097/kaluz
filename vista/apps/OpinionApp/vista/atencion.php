<?php
	/*created by leasim*/
/*
	include_once __DIR__."/../source/controller/ObraController.php";
	include_once __DIR__."/../source/controller/IndicadorController.php";
	include_once __DIR__."/../source/controller/ExposicionController.php";

*/	
	//include_once __DIR__."/../../../../vista/session.php";
	include_once __DIR__."/../source/controller/OpinionController.php";
	include_once __DIR__."/../source/controller/IndicadorController.php";

	$idUsuario = $_GET["idUsuario"];
	$ejeArea = $_GET["ejeArea"];
	$idEjeArea = $_GET["idEjeArea"];
	$cadenaValorObtiene = isset($_GET["cadenaValor"]) ? $_GET["cadenaValor"] : 1;
	$nombreAreaEje = "";

	$styleBtn = "";

	if($cadenaValorObtiene == 1){
		$styleBtn = "";
	}

	$act = new OpinionController();
	$actInd = new IndicadorController();

	$totalNoAtendidas = 0;
	$cadenaTipos = "";
	$sinCorreo = 0;
	$conCorreo = 0;

	if($ejeArea == 1){
		$area = $act -> mostrarNombreArea($idEjeArea);
		$orden = $area-> getOrden();
		$nombre = $area-> getNombreArea();

		$noAtendidas = $actInd -> mostrarTotalNoAtendidasArea($idEjeArea);
		$totalNoAtendidas = $noAtendidas -> getTotal();

		$tipos = $actInd -> mostrarTotalTipoNoAtendidasArea($idEjeArea);

		$correo = $actInd -> mostrarTotalCorreoNoAtendidasArea($idEjeArea);
		$sinCorreo = $correo ->getSinCorreo();
		$conCorreo = $correo ->getConCorreo();

		$nombreAreaEje = "Área ";

	}else{
		
		$eje = $act -> mostrarNombreEje($idEjeArea);
		$orden = $eje-> getOrden();
		$nombre = $eje-> getNombreEje();

		$noAtendidas = $actInd -> mostrarTotalNoAtendidasEje($idEjeArea);
		$totalNoAtendidas = $noAtendidas -> getTotal();

		$tipos = $actInd -> mostrarTotalTipoNoAtendidasEje($idEjeArea);

		$correo = $actInd -> mostrarTotalCorreoNoAtendidasEje($idEjeArea);
		$sinCorreo = $correo ->getSinCorreo();
		$conCorreo = $correo ->getConCorreo();

		$nombreAreaEje = "Eje ".$orden;

	}

	$cadenaValor = "";
	foreach($tipos as $tipo)
	{
		if($tipo->getIdTipo() == 1)
		{
			$cadenaValor = "2";
			if($cadenaValorObtiene == 2){
				$styleBtn = " clClick ";
			}else{
				$styleBtn = "";
			}
		}else if($tipo->getIdTipo() == 2)
		{
			$cadenaValor = "3";
			if($cadenaValorObtiene == 3){
				$styleBtn = " clClick ";
			}else{
				$styleBtn = "";
			}
		}else if($tipo->getIdTipo() == 3)
		{
			$cadenaValor = "4";
			if($cadenaValorObtiene == 4){
				$styleBtn = " clClick ";
			}else{
				$styleBtn = "";
			}
		}

		$cadenaTipos .= "<button onclick='atencionRespuesta(".$idUsuario.",".$ejeArea.",".$idEjeArea.",".$cadenaValor.");' type='button' class='btnOpinion btn btn-default btn-xs c ".$styleBtn."'>".$tipo->getNombre()." <b style='font-family: Muli-Regular;'> ".$tipo->getTotal()."</b></button> ";
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Seguridad</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
	<link rel="stylesheet" type="text/css" href="../../../../resources/css/loading.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"/>
	<link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<!--<link href="../resources/css/bootstrap-select.css" rel="stylesheet">-->
	<link rel="stylesheet" type="text/css" href="../../../../resources/font/index.css"/>
	<link rel="stylesheet" type="text/css" href="../../../../resources/css/scroll.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="../../../../resources/css/fileinput.min.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

	<!--<script src="../resources/js/bootstrap-select.js"></script>-->
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	<script src="../../../../resources/js/fileinput.min.js"></script>
	<script src="../../../../resources/js/locales/es.js" type="text/javascript"></script>
	<style>
 
	.dataTables_scrollBody::-webkit-scrollbar {
		-webkit-appearance: none;
	}

	.dataTables_scrollBody::-webkit-scrollbar:vertical {
		width:5px;
	}

	.dataTables_scrollBody::-webkit-scrollbar-button:increment,.dataTables_scrollBody::-webkit-scrollbar-button {
		display: none;
	} 

	.dataTables_scrollBody::-webkit-scrollbar:horizontal {
		height: 5px;
	}

	.dataTables_scrollBody::-webkit-scrollbar-thumb {
		background-color: #cbcbca;
		border-radius: 4px;
		border: 1px solid #5a274f;
	}

	.dataTables_scrollBody::-webkit-scrollbar-track {
		border-radius: 10px;  
	}
	
	.seleccion{
		color: #ffffff !important;
		background-color: #5d2852 !important;
		border-radius: 0px !important;
	}

	.titleRuta{
		font-size: 11px;
    font-family: 'Muli-Bold';
	}
	</style>
	<style>
	/*general*/
	body {
    font-family: Muli-Regular;
}

.well-sm {
    padding: 9px;
}

.well {
    min-height: 20px;
    font-family: Muli-SemiBold;
    font-size: 11px;
    padding: 8px;
    margin-bottom: 20px;
    background-color: rgb(211, 211, 211);
    border: 1px solid rgb(211, 211, 211);
    border-radius: 0px;
    color: rgb(0, 0, 0);
    box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 1px inset;
}

.well2 {
    min-height: 20px;
    font-family: Muli-SemiBold;
    font-size: 11px;
    padding: 8px;
    margin-bottom: 20px;
    background-color: rgb(90, 39, 79);
    border: 1px solid rgb(90, 39, 79);
    border-radius: 0px;
    color: rgb(254, 254, 254);
    box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 1px inset;
}

.wr {
    background-color: rgb(77, 77, 87);
    border: 1px solid rgb(77, 77, 87);
    margin-top: -20px;
    height: 31px;
}

.imgRegresar {
    cursor: pointer;
    width: 15px;
    height: 15px;
}

table#example {
    font-family: Muli-Regular;
    font-size: 11px;
}

thead {
    background-color: rgb(203, 203, 202);
}

.pass {
    -webkit-text-security: circle;
}

.dataTables_info {
    font-size: 11px;
    border-radius: 0px;
}

.dataTables_length {
    font-size: 11px;
    border-radius: 0px;
    position: relative;
    top: 35px;
    width: 400px;
}

.pagination {
    font-size: 11px;
}

.dataTables_filter {
    font-size: 11px;
}

.dropdown-menu {
    font-size: 11px;
    font-family: Muli-Regular;
}

.input-sm {
    border-radius: 0px;
}

.pagination > li:first-child > a, .pagination > li:first-child > span {
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
    color: rgb(0, 0, 0);
}

.pagination > li:last-child > a, .pagination > li:last-child > span {
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
    color: rgb(0, 0, 0);
}

.pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
    background-color: rgb(90, 39, 79);
    border-color: rgb(90, 39, 79);
}

.pagination > li > a, .pagination > li > span {
    color: rgb(0, 0, 0);
}


.select2-results {
    display: block;
    font-size: 10px;
    font-family: 'Muli-SemiBold';
}

.select2-container--default .select2-results>.select2-results__options {
    /*max-height: 100px;*/
    overflow-y: auto;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    font-size: 10px;
}

.btnC{
	font-size: 10px !important;
	border-radius: 0px !important;
	font-family: 'Muli-SemiBold';
	padding: 3px 7px 2px !important;
	text-transform: none !important;
}

.jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {
    font-size: 11px;
    font-family: 'Muli-Bold';
}

.btnOpinion{
	font-family: 'Muli-SemiBold';
    font-size: 11px;
    width: 100px;
}

.clClick{
	background-color: black !important;
    color: white !important;
}
</style>
 
</head>
<body style='overflow-x: hidden;'>
<div class="loading"></div>
<div class="well well-sm">Opiniones / Atención de opiniones</div>
<div class="well2 wr">
	<!--
	<a style="color:white;cursor:pointer; position: relative; top: -5px;" href="../../../aplicaciones.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>"><i class="fas fa-long-arrow-alt-left"></i></a>
	<button onclick='indicador(<?php echo $idUsuario; ?>);' style="font-family: 'Muli-Regular';background-color: #4d4d57;height: 30px;font-size: 11px;position: relative;top: -8px;left: 15px;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Indicador</button>
		
	<div style='position:relative;top: -38px;left: 102px;' class="dropdown">
		<button style="font-family: 'Muli-Regular';background-color: #4d4d57;height: 30px;font-size: 11px;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Catálogos
		<span class="caret"></span></button>
	</div>
	
	<div style='position:relative;top: -68px;left: 192px;' class="dropdown">
		<button style="font-family: 'Muli-Regular';background-color: #4d4d57;height: 30px;font-size: 11px;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Opiniones
		<span class="caret"></span></button>
		<ul style="font-family: 'Muli-SemiBold';font-size: 11px;" class="dropdown-menu">
			<li class="dropdown-header"></li>
			<li><a style='cursor:pointer;' onclick='mostrarCentral(<?php echo $idUsuario; ?>,"Opiniones / Central");' >Central</a></li>
			
		</ul>
	</div>

	<div style='position:relative;top: -98px;left: 281px;' class="dropdown">
		<button style="font-family: 'Muli-Regular';background-color: #4d4d57;height: 30px;font-size: 11px;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Registro
		<span class="caret"></span></button>
		<ul style="font-family: 'Muli-SemiBold';font-size: 11px;" class="dropdown-menu">
			
			<li><a style='cursor:pointer;' onclick='registroEscrita(<?php echo $idUsuario; ?>,"Registro / Opinión Libro");' >Opinión Libro</a></li>
		</ul>
	</div>

	<?php if($idUsuario == 1143) {?>
	<div style='position:relative;top: -128px;left: 361px;' class="dropdown">
		<button style="font-family: 'Muli-Regular';background-color: #4d4d57;height: 30px;font-size: 11px;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Reportes
		<span class="caret"></span></button>
		<ul style="font-family: 'Muli-SemiBold';font-size: 11px;" class="dropdown-menu">
			<li class="dropdown-header"></li>
			<li><a style='cursor:pointer;' onclick='mostrarReporteArea(<?php echo $idUsuario; ?>,"Opiniones / Reportes");' >Por área</a></li>
			
		</ul>
	</div>
	<?php } ?>
	-->
</div>

<div class="container-fluid" style='margin-top: -15px;'>
	<div class="row ruta">
		<div class="col-md-12 col-sm-12 col-xs-12 titleRuta">
		<?php echo $nombreAreaEje.".- ".$nombre; ?> / <b onclick="atencionRespuesta(<?php echo $idUsuario; ?>,<?php echo $ejeArea; ?>,<?php echo $idEjeArea; ?>,1);" style='color:red;cursor:pointer;'>Opiniones no atendidas :</b> <?php echo $totalNoAtendidas; ?>
		</div>
	</div><br>
	<div class='row' style='margin-top: -7px;'>
		<div class='col-md-12 col-sm-12 col-xs-12' style='text-align:center;'>
			<?php echo $cadenaTipos; ?>
			<button onclick="atencionRespuesta(<?php echo $idUsuario; ?>,<?php echo $ejeArea; ?>,<?php echo $idEjeArea; ?>,5);" type='button' class='btnOpinion btn btn-default btn-xs c  <?php if($cadenaValorObtiene == 5){ echo " clClick ";}else{ } ?>'>Con correo <b style='font-family: Muli-Regular;'> <?php echo $conCorreo;?></b></button>
			<button onclick="atencionRespuesta(<?php echo $idUsuario; ?>,<?php echo $ejeArea; ?>,<?php echo $idEjeArea; ?>,6);" type='button' class='btnOpinion btn btn-default btn-xs c  <?php if($cadenaValorObtiene == 6){ echo " clClick ";}else{  } ?>' >Sin correo <b style='font-family: Muli-Regular;'> <?php echo $sinCorreo;?></b></button>
		
		</div>
		
	</div>
	<div class='view'>

	</div>
</div>

</body>
<script>

$(function()
{
	atencionRespuesta(<?php echo $idUsuario; ?>,<?php echo $ejeArea; ?>,<?php echo $idEjeArea; ?>,<?php echo $cadenaValorObtiene; ?>);
});

function atencionRespuesta(idUsuario,ejeArea,idEjeArea,cadena){
	var idUsuario = idUsuario;
	var ejeArea = ejeArea;
	var idEjeArea = idEjeArea;
	var cadena = cadena;
	
	$('.loading').html("<div class='loader'><div class='info'>Cargando información</div></div>");
	$.post("respuesta/index.php",{idUsuario:idUsuario,ejeArea:ejeArea,idEjeArea:idEjeArea,cadena:cadena}, function( data ) {
		$(".view").html('');
		$(".view").html(data);
		$(".loading").fadeIn(1000).html('');
	});
}

function mostrarCentral(idUsuario,titulo){
	var idUsuario = idUsuario;
	var titulo = titulo;
	$.post("central/index.php",{idUsuario:idUsuario,titulo:titulo}, function( data ) {
		$(".view").html('');
		$(".view").html(data);
	});
}

function mostrarRegistroView(idUsuario,titulo){
	var idUsuario = idUsuario;
	var titulo = titulo;
	$.post("registrar/dispositivoMostrar.php",{idUsuario:idUsuario,titulo:titulo}, function( data ) {
		$(".view").html('');
		$(".view").html(data);
	});
}

function mostrarReporteArea(idUsuario,titulo){
	var idUsuario = idUsuario;
	var titulo = titulo;
	$.post("reporte/index.php",{idUsuario:idUsuario,titulo:titulo}, function( data ) {
		$(".view").html('');
		$(".view").html(data);
	});
}


function registroEscrita(idUsuario,titulo)
{
	var titulo = titulo;
	var idUsuario = idUsuario;
	$.confirm({
		type: 'dark',
		typeAnimated: true,
		boxWidth: '600px',
		useBootstrap: false,
		title: titulo,
		content: 'url:registro/frmOpinionLibro.php?idUsuario='+idUsuario,
		buttons: {
			formSubmit: {
				text: 'Guardar',
				btnClass: 'btn-green btnC',
				action: function () {
					var fecha = this.$content.find('#fecha').val();
					var descripcion = this.$content.find('#descripcion').val();
					if(!fecha){
						$.alert({
							title: 'Verifique datos',
							content: 'Seleccione fecha!',
							type:'red',
						});
						return false;
					}
					
					if(!descripcion){
						$.alert({
							title: 'Verifique datos',
							content: 'Ingrese descripción de la opinión!',
							type:'red',
						});
						return false;
					}
					
					var posting = $.post("../source/controller/OpinionFrontController.php",$("#frmOpinionLibro").serialize()+"&action=guardar");
		
					posting.done(function(data)
					{
						if(data == 1)
						{
							$.alert({
								title: 'Opinión Libro',
								content: 'Registro exitoso!',
								type:'green',
							});
							
							mostrarCentral(idUsuario,'Opiniones / Central');  
							
						}else{
							$.alert({
								title: 'Opinión Libro',
								content: 'No se pudo guardar registro!, intente nuevamente',
								type:'red',
							});

						}
					});
				}
			},
			cancelar: {
				btnClass: 'btn-danger btnC',
			},
			
		},
		onContentReady: function () {
			// bind to events
			var jc = this;
			this.$content.find('form').on('submit', function (e) {
				// if the user submits the form by pressing enter in the field.
				e.preventDefault();
				jc.$$formSubmit.trigger('click'); // reference the button and click it
			});
		}
	});
}

$(document).ready(function(){
	$('.c').click(function(e) {
		e.preventDefault();
		$('.c').removeClass('clClick');
		$(this).addClass('clClick');
	});
});
</script>
</html>