<?php

class AreaModel extends Model {

	public	function __construct() {
		parent::__construct();
	}
	
	public function getAreas() {
		$areas = [];
		try {
			$consulta = $this->db->connect()->query('select Id_Area, Nombre, tipoArea from c_area where estatus = 1 order by orden asc');
			while($row = $consulta->fetch()) {
				$area = new Area();
				$area->setIdArea($row['Id_Area']);
				$area->setNombre($row['Nombre']);
				$area->setTipo($row['tipoArea']);
				array_push($areas,$area);
			}
			return $areas;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getEjes() {
		$ejes = [];
		try {
			$consulta = $this->db->connect()->query('select idEje, Nombre, orden from c_eje where estatus = 1 order by orden asc');
			while($row = $consulta->fetch()) {
				$eje = new Area();
				$eje->setIdArea($row['idEje']);
				$eje->setOrden($row['orden']);
				$eje->setNombre($row['Nombre']);
				array_push($ejes,$eje);
			}
			return $ejes;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getIndicadoresArea($datos) {
		$areas = [];
		try {
			$base = $this -> db -> connect();
			$cadena = '';
			if($datos['opcion']=='recibido') {
				$cadena = '
				SELECT 
					a.orden, a.Id_Area, a.Nombre, a.tipoArea,
					SUM(CASE WHEN c.estatus IN (1,2,3,4) THEN 1 ELSE 0 END) AS total,
					SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
					SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
					SUM(CASE WHEN c.estatus in (3,4) THEN 1 ELSE 0 END) AS res
				FROM c_area a LEFT JOIN k_conversacion c  ON c.idOrigen = a.Id_Area and c.idDestino = :idArea
				WHERE a.estatus = 1
				group BY a.Id_Area ORDER BY a.orden ASC
				';
			} else if($datos['opcion']=='enviado') {
				$cadena = '
				SELECT 
					a.orden, a.Id_Area, a.Nombre, a.tipoArea,
					SUM(CASE WHEN c.estatus IN (1,2,3,4) THEN 1 ELSE 0 END) AS total,
					SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
					SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
					SUM(CASE WHEN c.estatus in (3,4) THEN 1 ELSE 0 END) AS res
				FROM c_area a LEFT JOIN k_conversacion c  ON c.idDestino = a.Id_Area and c.idOrigen = :idArea
				WHERE a.estatus = 1
				group BY a.Id_Area ORDER BY a.orden ASC
				';
			} else if($datos['opcion']=='invitado') {
				$cadena = '
				SELECT 
					a.orden, a.Id_Area, a.Nombre, a.tipoArea,
					SUM(CASE WHEN c.estatus IN (1,2,3,4) THEN 1 ELSE 0 END) AS total,
					SUM(CASE WHEN c.estatus = 1 THEN 1 ELSE 0 END) AS na,
					SUM(CASE WHEN c.estatus = 2 THEN 1 ELSE 0 END) AS con,
					SUM(CASE WHEN c.estatus in (3,4) THEN 1 ELSE 0 END) AS res
				FROM  k_conversacionArea ca INNER JOIN k_conversacion c on c.idConversacion = ca.idConversacion and ca.idArea = :idArea and ca.orden >= 3 and ca.estatus = 1  
				RIGHT JOIN c_area a ON (c.idOrigen = a.Id_Area OR c.idDestino = a.Id_Area)
				WHERE a.estatus = 1
				group BY a.Id_Area ORDER BY a.orden ASC
				';
			}
			
			$consulta = $base -> prepare($cadena);
			if($consulta -> execute([
				'idArea' => $datos['idArea']
			])) {
				while($row = $consulta->fetch()) {
					$area = new Area();
					$area->setIdArea($row['Id_Area']);
					$area->setNombre($row['Nombre']);
					$area->setTipo($row['tipoArea']);
					$area->setTotal($row['total']);
					$area->setNA($row['na']);
					$area->setCon($row['con']);
					$area->setRes($row['res']);
					array_push($areas,$area);
				}
			}

			return $areas;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>