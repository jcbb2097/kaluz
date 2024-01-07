<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class GestionarImagenes {

	private $IdImagenes;
	private $ImagenesCatalograficas;
	private $ImagenesComplementarias;
	private $TotalImagenes;
	private $rutaCatalograficas;
	private $rutaComplementarias;
	private $rutaAmbas;
	private $FechaEntregaCatalograficas;
  	private $FechaEntregaComplementarias;
  	private $FechaEntregaAmbas;

    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerImagenes(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdImagenes,ImagenesCatalograficas,ImagenesComplementarias,TotalImagenes,rutaCatalograficas,
	rutaComplementarias,rutaAmbas,FechaEntregaCatalograficas,FechaEntregaComplementarias,FechaEntregaAmbas FROM `c_gestionarImagenesLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->ImagenesCatalograficas = $row['ImagenesCatalograficas'];
            	$this->ImagenesComplementarias = $row['ImagenesComplementarias'];
            	$this->TotalImagenes = $row['TotalImagenes'];
            	$this->rutaCatalograficas = $row['rutaCatalograficas'];

            	$this->rutaComplementarias = $row['rutaComplementarias'];
            	$this->rutaAmbas = $row['rutaAmbas'];
            	$this->FechaEntregaCatalograficas = $row['FechaEntregaCatalograficas'];
            	$this->FechaEntregaComplementarias = $row['FechaEntregaComplementarias'];
            	$this->FechaEntregaAmbas = $row['FechaEntregaAmbas'];

            }
            return $result;
	}

	public function agregarGestionarImagenes(){
		$rutaUno = "";
		$rutaDos = "";
		$rutaTres = "";
		if (!isset($this->ImagenesCatalograficas) || $this->ImagenesCatalograficas == NULL || $this->ImagenesCatalograficas == ""){
            $this->ImagenesCatalograficas = "NULL";
        }
        if (!isset($this->ImagenesComplementarias) || $this->ImagenesComplementarias == NULL || $this->ImagenesComplementarias == ""){
            $this->ImagenesComplementarias = "NULL";

        }
         if (!isset($this->TotalImagenes) || $this->TotalImagenes == NULL || $this->TotalImagenes == ""){
            $this->TotalImagenes = "NULL";

        }
         if (!isset($this->FechaEntregaCatalograficas) || $this->FechaEntregaCatalograficas == NULL || $this->FechaEntregaCatalograficas == ""){
            $this->FechaEntregaCatalograficas = "0000-00-00";

        }
         if (!isset($this->FechaEntregaComplementarias) || $this->FechaEntregaComplementarias == NULL || $this->FechaEntregaComplementarias == ""){
            $this->FechaEntregaComplementarias = "0000-00-00";

        }
         if (!isset($this->FechaEntregaAmbas) || $this->FechaEntregaAmbas == NULL || $this->FechaEntregaAmbas == ""){
            $this->FechaEntregaAmbas = "0000-00-00";

        }

        if (!isset($this->rutaComplementarias) || $this->rutaComplementarias == NULL || $this->rutaComplementarias == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "NULL";
        }else{
        	$rutaUno =  "'".$this->rutaComplementarias."'";
        }

        if (!isset($this->rutaCatalograficas) || $this->rutaCatalograficas == NULL || $this->rutaCatalograficas == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaDos = "NULL";
        }else{
        	$rutaDos =  "'".$this->rutaCatalograficas."'";
        }

        if (!isset($this->rutaAmbas) || $this->rutaAmbas == NULL || $this->rutaAmbas == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaTres = "NULL";
        }else{
        	$rutaTres =  "'".$this->rutaAmbas."'";
        }

  		$insert ="INSERT INTO  c_gestionarImagenesLibro (IdLibro,ImagenesCatalograficas,ImagenesComplementarias,TotalImagenes,rutaComplementarias,rutaCatalograficas,rutaAmbas,FechaEntregaCatalograficas,FechaEntregaComplementarias,FechaEntregaAmbas,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->ImagenesCatalograficas.",".$this->ImagenesComplementarias.",".$this->TotalImagenes.",".$rutaUno.",".$rutaDos.",".$rutaTres.",'".$this->FechaEntregaCatalograficas."','".$this->FechaEntregaComplementarias."','".$this->FechaEntregaAmbas."','".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdImagenes = $catalogo->insertarRegistro($insert);

        if ($this->IdImagenes == 0 || $this->IdImagenes == null) {
            return false;
        }
        return true;
	}
	public function editarGestionarImagenes(){
		$rutaUno = "";
		$rutaDos = "";
		$rutaTres = "";
		if (!isset($this->ImagenesCatalograficas) || $this->ImagenesCatalograficas == NULL || $this->ImagenesCatalograficas == ""){
            $this->ImagenesCatalograficas = "NULL";
        }
        if (!isset($this->ImagenesComplementarias) || $this->ImagenesComplementarias == NULL || $this->ImagenesComplementarias == ""){
            $this->ImagenesComplementarias = "NULL";

        }
         if (!isset($this->TotalImagenes) || $this->TotalImagenes == NULL || $this->TotalImagenes == ""){
            $this->TotalImagenes = "NULL";

        }
         if (!isset($this->FechaEntregaCatalograficas) || $this->FechaEntregaCatalograficas == NULL || $this->FechaEntregaCatalograficas == ""){
            $this->FechaEntregaCatalograficas = "0000-00-00";

        }
         if (!isset($this->FechaEntregaComplementarias) || $this->FechaEntregaComplementarias == NULL || $this->FechaEntregaComplementarias == ""){
            $this->FechaEntregaComplementarias = "0000-00-00";

        }
         if (!isset($this->FechaEntregaAmbas) || $this->FechaEntregaAmbas == NULL || $this->FechaEntregaAmbas == ""){
            $this->FechaEntregaAmbas = "0000-00-00";

        }
        if (!isset($this->rutaComplementarias) || $this->rutaComplementarias == NULL || $this->rutaComplementarias == ""){
            //$this->Imagen = "NULL";
            $rutaUno = "";
        }else{
        	$rutaUno =  ",rutaComplementarias = "."'".$this->rutaComplementarias."'";
        }

        if (!isset($this->rutaCatalograficas) || $this->rutaCatalograficas == NULL || $this->rutaCatalograficas == ""){
            //$this->Imagen = "NULL";
            $rutaDos = "";
        }else{
        	$rutaDos =  ",rutaCatalograficas = "."'".$this->rutaCatalograficas."'";
        }


        if (!isset($this->rutaAmbas) || $this->rutaAmbas == NULL || $this->rutaAmbas == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaTres = "";
        }else{
        	$rutaTres =  ",rutaAmbas = "."'".$this->rutaAmbas."'";
        }

  		$insert ="UPDATE c_gestionarImagenesLibro SET ImagenesCatalograficas = ".$this->ImagenesCatalograficas."".$rutaDos.",ImagenesComplementarias = ".$this->ImagenesComplementarias."".$rutaUno.",TotalImagenes = ".$this->TotalImagenes."".$rutaTres.",FechaEntregaCatalograficas = '".$this->FechaEntregaCatalograficas."',FechaEntregaComplementarias = '".$this->FechaEntregaComplementarias."',FechaEntregaAmbas = '".$this->FechaEntregaAmbas."',UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

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

	public function getImagenesCatalograficas()
	{
	    return $this->ImagenesCatalograficas;
	}

	public function setImagenesCatalograficas($ImagenesCatalograficas)
	{
	    $this->ImagenesCatalograficas = $ImagenesCatalograficas;

	}
	public function getImagenesComplementarias()
	{
	    return $this->ImagenesComplementarias;
	}

	public function setImagenesComplementarias($ImagenesComplementarias)
	{
	    $this->ImagenesComplementarias = $ImagenesComplementarias;

	}
	public function getTotalImagenes()
	{
	    return $this->TotalImagenes;
	}

	public function setTotalImagenes($TotalImagenes)
	{
	    $this->TotalImagenes = $TotalImagenes;

	}
	public function getRutaComplementarias()
	{
	    return $this->rutaComplementarias;
	}

	public function setRutaComplementarias($rutaComplementarias)
	{
	    $this->rutaComplementarias = $rutaComplementarias;

	}

	public function getRutaCatalograficas()
	{
	    return $this->rutaCatalograficas;
	}

	public function setRutaCatalograficas($rutaCatalograficas)
	{
	    $this->rutaCatalograficas = $rutaCatalograficas;

	}

	public function getrutaAmbas()
	{
	    return $this->rutaAmbas;
	}

	public function setRutaAmbas($rutaAmbas)
	{
	    $this->rutaAmbas = $rutaAmbas;

	}

	public function getFechaEntregaCatalograficas()
	{
	    return $this->FechaEntregaCatalograficas;
	}

	public function setFechaEntregaCatalograficas($FechaEntregaCatalograficas)
	{
	    $this->FechaEntregaCatalograficas = $FechaEntregaCatalograficas;

	}

	public function getFechaEntregaAmbas()
	{
	    return $this->FechaEntregaAmbas;
	}

	public function setFechaEntregaAmbas($FechaEntregaAmbas)
	{
	    $this->FechaEntregaAmbas = $FechaEntregaAmbas;

	}

	public function getFechaEntregaComplementarias()
	{
	    return $this->FechaEntregaComplementarias;
	}

	public function setFechaEntregaComplementarias($FechaEntregaComplementarias)
	{
	    $this->FechaEntregaComplementarias = $FechaEntregaComplementarias;

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