<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/PortadaController.php";
	include_once __DIR__."/../../../source/controller/EntregableController.php";
	
	$anio = 2020;
	$idArea = 5;//$_GET["idArea"];
	$nombreArea = "sistemas";//$_GET["nombreArea"];
	$totalAsuntosRec = 4;//$_GET["totalAsuntosRec"];
	$idUsuario = 3;//$_GET["idUsuario"];
	$idAreaUsuario = 5;//$_GET["idAreaUsuario"];
	
	
	/*Entregables********************************************************************/
	$actEntregable = new EntregableController();
	$entregable = $actEntregable -> mostrarTotalEntregables();
	$totalEntregables = $entregable -> getTotal();
	
	$entregableGlobal = $actEntregable -> mostrarTotalEntregablesGlobales();
	$totalEntregablesGlobal = $entregableGlobal -> getTotal();
	
	$entregableGeneral = $actEntregable -> mostrarTotalEntregablesGenerales();
	$totalEntregablesGeneral = $entregableGeneral -> getTotal();
	
	$entregableParticular = $actEntregable -> mostrarTotalEntregablesParticulares();
	$totalEntregablesParticular = $entregableParticular -> getTotal();
	
	$entregableSub = $actEntregable -> mostrarTotalEntregablesSub();
	$totalEntregablesSub = $entregableSub -> getTotal();
	
	$entV = $actEntregable -> mostrarTotalEntregablesVerde();
	$totalEntregablesVerde = $entV -> getTotal();

	$entTColor = $actEntregable -> mostrarTotalEntregablesGeneralColor('0');
	$entGlColor = $actEntregable -> mostrarTotalEntregablesGeneralColor('1');
	$entGeColor = $actEntregable -> mostrarTotalEntregablesGeneralColor('2');
	$entPColor = $actEntregable -> mostrarTotalEntregablesGeneralColor('3');
	$entSColor = $actEntregable -> mostrarTotalEntregablesGeneralColor('4');

	/********************************************************************/
	/*******DIRECTOS*****************************************************/
	$act = new IndicadorController();
	
	
	/*total Ambos recibidos*/
	
	/*******INVITADOS*****************************************************/
	
	
	/*total enviados*/
	
	/**/
	
	/*subareas*/
	$actSub = new IndicadorController();
	$subArea = $actSub -> mostrarTotalAsuntosSubAreaGlobales();
	$totalRecibidosSubArea = $subArea -> getTotal();
	
	
	
	
	
	$actTotSubEnt = new EntregableController();
	$areaControllerActEnt = new AreaController();
	$mostrarSubAreas = $areaControllerActEnt -> mostrarTodasSubAreas();
	
	$cadenaSubAreas = "";
	$totEnt1 = 0; $totEnt2 = 0; $totEnt3 = 0; $totEnt4 = 0; $totEnt5 = 0; $totEnt6 = 0;
	$totEnt7 = 0; $totEnt8 = 0; $totEnt9 = 0; $totEnt10 = 0; $totEnt11 = 0;
	$c = 0;$c2 = 0;$c3 = 0;$c4 = 0;$c5 = 0;$c6 = 0;$c7 = 0;$c8 = 0;$c9 = 0;$c10 = 0;$c11 = 0;
	
	foreach($mostrarSubAreas as $subA)
	{
		$entregableArea = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),1);
		$totEnt1 = $entregableArea -> getTotal();
		$c .= $totEnt1.",";

		$entregableArea2 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),2);
		$totEnt2 = $entregableArea2 -> getTotal();
		$c2 .= $totEnt2.",";
		
		$entregableArea3 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),3);
		$totEnt3 = $entregableArea3 -> getTotal();
		$c3 .= $totEnt3.",";
		
		$entregableArea4 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),4);
		$totEnt4 = $entregableArea4 -> getTotal();
		$c4 .= $totEnt4.",";
		
		$entregableArea5 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),5);
		$totEnt5 = $entregableArea5 -> getTotal();
		$c5 .= $totEnt5.",";
		
		$entregableArea6 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),6);
		$totEnt6 = $entregableArea6 -> getTotal();
		$c6 .= $totEnt6.",";
		
		$entregableArea7 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),7);
		$totEnt7 = $entregableArea7 -> getTotal();
		$c7 .= $totEnt7.",";
		
		$entregableArea8 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),8);
		$totEnt8 = $entregableArea8 -> getTotal();
		$c8 .= $totEnt8.",";
		
		$entregableArea9 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),9);
		$totEnt9 = $entregableArea9 -> getTotal();
		$c9 .= $totEnt9.",";
		
		$entregableArea10 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),10);
		$totEnt10 = $entregableArea10 -> getTotal();
		$c10 .= $totEnt10.",";
		
		$entregableArea11 = $actEntregable -> mostrarTotalEntregablesArea($subA->getIdArea(),11);
		$totEnt11 = $entregableArea11 -> getTotal();
		$c11 .= $totEnt11.",";
	}
	
	
	$array = explode(",", $c);
	$array2 = explode(",", $c2);
	$array3 = explode(",", $c3);
	$array4 = explode(",", $c4);
	$array5 = explode(",", $c5);
	$array6 = explode(",", $c6);
	$array7 = explode(",", $c7);
	$array8 = explode(",", $c8);
	$array9 = explode(",", $c9);
	$array10 = explode(",", $c10);
	$array11 = explode(",", $c11);
	
	
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
	$style2= "";
	$seleccion = "";
	$onclick = "";
	
	$totEje1 = 0;$totEje2 = 0;$totEje3 = 0;$totEje4 = 0;$totEje5 = 0;$totEje6 = 0;
	$totEje7 = 0;$totEje8 = 0;$totEje9 = 0;$totEje10 = 0;$totEje11 = 0; $totalesArea = 0;
	$totalesEjesAreas = 0;
	
	$percentAtenArea = 0.0;
	
	foreach($areas as $area)
	{		
		
		$asuntosArea = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),1,0,4);
		if($asuntosArea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",1,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[1] + $array[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[3] + $array[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[5] + $array[6] + $array[7] + $array[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[9] + $array[10] + $array[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[12] + $array[13]; }
		else{ $totAreaSubArea1 = $asuntosArea->getTotal(); }
		*/
		$totAreaSubArea1 = $asuntosArea->getTotal();
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea1."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea->getFinal()."</div><div class='cuadro pro'>".$asuntosArea->getProceso()."</div><div class='cuadro pre'>".$asuntosArea->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea->getCero()."</div></div></div>";
		$totEje1 += $totAreaSubArea1;

		//$asuntosArea->getTotal();	
		
		$asuntosArea2 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),2,0,4);
		if($asuntosArea2->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",2,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[1] + $array2[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[3] + $array2[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[5] + $array2[6] + $array2[7] + $array2[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[9] + $array2[10] + $array2[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[12] + $array2[13]; }
		else{ $totAreaSubArea2 = $asuntosArea2->getTotal(); }
		*/
		$totAreaSubArea2 = $asuntosArea2->getTotal();
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea2."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea2->getFinal()."</div><div class='cuadro pro'>".$asuntosArea2->getProceso()."</div><div class='cuadro pre'>".$asuntosArea2->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea2->getCero()."</div></div></div>";
		$totEje2 += $totAreaSubArea2;
		//$asuntosArea2->getTotal();
		
		$asuntosArea3 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),3,0,4);
		if($asuntosArea3->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",3,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[1] + $array3[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[3] + $array3[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[5] + $array3[6] + $array3[7] + $array3[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[9] + $array3[10] + $array3[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[12] + $array3[13]; }
		else{ $totAreaSubArea3 = $asuntosArea3->getTotal(); }*/
		$totAreaSubArea3 = $asuntosArea3->getTotal();
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea3."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea3->getFinal()."</div><div class='cuadro pro'>".$asuntosArea3->getProceso()."</div><div class='cuadro pre'>".$asuntosArea3->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea3->getCero()."</div></div></div>";
		$totEje3 += $totAreaSubArea3; //$asuntosArea3->getTotal();
		
		$asuntosArea4 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),4,0,4);
		if($asuntosArea4->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",4,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[1] + $array4[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[3] + $array4[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[5] + $array4[6] + $array4[7] + $array4[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[9] + $array4[10] + $array4[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[12] + $array4[13]; }
		else{ $totAreaSubArea4 = $asuntosArea4->getTotal(); }*/
		$totAreaSubArea4 = $asuntosArea4->getTotal();
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea4."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea4->getFinal()."</div><div class='cuadro pro'>".$asuntosArea4->getProceso()."</div><div class='cuadro pre'>".$asuntosArea4->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea4->getCero()."</div></div></div>";
		$totEje4 += $totAreaSubArea4; //$asuntosArea4->getTotal();
		
		$asuntosArea5 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),5,0,4);
		if($asuntosArea5->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",5,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[1] + $array5[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[3] + $array5[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[5] + $array5[6] + $array5[7] + $array5[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[9] + $array5[10] + $array5[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[12] + $array5[13]; }
		else{ $totAreaSubArea5 = $asuntosArea5->getTotal(); }*/
		$totAreaSubArea5 = $asuntosArea5->getTotal();
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea5."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea5->getFinal()."</div><div class='cuadro pro'>".$asuntosArea5->getProceso()."</div><div class='cuadro pre'>".$asuntosArea5->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea5->getCero()."</div></div></div>";
		$totEje5 += $totAreaSubArea5;//$asuntosArea5->getTotal();
		
		$asuntosArea6 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),6,0,4);
		if($asuntosArea6->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",6,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[1] + $array6[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[3] + $array6[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[5] + $array6[6] + $array6[7] + $array6[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[9] + $array6[10] + $array6[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[12] + $array6[13]; }
		else{ $totAreaSubArea6 = $asuntosArea6->getTotal(); }*/
		$totAreaSubArea6 = $asuntosArea6->getTotal();
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea6."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea6->getFinal()."</div><div class='cuadro pro'>".$asuntosArea6->getProceso()."</div><div class='cuadro pre'>".$asuntosArea6->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea6->getCero()."</div></div></div>";
		$totEje6 += $totAreaSubArea6;//$asuntosArea6->getTotal();
		
		$asuntosArea7 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),7,0,4);
		if($asuntosArea7->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",7,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[1] + $array7[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[3] + $array7[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[5] + $array7[6] + $array7[7] + $array7[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[9] + $array7[10] + $array7[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[12] + $array7[13]; }
		else{ $totAreaSubArea7 = $asuntosArea7->getTotal(); }*/
		$totAreaSubArea7 = $asuntosArea7->getTotal();
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea7."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea7->getFinal()."</div><div class='cuadro pro'>".$asuntosArea7->getProceso()."</div><div class='cuadro pre'>".$asuntosArea7->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea7->getCero()."</div></div></div>";
		$totEje7 += $totAreaSubArea7;//$asuntosArea7->getTotal();
		
		$asuntosArea8 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),8,0,4);
		if($asuntosArea8->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",8,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[1] + $array8[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[3] + $array8[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[5] + $array8[6] + $array8[7] + $array8[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[9] + $array8[10] + $array8[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[12] + $array8[13]; }
		else{ $totAreaSubArea8 = $asuntosArea8->getTotal(); }*/
		$totAreaSubArea8 = $asuntosArea8->getTotal();
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea8."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea8->getFinal()."</div><div class='cuadro pro'>".$asuntosArea8->getProceso()."</div><div class='cuadro pre'>".$asuntosArea8->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea8->getCero()."</div></div></div>";
		$totEje8 += $totAreaSubArea8;//$asuntosArea8->getTotal();
		
		$asuntosArea9 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),9,0,4);
		if($asuntosArea9->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",9,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[1] + $array9[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[3] + $array9[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[5] + $array9[6] + $array9[7] + $array9[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[9] + $array9[10] + $array9[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[12] + $array9[13]; }
		else{ $totAreaSubArea9 = $asuntosArea9->getTotal(); }*/
		$totAreaSubArea9 = $asuntosArea9->getTotal();
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea9."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea9->getFinal()."</div><div class='cuadro pro'>".$asuntosArea9->getProceso()."</div><div class='cuadro pre'>".$asuntosArea9->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea9->getCero()."</div></div></div>";
		$totEje9 += $totAreaSubArea9;//$asuntosArea9->getTotal();
		
		$asuntosArea10 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),10,0,4);
		if($asuntosArea10->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",10,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[1] + $array10[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[3] + $array10[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[5] + $array10[6] + $array10[7] + $array10[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[9] + $array10[10] + $array10[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[12] + $array10[13]; }
		else{ $totAreaSubArea10 = $asuntosArea10->getTotal(); }*/
		$totAreaSubArea10 = $asuntosArea10->getTotal();
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea10."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea10->getFinal()."</div><div class='cuadro pro'>".$asuntosArea10->getProceso()."</div><div class='cuadro pre'>".$asuntosArea10->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea10->getCero()."</div></div></div>";
		$totEje10 += $totAreaSubArea10;//$asuntosArea10->getTotal();
		
		$asuntosArea11 = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),11,0,4);
		if($asuntosArea11->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",11,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		
		/*if($area->getIdArea() == 1){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[1] + $array11[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[3] + $array11[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[5] + $array11[6] + $array11[7] + $array11[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[9] + $array11[10] + $array11[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[12] + $array11[13]; }
		else{ $totAreaSubArea11 = $asuntosArea11->getTotal(); }*/
		$totAreaSubArea11 = $asuntosArea11->getTotal();
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea11."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea11->getFinal()."</div><div class='cuadro pro'>".$asuntosArea11->getProceso()."</div><div class='cuadro pre'>".$asuntosArea11->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea11->getCero()."</div></div></div>";
		$totEje11 += $totAreaSubArea11;//$asuntosArea11->getTotal();
		
		//$totalesArea = $asuntosArea->getTotal() + $asuntosArea2->getTotal() + $asuntosArea3->getTotal() + $asuntosArea4->getTotal() + $asuntosArea5->getTotal() + $asuntosArea6->getTotal() + $asuntosArea7->getTotal() + $asuntosArea8->getTotal() + $asuntosArea9->getTotal() + $asuntosArea10->getTotal() + $asuntosArea11->getTotal();
		$totalesArea = $totAreaSubArea1 + $totAreaSubArea2 + $totAreaSubArea3 + $totAreaSubArea4 + $totAreaSubArea5 + $totAreaSubArea6 + $totAreaSubArea7 + $totAreaSubArea8 + $totAreaSubArea9 + $totAreaSubArea10 + $totAreaSubArea11;
		
		$atendidos = $act -> mostrarTotalAsuntosAtendidosRecibidosArea($idArea,$area->getIdArea(),0);
		if($totalesArea > 0)
		{
			$percentAtenArea = ($atendidos->getTotal() / $totalesArea)*100;
		}else{
			$percentAtenArea = 0.0;
		}

		$tea = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),0,0,4);
		if($tea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",0,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; }

		$cadenaTotalesArea .= "<div style='cursor:pointer;' ".$onclick." id='totalArea".$area->getIdArea()."' class=' j2 horizontal'><div class='rotarT'>".$totalesArea."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$tea->getFinal()."</div><div class='cuadro pro'>".$tea->getProceso()."</div><div class='cuadro pre'>".$tea->getPreliminar()."</div><div class='cuadro cero'>".$tea->getCero()."</div></div></div>";
		
		
		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";
	}
	$totalesEjesAreas = $totEje1 + $totEje2 + $totEje3 + $totEje4 + $totEje5 + $totEje6 + $totEje7 + $totEje8 + $totEje9 + $totEje10 + $totEje11;
	
	/*totales por estatus*/
	
	
	/*porcentaje enviados*/
	
	
	
	/********************/
	
	
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
	
	
	/*resueltos porcentajes*/
	
	
	
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
	
	<script src="https://use.fontawesome.com/779a643cc8.js"></script>
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
    flex-direction: column;
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
    /*left: 36px;*/
    font-family: 'Muli-Bold';
    font-size: 12px;
    align-items: center;
    cursor: pointer;
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
    padding-left: 18px;
    /*top: -3px;
    position: absolute;*/
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

  .indBox {
  	display: flex;
  	flex-direction: row;
  	padding-top:5px;
  	flex-wrap: wrap;
  }
  .cuadro {
  	width: 14.6px;
  	height: 15px;
  	font-size: 8px;
    font-family: 'Muli-SemiBold';
    text-align:center;
  }
  .pre {
  	background-color: orange;
  }
  .pro {
  	background-color: yellow;
  	color: black;
  }
  .fi {
	background-color: #5cb85c;
  }
  .cero {
	background-color: red;
  }
	</style>
	
