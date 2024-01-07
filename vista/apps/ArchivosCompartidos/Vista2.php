<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
$acuerdo = new documento();
$catalogo = new Catalogo();
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$añoactual = date("Y");
$periodo_actual = $acuerdo->PeriodoActual($añoactual);
if (isset($_GET['usuario']) && $_GET['usuario'] != "") {
    $user = $_GET['usuario'];
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
}
echo '<input type="hidden" id="periodo" name="periodo" value="' . $periodo_actual . '" />';

?>
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
    <title>::.INDICADOR ARCHIVOS COMPARTIDOS.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="lista_archivo.php?nombreUsuario=<?php echo ($user); ?>">Archivos Compartidos</a> / Indicador Archivos Compartidos</div>
</body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Ver por:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="selecc" class="form-control" name="selecc" onchange="indicador();">
                        <option value="0">Seleccione una opción</option>
                        <option value="1">Área</option>
                        <option value="2">Eje</option>
                    </select>
                </div>
            </div>


        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div id="recargar">

        </div>
    </div>
</div>
<script>
function indicador(){
    var periodo = $("#periodo").val();
    $("#recargar").load("Indicador2.php?accion=2&periodo="+periodo+"&tipo=" + $("#selecc").val());
}

</script>

</html>