<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/Juridico.class.php');
$acuerdo = new Juridico();
$catalogo = new Catalogo();
$Internacional = 0;
$nacional = 0;
$total_contratos=0;
date_default_timezone_set('America/Mexico_City');
$zonahoraria = date_default_timezone_get();
$añoactual = date("Y");
$periodo_actual = $acuerdo->PeriodoActual($añoactual);
if (isset($_GET['usuario']) && $_GET['usuario'] != "") {
    $user = $_GET['usuario'];
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
}
echo '<input type="hidden" id="periodo" name="periodo" value="' . $periodo_actual . '" />';
$consulta3 = "SELECT Tipo_contrato FROM c_juridico";
$resultConsulta3 = $catalogo->obtenerLista($consulta3);
while ($row = mysqli_fetch_array($resultConsulta3)) {
    if ($row['Tipo_contrato'] == 1) {
        $nacional++;
    } else {
        $Internacional++;
    }
    $total_contratos++;
}
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

    <title>::.INDICADOR JURIDICO.::</title>
</head>

<body>
    <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_juridico.php?nombreUsuario=<?php echo ($user); ?>">Jurídico</a> / Indicador Jurídico</div>
</body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion">Año:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="selecc" class="form-control" name="selecc" onchange="indicador();">
                        <option value="0">Seleccione un Año</option>
                        <?php
                        $AÑO = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo as p ORDER BY p.Periodo";
                        $resulaño = $catalogo->obtenerLista($AÑO);
                        while ($row = mysqli_fetch_array($resulaño)) {
                            $selected = "";
                            echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>


        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div id="recargar">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tArchivo" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Exposición temporal</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Instrumento Jurídico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echo ' <td>';
                        $consulta = "SELECT e.tituloFinal as datos,
                        (SELECT COUNT(j.Id_juridico) FROM c_juridico as j 
                        WHERE j.Id_Exposicion=e.idExposicion)as series FROM c_exposicionTemporal as e 
                        ORDER BY e.tituloFinal";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<ul class="list-group">';
                            echo '	<li class="list-group-item" style="font-size: 10px;">' . $row['datos'] . '<span style="font-size: 10px;" class="badge">' . $row['series'] . '</span></li>';
                        }
                        echo ' </td>';
                        echo ' <td>';
                        echo '<ul class="list-group">';
                        echo '	<li class="list-group-item">Naci..<span style="font-size: 10px;" class="badge">' . $nacional . '</span></li>';
                        echo '	<li class="list-group-item">Inter..<span style="font-size: 10px;" class="badge">' . $Internacional . '</span></li>';
                        echo '	<li class="list-group-item">Total<span style="font-size: 10px;" class="badge">' . $total_contratos . '</span></li>';                      
                        echo ' </td>';
                        echo ' <td>';
                        $consulta2 = "SELECT ij.nombre AS datos,(SELECT COUNT(j.Id_juridico)
                        FROM c_juridico AS j 
                        WHERE j.Id_Instrumento = ij.idInstrumento ) AS series FROM c_instrumentoJuridico AS ij ORDER BY ij.nombre";
                        $resultConsulta2 = $catalogo->obtenerLista($consulta2);
                        while ($row = mysqli_fetch_array($resultConsulta2)) {

                            echo '<ul class="list-group">';
                            echo '	<li class="list-group-item">' . $row['datos'] . '<span style="font-size: 10px;" class="badge">' . $row['series'] . '</span></li>';
                        }
                        echo ' </td>';

                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <table id="tArchivo" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Eje</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        echo ' <td>';
                        $consulta = "SELECT e.Nombre,COUNT(a.Id_juridico) as contratos FROM c_juridico a, c_eje e  WHERE a.Id_eje=e.idEje GROUP BY e.Nombre";
                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        while ($row = mysqli_fetch_array($resultConsulta)) {

                            echo '<ul class="list-group">';
                            echo '	<li class="list-group-item" style="font-size: 10px;">' . $row['Nombre'] . '<span style="font-size: 10px;" class="badge">' . $row['contratos'] . '</span></li>';
                        }
                        echo ' </td>';
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
    function indicador() {
        var periodo = $("#periodo").val();
        $("#recargar").load("Indicador.php?accion=2&periodo=" + periodo + "&tipo=" + $("#selecc").val());
    }
</script>

</html>