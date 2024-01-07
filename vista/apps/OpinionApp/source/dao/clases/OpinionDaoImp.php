<?php
/*created by Leasim*/

	include_once __DIR__."/../interfaces/OpinionDao.php";
	include_once __DIR__."/ConexionPDO.php";
	require_once __DIR__."/../../entities/Opinion.php";
	
	class OpinionDaoImp implements OpinionDao
	{
		function __construct(){}
		
		public function obtenerOpiniones()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat, co.apMat 
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			WHERE o.estatus = 1 AND o.idProceso = 1
			ORDER BY o.idOpinion desc");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);
					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function registrarOpinion(Opinion $act)
		{
			$resultado = 0;
			
			try
			{
				$conexion = new ConexionPDO();
				$consulta = $conexion -> prepare("INSERT INTO mk_opinion(descripcion,fechaCreo,idOrigen,idTipo,idProceso,estatus,usuarioCreo,fechaCrea) 
				VALUES(:descripcion,:fechaCreo,:idOrigen,:idTipo,:idProceso,:estatus,:usuarioCreo,:fechaCrea)");
				$consulta -> bindValue(':descripcion',$act -> getDescripcion(),PDO::PARAM_STR);
				$consulta -> bindValue(':fechaCreo',$act -> getFechaCreo(),PDO::PARAM_STR);
				$consulta -> bindValue(':idOrigen',$act -> getIdOrigen(),PDO::PARAM_INT);
				$consulta -> bindValue(':idTipo',$act -> getIdTipo(),PDO::PARAM_INT);
				$consulta -> bindValue(':idProceso',$act -> getIdProceso(),PDO::PARAM_INT);
				$consulta -> bindValue(':estatus',$act -> getEstatus(),PDO::PARAM_INT);
				$consulta -> bindValue(':usuarioCreo',$act -> getUsuarioCreo(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaCrea',$act -> getFechaCrea(),PDO::PARAM_STR);

				$consulta -> execute();
				$resultado = $consulta -> rowCount();
				$idOpinion = $conexion -> lastInsertId();

				$consulta = $conexion -> prepare("INSERT INTO mk_contactoOpinion(idOpinion,nombre,apPat,apMat,edad,email,telefono,idPais,idEstado,idGenero,recibeInfo) 
				VALUES(:idOpinion,:nombre,:apPat,:apMat,:edad,:email,:telefono,:idPais,:idEstado,:idGenero,:recibeInfo)");
				$consulta -> bindValue(':idOpinion',$idOpinion,PDO::PARAM_INT);
				$consulta -> bindValue(':nombre',$act -> getNombre(),PDO::PARAM_STR);
				$consulta -> bindValue(':apPat',$act -> getApPat(),PDO::PARAM_STR);
				$consulta -> bindValue(':apMat',$act -> getApMat(),PDO::PARAM_STR);
				$consulta -> bindValue(':edad',$act -> getEdad(),PDO::PARAM_STR);
				$consulta -> bindValue(':email',$act -> getEmail(),PDO::PARAM_STR);
				$consulta -> bindValue(':telefono',$act -> getTelefono(),PDO::PARAM_STR);
				$consulta -> bindValue(':idPais',$act -> getIdPais(),PDO::PARAM_INT);
				$consulta -> bindValue(':idEstado',$act -> getIdEstado(),PDO::PARAM_INT);
				$consulta -> bindValue(':idGenero',$act -> getIdGenero(),PDO::PARAM_INT);
				$consulta -> bindValue(':recibeInfo',$act -> getRecibeInfo(),PDO::PARAM_INT);
				
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

		public function obtenerOpinion($idOpinion)
		{
			$act = new Opinion();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare (" SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat,co.apMat,co.edad,co.email, co.telefono, co.idPais, cp.Nombre AS nombrePais, co.idEstado, et.Nombre AS nombreEstado,
			co.idGenero, og.nombre AS nombreGenero
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN c_pais cp ON co.idPais = cp.id_Pais
			LEFT JOIN c_estado et ON co.idEstado = et.id_Estado
			LEFT JOIN mk_opinionGenero og ON co.idGenero = og.id
			WHERE o.estatus = 1 and o.idOpinion = :idOpinion ");
			$consulta -> bindValue(':idOpinion',$idOpinion,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);

					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					$act -> setEdad($row['edad']);
					$act -> setEmail($row['email']);
					$act -> setTelefono($row['telefono']);
					$act -> setIdPais($row['idPais']);
					$act -> setIdEstado($row['idEstado']);
					$act -> setIdGenero($row['idGenero']);

					$act -> setNombrePais($row['nombrePais']);
					$act -> setNombreEstado($row['nombreEstado']);
					$act -> setNombreGenero($row['nombreGenero']);
				}
			}
			return $act;
		}

		public function modificarOpinion(Opinion $act)
		{
			
			$conexion = new ConexionPDO();
			
			try
			{
				$consulta = $conexion -> prepare ("UPDATE mk_opinion SET descripcion = :descripcion, fechaCreo = :fechaCreo, 
				idTipo = :idTipo, usuarioMod = :usuarioMod, fechaMod = :fechaMod 
				WHERE idOpinion = :idOpinion");
				$consulta -> bindValue(':descripcion',$act -> getDescripcion(),PDO::PARAM_STR);
				$consulta -> bindValue(':fechaCreo',$act -> getFechaCreo(),PDO::PARAM_STR);
				$consulta -> bindValue(':idTipo',$act -> getIdTipo(),PDO::PARAM_INT);
				$consulta -> bindValue(':usuarioMod',$act -> getUsuarioMod(),PDO::PARAM_INT);
				$consulta -> bindValue(':fechaMod',$act -> getFechaMod(),PDO::PARAM_STR);
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				
				$consulta -> execute();
				$resultado = $consulta -> rowCount();

				$consulta = $conexion -> prepare("UPDATE mk_contactoOpinion SET nombre = :nombre, apPat = :apPat, apMat = :apMat, 
				email = :email, telefono = :telefono 
				WHERE idOpinion = :idOpinion ");
				$consulta -> bindValue(':idOpinion',$act -> getIdOpinion(),PDO::PARAM_INT);
				$consulta -> bindValue(':nombre',$act -> getNombre(),PDO::PARAM_STR);
				$consulta -> bindValue(':apPat',$act -> getApPat(),PDO::PARAM_STR);
				$consulta -> bindValue(':apMat',$act -> getApMat(),PDO::PARAM_STR);
				$consulta -> bindValue(':email',$act -> getEmail(),PDO::PARAM_STR);
				$consulta -> bindValue(':telefono',$act -> getTelefono(),PDO::PARAM_STR);
				
				
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

		public function eliminarOpinionLibro($idOpinion)
		{
			$conexion = new ConexionPDO();
			
			try
			{
				$consulta = $conexion -> prepare ("UPDATE mk_opinion SET estatus = 0 WHERE idOpinion =  :idOpinion");
				$consulta -> bindValue(':idOpinion',$idOpinion,PDO::PARAM_INT);
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
		
		public function obtenerOpinionesEje($id)
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare (" SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			ce.Nombre AS nombreEje,	co.nombre, co.apPat, co.apMat 
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_detalleOpinion dop ON o.idOpinion = dop.idOpinion
			LEFT JOIN c_eje ce ON dop.idEje = ce.idEje
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			WHERE o.estatus = 1 AND o.idProceso = 2 AND dop.idEje = :id
			ORDER BY o.idOpinion desc");
			$consulta -> bindValue(':id',$id,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);
					$act -> setNombreEje($row['nombreEje']);

					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}
		

		public function obtenerDetalleOpinionTurnada($id)
		{
			$act = new Opinion();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat,co.apMat,co.edad,co.email, co.telefono, co.idPais, cp.Nombre AS nombrePais, co.idEstado, et.Nombre AS nombreEstado,
			co.idGenero, og.nombre AS nombreGenero,
			doo.idDetalle, doo.idEje, ej.Nombre AS nombreEje, doo.idArea, ar.Nombre AS nombreArea, doo.idExposicion, ext.tituloFinal AS nombreExposicion,
			doo.idCategoria, cte.descCategoria AS nombreCategoria, doo.idSubcategoria, cte2.descCategoria AS nombreSubcategoria,
			doo.idActividadGlobal, acti.Nombre AS nombreActividadGlobal, doo.idActividadGeneral, acti2.Nombre AS nombreActividadGeneral,
			doo.idCheck, chet.Nombre AS nombreCheck, doo.idSubcheck, chet2.Nombre AS nombreSubcheck, doo.idPersonaResponde,
			person.Nombre AS nombrePersonaResponsable, person.Apellido_Paterno AS apPatResponde, person.Apellido_Materno AS apMatResponde,
			doo.medioRespuesta, doo.respuesta, doo.fechaTurnado, doo.fechaAtendido, us.IdUsuario AS idUsuario
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN c_pais cp ON co.idPais = cp.id_Pais
			LEFT JOIN c_estado et ON co.idEstado = et.id_Estado
			LEFT JOIN mk_opinionGenero og ON co.idGenero = og.id
			LEFT JOIN mk_detalleOpinion doo ON o.idOpinion = doo.idOpinion
			LEFT JOIN c_eje ej ON doo.idEje = ej.idEje
			LEFT JOIN c_area ar ON doo.idArea = ar.Id_Area
			LEFT JOIN c_exposicionTemporal ext  ON doo.idExposicion = ext.idExposicion
			LEFT JOIN c_categoriasdeejes cte ON doo.idCategoria = cte.idCategoria 
			LEFT JOIN c_categoriasdeejes cte2 ON doo.idSubcategoria = cte2.idCategoria 
			LEFT JOIN c_actividad acti ON doo.idActividadGlobal = acti.IdActividad
			LEFT JOIN c_actividad acti2 ON doo.idActividadGeneral = acti2.IdActividad
			LEFT JOIN c_checkList chet ON doo.idCheck = chet.IdCheckList
			LEFT JOIN c_checkList chet2 ON doo.idSubcheck = chet2.IdCheckList
			LEFT JOIN c_personas person ON doo.idPersonaResponde = person.id_Personas
			LEFT JOIN c_usuario us ON person.id_Personas = us.IdPersona
			WHERE o.estatus = 1  AND us.Activo = 1  and o.idOpinion = :id ");
			$consulta -> bindValue(':id',$id,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);

					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					$act -> setEdad($row['edad']);
					$act -> setEmail($row['email']);
					$act -> setTelefono($row['telefono']);
					$act -> setIdPais($row['idPais']);
					$act -> setIdEstado($row['idEstado']);
					$act -> setIdGenero($row['idGenero']);

					$act -> setNombrePais($row['nombrePais']);
					$act -> setNombreEstado($row['nombreEstado']);
					$act -> setNombreGenero($row['nombreGenero']);
						
					$act -> setIdDetalle($row['idDetalle']);
					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['nombreEje']);
					$act -> setIdArea($row['idArea']);
					$act -> setNombreArea($row['nombreArea']);
					$act -> setIdExposicion($row['idExposicion']);
					$act -> setNombreExposicion($row['nombreExposicion']);
					$act -> setIdCategoria($row['idCategoria']);
					$act -> setNombreCategoria($row['nombreCategoria']);
					$act -> setIdSubcategoria($row['idSubcategoria']);
					$act -> setNombreSubcategoria($row['nombreSubcategoria']);
					$act -> setIdActividadGlobal($row['idActividadGlobal']);
					$act -> setNombreActividadGlobal($row['nombreActividadGlobal']);
					$act -> setIdActividadGeneral($row['idActividadGeneral']);
					$act -> setNombreActividadGeneral($row['nombreActividadGeneral']);
					$act -> setIdCheck($row['idCheck']);
					$act -> setNombreCheck($row['nombreCheck']);
					$act -> setIdSubcheck($row['idSubcheck']);
					$act -> setNombreSubcheck($row['nombreSubcheck']);
					$act -> setIdPersonaResponsable($row['idPersonaResponde']);
					$act -> setNombrePersonaResponsable($row['nombrePersonaResponsable']);
					$act -> setApPatResponde($row['apPatResponde']);
					$act -> setApMatResponde($row['apMatResponde']);
					$act -> setMedioRespuesta($row['medioRespuesta']);
					$act -> setRespuesta($row['respuesta']);
					$act -> setFechaTurnado($row['fechaTurnado']);
					$act -> setFechaAtendido($row['fechaAtendido']);
					$act -> setIdUsuario($row['idUsuario']);
				}
			}
			return $act;
		}

		public function obtenerOpinionesOrigen($id)
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare (" SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat, co.apMat
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			WHERE o.estatus = 1  AND o.idOrigen = :id
			ORDER BY o.idOpinion desc");
			$consulta -> bindValue(':id',$id,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);

					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerOpinionesTipo($id)
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare (" SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat, co.apMat
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			WHERE o.estatus = 1  AND o.idTipo = :id
			ORDER BY o.idOpinion desc");
			$consulta -> bindValue(':id',$id,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);

					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerOpinionesGlobalKpi()
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SET lc_time_names = 'es_ES';");
			$consulta -> execute();

			$consulta = $conexion -> prepare ("SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			ce.Nombre AS nombreEje,	co.nombre, co.apPat, co.apMat, co.edad, co.email, co.telefono, co.idPais,
			pp.Nombre AS pais, co.idEstado, ee.Nombre AS estado, co.idGenero, ogg.nombre AS genero,
			DATE_FORMAT(o.fechaCreo, '%Y') AS anio,DATE_FORMAT(o.fechaCreo, '%M') AS mes,
			DATE_FORMAT(o.fechaCreo, '%d') AS dia, DATE_FORMAT(o.fechaCreo, '%m') AS mesNumero

			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_detalleOpinion dop ON o.idOpinion = dop.idOpinion
			LEFT JOIN c_eje ce ON dop.idEje = ce.idEje
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN c_pais pp ON co.idPais = pp.id_Pais
			LEFT JOIN c_estado ee ON co.idEstado = ee.id_Estado
			LEFT JOIN mk_opinionGenero ogg ON co.idGenero = ogg.id
			WHERE o.estatus = 1 
			ORDER BY o.idOpinion desc");
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);
					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					
					$act -> setNombreEje($row['nombreEje']);
					$act -> setEdad($row['edad']);
					$act -> setEmail($row['email']);
					$act -> setTelefono($row['telefono']);
					$act -> setNombrePais($row['pais']);
					$act -> setNombreEstado($row['estado']);
					$act -> setNombreGenero($row['genero']);

					$act -> setAnio($row['anio']);
					$act -> setMes($row['mes']);
					$act -> setDia($row['dia']);
					$act -> setMesNumero($row['mesNumero']);
					
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerOpinionesAnualKpi($anio)
		{
			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SET lc_time_names = 'es_ES';");
			$consulta -> execute();

			$consulta = $conexion -> prepare ("SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			ce.Nombre AS nombreEje,	co.nombre, co.apPat, co.apMat, co.edad, co.email, co.telefono, co.idPais,
			pp.Nombre AS pais, co.idEstado, ee.Nombre AS estado, co.idGenero, ogg.nombre AS genero,
			DATE_FORMAT(o.fechaCreo, '%Y') AS anio,DATE_FORMAT(o.fechaCreo, '%M') AS mes,
			DATE_FORMAT(o.fechaCreo, '%d') AS dia, DATE_FORMAT(o.fechaCreo, '%m') AS mesNumero

			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_detalleOpinion dop ON o.idOpinion = dop.idOpinion
			LEFT JOIN c_eje ce ON dop.idEje = ce.idEje
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN c_pais pp ON co.idPais = pp.id_Pais
			LEFT JOIN c_estado ee ON co.idEstado = ee.id_Estado
			LEFT JOIN mk_opinionGenero ogg ON co.idGenero = ogg.id
			WHERE o.estatus = 1 and DATE_FORMAT(o.fechaCreo, '%Y') = :anio
			ORDER BY o.idOpinion desc");

			$consulta -> bindValue(':anio',$anio,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);
					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					
					$act -> setNombreEje($row['nombreEje']);
					$act -> setEdad($row['edad']);
					$act -> setEmail($row['email']);
					$act -> setTelefono($row['telefono']);
					$act -> setNombrePais($row['pais']);
					$act -> setNombreEstado($row['estado']);
					$act -> setNombreGenero($row['genero']);

					$act -> setAnio($row['anio']);
					$act -> setMes($row['mes']);
					$act -> setDia($row['dia']);
					$act -> setMesNumero($row['mesNumero']);
					
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerOpinionesTurnadasEjeResponder($idEje,$cadena)
		{
			$query = "";
			if($cadena == 1){
				$query = "";
			}else if($cadena == 2){
				$query = " AND o.idTipo =1 ";
			}else if($cadena == 3){
				$query = " AND o.idTipo =2 ";
			}else if($cadena == 4){
				$query = " AND o.idTipo =3 ";
			}else if($cadena == 5){
				$query = " AND co.email != '' ";
			}else if($cadena == 6){
				$query = " AND co.email = '' ";
			}else{

			}


			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat, co.apMat, co.email, co.telefono, dop.idArea, are.Nombre AS nombreArea, dop.idPersonaResponde,
			per.Nombre AS nombrePersonaResponde, per.Apellido_Paterno AS apPatResponde, per.Apellido_Materno AS apMatResponde,
			co.edad, co.idPais, pa.Nombre AS nombrePais, co.idEstado, est.Nombre AS nombreEstado, co.idGenero, opgen.nombre AS nombreGenero,
			
			dop.idCategoria, cej.descCategoria AS nombreCategoria, dop.idSubcategoria, cejsub.descCategoria AS nombreSubcategoria,
			dop.idActividadGlobal,cact.Numeracion AS numeroOrdenGlobal, cact.Nombre AS nombreActividadGlobal,
			dop.idActividadGeneral, actGral.Numeracion AS numeroOrdenGral, actGral.Nombre AS nombreActividadGeneral,
			dop.idCheck, cchek.Orden AS ordenCheck, cchek.Nombre AS nombreCheck, dop.idSubcheck, cchekSub.Orden AS ordenSubcheck,
			cchekSub.Nombre AS nombreSubcheck, dop.idEje, ej.Nombre AS nombreEje
			
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN mk_detalleOpinion dop ON dop.idOpinion = o.idOpinion
			LEFT JOIN c_personas per ON dop.idPersonaResponde = per.id_Personas
			LEFT JOIN c_area are ON are.Id_Area = dop.idArea 
			LEFT JOIN c_pais pa ON co.idPais = pa.id_Pais
			LEFT JOIN c_estado est ON co.idEstado = est.id_Estado
			LEFT JOIN mk_opinionGenero opgen ON co.idGenero = opgen.id

			LEFT JOIN c_categoriasdeejes cej ON dop.idCategoria = cej.idCategoria
			LEFT JOIN c_categoriasdeejes cejsub ON dop.idSubcategoria = cejsub.idCategoria
			LEFT JOIN c_actividad cact ON dop.idActividadGlobal = cact.IdActividad
			LEFT JOIN c_actividad actGral ON dop.idActividadGeneral = actGral.IdActividad
			LEFT JOIN c_checkList cchek ON dop.idCheck = cchek.IdCheckList
			LEFT JOIN c_checkList cchekSub ON dop.idSubcheck = cchekSub.IdCheckList
			LEFT JOIN c_eje ej on dop.idEje = ej.idEje

			WHERE o.estatus = 1 AND o.idProceso = 2 AND dop.idEje = :idEje  ".$query."	 ORDER BY o.idOpinion desc");

			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);
					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					$act -> setEmail($row['email']);
					$act -> setTelefono($row['telefono']);

					$act -> setIdArea($row['idArea']);
					$act -> setNombreArea($row['nombreArea']);
					$act -> setIdPersonaResponsable($row['idPersonaResponde']);
					$act -> setNombrePersonaResponsable($row['nombrePersonaResponde']);
					$act -> setApPatResponde($row['apPatResponde']);
					$act -> setApMatResponde($row['apMatResponde']);

					$act -> setEdad($row['edad']);
					$act -> setIdPais($row['idPais']);
					$act -> setNombrePais($row['nombrePais']);
					$act -> setIdEstado($row['idEstado']);
					$act -> setNombreEstado($row['nombreEstado']);
					$act -> setIdGenero($row['idGenero']);
					$act -> setNombreGenero($row['nombreGenero']);

					$act -> setIdCategoria($row['idCategoria']);
					$act -> setNombreCategoria($row['nombreCategoria']);
					$act -> setIdSubcategoria($row['idSubcategoria']);
					$act -> setNombreSubcategoria($row['nombreSubcategoria']);

					$act -> setIdActividadGlobal($row['idActividadGlobal']);
					$act -> setNombreActividadGlobal($row['nombreActividadGlobal']);
					$act -> setIdActividadGeneral($row['idActividadGeneral']);
					$act -> setNombreActividadGeneral($row['nombreActividadGeneral']);
					$act -> setNumeroOrdenGlobal($row['numeroOrdenGlobal']);
					$act -> setNumeroOrdenGral($row['numeroOrdenGral']);

					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['nombreEje']);
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerNombreEje($idEje)
		{
			$act = new Opinion();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT idEje, Nombre, orden, idResponsable FROM c_eje 
			WHERE estatus = 1 AND idEje = :idEje ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['Nombre']);
					$act -> setOrden($row['orden']);
					$act -> setIdResponsableEje($row['idResponsable']);
			
				}
			}
			return $act;
		}

		public function obtenerNombreArea($idArea)
		{
			$act = new Opinion();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT Id_Area AS idArea,Nombre, orden FROM c_area
			 WHERE estatus = 1 AND Id_Area = :idArea ");
			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setIdArea($row['idArea']);
					$act -> setNombreArea($row['Nombre']);
					$act -> setOrden($row['orden']);
		
			
				}
			}
			return $act;
		}

		public function obtenerOpinionesTurnadasAreaResponder($idArea,$cadena)
		{
			$query = "";
			if($cadena == 1){
				$query = "";
			}else if($cadena == 2){
				$query = " AND o.idTipo =1 ";
			}else if($cadena == 3){ 
				$query = " AND o.idTipo =2 ";
			}else if($cadena == 4){
				$query = " AND o.idTipo =3 ";
			}else if($cadena == 5){
				$query = " AND co.email != '' ";
			}else if($cadena == 6){
				$query = " AND co.email = '' ";
			}else{

			}


			$opiniones = array();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT o.idOpinion, o.descripcion, o.fechaCreo, o.idOrigen, oo.nombre AS nombreOrigen, o.idTipo,
			ot.nombre AS nombreTipo, o.idProceso, po.nombre AS nombreProceso, o.estatus, o.usuarioMod, o.fechaMod,
			co.nombre, co.apPat, co.apMat, co.email, co.telefono, dop.idArea, are.Nombre AS nombreArea, dop.idPersonaResponde,
			per.Nombre AS nombrePersonaResponde, per.Apellido_Paterno AS apPatResponde, per.Apellido_Materno AS apMatResponde,
			co.edad, co.idPais, pa.Nombre AS nombrePais, co.idEstado, est.Nombre AS nombreEstado, co.idGenero, opgen.nombre AS nombreGenero,
			
			dop.idCategoria, cej.descCategoria AS nombreCategoria, dop.idSubcategoria, cejsub.descCategoria AS nombreSubcategoria,
			dop.idActividadGlobal,cact.Numeracion AS numeroOrdenGlobal, cact.Nombre AS nombreActividadGlobal,
			dop.idActividadGeneral, actGral.Numeracion AS numeroOrdenGral, actGral.Nombre AS nombreActividadGeneral,
			dop.idCheck, cchek.Orden AS ordenCheck, cchek.Nombre AS nombreCheck, dop.idSubcheck, cchekSub.Orden AS ordenSubcheck,
			cchekSub.Nombre AS nombreSubcheck, dop.idEje, ej.Nombre AS nombreEje
			
			FROM mk_opinion o LEFT JOIN mkc_origenOpinion oo ON o.idOrigen = oo.idOrigen
			LEFT JOIN mkc_tipoOpinion ot ON o.idTipo = ot.idTipo
			LEFT JOIN mkc_procesoOpinion po ON o.idProceso = po.idProceso
			LEFT JOIN mk_contactoOpinion co ON o.idOpinion = co.idOpinion
			LEFT JOIN mk_detalleOpinion dop ON dop.idOpinion = o.idOpinion
			LEFT JOIN c_personas per ON dop.idPersonaResponde = per.id_Personas
			LEFT JOIN c_area are ON are.Id_Area = dop.idArea 
			LEFT JOIN c_pais pa ON co.idPais = pa.id_Pais
			LEFT JOIN c_estado est ON co.idEstado = est.id_Estado
			LEFT JOIN mk_opinionGenero opgen ON co.idGenero = opgen.id

			LEFT JOIN c_categoriasdeejes cej ON dop.idCategoria = cej.idCategoria
			LEFT JOIN c_categoriasdeejes cejsub ON dop.idSubcategoria = cejsub.idCategoria
			LEFT JOIN c_actividad cact ON dop.idActividadGlobal = cact.IdActividad
			LEFT JOIN c_actividad actGral ON dop.idActividadGeneral = actGral.IdActividad
			LEFT JOIN c_checkList cchek ON dop.idCheck = cchek.IdCheckList
			LEFT JOIN c_checkList cchekSub ON dop.idSubcheck = cchekSub.IdCheckList
			LEFT JOIN c_eje ej on dop.idEje = ej.idEje

			WHERE o.estatus = 1 AND o.idProceso = 2 AND dop.idArea = :idArea  ".$query."	 ORDER BY o.idOpinion desc");

			$consulta -> bindValue(':idArea',$idArea,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() >0)
			{
				while ($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act = new Opinion();
					$act -> setIdOpinion($row['idOpinion']);
					$act -> setDescripcion($row['descripcion']);
					$act -> setFechaCreo($row['fechaCreo']);
					$act -> setIdOrigen($row['idOrigen']);
					$act -> setNombreOrigen($row['nombreOrigen']);
					$act -> setIdTipo($row['idTipo']);
					$act -> setNombreTipo($row['nombreTipo']);
					$act -> setIdProceso($row['idProceso']);
					$act -> setNombreProceso($row['nombreProceso']);
					$act -> setEstatus($row['estatus']);
					$act -> setUsuarioMod($row['usuarioMod']);
					$act -> setFechaMod($row['fechaMod']);
					$act -> setNombre($row['nombre']);
					$act -> setApPat($row['apPat']);
					$act -> setApMat($row['apMat']);
					$act -> setEmail($row['email']);
					$act -> setTelefono($row['telefono']);

					$act -> setIdArea($row['idArea']);
					$act -> setNombreArea($row['nombreArea']);
					$act -> setIdPersonaResponsable($row['idPersonaResponde']);
					$act -> setNombrePersonaResponsable($row['nombrePersonaResponde']);
					$act -> setApPatResponde($row['apPatResponde']);
					$act -> setApMatResponde($row['apMatResponde']);

					$act -> setEdad($row['edad']);
					$act -> setIdPais($row['idPais']);
					$act -> setNombrePais($row['nombrePais']);
					$act -> setIdEstado($row['idEstado']);
					$act -> setNombreEstado($row['nombreEstado']);
					$act -> setIdGenero($row['idGenero']);
					$act -> setNombreGenero($row['nombreGenero']);

					$act -> setIdCategoria($row['idCategoria']);
					$act -> setNombreCategoria($row['nombreCategoria']);
					$act -> setIdSubcategoria($row['idSubcategoria']);
					$act -> setNombreSubcategoria($row['nombreSubcategoria']);

					$act -> setIdActividadGlobal($row['idActividadGlobal']);
					$act -> setNombreActividadGlobal($row['nombreActividadGlobal']);
					$act -> setIdActividadGeneral($row['idActividadGeneral']);
					$act -> setNombreActividadGeneral($row['nombreActividadGeneral']);
					$act -> setNumeroOrdenGlobal($row['numeroOrdenGlobal']);
					$act -> setNumeroOrdenGral($row['numeroOrdenGral']);

					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['nombreEje']);
					
					array_push($opiniones,$act);
				}
			}
			$conexion = null;
			return $opiniones;	
		}

		public function obtenerResponsableEje($idEje)
		{
			$act = new Opinion();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT e.idEje, e.Nombre, e.orden, e.idResponsable, p.Nombre, p.Apellido_Paterno, p.Apellido_Materno, u.IdUsuario
			FROM c_eje e LEFT JOIN c_personas p ON e.idResponsable = p.id_Personas
			LEFT JOIN c_usuario u ON u.IdPersona = p.id_Personas 
			WHERE e.estatus = 1  AND u.Activo = 1 AND e.idEje = :idEje ");
			$consulta -> bindValue(':idEje',$idEje,PDO::PARAM_INT);
			$consulta -> execute();
			
			if($consulta -> rowCount() == 1)
			{
				while($row = $consulta -> fetch(PDO::FETCH_ASSOC))
				{
					$act -> setIdEje($row['idEje']);
					$act -> setNombreEje($row['Nombre']);
					$act -> setOrden($row['orden']);
					$act -> setIdResponsableEje($row['idResponsable']);
					$act -> setIdUsuario($row['IdUsuario']);
			
				}
			}
			return $act;
		}
		
		/*
		
		
		
		
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
		
		
		
		public function obtenerTotal()
		{
			$act = new Seguridad();
			$conexion = new ConexionPDO();
			$consulta = $conexion -> prepare ("SELECT COUNT(*) AS total
												FROM  mk_dispositivoDato
												WHERE estatus = 1");
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