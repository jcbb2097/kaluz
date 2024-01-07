<?php
	/*created by leasim*/
	//include_once __DIR__."/../source/controller/PermisoController.php";

	//include_once __DIR__."/../../../../vista/session.php";
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title></title>
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
	<link rel="stylesheet" type="text/css" href="../resources/css/fileinput.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../../../resources/css/loading.css"/>
	<!--
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
	-->
	
	<link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.2.0/css/scroller.dataTables.min.css">
	

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
	<!--
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
	-->
	<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.2.0/js/dataTables.scroller.min.js"></script>
	
	

	<!--<script src="../resources/js/bootstrap-select.js"></script>-->
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
	
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="../resources/js/fileinput.min.js"></script>
	<script src="../resources/js/locales/es.js" type="text/javascript"></script>
 
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

.resalta:hover{
	background-color: #fff !important;
	color:black !important;
}

.clClick{
	background-color: #fff !important;
	color:black !important;
}

.dropdown-menu .divider {
    height: 1px;
    margin: 0px 0;
    overflow: hidden;
    background-color: #e5e5e5;
}
</style>
 
</head>
<body style='overflow-x: hidden;'>
<div class="loading"></div>
<div class="well well-sm"><a style="color:#000;" href="../../../aplicaciones.php?tipoPerfil=<?php echo $tipoPerfil; ?>&idUsuario=<?php echo $idUsuario; ?>&nombreUsuario=<?php echo $nombreUsuario; ?>">Aplicaciones</a> / calculadora </div>
<div class="well2 wr">
	

</div>

<div class="container-fluid">
<div class='row'>
	<div class='col-md-2 col-sm-2 col-xs-12'>
	</div>
	<div class='col-md-8 col-sm-8 col-xs-12'>
		<div class="form-group">
			<label for="inputsm">Régimen fiscal de quien me factura</label>
			<select id="regimen" name="regimen" class="form-control input-sm ">
				<option value=''>seleccione...</option>
				<option value='1'>Persona moral</option>
				<option value='2'>Persona física con actividad empresarial</option>
				<option value='3'>Persona física con actividad profesional</option>
				<option value='4'>Resico empresarial</option>
				<option value='5'>Resico profesional</option>
				
			</select>
		</div>
	</div>
	<div class='col-md-2 col-sm-2 col-xs-12'>
	</div>
</div>

<div class=''>
	<div class='row'>
	<div class='col-md-2 col-sm-2 col-xs-12'>
	</div>
	
	<div class='col-md-8 col-sm-8 col-xs-12 view'>
	</div>
	
	<div class='col-md-2 col-sm-2 col-xs-12'>
	</div>
	</div>

</div>
</div>

</body>

<script>

$("#regimen" ).change(function() {
		var regimen = $("#regimen").val();
		
		if(regimen == 1)
		{
			$.post("personaMoral.php",{}, function( data ) 
			{
				$(".view").html('');
				$(".view").html(data);
			});
		} if(regimen == 2){
			$.post("personaFisicaAE.php",{}, function( data ) 
			{
				$(".view").html('');
				$(".view").html(data);
			});
			
		}if(regimen == 3){
			$.post("personaFisicaAP.php",{}, function( data ) 
			{
				$(".view").html('');
				$(".view").html(data);
			});
		}if(regimen == 4){
			$.post("resicoEmp.php",{}, function( data ) 
			{
				$(".view").html('');
				$(".view").html(data);
			});
		}if(regimen == 5){
			$.post("resicoPro.php",{}, function( data ) 
			{
				$(".view").html('');
				$(".view").html(data);
			});
		}
		else{
			$(".view").html('');
		
		}
		
	});


</script>
</html>