<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/OpinionController.php";
	include_once __DIR__."/../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../source/controller/AreaController.php";
	include_once __DIR__."/../../source/controller/ReporteController.php";
	
	$idUsuario = $_POST["idUsuario"];
	$anio = $_POST["anio"];
	
	$actReport = new ReporteController();

	$actArea = new AreaController();
	$areas = $actArea -> mostrarAreas();
	$cadenaArea = "";
	$totArea = 0;
	$felicitacion= 0;
	$solicitud = 0;
	$queja = 0;
	$atendioCC = 0;
	$atendioSC = 0;
	$noAtendioCC = 0;
	$noAtendioSC = 0;
	$totalAtendidas = 0;
	$totalNoAtendidas = 0;
	$percentAtencion = 0.0;
	$totalGral = 0;
	$totalFelicitacion = 0;
	$totalSolicitud = 0;
	$totalQueja = 0;
	$totalACC = 0;
	$totalASC = 0;
	$totalGralA = 0;
	$totalNCC = 0;
	$totalNSC = 0;
	$totalGralN = 0;
	$percentGral = 0;

	foreach($areas as $area)
	{
		$areaT = $actReport -> mostrarTotalOpinionArea($area -> getIdArea(),$anio);
		
		$totArea = $areaT ->getTotal();
		if($areaT ->getFelicitacion() != ''){
			$felicitacion= $areaT ->getFelicitacion();
		}else{
			$felicitacion= 0;
		}

		if($areaT ->getSolicitud() != ''){
			$solicitud = $areaT ->getSolicitud();
		}else{
			$solicitud= 0;
		}

		if($areaT ->getQueja() != ''){
			$queja = $areaT ->getQueja();
		}else{
			$queja= 0;
		}

		if($areaT ->getAtendioCC() != ''){
			$atendioCC = $areaT ->getAtendioCC();
		}else{
			$atendioCC= 0;
		}

		if($areaT ->getAtendioSC() != ''){
			$atendioSC = $areaT ->getAtendioSC();
		}else{
			$atendioSC= 0;
		}
		
		if($areaT ->getNoAtendioCC() != ''){
			$noAtendioCC = $areaT ->getNoAtendioCC();
		}else{
			$noAtendioCC= 0;
		}

		if($areaT ->getNoAtendioSC() != ''){
			$noAtendioSC = $areaT ->getNoAtendioSC();
		}else{
			$noAtendioSC= 0;
		}

		$totalAtendidas = $atendioCC + $atendioSC;
		$totalNoAtendidas = $noAtendioCC + $noAtendioSC;

		if($totArea > 0)
		{
			$percentAtencion = ($totalAtendidas * 100) / $totArea;
		}else{
			$percentAtencion = 0.0;
		}
		 
		
		$cadenaArea .= "<tr><td>".$area->getNombre()."</td>"
					."<td style='text-align:center;'><b>".$totArea."</b></td>"
					."<td style='text-align:center;'>".$felicitacion."</td>"
					."<td style='text-align:center;'>".$solicitud."</td>"
					."<td style='text-align:center;'>".$queja."</td>"
					."<td style='text-align:center;border-left: .5px solid #9cb59c;'>".$atendioCC."</td>"
					."<td style='text-align:center;'>".$atendioSC."</td>"
					."<td style='text-align:center;border-right: .5px solid #9cb59c;color:green;'>".$totalAtendidas."</td>"
					."<td style='text-align:center;border-left: .5px solid #cba9a9;'>".$noAtendioCC."</td>"
					."<td style='text-align:center;'>".$noAtendioSC."</td>"
					."<td style='text-align:center;border-right: .5px solid #cba9a9;color:red;'>".$totalNoAtendidas."</td>"
					."<td style='text-align:center;'><meter style='font-size: 7px;' min='0' max='100' low='15' high='99' optimum='100' value='".$percentAtencion."'></meter> <a class='numb'>".number_format($percentAtencion, 1, '.', '')." %</a></td>"
					."</tr>";
		
		$totalGral = $totalGral + $totArea;
		$totalFelicitacion = $totalFelicitacion + $felicitacion;
		$totalSolicitud = $totalSolicitud + $solicitud;
		$totalQueja = $totalQueja + $queja;
		$totalACC =  $totalACC + $atendioCC;
		$totalASC =  $totalASC + $atendioSC;
		$totalGralA = $totalGralA + $totalAtendidas;
		$totalNCC = $totalNCC + $noAtendioCC;
		$totalNSC = $totalNSC + $noAtendioSC;
		$totalGralN = $totalGralN + $totalNoAtendidas;

		if($totalGral > 0)
		{
			$percentGral = ($totalGralA * 100) / $totalGral ;
		}else{
			$percentGral = 0.0;
		}


	}
	
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
  </style>
