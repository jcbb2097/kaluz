<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	
	$anio = 2020;
	$idArea = $_POST["idArea"];
	$tipo = $_POST["tipo"];
	$total = $_POST["total"];
	$idUsuario = $_POST["idUsuario"];
	$idAreaUsuario = $_POST["idAreaUsuario"];
	$estatus = $_POST["estatus"];
	
	
	
	
	$act = new IndicadorController();
	
	$areaControllerAct =  new AreaController();
	$areas = $areaControllerAct -> mostrarAreas();
	$cadenaAreasEje1 = "";
	$cadenaAreasEje2 = "";
	$cadenaAreasEje3 = "";
	$cadenaAreasEje4 = "";
	$cadenaAreasEje5 = "";
	$cadenaAreasEje6 = "";
	$cadenaAreasEje7 = "";
	$cadenaAreasEje8 = "";
	$cadenaAreasEje9 = "";
	$cadenaAreasEje10 = "";
	$cadenaAreasEje11 = "";
	$cadenaTotalesArea = "";
	$style="";
	$styleColor= "#0093a3";
	$seleccion = "";
	$onclick = "";
	
	if($estatus == 1){ $styleColor = "#5cb85c";}else if($estatus == 2){ $styleColor = "#efd707";}else{ $styleColor = "#d9534f";}
	$totEje1 = 0;$totEje2 = 0;$totEje3 = 0;$totEje4 = 0;$totEje5 = 0;$totEje6 = 0;
	$totEje7 = 0;$totEje8 = 0;$totEje9 = 0;$totEje10 = 0;$totEje11 = 0; $totalesArea = 0;
	$percentAtenArea = 0.0;
	
	foreach($areas as $area)
	{		
		$asuntosArea = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),1,$tipo,$estatus);
		if($asuntosArea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",1,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea->getTotal()."</p></div>";
		$totEje1 += $asuntosArea->getTotal();
		
		$asuntosArea2 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),2,$tipo,$estatus);
		if($asuntosArea2->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",2,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea2->getTotal()."</p></div>";
		$totEje2 += $asuntosArea2->getTotal();
		
		$asuntosArea3 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),3,$tipo,$estatus);
		if($asuntosArea3->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",3,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea3->getTotal()."</p></div>";
		$totEje3 += $asuntosArea3->getTotal();
		
		$asuntosArea4 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),4,$tipo,$estatus);
		if($asuntosArea4->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",4,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea4->getTotal()."</p></div>";
		$totEje4 += $asuntosArea4->getTotal();
		
		$asuntosArea5 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),5,$tipo,$estatus);
		if($asuntosArea5->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",5,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea5->getTotal()."</p></div>";
		$totEje5 += $asuntosArea5->getTotal();
		
		$asuntosArea6 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),6,$tipo,$estatus);
		if($asuntosArea6->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",6,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea6->getTotal()."</p></div>";
		$totEje6 += $asuntosArea6->getTotal();
		
		$asuntosArea7 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),7,$tipo,$estatus);
		if($asuntosArea7->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",7,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea7->getTotal()."</p></div>";
		$totEje7 += $asuntosArea7->getTotal();
		
		$asuntosArea8 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),8,$tipo,$estatus);
		if($asuntosArea8->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",8,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea8->getTotal()."</p></div>";
		$totEje8 += $asuntosArea8->getTotal();
		
		$asuntosArea9 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),9,$tipo,$estatus);
		if($asuntosArea9->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",9,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea9->getTotal()."</p></div>";
		$totEje9 += $asuntosArea9->getTotal();
		
		$asuntosArea10 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),10,$tipo,$estatus);
		if($asuntosArea10->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",10,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea10->getTotal()."</p></div>";
		$totEje10 += $asuntosArea10->getTotal();
		
		$asuntosArea11 = $act -> mostrarTotalAsuntosRecibidosAreaTipoEstatusParticulares($idArea,$area->getIdArea(),11,$tipo,$estatus);
		if($asuntosArea11->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalleEstatus(".$idArea.",".$area->getIdArea().",11,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea11->getTotal()."</p></div>";
		$totEje11 += $asuntosArea11->getTotal();
		
		$totalesArea = $asuntosArea->getTotal() + $asuntosArea2->getTotal() + $asuntosArea3->getTotal() + $asuntosArea4->getTotal() + $asuntosArea5->getTotal() + $asuntosArea6->getTotal() + $asuntosArea7->getTotal() + $asuntosArea8->getTotal() + $asuntosArea9->getTotal() + $asuntosArea10->getTotal() + $asuntosArea11->getTotal();
		
		$atendidos = $act -> mostrarTotalAsuntosAtendidosRecibidosArea($idArea,$area->getIdArea(),$tipo);
		if($totalesArea > 0)
		{
			$percentAtenArea = ($atendidos->getTotal() / $totalesArea)*100;
		}else{
			$percentAtenArea = 0.0;
		}
		
		
		$cadenaTotalesArea .= "<div  id='totalArea".$area->getIdArea()."' onclick=''  class=' j2 horizontal'><p class='rotarT'>".$totalesArea."</p><p class='porcentajeTot'>".number_format($percentAtenArea, 1, '.', '')."<br>%</p></div>";
		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";

	}
	$totalesEjesAreas = $totEje1 + $totEje2 + $totEje3 + $totEje4 + $totEje5 + $totEje6 + $totEje7 + $totEje8 + $totEje9 + $totEje10 + $totEje11;
	
	/*atencion porcentajes*/
	
	$actAten = new IndicadorController();
	$totAtenEje1 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(1,$idArea,$tipo);
	$percent1Eje = 0.0;
	if($totEje1 > 0){ $percent1Eje = ($totAtenEje1->getTotal() / $totEje1)*100; }
	
	$totAtenEje2 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(2,$idArea,$tipo);
	$percent2Eje = 0.0;
	if($totEje2 > 0){ $percent2Eje = ($totAtenEje2->getTotal() / $totEje2)*100; }
	
	$totAtenEje3 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(3,$idArea,$tipo);
	$percent3Eje = 0.0;
	if($totEje3 > 0){ $percent3Eje = ($totAtenEje3->getTotal() / $totEje3)*100; }
	
	$totAtenEje4 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(4,$idArea,$tipo);
	$percent4Eje = 0.0;
	if($totEje4 > 0){ $percent4Eje = ($totAtenEje4->getTotal() / $totEje4)*100; }
	
	$totAtenEje5 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(5,$idArea,$tipo);
	$percent5Eje = 0.0;
	if($totEje5 > 0){ $percent5Eje = ($totAtenEje5->getTotal() / $totEje5)*100; }
	
	$totAtenEje6 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(6,$idArea,$tipo);
	$percent6Eje = 0.0;
	if($totEje6 > 0){ $percent6Eje = ($totAtenEje6->getTotal() / $totEje6)*100; }
	
	$totAtenEje7 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(7,$idArea,$tipo);
	$percent7Eje = 0.0;
	if($totEje7 > 0){ $percent7Eje = ($totAtenEje7->getTotal() / $totEje7)*100; }
	
	$totAtenEje8 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(8,$idArea,$tipo);
	$percent8Eje = 0.0;
	if($totEje8 > 0){ $percent8Eje = ($totAtenEje8->getTotal() / $totEje8)*100; }
	
	$totAtenEje9 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(9,$idArea,$tipo);
	$percent9Eje = 0.0;
	if($totEje9 > 0){ $percent9Eje = ($totAtenEje9->getTotal() / $totEje9)*100; }
	
	$totAtenEje10 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(10,$idArea,$tipo);
	$percent10Eje = 0.0;
	if($totEje10 > 0){ $percent10Eje = ($totAtenEje10->getTotal() / $totEje10)*100; }
	
	$totAtenEje11 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(11,$idArea,$tipo);
	$percent11Eje = 0.0;
	if($totEje11 > 0){ $percent11Eje = ($totAtenEje11->getTotal() / $totEje11)*100; }
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	
</head>
<body>


	<div class="flotante">
		<?php echo $cadenaAreasEje1;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje1;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent1Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 52px;">
		<?php echo $cadenaAreasEje2;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje2;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent2Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 51px;">
		<?php echo $cadenaAreasEje3;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje3;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent3Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 50px;">
		<?php echo $cadenaAreasEje4;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje4;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent4Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 49px;">
		<?php echo $cadenaAreasEje5;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje5;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent5Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 48px;">
		<?php echo $cadenaAreasEje6;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje6;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent6Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 47px;">
		<?php echo $cadenaAreasEje7;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje7;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent7Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 46px;">
		<?php echo $cadenaAreasEje8;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje8;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent8Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 45px;">
		<?php echo $cadenaAreasEje9;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje9;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent9Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 44px;">
		<?php echo $cadenaAreasEje10;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje10;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent10Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	<div class="flotante" style="top: 43px;">
		<?php echo $cadenaAreasEje11;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje11;?></p>
			<p class="totEjeFinPercent"><?php echo number_format($percent11Eje, 1, '.', '');?>% atendido</p>
		</div>
	</div>
	
	<div class="flotante" style="top: 42px;">
		<?php echo $cadenaTotalesArea;?>
		<div class="totEj" >
			<p  style="font-size: 15px;"><?php echo $totalesEjesAreas;?></p>
		</div>
	</div>


</body>
<script>

var padre = $(window.parent.document);
<?php echo $seleccion;?>

</script>
</html>
