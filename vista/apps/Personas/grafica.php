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

$Aplicacion="Personas";
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
    if       ($tipo == 1)  {    $nombre = 'Eje';            $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 2)  {    $nombre = 'Área';           $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 3)  {    $nombre = 'Año';            $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 4)  {    $nombre = 'Clasificación';  $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 5)  {    $nombre = 'Tipo';           $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
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
                            $eje = "    SELECT e.idEje AS ideje,
                            CONCAT(e.idEje,'. ',e.Nombre) AS nombre_eje,
                            (
                            SELECT COUNT(*) FROM c_personas p
                            JOIN k_personasAnios pa ON pa.IdPersona=p.id_Personas
                            WHERE p.id_TipoPersona=1 AND p.Activo=1 AND p.idEje=e.idEje ".$VarWhere."
                            ) AS total
                            FROM c_eje e
                            GROUP BY e.idEje
                            ";
                        $resulteje = $catalogo->obtenerLista($eje);
                        while ($rs = mysqli_fetch_array($resulteje)) {
                            array_push($categorias, $rs['nombre_eje']);
                            array_push($total, $rs['total']);
                            $tot=$tot+$rs['total'];
                            echo '<tr><td>'.$rs['nombre_eje'].'</td><td><a href="lista_personas.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['ideje'].'&'.$MisParam.'">'.$rs['total'].'</a></td></tr>';
                        }
                        } elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                            $area = "SELECT a.Id_Area, a.Nombre, COUNT(*) AS total
                            FROM c_personas p
                            JOIN c_area a ON a.Id_Area=p.idArea
                            WHERE a.estatus=1 AND p.Activo=1 AND p.id_TipoPersona=1
                            GROUP BY a.Id_Area
                            ORDER BY total DESC
								";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['Nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Nombre'] . '</td>';
                                echo '<td><a href="lista_personas.php?F_IdArea='.$rowareas['Id_Area'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 3) { //----------------------------------------Ver por ANIO--------------------------------------------
                            $anio = " SELECT pa.AnioLaborado as Anio, COUNT(*) AS total
                                FROM c_personas p
                                JOIN k_personasAnios pa ON pa.IdPersona=p.id_Personas
                                GROUP BY pa.AnioLaborado
                                ORDER BY total desc
                                ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Anio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Anio'] . '</td>';
                                echo '<td><a href="lista_personas.php?F_IdAnio='.$rowareas['Anio'].'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }  elseif ($tipo == 4) {//----------------------------------------Ver por Clasificacion--------------------------------------------
                            $expoTemp = " SELECT ce.IdClasificacionEmpleado as idcla, ce.Nombre as nombre, COUNT(*) AS total
                            FROM c_personas p
                            LEFT JOIN k_clasificacionPersona cp ON cp.IdPersona=p.id_Personas
                            LEFT JOIN c_clasificacionEmpleado ce ON ce.IdClasificacionEmpleado=cp.IdClasificacion
                            WHERE  p.Activo=1 AND ce.nombre is NOT null
                            GROUP BY ce.IdClasificacionEmpleado
                            ORDER BY total DESC
                                ";
                            $resulta = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
								echo '<td><a href="lista_personas.php?F_IdClasif='.$rowareas['idcla'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 5) {//----------------------------------------Ver por Tipo interno/externo--------------------------------------------
                            $expoTemp = " SELECT tp.id_TipoPersona as idtipo, tp.Nombre as nombre, COUNT(*) AS total
                            FROM c_personas p
                            JOIN c_tipopersona tp ON tp.id_TipoPersona=p.id_TipoPersona
                            WHERE  p.Activo=1
                            GROUP BY tp.id_TipoPersona
                            ORDER BY total DESC
                                ";
                            $resulta = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resulta)) {
                                array_push($categorias, $rowareas['nombre']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['nombre'] . '</td>';
								echo '<td><a href="lista_personas.php?F_IdTipoPer='.$rowareas['idtipo'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="lista_personas.php?F_IdAnio='.$AnioActual.'&'.$MisParam.'">' . $tot . '</a>'; ?></th>
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