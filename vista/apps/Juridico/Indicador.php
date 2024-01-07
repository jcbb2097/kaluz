<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$año = "";
$Internacional = 0;
$nacional = 0;
$total_contratos = 0;
if (isset($_GET['tipo']) && $_GET['tipo'] != "undefined") {
    $tipo = $_GET['tipo'];
    $consult = "SELECT Periodo FROM c_periodo WHERE Id_Periodo=" . $tipo;
    $resultConsult = $catalogo->obtenerLista($consult);
    //echo$consult;
    while ($row = mysqli_fetch_array($resultConsult)) {
        $año = $row['Periodo'];
    }
    if ($año > 0) {
        // echo 'entra a año';
        $consult = "SELECT Periodo FROM c_periodo WHERE Id_Periodo=" . $tipo;
        $resultConsult = $catalogo->obtenerLista($consult);
        // echo $consult;
        while ($row = mysqli_fetch_array($resultConsult)) {
            $año = $row['Periodo'];
        }
        $consulta3 = "SELECT j.Tipo_contrato FROM c_juridico as j , c_exposicionTemporal as ja WHERE ja.idExposicion=j.Id_Exposicion AND ja.anio=" . $año;
        //echo $consulta3;
        $resultConsulta3 = $catalogo->obtenerLista($consulta3);
        while ($row = mysqli_fetch_array($resultConsulta3)) {
            if ($row['Tipo_contrato'] == 1) {
                $nacional++;
            } else {
                $Internacional++;
            }
            $total_contratos++;
        }
    } else {
        //echo 'no entra a año';
        $consult = "SELECT Periodo FROM c_periodo WHERE Id_Periodo=" . $tipo;
        $resultConsult = $catalogo->obtenerLista($consult);
       // echo $consult;
        while ($row = mysqli_fetch_array($resultConsult)) {
            $año = $row['Periodo'];
        }
        $consulta3 = "SELECT j.Tipo_contrato FROM c_juridico as j , c_exposicionTemporal as ja WHERE ja.idExposicion=j.Id_Exposicion ";
        //echo $consulta3;
        $resultConsulta3 = $catalogo->obtenerLista($consulta3);
        while ($row = mysqli_fetch_array($resultConsulta3)) {
            if ($row['Tipo_contrato'] == 1) {
                $nacional++;
            } else {
                $Internacional++;
            }
            $total_contratos++;
        }
    }
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

</head>

<body>
    <div class="container-fluid">
        <div class="row">
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
                        $consult = "SELECT Periodo FROM c_periodo WHERE Id_Periodo=" . $tipo;
                        $resultConsult = $catalogo->obtenerLista($consult);
                        //echo $consult;
                        while ($row = mysqli_fetch_array($resultConsult)) {
                            $año = $row['Periodo'];
                        }
                        if ($año > 0) {
                            $where = "WHERE e.anio=" . $año;
                        } else {
                            $where = "";
                        }
                        //echo "este es el año seleccionado" . $año;
                        $consulta = "SELECT e.tituloFinal as datos,
                        (SELECT COUNT(j.Id_juridico) FROM c_juridico as j 
                        WHERE j.Id_Exposicion=e.idExposicion)as series FROM c_exposicionTemporal as e 
                        $where
                        ORDER BY e.tituloFinal";

                        $resultConsulta = $catalogo->obtenerLista($consulta);
                        //echo $consulta;
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
                        if ($año > 0) {
                            $consulta2 = "SELECT ij.nombre AS datos,(SELECT COUNT(j.Id_juridico)
                            FROM c_juridico AS j INNER JOIN c_exposicionTemporal as e on e.idExposicion=j.Id_Exposicion
                            WHERE j.Id_Instrumento = ij.idInstrumento and e.anio=$año) AS series FROM c_instrumentoJuridico AS ij ORDER BY ij.nombre";
                        } else {
                            $consulta2 = "SELECT ij.nombre AS datos,(SELECT COUNT(j.Id_juridico)
                            FROM c_juridico AS j INNER JOIN c_exposicionTemporal as e on e.idExposicion=j.Id_Exposicion
                            WHERE j.Id_Instrumento = ij.idInstrumento) AS series FROM c_instrumentoJuridico AS ij ORDER BY ij.nombre";
                        }
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tArchivo" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Eje</th>
                            <th scope="col">NUM.contratos</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>