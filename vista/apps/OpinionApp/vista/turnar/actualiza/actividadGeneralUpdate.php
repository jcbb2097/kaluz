<?php
include_once __DIR__."/../../../source/controller/ActividadController.php";

	$idActividadGlobal = $_POST["idActividadGlobal"];
	$anio = $_POST["anio"];
	$idEje = $_POST["idEje"];
	$idActividadGeneral = $_POST["idActividadGeneral"];
	
	
	$act = new ActividadController();
	$actGral = $act -> mostrarActGeneralEjeCat($idEje,$anio,$idActividadGlobal);
	
	$cadena = "";
	$selectGeneral  ="";
	foreach ($actGral as $general)
	{ 
		if($idActividadGeneral == $general -> getIdActividad())
		{
			$selectGeneral = " selected ";
		}else{
			$selectGeneral = "";
		} 
		$cadena.= "<option ".$selectGeneral." value='".$general -> getIdActividad()."' >".$general -> getNumeracion()." ".$general -> getNombre()."</option>";
				  	
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


