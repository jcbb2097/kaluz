<?php 
include_once __DIR__."/../../source/controller/OpinionController.php";
include_once __DIR__."/../../source/controller/EjeController.php";
include_once __DIR__."/../../source/controller/AreaController.php";
date_default_timezone_set('America/Mexico_City');

$idUsuario = $_GET["idUsuario"];
$idOpinion = $_GET["idOpinion"];
$fechaCrea = date("Y-m-d H:i");
$periodoAnio = 11;
$anio =  2023;

$act = new OpinionController();
$opinion = $act -> mostrarOpinion($idOpinion);

$nombre = $opinion -> getNombre();
$apPat = $opinion -> getApPat();
$apMat = $opinion -> getApMat();
$edad = $opinion -> getEdad();
$email = $opinion -> getEmail();
$telefono = $opinion -> getTelefono();
$nombrePais = $opinion -> getNombrePais();
$nombreEstado = $opinion -> getNombreEstado();
$nombreGenero = $opinion -> getNombreGenero();
$fechaCreo = $opinion -> getFechaCreo();
$nombreOrigen = $opinion -> getNombreOrigen();
$nombreTipo = $opinion -> getNombreTipo();
$descripcion = $opinion -> getDescripcion();

$dateCreo = date('Y-m-d', strtotime($fechaCreo));

/*Ejes*/
$actE = new EjeController();
$ejes = $actE -> mostrarEjes();
$cadenanEjes = "";

foreach($ejes as $eje)
{
	$cadenanEjes .= "<option value=".$eje->getIdEje().">".$eje->getOrden().".- ".$eje->getNombre()."</option>";
}

/*Areas*/
$actA = new AreaController();
$areas = $actA -> mostrarAreas();
$cadenanAreas = "";

foreach($areas as $area)
{
	$cadenanAreas .= "<option value=".$area->getIdArea().">".$area->getNombre()."</option>";
}


?>
<style>
	label{
		font-size: 11px;
	}
	.dc{
		font-size: 11px;
		font-family: 'Muli-SemiBold';
		
	}

	.mp{
		border: 1px solid #cccccc;
		padding: 7px;
		box-shadow: 0 9px 9px -6px;
	}

	.descOp{
		font-size: 11px;
		font-family: 'Muli-SemiBold';
		text-align: justify;
		box-shadow: 0 9px 9px -6px;
	}

	.selectT{
		height: 26px !important;
		font-size: 10px;
		font-family: 'Muli-SemiBold';
	}
</style>
<form style='overflow-x: hidden;' id ="frmturna" action="" class="formName">
	<div class='row'>
		<div style='' class="col-md-6 col-sm-6 col-xs-12">
		 	<p class='dc'><b style='font-family: Muli-Bold;'>Datos de Contacto</b></p>
		</div>
		<div style='' class="col-md-6 col-sm-6 col-xs-12">
		 
			 	<div style='' class="col-md-4 col-sm-4 col-xs-12 dc">
				 	<b style='font-family: Muli-Bold;'>Origen:</b> <br><?php echo $nombreOrigen; ?>
				</div>
				<div style='' class="col-md-4 col-sm-4 col-xs-12 dc">
				 	<b style='font-family: Muli-Bold;'>Tipo:</b><br> <?php echo $nombreTipo; ?>
				</div>
				<div style='' class="col-md-4 col-sm-4 col-xs-12 dc">
				 	<b style='font-family: Muli-Bold;'>Fecha:</b><br> <?php echo $dateCreo; ?>
				</div>
			
		</div>
	</div><br>
	<div class='row'>
		<div style='' class="col-md-6 col-sm-6 col-xs-12">
		 	<p class='dc mp'>
				<b style='font-family: Muli-Bold;'>Nombre:</b> <?php echo $nombre; ?> <?php echo $apPat; ?> <?php echo $apMat; ?>
				<br>
				<b style='font-family: Muli-Bold;'>Correo:</b> <?php echo $email; ?>
				<br>
				<b style='font-family: Muli-Bold;'>Edad:</b> <?php echo $edad; ?>
				<br>
				<b style='font-family: Muli-Bold;'>Teléfono:</b> <?php echo $telefono; ?>
				<br>
				<b style='font-family: Muli-Bold;'>País:</b> <?php echo $nombrePais; ?>
				<br>
				<b style='font-family: Muli-Bold;'>Estado:</b> <?php echo $nombreEstado; ?>
				<br>
				<b style='font-family: Muli-Bold;'>Género:</b> <?php echo $nombreGenero; ?>
			</p>
	
		</div>
		<div style='' class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<textarea class="form-control input-sm descOp" rows="7"><?php echo $descripcion; ?></textarea>
			</div>
		<!--
		 	<p style= 'text-align: justify;' class='dc mp'>
				<b style='font-family: Muli-Bold;'>Descripcion:</b> <br> 
				
			

			</p>
		-->
		</div>
	</div>
	<hr>
	<div class='row'>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Eje</label>
				<select id="idEje" name="idEje" class="form-control input-sm selectT">
					<option value=''>seleccione...</option>
					<?php echo $cadenanEjes; ?>
				</select>
			</div>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Área</label>
				<select id="idArea" name="idArea" class="form-control input-sm selectT ">
					<option value=''>seleccione...</option>
					<?php echo $cadenanAreas; ?>
				</select>
			</div>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Responsable de atender</label>
				<select id="idPersona" name="idPersona" class="form-control input-sm selectT actualizaPersona">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
	</div>

	<div class='row'>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Categoría</label>
				<select id="idCategoria" name="idCategoria" class="form-control input-sm selectT actualizaCategoria">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Sub-Categoría</label>
				<select id="idSubCategoria" name="idSubCategoria" class="form-control input-sm selectT actualizaSubcategoria">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
	</div>

	<div class='row'>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Actividad Global</label>
				<select id="idActividadGlobal" name="idActividadGlobal" class="form-control input-sm selectT actualizaActGlobal">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Actividad General</label>
				<select id="idActividadGeneral" name="idActividadGeneral" class="form-control input-sm selectT actualizaActGeneral">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
		
	</div>

	<div class='row'>
	<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Check</label>
				<select id="idCheck" name="idCheck" class="form-control input-sm selectT actualizaCheck">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label for="inputsm">Sub-Check</label>
				<select id="idSubCheck" name="idSubCheck" class="form-control input-sm selectT actualizaSubcheck">
					<option value=''>seleccione...</option>
					
				</select>
			</div>
		</div>
	
	</div>

	<input type="hidden" id="idUsuario" name="idUsuario" class="name form-control" value='<?php echo $idUsuario; ?>' />
	<input type="hidden" id="idOpinion" name="idOpinion" class="name form-control" value='<?php echo $idOpinion; ?>' />
