<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	
	$anio = 2020;
	$idArea = $_POST["idArea"];
	$tipo = $_POST["tipo"];
	$total = $_POST["total"];
	
	
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
	$styleColor= "";
	$seleccion = "";
	$onclick = "";
	
	if($tipo == 1){ $styleColor = "#5cb85c";}else if($tipo == 2){ $styleColor = "#efd707";}else{ $styleColor = "#d9534f";}
	$totEje1 = 0;$totEje2 = 0;$totEje3 = 0;$totEje4 = 0;$totEje5 = 0;$totEje6 = 0;
	$totEje7 = 0;$totEje8 = 0;$totEje9 = 0;$totEje10 = 0;$totEje11 = 0; $totalesArea = 0;
	foreach($areas as $area)
	{		
		$focosArea = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,1,$tipo);
		if($focosArea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",1,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea->getTotal()."</p></div>";
		$totEje1 += $focosArea->getTotal();
		
		$focosArea2 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,2,$tipo);
		if($focosArea2->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",2,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea2->getTotal()."</p></div>";
		$totEje2 += $focosArea2->getTotal();
		
		$focosArea3 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,3,$tipo);
		if($focosArea3->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",3,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea3->getTotal()."</p></div>";
		$totEje3 += $focosArea3->getTotal();
		
		$focosArea4 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,4,$tipo);
		if($focosArea4->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",4,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea4->getTotal()."</p></div>";
		$totEje4 += $focosArea4->getTotal();
		
		$focosArea5 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,5,$tipo);
		if($focosArea5->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",5,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea5->getTotal()."</p></div>";
		$totEje5 += $focosArea5->getTotal();
		
		$focosArea6 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,6,$tipo);
		if($focosArea6->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",6,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea6->getTotal()."</p></div>";
		$totEje6 += $focosArea6->getTotal();
		
		$focosArea7 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,7,$tipo);
		if($focosArea7->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{$onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",7,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea7->getTotal()."</p></div>";
		$totEje7 += $focosArea7->getTotal();
		
		$focosArea8 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,8,$tipo);
		if($focosArea8->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",8,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea8->getTotal()."</p></div>";
		$totEje8 += $focosArea8->getTotal();
		
		$focosArea9 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,9,$tipo);
		if($focosArea9->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",9,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea9->getTotal()."</p></div>";
		$totEje9 += $focosArea9->getTotal();
		
		$focosArea10 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,10,$tipo);
		if($focosArea10->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",10,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea10->getTotal()."</p></div>";
		$totEje10 += $focosArea10->getTotal();
		
		$focosArea11 = $act -> mostrarTotalfocosEnviadosAreaEstatus($area->getIdArea(),$idArea,11,$tipo);
		if($focosArea11->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",".$idArea.",11,".$tipo.")' "; $style="style='background-color: ".$styleColor.";'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea11->getTotal()."</p></div>";
		$totEje11 += $focosArea11->getTotal();
		
		$totalesArea = $focosArea->getTotal() + $focosArea2->getTotal() + $focosArea3->getTotal() + $focosArea4->getTotal() + $focosArea5->getTotal() + $focosArea6->getTotal() + $focosArea7->getTotal() + $focosArea8->getTotal() + $focosArea9->getTotal() + $focosArea10->getTotal() + $focosArea11->getTotal();
		$cadenaTotalesArea .= "<div  id='totalArea".$area->getIdArea()."' onclick=''  class=' j2 horizontal'><p class='rotarT'>".$totalesArea."</p></div>";
		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";

	}
	
	
	
	
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
		<div class="totEj" ><p><?php echo $totEje1;?></p></div>
	</div>
	<div class="flotante" style="top: 52px;">
		<?php echo $cadenaAreasEje2;?>
		<div class="totEj" ><p><?php echo $totEje2;?></p></div>
	</div>
	<div class="flotante" style="top: 51px;">
		<?php echo $cadenaAreasEje3;?>
		<div class="totEj" ><p><?php echo $totEje3;?></p></div>
	</div>
	<div class="flotante" style="top: 50px;">
		<?php echo $cadenaAreasEje4;?>
		<div class="totEj" ><p><?php echo $totEje4;?></p></div>
	</div>
	<div class="flotante" style="top: 49px;">
		<?php echo $cadenaAreasEje5;?>
		<div class="totEj" ><p><?php echo $totEje5;?></p></div>
	</div>
	<div class="flotante" style="top: 48px;">
		<?php echo $cadenaAreasEje6;?>
		<div class="totEj" ><p><?php echo $totEje6;?></p></div>
	</div>
	<div class="flotante" style="top: 47px;">
		<?php echo $cadenaAreasEje7;?>
		<div class="totEj" ><p><?php echo $totEje7;?></p></div>
	</div>
	<div class="flotante" style="top: 46px;">
		<?php echo $cadenaAreasEje8;?>
		<div class="totEj" ><p><?php echo $totEje8;?></p></div>
	</div>
	<div class="flotante" style="top: 45px;">
		<?php echo $cadenaAreasEje9;?>
		<div class="totEj" ><p><?php echo $totEje9;?></p></div>
	</div>
	<div class="flotante" style="top: 44px;">
		<?php echo $cadenaAreasEje10;?>
		<div class="totEj" ><p><?php echo $totEje10;?></p></div>
	</div>
	<div class="flotante" style="top: 43px;">
		<?php echo $cadenaAreasEje11;?>
		<div class="totEj" ><p><?php echo $totEje11;?></p></div>
	</div>
	
	<div class="flotante" style="top: 42px;">
		<?php echo $cadenaTotalesArea;?>
		<div class="totEj" ><p style="font-size: 15px;"><?php echo $total;?></p></p></div>
	</div>
</div>

</body>
<script>

var padre = $(window.parent.document);
<?php echo $seleccion;?>

</script>
</html>
