<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/PortadaController.php";
	
	$anio = 2020;
	$idArea = $_GET["idArea"];
	$nombreArea = $_GET["nombreArea"];
	$totalAsuntosRec = $_GET["totalAsuntosRec"];
	$idUsuario = $_GET["idUsuario"];
	$idAreaUsuario = $_GET["idAreaUsuario"];
	
	
	
	/*******DIRECTOS*****************************************************/
	$act = new IndicadorController();
	$asuntos = $act -> mostrarTotalAsuntosGlobales();
	$total = $asuntos -> getTotal();
	
	$asuntosPro = $act -> mostrarTotalAsuntosProGlobales();
	$totalPro = $asuntosPro -> getTotal();
	
	$asuntosSol = $act -> mostrarTotalAsuntosSolGlobales();
	$totalSol = $asuntosSol -> getTotal();
	
	$asuntosCon = $act -> mostrarTotalAsuntosConGlobales();
	$totalCon = $asuntosCon -> getTotal();
	
	$asuntosSug = $act -> mostrarTotalAsuntosSugGlobales();
	$totalSug = $asuntosSug -> getTotal();
	
	/*total Ambos recibidos*/
	$asuntosAmbos = $act -> mostrarTotalAsuntosAmbosRecibidos($idArea);
	$totalAmbos = $asuntosAmbos -> getTotal();
	
	/*******INVITADOS*****************************************************/
	$actInv = new IndicadorController();
	$asuntosInv = $actInv -> mostrarTotalAsuntosRecibidosInvitado($idArea);
	$totalInvitado = $asuntosInv -> getTotal();
	
	$asuntosProInv = $actInv -> mostrarTotalAsuntosProRecibidosInvitado($idArea);
	$totalProInvitado = $asuntosProInv -> getTotal();
	
	$asuntosSolInv = $actInv -> mostrarTotalAsuntosSolRecibidosInvitado($idArea);
	$totalSolInvitado = $asuntosSolInv -> getTotal();
	
	$asuntosConInv = $actInv -> mostrarTotalAsuntosConRecibidosInvitado($idArea);
	$totalConInvitado = $asuntosConInv -> getTotal();
	
	$asuntosSugInv = $actInv -> mostrarTotalAsuntosSugRecibidosInvitado($idArea);
	$totalSugInvitado = $asuntosSugInv -> getTotal();
	
	/*total enviados*/
	$focosE = $act -> mostrarTotalfocosEnviados($idArea);
	$totalE = $focosE -> getTotal();
	/**/
	
	/*subareas*/
	$actSub = new IndicadorController();
	$subArea = $actSub -> mostrarTotalAsuntosSubAreaGlobales();
	$totalRecibidosSubArea = $subArea -> getTotal();
	/**********/
	
	
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
	$totalesEjesAreas = 0;
	
	$percentAtenArea = 0.0;
	
	foreach($areas as $area)
	{		
		
		$asuntosArea = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),1);
		if($asuntosArea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",1,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea->getTotal()."</p></div>";
		$totEje1 += $asuntosArea->getTotal();	
		
		$asuntosArea2 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),2);
		if($asuntosArea2->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",2,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea2->getTotal()."</p></div>";
		$totEje2 += $asuntosArea2->getTotal();
		
		$asuntosArea3 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),3);
		if($asuntosArea3->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",3,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea3->getTotal()."</p></div>";
		$totEje3 += $asuntosArea3->getTotal();
		
		$asuntosArea4 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),4);
		if($asuntosArea4->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",4,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea4->getTotal()."</p></div>";
		$totEje4 += $asuntosArea4->getTotal();
		
		$asuntosArea5 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),5);
		if($asuntosArea5->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",5,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea5->getTotal()."</p></div>";
		$totEje5 += $asuntosArea5->getTotal();
		
		$asuntosArea6 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),6);
		if($asuntosArea6->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",6,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea6->getTotal()."</p></div>";
		$totEje6 += $asuntosArea6->getTotal();
		
		$asuntosArea7 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),7);
		if($asuntosArea7->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",7,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea7->getTotal()."</p></div>";
		$totEje7 += $asuntosArea7->getTotal();
		
		$asuntosArea8 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),8);
		if($asuntosArea8->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",8,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea8->getTotal()."</p></div>";
		$totEje8 += $asuntosArea8->getTotal();
		
		$asuntosArea9 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),9);
		if($asuntosArea9->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",9,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea9->getTotal()."</p></div>";
		$totEje9 += $asuntosArea9->getTotal();
		
		$asuntosArea10 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),10);
		if($asuntosArea10->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",10,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea10->getTotal()."</p></div>";
		$totEje10 += $asuntosArea10->getTotal();
		
		$asuntosArea11 = $act -> mostrarTotalAsuntosAreaGlobales($area->getIdArea(),11);
		if($asuntosArea11->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",11,0,".$idUsuario.",".$idAreaUsuario.")' "; $style="style='background-color: #0093a3;color: white;'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><p class='rotar'>".$asuntosArea11->getTotal()."</p></div>";
		$totEje11 += $asuntosArea11->getTotal();
		
		$totalesArea = $asuntosArea->getTotal() + $asuntosArea2->getTotal() + $asuntosArea3->getTotal() + $asuntosArea4->getTotal() + $asuntosArea5->getTotal() + $asuntosArea6->getTotal() + $asuntosArea7->getTotal() + $asuntosArea8->getTotal() + $asuntosArea9->getTotal() + $asuntosArea10->getTotal() + $asuntosArea11->getTotal();
		
		$atendidos = $act -> mostrarTotalAsuntosAtendidosRecibidosArea($idArea,$area->getIdArea(),0);
		if($totalesArea > 0)
		{
			$percentAtenArea = ($atendidos->getTotal() / $totalesArea)*100;
		}else{
			$percentAtenArea = 0.0;
		}
		
		$cadenaTotalesArea .= "<div style='cursor:pointer;' onclick='regresaArea(".$area->getIdArea().",\"".$area->getNombre()."\")' id='totalArea".$area->getIdArea()."' onclick=''  class=' j2 horizontal'><p class='rotarT'>".$totalesArea."</p><p class='porcentajeTot'>".number_format($percentAtenArea, 1, '.', '')."<br>%</p></div>";
		
		
		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";
	}
	$totalesEjesAreas = $totEje1 + $totEje2 + $totEje3 + $totEje4 + $totEje5 + $totEje6 + $totEje7 + $totEje8 + $totEje9 + $totEje10 + $totEje11;
	
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
	$actT = new IndicadorController();
	$totalDR = $actT -> mostrarTotalAsuntosResueltosGlobales();
	$directosR = $totalDR -> getTotal();
	
	$percentResul = 0.0;

	if($total > 0)
	{
		$percentResul = ($directosR * 100)/$total;
			
	}
	
	/*subareas*/
	
	$actTotSub = new IndicadorController();
	$mostrarSubAreas = $areaControllerAct -> mostrarTodasSubAreas();
	
	$cadenaSubAreas = "";
	foreach($mostrarSubAreas as $subA)
	{
		$totalSubAreaDiv = $actTotSub -> mostrarTotalAsuntosRecibidosSubAreaDiv($idArea,$subA->getIdArea());
		$cadenaSubAreas .= "<option value='".$subA->getIdArea()."'> ".$totalSubAreaDiv->getTotal()."  ".$subA->getNombre()."</option>";
	}
	
	/*atencion porcentajes*/
	
	$actAten = new IndicadorController();
	$totAtenEje1 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(1,$idArea,0);
	$percent1Eje = 0.0;
	if($totEje1 > 0){ $percent1Eje = ($totAtenEje1->getTotal() / $totEje1)*100; }
	
	$totAtenEje2 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(2,$idArea,0);
	$percent2Eje = 0.0;
	if($totEje2 > 0){ $percent2Eje = ($totAtenEje2->getTotal() / $totEje2)*100; }
	
	$totAtenEje3 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(3,$idArea,0);
	$percent3Eje = 0.0;
	if($totEje3 > 0){ $percent3Eje = ($totAtenEje3->getTotal() / $totEje3)*100; }
	
	$totAtenEje4 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(4,$idArea,0);
	$percent4Eje = 0.0;
	if($totEje4 > 0){ $percent4Eje = ($totAtenEje4->getTotal() / $totEje4)*100; }
	
	$totAtenEje5 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(5,$idArea,0);
	$percent5Eje = 0.0;
	if($totEje5 > 0){ $percent5Eje = ($totAtenEje5->getTotal() / $totEje5)*100; }
	
	$totAtenEje6 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(6,$idArea,0);
	$percent6Eje = 0.0;
	if($totEje6 > 0){ $percent6Eje = ($totAtenEje6->getTotal() / $totEje6)*100; }
	
	$totAtenEje7 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(7,$idArea,0);
	$percent7Eje = 0.0;
	if($totEje7 > 0){ $percent7Eje = ($totAtenEje7->getTotal() / $totEje7)*100; }
	
	$totAtenEje8 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(8,$idArea,0);
	$percent8Eje = 0.0;
	if($totEje8 > 0){ $percent8Eje = ($totAtenEje8->getTotal() / $totEje8)*100; }
	
	$totAtenEje9 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(9,$idArea,0);
	$percent9Eje = 0.0;
	if($totEje9 > 0){ $percent9Eje = ($totAtenEje9->getTotal() / $totEje9)*100; }
	
	$totAtenEje10 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(10,$idArea,0);
	$percent10Eje = 0.0;
	if($totEje10 > 0){ $percent10Eje = ($totAtenEje10->getTotal() / $totEje10)*100; }
	
	$totAtenEje11 = $actAten->mostrarTotalAsuntosAtendidosRecibidosEje(11,$idArea,0);
	$percent11Eje = 0.0;
	if($totEje11 > 0){ $percent11Eje = ($totAtenEje11->getTotal() / $totEje11)*100; } 
	
	/*resueltos porcentajes*/
	
	$actAtenR = new IndicadorController();
	$totAtenEje1R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(1,$idArea,0);
	$percent1EjeR = 0.0;
	if($totEje1 > 0){ $percent1EjeR = ($totAtenEje1R->getTotal() / $totEje1)*100; }
	
	$totAtenEje2R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(2,$idArea,0);
	$percent2EjeR = 0.0;
	if($totEje2 > 0){ $percent2EjeR = ($totAtenEje2R->getTotal() / $totEje2)*100; }
	
	$totAtenEje3R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(3,$idArea,0);
	$percent3EjeR = 0.0;
	if($totEje3 > 0){ $percent3EjeR = ($totAtenEje3R->getTotal() / $totEje3)*100; }
	
	$totAtenEje4R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(4,$idArea,0);
	$percent4EjeR = 0.0;
	if($totEje4 > 0){ $percent4EjeR = ($totAtenEje4R->getTotal() / $totEje4)*100; }
	
	$totAtenEje5R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(5,$idArea,0);
	$percent5EjeR = 0.0;
	if($totEje5 > 0){ $percent5EjeR = ($totAtenEje5R->getTotal() / $totEje5)*100; }
	
	$totAtenEje6R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(6,$idArea,0);
	$percent6EjeR = 0.0;
	if($totEje6 > 0){ $percent6EjeR = ($totAtenEje6R->getTotal() / $totEje6)*100; }
	
	$totAtenEje7R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(7,$idArea,0);
	$percent7EjeR = 0.0;
	if($totEje7 > 0){ $percent7EjeR = ($totAtenEje7R->getTotal() / $totEje7)*100; }
	
	$totAtenEje8R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(8,$idArea,0);
	$percent8EjeR = 0.0;
	if($totEje8 > 0){ $percent8EjeR = ($totAtenEje8R->getTotal() / $totEje8)*100; }
	
	$totAtenEje9R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(9,$idArea,0);
	$percent9EjeR = 0.0;
	if($totEje9 > 0){ $percent9EjeR = ($totAtenEje9R->getTotal() / $totEje9)*100; }
	
	$totAtenEje10R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(10,$idArea,0);
	$percent10EjeR = 0.0;
	if($totEje10 > 0){ $percent10EjeR = ($totAtenEje10R->getTotal() / $totEje10)*100; }
	
	$totAtenEje11R = $actAtenR->mostrarTotalAsuntosResueltosRecibidosEje(11,$idArea,0);
	$percent11EjeR = 0.0;
	if($totEje11 > 0){ $percent11EjeR = ($totAtenEje11R->getTotal() / $totEje11)*100; } 
	
	if($percent1EjeR == 100){$percent1Eje = 100;}
	if($percent2EjeR == 100){$percent2Eje = 100;}
	if($percent3EjeR == 100){$percent3Eje = 100;}
	if($percent4EjeR == 100){$percent4Eje = 100;}
	if($percent5EjeR == 100){$percent5Eje = 100;}
	if($percent6EjeR == 100){$percent6Eje = 100;}
	if($percent7EjeR == 100){$percent7Eje = 100;}
	if($percent8EjeR == 100){$percent8Eje = 100;}
	if($percent9EjeR == 100){$percent9Eje = 100;}
	if($percent10EjeR == 100){$percent10Eje = 100;}
	if($percent11EjeR == 100){$percent11Eje = 100;}
	
	/*estatus*/
	
	$actEst = new IndicadorController();
	$estPro = $actEst -> mostrarTotalEstatusAsuntosProGlobales();
	$estProNL = $estPro ->getNoLeido();
	$estProEC = $estPro ->getEnConversacion();
	$estProR = $estPro ->getResuelto();
	
	$estSol = $actEst -> mostrarTotalEstatusAsuntosSolGlobales();
	$estSolNL = $estSol ->getNoLeido();
	$estSolEC = $estSol ->getEnConversacion();
	$estSolR = $estSol ->getResuelto();
	
	$estCon = $actEst -> mostrarTotalEstatusAsuntosConGlobales();
	$estConNL = $estCon ->getNoLeido();
	$estConEC = $estCon ->getEnConversacion();
	$estConR = $estCon ->getResuelto();
	
	$estSug = $actEst -> mostrarTotalEstatusAsuntosSugGlobales();
	$estSugNL = $estSug ->getNoLeido();
	$estSugEC = $estSug ->getEnConversacion();
	$estSugR = $estSug ->getResuelto();
	
	$estTodo = $actEst -> mostrarTotalEstatusAsuntosTodoGlobales();
	$estTodoNL = $estTodo ->getNoLeido();
	$estTodoEC = $estTodo ->getEnConversacion();
	$estTodoR = $estTodo ->getResuelto();
	
	
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
	background-color: white !important;
	color:black !important;
    box-shadow: 0px 2px 5px #e7e7ef;
}

