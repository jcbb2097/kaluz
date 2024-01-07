<?php
include_once("../../../WEB-INF/Classes/Conexion.class.php");
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$db = new Conexion();
$db->Conectar();
//print_r($_POST);
$img = $_POST['base64'];
$idacuerdo = $_POST['idacuerdo'];
$tipoPerfil = $_POST['tipoPerfil'];
$idUsuario = $_POST['idUsuario'];
//echo $idacuerdo."  ";
//echo $areainvitada;

$img = str_replace('data:image/png;base64,', '', $img);
$fileData = base64_decode($img);
$fileName = uniqid().'.png';

file_put_contents("firmaspdf/".$fileName, $fileData);

//$query="INSERT INTO imagen(tipoperfil,imagen) VALUES ('Direccion','$fileName')";
//$resultado = $db->EjecutarInsert($query);

$query="UPDATE k_acuerdoactividad SET firma = '".$fileName."' where id_acuerdoactividad=".$idacuerdo;
//echo $query;
$query = $catalogo->ejecutaConsultaActualizacion($query, 'k_acuerdoarea', 'id_Acuerdo='.$idacuerdo);
header("Location: ./Lista_acuerdos.php?tipoPerfil= $tipoPerfil &idUsuario= $idUsuario ");
?>