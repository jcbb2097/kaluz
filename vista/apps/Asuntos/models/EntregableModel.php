<?php
//include_once __DIR__."libs/model.php";
//include_once __DIR__."/ConexionPDO.php";

class EntregableModel extends Model {

	public	function __construct() {
		parent::__construct();
	}

	public function getEntregables($datos) {
		try {
			$entregables = [];
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consultaE = '';
			$consulta = $base -> prepare('SELECT * FROM c_entregableEspecifico ee WHERE ee.IdEntregEspecifico = :idEntregable');
			if($consulta -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {
				$idEnt = '';
				$idExposicion = '';
				$idIntervalo = '';
				$opciones = [];
				while($row = $consulta->fetch()) {
					$idEnt = $row['IdEntregable'];
					$idExposicion = $row['idExp'];
					$idIntervalo = $row['idIntervalo'];
				}
				$consultaAux = '';
				$opciones = [];
				if($idExposicion != null || $idExposicion != 0) {
					$consultaAux = ' AND ee.idExp = :idExposicion';
					$opciones = [
						':idEntregable' => $idEnt,
						':idExposicion' => $idExposicion
					];
				} else {
					$consultaAux = ' AND ee.idIntervalo = :idIntervalo';
					$opciones = [
						':idEntregable' => $idEnt,
						':idIntervalo' => $idIntervalo
					];
				}

				$consultaE = '
				SELECT COUNT(*) AS num, ee.IdEntregEspecifico, e.IdEntregable, e.Nombre, ee.Descripcion, ee.avance, ex.tituloTrabajo as expint, i.descripcion as expint2, ee.FechaPlaneadaPreliminar, ee.FechaPlaneadaFinal, ee.FechaRealPreliminar, ee.FechaRealFinal, a.Id_Area as idArea, a.Nombre as area, p.Nombre AS nombreP, p.Apellido_Paterno AS apellido, ej.Nombre as eje, ej.orden AS o0, act4.Orden AS o4, act3.Orden AS o3, act2.Orden AS o2, act1.Orden AS o1, act4.Nombre as actividad, d.pdf, d.ruta, v.IdArchivoPreliminar, d2.pdf as pdf2, d2.descripcion as nombreEnt, d2.ruta as ruta2 
				FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_exposicionTemporal ex ON ee.idExp = ex.idExposicion LEFT JOIN c_intervalo i ON ee.idIntervalo =  i.idIntervalo LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento 
				LEFT JOIN k_entregableEspecifVersion v ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN  c_documento d2 ON v.IdArchivoPreliminar = d2.id_documento
				WHERE ee.IdEntregable = :idEntregable'.$consultaAux.' GROUP BY ee.IdEntregEspecifico';
				

				$consulta2 = $base -> prepare($consultaE);
				if($consulta2 -> execute($opciones)) {
					while($row2 = $consulta2->fetch()) {
						$ent = new Entregable();
						$ent->setChk('0/0');
						$qry3 = 'SELECT 
								    SUM(IF(ce.Valor = 1, 1, 0)) AS completo,
								    SUM(IF(ce.Valor >= 0, 1, 0)) AS total
								FROM k_entregableEspecifCheckList ce where ce.IdEntregEspecif = :entregable2';
						$opciones2 = [
							':entregable2' => $row2['IdEntregEspecifico']
						];
						$consulta3 = $base -> prepare($qry3);
						if($consulta3 -> execute($opciones2)) {
							while($row3 = $consulta3->fetch()) {
								if($row3['total']!=null)
								$ent->setChk($row3['completo'].'/'.$row3['total']);
							}
						}

						$ent->setIdEntregable($row2['IdEntregEspecifico']);
						$ent->setIdEntregableG($row2['IdEntregable']);
						$ent->setEntregableG($row2['Nombre']);
						$ent->setDescripcion($row2['Descripcion']);
						if($row2['expint']!=null) {
							$ent->setExpInt($row2['expint']);	
						} else if($row2['expint2']!=null) {
							$ent->setExpInt($row2['expint2']);	
						} else {
							$ent->setExpInt('');
						}
						$ent->setActividad($row2['actividad']);
						if($row2['o1']!=null) {
							$ent->setOrdenA($row2['o0'].'.'.$row2['o1'].'.'.$row2['o2'].'.'.$row2['o3'].'.'.$row2['o4']);
						} else if($row2['o2']!=null) {
							$ent->setOrdenA($row2['o0'].'.'.$row2['o2'].'.'.$row2['o3'].'.'.$row2['o4']);
						} else if($row2['o3']!=null) {
							$ent->setOrdenA($row2['o0'].'.'.$row2['o3'].'.'.$row2['o4']);
						} else if($row2['o4']!=null) {
							$ent->setOrdenA($row2['o0'].'.'.$row2['o4']);
						}
						$ent->setFechaInicioEstimada($row2['FechaPlaneadaPreliminar']);
						$ent->setFechaInicioReal($row2['FechaRealPreliminar']);
						$ent->setFechaFinEstimada($row2['FechaPlaneadaFinal']);
						$ent->setFechaFinReal($row2['FechaRealFinal']);
						$ent->setResponsable($row2['nombreP'].' '.$row2['apellido']);
						$ent->setIdArea($row2['idArea']);
						$ent->setArea($row2['area']);
						$ent->setProgreso($row2['avance']);
						//$ent->setRuta($row2['pdf']);
						$ent->setTipo($row2['o0'].'. '.$row2['eje']);
						
						if($row2['pdf2'] != null) {
							$ent->setVersiones('pre');
							if($row2['num'] > 1)
								$ent->setVersiones('proceso');
						}

						if($row2['pdf']=='link') {
							$ent->setRuta($row2['ruta']);
							$ent->setTipo('link');
							$ent->setVersiones('final');
						} else if($row2['pdf']!=null) {
							$ent->setRuta($row2['ruta'].$row2['pdf']);
							$ent->setTipo('archivo');
							$ent->setVersiones('final');
						} else if($row2['pdf2']=='link'){
							$ent->setRuta($row2['ruta2']);
							$ent->setTipo('link');
						} else if($row2['pdf2']!=null){
							$ent->setRuta($row2['ruta2'].$row2['pdf2']);
							$ent->setTipo('archivo');
						} else {
							$ent->setVersiones('no');
						}

						
						array_push($entregables,$ent);
					}
					echo '';
					return $entregables;
				}
				
			} else {
				echo 'Error al consultar entregable';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getInsumos($datos) {
		try {
			$entregables = [];
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('
				SELECT COUNT(*) AS num, ee.IdEntregEspecifico, e.IdEntregable, e.Nombre, ee.Descripcion, ex.tituloTrabajo AS expo, i.descripcion AS intervalo, ee.avance ,ee.FechaPlaneadaPreliminar, ee.FechaPlaneadaFinal, ee.FechaRealPreliminar, ee.FechaRealFinal, ee.estatus, a.Id_Area as idArea, a.Nombre as area, p.Nombre AS nombreP, p.Apellido_Paterno AS apellido, ej.orden AS o0, act4.Orden AS o4, act3.Orden AS o3, act2.Orden AS o2, act1.Orden AS o1, act4.IdActividad, act4.Nombre as actividad, d.pdf, d.ruta, v.IdArchivoPreliminar, d2.pdf as pdf2, d2.descripcion as nombreEnt, d2.ruta as ruta2	 
				FROM k_insumo ins INNER JOIN c_entregableEspecifico ee ON ins.idInsumo = ee.IdEntregEspecifico INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_exposicionTemporal ex ON ee.idExp = ex.idExposicion  LEFT JOIN c_intervalo i ON ee.idIntervalo =  i.idIntervalo LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento 
				LEFT JOIN k_entregableEspecifVersion v ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN  c_documento d2 ON v.IdArchivoPreliminar = d2.id_documento
				WHERE ins.idEntregable = :idEntregable GROUP BY ee.IdEntregEspecifico');
			if($consulta -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {
				while($row = $consulta->fetch()) {
					$ent = new Entregable();
					$ent->setInsumos('0/0');
					$ent->setChk('0/0');
					$qry2 = 'SELECT 
							    SUM(IF(ee.avance = 100, 1, 0)) AS completo,
							    SUM(IF(ee.avance <= 100, 1, 0)) AS total
							FROM k_insumo ins INNER JOIN c_entregableEspecifico ee ON ins.idInsumo = ee.IdEntregEspecifico
							WHERE ins.idEntregable = :entregable2';
					$qry3 = 'SELECT 
							    SUM(IF(ce.Valor = 1, 1, 0)) AS completo,
								SUM(IF(ce.Valor >= 0, 1, 0)) AS total
							FROM k_entregableEspecifCheckList ce where ce.IdEntregEspecif = :entregable2';
					$opciones = [
						':entregable2' => $row['IdEntregEspecifico']
					];

					$consulta2 = $base -> prepare($qry2);
					if($consulta2 -> execute($opciones)) {
						while($row2 = $consulta2->fetch()) {
							if($row2['total']!=null)
							$ent->setInsumos($row2['completo'].'/'.$row2['total']);
						}
					}
					$consulta2 = $base -> prepare($qry3);
					if($consulta2 -> execute($opciones)) {
						while($row2 = $consulta2->fetch()) {
							if($row2['total']!=null)
							$ent->setChk($row2['completo'].'/'.$row2['total']);
						}
					}
					
					$ent->setIdEntregable($row['IdEntregEspecifico']);
					$ent->setDescripcion($row['Descripcion']);
					if($row['expo'] != null) {
						$ent->setExpInt($row['expo']);
					} else {
						$ent->setExpInt($row['intervalo']);
					}
					if($row['o1']!=null) {
						$ent->setOrdenA($row['o0'].'.'.$row['o1'].'.'.$row['o2'].'.'.$row['o3'].'.'.$row['o4']);
					} else if($row['o2']!=null) {
						$ent->setOrdenA($row['o0'].'.'.$row['o2'].'.'.$row['o3'].'.'.$row['o4']);
					} else if($row['o3']!=null) {
						$ent->setOrdenA($row['o0'].'.'.$row['o3'].'.'.$row['o4']);
					} else if($row['o4']!=null) {
						$ent->setOrdenA($row['o0'].'.'.$row['o4']);
					}
					$ent->setFechaInicioEstimada($row['FechaPlaneadaPreliminar']);
					$ent->setFechaInicioReal($row['FechaRealPreliminar']);
					$ent->setFechaFinEstimada($row['FechaPlaneadaFinal']);
					$ent->setFechaFinReal($row['FechaRealFinal']);
					$ent->setResponsable($row['nombreP'].' '.$row['apellido']);
					$ent->setIdArea($row['idArea']);
					$ent->setArea($row['area']);
					$ent->setProgreso($row['avance']);
					$ent->setIdActividad($row['IdActividad']);
					$ent->setActividad($row['actividad']);
					$ent->setEstatus($row['estatus']);
					
					if($row['pdf2'] != null) {
						$ent->setVersiones('pre');
						if($row['num'] > 1)
							$ent->setVersiones('proceso');
					}

					if($row['pdf']=='link') {
						$ent->setRuta($row['ruta']);
						$ent->setTipo('link');
						$ent->setVersiones('final');
					} else if($row['pdf']!=null) {
						$ent->setRuta($row['ruta'].$row['pdf']);
						$ent->setTipo('archivo');
						$ent->setVersiones('final');
					} else if($row['pdf2']=='link'){
						$ent->setRuta($row['ruta2']);
						$ent->setTipo('link');
					} else if($row['pdf2']!=null){
						$ent->setRuta($row['ruta2'].$row['pdf2']);
						$ent->setTipo('archivo');
					} else {
						$ent->setVersiones('no');
					}


					array_push($entregables,$ent);
				}
				echo '';
				return $entregables;
			} else {
				echo 'Error al consultar entregable';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getChks($datos) {
		try {
			$chks = [];
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = $base -> prepare('select ck.IdCheckList as idCheck, ck.Nombre, ce.Valor, ce.FechaValor, ce.UsrValor from k_entregableEspecifCheckList ce inner join c_checkList ck on ce.IdCheckList = ck.IdCheckList where ce.IdEntregEspecif = :idEntregable');
			if($consulta -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {
				while($row = $consulta->fetch()) {
					$ck = new Check();
					$ck->setIdCheck($row['idCheck']);
					$ck->setNombre($row['Nombre']);
					$ck->setValor($row['Valor']);
					$ck->setFecha($row['FechaValor']);
					$ck->setUsrValor($row['UsrValor']);
					array_push($chks,$ck);
				}
				echo '';
				return $chks;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getCategorias($datos) {
		try {
			$cats = [];
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = '';
			if($datos['tipoE'] == '1'){
				$consulta = $base -> prepare('SELECT COUNT(*) AS total, ee.idIntervalo AS idExp, i.descripcion AS tituloTrabajo, e.Nombre, ee.IdEntregEspecifico FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable INNER JOIN c_intervalo i ON ee.idIntervalo = i.idIntervalo WHERE e.idActividad = :idActividad GROUP BY ee.idIntervalo');
			} else {
				$consulta = $base -> prepare('SELECT COUNT(*) AS total, ee.idExp, ex.tituloTrabajo, e.Nombre, ee.IdEntregEspecifico FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable INNER JOIN c_exposicionTemporal ex ON ee.idExp = ex.idExposicion WHERE e.idActividad = :idActividad GROUP BY ee.idExp');
			}
			
			if($consulta -> execute([
				':idActividad' => $datos['idActividad']
			])) {
				while($row = $consulta->fetch()) {
					$item = new Exposicion();
					$item->setAux($row['total']);
					$item->setIdExposicion($row['idExp']);
					$item->setTitulo($row['tituloTrabajo']);
					$item->setAnio($row['Nombre']);
					$item->setFechaInicio($row['IdEntregEspecifico']);
					array_push($cats,$item);
				}
				return $cats;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getEspecifico($datos) {
		try {
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = '';
			$pre=0;
			$pro=0;
			$final=0;
			$nombre='';
			$avance=0;
			$total=0;
			$cero=0;
			$idEntregable=0;
			$consulta = $base -> prepare('
					SELECT 
						COUNT(*) AS total, ee.IdEntregEspecifico, ee.idExp, e.Nombre, d.pdf, v.IdArchivoPreliminar, d2.pdf as pdf2, d2.descripcion as entN, d2.ruta
					FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable and ee.idExp = :idExpo LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento LEFT JOIN k_entregableEspecifVersion v ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN  c_documento d2 ON v.IdArchivoPreliminar = d2.id_documento
					WHERE e.idActividad = :idActividad group by ee.IdEntregEspecifico
				');
			
			if($consulta -> execute([
				':idActividad' => $datos['idActividad'],
				':idExpo' => $datos['idExpo']
			])) {
				
				while($row = $consulta->fetch()) {
					$nombre = $row['Nombre'];
					if($idEntregable==0)
						$idEntregable = $row['IdEntregEspecifico'];
					if(!isset($row['pdf']) && isset($row['pdf2']) && $row['total'] == 1) {
						$pre++;
						$avance += 33;
					} else if(!isset($row['pdf']) && isset($row['pdf2']) && $row['total'] > 1) {
						$pro++;
						$avance += 66;
					} else if(isset($row['pdf'])) {
						$final++;
						$avance += 100;
					} else {
						$cero++;
					}
					$total++;
				}
				$item = new Exposicion();
				$item->setTitulo($nombre);
				$item->setAux($total);
				$item->setAnio($final);
				$item->setIdExposicion($pre);
				$item->setAux2($pro);
				$item->setAux3($cero);
				$item->setAux4($idEntregable);
				$item->setFechaInicio($avance);

				return $item;
							
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getEspecificoNoTemporal($datos) {
		try {
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = '';
			$pre=0;
			$pro=0;
			$final=0;
			$nombre='';
			$avance=0;
			$total=0;
			$cero=0;
			$idEntregable=0;
			$consulta = $base -> prepare('
					SELECT 
						COUNT(*) AS total, ee.IdEntregEspecifico, e.Nombre, d.pdf, v.IdArchivoPreliminar, d2.pdf as pdf2, d2.descripcion as entN, d2.ruta
					FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_intervalo i ON ee.idIntervalo = i.idIntervalo LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento LEFT JOIN k_entregableEspecifVersion v ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN  c_documento d2 ON v.IdArchivoPreliminar = d2.id_documento
					WHERE e.idActividad = :idActividad group by ee.IdEntregEspecifico
				');
			if($consulta -> execute([
				':idActividad' => $datos['idActividad']
			])) {
				
				while($row = $consulta->fetch()) {
					$nombre = $row['Nombre'];
					if($idEntregable==0)
						$idEntregable = $row['IdEntregEspecifico'];
					if(!isset($row['pdf']) && isset($row['pdf2']) && $row['total'] == 1) {
						$pre++;
						$avance += 33;
					} else if(!isset($row['pdf']) && isset($row['pdf2']) && $row['total'] > 1) {
						$pro++;
						$avance += 66;
					} else if(isset($row['pdf'])) {
						$final++;
						$avance += 100;
					} else {
						$cero++;
					}
					$total++;
					
				}
				$item = new Exposicion();
				$item->setTitulo($nombre);
				$item->setAux($total);
				$item->setAnio($final);
				$item->setIdExposicion($pre);
				$item->setAux2($pro);
				$item->setAux3($cero);
				$item->setAux4($idEntregable);
				$item->setFechaInicio($avance);

				return $item;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getGeneral($datos) {
		try {
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = '';

			$consulta = $base -> prepare('
					SELECT 
						e.Nombre
					FROM c_entregable e
					WHERE e.idActividad = :idActividad
				');
			
			if($consulta -> execute([
				':idActividad' => $datos['idActividad']
			])) {
				$item = new Exposicion();
				while($row = $consulta->fetch()) {
					$item->setTitulo($row['Nombre']);
					//terminar a la primera iteración
					return $item;
				}
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getDetalleGeneralEntregable($datos) {
		try {
			$indicador = [];
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta0 = '';
			$consulta0 = $base -> prepare('SELECT ee.IdEntregable, ee.idExp, ee.idIntervalo FROM c_entregableEspecifico ee WHERE ee.IdEntregEspecifico = :idEntregable');
			if($consulta0 -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {
				$idEnt = '';
				$idExp = '';
				$idInt = '';
				while($row = $consulta0->fetch()) {
					$idEnt = $row['IdEntregable'];
					$idExp = isset($row['idExp']) ? $row['idExp'] : '0';
					$idInt = isset($row['idIntervalo']) ? $row['idIntervalo'] : '0';
				}
				if($idEnt != '') {
					$consulta = '';
					$aux = '';
					if($datos['tipoE'] == '1') {
						$aux = ' AND ee.idIntervalo = '.$idInt;	
					} else {
						$aux = ' AND ee.idExp = '.$idExp;
					}
					$pre=0;
					$pro=0;
					$final=0;
					$nombre='';
					$avance=0;
					$total=0;
					$cero=0;
					$idEntregable=0;
					$query = '
					SELECT 
						COUNT(*) AS total, ee.IdEntregEspecifico, ee.idExp, ex.tituloTrabajo, e.Nombre, 
						ex.tituloTrabajo as expint, i.descripcion as expint2, d.pdf, v.IdArchivoPreliminar, d2.pdf as pdf2, d2.descripcion as entN, d2.ruta
					FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_exposicionTemporal ex ON ee.idExp = ex.idExposicion LEFT JOIN c_intervalo i ON ee.idIntervalo =  i.idIntervalo LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento LEFT JOIN k_entregableEspecifVersion v ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN  c_documento d2 ON v.IdArchivoPreliminar = d2.id_documento
					WHERE ee.IdEntregable = :idEntregable'.$aux.' group by ee.IdEntregEspecifico';
					
					$consulta = $base -> prepare($query);

					if($consulta -> execute([
						':idEntregable' => $idEnt
					])) {
						//echo $query;
						while($row2 = $consulta->fetch()) {
							
							$nombre = $row2['Nombre'];
							$idEntregable = $row2['IdEntregEspecifico'];
							if(!isset($row2['pdf']) && isset($row2['pdf2']) && $row2['total'] == 1) {
								$pre++;
								$avance += 33;
							} else if(!isset($row2['pdf']) && isset($row2['pdf2']) && $row2['total'] > 1) {
								$pro++;
								$avance += 66;
							} else if(isset($row2['pdf'])) {
								$final++;
								$avance += 100;
							} else {
								$cero++;
							}
							$total++;
						}
							$item = new Exposicion();
							$item->setTitulo($nombre);
							$item->setAux($total);
							$item->setAnio($final);
							$item->setIdExposicion($pre);
							$item->setAux2($pro);
							$item->setAux3($cero);
							$item->setFechaInicio($avance);
							$item->setAux4($idEntregable);
							array_push($indicador,$item);
						
						return $indicador;
					}
				}
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getDetalleGeneralInsumos($datos) {
		try {
			$indicador = [];
			//$fecha = date('Y-m-d H:i');
			$base = $this -> db -> connect();
			$consulta = '';
			$consulta = $base -> prepare('
				SELECT COUNT(*) AS total, ee.IdEntregEspecifico, e.Nombre, d.pdf, v.IdArchivoPreliminar, d2.pdf as pdf2, d2.descripcion as entN, d2.ruta
				FROM k_insumo ki INNER JOIN c_entregableEspecifico ee ON ki.idInsumo = ee.IdEntregEspecifico LEFT JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento LEFT JOIN k_entregableEspecifVersion v ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN  c_documento d2 ON v.IdArchivoPreliminar = d2.id_documento
				WHERE ki.idEntregable = :idEntregable group by ee.IdEntregEspecifico
			');
			if($consulta -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {

				$pre=0;
				$pro=0;
				$final=0;
				$nombre='';
				$avance=0;
				$total=0;
				$cero=0;
				$idEntregable = 0;
				while($row = $consulta->fetch()) {
					$nombre = $row['Nombre'];
					if($idEntregable==0)
						$idEntregable = $row['IdEntregEspecifico'];
					if(!isset($row['pdf']) && isset($row['pdf2']) && $row['total'] == 1) {
						$pre++;
						$avance += 33;
					} else if(!isset($row['pdf']) && isset($row['pdf2']) && $row['total'] > 1) {
						$pro++;
						$avance += 66;
					} else if(isset($row['pdf'])) {
						$final++;
						$avance += 100;
					} else {
						$cero++;
					}
					$total++;

					
				}
				$item = new Exposicion();
					$item->setTitulo($nombre);
					$item->setAux($total);
					$item->setAnio($final);
					$item->setIdExposicion($pre);
					$item->setAux2($pro);
					$item->setAux3($cero);
					$item->setFechaInicio($avance);
					$item->setAux4($idEntregable);
					array_push($indicador,$item);
				return $indicador;
			}
				
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getDetalleGeneralImpacto($datos) {
		try {
			$idInsumo = null;
			$base = $this -> db -> connect();
			$cons = $base -> prepare('
				SELECT ee.IdEntregable 
				FROM c_entregableEspecifico ee WHERE ee.IdEntregEspecifico = :idEntregable
				');
			if($cons -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {
				while($row = $cons->fetch()) {
					$idInsumo = $row['IdEntregable'];
				}
			}
			if(isset($idInsumo)){
				$indicador = [];
				$consulta = '';
				$consulta = $base -> prepare('
					SELECT count(*) as total ,   ej.idEje as idEje, ej.Nombre, ej.orden
					FROM k_entregableinsumo i INNER JOIN c_entregable e ON i.IdEntregable = e.IdEntregable LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area    
					WHERE i.IdInsumo = :idEntregable group by ej.idEje
				');
				if($consulta -> execute([
					':idEntregable' => $idInsumo
				])) {
					while($row = $consulta->fetch()) {
						$item = new Exposicion();
						$item->setAux($row['total']);
						$item->setAnio($row['idEje']);
						$item->setIdExposicion($row['Nombre']);
						$item->setFechaInicio($row['orden']);
						array_push($indicador,$item);
					}
					return $indicador;
				}
			}
			
				
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getNombre($idActividad){
		try {
			$base = $this -> db -> connect();
			$consulta = '';
			$consulta = $base -> prepare('
				SELECT e.Nombre FROM c_entregable e WHERE e.idActividad = :idActividad
			');
			if($consulta -> execute([
				':idActividad' => $idActividad
			])) {
				$item = '';
				while($row = $consulta->fetch()) {
					$item = $row['Nombre'];
				}
				return $item;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	
}
?>