</head>
<body>
<div class="well2 ">
	Indicador: Entregables 2020
</div>
<div class="well2 wr">
	<p style="position: absolute;left: 2px;top: 31px;">Totales</p>
	<p data-toggle="tooltip" data-placement="bottom" title="Entregables" style="cursor:pointer;background-color:#0093a3;border: 1px solid green;left:5px;color:white;top: 46.5px;z-index:10;" onclick="window.location.reload();" class="totales a resalta"><?php echo $totalEntregables; ?></p>
	<div  class="clasifTodo">
		<p onclick="tipo(0,<?php echo $totalEntregablesGlobal; ?>,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifTodo"><?php echo $entTColor->getFinal(); ?></p>
		<p onclick="tipo(0,<?php echo $totalEntregablesGlobal; ?>,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifTodo"><?php echo $entTColor->getProceso(); ?></p>
		<p onclick="tipo(0,<?php echo $totalEntregablesGlobal; ?>,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifTodo"><?php echo $entTColor->getPreliminar(); ?></p>
		<p onclick="tipo(0,<?php echo $totalEntregablesGlobal; ?>,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifTodo"><?php echo $entTColor->getCero(); ?></p>
	</div>
	<!--  onclick='muestraDetalle(".$area->getIdArea().",1,0,".$idUsuario.",".$idAreaUsuario.",4)'  -->
	
	<div class="btn-group btn-group-justified groupMod">
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(1,<?php echo $totalEntregablesGlobal; ?>,4);" class="btn btn-primary btnMod">Globales &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalEntregablesGlobal; ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(2,<?php echo $totalEntregablesGeneral; ?>,4);" class="btn btn-primary btnMod">Generales &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalEntregablesGeneral; ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(3,<?php echo $totalEntregablesParticular; ?>,4);" class="btn btn-primary btnMod">Particulares &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalEntregablesParticular; ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(4,<?php echo $totalEntregablesSub; ?>,4);" class="btn btn-primary btnMod">Sub &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $totalEntregablesSub; ?>&nbsp;</b></a>
	</div>
	<!--muestraDetalle(0,0,1,'<?php //echo $idUsuario;?>','<?php //echo $idAreaUsuario;?>',3);-->
	<div  class="clasifPro">
		<p onclick="tipo(1,<?php echo $totalEntregablesGlobal; ?>,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifPro"><?php echo $entGlColor->getFinal(); ?></p>
		<p onclick="tipo(1,<?php echo $totalEntregablesGlobal; ?>,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifPro"><?php echo $entGlColor->getProceso(); ?></p>
		<p onclick="tipo(1,<?php echo $totalEntregablesGlobal; ?>,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifPro"><?php echo $entGlColor->getPreliminar(); ?></p>
		<p onclick="tipo(1,<?php echo $totalEntregablesGlobal; ?>,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifPro"><?php echo $entGlColor->getCero(); ?></p>
	</div>
	<div  class="clasifSol">
		<p onclick="tipo(2,<?php echo $totalEntregablesGlobal; ?>,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifSol "><?php echo $entGeColor->getFinal(); ?></p>
		<p onclick="tipo(2,<?php echo $totalEntregablesGlobal; ?>,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifSol"><?php echo $entGeColor->getProceso(); ?></p>
		<p onclick="tipo(2,<?php echo $totalEntregablesGlobal; ?>,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifSol"><?php echo $entGeColor->getPreliminar(); ?></p>
		<p onclick="tipo(2,<?php echo $totalEntregablesGlobal; ?>,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifSol"><?php echo $entGeColor->getCero(); ?></p>
	</div>
	<div  class="clasifCon">
		<p onclick="tipo(3,<?php echo $totalEntregablesGlobal; ?>,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifCon"><?php echo $entPColor->getFinal(); ?></p>
		<p onclick="tipo(3,<?php echo $totalEntregablesGlobal; ?>,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifCon"><?php echo $entPColor->getProceso(); ?></p>
		<p onclick="tipo(3,<?php echo $totalEntregablesGlobal; ?>,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifCon"><?php echo $entPColor->getPreliminar(); ?></p>
		<p onclick="tipo(3,<?php echo $totalEntregablesGlobal; ?>,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifCon"><?php echo $entPColor->getCero(); ?></p>
	</div>
	<div  class="clasifSug">
		<p onclick="tipo(4,<?php echo $totalEntregablesGlobal; ?>,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifSug"><?php echo $entSColor->getFinal(); ?></p>
		<p onclick="tipo(4,<?php echo $totalEntregablesGlobal; ?>,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifSug"><?php echo $entSColor->getProceso(); ?></p>
		<p onclick="tipo(4,<?php echo $totalEntregablesGlobal; ?>,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifSug"><?php echo $entSColor->getPreliminar(); ?></p>
		<p onclick="tipo(4,<?php echo $totalEntregablesGlobal; ?>,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifSug"><?php echo $entSColor->getCero(); ?></p>
	</div>
	
	<!--
	<div class="titleSub">Tot. sub-áreas&nbsp;&nbsp; <b><?php //echo $totalRecibidosSubArea; ?></b></div>
	<div class="titleSelect">
		<select style="width: 124px;border-radius: 0px;font-size: 9px;font-family: 'Muli-Regular';" name="subArea" id="subArea">
			<?php //echo $cadenaSubAreas;?>
		</select>
	</div>
		-->
	<p style="position:absolute;top:42px;right:30px;"># total</p>


