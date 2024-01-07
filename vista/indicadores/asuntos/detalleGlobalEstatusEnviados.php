<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	
	$anio = 2020;
	$idDestino = $_POST["idDestino"];
	$idEje = $_POST["idEje"];
	$tipo = $_POST["tipo"];
	$server = $_SERVER['SERVER_NAME'];
	$idUsuario = $_POST["idUsuario"];
	$idAreaUsuario = $_POST["idAreaUsuario"];
	$estatus = $_POST["estatus"];
	$estatusRegreso = $_POST["estatusRegreso"];
	
	$cadenafuncion = "";
	
	$act = new IndicadorController();
	$asuntos = $act -> mostrarDetalleAsuntosEnviadosEstatusGlobales($idDestino,$idEje,$tipo,$estatus);
	$cadenaTabla = "";
	$i = 1;
	$color = "";
	$ultimaAct = "";
	$onclick = "";
	$icon = "";
	$resp = "";
	$conver = "";
	$tipoA = "";
	foreach($asuntos as $asunto)
	{
	
		if($asunto->getEstatus() == 1){
			$color = "background-color: #d8534f;";
			$icon = "<i onclick='responder(".$asunto->getId().")' style='cursor:pointer;' class='fas fa-user-edit'></i>";
			$conver="";
			
		}else if($asunto->getEstatus() == 2){
			$color = "background-color: #efd707;";
			$icon = "<i onclick='responder(".$asunto->getId().")'  style='cursor:pointer;' class='fas fa-user-edit'></i>";
			$conver = "<i onclick='conversacion(".$asunto->getId().",".$idDestino.",".$idOrigen.")' style='cursor:pointer;' class='far fa-comments'></i>";
			
		}else{
			$color = "background-color: #5bb75b;";
			$icon = "";
			$resp = "";
			$conver = "<i onclick='conversacion(".$asunto->getId().",".$idDestino.",".$idOrigen.")' style='cursor:pointer;' class='far fa-comments'></i>";
		}
		if($asunto->getActSub() != null)
		{
			$ultimaAct = $asunto->getActSub();
		}else if($asunto->getActParticular() != null)
		{
			$ultimaAct = $asunto->getActParticular();
		}else if($asunto->getActGeneral() != null)
		{
			$ultimaAct = $asunto->getActGeneral();
		}
		else {
			$ultimaAct = $asunto->getActGlobal();
		}
		
		if($asunto->getIdEntregableEspecifico() > 0 )
		{
			$onclick = "<p style='cursor:pointer' onclick='entregables(".$asunto->getIdEntregableEspecifico().")' >Insumos y Entregables</p>";
		}else{
			$onclick = "";
		}
		
		if($asunto->getTipo() == 1){
			$tipoA ="Solicitud";
		}else if($asunto->getTipo() == 2){
			$tipoA ="Conocimiento";
		}else if($asunto->getTipo() == 3){
			$tipoA ="Sugerencia";
		}else{
			$tipoA ="Problemática";
		}
		
		$cadenaTabla .= "<tr><th style='width: 25px;".$color."' scope='row'>".$i."<br><br>".$conver."<br><br>".$icon."<br><br>".$resp."</th><td><b>".$tipoA."</b><br>Enviado por : ".$asunto->getNombreArea()." (".$asunto->getNombreUsuario().")<br>para: ".$asunto->getNombreAreaDestino()." (".$asunto->getNombreUsuarioDestino().")<br><div style='font-size: 8.5px;'>".$asunto->getNombreEje()."<br>".$ultimaAct."</div> <div class='respuesta'><b style='text-decoration: underline #607D8B;'>".$asunto->getDescripcion()."</b><br>".$asunto->getRespuesta()." <div class='fecha'>".date('Y-m-d H:i', strtotime($asunto->getFecha()))."</div></div> <div class='divResponde' id='responde".$i."'></div></td><td>".$onclick."</td></tr>"; 
		
		if($asunto->getEstatus() <= 2){
		$cadenafuncion .= "function respondeAsunto".$i."(){ $('#responde".$i."').css('display','block');  $('#responde".$i."').html(\"<form><div class='form-group'><textarea style='font-size: 10px;border-radius: 0px;resize: none;' class='form-control' rows='4' maxlength='400' id='comment'></textarea><button style='padding: 1px 6px;font-size: 11px;border-radius: 0px;background-color: #4d4d57;color: white;margin-top: 5px;' type='submit' class='btn btn-default'>Enviar</button></div></form>\"); }";
		}else{
			$cadenafuncion = "";
		}
		$i++;
	}
	
	//<td style='font-size: 8.5px;'><b>".$asunto->getNombreEje()."</b><br>".$asunto->getActGlobal()."<br>".$asunto->getActGeneral()."<br>".$asunto->getActParticular()."<br>".$asunto->getActSub()."

	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
   <script src="https://use.fontawesome.com/779a643cc8.js"></script>

	
	
	<style>
	.my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
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

