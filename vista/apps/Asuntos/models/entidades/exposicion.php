<?php
class Exposicion {
	private $idExposicion;
	private $titulo;
	private $fechaInicio;
	private $anio;
	private $aux;
	private $aux2;
	private $aux3;
	private $aux4;

	public function getIdExposicion () {
		return $this -> idExposicion;
	}
	public function getTitulo () {
		return $this -> titulo;
	}
	public function getFechaInicio () {
		return $this -> fechaInicio;
	}
	public function getAnio () {
		return $this -> anio;
	}
	public function getAux () {
		return $this -> aux;
	}
	public function getAux2 () {
		return $this -> aux2;
	}
	public function getAux3 () {
		return $this -> aux3;
	}
	public function getAux4 () {
		return $this -> aux4;
	}


	public function setIdExposicion ($idExposicion) {
		$this -> idExposicion = $idExposicion;
	}
	public function setTitulo ($titulo) {
		$this -> titulo = $titulo ;
	}
	public function setFechaInicio ($fechaInicio) {
		$this -> fechaInicio = $fechaInicio;
	}
	public function setAnio ($anio) {
		$this -> anio = $anio;
	}
	public function setAux ($aux) {
		$this -> aux = $aux;
	}
	public function setAux2 ($aux2) {
		$this -> aux2 = $aux2;
	}
	public function setAux3 ($aux3) {
		$this -> aux3 = $aux3;
	}
	public function setAux4 ($aux4) {
		$this -> aux4 = $aux4;
	}
}
?>