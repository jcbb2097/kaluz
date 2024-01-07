<?php
/*created by Leasim*/
class Categoria implements JsonSerializable
{
	private $idCategoria;
	private $idEje;
	private $descripcion;
	private $anio;
	private $nivel;
	private $idCategoriaPadre;
	private $idExposicion;
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
	 * Get the value of nivel
	 */
	public function getNivel()
	{
		return $this->nivel;
	}

	/**
	 * Set the value of nivel
	 */
	public function setNivel($nivel): self
	{
		$this->nivel = $nivel;

		return $this;
	}

	/**
	 * Get the value of idCategoriaPadre
	 */
	public function getIdCategoriaPadre()
	{
		return $this->idCategoriaPadre;
	}

	/**
	 * Set the value of idCategoriaPadre
	 */
	public function setIdCategoriaPadre($idCategoriaPadre): self
	{
		$this->idCategoriaPadre = $idCategoriaPadre;

		return $this;
	}

	/**
	 * Get the value of idExposicion
	 */
	public function getIdExposicion()
	{
		return $this->idExposicion;
	}

	/**
	 * Set the value of idExposicion
	 */
	public function setIdExposicion($idExposicion): self
	{
		$this->idExposicion = $idExposicion;

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