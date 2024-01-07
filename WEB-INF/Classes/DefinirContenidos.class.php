<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class DefinirContenidos {

	private $IdContenidosLibro;
    private $IdLibro;
    private $IdEntregableIndicePreliminar;
	private $rutaEntregableIndicePreliminar;
	private $FechaEnvio;
	private $FechaEntrega;
	private $VoboFinalCreadorConceptoCuratorial;
	private $IdCheckList;
    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;

	
	public function obtenerDefinirContenidos(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdEntregableIndicePreliminar,rutaEntregableIndicePreliminar,FechaEnvio,FechaEntrega FROM `c_contenidosLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdEntregableIndicePreliminar = $row['IdEntregableIndicePreliminar'];
            	$this->rutaEntregableIndicePreliminar = $row['rutaEntregableIndicePreliminar'];
            	$this->FechaEnvio = $row['FechaEnvio'];
            	$this->FechaEntrega = $row['FechaEntrega'];

            }
            return $result;
	}

	public function agregarDefinirContenidos(){
		$ruta = "";
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->IdEntregableIndicePreliminar) || $this->IdEntregableIndicePreliminar == NULL || $this->IdEntregableIndicePreliminar == ""){
            $this->IdEntregableIndicePreliminar = "NULL";

        }
        if (!isset($this->FechaEnvio) || $this->FechaEnvio == NULL || $this->FechaEnvio == ""){
            $this->FechaEnvio = "0000-00-00";

        }
        if (!isset($this->FechaEntrega) || $this->FechaEntrega == NULL || $this->FechaEntrega == ""){
            $this->FechaEntrega = "0000-00-00";

        }
        if (!isset($this->rutaEntregableIndicePreliminar) || $this->rutaEntregableIndicePreliminar == NULL || $this->rutaEntregableIndicePreliminar == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$ruta = "NULL";
        }else{
        	$ruta =  "'".$this->rutaEntregableIndicePreliminar."'";
        }

  		$insert ="INSERT INTO  c_contenidosLibro (IdLibro,IdEntregableIndicePreliminar,rutaEntregableIndicePreliminar,FechaEnvio,FechaEntrega,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdEntregableIndicePreliminar.",".$ruta.",'".$this->FechaEnvio."','".$this->FechaEntrega."','".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdContenidosLibro = $catalogo->insertarRegistro($insert);

        if ($this->IdContenidosLibro == 0 || $this->IdContenidosLibro == null) {
            return false;
        }
        return true;
	}
	public function editarDefinirContenidos(){
		$ruta="";
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->IdEntregableIndicePreliminar) || $this->IdEntregableIndicePreliminar == NULL || $this->IdEntregableIndicePreliminar == ""){
            $this->IdEntregableIndicePreliminar = "NULL";

        }
        if (!isset($this->FechaEnvio) || $this->FechaEnvio == NULL || $this->FechaEnvio == ""){
            $this->FechaEnvio = "0000-00-00";

        }
        if (!isset($this->FechaEntrega) || $this->FechaEntrega == NULL || $this->FechaEntrega == ""){
            $this->FechaEntrega = "0000-00-00";

        }
        if (!isset($this->rutaEntregableIndicePreliminar) || $this->rutaEntregableIndicePreliminar == NULL || $this->rutaEntregableIndicePreliminar == ""){
            //$this->Imagen = "NULL";
            $ruta = "";
        }else{
        	$ruta =  ",rutaEntregableIndicePreliminar = "."'".$this->rutaEntregableIndicePreliminar."'";
        }

  		$insert ="UPDATE c_contenidosLibro SET IdEntregableIndicePreliminar = ".$this->IdEntregableIndicePreliminar."".$ruta.",FechaEnvio = '".$this->FechaEnvio."',FechaEntrega = '".$this->FechaEntrega."',UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_libro', 'IdLibro = ' . $this->IdLibro);

        if ($query == 1) {
            return true;
        }
        return false;
	}



	public function getIdLibro()
	{
	    return $this->IdLibro;
	}

	public function setIdLibro($IdLibro)
	{
	    $this->IdLibro = $IdLibro;

	}
	public function getIdEntregableIndicePreliminar()
	{
	    return $this->IdEntregableIndicePreliminar;
	}

	public function setIdEntregableIndicePreliminar($IdEntregableIndicePreliminar)
	{
	    $this->IdEntregableIndicePreliminar = $IdEntregableIndicePreliminar;

	}

	public function getRutaEntregableIndicePreliminar()
	{
	    return $this->rutaEntregableIndicePreliminar;
	}

	public function setRutaEntregableIndicePreliminar($rutaEntregableIndicePreliminar)
	{
	    $this->rutaEntregableIndicePreliminar = $rutaEntregableIndicePreliminar;

	}

	public function getFechaEnvio()
	{
	    return $this->FechaEnvio;
	}

	public function setFechaEnvio($FechaEnvio)
	{
	    $this->FechaEnvio = $FechaEnvio;

	}

	public function getFechaEntrega()
	{
	    return $this->FechaEntrega;
	}

	public function setFechaEntrega($FechaEntrega)
	{
	    $this->FechaEntrega = $FechaEntrega;

	}

	public function getVoboFinalCreadorConceptoCuratorial()
	{
	    return $this->VoboFinalCreadorConceptoCuratorial;
	}

	public function setVoboFinalCreadorConceptoCuratorial($VoboFinalCreadorConceptoCuratorial)
	{
	    $this->VoboFinalCreadorConceptoCuratorial = $VoboFinalCreadorConceptoCuratorial;

	}

	public function getIdCheckList()
	{
	    return $this->IdCheckList;
	}

	public function setIdCheckList($IdCheckList)
	{
	    $this->IdCheckList = $IdCheckList;

	}

	public function getUsuarioCreacion()
	{
	    return $this->UsuarioCreacion;
	}

	public function setUsuarioCreacion($UsuarioCreacion)
	{
	    $this->UsuarioCreacion = $UsuarioCreacion;

	}

	public function getFechaCreacion()
	{
	    return $this->FechaCreacion;
	}

	public function setFechaCreacion($FechaCreacion)
	{
	    $this->FechaCreacion = $FechaCreacion;

	}

	public function getUsuarioUltimaModificiacion()
	{
	    return $this->UsuarioUltimaModificiacion;
	}

	public function setUsuarioUltimaModificiacion($UsuarioUltimaModificiacion)
	{
	    $this->UsuarioUltimaModificiacion = $UsuarioUltimaModificiacion;

	}

	public function getFechaUltimaModificacion()
	{
	    return $this->FechaUltimaModificacion;
	}

	public function setFechaUltimaModificacion($FechaUltimaModificacion)
	{
	    $this->FechaUltimaModificacion = $FechaUltimaModificacion;

	}

	public function getPantalla()
	{
	    return $this->Pantalla;
	}

	public function setPantalla($Pantalla)
	{
	    $this->Pantalla = $Pantalla;

	}


}

?>