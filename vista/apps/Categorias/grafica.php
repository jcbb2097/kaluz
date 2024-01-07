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
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "") { //Si trae Todos no se debe filtrar por año, pero si trae algo diferente se arma el WHERE
    $AnioActual=$_GET['F_IdAnio'];
    if ($_GET['F_IdAnio'] == "Todos") { $VarWhere= " "; }
    else { $VarWhere=" AND p.Periodo='".$AnioActual."' "; }
}

$Aplicacion="Categorías y subcategorías";
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
    if       ($tipo == 1)  {    $nombre = 'Eje';                      $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    }/* elseif ($tipo == 2)  {    $nombre = 'Categoría';                $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    }*/ elseif ($tipo == 3)  {    $nombre = 'Año';                     $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 4)  {    $nombre = 'Exposición';               $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
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
                            echo '<th>Total de '.$Aplicacion.' por '.$nombre.'</th>';
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($tipo == 1) { //----------------------------------------Ver por EJE--------------------------------------------
                        $eje = "SELECT if (ISNULL(concat(ej.orden, ' ',ej.Nombre)),'Sin información', concat(ej.orden, ' ',ej.Nombre)) AS DescEje, 
                        COUNT(*) AS Total, ej.idEje AS id_eje
                        FROM c_categoriasdeejes ce
                        INNER JOIN c_eje ej on ej.idEje=ce.idEje
                        INNER JOIN c_periodo p ON p.Id_Periodo=ce.anio
                        WHERE 1 ".$VarWhere."
                        AND ce.nivelCategoria=1
                        GROUP BY DescEje
                        ORDER BY ej.orden";
                            $resulteje = $catalogo->obtenerLista($eje);
                            while ($rs = mysqli_fetch_array($resulteje)) {
                                array_push($categorias, $rs['DescEje']);
                                array_push($total, $rs['Total']);
                                $tot=$tot+$rs['Total'];
                                echo '<tr><td>'.$rs['DescEje'].'</td><td><a href="Lista_categorias.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$rs['Total'].'</a></td></tr>';
                            }
                        }/* elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                            $area = "SELECT if (ISNULL(ce.descCategoria),'Sin información', ce.descCategoria) AS DescCate, 
                        COUNT(*) AS Total, ce1.idCategoriaPadre AS id_categoria
                        FROM c_categoriasdeejes ce
                        JOIN c_categoriasdeejes ce1 ON ce1.idCategoriaPadre=ce.idCategoria
                        INNER JOIN c_eje ej on ej.idEje=ce.idEje
                        INNER JOIN c_periodo p ON p.Id_Periodo=ce.anio
                            WHERE 1 ".$VarWhere."
                            GROUP BY DescCate
                           ORDER BY ce1.idCategoriaPadre";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['DescCate']);
                                array_push($total, $rowareas['Total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['DescCate'] . '</td>';
                                echo '<td><a href="Lista_categorias.php?F_IdCate='.$rowareas['id_categoria'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['Total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['Total'];
                            }
                        }*/ elseif ($tipo == 3) { //----------------------------------------Ver por Año--------------------------------------------
                            $anio = "SELECT if (ISNULL(pe.Id_Periodo), 0,pe.Id_Periodo) AS idperiodo,
                            if (ISNULL(pe.Periodo),'Sin información', pe.Periodo) AS Anio,
                            COUNT(*) AS total
                            FROM c_categoriasdeejes ce
                            INNER JOIN c_eje ej on ej.idEje=ce.idEje
                            INNER JOIN c_periodo pe ON pe.Id_Periodo=ce.anio
                            WHERE 1 ".$VarWhere."
                            AND ce.nivelCategoria=1
                            GROUP by pe.Periodo desc  ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowperiodo = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowperiodo['Anio']);
                                array_push($total, $rowperiodo['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowperiodo['Anio'] . '</td>';
                                echo '<td><a href="Lista_categorias.php?F_IdAnio='.$rowperiodo['Anio'].'&'.$MisParam.'">'. $rowperiodo['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowperiodo['total'];
                            }
                        } elseif ($tipo == 4) { //----------------------------------------Ver por Año--------------------------------------------
                            $anio = "SELECT if (ISNULL(CONCAT ('(',et.anio,') ',et.tituloFinal)),'Sin información', CONCAT ('(',et.anio,') ',et.tituloFinal)) AS DescExpo, 
                            COUNT(*) AS Total, et.idExposicion AS id_expo
                            FROM c_categoriasdeejes ce
                            INNER JOIN c_eje ej on ej.idEje=ce.idEje
                            INNER JOIN c_periodo p ON p.Id_Periodo=ce.anio
                            JOIN c_exposicionTemporal et ON et.idExposicion=ce.idExposicion
                            WHERE 1 ".$VarWhere."
                            AND ce.nivelCategoria=1
                            GROUP BY DescExpo
                            ORDER BY et.idExposicion";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowperiodo = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowperiodo['DescExpo']);
                                array_push($total, $rowperiodo['Total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowperiodo['DescExpo'] . '</td>';
                                echo '<td><a href="Lista_categorias.php?F_IdAnio='.$AnioActual.'&F_IdExpo='.$rowperiodo['id_expo'].'&'.$MisParam.'">'. $rowperiodo['Total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowperiodo['Total'];
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="Lista_categorias.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $tot . '</a>'; ?></th>
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