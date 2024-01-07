<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/ReporteDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Reporte.php";
	
	class ReporteDaoImp implements ReporteDao
	{
		function __construct(){}

		public function totalOpinionArea($idArea,$anio)
		{
			$cadenaAnio = "";
			if($anio == 0)
			{
				$cadenaAnio = " ";
			}else{
				$cadenaAnio = " AND DATE_FORMAT(o.fechaCreo, '%Y') =  ".$anio;
			}

			$act = new Reporte();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total,
			sum(case when  o.idTipo = 1 then 1 else 0 end) as felicitacion,
			sum(case when  o.idTipo = 2 then 1 else 0 end) as solicitud,
			sum(case when  o.idTipo = 3 then 1 else 0 end) as queja,
			sum(case when  o.idProceso = 3 then 1 else 0 end) AS atendioConCorreo,
			sum(case when  o.idProceso = 4 then 1 else 0 end) AS atendioSinCorreo,
			sum(case when  o.idProceso = 2 AND co.email = '' then 1 else 0 end) AS noAtendioSinCorreo,
			sum(case when  o.idProceso = 2 AND co.email != '' then 1 else 0 end) AS noAtendioConCorreo
			FROM mk_opinion o LEFT JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			WHERE o.estatus = 1 AND o.idProceso IN (2,3,4) AND d.idArea = :idArea ".$cadenaAnio." ");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
					$act -> setFelicitacion($row['felicitacion']);
					$act -> setSolicitud($row['solicitud']);
					$act -> setQueja($row['queja']);
					$act -> setAtendioCC($row['atendioConCorreo']);
					$act -> setAtendioSC($row['atendioSinCorreo']);
					$act -> setNoAtendioSC($row['noAtendioSinCorreo']);
					$act -> setNoAtendioCC($row['noAtendioConCorreo']);
				}
			}
			return $act;
		}

		public function totalOpinionEje($idEje,$anio)
		{
			$cadenaAnio = "";
			if($anio == 0)
			{
				$cadenaAnio = " ";
			}else{
				$cadenaAnio = " AND DATE_FORMAT(o.fechaCreo, '%Y') =  ".$anio;
			}

			$act = new Reporte();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total,
			sum(case when  o.idTipo = 1 then 1 else 0 end) as felicitacion,
			sum(case when  o.idTipo = 2 then 1 else 0 end) as solicitud,
			sum(case when  o.idTipo = 3 then 1 else 0 end) as queja,
			sum(case when  o.idProceso = 3 then 1 else 0 end) AS atendioConCorreo,
			sum(case when  o.idProceso = 4 then 1 else 0 end) AS atendioSinCorreo,
			sum(case when  o.idProceso = 2 AND co.email = '' then 1 else 0 end) AS noAtendioSinCorreo,
			sum(case when  o.idProceso = 2 AND co.email != '' then 1 else 0 end) AS noAtendioConCorreo
			FROM mk_opinion o LEFT JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			WHERE o.estatus = 1 AND o.idProceso IN (2,3,4) AND d.idEje = :idEje ".$cadenaAnio." ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setTotal($row['total']);
					$act -> setFelicitacion($row['felicitacion']);
					$act -> setSolicitud($row['solicitud']);
					$act -> setQueja($row['queja']);
					$act -> setAtendioCC($row['atendioConCorreo']);
					$act -> setAtendioSC($row['atendioSinCorreo']);
					$act -> setNoAtendioSC($row['noAtendioSinCorreo']);
					$act -> setNoAtendioCC($row['noAtendioConCorreo']);
				}
			}
			return $act;
		}

		public function totalOpinionEjeArea($idEje,$anio)
		{

			$cadenaAnio = "";
			if($anio == 0)
			{
				$cadenaAnio = " ";
			}else{
				$cadenaAnio = " AND DATE_FORMAT(o.fechaCreo, '%Y') =  ".$anio;
			}

			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare (" SELECT COUNT(*) AS total,
			sum(case when  o.idTipo = 1 then 1 else 0 end) as felicitacion,
			sum(case when  o.idTipo = 2 then 1 else 0 end) as solicitud,
			sum(case when  o.idTipo = 3 then 1 else 0 end) as queja,
			sum(case when  o.idProceso = 3 then 1 else 0 end) AS atendioConCorreo,
			sum(case when  o.idProceso = 4 then 1 else 0 end) AS atendioSinCorreo,
			sum(case when  o.idProceso = 2 AND co.email = '' then 1 else 0 end) AS noAtendioSinCorreo,
			sum(case when  o.idProceso = 2 AND co.email != '' then 1 else 0 end) AS noAtendioConCorreo,
			d.idArea, ar.Nombre AS nombreArea
			FROM mk_opinion o LEFT JOIN mk_detalleOpinion d ON o.idOpinion = d.idOpinion
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN c_area ar ON d.idArea = ar.Id_Area
			WHERE o.estatus = 1 AND o.idProceso IN (2,3,4) AND d.idEje = :idEje  ".$cadenaAnio." 	GROUP BY d.idArea ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Reporte();
				
					$act -> setTotal($row['total']);
					$act -> setFelicitacion($row['felicitacion']);
					$act -> setSolicitud($row['solicitud']);
					$act -> setQueja($row['queja']);
					$act -> setAtendioCC($row['atendioConCorreo']);
					$act -> setAtendioSC($row['atendioSinCorreo']);
					$act -> setNoAtendioSC($row['noAtendioSinCorreo']);
					$act -> setNoAtendioCC($row['noAtendioConCorreo']);
					$act -> setNombreArea($row['nombreArea']);

					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		
	}

?>