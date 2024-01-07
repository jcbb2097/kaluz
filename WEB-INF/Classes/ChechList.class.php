<?php

include_once("Catalogo.class.php");

class check_list
{

    private $IdCheckList;
    private $Nombre;
    private $Descripcion;
    private $UsuarioCreacion;
    private $FechaCreacion;
    private $UsuarioUltimaModificacion;
    private $FechaUltimaModificacion;
    private $Pantalla;

    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function nuevo_checklist()
    {
        $insert = "INSERT INTO c_checkList(Nombre)
            VALUES( '" . $this->Nombre . "');";
        $this->IdCheckList = $this->catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>"; 
        if ($this->IdCheckList == 0 || $this->IdCheckList == null) {
            return false;
        }
        return true;
    }



    public function check_existe($check)
    {
        $id = "";
        $consultaareas = "SELECT ch.IdCheckList FROM c_checkList as ch WHERE ch.Nombre like '%$check%'";
        $Result = $this->catalogo->obtenerLista($consultaareas);
        while ($row = mysqli_fetch_array($Result)) {
            $id = $row['IdCheckList'];
        }
        return $id;
    }

    public function anadir_check_actividad($id_check, $id_actividad, $id_periodo)
    {
        $insert = "INSERT INTO k_checklist_actividad(IdCheckList,IdActividad,Id_Periodo)
        VALUES(  $id_check  , $id_actividad , $id_periodo);";
        $this->IdCheckList = $this->catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->IdCheckList == 0 || $this->IdCheckList == null) {
            return false;
        }
        return true;
    }
    public function eliminar_check_actividad($id_actividad, $id_periodo)
    {
        $consulta = "DELETE FROM k_checklist_actividad WHERE  IdActividad =$id_actividad AND Id_Periodo=$id_periodo";
        $query =  $this->catalogo->ejecutaConsultaActualizacion($consulta, "k_checklist_actividad", "IdActividad = " . $id_actividad);
        if ($query == 1) {
            return true;
        }
        return false;
    }


    public function getIdCheckList()
    {
        return $this->IdCheckList;
    }

    public function setIdCheckList($IdCheckList)
    {
        $this->IdCheckList = $IdCheckList;

        return $this;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getUsuarioCreacion()
    {
        return $this->UsuarioCreacion;
    }

    public function setUsuarioCreacion($UsuarioCreacion)
    {
        $this->UsuarioCreacion = $UsuarioCreacion;

        return $this;
    }

    public function getFechaCreacion()
    {
        return $this->FechaCreacion;
    }

    public function setFechaCreacion($FechaCreacion)
    {
        $this->FechaCreacion = $FechaCreacion;

        return $this;
    }


    public function getUsuarioUltimaModificacion()
    {
        return $this->UsuarioUltimaModificacion;
    }

    public function setUsuarioUltimaModificacion($UsuarioUltimaModificacion)
    {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;

        return $this;
    }

    public function getFechaUltimaModificacion()
    {
        return $this->FechaUltimaModificacion;
    }

    public function setFechaUltimaModificacion($FechaUltimaModificacion)
    {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;

        return $this;
    }

    public function getPantalla()
    {
        return $this->Pantalla;
    }

    public function setPantalla($Pantalla)
    {
        $this->Pantalla = $Pantalla;

        return $this;
    }
}
