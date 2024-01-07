<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

session_start();

if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
include_once __DIR__ . "/../../../source/dao/clases/LoggedinTime.php";
$acuerdo = new documento();
$catalogo = new Catalogo();
$catalogo_a = new Catalogo();
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$añoactual = date("Y");
$Aplicacion="Acuerdos";
$idUsuario = "";
$idUsuario = $_SESSION['user_session'];
$MiNomUsr ="";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$periodo_actual = $acuerdo->PeriodoActual($añoactual);
if (isset($_GET['usuario']) && $_GET['usuario'] != "") {
    $user = $_GET['usuario'];
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
}

$MiNomUsr="SinUsr";
if ((isset($_GET['nombreUsuario'])   && $_GET['nombreUsuario'] != ""))       { $MiNomUsr=    $_GET['nombreUsuario']; }
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $idUsuario=     $_GET['idUsuario']; }
echo '<input type="hidden" id="periodo" name="periodo" value="' . $periodo_actual . '" />';
//if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $idUsuario=     $_SESSION['user_session']; }
//EXTRAEMOS EL ID Y NOMBRE DE USUARIO
$nombreUsuario = $MiNomUsr;
$count = 0;
$consulta = "SELECT  DATE_FORMAT(noti.Fecha_convocado,'%Y') anio FROM c_acuerdospdf noti GROUP BY DATE_FORMAT(Fecha_convocado,'%Y')
    ORDER BY noti.Fecha_convocado DESC ";
$result = $catalogo->obtenerLista($consulta);
$anios_datos = array();
while ($rs = mysqli_fetch_array($result)) {


    if ($count == 0)
        if ($añoactual != $rs['anio'])
            array_push($anios_datos, $añoactual);
        else
            $añoactual = $rs['anio'];


    array_push($anios_datos, $rs['anio']);
    $count++;
}
?>

<script>
    var MiApp = '<?php echo $Aplicacion; ?>';
    var MiTipoPerfil = '<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr = '<?php echo $idUsuario; ?>';
    var MiNomUsr = '<?php echo $MiNomUsr; ?>';
    var MiAnioAct = '<?php echo $añoactual; ?>';
</script>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap-select.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/AcuedosEscritos/Alta_acuerdo.js"></script>
    <title>::.INDICADOR ACUERDOS ESCRITOS.::</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>

    <div class="well well-sm" style="height: 32px;">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $idUsuario; ?>">Aplicaciones</a> /
        <a style="color:#fefefe;" href="Vista.php?usuario=<?= $nombreUsuario ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $MiTipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Acuerdos</a> /
        <a style="color: #fbff00;text-decoration: underline;" href="javascript:window.location.reload(true)">Indicadores</a> /
        <a style="color:#fefefe; cursor: pointer;" href="Lista_acuerdos.php?nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $MiTipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Lista Acuerdos</a> /
     <!--   <a style="color:#fefefe; cursor: pointer;" href="Acuerdosfocos.php?usuario=<?= $nombreUsuario ?>&nombreUsuario=<?= $nombreUsuario ?>&tipoPerfil=<?= $MiTipoPerfil ?>&idUsuario=<?= $idUsuario ?>">Focos</a> /  -->
        <a style="color:#fefefe; cursor: pointer;" href="Alta_acuerdo.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?= $nombreUsuario ?>&idUsuario=<?= $idUsuario ?>&tipoPerfil=<?= $MiTipoPerfil ?>;">Acuerdo Nuevo</a>      
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4" style="margin-left: -18px;">
        <label class="col-md-4 col-sm-4 col-xs-4  control-label" for="descripcion">Ver por:</label>
        <select id="selecc" class="form-control col-md-3 col-sm-3 col-xs-3" name="selecc" onchange="IndicadorTipo();" style="margin-left: -26px; width: 89px;height: 22px;border-radius: 0px;font-size: 7px;font-family: 'Muli-Regular';color: black;margin-top: -4px;">
                        <option value="1">Área</option>
                        <option value="2" selected>Eje</option>
                        <option value="3">Año</option>
                        <option value="4">Exposición</option>
                        <option value="5">Tipo de Acuerdo</option>
                        <option value="6">Tipo de Documento</option>
                        <option value="7">Receptor del acuerdo</option>
                        <option value="10">Emisor del acuerdo</option>
                        <option value="8">Eje y Área</option>
                    </select>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-3" style="margin-left: -130px;">
      <label class="col-md-4 col-sm-4 col-xs-4  control-label" for="descripcion">Año : </label>
                    <select id="anio" class="form-control col-md-3 col-sm-3 col-xs-3" name="anio" onchange="IndicadorAnio();" style="margin-left: -16px; width: 119px;height: 22px;border-radius: 0px;font-size: 7px;font-family: 'Muli-Regular';color: black;margin-top: -4px;">
                        <?php
                        $consultaanio = "SELECT DISTINCT p.Id_Periodo,p.Periodo FROM c_periodo as p
                        WHERE p.CPE_ESTATUS=1 AND p.Periodo > 2012 and p.Periodo < 2024 ORDER BY p.Periodo DESC";
                        $resultado1 = $catalogo->obtenerLista($consultaanio);
                        while ($row = mysqli_fetch_array($resultado1)) {
                        $s = '';
                        if ($row['Periodo'] == $añoactual) {
                        $s = 'selected = "selected"';
                        }
                        echo '<option value = "' . $row['Periodo'] . '" ' . $s . '>' . $row['Periodo'].'</option>';
                        }
                        ?>
                        <option >Todos</option>
                    </select>
      </div>
        <i onclick="history.back()" data-toggle="tooltip" data-placement="bottom" title="" style="position: absolute;right: 73px;cursor:pointer; margin-right: -63px;" class="fa fa-undo" aria-hidden="true" data-original-title="Regresar"></i>
    </div>
    <div class="well2 wr">
      
    </div>

   <!-- <legend id="AnioTitulo" style="text-align: center;"><?php echo $Aplicacion." ".$añoactual; ?></legend> -->
