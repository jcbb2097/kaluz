<?php
	include_once __DIR__."/../../../source/controller/IndicadorController.php";
	include_once __DIR__."/../../../source/controller/AreaController.php";
	include_once __DIR__."/../../../source/controller/EjeController.php";
	include_once __DIR__."/../../../source/controller/LogroController.php";
	
	$anio = 2020;
	$tipo = $_POST["tipo"];
	
	$actLogro = new LogroController();
	$actEje = new EjeController();
	
	$ejes = $actEje -> mostrarEjes();
	
	$cadenaEjes = "";
	
	foreach($ejes as $eje)
	{
		$cadenaEjes .= "'".$eje->getOrden().". ".$eje->getNombre()."',";
	}
	
	$porArea = $actLogro ->  mostrarDetallePorAreaGlobalGrafica($tipo);
	
	$cadenaAreas = "";
	$cadenaAreasTot = "";
	foreach($porArea as $pa)
	{
		$cadenaAreas .= "'".$pa->getNombreArea()."',";
		$cadenaAreasTot .= "".$pa->getTotal().",";
	}
	
	$titulo = "";
	
	if($tipo == 1){
		$titulo = "actividades";
	}else{
		$titulo = "metas";
	}
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
	<!--<link rel="stylesheet" type="text/css" href="../resources/css/inicio.css"/>-->
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	-->
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
	<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	
	
	
	<style>
	
.highcharts-figure, .highcharts-data-table table {
  min-width: 310px; 
  max-width: 800px;
  margin: 1em auto;
}

#container {
  height: 400px;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
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


	</style>
	
</head>
<body>

<figure class="highcharts-figure">
  <div id="container"></div>
  
</figure>
</body>
<script>
$('document').ready(function()
{ 
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover(); 
	
	Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Áreas sin llenar Logros de <?php echo $titulo ?> 2020'
  },
  subtitle: {
    text: ''
  },
  xAxis: {
    categories: [
      <?php echo $cadenaAreas;?>
     
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Total'
    },
	
	
	
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y}</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  colors: [ '#F44336' ],


  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    },
	
	series: {
            colorByPoint: true
        }
	
  },
  series: [{
    name: 'Sin llenar',
    data: [<?php echo $cadenaAreasTot; ?>]

  },/* {
    name: 'Terminados',
    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, ]

  }, {
    name: 'En proceso',
    data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, ]

  },*/]
});
	
	
	
});


</script>
</html>
