<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	include_once __DIR__."/../../../source/controller/LogroController.php";
	
	$anio = 2020;
	
	$actLogro = new LogroController();
	$exposiciones = $actLogro -> mostrarExposiciones();
	
	$cadenaTabla ="";
	$totSinLlenar = 0;
	$totTerminados = 0;
	$totEnProceso = 0;
	$totEntregables = 0;
	$totGlobal = 0;
	$percent = 0.0;
	$percentGlobal = 0.0;
	foreach($exposiciones as $expo){
		
		$exposLogros = $actLogro  -> mostrarTotalLogrosMetasExpoNoEditados($expo->getId());
		$totalExpoLogro = $exposLogros -> getTotal();
		
		$exposLogrosT = $actLogro  -> mostrarTotalLogrosMetasExpoTerminados($expo->getId());
		$totalExpoLogroTer = $exposLogrosT -> getTotal();
		
		$exposLogrosE = $actLogro  -> mostrarTotalLogrosMetasExpoEditados($expo->getId());
		$totalExpoLogroE = $exposLogrosE -> getTotal();
		
		$exposLogrosEnt = $actLogro  -> mostrarTotalLogrosMetasExpoEntregable($expo->getId());
		$totalExpoLogroEnt = $exposLogrosEnt -> getTotal();
		
		$exposLogrostotal = $actLogro  -> mostrarTotalLogrosMetasExpo($expo->getId());
		$totalExposicion = $exposLogrostotal -> getTotal();
		
		
		
		$totSinLlenar +=  $totalExpoLogro;
		$totTerminados +=  $totalExpoLogroTer;
		$totEnProceso +=  $totalExpoLogroE;
		$totEntregables +=  $totalExpoLogroEnt;
		$totGlobal +=  $totalExposicion;
		
		$percent = (($totalExpoLogroTer + $totalExpoLogroE)*100)/$totalExposicion;
		
	
		$cadenaTabla .= "<tr><td>(".$expo->getAnio().") ".$expo->getNombreExposicion()." <p class='avanceExpo'>".number_format($percent, 0, '.', '')."% avance<br><meter min='0' max='100' low='20' high='60' optimum='100'  value='".number_format($percent, 0, '.', '')."'></meter></p></td><td onclick='abreSubModal(7,\"Logros de Exposiciones temporales\",\" de actividades sin llenar (".$expo->getNombreExposicion().")\",".$totalExpoLogro.",2,".$expo->getId().");' style='cursor:pointer;color:red'>".$totalExpoLogro."</td><td onclick='abreSubModalTerminado(7,\"Logros de Exposiciones temporales\",\" de actividades terminados (".$expo->getNombreExposicion().")\",".$totalExpoLogroTer.",2,".$expo->getId().");'  style='cursor:pointer;color:#107c10'>".$totalExpoLogroTer."</td><td onclick='abreSubModalProceso(7,\"Logros de Exposiciones temporales\",\" de actividades en proceso (".$expo->getNombreExposicion().")\",".$totalExpoLogroE.",2,".$expo->getId().");' style='cursor:pointer;color:#ffb900'>".$totalExpoLogroE."</td><td onclick='abreModalEntregableExpo(7,2,".$expo->getId().",\" (".$expo->getNombreExposicion().")\")' style='cursor:pointer;color:#2196F3' >".$totalExpoLogroEnt."</td></tr>";
		
	}
	$percentGlobal = (($totTerminados + $totEnProceso)*100)/$totGlobal;

	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<!--<link rel="stylesheet" type="text/css" href="../resources/css/inicio.css"/>-->
	
	
	
	
	<style>
	
	.avanceExpo {
    font-size: 11px;
    height: 10px;
}
	</style>
	
</head>
<body>

<div class="resumen2">


