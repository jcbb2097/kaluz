<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/OpinionController.php";
	
	$idUsuario = $_GET["idUsuario"];
	$titulo ="";
	$id = $_GET["id"];
	
	$act = new OpinionController();
	$opiniones = $act -> mostrarOpinionesOrigen($id);
	 
	$cadena = "";
	$editaLibro = "";
	$eliminaLibro = "";
	
				
	foreach ($opiniones as $opinion)
	{
			if($idUsuario == 1152 || $idUsuario == 1143){
				//$editaLibro = "<i onclick='actualizaTurnado(".$opinion -> getIdOpinion().")' style='cursor:pointer;' class='far fa-edit'></i>";
				$eliminaLibro = "";
			}else{
				$editaLibro = "";
				$eliminaLibro = "";
			}
		
		$date = new DateTime($opinion -> getFechaCreo());
		
		$cadena.="<tr><td><i style='cursor:pointer' onclick='verInformacion(".$opinion->getIdOpinion().");' class='far fa-list-alt'></i> <br> ".$editaLibro."</td>"
				."<td>".$opinion -> getDescripcion()."<p style='text-align: right;font-size: 9px;'>  ".$eliminaLibro."</p><p class='namePerson'><i>".$opinion->getNombre()." ".$opinion->getApPat()." ".$opinion->getApMat()."</i></p></td>"
				."<td style='width:70px;'>".$date->format('Y-m-d')."</td>"
				."<td>".$opinion -> getNombreOrigen()."</td>"
				."<td>".$opinion -> getNombreTipo()."</td>"
				."</tr>";
		$titulo = $opinion ->getNombreEje();
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

	.namePerson{
		font-family: 'Muli-Bold';
    	font-size: 8px;
		color: #286090;
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
		<div class="col-md-5 col-sm-5 col-xs-5">
			
		</div>
	</div>
	<div class="table-responsive">
		<table id="opinionesCentralEje" class="table table-striped table-bordered table-condensed"  width="100%">
			<thead style="font-size:10px;background-color: #4d4d57;color: white;font-family: 'Muli-SemiBold';">
				<tr>
					<th></th>
					<th>Opinión</th>
					<th style= "width: 70px;">Fecha</th>
					<th>Origen</th>
					<th>Tipo</th>
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


<style>
.text-wrap{
    white-space:normal;
}
.width-50{
    width:15px;
}
</style>
<script>
$(document).ready(function() {

	var table = $('#opinionesCentralEje').DataTable();
	table.destroy();
	
	
	var table = $('#opinionesCentralEje').DataTable(
	{
		pageLength: 50,
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
		"scrollY":        "350px",
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

function verInformacion(idOpinion)
{
	var idOpinion = idOpinion;
	var idUsuario = <?php echo $idUsuario; ?>;
	$.confirm({
		type: 'dark',
		typeAnimated: true,
		boxWidth: '700px',
		useBootstrap: false,
		title: 'Detalle de opinión turnada',
		content: 'url:turnar/detalleOpinionTurnada.php?idUsuario='+idUsuario+'&idOpinion='+idOpinion,
		buttons: {
			cerrar: {
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





</script>
</body>
</html>
