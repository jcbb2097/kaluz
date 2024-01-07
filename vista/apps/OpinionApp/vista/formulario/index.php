<?php 
	include_once __DIR__."/../../source/controller/PaisController.php";
	include_once __DIR__."/../../source/controller/GeneroController.php";
	
	$idOrigen = $_GET["idOrigen"];
	
	$act = new PaisController();
	$paises = $act -> mostrarPaises();
	
	$cadena = "";
	
	foreach($paises as $pais)
	{
		$cadena .="<option value='".$pais->getId()."'>".$pais->getNombre()."</option>";
	}
	
	$actR = new GeneroController();
	$generos = $actR -> mostrarGeneros();
	
	$cadenaGenero = "";
	
	foreach($generos as $genero)
	{
		$cadenaGenero .="<option value='".$genero->getId()."'>".$genero->getNombre()."</option>";
	}
	
	$reload = "";

	if($idOrigen == 1){
		$reload = "$(location).attr('href','https://museokaluz.org/');";
	}else if($idOrigen == 2)
	{
		$reload = "location.reload();";
	}else{
		$reload = "";
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Opinion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../resources/font/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <style>
   body{
	   font-family:'HelveticaNowText-Bold';
	
   }
   
   label{
	   font-size: 15px;
   }
   
   .select2-results {
		display: block;
		font-size: 13px;
	}
	
	.select2-container--default .select2-selection--single {
		background-color: #fff;
		border: 1px solid #aaa;
		border-radius: 4px;
		font-size: 13px;
		height: 34px;
	}
	
	.jconfirm .jconfirm-box div.jconfirm-title-c .jconfirm-title {	
		font-size: 15px;
	}
	
	.aviso{
		font-size: 12px;
	}

	.tck{
		background-color: #ed6860;
		font-size: 12px !important;
		color: white;
	}

	.tck:hover{
		background-color: #ed6860;
		font-size: 12px !important;
		color: white;
		border: 1px solid #ed6860;
	}

	.jconfirm .jconfirm-box.jconfirm-type-dark {
    	border-top: solid 7px  #ed6860;
		animation-name: none;
	}
  </style>
</head>
<body>

<div class="container"><br>
	<div class='row'>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<img onclick='refresh();'  src='../../resources/img/logo.png' width="90px;">
		</div>
		<div class="col-md-10 col-sm-10 col-xs-12" style='text-align: center;'>
			<br> 
			<!--<p style='font-size:17px;'>¿Tienes dudas? ¿necesitas información? ¿Quieres dejarnos una opinión?</p> -->
			<!--<p><strong style='font-size: 30px;'>Sigamos en contacto</strong>, <a style='color: #e34e35;text-decoration:none;font-size: 30px;'>escríbenos.</a></p>-->
			<p><strong style='font-size: 30px;'>Nos interesa tu opinión.</strong></p>
			
		</div>
		
	</div>
	<form  id="frmOpinion" style='margin-top: 40px;' action="">
		<div class='row'>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label style='font-size:15px;' class="radio-inline">
					<input type="radio" name="idTipo" value='1' required="required">Felicitación
				</label>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label style='font-size:15px;' class="radio-inline">
					<input type="radio" name="idTipo" value='2'>Solicitud
				</label>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label style='font-size:15px;' class="radio-inline">
					<input type="radio" name="idTipo" value='3'>Queja
				</label>
			</div>
		</div><br><br>
		<div class='row'>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="email">Nombre:</label>
				<input type="text" class="form-control" id="nombre" name='nombre' placeholder="" required />
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="email">Apellido Paterno:</label>
				<input type="text" class="form-control" id="apPat" name='apPat' placeholder="" />
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="email">Apellido Materno:</label>
				<input type="text" class="form-control" id="apMat" name='apMat' placeholder="" />
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="email"><?php if($idOrigen == 1){ echo "Lugar de residencia";} else { echo "¿De dónde nos visita?"; } ?></label><br>
				<select id="idPais" name="idPais" class="form-control  js-example-basic-single"  required>
					<option value=''>seleccione...</option>
					<?php echo $cadena; ?>		
				</select>
			</div>
			<div class='viewEstado'></div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="email">Email:</label>
				<input type="email" class="form-control" id="email" placeholder="" name="email" required>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="edad">Edad:</label><br>
				<input type="number" min='5' max='99' class="form-control" id="edad" placeholder="" name="edad" >
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label for="email">Género:</label>
				<select style="font-size: 13px;" id="idGenero" name="idGenero" class="form-control"  >
					<option value=''>seleccione...</option>
					<?php echo $cadenaGenero; ?>	
				</select>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label for="email" id='descripcionOpinion'>Comentario:</label><br>
				<textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12"><br>
				<p class='aviso'>
					<div class="checkbox">
						<label style='font-size: 12px;'><input id="checkAviso" name='checkAviso' type="checkbox" value="" required>He leído y acepto el <a style='cursor:pointer;' onclick='avisoPrivacidad()'><i>aviso de privacidad</i></a></label>
					</div> 
				</p>
				
			</div>
			
		</div>
		<br>
		<input type="hidden" class="form-control" id="idOrigen" name="idOrigen" value='<?php echo $idOrigen; ?>'/>
		<button style="background-color:#e27e6c; color:white;height: 50px;width: 80px; font-size: 13px;" type="submit" class="btn btn-default">ENVIAR</button>
	</form>
	<br>
</div>

</body>
<script>
$(document).ready(function(){
 
	$('.js-example-basic-single').select2();
	$('.actualizaEstado').select2();
	
	$("#idPais").change(function() {
		var idPais = $("#idPais").val();
		
		if(idPais == 117){
			$.post("estados/estados.php",{}, function( data ) 
			{
				$(".viewEstado").html('');
				$(".viewEstado").html(data);
			});	
		}else{
			$(".viewEstado").html('');
		}
		
		
	});
	
});
/*guardar*/

$(document).ready(function()
{
	$("#frmOpinion").submit(function(event) {
		event.preventDefault();
		
		var posting = $.post("../../source/controller/OpinionFrontController.php",$("#frmOpinion").serialize()+"&action=guardar");
				
		posting.done(function(data)
		{
			if(data == 1)
			{
				$.alert({
					title: 'Gracias por registrar su opinión',
					content: '',
					type:'dark',
					buttons: {
						aceptar: {
							action: function () {
								<?php echo $reload; ?>
							}
						}
					}
				});
				
				
			}else{
				$.alert({
					title: 'Error!',
					content: 'Registro no exitoso!, intente nuevamente ',
					type:'red',
				});
				return false;
			}
		});
			posting.fail(function(data)
			{
				alert("Error al enviar formulario");
			});
		});
});

function refresh()
{
	location.reload();
}

function avisoPrivacidad(){
	$.confirm({
		type: 'dark',
		typeAnimated: true,
		boxWidth: '800px',
		useBootstrap: false,
		//columnClass: 'col-md-4 col-md-offset-4',
		//columnClass: 'small',
		title: 'Aviso de Privacidad',
		content: 'url:aviso.php',
		buttons: {
			Aceptar: {
				btnClass: 'btnC tck',
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

$(document).ready(function()
{
    $("input[name=idTipo]").click(function () {    
       // alert("La edad seleccionada es: " + $('input:radio[name=edad]:checked').val());
       var idTipo = $(this).val();

	   if(idTipo == 1){
			$("#descripcionOpinion").html("Descripción de la Felicitación");
	   }else if(idTipo == 2)
	   {
			$("#descripcionOpinion").html("Descripción de la Solicitud");	
	   }else if(idTipo == 3){
			$("#descripcionOpinion").html("Descripción de la Queja");	
	   }
    });
});

</script>
</html>

 



