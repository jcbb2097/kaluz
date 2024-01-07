<?php
class Check {
	private $idCheck;
	private $nombre;
	private $Valor;
	private $fecha;
	private $usrValor;

	public function setIdCheck($id) {
		$this->idCheck = $id;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function setValor($valor) {
		$this->valor = $valor;
	}
	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}
	public function setUsrValor($usrValor) {
		$this->usrValor = $usrValor;
	}

	public function getIdCheck() {
		return $this->idCheck;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function getValor() {
		return $this->valor;
	}
	public function getFecha() {
		return $this->fecha;
	}
	public function getUsrValor() {
		return $this->usrValor;
	}
}	
?>