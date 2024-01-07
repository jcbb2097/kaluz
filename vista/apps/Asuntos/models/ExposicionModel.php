<?php

class ExposicionModel extends Model {

	public	function __construct() {
		parent::__construct();
	}
	
	public function getExposicionesAnio($anio) {
		$exposiciones = [];
		try {
			$consulta = $this -> db -> connect() -> prepare('select idExposicion, tituloFinal as titulo from c_exposicionTemporal where anio = :anio and estatus = 1 order by fechaInicio asc');
			if($consulta -> execute([
				':anio' => $anio
			])) {
				while($row = $consulta->fetch()) {
					$expo = new Exposicion();
					$expo->setIdExposicion($row['idExposicion']);
					$expo->setTitulo($row['titulo']);
					array_push($exposiciones,$expo);
				}
				return $exposiciones;
			} else {
				echo 'Error';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function getExposiciones() {
		$exposiciones = [];
		try {
			$consulta = $this->db->connect()->prepare('select idExposicion, tituloFinal as titulo from c_exposicionTemporal where estatus = 1 order by fechaInicio asc');
			if($consulta -> execute([
				':anio' => $anio
			])) {
				while($row = $consulta->fetch()) {
					$expo = new Exposicion();
					$expo->setIdExposicion($row['idExposicion']);
					$expo->setTitulo($row['titulo']);
					array_push($exposiciones,$expo);
				}
				return $exposiciones;
			} else {
				echo 'Error';
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
}

?>