.respuesta{
	border: .5px solid #d6d4d4;
    padding-left: 5px;
   /* box-shadow: 2px 3px 5px;*/
   font-size: 11px;
}

.tituloModal{
	    font-size: 12px;
    font-family: 'Muli-Bold';
    text-align: center;
    margin-top: -19px;
    margin-bottom: 8px;
}

.fecha{
	    font-size: 9px;
}

div#cajaEI{
	margin-left: 90px;
    margin-top: 5px;
}

table.table tbody tr.selected {
    background-color: #e6e6e1;
}

.divResponde{
	display: none;
    border: 1px solid black;
    height: 100px;
    font-family: 'Muli-Regular';
    font-size: 10px;
}

	</style>
</head>
<body>

<div style="margin-top: -26px;" class="table-wrapper-scroll-y my-custom-scrollbar">
	<table id="table" class="table table-bordered  mb-0">
		<thead></thead>
		<tbody><?php echo $cadenaTabla; ?></tbody>
	</table>
</div>
<div id="cajaEI">
<?php 

?>
</div>

<iframe scrolling="no" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+1)+'px';"  name="myiframe" id="myiframe" src="" style="border: 0;width: 616px;margin-left: 1px;">

</iframe>

</body>

	
<script>
$('document').ready(function()
{
	$('#table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
	
});


function entregables(idEntregableEspecifico)
{
	//$.post("<?php echo $sever; ?>/sie/vista/apps/Asuntos/indexAct.php",{action:'entregables',idConversacion:456,idUsuario:3,idArea:16, anio:2020,tipo:4,opcion:'recibido',idEje:7,idAreaU:5,idEntregable:7}, function( data ) {
  	/*	$.post("<?php echo $server; ?>/sie/vista/apps/Asuntos/indexAct.php",{action:'entregables',idEntregable:7}, function( data ) {
  		
    		$("#cajaEI").html(data);
    	});*/
	var idEntregableEspecifico = idEntregableEspecifico;
	$('iframe#myiframe').attr('src','/sie/vista/apps/Asuntos/indexAct.php?action=entregables&idEntregable='+idEntregableEspecifico);	
	
		
}

function responder(idConversacion) 
{
	var idConversacion = idConversacion;
	var anio = <?php echo $anio; ?>;
	var idArea = <?php echo $idDestino; ?>;
	var idUsuario = <?php echo $idUsuario; ?>;
	var idAreaUsuario = <?php echo $idAreaUsuario; ?>;
	var estatusRegreso = <?php echo $estatusRegreso; ?>;
	location.replace("/sie/vista/apps/Asuntos/index.php?ind=12&estatusIndicador="+estatusRegreso+"&ac=1&idUsuario="+idUsuario+"&idArea="+idArea+"&anio="+anio+"&tipo=0&opcion=enviado&idEje=0&idAreaU="+idAreaUsuario+"&idConversacion="+idConversacion); 
}


function conversacion(idConversacion,idDestino,idOrigen)
{
	//$.post("<?php echo $sever; ?>/sie/vista/apps/Asuntos/indexAct.php",{action:'entregables',idConversacion:456,idUsuario:3,idArea:16, anio:2020,tipo:4,opcion:'recibido',idEje:7,idAreaU:5,idEntregable:7}, function( data ) {
  	/*	$.post("<?php echo $server; ?>/sie/vista/apps/Asuntos/indexAct.php",{action:'entregables',idEntregable:7}, function( data ) {
  		
    		$("#cajaEI").html(data);
    	});*/
	var idConversacion = idConversacion;
	var idDestino = idDestino;
	var idOrigen = idOrigen;
	$('iframe#myiframe').attr('src','conversacion.php?idConversacion='+idConversacion+'&idDestino='+idDestino+'&idOrigen='+idOrigen);	
	
		
}


<?php echo $cadenafuncion; ?>


</script>
</html>
