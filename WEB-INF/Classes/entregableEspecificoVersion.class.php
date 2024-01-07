<?php
include_once("Catalogo.class.php");

class entregableEspecificoVersion{

	private $IdEntregableEspecificoVersion;
	private $IdEntregableEspecifico;
	private $Fecha;
	private $IdArchivoPreliminar;

	public function obtenerEntregableEsp($IdEntregableEspecificoVersion){
		 $consulta ="SELECT IdEntregableEspecifico,Fecha,IdArchivoPreliminar FROM `k_entregableEspecifVersion` WHERE IdEntregableEspecificoVersion = ".$IdEntregableEspecificoVersion;

		 $query = $catalogo->obtenerLista($consulta);
	        while ($rs = mysqli_fetch_array($query)) {
	            
	            $this->IdEntregableEspecifico = $rs['IdEntregableEspecifico'];
	            $this->Fecha = $rs['Fecha'];
	            $this->IdArchivoPreliminar = $rs['IdArchivoPreliminar'];
				echo $rs['IdArchivoPreliminar'];
	        }
			echo $consulta;
	}

	public function agregarEntregableEspecificoVersion() {
		if(!isset($this->IdEntregableEspecifico) || $this->IdEntregableEspecifico == null){
            $this->IdEntregableEspecifico = "NULL";
        }
        if(!isset($this->IdArchivoPreliminar) || $this->IdArchivoPreliminar == null){
            $this->IdArchivoPreliminar = "NULL";
        }
		$consulta = ("INSERT INTO k_entregableEspecifVersion(IdEntregableEspecifico,Fecha,IdArchivoPreliminar)
            VALUES(".$this->IdEntregableEspecifico.",NOW(),".$this->IdArchivoPreliminar.");");
        //echo "<br><br>$consulta<br><br>";
        $catalogo = new Catalogo();
        $this->IdEntregableEspecificoVersion = $catalogo->insertarRegistro($consulta);

        if ($this->IdEntregableEspecificoVersion != NULL && $this->IdEntregableEspecificoVersion != 0) {
            return true;
        }
        return false;
	}

	public function editarEntregableEspecificoVersion() {
		if(!isset($this->IdEntregableEspecifico) || $this->IdEntregableEspecifico == null){
            $this->IdEntregableEspecifico = "NULL";
        }
        if(!isset($this->IdArchivoPreliminar) || $this->IdArchivoPreliminar == null){
            $this->IdArchivoPreliminar = "NULL";
        }
		$insert = ("UPDATE k_entregableEspecifVersion SET IdEntregableEspecifico = ".$this->IdEntregable.",Fecha = NOW(),IdArchivoPreliminar = ".$this->IdArchivoPreliminar." WHERE IdEntregableEspecifico = ".$this->IdEntregableEspecifico." AND  IdArchivoPreliminar =".$IdArchivoPreliminar.";");
        //echo "<br><br>$insert<br><br>";
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($insert, 'k_entregableEspecifVersion', 'IdEntregableEspecifico = '.$this->IdEntregableEspecifico.' AND  IdArchivoPreliminar ='.$IdArchivoPreliminar);

        if ($query == 1) {
            return true;
        }
        return false;
	}

    public function eliminarEntregableEspecificoVersion(){
        $consulta = ("DELETE FROM k_entregableEspecifVersion WHERE IdEntregableEspecifico = ".$this->IdEntregableEspecifico." AND  IdArchivoPreliminar =".$this->IdArchivoPreliminar.";");
        $catalogo = new Catalogo();
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_entregableEspecifVersion', 'IdEntregableEspecifico = '.$this->IdEntregableEspecifico.' AND  IdArchivoPreliminar ='.$this->IdArchivoPreliminar);
        //echo "<br>$consulta<br>";
        if ($query == 1) {
            return true;
        }
        return false; 
    }
    public function setIdEntregableEspecificoVersion($IdEntregableEspecificoVersion){
        $this->IdEntregableEspecificoVersion= $IdEntregableEspecificoVersion;
    }

    public function getIdEntregableEspecificoVersion(){
        return $this->IdEntregableEspecificoVersion;
    }
    public function setIdEntregableEspecifico($IdEntregableEspecifico){
        $this->IdEntregableEspecifico= $IdEntregableEspecifico;
    }

    public function getIdEntregableEspecifico(){
        return $this->IdEntregableEspecifico;
    }
    public function setFecha($Fecha){
        $this->Fecha= $Fecha;
    }

    public function getFecha(){
        return $this->Fecha;
    }
    public function setIdArchivoPreliminar($IdArchivoPreliminar){
        $this->IdArchivoPreliminar= $IdArchivoPreliminar;
    }

    public function getIdArchivoPreliminar(){
        return $this->IdArchivoPreliminar;
    }
}