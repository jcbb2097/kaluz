<?php

include_once("Catalogo.class.php");

class categoria_eje
{
    private $idCategoria;
    private $idEje;
    private $descCategoria;
    private $anio;
    private $nivelCategoria;
    private $idCategoriaPadre;
    private $idExposicion;
    private $ordencate;
    private $ordensubcate;

    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }


    public function getCategoria()
    {
        $consultaCategoria = "SELECT * FROM c_categoriasdeejes ce WHERE ce.idCategoria = " . $this->idCategoria;
        $resultCategoria = $this->catalogo->obtenerLista($consultaCategoria);
        while ($row = mysqli_fetch_array($resultCategoria)) {
            $this->descCategoria = $row['descCategoria'];
            $this->idEje = $row['idEje'];
            $this->anio = $row['anio'];
            $this->nivelCategoria = $row['nivelCategoria'];
            $this->idCategoriaPadre = $row['idCategoriaPadre'];
            $this->idExposicion = $row['idExposicion'];
            $this->ordencate = $row['orden'];
            return true;
        }
        return false;
    }

    public function nuevaCategoria()
    {
        $insert = "INSERT INTO c_categoriasdeejes(descCategoria,idEje,anio,nivelCategoria,orden)
            VALUES('" . $this->descCategoria . "'," . $this->idEje . "," . $this->anio . "," . $this->nivelCategoria . ",".$this->ordencate.");";
        $this->idCategoria = $this->catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>"; 
        if ($this->idCategoria == 0 || $this->idCategoria == null) {
            return false;
        }
        return true;
    }
    public function nuevaSubcategoria()
    {
        $insert = "INSERT INTO c_categoriasdeejes(descCategoria,idEje,anio,nivelCategoria,idExposicion,idCategoriaPadre,orden)
        VALUES('" . $this->descCategoria . "'," . $this->idEje . "," . $this->anio . "," . $this->nivelCategoria . "," . $this->idExposicion . "," . $this->idCategoriaPadre . "," . $this->ordensubcate . ");";
        $this->idCategoria = $this->catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>"; 
        if ($this->idCategoria == 0 || $this->idCategoria == null) {
            return false;
        }
        return true;
    }
    public function editarCategoria()
    {
        $consulta = "UPDATE c_categoriasdeejes SET descCategoria='" . $this->descCategoria . "',idEje=" . $this->idEje . ",anio = " . $this->anio . ",orden = " . $this->ordencate . " WHERE c_categoriasdeejes.idCategoria = " . $this->idCategoria . ";";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'c_categoriasdeejes', 'idCategoria = ' . $this->idCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function editarSubcategoria()
    {
        $consulta = "UPDATE c_categoriasdeejes SET descCategoria='" . $this->descCategoria . "',idEje=" . $this->idEje . ",anio = " . $this->anio . ", idExposicion = " . $this->idExposicion . ", orden = " . $this->ordensubcate . " WHERE c_categoriasdeejes.idCategoria = " . $this->idCategoria . ";";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'c_categoriasdeejes', 'idCategoria = ' . $this->idCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminaCategoria()
    {
        $consulta = "DELETE FROM c_categoriasdeejes WHERE idCategoria = " . $this->idCategoria . ";";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, "c_categoriasdeejes", "idCategoria = " . $this->idCategoria);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminaSubcategoria()
    {
        $consulta = "DELETE FROM c_categoriasdeejes WHERE idCategoria = " . $this->idCategoria . ";";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, "c_categoriasdeejes", "idCategoria = " . $this->idCategoria);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }
    public function getIdEje()
    {
        return $this->idEje;
    }
    public function setIdEje($idEje)
    {
        $this->idEje = $idEje;

        return $this;
    }
    public function getDescCategoria()
    {
        return $this->descCategoria;
    }
    public function setDescCategoria($descCategoria)
    {
        $this->descCategoria = $descCategoria;

        return $this;
    }
    public function getAnio()
    {
        return $this->anio;
    }
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }
    public function getNivelCategoria()
    {
        return $this->nivelCategoria;
    }
    public function setNivelCategoria($nivelCategoria)
    {
        $this->nivelCategoria = $nivelCategoria;

        return $this;
    }
    public function getIdCategoriaPadre()
    {
        return $this->idCategoriaPadre;
    }
    public function setIdCategoriaPadre($idCategoriaPadre)
    {
        $this->idCategoriaPadre = $idCategoriaPadre;

        return $this;
    }
    public function getIdExposicion()
    {
        return $this->idExposicion;
    }
    public function setIdExposicion($idExposicion)
    {
        $this->idExposicion = $idExposicion;

        return $this;
    }
    public function getordencate()
    {
        return $this->ordencate;
    }
    public function setordencate($ordencate)
    {
        $this->ordencate = $ordencate;

        return $this;
    }

    public function getordensubcate()
    {
        return $this->ordensubcate;
    }
    public function setordensubcate($ordensubcate)
    {
        $this->ordensubcate = $ordensubcate;

        return $this;
    }
}
