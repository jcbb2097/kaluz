<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/ActividadDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Actividad.php";
	
	class ActividadDaoImp implements ActividadDao
	{
		function __construct(){}
		
		public function obtenerActGlobalEjeCat($idEje,$anio,$idCategoria)
		{
			$actividades = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_actividad
			WHERE Anio = :anio AND IdEje = :idEje AND IdTipoActividad = 1 
			AND IdNivelActividad =1 AND Idcategoria = :idCategoria
			ORDER BY Orden asc");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> bindValue(':anio',$anio,PDO::PARAM_INT);
			$consulta -> bindValue(':idCategoria',$idCategoria,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Actividad();
					$act -> setIdActividad($row['IdActividad']);
					$act -> setNombre($row['Nombre']);
					$act -> setAnio($row['Anio']);
					$act -> setPeriodo($row['Periodo']);
					$act -> setIdCategoria($row['Idcategoria']);
					$act -> setNumeracion($row['Numeracion']);
					
					array_push($actividades,$act);
				}
			}
			$conexion = null;
			return $actividades;	
		}
		
		public function obtenerActGeneralEjeCat($idEje,$anio,$idCategoria,$idActividadGlobal)
		{
			$actividades = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM c_actividad
			WHERE Anio = :anio AND IdEje = :idEje AND IdTipoActividad = 1 
			AND IdNivelActividad = 2 AND Idcategoria = :idCategoria AND IdActividadSuperior = :idActividadGlobal
			ORDER BY Orden asc");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> bindValue(':anio',$anio,PDO::PARAM_INT);
			$consulta -> bindValue(':idCategoria',$idCategoria,PDO::PARAM_INT);
			$consulta -> bindValue(':idActividadGlobal',$idActividadGlobal,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Actividad();
					$act -> setIdActividad($row['IdActividad']);
					$act -> setNombre($row['Nombre']);
					$act -> setAnio($row['Anio']);
					$act -> setPeriodo($row['Periodo']);
					$act -> setIdCategoria($row['Idcategoria']);
					$act -> setNumeracion($row['Numeracion']);
					$act -> setIdActividadSuperior($row['IdActividadSuperior']);
					
					array_push($actividades,$act);
				}
			}
			$conexion = null;
			return $actividades;	
		}
		
	}

?>