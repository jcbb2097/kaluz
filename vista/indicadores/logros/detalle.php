<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	include_once __DIR__."/../../../source/controller/LogroController.php";
	
	$anio = 2020;
	$idEje = $_POST["idEje"];
	$titulo = $_POST["titulo"];
	$nombreEje = $_POST["nombreEje"];
	$total = $_POST["total"];
	$tipo = $_POST["tipo"];
	
	$actLogro = new LogroController();
	
	$logrosArea = $actLogro -> mostrarDetallePorArea($idEje,$tipo);
	
	$cadenaArea ="";
	foreach($logrosArea as $logroArea)
	{
		$cadenaArea .="<span class='label label-danger'>".$logroArea->getNombreArea()." - ".$logroArea->getTotal()."</span> ";
	}
	
	
	$logros = $actLogro -> mostrarDetalle($idEje,$tipo);
	$cadena ="";
	foreach($logros as $logro)
	{
		//$cadena .="<div class='panel panel-default font'><div class='panel-heading' style='padding: 3px;'>".$logro->getIdEje().".".$logro->getOrden()." ".$logro->getNombreActividad()." (".$logro->getNombreArea().")<br>".$logro->getNombrePersona()."</div><div class='panel-body'>Panel Content</div></div>";
		$cadena .="<div class='panel panel-default font'><div class='panel-heading' style='padding: 3px;background-color:#d9534f;color: white;'>".$logro->getIdEje().".".$logro->getOrden()." ".$logro->getNombreActividad()." (".$logro->getNombreArea().")<br>".$logro->getNombrePersona()."<i onclick='editar(".$logro->getId().",".$tipo.")' style='float: right;cursor:pointer' class='fas fa-edit'></i></div></div>";

	}
	
	
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<!--<link rel="stylesheet" type="text/css" href="../resources/css/inicio.css"/>-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.font{
			font-family: 'Muli-Regular';
			font-size: 11px;
		}
		
		body{
			font-family:'Muli-Regular';
		}
		.titulo{
			    font-family: 'Muli-SemiBold';
    font-size: 13px;
    text-align: center;
		}
	</style>
	
</head>
<body>

<div class="titulo"><span class="badge" style="border-radius: 0px;font-size: 13px;"><?php echo $total;?></span> Logros <?php echo $titulo; ?> del eje <?php echo $idEje; ?>. <?php echo $nombreEje;?></div><br>

<?php echo $cadenaArea;?><br><br>
<?php echo $cadena;?>
</body>
<script>
$('document').ready(function()
{ 
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover(); 
});


function editar(idLogro,tipo)
{
	var idLogro = idLogro;
	var tipo = tipo;
	
	location.replace("/sie/vista/apps/Logros/Alta_logro.php?accion=editar&tipo_de_resumen=3&id="+idLogro+"&act_met="+tipo+"&origen=10"); 

}

</script>
</html>
