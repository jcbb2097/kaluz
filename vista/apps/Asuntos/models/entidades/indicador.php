<?php

class Indicador {
	private $recibidos;
	private $enviados;
	private $invitados;
	private $invitados2;
	private $problematica;
	private $conocimiento;
	private $sugerencia;
	private $solicitud;
	private $conversacion1;
	private $noatendido1;
	private $conversacion2;
	private $noatendido2;
	private $conversacion3;
	private $noatendido3;

	private $nombreArea;

	public function getRecibidos() {
		return $this -> recibidos;
	}
	public function getEnviados() {
		return $this -> enviados;
	}
	public function getInvitados() {
		return $this -> invitados;
	}
	public function getInvitados2() {
		return $this -> invitados2;
	}
	public function getProblematica() {
		return $this -> problematica;
	}
	public function getConocimiento() {
		return $this -> conocimiento;
	}
	public function getSugerencia() {
		return $this -> sugerencia;
	}
	public function getSolicitud() {
		return $this -> solicitud;
	}
	public function getNoAtendido1() {
		return $this -> noatendido1;
	}
	public function getConversacion1() {
		return $this -> conversacion1;
	}
	public function getNoAtendido2() {
		return $this -> noatendido2;
	}
	public function getConversacion2() {
		return $this -> conversacion2;
	}
	public function getNoAtendido3() {
		return $this -> noatendido3;
	}
	public function getConversacion3() {
		return $this -> conversacion3;
	}
	public function getNombreArea() {
		return $this -> nombreArea;
	}


	public function setRecibidos($recibidos) {
		$this -> recibidos = $recibidos;
	}
	public function setEnviados($enviados) {
		$this -> enviados = $enviados;
	}
	public function setInvitados($invitados) {
		$this -> invitados = $invitados;
	}
	public function setInvitados2($invitados2) {
		$this -> invitados2 = $invitados2;
	}
	public function setProblematica($problematica) {
		$this -> problematica = $problematica;
	}
	public function setConocimiento($conocimiento) {
		$this -> conocimiento = $conocimiento;
	}
	public function setSugerencia($sugerencia) {
		$this -> sugerencia = $sugerencia;
	}
	public function setSolicitud($solicitud) {
		$this -> solicitud = $solicitud;
	}

	public function setNoAtendido1($noatendido1){
		$this -> noatendido1 = $noatendido1;
	}
	public function setConversacion1($conversacion1){
		$this -> conversacion1 = $conversacion1;
	}
	public function setNoAtendido2($noatendido2){
		$this -> noatendido2 = $noatendido2;
	}
	public function setConversacion2($conversacion2){
		$this -> conversacion2 = $conversacion2;
	}
	public function setNoAtendido3($noatendido3){
		$this -> noatendido3 = $noatendido3;
	}
	public function setConversacion3($conversacion3){
		$this -> conversacion3 = $conversacion3;
	}
	public function setNombreArea($nombreArea){
		$this -> nombreArea = $nombreArea;
	}

}



?>