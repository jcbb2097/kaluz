<?php

class ActividadModel extends Model {

	public	function __construct() {
		parent::__construct();
	}
	
	public function getActividadesEje($datos) {
		$actividades = [];
		try {
			$consulta = $this -> db -> connect() -> prepare("select e.Orden, e.IdActividad, e.Nombre, a.Id_Area as idArea, a.Nombre as area, p.id_Personas as idPersona, p.Nombre AS nombreP, p.Apellido_Paterno AS apellido from c_actividad e left join c_area a on e.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = e.IdResponsable where e.Anio = :anio and e.IdEje = :eje and e.IdNivelActividad = 1 and e.IdTipoActividad = :tipo order by e.Orden");
			if($consulta -> execute([
				':eje' => $datos['eje'],
				':anio' => $datos['anio'],
				':tipo' => $datos['tipo']
			])) { 
				while($row = $consulta->fetch()) {
					$actividad = new Actividad();
					$actividad->setId($row['IdActividad']);
					$actividad->setIdEncargado($row['idPersona']);
					$actividad->setNombre($row['Nombre']);
					$actividad->setIdArea($row['idArea']);
					$actividad->setArea($row['area']);
					$actividad->setEncargado($row['nombreP'].' '.$row['apellido']);
					$actividad->setOrden($datos['orden'].'.'.$row['Orden']);
					array_push($actividades,$actividad);
				}
				return $actividades;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getActividades($datos) {
		$actividades = [];
		try {
			$consulta = $this -> db -> connect() -> prepare("select e.Orden, e.IdActividad, e.Nombre, e.IdActividadSuperior, a.Id_Area as idArea, a.Nombre as area, p.id_Personas as idPersona, p.Nombre AS nombreP, p.Apellido_Paterno AS apellido from c_actividad e left join c_area a on e.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = e.IdResponsable where e.IdActividadSuperior = :superior order by e.Orden");
			$consulta -> bindValue(":superior",$datos['superior'],PDO::PARAM_INT);
			$consulta -> execute();
			while($row = $consulta->fetch()) {
				$actividad = new Actividad();
				$actividad->setId($row['IdActividad']);
				$actividad->setIdEncargado($row['idPersona']);
				$actividad->setNombre($row['Nombre']);
				$actividad->setPadre($row['IdActividadSuperior']);
				$actividad->setIdArea($row['idArea']);
				$actividad->setArea($row['area']);
				$actividad->setEncargado($row['nombreP'].' '.$row['apellido']);
				$actividad->setOrden($datos['orden'].'.'.$row['Orden']);
				array_push($actividades,$actividad);
			}
			return $actividades;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}/*
SELECT ca.idEje, e.Nombre AS eje, e.orden as oe, ca.idGlobal, a1.Nombre AS nombreGlobal, a1.Orden AS gl, ca.idGeneral, a2.Nombre AS nombreGeneral, a2.Orden AS g, ca.idParticular, a3.Nombre AS nombrePart, a3.Orden AS p, ca.idSub, a4.Nombre AS nombreSub, a4.Orden AS s, ca.idEE from k_conversacionActividad ca LEFT JOIN c_eje e ON e.IdEje = ca.idEje LEFT JOIN c_actividad a1 ON ca.idGlobal = a1.IdActividad LEFT JOIN c_actividad a2 ON ca.idGeneral = a2.IdActividad LEFT JOIN c_actividad a3 ON ca.idParticular = a3.IdActividad LEFT JOIN c_actividad a4 ON ca.idSub = a4.IdActividad where ca.idConversacion = :idConversacion*/
	public function getActividad($datos) {
		$actividades = [];
		try {
			$consulta = $this -> db -> connect() -> prepare("
				SELECT 
					SUM(CASE WHEN k.id_archivoactividad IS NOT NULL AND d.id_tipo NOT IN (11,9,14,10) THEN 1 ELSE 0 END) AS totalArchivos, 
					SUM(CASE WHEN k.id_archivoactividad IS NOT NULL AND d.id_tipo = 11 THEN 1 ELSE 0 END) AS totalNorm, ca.idEje, e.Nombre AS eje, e.orden as oe, ca.idGlobal, a1.Nombre AS nombreGlobal, a1.Orden AS gl, ca.idGeneral, a2.Nombre AS nombreGeneral, a2.Orden AS g, ca.idParticular, a3.Nombre AS nombrePart, a3.Orden AS p, ca.idSub, a4.Nombre AS nombreSub, a4.Orden AS s, ca.idEE, k.id_archivoactividad
				FROM k_conversacionActividad ca LEFT JOIN c_eje e ON e.IdEje = ca.idEje LEFT JOIN c_actividad a1 ON ca.idGlobal = a1.IdActividad LEFT JOIN c_actividad a2 ON ca.idGeneral = a2.IdActividad LEFT JOIN c_actividad a3 ON ca.idParticular = a3.IdActividad LEFT JOIN c_actividad a4 ON ca.idSub = a4.IdActividad 
				LEFT JOIN k_archivoactividad k ON (a1.IdActividad = k.id_actividad1 AND k.id_actividad2 IS NULL AND a2.IdActividad IS NULL) OR (a2.IdActividad = k.id_actividad2 AND k.id_actividad3 IS NULL AND a3.IdActividad IS NULL) OR (a3.IdActividad = k.id_actividad3 AND k.id_actividad4 IS NULL AND a4.IdActividad IS NULL) OR (a4.IdActividad = k.id_actividad4)
				LEFT JOIN c_documento d ON d.id_documento = k.id_archivo
				WHERE ca.idConversacion = :idConversacion
			");
			if($consulta -> execute([
				':idConversacion' => $datos['idConversacion']
			])) {
				while($row = $consulta->fetch()) {
					$eje = new Actividad();
					$eje->setId($row['idEje']);
					$eje->setNombre($row['eje']);
					$eje->setOrden($row['oe']);
					$eje->setIdEntregable($row['idEE']);
					$eje->setCompartidos($row['totalArchivos']);
					$eje->setNormatividad($row['totalNorm']);
					array_push($actividades,$eje);

					$act1 = new Actividad();
					$act1->setId($row['idGlobal']);
					$act1->setNombre($row['nombreGlobal']);
					$act1->setOrden($row['gl']);
					array_push($actividades,$act1);

					$act2 = new Actividad();
					$act2->setId($row['idGeneral']);
					$act2->setNombre($row['nombreGeneral']);
					$act2->setOrden($row['g']);
					array_push($actividades,$act2);

					$act3 = new Actividad();
					$act3->setId($row['idParticular']);
					$act3->setNombre($row['nombrePart']);
					$act3->setOrden($row['p']);
					array_push($actividades,$act3);

					$act4 = new Actividad();
					$act4->setId($row['idSub']);
					$act4->setNombre($row['nombreSub']);
					$act4->setOrden($row['s']);
					array_push($actividades,$act4);


					//$actividad->setIdArea($row['idArea']);
					//$actividad->setArea($row['area']);
					//$actividad->setEncargado($row['nombreP'].' '.$row['apellido']);
					
				}

				return $actividades;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	function getActividadEntregable($datos) {
		$actividades = [];
		try {
			$consulta = $this -> db -> connect() -> prepare("SELECT ee.IdEntregEspecifico, ee.idExp, ee.idIntervalo, e.IdEntregable, e.Nombre, ee.Descripcion, a.Id_Area as idArea, a.Nombre as area, p.Nombre AS nombreP, p.Apellido_Paterno AS apellido, ej.orden AS o0, act4.Orden AS o4, act3.Orden AS o3, act2.Orden AS o2, act1.Orden AS o1, ej.idEje, act4.IdActividad AS id4,act4.Nombre AS n4, act3.IdActividad AS id3,act3.Nombre AS n3, act2.IdActividad AS id2,act2.Nombre AS n2, act1.IdActividad AS id1, act1.Nombre AS n1   FROM c_entregableEspecifico ee INNER JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_actividad act4 ON e.idActividad = act4.IdActividad LEFT JOIN c_actividad act3 ON act4.IdActividadSuperior = act3.IdActividad LEFT JOIN c_actividad act2 ON act3.IdActividadSuperior = act2.IdActividad LEFT JOIN c_actividad act1 ON act2.IdActividadSuperior = act1.IdActividad LEFT JOIN c_eje ej ON act4.IdEje = ej.idEje LEFT JOIN c_area a on act4.IdArea = a.Id_Area LEFT JOIN c_personas p ON p.id_Personas = act4.IdResponsable WHERE ee.IdEntregEspecifico = :idEntregable");
			if($consulta -> execute([
				':idEntregable' => $datos['idEntregable']
			])) {
				while($row = $consulta->fetch()) {
					$eje = new Actividad();
						
					if($row['idExp']!=null){
						$eje->setExp($row['idExp']);
					} else if($row['idIntervalo']!=null) {
						$eje->setExp($row['idIntervalo']);
					} else {
						$eje->setExp('0');
					}

					$eje->setId($row['idEje']);
					$eje->setOrden($row['o0']);
					$eje->setIdEntregable($row['Descripcion']);
					$eje->setIdArea($row['idArea']);
					$eje->setArea($row['area']);
					array_push($actividades,$eje);

					$act1 = new Actividad();
					$act1->setId($row['id4']);
					$act1->setNombre($row['n4']);
					$act1->setOrden($row['o4']);
					array_push($actividades,$act1);

					$act2 = new Actividad();
					$act2->setId($row['id3']);
					$act2->setNombre($row['n3']);
					$act2->setOrden($row['o3']);
					array_push($actividades,$act2);

					$act3 = new Actividad();
					$act3->setId($row['id2']);
					$act3->setNombre($row['n2']);
					$act3->setOrden($row['o2']);
					array_push($actividades,$act3);

					$act4 = new Actividad();
					$act4->setId($row['id1']);
					$act4->setNombre($row['n1']);
					$act4->setOrden($row['o1']);
					array_push($actividades,$act4);
				}

				return $actividades;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>