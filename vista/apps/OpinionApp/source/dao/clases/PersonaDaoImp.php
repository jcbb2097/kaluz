<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/PersonaDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Persona.php";
	
	class PersonaDaoImp implements PersonaDao
	{
		function __construct(){}
		
		public function obtenerPersonasArea($idArea)
		{
			$personas = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT id_Personas, idEje, idArea, Nombre, Apellido_Paterno, Apellido_Materno
			FROM c_personas
			WHERE personal = 1 and Activo = 1 AND idArea = :idArea");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Persona();
					$act -> setIdPersona($row['id_Personas']);
					$act -> setIdEje($row['idEje']);
					$act -> setIdArea($row['idArea']);
					$act -> setNombre($row['Nombre']);
					$act -> setApPat($row['Apellido_Paterno']);
					$act -> setApMat($row['Apellido_Materno']);
					
					array_push($personas,$act);
				}
			}
			$conexion = null;
			return $personas;	
		}
		
	}

?>