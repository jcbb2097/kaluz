<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class CaracteristicasTecnicas {
	//c_caracTecnicasLibro
	private $IdCaracTecnicas;
	private $IdLibro;
    private $IdEntregableEsp;
    private $numPaginas;
    private $medidaFinal;
	private $IdTipoPortada;
	private $IdTipoLomo;
	private $IdTipoEncuadernado;
	private $Tirajetotal;
    private $TirajeEspanol;
    private $TirajeIngles;
    private $TirajeBilingue;
    private $AnioEdicion;
    //k_papelRecubrimiento
    private $IdPapelRecubrimiento;
    private $IdTipoPapelRecubrimiento;
    private $NumeroPaginas;
    private $DescripcionPapelRecubrimiento;

    //k_impresion
    private $IdImpresion;
    private $IdTipoImpresion;
    private $DescripcionImpresion;
    //k_acabados
    private $IdAcabado;
    private $IdTipoAcabado;
     private $DescripcionAcabado;

    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerCaracteristicasTecnicas(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdCaracTecnicas,IdEntregableEsp,numPaginas,medidaFinal,IdTipoPortada,IdTipoLomo,IdTipoEncuadernado,AnioEdicion,TirajeBilingue,TirajeEspanol,TirajeIngles,TirajeTotal FROM `c_caracTecnicasLibro` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->numPaginas = $row['numPaginas'];
            	$this->medidaFinal = $row['medidaFinal'];
            	$this->IdTipoPortada = $row['IdTipoPortada'];
            	$this->IdTipoLomo = $row['IdTipoLomo'];
            	$this->IdTipoEncuadernado = $row['IdTipoEncuadernado'];
            	$this->AnioEdicion = $row['AnioEdicion'];
            	$this->TirajeBilingue = $row['TirajeBilingue'];
            	$this->TirajeEspanol = $row['TirajeEspanol'];
            	$this->TirajeIngles = $row['TirajeIngles'];
            	$this->TirajeTotal = $row['TirajeTotal'];
                $this->IdCaracTecnicas = $row['IdCaracTecnicas'];
                $this->IdEntregableEsp = $row['IdEntregableEsp'];
     
            }

            return $result;
	}
	public function obtenerPapelRecubrimiento(){

  		$catalogo = new Catalogo();
  		$coeditorArray = array();
  		$consulta ="SELECT IdTipoPapelRecubrimiento,NumeroPaginas,Descripcion FROM `k_papelRecubrimientoCaracTecnicas` WHERE IdCaracteristicaTecnica = ".$this->IdCaracTecnicas;
		$result = $catalogo->obtenerLista($consulta);
            /*while ($row = mysqli_fetch_array($result)) {

            	//$this->Coedicion = $row['IdCoeditor'];
            	array_push($coeditorArray,$row['IdPapelRecubrimiento']);
            }*/
            //echo "<br>".$consulta."<br>";
         return $result;
	}
	public function obtenerImpresion(){

  		$catalogo = new Catalogo();
  		$coeditorArray = array();
  		$consulta ="SELECT IdTipoImpresion,Descripcion FROM `k_impresionCaracTecnicas` WHERE IdCaracteristicasTecnicas = ".$this->IdCaracTecnicas;
        //echo "<br>".$consulta."<br>";
		$result = $catalogo->obtenerLista($consulta);
            /*while ($row = mysqli_fetch_array($result)) {

            	//$this->Coedicion = $row['IdCoeditor'];
            	array_push($coeditorArray,$row['IdTipoImpresion']);
            }*/
         return $result;
	}
	public function obtenerAcabado(){
  		$catalogo = new Catalogo();
  		$coeditorArray = array();
  		$consulta ="SELECT IdTipoAcabado,Descripcion FROM `k_acabadoCaracTecnicas` WHERE IdCaracteristicasTecnicas = ".$this->IdCaracTecnicas;
        //echo "<br>".$consulta."<br>";
		$result = $catalogo->obtenerLista($consulta);
            /*while ($row = mysqli_fetch_array($result)) {

            	//$this->Coedicion = $row['IdCoeditor'];
            	array_push($coeditorArray,$row['IdTipoAcabado']);
            }*/
         return $result;
	}

	public function agregarCaracteristicasTecnicas(){

		if (!isset($this->numPaginas) || $this->numPaginas == NULL || $this->numPaginas == ""){
            $this->numPaginas = "NULL";
        }
        if (!isset($this->IdTipoPortada) || $this->IdTipoPortada == NULL || $this->IdTipoPortada == ""){
            //$this->Imagen = "NULL";
            $this->IdTipoPortada = "NULL";
        }
        if (!isset($this->IdTipoLomo) || $this->IdTipoLomo == NULL || $this->IdTipoLomo == ""){
            //$this->PDF = "NULL";
            $this->IdTipoLomo = "NULL";
        }
        if (!isset($this->IdTipoEncuadernado) || $this->IdTipoEncuadernado == NULL || $this->IdTipoEncuadernado == ""){
            //$this->PDF = "NULL";
            $this->IdTipoEncuadernado = "NULL";
        }
        if (!isset($this->AnioEdicion) || $this->AnioEdicion == NULL || $this->AnioEdicion == ""){
            //$this->PDF = "NULL";
            $this->AnioEdicion = "NULL";
        }
        if (!isset($this->TirajeTotal) || $this->TirajeTotal == NULL || $this->TirajeTotal == ""){
            //$this->PDF = "NULL";
            $this->TirajeTotal = "NULL";
        }
        if (!isset($this->TirajeIngles) || $this->TirajeIngles == NULL || $this->TirajeIngles == ""){
            //$this->PDF = "NULL";
            $this->TirajeIngles = "NULL";
        }
        if (!isset($this->TirajeBilingue) || $this->TirajeBilingue == NULL || $this->TirajeBilingue == ""){
            //$this->PDF = "NULL";
            $this->TirajeBilingue = "NULL";
        }
        if (!isset($this->TirajeEspanol) || $this->TirajeEspanol == NULL || $this->TirajeEspanol == ""){
            //$this->PDF = "NULL";
            $this->TirajeEspanol = "NULL";
        }
        if (!isset($this->IdEntregableEsp) || $this->IdEntregableEsp == NULL || $this->IdEntregableEsp == ""){
            //$this->PDF = "NULL";
            $this->IdEntregableEsp = "NULL";
        }
        

  		$insert ="INSERT INTO c_caracTecnicasLibro (IdLibro,IdEntregableEsp,numPaginas,medidaFinal,IdTipoPortada,IdTipoLomo,IdTipoEncuadernado,AnioEdicion,TirajeTotal,
  TirajeEspanol,TirajeIngles,TirajeBilingue,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->IdEntregableEsp.",".$this->numPaginas.",'".$this->medidaFinal."',".$this->IdTipoPortada.",".$this->IdTipoLomo.",".$this->IdTipoEncuadernado.",".$this->AnioEdicion.",".$this->TirajeTotal.",".$this->TirajeEspanol.",".$this->TirajeIngles.",".$this->TirajeBilingue.",'".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdCaracTecnicas = $catalogo->insertarRegistro($insert);

        if ($this->IdCaracTecnicas == 0 || $this->IdCaracTecnicas == null) {
            return false;
        }
        return true;
	}
	public function editarCaracteristicasTecnicas(){

		if (!isset($this->numPaginas) || $this->numPaginas == NULL || $this->numPaginas == ""){
            $this->numPaginas = "NULL";
        }
        if (!isset($this->IdTipoPortada) || $this->IdTipoPortada == NULL || $this->IdTipoPortada == ""){
            //$this->Imagen = "NULL";
            $this->IdTipoPortada = "NULL";
        }
        if (!isset($this->IdTipoLomo) || $this->IdTipoLomo == NULL || $this->IdTipoLomo == ""){
            //$this->PDF = "NULL";
            $this->IdTipoLomo = "NULL";
        }
        if (!isset($this->IdTipoEncuadernado) || $this->IdTipoEncuadernado == NULL || $this->IdTipoEncuadernado == ""){
            //$this->PDF = "NULL";
            $this->IdTipoEncuadernado = "NULL";
        }
        if (!isset($this->AnioEdicion) || $this->AnioEdicion == NULL || $this->AnioEdicion == ""){
            //$this->PDF = "NULL";
            $this->AnioEdicion = "NULL";
        }
        if (!isset($this->TirajeTotal) || $this->TirajeTotal == NULL || $this->TirajeTotal == ""){
            //$this->PDF = "NULL";
            $this->TirajeTotal = "NULL";
        }
        if (!isset($this->TirajeIngles) || $this->TirajeIngles == NULL || $this->TirajeIngles == ""){
            //$this->PDF = "NULL";
            $this->TirajeIngles = "NULL";
        }
        if (!isset($this->TirajeBilingue) || $this->TirajeBilingue == NULL || $this->TirajeBilingue == ""){
            //$this->PDF = "NULL";
            $this->TirajeBilingue = "NULL";
        }
        if (!isset($this->TirajeEspanol) || $this->TirajeEspanol == NULL || $this->TirajeEspanol == ""){
            //$this->PDF = "NULL";
            $this->TirajeEspanol = "NULL";
        }
        if (!isset($this->IdEntregableEsp) || $this->IdEntregableEsp == NULL || $this->IdEntregableEsp == ""){
            //$this->PDF = "NULL";
            $this->IdEntregableEsp = "NULL";
        }

  		$insert ="UPDATE c_caracTecnicasLibro SET IdEntregableEsp = ".$this->IdEntregableEsp.",numPaginas = ".$this->numPaginas.",medidaFinal = '".$this->medidaFinal."',IdTipoPortada = ".$this->IdTipoPortada.",IdTipoLomo = ".$this->IdTipoLomo.",IdTipoEncuadernado = ".$this->IdTipoEncuadernado.",AnioEdicion = ".$this->AnioEdicion.",TirajeTotal = ".$this->TirajeTotal.",
  TirajeEspanol = ".$this->TirajeEspanol.",TirajeIngles = ".$this->TirajeIngles.",TirajeBilingue = ".$this->TirajeBilingue.",UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion=NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$query = $catalogo->ejecutaConsultaActualizacion($insert, 'c_libro', 'IdLibro = ' . $this->IdLibro);

        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function agregarPapelRecubrimiento(){
		if (!isset($this->IdCaracTecnicas) || $this->IdCaracTecnicas == NULL){
            $this->IdCaracTecnicas = "NULL";
        }
        if (!isset($this->IdTipoPapelRecubrimiento) || $this->IdTipoPapelRecubrimiento == NULL){
            $this->IdTipoPapelRecubrimiento = "NULL";
        }


		$insert ="INSERT INTO k_papelRecubrimientoCaracTecnicas (IdCaracteristicaTecnica,IdTipoPapelRecubrimiento,NumeroPaginas,Descripcion) VALUES (".$this->IdCaracTecnicas.",".$this->IdTipoPapelRecubrimiento.",'".$this->NumeroPaginas."','".$this->DescripcionPapelRecubrimiento."');";

		$catalogo = new Catalogo();

		//echo "<br>".$insert."<br>";
		$this->IdPapelRecubrimiento = $catalogo->insertarRegistro($insert);

        if ($this->IdPapelRecubrimiento == 0 || $this->IdPapelRecubrimiento == null) {
            return false;
        }
        return true;

	}


	public function agregarImpresion(){

		if (!isset($this->IdCaracTecnicas) || $this->IdCaracTecnicas == NULL || $this->IdCaracTecnicas == ""){
            $this->IdCaracTecnicas = "NULL";
        }
        if (!isset($this->IdTipoImpresion) || $this->IdTipoImpresion == NULL || $this->IdTipoImpresion == ""){
            $this->IdTipoImpresion = "NULL";
        }

		$insert ="INSERT INTO k_impresionCaracTecnicas (IdCaracteristicasTecnicas,IdTipoImpresion,Descripcion) VALUES (".$this->IdCaracTecnicas.",".$this->IdTipoImpresion.",'".$this->DescripcionImpresion."');";

		$catalogo = new Catalogo();
         //echo "<br>".$insert."<br>";
  		$this->IdImpresion= $catalogo->insertarRegistro($insert);

        if ($this->IdImpresion == 0 || $this->IdImpresion == null) {
            return false;
        }
        return true;
	}

	public function agregarAcabado(){

		if (!isset($this->IdCaracTecnicas) || $this->IdCaracTecnicas == NULL || $this->IdCaracTecnicas == ""){
            $this->IdCaracTecnicas = "NULL";
        }
        if (!isset($this->IdTipoAcabado) || $this->IdTipoAcabado == NULL || $this->IdTipoAcabado == ""){
            $this->IdTipoAcabado = "NULL";
        }

		$insert ="INSERT INTO k_acabadoCaracTecnicas (IdCaracteristicasTecnicas,IdTipoAcabado,Descripcion) VALUES (".$this->IdCaracTecnicas.",".$this->IdTipoAcabado.",'".$this->DescripcionAcabado."');";

		$catalogo = new Catalogo();
         //echo "<br>".$insert."<br>";
  		$this->IdAcabado= $catalogo->insertarRegistro($insert);

        if ($this->IdAcabado == 0 || $this->IdAcabado == null) {
            return false;
        }
        return true;
	}
    public function eliminarPapelRecubrimiento(){
    	$catalogo = new Catalogo();
        $consulta = "delete from k_papelRecubrimientoCaracTecnicas WHERE IdCaracteristicaTecnica =". $this->IdCaracTecnicas.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "", "");
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarImpresion(){
    	$catalogo = new Catalogo();
        $consulta = "delete from k_impresionCaracTecnicas WHERE IdCaracteristicasTecnicas =". $this->IdCaracTecnicas.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "null", "null");
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarAcabado(){
    	$catalogo = new Catalogo();
        $consulta = "delete from k_acabadoCaracTecnicas WHERE IdCaracteristicasTecnicas =". $this->IdCaracTecnicas.";";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "null", "null");
        //echo "<br><br>$consulta<br><br>";
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

    public function getTirajeBilingue()
    {
        return $this->TirajeBilingue;
    }

    public function setTirajeBilingue($TirajeBilingue)
    {
        $this->TirajeBilingue = $TirajeBilingue;

    }
    public function getTirajeIngles()
    {
        return $this->TirajeIngles;
    }

    public function setTirajeIngles($TirajeIngles)
    {
        $this->TirajeIngles = $TirajeIngles;

    }
    public function getTirajeEspanol()
    {
        return $this->TirajeEspanol;
    }

    public function setTirajeEspanol($TirajeEspanol)
    {
        $this->TirajeEspanol = $TirajeEspanol;

    }
    public function getTirajeTotal()
    {
        return $this->TirajeTotal;
    }

    public function setTirajeTotal($TirajeTotal)
    {
        $this->TirajeTotal = $TirajeTotal;

    }
    public function getIdTipoEncuadernado()
    {
        return $this->IdTipoEncuadernado;
    }

    public function setIdTipoEncuadernado($IdTipoEncuadernado)
    {
        $this->IdTipoEncuadernado = $IdTipoEncuadernado;

    }
    public function getIdTipoLomo()
    {
        return $this->IdTipoLomo;
    }

    public function setIdTipoLomo($IdTipoLomo)
    {
        $this->IdTipoLomo = $IdTipoLomo;

    }
    public function getIdCaracTecnicas()
    {
        return $this->IdCaracTecnicas;
    }

    public function setIdCaracTecnicas($IdCaracTecnicas)
    {
        $this->IdCaracTecnicas = $IdCaracTecnicas;

    }

   public function getNumPaginas()
   {
       return $this->numPaginas;
   }

   public function setNumPaginas($numPaginas)
   {
       $this->numPaginas = $numPaginas;

   }

   public function getMedidaFinal()
   {
       return $this->medidaFinal;
   }

   public function setMedidaFinal($medidaFinal)
   {
       $this->medidaFinal = $medidaFinal;

   }

   public function getIdTipoPortada()
   {
       return $this->IdTipoPortada;
   }

   public function setIdTipoPortada($IdTipoPortada)
   {
       $this->IdTipoPortada = $IdTipoPortada;

   }

    public function getDescripcionPapelRecubrimiento()
    {
        return $this->DescripcionPapelRecubrimiento;
    }

    public function setDescripcionPapelRecubrimiento($DescripcionPapelRecubrimiento)
    {
        $this->DescripcionPapelRecubrimiento = $DescripcionPapelRecubrimiento;

    }
    public function getNumeroPaginas()
    {
        return $this->NumeroPaginas;
    }

    public function setNumeroPaginas($NumeroPaginas)
    {
        $this->NumeroPaginas = $NumeroPaginas;

    }
    public function getIdPapelRecubrimiento()
    {
        return $this->IdPapelRecubrimiento;
    }

    public function setIdPapelRecubrimiento($IdPapelRecubrimiento)
    {
        $this->IdPapelRecubrimiento = $IdPapelRecubrimiento;

    }

    public function getIdTipoPapelRecubrimiento()
    {
        return $this->IdTipoPapelRecubrimiento;
    }

    public function setIdTipoPapelRecubrimiento($IdTipoPapelRecubrimiento)
    {
        $this->IdTipoPapelRecubrimiento = $IdTipoPapelRecubrimiento;

    }

    public function getDescripcionImpresion()
    {
        return $this->DescripcionImpresion;
    }

    public function setDescripcionImpresion($DescripcionImpresion)
    {
        $this->DescripcionImpresion = $DescripcionImpresion;

    }
 	public function getIdTipoImpresion()
 	{
 	    return $this->IdTipoImpresion;
 	}

 	public function setIdTipoImpresion($IdTipoImpresion)
 	{
 	    $this->IdTipoImpresion = $IdTipoImpresion;

 	}
    public function getIdImpresion()
    {
        return $this->IdImpresion;
    }

    public function setIdImpresion($IdImpresion)
    {
        $this->IdImpresion = $IdImpresion;

    }
     public function getIdAcabado()
     {
         return $this->IdAcabado;
     }

     public function setIdAcabado($IdAcabado)
     {
         $this->IdAcabado = $IdAcabado;

     }

     public function getIdTipoAcabado()
     {
         return $this->IdTipoAcabado;
     }

     public function setIdTipoAcabado($IdTipoAcabado)
     {
         $this->IdTipoAcabado = $IdTipoAcabado;

     }
     public function getDescripcionAcabado()
     {
         return $this->DescripcionAcabado;
     }

     public function setDescripcionAcabado($DescripcionAcabado)
     {
         $this->DescripcionAcabado = $DescripcionAcabado;

     }

     public function getAnioEdicion()
     {
         return $this->AnioEdicion;
     }

     public function setAnioEdicion($AnioEdicion)
     {
         $this->AnioEdicion = $AnioEdicion;

     }
     public function setIdEntregableEsp($IdEntregableEsp){
        $this->IdEntregableEsp = $IdEntregableEsp;
     }

     public function getIdEntregableEsp(){
        return $this->IdEntregableEsp;
     }
}

?>