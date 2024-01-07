<?php

include_once("Catalogo.class.php");

class Perfil_submenu
{
    private $Id_perfil;
    private $Id_submenu;
    private $Alta;
    private $Baja;
    private $Cambio;


    public function Get_perfil_submenu()
    {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM k_perfil_submenu as a WHERE a.Id_perfil=" . $this->Id_perfil . " AND a.Id_submenu=" . $this->Id_submenu;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->Id_perfil = $row['Id_perfil'];
            $this->Id_submenu = $row['Id_submenu'];
            $this->Alta = $row['Alta'];
            $this->Baja = $row['Baja'];
            $this->Cambio = $row['Cambio'];
            return true;
        }
        return false;
    }

    public function Nuevo_perfil_submenu()
    {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_perfil_submenu(Id_perfil,Id_submenu,Alta,Baja,Cambio)
            VALUES( " . $this->Id_perfil . "," . $this->Id_submenu . ",".$this->Alta.",".$this->Baja.",".$this->Cambio.");";
        $this->Id_perfil = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_perfil == null) {
            return false;
        }
        return true;
    }

    public function Editar_perfil_submenu() {

        $catalogo = new Catalogo();
        $consulta = "UPDATE k_perfil_submenu as a set a.Alta=".$this->Alta.",a.Baja=".$this->Baja.",a.Cambio=".$this->Cambio." WHERE a.Id_perfil=".$this->Id_perfil." AND a.Id_submenu=".$this->Id_submenu;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_perfil_submenu', 'Id_perfil = ' . $this->Id_perfil);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminar_perfil_submenu() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_perfil_submenu WHERE Id_perfil = $this->Id_perfil AND Id_submenu = $this->Id_submenu";
                $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_perfil_submenu", "Id_perfil = " . $this->Id_perfil);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function SubMenu($Id_menu,$Id_perfil)
    {
        $existe = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(p.Id_submenu) total FROM k_perfil_submenu p WHERE p.Id_submenu=$Id_menu AND p.Id_perfil=$Id_perfil";
        //echo$consulta;
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $existe = $row['total'];
        }
        return $existe;
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
     * Get the value of Id_submenu
     */
    public function getId_submenu()
    {
        return $this->Id_submenu;
    }

    /**
     * Set the value of Id_submenu
     *
     * @return  self
     */
    public function setId_submenu($Id_submenu)
    {
        $this->Id_submenu = $Id_submenu;

        return $this;
    }

    /**
     * Get the value of Alta
     */
    public function getAlta()
    {
        return $this->Alta;
    }

    /**
     * Set the value of Alta
     *
     * @return  self
     */
    public function setAlta($Alta)
    {
        $this->Alta = $Alta;

        return $this;
    }

    /**
     * Get the value of Baja
     */
    public function getBaja()
    {
        return $this->Baja;
    }

    /**
     * Set the value of Baja
     *
     * @return  self
     */
    public function setBaja($Baja)
    {
        $this->Baja = $Baja;

        return $this;
    }

    /**
     * Get the value of Cambio
     */
    public function getCambio()
    {
        return $this->Cambio;
    }

    /**
     * Set the value of Cambio
     *
     * @return  self
     */
    public function setCambio($Cambio)
    {
        $this->Cambio = $Cambio;

        return $this;
    }
}
