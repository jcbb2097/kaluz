<?php


ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class PVP {

	private $IdCostosPresupuestos;
	private $IdLibro;
	private $MontoPresupuesto;
	private $RutaExcelPresupuesto;
	private $FechaEntregaPresupuesto;
	private $PresupuestoOrigenes;
	private $PresupuestoEjercido;
	private $CostoTiraje;
	private $IdPatrocinador;
	private $CostoProduccionUnitario;
	private $PVP;
	private $IdPuntosDeVenta;
	private $CostoProduccion;
	private $PorcentajeCoedicion;
	private $Reimpresion;


    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificiacion;
	private $FechaUltimaModificacion;
	private $Pantalla;


	public function obtenerPVP(){

		$catalogo = new Catalogo();
        $consulta ="SELECT IdCostosPresupuestos,MontoPresupuesto,RutaExcelPresupuesto,FechaEntregaPresupuesto,
					PresupuestoOrigenes,PresupuestoEjercido,CostoTiraje,IdPatrocinador,CostoProduccionUnitario,PVP,IdPuntosDeVenta,CostoProduccion,PorcentajeCoedicion,Reimpresion FROM `c_costosypresupuestos` WHERE IdLibro =". $this->IdLibro;
        //echo "<br><br>".$consulta."<br><br>";
            $result = $catalogo->obtenerLista($consulta);
            while ($row = mysqli_fetch_array($result)) {

            	$this->IdCostosPresupuestos = $row['IdCostosPresupuestos'];
            	$this->MontoPresupuesto = $row['MontoPresupuesto'];
            	$this->FechaEntregaPresupuesto = $row['FechaEntregaPresupuesto'];
            	$this->RutaExcelPresupuesto = $row['RutaExcelPresupuesto'];
            	$this->PresupuestoOrigenes = $row['PresupuestoOrigenes'];
            	$this->PresupuestoEjercido = $row['PresupuestoEjercido'];
            	$this->CostoTiraje = $row['CostoTiraje'];
            	$this->IdPatrocinador = $row['IdPatrocinador'];
            	$this->CostoProduccionUnitario = $row['CostoProduccionUnitario'];
            	$this->PVP = $row['PVP'];
            	$this->IdPuntosDeVenta = $row['IdPuntosDeVenta'];
            	$this->CostoProduccion = $row['CostoProduccion'];
            	$this->PorcentajeCoedicion = $row['PorcentajeCoedicion'];
            	$this->Reimpresion = $row['Reimpresion'];

            }
            return $result;
	}

	public function agregarPVP(){
		$rutaUno = "";
	
		if (!isset($this->FechaEntregaPresupuesto) || $this->FechaEntregaPresupuesto == NULL || $this->FechaEntregaPresupuesto == ""){
            $this->FechaEntregaPresupuesto = "0000-00-00";
        }
        if (!isset($this->IdPatrocinador) || $this->IdPatrocinador == NULL || $this->IdPatrocinador == ""){
            $this->IdPatrocinador = "NULL";

        }
        if (!isset($this->IdPuntosDeVenta) || $this->IdPuntosDeVenta == NULL || $this->IdPuntosDeVenta == ""){
            $this->IdPuntosDeVenta = "NULL";

        }
        if (!isset($this->PresupuestoOrigenes) || $this->PresupuestoOrigenes == NULL || $this->PresupuestoOrigenes == ""){
            $this->PresupuestoOrigenes = "NULL";
        }
        if (!isset($this->PresupuestoEjercido) || $this->PresupuestoEjercido == NULL || $this->PresupuestoEjercido == ""){
            $this->PresupuestoEjercido = "NULL";

        }
        if (!isset($this->CostoTiraje) || $this->CostoTiraje == NULL || $this->CostoTiraje == ""){
            $this->CostoTiraje = "NULL";

        }
        if (!isset($this->CostoProduccionUnitario) || $this->CostoProduccionUnitario == NULL || $this->CostoProduccionUnitario == ""){
            $this->CostoProduccionUnitario = "NULL";
        }
        if (!isset($this->PVP) || $this->PVP == NULL || $this->PVP == ""){
            $this->PVP = "NULL";

        }
        if (!isset($this->IdPuntosDeVenta) || $this->IdPuntosDeVenta == NULL || $this->IdPuntosDeVenta == ""){
            $this->IdPuntosDeVenta = "NULL";

        }
         if (!isset($this->CostoTiraje) || $this->CostoTiraje == NULL || $this->CostoTiraje == ""){
            $this->CostoTiraje = "NULL";

        }
        if (!isset($this->PorcentajeCoedicion) || $this->PorcentajeCoedicion == NULL || $this->PorcentajeCoedicion == ""){
            $this->PorcentajeCoedicion = "NULL";
        }
        
        if (!isset($this->IdPuntosDeVenta) || $this->IdPuntosDeVenta == NULL || $this->IdPuntosDeVenta == ""){
            $this->IdPuntosDeVenta = "NULL";

        }
         if (!isset($this->CostoProduccion) || $this->CostoProduccion == NULL || $this->CostoProduccion == ""){
            $this->CostoProduccion = "NULL";

        }
         if (!isset($this->MontoPresupuesto) || $this->MontoPresupuesto == NULL || $this->MontoPresupuesto == ""){
            $this->MontoPresupuesto = "NULL";

        }

        if (!isset($this->RutaExcelPresupuesto) || $this->RutaExcelPresupuesto == NULL || $this->RutaExcelPresupuesto == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "NULL";
        }else{
        	$rutaUno =  "'".$this->RutaExcelPresupuesto."'";
        }


  		$insert ="INSERT INTO  c_costosypresupuestos (IdLibro,MontoPresupuesto,RutaExcelPresupuesto,FechaEntregaPresupuesto,
							PresupuestoOrigenes,PresupuestoEjercido,CostoTiraje,IdPatrocinador,CostoProduccionUnitario,PVP,IdPuntosDeVenta,CostoProduccion,PorcentajeCoedicion,Reimpresion,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla) VALUES (".$this->IdLibro.",".$this->MontoPresupuesto.",".$rutaUno.",'".$this->FechaEntregaPresupuesto."',".$this->PresupuestoOrigenes.",".$this->PresupuestoEjercido.",".$this->CostoTiraje.",".$this->IdPatrocinador.",".$this->CostoProduccionUnitario.",".$this->PVP.",".$this->IdPuntosDeVenta.",".$this->CostoProduccion.",".$this->PorcentajeCoedicion.",'".$this->Reimpresion."','".$this->UsuarioCreacion."',NOW(),'".$this->UsuarioUltimaModificiacion."',NOW(),'".$this->Pantalla."');";

  		$catalogo = new Catalogo();

  		//echo "<br>".$insert."<br>";

  		$this->IdCostosPresupuestos = $catalogo->insertarRegistro($insert);

        if ($this->IdCostosPresupuestos == 0 || $this->IdCostosPresupuestos == null) {
            return false;
        }
        return true;
	}
	public function editarPVP(){
		$rutaUno = "";
	
		if (!isset($this->FechaEntregaPresupuesto) || $this->FechaEntregaPresupuesto == NULL || $this->FechaEntregaPresupuesto == ""){
            $this->FechaEntregaPresupuesto = "0000-00-00";
        }
        if (!isset($this->IdPatrocinador) || $this->IdPatrocinador == NULL || $this->IdPatrocinador == ""){
            $this->IdPatrocinador = "NULL";

        }
        if (!isset($this->IdPuntosDeVenta) || $this->IdPuntosDeVenta == NULL || $this->IdPuntosDeVenta == ""){
            $this->IdPuntosDeVenta = "NULL";

        }
        if (!isset($this->PresupuestoOrigenes) || $this->PresupuestoOrigenes == NULL || $this->PresupuestoOrigenes == ""){
            $this->PresupuestoOrigenes = "NULL";
        }
        if (!isset($this->PresupuestoEjercido) || $this->PresupuestoEjercido == NULL || $this->PresupuestoEjercido == ""){
            $this->PresupuestoEjercido = "NULL";

        }
        if (!isset($this->CostoTiraje) || $this->CostoTiraje == NULL || $this->CostoTiraje == ""){
            $this->CostoTiraje = "NULL";

        }
        if (!isset($this->CostoProduccionUnitario) || $this->CostoProduccionUnitario == NULL || $this->CostoProduccionUnitario == ""){
            $this->CostoProduccionUnitario = "NULL";
        }
        if (!isset($this->PVP) || $this->PVP == NULL || $this->PVP == ""){
            $this->PVP = "NULL";

        }
        if (!isset($this->IdPuntosDeVenta) || $this->IdPuntosDeVenta == NULL || $this->IdPuntosDeVenta == ""){
            $this->IdPuntosDeVenta = "NULL";

        }
         if (!isset($this->CostoTiraje) || $this->CostoTiraje == NULL || $this->CostoTiraje == ""){
            $this->CostoTiraje = "NULL";

        }
        if (!isset($this->PorcentajeCoedicion) || $this->PorcentajeCoedicion == NULL || $this->PorcentajeCoedicion == ""){
            $this->PorcentajeCoedicion = "NULL";
        }
       
        if (!isset($this->IdPuntosDeVenta) || $this->IdPuntosDeVenta == NULL || $this->IdPuntosDeVenta == ""){
            $this->IdPuntosDeVenta = "NULL";

        }
         if (!isset($this->CostoProduccion) || $this->CostoProduccion == NULL || $this->CostoProduccion == ""){
            $this->CostoProduccion = "NULL";

        }
         if (!isset($this->MontoPresupuesto) || $this->MontoPresupuesto == NULL || $this->MontoPresupuesto == ""){
            $this->MontoPresupuesto = "NULL";

        }


        if (!isset($this->RutaExcelPresupuesto) || $this->RutaExcelPresupuesto == NULL || $this->RutaExcelPresupuesto == ""){
            //$this->IdEntregableIndicePreliminar = "NULL";
        	$rutaUno = "";
        }else{
        	$rutaUno =  ",RutaExcelPresupuesto ="."'".$this->RutaExcelPresupuesto."'";
        }

  		$insert ="UPDATE c_costosypresupuestos SET MontoPresupuesto = ".$this->MontoPresupuesto."".$rutaUno.",FechaEntregaPresupuesto = '".$this->FechaEntregaPresupuesto."',PresupuestoOrigenes = ".$this->PresupuestoOrigenes.",PresupuestoEjercido =".$this->PresupuestoEjercido.",CostoTiraje = ".$this->CostoTiraje.",IdPatrocinador = ".$this->IdPatrocinador.",CostoProduccionUnitario = ".$this->CostoProduccionUnitario.",PVP = ".$this->PVP.",IdPuntosDeVenta = ".$this->IdPuntosDeVenta.",CostoProduccion = ".$this->CostoProduccion.",PorcentajeCoedicion = ".$this->PorcentajeCoedicion.",Reimpresion = '".$this->Reimpresion."',UsuarioUltimaModificacion = '".$this->UsuarioUltimaModificiacion."',FechaUltimaModificacion = NOW(),Pantalla = '".$this->Pantalla."' WHERE IdLibro = ".$this->IdLibro.";";

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
	

	public function getCostoProduccion()
	{
	    return $this->CostoProduccion;
	}

	public function setCostoProduccion($CostoProduccion)
	{
	    $this->CostoProduccion = $CostoProduccion;

	}	

	public function getFechaEntregaPresupuesto()
	{
	    return $this->FechaEntregaPresupuesto;
	}

	public function setFechaEntregaPresupuesto($FechaEntregaPresupuesto)
	{
	    $this->FechaEntregaPresupuesto = $FechaEntregaPresupuesto;

	}

	public function getPresupuestoOrigenes()
	{
	    return $this->PresupuestoOrigenes;
	}

	public function setPresupuestoOrigenes($PresupuestoOrigenes)
	{
	    $this->PresupuestoOrigenes = $PresupuestoOrigenes;

	}
	public function getPresupuestoEjercido()
	{
	    return $this->PresupuestoEjercido;
	}
	public function setPresupuestoEjercido($PresupuestoEjercido)
	{
	    $this->PresupuestoEjercido = $PresupuestoEjercido;

	}



	public function getIdCostosPresupuestos()
	{
	    return $this->IdCostosPresupuestos;
	}

	public function setIdCostosPresupuestos($IdCostosPresupuestos)
	{
	    $this->IdCostosPresupuestos = $IdCostosPresupuestos;

	}



	public function getMontoPresupuesto()
	{
	    return $this->MontoPresupuesto;
	}

	public function setMontoPresupuesto($MontoPresupuesto)
	{
	    $this->MontoPresupuesto = $MontoPresupuesto;

	}
	public function getRutaExcelPresupuesto()
	{
	    return $this->RutaExcelPresupuesto;
	}

	public function setRutaExcelPresupuesto($RutaExcelPresupuesto)
	{
	    $this->RutaExcelPresupuesto = $RutaExcelPresupuesto;

	}

	public function getCostoTiraje()
	{
	    return $this->CostoTiraje;
	}

	public function setCostoTiraje($CostoTiraje)
	{
	    $this->CostoTiraje = $CostoTiraje;

	}

	public function getIdPatrocinador()
	{
	    return $this->IdPatrocinador;
	}

	public function setIdPatrocinador($IdPatrocinador)
	{
	    $this->IdPatrocinador = $IdPatrocinador;

	}
	public function getCostoProduccionUnitario()
	{
	    return $this->CostoProduccionUnitario;
	}

	public function setCostoProduccionUnitario($CostoProduccionUnitario)
	{
	    $this->CostoProduccionUnitario = $CostoProduccionUnitario;

	}
	public function getIdPuntosDeVenta()
	{
	    return $this->IdPuntosDeVenta;
	}

	public function setIdPuntosDeVenta($IdPuntosDeVenta)
	{
	    $this->IdPuntosDeVenta = $IdPuntosDeVenta;

	}
	public function getPVP()
	{
	    return $this->PVP;
	}

	public function setPVP($PVP)
	{
	    $this->PVP = $PVP;

	}
	public function getReimpresion()
	{
	    return $this->Reimpresion;
	}

	public function setReimpresion($Reimpresion)
	{
	    $this->Reimpresion = $Reimpresion;

	}
	public function getPorcentajeCoedicion()
	{
	    return $this->PorcentajeCoedicion;
	}

	public function setPorcentajeCoedicion($PorcentajeCoedicion)
	{
	    $this->PorcentajeCoedicion = $PorcentajeCoedicion;

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