</body>

<div class="container-fluid">
  <!--  <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            


        </div>
    </div>
    <br>
    <br>-->

    <div class="row">
        <div id="recargar">
            <div class="col-md-6 col-sm-6 col-xs-6">

                <table class="table table-striped " style="width:100%; margin-top: -52.2px; margin-left: -15px;">
                    <thead class="thead-dark" style="background-color: #00000000; color: #ffffff;">
                        <tr>
                            <?php
                            $contador = 1;
                            $totalconvoca = 0;
                            $totalinvita = 0;
                            $totalrea = 0;
                            $totalnorea = 0;
                            $id_eje = array(); // añadido
                            $categorias = array();

                            $realizado = array();
                            $enproceso = array();
                            $cancelado = array();
                            $atendido = array();
                            $sinrealizar = array();

                            $sinrealizarGrafica = array();

                            $invitados = array();
                            $categoriasNumero = array();
                            $total = array();
                            $idejetotal = "";

                            // idEje añadidio
                            // $ejes = "SELECT idEje, e.Nombre as nombre,
                            // (SELECT COUNT( acu.id_proyecto ) FROM k_acuerdoactividad AS acu WHERE acu.id_proyecto = e.idEje ) AS concoca,
                            // (SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p INNER JOIN k_acuerdoactividad AS c WHERE p.estatus = 1 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_proyecto = e.idEje) AS realizado,
                            // (SELECT COUNT( id_acuerdo_escrito ) FROM c_acuerdospdf AS p INNER JOIN k_acuerdoactividad AS c WHERE p.estatus = 0 AND c.id_acuerdo = p.id_acuerdo_escrito AND c.id_proyecto = e.idEje) AS norealizado
                            // FROM c_eje as e ORDER BY idEje ASC";

                            $ejes = "SELECT e.idEje as idEje, e.Nombre as nombre,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.id_proyecto = e.idEje and pe.Periodo=".$añoactual.") AS concoca,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=2 AND acu.id_proyecto = e.idEje and pe.Periodo=".$añoactual.") AS realizado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=1 AND acu.id_proyecto = e.idEje and pe.Periodo=".$añoactual.") AS enproceso,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=3 AND acu.id_proyecto = e.idEje and pe.Periodo=".$añoactual.") AS cancelado,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=4 AND acu.id_proyecto = e.idEje and pe.Periodo=".$añoactual.") AS atendido,
                            (SELECT COUNT(*) FROM k_acuerdoactividad acu  LEFT JOIN c_acuerdospdf a ON a.id_acuerdo_escrito=acu.id_acuerdo
                            LEFT JOIN c_periodo pe ON pe.Id_Periodo=a.anio
                            WHERE acu.Id_acuerdoestatus=5 AND acu.id_proyecto = e.idEje and pe.Periodo=".$añoactual.") AS sinrealizar
                            FROM c_eje as e
                            ORDER BY e.idEje ASC";

                            $resultejes = $catalogo->obtenerLista($ejes);

                            ?>
                            <th>Total</th>  
                            <th>Realizado</th>
                            <th>Atendido</th>
                            <th>En proceso</th>                          
                            <th>Cancelado</th>
                            <th>Sin realizar</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rowejes = mysqli_fetch_array($resultejes)): ?>
                            <tr id="trFila" style="height: 53px;">
                                <?php
                                    array_push($id_eje, $rowejes['idEje']); //añadido
                                    array_push($categorias, $rowejes['nombre']);
                                  //  array_push($sinavance, $rowejes['sinavance']);
                                    array_push($sinrealizar, $rowejes['sinrealizar']);
                                    array_push($cancelado, $rowejes['cancelado']);
                                    array_push($enproceso, $rowejes['enproceso']);
                                    array_push($sinrealizarGrafica, $rowejes['concoca'] - $rowejes['realizado']);
                                    array_push($atendido, $rowejes['atendido']);
                                    array_push($realizado, $rowejes['realizado']);
                                    array_push($categoriasNumero, $rowejes['idEje'] . " - " . $rowejes['nombre']);
                                    array_push($total, $rowejes['concoca']);
                                    $idejetotal = $rowejes['idEje'];
                                ?>
                          <!--  <td> <?=$rowejes['idEje'] ?>. <?= $rowejes['nombre']?> </td> -->

                            <!--Total por eje-->
                            <?php if ($rowejes['concoca'] == '0'): ?>
                                <td> 
                                    <?= $rowejes['concoca'] ?>  </td>
                            <?php else:?>
                                <?php $numeroAcuerdos = $rowejes['concoca']; ?>
                                <td> 
                                    <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=<?=$rowejes['idEje']?>&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=todos"> <?=$rowejes['concoca']?> </a> </td>
                            <?php endif; ?>

                            <!--Realizado-->
                            <?php if ($rowejes['realizado'] == '0'): ?>
                                <td> 
                                    <?= $rowejes['realizado']?> </td>
                            <?php else: ?>
                                <td> 
                                    <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=<?=$rowejes['idEje']?>&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=realizado"> <?= $rowejes['realizado'] ?> </a> </td>
                            <?php endif; ?>                          

                             <!--En proceso-->
                             <?php if ($rowejes['atendido'] == '0'): ?>
                                <td> 
                                    <?=$rowejes['atendido']?> </td>
                            <?php else:?>
                                <td> 
                                    <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=<?=$rowejes['idEje']?>&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=atendido"> <?= $rowejes['atendido'] ?> </a> </td>
                            <?php endif;?>

                             <!--En proceso-->
                             <?php if ($rowejes['enproceso'] == '0'): ?>
                                <td> 
                                    <?=$rowejes['enproceso']?> </td>
                            <?php else:?>
                                <td> 
                                    <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=<?=$rowejes['idEje']?>&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=enproceso"> <?= $rowejes['enproceso'] ?> </a> </td>
                            <?php endif;?>
                            
                            <!--En proceso-->
                            <?php if ($rowejes['cancelado'] == '0'): ?>
                                <td> 
                                    <?=$rowejes['cancelado']?> </td>
                            <?php else:?>
                                <td> 
                                    <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=<?=$rowejes['idEje']?>&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=cancelado"> <?= $rowejes['cancelado'] ?> </a> </td>
                            <?php endif;?>

                            

                             <!--En sin realizar-->
                             <?php if ($rowejes['sinrealizar'] == '0'): ?>
                                <td> 
                                    <?=$rowejes['sinrealizar']?> </td>
                            <?php else:?>
                                <td> 
                                    <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=<?=$rowejes['idEje']?>&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=sinrealizar"> <?= $rowejes['sinrealizar'] ?> </a> </td>
                            <?php endif;?>

                            </tr>
                        <?php endwhile; ?>

                        <tr style="height: 35px;">
                            <th> <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=todos&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=todos"> <?= array_sum($total) ?> </a> </th>
                            <th> <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=todos&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=realizado"> <?= array_sum($realizado) ?> </a> </th>
                            <th> <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=todos&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=atendido"> <?= array_sum($atendido) ?> </a> </th>
                            <th> <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=todos&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=enproceso"> <?= array_sum($enproceso) ?> </a> </th>                           
                            <th> <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=todos&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=cancelado"> <?= array_sum($cancelado) ?> </a> </th>
                            <th> <a href="Lista_acuerdos.php?nombreUsuario=<?=$nombreUsuario?>&ejeid=todos&ejeaño=<?=$añoactual?>&tipoPerfil=<?=$MiTipoPerfil?>&idUsuario=<?=$idUsuario?>&numeroAcuerdos=<?php echo $numeroAcuerdos; ?>&directo=1&varFiltro=sinrealizar"> <?= array_sum($sinrealizar) ?> </a> </th>
                        </tr>
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
    <?php
    $nombres = "";
    for ($i = 0; $i < count($categorias); $i++) {
        $nombres = $nombres . "'" . $categorias[$i] . "'";
        if ($i + 1 < count($categorias)) {
            $nombres = $nombres . ",";
        }
    }
    $nombresNumero = "";
    for ($i = 0; $i < count($categoriasNumero); $i++) {
        $nombresNumero = $nombresNumero . "'" . $categoriasNumero[$i] . "'";
        if ($i + 1 < count($categoriasNumero)) {
            $nombresNumero = $nombresNumero . ",";
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
    for ($index = 0; $index < count($sinrealizarGrafica); $index++) {
        $resultados3 = $resultados3 . $sinrealizarGrafica[$index];
        if ($index + 1 < count($sinrealizarGrafica)) {
            $resultados3 = $resultados3 . ",";
        }
    }

    $resultados4 = "";
    for ($index = 0; $index < count($cancelado); $index++) {
        $resultados4 = $resultados4 . $cancelado[$index];
        if ($index + 1 < count($cancelado)) {
            $resultados4 = $resultados4 . ",";
        }
    }


    ?>
    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: false,
                    alpha: 15,
                    beta: 15,
                    viewDistance: 25,
                    depth: 40
                }
            },
            title: {
                text: 'Total de Acuerdos por Eje'
            },
            colors: ['#12a2cd', "#3fff00", "#ff0000"],
            xAxis: {
                categories: [
                    <?php
                    echo $nombresNumero;
                    ?>
                ],
                labels: {
                    skew3d: false,
                    style: {
                        fontSize: '10px'
                    }
                }
            },
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'Número de Acuerdos',
                    skew3d: false
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

    <script>
        /*function indicador() {
            var periodo = $("#anio").val();
            $("#recargar").load("grafica.php?accion=2&periodo=" + $("#anio").val() + "&tipo=" + $("#selecc").val());
        }*/

        function IndicadorTipo(){
        if ($("#selecc").val()==3) {
            $("#anio").val("Todos");
            $("#AnioTitulo").html(MiApp+' (Todos los años)');
        }
            $("#recargar").load("grafica.php?periodo=" + $("#anio").val() + "&tipo=" + $("#selecc").val());

        }

        function IndicadorAnio(){
        if ($("#anio").val()=="Todos") { $("#AnioTitulo").html(MiApp+' (Todos los años)'); }
        else { $("#AnioTitulo").html(MiApp+' '+$("#anio").val()); }
        $("#recargar").load("grafica.php?periodo=" + $("#anio").val() + "&tipo=" + $("#selecc").val());
    }
    </script>

</html>
