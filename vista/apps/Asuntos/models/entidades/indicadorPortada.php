<?php

class Indicador {
	private $recibidos;
	private $invitados;
	private $enviados;
	private $recibidosC;
	private $invitadosC;
	private $enviadosC;
	private $recibidosR;
	private $enviadosR;
	private $invitadosR;
	private $recibidosT;
	private $enviadosT;

	public function getRecibidos() {
		return $this -> recibidos;
	}
	public function getInvitados() {
		return $this -> invitados;
	}
	public function getEnviados() {
		return $this -> enviados;
	}
	
	public function getRecibidosC() {
		return $this -> recibidosC;
	}
	public function getInvitadosC() {
		return $this -> invitadosC;
	}
	public function getEnviadosC() {
		return $this -> enviadosC;
	}

	public function getRecibidosR() {
		return $this -> recibidosR;
	}
	public function getEnviadosR() {
		return $this -> enviadosR;
	}
	public function getInvitadosR() {
		return $this -> invitadosR;
	}

	public function getRecibidosT() {
		return $this -> recibidosT;
	}
	public function getEnviadosT() {
		return $this -> enviadosT;
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

	public function setRecibidosC($recibidosC) {
		$this -> recibidosC = $recibidosC;
	}
	public function setEnviadosC($enviadosC) {
		$this -> enviadosC = $enviadosC;
	}
	public function setInvitadosC($invitadosC) {
		$this -> invitadosC = $invitadosC;
	}
	
	public function setRecibidosR($recibidosR) {
		$this -> recibidosR = $recibidosR;
	}
	public function setEnviadosR($enviadosR) {
		$this -> enviadosR = $enviadosR;
	}
	public function setInvitadosR($invitadosR) {
		$this -> invitadosR = $invitadosR;
	}

	public function setRecibidosT($recibidosT) {
		$this -> recibidosT = $recibidosT;
	}
	public function setEnviadosT($enviadosT) {
		$this -> enviadosT = $enviadosT;
	}
}



?>