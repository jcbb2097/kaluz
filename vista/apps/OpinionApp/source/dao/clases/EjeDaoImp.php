<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/EjeDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Eje.php";
	
	class EjeDaoImp implements EjeDao
	{
		function __construct(){}
		
		public function obtenerEjes()
		{
			$ejes = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare (" SELECT * FROM c_eje WHERE estatus = 1
			ORDER BY orden asc");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Eje();
					$act -> setIdEje($row['idEje']);
					$act -> setNombre($row['Nombre']);
					$act -> setOrden($row['orden']);
					
					array_push($ejes,$act);
				}
			}
			$conexion = null;
			return $ejes;	
		}
		
	}

?>