<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
$Id_user = "";
$Id_menu = "";
$Id_submenu = "";
$resultado = array();
$catalogo = new Catalogo();
$resultado = "";

if (isset($_POST['Id_usuario']) && $_POST['Id_usuario'] != "") {
    $Id_user = $_POST['Id_usuario'];
}
if (isset($_POST['Id_submenu']) && $_POST['Id_submenu'] != "") {
    $Id_submenu = $_POST['Id_submenu'];
}
if (isset($_POST['Accion']) && $_POST['Accion'] != "") {

    switch ($_POST['Accion']) {
        case 'Consulta':
            echo 'consulta';
            break;
        case 'Alta':
            $consulta = "SELECT
            psm.Alta
            FROM
                k_perfil_submenu psm
                INNER JOIN c_submenu sbm ON sbm.Id_submenu = psm.Id_submenu
                INNER JOIN c_perfil p ON p.idPerfil = psm.Id_perfil
                INNER JOIN c_usuario u ON u.IdPerfil = p.idPerfil 
            WHERE
                u.IdUsuario = $Id_user
                AND sbm.Id_submenu = $Id_submenu";
            $resulaño = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($resulaño)) {
                $resultado = $row['Alta'];
            }
            echo $resultado;
            break;
        case 'Editar':
            $consulta = "SELECT
            psm.Cambio
            FROM
                k_perfil_submenu psm
                INNER JOIN c_submenu sbm ON sbm.Id_submenu = psm.Id_submenu
                INNER JOIN c_perfil p ON p.idPerfil = psm.Id_perfil
                INNER JOIN c_usuario u ON u.IdPerfil = p.idPerfil 
            WHERE
                u.IdUsuario = $Id_user
                AND sbm.Id_submenu = $Id_submenu
                ";
            $resulaño = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($resulaño)) {
                $resultado = $row['Cambio'];
            }
            echo $resultado;
            break;
        case 'Eliminar':
            $consulta = "SELECT
            psm.Baja
            FROM
                k_perfil_submenu psm
                INNER JOIN c_submenu sbm ON sbm.Id_submenu = psm.Id_submenu
                INNER JOIN c_perfil p ON p.idPerfil = psm.Id_perfil
                INNER JOIN c_usuario u ON u.IdPerfil = p.idPerfil 
            WHERE
                u.IdUsuario = $Id_user
                AND sbm.Id_submenu = $Id_submenu
                ";
            $resulaño = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($resulaño)) {
                $resultado = $row['Baja'];
            }
            echo $resultado;
            break;
    }
}
