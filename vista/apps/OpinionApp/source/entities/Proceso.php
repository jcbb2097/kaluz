<?php
/*created by Leasim*/
class Proceso implements JsonSerializable
{
	private $idProceso;
	private $nombre;
	private $estatus;
	private $usuarioCreo;
	private $fechaCreo;
	private $usuarioMod;
	private $fechaMod;
	

	
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
	
	public function __construct4($nombre,$estatus,$usuarioCreo,$fechaCreo)
	{
		$this -> nombre = $nombre;
		$this -> estatus = $estatus;
		$this -> usuarioCreo = $usuarioCreo;
		$this -> fechaCreo = $fechaCreo;
	}
	
	public function __construct5($idProceso,$nombre,$estatus,$usuarioMod,$fechaMod)
	{
		$this -> idProceso = $idProceso;
		$this -> nombre = $nombre;
		$this -> estatus = $estatus;
		$this -> usuarioMod = $usuarioMod;
		$this -> fechaMod = $fechaMod;
	}
	
	

	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
    }


	

	/**
	 * Get the value of idOrigen
	 */
	public function getIdProceso()
	{
		return $this->idProceso;
	}

	/**
	 * Set the value of idOrigen
	 */
	public function setIdProceso($idProceso): self
	{
		$this->idProceso = $idProceso;

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
	 * Get the value of estatus
	 */
	public function getEstatus()
	{
		return $this->estatus;
	}

	/**
	 * Set the value of estatus
	 */
	public function setEstatus($estatus): self
	{
		$this->estatus = $estatus;

		return $this;
	}

	/**
	 * Get the value of usuarioCreo
	 */
	public function getUsuarioCreo()
	{
		return $this->usuarioCreo;
	}

	/**
	 * Set the value of usuarioCreo
	 */
	public function setUsuarioCreo($usuarioCreo): self
	{
		$this->usuarioCreo = $usuarioCreo;

		return $this;
	}

	/**
	 * Get the value of fechaCreo
	 */
	public function getFechaCreo()
	{
		return $this->fechaCreo;
	}

	/**
	 * Set the value of fechaCreo
	 */
	public function setFechaCreo($fechaCreo): self
	{
		$this->fechaCreo = $fechaCreo;

		return $this;
	}

	/**
	 * Get the value of usuarioMod
	 */
	public function getUsuarioMod()
	{
		return $this->usuarioMod;
	}

	/**
	 * Set the value of usuarioMod
	 */
	public function setUsuarioMod($usuarioMod): self
	{
		$this->usuarioMod = $usuarioMod;

		return $this;
	}

	/**
	 * Get the value of fechaMod
	 */
	public function getFechaMod()
	{
		return $this->fechaMod;
	}

	/**
	 * Set the value of fechaMod
	 */
	public function setFechaMod($fechaMod): self
	{
		$this->fechaMod = $fechaMod;

		return $this;
	}
}

?>