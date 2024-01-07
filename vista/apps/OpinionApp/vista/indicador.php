<?php
/*created by leasim*/
	include_once __DIR__."/../source/controller/IndicadorController.php";
	
	$idUsuario = $_POST["idUsuario"];
	
	$act = new IndicadorController();

	$totalOpinion = $act -> mostrarTotalOpiniones();
	$totalOp = $totalOpinion -> getTotal(); 

	$opinionesAnio = $act -> mostrarOpinionesAnio();
	$cadena = "";
	$totalAtenCon = 0;
	$percentAtencion = 0;
	$totalOpT = 0;
	$totalSTT = 0;
	$totalPT = 0;
	$totalACT = 0;
				
	foreach ($opinionesAnio as $opAnio)
	{
		$totalAtenCon = $opAnio -> getAtendida() + $opAnio -> getConcluida();
		if($opAnio -> getTotal() > 0){
			$percentAtencion = ($totalAtenCon * 100) / $opAnio -> getTotal();
		}else{
			$percentAtencion = 0;
		}
		
		$cadena.="<tr>"
				."<td>".$opAnio -> getDescripcion()."</td>"
				."<td style='text-align: center;'>".$opAnio -> getTotal()."</td>"
				."<td style='text-align: center;'>".$opAnio -> getSinTurnar()."</td>"
				."<td style='text-align: center;'>".$opAnio -> getProceso()."</td>"
				."<td style='text-align: center;'>".$totalAtenCon."</td>"
				."<td style='text-align: center;'><meter min='0' max='100' low='15' high='99' optimum='100' value='".$percentAtencion."'></meter> <a class='numb'>".number_format($percentAtencion, 1, '.', '')." %</a></td>"
				."</tr>";
		$totalOpT = $totalOpT + $opAnio -> getTotal();
		$totalSTT = $totalSTT + $opAnio -> getSinTurnar();
		$totalPT = $totalPT + $opAnio -> getProceso();
		$totalACT = $totalACT + $totalAtenCon;
		
	}
	$percentGeneralInd = 0.0;
	if($totalOpT > 0){
		$percentGeneralInd = ($totalACT * 100) /  $totalOpT ;

	}else{
		$percentGeneralInd = 0.0;
	}

	$cadena .= "<tr><td></td><td class='tdTotales'>".$totalOpT."</td><td class='tdTotales'>".$totalSTT."</td><td class='tdTotales'>".$totalPT."</td><td class='tdTotales'>".$totalACT."</td><td class='tdTotales'><meter min='0' max='100' low='15' high='99' optimum='100' value='".$percentGeneralInd."'></meter> <a style='color:white;' class='numb'>".number_format($percentGeneralInd, 1, '.', '')." %</a></td></tr>";

	$opinionesTipo = $act -> mostrarOpinionesTipo();
	$cadena2 = "";
				
	foreach ($opinionesTipo as $tipo)
	{
		$cadena2 .="<tr>"
				."<td>".$tipo -> getDescripcion()."</td>"
				."<td style='text-align: center;'>".$tipo -> getTotal()."</td>"
				."</tr>";
	}

	$opinionesOrigen = $act -> mostrarOpinionesOrigen();
	$cadena3 = "";
				
	foreach ($opinionesOrigen as $opOrigen)
	{
		$cadena3 .="<tr>"
				."<td>".$opOrigen -> getDescripcion()."</td>"
				."<td style='text-align: center;'>".$opOrigen -> getTotal()."</td>"
				."</tr>";
	}
	
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Indicador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <style>
	div.dt-buttons {
		position: relative;
		float: left;
		top: 33px;
		z-index: 100;
	}
	table.dataTable thead .sorting::after {
		opacity: 1;
	}
	.labelC{
		font-family: 'Muli-SemiBold';
		border-radius: 0px;
		font-size: 10px;
		padding: 5px;
		color:white;
		background-color:#4d4d57;
	}
	
	/*jquery confirm*/
	
	.jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {
		font-size: 12px;
		font-family: 'Muli-Bold';
	}
	
	.btnC{
		font-size: 11px !important;
		border-radius: 0px !important;
		font-family: 'Muli-SemiBold';
	}
	
	/**/
	
	.form-control{
		border-radius: 0px;
		font-size: 12px;
		height: 25px;
		font-family: 'Muli-Regular';
	}
	
	label{
		font-size: 12px;
		font-family: 'Muli-Bold';
	}

	.totalOpinion{
		font-family: 'Muli-Bold';
    	font-size: 11px;
	}

	.titulosIndica{
		font-size: 12px;
		font-family: 'Muli-Bold';
		text-align: center;
	}

	.clnav{
		font-size: 11px;
    	font-family: 'Muli-Bold';
	}

	.numb{
		text-decoration: none !important;
    	color: black;
	}

	.tdTotales{
		background-color: #4d4d57;
		color: white;
		text-align: center;
		font-size: 9.5px;
		padding: 2px !important;
		font-family: 'Muli-SemiBold';
	}
  </style>
