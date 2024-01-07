<?php 
class Archivo {
	private $idArchivo;
	private $idEE;
	private $idEntregable;
	private $nombre;
	private $tipoE;
	private $ruta;
	private $tipo;
	private $descripcion;
	private $fecha;

	public function getIdArchivo() {
		return $this->idArchivo;
	}
	public function getIdEE() {
		return $this->idEE;
	}
	public function getIdEntregable() {
		return $this->idEntregable;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function getRuta() {
		return $this->ruta;
	}
	public function getTipo() {
		return $this->tipo;
	}
	public function getTipoE() {
		return $this->tipoE;
	}
	public function getDescripcion() {
		return $this->descripcion;
	}
	public function getFecha() {
		return $this->fecha;
	}

	public function setIdArchivo($idArchivo) {
		$this -> idArchivo = $idArchivo;
	}
	public function setIdEE($idEE) {
		$this -> idEE = $idEE;
	}
	public function setIdEntregable($idEntregable) {
		$this -> idEntregable = $idEntregable;
	}
	public function setNombre($nombre) {
		$this -> nombre = $nombre;
	}
	public function setRuta($ruta) {
		$this -> ruta = $ruta;
	}
	public function setTipo($tipo) {
		$this -> tipo = $tipo;
	}
	public function setTipoE($tipoE) {
		$this -> tipoE = $tipoE;
	}
	public function setDescripcion($descripcion) {
		$this -> descripcion = $descripcion;
	}
	public function setFecha($fecha) {
		$this -> fecha = $fecha;
	}
}

?>