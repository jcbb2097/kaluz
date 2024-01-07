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
	private $noAtendida;
	private $idEje;
	private $idArea;
	private $idTipo;
	private $anioInicio;
	private $anioUltimo;

	private $sinCorreo;
	private $conCorreo;
	private $nombre;
	private $nombreEje;

	
	
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
	

	/**
	 * Get the value of noAtendida
	 */
	public function getNoAtendida()
	{
		return $this->noAtendida;
	}

	/**
	 * Set the value of noAtendida
	 */
	public function setNoAtendida($noAtendida): self
	{
		$this->noAtendida = $noAtendida;

		return $this;
	}

	/**
	 * Get the value of idTipo
	 */
	public function getIdTipo()
	{
		return $this->idTipo;
	}

	/**
	 * Set the value of idTipo
	 */
	public function setIdTipo($idTipo): self
	{
		$this->idTipo = $idTipo;

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
	 * Get the value of anioInicio
	 */
	public function getAnioInicio()
	{
		return $this->anioInicio;
	}

	/**
	 * Set the value of anioInicio
	 */
	public function setAnioInicio($anioInicio): self
	{
		$this->anioInicio = $anioInicio;

		return $this;
	}

	/**
	 * Get the value of anioUltimo
	 */
	public function getAnioUltimo()
	{
		return $this->anioUltimo;
	}

	/**
	 * Set the value of anioUltimo
	 */
	public function setAnioUltimo($anioUltimo): self
	{
		$this->anioUltimo = $anioUltimo;

		return $this;
	}

	/**
	 * Get the value of sinCorreo
	 */
	public function getSinCorreo()
	{
		return $this->sinCorreo;
	}

	/**
	 * Set the value of sinCorreo
	 */
	public function setSinCorreo($sinCorreo): self
	{
		$this->sinCorreo = $sinCorreo;

		return $this;
	}

	/**
	 * Get the value of conCorreo
	 */
	public function getConCorreo()
	{
		return $this->conCorreo;
	}

	/**
	 * Set the value of conCorreo
	 */
	public function setConCorreo($conCorreo): self
	{
		$this->conCorreo = $conCorreo;

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
	 * Get the value of nombreEje
	 */
	public function getNombreEje()
	{
		return $this->nombreEje;
	}

	/**
	 * Set the value of nombreEje
	 */
	public function setNombreEje($nombreEje): self
	{
		$this->nombreEje = $nombreEje;

		return $this;
	}
}

?>