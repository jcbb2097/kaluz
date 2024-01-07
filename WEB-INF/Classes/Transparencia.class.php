<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once("Catalogo.class.php");

class Transparencia{
	private $Id_transparencia;
	private $Mes;
	private $Eje;
	private $Anio;
	private $Folio;
	private $Folio_sec;
	private $Contratos;
	private $Fecha_envio;
	private $Fecha_termino;
	private $Fecha_respuesta;
	private $Mpba;
	private $Informacion_solicitada;
	private $Exposicion;
	private $Actividad;
	private $Archivo;
	private $Estatus;
	private $UsrCreacion;
	private $FechaCreacion;
	private $UsrModificacion;
	private $FechaModificacion;
	private $area;

	public function getTransparencia(){
		$catalogo = new catalogo();
		$consultaT = "SELECT * FROM c_transparencia WHERE Id_transparencia = " . $this->Id_transparencia;
		$resultadoT = $catalogo->obtenerLista($consultaT);
		while ($row = mysqli_fetch_array($resultadoT)) {
			//$this->Id_transparencia = $row['Id_transparencia'];
			$this->Mes = $row['Mes'];
			$this->Eje = $row['Eje'];
			$this->Anio = $row['Anio'];
			$this->Folio = $row['Folio'];
			$this->Folio_sec = $row['Folio_sec'];
			$this->Contratos = $row['Contratos'];
			$this->Fecha_envio = $row['Fecha_envio'];
			$this->Fecha_termino = $row['Fecha_termino'];
			$this->Fecha_respuesta = $row['Fecha_respuesta'];
			$this->Mpba = $row['Mpba'];
			$this->Informacion_solicitada = $row['Informacion_solicitada'];
			$this->Exposicion = $row['Exposicion'];
			$this->Actividad = $row['Actividad'];
			$this->Archivo = $row['Archivo'];
			$this->Estatus = $row['Estatus'];
			$this->UsrCreacion = $row['UsrCreacion'];
			$this->FechaCreacion = $row['FechaCreacion'];
			$this->UsrModificacion = $row['UsrModificacion'];
			$this->FechaModificacion = $row['FechaModificacion'];
			$this->area = $row['IdArea'];
			return true;
		}
		return false;
	}

	public function agregarTransparencia(){
		if (!isset($this->Informacion_solicitada) || $this->Informacion_solicitada == ""){
            $this->id_tipotel = NULL;
        }
        if (!isset($this->Fecha_termino) || $this->Fecha_termino == ""){
            $this->Fecha_termino = '0000-00-00';
        }
        if (!isset($this->Fecha_respuesta) || $this->Fecha_respuesta == ""){
            $this->Fecha_respuesta = '0000-00-00';
        }
		$catalogo = new catalogo();
		$insert = "INSERT INTO c_transparencia(Mes, Eje, Anio, Folio, Folio_sec, Contratos, Fecha_envio, Fecha_termino, Fecha_respuesta, Mpba, Informacion_solicitada, Exposicion, Actividad, Archivo, Estatus, UsrCreacion, FechaCreacion, UsrModificacion, FechaModificacion,  IdArea) VALUES(".$this->Mes.",".$this->Eje.",".$this->Anio.",'".$this->Folio."','".$this->Folio_sec."','".$this->Contratos."','".$this->Fecha_envio."','".$this->Fecha_termino."','".$this->Fecha_respuesta."','".$this->Mpba."','".$this->Informacion_solicitada."',".$this->Exposicion.",".$this->Actividad.",'".$this->Archivo."',".$this->Estatus.",'".$this->UsrCreacion."',NOW(),'".$this->UsrModificacion."',NOW(), ".$this->area.");";
		$this->Id_transparencia = $catalogo->insertarRegistro($insert);
		//echo "Insertar: " . $insert;
		if ($this->Id_transparencia == 0 || $this->Id_transparencia == null) {
            return false;
        }
        return true;
	}

