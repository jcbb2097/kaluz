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
$AnioActual=date("2020");
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "") { //Si trae Todos no se debe filtrar por año, pero si trae algo diferente se arma el WHERE
    $AnioActual=$_GET['F_IdAnio'];
    if ($_GET['F_IdAnio'] == "Todos") { $VarWhere= " "; }
    else { $VarWhere=" AND pa.AnioLaborado='".$AnioActual."' "; }
}

$Aplicacion="Instituciones";
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
    if       ($tipo == 1)  {    $nombre = 'País';           $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 2)  {    $nombre = 'Sector';         $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 3)  {    $nombre = 'Giro';           $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
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
                        if ($tipo == 1) { //----------------------------------------Ver por PAIS--------------------------------------------
                            $eje = "     SELECT i.Id_pais as idpais, c_pais.Nombre as nombre, COUNT(*) AS total
                            FROM c_institucion i
                            LEFT JOIN c_sector ON i.Id_sector = c_sector.Id_sector
                            LEFT JOIN c_pais ON i.Id_pais = c_pais.id_Pais
                            LEFT JOIN k_subgiro ON i.Id_subgiro = k_subgiro.Id_subgiro
                            LEFT JOIN c_subgiro ON k_subgiro.Id_subgiro2 = c_subgiro.Id_subgiro
                            LEFT JOIN c_giro ON i.Id_giro = c_giro.Id_giro
                            GROUP BY i.Id_pais
                            ORDER BY total desc
                            ";
                        $resulteje = $catalogo->obtenerLista($eje);
                        while ($rs = mysqli_fetch_array($resulteje)) {
                            array_push($categorias, $rs['nombre']);
                            array_push($total, $rs['total']);
                            $tot=$tot+$rs['total'];
                            echo '<tr><td>'.$rs['nombre'].'</td><td><a href="Lista_institucion.php?F_IdPais='.$rs['idpais'].'&'.$MisParam.'">'.$rs['total'].'</a></td></tr>';
                        }
                        } elseif ($tipo == 2) { //----------------------------------------Ver por SECTOR--------------------------------------------
                            $area = "SELECT i.Id_sector as idsec, c_sector.nombre as nombre, COUNT(*) AS total
                            FROM c_institucion i
                            LEFT JOIN c_sector ON i.Id_sector = c_sector.Id_sector
                            LEFT JOIN c_pais ON i.Id_pais = c_pais.id_Pais
                            LEFT JOIN k_subgiro ON i.Id_subgiro = k_subgiro.Id_subgiro
                            LEFT JOIN c_subgiro ON k_subgiro.Id_subgiro2 = c_subgiro.Id_subgiro
                            LEFT JOIN c_giro ON i.Id_giro = c_giro.Id_giro
                            GROUP BY i.Id_sector
                            ORDER BY total desc
								";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                echo '<td><a href="Lista_institucion.php?F_IdSector='.$rowareas['idsec'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 3) { //----------------------------------------Ver por GIRO--------------------------------------------
                            $anio = " SELECT i.Id_giro as idgiro, c_giro.nombre as nombre, COUNT(*) AS total
                            FROM c_institucion i
                            LEFT JOIN c_sector ON i.Id_sector = c_sector.Id_sector
                            LEFT JOIN c_pais ON i.Id_pais = c_pais.id_Pais
                            LEFT JOIN k_subgiro ON i.Id_subgiro = k_subgiro.Id_subgiro
                            LEFT JOIN c_subgiro ON k_subgiro.Id_subgiro2 = c_subgiro.Id_subgiro
                            LEFT JOIN c_giro ON i.Id_giro = c_giro.Id_giro
                            GROUP BY i.Id_giro
                            ORDER BY total desc
                                ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
                                echo '<td><a href="Lista_institucion.php?F_IdGiro='.$rowareas['idgiro'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="Lista_institucion.php?'.$MisParam.'">' . $tot . '</a>'; ?></th>
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