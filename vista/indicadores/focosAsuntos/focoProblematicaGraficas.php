<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	
	$anio = 2020;
	$idArea = $_GET["idArea"];
	$nombreArea = $_GET["nombreArea"];
	
	$act = new IndicadorController();
	$focos = $act -> mostrarTotalfocosRecibidos($idArea);
	
	$total = $focos -> getTotal();
	
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
	$style= "";
	$seleccion = "";
	
	$totEje1 = 0;$totEje2 = 0;$totEje3 = 0;$totEje4 = 0;$totEje5 = 0;$totEje6 = 0;
	$totEje7 = 0;$totEje8 = 0;$totEje9 = 0;$totEje10 = 0;$totEje11 = 0;
	foreach($areas as $area)
	{		
		$focosArea = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),1);
		if($focosArea->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae1".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje1').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje1').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje1 .= "<div ".$style." id='ae1".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea->getTotal()."</p></div>";
		$totEje1 += $focosArea->getTotal();	
		
		$focosArea2 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),2);
		if($focosArea2->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae2".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje2').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje2').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje2 .= "<div ".$style." id='ae2".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea2->getTotal()."</p></div>";
		$totEje2 += $focosArea2->getTotal();
		
		$focosArea3 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),3);
		if($focosArea3->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae3".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje3').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje3').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje3 .= "<div ".$style."  id='ae3".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea3->getTotal()."</p></div>";
		$totEje3 += $focosArea3->getTotal();
		
		$focosArea4 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),4);
		if($focosArea4->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae4".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje4').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje4').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje4 .= "<div ".$style."  id='ae4".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea4->getTotal()."</p></div>";
		$totEje4 += $focosArea4->getTotal();
		
		$focosArea5 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),5);
		if($focosArea5->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae5".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje5').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje5').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje5 .= "<div ".$style."  id='ae5".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea5->getTotal()."</p></div>";
		$totEje5 += $focosArea5->getTotal();
		
		$focosArea6 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),6);
		if($focosArea6->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae6".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje6').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje6').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje6 .= "<div ".$style."  id='ae6".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea6->getTotal()."</p></div>";
		$totEje6 += $focosArea6->getTotal();
		
		$focosArea7 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),7);
		if($focosArea7->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae7".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje7').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje7').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje7 .= "<div ".$style."  id='ae7".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea7->getTotal()."</p></div>";
		$totEje7 += $focosArea7->getTotal();
		
		$focosArea8 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),8);
		if($focosArea8->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae8".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje8').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje8').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje8 .= "<div ".$style."  id='ae8".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea8->getTotal()."</p></div>";
		$totEje8 += $focosArea8->getTotal();
		
		$focosArea9 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),9);
		if($focosArea9->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae9".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje9').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje9').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje9 .= "<div ".$style."  id='ae9".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea9->getTotal()."</p></div>";
		$totEje9 += $focosArea9->getTotal();
		
		$focosArea10 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),10);
		if($focosArea10->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#ae10".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje10').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje10').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje10 .= "<div ".$style."  id='ae10".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea10->getTotal()."</p></div>";
		$totEje10 += $focosArea10->getTotal();
		
		$focosArea11 = $act -> mostrarTotalfocosRecibidosArea($idArea,$area->getIdArea(),11);
		if($focosArea11->getTotal() == 0){$style = "style='opacity:.4;'";}else{$style="style='background-color: #aeb599;'"; $seleccion .="$('#aeje11".$area->getIdArea()."').hover(function(){ $(padre).find('div#a".$area->getIdArea()."').css('background-color','#0093a3'); $(padre).find('p.nEje11').css('background-color','#0093a3'); }, function() { $(padre).find('div#a".$area->getIdArea()."').css('background-color','#4d4d57'); $(padre).find('p.nEje11').css('background-color','#4d4d57'); } );"; }
		$cadenaAreasEje11 .= "<div ".$style."  id='aeje11".$area->getIdArea()."' onclick=''  class='j  horizontal'><p class='rotar'>".$focosArea11->getTotal()."</p></div>";
		$totEje11 += $focosArea11->getTotal();
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
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	
	
	<style>
	
body{

overflow-y:hidden;
overflow-x:hidden;

background-color:#ffffff;
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
	margin-top: -19px;
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
	</style>
</head>
<body>
<div class="well2 ">Focos de problemáticas gráficas <i onclick="javascript:location.href='focoProblematica.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>'" data-toggle="tooltip" data-placement="bottom" title="Recibidos" style="position: absolute;right: 102px;cursor:pointer;" class="fa fa-envelope-open" aria-hidden="true"></i> <i onclick="javascript:location.href='focoProblematicaEnviados.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>'" data-toggle="tooltip" data-placement="bottom" title="Enviados" style="position: absolute;right: 72px;cursor:pointer;" class="fa fa-paper-plane" aria-hidden="true"></i> <i onclick="javascript:location.href='focoProblematicaGraficas.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>'" data-toggle="tooltip" data-placement="bottom" title="Gráficas" style="color: #00BCD4;position: absolute;right: 39px;cursor:pointer; font-size: 13px;" class="far fa-chart-bar"></i> <i onclick="javascript:location.href='focoProblematicaGlobal.php?idArea=<?php echo $idArea; ?>&nombreArea=<?php echo $nombreArea; ?>'" data-toggle="tooltip" data-placement="bottom" title="Global" style="position: absolute;right: 9px;cursor:pointer;" class="fa fa-globe" aria-hidden="true"></i></div>
<div class="well2 wr"></div>

<div class="global">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div id="container"></div>
		</div>
		<!--<div class="col-md-4 col-sm-4 col-xs-4">2</div>
		<div class="col-md-4 col-sm-4 col-xs-4">3</div>-->
	</div>
	
</div>

</body>
<script>
$('document').ready(function()
{ 
	$('[data-toggle="tooltip"]').tooltip();
});



$(document).ready(function(){
	$('.a').click(function(e) {
	    e.preventDefault();
		$('.a').removeClass('selector');
		$(this).addClass('selector');
	});
});


Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },

    accessibility: {
        announceNewData: {
            enabled: true
        },
        point: {
            valueSuffix: '%'
        }
    },

    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '{point.name}: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> en total<br/>'
    },

    series: [
        {
            name: "Problemáticas",
            colorByPoint: true,
            data: [
                {
                    name: "Recibidas",
                    y: 15,
                    drilldown: "Recibidas"
                },
                {
                    name: "Enviadas",
                    y: 5,
                    drilldown: "Enviadas"
                },
                
            ]
        }
    ],
    drilldown: {
        series: [
            {
                name: "Recibidas",
                id: "Recibidas",
                data: [
                    [
                       
						 "y": 3,
						"name": "Resueltos",
						"color": "#5cb85c",
						"drilldown": "cars2"
                    ],
                    [
                       "y": 2,
						"name": "Resueltos",
						"color": "#5cb85c",
						"drilldown": "cars2"
                    ],
                    [
                        "y": 10,
						"name": "Resueltos",
						"color": "#5cb85c",
						"drilldown": "cars2"
                    ],
                   
                ]
	
            },
            {
                name: "Enviadas",
                id: "Enviadas",
                data: [
                    [
                        "y": 3,
						"name": "Resueltos",
						"color": "#5cb85c",
						"drilldown": "cars2"
                    ],
                    [
                        "y": 3,
						"name": "Resueltos",
						"color": "#5cb85c",
						"drilldown": "cars2"
                    ],
                    [
                        "y": 3,
						"name": "Resueltos",
						"color": "#5cb85c",
						"drilldown": "cars2"
                    ],
                    
                ]
            },
            
            
        ]
    }
});
/*
"name": "Cars",
"y": 2,
"color": "#ffa929",
"drilldown": "cars2"
*/
</script>
</html>
