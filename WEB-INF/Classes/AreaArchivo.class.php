<?php

include_once("Catalogo.class.php");

class Areas {

    private $id_Archivo_area;
    private $id_Archivo;
    private $id_Area_invitada;

    public function getAreas() {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM k_archivoarea WHERE k_acuerdoarea.id_Archivo = " . $this->id_Archivo;
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
        $insert = "INSERT INTO k_archivoarea(id_Archivo,id_Area_invitada)
                VALUES(" . $this->id_Archivo . "," . $this->id_Area_invitada .");";
        $this->id_Archivo_area = $catalogo->insertarRegistro($insert);
        // echo "<br><br>$insert<br><br>";
        if ($this->id_Archivo_area == 0 || $this->id_Archivo_area == null) {
            return false;
        }
    }





    public function Eliminarea() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_archivoarea WHERE id_Archivo = $this->id_Archivo;";
        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_archivoarea", "id_Archivo = " . $this->id_Archivo);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_Archivo_area() {
        return $this->id_Archivo_area;
    }

    function getId_Archivo() {
        return $this->id_Archivo;
    }

    function getId_Area_invitada() {
        return $this->id_Area_invitada;
    }

    function setId_Archivo_area($id_Archivo_area) {
        $this->id_Archivo_area = $id_Archivo_area;
    }

    function setId_Archivo($id_Archivo) {
        $this->id_Archivo = $id_Archivo;
    }

    function setId_Area_invitada($id_Area_invitada) {
        $this->id_Area_invitada = $id_Area_invitada;
    }


}
