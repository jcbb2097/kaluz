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
			$consulta = $conexion -> prepare ("SELECT COUNT(o.idOpinion) AS total, t.nombre, o.idTipo
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
					$act -> setId($row['idTipo']);
										
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
			$consulta = $conexion -> prepare ("SELECT COUNT(o.idOpinion) AS total, ori.nombre, ori.idOrigen
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
					$act -> setId($row['idOrigen']);
										
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
				

		public function totalAnioOpinion($anio)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(idOpinion) AS total FROM mk_opinion WHERE estatus = 1 AND DATE_FORMAT(fechaCreo, '%Y') = :anio");
			$consulta -> bindValue(':anio',$anio,PDO::PARAM_INT);
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

		public function totalOpinionEje($idEje)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idEje, e.Nombre AS nombreEje
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			WHERE o.estatus= 1 AND d.idEje = :idEje");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
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

		public function totalOpinionArea($idArea)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idArea, a.Nombre AS nombreArea
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_area a ON d.idArea = a.Id_Area
			WHERE o.estatus= 1 AND d.idArea = :idArea");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
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

		public function obtenerTiposOpinion()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT * FROM mkc_tipoOpinion WHERE estatus = 1");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setDescripcion($row['nombre']);
					$act -> setId($row['idTipo']);
										
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerOpinionTipoAtencionEje($idEje,$idTipo)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idEje, e.Nombre AS nombreEje, o.idTipo, top.nombre AS nombreTipo,
			sum(case when  o.idProceso = 2 then 1 else 0 end) as noAtendidas,
			sum(case when  cont.email != '' AND  o.idProceso = 2 then 1 else 0 end) as noAtendidasConCorreo,
			sum(case when  cont.email = '' AND  o.idProceso = 2 then 1 else 0 end) as noAtendidasSinCorreo,
			sum(case when  o.idProceso IN (3,4) then 1 else 0 end) as atendidas
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			LEFT JOIN mkc_tipoOpinion top ON o.idTipo = top.idTipo
			LEFT JOIN mk_contactoOpinion cont ON cont.idOpinion = o.idOpinion
			WHERE o.estatus= 1 AND d.idEje = :idEje AND o.idTipo =  :idTipo ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> bindValue(':idTipo',$idTipo,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
					$act -> setAtendida($row['atendidas']);
					$act -> setNoAtendida($row['noAtendidas']);
					$act -> setIdEje($row['idEje']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setSinCorreo($row['noAtendidasSinCorreo']);
					$act -> setConCorreo($row['noAtendidasConCorreo']);
				}
			}
			return $act;
		}

		public function obtenerOpinionTipoAtencionArea($idArea,$idTipo)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idEje, e.Nombre AS nombreEje, o.idTipo, top.nombre AS nombreTipo, d.idArea, 
			sum(case when  o.idProceso = 2 then 1 else 0 end) as noAtendidas,
			sum(case when  cont.email != '' AND  o.idProceso = 2 then 1 else 0 end) as noAtendidasConCorreo,
			sum(case when  cont.email = '' AND  o.idProceso = 2 then 1 else 0 end) as noAtendidasSinCorreo,
			sum(case when  o.idProceso IN (3,4) then 1 else 0 end) as atendidas
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			LEFT JOIN c_area a ON d.idArea = a.Id_Area
			LEFT JOIN mkc_tipoOpinion top ON o.idTipo = top.idTipo
			LEFT JOIN mk_contactoOpinion cont ON cont.idOpinion = o.idOpinion
			WHERE o.estatus= 1 AND d.idArea = :idArea AND o.idTipo = :idTipo ");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			$consulta -> bindValue(':idTipo',$idTipo,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
					$act -> setAtendida($row['atendidas']);
					$act -> setNoAtendida($row['noAtendidas']);
					$act -> setIdEje($row['idEje']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setIdArea($row['idArea']);
					$act -> setSinCorreo($row['noAtendidasSinCorreo']);
					$act -> setConCorreo($row['noAtendidasConCorreo']);
				}
			}
			return $act;
		}

		public function obtenerRangoAnio()
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT MIN(DATE_FORMAT(fechaCreo, '%Y')) AS fechaMenor, MAX(DATE_FORMAT(fechaCreo, '%Y')) as fechaMayor
			FROM mk_opinion WHERE estatus = 1 ");
			
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setAnioInicio($row['fechaMenor']);
					$act -> setAnioUltimo($row['fechaMayor']);
					
				}
			}
			return $act;
		}

		public function totalNoAtendidasEje($idEje)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total 
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN mk_detalleOpinion dop ON dop.idOpinion = o.idOpinion
			LEFT JOIN c_personas per ON dop.idPersonaResponde = per.id_Personas
			LEFT JOIN c_area are ON are.Id_Area = dop.idArea 
			WHERE o.estatus = 1 AND o.idProceso = 2 AND dop.idEje = :idEje ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);

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
		

		public function totalNoAtendidasOrigenEje($idEje,$cadena)
		{
			$query = "";
			if($cadena == 1){
				$query = "";
			}else if($cadena == 2){
				$query = " AND mo.idTipo =1 ";
			}else if($cadena == 3){
				$query = " AND mo.idTipo =2 ";
			}else if($cadena == 4){
				$query = " AND mo.idTipo =3 ";
			}else if($cadena == 5){
				$query = " AND conton.email != '' ";
			}else if($cadena == 6){
				$query = " AND conton.email = '' ";
			}else{

			}


			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, mo.idOrigen, oo.nombre AS nombreOrigen
			FROM mk_opinion mo LEFT JOIN mkc_origenOpinion oo ON mo.idOrigen = oo.idOrigen
			LEFT JOIN mk_detalleOpinion deop ON mo.idOpinion = deop.idOpinion
			LEFT JOIN mk_contactoOpinion conton ON  mo.idOpinion = conton.idOpinion
			LEFT JOIN mkc_tipoOpinion tip ON mo.idTipo = tip.idTipo
			WHERE mo.estatus = 1 AND mo.idProceso = 2 AND deop.idEje = :idEje  ".$query."		GROUP BY mo.idOrigen");

			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
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

		public function totalNoAtendidasArea($idArea)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total 
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN mk_detalleOpinion dop ON dop.idOpinion = o.idOpinion
			LEFT JOIN c_personas per ON dop.idPersonaResponde = per.id_Personas
			LEFT JOIN c_area are ON are.Id_Area = dop.idArea 
			WHERE o.estatus = 1 AND o.idProceso = 2 AND dop.idArea = :idArea ");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);

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

		public function totalTipoNoAtendidasEje($idEje)
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idEje, o.idTipo, top.nombre AS nombreTipo
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			LEFT JOIN mkc_tipoOpinion top ON o.idTipo = top.idTipo
			LEFT JOIN mk_contactoOpinion cont ON cont.idOpinion = o.idOpinion
			WHERE o.estatus= 1 AND d.idEje = :idEje AND o.idProceso = 2
			GROUP BY top.idTipo
			ORDER BY top.idTipo asc");

			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> execute();

			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setIdEje($row['idEje']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombre($row['nombreTipo']);

					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;
		}

		public function totalCorreoNoAtendidasEje($idEje)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idEje, e.Nombre AS nombreEje, 
			sum(case when  cont.email != ''  then 1 else 0 end) as noAtendidasConCorreo,
			sum(case when  cont.email = ''  then 1 else 0 end) as noAtendidasSinCorreo
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			LEFT JOIN c_area a ON d.idArea = a.Id_Area
			LEFT JOIN mkc_tipoOpinion top ON o.idTipo = top.idTipo
			LEFT JOIN mk_contactoOpinion cont ON cont.idOpinion = o.idOpinion
			WHERE o.estatus= 1 AND d.idEje = :idEje  AND o.idProceso = 2 ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['nombreEje']);
					$act -> setSinCorreo($row['noAtendidasSinCorreo']);
					$act -> setConCorreo($row['noAtendidasConCorreo']);
				}
			}
			return $act;
		}

		public function totalTipoNoAtendidasArea($idArea)
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idArea, o.idTipo, top.nombre AS nombreTipo
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			LEFT JOIN mkc_tipoOpinion top ON o.idTipo = top.idTipo
			LEFT JOIN mk_contactoOpinion cont ON cont.idOpinion = o.idOpinion
			LEFT JOIN c_area ar ON d.idArea = ar.Id_Area
			WHERE o.estatus= 1 AND d.idArea = :idArea AND o.idProceso = 2
			GROUP BY top.idTipo
			ORDER BY top.idTipo asc");

			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			$consulta -> execute();

			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Indicador();
					$act -> setTotal($row['total']);
					$act -> setIdArea($row['idArea']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombre($row['nombreTipo']);

					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;
		}

		public function totalCorreoNoAtendidasArea($idArea)
		{
			$act = new Indicador();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total, d.idArea, a.Nombre AS nombreArea, 
			sum(case when  cont.email != ''  then 1 else 0 end) as noAtendidasConCorreo,
			sum(case when  cont.email = ''  then 1 else 0 end) as noAtendidasSinCorreo
			FROM mk_opinion o left JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN c_eje e ON d.idEje = e.idEje
			LEFT JOIN c_area a ON d.idArea = a.Id_Area
			LEFT JOIN mkc_tipoOpinion top ON o.idTipo = top.idTipo
			LEFT JOIN mk_contactoOpinion cont ON cont.idOpinion = o.idOpinion
			WHERE o.estatus= 1 AND d.idArea = :idArea  AND o.idProceso = 2  ");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['nombreEje']);
					$act -> setSinCorreo($row['noAtendidasSinCorreo']);
					$act -> setConCorreo($row['noAtendidasConCorreo']);
				}
			}
			return $act;
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