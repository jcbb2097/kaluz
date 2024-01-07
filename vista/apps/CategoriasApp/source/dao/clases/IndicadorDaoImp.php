<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/IndicadorDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Indicador.php";
	
	class IndicadorDaoImp implements IndicadorDao
	{
		function __construct(){}

		public function totalOpiniones()
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(idOpinion) AS total FROM mk_opinion WHERE estatus = 1");
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
				}
			}
			return $act;
		}

		public function opinionesAnio()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(o.idOpinion) AS total, DATE_FORMAT(o.fechaCreo, '%Y') AS anio,
			sum(case when o.idProceso = 1 then 1 else 0 end) as sinTurnar,
			sum(case when o.idProceso = 2 then 1 else 0 end) as proceso,
			sum(case when o.idProceso = 3 then 1 else 0 end) as atendida,
			sum(case when o.idProceso = 4 then 1 else 0 end) as concluida
			FROM mk_opinion o
			WHERE o.estatus = 1 
			GROUP BY anio
			ORDER BY anio desc");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setDescripcion($row['anio']);
					$act -> setSinTurnar($row['sinTurnar']);
					$act -> setProceso($row['proceso']);
					$act -> setAtendida($row['atendida']);
					$act -> setConcluida($row['concluida']);
										
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function opinionesTipo()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(o.idOpinion) AS total, t.nombre
			FROM mk_opinion o left JOIN  mkc_tipoOpinion t ON o.idTipo = t.idTipo
			WHERE o.estatus = 1  
			GROUP BY o.idTipo");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setDescripcion($row['nombre']);
										
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function opinionesOrigen()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(o.idOpinion) AS total, ori.nombre
			FROM mk_opinion o left JOIN  mkc_origenOpinion ori ON o.idOrigen = ori.idOrigen
			WHERE o.estatus = 1  
			GROUP BY o.idOrigen");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setDescripcion($row['nombre']);
										
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}
		
		public function opinionesEje()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idEje, e.Nombre AS nombreEje
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			WHERE o.idProceso = 2 AND o.estatus= 1
			GROUP BY d.idEje");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setDescripcion($row['nombreEje']);
					$act -> setId($row['idEje']);
										
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}
		
		public function totalOpinionesPorTurnar()
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total FROM mk_opinion WHERE estatus = 1 AND idProceso = 1");
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
				}
			}
			return $act;
		}
		
		public function totalOrigenTurnar()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, mo.idOrigen, oo.nombre AS nombreOrigen
			FROM mk_opinion mo LEFT JOIN mkc_origenOpinion oo ON mo.idOrigen = oo.idOrigen
			WHERE mo.estatus = 1 AND mo.idProceso = 1
			GROUP BY mo.idOrigen");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setDescripcion($row['nombreOrigen']);
					$act -> setId($row['idOrigen']);
										
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}
		
		
		
		/*
		public function obtenerDispositivo($id)
		{
			$act = new Seguridad();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT id, nombre, descripcion, estatus
												FROM mk_dispositivo
												WHERE estatus = 1 and id = :id");
			$consulta -> bindValue(':id',$id,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setId($row['id']);
					$act -> setNombre($row['nombre']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setEstatus($row['estatus']);
				}
			}
			return $act;
		}
		
		public function eliminarDispositivo($id)
		{
			$conexion = new ConexionPDO();
			
			try
			{
				$consulta = $conexion -> prepare ("update mk_dispositivo set estatus = 0 where id = :id");
				$consulta -> bindValue(':id',$id,PDO::PARAM_INT);
				$consulta -> execute();
				$resultado = $consulta -> rowCount();
				echo "1";
			}
			catch(PDOException $e)
			{
				return $resultado;
				echo $e;
			}
		}
		
		public function registrarDispositivo(Seguridad $act)
		{
			$resultado = 0;
			
			try
			{
				$conexion = new ConexionPDO();
				$consulta = $conexion -> prepare("insert into mk_dispositivo (nombre,descripcion,estatus,usuarioCreo,
				fechaCreo) 
				values (:nombre,:descripcion,:estatus,:usuarioCreo,:fechaCreo)");
				$consulta -> bindValue(':nombre',$act -> getNombre(),PDO::PARAM_STR);
				$consulta -> bindValue(':descripcion',$act -> getDescripcion(),PDO::PARAM_STR);
				$consulta -> bindValue(':estatus',$act -> getEstatus(),PDO::PARAM_INT);
				$consulta -> bindValue(':usuarioCreo',$act -> getUsuarioCreo(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaCreo',$act -> getFechaCreo(),PDO::PARAM_STR);

				$consulta -> execute();
				$resultado = $consulta -> rowCount();
				echo "1";
				$conexion = null;
			}
			catch(PDOException $e)
			{
				echo $e;
				return $resultado;
				
			}
		}
		
		public function modificarDispositivo(Seguridad $act)
		{
			
			$conexion = new ConexionPDO();
			
			try
			{
				
				$consulta = $conexion -> prepare ("update mk_dispositivo set nombre = :nombre, descripcion = :descripcion,
				estatus = :estatus, usuarioMod = :usuarioMod, fechaMod = :fechaMod where id = :id");
				$consulta -> bindValue(':nombre',$act -> getNombre(),PDO::PARAM_STR);
				$consulta -> bindValue(':descripcion',$act -> getDescripcion(),PDO::PARAM_STR);
				$consulta -> bindValue(':usuarioMod',$act -> getUsuarioMod(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaMod',$act -> getFechaMod(),PDO::PARAM_STR);
				$consulta -> bindValue(':estatus',$act -> getEstatus(),PDO::PARAM_INT);
				$consulta -> bindValue(':id',$act -> getId(),PDO::PARAM_INT);
				
				$consulta -> execute();
				$resultado = $consulta -> rowCount();
				echo "1";
				$conexion = null;
	
			}
			catch(PDOException $e)
			{
				echo $e;
				return $resultado;
				
			}
		}
		
		
		
		public function obtenerTotalDispositivos()
		{
			$dispositivos = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(di.idDispositivo) AS total, d.nombre
												FROM mk_dispositivoDato di, mk_dispositivo d
												WHERE  di.idDispositivo = d.id AND  di.estatus = 1
												GROUP BY d.nombre");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Seguridad();
					$act -> setTotal($row['total']);
					$act -> setNombre($row['nombre']);
					array_push($dispositivos,$act);
				}
			}
			$conexion = null;
			return $dispositivos;	
		}
		
		public function obtenerTotalUbicacion()
		{
			$dispositivos = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(di.idUbicacion) AS total, u.espacio
												FROM mk_dispositivoDato di, c_espacios u
												WHERE  di.idUbicacion = u.id_espacio AND  di.estatus = 1
												GROUP BY u.espacio
												");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Seguridad();
					$act -> setTotal($row['total']);
					$act -> setNombre($row['espacio']);
					array_push($dispositivos,$act);
				}
			}
			$conexion = null;
			return $dispositivos;	
		}
		*/
	}

?>