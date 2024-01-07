<?php

class Actividad {
	private $idActividad;
	private $idEje;
	private $descripcion;
	private $idActividadPadre;
	private $anio;
	private $idArea; 
	private $area;
	private $idEncargado;
	private $encargado;
	private $idEntregable;
	private $entregable;
	private $orden;
	private $exp;
	private $compartidos;
	private $normatividad;

	public function getId() {
		return $this->idActividad;
	}
	public function getIdEje() {
		return $this->idEje;
	}
	public function getNombre() {
		return $this->descripcion;
	}
	public function getPadre() {
		return $this->idActividadPadre;
	}
	public function getAnio() {
		return $this->anio;
	}
	public function getIdArea() {
		return $this->idArea;
	}
	public function getArea() {
		return $this->area;
	}
	public function getIdEncargado() {
		return $this->idEncargado;
	}
	public function getEncargado() {
		return $this->encargado;
	}
	public function getIdEntregable() {
		return $this->idEntregable;
	}
	public function getEntregable() {
		return $this->entregable;
	}
	public function getOrden() {
		return $this->orden;
	}
	public function getExp() {
		return $this->exp;
	}
	public function getCompartidos() {
		return $this->compartidos;
	}
	public function getNormatividad() {
		return $this->normatividad;
	}

	public function setId($idActividad) {
		$this -> idActividad = $idActividad;
	}
	public function setEje($idEje) {
		$this -> idEje = $idEje;
	}
	public function setNombre($descripcion) {
		$this -> descripcion = $descripcion;
	}
	public function setPadre($idActividadPadre) {
		$this -> idActividadPadre = $idActividadPadre;
	}
	public function setAnio($anio) {
		$this -> anio = $anio;
	}
	public function setIdArea($idArea) {
		$this -> idArea = $idArea;
	}
	public function setArea($area) {
		$this -> area = $area;
	}
	public function setIdEncargado($idEncargado) {
		$this -> idEncargado = $idEncargado;
	}
	public function setEncargado($encargado) {
		$this -> encargado = $encargado;
	}
	public function setIdEntregable($idEntregable) {
		$this -> idEntregable = $idEntregable;
	}
	public function setEntregable($entregable) {
		$this -> entregable = $entregable;
	}
	public function setOrden($orden) {
		$this -> orden = $orden;
	}
	public function setExp($exp) {
		$this -> exp = $exp;
	}
	public function setCompartidos($compartidos) {
		$this -> compartidos = $compartidos;
	}
	public function setNormatividad($normatividad) {
		$this -> normatividad = $normatividad;
	}
}

?>