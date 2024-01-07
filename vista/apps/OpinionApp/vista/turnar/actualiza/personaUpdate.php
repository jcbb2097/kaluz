<?php
include_once __DIR__."/../../../source/controller/PersonaController.php";

	$idArea = $_POST["idArea"];
	$idPersona = $_POST["idPersona"];
	
	
	$act = new PersonaController();
	$personas = $act -> mostrarPersonasArea($idArea);
	
	$cadena = "";
	$selectPersona = "";
	foreach ($personas as $persona)
	{ 
		if($idPersona == $persona -> getIdPersona())
		{
			$selectPersona = " selected ";
		}else{
			$selectPersona = "";
		}
		$cadena.= "<option ".$selectPersona." value='".$persona -> getIdPersona()."' >".$persona -> getNombre()." ".$persona -> getApPat()." ".$persona -> getApMat()."</option>";
				  	
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


