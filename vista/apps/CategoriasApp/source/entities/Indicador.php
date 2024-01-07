<?php
/*created by Leasim*/
class Indicador implements JsonSerializable
{
	private $total;
	private $total2;
	private $descripcion;
	private $anio;
	private $sinTurnar;
	private $proceso;
	private $atendida;
	private $concluida;
	private $id;

	
	
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
	 * Get the value of total
	 */
	public function getTotal()
	{
		return $this->total;
	}

	/**
	 * Set the value of total
	 */
	public function setTotal($total): self
	{
		$this->total = $total;

		return $this;
	}

	/**
	 * Get the value of total2
	 */
	public function getTotal2()
	{
		return $this->total2;
	}

	/**
	 * Set the value of total2
	 */
	public function setTotal2($total2): self
	{
		$this->total2 = $total2;

		return $this;
	}

	/**
	 * Get the value of descripcion
	 */
	public function getDescripcion()
	{
		return $this->descripcion;
	}

	/**
	 * Set the value of descripcion
	 */
	public function setDescripcion($descripcion): self
	{
		$this->descripcion = $descripcion;

		return $this;
	}

	/**
	 * Get the value of anio
	 */
	public function getAnio()
	{
		return $this->anio;
	}

	/**
	 * Set the value of anio
	 */
	public function setAnio($anio): self
	{
		$this->anio = $anio;

		return $this;
	}

	

	/**
	 * Get the value of sinTurnar
	 */
	public function getSinTurnar()
	{
		return $this->sinTurnar;
	}

	/**
	 * Set the value of sinTurnar
	 */
	public function setSinTurnar($sinTurnar): self
	{
		$this->sinTurnar = $sinTurnar;

		return $this;
	}

	/**
	 * Get the value of proceso
	 */
	public function getProceso()
	{
		return $this->proceso;
	}

	/**
	 * Set the value of proceso
	 */
	public function setProceso($proceso): self
	{
		$this->proceso = $proceso;

		return $this;
	}

	/**
	 * Get the value of atendida
	 */
	public function getAtendida()
	{
		return $this->atendida;
	}

	/**
	 * Set the value of atendida
	 */
	public function setAtendida($atendida): self
	{
		$this->atendida = $atendida;

		return $this;
	}

	/**
	 * Get the value of concluida
	 */
	public function getConcluida()
	{
		return $this->concluida;
	}

	/**
	 * Set the value of concluida
	 */
	public function setConcluida($concluida): self
	{
		$this->concluida = $concluida;

		return $this;
	}
	
	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 */
	public function setId($id): self
	{
		$this->id = $id;

		return $this;
	}
	
}

?>