<table style="font-fami ly: 'Muli-Regular';font-size: 11px;" class="table table-bordered">
    <thead>
	
      <tr>
        <!--<th style="color:white">Eje</th>-->
        <th style="font-size:13px">Avance de Exposiciones en el 2020
		<p class='avanceExpo'><?php echo number_format($percentGlobal, 0, '.', '') ?>% avance <br><meter min='0' max='100' low='20' high='60' optimum='100'  value='<?php echo number_format($percentGlobal, 0, '.', '')?>'></meter></p>
		</th>
		
		<th style="background-color: #efeffb;">Sin llenar <b style='color:red'><?php echo $totSinLlenar;?></b></th>
		<th style="background-color: #efeffb;">Terminados <b style='color:#107c10'><?php echo $totTerminados;?></b></th>
		<th style="background-color: #efeffb;">En proceso <b style='color:#ffb900'><?php echo $totEnProceso;?></b></th>
		<th style="background-color: #efeffb;">Con entregable <b style='color:#2196F3'><?php echo $totEntregables;?></b></th>
		<!--
        <th style="background-color: #f7f6f1;width: 88px;">Logros metas</th>
		<th style="background-color: #f7f6f1;">Sin llenar</th>
		<th style="background-color: #f7f6f1;">Terminados</th>
		<th style="background-color: #f7f6f1;">En proceso</th>
		<th style="background-color: #f7f6f1;">Con entregable</th>
		
		<th style="color:white">Total</th>
		-->
      </tr>
    </thead>
    <tbody>
		<?php echo $cadenaTabla; ?>
      
    </tbody>
  </table>
</div>
<div style=" width: 800px;" class="modal fade " id="myModal250" role="dialog">
    <div class="modal-dialog modal-lg">
      <div style="left: -100px;" class="modal-content">
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-number="2">&times;</button>
		   
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body detalle3">
          
        </div>
        
      </div>
    </div>
	
 </div>

<div style="width: 800px;" class="modal fade" id="myModalEntregablesExpo" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style='    width: 662px;height:600px;left: -106px;'>
        <div class="modal-header" style="padding: 0px;">
          <button type="button" class="close" data-number="3">&times;</button>
          <h4 class="modal-title" style="font-family: 'Muli-SemiBold';font-size: 12px;  text-align: center;">Listado de entregables <b class="tit"></b></h4>
        </div>
        <div class="modal-body detalleEntExpo">
          
        </div>
        
      </div>
    </div>
 </div>

</body>
<script>
$('document').ready(function()
{ 
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover(); 

});

var padre = $(window.parent.document);
<?php echo $seleccion;?>



$(document).ready(function(){
	$('.btnMod').click(function(e) {
	    e.preventDefault();
		$('.btnMod').removeClass('selector');
		$(this).addClass('selector');
	});
});


function abreSubModal(idEje,nombreEje,titulo,total,tipo,idExposicion)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var tipo = tipo;
	var idExposicion=idExposicion;
	
	$("#myModal250").modal("show");
	
	$.post("detalleExposicion.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,tipo:tipo,idExposicion:idExposicion}, function(data) {
		$(".detalle3").html('');
		$(".detalle3").html(data);
	});
	
}


function abreSubModalTerminado(idEje,nombreEje,titulo,total,tipo,idExposicion)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var tipo = tipo;
	var idExposicion=idExposicion;
	
	$("#myModal250").modal("show");
	
	$.post("detalleExposicionTerminado.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,tipo:tipo,idExposicion:idExposicion}, function(data) {
		$(".detalle3").html('');
		$(".detalle3").html(data);
	});
	
}

function abreSubModalProceso(idEje,nombreEje,titulo,total,tipo,idExposicion)
{
	var idEje = idEje;
	var nombreEje = nombreEje;
	var titulo = titulo;
	var total = total;
	var tipo = tipo;
	var idExposicion=idExposicion;
	
	$("#myModal250").modal("show");
	
	$.post("detalleExposicionProceso.php",{idEje:idEje,nombreEje:nombreEje,titulo:titulo,total:total,tipo:tipo,idExposicion:idExposicion}, function(data) {
		$(".detalle3").html('');
		$(".detalle3").html(data);
	});
	
}


function abreModalEntregableExpo(idEje,tipo,idExposicion,nombreExposicion)
{

	var idEje = idEje;
	var tipo = tipo;
	var idExposicion = idExposicion;
	var nombreExposicion = nombreExposicion;
	$("#myModalEntregablesExpo").modal("show");
	
	$.post("entregablesExposicion.php",{idEje:idEje,tipo:tipo,idExposicion:idExposicion}, function(data) {
		$(".detalleEntExpo").html('');
		$(".detalleEntExpo").html(data);
		$(".tit").html('');
		$(".tit").html(nombreExposicion);
	});
	
}

$("button[data-number=2]").click(function(){
	$("#myModal250").modal("hide");
});

$("button[data-number=3]").click(function(){
	$("#myModalEntregablesExpo").modal("hide");
});

</script>
</html>
