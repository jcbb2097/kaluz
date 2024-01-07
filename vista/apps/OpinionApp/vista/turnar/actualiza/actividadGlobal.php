<?php
include_once __DIR__."/../../../source/controller/ActividadController.php";

	$idCategoria = $_POST["idSubCategoria"];
	$anio = $_POST["anio"];
	$idEje = $_POST["idEje"];
	
	
	$act = new ActividadController();
	$actGlobal = $act -> mostrarActGlobalEjeCat($idEje,$anio,$idCategoria);
	
	$cadena = "";
	foreach ($actGlobal as $global)
	{ 
		$cadena.= "<option value='".$global -> getIdActividad()."' >".$global -> getNumeracion()." ".$global -> getNombre()."</option>";
				  	
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


