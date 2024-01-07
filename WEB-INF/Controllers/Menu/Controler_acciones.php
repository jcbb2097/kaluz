<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");

$catalogo = new Catalogo();

if (isset($_POST['Tipo']) && $_POST['Tipo'] != "") {
    switch ($_POST['Tipo']) {
        case 'menu':
            $consulta_menu = "SELECT m.Id_menu,m.Nombre FROM c_menu as m WHERE m.Id_aplicacion=".$_POST['APP'];
            $s = "";
            $resultado = $catalogo->obtenerLista($consulta_menu);
            echo '<option value="">Seleccione un Menú</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<option value="' . $row['Id_menu'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
            }
            break;
        case 'Submenu':
            $consulta_Submenu = "SELECT m.Id_submenu,m.Descripcion FROM c_submenu as m WHERE m.Id_menu=".$_POST['Menu'];
            $s = "";
            $resultado = $catalogo->obtenerLista($consulta_Submenu);
            echo '<option value="">Seleccione un Submenú</option>';
            while ($row = mysqli_fetch_array($resultado)) {
                echo '<option value="' . $row['Id_submenu'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
            }
            break;
    }
}
