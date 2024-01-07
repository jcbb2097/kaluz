<?php
/*created by Leasim*/
class Opinion implements JsonSerializable
{
	private $idOpinion;
	private $descripcion;
	private $fechaCreo;
	private $idOrigen;
	private $idTipo;
	private $idProceso;
	private $estatus;
	private $usuarioMod;
	private $fechaMod;

	private $nombreOrigen;
	private $nombreTipo;
	private $nombreProceso;

	private $idContacto;
	private $nombre;
	private $apPat;
	private $apMat;
	private $edad;
	private $email;
	private $telefono;
	private $idPais;
	private $idEstado;
	private $idGenero;

	private $usuarioCreo;
	private $fechaCrea;

	private $nombrePais;
	private $nombreEstado;
	private $nombreGenero;
	private $nombreEje;
	
	private $idDetalle;
	private $idEje;
	private $idArea;
	private $idExposicion;
	private $idCategoria;
	private $idSubcategoria;
	private $idActividadGlobal;
	private $idActividadGeneral;
	private $idCheck;
	private $idSubcheck;
	private $idPersonaResponsable;
	private $medioRespuesta;
	private $respuesta;
	private $fechaTurnado;
	private $fechaAtendido;

	private $nombreArea;
	private $nombreExposicion;
	private $nombreCategoria;
	private $nombreSubcategoria;
	private $nombreActividadGlobal;
	private $nombreActividadGeneral;
	private $nombreCheck;
	private $nombreSubcheck;
	private $nombrePersonaResponsable;

	private $apPatResponde;
	private $apMatResponde;

	private $anio;
	private $mes;
	private $dia;
	private $mesNumero;
	private $orden;
	private $idResponsableEje;

	private $numeroOrdenGlobal;
	private $numeroOrdenGral;
	private $ordenCheck;
	private $ordenSubcheck;
	private $idUsuario;
	private $recibeInfo;

	
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
	
	public function __construct18($descripcion,$fechaCreo,$idOrigen,$idTipo,$idProceso,$estatus,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero,$usuarioCreo,$fechaCrea,$recibeInfo)
	{
		$this -> descripcion = $descripcion;
		$this -> fechaCreo = $fechaCreo;
		$this -> idOrigen = $idOrigen;
		$this -> idTipo = $idTipo;
		$this -> idProceso = $idProceso;
		$this -> estatus = $estatus;
		$this -> nombre = $nombre;
		$this -> apPat = $apPat;
		$this -> apMat = $apMat;
		$this -> edad = $edad;
		$this -> email = $email;
		$this -> telefono = $telefono;
		$this -> idPais = $idPais;
		$this -> idEstado = $idEstado;
		$this -> idGenero = $idGenero;
		$this -> usuarioCreo = $usuarioCreo;
		$this -> fechaCrea = $fechaCrea;
		$this -> recibeInfo = $recibeInfo;
	}
	
	public function __construct19($idOpinion,$descripcion,$fechaCreo,$idOrigen,$idTipo,$idProceso,$estatus,$nombre,$apPat,$apMat,$edad,$email,$telefono,$idPais,$idEstado,$idGenero,$usuarioMod,$fechaMod,$recibeInfo)
	{
		$this -> idOpinion = $idOpinion;
		$this -> descripcion = $descripcion;
		$this -> fechaCreo = $fechaCreo;
		$this -> idOrigen = $idOrigen;
		$this -> idTipo = $idTipo;
		$this -> idProceso = $idProceso;
		$this -> estatus = $estatus;
		$this -> nombre = $nombre;
		$this -> apPat = $apPat;
		$this -> apMat = $apMat;
		$this -> edad = $edad;
		$this -> email = $email;
		$this -> telefono = $telefono;
		$this -> idPais = $idPais;
		$this -> idEstado = $idEstado;
		$this -> idGenero = $idGenero;
		$this -> usuarioMod = $usuarioMod;
		$this -> fechaMod = $fechaMod;
		$this -> recibeInfo = $recibeInfo;
	}

	public function __construct9($idOpinion,$descripcion,$fechaCreo,$idOrigen,$idTipo,$idProceso,$estatus,$usuarioMod,$fechaMod)
	{
		$this -> idOpinion = $idOpinion;
		$this -> descripcion = $descripcion;
		$this -> fechaCreo = $fechaCreo;
		$this -> idOrigen = $idOrigen;
		$this -> idTipo = $idTipo;
		$this -> idProceso = $idProceso;
		$this -> estatus = $estatus;
		$this -> usuarioMod = $usuarioMod;
		$this -> fechaMod = $fechaMod;
	}

