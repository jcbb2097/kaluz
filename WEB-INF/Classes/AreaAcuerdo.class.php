<?php

include_once("Catalogo.class.php");

class Areas {

    private $id_Acuerdo_area;
    private $id_Acuerdo;
    private $id_Area_invitada;

    public function getAreas() {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM k_acuerdoarea WHERE k_acuerdoarea.id_Acuerdo = " . $this->id_Acuerdo;
        //echo '<br>'.$consultaAcuerdo.'<br>';
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        /*while ($row = mysql_fetch_array($resultAcuerdo)) {
            $this->id_Acuerdo = $row['id_Acuerdo'];
            $this->id_Area_invitada = $row['id_Area_invitada'];
            return true;
        }*/
        return $resultAcuerdo;
    }

    public function acuerdoareas() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_acuerdoarea(id_Acuerdo,id_Area_invitada,firma)
                VALUES(" . $this->id_Acuerdo . "," . $this->id_Area_invitada .",null);";
        $this->id_Acuerdo_area = $catalogo->insertarRegistro($insert);
        
        // echo "<br><br>$insert<br><br>";
        if ($this->id_Acuerdo_area == 0 || $this->id_Acuerdo_area == null) {
            return false;
        }
    }
    
    public function editarareas(){
        $catalogo = new Catalogo(); 
        $consulta = "UPDATE k_acuerdoarea SET id_Acuerdo =$this->id_Acuerdo,id_Area_invitada=$this->id_Area_invitada WHERE id_Acuerdo_area = $this->id_Acuerdo_area;"; 
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_acuerdoarea', 'id_Acuerdo_area = '.$this->id_Acuerdo_area);
          //echo "<br><br>$consulta<br><br>";
        if($query == 1){
            return true;
        }
        return false;
}

    

    public function Eliminarea() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_acuerdoarea WHERE id_Acuerdo = $this->id_Acuerdo;";
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_acuerdoarea", "id_Acuerdo = " . $this->id_Acuerdo);
        if ($query == 1) {
            return true;
        }
        return false;
    }


    public function validaareas() {
        $consultageneral = "SELECT * FROM k_acuerdoarea WHERE id_Acuerdo=$this->id_Acuerdo and id_Area_invitada=$this->id_Area_invitada;";
        $catalogo = new Catalogo();
        //print_r($consultageneral);
        $resultgeneral = $catalogo->obtenerLista($consultageneral);
        if(mysqli_num_rows($resultgeneral)>0){
           //echo " si existe ";
        }else{
           $insert = "INSERT INTO k_acuerdoarea(id_Acuerdo,id_Area_invitada,firma)
                VALUES(" . $this->id_Acuerdo . "," . $this->id_Area_invitada .",null);";
           $this->id_Acuerdo_area = $catalogo->insertarRegistro($insert);
           if ($this->id_Acuerdo_area == 0 || $this->id_Acuerdo_area == null) {
            return false;
        }
        }
    }


    public function validaEliminarea() {
        $valores = $this->id_Area_invitada;
        while ($valores != $this->id_Area_invitada) {
            echo $valores;
            $valores = $valores.", ".$this->id_Area_invitada."" ;
        }
        /*$consultaeliminar = "SELECT * FROM k_acuerdoarea WHERE id_Acuerdo=$this->id_Acuerdo and id_Area_invitada!=$this->id_Area_invitada;";
        $catalogo = new Catalogo();
        //echo $consultaeliminar;
        $resulteliminar = $catalogo->obtenerLista($consultaeliminar);
        if(mysqli_num_rows($resulteliminar)>0){
           echo " no existe ";
        }else{
           echo " si existe ";
        }*/
        
    }

    function getId_Acuerdo_area() {
        return $this->id_Acuerdo_area;
    }

    function getId_Acuerdo() {
        return $this->id_Acuerdo;
    }

    function getId_Area_invitada() {
        return $this->id_Area_invitada;
    }

    function setId_Acuerdo_area($id_Acuerdo_area) {
        $this->id_Acuerdo_area = $id_Acuerdo_area;
    }

    function setId_Acuerdo($id_Acuerdo) {
        $this->id_Acuerdo = $id_Acuerdo;
    }

    function setId_Area_invitada($id_Area_invitada) {
        $this->id_Area_invitada = $id_Area_invitada;
    }

}
