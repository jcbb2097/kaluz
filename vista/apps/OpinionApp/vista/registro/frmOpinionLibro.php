<?php 
date_default_timezone_set('America/Mexico_City');
$idUsuario = $_GET["idUsuario"];
$fechaCrea = date("Y-m-d H:i");

?>
<style>
	label{
		font-size: 11px;
	}
</style>
<form style='overflow-x: hidden;' id ="frmOpinionLibro" action="" class="formName">
		<div class='row'>
			<div style='text-align: center;' class="col-md-4 col-sm-4 col-xs-12">
				<label style="font-size:11px;font-family: 'Muli-SemiBold'" class="radio-inline">
					<input type="radio" name="idTipo" value='1' checked>Felicitación
				</label>
			</div>
			<div style='text-align: center;' class="col-md-4 col-sm-4 col-xs-12">
				<label style="font-size:11px;font-family: 'Muli-SemiBold';" class="radio-inline">
					<input type="radio" name="idTipo" value='2'>Solicitud
				</label>
			</div>
			<div style='text-align: center;' class="col-md-4 col-sm-4 col-xs-12">
				<label style="font-size:11px;font-family: 'Muli-SemiBold';" class="radio-inline">
					<input type="radio" name="idTipo" value='3'>Queja
				</label>
			</div>
		</div><br><br>
	
		<div class='row'>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
					<label>Nombre:</label>
					<input type="text" placeholder="" id="nombre" name="nombre" class="name form-control input-sm" required />
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
					<label>Apellido Paterno:</label>
					<input type="text" placeholder="" id="apPat" name="apPat" class="name form-control input-sm"  />
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
					<label>Apellido Materno:</label>
					<input type="text" placeholder="" id="apMat" name="apMat" class="name form-control input-sm"  />
				</div>
			</div>
		</div>

		<div class='row'>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
					<label>Fecha:</label>
					<input type="date" placeholder="" id="fecha" name="fecha" class="name form-control input-sm"  />
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
					<label>Email:</label>
					<input type="email" placeholder="" id="email" name="email" class="name form-control input-sm"  />
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<div class="form-group">
					<label>Teléfono:</label>
					<input type="text" placeholder="" id="telefono" name="telefono" class="name form-control input-sm"  />
				</div>
			</div>
		</div>

		<div class='row'>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<label>Descripción:</label>
					<textarea rows=5 id="descripcion" name="descripcion" class="name form-control input-sm"></textarea>
					
				</div>
			</div>
		</div>
	
	
	
	<input type="hidden" id="usuarioCreo" name="usuarioCreo" class="name form-control" value='<?php echo $idUsuario; ?>' />
	<input type="hidden" id="idOrigen" name="idOrigen" class="name form-control" value='3' />
	<input type="hidden" id="fechaCrea" name="fechaCrea" class="name form-control" value='<?php echo $fechaCrea; ?>' />
</form>

<script>
$(document).ready(function(){
	 
});

</script>