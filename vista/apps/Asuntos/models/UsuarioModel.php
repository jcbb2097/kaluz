<?php

class UsuarioModel extends Model {

	public	function __construct() {
		parent::__construct();
	}
	
	public function getUsuarios($datos) {
		$usuarios = [];
		try {
			$base = $this -> db -> connect();
			$cadena = 'SELECT p.id_Personas, p.Nombre, p.Apellido_Paterno, p.Apellido_Materno FROM c_personas p INNER JOIN c_area a ON p.idArea = a.Id_Area WHERE a.Id_Area = :idArea and p.id_TipoPersona = 1 and p.Activo = 1';
			$consulta = $base -> prepare($cadena);
			if($consulta -> execute([
				':idArea' => $datos['idArea']
			])) {
				while($row = $consulta->fetch()) {
					$usuario = new Usuario();
					$usuario->setIdPersona($row['id_Personas']);
					$usuario->setNombre($row['Nombre']);
					$usuario->setApellidoP($row['Apellido_Paterno']);
					$usuario->setApellidoM($row['Apellido_Materno']);
					array_push($usuarios,$usuario);
				}
			}
			return $usuarios;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>