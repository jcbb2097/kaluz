<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$accion = "";
$tipo = "";
$periodo = "";
$nombre = "";
$contador = 1;
$totalconvoca = 0;
$totalinvita = 0;
$totalrea = 0;
$totalnorea = 0;
$categorias = array();
$realizado = array();
$norealizado = array();
$invitados = array();
$total = array();
$titulo = "";
if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    $accion = $_GET['accion'];
    $periodo = $_GET['periodo'];
    if ($tipo == 1) {
        $nombre = 'Área';
        $titulo='Total de archivos por '.$nombre;
    } else {
        $nombre = 'Eje';
        $titulo='Total de archivos por '.$nombre;
    }
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../../../resources/js/aplicaciones/ArchivosCompartidos/Alta_archivo.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="tArchivo" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                        <?php
                                echo'<th scope="col">Archivos Compartidos ' . $nombre . '</th>';

                                echo'<th scope="col">Número de archivos</th>';
                                if ($tipo == 1) {
                                    echo'<th scope="col">Áreas interesadas</th>';
                                }
                                ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($tipo == 1) {

                            $areas = "SELECT
                            a.Nombre AS nombre,
                            ( SELECT COUNT( acu.id_documento ) FROM c_documento AS acu WHERE acu.id_area = a.Id_Area ) AS convoca,
                            ( SELECT COUNT( inv.id_Area_invitada ) FROM k_archivoarea AS inv WHERE inv.id_Area_invitada = a.Id_Area ) AS invitada 
                        FROM
                            c_area AS a 
                            INNER JOIN k_area_periodo as k on k.Id_Area=a.Id_Area
                        WHERE
                            k.Id_Periodo = 3 ORDER BY a.Nombre";
                            //echo$areas;
                            $resultareas = $catalogo->obtenerLista($areas);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['convoca']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                echo '<td>' . $rowareas['convoca'] . '</td>';
                                $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                echo '<td>' . $rowareas['invitada'] . '</td>';
                                $totalinvita = $totalinvita + $rowareas['invitada'];
                                echo '</tr>';
                                $contador++;
                            }
                           /*  echo '<td>Total</td>';
                            echo '<td>' . $totalconvoca . '</td>';
                            echo '<td>' . $totalinvita . '</td>';
                            echo '<td>' . $totalrea . '</td>';
                            echo '<td>' . $totalnorea . '</td>'; */
                        } else {
                            $ejes = "SELECT a.Nombre AS nombre, ( SELECT COUNT(acu.id_proyecto) FROM k_archivoactividad AS acu WHERE acu.id_proyecto = a.idEje) AS concoca FROM c_eje AS a 
                            INNER JOIN k_proyecto_periodo as p on p.Id_Proyecto=a.idEje
                            WHERE p.Id_Periodo = 3"; 
                           // echo $ejes;
                            $resultejes = $catalogo->obtenerLista($ejes);
                            while ($rowejes = mysqli_fetch_array($resultejes)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['nombre']);
                                array_push($total, $rowejes['concoca']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';
                                echo '<td>' . $rowejes['concoca'] . '</td>';
                                $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                
                                echo '</tr>';
                            }
                            /* echo '<td>Total</td>';
                            echo '<td>' . $totalconvoca . '</td>';
                            echo '<td>' . $totalrea . '</td>';
                            echo '<td>' . $totalnorea . '</td>'; */
                        }
                        ?>
                    </tbody>
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
<?php
    $nombres = "";
    for ($i = 0; $i < count($categorias); $i++) {
        $nombres = $nombres . "'" . $categorias[$i] . "'";
        if ($i + 1 < count($categorias)) {
            $nombres = $nombres . ",";
        }
    }
    $resultados="";
    for ($index = 0; $index < count($total); $index++) {
        $resultados=$resultados.$total[$index];
        if ($index + 1 < count($total)) {
            $resultados = $resultados . ",";
        }
    }
    $resultados2="";
    for ($index = 0; $index < count($realizado); $index++) {
        $resultados2=$resultados2.$realizado[$index];
        if ($index + 1 < count($realizado)) {
            $resultados2 = $resultados2 . ",";
        }
    }
    $resultados3="";
    for ($index = 0; $index < count($norealizado); $index++) {
        $resultados3=$resultados3.$norealizado[$index];
        if ($index + 1 < count($norealizado)) {
            $resultados3 = $resultados3 . ",";
        }
    }
   
    
   
    ?>
    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: 15,
                    viewDistance: 25,
                    depth: 40
                }
            },
            title: {
                text: '<?php echo$titulo; ?>'
            },
            xAxis: {
                categories: [
<?php
echo $nombres;
?>
                ],
                labels: {
                    skew3d: true,
                    style: {
                        fontSize: '16px'
                    }
                }
            },
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'Numero de Acuerdos',
                    skew3d: true
                }
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    depth: 40
                }
            },
            series: [{
                    name: 'Acuerdos',
                    data: [
                        <?php
                        echo$resultados;
                        ?>
                    ],
                    stack: 'male'
                }, {
                    name: 'realizados',
                    data: [
                        <?php
                        echo$resultados2;
                        ?>
                    ],
                    stack: 'female'
                }, {
                    name: 'No realizados',
                    data: [
                        <?php
                        echo$resultados3;
                        ?>
                    ],
                    stack: 'female'
                }]
        });

    </script>
    </html>