<?php
include_once __DIR__."/../../../source/controller/ActividadController.php";

	$idCategoria = $_POST["idSubcategoria"];
	$anio = $_POST["anio"];
	$idEje = $_POST["idEje"];
	$idActividadGlobal = $_POST["idActividadGlobal"];
	
	
	$act = new ActividadController();
	$actGlobal = $act -> mostrarActGlobalEjeCat($idEje,$anio,$idCategoria);
	
	$cadena = "";
	$selectGlobal = "";
	foreach ($actGlobal as $global)
	{
		if($idActividadGlobal == $global -> getIdActividad())
		{
			$selectGlobal = " selected ";
		}else{
			$selectGlobal = "";
		} 
		$cadena.= "<option ".$selectGlobal." value='".$global -> getIdActividad()."' >".$global -> getNumeracion()." ".$global -> getNombre()."</option>";
				  	
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


