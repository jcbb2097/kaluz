<?php
/*created by Leasim*/
class Persona implements JsonSerializable
{
	private $idPersona;
	private $idEje;
	private $idArea;
	private $nombre;
	private $apPat;
	private $apMat;
	
	

	
	function __construct()
	{
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámetros tendrá un nombre de función
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) 
		{
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}		
	}
	
	function __construct0()
	{
		
	}
	
	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
    }

	

	/**
	 * Get the value of idPersona
	 */
	public function getIdPersona()
	{
		return $this->idPersona;
	}

	/**
	 * Set the value of idPersona
	 */
	public function setIdPersona($idPersona): self
	{
		$this->idPersona = $idPersona;

		return $this;
	}

	/**
	 * Get the value of idEje
	 */
	public function getIdEje()
	{
		return $this->idEje;
	}

	/**
	 * Set the value of idEje
	 */
	public function setIdEje($idEje): self
	{
		$this->idEje = $idEje;

		return $this;
	}

	/**
	 * Get the value of idArea
	 */
	public function getIdArea()
	{
		return $this->idArea;
	}

	/**
	 * Set the value of idArea
	 */
	public function setIdArea($idArea): self
	{
		$this->idArea = $idArea;

		return $this;
	}

	/**
	 * Get the value of nombre
	 */
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Set the value of nombre
	 */
	public function setNombre($nombre): self
	{
		$this->nombre = $nombre;

		return $this;
	}

	/**
	 * Get the value of apPat
	 */
	public function getApPat()
	{
		return $this->apPat;
	}

	/**
	 * Set the value of apPat
	 */
	public function setApPat($apPat): self
	{
		$this->apPat = $apPat;

		return $this;
	}

	/**
	 * Get the value of apMat
	 */
	public function getApMat()
	{
		return $this->apMat;
	}

	/**
	 * Set the value of apMat
	 */
	public function setApMat($apMat): self
	{
		$this->apMat = $apMat;

		return $this;
	}
}

?>