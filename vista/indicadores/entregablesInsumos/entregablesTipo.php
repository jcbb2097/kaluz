<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EntregableController.php";
	
	$anio = 2020;
	$idArea = $_POST["idArea"];
	$tipo = $_POST["tipo"];
	$total = $_POST["total"];
	$idUsuario = $_POST["idUsuario"];
	$idAreaUsuario = $_POST["idAreaUsuario"];
	$estatus = $_POST["estatus"];
	
	
	$actEntregable = new EntregableController();
	$areaControllerActEnt = new AreaController();
	$mostrarSubAreas = $areaControllerActEnt -> mostrarTodasSubAreas();
	
	
	$totEnt1 = 0; $totEnt2 = 0; $totEnt3 = 0; $totEnt4 = 0; $totEnt5 = 0; $totEnt6 = 0;
	$totEnt7 = 0; $totEnt8 = 0; $totEnt9 = 0; $totEnt10 = 0; $totEnt11 = 0;
	$c = 0;$c2 = 0;$c3 = 0;$c4 = 0;$c5 = 0;$c6 = 0;$c7 = 0;$c8 = 0;$c9 = 0;$c10 = 0;$c11 = 0;
	
	foreach($mostrarSubAreas as $subA)
	{
		$entregableArea = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),1,$tipo,4);
		$totEnt1 = $entregableArea -> getTotal();
		$c .= $totEnt1.",";

		$entregableArea2 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),2,$tipo,4);
		$totEnt2 = $entregableArea2 -> getTotal();
		$c2 .= $totEnt2.",";
		
		$entregableArea3 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),3,$tipo,4);
		$totEnt3 = $entregableArea3 -> getTotal();
		$c3 .= $totEnt3.",";
		
		$entregableArea4 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),4,$tipo,4);
		$totEnt4 = $entregableArea4 -> getTotal();
		$c4 .= $totEnt4.",";
		
		$entregableArea5 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),5,$tipo,4);
		$totEnt5 = $entregableArea5 -> getTotal();
		$c5 .= $totEnt5.",";
		
		$entregableArea6 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),6,$tipo,4);
		$totEnt6 = $entregableArea6 -> getTotal();
		$c6 .= $totEnt6.",";
		
		$entregableArea7 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),7,$tipo,4);
		$totEnt7 = $entregableArea7 -> getTotal();
		$c7 .= $totEnt7.",";
		
		$entregableArea8 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),8,$tipo,4);
		$totEnt8 = $entregableArea8 -> getTotal();
		$c8 .= $totEnt8.",";
		
		$entregableArea9 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),9,$tipo,4);
		$totEnt9 = $entregableArea9 -> getTotal();
		$c9 .= $totEnt9.",";
		
		$entregableArea10 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),10,$tipo,4);
		$totEnt10 = $entregableArea10 -> getTotal();
		$c10 .= $totEnt10.",";
		
		$entregableArea11 = $actEntregable -> mostrarTotalEntregablesAreaTipo($subA->getIdArea(),11,$tipo,4);
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
	
	
	
	$act = new IndicadorController();
	$actEnt = new EntregableController();
	
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
	$style2="";
	$styleColor= "#0093a3";
	$seleccion = "";
	$onclick = "";
	
	//if($tipo == 1){ $styleColor = "#5cb85c";}else if($tipo == 2){ $styleColor = "#efd707";}else{ $styleColor = "#d9534f";}
	$totEje1 = 0;$totEje2 = 0;$totEje3 = 0;$totEje4 = 0;$totEje5 = 0;$totEje6 = 0;
	$totEje7 = 0;$totEje8 = 0;$totEje9 = 0;$totEje10 = 0;$totEje11 = 0; $totalesArea = 0;
	$percentAtenArea = 0.0;
	
	foreach($areas as $area)
	{		
		$asuntosArea = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),1,$tipo,$estatus);
		if($asuntosArea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",1,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[1] + $array[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[3] + $array[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[5] + $array[6] + $array[7] + $array[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[9] + $array[10] + $array[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea1 = $asuntosArea->getTotal() + $array[12] + $array[13]; }
		else{ $totAreaSubArea1 = $asuntosArea->getTotal(); }
		
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea1."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea->getFinal()."</div><div class='cuadro pro'>".$asuntosArea->getProceso()."</div><div class='cuadro pre'>".$asuntosArea->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea->getCero()."</div></div></div>";
		$totEje1 += $totAreaSubArea1;//$asuntosArea->getTotal();
		
		$asuntosArea2 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),2,$tipo,$estatus);
		if($asuntosArea2->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",2,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[1] + $array2[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[3] + $array2[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[5] + $array2[6] + $array2[7] + $array2[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[9] + $array2[10] + $array2[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea2 = $asuntosArea2->getTotal() + $array2[12] + $array2[13]; }
		else{ $totAreaSubArea2 = $asuntosArea2->getTotal(); }
		
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea2."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea2->getFinal()."</div><div class='cuadro pro'>".$asuntosArea2->getProceso()."</div><div class='cuadro pre'>".$asuntosArea2->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea2->getCero()."</div></div></div>";
		$totEje2 +=  $totAreaSubArea2;//$asuntosArea2->getTotal();
		
		$asuntosArea3 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),3,$tipo,$estatus);
		if($asuntosArea3->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",3,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[1] + $array3[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[3] + $array3[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[5] + $array3[6] + $array3[7] + $array3[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[9] + $array3[10] + $array3[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea3 = $asuntosArea3->getTotal() + $array3[12] + $array3[13]; }
		else{ $totAreaSubArea3 = $asuntosArea3->getTotal(); }
		
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea3."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea3->getFinal()."</div><div class='cuadro pro'>".$asuntosArea3->getProceso()."</div><div class='cuadro pre'>".$asuntosArea3->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea3->getCero()."</div></div></div>";
		$totEje3 += $totAreaSubArea3;// $asuntosArea3->getTotal();
		
		$asuntosArea4 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),4,$tipo,$estatus);
		if($asuntosArea4->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",4,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[1] + $array4[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[3] + $array4[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[5] + $array4[6] + $array4[7] + $array4[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[9] + $array4[10] + $array4[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea4 = $asuntosArea4->getTotal() + $array4[12] + $array4[13]; }
		else{ $totAreaSubArea4 = $asuntosArea4->getTotal(); }
		
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea4."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea4->getFinal()."</div><div class='cuadro pro'>".$asuntosArea4->getProceso()."</div><div class='cuadro pre'>".$asuntosArea4->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea4->getCero()."</div></div></div>";
		$totEje4 += $totAreaSubArea4;//$asuntosArea4->getTotal();
		
		$asuntosArea5 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),5,$tipo,$estatus);
		if($asuntosArea5->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",5,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[1] + $array5[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[3] + $array5[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[5] + $array5[6] + $array5[7] + $array5[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[9] + $array5[10] + $array5[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea5 = $asuntosArea5->getTotal() + $array5[12] + $array5[13]; }
		else{ $totAreaSubArea5 = $asuntosArea5->getTotal(); }
		
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea5."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea5->getFinal()."</div><div class='cuadro pro'>".$asuntosArea5->getProceso()."</div><div class='cuadro pre'>".$asuntosArea5->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea5->getCero()."</div></div></div>";
		$totEje5 += $totAreaSubArea5;//$asuntosArea5->getTotal();
		
		$asuntosArea6 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),6,$tipo,$estatus);
		if($asuntosArea6->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",6,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[1] + $array6[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[3] + $array6[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[5] + $array6[6] + $array6[7] + $array6[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[9] + $array6[10] + $array6[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea6 = $asuntosArea6->getTotal() + $array6[12] + $array6[13]; }
		else{ $totAreaSubArea6 = $asuntosArea6->getTotal(); }
		
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea6."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea6->getFinal()."</div><div class='cuadro pro'>".$asuntosArea6->getProceso()."</div><div class='cuadro pre'>".$asuntosArea6->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea6->getCero()."</div></div></div>";
		$totEje6 += $totAreaSubArea6;//$asuntosArea6->getTotal();
		
		$asuntosArea7 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),7,$tipo,$estatus);
		if($asuntosArea7->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",7,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[1] + $array7[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[3] + $array7[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[5] + $array7[6] + $array7[7] + $array7[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[9] + $array7[10] + $array7[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea7 = $asuntosArea7->getTotal() + $array7[12] + $array7[13]; }
		else{ $totAreaSubArea7 = $asuntosArea7->getTotal(); }
		
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea7."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea7->getFinal()."</div><div class='cuadro pro'>".$asuntosArea7->getProceso()."</div><div class='cuadro pre'>".$asuntosArea7->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea7->getCero()."</div></div></div>";
		$totEje7 += $totAreaSubArea7;//$asuntosArea7->getTotal();
		
		$asuntosArea8 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),8,$tipo,$estatus);
		if($asuntosArea8->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",8,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[1] + $array8[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[3] + $array8[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[5] + $array8[6] + $array8[7] + $array8[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[9] + $array8[10] + $array8[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea8 = $asuntosArea8->getTotal() + $array8[12] + $array8[13]; }
		else{ $totAreaSubArea8 = $asuntosArea8->getTotal(); }
		
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea8."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea8->getFinal()."</div><div class='cuadro pro'>".$asuntosArea8->getProceso()."</div><div class='cuadro pre'>".$asuntosArea8->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea8->getCero()."</div></div></div>";
		$totEje8 += $totAreaSubArea8;//$asuntosArea8->getTotal();
		
		$asuntosArea9 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),9,$tipo,$estatus);
		if($asuntosArea9->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",9,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[1] + $array9[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[3] + $array9[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[5] + $array9[6] + $array9[7] + $array9[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[9] + $array9[10] + $array9[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea9 = $asuntosArea9->getTotal() + $array9[12] + $array9[13]; }
		else{ $totAreaSubArea9 = $asuntosArea9->getTotal(); }
		
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea9."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea9->getFinal()."</div><div class='cuadro pro'>".$asuntosArea9->getProceso()."</div><div class='cuadro pre'>".$asuntosArea9->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea9->getCero()."</div></div></div>";
		$totEje9 += $totAreaSubArea9;//$asuntosArea9->getTotal();
		
		$asuntosArea10 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),10,$tipo,$estatus);
		if($asuntosArea10->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",10,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[1] + $array10[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[3] + $array10[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[5] + $array10[6] + $array10[7] + $array10[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[9] + $array10[10] + $array10[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea10 = $asuntosArea10->getTotal() + $array10[12] + $array10[13]; }
		else{ $totAreaSubArea10 = $asuntosArea10->getTotal(); }
		
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea10."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea10->getFinal()."</div><div class='cuadro pro'>".$asuntosArea10->getProceso()."</div><div class='cuadro pre'>".$asuntosArea10->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea10->getCero()."</div></div></div>";
		$totEje10 += $totAreaSubArea10;//$asuntosArea10->getTotal();
		
		$asuntosArea11 = $actEnt -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),11,$tipo,$estatus);
		if($asuntosArea11->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",11,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: ".$styleColor.";color:white;'";$style2="style='opacity:1;'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		
		if($area->getIdArea() == 1){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[0]; }
		else if($area->getIdArea() == 9){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[1] + $array11[2]; }
		else if($area->getIdArea() == 11){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[3] + $array11[4]; }
		else if($area->getIdArea() == 12){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[5] + $array11[6] + $array11[7] + $array11[8]; }
		else if($area->getIdArea() == 18){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[9] + $array11[10] + $array11[11]; }
		else if($area->getIdArea() == 26){ $totAreaSubArea11 = $asuntosArea11->getTotal() + $array11[12] + $array11[13]; }
		else{ $totAreaSubArea11 = $asuntosArea11->getTotal(); }
		
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totAreaSubArea11."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$asuntosArea11->getFinal()."</div><div class='cuadro pro'>".$asuntosArea11->getProceso()."</div><div class='cuadro pre'>".$asuntosArea11->getPreliminar()."</div><div class='cuadro cero'>".$asuntosArea11->getCero()."</div></div></div>";
		$totEje11 += $totAreaSubArea11;

		$totalesArea = $totAreaSubArea1 + $totAreaSubArea2 + $totAreaSubArea3 + $totAreaSubArea4 + $totAreaSubArea5 + $totAreaSubArea6 + $totAreaSubArea7 + $totAreaSubArea8 + $totAreaSubArea9 + $totAreaSubArea10 + $totAreaSubArea11;
		
		$atendidos = $act -> mostrarTotalAsuntosAtendidosRecibidosArea($idArea,$area->getIdArea(),$tipo);
		if($totalesArea > 0)
		{
			$percentAtenArea = ($atendidos->getTotal() / $totalesArea)*100;
		}else{
			$percentAtenArea = 0.0;
		}

		$tea = $actEntregable -> mostrarTotalEntregablesAreaTipo($area->getIdArea(),0,$tipo,$estatus);
		if($tea->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(".$area->getIdArea().",0,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; }
		
		$cadenaTotalesArea .= "<div  id='totalArea".$area->getIdArea()."' ".$onclick."  class=' j2 horizontal'><div class='rotarT'>".$totalesArea."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$tea->getFinal()."</div><div class='cuadro pro'>".$tea->getProceso()."</div><div class='cuadro pre'>".$tea->getPreliminar()."</div><div class='cuadro cero'>".$tea->getCero()."</div></div></div>";

		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";

	}
	$totalesEjesAreas = $totEje1 + $totEje2 + $totEje3 + $totEje4 + $totEje5 + $totEje6 + $totEje7 + $totEje8 + $totEje9 + $totEje10 + $totEje11;
	
	/*atencion porcentajes*/
	
	
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	
</head>
<body>


	<div class="flotante">
		<?php 
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,1,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,1,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,2,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,2,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,3,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,3,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,4,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,4,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,5,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,5,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,6,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,6,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,7,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,7,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,8,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,8,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,9,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,9,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,10,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,10,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
		$ejeT = $actEntregable -> mostrarTotalEntregablesAreaTipo(0,11,$tipo,$estatus);
		if($ejeT->getTotal() == 0){ $onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";}else{ $onclick = "onclick='muestraDetalle(0,11,".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";}
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
