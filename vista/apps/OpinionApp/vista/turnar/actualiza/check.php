<?php
include_once __DIR__."/../../../source/controller/ActividadController.php";

	$idActividad = $_POST["idActividad"];
	
	$act = new ActividadController();
	$checkList = $act -> mostrarCheckList($idActividad);
	
	$cadena = "";
	foreach ($checkList as $check)
	{ 
		$cadena.= "<option value='".$check -> getIdCheck()."' >".$check -> getOrden().". ".$check -> getNombre()."</option>";
				  	
	}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body >
	<option value=''>seleccione...</option>
	<?php echo $cadena; ?>
		
</body>
<script>
</script>
</html>


