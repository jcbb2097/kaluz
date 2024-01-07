<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class DefinirColaboradores {

	private $IdColaboradores;
	private $IdLibro;
    private $IdCorrectorEstilo;
    private $checkCorrectorEstilo;
    private $IdEntregableEsp;
	private $Idtraductor;
	private $checkTraductor;
	private $IdDisenador;
	private $checkDisenador;
    private $IdIlustrador;
    private $checkIlustrador;

    private $IdPreprensista;
    private $checkPreprensista;
    private $IdImprenta;
    private $checkImprenta;


    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerDefinirColaboradores(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdEntregableEspecifico,IdCorrectorEstilo,checkCorrectorEstilo,Idtraductor,checkTraductor,IdDisenador,checkDisenador,IdIlustrador,checkIlustrador,IdPreprensista,checkPreprensista,IdImprenta,checkImprenta FROM `c_colaboradorLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdCorrectorEstilo = $row['IdCorrectorEstilo'];
            	$this->checkCorrectorEstilo = $row['checkCorrectorEstilo'];
            	$this->Idtraductor = $row['Idtraductor'];
            	$this->checkTraductor = $row['checkTraductor'];
            	$this->IdDisenador = $row['IdDisenador'];
            	$this->checkDisenador = $row['checkDisenador'];
            	$this->IdIlustrador = $row['IdIlustrador'];
            	$this->checkIlustrador = $row['checkIlustrador'];
            	$this->IdPreprensista = $row['IdPreprensista'];
            	$this->checkPreprensista = $row['checkPreprensista'];
            	$this->IdImprenta = $row['IdImprenta'];
            	$this->checkImprenta = $row['checkImprenta'];
            	$this->IdEntregableEsp = $row['IdEntregableEspecifico'];
            }
            return  $result;
	}


	public function agregarDefinirColaboradores(){

		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->IdCorrectorEstilo) || $this->IdCorrectorEstilo == NULL || $this->IdCorrectorEstilo == ""){
            $this->IdCorrectorEstilo = "NULL";

        }
        if (!isset($this->Idtraductor) || $this->Idtraductor == NULL || $this->Idtraductor == ""){
            $this->Idtraductor = "NULL";

        }
        if (!isset($this->IdDisenador) || $this->IdDisenador == NULL || $this->IdDisenador == ""){
            $this->IdDisenador = "NULL";

        }
        if (!isset($this->IdIlustrador) || $this->IdIlustrador == NULL || $this->IdIlustrador == ""){
            $this->IdIlustrador = "NULL";

        }
        if (!isset($this->IdPreprensista) || $this->IdPreprensista == NULL || $this->IdPreprensista == ""){
            $this->IdPreprensista = "NULL";

        }
        if (!isset($this->IdImprenta) || $this->IdImprenta == NULL || $this->IdImprenta == ""){
            $this->IdImprenta = "NULL";

        }
        if (!isset($this->IdEntregableEsp) || $this->IdEntregableEsp == NULL || $this->IdEntregableEsp == ""){
            //$this->PDF = "NULL";
            $this->IdEntregableEsp = "NULL";
        }

  		$insert ="INSERT INTO c_colaboradorLibro (IdLibro,IdEntregableEspecifico,IdCorrectorEstilo,checkCorrectorEstilo,Idtraductor,checkTraductor,IdDisenador,checkDisenador,IdIlustrador,checkIlustrador,IdPreprensista,checkPreprensista,IdImprenta,checkImprenta,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdEntregableEsp.",".$this->IdCorrectorEstilo.",".$this->checkCorrectorEstilo.",".$this->Idtraductor.",".$this->checkTraductor.",".$this->IdDisenador.",".$this->checkDisenador.",".$this->IdIlustrador.",".$this->checkIlustrador.",".$this->IdPreprensista.",".$this->checkPreprensista.",".$this->IdImprenta.",".$this->checkImprenta.",'".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdColaboradores = $catalogo->insertarRegistro($insert);

        if ($this->IdColaboradores == 0 || $this->IdColaboradores == null) {
            return false;
        }
        return true;
	}
	public function editarDefinirColaboradores(){
		if (!isset($this->IdLibro) || $this->IdLibro == NULL || $this->IdLibro == ""){
            $this->IdLibro = "NULL";
        }
        if (!isset($this->IdCorrectorEstilo) || $this->IdCorrectorEstilo == NULL || $this->IdCorrectorEstilo == ""){
            $this->IdCorrectorEstilo = "NULL";

        }
        if (!isset($this->Idtraductor) || $this->Idtraductor == NULL || $this->Idtraductor == ""){
            $this->Idtraductor = "NULL";

        }
        if (!isset($this->IdDisenador) || $this->IdDisenador == NULL || $this->IdDisenador == ""){
            $this->IdDisenador = "NULL";

        }
        if (!isset($this->IdIlustrador) || $this->IdIlustrador == NULL || $this->IdIlustrador == ""){
            $this->IdIlustrador = "NULL";

        }
        if (!isset($this->IdPreprensista) || $this->IdPreprensista == NULL || $this->IdPreprensista == ""){
            $this->IdPreprensista = "NULL";

        }
        if (!isset($this->IdImprenta) || $this->IdImprenta == NULL || $this->IdImprenta == ""){
            $this->IdImprenta = "NULL";

        }
        if (!isset($this->IdEntregableEsp) || $this->IdEntregableEsp == NULL || $this->IdEntregableEsp == ""){
            //$this->PDF = "NULL";
            $this->IdEntregableEsp = "NULL";
        }

  		$insert ="UPDATE c_colaboradorLibro SET IdEntregableEspecifico = ".$this->IdEntregableEsp.",IdCorrectorEstilo = ".$this->IdCorrectorEstilo.",checkCorrectorEstilo = ".$this->checkCorrectorEstilo.",Idtraductor = ".$this->Idtraductor.",checkTraductor = ".$this->checkTraductor.",IdDisenador = ".$this->IdDisenador.",checkDisenador = ".$this->checkDisenador.",IdIlustrador = ".$this->IdIlustrador.",checkIlustrador = ".$this->checkIlustrador.",IdPreprensista = ".$this->IdPreprensista.",checkPreprensista = ".$this->checkPreprensista.",IdImprenta = ".$this->IdImprenta.",checkImprenta = ".$this->checkImprenta.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla. "' WHERE IdLibro =".$this->IdLibro." ;";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_colaboradorLibro', 'IdColaboradores = ' . $this->IdColaboradores);

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

	public function getIdColaboradores()
	{
	    return $this->IdColaboradores;
	}

	public function setIdColaboradores($IdColaboradores)
	{
	    $this->IdColaboradores = $IdColaboradores;

	}

	public function getIdCorrectorEstilo()
	{
	    return $this->IdCorrectorEstilo;
	}

	public function setIdCorrectorEstilo($IdCorrectorEstilo)
	{
	    $this->IdCorrectorEstilo = $IdCorrectorEstilo;

	}

	public function getCheckCorrectorEstilo()
	{
	    return $this->checkCorrectorEstilo;
	}

	public function setCheckCorrectorEstilo($checkCorrectorEstilo)
	{
	    $this->checkCorrectorEstilo = $checkCorrectorEstilo;

	}

	public function getIdtraductor()
	{
	    return $this->Idtraductor;
	}

	public function setIdtraductor($Idtraductor)
	{
	    $this->Idtraductor = $Idtraductor;

	}

	public function getCheckTraductor()
	{
	    return $this->checkTraductor;
	}

	public function setCheckTraductor($checkTraductor)
	{
	    $this->checkTraductor = $checkTraductor;

	}

	public function getIdDisenador()
	{
	    return $this->IdDisenador;
	}

	public function setIdDisenador($IdDisenador)
	{
	    $this->IdDisenador = $IdDisenador;

	}

	public function getCheckDisenador()
	{
	    return $this->checkDisenador;
	}

	public function setCheckDisenador($checkDisenador)
	{
	    $this->checkDisenador = $checkDisenador;

	}

	public function getIdIlustrador()
	{
	    return $this->IdIlustrador;
	}

	public function setIdIlustrador($IdIlustrador)
	{
	    $this->IdIlustrador = $IdIlustrador;

	}

	public function getCheckIlustrador()
	{
	    return $this->checkIlustrador;
	}

	public function setCheckIlustrador($checkIlustrador)
	{
	    $this->checkIlustrador = $checkIlustrador;

	}

	public function getIdPreprensista()
	{
	    return $this->IdPreprensista;
	}

	public function setIdPreprensista($IdPreprensista)
	{
	    $this->IdPreprensista = $IdPreprensista;

	}

	public function getCheckPreprensista()
	{
	    return $this->checkPreprensista;
	}

	public function setCheckPreprensista($checkPreprensista)
	{
	    $this->checkPreprensista = $checkPreprensista;

	}

	public function getIdImprenta()
	{
	    return $this->IdImprenta;
	}

	public function setIdImprenta($IdImprenta)
	{
	    $this->IdImprenta = $IdImprenta;

	}

	public function getCheckImprenta()
	{
	    return $this->checkImprenta;
	}

	public function setCheckImprenta($checkImprenta)
	{
	    $this->checkImprenta = $checkImprenta;

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
	public function setIdEntregableEsp($IdEntregableEsp){
        $this->IdEntregableEsp = $IdEntregableEsp;
     }

     public function getIdEntregableEsp(){
        return $this->IdEntregableEsp;
     }

}

?>