<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/AreaDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Area.php";
	
	class AreaDaoImp implements AreaDao
	{
		function __construct(){}
		
		public function obtenerAreas()
		{
			$areas = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_area WHERE estatus = 1
			ORDER BY orden ASC");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Area();
					$act -> setIdArea($row['Id_Area']);
					$act -> setNombre($row['Nombre']);
					$act -> setOrden($row['orden']);
					
					array_push($areas,$act);
				}
			}
			$conexion = null;
			return $areas;	
		}
		
	}

?>