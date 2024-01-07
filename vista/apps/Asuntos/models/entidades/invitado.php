<?php
class Invitado {
	private $idArea;
	private $area;
	private $orden;
	private $estatus;
	private $fechaSalida;

	function getIdArea() {
		return $this->idArea;
	}
	function getArea() {
		return $this->area;
	}
	function getOrden() {
		return $this->orden;
	}  
	function getEstatus() {
		return $this->estatus;
	}
	function getFechaSalida() {
		return $this->fechaSalida;
	}

	function setIdArea($idArea) {
		$this->idArea = $idArea;
	}
	function setArea($area) {
		$this->area = $area;
	}
	function setOrden($orden) {
		$this->orden = $orden;
	} 
	function setEstatus($estatus) {
		$this->estatus = $estatus;
	} 
	function setFechaSalida($fechaSalida) {
		$this->fechaSalida = $fechaSalida;
	} 
}
?>