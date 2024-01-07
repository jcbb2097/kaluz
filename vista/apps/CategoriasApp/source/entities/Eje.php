<?php
/*created by Leasim*/
class Eje implements JsonSerializable
{
	private $idEje;
	private $nombre;
	private $orden;
		
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
	 * Get the value of orden
	 */
	public function getOrden()
	{
		return $this->orden;
	}

	/**
	 * Set the value of orden
	 */
	public function setOrden($orden): self
	{
		$this->orden = $orden;

		return $this;
	}
}

?>