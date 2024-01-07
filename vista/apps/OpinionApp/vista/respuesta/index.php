<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/OpinionController.php";
	include_once __DIR__."/../../source/controller/IndicadorController.php";
	
	
	$idEjeArea = $_POST["idEjeArea"];
	$ejeArea = $_POST["ejeArea"];
	$idUsuario = $_POST["idUsuario"];
	$cadenaValor = $_POST["cadena"];
	
	$act = new OpinionController();
	$actInd = new IndicadorController();

	

	if($ejeArea == 1){
		$opiniones = $act -> mostrarOpinionesTurnadasAreaResponder($idEjeArea,$cadenaValor);

	}else{
		$opiniones = $act -> mostrarOpinionesTurnadasEjeResponder($idEjeArea,$cadenaValor);

		$origen = $actInd -> mostrarTotalNoAtendidasOrigenEje($idEjeArea,$cadenaValor);
		$cadenaOr = "";
		foreach($origen as $org)
		{
			$cadenaOr .= "<a onclick = 'buscarPalabra(\"".$org -> getDescripcion()."\")' style='cursor:pointer;' class='btn btn-default httli paddinButton'>".$org -> getDescripcion()."  ".$org -> getTotal()."</a>";
		}

		$usuarioR = $act -> mostrarResponsableEje($idEjeArea);
		$idUsuarioResp = $usuarioR -> getIdUsuario();
		$cadenaReasignar = "";

	}
	
	 
	$cadena = "";
	$editaLibro = "";
	$eliminaLibro = "";
	$cadenaDatos = "";
	$iconLike = "";
	$iconLikeTel = "";
	$iconSin = "";
	$iconCon = "";
	$descripcionLinkSin = ""; 
	
	
	foreach ($opiniones as $opinion)
	{
		if($idUsuario == $idUsuarioResp || $idUsuario == 1143  || $idUsuario == 1152){
			$cadenaReasignar = "<i onclick='reasignaOpinion(".$opinion->getIdOpinion().")' data-toggle='tooltip' data-placement='right' title='reasignar opinión' style='cursor: pointer;color: #338ccb;font-size: 13px;' class='fas fa-retweet'></i>";
		}else{
			$cadenaReasignar = "";
		}

		if($opinion->getEmail() != '')
		{
			$iconLike = "<i style='color: green;font-size: 12px;' class='far fa-envelope'><b style='font-size:1px'>1</b></i>";
			$iconSin = "";
			$descripcionLinkSin = "<a style='cursor:pointer;' onclick='atenderOpinionCC(".$opinion->getIdOpinion().")'>".$opinion -> getDescripcion()."</a>";
			//if($idUsuario == 1143){
				//$iconCon = "<i data-toggle='tooltip' data-placement='right' title='atender opinión' style='cursor:pointer;font-size: 13px;color:green;' onclick='atenderOpinionCC(".$opinion->getIdOpinion().")' class='fas fa-mail-bulk'></i>";
			//}else{
				//$iconCon = "";
			//}
			
		}else{
			$iconLike = "<i style='color: red;font-size: 12px;' class='far fa-envelope'><b style='font-size:1px'>0</b></i>";
			//$iconSin = "<i data-toggle='tooltip' data-placement='right' title='atender opinión' style='cursor:pointer;color: green;font-size: 13px;' onclick='atenderOpinionSC(".$opinion->getIdOpinion().")' class='far fa-check-square'></i> ";
			$descripcionLinkSin = "<a style='cursor:pointer;' onclick='atenderOpinionSC(".$opinion->getIdOpinion().")'>".$opinion -> getDescripcion()."</a>";
			$iconCon = "";
		}

		if($opinion->getTelefono() != '')
		{
			$iconLikeTel = "<i style='color: green;font-size: 12px;' class='fas fa-phone'><b style='font-size:1px'>1</b></i>";
		}else{
			$iconLikeTel = "<i style='color: red;font-size: 12px;' class='fas fa-phone'><b style='font-size:1px'>0</b></i>";
		}

		$date = new DateTime($opinion -> getFechaCreo());
		$cadena.="<tr><td>".$iconSin.$iconCon."<br><br>".$cadenaReasignar."</td>"
		//$cadena.="<tr><td><i style='cursor:pointer' onclick='turnarOpinion(".$opinion->getIdOpinion().")' class='fas fa-plane-departure'></i></td>"
				."<td>".$descripcionLinkSin."<p style='text-align: right;font-size: 9px;'>".$editaLibro."  ".$eliminaLibro."</p><p class='namePerson'><i>".$opinion->getNombre()." ".$opinion->getApPat()." ".$opinion->getApMat()."<br>".$opinion->getEdad()."<br>".$opinion->getNombrePais().", ".$opinion->getNombreEstado()."<br> ".$opinion->getNombreGenero()." <br> ".$opinion->getEmail()."<br>".$opinion->getTelefono()."</i></p></td>"
				."<td style='text-align:center;'>".$iconLike."</td>"
				."<td style='text-align:center;'>".$iconLikeTel."</td>"
				."<td style='width:70px;'>".$date->format('Y-m-d')."</td>"
				."<td>".$opinion -> getNombreOrigen()."</td>"
				."<td>".$opinion -> getNombreTipo()."</td>"
				."<td style='font-size: 9px;'><b>".$opinion -> getNombreArea()."</b><br>".$opinion -> getNombrePersonaResponsable()." ".$opinion -> getApPatResponde()." ".$opinion -> getApMatResponde()."</td>"
				."<td><p style='font-size: 8.5px;'><b>".$opinion->getNombreEje()."</b></p></td>"
				."<td><p style='font-size: 8.5px;'>".$opinion -> getNombreCategoria()."</p></td>"
				."<td><p style='font-size: 8.5px;'>".$opinion -> getNombreSubcategoria()."</p></td>"
				."<td><p style='font-size: 8.5px;'><b>".$opinion->getNumeroOrdenGlobal()."</b> ".$opinion -> getNombreActividadGlobal()."<br><b> ".$opinion->getNumeroOrdenGral()."</b> ".$opinion->getNombreActividadGeneral()."</p></td>"
				
				."</tr>";
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
	
	.paddinButton{
		padding: 1px 12px;
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
<div class="container-fluid" style='padding-left: 0px;' >
	<!--
	<div class="row ruta">
		<div class="col-md-12 col-sm-12 col-xs-12 titleRuta">
		< ?php echo $ordenEje.".- ".$nombreEje; ?> / <b style='color:red;'>Opiniones no atendidas :</b> < ?php echo $totalNoAtendidas; ?>
		</div>
	</div>
-->
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
					<th style= "width: 10px;"></th>
					<th>Opinión</th>
					<th style='text-align:center'><i class="fas fa-at"></i></th>
					<th style='text-align:center'><i class="fas fa-phone"></i></th>
					<th style= "width: 70px;">Fecha</th>
					<th>Origen</th>
					<th>Tipo</th>
					<th>Responsable de atender</th>
					<th>Eje</th>
					<th>Categoría</th>
					<th>Sub-Categoría</th>
					<th>Actividad</th>
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
    width:6px;
}

.width-500{
    width:350px;
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
                targets: 0,

				render: function (data, type, full, meta) {
					return "<div class='text-wrap width-500'>" + data + "</div>";
                },
                targets: 1,

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

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});