	public function __construct11($idOpinion,$descripcion,$fechaCreo,$idTipo,$nombre,$apPat,$apMat,$email,$telefono,$usuarioMod,$fechaMod)
	{
		$this -> idOpinion = $idOpinion;
		$this -> descripcion = $descripcion;
		$this -> fechaCreo = $fechaCreo;
		$this -> idTipo = $idTipo;
		$this -> nombre = $nombre;
		$this -> apPat = $apPat;
		$this -> apMat = $apMat;
		$this -> email = $email;
		$this -> telefono = $telefono;
		$this -> usuarioMod = $usuarioMod;
		$this -> fechaMod = $fechaMod;
	}
	

	public function jsonSerialize()
    {
        $vars = get_object_vars($this);
		return $vars;
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
	 * Get the value of idOrigen
	 */
	public function getIdOrigen()
	{
		return $this->idOrigen;
	}

	/**
	 * Set the value of idOrigen
	 */
	public function setIdOrigen($idOrigen): self
	{
		$this->idOrigen = $idOrigen;

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
	 * Get the value of idProceso
	 */
	public function getIdProceso()
	{
		return $this->idProceso;
	}

	/**
	 * Set the value of idProceso
	 */
	public function setIdProceso($idProceso): self
	{
		$this->idProceso = $idProceso;

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

	/**
	 * Get the value of nombreOrigen
	 */
	public function getNombreOrigen()
	{
		return $this->nombreOrigen;
	}

	/**
	 * Set the value of nombreOrigen
	 */
	public function setNombreOrigen($nombreOrigen): self
	{
		$this->nombreOrigen = $nombreOrigen;

		return $this;
	}

	/**
	 * Get the value of nombreTipo
	 */
	public function getNombreTipo()
	{
		return $this->nombreTipo;
	}

	/**
	 * Set the value of nombreTipo
	 */
	public function setNombreTipo($nombreTipo): self
	{
		$this->nombreTipo = $nombreTipo;

		return $this;
	}

	/**
	 * Get the value of nombreProceso
	 */
	public function getNombreProceso()
	{
		return $this->nombreProceso;
	}

	/**
	 * Set the value of nombreProceso
	 */
	public function setNombreProceso($nombreProceso): self
	{
		$this->nombreProceso = $nombreProceso;

		return $this;
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
	 * Get the value of fechaCrea
	 */
	public function getFechaCrea()
	{
		return $this->fechaCrea;
	}

	/**
	 * Set the value of fechaCrea
	 */
	public function setFechaCrea($fechaCrea): self
	{
		$this->fechaCrea = $fechaCrea;

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
	 * Get the value of idPersonaResponsable
	 */
	public function getIdPersonaResponsable()
	{
		return $this->idPersonaResponsable;
	}

	/**
	 * Set the value of idPersonaResponsable
	 */
	public function setIdPersonaResponsable($idPersonaResponsable): self
	{
		$this->idPersonaResponsable = $idPersonaResponsable;

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

	/**
	 * Get the value of nombreExposicion
	 */
	public function getNombreExposicion()
	{
		return $this->nombreExposicion;
	}

	/**
	 * Set the value of nombreExposicion
	 */
	public function setNombreExposicion($nombreExposicion): self
	{
		$this->nombreExposicion = $nombreExposicion;

		return $this;
	}

	/**
	 * Get the value of nombreCategoria
	 */
	public function getNombreCategoria()
	{
		return $this->nombreCategoria;
	}

	/**
	 * Set the value of nombreCategoria
	 */
	public function setNombreCategoria($nombreCategoria): self
	{
		$this->nombreCategoria = $nombreCategoria;

		return $this;
	}

	/**
	 * Get the value of nombreSubcategoria
	 */
	public function getNombreSubcategoria()
	{
		return $this->nombreSubcategoria;
	}

	/**
	 * Set the value of nombreSubcategoria
	 */
	public function setNombreSubcategoria($nombreSubcategoria): self
	{
		$this->nombreSubcategoria = $nombreSubcategoria;

		return $this;
	}

	/**
	 * Get the value of nombreActividadGlobal
	 */
	public function getNombreActividadGlobal()
	{
		return $this->nombreActividadGlobal;
	}

	/**
	 * Set the value of nombreActividadGlobal
	 */
	public function setNombreActividadGlobal($nombreActividadGlobal): self
	{
		$this->nombreActividadGlobal = $nombreActividadGlobal;

		return $this;
	}

	/**
	 * Get the value of nombreActividadGeneral
	 */
	public function getNombreActividadGeneral()
	{
		return $this->nombreActividadGeneral;
	}

	/**
	 * Set the value of nombreActividadGeneral
	 */
	public function setNombreActividadGeneral($nombreActividadGeneral): self
	{
		$this->nombreActividadGeneral = $nombreActividadGeneral;

		return $this;
	}

	/**
	 * Get the value of nombreCheck
	 */
	public function getNombreCheck()
	{
		return $this->nombreCheck;
	}

	/**
	 * Set the value of nombreCheck
	 */
	public function setNombreCheck($nombreCheck): self
	{
		$this->nombreCheck = $nombreCheck;

		return $this;
	}

	/**
	 * Get the value of nombreSubcheck
	 */
	public function getNombreSubcheck()
	{
		return $this->nombreSubcheck;
	}

	/**
	 * Set the value of nombreSubcheck
	 */
	public function setNombreSubcheck($nombreSubcheck): self
	{
		$this->nombreSubcheck = $nombreSubcheck;

		return $this;
	}

	/**
	 * Get the value of nombrePersonaResponsable
	 */
	public function getNombrePersonaResponsable()
	{
		return $this->nombrePersonaResponsable;
	}

	/**
	 * Set the value of nombrePersonaResponsable
	 */
	public function setNombrePersonaResponsable($nombrePersonaResponsable): self
	{
		$this->nombrePersonaResponsable = $nombrePersonaResponsable;

		return $this;
	}

	/**
	 * Get the value of apPatResponde
	 */
	public function getApPatResponde()
	{
		return $this->apPatResponde;
	}

	/**
	 * Set the value of apPatResponde
	 */
	public function setApPatResponde($apPatResponde): self
	{
		$this->apPatResponde = $apPatResponde;

		return $this;
	}

	/**
	 * Get the value of apMatResponde
	 */
	public function getApMatResponde()
	{
		return $this->apMatResponde;
	}

	/**
	 * Set the value of apMatResponde
	 */
	public function setApMatResponde($apMatResponde): self
	{
		$this->apMatResponde = $apMatResponde;

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
	 * Get the value of mes
	 */
	public function getMes()
	{
		return $this->mes;
	}

	/**
	 * Set the value of mes
	 */
	public function setMes($mes): self
	{
		$this->mes = $mes;

		return $this;
	}

	/**
	 * Get the value of dia
	 */
	public function getDia()
	{
		return $this->dia;
	}

	/**
	 * Set the value of dia
	 */
	public function setDia($dia): self
	{
		$this->dia = $dia;

		return $this;
	}

	/**
	 * Get the value of mesNumero
	 */
	public function getMesNumero()
	{
		return $this->mesNumero;
	}

	/**
	 * Set the value of mesNumero
	 */
	public function setMesNumero($mesNumero): self
	{
		$this->mesNumero = $mesNumero;

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

	/**
	 * Get the value of idResponsableEje
	 */
	public function getIdResponsableEje()
	{
		return $this->idResponsableEje;
	}

	/**
	 * Set the value of idResponsableEje
	 */
	public function setIdResponsableEje($idResponsableEje): self
	{
		$this->idResponsableEje = $idResponsableEje;

		return $this;
	}

	/**
	 * Get the value of numeroOrdenGlobal
	 */
	public function getNumeroOrdenGlobal()
	{
		return $this->numeroOrdenGlobal;
	}

	/**
	 * Set the value of numeroOrdenGlobal
	 */
	public function setNumeroOrdenGlobal($numeroOrdenGlobal): self
	{
		$this->numeroOrdenGlobal = $numeroOrdenGlobal;

		return $this;
	}

	/**
	 * Get the value of numeroOrdenGral
	 */
	public function getNumeroOrdenGral()
	{
		return $this->numeroOrdenGral;
	}

	/**
	 * Set the value of numeroOrdenGral
	 */
	public function setNumeroOrdenGral($numeroOrdenGral): self
	{
		$this->numeroOrdenGral = $numeroOrdenGral;

		return $this;
	}

	/**
	 * Get the value of ordenCheck
	 */
	public function getOrdenCheck()
	{
		return $this->ordenCheck;
	}

	/**
	 * Set the value of ordenCheck
	 */
	public function setOrdenCheck($ordenCheck): self
	{
		$this->ordenCheck = $ordenCheck;

		return $this;
	}

	/**
	 * Get the value of ordenSubcheck
	 */
	public function getOrdenSubcheck()
	{
		return $this->ordenSubcheck;
	}

	/**
	 * Set the value of ordenSubcheck
	 */
	public function setOrdenSubcheck($ordenSubcheck): self
	{
		$this->ordenSubcheck = $ordenSubcheck;

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
	 * Get the value of recibeInfo
	 */
	public function getRecibeInfo()
	{
		return $this->recibeInfo;
	}

	/**
	 * Set the value of recibeInfo
	 */
	public function setRecibeInfo($recibeInfo): self
	{
		$this->recibeInfo = $recibeInfo;

		return $this;
	}
}

?>