<?php
/*created by leasim*/
	include_once __DIR__."/../../source/controller/IndicadorController.php";
    $idUsuario = $_POST["idUsuario"];
	$act = new IndicadorController();
	
	$opinion = $act -> mostrarOpinionesOrigen();
	$cadena = "";
				
	foreach ($opinion as $op)
	{
		$cadena.= "{name: '".$op->getDescripcion()."',y: ".$op->getTotal().",id: ".$op -> getId()."},";
	}
	
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Grafica</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  

  <style>
  .highcharts-figure,
.highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    /*font-size: 1.2em;*/
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

input[type="number"] {
    min-width: 50px;
}

.highcharts-container {
	/*margin-top: -40px;*/
}

#container {
    /*height: 300px;*/
}


	</style>

</head>
<body>
<div class="container-fluid" style=''>
	<figure class="highcharts-figure">
		<div id="container" style=""></div>
	</figure>
</div>

<script>
$(document).ready(function() {

 Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
		//marginTop: -50
    },
    title: {
        text: 'Opiniones por origen',
        align: 'center',
		style: {
            fontSize: 11,
        },
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y}</b>',
        style: {
            fontSize: 11,
        },
    },
	exporting: {
		enabled: true
	},
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
				style: {
                   fontSize: 11,
                },
                enabled: true,
                format: '<b>{point.name}</b>: {point.y} '
            }
        },
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        //alert('value: ' + this.id);
                        muestraDatosOrigen(this.id,this.name);
                    }
                }
            }
        }
    },
    series: [{
        name: 'Total',
        colorByPoint: true,
        data: [<?php echo $cadena; ?>]
    }]
});

	
});




function muestraDatosOrigen(id,name)
{
	var id = id;
    var name = name;
    var idUsuario = <?php echo $idUsuario; ?>;
  
    
	$.confirm({
		type: 'dark',
		typeAnimated: true,
		boxWidth: '800px',
		useBootstrap: false,
		title: 'Opiniones de '+ name,
		content: 'url:central/origenDatos.php?id='+id+'&idUsuario='+idUsuario,
		buttons: {
			formSubmit: {
				text: 'Cerrar',
				btnClass: 'btn-green btnC',
				action: function () {

                }		
			},
			/*cancelar: {
				btnClass: 'btn-danger btnC',
			},*/
			
		},
		onContentReady: function () {
			// bind to events
			var jc = this;
			this.$content.find('form').on('submit', function (e) {
				// if the user submits the form by pressing enter in the field.
				e.preventDefault();
				jc.$$formSubmit.trigger('click'); // reference the button and click it
			});
		}
	});
}
</script>
</body>
</html>
