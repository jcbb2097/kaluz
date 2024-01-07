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

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual=date("2020");
$Aplicacion="Instituciones";
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
    <title>::.Indicador.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../indicadores.php?tipoPerfil=<?php echo $MiTipoPerfil; ?>">Indicadores</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"><?php echo $Aplicacion; ?></a></div>
    <legend id="AnioTitulo" style="text-align: center;"><?php echo $Aplicacion; ?></legend>
</body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="selecc" class="form-control" name="selecc" onchange="IndicadorTipo();">
                        <option value="1">País</option>
                        <option value="2">Sector</option>
                        <option value="3">Giro</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div id="recargar">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>País</th>
                            <th>Total de <?php echo $Aplicacion; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $eje = " SELECT i.Id_pais as idpais, c_pais.Nombre as nombre, COUNT(*) AS total
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
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Total</th>
                            <th scope="col"><?php echo '<a href="Lista_institucion.php?'.$MisParam.'">'.$tot.'</a>'; ?></th>
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
                title: { text: '<?php echo $Aplicacion; ?> por País' },
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
        //if ($("#selecc").val()==3) {
        //    $("#anio").val("Todos");
        //    $("#AnioTitulo").html(MiApp+' (Todos los años)');
        //}
        $("#recargar").load("grafica.php?F_IdAnio="+$("#anio").val()+"&tipo="+$("#selecc").val());

    }

    function IndicadorAnio(){
        //if ($("#anio").val()=="Todos") { $("#AnioTitulo").html(MiApp+' (Todos los años)'); }
        //else { $("#AnioTitulo").html(MiApp+' '+$("#anio").val()); }
        //$("#recargar").load("grafica.php?F_IdAnio="+$("#anio").val()+"&tipo="+$("#selecc").val());
    }
</script>
</html>