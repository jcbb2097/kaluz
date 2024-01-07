<?php 
include_once __DIR__."/../../source/controller/OpinionController.php";
include_once __DIR__."/../../source/controller/EjeController.php";
include_once __DIR__."/../../source/controller/AreaController.php";
date_default_timezone_set('America/Mexico_City');

$idUsuario = $_GET["idUsuario"];
$idOpinion = $_GET["idOpinion"];
$fechaCrea = date("Y-m-d H:i");
$periodoAnio = 11;

$act = new OpinionController();
$opinion = $act -> mostrarDetalleOpinionTurnada($idOpinion);

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

$nombreEje = $opinion -> getNombreEje();
$nombrePersonaResponsable = $opinion -> getNombrePersonaResponsable();
$nombreApPatResponde = $opinion -> getApPatResponde();
$nombreApMatResponde = $opinion -> getApMatResponde();
$nombreArea = $opinion -> getNombreArea();

$nombreCategoria = $opinion -> getNombreCategoria();
$nombreSubcategoria = $opinion -> getNombreSubcategoria();
$nombreActividadGlobal = $opinion -> getNombreActividadGlobal();
$nombreActividadGeneral = $opinion -> getNombreActividadGeneral();
$nombreCheck = $opinion -> getNombreCheck();
$nombreSubcheck = $opinion -> getNombreSubcheck();




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

	.spanDat{
		font-family: 'Muli-SemiBold';
    font-size: 12px;
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
			<label for="inputsm">Responsable de atender</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombrePersonaResponsable; ?>  <?php echo $nombreApPatResponde; ?>  <?php echo $nombreApMatResponde; ?></span>
			</p>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Área</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreArea; ?> </span>
			</p>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Eje</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreEje; ?> </span>
			</p>
		</div>
	</div>
	<div class='row'>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Categoría</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreCategoria; ?></span>
			</p>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Sub-Categoría</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreSubcategoria; ?></span>
			</p>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Actividad Global</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreActividadGlobal; ?></span>
			</p>
		</div>
	</div>
	<div class='row'>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Actividad General</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreActividadGeneral; ?></span>
			</p>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Check</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreCheck; ?></span>
			</p>
		</div>
		<div style='' class="col-md-4 col-sm-4 col-xs-12">
			<label for="inputsm">Sub-Check</label>
			<p class='spanDat'>
				<span class="label label-default"><?php echo $nombreSubcheck; ?></span>
			</p>
		</div>
	</div>

	<input type="hidden" id="idUsuario" name="idUsuario" class="name form-control" value='<?php echo $idUsuario; ?>' />
	<input type="hidden" id="idOpinion" name="idOpinion" class="name form-control" value='<?php echo $idOpinion; ?>' />
</form>

<script>

</script>