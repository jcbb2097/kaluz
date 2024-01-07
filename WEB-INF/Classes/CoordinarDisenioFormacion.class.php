<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class CoordinarDisenioFormacion {

	private $IdKColaborador;
	private $IdLibro;
	private $IdTraductor;
	private $IdCorrector;
	private $IdDisenador;
	private $IdIlustrador;
	private $PrePrensa;
	private $IdImprenta;
	private $rutaPropuestaGrafica;
	private $FechaEntregaPropuestaGrafica;
	private $rutaMaqueta;
	private $FechaEntregaMaqueta;
	private $RutaIndice;
	private $FechaEntregaIndice;
    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerCoordinarDisenioFormacion(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdKColaborador,IdLibro,IdTraductor,IdCorrector,IdDisenador,IdIlustrador,PrePrensa,IdImprenta,
					rutaPropuestaGrafica,FechaEntregaPropuestaGrafica,rutaMaqueta,FechaEntregaMaqueta,RutaIndice,FechaEntregaIndice FROM `c_disenioFormacionLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	
            	$this->IdKColaborador = $row['IdKColaborador'];
				$this->IdLibro = $row['IdLibro'];
				$this->IdDisenador = $row['IdDisenador'];
				$this->IdIlustrador = $row['IdIlustrador'];
				$this->rutaPropuestaGrafica = $row['rutaPropuestaGrafica'];
				$this->rutaMaqueta = $row['rutaMaqueta'];
				$this->RutaIndice = $row['RutaIndice'];
				$this->FechaEntregaIndice = $row['FechaEntregaIndice'];

            }
            return $result;
	}

	public function obtenerCoordinarDisenioFormaciones(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdKColaborador,IdLibro,IdTraductor,IdCorrector,IdDisenador,IdIlustrador,PrePrensa,IdImprenta,
					rutaPropuestaGrafica,FechaEntregaPropuestaGrafica,rutaMaqueta,FechaEntregaMaqueta,RutaIndice,FechaEntregaIndice FROM `c_disenioFormacionLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            
            return $result;
	}

	public function agregarCoordinarDisenioFormacion(){
		$rutaUno = "";
		$rutaDos = "";
		$rutaTres = "";

		if (!isset($this->FechaEntregaPropuestaGrafica) || $this->FechaEntregaPropuestaGrafica == NULL || $this->FechaEntregaPropuestaGrafica == ""){
            $this->FechaEntregaPropuestaGrafica = "0000-00-00";
        }
        if (!isset($this->FechaEntregaMaqueta) || $this->FechaEntregaMaqueta == NULL || $this->FechaEntregaMaqueta == ""){
            $this->FechaEntregaMaqueta = "0000-00-00";
        }
        if (!isset($this->FechaEntregaIndice) || $this->FechaEntregaIndice == NULL || $this->FechaEntregaIndice == ""){
            $this->FechaEntregaIndice = "0000-00-00";
        }
        if (!isset($this->IdTraductor) || $this->IdTraductor == NULL || $this->IdTraductor == ""){
            $this->IdTraductor = "NULL";

        }
        if (!isset($this->IdCorrector) || $this->IdCorrector == NULL || $this->IdCorrector == ""){
            $this->IdCorrector = "NULL";

        }
        if (!isset($this->IdDisenador) || $this->IdDisenador == NULL || $this->IdDisenador == ""){
            $this->IdDisenador = "NULL";
        }
        if (!isset($this->IdIlustrador) || $this->IdIlustrador == NULL || $this->IdIlustrador == ""){
            $this->IdIlustrador = "NULL";

        }
        if (!isset($this->IdImprenta) || $this->IdImprenta == NULL || $this->IdImprenta == ""){
            $this->IdImprenta = "NULL";

        }
      
        if (!isset($this->rutaPropuestaGrafica) || $this->rutaPropuestaGrafica == NULL || $this->rutaPropuestaGrafica == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "NULL";
        }else{
        	$rutaUno =  "'".$this->rutaPropuestaGrafica."'";
        }
        if (!isset($this->rutaMaqueta) || $this->rutaMaqueta == NULL || $this->rutaMaqueta == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaDos = "NULL";
        }else{
        	$rutaDos =  "'".$this->rutaMaqueta."'";
        }
        if (!isset($this->RutaIndice) || $this->RutaIndice == NULL || $this->RutaIndice == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaTres = "NULL";
        }else{
        	$rutaTres =  "'".$this->RutaIndice."'";
        }

  		$insert ="INSERT INTO  c_disenioFormacionLibro (IdLibro,IdTraductor,IdCorrector,IdDisenador,IdIlustrador,PrePrensa,IdImprenta,rutaPropuestaGrafica,FechaEntregaPropuestaGrafica,rutaMaqueta,FechaEntregaMaqueta,RutaIndice,FechaEntregaIndice,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdTraductor.",".$this->IdCorrector.",".$this->IdDisenador.",".$this->IdIlustrador.",'".$this->PrePrensa."',".$this->IdImprenta.",".$rutaUno.",'".$this->FechaEntregaPropuestaGrafica."',".$rutaDos.",'".$this->FechaEntregaMaqueta."',".$rutaTres.",'".$this->FechaEntregaIndice."','".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdKColaborador = $catalogo->insertarRegistro($insert);

        if ($this->IdKColaborador == 0 || $this->IdKColaborador == null) {
            return false;
        }
        return true;
	}

    public function eliminarDisenioFormacio(){
        
        $catalogo = new Catalogo();

        $tabla = "c_disenioFormacionLibro";
        $where = "IdLibro = " . $this->IdLibro;
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }
	/*public function editarCoordinarDisenioFormacion(){
		$rutaUno = "";
	
		if (!isset($this->IdDisenador) || $this->IdDisenador == NULL || $this->IdDisenador == ""){
            $this->IdDisenador = "NULL";
        }
        if (!isset($this->IdIlustrador) || $this->IdIlustrador == NULL || $this->IdIlustrador == ""){
            $this->IdIlustrador = "NULL";

        }		

        if (!isset($this->rutaPropuestaGrafica) || $this->rutaPropuestaGrafica == NULL || $this->rutaPropuestaGrafica == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "";
        }else{
        	$rutaUno =  ",rutaPropuestaGrafica ="."'".$this->rutaPropuestaGrafica."'";
        }

        if (!isset($this->rutaMaqueta) || $this->rutaMaqueta == NULL || $this->rutaMaqueta == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaDos = "";
        }else{
        	$rutaDos =  ",rutaMaqueta ="."'".$this->rutaMaqueta."'";
        }

        if (!isset($this->RutaIndice) || $this->RutaIndice == NULL || $this->RutaIndice == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaTres = "";
        }else{
        	$rutaTres =  ",RutaIndice ="."'".$this->RutaIndice."'";
        }

  		$insert ="UPDATE c_disenioFormacionLibro SET IdIlustrador = ".$this->IdIlustrador.", IdDisenador = ".$this->IdDisenador."".$rutaUno.",FechaEntregaIndice = '".$this->FechaEntregaIndice."'".$rutaDos."".$rutaTres.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

  		$catalogo = new Catalogo();

  		echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert,'', '');

        if ($query == 1) {
            return true;
        }
        return false;
	}*/



	public function getIdLibro()
	{
	    return $this->IdLibro;
	}

	public function setIdLibro($IdLibro)
	{
	    $this->IdLibro = $IdLibro;

	}
	
	public function setIdDisenador($param) {
        $this->IdDisenador = $param;
    }
    public function getIdDisenador() {
        return $this->IdDisenador;
    }
    public function setIdIlustrador($param) {
        $this->IdIlustrador = $param;
    }
    public function getIdIlustrador() {
        return $this->IdIlustrador;
    }

    public function setFechaIndice($FechaEntregaIndice) {
        $this->FechaEntregaIndice = $FechaEntregaIndice;
    }
    
    public function getFechaIndice() {
        return $this->fechaIndice;
    }

    public function setPDFMaqueta($param) {
        $this->rutaMaqueta=$param;
    }
    public function getPDFMaqueta() {
        return $this->rutaMaqueta;
    }

    public function setPDFPropuestaGrafica($rutaPropuestaGrafica) {
        $this->rutaPropuestaGrafica=$rutaPropuestaGrafica;
    }
    public function getPDFPropuestaGrafica() {
        return $this->rutaPropuestaGrafica;
    }

    public function setPdfIndice($RutaIndice) {
        $this->RutaIndice = $RutaIndice;
    }

    public function getPdfIndice() {
       return $this->RutaIndice;
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