</div>

<div class="global">
	<div style="top: 54px;" class="flotante">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,1,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,1,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje1;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje1."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
		
	</div>
	<div class="flotante" style="top: 52px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,2,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,2,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje2;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje2."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 51px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,3,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,3,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje3;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje3."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 50px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,4,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,4,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje4;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje4."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 49px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,5,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,5,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje5;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje5."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 48px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,6,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,6,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje6;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje6."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 47px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,7,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,7,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje7;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje7."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 46px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,8,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,8,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje8;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje8."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 45px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,9,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,9,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje9;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje9."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 44px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,10,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,10,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje10;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje10."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
		</div>
	</div>
	<div class="flotante" style="top: 43px;">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,11,0,4);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,11,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
		echo $cadenaAreasEje11;
		?>
		<div class="totEj" <?php echo $onclick; ?>>
			<?php 
			echo "<div class=\"totEjeFin\">".$totEje11."</div>";
			echo "<div class='indBox' ".$style2."><div class='cuadro fi'>".$ejeT->getFinal()."</div><div class='cuadro pro'>".$ejeT->getProceso()."</div><div class='cuadro pre'>".$ejeT->getPreliminar()."</div><div class='cuadro cero'>".$ejeT->getCero()."</div></div>";
			?>
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
<div style="top: 33px; width: 100%; overflow-y: hidden !important;" class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg" style="width: 100%;">
		<!-- Modal content-->
		<div class="modal-content" style=" height: 630px;">
			<div class="modal-header h" style="padding: 7px 5px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				 Listado de entregables <a style="color:white;text-decoration:none;" class="resul"></a>
			</div>
			<div class="modal-body detalle" style="padding: 5px 5px;">
          
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

function tipo(tipo,total,estatus)
{
	var tipo = tipo;
	var idArea = <?php echo $idArea;?>;
	var total = total;
	var idUsuario = <?php echo $idUsuario;?>;
	var idAreaUsuario = <?php echo $idAreaUsuario;?>;
	var estatus = estatus;

	$.post("entregablesTipo.php",{idArea:idArea,tipo:tipo,total:total,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,estatus:estatus}, function(data) {
		$(".global").html('');
		//alert(data);
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

function muestraDetalle(idDestino,idEje,tipo,idUsuario,idAreaUsuario,estatus)
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
	
	$.post("detalleGlobal.php",{idDestino:idDestino,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,estatus:estatus}, function(data) {
		$(".detalle").html('');
		//alert(data);
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
