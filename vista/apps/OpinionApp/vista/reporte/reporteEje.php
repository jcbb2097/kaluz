<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/OpinionController.php";
	include_once __DIR__."/../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../source/controller/AreaController.php";
	include_once __DIR__."/../../source/controller/ReporteController.php";
	include_once __DIR__."/../../source/controller/EjeController.php";
	
	$idUsuario = $_POST["idUsuario"];
	$anio = $_POST["anio"];
	
	$actReport = new ReporteController();
	$actReport2 = new ReporteController();

	$actEje = new EjeController();
	$ejes = $actEje -> mostrarEjes();
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

	foreach($ejes as $eje)
	{
		$areaT = $actReport -> mostrarTotalOpinionEje($eje -> getIdEje(),$anio);
		
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
		 
		
		$cadenaArea .= "<tr><td style='text-align:center;'>".$eje->getOrden()."</td><td>".$eje->getNombre()."</td>"
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
		$cadenaArea .="<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";

		
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
		
		/*
		$areaEjeOp = $actReport2 -> mostrarTotalOpinionEjeArea($eje -> getIdEje(),$anio);
		foreach($areaEjeOp as $arEj)
		{
			$cadenaArea .="<tr><td style='text-align:center;'></td><td>".$arEj->getNombreArea()."</td>"
					."<td style='text-align:center;'><b></b></td>"
					."<td style='text-align:center;'></td>"
					."<td style='text-align:center;'></td>"
					."<td style='text-align:center;'></td>"
					."<td style='text-align:center;border-left: .5px solid #9cb59c;'></td>"
					."<td style='text-align:center;'></td>"
					."<td style='text-align:center;border-right: .5px solid #9cb59c;color:green;'></td>"
					."<td style='text-align:center;border-left: .5px solid #cba9a9;'></td>"
					."<td style='text-align:center;'></td>"
					."<td style='text-align:center;border-right: .5px solid #cba9a9;color:red;'></td>"
					."<td style='text-align:center;'><meter style='font-size: 7px;' min='0' max='100' low='15' high='99' optimum='100' value='".$percentAtencion9."'></meter> <a class='numb'>".number_format($percentAtencion9, 1, '.', '')." %</a></td>"
					."</tr>";
		}*/
		
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
					<th style='text-align: center;' rowspan="2"></th>
					<th style='text-align: center;' rowspan="2">Eje</th>
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
					<th></th>
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
    width:80px;
}

.width-20{
    width:20px;
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
		"order": [[ 0, "asc" ]],
		responsive: false,
		"scrollY":        "370px",
        "scrollCollapse": true,
        "paging": true,
		columnDefs:[
            {
                render: function (data, type, full, meta) {
					return "<div class='text-wrap width-50'>" + data + "</div>";
                },
                targets: 1,
				render: function (data, type, full, meta) {
					return "<div class='text-wrap width-20'>" + data + "</div>";
                },
                targets: 0
            }
        ]
		
		
		
	});	
});
</script>
<script>
function buscarPalabra(palabra) {
    $('#opinionesCentral')
        .DataTable()
        .search(palabra)
        .draw();
}
</script>
</body>
</html>
