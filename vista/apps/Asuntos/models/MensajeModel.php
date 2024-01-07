<?php

class MensajeModel extends Model {

	public	function __construct() {
		parent::__construct();
	}

	/*public function guardarConversacion($datos) {
		try {
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('insert into k_conversacion (asunto,idAreaOrigen,idAreaDestino,tipo,estatus) values (:titulo, :origen,:destino,:tipo,1)');

			if($consulta -> execute([
				':titulo' => $datos['titulo'],
				':origen' => $datos['origen'],
				':destino' => $datos['destino'],
				':tipo' => $datos['tipo']
			])) {
				//echo 'Mensaje enviado';
				$idConversacion = $base->lastInsertId();
				$consulta = $base -> prepare('insert into k_conversacionActividad (idConversacion,idEje,idGlobal,idGeneral,idParticular,idSub) values (:idConv, :idEje,:idGl,:idGnl,:idPart,:idSub)');
				if($consulta -> execute([
				':idConv' => $idConversacion,
				':idEje' => $datos['eje'],
				':idGl' => $datos['global'],
				':idGnl' => $datos['general'],
				':idPart' => $datos['particular'],
				':idSub' => $datos['sub']
				])) {
					$consulta = $base -> prepare('insert into k_conversacionRespuesta (idConversacion,respuesta,idUsuario,fecha,orden) values (:idConv,:mensaje,:idUsuario,:fecha,1)');
					if($consulta -> execute([
					':idConv' => $idConversacion,
					':mensaje' => $datos['mensaje'],
					':idUsuario' => $datos['idUsuario'],
					':fecha' => $datos['fecha'],
					])) {

					} else {
						echo 'Error al guardar mensaje';
					}
				} else {
					echo 'Error al guardar actividades';
				}
			} else {
				echo 'Error al crear asunto';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}*/

