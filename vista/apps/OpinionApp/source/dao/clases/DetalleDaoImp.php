<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/DetalleDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Detalle.php";
	
	class DetalleDaoImp implements DetalleDao
	{
		function __construct(){}
		
		

		public function registrarTurnarOpinion(Detalle $act)
		{
			$resultado = 0;
			
			try
			{
				$conexion = new ConexionPDO();
				$consulta = $conexion -> prepare("INSERT INTO mk_detalleOpinion(idOpinion,idEje,idArea,idExposicion,idCategoria,idSubcategoria,idActividadGlobal,idActividadGeneral,idCheck,idSubcheck,idPersonaResponde,fechaTurnado)
				VALUES(:idOpinion,:idEje,:idArea,:idExposicion,:idCategoria,:idSubcategoria,:idActividadGlobal,:idActividadGeneral,:idCheck,:idSubcheck,:idPersonaResponde,:fechaTurnado) ");
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				$consulta -> bindValue(':idEje',$act -> getIdEje(),PDO::PARAM_INT);
				$consulta -> bindValue(':idArea',$act -> getIdArea(),PDO::PARAM_INT);
				$consulta -> bindValue(':idExposicion',$act -> getIdExposicion(),PDO::PARAM_INT);
				$consulta -> bindValue(':idCategoria',$act -> getIdCategoria(),PDO::PARAM_INT);
				$consulta -> bindValue(':idSubcategoria',$act -> getIdSubcategoria(),PDO::PARAM_INT);
				$consulta -> bindValue(':idActividadGlobal',$act -> getIdActividadGlobal(),PDO::PARAM_INT);
				$consulta -> bindValue(':idActividadGeneral',$act -> getIdActividadGeneral(),PDO::PARAM_INT);
				$consulta -> bindValue(':idCheck',$act -> getIdCheck(),PDO::PARAM_INT);
				$consulta -> bindValue(':idSubcheck',$act -> getIdSubcheck(),PDO::PARAM_INT);
				$consulta -> bindValue(':idPersonaResponde',$act -> getIdPersonaResponde(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaTurnado',$act -> getFechaTurnado(),PDO::PARAM_STR);

				$consulta -> execute();
				$resultado = $consulta -> rowCount();
				
				$consulta = $conexion -> prepare("UPDATE mk_opinion SET idProceso = 2 where idOpinion = :idOpinion");
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				$consulta -> execute();
				$resultado = $consulta -> rowCount();

				$consulta = $conexion -> prepare("INSERT INTO mk_logProcesoOpinion(idOpinion,idProceso,fecha,idUsuario)
				VALUES(:idOpinion,2,:fecha,:idUsuario)");
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				$consulta -> bindValue(':fecha',$act -> getFechaTurnado(),PDO::PARAM_STR);
				$consulta -> bindValue(':idUsuario',$act -> getIdUsuario(),PDO::PARAM_INT);

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

		public function modificarOpinionTurnada(Detalle $act)
		{
			
			$conexion = new ConexionPDO();
			
			try
			{
				$consulta = $conexion -> prepare ("UPDATE mk_detalleOpinion SET idEje = :idEje, idArea = :idArea, idExposicion = :idExposicion, idCategoria = :idCategoria,
				idSubcategoria = :idSubcategoria, idActividadGlobal = :idActividadGlobal, idActividadGeneral = :idActividadGeneral,
				idCheck = :idCheck, idSubcheck = :idSubcheck, idPersonaResponde = :idPersonaResponde, fechaTurnado = :fechaTurnado
				WHERE idOpinion = :idOpinion");

				$consulta -> bindValue(':idEje',$act -> getIdEje(),PDO::PARAM_INT);
				$consulta -> bindValue(':idArea',$act -> getIdArea(),PDO::PARAM_INT);
				$consulta -> bindValue(':idExposicion',$act -> getIdExposicion(),PDO::PARAM_INT);
				$consulta -> bindValue(':idCategoria',$act -> getIdCategoria(),PDO::PARAM_INT);
				$consulta -> bindValue(':idSubcategoria',$act -> getIdSubcategoria(),PDO::PARAM_INT);
				$consulta -> bindValue(':idActividadGlobal',$act -> getIdActividadGlobal(),PDO::PARAM_INT);
				$consulta -> bindValue(':idActividadGeneral',$act -> getIdActividadGeneral(),PDO::PARAM_INT);
				$consulta -> bindValue(':idCheck',$act -> getIdCheck(),PDO::PARAM_INT);
				$consulta -> bindValue(':idSubcheck',$act -> getIdSubcheck(),PDO::PARAM_INT);
				$consulta -> bindValue(':idPersonaResponde',$act -> getIdPersonaResponde(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaTurnado',$act -> getFechaTurnado(),PDO::PARAM_STR);
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				
				
				
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

	}

?>