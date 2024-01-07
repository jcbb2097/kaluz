<?php

//include_once ($_SERVER['DOCUMENT_ROOT'].'/sie/WEB-INF/Classes/Catalogo.class.php');
//$catalogo = new Catalogo();
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
if (isset($_GET['my_modal']) && $_GET['my_modal'] != "") {
    $id = $_GET['my_modal'];
}
$consulta_activo = "SELECT j.Fee_pago, j.Pago_seguro,j.Comite_transporte,j.Fecha_pago_contraparte,j.Num_obra,j.Borrador,j.Avance,j.Estatus,j.Archivo,t.tituloFinal
FROM c_juridico j INNER JOIN c_exposicionTemporal t ON t.idExposicion= j.Id_Exposicion WHERE j.Id_juridico=" . $id;
//echo$consulta_activo;
$resultConsulta = $catalogo->obtenerLista($consulta_activo);
while ($row = mysqli_fetch_array($resultConsulta)) {

    $ruta = '../../../resources/aplicaciones/PDF/Juridico/' . $row['Archivo'];
    
    echo '<i><b><h5 class="modal-title">' . $row['tituloFinal'] . '</h5><br></b></i>';
    echo '<table id="tJuridico" class="table table-striped table-bordered" style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th>FEE / Pago de derechos</th>
            <th>Pago de seguro</th>
            <th>Comité de transporte</th>
            <th>Fecha pagos contraparte</th>
            <th>Núm obras en prestamo</th>
            <th>Borrador contraparte</th>
            <th>Avance</th>
            <th>Estatus</th>
            <th>Archivo</th>
        </tr>
    </thead>
    <tbody>';
    echo ' <tr>';
    echo '<td>' . $row['Fee_pago'] . '</td>';
    echo ' <td>' . $row['Pago_seguro'] . '</td>';
    echo '<td>' . $row['Comite_transporte'] . '</td>';
    echo ' <td>' . $row['Fecha_pago_contraparte'] . '</td>';
    echo '<td>' . $row['Num_obra'] . '</td>';
    echo '<td>' . $row['Borrador'] . '</td>';
    echo '<td>' . $row['Avance'] . '</td>';
    echo '<td>' . $row['Estatus'] . '</td>';
    if ($row['Archivo'] != '') {
        echo '<td><a target="_blank" href="' . $ruta . '" ><i class="glyphicon glyphicon-file"></i> Archivo</a></td>';
    } else {
        
    }
    echo '</tr>
    </tbody>';
}
