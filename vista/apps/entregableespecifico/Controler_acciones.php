<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

$catalogo = new Catalogo();

if (isset($_POST['Tipo']) && $_POST['Tipo'] != "") {
    switch ($_POST['Tipo']) {
        case 'menu':
            $consulta_menu = "SELECT distinct en.IdEntregable as IdEntregable, en.Nombre AS nom_entre,ac.IdActividad, CONCAT(ac.Numeracion,' ',ac.Nombre) AS Nombre
            FROM c_entregableEspecifico AS ene
            LEFT JOIN c_entregable AS en ON en.IdEntregable=ene.IdEntregable
            LEFT JOIN c_actividad AS ac ON ac.IdActividad=en.idActividad 
            WHERE ac.IdActividad=".$_POST['APP'];
            $s = "";
            $resultado = $catalogo->obtenerLista($consulta_menu);
            #echo '<option value="">Entregable correspondiente </option>';
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<option value="' . $row['IdEntregable'] . '" ' . $s . '>' . $row['nom_entre'] . ' </option>';
            }
            break;
        /*case 'Submenu':
            $consulta_Submenu = "SELECT m.Id_submenu,m.Descripcion FROM c_submenu as m WHERE m.Id_menu=".$_POST['Menu'];
            $s = "";
            $resultado = $catalogo->obtenerLista($consulta_Submenu);
            echo '<option value="">Seleccione un Submenú</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<option value="' . $row['Id_submenu'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
            }
            break;*/
    }
}
