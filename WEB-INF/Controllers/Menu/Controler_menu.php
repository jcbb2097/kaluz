<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("../../Classes/Catalogo.class.php");
$Id_user = "";
$Id_menu = "";
$resultado = array();
$catalogo = new Catalogo();
if (isset($_POST['Id_usuario']) && $_POST['Id_usuario'] != "") {
    $Id_user = $_POST['Id_usuario'];
    $Id_menu = $_POST['Id_menu'];
}
$consulta = "SELECT a.Descripcion,m.Ruta FROM k_perfil_menu pm
INNER JOIN c_menu m ON m.Id_menu = pm.Id_menu
INNER JOIN c_perfil p ON p.idPerfil = pm.Id_perfil
INNER JOIN c_usuario u ON u.IdPerfil = p.idPerfil
INNER JOIN c_aplicaciones a ON a.idAplicacion = m.Id_aplicacion
WHERE
u.IdUsuario = $Id_user AND m.Id_menu =$Id_menu";
$resulaño = $catalogo->obtenerLista($consulta);

while ($row = mysqli_fetch_array($resulaño)) {
    $resultado = array("ruta" => $row['Ruta']);
}


$insert = "Insert into k_usuarioLog (idUsuario,idApp,Accion) VALUES($Id_user,(SELECT Id_aplicacion FROM c_menu where Id_menu = $Id_menu),2)";
$res = $catalogo->insertarRegistro($insert);

echo json_encode($resultado);