.tooltip.bottom {
    padding: 5px 0;
    /*margin-top: 8px;*/
	margin-top: 2px;
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
	top: 7px;
    position: absolute;
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
  
  .btnMod{
	  border-radius: 0px;
    font-family: 'Muli-SemiBold';
    font-size: 11px;
    padding: 0px 12px;
  }
  
  .groupMod{
	/*width: 606px;*/
	width: 484px;
    left: 169px;
    /*top: -1px;*/
	top:-12px;
  }
  
  .btnMod:hover{
	  background-color: white !important;
	  color: black;
  }
  
  .porcentajeTot{
	position: absolute;
    top: 25px;
    font-size: 10px;
    font-family: 'Muli-Regular';
    text-align: center;
  }
  
  .totEjeFin{
	      font-family: 'Muli-Bold';
    font-size: 12px;
    top: -3px;
    position: absolute;
  }
  
  .totEjeFinPercent{
	position: absolute;
    top: 10px;
    font-size: 10.5px;
    font-family: 'Muli-Regular';
    width: 90px;
    left: -35px;
    text-align: center;
  }
  
  
  .resalta{
	border: .5px solid white !important;
  }
  
.clsProSub{
	width: 40%;
    font-size: 9px;
    font-family: 'Muli-Bold';
    line-height: 10px;
	color: #4d4d57;
}

.clsPro{
	width: 91px;
    height: 9px;
    position: absolute;
    top: 13px;
    right: 30px;
    border-radius: 0px;
}
  
  .titRes{
	  position: absolute;
    top: 1px;
    font-family: 'Muli-Regular';
    font-size: 10px;
        right: 38px;
  }
   .progress-bar-warning{
	 background-color:#ffc107;
   }
   
   
   .titleSub{
	   position: absolute;
    top: 31px;
    left: 707px;
   }
   
   .titleSelect{
	   position: absolute;
    top: 45px;
    left: 691px;
    color: black;
    width: 124px;
   }
   
   .totEjeFinPercent2{
	position: absolute;
    top: 26px;
    font-size: 10.5px;
    font-family: 'Muli-Regular';
    width: 90px;
    left: -35px;
    text-align: center;
	color: green;
  }
  
  .clasifPro{
	display: flex;
    position: absolute;
    top: 47px;
    border: 1px solid white;
    left: 178px;
    width: 121px;
    align-items: center;
    justify-content: center;
  }
  
  .pclasifPro{
	  width:40.33px;
	  text-align: center;
  }
  
  .clasifSol{
	display: flex;
    position: absolute;
    top: 47px;
    border: 1px solid white;
    left: 299px;
    width: 121px;
    align-items: center;
    justify-content: center;
  }
  
  .pclasifSol{
	  width:40.33px;
	  text-align: center;
  }
  
  .clasifCon{
	display: flex;
    position: absolute;
    top: 47px;
    border: 1px solid white;
    left: 420px;
    width: 121px;
    align-items: center;
    justify-content: center;
  }
  
  .pclasifCon{
	  width:40.33px;
	  text-align: center;
  }
  
  .clasifSug{
	display: flex;
    position: absolute;
    top: 47px;
    border: 1px solid white;
    left: 541px;
    width: 121px;
    align-items: center;
    justify-content: center;
  }
  
  .pclasifSug{
	  width:40.33px;
	  text-align: center;
  }
  .resaltaEstatus{
	color: black;
    font-weight: bold;
    border: 1px solid #0c0c0c;
	box-shadow: 2px 1px 3px #5a274f;
  }
  
  .clasifTodo{
	display: flex;
    position: absolute;
    border: 1px solid white;
    top: 47px;
    left: 36px;
    width: 121px;
    align-items: center;
    justify-content: center;
  }
  
  .pclasifTodo{
	  width:40.33px;
	  text-align: center;
  }
	</style>
	
</head>
<body>
<div class="well2 ">
	Indicador global de Asuntos recibidos 
	
	<p class="titRes">resueltos <b><?php echo $directosR; ?> / <?php echo $total; ?></b></p>
	<div onclick="muestraResueltos(<?php echo $idArea; ?>,<?php echo $idUsuario; ?>,<?php echo $idAreaUsuario; ?>,0)" style="cursor:pointer;" data-toggle="tooltip" data-placement="bottom" title="  <?php echo number_format($percentResul, 1, '.', '');?>% de avance resueltos" class="progress clsPro">
		<div class="clsProSub progress-bar progress-bar-success" role="progressbar"  style="color: white;background-color: green;width:<?php echo $percentResul;?>%">
		<?php echo number_format($percentResul, 1, '.', '');?>%
		</div>
	</div>

	<i onclick="javascript:location.href='index.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" data-toggle="tooltip" data-placement="bottom" title="Recibidos área" style=";position: absolute;left: 339px;cursor:pointer;" class="fa fa-envelope-open" aria-hidden="true"></i> 
	
	<i onclick="javascript:location.href='indexGlobal.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" data-toggle="tooltip" data-placement="bottom" title="Recibidos Global" style="color: #00BCD4;position: absolute;right: 9px;cursor:pointer;" class="fa fa-globe" aria-hidden="true"></i>
	
</div>
<div class="well2 wr">
	<p style="position: absolute;left: 2px;top: 31px;">Totales</p>
	<p data-toggle="tooltip" data-placement="bottom" title="Asuntos" style="cursor:pointer;background-color:#0093a3;border: 1px solid green;left:5px;color:white;top: 46.5px;" onclick="window.location.reload();" class="totales a resalta"><?php echo $total; ?></p>
	<div  class="clasifTodo">
		<p onclick="tipoEstatus(5,1,<?php echo $estTodoR; ?>);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifTodo"><?php echo $estTodoR; ?></p>
		<p onclick="tipoEstatus(5,2,<?php echo $estTodoEC; ?>);" style="cursor:pointer;background-color: #efd707;" class="b pclasifTodo"><?php echo $estTodoEC; ?></p>
		<p onclick="tipoEstatus(5,3,<?php echo $estTodoNL; ?>);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifTodo"><?php echo $estTodoNL; ?></p>
	</div>
	
	
	<div class="btn-group btn-group-justified groupMod">
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="javascript:location.href='../focosAsuntos/focoProblematicaGlobal.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>'" class="btn btn-primary btnMod">Problemática &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalPro; ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(1,<?php echo $totalSol; ?>);" class="btn btn-primary btnMod">Solicitud &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalSol; ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(2,<?php echo $totalCon; ?>);" class="btn btn-primary btnMod">Conocimiento &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalCon; ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(3,<?php echo $totalSug; ?>);" class="btn btn-primary btnMod">Sugerencia &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalSug; ?>&nbsp;</b></a>
	</div>
	<div  class="clasifPro">
		<p onclick="tipoEstatus(4,1,<?php echo $estProR; ?>);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifPro"><?php echo $estProR; ?></p>
		<p onclick="tipoEstatus(4,2,<?php echo $estProEC; ?>);" style="cursor:pointer;background-color: #efd707;" class="b pclasifPro"><?php echo $estProEC; ?></p>
		<p onclick="tipoEstatus(4,3,<?php echo $estProNL; ?>);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifPro"><?php echo $estProNL; ?></p>
	</div>
	<div  class="clasifSol">
		<p onclick="tipoEstatus(1,1,<?php echo $estSolR; ?>);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifSol "><?php echo $estSolR; ?></p>
		<p onclick="tipoEstatus(1,2,<?php echo $estSolEC; ?>);" style="cursor:pointer;background-color: #efd707;" class="b pclasifSol"><?php echo $estSolEC; ?></p>
		<p onclick="tipoEstatus(1,3,<?php echo $estSolNL; ?>);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifSol"><?php echo $estSolNL; ?></p>
	</div>
	<div  class="clasifCon">
		<p onclick="tipoEstatus(2,1,<?php echo $estConR; ?>);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifCon"><?php echo $estConR; ?></p>
		<p onclick="tipoEstatus(2,2,<?php echo $estConEC; ?>);" style="cursor:pointer;background-color: #efd707;" class="b pclasifCon"><?php echo $estConEC; ?></p>
		<p onclick="tipoEstatus(2,3,<?php echo $estConNL; ?>);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifCon"><?php echo $estConNL; ?></p>
	</div>
	<div  class="clasifSug">
		<p onclick="tipoEstatus(3,1,<?php echo $estSugR; ?>);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifSug"><?php echo $estSugR; ?></p>
		<p onclick="tipoEstatus(3,2,<?php echo $estSugEC; ?>);" style="cursor:pointer;background-color: #efd707;" class="b pclasifSug"><?php echo $estSugEC; ?></p>
		<p onclick="tipoEstatus(3,3,<?php echo $estSugNL; ?>);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifSug"><?php echo $estSugNL; ?></p>
	</div>
	<div class="titleSub">Tot. sub-áreas&nbsp;&nbsp; <b><?php echo $totalRecibidosSubArea; ?></b></div>
	<div class="titleSelect">
		<select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="subArea" id="subArea">
			<?php echo $cadenaSubAreas;?>
		</select>
	</div>
	
	<p style="position:absolute;top:42px;right:30px;"># total</p>


</div>

<div class="global">
	<div style="top: 54px;" class="flotante">
		<?php echo $cadenaAreasEje1;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje1;?></p>
			<p <?php if($percent1Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?> class="totEjeFinPercent"><?php echo number_format($percent1Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent1EjeR, 1, '.', '');?>% resuelto</p>
		</div>
		
	</div>
	<div class="flotante" style="top: 52px;">
		<?php echo $cadenaAreasEje2;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje2;?></p>
			<p <?php if($percent2Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent2Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent2EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 51px;">
		<?php echo $cadenaAreasEje3;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje3;?></p>
			<p <?php if($percent3Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent3Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent3EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 50px;">
		<?php echo $cadenaAreasEje4;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje4;?></p>
			<p <?php if($percent4Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent4Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent4EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 49px;">
		<?php echo $cadenaAreasEje5;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje5;?></p>
			<p <?php if($percent5Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent5Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent5EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 48px;">
		<?php echo $cadenaAreasEje6;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje6;?></p>
			<p <?php if($percent6Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent6Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent6EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 47px;">
		<?php echo $cadenaAreasEje7;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje7;?></p>
			<p <?php if($percent7Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent7Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent7EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 46px;">
		<?php echo $cadenaAreasEje8;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje8;?></p>
			<p <?php if($percent8Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent8Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent8EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 45px;">
		<?php echo $cadenaAreasEje9;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje9;?></p>
			<p <?php if($percent9Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent9Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent9EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 44px;">
		<?php echo $cadenaAreasEje10;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje10;?></p>
			<p <?php if($percent10Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent10Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent10EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	<div class="flotante" style="top: 43px;">
		<?php echo $cadenaAreasEje11;?>
		<div class="totEj" >
			<p class="totEjeFin"><?php echo $totEje11;?></p>
			<p <?php if($percent11Eje == 100){ echo "style='font-weight: bold;font-size: 10px;' "; } ?>  class="totEjeFinPercent"><?php echo number_format($percent11Eje, 1, '.', '');?>% en proceso</p>
			<p class="totEjeFinPercent2"><?php echo number_format($percent11EjeR, 1, '.', '');?>% resuelto</p>
		</div>
	</div>
	
	<div class="flotante" style="top: 42px;">
		<?php echo $cadenaTotalesArea;?>
		<div class="totEj" ><p style="font-size: 15px;"><?php echo $totalesEjesAreas;?></p></div>
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
				 Asuntos recibidos al área de  <a style="color:white;text-decoration:none;" class="resul"></a>
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

function tipo(tipo,total)
{
	var tipo = tipo;
	var idArea = <?php echo $idArea;?>;
	var total = total;
	var idUsuario = <?php echo $idUsuario;?>;
	var idAreaUsuario = <?php echo $idAreaUsuario;?>;
	
	$.post("asuntosTipoGlobal.php",{idArea:idArea,tipo:tipo,total:total,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario}, function(data) {
		$(".global").html('');
		$(".global").html(data);
	});
}

$(document).ready(function(){
	$('.btnMod').click(function(e) {
	    e.preventDefault();
		$('.btnMod').removeClass('selector');
		$(this).addClass('selector');
	});
});

function muestraDetalle(idDestino,idEje,tipo,idUsuario,idAreaUsuario)
{
	var idDestino = idDestino;
	var idEje = idEje;
	var tipo = tipo;
	var idUsuario = idUsuario;
	var idAreaUsuario = idAreaUsuario;
	
	
	$(".h").css('background-color',"#4d4d57");
	$(".resul").html('');
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleGlobal.php",{idDestino:idDestino,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

$(document).ready(function(){
  
  
  $('.a').click(function(e) {
	        e.preventDefault();
			$('.a').removeClass('resalta');
			$(this).addClass('resalta');
	});
  
  
  $('.b').click(function(e) {
	        e.preventDefault();
			$('.b').removeClass('resaltaEstatus');
			$(this).addClass('resaltaEstatus');
	});
  
  
 $("#subArea").change(function() {
	var idSubArea = $(this).val()
	var idDestino = <?php echo $idArea;?>;
	var idEje = 0;
	var idUsuario = <?php echo $idUsuario;?>;
	var idAreaUsuario = <?php echo $idAreaUsuario;?>;
	var tipo = 0;
	
	$(".h").css('background-color',"#4d4d57");
	$("#myModal").modal({backdrop: false});
	
  
	$.post("detalle.php",{idDestino:idDestino,idOrigen:idSubArea,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
});
  
  
 
});


/*****************************************************************/

function muestraResueltos(idArea,idUsuario,idAreaUsuario,die)
{
	var idArea = idArea;
	var idUsuario = idUsuario;
	var idAreaUsuario = idAreaUsuario;
	var die = die;
	
	
	$(".h").css('background-color',"#4d4d57");
	$(".resul").html('resueltos');
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleResueltos.php",{idArea:idArea,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,die:die}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}

function regresaArea(idArea,nombreArea)
{
	var idArea = idArea;
	var nombreArea = nombreArea;
	location.href ='index.php?idArea='+idArea+'&nombreArea='+nombreArea+'&idUsuario=<?php echo $idUsuario; ?>&idAreaUsuario=<?php echo $idAreaUsuario; ?>';
}

function tipoEstatus(tipo,estatus,total)
{
	var tipo = tipo;
	var estatus = estatus;
	var idArea = <?php echo $idArea;?>;
	var total = total;
	var idUsuario = <?php echo $idUsuario;?>;
	var idAreaUsuario = <?php echo $idAreaUsuario;?>;
	
	$.post("asuntosTipoEstatusGlobal.php",{idArea:idArea,tipo:tipo,total:total,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,estatus:estatus}, function(data) {
		$(".global").html('');
		$(".global").html(data);
	});
}

function muestraDetalleEstatus(idDestino,idEje,tipo,idUsuario,idAreaUsuario,estatus)
{
	var idDestino = idDestino;
	var idEje = idEje;
	var tipo = tipo;
	var idUsuario = idUsuario;
	var idAreaUsuario = idAreaUsuario;
	var estatus = estatus;
	
	
	$(".h").css('background-color',"#4d4d57");
	$(".resul").html('');
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleGlobalEstatus.php",{idDestino:idDestino,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,estatus:estatus}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});
	
}
</script>
</html>
