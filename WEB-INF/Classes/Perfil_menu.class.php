<?php

include_once("Catalogo.class.php");

class Perfil_menu {

    private $Id_perfil;
    private $Id_menu;
    private $Consulta;
    


    public function Get_perfil_menu($ID_aplicacion) {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT pm.Id_perfil,pm.Id_menu,pm.Consulta FROM k_perfil_menu pm INNER JOIN c_menu m on m.Id_menu=pm.Id_menu WHERE m.Id_aplicacion=".$ID_aplicacion." AND pm.Id_perfil=".$this->Id_perfil;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->Id_perfil = $row['Id_perfil'];
            $this->Id_menu = $row['Id_menu'];
            $this->Consulta = $row['Consulta'];
           
            return true;
        }
        return false;
    }

    public function Nuevo_perfil_menu() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_perfil_menu(Id_perfil,Id_menu,Consulta)
            VALUES( " . $this->Id_perfil . "," . $this->Id_menu . ",".$this->Consulta.");";
        $this->Id_perfil = $catalogo->insertarRegistro($insert);
         //echo "<br><br>$insert<br><br>"; 
        if ($this->Id_perfil == null) {
            return false;
        }
        return true;
    }
    public function Editar_perfil_submenu() {
      
        $catalogo = new Catalogo();
        $consulta = "UPDATE k_perfil_menu as pm SET pm.Consulta=".$this->Consulta." WHERE pm.Id_menu=".$this->Id_menu." AND pm.Id_perfil=".$this->Id_perfil;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_perfil_menu', 'Id_perfil = ' . $this->Id_perfil);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    

    public function Eliminar_perfil_menu() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_perfil_menu WHERE Id_perfil = $this->Id_perfil AND Id_menu = $this->Id_menu";
                $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_perfil_menu", "Id_perfil = " . $this->Id_perfil);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

   


    /**
     * Get the value of Id_perfil
     */ 
    public function getId_perfil()
    {
        return $this->Id_perfil;
    }

    /**
     * Set the value of Id_perfil
     *
     * @return  self
     */ 
    public function setId_perfil($Id_perfil)
    {
        $this->Id_perfil = $Id_perfil;

        return $this;
    }

    /**
     * Get the value of Id_menu
     */ 
    public function getId_menu()
    {
        return $this->Id_menu;
    }

    /**
     * Set the value of Id_menu
     *
     * @return  self
     */ 
    public function setId_menu($Id_menu)
    {
        $this->Id_menu = $Id_menu;

        return $this;
    }

    /**
     * Get the value of Consulta
     */ 
    public function getConsulta()
    {
        return $this->Consulta;
    }

    /**
     * Set the value of Consulta
     *
     * @return  self
     */ 
    public function setConsulta($Consulta)
    {
        $this->Consulta = $Consulta;

        return $this;
    }
}
