<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class ElaborarRutaCritica {

	private $IdRutaCritica;
    private $IdLibro;
    private $IdEntregableCalendarioProduccion;
	private $rutaEntregableCalendarioProduccion;
	private $FechaInicio;
	private $FechaPublicacion;
    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	/*public function obtenerElaborarRutaCritica(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdEntregableCalendarioProduccion,rutaEntregableCalendarioProduccion,FechaInicio,FechaPublicacion FROM `c_rutaCriticaLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdEntregableCalendarioProduccion = $row['IdEntregableCalendarioProduccion'];
            	$this->rutaEntregableCalendarioProduccion = $row['rutaEntregableCalendarioProduccion'];
            	$this->FechaInicio = $row['FechaInicio'];
            	$this->FechaPublicacion = $row['FechaPublicacion'];

            }
            return $result;
	}*/

	public function obtenerElaborarRutaCritica(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdEntregableCalendarioProduccion,rutaEntregableCalendarioProduccion,FechaInicio,FechaPublicacion FROM `c_rutaCriticaLibro` WHERE IdLibro =". $this->IdLibro." AND IdEntregableCalendarioProduccion IS NOT NULL";
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);

            return $result;
	}

	public function agregarElaborarRutaCritica(){
		$ruta = "";
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->IdEntregableCalendarioProduccion) || $this->IdEntregableCalendarioProduccion == NULL || $this->IdEntregableCalendarioProduccion == ""){
            $this->IdEntregableIndicePreliminar = "NULL";

        }
        if (!isset($this->FechaInicio) || $this->FechaInicio == NULL || $this->FechaInicio == ""){
            $this->FechaInicio = "0000-00-00";

        }
        if (!isset($this->FechaPublicacion) || $this->FechaPublicacion == NULL || $this->FechaPublicacion == ""){
            $this->FechaPublicacion = "0000-00-00";

        }
        if (!isset($this->rutaEntregableCalendarioProduccion) || $this->rutaEntregableCalendarioProduccion == NULL || $this->rutaEntregableCalendarioProduccion == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$ruta = "NULL";
        }else{
        	$ruta =  "'".$this->rutaEntregableCalendarioProduccion."'";
        }

  		$insert ="INSERT INTO  c_rutaCriticaLibro (IdLibro,IdEntregableCalendarioProduccion,rutaEntregableCalendarioProduccion,FechaInicio,FechaPublicacion,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdEntregableCalendarioProduccion.",".$ruta.",'".$this->FechaInicio."','".$this->FechaPublicacion."','".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdRutaCritica = $catalogo->insertarRegistro($insert);

        if ($this->IdRutaCritica == 0 || $this->IdRutaCritica == null) {
            return false;
        }
        return true;
	}
	public function editarElaborarRutaCritica(){
		$ruta="";
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->IdEntregableCalendarioProduccion) || $this->IdEntregableCalendarioProduccion == NULL || $this->IdEntregableCalendarioProduccion == ""){
            $this->IdEntregableCalendarioProduccion = "NULL";

        }
        if (!isset($this->FechaInicio) || $this->FechaInicio == NULL || $this->FechaInicio == ""){
            $this->FechaInicio = "0000-00-00";

        }
        if (!isset($this->FechaPublicacion) || $this->FechaPublicacion == NULL || $this->FechaPublicacion == ""){
            $this->FechaPublicacion = "0000-00-00";

        }
        if (!isset($this->rutaEntregableCalendarioProduccion) || $this->rutaEntregableCalendarioProduccion == NULL || $this->rutaEntregableCalendarioProduccion == ""){
            //$this->Imagen = "NULL";
            $ruta = "";
        }else{
        	$ruta =  ",rutaEntregableCalendarioProduccion = "."'".$this->rutaEntregableCalendarioProduccion."'";
        }

  		$insert ="UPDATE c_rutaCriticaLibro SET IdEntregableCalendarioProduccion = ".$this->IdEntregableCalendarioProduccion."".$ruta.",FechaInicio = '".$this->FechaInicio."',FechaPublicacion = '".$this->FechaPublicacion."',UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = $this->IdLibro";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_libro', 'IdLibro = ' . $this->IdLibro);

        if ($query == 1) {
            return true;
        }
        return $query;
	}



	public function getIdLibro()
	{
	    return $this->IdLibro;
	}

	public function setIdLibro($IdLibro)
	{
	    $this->IdLibro = $IdLibro;

	}
	public function getIdEntregableCalendarioProduccion()
	{
	    return $this->IdEntregableCalendarioProduccion;
	}

	public function setIdEntregableCalendarioProduccion($IdEntregableCalendarioProduccion)
	{
	    $this->IdEntregableCalendarioProduccion = $IdEntregableCalendarioProduccion;

	}

	public function getRutaEntregableCalendarioProduccion()
	{
	    return $this->rutaEntregableCalendarioProduccion;
	}

	public function setRutaEntregableCalendarioProduccion($rutaEntregableCalendarioProduccion)
	{
	    $this->rutaEntregableCalendarioProduccion = $rutaEntregableCalendarioProduccion;

	}

	public function getFechaInicio()
	{
	    return $this->FechaInicio;
	}

	public function setFechaInicio($FechaInicio)
	{
	    $this->FechaInicio = $FechaInicio;

	}

	public function getFechaPublicacion()
	{
	    return $this->FechaPublicacion;
	}

	public function setFechaPublicacion($FechaPublicacion)
	{
	    $this->FechaPublicacion = $FechaPublicacion;

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