</form>

<script>
$(document).ready(function(){
	/*mostrar Categorias dependiendo del eje*/
	$( "#idEje" ).change(function() {
		var idEje = $("#idEje").val();
		var anio = <?php echo $periodoAnio; ?>;
		
		$.post("turnar/actualiza/categoria.php",{idEje:idEje,anio:anio}, function( data ) 
		{
			$(".actualizaCategoria").html('');
			$(".actualizaSubcategoria").html('');
			$(".actualizaActGlobal").html('');
			$(".actualizaActGeneral").html('');
			$(".actualizaCheck").html('');
			$(".actualizaSubcheck").html('');

			$(".actualizaCategoria").html(data);
		});	
	});

	/*mostrar Personas dependiendo del area*/
	$( "#idArea" ).change(function() {
		var idArea = $("#idArea").val();

		$.post("turnar/actualiza/persona.php",{idArea:idArea}, function( data ) 
		{
			$(".actualizaPersona").html('');
			$(".actualizaPersona").html(data);
		});	
	});

	/*mostrar subcategorias de la categoria */
	$( "#idCategoria" ).change(function() {
		var idCategoria = $("#idCategoria").val();
			
		$.post("turnar/actualiza/subcategoria.php",{idCategoria:idCategoria}, function( data ) 
		{
			
			$(".actualizaActGlobal").html('');
			$(".actualizaActGeneral").html('');
			$(".actualizaCheck").html('');
			$(".actualizaSubcheck").html('');

			$(".actualizaSubcategoria").html('');
			$(".actualizaSubcategoria").html(data);
		});	
	});

	/*mostrar actividades globales */
	$( "#idSubCategoria" ).change(function() {
		var idSubCategoria = $("#idSubCategoria").val();
		var idEje = $("#idEje").val();
		var anio = <?php echo $anio; ?>;
			
		$.post("turnar/actualiza/actividadGlobal.php",{idSubCategoria:idSubCategoria,idEje:idEje,anio:anio}, function( data ) 
		{
			
			$(".actualizaActGeneral").html('');
			$(".actualizaCheck").html('');
			$(".actualizaSubcheck").html('');

			$(".actualizaActGlobal").html('');
			$(".actualizaActGlobal").html(data);
		});	
	});

	/*mostrar actividades generales */
	$( "#idActividadGlobal" ).change(function() {
		var idActividadGlobal = $("#idActividadGlobal").val();
		var idEje = $("#idEje").val();
		var anio = <?php echo $anio; ?>;
			
		$.post("turnar/actualiza/actividadGeneral.php",{idActividadGlobal:idActividadGlobal,idEje:idEje,anio:anio}, function( data ) 
		{
			
			$(".actualizaCheck").html('');
			$(".actualizaSubcheck").html('');

			$(".actualizaActGeneral").html('');
			$(".actualizaActGeneral").html(data);
		});	
	});

	/*mostrar checklist actividades*/
	$( "#idActividadGlobal" ).change(function() {
		var idActividad = $("#idActividadGlobal").val();
			
		$.post("turnar/actualiza/check.php",{idActividad:idActividad}, function( data ) 
		{
			
			$(".actualizaSubcheck").html('');

			$(".actualizaCheck").html('');
			$(".actualizaCheck").html(data);
		});	
	});

	$( "#idActividadGeneral" ).change(function() {
		var idActividad = $("#idActividadGeneral").val();
			
		$.post("turnar/actualiza/check.php",{idActividad:idActividad}, function( data ) 
		{
			$(".actualizaSubcheck").html('');
			
			$(".actualizaCheck").html('');
			$(".actualizaCheck").html(data);
		});	
	});

	$( "#idCheck" ).change(function() {
		var idCheck = $("#idCheck").val();
			
		$.post("turnar/actualiza/subCheck.php",{idCheck:idCheck}, function( data ) 
		{
			$(".actualizaSubcheck").html('');
			$(".actualizaSubcheck").html(data);
		});	
	});

});

</script>