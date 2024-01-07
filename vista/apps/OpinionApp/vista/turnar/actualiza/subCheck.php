<?php
include_once __DIR__."/../../../source/controller/ActividadController.php";

	$idCheck = $_POST["idCheck"];
	
	$act = new ActividadController();
	$checkList = $act -> mostrarSubCheckList($idCheck);
	
	$cadena = "";
	foreach ($checkList as $subcheck)
	{ 
		$cadena.= "<option value='".$subcheck -> getIdCheck()."' >".$subcheck -> getOrden().". ".$subcheck -> getNombre()."</option>";
				  	
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


