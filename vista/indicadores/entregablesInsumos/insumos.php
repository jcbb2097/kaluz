<?php

	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/PortadaController.php";
	include_once __DIR__."/../../../source/controller/EntregableController.php";
	
	$anio = 2020;
	$nombreArea = "sistemas";

	$anio =  isset($_REQUEST['anio']) ? $_REQUEST['anio'] : '2020';
	$idArea = isset($_REQUEST['idArea']) ? $_REQUEST['idArea'] : '0';
	$tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '0';
	$idUsuario = isset($_REQUEST['idUsuario']) ? $_REQUEST['idUsuario'] : '3';
	$idAreaUsuario = isset($_REQUEST['idAreaUsuario']) ? $_REQUEST['idAreaUsuario'] : '5';
	$estatus = isset($_REQUEST['estatus']) ? $_REQUEST['estatus'] : '4';
	
	/*Entregables********************************************************************/
	$actEntregable = new EntregableController();
	
	$entTColor = $actEntregable -> mostrarInsumosEncabezado(0,4);
	$entGlColor = $actEntregable -> mostrarInsumosEncabezado(1,4);
	$entGeColor = $actEntregable -> mostrarInsumosEncabezado(2,4);
	$entPColor = $actEntregable -> mostrarInsumosEncabezado(3,4);
	$entSColor = $actEntregable -> mostrarInsumosEncabezado(4,4);
	
	
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

	$filaEje=[];
	$totalesEje = [];
	$filaTotales="";
	$ins = $actEntregable -> mostrarTotalInsumos($tipo,$estatus);
	//$j=0;
	$ix=0;
	$iy=0;
	for ($i=1; $i <= 11; $i++) { 
		$fila="";

		$sin=0;
		$pre=0;
		$pro=0;
		$fin=0;
		$tEj=0;
		foreach($areas as $area) {
			$totArea="";
			$onclick = "";
			$estatusT = "";	
			$style = ""; 
			$style2 = "";
			if(isset($ins[$iy][$ix])) {
				if($area->getIdArea() == $ins[$iy][$ix]->getIdArea() && $ins[$iy][0]->getNombreEje() == $i) {
					$onclick = "onclick='muestraInsumos(".$area->getIdArea().",".$ins[$iy][0]->getNombreEje().",".$tipo.",".$idUsuario.",".$idAreaUsuario.",".$estatus.")' "; 
					$style="style='background-color: #b1465c;color: white;'"; 
					$style2="style='opacity:1;'"; 
					$seleccion .="$('#ae".$i.$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje".$i."').css('background-color','#5d2852'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje".$i."').css('background-color','#4d4d57'); } );";
					$totArea = $ins[$iy][$ix]->getTotal(); 
					$estatusT = "<div class='indBox' ".$style2.">";
					if($ins[$iy][$ix]->getFinal() > 0) $estatusT .= "<div class='cuadro fi' style='grid-column: 1 / 2; grid-row: 1 / 2;'>".$ins[$iy][$ix]->getFinal()."</div>";
					if($ins[$iy][$ix]->getProceso() > 0) $estatusT .= "<div class='cuadro pro' style='grid-column: 2 / 3; grid-row: 1 / 2;'>".$ins[$iy][$ix]->getProceso()."</div>";
					if($ins[$iy][$ix]->getPreliminar() > 0) $estatusT .= "<div class='cuadro pre' style='grid-column: 1 / 2; grid-row: 2 / 3;'>".$ins[$iy][$ix]->getPreliminar()."</div>";
					if($ins[$iy][$ix]->getCero() > 0) $estatusT .= "<div class='cuadro cero' style='grid-column: 2 / 3; grid-row: 2 / 3;'>".$ins[$iy][$ix]->getCero()."</div>";
					$estatusT .= "</div>";
					
					$sin+=$ins[$iy][$ix]->getCero();
					$pre+=$ins[$iy][$ix]->getPreliminar();
					$pro+=$ins[$iy][$ix]->getProceso();
					$fin+=$ins[$iy][$ix]->getFinal();
					$tEj+=$totArea;
					$ix++;
				} else {
					$style = "style='opacity:.4;'"; 
					$style2 = "style='opacity:0;'";
				}
			}
			
			$fila .= "<div ".$style." id='ae".$i.$area->getIdArea()."' ".$onclick."  class='j  horizontal'><div class='rotar'>".$totArea."</div>".$estatusT."</div>";
			//$j++;
		}
		if($ix > 0)
			$iy++;
		$ix=0;
		array_push($filaEje,$fila);

		$fiEje = "";
		$style="";
		$style2="";
		if($tEj == 0) { 
			$onclick = ""; $style = "style='opacity:.4;'"; $style2 = "style='opacity:0;'";
		} else { 
			$onclick = "onclick='muestraInsumos(0,".$i.",0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'"; $style2="style='opacity:1;'";
		}

		$fiEje .= "<div class=\"totEj\" ".$onclick.">";
		$fiEje .= "<div class=\"totEjeFin\">".$tEj."</div>";
		$fiEje .= "<div class='indBox2' ".$style2.">";
		if($fin>0) $fiEje .= "<div class='cuadro fi' style='grid-column:1/2;'>".$fin."</div>";
		if($pro>0) $fiEje .= "<div class='cuadro pro' style='grid-column:2/3;'>".$pro."</div>";
		if($pre>0) $fiEje .= "<div class='cuadro pre' style='grid-column:3/4;'>".$pre."</div>";
		if($sin>0) $fiEje .= "<div class='cuadro cero' style='grid-column:4/5;'>".$sin."</div>";
		$fiEje .= "</div>";
		$fiEje .= "</div>";
		array_push($totalesEje,$fiEje);


	}

	foreach($areas as $area) {
		$style="";
		$style2="";
		//totales por AREA
		$tea = $actEntregable -> mostrarInsumosArea($area->getIdArea(),$tipo,0,$estatus);

		if($tea->getTotal() == 0) { 
			$onclick = ""; $style = "style='opacity:.4;'";$style2 = "style='opacity:0;'";
		} else{ 
			$onclick = "onclick='muestraInsumos(".$area->getIdArea().",0,0,".$idUsuario.",".$idAreaUsuario.",4)' "; $style="style='background-color: #0093a3;color: white;'";$style2="style='opacity:1;'"; 
		}

		$filaTotales .= "<div style='cursor:pointer;' ".$onclick." id='totalArea".$area->getIdArea()."' class=' j2 horizontal'><div class='rotarT'>".$tea->getTotal()."</div><div class='indBox' ".$style2."><div class='cuadro fi'>".$tea->getFinal()."</div><div class='cuadro pro'>".$tea->getProceso()."</div><div class='cuadro pre'>".$tea->getPreliminar()."</div><div class='cuadro cero'>".$tea->getCero()."</div></div></div>";
		
		$seleccion .="$('#totalArea".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3');  }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); } );";
	}

	//echo $ins[1][0]->getProceso();
	/*foreach($ins as $ej) {
		foreach($ej as $insm) {
			echo $insm->getTotal().',';
		}
		echo '<br>';
	}*/
	
	
	
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
  	display: grid;
  	/*flex-direction: row;*/
  	padding-top:5px;
  	/*flex-wrap: wrap;*/
  	grid-template-columns: 14.6px 14.6px;
  	grid-template-rows: 15px 15px;

  }
  .indBox2 {
  	display: grid;
  	padding-top:5px;
  	grid-template-columns: 14.6px 14.6px 14.6px 14.6px;

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
	Indicador: Insumos 2020
</div>
<div class="well2 wr">
	<p style="position: absolute;left: 2px;top: 31px;">Totales</p>
	<p data-toggle="tooltip" data-placement="bottom" title="Entregables" style="cursor:pointer;background-color:#0093a3;border: 1px solid green;left:5px;color:white;top: 46.5px;z-index:10;" onclick="tipo(0,4);" class="totales a resalta"><?php echo $entTColor->getTotal(); ?></p>
	<div  class="clasifTodo">
		<p onclick="tipo(0,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifTodo"><?php echo $entTColor->getFinal(); ?></p>
		<p onclick="tipo(0,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifTodo"><?php echo $entTColor->getProceso(); ?></p>
		<p onclick="tipo(0,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifTodo"><?php echo $entTColor->getPreliminar(); ?></p>
		<p onclick="tipo(0,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifTodo"><?php echo $entTColor->getCero(); ?></p>
	</div>
	<!--  onclick='muestraDetalle(".$area->getIdArea().",1,0,".$idUsuario.",".$idAreaUsuario.",4)'  -->
	
	<div class="btn-group btn-group-justified groupMod">
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(1,4);" class="btn btn-primary btnMod">Globales &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $entGlColor->getTotal(); ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(2,4);" class="btn btn-primary btnMod">Generales &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $entGeColor->getTotal(); ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(3,4);" class="btn btn-primary btnMod">Particulares &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $entPColor->getTotal(); ?>&nbsp;</b></a>
		<a style="background-color: #4d4d57;border: 1px solid #a9a9ae;" onclick="tipo(4,4);" class="btn btn-primary btnMod">Sub &nbsp;<b style="background-color: #0093a3;color:white;">&nbsp;<?php echo $entSColor->getTotal(); ?>&nbsp;</b></a>
	</div>
	<!--muestraDetalle(0,0,1,'<?php //echo $idUsuario;?>','<?php //echo $idAreaUsuario;?>',3);-->
	<div  class="clasifPro">
		<p onclick="tipo(1,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifPro"><?php echo $entGlColor->getFinal(); ?></p>
		<p onclick="tipo(1,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifPro"><?php echo $entGlColor->getProceso(); ?></p>
		<p onclick="tipo(1,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifPro"><?php echo $entGlColor->getPreliminar(); ?></p>
		<p onclick="tipo(1,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifPro"><?php echo $entGlColor->getCero(); ?></p>
	</div>
	<div  class="clasifSol">
		<p onclick="tipo(2,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifSol "><?php echo $entGeColor->getFinal(); ?></p>
		<p onclick="tipo(2,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifSol"><?php echo $entGeColor->getProceso(); ?></p>
		<p onclick="tipo(2,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifSol"><?php echo $entGeColor->getPreliminar(); ?></p>
		<p onclick="tipo(2,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifSol"><?php echo $entGeColor->getCero(); ?></p>
	</div>
	<div  class="clasifCon">
		<p onclick="tipo(3,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifCon"><?php echo $entPColor->getFinal(); ?></p>
		<p onclick="tipo(3,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifCon"><?php echo $entPColor->getProceso(); ?></p>
		<p onclick="tipo(3,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifCon"><?php echo $entPColor->getPreliminar(); ?></p>
		<p onclick="tipo(3,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifCon"><?php echo $entPColor->getCero(); ?></p>
	</div>
	<div  class="clasifSug">
		<p onclick="tipo(4,3);" style="cursor:pointer;background-color: #5cb85c;" class="b pclasifSug"><?php echo $entSColor->getFinal(); ?></p>
		<p onclick="tipo(4,2);" style="cursor:pointer;background-color: #efd707;" class="b pclasifSug"><?php echo $entSColor->getProceso(); ?></p>
		<p onclick="tipo(4,1);" style="cursor:pointer;background-color: #ff9800;" class="b pclasifSug"><?php echo $entSColor->getPreliminar(); ?></p>
		<p onclick="tipo(4,0);" style="cursor:pointer;background-color: #d9534f;" class="b pclasifSug"><?php echo $entSColor->getCero(); ?></p>
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
		echo $filaEje[0];
		echo $totalesEje[0];
		?>
		
		
	</div>
	<div class="flotante" style="top: 52px;">
		<?php 
		echo $filaEje[1];
		echo $totalesEje[1];
		?>
	</div>
	<div class="flotante" style="top: 51px;">
		<?php 
		echo $filaEje[2];
		echo $totalesEje[2];
		?>
	</div>
	<div class="flotante" style="top: 50px;">
		<?php 
		echo $filaEje[3];
		echo $totalesEje[3];
		?>
	</div>
	<div class="flotante" style="top: 49px;">
		<?php 
		echo $filaEje[4];
		echo $totalesEje[4];
		?>
	</div>
	<div class="flotante" style="top: 48px;">
		<?php 
		echo $filaEje[5];
		echo $totalesEje[5];
		?>
	</div>
	<div class="flotante" style="top: 47px;">
		<?php 
		echo $filaEje[6];
		echo $totalesEje[6];
		?>
	</div>
	<div class="flotante" style="top: 46px;">
		<?php 
		echo $filaEje[7];
		echo $totalesEje[7];
		?>
	</div>
	<div class="flotante" style="top: 45px;">
		<?php 
		echo $filaEje[8];
		echo $totalesEje[8];
		?>
	</div>
	<div class="flotante" style="top: 44px;">
		<?php 
		echo $filaEje[9];
		echo $totalesEje[9];
		?>
	</div>
	<div class="flotante" style="top: 43px;">
		<?php 
		echo $filaEje[10];
		echo $totalesEje[10];
		?>
	</div>
	
	<div class="flotante" style="top: 42px;">
		<?php echo $filaTotales;?>
		<div class="totEj" ><p style="font-size: 15px;"><?php //echo $totalesEjesAreas;?></p></div>
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

function tipo(tipo,estatus)
{
	var tipo = tipo;
	var idArea = <?php echo $idArea;?>;
	var idUsuario = <?php echo $idUsuario;?>;
	var idAreaUsuario = <?php echo $idAreaUsuario;?>;
	var estatus = estatus;

	location.replace("insumos.php?idArea="+idArea+"&tipo="+tipo+"&idUsuario="+idUsuario+"&idAreaUsuario="+idAreaUsuario+"&estatus="+estatus); 

	/*$.post("entregablesTipo.php",{idArea:idArea,tipo:tipo,total:total,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,estatus:estatus}, function(data) {
		$(".global").html('');
		//alert(data);
		$(".global").html(data);
	});*/
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

function muestraInsumos(idDestino,idEje,tipo,idUsuario,idAreaUsuario,estatus) {
	var idDestino = idDestino;
	var idEje = idEje;
	var tipo = tipo;
	var idUsuario = idUsuario;
	var idAreaUsuario = idAreaUsuario;
	var estatus = estatus;
	
	$(".h").css('background-color',"#4d4d57");
	$(".resul").html('');
	$("#myModal").modal({backdrop: false});
	
	$.post("detalleInsumo.php",{idDestino:idDestino,idEje:idEje,tipo:tipo,idUsuario:idUsuario,idAreaUsuario:idAreaUsuario,estatus:estatus}, function(data) {
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
