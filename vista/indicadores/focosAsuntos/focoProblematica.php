<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	
	$anio = 2020;
	$idArea = $_GET["idArea"];
	$nombreArea = $_GET["nombreArea"];
	$idUsuario = $_GET["idUsuario"];
	$idAreaUsuario = $_GET["idAreaUsuario"];
	
	$act = new IndicadorController();
	$focos = $act -> mostrarTotalfocosRecibidos($idArea);
	$total = $focos -> getTotal();
	
	/*total enviados*/
	$focosE = $act -> mostrarTotalfocosEnviados($idArea);
	$totalE = $focosE -> getTotal();
	/**/
	
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
	$style= "";
	$seleccion = "";
	$onclick = "";
	
	$totEje1 = 0;$totEje2 = 0;$totEje3 = 0;$totEje4 = 0;$totEje5 = 0;$totEje6 = 0;
	$totEje7 = 0;$totEje8 = 0;$totEje9 = 0;$totEje10 = 0;$totEje11 = 0; $totalesArea = 0;
	foreach($areas as $area)
	{		
		$focosArea = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),1);
		if($focosArea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",1,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea->getTotal()."</p></div>";
		$totEje1 += $focosArea->getTotal();	
		
		$focosArea2 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),2);
		if($focosArea2->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",2,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea2->getTotal()."</p></div>";
		$totEje2 += $focosArea2->getTotal();
		
		$focosArea3 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),3);
		if($focosArea3->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",3,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea3->getTotal()."</p></div>";
		$totEje3 += $focosArea3->getTotal();
		
		$focosArea4 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),4);
		if($focosArea4->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",4,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea4->getTotal()."</p></div>";
		$totEje4 += $focosArea4->getTotal();
		
		$focosArea5 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),5);
		if($focosArea5->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",5,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea5->getTotal()."</p></div>";
		$totEje5 += $focosArea5->getTotal();
		
		$focosArea6 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),6);
		if($focosArea6->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",6,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea6->getTotal()."</p></div>";
		$totEje6 += $focosArea6->getTotal();
		
		$focosArea7 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),7);
		if($focosArea7->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",7,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea7->getTotal()."</p></div>";
		$totEje7 += $focosArea7->getTotal();
		
		$focosArea8 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),8);
		if($focosArea8->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",8,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea8->getTotal()."</p></div>";
		$totEje8 += $focosArea8->getTotal();
		
		$focosArea9 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),9);
		if($focosArea9->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",9,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea9->getTotal()."</p></div>";
		$totEje9 += $focosArea9->getTotal();
		
		$focosArea10 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),10);
		if($focosArea10->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",10,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea10->getTotal()."</p></div>";
		$totEje10 += $focosArea10->getTotal();
		
		$focosArea11 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),11);
		if($focosArea11->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$idArea.",".$area->getIdArea().",11,4)' "; $style="style='background-color: #0093a3;color:white;'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$focosArea11->getTotal()."</p></div>";
		$totEje11 += $focosArea11->getTotal();
		
		$totalesArea = $focosArea->getTotal() + $focosArea2->getTotal() + $focosArea3->getTotal() + $focosArea4->getTotal() + $focosArea5->getTotal() + $focosArea6->getTotal() + $focosArea7->getTotal() + $focosArea8->getTotal() + $focosArea9->getTotal() + $focosArea10->getTotal() + $focosArea11->getTotal();
		$cadenaTotalesArea .= "<div  id='totalArea".$area->getIdArea()."' onclick=''  class=' j2 horizontal'><p class='rotarT'>".$totalesArea."</p><p class='porcentajeTot'>0%</p></div>";
		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";
	}
	
	/*totales por estatus*/
	
	$actC = new IndicadorController();
	$resueltos = $actC -> mostrarTotalfocosRecibidosResueltos($idArea);
	$totalResueltos = $resueltos -> getTotal();
	
	$enSeguimiento = $actC -> mostrarTotalfocosRecibidosEnSeguimiento($idArea);
	$totalEnSeguimiento = $enSeguimiento -> getTotal();
	
	$sinAtender = $actC -> mostrarTotalfocosRecibidosSinAtender($idArea);
	$totalSinAtender = $sinAtender -> getTotal();
	
	$percent1 = 0;
	$percent2 = 0;
	$percent3 = 0;
	
	$percent1 = ($totalResueltos * 100)/ $total;
	$percent2 = ($totalEnSeguimiento * 100)/ $total;
	$percent3 = ($totalSinAtender * 100)/ $total;
	
	/*porcentaje enviados*/
	
	$actC = new IndicadorController();
	$resueltosE = $actC -> mostrarTotalfocosEnviadosResueltos($idArea);
	$totalResueltosE = $resueltosE -> getTotal();
	
	$percent1E = 0;
	$percentR = 0;
	
	if($totalE > 0)
	{
		$percent1E = ($totalResueltosE * 100)/ $totalE;
	}
	if($total > 0)
	{
		$percentR = ($totalResueltos * 100)/ $total;
	}
	
	/********************/
	
	
	
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
	
