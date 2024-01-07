<?php
/*created by Leasim*/
class Contacto implements JsonSerializable
{
	private $idContacto;
	private $idOpinion;
	private $nombre;
	private $apPat;
	private $apMat;
	private $edad;
	private $email;
	private $telefono;
	private $idPais;
	private $idEstado;
	private $idGenero;

	private $nombrePais;
	private $nombreEstado;
	private $nombreGenero;

	
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
	
	public function __construct9($nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero)
	{
		
		$this -> nombre = $nombre;
		$this -> apPat = $apPat;
		$this -> apMat = $apMat;
		$this -> edad = $edad;
		$this -> email = $email;
		$this -> telefono = $telefono;
		$this -> idPais = $idPais;
		$this -> idEstado = $idEstado;
		$this -> idGenero = $idGenero;
	}

	public function __construct10($idOpinion,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero)
	{
		$this -> idOpinion = $idOpinion;
		$this -> nombre = $nombre;
		$this -> apPat = $apPat;
		$this -> apMat = $apMat;
		$this -> edad = $edad;
		$this -> email = $email;
		$this -> telefono = $telefono;
		$this -> idPais = $idPais;
		$this -> idEstado = $idEstado;
		$this -> idGenero = $idGenero;
	}
	
	public function __construct11($idContacto,$idOpinion,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero)
	{
		$this -> idContacto = $idContacto;
		$this -> idOpinion = $idOpinion;
		$this -> nombre = $nombre;
		$this -> apPat = $apPat;
		$this -> apMat = $apMat;
		$this -> edad = $edad;
		$this -> email = $email;
		$this -> telefono = $telefono;
		$this -> idPais = $idPais;
		$this -> idEstado = $idEstado;
		$this -> idGenero = $idGenero;
	}
	
	

	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
    }


	

	/**
	 * Get the value of idContacto
	 */
	public function getIdContacto()
	{
		return $this->idContacto;
	}

	/**
	 * Set the value of idContacto
	 */
	public function setIdContacto($idContacto): self
	{
		$this->idContacto = $idContacto;

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

	/**
	 * Get the value of edad
	 */
	public function getEdad()
	{
		return $this->edad;
	}

	/**
	 * Set the value of edad
	 */
	public function setEdad($edad): self
	{
		$this->edad = $edad;

		return $this;
	}

	/**
	 * Get the value of email
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 */
	public function setEmail($email): self
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of telefono
	 */
	public function getTelefono()
	{
		return $this->telefono;
	}

	/**
	 * Set the value of telefono
	 */
	public function setTelefono($telefono): self
	{
		$this->telefono = $telefono;

		return $this;
	}

	/**
	 * Get the value of idPais
	 */
	public function getIdPais()
	{
		return $this->idPais;
	}

	/**
	 * Set the value of idPais
	 */
	public function setIdPais($idPais): self
	{
		$this->idPais = $idPais;

		return $this;
	}

	/**
	 * Get the value of idEstado
	 */
	public function getIdEstado()
	{
		return $this->idEstado;
	}

	/**
	 * Set the value of idEstado
	 */
	public function setIdEstado($idEstado): self
	{
		$this->idEstado = $idEstado;

		return $this;
	}

	/**
	 * Get the value of idGenero
	 */
	public function getIdGenero()
	{
		return $this->idGenero;
	}

	/**
	 * Set the value of idGenero
	 */
	public function setIdGenero($idGenero): self
	{
		$this->idGenero = $idGenero;

		return $this;
	}

	/**
	 * Get the value of nombrePais
	 */
	public function getNombrePais()
	{
		return $this->nombrePais;
	}

	/**
	 * Set the value of nombrePais
	 */
	public function setNombrePais($nombrePais): self
	{
		$this->nombrePais = $nombrePais;

		return $this;
	}

	/**
	 * Get the value of nombreEstado
	 */
	public function getNombreEstado()
	{
		return $this->nombreEstado;
	}

	/**
	 * Set the value of nombreEstado
	 */
	public function setNombreEstado($nombreEstado): self
	{
		$this->nombreEstado = $nombreEstado;

		return $this;
	}

	/**
	 * Get the value of nombreGenero
	 */
	public function getNombreGenero()
	{
		return $this->nombreGenero;
	}

	/**
	 * Set the value of nombreGenero
	 */
	public function setNombreGenero($nombreGenero): self
	{
		$this->nombreGenero = $nombreGenero;

		return $this;
	}
}

?>