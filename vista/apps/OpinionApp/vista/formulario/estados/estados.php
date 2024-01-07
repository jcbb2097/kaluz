<?php 
	include_once __DIR__."/../../../source/controller/PaisController.php";
	
	$act = new PaisController();
	$estados = $act -> mostrarEstadosMexico();
	
	$cadena = "";
	
	foreach($estados as $estado)
	{
		$cadena .="<option value='".$estado->getId()."'>".$estado->getNombre()."</option>";
	}

?>
<div class="col-md-4 col-sm-4 col-xs-12">
	<label for="email">Estado:</label><br>
	<select id="idEstado" name="idEstado" class="form-control  js-example-basic-single actualizaEstado"  required>
		<option value=''>seleccione...</option>
		<?php echo $cadena; ?>		
	</select>
</div>
<script>
$(document).ready(function(){
 
	
	$('.actualizaEstado').select2();
	
	
});
</script>
		