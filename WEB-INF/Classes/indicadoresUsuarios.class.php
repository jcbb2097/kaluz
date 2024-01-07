<?php
include_once("Catalogo.class.php");
 class Indicadoresusuarios {
    Private $id_indicador;
    Private $id_usuario;
    
    public function getRegistro() {
        $catalogo = new Catalogo();
        $consultaRegistro = "SELECT * FROM k_indicador_usuario WHERE id_indicador= " . $this->$id_indicador ."AND".$this->id_usuario."";
        $resultCRegistro = $catalogo->obtenerLista($consultaRegistro);
        //var_dump($resultCRegistro);
        while ($row = mysqli_fetch_array($resultCRegistro)) {
            $this->id_indicador = $row['id_indicador'];
            $this->id_usuario = $row['id_usuario'];
     
            return true;
        }
        return false;
    }
    public function indicadorusuario() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_indicador_usuario(id_indicador,id_usuario)
                VALUES(" . $this->id_indicador . "," . $this->id_usuario . ");";
        $this->IdIndicador = $catalogo->insertarRegistro($insert);
       //echo "<br><br>$insert<br><br>";
        $this->id_indicador = $catalogo->insertarRegistro($insert);
        if($this->id_indicador == 0 || $this->id_indicador == null){
        return false;
    }
    }
    public function Eliminarusuarioindicador() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_indicador_usuario WHERE id_indicador = $this->id_indicador AND id_usuario=$this->id_usuario;";

        //echo "<br><br>$consulta<br><br>";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_indicador_usuario", "id_indicador = ".$this->id_indicador);
        if($query == 1){
            return true;
        }
        return false;
    }
    
    
    
    function getId_indicador() {
        return $this->id_indicador;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setId_indicador($id_indicador) {
        $this->id_indicador = $id_indicador;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }


}
