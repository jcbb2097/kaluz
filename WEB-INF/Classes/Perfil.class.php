<?php

include_once("Catalogo.class.php");

class Perfil
{

    private $idPerfil;
    private $descripcion;


    public function Get_perfil()
    {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM c_perfil WHERE c_perfil.idPerfil = " . $this->idPerfil;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->idPerfil = $row['idPerfil'];
            $this->descripcion = $row['descripcion'];

            return true;
        }
        return false;
    }
    public function Nuevo_perfil() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_perfil(descripcion)
            VALUES( '" . $this->descripcion . "');";
        $this->idPerfil = $catalogo->insertarRegistro($insert);
         //echo "<br><br>$insert<br><br>"; 
        if ($this->idPerfil == 0 || $this->idPerfil == null) {
            return false;
        }
        return true;
    }

    public function Editar_perfil() {
       
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_perfil SET descripcion='" . $this->descripcion ."' WHERE c_perfil.idPerfil = $this->idPerfil;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_perfil', 'idPerfil = ' . $this->idPerfil);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminar_perfil() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_perfil WHERE idPerfil = $this->idPerfil;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_perfil", "idPerfil = " . $this->idPerfil);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }





    /**
     * Get the value of idPerfil
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set the value of idPerfil
     *
     * @return  self
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
