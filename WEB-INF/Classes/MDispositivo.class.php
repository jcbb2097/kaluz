<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class MDispositivo{
	private $nombre;
	private $descripcion;
	private $tf;
    public function getMDispositivo(){
    	$catalogo = new catalogo();
    	$consultaP = "SELECT nombre, idEje, idArea, idConcepto, numero FROM c_metadisp WHERE idMeta = '".$this->Mid."'";
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->nombre = $row['nombre'];
            $this->idEje = $row['idEje'];
            $this->idArea = $row['idArea'];
            $this->idConcepto = $row['idConcepto'];
            $this->numero = $row['numero'];
    		return true;
    	}
    	return false;
    }

    public function corroborarMDispositivo(){
    	$catalogo = new Catalogo();
    	$consultaT = "SELECT * FROM c_metadisp WHERE nombre = '".$this->nombre."'";
    	//echo "C " . $consultaT;
    	$corroborar = $catalogo->obtenerLista($consultaT);
    	if (mysqli_num_rows($corroborar) == 0) {
    		return true;
    	}
    	return false;
    }
    public function nuevoMDispositivo(){
    	$catalogo = new Catalogo();
    	$insertarA = "INSERT INTO c_metadisp (nombre, idEje, idArea, idConcepto, numero, estatus, fechaCreacion, usuarioCreacion, fechaUltimaModificacion, usuarioUltimaModificacion, pantalla)
    	VALUES ('".$this->nombre."', '".$this->idEje."', '".$this->idArea."', '".$this->idConcepto."', '".$this->numero."', ".$this->Estatus.", NOW(), 'prueba',NOW(), 'prueba','alta_MDispositivo.php');";
    	$this->Mid = $catalogo->insertarRegistro($insertarA);
    	//echo "<br><br>$insertarA<br><br>"; 
        if ($this->Mid == 0 || $this->Mid == null) {
            return false;
        }
        return true;
    }
    public function editarMDispositivo(){
    	$catalogo = new Catalogo();
    	$editarA = "UPDATE c_metadisp SET nombre='".$this->nombre."', idEje='".$this->idEje."', idArea='".$this->idArea."', idConcepto='".$this->idConcepto."', numero='".$this->numero."'  WHERE idMeta ='".$this->Mid."' ";
    	$query = $catalogo->ejecutaConsultaActualizacion($editarA, 'c_metadisp', 'idMeta = ' . $this->Mid);
    	//echo "<br><br>$editarA<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarMDispositivo(){
    	$catalogo = new Catalogo();
    	$eliminarA = "DELETE FROM c_metadisp WHERE idMeta = $this->Mid;";
    	$queryE = $catalogo->ejecutaConsultaActualizacion($eliminarA, 'c_metadisp', 'idMeta = ' . $this->Mid);
    	//echo "<br><br>$eliminarA<br><br>"; 
        if ($queryE == 1) {
            return true;
        }
        return false;
    }

  function setnombre($nombre){
        $this->nombre = $nombre;
    }
    function getnombre(){
        return $this->nombre;
    } 
    function setMid($Mid){
        $this->Mid = $Mid;
    }
    function getMid(){
        return $this->Mid;
    } 
    function setidEje($idEje){
        $this->idEje = $idEje;
    }
    function getidEje(){
        return $this->idEje;
    }
    function setidArea($idArea){
        $this->idArea = $idArea;
    }
    function getidArea(){
        return $this->idArea;
    }
    function setidConcepto($idConcepto){
        $this->idConcepto = $idConcepto;
    }
    function getidConcepto(){
        return $this->idConcepto;
    }
    function getnumero(){
        return $this->numero;
    }
    function setnumero($numero){
        $this->numero = $numero;
    }
 
    function  setEstatus($Estatus){
        $this->Estatus = $Estatus;
    }
    function getEstatus(){
        return $this->Estatus;
    }

  

}
?>  