</head>
<body>
<div class="container-fluid" >
	<div class='row'>
		<div class="col-md-5 col-sm-5 col-xs-12">
			<p class='totalOpinion'>Total de opiniones:  <?php echo $totalOp; ?></p>
		</div>
	</div>
	<!--
	<div class='row'>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<ul class="nav nav-tabs clnav">
				<li class="active"><a data-toggle="tab" href="#menu1">Por turnar</a></li>
				<li><a data-toggle="tab" href="#menu2">En proceso de atención</a></li>
				<li><a data-toggle="tab" href="#menu3">Atendidas - Concluidas</a></li>
			</ul>
  		</div>
	</div>
	<br><br>-->
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<p class='titulosIndica'><span class="label label-default">Opiniones por Año</span></p>
			<div class="table-responsive">
				<table id="opinionAnio" class="table table-striped table-bordered table-condensed"  width="100%">
					<thead style="font-size:10px;background-color: #4d4d57;color: white;font-family: 'Muli-SemiBold';">
						<tr>
							<th>Año</th>
							<th style='text-align:center;'>Total</th>
							<th style='text-align:center;'>Por turnar</th>
							<th style='text-align:center;'>En proceso de atención</th>
							<th style='text-align:center;'>Atendidas-Concluidas</th>
							<th style='text-align:center;'>% de atención</th>
						</tr>
					</thead>
					<tbody style="font-size:10px">
					<?php
						echo $cadena;
					?>	 	
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="actualizaDiv">
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12" id="grafica1">
				
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12" id="grafica2">
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" id="grafica3">
				
			</div>
			
		</div>
	</div>
</div>


<style>
.text-wrap{
    white-space:normal;
}
.width-50{
    width:40px;
}
</style>
<script>
$(function()
{
	$.post("grafica/origen.php",{idUsuario:<?php echo $idUsuario; ?>}, function( data ) {
		$("#grafica1").html('');
		$("#grafica1").html(data);
	});
	
	$.post("grafica/tipo.php",{idUsuario:<?php echo $idUsuario; ?>}, function( data ) {
		$("#grafica2").html('');
		$("#grafica2").html(data);
	});
	
	$.post("grafica/eje.php",{idUsuario:<?php echo $idUsuario; ?>}, function( data ) {
		$("#grafica3").html('');
		$("#grafica3").html(data);
	});
	
});





$(document).ready(function() {

	var table = $('#opinionAnio').DataTable();
	table.destroy();
	
	
	var table = $('#opinionAnio').DataTable(
	{
		pageLength: 100,
		"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todo"]],
		
		"language": 
		{
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
		dom: '',
		buttons: [
           
           
        ],
        /*buttons: [
            //'copy', 'csv', 'excel', 'print'
			'excel'
        ],*/
		"scrollX": true,
		"order": [[ 0, "desc" ]],
		responsive: false,
		"scrollY":        "370px",
        "scrollCollapse": true,
        "paging": true,
		columnDefs:[
            
        ]
		
		
		
	});	
	
	
	
	var table = $('#tipoOpinion').DataTable();
	table.destroy();
	
	
	var table = $('#tipoOpinion').DataTable(
	{
		pageLength: 100,
		"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todo"]],
		
		"language": 
		{
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
		dom: 'rt',
		buttons: [
           
           
        ],
        /*buttons: [
            //'copy', 'csv', 'excel', 'print'
			'excel'
        ],*/
		"scrollX": true,
		"order": [[ 0, "asc" ]],
		responsive: false,
		"scrollY":        "250px",
        "scrollCollapse": true,
        "paging": true,
		columnDefs:[
            
        ]
		
		
		
	});	

	var table = $('#origenOpinion').DataTable();
	table.destroy();
	
	
	var table = $('#origenOpinion').DataTable(
	{
		pageLength: 100,
		"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todo"]],
		
		"language": 
		{
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
		dom: 'rt',
		buttons: [
           
           
        ],
        /*buttons: [
            //'copy', 'csv', 'excel', 'print'
			'excel'
        ],*/
		"scrollX": true,
		"order": [[ 0, "asc" ]],
		responsive: false,
		"scrollY":        "250px",
        "scrollCollapse": true,
        "paging": true,
		columnDefs:[
            
        ]
		
		
		
	});	
	
	
});




</script>

</body>
</html>
