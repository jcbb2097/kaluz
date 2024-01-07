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
    else { $VarWhere=" AND pe.Periodo='".$AnioActual."' "; }
}

$Aplicacion="Entregable Check";
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
                            $eje = "SELECT if (ISNULL(concat(ej.orden, ' ',ej.Nombre)),'Sin información', concat(ej.orden, ' ',ej.Nombre)) 
                            AS DescEje, COUNT(*) AS Total, if (ISNULL(ej.idEje), 0,ej.idEje) AS id_eje
                            from k_entregableCheckList AS enche
                            LEFT JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                            LEFT JOIN c_checkList AS lis ON lis.IdCheckList=enche.IdCheckList
                            LEFT JOIN c_personas AS per ON per.id_Personas=enche.IdResponsableVbo
                            LEFT JOIN c_actividad a ON a.IdActividad=en.idActividad
                            LEFT JOIN c_eje ej ON ej.idEje=a.IdEje
                            LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo 
                            WHERE 1 ".$VarWhere."
                            GROUP BY DescEje
                            ORDER BY ej.orden";
                            $resulteje = $catalogo->obtenerLista($eje);
                            while ($rs = mysqli_fetch_array($resulteje)) {
                                array_push($categorias, $rs['DescEje']);
                                array_push($total, $rs['Total']);
                                $tot=$tot+$rs['Total'];
                                echo '<tr><td>'.$rs['DescEje'].'</td><td><a href="Lista_entregablecheck.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['id_eje'].'&'.$MisParam.'">'.$rs['Total'].'</a></td></tr>';
                            }
                        } elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                            $area = "SELECT if (ISNULL(ar.Nombre),'Sin información',ar.Nombre) 
                            AS DescArea, COUNT(*) AS Total, if (ISNULL(ar.Id_Area), 0,ar.Id_Area) AS idarea
                            from k_entregableCheckList AS enche
                            LEFT JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                            LEFT JOIN c_checkList AS lis ON lis.IdCheckList=enche.IdCheckList
                            LEFT JOIN c_personas AS per ON per.id_Personas=enche.IdResponsableVbo
                            LEFT JOIN c_actividad a ON a.IdActividad=en.idActividad
                            LEFT JOIN c_eje ej ON ej.idEje=a.IdEje
                            LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo 
                            WHERE 1 ".$VarWhere."
                            GROUP BY DescArea
                            ORDER BY ar.orden";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['DescArea']);
                                array_push($total, $rowareas['Total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['DescArea'] . '</td>';
                                echo '<td><a href="Lista_entregablecheck.php?F_IdArea='.$rowareas['idarea'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['Total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['Total'];
                            }
                        } elseif ($tipo == 3) { //----------------------------------------Ver por Año--------------------------------------------
                            $anio = "SELECT if (ISNULL(pe.Id_Periodo), 0,pe.Id_Periodo) AS idperiodo,
                            if (ISNULL(pe.Periodo),'Sin información', pe.Periodo) AS Anio,
                            COUNT(*) AS total
                            from k_entregableCheckList AS enche
                            LEFT JOIN c_entregable AS en ON en.IdEntregable=enche.IdEntregable
                            LEFT JOIN c_checkList AS lis ON lis.IdCheckList=enche.IdCheckList
                            LEFT JOIN c_personas AS per ON per.id_Personas=enche.IdResponsableVbo
                            LEFT JOIN c_actividad a ON a.IdActividad=en.idActividad
                            LEFT JOIN c_eje ej ON ej.idEje=a.IdEje
                            LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.Periodo 
                            WHERE 1 ".$VarWhere."
                            GROUP by pe.Periodo desc";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Anio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Anio'] . '</td>';
                                echo '<td><a href="Lista_entregablecheck.php?F_IdAnio='.$rowareas['Anio'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="Lista_entregablecheck.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $tot . '</a>'; ?></th>
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