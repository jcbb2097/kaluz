<?php
/*created by Leasim*/
class Reporte implements JsonSerializable
{
	private $total;
	private $total2;
	private $descripcion;
	private $anio;
	private $idArea;

	private $felicitacion;
	private $solicitud;
	private $queja;
	private $atendioCC;
	private $atendioSC;
	private $noAtendioCC;
	private $noAtendioSC;

	private $idEje;
	private $nombreArea;

	

	
	
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
	 * Get the value of felicitacion
	 */
	public function getFelicitacion()
	{
		return $this->felicitacion;
	}

	/**
	 * Set the value of felicitacion
	 */
	public function setFelicitacion($felicitacion): self
	{
		$this->felicitacion = $felicitacion;

		return $this;
	}

	/**
	 * Get the value of solicitud
	 */
	public function getSolicitud()
	{
		return $this->solicitud;
	}

	/**
	 * Set the value of solicitud
	 */
	public function setSolicitud($solicitud): self
	{
		$this->solicitud = $solicitud;

		return $this;
	}

	/**
	 * Get the value of queja
	 */
	public function getQueja()
	{
		return $this->queja;
	}

	/**
	 * Set the value of queja
	 */
	public function setQueja($queja): self
	{
		$this->queja = $queja;

		return $this;
	}

	/**
	 * Get the value of atendioCC
	 */
	public function getAtendioCC()
	{
		return $this->atendioCC;
	}

	/**
	 * Set the value of atendioCC
	 */
	public function setAtendioCC($atendioCC): self
	{
		$this->atendioCC = $atendioCC;

		return $this;
	}

	/**
	 * Get the value of atendioSC
	 */
	public function getAtendioSC()
	{
		return $this->atendioSC;
	}

	/**
	 * Set the value of atendioSC
	 */
	public function setAtendioSC($atendioSC): self
	{
		$this->atendioSC = $atendioSC;

		return $this;
	}

	/**
	 * Get the value of noAtendioCC
	 */
	public function getNoAtendioCC()
	{
		return $this->noAtendioCC;
	}

	/**
	 * Set the value of noAtendioCC
	 */
	public function setNoAtendioCC($noAtendioCC): self
	{
		$this->noAtendioCC = $noAtendioCC;

		return $this;
	}

	/**
	 * Get the value of noAtendioSC
	 */
	public function getNoAtendioSC()
	{
		return $this->noAtendioSC;
	}

	/**
	 * Set the value of noAtendioSC
	 */
	public function setNoAtendioSC($noAtendioSC): self
	{
		$this->noAtendioSC = $noAtendioSC;

		return $this;
	}

	/**
	 * Get the value of nombreArea
	 */
	public function getNombreArea()
	{
		return $this->nombreArea;
	}

	/**
	 * Set the value of nombreArea
	 */
	public function setNombreArea($nombreArea): self
	{
		$this->nombreArea = $nombreArea;

		return $this;
	}
}

?>