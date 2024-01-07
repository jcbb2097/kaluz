<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/OpinionController.php";
	include_once __DIR__."/../../source/controller/IndicadorController.php";
	
	$idUsuario = $_POST["idUsuario"];
	$titulo = $_POST["titulo"];
	
	$act = new OpinionController();
	$opiniones = $act -> mostrarOpiniones();
	 
	$cadena = "";
	$editaLibro = "";
	$eliminaLibro = "";
	
				
	foreach ($opiniones as $opinion)
	{
		if($opinion -> getIdOrigen() == 3)
		{
			if($idUsuario == 1152 || $idUsuario == 1143){
				$editaLibro = "<a style='cursor:pointer;' onclick='editaOpinionLibro(".$opinion -> getIdOpinion().")'><i class='fas fa-edit'></i></a>";
				$eliminaLibro = "<a style='cursor:pointer;' onclick='eliminaOpinionLibro(".$opinion -> getIdOpinion().")'><i class='fas fa-trash-alt'></i></a>";
			
			}else{
				$editaLibro = "";
				$eliminaLibro = "";
			}
		}else{
			$editaLibro = "";
			$eliminaLibro = "";
		}
		$date = new DateTime($opinion -> getFechaCreo());
		
		$cadena.="<tr><td><i style='cursor:pointer' onclick='turnarOpinion(".$opinion->getIdOpinion().")' class='fas fa-plane-departure'></i></td>"
				."<td>".$opinion -> getDescripcion()."<p style='text-align: right;font-size: 9px;'>".$editaLibro."  ".$eliminaLibro."</p><p class='namePerson'><i>".$opinion->getNombre()." ".$opinion->getApPat()." ".$opinion->getApMat()."</i></p></td>"
				."<td style='width:70px;'>".$date->format('Y-m-d')."</td>"
				."<td>".$opinion -> getNombreOrigen()."</td>"
				."<td>".$opinion -> getNombreTipo()."</td>"
				."</tr>";
	}
	
	
	$actInd = new IndicadorController();
	$porTurnar = $actInd -> mostrarTotalOpinionesPorTurnar();
	$totalTurnar = $porTurnar -> getTotal();
	
	
	$origen = $actInd -> mostrarTotalOrigenTurnar();
	
	$cadenaOr = "";
	foreach($origen as $org)
	{
		$cadenaOr .= "<a onclick = 'buscarPalabra(\"".$org -> getDescripcion()."\")' style='cursor:pointer;' class='btn btn-default httli'>".$org -> getDescripcion()."  ".$org -> getTotal()."</a>";
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
  </style>
</head>
<body>
<div class="container-fluid" >
	<div class="row ruta">
		<div class="col-md-12 col-sm-12 col-xs-12 titleRuta">
			<?php echo $titulo; ?> / Por turnar a Eje : <?php echo $totalTurnar; ?>
		</div>
	</div>
	<div class="row" style="position: relative;top: 20px;">
		<div class="col-md-5 col-sm-5 col-xs-5">
			
		</div>
	</div><br>
	<div class="row" style="">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="btn-group btn-group-justified">
			   <?php echo $cadenaOr; ?>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			
		</div>
	</div>
	<div class="table-responsive">
		<table id="opinionesCentral" class="table table-striped table-bordered table-condensed"  width="100%">
			<thead style="font-size:10px;background-color: #4d4d57;color: white;font-family: 'Muli-SemiBold';">
				<tr>
					<th style= "width: 40px;"></th>
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
    width:40px;
}
</style>
<script>
$(document).ready(function() {

	var table = $('#opinionesCentral').DataTable();
	table.destroy();
	
	
	var table = $('#opinionesCentral').DataTable(
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