	public function guardarRespuesta($datos) {
		try {
			$ultimo=0;
			$estatus="";
			$idDestino = "";
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('select orden from k_conversacionRespuesta where idConversacion = :idConv order by orden desc LIMIT 1');
			if($consulta -> execute([':idConv' => $datos['idConversacion']])) {
				while($row = $consulta->fetch()) {
					$ultimo = (int)$row['orden'] + 1;
				}
				//guarda respuesta
				$date = new DateTime("now", new DateTimeZone('America/Mexico_City') );
				$fecha = $date->format('Y-m-d H:i');

				//$fecha = date('Y-m-d H:i');
				$consulta = $base -> prepare('insert into k_conversacionRespuesta (idConversacion,respuesta,idUsuario,idArea,fecha,orden) values (:idConv,:mensaje,:idUsuario,:idArea,:fecha,:orden)');
				if($consulta -> execute([
				':idConv' => $datos['idConversacion'],
				':mensaje' => $datos['mensaje'],
				':idUsuario' => $datos['idUsuario'],
				':idArea' => $datos['idArea'],
				':fecha' => $fecha,
				':orden' => $ultimo
				])) {
					//actualizar fecha de respuesta y estatus
					//Si es el destinatario marcar como leído, estatus = 2 es leido
					$consulta = $base -> prepare('select idDestino, estatus from k_conversacion where idConversacion = :idConv');
					if($consulta -> execute([':idConv' => $datos['idConversacion']])) {
						while($row = $consulta->fetch()) {
							$idDestino = $row['idDestino'];
							$estatus = $row['estatus'];
						}
						if($idDestino == $datos['idArea'] && $estatus == '1') {
							$consulta = $base -> prepare('update k_conversacion set estatus = 2, fechaRespuesta = :fecha where idConversacion = :idConv');
							$consulta -> execute([
								':idConv' => $datos['idConversacion'],
								':fecha' => $fecha
							]);
						}

						$consulta = $base -> prepare('update k_conversacion set fechaRespuesta = :fecha where idConversacion = :idConv');
						if($consulta -> execute([
							':idConv' => $datos['idConversacion'],
							':fecha' => $fecha
						])){

						} else {
							echo "fecha no se actualizó";
						}

					} else {
						echo 'No encontró destinatario';
					}


					//Actualizar respuestas
					$consulta = $base -> prepare('
						SELECT orden FROM k_conversacionArea WHERE idConversacion = :idConv AND idArea = :idArea
						');
					if($consulta -> execute([
						':idConv' => $datos['idConversacion'],
						':idArea' => $datos['idArea']
					])){
						while($row2 = $consulta->fetch()) {
							$cadena2 = '';
							if($row2['orden'] == '1') {
								$cadena2 = 'UPDATE k_conversacionArea SET respuestas =
												(CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE coalesce(respuestas+1,1) END),
												respuestas2 = (CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE respuestas2 END),
												respuestasInv = (CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE respuestasInv END)
											WHERE idConversacion = :idConv';
							} else if($row2['orden'] == '2') {
								$cadena2 = 'UPDATE k_conversacionArea SET respuestas2 =
												(CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE coalesce(respuestas2+1,1) END),
												respuestas = (CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE respuestas END),
												respuestasInv = (CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE respuestasInv END)
											WHERE idConversacion = :idConv';
							} else {
								$cadena2 = 'UPDATE k_conversacionArea SET respuestasInv =
												(CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE coalesce(respuestasInv+1,1) END),
												respuestas = (CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE respuestas END),
												respuestas2 = (CASE WHEN idArea = '.$datos['idArea'].' then 0 ELSE respuestas2 END)
											WHERE idConversacion = :idConv';
							}
							$cons2 = $base -> prepare($cadena2);
							if($cons2 -> execute([
								':idConv' => $datos['idConversacion']
							])){

							} else {
								echo "No se actualizó el contador";
							}

						}

					} else {
						echo "No se actualizó el contador";
					}
					//Actualizar respuestas

				} else {
					echo 'Error al guardar mensaje';
				}
			} else {
				echo 'Error al consultar orden';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getMensajes($idConversacion) {
		try {
			$mensajes = [];
			$idRespuesta = "";
			$base = $this -> db -> connect();
			$set_idioma = $base -> prepare("SET lc_time_names = 'es_ES';");
			$set_idioma -> execute();
			$consulta = $base -> prepare('select r.idConversacion, r.idRespuesta, r.respuesta, r.idUsuario, r.idArea, date_format(r.fecha, "%d-%M-%Y %H:%i") as fecha, a.orden as indice, ca.Nombre as area, p.Nombre, p.Apellido_Paterno from k_conversacionRespuesta r left join k_conversacionArea a on r.idConversacion = a.idConversacion and r.idArea = a.idArea left join c_area ca on r.idArea = ca.Id_Area  left join c_usuario u on r.idUsuario = u.IdUsuario left join c_personas p on u.IdPersona = p.id_Personas where r.idConversacion = :idConv order by r.idConversacion, r.orden desc');
			if($consulta -> execute([':idConv' => $idConversacion])) {
				while($row = $consulta->fetch()) {
					if($idRespuesta != $row['idRespuesta']) {
						$msj = new Mensaje();
						$msj->setIdRespuesta($row['idRespuesta']);
						$msj->setIdConversacion($row['idConversacion']);
						$msj->setRespuesta($row['respuesta']);
						$msj->setIdUsuario($row['idUsuario']);
						$msj->setUsuario($row['Nombre'].' '.$row['Apellido_Paterno']);
						$msj->setIdArea($row['idArea']);
						$msj->setArea($row['area']);
						$msj->setFecha($row['fecha']);
						$msj->setIndice($row['indice']);
						array_push($mensajes,$msj);
						$idRespuesta = $row['idRespuesta'];
					}
				}
				echo '';
			} else {
				echo 'Error';
			}
			return $mensajes;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function mensajeSistema($datos) {
		try {
			$ultimo=0;
			$estatus="";
			$idDestino = "";
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('select orden from k_conversacionRespuesta where idConversacion = :idConv order by orden desc LIMIT 1');
			if($consulta -> execute([':idConv' => $datos['idConversacion']])) {
				while($row = $consulta->fetch()) {
					$ultimo = (int)$row['orden'] + 1;
				}
				//guarda respuesta
				$fecha = date('Y-m-d H:i');
				$consulta = $base -> prepare('insert into k_conversacionRespuesta (idConversacion,respuesta,idUsuario,idArea,fecha,orden) values (:idConv,:mensaje,:idUsuario,:idArea,:fecha,:orden)');
				if($consulta -> execute([
				':idConv' => $datos['idConversacion'],
				':mensaje' => $datos['mensaje'],
				':idUsuario' => '1000',
				':idArea' => '1000',
				':fecha' => $fecha,
				':orden' => $ultimo
				])) {
					$consulta = $base -> prepare('update k_conversacion set fechaRespuesta = :fecha where idConversacion = :idConv');
					if($consulta -> execute([
						':idConv' => $datos['idConversacion'],
						':fecha' => $fecha
					])){
						//Actualizar respuestas
						$consulta = $base -> prepare('update k_conversacionArea set respuestas = (respuestas + 1) where idConversacion = :idConv');
						if($consulta -> execute([':idConv' => $datos['idConversacion']])){

						} else {
							echo "No se actualizó el contador";
						}
					} else {
						echo "fecha no se actualizó";
					}
				} else {
					echo 'Error al guardar mensaje';
				}
			} else {
				echo 'Error al consultar orden';
			}

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

}
?>
