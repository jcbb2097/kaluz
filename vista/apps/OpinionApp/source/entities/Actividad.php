<?php
/*created by Leasim*/
class Actividad implements JsonSerializable
{
	private $idActividad;
	private $nombre;
	private $anio;
	private $periodo;
	private $idCategoria;
	private $numeracion;
	private $idActividadSuperior;
	private $idCheck;
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
	 * Get the value of idActividad
	 */
	public function getIdActividad()
	{
		return $this->idActividad;
	}

	/**
	 * Set the value of idActividad
	 */
	public function setIdActividad($idActividad): self
	{
		$this->idActividad = $idActividad;

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
	 * Get the value of periodo
	 */
	public function getPeriodo()
	{
		return $this->periodo;
	}

	/**
	 * Set the value of periodo
	 */
	public function setPeriodo($periodo): self
	{
		$this->periodo = $periodo;

		return $this;
	}
	
	/**
	 * Get the value of idCategoria
	 */
	public function getIdCategoria()
	{
		return $this->idCategoria;
	}

	/**
	 * Set the value of idCategoria
	 */
	public function setIdCategoria($idCategoria): self
	{
		$this->idCategoria = $idCategoria;

		return $this;
	}
	
	/**
	 * Get the value of numeracion
	 */
	public function getNumeracion()
	{
		return $this->numeracion;
	}

	/**
	 * Set the value of numeracion
	 */
	public function setNumeracion($numeracion): self
	{
		$this->numeracion = $numeracion;

		return $this;
	}
	
	/**
	 * Get the value of idActividadSuperior
	 */
	public function getIdActividadSuperior()
	{
		return $this->idActividadSuperior;
	}

	/**
	 * Set the value of idActividadSuperior
	 */
	public function setIdActividadSuperior($idActividadSuperior): self
	{
		$this->idActividadSuperior = $idActividadSuperior;

		return $this;
	}
	

	/**
	 * Get the value of idCheck
	 */
	public function getIdCheck()
	{
		return $this->idCheck;
	}

	/**
	 * Set the value of idCheck
	 */
	public function setIdCheck($idCheck): self
	{
		$this->idCheck = $idCheck;

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