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

date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$AnioActual=date("Y"); //Año actual para mostrar por default
$Aplicacion="Archivos Entregables";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga
?>

<script>
    var MiApp='<?php echo $Aplicacion; ?>';
    var MiTipoPerfil='<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr='<?php echo $MiIdUsr; ?>';
    var MiNomUsr='<?php echo $MiNomUsr; ?>';
    var MiAnioAct='<?php echo $AnioActual; ?>';
</script>

<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
    <link rel="stylesheet" href="./css/noticias_vista.css">
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <title>::.Archivos Entregables.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=<?php echo $MiNomUsr; ?>&idUsuario=<?php echo $MiIdUsr; ?>">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_entregable.php?tipoPerfil=1&nombreUsuario=<?php echo $MiNomUsr; ?>&idUsuario=<?php echo $MiIdUsr; ?>"><?php echo $Aplicacion; ?></a>
    / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Indicadores</a></div>
     <div class="well2 wr">
            <a style="color:#fefefe; cursor: pointer;" href="vista.php?tipoPerfil=1&nombreUsuario=<?php echo $MiNomUsr; ?>&idUsuario=<?php echo $MiIdUsr; ?>"> Indicadores</a> /
            <a style="color:#fefefe; cursor: pointer;" href="Lista_entregable.php?tipoPerfil=1&nombreUsuario=<?php echo $MiNomUsr; ?>&idUsuario=<?php echo $MiIdUsr; ?>">Lista Archivos Entregables</a> /
            <a style="color:#fefefe; cursor: pointer;" href="../../indicadores/Entregables/index.php?tipoPerfil=1&nombreUsuario=<?php echo $MiNomUsr; ?>&idUsuario=<?php echo $MiIdUsr; ?>">Dashboard</a> /
            <a style="color:#fefefe; cursor: pointer;" onclick="Alta(<?php echo $MiIdUsr ?>,13,'Alta_entregable_2.php?accion=guardar&tipoPerfil=1&nombreUsuario=<?php echo $MiNomUsr; ?>&idUsuario=<?php echo $MiIdUsr; ?>&regreso=1');">Agregar +</a>
        </div>

    <legend id="AnioTitulo" style="text-align: center;"><?php echo $Aplicacion." ".$AnioActual; ?></legend>
</body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="selecc" class="form-control" name="selecc" onchange="IndicadorTipo();">
                        <option value="1">Eje</option>
                        <option value="2">Área</option>
                        <option value="3">Año</option>
                        <option value="4">Tipo documento</option>
                        <!--<option value="4">Entregable Específico</option>-->
                    </select>
                </div>
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Año : </label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="anio" class="form-control" name="anio" onchange="IndicadorAnio();">
                        <?php
                            $consultaPeriodo = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 ORDER BY Periodo desc;";
                            $resultPeriodo= $catalogo->obtenerLista($consultaPeriodo);
                            while ($row =mysqli_fetch_array($resultPeriodo)){
                                $s="";
                                if($row['Periodo']==$AnioActual){
                                    echo $s="selected";
                                }
                                echo "<option value='".$row['Periodo']."' ".$s.">".$row['Periodo']."</option>";
                            }
                            ?>
                        <option >Todos</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div id="recargar">
            <?php
                echo '
                <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>Eje</th>
                        <th>Total de '.$Aplicacion.'</th>
                    </tr>
                </thead>
                <tbody>
                ';
                $eje = "SELECT  if (ISNULL(concat(ej.orden, ' ',ej.Nombre)),'Sin información', concat(ej.orden, ' ',ej.Nombre)) AS DescEje, COUNT(*) AS Total, ej.idEje AS id_eje
                                     FROM c_documento AS d
                            JOIN c_periodo AS pe ON pe.Id_Periodo=d.anio
                            JOIN c_area AS ar ON ar.Id_Area=d.id_area
                            JOIN c_tipo_documento AS td ON td.id_tipo=d.id_tipo
                            JOIN k_archivoactividad k_ar ON d.id_documento = k_ar.id_archivo
                            JOIN c_eje ej on ej.idEje=k_ar.id_proyecto
                WHERE pe.Periodo=".$AnioActual."
                AND d.id_tipo in (9,10,14)
                GROUP BY DescEje
                ORDER BY ej.orden  ";
                $resulteje = $catalogo->obtenerLista($eje);
                while ($rs = mysqli_fetch_array($resulteje)) {
                    array_push($categorias, $rs['DescEje']);
                    array_push($total, $rs['Total']);
                    $tot=$tot+$rs['Total'];
                    echo '<tr><td>'.$rs['DescEje'].'</td><td><a href="Lista_entregable.php?F_IdEje='.$rs['id_eje'].'&'.$MisParam.'&F_IdAnio='.$AnioActual.'">'.$rs['Total'].'</a></td></tr>';
                }
            ?>
                </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total</th>
                            <th scope="col"><?php echo '<a href="Lista_entregable.php?'.$MisParam.'&F_IdAnio='.$AnioActual.'">'.$tot.'</a>'; ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
            <script>
                Highcharts.chart('container', {
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

<script>
    function IndicadorTipo(){
        if ($("#selecc").val()==3) {
            $("#anio").val("Todos");
            $("#AnioTitulo").html(MiApp+' (Todos los años)');
        }
        $("#recargar").load("grafica.php?F_IdAnio="+$("#anio").val()+"&tipo="+$("#selecc").val()+"&tipoPerfil="+MiTipoPerfil+"&idUsuario="+MiIdUsr+"&nombreUsuario="+MiNomUsr);

    }

    function IndicadorAnio(){
        if ($("#anio").val()=="Todos") { $("#AnioTitulo").html(MiApp+' (Todos los años)'); }
        else { $("#AnioTitulo").html(MiApp+' '+$("#anio").val()); }
        $("#recargar").load("grafica.php?F_IdAnio="+$("#anio").val()+"&tipo="+$("#selecc").val()+"&tipoPerfil="+MiTipoPerfil+"&idUsuario="+MiIdUsr+"&nombreUsuario="+MiNomUsr);
    }
</script>
</html>