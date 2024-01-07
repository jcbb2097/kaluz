<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$tot = 0;
$categorias = array();
$total = array();
$tot_a = 0;
$categorias_a = array();
$total_a = array();

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual=date("2020");
$Aplicacion="Personas";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <title>::.Indicador.::</title>
</head>

<body>

    <legend id="AnioTitulo" style="text-align: center;"><?php echo "Personal  capítulo 3000 "; ?></legend>


<div class="container-fluid">

    <br>
    <br>

    <div class="row">
        <div id="recargar">
          <?php
          $area = "SELECT a.Id_Area, a.Nombre, COUNT(*) AS total
          FROM c_personas p
          JOIN c_area a ON a.Id_Area=p.idArea
          LEFT JOIN k_clasificacionPersona cp ON cp.IdPersona=p.id_Personas
          LEFT JOIN c_clasificacionEmpleado ce ON ce.IdClasificacionEmpleado=cp.IdClasificacion
          WHERE a.estatus=1 AND p.Activo=1 AND p.id_TipoPersona=1 AND ce.IdClasificacionEmpleado=24
          GROUP BY a.Id_Area
          ORDER BY total DESC";
          $resultareas = $catalogo->obtenerLista($area);
          while ($rowareas = mysqli_fetch_array($resultareas)) {
              array_push($categorias_a, $rowareas['Nombre']);
              array_push($total_a, $rowareas['total']);
              // echo '<tr id="trFila">';
              // echo '<td>' . $rowareas['Nombre'] . '</td>';
              // echo '<td><a href="lista_personas.php?F_IdArea='.$rowareas['Id_Area'].'&F_IdAnio='.$AnioActual.'&'.$MisParam.'">'. $rowareas['total'] .'</a></td>';
              // echo '</tr>';
              $tot_a += $rowareas['total'];
          }
           ?>

            <div class="col-md-6 col-sm-6 col-xs-6">
              <figure class="highcharts-figure">
                  <div id="grafica_area"></div>
              </figure>
              <script>
                  Highcharts.chart('grafica_area', {
                  chart: { type: 'bar'  },
                  title: { text: '<?php echo $Aplicacion; ?> por área' },
                  xAxis: { categories: [<?php   foreach ($categorias_a as $clave => $valor_a) { echo  "'".$valor_a."', "; }?>] },
                  yAxis: { min: 0, title: { text: '<?php echo $Aplicacion; ?>' } },
                  legend: { reversed: false },
                  plotOptions: { series: { stacking: 'normal' } },
                  series: [{
                              name: '<?php echo $tot_a;?> <?php echo $Aplicacion; ?>' ,
                              data: [<?php   foreach ($total_a as $clave => $valor_a) { echo  $valor_a.", "; }?>]
                          }]
                  });
              </script>
                    <?php
                        $eje = " SELECT e.idEje AS ideje,
                        CONCAT(e.idEje,'. ',e.Nombre) AS nombre_eje,
                        (
                        SELECT COUNT(*) FROM c_personas p
                        JOIN k_personasAnios pa ON pa.IdPersona=p.id_Personas
                        LEFT JOIN k_clasificacionPersona cp ON cp.IdPersona=p.id_Personas
                        LEFT JOIN c_clasificacionEmpleado ce ON ce.IdClasificacionEmpleado=cp.IdClasificacion
                        WHERE p.id_TipoPersona=1 AND p.Activo=1 AND p.idEje=e.idEje AND pa.AnioLaborado=".$AnioActual." AND ce.IdClasificacionEmpleado=24
                        ) AS total
                        FROM c_eje e
                        GROUP BY e.idEje
                            ";
                        $resulteje = $catalogo->obtenerLista($eje);
                        while ($rs = mysqli_fetch_array($resulteje)) {
                            array_push($categorias, $rs['nombre_eje']);
                            array_push($total, $rs['total']);
                            $tot=$tot+$rs['total'];
                            //echo '<tr><td>'.$rs['nombre_eje'].'</td><td><a href="lista_personas.php?F_IdAnio='.$AnioActual.'&F_IdEje='.$rs['ideje'].'&'.$MisParam.'">'.$rs['total'].'</a></td></tr>';
                        }
                    ?>

            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <figure class="highcharts-figure">
                    <div id="grafica_eje"></div>
                </figure>
            </div>
            <script>
                Highcharts.chart('grafica_eje', {
                chart: { type: 'bar'  },
                title: { text: '<?php echo $Aplicacion; ?> por Eje' },
                xAxis: { categories: [<?php   foreach ($categorias as $clave => $valor) { echo  "'".$valor."', "; }?>] },
                yAxis: { min: 0, title: { text: '<?php echo $Aplicacion; ?>' } },
                legend: { reversed: false },
                plotOptions: { series: { stacking: 'normal' } },
                series: [{
                            name: '<?php echo $tot;?> <?php echo $Aplicacion; ?>' ,
                            data: [<?php   foreach ($total as $clave => $valor) { echo  $valor.", "; }?>]
                        }]
                });
            </script>
        </div>
    </div>
</div>
</body>
</html>
