<?php
//include_once __DIR__."libs/model.php";
//include_once __DIR__."/ConexionPDO.php";

class IndicadorModel extends Model {

	public	function __construct() {
		parent::__construct();
	}
	
	public function getIndicadoresGeneral($datos) {
		try {
			$ind = new Indicador();
			$ind -> setRecibidos('0');
			$ind -> setEnviados('0');
			$ind -> setInvitados('0');
			$ind -> setSolicitud('0');
			$ind -> setSugerencia('0');
			$ind -> setConocimiento('0');
			$ind -> setProblematica('0');
			$estatus='0';
			if($datos['estatus']==='0') {
				$estatus = '1,2';
			} else {
				$estatus=$datos['estatus'];
			}
			$ejeAux = "";
			if($datos['idEje']!='0') {
				$ejeAux = 'INNER JOIN k_conversacionActividad act ON c.idConversacion = act.idConversacion AND act.idEje = '.$datos['idEje'];
			} 

			$base = $this -> db -> connect();
			$qryEnviados = 'SELECT 
								COUNT(*) AS total,
								SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
								SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 1 THEN 1 ELSE 0 END) AS so,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 2 THEN 1 ELSE 0 END) AS co,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 3 THEN 1 ELSE 0 END) AS su,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 4 THEN 1 ELSE 0 END) AS pr,
								a.Nombre
							from k_conversacion c '.$ejeAux.' LEFT JOIN c_area a ON c.idOrigen = a.Id_Area where c.idOrigen = :idArea and c.estatus IN (1,2)';
			$qryRecibidos = 'SELECT 
								COUNT(*) AS total,
								SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
								SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 1 THEN 1 ELSE 0 END) AS so,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 2 THEN 1 ELSE 0 END) AS co,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 3 THEN 1 ELSE 0 END) AS su,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 4 THEN 1 ELSE 0 END) AS pr,
								a.Nombre
							from k_conversacion c '.$ejeAux.' LEFT JOIN c_area a ON c.idDestino = a.Id_Area where c.idDestino = :idArea and c.estatus IN (1,2)';
			$qryInvitados = 'SELECT 
								COUNT(*) AS total,
								SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
								SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 1 THEN 1 ELSE 0 END) AS so,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 2 THEN 1 ELSE 0 END) AS co,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 3 THEN 1 ELSE 0 END) AS su,
								SUM(CASE WHEN c.estatus IN ('.$estatus.') AND c.tipo = 4 THEN 1 ELSE 0 END) AS pr,
								a.Nombre
							from k_conversacion c '.$ejeAux.' inner join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea and ca.orden >= 3 and ca.estatus = 1 LEFT JOIN c_area a ON ca.idArea = a.Id_Area where c.estatus < 3';

			$consulta = $base -> prepare($qryRecibidos);
			if($consulta -> execute([
				':idArea' => $datos['idArea']
			])) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='recibido') {
						$ind->setSolicitud($row['so']);
						$ind->setSugerencia($row['su']);
						$ind->setConocimiento($row['co']);
						$ind->setProblematica($row['pr']);
						$ind->setNombreArea($row['Nombre']);
					}
					$ind->setRecibidos($row['total']);
					$ind->setNoAtendido1($row['na']);
					$ind->setConversacion1($row['con']);
					
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryEnviados);
			if($consulta -> execute([
				':idArea' => $datos['idArea']
			])) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='enviado') {
						$ind->setSolicitud($row['so']);
						$ind->setSugerencia($row['su']);
						$ind->setConocimiento($row['co']);
						$ind->setProblematica($row['pr']);
						$ind->setNombreArea($row['Nombre']);
					}
					$ind->setEnviados($row['total']);
					$ind->setNoAtendido3($row['na']);
					$ind->setConversacion3($row['con']);
					
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryInvitados);
			if($consulta -> execute([
				':idArea' => $datos['idArea']
			])) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='invitado') {
						$ind->setSolicitud($row['so']);
						$ind->setSugerencia($row['su']);
						$ind->setConocimiento($row['co']);
						$ind->setProblematica($row['pr']);
						$ind->setNombreArea($row['Nombre']);
					}
					$ind->setInvitados($row['total']);
					$ind->setNoAtendido2($row['na']);
					$ind->setConversacion2($row['con']);
					
				}
			} else {
				echo 'Error';
			}
			
			return $ind;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getIndicadoresEje($datos) {
		try {
			$ind = new Indicador();
			$ind -> setRecibidos('0');
			$ind -> setEnviados('0');
			$ind -> setInvitados('0');
			$ind -> setSolicitud('0');
			$ind -> setSugerencia('0');
			$ind -> setConocimiento('0');
			$ind -> setProblematica('0');
			$base = $this -> db -> connect();
			$qryEnviados= '
			SELECT c.tipo, count(*) as total1, (select count(*) from k_conversacion c2 INNER JOIN k_conversacionActividad act2 ON c2.idConversacion = act2.idConversacion and act2.idEje = :idEje where c2.idOrigen = :idArea and c2.estatus in (1,2)) as total2 
			from k_conversacion c INNER JOIN k_conversacionActividad act ON c.idConversacion = act.idConversacion AND act.idEje = :idEje2 
			where c.idOrigen = :idArea2 and c.estatus in (1,2)  group by c.tipo
			';
			$qryRecibidos = 'select c.tipo, count(*) as total1, (select count(*) from k_conversacion c2 INNER JOIN k_conversacionActividad act2 ON c2.idConversacion = act2.idConversacion and act2.idEje = :idEje where c2.idDestino = :idArea and c2.estatus in (1,2)) as total2 from k_conversacion c INNER JOIN k_conversacionActividad act ON c.idConversacion = act.idConversacion and act.idEje = :idEje2 where c.idDestino = :idArea2 and c.estatus in (1,2) group by c.tipo';
			$qryInvitados = 'select c.tipo, count(*) as total1, (select count(*) from k_conversacion c2 INNER JOIN k_conversacionActividad act2 ON c2.idConversacion = act2.idConversacion and act2.idEje = :idEje INNER JOIN k_conversacionArea ca2 on c2.idConversacion = ca2.idConversacion and ca2.estatus = 1 where ca2.idArea = :idArea and ca2.orden >= 3 and c2.estatus in (1,2)) as total2 from k_conversacion c INNER JOIN k_conversacionActividad act ON c.idConversacion = act.idConversacion and act.idEje = :idEje2 INNER join k_conversacionArea ca on c.idConversacion = ca.idConversacion AND ca.idArea = :idArea2 and ca.orden >= 3 and ca.estatus = 1 where c.estatus in (1,2) group by c.tipo';
			$condiciones = [
				':idArea' => $datos['idArea'],
				':idArea2' => $datos['idArea'],
				':idEje' => $datos['idEje'],
				':idEje2' => $datos['idEje']
			];
			$consulta = $base -> prepare($qryRecibidos);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='recibido') {
						if($row['tipo']=='1') {
						$ind->setSolicitud($row['total1']);
						} else if($row['tipo']=='2') {
							$ind->setSugerencia($row['total1']);
						} else if($row['tipo']=='3') {
							$ind->setConocimiento($row['total1']);
						} else if($row['tipo']=='4') {
							$ind->setProblematica($row['total1']);
						}
					}
					$ind->setRecibidos($row['total2']);
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryEnviados);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='enviado') {
						if($row['tipo']=='1') {
						$ind->setSolicitud($row['total1']);
						} else if($row['tipo']=='2') {
							$ind->setSugerencia($row['total1']);
						} else if($row['tipo']=='3') {
							$ind->setConocimiento($row['total1']);
						} else if($row['tipo']=='4') {
							$ind->setProblematica($row['total1']);
						}
					}
					$ind->setEnviados($row['total2']);
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryInvitados);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='invitado') {
						if($row['tipo']=='1') {
						$ind->setSolicitud($row['total1']);
						} else if($row['tipo']=='2') {
							$ind->setSugerencia($row['total1']);
						} else if($row['tipo']=='3') {
							$ind->setConocimiento($row['total1']);
						} else if($row['tipo']=='4') {
							$ind->setProblematica($row['total1']);
						}
					}
					$ind->setInvitados($row['total2']);
				}
			} else {
				echo 'Error';
			}
			
			return $ind;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getIndicadoresResueltos($datos) {
		try {
			/*$ejeTexto = '';
			if($datos['idEje'] != 0 || $datos['idEje'] != null) {
				$ejeTexto = 'and act.idEje = :idEje';
			}*/
			$ind = new Indicador();
			$ind -> setRecibidos('0');
			$ind -> setEnviados('0');
			$ind -> setInvitados('0');
			$ind -> setSolicitud('0');
			$ind -> setSugerencia('0');
			$ind -> setConocimiento('0');
			$ind -> setProblematica('0');

			$ejeAux = "";
			if($datos['idEje']!='0') {
				$ejeAux = 'INNER JOIN k_conversacionActividad act ON c.idConversacion = act.idConversacion AND act.idEje = '.$datos['idEje'];
			} 

			$base = $this -> db -> connect();
			$qryEnviados = '
				SELECT 
					COUNT(*) AS total,
					SUM(CASE WHEN c.tipo = 1 THEN 1 ELSE 0 END) AS so,
					SUM(CASE WHEN c.tipo = 2 THEN 1 ELSE 0 END) AS co,
					SUM(CASE WHEN c.tipo = 3 THEN 1 ELSE 0 END) AS su,
					SUM(CASE WHEN c.tipo = 4 THEN 1 ELSE 0 END) AS pr,
					a.Nombre
				FROM k_conversacion c '.$ejeAux.' LEFT JOIN c_area a ON c.idOrigen = a.Id_Area 
				WHERE c.idOrigen = :idArea and c.estatus in (3,4) ';
			$qryRecibidos = '
				SELECT 
					COUNT(*) AS total,
					SUM(CASE WHEN c.tipo = 1 THEN 1 ELSE 0 END) AS so,
					SUM(CASE WHEN c.tipo = 2 THEN 1 ELSE 0 END) AS co,
					SUM(CASE WHEN c.tipo = 3 THEN 1 ELSE 0 END) AS su,
					SUM(CASE WHEN c.tipo = 4 THEN 1 ELSE 0 END) AS pr,
					a.Nombre
				FROM k_conversacion c '.$ejeAux.' LEFT JOIN c_area a ON c.idOrigen = a.Id_Area 
				WHERE c.idDestino = :idArea and c.estatus in (3,4) ';
				
			$qryInvitados = '
				SELECT 
					COUNT(*) AS total,
					SUM(CASE WHEN c.tipo = 1 THEN 1 ELSE 0 END) AS so,
					SUM(CASE WHEN c.tipo = 2 THEN 1 ELSE 0 END) AS co,
					SUM(CASE WHEN c.tipo = 3 THEN 1 ELSE 0 END) AS su,
					SUM(CASE WHEN c.tipo = 4 THEN 1 ELSE 0 END) AS pr,
					a.Nombre
				FROM k_conversacion c '.$ejeAux.' INNER JOIN k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea and ca.orden >= 3 and ca.estatus = 1 LEFT JOIN c_area a ON ca.idArea = a.Id_Area 
				WHERE c.estatus in (3,4) ';
			$condiciones = [
				':idArea' => $datos['idArea']
			];
			/*if($datos['idEje'] != 0 || $datos['idEje'] != null) {
				array_push($condiciones,[':idEje' => $datos['idEje']]);
			}*/
			$consulta = $base -> prepare($qryRecibidos);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='recibido') {
						$ind->setSolicitud($row['so']);
						$ind->setSugerencia($row['su']);
						$ind->setConocimiento($row['co']);
						$ind->setProblematica($row['pr']);
						$ind->setNombreArea($row['Nombre']);
					}
					$ind->setRecibidos($row['total']);
					$ind->setNoAtendido1('-');
					$ind->setConversacion1('-');
					
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryEnviados);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='enviado') {
						$ind->setSolicitud($row['so']);
						$ind->setSugerencia($row['su']);
						$ind->setConocimiento($row['co']);
						$ind->setProblematica($row['pr']);
						$ind->setNombreArea($row['Nombre']);
					}
					$ind->setEnviados($row['total']);
					$ind->setNoAtendido3('-');
					$ind->setConversacion3('-');
					
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryInvitados);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($datos['opcion']=='invitado') {
						$ind->setSolicitud($row['so']);
						$ind->setSugerencia($row['su']);
						$ind->setConocimiento($row['co']);
						$ind->setProblematica($row['pr']);
						$ind->setNombreArea($row['Nombre']);
					}
					$ind->setInvitados($row['total']);
					$ind->setNoAtendido2('-');
					$ind->setConversacion2('-');
					
				}
			} else {
				echo 'Error';
			}
			
			return $ind;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getIndicadoresEjeLateral($datos) {
		try {
			$ind = [];
			$tNa=0;
			$tCon=0;
			$tRes=0;
			$base = $this -> db -> connect();
			//$qryRecibidos = 'select act.idEje, c.estatus, count(*) as total from k_conversacion c left join k_conversacionActividad act on c.idConversacion = act.idConversacion where c.idOrigen = :idArea and c.estatus in (1,2) group by act.idEje, c.estatus order by act.idEje, c.estatus';
			$qry = "";
			if($datos['opcion']=='recibido') {
				$qry = '
				SELECT 
					e.idEje,
					SUM(CASE WHEN c.estatus IN (1,2,3,4) THEN 1 ELSE 0 END) AS total,
					SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
					SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
					SUM(CASE WHEN c.estatus in (3,4) THEN 1 ELSE 0 END) AS res
				FROM c_eje e LEFT JOIN  k_conversacionActividad act ON e.idEje = act.idEje LEFT JOIN k_conversacion c  ON c.idConversacion = act.idConversacion and c.idDestino = :idArea 
				group by e.idEje order BY e.idEje';
			} else if ($datos['opcion']=='enviado'){
				$qry = '
				SELECT 
					e.idEje,
					SUM(CASE WHEN c.estatus IN (1,2,3,4) THEN 1 ELSE 0 END) AS total,
					SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
					SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
					SUM(CASE WHEN c.estatus in (3,4) THEN 1 ELSE 0 END) AS res
				FROM c_eje e LEFT JOIN  k_conversacionActividad act ON e.idEje = act.idEje LEFT JOIN k_conversacion c  ON c.idConversacion = act.idConversacion and c.idOrigen = :idArea 
				group by e.idEje order BY e.idEje';
			} else if($datos['opcion']=='invitado') {
				$qry = '
				SELECT 
					e.idEje,
					SUM(CASE WHEN c.estatus IN (1,2,3,4) THEN 1 ELSE 0 END) AS total,
					SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
					SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
					SUM(CASE WHEN c.estatus in (3,4) THEN 1 ELSE 0 END) AS res
				FROM c_eje e LEFT JOIN  k_conversacionActividad act ON e.idEje = act.idEje LEFT JOIN k_conversacion c  ON c.idConversacion = act.idConversacion LEFT join k_conversacionArea ca on c.idConversacion = ca.idConversacion and ca.idArea = :idArea and ca.orden >= 3 and ca.estatus = 1 
				group by e.idEje order BY e.idEje';
			}

			$consulta = $base -> prepare($qry);
			if($consulta -> execute([
				':idArea' => $datos['idArea']
			])) {
				while($row = $consulta->fetch()) {
					$i = new IndicadorEje();
					$i->setEje($row['idEje']);
					$i->setTotal($row['total']);
					$i->setNoatendidos($row['na']);
					$i->setConversacion($row['con']);
					$i->setResueltos($row['res']);
					$tNa += $row['na'];
					$tCon += $row['con'];
					$tRes += $row['res'];
					array_push($ind,$i);
				}
			} else {
				echo 'Error';
			}
			$i = new IndicadorEje();
			$i->setEje('0');
			$i->setTotal('0');
			$i->setNoatendidos($tNa);
			$i->setConversacion($tCon);
			$i->setResueltos($tRes);
			array_push($ind,$i);
			return $ind;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getIndicadorPortada($datos) {
		try {
			$ind = new Indicador();
			$ind -> setRecibidos('0');
			$ind -> setEnviados('0');
			$ind -> setInvitados('0');
			$ind -> setRecibidosC('0');
			$ind -> setEnviadosC('0');
			$ind -> setInvitadosC('0');
			$ind -> setRecibidosR('0');
			$ind -> setEnviadosR('0');
			$ind -> setInvitadosR('0');
			$ind -> setRecibidosT('0');
			$ind -> setEnviadosT('0');
			$base = $this -> db -> connect();
			$qryEnviados= 'select c.estatus, count(*) as total1 from k_conversacion c where c.idOrigen = :idArea group by c.estatus';
			$qryRecibidos = 'select c.estatus, count(*) as total1 from k_conversacion c where c.idDestino = :idArea group by c.estatus';
			$qryInvitados = 'select c.estatus, count(*) as total1 from k_conversacion c INNER join k_conversacionArea ca on c.idConversacion = ca.idConversacion AND ca.idArea = :idArea and ca.orden >= 3 and ca.estatus = 1 group by c.estatus';
			$condiciones = [
				':idArea' => $datos['idArea']
			];
			$consulta = $base -> prepare($qryRecibidos);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($row['estatus']=='1') {
						$ind->setRecibidos($row['total1']);
					} else if($row['estatus']=='2') {
						$ind->setRecibidosC($row['total1']);
					} else if($row['estatus']=='3' || $row['estatus']=='4') {
						$ind->setRecibidosR($ind->getRecibidosR()+$row['total1']);
					}
					$ind->setRecibidosT($ind->getRecibidosT()+$row['total1']); 
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryEnviados);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($row['estatus']=='1') {
						$ind->setEnviados($row['total1']);
					} else if($row['estatus']=='2') {
						$ind->setEnviadosC($row['total1']);
					} else if($row['estatus']=='3' || $row['estatus']=='4') {
						$ind->setEnviadosR($ind->getEnviadosR()+$row['total1']);
					}
					$ind->setEnviadosT($ind->getEnviadosT()+$row['total1']); 
				}
			} else {
				echo 'Error';
			}

			$consulta = $base -> prepare($qryInvitados);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					if($row['estatus']=='1') {
						$ind->setInvitados($row['total1']);
					} else if($row['estatus']=='2') {
						$ind->setInvitadosC($row['total1']);
					} else if($row['estatus']=='3' || $row['estatus']=='4') {
						$ind->setInvitadosR($ind->getInvitadosR()+$row['total1']);
					}
					$ind->setRecibidosT($ind->getRecibidosT()+$row['total1']); 
				}
			} else {
				echo 'Error';
			}
			
			return $ind;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
			
}

?>