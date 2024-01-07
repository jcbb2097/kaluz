
<?php

include_once("Catalogo.class.php");

class asunto_actividad
{
    private $idConversacion;
    private $idEje;
    private $idGlobal;
    private $idGeneral;
    private $idParticular;
    private $idSub;
    private $idEE;
    private $idExpo;
    private $idCategoria;
    private $idChecklist;


    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }
    public function nuevoAsuntoActividad()
    {
        $insert = "INSERT INTO k_conversacionActividad(idConversacion,idEje,idGlobal,idGeneral,idEE,idExpo,idCategoria,idChecklist)
            VALUES( " . $this->idConversacion . "," . $this->idEje . "," . $this->idGlobal . "," . $this->idGeneral . "," . $this->idEE . "," . $this->idExpo . "," . $this->idCategoria . "," . $this->idChecklist . ");";
        $this->idConversacion = $this->catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>"; 
        if ($this->idConversacion == 0 || $this->idConversacion == null) {
            return false;
        }
        return true;
    }
    /**
     * Get the value of idConversacion
     */
    public function getIdConversacion()
    {
        return $this->idConversacion;
    }

    /**
     * Set the value of idConversacion
     *
     * @return  self
     */
    public function setIdConversacion($idConversacion)
    {
        $this->idConversacion = $idConversacion;

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
     * Get the value of idGlobal
     */
    public function getIdGlobal()
    {
        return $this->idGlobal;
    }

    /**
     * Set the value of idGlobal
     *
     * @return  self
     */
    public function setIdGlobal($idGlobal)
    {
        $this->idGlobal = $idGlobal;

        return $this;
    }

    /**
     * Get the value of idGeneral
     */
    public function getIdGeneral()
    {
        return $this->idGeneral;
    }

    /**
     * Set the value of idGeneral
     *
     * @return  self
     */
    public function setIdGeneral($idGeneral)
    {
        $this->idGeneral = $idGeneral;

        return $this;
    }

    /**
     * Get the value of idParticular
     */
    public function getIdParticular()
    {
        return $this->idParticular;
    }

    /**
     * Set the value of idParticular
     *
     * @return  self
     */
    public function setIdParticular($idParticular)
    {
        $this->idParticular = $idParticular;

        return $this;
    }

    /**
     * Get the value of idSub
     */
    public function getIdSub()
    {
        return $this->idSub;
    }

    /**
     * Set the value of idSub
     *
     * @return  self
     */
    public function setIdSub($idSub)
    {
        $this->idSub = $idSub;

        return $this;
    }

    /**
     * Get the value of idEE
     */
    public function getIdEE()
    {
        return $this->idEE;
    }

    /**
     * Set the value of idEE
     *
     * @return  self
     */
    public function setIdEE($idEE)
    {
        $this->idEE = $idEE;

        return $this;
    }

    /**
     * Get the value of idExpo
     */
    public function getIdExpo()
    {
        return $this->idExpo;
    }

    /**
     * Set the value of idExpo
     *
     * @return  self
     */
    public function setIdExpo($idExpo)
    {
        $this->idExpo = $idExpo;

        return $this;
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
     * Get the value of idChecklist
     */
    public function getIdChecklist()
    {
        return $this->idChecklist;
    }

    /**
     * Set the value of idChecklist
     *
     * @return  self
     */
    public function setIdChecklist($idChecklist)
    {
        $this->idChecklist = $idChecklist;

        return $this;
    }
}
