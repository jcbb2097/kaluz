<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/EvidenciaDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Evidencia.php";
	
	class EvidenciaDaoImp implements EvidenciaDao
	{
		function __construct(){}


		public function registrarRespuesta(Evidencia $act)
		{
			$resultado = 0;
			
			try
			{
				$conexion = new ConexionPDO();
				$consulta = $conexion -> prepare("INSERT INTO mk_evidenciaOpinion(idOpinion,respuesta,archivo,idUsuario,fechaAtendio,estatus,datos,clasificacion)
				VALUES(:idOpinion,:respuesta,:archivo,:idUsuario,:fechaAtendio,:estatus,:datos,:clasificacion) ");
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				$consulta -> bindValue(':respuesta',$act -> getRespuesta(),PDO::PARAM_STR);
				$consulta -> bindValue(':archivo',$act -> getArchivo(),PDO::PARAM_STR);
				$consulta -> bindValue(':idUsuario',$act -> getIdUsuario(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaAtendio',$act -> getFechaAtendio(),PDO::PARAM_STR);
				$consulta -> bindValue(':estatus',$act -> getEstatus(),PDO::PARAM_INT);
				$consulta -> bindValue(':datos',$act -> getDatos(),PDO::PARAM_INT);
				$consulta -> bindValue(':clasificacion',$act -> getClasificacion(),PDO::PARAM_STR);
				

				$consulta -> execute();
				$resultado = $consulta -> rowCount();

				if($act -> getDatos() == 1)
				{
					$consulta = $conexion -> prepare("UPDATE mk_opinion SET idProceso = 3 WHERE idOpinion = :idOpinion ");
				}else{
					$consulta = $conexion -> prepare("UPDATE mk_opinion SET idProceso = 4 WHERE idOpinion = :idOpinion ");
				}
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				
				$consulta -> execute();
				$resultado = $consulta -> rowCount();



				$consulta = $conexion -> prepare("UPDATE mk_detalleOpinion SET respuesta = :respuesta, fechaAtendido = :fechaAtendio WHERE idOpinion = :idOpinion ");
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaAtendio',$act -> getFechaAtendio(),PDO::PARAM_STR);
				$consulta -> bindValue(':respuesta',$act -> getRespuesta(),PDO::PARAM_STR);

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