</head>
<body>

	
	
	<div class="table-responsive">
		<table id="opinionesCentral" class="table table-striped table-bordered table-condensed"  width="100%">
			<thead style="font-size:10px;background-color: #4d4d57;color: white;font-family: 'Muli-SemiBold';">
				<tr>
					<th style='text-align: center;' rowspan="2">Área</th>
					<th style='text-align: center;' rowspan="2">Total</th>
					<th style='text-align: center;' colspan="3">Tipo</th>
					<th style='text-align: center;background-color: #9cb59c;color: black;' colspan="3">Atendidas</th>
					<th style='text-align: center;background-color: #cba9a9;color: black;' colspan="3">No atendidas</th>
					<th style='text-align: center;' rowspan="2">% atención</th>
				</tr>
				<tr>
					<th style='text-align: center;'>Felicitación</th>
					<th style='text-align: center;'>Solicitud</th>
					<th style='text-align: center;'>Queja</th>
					<th style='text-align: center;'>Con correo</th>
					<th style='text-align: center;'>Sin correo</th>
					<th style='text-align: center;'>Total</th>
					<th style='text-align: center;'>Con correo</th>
					<th style='text-align: center;'>Sin correo</th>
					<th style='text-align: center;border-right: 1px solid;'>Total</th>
            	</tr>
			</thead>
			<tbody style="font-size:10px">
			<?php
				echo $cadenaArea;
			?>	 	
			</tbody>
			<tfoot class='tftable'>
				<tr>
					<th>Totales</th>
					<th style='text-align:center;'><?php echo $totalGral;?></th>
					<th style='text-align:center;'><?php echo $totalFelicitacion;?></th>
					<th style='text-align:center;'><?php echo $totalSolicitud;?></th>
					<th style='text-align:center;'><?php echo $totalQueja;?></th>
					<th style='text-align:center;'><?php echo $totalACC;?></th>
					<th style='text-align:center;'><?php echo $totalASC;?></th>
					<th style='text-align:center;background-color: #9cb59c;color: black;'><?php echo $totalGralA;?></th>
					<th style='text-align:center;'><?php echo $totalNCC;?></th>
					<th style='text-align:center;'><?php echo $totalNSC;?></th>
					<th style='text-align:center;background-color: #cba9a9;color: black;'><?php echo $totalGralN;?></th>
					<th style='text-align:center;color:white;'><meter style='font-size: 7px;' min='0' max='100' low='15' high='99' optimum='100' value='<?php echo $percentGral; ?>'></meter> <a class='numb' style='color: white;'><?php echo number_format($percentGral, 1, '.', ''); ?> %</a></th>
				</tr>
				
        </tfoot>
		</table>
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
$(document).ready(function() {

	var table = $('#opinionesCentral').DataTable();
	table.destroy();
	
	
	var table = $('#opinionesCentral').DataTable(
	{
		pageLength: -1,
		"lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Todo"]],
		
		"language": 
		{
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
		dom: 'Blfrtip',
		buttons: [
           
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
				title: 'Data export opiniones'
            },
           /*
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }*/
        ],
        /*buttons: [
            //'copy', 'csv', 'excel', 'print'
			'excel'
        ],*/
		"scrollX": true,
		"order": [[ 1, "desc" ]],
		responsive: false,
		"scrollY":        "370px",
        "scrollCollapse": true,
        "paging": true,
		columnDefs:[
            {
                render: function (data, type, full, meta) {
					return "<div class='text-wrap width-50'>" + data + "</div>";
                },
                targets: 0
            }
        ]
		
		
		
	});	
});
</script>
<script>

