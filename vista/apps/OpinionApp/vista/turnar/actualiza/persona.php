<?php
include_once __DIR__."/../../../source/controller/PersonaController.php";

	$idArea = $_POST["idArea"];
	
	
	$act = new PersonaController();
	$personas = $act -> mostrarPersonasArea($idArea);
	
	$cadena = "";
	foreach ($personas as $persona)
	{ 
		$cadena.= "<option value='".$persona -> getIdPersona()."' >".$persona -> getNombre()." ".$persona -> getApPat()." ".$persona -> getApMat()."</option>";
				  	
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