body{

overflow-y:hidden;
overflow-x:hidden;

background-color:#ffffff;
}

div.horizontal{
/*width: 29.3px;*/
width: 30.27px; 
/* este tamaño tenia hasta la version 82 de chrome
width: 30.27px;*/
padding: 25px 0;
margin: 0;
border-right: .5px solid #a9a9ae;
height: 53px;

display: flex;
    align-items: center;
    justify-content: center;
}

.flotante{  /*padre*/
	overflow: hidden;
	/*width: 910px ; antes de 83 chrome*/
	width: 909px ;
	position:relative;
	left:-3px;
	top:53px;
	height:54px;
	border-bottom: 1px solid #a9a9ae;
	font-family: 'Muli-Regular';
	display:flex;/*se agrego para la version 83 de chrome*/
}



.j:hover{

/*background-color:#0093a3;*/
color:#0093a3;


}

.active, .j:hover {
   /* background-color: #878787;*/
	/*background-color:#0093a3 !important;*/
    color: white;
}


div.j{
	float: left;
	cursor:pointer;
}



.well2{
	min-height: 20px;
	font-family: 'Muli-SemiBold';
	font-size: 11px;
	padding: 8px;
	margin-bottom: 20px;
	background-color: #5a274f;
	border: 1px solid #5a274f;
	border-radius: 0px;
	color: #fefefe;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
}
	
.wr{
	background-color: #4d4d57;
    border: 1px solid #4d4d57;
    margin-top: -20px;
    height: 31px;
}

.global{
	margin-top: -74px;
}

