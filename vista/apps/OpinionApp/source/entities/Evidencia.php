<?php
/*created by Leasim*/
class Evidencia implements JsonSerializable
{
	private $id;
	private $idOpinion;
	private $respuesta;
	private $archivo;
	private $idUsuario;
	private $fechaAtendio;
	private $estatus;
	private $datos;
	private $clasificacion;

	

	
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
	
	public function __construct8($idOpinion,$respuesta,$archivo,$idUsuario,$fechaAtendio,$estatus,$datos,$clasificacion)
	{
		$this -> idOpinion = $idOpinion;
		$this -> respuesta = $respuesta;
		$this -> archivo = $archivo;
		$this -> idUsuario = $idUsuario;
		$this -> fechaAtendio = $fechaAtendio;
		$this -> estatus = $estatus;
		$this -> datos = $datos;
		$this -> clasificacion = $clasificacion;
	}

	public function __construct9($id,$idOpinion,$respuesta,$archivo,$idUsuario,$fechaAtendio,$estatus,$datos,$clasificacion)
	{
		$this -> id = $id;
		$this -> idOpinion = $idOpinion;
		$this -> respuesta = $respuesta;
		$this -> archivo = $archivo;
		$this -> idUsuario = $idUsuario;
		$this -> fechaAtendio = $fechaAtendio;
		$this -> estatus = $estatus;
		$this -> datos = $datos;
		$this -> clasificacion = $clasificacion;
	}
	
	
	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
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
	 * Get the value of idOpinion
	 */
	public function getIdOpinion()
	{
		return $this->idOpinion;
	}

	/**
	 * Set the value of idOpinion
	 */
	public function setIdOpinion($idOpinion): self
	{
		$this->idOpinion = $idOpinion;

		return $this;
	}

	/**
	 * Get the value of respuesta
	 */
	public function getRespuesta()
	{
		return $this->respuesta;
	}

	/**
	 * Set the value of respuesta
	 */
	public function setRespuesta($respuesta): self
	{
		$this->respuesta = $respuesta;

		return $this;
	}

	/**
	 * Get the value of archivo
	 */
	public function getArchivo()
	{
		return $this->archivo;
	}

	/**
	 * Set the value of archivo
	 */
	public function setArchivo($archivo): self
	{
		$this->archivo = $archivo;

		return $this;
	}

	/**
	 * Get the value of idUsuario
	 */
	public function getIdUsuario()
	{
		return $this->idUsuario;
	}

	/**
	 * Set the value of idUsuario
	 */
	public function setIdUsuario($idUsuario): self
	{
		$this->idUsuario = $idUsuario;

		return $this;
	}

	/**
	 * Get the value of fechaAtendio
	 */
	public function getFechaAtendio()
	{
		return $this->fechaAtendio;
	}

	/**
	 * Set the value of fechaAtendio
	 */
	public function setFechaAtendio($fechaAtendio): self
	{
		$this->fechaAtendio = $fechaAtendio;

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
	 * Get the value of datos
	 */
	public function getDatos()
	{
		return $this->datos;
	}

	/**
	 * Set the value of datos
	 */
	public function setDatos($datos): self
	{
		$this->datos = $datos;

		return $this;
	}

	/**
	 * Get the value of clasificacion
	 */
	public function getClasificacion()
	{
		return $this->clasificacion;
	}

	/**
	 * Set the value of clasificacion
	 */
	public function setClasificacion($clasificacion): self
	{
		$this->clasificacion = $clasificacion;

		return $this;
	}
}

?>