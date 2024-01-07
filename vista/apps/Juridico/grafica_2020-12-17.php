<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$accion = "";
$tipo = "";
$periodo = "";
$indicador = "";
$nombre = "";
$titulo = "";
$tot = 0;
$año = "";
$categorias = array();
$total = array();


if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    $accion = $_GET['accion'];
    $periodo = $_GET['periodo'];
    $indicador = $_GET['indicador'];

    if ($indicador == 1 || $tipo == 0) {
        $nombre = 'Área';
        $titulo = 'Total de Contratos por ' . $nombre;
    } elseif ($indicador == 2) {
        $nombre = 'Eje';
        $titulo = 'Total de Contratos por ' . $nombre;
    } elseif ($indicador == 3) {
        $nombre = 'Exposición Temporal';
        $titulo = 'Total de Contratos por ' . $nombre;
    } elseif ($indicador == 4) {
        $nombre = 'Instrumento Jurídico';
        $titulo = 'Total de Contratos por ' . $nombre;
    } elseif ($indicador == 5) {
        $nombre = 'Tipo';
        $titulo = 'Total de Contratos por ' . $nombre;
    } else {
        $nombre = 'General';
        $titulo = 'Total de Contratos por ' . $nombre;
    }
}

//echo "Hola <br>";
/*echo "tipo: " . $tipo . "<br>";
echo "acción: " . $accion . "<br>";
echo "periodo:" . $periodo . "<br>";
echo "indicador: " . $indicador . "<br>";*/


?>