.totales{
	position: absolute;
    top: 41px;
    left: 57px;
    border: .5px solid #a9a9ae;
    width: 31px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.rotar{
	font-size: 11px;
    font-family: 'Muli-SemiBold';
}

.progress2{
	position: absolute;
    top: 41px;
    left: 88px;
    width: 332px;
    border-radius: 0px;
    font-family: 'Muli-Regular';
    height: 17px;
}

.font{
	font-family: 'Muli-SemiBold';
    font-size: 11px;
}




.tooltiptext2 {
 position: fixed;
    top: 26px;
    z-index: 1;
    left: 57px;
    visibility: hidden;
}

.font:hover .tooltiptext2 {
  visibility: visible;
}

.selector{
	border: 1px solid #ffffff;
	font-size: 12px;
    box-shadow: -2px 2px 5px #4d4d57;
}

.tooltip.bottom {
    padding: 5px 0;
    margin-top: 8px;
	font-family:'Muli-Regular';
	font-size:10px;
}


.totEj{
	position: relative;
    top: 14px;
    left: 36px;
    font-family: 'Muli-Bold';
    font-size: 12px;
}

.clsPro{
	width: 91px;
    height: 9px;
    position: absolute;
    top: 12px;
    right: 242px;
    border-radius: 0px;
}

.clsProEnv{
	width: 91px;
    height: 9px;
    position: absolute;
    top: 12px;
    right: 121px;
    border-radius: 0px;
}

.clsProSub{
	width: 40%;
    font-size: 9px;
    font-family: 'Muli-Bold';
    line-height: 10px;
	color: #4d4d57;
}

.rotarT{
	font-family: 'Muli-Bold';
    font-size: 12px;
}

.j2:hover {
   
	background-color:#0093a3 !important;
    color: white;
}


.modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 11px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  
  .totEjeFin{
	      font-family: 'Muli-Bold';
    font-size: 12px;
    top: -3px;
    position: absolute;
  }
  
  .totEjeFinPercent{
	      position: absolute;
    top: 18px;
    font-size: 11px;
    font-family: 'Muli-Regular';
  }
	
	.porcentajeTot{
	  position: absolute;
    top: 35px;
    font-size: 11px;
    font-family: 'Muli-Regular';
  }
	</style>
</head>
<body>
<div class="well2 ">Focos de problemáticas recibidas al área de <b><?php echo $nombreArea; ?></b>
	<div data-toggle="tooltip" data-placement="bottom" title="Recibidos  <?php echo number_format($percentR, 1, '.', '');?>% de avance resueltos" class="progress clsPro">
		<div class="clsProSub progress-bar progress-bar-success" role="progressbar"  style="width:<?php echo $percentR;?>%">
		<?php echo number_format($percentR, 1, '.', '');?>%
		</div>
	</div>
	<div data-toggle="tooltip" data-placement="bottom" title="Enviados  <?php echo number_format($percent1E, 1, '.', '');?>% de avance resueltos" class="progress clsProEnv">
		<div class="clsProSub progress-bar progress-bar-success" role="progressbar"  style="width:<?php echo $percent1E;?>%">
		<?php echo number_format($percent1E, 1, '.', '');?>%
		</div>
	</div>
	<i onclick="javascript:location.href='focoProblematica.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>'" data-toggle="tooltip" data-placement="bottom" title="Recibidos" style="color: #00BCD4;position: absolute;right: 342px;cursor:pointer;" class="fa fa-envelope-open" aria-hidden="true"></i> 
	<i onclick="javascript:location.href='focoProblematicaEnviados.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>'" data-toggle="tooltip" data-placement="bottom" title="Enviados" style="position: absolute;right: 222px;cursor:pointer;" class="fa fa-paper-plane" aria-hidden="true"></i> 
	<i onclick="javascript:location.href='../asuntos/index.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" data-toggle="tooltip" data-placement="bottom" title="Asuntos" style="position: absolute;right: 39px;cursor:pointer; font-size: 13px;" class="far fa-comments"></i>
	<i onclick="javascript:location.href='focoProblematicaGlobal.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" data-toggle="tooltip" data-placement="bottom" title="Global" style="position: absolute;right: 9px;cursor:pointer;" class="fa fa-globe" aria-hidden="true"></i>
</div>
<div class="well2 wr">
	Totales <p style="background-color:#0093a3;cursor:pointer" onclick="window.location.reload();" class="totales a "><?php echo $total; ?></p>
	<div class="progress2 progress">
		<div onclick="focosResueltos(1,<?php echo $totalResueltos; ?>);" class="progress-bar progress-bar-success font a" role="progressbar" style="cursor:pointer;width:<?php echo $percent1;?>%">
			<?php echo $totalResueltos; ?>
			<span class="tooltiptext2">Resueltos - <?php echo number_format($percent1, 2, '.', '');?>%</span>
		</div>
		<div onclick="focosResueltos(2,<?php echo $totalEnSeguimiento; ?>);" class="progress-bar progress-bar-warning font a" role="progressbar" style="background-color: #efd707;cursor:pointer;width:<?php echo $percent2;?>%">
			<?php echo $totalEnSeguimiento; ?>
			<span class="tooltiptext2">En seguimiento - <?php echo number_format($percent2, 2, '.', '');?>%</span>
		</div>
		<div onclick="focosResueltos(3,<?php echo $totalSinAtender; ?>);" class="progress-bar progress-bar-danger font a" role="progressbar" style="cursor:pointer;width:<?php echo $percent3;?>%">
			<?php echo $totalSinAtender; ?>
			<span class="tooltiptext2">Sin atender - <?php echo number_format($percent3, 2, '.', '');?>%</span>
		</div>
	</div>
	<p style="position:absolute;top:42px;right:30px;"># total</p>


</div>

<div class="global">
	<div style="top:54px" class="flotante">
		<?php echo $cadenaAreasEje1;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje1;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
		
	</div>
	<div class="flotante" style="top: 52px;">
		<?php echo $cadenaAreasEje2;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje2;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 51px;">
		<?php echo $cadenaAreasEje3;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje3;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 50px;">
		<?php echo $cadenaAreasEje4;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje4;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 49px;">
		<?php echo $cadenaAreasEje5;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje5;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 48px;">
		<?php echo $cadenaAreasEje6;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje6;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 47px;">
		<?php echo $cadenaAreasEje7;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje7;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 46px;">
		<?php echo $cadenaAreasEje8;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje8;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 45px;">
		<?php echo $cadenaAreasEje9;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje9;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 44px;">
		<?php echo $cadenaAreasEje10;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje10;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	<div class="flotante" style="top: 43px;">
		<?php echo $cadenaAreasEje11;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje11;?></p>
			<p class="totEjeFinPercent">0%</p>
		</div>
	</div>
	
	<div class="flotante" style="top: 42px;">
		<?php echo $cadenaTotalesArea;?>
		<div class="totEj" ><p style="font-size: 15px;"><?php echo $total;?></p></div>
	</div>
</div>
<style>
.modal::-webkit-scrollbar {
    -webkit-appearance: none;
}

.modal::-webkit-scrollbar:vertical {
    width:5px;
}

.modal::-webkit-scrollbar-button:increment,.modal::-webkit-scrollbar-button {
    display: none;
} 

.modal::-webkit-scrollbar:horizontal {
    height: 5px;
}

.modal::-webkit-scrollbar-thumb {
   /* background-color: #797979;
    border-radius: 20px;
    border: 2px solid #f1f2f3;
	border-radius: 0px;
    border: 2px solid #464456;*/
	background-color: #cbcbca;
    border-radius: 4px;
    border: 1px solid #5a274f;
}

.modal::-webkit-scrollbar-track {
    border-radius: 10px;  
}
</style>
<!-- Modal -->
<div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content" style="left: -6px;width: 624px;">
			<div class="modal-header h" style="padding: 7px 5px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				Problemáticas recibidas al área de <b><?php echo $nombreArea; ?></b>
			</div>
			<div class="modal-body detalle" style="padding: 31px 5px;">
          
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

function focosResueltos(tipo,total)
{
	var tipo = tipo;
	var idArea = <?php echo $idArea;?>;
	var total = total;
	$.post("focoProblematicaEstatus.php",{idArea:idArea,tipo:tipo,total:total}, function(data) {
		$(".global").html('');
		$(".global").html(data);
	});
}

$(document).ready(function(){
	$('.a').click(function(e) {
	    e.preventDefault();
		$('.a').removeClass('selector');
		$(this).addClass('selector');
	});
});

function muestraDetalle(idDestino,idOrigen,idEje,tipo)
{
	var idDestino = idDestino;
	var idOrigen = idOrigen;
	var idEje = idEje;
	var tipo = tipo;
	var idUsuario = <?php echo $idUsuario;?>;
	var idAreaUsuario = <?php echo $idAreaUsuario;?>;
	
	
	$(".h").css('background-color',"#4d4d57");
	$("#myModal").modal({backdrop: false});
	
	$.post("detalle.php",{idDestino:idDestino,idOrigen:idOrigen,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

</script>
</html>
