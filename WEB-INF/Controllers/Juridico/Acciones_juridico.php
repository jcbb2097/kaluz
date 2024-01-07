<?php
include_once("../../Classes/Catalogo.class.php");
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
$catalogo = new Catalogo();
if (isset($_POST['expo']) && $_POST['expo'] != "") {
    $Periodo = $_POST['Periodo'];
    $consultaperiodo6 = "SELECT
    e.idExposicion,
    e.tituloFinal,
    p.Periodo
    FROM
    c_exposicionTemporal AS e
    INNER JOIN c_periodo AS p ON e.anio = p.Periodo
    WHERE p.Id_Periodo=$Periodo
    ORDER BY
    e.tituloFinal ASC";
    echo$consultaperiodo6;
    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
    echo '<option value = "">Seleccione una opción</option>';
    while ($row = mysqli_fetch_array($resultado6)) {
        $s = '';
        echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
    }
} 
?>