	public function editarTransparencia(){
		$catalogo = new catalogo();
		$update = "UPDATE c_transparencia SET Mes=".$this->Mes.", Eje=".$this->Eje.", Anio=".$this->Anio.", Folio='".$this->Folio."', Folio_sec='".$this->Folio_sec."', Contratos='".$this->Contratos."', Fecha_envio='".$this->Fecha_envio."', Fecha_termino='".$this->Fecha_termino."', Fecha_respuesta='".$this->Fecha_respuesta."', Mpba='".$this->Mpba."', Informacion_solicitada='".$this->Informacion_solicitada."', Exposicion=".$this->Exposicion.", Actividad=".$this->Actividad.", Archivo='".$this->Archivo."', Estatus=".$this->Estatus.", UsrModificacion='".$this->UsrModificacion."', FechaModificacion=NOW(), IdArea=".$this->area." WHERE Id_transparencia = $this->Id_transparencia;";
		$query = $catalogo->ejecutaConsultaActualizacion($update, 'c_transparencia', 'Id_transparencia = ' . $this->Id_transparencia);
        //echo "<br>EDITAR:  " . $update;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	public function eliminarTransparencia(){
		$catalogo = new catalogo();
		$delete = "DELETE FROM c_transparencia WHERE Id_transparencia = $this->Id_transparencia;";
		$query = $catalogo->ejecutaConsultaActualizacion($delete, "c_transparencia", "Id_transparencia = " . $this->Id_transparencia);
        //echo "<br> ELIMINAR: " . $delete;
        if ($query == 1) {
            return true;
        }
        return false;
	}

	function getId_transparencia(){
		return $this->Id_transparencia;
	}
	function setId_transparencia($Id_transparencia) {
        $this->Id_transparencia = $Id_transparencia;
    }
	
	function getMes(){
		return $this->Mes;
	}
	function setMes($Mes) {
        $this->Mes = $Mes;
    }

	function getEje(){
		return $this->Eje;
	}
	function setEje($Eje) {
        $this->Eje = $Eje;
    }
	
	function getAnio(){
		return $this->Anio;
	}
	function setAnio($Anio) {
        $this->Anio = $Anio;
    }
	
	function getFolio(){
		return $this->Folio;
	}
	function setFolio($Folio) {
        $this->Folio = $Folio;
    }
	
	function getFolio_sec(){
		return $this->Folio_sec;
	}
	function setFolio_sec($Folio_sec) {
        $this->Folio_sec = $Folio_sec;
    }

	function getContratos(){
		return $this->Contratos;
	}
	function setContratos($Contratos) {
        $this->Contratos = $Contratos;
    }

	function getFecha_envio(){
		return $this->Fecha_envio;
	}
	function setFecha_envio($Fecha_envio) {
        $this->Fecha_envio = $Fecha_envio;
    }

	function getFecha_termino(){
		return $this->Fecha_termino;
	}
	function setFecha_termino($Fecha_termino) {
        $this->Fecha_termino = $Fecha_termino;
    }

	function getFecha_respuesta(){
		return $this->Fecha_respuesta;
	}
	function setFecha_respuesta($Fecha_respuesta) {
        $this->Fecha_respuesta = $Fecha_respuesta;
    }

	function getMpba(){
		return $this->Mpba;
	}
	function setMpba($Mpba) {
        $this->Mpba = $Mpba;
    }

	function getInformacion_solicitada(){
		return $this->Informacion_solicitada;
	}
	function setInformacion_solicitada($Informacion_solicitada) {
        $this->Informacion_solicitada = $Informacion_solicitada;
    }

	function getExposicion(){
		return $this->Exposicion;
	}
	function setExposicion($Exposicion) {
        $this->Exposicion = $Exposicion;
    }

	function getActividad(){
		return $this->Actividad;
	}
	function setActividad($Actividad) {
        $this->Actividad = $Actividad;
    }

	function getArchivo(){
		return $this->Archivo;
	}
	function setArchivo($Archivo) {
        $this->Archivo = $Archivo;
    }

	function getEstatus(){
		return $this->Estatus;
	}
	function setEstatus($Estatus) {
        $this->Estatus = $Estatus;
    }

	function getUsrCreacion(){
		return $this->UsrCreacion;
	}
	function setUsrCreacion($UsrCreacion) {
        $this->UsrCreacion = $UsrCreacion;
    }

	function getFechaCreacion(){
		return $this->FechaCreacion;
	}
	function setFechaCreacion($FechaCreacion) {
        $this->FechaCreacion = $FechaCreacion;
    }

	function getUsrModificacion(){
		return $this->UsrModificacion;
	}
	function setUsrModificacion($UsrModificacion) {
        $this->UsrModificacion = $UsrModificacion;
    }

	function getFechaModificacion(){
		return $this->FechaModificacion;
	}
	function setFechaModificacion($FechaModificacion) {
        $this->FechaModificacion = $FechaModificacion;
    }

    function getArea(){
		return $this->area;
	}
	function setArea($area) {
        $this->area = $area;
    }

}
?>