<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!--  <script src="../../../resources/js/aplicaciones/Noticias/Alta_Noticias.js"></script>
 -->
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            echo '<th>' . $nombre . '</th>';
                            echo '<th>Total de Contratos por ' . $nombre . '</th>'
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
                    	if ($indicador == 1 || $periodo == 0 ) {
                            if ($tipo == 0) {
                                $tipo = 3;
                            }
                    		$consulta = "SELECT a.Nombre AS datos,
                            ( SELECT COUNT( j.Id_juridico ) FROM c_juridico AS j WHERE j.IdArea = a.Id_Area AND j.Id_periodo = $tipo ) AS series 
                            FROM
                            c_area AS a WHERE a.estatus = 1
                            ORDER BY
                            a.Nombre";
                            //echo "Consulta 1: " . $consulta;
                            $resultarea = $catalogo->obtenerLista($consulta);
                            while($rowarea = mysqli_fetch_array($resultarea)){
                                array_push($categorias, $rowarea['datos']);
                                array_push($total, $rowarea['series']);

                                echo '<tr id="trFila">';
                                echo '<td>' . $rowarea['datos'] . '</td>';
                                echo '<td>' . $rowarea['series'] . '</td>';
                                echo '</tr>';
                                $tot += $rowarea['series'];
                            }
                    	} elseif ($indicador == 2){
                    		$consulta = "SELECT
                    		CONCAT(e.idEje,'. ', e.Nombre) AS datos,
                    		( SELECT COUNT( j.Id_juridico ) FROM c_juridico AS j WHERE j.Id_Eje = e.idEje AND j.Id_periodo = $tipo ) AS series 
                    		FROM
                    		c_eje AS e 
                    		ORDER BY
                    		e.idEje";
                    		//echo "Consulta 2: " . $consulta;
                    		$resulteje = $catalogo->obtenerLista($consulta);

                    		while($rowejes = mysqli_fetch_array($resulteje)){
                    			array_push($categorias, $rowejes['datos']);
                                array_push($total, $rowejes['series']);

                    			echo '<tr id="trFila">';
                                echo '<td>' . $rowejes['datos'] . '</td>';
                                echo '<td>' . $rowejes['series'] . '</td>';
                                echo '</tr>';
                                $tot += $rowejes['series'];
                    		}
                    	}elseif ($indicador == 3){
                    		$consulta = "SELECT
                    		e.tituloFinal AS datos,
                    		( SELECT COUNT( j.Id_juridico ) FROM c_juridico AS j WHERE j.Id_Exposicion = e.idExposicion AND j.Id_periodo = $tipo) AS series 
                    		FROM
                    		c_exposicionTemporal AS e
                    		ORDER BY
                    		e.tituloFinal";
                    		//echo "Consulta 3: " . $consulta;
                    		$resultarea = $catalogo->obtenerLista($consulta);
                    		
                            while ($rowareas = mysqli_fetch_array($resultarea)) {
                            	array_push($categorias, $rowareas['datos']);
                                array_push($total, $rowareas['series']);

                            	echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['datos'] . '</td>';
                                echo '<td>' . $rowareas['series'] . '</td>';
                                echo '</tr>';
                                $tot += $rowareas['series'];
                            }
                    	}elseif ($indicador == 4){
                            if ($tipo == 0) {
                                $tipo = 3;
                            }
                    		$consult = "SELECT Periodo FROM c_periodo WHERE Id_Periodo=" . $tipo;
	                        $resultConsult = $catalogo->obtenerLista($consult);
	                        //echo "Periodo" . $consult;
	                        while ($row = mysqli_fetch_array($resultConsult)) {
	                            $año = $row['Periodo'];
	                        }
	                        $consulta = "SELECT ij.nombre AS datos,(SELECT COUNT(j.Id_juridico)
                            FROM c_juridico AS j INNER JOIN c_exposicionTemporal as e on e.idExposicion=j.Id_Exposicion
                            WHERE j.Id_Instrumento = ij.idInstrumento and e.anio=$año) AS series FROM c_instrumentoJuridico AS ij ORDER BY ij.nombre";
                            //echo "<br>Juridico: " . $consulta;
                            $resultinstrumento = $catalogo->obtenerLista($consulta);
                            while ($rowjuridico = mysqli_fetch_array($resultinstrumento)) {
                            	array_push($categorias, $rowjuridico['datos']);
                                array_push($total, $rowjuridico['series']);

                            	echo '<tr id="trFila">';
                                echo '<td>' . $rowjuridico['datos'] . '</td>';
                                echo '<td>' . $rowjuridico['series'] . '</td>';
                                echo '</tr>';
                                $tot += $rowjuridico['series'];
                            }
                    	}else{
                            if ($tipo == 0) {
                                $tipo = 3;
                            }
                    		$consult = "SELECT Periodo FROM c_periodo WHERE Id_Periodo=" . $tipo;
	                        $resultConsult = $catalogo->obtenerLista($consult);
	                        //echo "Periodo" . $consult;
	                        while ($row = mysqli_fetch_array($resultConsult)) {
	                            $año = $row['Periodo'];
	                        }
	                        $nacional="";
	                        $Internacional="";
	                        $total_contratos=0;
                    		$consulta3 = "SELECT j.Tipo_contrato FROM c_juridico as j , c_exposicionTemporal as ja WHERE ja.idExposicion=j.Id_Exposicion AND ja.anio=" . $año;
					        //echo $consulta3;
					        $resultConsulta3 = $catalogo->obtenerLista($consulta3);
					        while ($row = mysqli_fetch_array($resultConsulta3)) {
					            if ($row['Tipo_contrato'] == 1) {
					                $nacional++;
					            } else {
					                $Internacional++;
					            }
					            $total_contratos++;
					        }
					        echo '<tr id="trFila">';
                            echo '<td> Nacional </td>';
                            echo '<td>' . $nacional . '</td>';
                            echo '</tr>';
                            echo '<tr id="trFila">';
                            echo '<td> Internacional </td>';
                            echo '<td>' . $Internacional . '</td>';
                            echo '</tr>';

                            array_push($categorias, 'Nacional', 'Internacional');
                               array_push($total, $nacional, $Internacional);
                            $tot += $total_contratos++;
                    	}
                    	?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de Contratos</th>
                            <th scope="col"><?php echo $tot; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">
                <figure class="highcharts-figure">

                    <div id="container"></div>
                </figure>
            </div>

        </div>
    </div>
</body>
<script>
 
Highcharts.chart('container', {
  chart: {
    type: 'bar'
  },
  title: {
    text: 'Contratos por <?php echo $nombre; ?>'
  },
  xAxis: {
     categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".$valor."', "; }?>]
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Contratos'
    }
  },
  legend: {
    reversed: false
  },
  plotOptions: {
    series: {
      stacking: 'normal'
    }
  },
  series: [{
    name: '<?php echo $tot;?> Contratos' ,
    data: [<?php   foreach ($total as $clave => $valor) { echo  $valor.", "; }?>]
  }]
});

</script>
</html>