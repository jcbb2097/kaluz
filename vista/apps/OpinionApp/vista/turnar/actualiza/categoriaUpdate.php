<?php
include_once __DIR__."/../../../source/controller/CategoriaController.php";

	$idEje = $_POST["idEje"];
	$anio = $_POST["anio"];
	///$idCategoria = $_POST["idCategoria"];
	$idCategoria = isset($_POST["idCategoria"]) ? $_POST["idCategoria"] : 0;
	
	$act = new CategoriaController();
	$categorias = $act -> mostrarCategoriasEje($idEje,$anio);
	
	$cadena = "";
	$selectCat = "";
	foreach ($categorias as $categoria)
	{ 
		if($idCategoria == $categoria -> getIdCategoria())
		{
			$selectCat = " selected ";
		}else{
			$selectCat = "";
		}

		$cadena.= "<option ".$selectCat." value='".$categoria -> getIdCategoria()."' >".$categoria -> getOrden().". ".$categoria -> getDescripcion()."</option>";
				  	
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


