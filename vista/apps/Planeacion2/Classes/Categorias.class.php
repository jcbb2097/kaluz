<?php

include_once __DIR__ . "/../../../../WEB-INF/Classes/Catalogo.class.php";

//clase principal de Planeacion 
class Categoria
{
    private $idCategoria;
    private $idEje;
    private $descCategoria;
    private $anio;
    private $nivelCategoria;
    private $idCategoriaPadre;
    private $idExposicion;
    private $orden;
    private $Periodo;
    private $Visible;
    private $ACME;


    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function DeactivateCategoria($id_categoria)
    {
        $consulta = "UPDATE k_categoriasdeejes_anios SET Visible = $this->Visible WHERE idCategoria in($id_categoria) AND Anio=$this->anio AND ACME=$this->ACME;";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_categoriasdeejes_anios', 'idCategoria = ' . $this->idCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function get_categorias($idcategoria, $tipo, $anio)
    {
        $ids = array();
        array_push($ids, $idcategoria);
        $consulta_sub = "SELECT
        ca.idCategoria 
    FROM
        c_categoriasdeejes ca
        LEFT JOIN k_categoriasdeejes_anios caa ON caa.idCategoria = ca.idCategoria
        WHERE  caa.ACME=$tipo AND caa.Anio=$anio AND ca.idCategoriaPadre=$idcategoria";
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }

    /**
     * Get the value of idCategoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of idCategoria
     *
     * @return  self
     */
    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get the value of idEje
     */
    public function getIdEje()
    {
        return $this->idEje;
    }

    /**
     * Set the value of idEje
     *
     * @return  self
     */
    public function setIdEje($idEje)
    {
        $this->idEje = $idEje;

        return $this;
    }

    /**
     * Get the value of descCategoria
     */
    public function getDescCategoria()
    {
        return $this->descCategoria;
    }

    /**
     * Set the value of descCategoria
     *
     * @return  self
     */
    public function setDescCategoria($descCategoria)
    {
        $this->descCategoria = $descCategoria;

        return $this;
    }

    /**
     * Get the value of anio
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set the value of anio
     *
     * @return  self
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get the value of nivelCategoria
     */
    public function getNivelCategoria()
    {
        return $this->nivelCategoria;
    }

    /**
     * Set the value of nivelCategoria
     *
     * @return  self
     */
    public function setNivelCategoria($nivelCategoria)
    {
        $this->nivelCategoria = $nivelCategoria;

        return $this;
    }

    /**
     * Get the value of idCategoriaPadre
     */
    public function getIdCategoriaPadre()
    {
        return $this->idCategoriaPadre;
    }

    /**
     * Set the value of idCategoriaPadre
     *
     * @return  self
     */
    public function setIdCategoriaPadre($idCategoriaPadre)
    {
        $this->idCategoriaPadre = $idCategoriaPadre;

        return $this;
    }

    /**
     * Get the value of idExposicion
     */
    public function getIdExposicion()
    {
        return $this->idExposicion;
    }

    /**
     * Set the value of idExposicion
     *
     * @return  self
     */
    public function setIdExposicion($idExposicion)
    {
        $this->idExposicion = $idExposicion;

        return $this;
    }

    /**
     * Get the value of orden
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set the value of orden
     *
     * @return  self
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get the value of Periodo
     */
    public function getPeriodo()
    {
        return $this->Periodo;
    }

    /**
     * Set the value of Periodo
     *
     * @return  self
     */
    public function setPeriodo($Periodo)
    {
        $this->Periodo = $Periodo;

        return $this;
    }

    /**
     * Get the value of Visible
     */
    public function getVisible()
    {
        return $this->Visible;
    }

    /**
     * Set the value of Visible
     *
     * @return  self
     */
    public function setVisible($Visible)
    {
        $this->Visible = $Visible;

        return $this;
    }

    /**
     * Get the value of ACME
     */
    public function getACME()
    {
        return $this->ACME;
    }

    /**
     * Set the value of ACME
     *
     * @return  self
     */
    public function setACME($ACME)
    {
        $this->ACME = $ACME;

        return $this;
    }
}
