<?php
	include_once __DIR__."/../../source/controller/NotificacionController.php";
	
	
	$anio = 2020;
	$idArea = $_GET["idArea"];
	$idUsuario = $_GET["idUsuario"];
	$nombreArea = $_GET["nombreArea"];
	
	
	
	$act = new NotificacionController();
	$act2 = new NotificacionController();
	$sinLeerRec =  $act -> mostrarTotalRecSL($idArea);
	$totalRecSL = $sinLeerRec -> getTotal();
	
	$sinLeerEnv =  $act -> mostrarTotalEnvSL($idArea);
	$totalEnvSL = $sinLeerEnv -> getTotal();
	
	$cadenaTabla = "";
	$cadenaLinea1 = "";
	$cadenaLinea2 = "";
	$cadenaLinea3 = "";
	$cadenaLinea4 = "";
	$totalRecibidosSinRespuesta = 0;
	$totalEnviadosSinRespuesta = 0;
	
	
	$recSinRes = $act -> mostrarRecibidosSinRespuesta($idArea);
	foreach($recSinRes as $re)
	{
		$recSinResUltima = $act -> mostrarRecibidosSinRespuestaUltima($re->getId());
		$idRes = $recSinResUltima -> getId();
		
		if($idRes == $idArea){
			$totalRecibidosSinRespuesta += 0;
		}else{
			$totalRecibidosSinRespuesta += 1;
		}
	}
	//echo $totalRecibidosSinRespuesta;
	
	$envSinRes = $act -> mostrarEnviadosSinRespuesta($idArea);
	foreach($envSinRes as $reenv)
	{
		$envSinResUltima = $act -> mostrarEnviadosSinRespuestaUltima($reenv->getId());
		$idResEnv = $envSinResUltima -> getId();
		
		if($idResEnv == $idArea){
			$totalEnviadosSinRespuesta += 0;
		}else{
			$totalEnviadosSinRespuesta += 1;
		}
	}
	
	$cadenaLinea1 = "<tr><td onclick='abreAsuntos(\"recibido\",1)' style ='cursor:pointer;color: white;background-color: red;' id='numActualizado'>".$totalRecSL."</td><td onclick='abreAsuntos(\"recibido\",1)' style='cursor:pointer;background-color: #bfd1b2;color:black;font-size: 8.2px;'><i style='font-size: 8.2px;' class='far fa-envelope'></i> recibidos de las áreas sin leer míos</td></tr>"; 
	$cadenaLinea2 = "<tr><td onclick='abreAsuntos(\"recibido\",2)' style='cursor:pointer;background-color: #ffeb3b;color: black;' id='numActualizadoSinRespuesta'>".$totalRecibidosSinRespuesta."</td><td onclick='abreAsuntos(\"recibido\",2)' style='cursor:pointer;font-size: 8.2px;background-color: #bfd1b2;color:black'><i style='font-size: 8.2px;' class='far fa-envelope'></i> recibidos en conversación sin respuesta mía</td></tr>"; 
	$cadenaLinea3 = "<tr><td onclick='abreAsuntos(\"enviado\",1)' style ='cursor:pointer;color: white;background-color: red;' id='numActualizadoEnviado'>".$totalEnvSL."</td><td onclick='abreAsuntos(\"enviado\",1)' style='cursor:pointer;background-color: white;color:black;font-size: 8.2px;'><i style='font-size: 8.2px;' class='far fa-paper-plane'></i> enviados míos sin leer por las áreas</td></tr>"; 
	$cadenaLinea4 = "<tr><td onclick='abreAsuntos(\"enviado\",2)' style='cursor:pointer;background-color: #ffeb3b;color: black;' id='numActualizadoSinRespuestaEnviados'>".$totalEnviadosSinRespuesta."</td><td onclick='abreAsuntos(\"enviado\",2)' style='cursor:pointer;font-size: 8.2px;background-color: white;color:black'><i style='font-size: 8.2px;' class='far fa-paper-plane'></i> enviados en conversación sin respuesta mía</td></tr>"; 
	
	/*
	if($totalRecSL > 0){ $cadenaLinea1 = "<tr><td onclick='abreAsuntos(\"recibido\",1)' style ='cursor:pointer;color: white;background-color: red;' id='numActualizado'>".$totalRecSL."</td><td onclick='abreAsuntos(\"recibido\",1)' style='cursor:pointer;background-color: #bfd1b2;color:black'><i style='font-size: 8.2px;' class='far fa-envelope'></i> recibidos de las áreas sin leer míos</td></tr>"; }else{ $cadenaLinea1 = "";}
	if($totalRecibidosSinRespuesta > 0){ $cadenaLinea2 = "<tr><td onclick='abreAsuntos(\"recibido\",2)' style='cursor:pointer;background-color: #ffeb3b;color: black;'>".$totalRecibidosSinRespuesta."</td><td onclick='abreAsuntos(\"recibido\",2)' style='cursor:pointer;font-size: 8.2px;background-color: #bfd1b2;color:black'><i style='font-size: 8.2px;' class='far fa-envelope'></i> recibidos en conversación sin respuesta mía</td></tr>"; }else{ $cadenaLinea2 = "";}
	if($totalEnvSL > 0){ $cadenaLinea3 = "<tr><td onclick='abreAsuntos(\"enviado\",1)' style ='cursor:pointer;color: white;background-color: red;' id='numActualizadoEnviado'>".$totalEnvSL."</td><td onclick='abreAsuntos(\"enviado\",1)' style='cursor:pointer;background-color: white;color:black'><i style='font-size: 8.2px;' class='far fa-paper-plane'></i> enviados míos sin leer por las áreas</td></tr>"; }else{ $cadenaLinea3 = "";}
	if($totalEnviadosSinRespuesta > 0){ $cadenaLinea4 = "<tr><td onclick='abreAsuntos(\"enviado\",2)' style='cursor:pointer;background-color: #ffeb3b;color: black;'>".$totalEnviadosSinRespuesta."</td><td onclick='abreAsuntos(\"enviado\",2)' style='cursor:pointer;font-size: 8.2px;background-color: white;color:black'><i style='font-size: 8.2px;' class='far fa-paper-plane'></i> enviados en conversación sin respuesta mía</td></tr>"; }else{ $cadenaLinea4 = "";}
	*/
	
	$cadenaTabla = $cadenaLinea1.$cadenaLinea2.$cadenaLinea3.$cadenaLinea4;
	
				
				
			
			
			
			
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../resources/font/index.css"/>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	
	   <script src="https://use.fontawesome.com/779a643cc8.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	
	

	
	
	<style>
	.my-custom-scrollbar {
position: relative;
height: 118px;
/*overflow: auto;*/
overflow: hidden;
}
.table-wrapper-scroll-y {
display: block;
}


