<?php 
include_once __DIR__."/../source/controller/CategoriaController.php";
include_once __DIR__."/../source/controller/ActividadController.php";

$idEje = 7;
$anio = 2023;
$periodo = 11;
$act = new CategoriaController();
$act2 = new CategoriaController();
$act3 = new ActividadController();

$categorias = $act -> mostrarCategoriasEje($idEje,$periodo);

$cadenaCategoria = "";

foreach($categorias as $categoria)
{
	
	
	$cadenaCategoria.= "<tr data-id='".$categoria -> getIdCategoria()."' data-parent=''>"
							."<td class='categoriaTd'> ".$categoria -> getDescripcion()."</td>"
							."<td>-</td>"
							."<td>-</td>"
							."<td>-</td>"
							."<td>-</td>"
							."<td>-</td>"
						."</tr>";
						
	$subCategorias = $act2 -> mostrarSubcategorias($categoria -> getIdCategoria());
	foreach($subCategorias as $sub)
	{
		$cadenaCategoria .= "<tr data-id='".$sub -> getIdCategoria()."' data-parent='".$sub -> getIdCategoriaPadre()."'>
		<td class='sizeSub'> ".$sub -> getDescripcion()."</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
	  </tr>";
	  
		$globales = $act3 -> mostrarActGlobalEjeCat($idEje,$anio,$sub -> getIdCategoria());
		foreach($globales as $global)
		{
			$cadenaCategoria .= "<tr data-id='".$global -> getIdActividad()."' data-parent='".$global -> getIdCategoria()."'>
			<td class='globalAct'> ".$global -> getNumeracion()." ".$global -> getNombre()."</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		  </tr>";
		  
			$generales = $act3 -> mostrarActGeneralEjeCat($idEje,$anio,$sub -> getIdCategoria(),$global -> getIdActividad());
			foreach($generales as $gral)
			{
				$cadenaCategoria .= "<tr data-id='".$gral -> getIdActividad()."' data-parent='".$gral -> getIdActividadSuperior()."'>
				<td class='gralAct'> ".$gral -> getNumeracion()." ".$gral -> getNombre()."</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			  </tr>";
			}
		  
		  
		}
	}
	
	
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link  rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="../../../../resources/font/index.css"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../resources/js/jquery.aCollapTable.js"></script>	


<style>
	.thead{
		font-size:11px;
		font-family: 'Muli-Bold';
	}
	
	.tbody{
		font-family: 'Muli-SemiBold';
		font-size: 11px;
	}
	
	.sizeSub{
		font-size: 9px;
		padding-left: 20px !important;
	}
	
	.divSub{
		
		padding-left: 10px;
		font-size: 9px;
		color: #286090;
	}
	
	.globalAct{
		font-size: 9px;
		color:#286090;
		padding-left: 28px !important;
	}
	
	.gralAct{
		font-size: 9px;
		color:#337ab7;
		padding-left: 44px !important;
	}
	
	.categoriaTd{
		font-family: Muli-Bold;
	}

</style>
</head>

<body>

</div>
<div class="container" style="margin-top:15px;">
	<div class="well">
		<a href="javascript:void(0);" class="btn btn-primary act-button-expand-all ">Expander</a>
         <a href="javascript:void(0);" class="btn btn-primary act-button-collapse-all">Ocultar</a>
    </div>
<table class="collaptable table table-striped">
<thead class='thead'>
  <tr>
    <th style='width:400px'>Categoría</th>
    <th>#A.Global</th>
    <th>#A.General</th>
	<th>#Entregables</th>
	<th>Avance</th>
	<th>Opciones</th>
  </tr>
</thead> 
<tbody class='tbody'>
	<?php  echo $cadenaCategoria; ?>
</tbody>
	

<!--
  <tr data-id="1" data-parent="">
    <td> Homenaje</td>
    <td>-</td>
    <td></td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
  </tr>
	  <tr data-id="2" data-parent="1">
		<td> Tin Tan</td>
		<td>-</td>
		<td></td>
		<td>-</td>
		<td>-</td>
		<td>-</td>
	  </tr>
		  <tr data-id="3" data-parent="2">
			<td> 7.1 Desarrollo curatorial</td>
			<td>-</td>
			<td></td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		  </tr>
			<tr data-id="4" data-parent="3">
				<td> 7.1.1 Concepto curatorial</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
			<tr data-id="5" data-parent="3">
				<td> 7.1.2 Investigación curatorial</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
				<td>-</td>
			</tr>
		  -->
</table>
</div>

<script>
$(document).ready(function(){
  $('.collaptable').aCollapTable({ 
    startCollapsed: true,
    addColumn: false, 
    plusButton: '<i style="font-size: 11px;" class="fas fa-folder-plus"></i>', 
    minusButton: '<i style="color:black;font-size: 11px;" class="fas fa-folder-minus"></i>' 
  });
});
</script>


</body>
</html>
