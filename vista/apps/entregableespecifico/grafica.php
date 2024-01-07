<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$tipo = "";
$nombre = "";
$titulo = "";
$tot = 0;
$categorias = array();
$total = array();
$anio="";

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual="2020";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "") { //Si trae Todos no se debe filtrar por año, pero si trae algo diferente se arma el WHERE
    $AnioActual=$_GET['F_IdAnio'];
    if ($_GET['F_IdAnio'] == "Todos") { $VarWhere= " "; }
    else { $VarWhere=" AND pe.Periodo='".$AnioActual."' "; }
}

$Aplicacion="Entregable Especifico";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    if       ($tipo == 1)  {    $nombre = 'Eje';                            $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 2)  {    $nombre = 'Área';                           $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 3)  {    $nombre = 'Año';                            $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 4)  {    $nombre = 'Intervalo';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 5)  {    $nombre = 'Actividad';            $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 11) {    $nombre = 'Exposición';                     $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    }
}
?>

<script>
    var MiApp='<?php echo $Aplicacion; ?>';
    var MiTipoPerfil='<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr='<?php echo $MiIdUsr; ?>';
    var MiNomUsr='<?php echo $MiNomUsr; ?>';
    var MiAnioAct=$("#anio").val();
</script>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="../../../resources/js/aplicaciones/Noticias/Alta_Noticias.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <?php
                            echo '<th>'.$nombre.'</th>';
                            echo '<th>Total de '.$Aplicacion.' por '.$nombre.'</th>'
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($tipo == 1) { //----------------------------------------Ver por EJE--------------------------------------------
                            $eje = " SELECT ej.idEje AS id_eje, CONCAT(ej.idEje,'. ', ej.Nombre) AS eje, COUNT(*) AS total
                                from c_entregableEspecifico AS enche
                                LEFT JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                                JOIN c_actividad a ON a.IdActividad=en.idActividad
                                JOIN c_eje ej ON ej.idEje=a.IdEje
                                JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo 
                                WHERE 1 ".$VarWhere."
                                GROUP BY eje
                                ORDER BY ej.idEje
                                ";
                            $resulteje = $catalogo->obtenerLista($eje);
                            while ($rs = mysqli_fetch_array($resulteje)) {
                                array_push($categorias, $rs['eje']);
                                array_push($total, $rs['total']);
                                $tot=$tot+$rs['total'];
                                echo '<tr><td>'.$rs['eje'].'</td><td><a href="Lista_especificoE.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$rs['total'].'</a></td></tr>';
                            }
                        } elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                            $area = "SELECT if (ISNULL(ar.Id_Area), 0,ar.Id_Area) AS id_area, CONCAT(ar.Id_Area,'. ', ar.Nombre) AS areaa, COUNT(*) AS total
                                from c_entregableEspecifico AS enche
                                JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                                JOIN c_actividad a ON a.IdActividad=en.idActividad
                                JOIN c_eje ej ON ej.idEje=a.IdEje
                                LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                                JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                                JOIN c_intervalo i ON i.idIntervalo=enche.idIntervalo
                                WHERE 1 ".$VarWhere."
                                GROUP BY areaa
                                ORDER BY ar.Id_Area
								";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['areaa']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['areaa'] . '</td>';
                                echo '<td><a href="Lista_especificoE.php?F_IdArea='.$rowareas['id_area'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 3) { //----------------------------------------Ver por ANIO--------------------------------------------
                            $anio = "SELECT pe.Id_Periodo AS id_ano, concat(pe.Id_Periodo,'. ', pe.Periodo) AS periodo, COUNT(*) AS total
                                from c_entregableEspecifico AS enche
                                JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                                JOIN c_actividad a ON a.IdActividad=en.idActividad
                                JOIN c_eje ej ON ej.idEje=a.IdEje
                                JOIN c_area ar ON ar.Id_Area=a.IdArea
                                LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                                WHERE 1 ".$VarWhere."
                                GROUP BY periodo
                                ORDER BY pe.Id_Periodo
                                ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['periodo']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['periodo'] . '</td>';
                                echo '<td><a href="Lista_especificoE.php?F_IdAnio='.$rowareas['id_ano'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 4) { //----------------------------------------INTERVALO--------------------------------------------
                            $lugar = "SELECT 
				                if (ISNULL(i.idIntervalo), 0,i.idIntervalo) AS id_intervalo,
				                if (ISNULL (CONCAT(i.idIntervalo,'. ', i.descripcion)),'Sin información', i.descripcion) AS intervalo, COUNT(*) AS total
                                from c_entregableEspecifico AS enche
                                JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                                JOIN c_actividad a ON a.IdActividad=en.idActividad
                                JOIN c_eje ej ON ej.idEje=a.IdEje
                                JOIN c_area ar ON ar.Id_Area=a.IdArea
                                JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                                LEFT JOIN c_intervalo i ON i.idIntervalo=enche.idIntervalo
                                WHERE 1 ".$VarWhere."
                                GROUP BY intervalo
                                ORDER BY i.idIntervalo
								";
                            $resulta = $catalogo->obtenerLista($lugar);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['intervalo']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['intervalo'] . '</td>';
                                echo '<td><a href="Lista_especificoE.php?F_IdInter='.$rowareas['id_intervalo'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 5) { //----------------------------------------Ver por ACTIVIDAD--------------------------------------------
                            $tipon = "SELECT a.IdActividad AS id_actividad, CONCAT(a.IdActividad,'. ', a.Nombre) AS actividad, COUNT(*) AS total
                                from c_entregableEspecifico AS enche
                                JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                                LEFT JOIN c_actividad a ON a.IdActividad=en.idActividad
                                JOIN c_eje ej ON ej.idEje=a.IdEje
                                JOIN c_area ar ON ar.Id_Area=a.IdArea
                                JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                                JOIN c_intervalo i ON i.idIntervalo=enche.idIntervalo
                                WHERE 1 ".$VarWhere."
                                GROUP BY actividad
                                ORDER BY a.IdActividad
								";
                            $resulta = $catalogo->obtenerLista($tipon);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['actividad']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['actividad'] . '</td>';
                                echo '<td><a href="Lista_especificoE.php?F_IdAct='.$rowareas['id_actividad'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 11) {//----------------------------------------Ver por EXPOSICION--------------------------------------------
                            $expoTemp = "SELECT if(ISNULL(concat(ep.idExposicion,'. ', ep.tituloFinal)),'Sin información',ep.tituloFinal) AS nom_extem,
				COUNT(*) AS total, if (ISNULL(ep.idExposicion), 0,ep.idExposicion) AS id_extem
                                from c_entregableEspecifico AS enche
                                JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                                LEFT JOIN c_exposicionTemporal ep ON ep.idExposicion=enche.idExp
                                JOIN c_actividad a ON a.IdActividad=en.idActividad
                                JOIN c_eje ej ON ej.idEje=a.IdEje
                                JOIN c_area ar ON ar.Id_Area=a.IdArea
                                JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo
                                WHERE 1 ".$VarWhere."
                                GROUP BY nom_extem
                                ORDER BY ep.idExposicion
                                ";
                            $resulta = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['nom_extem']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nom_extem'] . '</td>';
								echo '<td><a href="Lista_especificoE.php?F_IdExp='.$rowareas['id_extem'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="Lista_especificoE.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $tot . '</a>'; ?></th>
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
            chart: { type: 'bar'  },
            title: { text: '<?php echo $Aplicacion; ?> por <?php echo $nombre; ?>' },
            xAxis: { categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".$valor."', "; }?>] },
            yAxis: { min: 0, title: { text: '<?php echo $Aplicacion; ?>'  } },
            legend: { reversed: false  },
            plotOptions: { series: { stacking: 'normal' } },
            series: [{  name: '<?php echo $tot;?> <?php echo $Aplicacion; ?>' ,
                        data: [<?php   foreach ($total as $clave => $valor) { echo  $valor.", "; }?>]
                    }]
        });
    </script>
</html>