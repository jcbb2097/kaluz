<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("Catalogo.class.php");
class indicador{
	public function getAgente($id){
    	$catalogo = new catalogo();
    	$consultaP = "select marca, count(*) as total,
				sum(case when idEstatusDispositivo=3 then 1 else 0 end) as totalActivas,
				sum(case when idEstatusDispositivo=4 then 1 else 0 end) as totalInactivas
				from k_dispositivoP
				where idTipoDispositivo  = " . $this->id;
    	$rpersona = $catalogo->obtenerLista($consultaP);
    	while ($row = mysqli_fetch_array($rpersona)) {
			$this->totalActivas = $row['totalActivas'];
			$this->totalInactivas = $row['totalInactivas'];
    		$this->marca= $row['marca'];
    		$this->total = $row['total'];
    		return true;
    	}
    	return false;
    }
    function gettotalActivas(){
    	return $this->totalActivas;
    }

    function settotalActivas($totalActivas){
    	$this->totalActivas = $totalActivas;
    }
       function gettotalInactivas(){
    	return $this->totalInactivas;
    }

    function settotalInactivas($totalInactivas){
    	$this->totalInactivas = $totalInactivas;
    }
       function getmarca(){
    	return $this->marca;
    }

    function setmarca($marca){
    	$this->marca = $marca;
    }
       function gettotal(){
    	return $this->total;
    }

    function settotal($total){
    	$this->total = $total;
    }
}