function atenderOpinionSC(idOpinion)
{
	var idOpinion = idOpinion;
	var idUsuario = <?php echo $idUsuario; ?>;
	var cadenaValor = <?php echo $cadenaValor; ?>;
	var idEjeArea = <?php echo $idEjeArea; ?>;
	var ejeArea = <?php echo $ejeArea; ?>;

	$.confirm({
		type: 'yellow',
		typeAnimated: true,
		boxWidth: '700px',
		useBootstrap: false,
		title: 'Atender opinión sin contacto ',
		content: 'url:respuesta/atenderOpinionSinContacto.php?idUsuario='+idUsuario+'&idOpinion='+idOpinion+'&cadenaValor='+cadenaValor+'&idEjeArea='+idEjeArea+'&ejeArea='+ejeArea,
		buttons: {
			formSubmit: {
				text: 'Atender',
				btnClass: 'btn-green btnC',
				action: function () {
					var clasificacion = this.$content.find('#clasificacion').val();
					var idUsuarioResponde = this.$content.find('#idUsuarioResponde').val();

					if(!clasificacion){
						$.alert({
							title: 'Verifique datos',
							content: 'Seleccione clasificación de la opinión!',
							type:'red',
						});
						return false;
					}

					if(idUsuarioResponde != idUsuario ){
						$.alert({
							title: 'Validación usuario',
							content: 'El usuario actual no puede atender opinión, verifique usuario!',
							type:'red',
						});
						return false;
					}

					$('.loading').html("<div class='loader'><div class='info'>Subiendo respuesta...</div></div>");
					var formData = new FormData(document.getElementById("frmRespuestaSC"));
					formData.append("action", "guardar");
					
					$.ajax({
						url: "../source/controller/EvidenciaFrontController.php",
						type: "post",
						dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false
					})
					.done(function(data,status,xhr)
					{
						
						if(xhr.status === 200)
						{
							var respuesta = xhr.responseText;
							var r = respuesta.trim();
								$(".loading").fadeIn(1000).html('');
								$.alert({
									title: 'Opinión',
									content: 'Opinión atendida correctamente!',
									type:'green',
									buttons: {
										aceptar: function () {
											var url = "atencion.php?ejeArea="+ejeArea+"&idUsuario="+idUsuario+"&idEjeArea="+idEjeArea+"&cadenaValor="+cadenaValor; 
											$(location).attr('href',url);
										},
									}
								});
							
						}
						else{
							$(".loading").fadeIn(1000).html('');
							$.alert({
								title: 'Opinión',
								content: 'No se pudo atender opinión!, intente nuevamente',
								type:'red',
							});
						
						}
					});
					/*
					var posting = $.post("../source/controller/EvidenciaFrontController.php",$("#frmRespuestaSC").serialize()+"&action=guardar");
		
					posting.done(function(data)
					{
						
						if(data == 1)
						{
							$.alert({
								title: 'Opinión',
								content: 'Opinión atendida correctamente!',
								type:'green',
							});
							//muestraDatosEje(idEje);
							//mostrarCentral(idUsuario,'Opiniones / Central');  
							
						}else{
							$.alert({
								title: 'Opinión',
								content: 'No se pudo atender opinión!, intente nuevamente',
								type:'red',
							});

						}
					});
					*/
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


function reasignaOpinion(idOpinion)
{
	var idOpinion = idOpinion;
	var idUsuario = <?php echo $idUsuario; ?>;
	var cadenaValor = <?php echo $cadenaValor; ?>;
	var idEjeArea = <?php echo $idEjeArea; ?>;
	var ejeArea = <?php echo $ejeArea; ?>;

	$.confirm({
		type: 'yellow',
		typeAnimated: true,
		boxWidth: '700px',
		useBootstrap: false,
		title: 'Turnar Opinión -> reasignar',
		content: 'url:turnar/updateTurnar.php?idUsuario='+idUsuario+'&idOpinion='+idOpinion,
		buttons: {
			formSubmit: {
				text: 'Reasignar',
				btnClass: 'btn-orange btnC',
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
					
					var posting = $.post("../source/controller/DetalleFrontController.php",$("#frmturnaUpdate").serialize()+"&action=modificarTurnado");
		
					posting.done(function(data)
					{
						
						if(data == 1)
						{
							/*
							$.alert({
								title: 'Opinión',
								content: 'Opinión reasignada correctamente!',
								type:'green',
							});
							var url = "atencion.php?ejeArea="+ejeArea+"&idUsuario="+idUsuario+"&idEjeArea="+idEjeArea+"&cadenaValor="+cadenaValor; 
							$(location).attr('href',url);  
							*/

							$.alert({
									title: 'Opinión',
									content: 'Opinión reasignada correctamente!',
									type:'green',
									buttons: {
										aceptar: function () {
											var url = "atencion.php?ejeArea="+ejeArea+"&idUsuario="+idUsuario+"&idEjeArea="+idEjeArea+"&cadenaValor="+cadenaValor; 
											$(location).attr('href',url);
										},
									}
							});

						}else{
							$.alert({
								title: 'Opinión',
								content: 'No se pudo reasignar opinión!, intente nuevamente',
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


function atenderOpinionCC(idOpinion)
{
	var idOpinion = idOpinion;
	var idUsuario = <?php echo $idUsuario; ?>;
	var cadenaValor = <?php echo $cadenaValor; ?>;
	var idEjeArea = <?php echo $idEjeArea; ?>;
	var ejeArea = <?php echo $ejeArea; ?>;

	$.confirm({
		type: 'yellow',
		typeAnimated: true,
		boxWidth: '700px',
		useBootstrap: false,
		title: 'Atender opinión con contacto ',
		content: 'url:respuesta/atenderOpinionConContacto.php?idUsuario='+idUsuario+'&idOpinion='+idOpinion+'&cadenaValor='+cadenaValor+'&idEjeArea='+idEjeArea+'&ejeArea='+ejeArea,
		buttons: {
			formSubmit: {
				text: 'Atender',
				btnClass: 'btn-green btnC',
				action: function () {
					var clasificacion = this.$content.find('#clasificacion').val();
					var idUsuarioResponde = this.$content.find('#idUsuarioResponde').val();
					var respuesta = this.$content.find('#respuesta').val();

					if(!clasificacion){
						$.alert({
							title: 'Verifique datos',
							content: 'Seleccione clasificación de la opinión!',
							type:'red',
						});
						return false;
					}

					if(idUsuarioResponde != idUsuario ){
						$.alert({
							title: 'Validación usuario',
							content: 'El usuario actual no puede atender opinión, verifique usuario!',
							type:'red',
						});
						return false;
					}

					$('.loading').html("<div class='loader'><div class='info'>Subiendo respuesta...</div></div>");
					var formData = new FormData(document.getElementById("frmRespuestaSC"));
					formData.append("action", "guardar");
					
					$.ajax({
						url: "respuesta/envioCorreo.php",
						type: "post",
						dataType: "html",
						data: formData,
						cache: false,
						contentType: false,
						processData: false
					})
					.done(function(data,status,xhr)
					{
						
						if(xhr.status === 200)
						{
							var respuesta = xhr.responseText;
							var r = respuesta.trim();
								$(".loading").fadeIn(1000).html('');
								$.alert({
									title: 'Opinión',
									content: 'Opinión atendida correctamente!',
									type:'green',
									buttons: {
										aceptar: function () {
											var url = "atencion.php?ejeArea="+ejeArea+"&idUsuario="+idUsuario+"&idEjeArea="+idEjeArea+"&cadenaValor="+cadenaValor; 
											$(location).attr('href',url);
										},
									}
								});
							
						}
						else{
							$(".loading").fadeIn(1000).html('');
							$.alert({
								title: 'Opinión',
								content: 'No se pudo atender opinión!, intente nuevamente',
								type:'red',
							});
						
						}
					});
					/*
					var posting = $.post("../source/controller/EvidenciaFrontController.php",$("#frmRespuestaSC").serialize()+"&action=guardar");
		
					posting.done(function(data)
					{
						
						if(data == 1)
						{
							$.alert({
								title: 'Opinión',
								content: 'Opinión atendida correctamente!',
								type:'green',
							});
							//muestraDatosEje(idEje);
							//mostrarCentral(idUsuario,'Opiniones / Central');  
							
						}else{
							$.alert({
								title: 'Opinión',
								content: 'No se pudo atender opinión!, intente nuevamente',
								type:'red',
							});

						}
					});
					*/
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

</script>
</body>
</html>