function eliminaOpinionLibro(idOpinion)
{
    var idOpinion = idOpinion;
	var idUsuario = <?php echo $idUsuario; ?>;
	
    $.confirm({
		title: 'Confirmación',
		content: 'Desea eliminar opinión libro de visita?',
		autoClose: 'cancelar|8000',
		type: 'red',
		typeAnimated: true,
		buttons: 
		{
			aceptar: 
			{
				btnClass: 'btn-dark btnC',
				action: function()
				{
					var posting = $.post("../source/controller/OpinionFrontController.php",{idOpinion:idOpinion, action:"eliminar"});
				
					posting.done(function(data)
					{
						if(data == 1)
						{
							$.alert({
								title: 'Opinión Libro',
								content: 'Opinión eliminada correctamente!',
								type:'green',
							});
							
							mostrarCentral(idUsuario,'Opiniones / Central');
						}else{
							$.alert({
								title: 'Error!',
								content: 'NO se pudo eliminar el registro!, intente nuevamente ',
								type:'red',
							});
							return false;
						}
					});
					
				}
			},
			cancelar:
			{
				btnClass: 'btn-default btnC',
			},
		}
    }); 
}


function editaOpinionLibro(id){
	var id =id;
	var idUsuario = <?php echo $idUsuario; ?>;
	var titulo = '<?php echo $titulo; ?>';
	$.confirm({
		type: 'orange',
		typeAnimated: true,
		boxWidth: '500px',
		useBootstrap: false,
		title: 'Edita Opinión ',
		content: 'url:central/form/opinionEdita.php?idUsuario='+idUsuario+'&id='+id,
		buttons: {
			formSubmit: {
				text: 'Modificar opinión',
				btnClass: 'btn-orange btnC',
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
					
					var posting = $.post("../source/controller/OpinionFrontController.php",$("#frmOpinionLibro").serialize()+"&action=modificar");
				
					posting.done(function(data)
					{
						if(data == 1)
						{
							$.alert({
								title: 'Opinión Libro',
								content: 'Modificación exitosa!',
								type:'green',
							});
							
							mostrarCentral(idUsuario,'Opiniones / Central');
						}else{
							$.alert({
								title: 'Error!',
								content: 'NO se pudo modificar el registro!, intente nuevamente ',
								type:'red',
							});
							return false;
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

function turnarOpinion(idOpinion)
{
	var idOpinion = idOpinion;
	var idUsuario = <?php echo $idUsuario; ?>;
	$.confirm({
		type: 'dark',
		typeAnimated: true,
		boxWidth: '700px',
		useBootstrap: false,
		title: 'Turnar Opinión',
		content: 'url:turnar/frmTurnar.php?idUsuario='+idUsuario+'&idOpinion='+idOpinion,
		buttons: {
			formSubmit: {
				text: 'Guardar',
				btnClass: 'btn-green btnC',
				action: function () {
					var idEje = this.$content.find('#idEje').val();
					var idArea = this.$content.find('#idArea').val();
					var idPersona = this.$content.find('#idPersona').val();

					if(!idEje){
						$.alert({
							title: 'Verifique datos',
							content: 'Seleccione Eje!',
							type:'red',
						});
						return false;
					}
					
					if(!idArea){
						$.alert({
							title: 'Verifique datos',
							content: 'Seleccione Área!',
							type:'red',
						});
						return false;
					}

					if(!idPersona){
						$.alert({
							title: 'Verifique datos',
							content: 'Seleccione persona responsable!',
							type:'red',
						});
						return false;
					}
					
					var posting = $.post("../source/controller/DetalleFrontController.php",$("#frmturna").serialize()+"&action=turnado");
		
					posting.done(function(data)
					{
						
						if(data == 1)
						{
							$.alert({
								title: 'Opinión',
								content: 'Opinión turnada al eje correctamente!',
								type:'green',
							});
							
							mostrarCentral(idUsuario,'Opiniones / Central');  
							
						}else{
							$.alert({
								title: 'Opinión',
								content: 'No se pudo turnar opinión!, intente nuevamente',
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


function buscarPalabra(palabra) {
    $('#opinionesCentral')
        .DataTable()
        .search(palabra)
        .draw();
}
</script>
</body>
</html>
