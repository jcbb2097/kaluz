<?php
session_start();

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
$id_eje = array(); // añadido
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
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif ($tipo == 2) {
        $nombre = 'Eje';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } elseif ($tipo == 3) {
        $nombre = 'Año';
        $titulo = 'Total de acuerdos por ' . $nombre;
    } else {
        $nombre = 'Exposición';
        $titulo = 'Total de acuerdos por ' . $nombre;
    }
}

//EXTRAEMOS EL ID Y NOMBRE DE USUARIO
$idUsuario = $_SESSION['user_session'];
$nombreUsuario = 'Zeuxis Martínez';
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../../../resources/js/aplicaciones/AcuedosEscritos/Alta_acuerdo.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            echo '<th>Acuerdos escritos por ' . $nombre . '</th>';
                            if ($tipo == 1) {
                                echo ' <th>Donde mi área convoca</th>';
                            } else {
                                echo ' <th>total por ' . $nombre . '</th>';
                            }
                            ?>
                            <?php if ($tipo == 1) echo ' <th>Donde mi área fue invitada</th>'; ?>
                            <th>Realizado</th>
                            <th>No Realizado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($tipo == 1) {

                            $areas = "SELECT
                                a.Nombre AS nombre,
                                ( SELECT COUNT( acu.id_acuerdo_escrito ) FROM c_acuerdospdf AS acu WHERE acu.id_area = a.Id_Area ) AS convoca,
                                ( SELECT COUNT( inv.id_Acuerdo_area ) FROM k_acuerdoarea AS inv WHERE inv.id_Area_invitada = a.Id_Area ) AS invitada,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p WHERE p.id_area = a.Id_Area AND p.estatus = 1 ) AS realizado,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p WHERE p.id_area = a.Id_Area AND p.estatus = 0 ) AS norealizado 
                            FROM
                                c_area AS a
                                ORDER BY a.Nombre";
                            //echo$areas;
                            $resultareas = $catalogo->obtenerLista($areas);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['convoca']);
                                array_push($realizado, $rowareas['realizado']);
                                array_push($norealizado, $rowareas['norealizado']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowareas['convoca'] == '0') {
                                    echo '<td>' . $rowareas['convoca'] . '</td>';
                                    $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowareas['convoca'] . '</a> </td>';
                                    $totalconvoca = $totalconvoca + $rowareas['convoca'];
                                }

                                if ($rowareas['invitada'] == '0') {
                                    echo '<td>' . $rowareas['invitada'] . '</td>';
                                    $totalinvita = $totalinvita + $rowareas['invitada'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowareas['invitada'] . '</a> </td>';
                                    $totalinvita = $totalinvita + $rowareas['invitada'];
                                }

                                if ($rowareas['realizado'] == '0') {
                                    echo '<td>' . $rowareas['realizado'] . '</td>';
                                    $totalrea = $totalrea + $rowareas['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowareas['realizado'] . '</a> </td>';
                                    $totalrea = $totalrea + $rowareas['realizado'];
                                }

                                if ($rowareas['norealizado'] == '0') {
                                    echo '<td>' . $rowareas['norealizado'] . '</td>';
                                    $totalnorea = $totalnorea + $rowareas['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowareas['norealizado'] . '</a> </td>';
                                    $totalnorea = $totalnorea + $rowareas['norealizado'];
                                }

                                echo '</tr>';
                                $contador++;
                            }
                            /*  echo '<td>Total</td>';
                            echo '<td>' . $totalconvoca . '</td>';
                            echo '<td>' . $totalinvita . '</td>';
                            echo '<td>' . $totalrea . '</td>';
                            echo '<td>' . $totalnorea . '</td>'; */
                        } elseif ($tipo == 2) {
                            $ejes = "SELECT idEje, e.Nombre as nombre,
                            (SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu WHERE acu.id_proyecto = e.idEje ) AS concoca,
                            (SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p INNER JOIN k_acuerdoactividad AS c WHERE p.estatus = 1 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_proyecto = e.idEje) AS realizado,
                            (SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p INNER JOIN k_acuerdoactividad AS c WHERE p.estatus = 0 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_proyecto = e.idEje) AS norealizado
                            FROM c_eje as e ORDER BY idEje ASC";
                            
                            $resultejes = $catalogo->obtenerLista($ejes);
                            while ($rowejes = mysqli_fetch_array($resultejes)) {

                                echo '<tr id="trFila">';
                                array_push($id_eje, $rowejes['idEje']); //añadido
                                array_push($categorias, $rowejes['nombre']);
                                array_push($norealizado, $rowejes['norealizado']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($total, $rowejes['concoca']);
                                echo '<td>' . $rowejes['idEje'] . '. ' . $rowejes['nombre'] . '</td>';
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                    $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&portada=1&tipo_acuerdo=convocadoseje&ejeid='.$rowejes['idEje'].'">' . $rowejes['concoca'] . '</a> </td>';
                                    $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                    $totalrea = $totalrea + $rowejes['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&portada=1&tipo_acuerdo=realizadoseje&ejeid='.$rowejes['idEje'].'">' . $rowejes['realizado'] . '</a> </td>';
                                    $totalrea = $totalrea + $rowejes['realizado'];
                                }

                                if ($rowejes['norealizado'] == '0') {
                                    echo '<td>' . $rowejes['norealizado'] . '</td>';
                                    $totalnorea = $totalnorea + $rowejes['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario .'&portada=1&tipo_acuerdo=norealizadoseje&ejeid='.$rowejes['idEje'].'">' . $rowejes['norealizado'] . '</a> </td>';
                                    $totalnorea = $totalnorea + $rowejes['norealizado'];
                                }
                                echo '</tr>';
                            }
                            
                            echo '<tr>'; //añadido
                                echo '<th>Total</th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&portada=1&tipo_acuerdo=convocados">' . array_sum($total) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&portada=1&tipo_acuerdo=realizados">' . array_sum($realizado) . '</a> </th>';
                                echo '<th> <a href="Lista_acuerdos.php?nombreUsuario='.$nombreUsuario.'&portada=1&tipo_acuerdo=norealizados">' . array_sum($norealizado) . '</a> </th>';
                                
                            echo '</tr>';
                            
                            
                        } elseif ($tipo == 3) {
                            $act = "SELECT
                                a.Periodo AS nombre,
                                ( SELECT COUNT( acu.id_acuerdo_escrito ) FROM c_acuerdospdf AS acu WHERE acu.anio = a.Id_Periodo ) AS concoca,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p WHERE p.anio = a.Id_Periodo AND p.estatus = 1 ) AS realizado,
                                ( SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p WHERE p.anio = a.Id_Periodo AND p.estatus = 0 ) AS norealizado 
                            FROM
                                c_periodo AS a 
                            ORDER BY
                                a.Periodo";
                            $resultexpo = $catalogo->obtenerLista($act);
                            while ($rowejes = mysqli_fetch_array($resultexpo)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['nombre']);
                                array_push($norealizado, $rowejes['norealizado']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($total, $rowejes['concoca']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';

                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                    $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowejes['concoca'] . '</a> </td>';
                                    $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                    $totalrea = $totalrea + $rowejes['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowejes['realizado'] . '</a> </td>';
                                    $totalrea = $totalrea + $rowejes['realizado'];
                                }

                                if ($rowejes['norealizado'] == '0') {
                                    echo '<td>' . $rowejes['norealizado'] . '</td>';
                                    $totalnorea = $totalnorea + $rowejes['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowejes['norealizado'] . '</a> </td>';
                                    $totalnorea = $totalnorea + $rowejes['norealizado'];
                                }
                                echo '</tr>';
                            }
                        } else {
                            $expo = "SELECT
                                e.tituloFinal AS nombre,
                                ( SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu WHERE acu.id_exposicion = e.idExposicion ) AS concoca,
                                (
                                SELECT
                                    COUNT( id_acuerdo_escrito ) 
                                FROM
                                    c_acuerdospdf AS p
                                    INNER JOIN k_acuerdoactividad AS c 
                                WHERE
                                    p.estatus = 1 
                                    AND c.id_acuerdo = p.id_acuerdo_escrito 
                                    AND c.id_exposicion = e.idExposicion 
                                ) AS realizado,
                                (
                                SELECT
                                    COUNT( id_acuerdo_escrito ) 
                                FROM
                                    c_acuerdospdf AS p
                                    INNER JOIN k_acuerdoactividad AS c 
                                WHERE
                                    p.estatus = 0 
                                    AND c.id_acuerdo = p.id_acuerdo_escrito 
                                    AND c.id_exposicion = e.idExposicion 
                                ) AS norealizado 
                            FROM
                                c_exposicionTemporal AS e 
                            ORDER BY
                                tituloFinal";
                            $resultexpo = $catalogo->obtenerLista($expo);
                            while ($rowejes = mysqli_fetch_array($resultexpo)) {

                                echo '<tr id="trFila">';
                                array_push($categorias, $rowejes['nombre']);
                                array_push($norealizado, $rowejes['norealizado']);
                                array_push($realizado, $rowejes['realizado']);
                                array_push($total, $rowejes['concoca']);
                                echo '<td>' . $rowejes['nombre'] . '</td>';
                                
                                //recorre el while y valida si esta en 0 no crea el href
                                if ($rowejes['concoca'] == '0') {
                                    echo '<td>' . $rowejes['concoca'] . '</td>';
                                    $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowejes['concoca'] . '</a> </td>';
                                    $totalconvoca = $totalconvoca + $rowejes['concoca'];
                                }

                                if ($rowejes['realizado'] == '0') {
                                    echo '<td>' . $rowejes['realizado'] . '</td>';
                                    $totalrea = $totalrea + $rowejes['realizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowejes['realizado'] . '</a> </td>';
                                    $totalrea = $totalrea + $rowejes['realizado'];
                                }

                                if ($rowejes['norealizado'] == '0') {
                                    echo '<td>' . $rowejes['norealizado'] . '</td>';
                                    $totalnorea = $totalnorea + $rowejes['norealizado'];
                                } else {
                                    echo '<td> <a href="Lista_acuerdos.php?nombreUsuario=' . $nombreUsuario . '">' . $rowejes['norealizado'] . '</a> </td>';
                                    $totalnorea = $totalnorea + $rowejes['norealizado'];
                                }
                                echo '</tr>';
                            }
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
$resultados = "";
for ($index = 0; $index < count($total); $index++) {
    $resultados = $resultados . $total[$index];
    if ($index + 1 < count($total)) {
        $resultados = $resultados . ",";
    }
}
$resultados2 = "";
for ($index = 0; $index < count($realizado); $index++) {
    $resultados2 = $resultados2 . $realizado[$index];
    if ($index + 1 < count($realizado)) {
        $resultados2 = $resultados2 . ",";
    }
}
$resultados3 = "";
for ($index = 0; $index < count($norealizado); $index++) {
    $resultados3 = $resultados3 . $norealizado[$index];
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
            text: '<?php echo $titulo; ?>'
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
                echo $resultados;
                ?>
            ],
            stack: 'male'
        }, {
            name: 'realizados',
            data: [
                <?php
                echo $resultados2;
                ?>
            ],
            stack: 'female'
        }, {
            name: 'No realizados',
            data: [
                <?php
                echo $resultados3;
                ?>
            ],
            stack: 'female'
        }]
    });
</script>

</html>