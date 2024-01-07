<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/PaisDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Pais.php";
	
	class PaisDaoImp implements PaisDao
	{
		function __construct(){}
		
		public function obtenerPaises()
		{
			$paises = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_pais WHERE Activo = 1");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Pais();
					$act -> setId($row['id_Pais']);
					$act -> setNombre($row['Nombre']);
					
					array_push($paises,$act);
				}
			}
			$conexion = null;
			return $paises;	
		}
		
		public function obtenerEstadosMexico()
		{
			$paises = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_estado WHERE Activo = 1");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Pais();
					$act -> setId($row['id_Estado']);
					$act -> setNombre($row['Nombre']);
					
					array_push($paises,$act);
				}
			}
			$conexion = null;
			return $paises;	
		}
		
	}

?>