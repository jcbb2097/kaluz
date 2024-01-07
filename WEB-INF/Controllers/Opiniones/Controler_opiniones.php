<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("../../Classes/Catalogo.class.php");
include_once('../../Classes/Opinion.class.php');
$catalogo = new Catalogo();
$obj = new Opinion();
$id = "";


if (isset($_POST['form'])) {
    $parametros = array();
    parse_str($_POST['form'], $parametros);
}
$consulta = "SELECT u.IdPersona FROM c_usuario u WHERE u.IdUsuario=" . $parametros['idUsuario'];
$result = $catalogo->obtenerLista($consulta);
while ($row = mysqli_fetch_array($result)) {
    $id = $row['IdPersona'];
}
$obj->setIdOpinion($parametros['IdOpinion']);
$obj->setIdPersonaAtendio($id);
$obj->setIdUsuarioAtendio($parametros['idUsuario']);
if (isset($parametros['txtRespuestaTel'])) {
    $obj->setTextoAtencion($parametros['txtRespuestaTel']);
} else {
    $obj->setTextoAtencion($parametros['txtRespuestaEmail']);
}
$obj->setIncidencia_al_atender($parametros['incidencia']);

if ($obj->Responder_opinion()) {
    echo 'Éxito: Opinion atendida';
} else {
    echo 'Error: No se ha podido atender la opinion';
}
