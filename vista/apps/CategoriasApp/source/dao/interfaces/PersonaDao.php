<?php
/*created by Leasim*/

require_once __DIR__."/../../entities/Persona.php";

interface PersonaDao
{
	public function obtenerPersonasArea($idArea);
}

?>