<?php
class Area {
	public $idArea;
	public $descripcion;
	public $orden;
	public $tipo;
	public $total;
	public $na;
	public $con;
	public $res;


	public function setIdArea($idArea){
		$this->idArea = $idArea;
	}
	public function setNombre($descripcion){
		$this->descripcion = $descripcion;
	}
	public function setOrden($orden){
		$this->orden = $orden;
	}
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	public function setTotal($total) {
		$this->total = $total;
	}
	public function setNA($na){
		$this->na = $na;
	}
	public function setCon($con){
		$this->con = $con;
	}
	public function setRes($res){
		$this->res = $res;
	}


	public function getIdArea(){
		return $this->idArea;
	}
	public function getNombre(){
		return $this->descripcion;
	}
	public function getOrden(){
		return $this->orden;
	}
	public function getTipo(){
		return $this->tipo;
	}
	public function getTotal(){
		return $this->total;
	}
	public function getNA(){
		return $this->na;
	}
	public function getCon(){
		return $this->con;
	}
	public function getRes(){
		return $this->res;
	}


}
?>