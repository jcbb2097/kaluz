<?php

class Entregable {
	private $idEntregable;
	private $idEntregableG;
	private $entregableG;
	private $descripcion;
	private $expint;
	private $idActividad;
	private $actividad;
	private $ordenA;
	private $idResponsable;
	private $responsable;
	private $idArea;
	private $area;
	private $fechaInicioEstimada;
	private $fechaInicioReal;
	private $fechaFinEstimada;
	private $fechaFinReal;
	private $progreso;
	private $estatus;
	private $tipo;
	private $insumos;
	private $check;
	private $ruta;
	private $versiones;

	public function getIdEntregable() {
		return $this -> idEntregable;
	}
	public function getDescripcion() {
		return $this -> descripcion;
	}
	public function getEntregableG() {
		return $this -> entregableG;
	}
	public function getIdEntregableG() {
		return $this -> idEntregableG;
	}
	public function getExpInt() {
		return $this -> expint;
	}
	public function getIdActividad() {
		return $this -> idActividad;
	}
	public function getActividad() {
		return $this -> actividad;
	}
	public function getOrdenA() {
		return $this -> ordenA;
	}
	public function getIdResponsable() {
		return $this -> idResponsable;
	}
	public function getResponsable() {
		return $this -> responsable;
	}
	public function getIdArea() {
		return $this -> idArea;
	}
	public function getArea() {
		return $this -> area;
	}
	public function getFechaInicioEstimada() {
		return $this -> fechaInicioEstimada;
	}
	public function getFechaInicioReal() {
		return $this -> fechaInicioReal;
	}
	public function getFechaFinEstimada() {
		return $this -> fechaFinEstimada;
	}
	public function getFechaFinReal() {
		return $this -> fechaFinReal;
	}
	public function getProgreso() {
		return $this -> progreso;
	}
	public function getEstatus() {
		return $this -> estatus;
	}
	public function getTipo() {
		return $this -> tipo;
	}
	public function getInsumos() {
		return $this -> insumos;
	}
	public function getChk() {
		return $this -> check;
	}
	public function getRuta() {
		return $this -> ruta;
	}
	public function getVersiones() {
		return $this -> versiones;
	}

	public function setIdEntregable($idEntregable) {
		$this -> idEntregable = $idEntregable;
	}
	public function setIdEntregableG($idEntregableG) {
		$this -> idEntregableG = $idEntregableG;
	}
	public function setEntregableG($entregableG) {
		$this -> entregableG = $entregableG;
	}
	public function setDescripcion($descripcion) {
		$this -> descripcion = $descripcion;
	}
	public function setExpInt($expint) {
		$this -> expint = $expint;
	}
	public function setIdActividad($idActividad) {
		$this -> idActividad = $idActividad;
	}
	public function setActividad($actividad) {
		$this -> actividad = $actividad;
	}
	public function setOrdenA($ordenA) {
		$this -> ordenA = $ordenA;
	}
	public function setIdResponsable($idResponsable) {
		$this -> idResponsable = $idResponsable;
	}
	public function setResponsable($responsable) {
		$this -> responsable = $responsable;
	}
	public function setIdArea($idArea) {
		$this -> idArea = $idArea;
	}
	public function setArea($area) {
		$this -> area = $area;
	}
	public function setFechaInicioEstimada($fechaInicioEstimada) {
		$this -> fechaInicioEstimada = $fechaInicioEstimada;
	}
	public function setFechaInicioReal($fechaInicioReal) {
		$this -> fechaInicioReal = $fechaInicioReal;
	}
	public function setFechaFinEstimada($fechaFinEstimada) {
		$this -> fechaFinEstimada = $fechaFinEstimada;
	}
	public function setFechaFinReal($fechaFinReal) {
		$this -> fechaFinReal = $fechaFinReal;
	}
	public function setProgreso($progreso) {
		$this -> progreso = $progreso;
	}
	public function setEstatus($estatus) {
		$this -> estatus = $estatus;
	}
	public function setTipo($tipo) {
		$this -> tipo = $tipo;
	}
	public function setInsumos($insumos) {
		$this -> insumos = $insumos;
	}
	public function setChk($check) {
		$this -> check = $check;
	}
	public function setRuta($ruta) {
		$this -> ruta = $ruta;
	}
	public function setVersiones($versiones) {
		$this -> versiones = $versiones;
	}
}

?>