<?php
include_once __DIR__."/../../../source/controller/CategoriaController.php";

	$idCategoria = $_POST["idCategoria"];
	$idSubcategoria = $_POST["idSubcategoria"];
	
	
	$act = new CategoriaController();
	$categorias = $act -> mostrarSubcategorias($idCategoria);
	
	$cadena = "";
	$selectSub = "";
	foreach ($categorias as $categoria)
	{ 
		if($idSubcategoria == $categoria -> getIdCategoria())
		{
			$selectSub = " selected ";
		}else{
			$selectSub = "";
		}

		$cadena.= "<option ".$selectSub." value='".$categoria -> getIdCategoria()."' >".$categoria -> getOrden().". ".$categoria -> getDescripcion()."</option>";
				  	
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


