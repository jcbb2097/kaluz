<?php
//include_once __DIR__."libs/model.php";
//include_once __DIR__."/ConexionPDO.php";

class AsuntoModel extends Model {

	public	function __construct() {
		parent::__construct();
	}

	public function guardarConversacion($datos) {
		try {
			$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
			$fecha = $date->format('Y-m-d H:i');
			$idConversacion = "";
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('insert into k_conversacion (asunto,idOrigen,idUsuarioOrigen,idDestino,idUsuarioDestino,tipo,estatus,fechaInicio,fechaRespuesta) values (:titulo, :origen,:idUsuario,:destino,:destinatario,:tipo,1,:fecha1,:fecha2)');

			if($consulta -> execute([
				':titulo' => $datos['titulo'],
				':origen' => $datos['origen'],
				':idUsuario' => $datos['idUsuario'],
				':destino' => $datos['destino'],
				':destinatario' => $datos['destinatario'],
				':tipo' => $datos['tipo'],
				':fecha1' => $fecha,
				':fecha2' => $fecha
			])) {
				//echo 'Mensaje enviado';
				$idConversacion = $base->lastInsertId();
				$consulta = $base -> prepare('insert into k_conversacionActividad (idConversacion,idEje,idGlobal,idGeneral,idParticular,idSub,idEE,idExpo) values (:idConv, :idEje,:idGl,:idGnl,:idPart,:idSub,:idEnt,:idExpo)');
				if($consulta -> execute([
				':idConv' => $idConversacion,
				':idEje' => $datos['eje'],
				':idGl' => $datos['global'],
				':idGnl' => $datos['general'],
				':idPart' => $datos['particular'],
				':idSub' => $datos['sub'],
				':idEnt' => $datos['idEntregable'],
				':idExpo' => $datos['idExpo']
				])) {

				} else {
					echo 'Error al guardar actividades';
				}

				$consulta = $base -> prepare('insert into k_conversacionArea (idConversacion,idArea,orden,estatus,respuestas,fechaAlta) values (:idConv,:idArea,1,1,0,:fecha)');
				if($consulta -> execute([
				':idConv' => $idConversacion,
				':idArea' => $datos['origen'],
				':fecha' => $fecha
				])) {
					$consulta = $base -> prepare('insert into k_conversacionArea (idConversacion,idArea,orden,estatus,respuestas,fechaAlta) values (:idConv,:idArea,2,1,1,:fecha)');
					if($consulta -> execute([
					':idConv' => $idConversacion,
					':idArea' => $datos['destino'],
					':fecha' => $fecha
					])) {

					} else {
						echo 'Error al guardar al conversador';
					}
					$consulta = $base -> prepare('insert into k_conversacionRespuesta (idConversacion,respuesta,idUsuario,idArea,fecha,orden) values (:idConv,:mensaje,:idUsuario,:idArea,:fecha,1)');
					if($consulta -> execute([
					':idConv' => $idConversacion,
					':mensaje' => $datos['mensaje'],
					':idUsuario' => $datos['idUsuario'],
					':idArea' => $datos['origen'],
					':fecha' => $fecha
					])) {

					} else {
						echo 'Error al guardar mensaje';
					}
				} else {
					echo 'Error al guardar al conversador';
				}
				return $idConversacion;
			} else {
				echo 'Error al crear asunto';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function guardarInvitados($idConversacion, $invitados,$destino){
		try {
			$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
			$fecha = $date->format('Y-m-d H:i');
			$base = $this -> db -> connect();
			$i = 3;
			foreach ($invitados as $inv) {
				if($inv != $destino) {
					$consulta = $base -> prepare('insert into k_conversacionArea (idConversacion,idArea,orden,estatus,respuestas,fechaAlta) values (:idConv,:idArea,:orden,1,1,:fecha)');
					if($consulta -> execute([
					':idConv' => $idConversacion,
					':idArea' => $inv,
					':orden' => $i,
					':fecha' => $fecha
					])) {
						$i += 1 ;
					} else {
						echo 'Error al guardar al conversador '.$i;
					}
				}


			}


		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*public function guardarRespuesta($datos) {
		try {
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('insert into k_conversacionRespuesta (idConversacion,respuesta,idUsuario,fecha,orden) values (:idConv,:mensaje,:idUsuario,:fecha,1)');

			if($consulta -> execute([
			':idConv' => $datos['idConversacion'],
			':idUsuario' => $datos['idUsuario'],
			':mensaje' => $datos['mensaje'],
			':fecha' => $datos['fecha']
			])) {

			} else {
				echo 'Error al guardar mensaje';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}*/

	public function guardarConvAct($datos) {
		try {
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('insert into k_conversacionActividad (idConversacion,idEje,idGlobal,idGeneral,idParticular,idSub) values (:idConv, :idEje,:idGl,:iGnl,:idPart,:idSub)');

			echo $datos['idConversacion'].$datos['global'];
			if($consulta -> execute([
				':idConv' => $datos['idConversacion'],
				':idEje' => $datos['eje'],
				':idGl' => $datos['global'],
				':idGnl' => $datos['general'],
				':idPart' => $datos['particular'],
				':idSub' => $datos['sub']
			])) {
				echo 'actividad enviada';
			} else {
				echo 'Error';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getRecibidos($datos) {
		try {
			$asuntos = [];
			$condiciones = [];
			$tipo='0';
			$estatus='0';
			//return 'aquiii'.$datos['tipo'];
			if($datos['tipo']==='0') {
				$tipo = '1,2,3,4';
			} else {
				$tipo=$datos['tipo'];
			}

			if($datos['estatus']==='0') {
				$estatus = '1,2';
			} else {
				$estatus=$datos['estatus'];
			}

			$ejeAux = "";
			if($datos['idEje']!='0') {
				$ejeAux = 'and act.idEje = '.$datos['idEje'];

			}
			$filtroAux = "";


			$base = $this -> db -> connect();
			$qry = "";
			if($datos['opcion'] == 'recibido') {
				if($datos['filtroa']!='0') {
					$filtroAux = ' and c.idOrigen = '.$datos['filtroa'];
				}
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino,p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio,c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c left join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.idDestino = :idArea ".$ejeAux.$filtroAux." and c.estatus in (".$estatus.") and c.tipo in (".$tipo.") order by c.fechaRespuesta desc";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idArea' => $datos['idArea']
				];
			} else if($datos['opcion'] == 'enviado') {
				if($datos['filtroa']!='0') {
					$filtroAux = ' and c.idDestino = '.$datos['filtroa'];
				}
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino,p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio,c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c left join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.idOrigen = :idArea ".$ejeAux.$filtroAux." and c.estatus in (".$estatus.") and c.tipo in (".$tipo.") order by c.fechaRespuesta desc";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idArea' => $datos['idArea']
				];
			} else if($datos['opcion'] == 'invitado') { //invitado
				if($datos['filtroa']!='0') {
					$filtroAux = ' and (c.idDestino = '.$datos['filtroa'].' or c.idOrigen = '.$datos['filtroa'].')';
				}
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino,p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio,c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c inner join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 and ca.orden >= 3 and ca.estatus = 1 left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.estatus in (".$estatus.") ".$ejeAux.$filtroAux." and c.tipo in (".$tipo.") order by c.fechaRespuesta desc";
				$condiciones = [
				':idArea2' => $datos['idArea']
				];
			}
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$asunto = new Asunto();
					$asunto->setIdConversacion($row['idConversacion']);
					$asunto->setTitulo($row['asunto']);
					$asunto->setIdOrigen($row['idOrigen']);
					$asunto->setOrigen($row['origen']);
					$asunto->setIdDestino($row['idDestino']);
					$asunto->setDestino($row['destino']);
					$asunto->setIdUsuarioOrigen($row['Nombre'].' '.$row['Apellido_Paterno']);
					$asunto->setIdUsuarioDestino($row['nombreDest'].' '.$row['APdest']);
					$asunto->setFechaInicio($row['fechaInicio']);
					$query_ultfechas = "SELECT con.idConversacion,conre.idRespuesta , MAX(conre.fecha) fecha,if(con.idOrigen = conre.idArea,'Emisor',if(con.idDestino = conre.idArea,'Receptor','Invitado')) AS tipoer
					  											FROM k_conversacion con
																	JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion
																	WHERE con.idConversacion = :idconv
																	GROUP BY tipoer
																	ORDER BY fecha";
																	$cond = [
																	':idconv' => $row['idConversacion']
																	];
																	$consulta_ultfechas = $base -> prepare($query_ultfechas);
																	if($consulta_ultfechas -> execute($cond)){
																		while ($roww = $consulta_ultfechas->fetch()) {
																			if($roww['tipoer'] == "Emisor")
																				$asunto->setEmisorUltres($roww['fecha']);
																				if($roww['tipoer'] == "Receptor")
																					$asunto->setReceptorUltres($roww['fecha']);
																					if($roww['tipoer'] == "Invitado")
																						$asunto->setInvitadosUltres($roww['fecha']);
																		}
																	}
					$asunto->setFechaRespuesta($row['fechaRespuesta']);
					$asunto->setFechaFin($row['fechaFin']);
					$asunto->setEstatus($row['estatus']);
					$asunto->setNumero($row['respuestas']);
					$asunto->setNumero2($row['respuestas2']);
					$asunto->setNumero3($row['respuestasInv']);
					$asunto->setTipo($row['tipo']);
					$asunto->setExpo($row['expo']);
					$auxT = '';
					if($row['IdTipoActividad']=='1')
						$auxT = '<span style="font-size:10px;">&#127344;</span>->';
					else
						$auxT = '<span style="font-size:10px;">&#127356;</span>->';
					if($row['idSub'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].'.'.$row['p'].'.'.$row['s'].' '.$row['nombreSub']);
					} else if($row['idParticular'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].'.'.$row['p'].' '.$row['nombrePart']);
					} else if($row['idGeneral'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].' '.$row['nombreGeneral']);
					} else {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].' '.$row['nombreGlobal']);
					}
					array_push($asuntos,$asunto);
				}
			} else {
				echo 'Error';
			}
			return $asuntos;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getRecibidosEje($datos) {
		try {
			$asuntos = [];
			$condiciones = [];
			$tipo='0';
			$estatus='0';

			if($datos['tipo']==='0') {
				$tipo = '1,2,3,4';
			} else {
				$tipo=$datos['tipo'];
			}

			if($datos['estatus']==='0') {
				$estatus = '1,2';
			} else {
				$estatus=$datos['estatus'];
			}

			$base = $this -> db -> connect();
			$qry = "";
			if($datos['opcion'] == 'enviado') {
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio, c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c LEFT JOIN k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 LEFT JOIN c_area a on c.idOrigen = a.Id_Area LEFT JOIN c_area a2 on c.idDestino = a2.Id_Area LEFT JOIN c_usuario u on c.idUsuarioOrigen = u.IdUsuario LEFT JOIN c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.idOrigen = :idArea and act.idEje = :idEje and c.estatus in (".$estatus.") and c.tipo in (".$tipo.") order by c.fechaRespuesta desc
";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idArea' => $datos['idArea'],
				':idEje' => $datos['idEje']
				];
			} else if($datos['opcion'] == 'recibido') {
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio, c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c LEFT JOIN k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 LEFT JOIN c_area a on c.idOrigen = a.Id_Area LEFT JOIN c_area a2 on c.idDestino = a2.Id_Area LEFT JOIN c_usuario u on c.idUsuarioOrigen = u.IdUsuario LEFT JOIN c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.idDestino = :idArea and act.idEje = :idEje and c.estatus in (".$estatus.") and c.tipo in (".$tipo.") order by c.fechaRespuesta desc
				";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idArea' => $datos['idArea'],
				':idEje' => $datos['idEje']
				];
			} else if($datos['opcion'] == 'invitado') { //invitado
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio, c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c INNER JOIN k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 and ca.orden >= 3 and ca.estatus = 1 LEFT JOIN c_area a on c.idOrigen = a.Id_Area LEFT JOIN c_area a2 on c.idDestino = a2.Id_Area LEFT JOIN c_usuario u on c.idUsuarioOrigen = u.IdUsuario LEFT JOIN c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act on c.idConversacion = act.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.estatus in (".$estatus.") and act.idEje = :idEje and c.tipo in (".$tipo.") order by c.fechaRespuesta DESC
				";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idEje' => $datos['idEje']
				];
			}
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$asunto = new Asunto();
					$asunto->setIdConversacion($row['idConversacion']);
					$asunto->setTitulo($row['asunto']);
					$asunto->setIdOrigen($row['idOrigen']);
					$asunto->setOrigen($row['origen']);
					$asunto->setIdDestino($row['idDestino']);
					$asunto->setDestino($row['destino']);
					$asunto->setIdUsuarioOrigen($row['Nombre'].' '.$row['Apellido_Paterno']);
					$asunto->setIdUsuarioDestino($row['nombreDest'].' '.$row['APdest']);
					$query_ultfechas = "SELECT con.idConversacion,conre.idRespuesta , MAX(conre.fecha) fecha,if(con.idOrigen = conre.idArea,'Emisor',if(con.idDestino = conre.idArea,'Receptor','Invitado')) AS tipoer
					  											FROM k_conversacion con
																	JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion
																	WHERE con.idConversacion = :idconv
																	GROUP BY tipoer
																	ORDER BY fecha";
																	$cond = [
																	':idconv' => $row['idConversacion']
																	];
																	$consulta_ultfechas = $base -> prepare($query_ultfechas);
																	if($consulta_ultfechas -> execute($cond)){
																		while ($roww = $consulta_ultfechas->fetch()) {
																			if($roww['tipoer'] == "Emisor")
																				$asunto->setEmisorUltres($roww['fecha']);
																				if($roww['tipoer'] == "Receptor")
																					$asunto->setReceptorUltres($roww['fecha']);
																					if($roww['tipoer'] == "Invitado")
																						$asunto->setInvitadosUltres($roww['fecha']);
																		}
																	}
					$asunto->setFechaInicio($row['fechaInicio']);
					$asunto->setFechaRespuesta($row['fechaRespuesta']);
					$asunto->setEstatus($row['estatus']);
					$asunto->setNumero($row['respuestas']);
					$asunto->setTipo($row['tipo']);
					$asunto->setExpo($row['expo']);
					$auxT = '';
					if($row['IdTipoActividad']=='1')
						$auxT = '<span style="font-size:10px;">&#127344;</span>->';
					else
						$auxT = '<span style="font-size:10px;">&#127356;</span>->';
					if($row['idSub'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].'.'.$row['p'].'.'.$row['s'].' '.$row['nombreSub']);
					} else if($row['idParticular'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].'.'.$row['p'].' '.$row['nombrePart']);
					} else if($row['idGeneral'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].' '.$row['nombreGeneral']);
					} else {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].' '.$row['nombreGlobal']);
					}
					array_push($asuntos,$asunto);
				}
				echo '';
			} else {
				echo 'Error';
			}

			return $asuntos;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getResueltos($datos) {
		try {
			$asuntos = [];
			$condiciones = [];
			$ejeTexto = '';

			$tipo='0';
			//return 'aquiii'.$datos['tipo'];
			if($datos['tipo']==='0') {
				$tipo = '1,2,3,4';
			} else {
				$tipo=$datos['tipo'];
			}

			$base = $this -> db -> connect();
			$qry = "";

			if($datos['idEje'] != 0) {
				$ejeTexto = 'and act.idEje = :idEje';
			}

			if($datos['opcion'] == 'recibido') {
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, c.idUsuarioDestino,p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio,c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c left join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.idDestino = :idArea and c.estatus in (3,4) and c.tipo in (".$tipo.") ".$ejeTexto." order by c.fechaRespuesta desc";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idArea' => $datos['idArea']
				];
			} else if($datos['opcion'] == 'enviado') {
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, c.idUsuarioDestino,p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio,c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c left join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.idOrigen = :idArea and c.estatus in (3,4) and c.tipo in (".$tipo.") ".$ejeTexto." order by c.fechaRespuesta desc";
				$condiciones = [
				':idArea2' => $datos['idArea'],
				':idArea' => $datos['idArea']
				];
			} else if($datos['opcion'] == 'invitado') { //invitado
				$qry = "
				SELECT c.idConversacion, c.tipo, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, c.idUsuarioDestino,p2.Nombre as nombreDest, p2.Apellido_Paterno as APdest, p2.Apellido_Materno as AMdest, c.fechaInicio,c.fechaFin, c.fechaRespuesta, c.estatus, ca.respuestas, ca.respuestas2, ca.respuestasInv, e.orden as oe, act1.Nombre AS nombreGlobal,act1.IdTipoActividad, act1.Orden AS gl, act2.Nombre AS nombreGeneral, act2.Orden AS g, act3.Nombre AS nombrePart, act3.Orden AS p, act4.Nombre AS nombreSub, act4.Orden AS s, act.idGlobal, act.idGeneral, act.idParticular, act.idSub, tmp.tituloTrabajo as expo
				FROM k_conversacion c inner join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea2 and ca.orden >= 3 and ca.estatus = 1 left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas LEFT JOIN c_personas p2 ON c.idUsuarioDestino = p2.id_Personas LEFT JOIN k_conversacionActividad act ON act.idConversacion = c.idConversacion LEFT JOIN c_eje e ON e.IdEje = act.idEje LEFT JOIN c_actividad act1 ON act.idGlobal = act1.IdActividad LEFT JOIN c_actividad act2 ON act.idGeneral = act2.IdActividad LEFT JOIN c_actividad act3 ON act.idParticular = act3.IdActividad LEFT JOIN c_actividad act4 ON act.idSub = act4.IdActividad LEFT JOIN c_exposicionTemporal tmp ON act.idExpo = tmp.idExposicion
				WHERE c.estatus in (3,4) and c.tipo in (".$tipo.") ".$ejeTexto." order by c.fechaRespuesta desc";
				$condiciones = [
				':idArea2' => $datos['idArea']
				];
			}

			if($datos['idEje'] != 0) {
				$condiciones += [':idEje' => $datos['idEje']];
			}
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$asunto = new Asunto();
					$asunto->setIdConversacion($row['idConversacion']);
					$asunto->setTitulo($row['asunto']);
					$asunto->setIdOrigen($row['idOrigen']);
					$asunto->setOrigen($row['origen']);
					$asunto->setIdDestino($row['idDestino']);
					$asunto->setDestino($row['destino']);
					$asunto->setIdUsuarioOrigen($row['Nombre'].' '.$row['Apellido_Paterno']);
					$asunto->setIdUsuarioDestino($row['nombreDest'].' '.$row['APdest']);
					$query_ultfechas = "SELECT con.idConversacion,conre.idRespuesta , MAX(conre.fecha) fecha,if(con.idOrigen = conre.idArea,'Emisor',if(con.idDestino = conre.idArea,'Receptor','Invitado')) AS tipoer
					  											FROM k_conversacion con
																	JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion
																	WHERE con.idConversacion = :idconv
																	GROUP BY tipoer
																	ORDER BY fecha";
																	$cond = [
																	':idconv' => $row['idConversacion']
																	];
																	$consulta_ultfechas = $base -> prepare($query_ultfechas);
																	if($consulta_ultfechas -> execute($cond)){
																		while ($roww = $consulta_ultfechas->fetch()) {
																			if($roww['tipoer'] == "Emisor")
																				$asunto->setEmisorUltres($roww['fecha']);
																				if($roww['tipoer'] == "Receptor")
																					$asunto->setReceptorUltres($roww['fecha']);
																					if($roww['tipoer'] == "Invitado")
																						$asunto->setInvitadosUltres($roww['fecha']);
																		}
																	}
					$asunto->setFechaInicio($row['fechaInicio']);
					$asunto->setFechaRespuesta($row['fechaRespuesta']);
					$asunto->setFechaFin($row['fechaFin']);
					$asunto->setEstatus($row['estatus']);
					$asunto->setNumero($row['respuestas']);
					$asunto->setNumero2($row['respuestas2']);
					$asunto->setNumero3($row['respuestasInv']);
					$asunto->setTipo($row['tipo']);
					$auxT = '';
					if($row['IdTipoActividad']=='1')
						$auxT = '<span style="font-size:10px;">&#127344;</span>->';
					else
						$auxT = '<span style="font-size:10px;">&#127356;</span>->';
					if($row['idSub'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].'.'.$row['p'].'.'.$row['s'].' '.$row['nombreSub']);
					} else if($row['idParticular'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].'.'.$row['p'].' '.$row['nombrePart']);
					} else if($row['idGeneral'] != '0') {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].'.'.$row['g'].' '.$row['nombreGeneral']);
					} else {
						$asunto->setActividad($auxT.$row['oe'].'.'.$row['gl'].' '.$row['nombreGlobal']);
					}
					array_push($asuntos,$asunto);
				}
			} else {
				echo 'Error';
			}
			return $asuntos;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getAsunto($idConversacion) {
		try {
			$asunto = new Asunto();
			$base = $this -> db -> connect();
			$qry = "select c.idConversacion, c.asunto, c.idOrigen, a.Nombre as origen, c.idDestino, a2.Nombre as destino, c.idUsuarioOrigen, p.Nombre, p.Apellido_Paterno, c.idUsuarioDestino, c.fechaInicio, c.fechaRespuesta, c.estatus from k_conversacion c left join c_area a on c.idOrigen = a.Id_Area left join c_area a2 on c.idDestino = a2.Id_Area left join c_usuario u on c.idUsuarioOrigen = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas where c.idConversacion = :idConversacion";
			$consulta = $base -> prepare($qry);
			if($consulta -> execute([
				':idConversacion' => $idConversacion
			])) {
				while($row = $consulta->fetch()) {
					$asunto->setIdConversacion($row['idConversacion']);
					$asunto->setTitulo($row['asunto']);
					$asunto->setIdOrigen($row['idOrigen']);
					$asunto->setOrigen($row['origen']);
					$asunto->setIdDestino($row['idDestino']);
					$asunto->setDestino($row['destino']);
					$asunto->setIdUsuarioOrigen($row['Nombre'].' '.$row['Apellido_Paterno']);
					$asunto->setIdUsuarioDestino($row['idUsuarioDestino']);
					$query_ultfechas = "SELECT con.idConversacion,conre.idRespuesta , MAX(conre.fecha) fecha,if(con.idOrigen = conre.idArea,'Emisor',if(con.idDestino = conre.idArea,'Receptor','Invitado')) AS tipoer
					  											FROM k_conversacion con
																	JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion
																	WHERE con.idConversacion = :idconv
																	GROUP BY tipoer
																	ORDER BY fecha";
																	$cond = [
																	':idconv' => $row['idConversacion']
																	];
																	$consulta_ultfechas = $base -> prepare($query_ultfechas);
																	if($consulta_ultfechas -> execute($cond)){
																		while ($roww = $consulta_ultfechas->fetch()) {
																			if($roww['tipoer'] == "Emisor")
																				$asunto->setEmisorUltres($roww['fecha']);
																				if($roww['tipoer'] == "Receptor")
																					$asunto->setReceptorUltres($roww['fecha']);
																					if($roww['tipoer'] == "Invitado")
																						$asunto->setInvitadosUltres($roww['fecha']);
																		}
																	}
					$asunto->setFechaInicio($row['fechaInicio']);
					$asunto->setFechaRespuesta($row['fechaRespuesta']);
					$asunto->setEstatus($row['estatus']);
				}
				return $asunto;
			} else {
				echo 'Error';
			}
			return $asuntos;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	/*public function getConversacion($idConversacion) {
		try {
			$mensajes = [];
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('select * from k_conversacionRespuesta where idConversacion = :idConv order by orden asc');
			if($consulta -> execute(':idConv' => $idConversacion)) {
				while($row = $consulta->fetch()) {
					$msj = new Mensaje();
					$msj->setIdRespuesta($row['idRespuesta']);
					$msj->setIdConversacion($row['idConversacion']);
					$msj->setIdUsuario($row['idUsuario']);
					$msj->setArea($row['usuario']);
					$msj->setFecha($row['fecha']);
					array_push($asuntos,$asunto);
				}
				echo '';
			} else {
				echo 'Error';
			}

			return $asuntos;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}*/

	public function terminar($datos) {
		try {
			$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('update k_conversacion set estatus = 3, fechaFin = :fecha where idConversacion = :idConv');
			if($consulta -> execute([
				':idConv' => $datos['idConversacion'],
				':fecha' => $fecha
			])) {
				//echo 'Asunto terminado';
			} else {
				echo 'Error al terminar asunto';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function terminarCompleto($idConversacion){
		try {
			$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
			$fecha = $date->format('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('update k_conversacion set estatus = 3 where idConversacion = :idConv');
			if($consulta -> execute([
				':idConv' => $idConversacion
			])) {
				//echo 'Asunto terminado';
			} else {
				echo 'Error el asunto no se terminó por el sistema';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function salirConversacion($datos) {
		try {
			$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
			$fecha = $date->format('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('update k_conversacionArea set estatus = 2, fechaSalida = :fecha where idConversacion = :idConv and idArea = :idArea');
			if($consulta -> execute([
				':idConv' => $datos['idConversacion'],
				':idArea' => $datos['idArea'],
				':fecha' => $fecha
			])) {
				//echo 'Saliste del asunto';
			} else {
				echo 'Error al salir del asunto';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

}
?>
