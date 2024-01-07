<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/OpinionController.php";
	include_once __DIR__."/../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../source/controller/AreaController.php";
	include_once __DIR__."/../../source/controller/ReporteController.php";
	
	$idUsuario = $_POST["idUsuario"];
	$titulo = $_POST["titulo"];
	$tipo = $_POST["tipo"];
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title></title>
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
	
	.titleRuta{
		font-size: 11px;
    font-family: 'Muli-Bold';
	}
	
	.pInd{
		font-size: 11px;
		font-family: 'Muli-SemiBold';
	}
	
	.httli{
		font-size: 11px;
		font-family: 'Muli-Bold';
		
	}

	.namePerson{
		font-family: 'Muli-Bold';
    	font-size: 8px;
	}

	.tftable{
		background-color: #4d4d57;
		color: white;
		font-size: 10px;
		font-family: 'Muli-SemiBold';
	}

	.numb{
		text-decoration: none !important;
    	color: black;
		font-size: 7.5px;

	}

	.selectT{
		height: 26px !important;
		font-size: 10px !important;
		font-family: 'Muli-SemiBold' !important;
	}
  </style>
</head>
<body>
<div class="container-fluid" >
	<div class="row ruta">
		<div class="col-md-12 col-sm-12 col-xs-12 titleRuta">
			<?php echo $titulo; ?> 
		</div>
	</div>
	<div class="row" style="position: relative;top: 20px;">
		<div style='' class="col-md-3 col-sm-3 col-xs-12">
			<div class="form-group">
				
				<select id="anio" name="anio" class="form-control input-sm selectT">
					<option value=''>seleccione año</option>
					<option value='2020'>2020</option>
					<option value='2021'>2021</option>
					<option value='2022'>2022</option>
					<option value='2023'>2023</option>
					<option value='2024'>2024</option>
					<option value='0' selected>Todos los años</option>
				</select>
			</div>
		</div>
	</div>
	<div class='actualizaReport'>

	</div>
	
</div>

<script>
$(function()
{
	var tipo = <?php echo $tipo; ?>;
	if(tipo == 1){
		$.post("reporte/reporteArea.php",{idUsuario:<?php echo $idUsuario; ?>,anio:0}, function( data ) {
			$(".actualizaReport").html('');
			$(".actualizaReport").html(data);
		});

	}else if(tipo == 2){
		$.post("reporte/reporteEje.php",{idUsuario:<?php echo $idUsuario; ?>,anio:0}, function( data ) {
			$(".actualizaReport").html('');
			$(".actualizaReport").html(data);
		});
	}
	
});

$(document).ready(function(){
	$( "#anio" ).change(function() {
		var anio = $("#anio").val();
		var idUsuario = <?php echo $idUsuario; ?>; 
		var tipo = <?php echo $tipo; ?>; 
		
		if(tipo == 1){
			$.post("reporte/reporteArea.php",{idUsuario:idUsuario,anio:anio}, function( data ) 
			{
				$(".actualizaReport").html('');
				$(".actualizaReport").html(data);
			});
		}else if(tipo == 2){
			$.post("reporte/reporteEje.php",{idUsuario:idUsuario,anio:anio}, function( data ) 
			{
				$(".actualizaReport").html('');
				$(".actualizaReport").html(data);
			});
		}
			
	});

});
</script>

</body>
</html>
