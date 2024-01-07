<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class CarpetaPresentacion {

	private $IdCarpetaPresentacion;
	private $IdLibro;
	private $IdEntregableElaborarIndiceCarpeta;
	private $rutaEntregableElaborarIndiceCarpeta;
	private $IdEntregableSinopsisCatalogo;
	private $rutaEntregableSinopsisCatalogo;

    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerCarpetaPresentacion(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdCarpetaPresentacion,IdLibro,IdEntregableElaborarIndiceCarpeta,IdEntregableSinopsisCatalogo,
	rutaEntregableElaborarIndiceCarpeta,rutaEntregableSinopsisCatalogo FROM `c_carpetaPresentacionLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdEntregableElaborarIndiceCarpeta = $row['IdEntregableElaborarIndiceCarpeta'];
            	$this->rutaEntregableElaborarIndiceCarpeta = $row['rutaEntregableElaborarIndiceCarpeta'];
            	$this->IdEntregableSinopsisCatalogo = $row['IdEntregableSinopsisCatalogo'];
            	$this->rutaEntregableSinopsisCatalogo = $row['rutaEntregableSinopsisCatalogo'];

            }
            return $result;
	}

	public function agregarCarpetaPresentacion(){
		$rutaUno = "";
		$rutaDos = "";
		if (!isset($this->IdEntregableElaborarIndiceCarpeta) || $this->IdEntregableElaborarIndiceCarpeta == NULL || $this->IdEntregableElaborarIndiceCarpeta == ""){
            $this->IdEntregableElaborarIndiceCarpeta = "NULL";
        }
        if (!isset($this->IdEntregableSinopsisCatalogo) || $this->IdEntregableSinopsisCatalogo == NULL || $this->IdEntregableSinopsisCatalogo == ""){
            $this->IdEntregableSinopsisCatalogo = "NULL";

        }

        if (!isset($this->rutaEntregableElaborarIndiceCarpeta) || $this->rutaEntregableElaborarIndiceCarpeta == NULL || $this->rutaEntregableElaborarIndiceCarpeta == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "NULL";
        }else{
        	$rutaUno =  "'".$this->rutaEntregableElaborarIndiceCarpeta."'";
        }

        if (!isset($this->rutaEntregableSinopsisCatalogo) || $this->rutaEntregableSinopsisCatalogo == NULL || $this->rutaEntregableSinopsisCatalogo == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaDos = "NULL";
        }else{
        	$rutaDos =  "'".$this->rutaEntregableSinopsisCatalogo."'";
        }

  		$insert ="INSERT INTO  c_carpetaPresentacionLibro (IdLibro,IdEntregableElaborarIndiceCarpeta,rutaEntregableElaborarIndiceCarpeta,
	IdEntregableSinopsisCatalogo,rutaEntregableSinopsisCatalogo,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdEntregableElaborarIndiceCarpeta.",".$rutaUno.",".$this->IdEntregableSinopsisCatalogo.",".$rutaDos.",'".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdCarpetaPresentacion = $catalogo->insertarRegistro($insert);

        if ($this->IdCarpetaPresentacion == 0 || $this->IdCarpetaPresentacion == null) {
            return false;
        }
        return true;
	}
	public function editarCarpetaPresentacion(){
		$rutaDos ="";
		$rutaUno = "";
		if (!isset($this->IdEntregableElaborarIndiceCarpeta) || $this->IdEntregableElaborarIndiceCarpeta == NULL || $this->IdEntregableElaborarIndiceCarpeta == ""){
            $this->IdEntregableElaborarIndiceCarpeta = "NULL";
        }
        if (!isset($this->IdEntregableSinopsisCatalogo) || $this->IdEntregableSinopsisCatalogo == NULL || $this->IdEntregableSinopsisCatalogo == ""){
            $this->IdEntregableSinopsisCatalogo = "NULL";

        }


        if (!isset($this->rutaEntregableElaborarIndiceCarpeta) || $this->rutaEntregableElaborarIndiceCarpeta == NULL || $this->rutaEntregableElaborarIndiceCarpeta == ""){
            //$this->Imagen = "NULL";
            $rutaUno = "";
        }else{
        	$rutaUno =  ",rutaEntregableElaborarIndiceCarpeta = "."'".$this->rutaEntregableElaborarIndiceCarpeta."'";
        }

        if (!isset($this->rutaEntregableSinopsisCatalogo) || $this->rutaEntregableSinopsisCatalogo == NULL || $this->rutaEntregableSinopsisCatalogo == ""){
            //$this->Imagen = "NULL";
            $rutaDos = "";
        }else{
        	$rutaDos =  ",rutaEntregableSinopsisCatalogo = "."'".$this->rutaEntregableSinopsisCatalogo."'";
        }
  		$insert ="UPDATE c_carpetaPresentacionLibro SET IdEntregableElaborarIndiceCarpeta = ".$this->IdEntregableElaborarIndiceCarpeta."".$rutaUno.",IdEntregableSinopsisCatalogo = ".$this->IdEntregableSinopsisCatalogo."".$rutaDos.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert,'', '');

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

	public function getRutaEntregableElaborarIndiceCarpeta()
	{
	    return $this->rutaEntregableElaborarIndiceCarpeta;
	}

	public function setRutaEntregableElaborarIndiceCarpeta($rutaEntregableElaborarIndiceCarpeta)
	{
	    $this->rutaEntregableElaborarIndiceCarpeta = $rutaEntregableElaborarIndiceCarpeta;

	}
	public function getRutaEntregableSinopsisCatalogo()
	{
	    return $this->rutaEntregableSinopsisCatalogo;
	}

	public function setRutaEntregableSinopsisCatalogo($rutaEntregableSinopsisCatalogo)
	{
	    $this->rutaEntregableSinopsisCatalogo = $rutaEntregableSinopsisCatalogo;

	}
	public function getIdEntregableSinopsisCatalogo()
	{
	    return $this->IdEntregableSinopsisCatalogo;
	}

	public function setIdEntregableSinopsisCatalogo($IdEntregableSinopsisCatalogo)
	{
	    $this->IdEntregableSinopsisCatalogo = $IdEntregableSinopsisCatalogo;

	}
	public function getIdEntregableElaborarIndiceCarpeta()
	{
	    return $this->IdEntregableElaborarIndiceCarpeta;
	}

	public function setIdEntregableElaborarIndiceCarpeta($IdEntregableElaborarIndiceCarpeta)
	{
	    $this->IdEntregableElaborarIndiceCarpeta = $IdEntregableElaborarIndiceCarpeta;

	}
	
	public function getIdCarpetaPresentacion()
	{
	    return $this->IdCarpetaPresentacion;
	}

	public function setIdCarpetaPresentacion($IdCarpetaPresentacion)
	{
	    $this->IdCarpetaPresentacion = $IdCarpetaPresentacion;

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