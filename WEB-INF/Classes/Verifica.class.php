<?php
include_once("Conexion.class.php");
class Verifica {

 public function verifica_responsable_eje($idUsuario){
	$db = new Conexion();
	$db->Conectar();
		$result = $db->Ejecutar("SELECT * FROM c_eje eje JOIN c_usuario usu ON eje.idResponsable = usu.IdPersona WHERE usu.IdUsuario =".$idUsuario);
		while($row = mysqli_fetch_array($result)){
			return true;
		}
	$db->Desconectar();
	return false;
 }
 public function verifica_sustituto_eje($idUsuario){
	$db = new Conexion();
	$db->Conectar();
		$result = $db->Ejecutar("SELECT * FROM c_eje eje JOIN c_usuario usu ON eje.idSustitutoResponsable = usu.IdPersona WHERE usu.IdUsuario =".$idUsuario);
		while($row = mysqli_fetch_array($result)){
			return true;
		}
	$db->Desconectar();
	return false;
 }
  public function verifica_perfil($idUsuario){
		$db = new Conexion();
		$db->Conectar();
			$result = $db->Ejecutar("SELECT IdUsuario from c_usuario where IdPerfil in(1,4) and IdUsuario =".$idUsuario);
			while($row = mysqli_fetch_array($result)){
				return true;
			}
		$db->Desconectar();
		return false;
	}
}
?>
