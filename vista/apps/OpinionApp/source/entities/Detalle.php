<?php
/*created by Leasim*/
class Detalle implements JsonSerializable
{
	private $idDetalle;
	private $idOpinion;
	private $idEje;
	private $idArea;
	private $idExposicion;
	private $idCategoria;
	private $idSubcategoria;
	private $idActividadGlobal;
	private $idActividadGeneral;
	private $idCheck;
	private $idSubcheck;
	private $idPersonaResponde;
	private $medioRespuesta;
	private $respuesta;
	private $fechaTurnado;
	private $fechaAtendido;
	private $idUsuario;
	

	
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
	
	public function __construct13($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idUsuario,$idPersonaResponde)
	{
		$this -> idOpinion = $idOpinion;
		$this -> idEje = $idEje;
		$this -> idArea = $idArea;
		$this -> idExposicion = $idExposicion;
		$this -> idCategoria = $idCategoria;
		$this -> idSubcategoria = $idSubcategoria;
		$this -> idActividadGlobal = $idActividadGlobal;
		$this -> idActividadGeneral = $idActividadGeneral;
		$this -> idCheck = $idCheck;
		$this -> idSubcheck = $idSubcheck;
		$this -> fechaTurnado = $fechaTurnado;
		$this -> idUsuario = $idUsuario;
		$this -> idPersonaResponde = $idPersonaResponde;
		
	}

	public function __construct12($idOpinion,$idEje,$idArea,$idExposicion,$idCategoria,$idSubcategoria,$idActividadGlobal,$idActividadGeneral,$idCheck,$idSubcheck,$fechaTurnado,$idPersonaResponde)
	{
		$this -> idOpinion = $idOpinion;
		$this -> idEje = $idEje;
		$this -> idArea = $idArea;
		$this -> idExposicion = $idExposicion;
		$this -> idCategoria = $idCategoria;
		$this -> idSubcategoria = $idSubcategoria;
		$this -> idActividadGlobal = $idActividadGlobal;
		$this -> idActividadGeneral = $idActividadGeneral;
		$this -> idCheck = $idCheck;
		$this -> idSubcheck = $idSubcheck;
		$this -> fechaTurnado = $fechaTurnado;
		$this -> idPersonaResponde = $idPersonaResponde;
		
	}
	
	
	

	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
    }

	

	/**
	 * Get the value of idDetalle
	 */
	public function getIdDetalle()
	{
		return $this->idDetalle;
	}

	/**
	 * Set the value of idDetalle
	 */
	public function setIdDetalle($idDetalle): self
	{
		$this->idDetalle = $idDetalle;

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
	 * Get the value of idSubcategoria
	 */
	public function getIdSubcategoria()
	{
		return $this->idSubcategoria;
	}

	/**
	 * Set the value of idSubcategoria
	 */
	public function setIdSubcategoria($idSubcategoria): self
	{
		$this->idSubcategoria = $idSubcategoria;

		return $this;
	}

	/**
	 * Get the value of idActividadGlobal
	 */
	public function getIdActividadGlobal()
	{
		return $this->idActividadGlobal;
	}

	/**
	 * Set the value of idActividadGlobal
	 */
	public function setIdActividadGlobal($idActividadGlobal): self
	{
		$this->idActividadGlobal = $idActividadGlobal;

		return $this;
	}

	/**
	 * Get the value of idActividadGeneral
	 */
	public function getIdActividadGeneral()
	{
		return $this->idActividadGeneral;
	}

	/**
	 * Set the value of idActividadGeneral
	 */
	public function setIdActividadGeneral($idActividadGeneral): self
	{
		$this->idActividadGeneral = $idActividadGeneral;

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
	 * Get the value of idSubcheck
	 */
	public function getIdSubcheck()
	{
		return $this->idSubcheck;
	}

	/**
	 * Set the value of idSubcheck
	 */
	public function setIdSubcheck($idSubcheck): self
	{
		$this->idSubcheck = $idSubcheck;

		return $this;
	}

	/**
	 * Get the value of idPersonaResponde
	 */
	public function getIdPersonaResponde()
	{
		return $this->idPersonaResponde;
	}

	/**
	 * Set the value of idPersonaResponde
	 */
	public function setIdPersonaResponde($idPersonaResponde): self
	{
		$this->idPersonaResponde = $idPersonaResponde;

		return $this;
	}

	/**
	 * Get the value of medioRespuesta
	 */
	public function getMedioRespuesta()
	{
		return $this->medioRespuesta;
	}

	/**
	 * Set the value of medioRespuesta
	 */
	public function setMedioRespuesta($medioRespuesta): self
	{
		$this->medioRespuesta = $medioRespuesta;

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
	 * Get the value of fechaTurnado
	 */
	public function getFechaTurnado()
	{
		return $this->fechaTurnado;
	}

	/**
	 * Set the value of fechaTurnado
	 */
	public function setFechaTurnado($fechaTurnado): self
	{
		$this->fechaTurnado = $fechaTurnado;

		return $this;
	}

	/**
	 * Get the value of fechaAtendido
	 */
	public function getFechaAtendido()
	{
		return $this->fechaAtendido;
	}

	/**
	 * Set the value of fechaAtendido
	 */
	public function setFechaAtendido($fechaAtendido): self
	{
		$this->fechaAtendido = $fechaAtendido;

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
}

?>