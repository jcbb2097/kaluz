<?php

class ArchivoModel extends Model {

	public	function __construct() {
		parent::__construct();
	}

	public function getVersionesPre($datos) {
		try {
			$versiones = [];
			$condiciones = [];
			$base = $this -> db -> connect();
			$qry = "";
			$qry = "SELECT d.id_documento, ee.IdEntregEspecifico AS idEE, ee.IdEntregable, d.pdf, d.descripcion, d.ruta, d.TipoEntregable, td.tipo, d.fechaCreacion FROM k_entregableEspecifVersion v INNER JOIN c_entregableEspecifico ee ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_documento d ON v.IdArchivoPreliminar = d.id_documento LEFT JOIN c_tipo_documento td ON d.id_tipo = td.id_tipo WHERE ee.IdEntregEspecifico = :IdEntregable and d.TipoEntregable = 1 ORDER BY d.fechaCreacion desc";
			$condiciones = [
			':IdEntregable' => $datos['idEntregable']
			];
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$arc = new Archivo();
					$arc->setIdArchivo($row['id_documento']);
					$arc->setIdEE($row['idEE']);
					$arc->setIdEntregable($row['IdEntregable']);
					if($row['pdf']=='link') {
						$arc->setRuta($row['ruta']);
						$arc->setTipo('link');
					} else {
						$arc->setRuta($row['ruta'].$row['pdf']);
						$arc->setTipo('archivo');
					}
					$arc->setNombre($row['descripcion']);
					$arc->setFecha($row['fechaCreacion']);
					array_push($versiones,$arc);
				}
				echo '';
			} else {
				echo 'Error';
			}
			return $versiones;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getVersionesFinal($datos) { 
		try {
			$versiones = [];
			$condiciones = [];
			$base = $this -> db -> connect();
			$qry = "";
			$qry = "SELECT 
						d.id_documento, ee.IdEntregEspecifico AS idEE, ee.IdEntregable, d.pdf, d.descripcion, d.ruta, d.TipoEntregable, td.tipo, d.fechaCreacion 
					FROM c_entregableEspecifico ee LEFT JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_documento d ON ee.IdArchFinal = d.id_documento LEFT JOIN c_tipo_documento td ON d.id_tipo = td.id_tipo 
					WHERE ee.IdEntregEspecifico = :IdEntregable and d.TipoEntregable = 1  ORDER BY d.fechaCreacion DESC";
			$condiciones = [
			':IdEntregable' => $datos['idEntregable']
			];
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$arc = new Archivo();
					$arc->setIdArchivo($row['id_documento']);
					$arc->setIdEE($row['idEE']);
					$arc->setIdEntregable($row['IdEntregable']);
					if($row['pdf']=='link') {
						$arc->setRuta($row['ruta']);
						$arc->setTipo('link');
					} else {
						$arc->setRuta($row['ruta'].$row['pdf']);
						$arc->setTipo('archivo');
					}
					$arc->setNombre($row['descripcion']);
					$arc->setFecha($row['fechaCreacion']);

					array_push($versiones,$arc);
				}
				echo '';
			} else {
				echo 'Error';
			}
			return $versiones;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getVersionesTipo($datos) { 
		try {
			$versiones = [];
			$condiciones = [];
			$base = $this -> db -> connect();
			$qry = "";
			$qry = "
					SELECT d.id_documento, ee.IdEntregEspecifico AS idEE, ee.IdEntregable, v.TipoEntregable as tv, d.pdf, d.descripcion, d.ruta, d.TipoEntregable, td.tipo, d.fechaCreacion 
					FROM k_entregableEspecifVersion v INNER JOIN c_entregableEspecifico ee ON v.IdEntregableEspecifico = ee.IdEntregEspecifico LEFT JOIN c_entregable e ON ee.IdEntregable = e.IdEntregable LEFT JOIN c_documento d ON v.IdArchivoPreliminar = d.id_documento LEFT JOIN c_tipo_documento td ON d.id_tipo = td.id_tipo 
					WHERE ee.IdEntregEspecifico = :idEntregable  ORDER BY v.TipoEntregable, d.fechaCreacion desc
					";
			$condiciones = [
			':idEntregable' => $datos['idEntregable']
			];
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$arc = new Archivo();
					$arc->setIdArchivo($row['id_documento']);
					$arc->setIdEE($row['idEE']);
					$arc->setIdEntregable($row['IdEntregable']);
					if($row['pdf']=='link') {
						$arc->setRuta($row['ruta']);
						$arc->setTipo('link');
					} else {
						$arc->setRuta($row['ruta'].$row['pdf']);
						$arc->setTipo('archivo');
					}
					$arc->setTipoE($row['tv']);
					$arc->setNombre($row['descripcion']);
					$arc->setFecha($row['fechaCreacion']);

					array_push($versiones,$arc);
				}
				echo '';
			} else {
				echo 'Error';
			}
			return $versiones;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getCompartidos($datos) { 
		try {
			$versiones = [];
			$condiciones = [];
			$base = $this -> db -> connect();
			$qry = "";
			$aux = "";
			if($datos['tipo']=='1') {
				$aux = " d.id_tipo NOT IN (11,9,14,10) AND ";
			} else {
				$aux = " d.id_tipo = 11 AND ";
			}

			$qry = "
					SELECT d.id_documento, d.ruta, d.pdf, d.descripcion, td.id_tipo, td.tipo, d.fechaCreacion, a1.IdActividad AS id1, a1.Nombre AS n1, a2.IdActividad AS id2, a2.Nombre AS n2, a3.IdActividad AS id3, a3.Nombre AS n3, a4.IdActividad AS id4, a2.Nombre AS n4, a1.IdEje AS o0, a1.Orden as o1, a2.Orden AS o2, a3.Orden AS o3, a4.Orden AS o4
					FROM c_documento d INNER JOIN k_archivoactividad k ON d.id_documento = k.id_archivo LEFT JOIN c_tipo_documento td ON d.id_tipo = td.id_tipo
					LEFT JOIN  c_actividad a1 ON a1.IdActividad = k.id_actividad1 LEFT JOIN  c_actividad a2 ON a2.IdActividad = k.id_actividad2 LEFT JOIN  c_actividad a3 ON a3.IdActividad = k.id_actividad3 LEFT JOIN  c_actividad a4 ON a4.IdActividad = k.id_actividad4
					WHERE".$aux."(k.id_actividad1 = :idA1 AND k.id_actividad2 IS NULL) OR (k.id_actividad2 = :idA2 AND k.id_actividad3 IS NULL) OR (k.id_actividad3 = :idA3 AND k.id_actividad4 IS NULL) OR (k.id_actividad4 = :idA4) ORDER BY d.fechaCreacion
					";
			$condiciones = [
			':idA1' => $datos['idActividad'],
			':idA2' => $datos['idActividad'],
			':idA3' => $datos['idActividad'],
			':idA4' => $datos['idActividad']
			];
			$consulta = $base -> prepare($qry);
			if($consulta -> execute($condiciones)) {
				while($row = $consulta->fetch()) {
					$arc = new Archivo();
					$arc->setIdArchivo($row['id_documento']);
					$arc->setNombre($row['descripcion']);
					$arc->setFecha($row['fechaCreacion']);
					$arc->setTipoE($row['tipo']);
					//$arc->setIdEE($row['idEE']);
					//$arc->setIdEntregable($row['IdEntregable']);
					if($row['pdf']=='link') {
						$arc->setRuta($row['ruta']);
						$arc->setTipo('link');
					} else {
						$arc->setRuta($row['ruta'].$row['pdf']);
						$arc->setTipo('archivo');
					}
					array_push($versiones,$arc);
				}
				echo '';
			} else {
				echo 'Error';
			}
			return $versiones;
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	
}

?>