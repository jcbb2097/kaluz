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
    if ($_GET['F_IdAnio'] == "Todos") { 
        $VarWhere= " "; 
        $VarWhere2= " ";
        $VarWhere3= " ";
    }
    else { 
        $resultPeriodo = "SELECT * FROM c_periodo WHERE periodo =".$AnioActual." ";
        $resulta = $catalogo->obtenerLista($resultPeriodo);
        $rowperiodo = mysqli_fetch_array($resulta);
        $idPeriodo = $rowperiodo['Id_Periodo'];

        $VarWhere=" AND pe.Periodo='".$AnioActual."' "; 
        $VarWhere2=" j.Id_periodo='".$idPeriodo."' and "; 
        $VarWhere3=" where j.Id_periodo='".$idPeriodo."'"; 
    }
}

$Aplicacion="Instrumentos Jurídicos";
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
    } elseif ($tipo == 4)  {    $nombre = 'Tipo Nacional/Internacional';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 5)  {    $nombre = 'Tipo de instrumento';            $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 11) {    $nombre = 'Exposición';                     $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 12) {    $nombre = 'Estatus';                     $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
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
                            $eje = "    SELECT ej.idEje AS id_eje, concat(ej.idEje, '. ', ej.Nombre) AS nombre_eje,
                                (SELECT COUNT(*)
                                FROM c_juridico ju join c_periodo pe on pe.Id_Periodo=ju.Id_periodo
                                WHERE ju.Id_eje=ej.idEje ".$VarWhere."
                                ) AS total
                                FROM c_eje ej
                                ORDER BY ej.idEje
                                ";
                            $resulteje = $catalogo->obtenerLista($eje);
                            while ($rs = mysqli_fetch_array($resulteje)) {
                                array_push($categorias, $rs['nombre_eje']);
                                array_push($total, $rs['total']);
                                $tot=$tot+$rs['total'];
                                echo '<tr><td>'.$rs['nombre_eje'].'</td><td><a href="Lista.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$rs['total'].'</a></td></tr>';
                            }
                        } elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                            $area = "SELECT
                                    if (ISNULL(ar.Id_Area), 0,ar.Id_Area) AS idarea,
                                    if (ISNULL(ar.Nombre),'Sin información', ar.Nombre) AS nombre,
                                    COUNT(*) AS total
                                    FROM c_juridico ju
                                    LEFT JOIN c_area ar ON ar.Id_Area=ju.IdArea
                                    JOIN c_periodo pe on pe.Id_Periodo=ju.Id_periodo
                                    WHERE 1 ".$VarWhere."
                                    GROUP by ar.Id_Area
									";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdArea='.$rowareas['idarea'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 3) { //----------------------------------------Ver por ANIO--------------------------------------------
                            $anio = "SELECT
                                if (ISNULL(pe.Id_Periodo), 0,pe.Id_Periodo) AS idperiodo,
                                if (ISNULL(pe.Periodo),'Sin información', pe.Periodo) AS Anio,
                                COUNT(*) AS total
                                FROM c_juridico ju
                                LEFT JOIN c_periodo pe on pe.Id_Periodo=ju.Id_periodo
                                WHERE 1 ".$VarWhere."
                                GROUP by pe.Periodo desc
                                ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Anio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Anio'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdAnio='.$rowareas['Anio'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 4) { //----------------------------------------Ver porTipo Nacional/Internacional--------------------------------------------
                            $lugar = "SELECT
                                if (ISNULL(tcn.idTipoContratoNacional), 0,tcn.idTipoContratoNacional) AS idtipocontratonal,
                                if (ISNULL(tcn.Descripcion),'Sin información', tcn.Descripcion) AS tipoContratoNal,
                                COUNT(*) AS total
                                FROM c_juridico ju
                                LEFT JOIN c_tipoContratoNacional tcn ON tcn.idTipoContratoNacional=ju.Tipo_contrato
                                LEFT JOIN c_periodo pe ON pe.Id_Periodo=ju.Id_periodo
                                WHERE 1 ".$VarWhere."
                                GROUP by ju.Tipo_contrato
                                ORDER BY total desc
								";
                            $resulta = $catalogo->obtenerLista($lugar);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['tipoContratoNal']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['tipoContratoNal'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdTipoContNal='.$rowareas['idtipocontratonal'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 5) { //----------------------------------------Ver por Tipo de instrumento--------------------------------------------
                            $tipon = "SELECT
                                if (ISNULL(ij.idInstrumento), 0,ij.idInstrumento) AS idinstrum,
                                if (ISNULL(ij.nombre),'Sin información', ij.nombre) AS nombre,
                                COUNT(*) AS total
                                FROM c_juridico ju
                                LEFT JOIN c_instrumentoJuridico ij ON ij.idInstrumento=ju.Id_subtipo
                                LEFT JOIN c_periodo pe ON pe.Id_Periodo=ju.Id_periodo
                                WHERE 1 ".$VarWhere."
                                GROUP by ju.Id_subtipo
                                ORDER BY total desc
								";
                            $resulta = $catalogo->obtenerLista($tipon);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdTipoCont='.$rowareas['idinstrum'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 11) {//----------------------------------------Ver por Exposicion--------------------------------------------
                            $expoTemp = "SELECT
                                if (ISNULL(et.idExposicion), 0,et.idExposicion) AS idexpo,
                                if (ISNULL(et.tituloFinal),'Sin información', et.tituloFinal) AS ExpoTemp,
                                COUNT(*) AS total
                                FROM c_juridico ju
                                LEFT JOIN c_exposicionTemporal et ON et.idExposicion=ju.Id_Exposicion
                                LEFT JOIN c_periodo pe ON pe.Id_Periodo=ju.Id_periodo
                                WHERE 1 ".$VarWhere."
                                GROUP by ju.Id_Exposicion
                                ORDER BY total desc
                                ";
                            $resulta = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['ExpoTemp']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['ExpoTemp'] . '</td>';
								echo '<td><a href="Lista.php?F_IdExpoTemp='.$rowareas['idexpo'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 12) {//----------------------------------------Ver por Estatus--------------------------------------------
                             $expoTemp = "SELECT COUNT(*) AS TOTAL, 
                                         (SELECT COUNT(*) AS TOTAL FROM c_juridico j WHERE ".$VarWhere2." j.EstatusAvance = 0) AS sin_avance,
                                         (SELECT COUNT(*) AS TOTAL FROM c_juridico j WHERE ".$VarWhere2." j.EstatusAvance = 1) AS Interno,
                                         (SELECT COUNT(*) AS TOTAL FROM c_juridico j WHERE ".$VarWhere2." j.EstatusAvance = 2) AS INBAL,
                                         (SELECT COUNT(*) AS TOTAL FROM c_juridico j WHERE ".$VarWhere2." j.EstatusAvance = 3) AS Liberado
                                FROM c_juridico j
                                 ".$VarWhere3." ";
                            $resulta = $catalogo->obtenerLista($expoTemp);
                            $rowareas = mysqli_fetch_array($resulta);
                                array_push($categorias, 'Sin Avance');
                                array_push($total, $rowareas['sin_avance']);
                                array_push($categorias, 'Interno');
                                array_push($total, $rowareas['Interno']);
                                array_push($categorias, 'INBAL');
                                array_push($total, $rowareas['INBAL']);
                                array_push($categorias, 'Liberado');
                                array_push($total, $rowareas['Liberado']);

                                echo '<tr id="trFila">';
                                echo '<td>Sin avance</td>';
								echo '<td><a href="Lista.php?F_IdEstatus='.$rowareas['sin_avance'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'&idParametroEstatus=0">' . $rowareas['sin_avance'] . '</a></td>';
                                echo '</tr>';

                                echo '<tr id="trFila">';
                                echo '<td>Interno</td>';
								echo '<td><a href="Lista.php?F_IdEstatus='.$rowareas['Interno'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'&idParametroEstatus=1">' . $rowareas['Interno'] . '</a></td>';
                                echo '</tr>';

                                echo '<tr id="trFila">';
                                echo '<td>INBAL</td>';
								echo '<td><a href="Lista.php?F_IdEstatus='.$rowareas['INBAL'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'&idParametroEstatus=2">' . $rowareas['INBAL'] . '</a></td>';
                                echo '</tr>';

                                echo '<tr id="trFila">';
                                echo '<td>Liberado</td>';
								echo '<td><a href="Lista.php?F_IdEstatus='.$rowareas['Liberado'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'&idParametroEstatus=3">' . $rowareas['Liberado'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['TOTAL'];                   
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="Lista.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $tot . '</a>'; ?></th>
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
            chart: { type: 'column'  },
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