.my-custom-scrollbar::-webkit-scrollbar {
    -webkit-appearance: none;
}

.my-custom-scrollbar::-webkit-scrollbar:vertical {
    width:5px;
}

.my-custom-scrollbar::-webkit-scrollbar-button:increment,.my-custom-scrollbar::-webkit-scrollbar-button {
    display: none;
} 

.my-custom-scrollbar::-webkit-scrollbar:horizontal {
    height: 5px;
}

.my-custom-scrollbar::-webkit-scrollbar-thumb {
   /* background-color: #797979;
    border-radius: 20px;
    border: 2px solid #f1f2f3;
	border-radius: 0px;
    border: 2px solid #464456;*/
	background-color: #cbcbca;
    border-radius: 4px;
    border: 1px solid #5a274f;
}

.my-custom-scrollbar::-webkit-scrollbar-track {
    border-radius: 10px;  
}

table{
	font-family:'Muli-Regular';
	font-size: 10px;
}

table.table tbody tr.selected {
    background-color: #e6e6e1;
}

body{
	background-color: #2c2d30;
    color: white;
}
.td{
	text-align: center;
    font-family: 'Muli-Bold';
}

	</style>
</head>
<body>

<div style="" class="table-wrapper-scroll-y my-custom-scrollbar">
	<table id="table" class="table table-condensed  mb-0">
		<thead></thead>
		<tbody style="font-size: 9px;">
			<?php echo $cadenaTabla; ?>
			<tr><td class='td' colspan="2">pendientes de <?php echo $nombreArea; ?></td></tr>
		</tbody>
	</table>
</div>



<script>

</script>
</body>

	
<script>
$('document').ready(function()
{
	
	
});


function abreAsuntos(tipo,estatus)
{
	
	var anio = <?php echo $anio; ?>;
	var idArea = <?php echo $idArea; ?>;
	
	var idAreaUsuario = <?php echo $idArea; ?>;
	var idUsuario = <?php echo $idUsuario; ?>;
	var estatus = estatus;
	var tipo = tipo;
	
	var padre = $(window.parent.document);
	//$(padre).find('div#a".$area->getIdArea()."')
	
	$(padre).find('iframe#scorm_object').attr('src','apps/Asuntos/index.php?ac=1&anio='+anio+'&idArea='+idArea+'&idUsuario='+idUsuario+'&opcion='+tipo+'&tipo=0&estatus='+estatus+'&idEje=0&idAreaU=0');
	//location.replace('../apps/Asuntos/index.php?ac=1&anio='+anio+'&idArea='+idArea+'&idUsuario='+idUsuario+'&opcion='+tipo+'&tipo=0&estatus='+estatus+'&idEje=0&idAreaU='+idAreaUsuario);

	
    
 


}


</script>
</html>
