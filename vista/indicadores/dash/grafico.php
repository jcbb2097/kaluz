<?php
	include_once __DIR__."/../../../source/controller/DashboardController.php";
	
	$grafica = $_POST["grafica"];
	$anio = $_POST["anio"];
	$tipo = $_POST["tipo"];
	
	$cadenaTotales = "";
	$cadenaAreas = "";
	
	switch ($grafica)
	{
		case '1':
			$act = new DashboardController();
			$areasSinResolver = $act ->  mostrarAreasSinResolver();
	
			foreach($areasSinResolver as $asr)
			{
				$cadenaTotales.= "".$asr->getTotal().",";
				$cadenaAreas.= "'".$asr->getNombreArea()."',";
			}
			break;
		
		case '2':
			$act = new DashboardController();
			$areasSinResolverAnio = $act ->  mostrarAreasSinResolverAnio($tipo,$anio);
	
			foreach($areasSinResolverAnio as $asr)
			{
				$cadenaTotales.= "".$asr->getTotal().",";
				$cadenaAreas.= "'".$asr->getNombreArea()."',";
			}
			break;
			
		default:
		echo "No se pudo realizar la acción requerida";		
	}	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	

	<style>
@import 'https://code.highcharts.com/css/highcharts.css';

.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
	max-width: 800px;
    margin: 1em auto;
}

.highcharts-title {
    
    font-family:'Muli-SemiBold';
    font-size: 14px;
}

.highcharts-data-table table {
	font-family: 'Muli-Regular';
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


/* Link the series colors to axis colors */
.highcharts-color-0 {
	fill: #7cb5ec;
	stroke: #7cb5ec;
}
.highcharts-axis.highcharts-color-0 .highcharts-axis-line {
	stroke: #7cb5ec;
}
.highcharts-axis.highcharts-color-0 text {
	fill: #7cb5ec;
}
.highcharts-color-1 {
	fill: #90ed7d;
	stroke: #90ed7d;
}
.highcharts-axis.highcharts-color-1 .highcharts-axis-line {
	stroke: #90ed7d;
}
.highcharts-axis.highcharts-color-1 text {
	fill: #90ed7d;
}


.highcharts-yaxis .highcharts-axis-line {
	stroke-width: 2px;
}

</style>
<head>
<body>
<figure class="highcharts-figure">
    <div id="container"></div>
    
</figure>


</body>
<script>
$('document').ready(function()
{ 

var myChart = new Highcharts.chart('container', {

    chart: {
        type: 'column',
        styledMode: true
    },

    title: {
        text: ''
    },
	xAxis: {
        categories: [<?php echo $cadenaAreas; ?>],
		
    },
    yAxis: [{
        className: 'highcharts-color-0',
        title: {
            text: 'total'
        }
    }, {
        className: 'highcharts-color-1',
        opposite: true,
        title: {
            text: ''
        }
    }],

    plotOptions: {
        column: {
            borderRadius: 5
        }
    },
	tooltip: {
    formatter: function() {
        return '<b>' + this.x + '</b> : ' + this.y + '<br> asuntos sin resolver';
		 //return '<b>' + this.x + '</b> : <b>' + this.y + '</b>, in series '+ this.series.name;
    }
},
	/*tooltip: {
        headerFormat: '<span style="font-size:11px"></span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> asuntos<br/>'
    },*/

    series: [{
        data: [<?php echo $cadenaTotales; ?>],
		name: 'Área',
	
    }, /*{
        data: [324, 124, 547, 221],
        yAxis: 1
    }*/]

});

});
</script>
</html>