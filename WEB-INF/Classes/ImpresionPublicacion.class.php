<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class ImpresionPublicacion {

	private $idImpresion;
	private $IdLibro;
	private $IdPreprensa;
	private $prePrensa;
	private $IdImprenta;
	private $RutaPruebasColor;
	private $FechaEntregaPruebasColor;
	private $FechaEntregaRealPruebasColor;
	private $RutaVboPieImprenta;
	private $FechaEntregaPieImprenta;
	private $FechaEntregaRealPieImprenta;
	private $RutaVoboSTecnicaImpFinal;
	private $FechaEntregaVboSTecnicaImpFinal;
	private $FechaEntregaRealVboSTecnicaImpFinal;

    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerImpresionPublicacion(){

		$catalogo = new Catalogo();
        $consulta ="SELECT idImpresion,IdLibro,IdPreprensa,prePrensa,IdImprenta,RutaPruebasColor,FechaEntregaPruebasColor,FechaEntregaRealPruebasColor,RutaVboPieImprenta,FechaEntregaPieImprenta,FechaEntregaRealPieImprenta,RutaVoboSTecnicaImpFinal,FechaEntregaVboSTecnicaImpFinal,FechaEntregaRealVboSTecnicaImpFinal FROM `c_impresion` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdPreprensa = $row['IdPreprensa'];
            	$this->prePrensa = $row['prePrensa'];
            	$this->IdImprenta = $row['IdImprenta'];
            	$this->RutaPruebasColor = $row['RutaPruebasColor'];
            	$this->FechaEntregaPruebasColor = $row['FechaEntregaPruebasColor'];
            	$this->FechaEntregaRealPruebasColor = $row['FechaEntregaRealPruebasColor'];
            	$this->RutaVboPieImprenta = $row['RutaVboPieImprenta'];
            	$this->FechaEntregaPieImprenta = $row['FechaEntregaPieImprenta'];
            	$this->FechaEntregaRealPieImprenta = $row['FechaEntregaRealPieImprenta'];
            	$this->RutaVoboSTecnicaImpFinal = $row['RutaVoboSTecnicaImpFinal'];
            	$this->FechaEntregaVboSTecnicaImpFinal = $row['FechaEntregaVboSTecnicaImpFinal'];
            	$this->FechaEntregaRealVboSTecnicaImpFinal = $row['FechaEntregaRealVboSTecnicaImpFinal'];

            }
            return $result;
	}

	public function agregarImpresionPublicacion(){
		$rutaUno = "";
		$rutaDos = "";
		$rutaTres = "";
		if (!isset($this->IdPreprensa) || $this->IdPreprensa == NULL || $this->IdPreprensa == ""){
            $this->IdPreprensa = "NULL";
        }
        if (!isset($this->IdImprenta) || $this->IdImprenta == NULL || $this->IdImprenta == ""){
            $this->IdImprenta = "NULL";

        }
         if (!isset($this->FechaEntregaPruebasColor) || $this->FechaEntregaPruebasColor == NULL || $this->FechaEntregaPruebasColor == ""){
            $this->FechaEntregaPruebasColor = "0000-00-00";

        }
         if (!isset($this->FechaEntregaRealPruebasColor) || $this->FechaEntregaRealPruebasColor == NULL || $this->FechaEntregaRealPruebasColor == ""){
            $this->FechaEntregaRealPruebasColor = "0000-00-00";

        }
         if (!isset($this->FechaEntregaPieImprenta) || $this->FechaEntregaPieImprenta == NULL || $this->FechaEntregaPieImprenta == ""){
            $this->FechaEntregaPieImprenta = "0000-00-00";

        }
         if (!isset($this->FechaEntregaRealPieImprenta) || $this->FechaEntregaRealPieImprenta == NULL || $this->FechaEntregaRealPieImprenta == ""){
            $this->FechaEntregaRealPieImprenta = "0000-00-00";

        }
        if (!isset($this->FechaEntregaVboSTecnicaImpFinal) || $this->FechaEntregaVboSTecnicaImpFinal == NULL || $this->FechaEntregaVboSTecnicaImpFinal == ""){
            $this->FechaEntregaVboSTecnicaImpFinal = "0000-00-00";

        }
        if (!isset($this->FechaEntregaRealVboSTecnicaImpFinal) || $this->FechaEntregaRealVboSTecnicaImpFinal == NULL || $this->FechaEntregaRealVboSTecnicaImpFinal == ""){
            $this->FechaEntregaRealVboSTecnicaImpFinal = "0000-00-00";

        }
        if (!isset($this->RutaPruebasColor) || $this->RutaPruebasColor == NULL || $this->RutaPruebasColor == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "NULL";
        }else{
        	$rutaUno =  "'".$this->RutaPruebasColor."'";
        }

        if (!isset($this->RutaVboPieImprenta) || $this->RutaVboPieImprenta == NULL || $this->RutaVboPieImprenta == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaDos = "NULL";
        }else{
        	$rutaDos =  "'".$this->RutaVboPieImprenta."'";
        }

        if (!isset($this->RutaVoboSTecnicaImpFinal) || $this->RutaVoboSTecnicaImpFinal == NULL || $this->RutaVoboSTecnicaImpFinal == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaTres = "NULL";
        }else{
        	$rutaTres =  "'".$this->RutaVoboSTecnicaImpFinal."'";
        }

  		$insert ="INSERT INTO  c_impresion (IdLibro,IdPreprensa,prePrensa,IdImprenta,RutaPruebasColor,FechaEntregaPruebasColor,FechaEntregaRealPruebasColor,RutaVboPieImprenta,FechaEntregaPieImprenta,FechaEntregaRealPieImprenta,RutaVoboSTecnicaImpFinal,FechaEntregaVboSTecnicaImpFinal,FechaEntregaRealVboSTecnicaImpFinal,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdPreprensa.",'".$this->prePrensa."',".$this->IdImprenta.",".$rutaUno.",'".$this->FechaEntregaPruebasColor."','".$this->FechaEntregaRealPruebasColor."',".$rutaDos.",'".$this->FechaEntregaPieImprenta."','".$this->FechaEntregaRealPieImprenta."',".$rutaTres.",'".$this->FechaEntregaVboSTecnicaImpFinal."','".$this->FechaEntregaRealVboSTecnicaImpFinal."','".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->idImpresion = $catalogo->insertarRegistro($insert);

        if ($this->idImpresion == 0 || $this->idImpresion == null) {
            return false;
        }
        return true;
	}
	public function editarImpresionPublicacion(){
		$rutaUno = "";
		$rutaDos = "";
		$rutaTres = "";
		if (!isset($this->IdPreprensa) || $this->IdPreprensa == NULL || $this->IdPreprensa == ""){
            $this->IdPreprensa = "NULL";
        }
        if (!isset($this->IdImprenta) || $this->IdImprenta == NULL || $this->IdImprenta == ""){
            $this->IdImprenta = "NULL";

        }
         if (!isset($this->FechaEntregaPruebasColor) || $this->FechaEntregaPruebasColor == NULL || $this->FechaEntregaPruebasColor == ""){
            $this->FechaEntregaPruebasColor = "0000-00-00";

        }
         if (!isset($this->FechaEntregaRealPruebasColor) || $this->FechaEntregaRealPruebasColor == NULL || $this->FechaEntregaRealPruebasColor == ""){
            $this->FechaEntregaRealPruebasColor = "0000-00-00";

        }
         if (!isset($this->FechaEntregaPieImprenta) || $this->FechaEntregaPieImprenta == NULL || $this->FechaEntregaPieImprenta == ""){
            $this->FechaEntregaPieImprenta = "0000-00-00";

        }
         if (!isset($this->FechaEntregaRealPieImprenta) || $this->FechaEntregaRealPieImprenta == NULL || $this->FechaEntregaRealPieImprenta == ""){
            $this->FechaEntregaRealPieImprenta = "0000-00-00";

        }
        if (!isset($this->FechaEntregaVboSTecnicaImpFinal) || $this->FechaEntregaVboSTecnicaImpFinal == NULL || $this->FechaEntregaVboSTecnicaImpFinal == ""){
            $this->FechaEntregaVboSTecnicaImpFinal = "0000-00-00";

        }
        if (!isset($this->FechaEntregaRealVboSTecnicaImpFinal) || $this->FechaEntregaRealVboSTecnicaImpFinal == NULL || $this->FechaEntregaRealVboSTecnicaImpFinal == ""){
            $this->FechaEntregaRealVboSTecnicaImpFinal = "0000-00-00";

        }


        if (!isset($this->RutaPruebasColor) || $this->RutaPruebasColor == NULL || $this->RutaPruebasColor == ""){
            //$this->Imagen = "NULL";
            $rutaUno = "";
        }else{
        	$rutaUno =  ",RutaPruebasColor = "."'".$this->RutaPruebasColor."'";
        }

        if (!isset($this->RutaVboPieImprenta) || $this->RutaVboPieImprenta == NULL || $this->RutaVboPieImprenta == ""){
            //$this->Imagen = "NULL";
            $rutaDos = "";
        }else{
        	$rutaDos =  ",RutaVboPieImprenta = "."'".$this->RutaVboPieImprenta."'";
        }


        if (!isset($this->RutaVoboSTecnicaImpFinal) || $this->RutaVoboSTecnicaImpFinal == NULL || $this->RutaVoboSTecnicaImpFinal == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaTres = "";
        }else{
        	$rutaTres =  ",RutaVoboSTecnicaImpFinal = "."'".$this->RutaVoboSTecnicaImpFinal."'";
        }


  		$insert ="UPDATE c_impresion SET IdPreprensa = ".$this->IdPreprensa."".$rutaUno.",prePrensa = '".$this->prePrensa."',IdImprenta = ".$this->IdImprenta."".$rutaUno.",FechaEntregaPruebasColor = '".$this->FechaEntregaPruebasColor."',FechaEntregaRealPruebasColor = '".$this->FechaEntregaRealPruebasColor."'".$rutaDos.",FechaEntregaPieImprenta = '".$this->FechaEntregaPieImprenta."',FechaEntregaRealPieImprenta = '".$this->FechaEntregaRealPieImprenta."'".$rutaTres.",FechaEntregaVboSTecnicaImpFinal = '".$this->FechaEntregaVboSTecnicaImpFinal."',FechaEntregaRealVboSTecnicaImpFinal = '".$this->FechaEntregaRealVboSTecnicaImpFinal."',UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

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

	public function getIdImpresion()
	{
	    return $this->idImpresion;
	}

	public function setIdImpresion($idImpresion)
	{
	    $this->idImpresion = $idImpresion;

	}


	public function getFechaEntregaRealVboSTecnicaImpFinal()
	{
	    return $this->FechaEntregaRealVboSTecnicaImpFinal;
	}

	public function setFechaEntregaRealVboSTecnicaImpFinal($FechaEntregaRealVboSTecnicaImpFinal)
	{
	    $this->FechaEntregaRealVboSTecnicaImpFinal = $FechaEntregaRealVboSTecnicaImpFinal;

	}


	public function getFechaEntregaRealPieImprenta()
	{
	    return $this->FechaEntregaRealPieImprenta;
	}

	public function setFechaEntregaRealPieImprenta($FechaEntregaRealPieImprenta)
	{
	    $this->FechaEntregaRealPieImprenta = $FechaEntregaRealPieImprenta;

	}
	public function getRutaVoboSTecnicaImpFinal()
	{
	    return $this->RutaVoboSTecnicaImpFinal;
	}

	public function setRutaVoboSTecnicaImpFinal($RutaVoboSTecnicaImpFinal)
	{
	    $this->RutaVoboSTecnicaImpFinal = $RutaVoboSTecnicaImpFinal;

	}
	public function getFechaEntregaVboSTecnicaImpFinal()
	{
	    return $this->FechaEntregaVboSTecnicaImpFinal;
	}

	public function setFechaEntregaVboSTecnicaImpFinal($FechaEntregaVboSTecnicaImpFinal)
	{
	    $this->FechaEntregaVboSTecnicaImpFinal = $FechaEntregaVboSTecnicaImpFinal;

	}



	public function getFechaEntregaRealPruebasColor()
	{
	    return $this->FechaEntregaRealPruebasColor;
	}

	public function setFechaEntregaRealPruebasColor($FechaEntregaRealPruebasColor)
	{
	    $this->FechaEntregaRealPruebasColor = $FechaEntregaRealPruebasColor;

	}
	public function getRutaVboPieImprenta()
	{
	    return $this->RutaVboPieImprenta;
	}

	public function setRutaVboPieImprenta($RutaVboPieImprenta)
	{
	    $this->RutaVboPieImprenta = $RutaVboPieImprenta;

	}
	public function getFechaEntregaPieImprenta()
	{
	    return $this->FechaEntregaPieImprenta;
	}

	public function setFechaEntregaPieImprenta($FechaEntregaPieImprenta)
	{
	    $this->FechaEntregaPieImprenta = $FechaEntregaPieImprenta;

	}


	public function getIdPreprensa()
	{
	    return $this->IdPreprensa;
	}

	public function setIdPreprensa($IdPreprensa)
	{
	    $this->IdPreprensa = $IdPreprensa;

	}
	public function getIdImprenta()
	{
	    return $this->IdImprenta;
	}

	public function setIdImprenta($IdImprenta)
	{
	    $this->IdImprenta = $IdImprenta;

	}
	public function getRutaPruebasColor()
	{
	    return $this->RutaPruebasColor;
	}

	public function setRutaPruebasColor($RutaPruebasColor)
	{
	    $this->RutaPruebasColor = $RutaPruebasColor;

	}

	public function getFechaEntregaPruebasColor()
	{
	    return $this->FechaEntregaPruebasColor;
	}

	public function setFechaEntregaPruebasColor($FechaEntregaPruebasColor)
	{
	    $this->FechaEntregaPruebasColor = $FechaEntregaPruebasColor;

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