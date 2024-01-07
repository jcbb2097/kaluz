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
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "") {
    $AnioActual=$_GET['F_IdAnio'];
    if ($_GET['F_IdAnio'] == "Todos") { $VarWhere= " "; }
    else { $VarWhere=" WHERE n.FechaPublicacion BETWEEN '".$AnioActual."/01/01 00:00:00' AND '".$AnioActual."/12/31 23:59:59' "; }
}

$Aplicacion="Noticias";
$MiTipoPerfil=1;
$MiIdUsr=1;
$MiNomUsr="Carlos";

if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    if ($tipo == 1)        {    $nombre = 'Eje';                $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 2)  {    $nombre = 'Área';               $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 3)  {    $nombre = 'Año';                $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 4)  {    $nombre = 'Lugar de Noticia';   $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 5)  {    $nombre = 'Tipo de Noticia';    $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 6)  {    $nombre = 'Soporte de Noticia'; $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 7)  {    $nombre = 'Tipo de Medio';      $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 8)  {    $nombre = 'Género';             $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 9)  {    $nombre = 'Medio (TOP 50)';     $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } elseif ($tipo == 11) {    $nombre = 'Exposición';         $titulo = 'Total de '.$Aplicacion.' por '.$nombre;
    } else {                    $nombre = 'Calificación';       $titulo = 'Total de '.$Aplicacion.' por '.$nombre; }
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
                            $eje1 = "1. Estrategias de Seguridad";
                            $eje2 = "2. Plan Estratégico";
                            $eje3 = "3. Infraestructura";
                            $eje4 = "4. Gestión Administrativa";
                            $eje5 = "5. Autogestión de Recursos";
                            $eje6 = "6. Exposición Permanente";
                            $eje7 = "7. Exposiciones Temporales";
                            $eje8 = "8. Bellas Artes para Todos";
                            $eje9 = "9. Difusión e Imagen";
                            $eje10 = "10. Publicaciones";
                            $eje11 = "11. Estrategia Digital";
                            $totalEje1 = 0;
                            $totalEje2 = 0;
                            $totalEje3 = 0;
                            $totalEje4 = 0;
                            $totalEje5 = 0;
                            $totalEje6 = 0;
                            $totalEje7 = 0;
                            $totalEje8 = 0;
                            $totalEje9 = 0;
                            $totalEje10 = 0;
                            $totalEje11 = 0;
                            $eje = "SELECT
                                        n.idNoticia,
                                        n.Titulo,
                                        n.FechaPublicacion,
                                        n.idEje,
                                        e.Nombre AS Nombre_eje
                                    FROM
                                        c_noticia n
                                        LEFT JOIN c_eje e ON e.idEje = n.idEje
                                        ".$VarWhere."
                                        ";
                            $resulteje = $catalogo->obtenerLista($eje);
                            while ($rs = mysqli_fetch_array($resulteje)) {
                                array_push($categorias, $rs['Nombre_eje']);
                                if ($rs['Nombre_eje'] == "Estrategias de Seguridad") {  $totalEje1  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Plan Estratégico") {          $totalEje2  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Infraestructura") {           $totalEje3  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Gestión Administrativa") {    $totalEje4  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Autogestión de Recursos") {   $totalEje5  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Exposición Permanente") {     $totalEje6  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Exposiciones Temporales") {   $totalEje7  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Bellas Artes para Todos") {   $totalEje8  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Difusión e Imagen") {         $totalEje9  += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Publicaciones") {             $totalEje10 += 1;  $tot += 1;  }
                                if ($rs['Nombre_eje'] == "Estrategia Digital") {        $totalEje11 += 1;  $tot += 1;  }
                            }
                            echo '<tr><td>'.$eje1.'</td><td><a href="Lista.php?F_IdEje=1&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje1.'</a></td></tr>';
                            echo '<tr><td>'.$eje2.'</td><td><a href="Lista.php?F_IdEje=2&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje2.'</a></td></tr>';
                            echo '<tr><td>'.$eje3.'</td><td><a href="Lista.php?F_IdEje=3&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje3.'</a></td></tr>';
                            echo '<tr><td>'.$eje4.'</td><td><a href="Lista.php?F_IdEje=4&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje4.'</a></td></tr>';
                            echo '<tr><td>'.$eje5.'</td><td><a href="Lista.php?F_IdEje=5&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje5.'</a></td></tr>';
                            echo '<tr><td>'.$eje6.'</td><td><a href="Lista.php?F_IdEje=6&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje6.'</a></td></tr>';
                            echo '<tr><td>'.$eje7.'</td><td><a href="Lista.php?F_IdEje=7&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje7.'</a></td></tr>';
                            echo '<tr><td>'.$eje8.'</td><td><a href="Lista.php?F_IdEje=8&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje8.'</a></td></tr>';
                            echo '<tr><td>'.$eje9.'</td><td><a href="Lista.php?F_IdEje=9&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje9.'</a></td></tr>';
                            echo '<tr><td>'.$eje10.'</td><td><a href="Lista.php?F_IdEje=10&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje10.'</a></td></tr>';
                            echo '<tr><td>'.$eje11.'</td><td><a href="Lista.php?F_IdEje=11&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$totalEje11.'</a></td></tr>';
                            $categorias = array($eje1, $eje2, $eje3, $eje4, $eje5, $eje6, $eje7, $eje8, $eje9, $eje10, $eje11);
                            $total = array($totalEje1, $totalEje2, $totalEje3, $totalEje4, $totalEje5, $totalEje6, $totalEje7, $totalEje8, $totalEje9, $totalEje10, $totalEje11);
                        } elseif ($tipo == 2) { //----------------------------------------Ver por AREA--------------------------------------------
                            $area = "SELECT count( * ) AS total,
                                    IF (ISNULL(a.Nombre),'Sin información', a.Nombre) AS Area, 
                                    IF (ISNULL(n.idArea), 0,n.idArea) AS IdArea
                                    FROM c_noticia n LEFT JOIN c_area a ON n.idArea=a.Id_Area
                                    ".$VarWhere."
                                    GROUP BY n.idArea
									";
                            $resultareas = $catalogo->obtenerLista($area);
                            while ($rowareas = mysqli_fetch_array($resultareas)) {
                                array_push($categorias, $rowareas['Area']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Area'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdArea='.$rowareas['IdArea'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }

                        } elseif ($tipo == 3) { //----------------------------------------Ver por ANIO--------------------------------------------
                            $anio = "SELECT count( * ) AS total, DATE_FORMAT(FechaPublicacion,'%Y') AnioP,
                                IF (ISNULL(FechaPublicacion), 'Sin información', DATE_FORMAT(FechaPublicacion,'%Y') ) AS Anio
                                FROM c_noticia GROUP BY 2 ORDER BY AnioP desc
                                ";
                            $resultanio = $catalogo->obtenerLista($anio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Anio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Anio'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdAnio='.$rowareas['Anio'].'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 4) { //----------------------------------------Ver por Lugar--------------------------------------------
                            $lugar = "SELECT count( * ) AS total, n.idLugarNoticia, l.Nombre AS Lugar
                                FROM c_noticia n JOIN c_lugarNoticia l ON n.idLugarNoticia=l.idLugarNoticia
                                ".$VarWhere."
                                GROUP BY Lugar ORDER BY n.idLugarNoticia
								";
                            $resultanio = $catalogo->obtenerLista($lugar);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Lugar']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Lugar'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdLugar='.$rowareas['idLugarNoticia'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 5) { //----------------------------------------Ver por Tipo Interna-Externa--------------------------------------------
                            $tipon = "SELECT count( * ) AS total,
                                IF (ISNULL(t.Descripcion),'Sin información', t.Descripcion) AS TipoN,
                                IF (ISNULL(n.idTipo), 0,n.idTipo) AS idTipo
                                FROM c_noticia n LEFT JOIN c_tipo_noticia t ON n.idTipo=t.Id_tipo
                                ".$VarWhere."
                                GROUP BY n.idTipo
								";
                            $resultanio = $catalogo->obtenerLista($tipon);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['TipoN']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoN'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdTipoInterna='.$rowareas['idTipo'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 6){//----------------------------------------Ver por SOPORTE--------------------------------------------
                            $soporte = "SELECT count( * ) AS total,
                                IF (ISNULL(s.Nombre),'Sin información', s.Nombre) AS Soporte,
                                IF (ISNULL(n.idSoporte), 0,n.idSoporte) AS idSoporte
                                FROM c_noticia n LEFT JOIN c_soporteNoticia s ON n.idSoporte=s.IdSoporte
                                ".$VarWhere."
                                GROUP BY Soporte
								";
                            $resultanio = $catalogo->obtenerLista($soporte);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Soporte']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Soporte'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdSoporte='.$rowareas['idSoporte'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'. $rowareas['total'] .'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 7) {//----------------------------------------Ver por Tipo Medio--------------------------------------------
                            $tmedio = "SELECT count( * ) AS total, n.idTipoMedio, tm.Nombre AS TipoMedio
                                FROM c_noticia n JOIN c_tipoMedio tm ON n.idTipoMedio=tm.idTipoMedio
                                ".$VarWhere."
                                GROUP BY TipoMedio order BY total desc
								";
                            $resultanio = $catalogo->obtenerLista($tmedio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['TipoMedio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['TipoMedio'] . '</td>';
								echo '<td><a href="Lista.php?F_IdTipoMedio='.$rowareas['idTipoMedio'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$rowareas['total'].'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 8) {//----------------------------------------Ver por Genero--------------------------------------------
                            $genero = "SELECT count( * ) AS total,
                                IF (ISNULL(n.idGenero), 0,n.idGenero) AS idGenero,
                                IF (ISNULL(g.Descripcion),'Sin información', g.Descripcion) AS Genero
                                FROM c_noticia n LEFT JOIN c_genero_noticia g ON n.idGenero=g.Id_genero
                                ".$VarWhere."
                                GROUP BY Genero ORDER BY total desc
								";
                            $resultanio = $catalogo->obtenerLista($genero);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Genero']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Genero'] . '</td>';
								echo '<td><a href="Lista.php?F_IdGenero='.$rowareas['idGenero'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 9) {//----------------------------------------Ver por MEDIO--------------------------------------------
                            $medio = "SELECT COUNT(*) AS total,
                                IF (ISNULL(n.idMedio), 0,n.idMedio) AS idMedio,
                                IF (ISNULL(m.Nombre),'Sin información', m.Nombre) AS Medio
                                FROM c_noticia n LEFT JOIN c_medio m ON n.idMedio=m.idMedio
                                ".$VarWhere."
                                GROUP BY Medio ORDER BY total DESC, Medio LIMIT 50";
                                //echo "Medio:".$medio;
                            $resultanio = $catalogo->obtenerLista($medio);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Medio']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Medio'] . '</td>';
								echo '<td><a href="Lista.php?F_IdMedio='.$rowareas['idMedio'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } elseif ($tipo == 11) {//----------------------------------------Ver por Exposicion--------------------------------------------
                            $expoTemp = "SELECT count( * ) AS total,
                                CASE WHEN isnull(n.idExposicion) THEN '0' ELSE n.idExposicion END AS idExposicion,
                                CASE WHEN n.idExposicion >0 THEN e.tituloFinal ELSE 'Sin exposición' END AS ExpoTemp
                                FROM c_noticia n LEFT JOIN c_exposicionTemporal e ON n.idExposicion=e.idExposicion
                                ".$VarWhere."
                                GROUP BY ExpoTemp ORDER BY total desc
                                ";
                            $resultanio = $catalogo->obtenerLista($expoTemp);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['ExpoTemp']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['ExpoTemp'] . '</td>';
								echo '<td><a href="Lista.php?F_IdExpoTemp='.$rowareas['idExposicion'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">' . $rowareas['total'] . '</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        } else { //----------------------------------------Ver por Calificación--------------------------------------------
                            $calif = "SELECT count( * ) AS total,
                                IF (ISNULL(n.idCalificacion), 0,n.idCalificacion) AS idCalificacion,
                                IF (ISNULL(c.Nombre),'Sin información', c.Nombre) AS Calif
                                FROM c_noticia n LEFT JOIN c_calificacion c ON n.idCalificacion=c.idCalificacion
                                ".$VarWhere."
                                GROUP BY Calif
                                ";
                            $resultanio = $catalogo->obtenerLista($calif);
                            while ($rowareas = mysqli_fetch_array($resultanio)) {
                                array_push($categorias, $rowareas['Calif']);
                                array_push($total, $rowareas['total']);
                                echo '<tr id="trFila">';
                                echo '<td>' . $rowareas['Calif'] . '</td>';
                                echo '<td><a href="Lista.php?F_IdCalificacion='.$rowareas['idCalificacion'].'&F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">'.$rowareas['total'].'</a></td>';
                                echo '</tr>';
                                $tot += $rowareas['total'];
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total de <?php echo $Aplicacion; ?></th>
                            <th scope="col"><?php echo '<a href="Lista.php?F_IdAnio='.$AnioActual.'&tipoPerfil='.$MiTipoPerfil.'&idUsuario='.$MiIdUsr.'&nombreUsuario='.$MiNomUsr.'">' . $tot . '</a>'; ?></th>
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