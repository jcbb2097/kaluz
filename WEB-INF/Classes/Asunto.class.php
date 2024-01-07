
<?php

include_once("Catalogo.class.php");

class asunto
{
    private $idConversacion;
    private $asunto;
    private $idOrigen;
    private $idUsuarioOrigen;
    private $idDestino;
    private $idUsuarioDestino;
    private $fechaInicio;
    private $fechaFin;
    private $tipo;
    private $fechaRespuesta;
    private $estatus;

    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function nuevoAsunto()
    {
        $insert = "INSERT INTO k_conversacion(asunto,idOrigen,idUsuarioOrigen,idDestino,idUsuarioDestino,fechaInicio,tipo,fechaRespuesta,estatus)
            VALUES( '" . $this->asunto. "'," . $this->idOrigen .",".$this->idUsuarioOrigen.",".$this->idDestino.",".$this->idUsuarioDestino.",".$this->fechaInicio.",".$this->tipo.",".$this->fechaRespuesta.",".$this->estatus.");";
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
     * Get the value of asunto
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set the value of asunto
     *
     * @return  self
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get the value of idOrigen
     */
    public function getIdOrigen()
    {
        return $this->idOrigen;
    }

    /**
     * Set the value of idOrigen
     *
     * @return  self
     */
    public function setIdOrigen($idOrigen)
    {
        $this->idOrigen = $idOrigen;

        return $this;
    }

    /**
     * Get the value of idUsuarioOrigen
     */
    public function getIdUsuarioOrigen()
    {
        return $this->idUsuarioOrigen;
    }

    /**
     * Set the value of idUsuarioOrigen
     *
     * @return  self
     */
    public function setIdUsuarioOrigen($idUsuarioOrigen)
    {
        $this->idUsuarioOrigen = $idUsuarioOrigen;

        return $this;
    }

    /**
     * Get the value of idDestino
     */
    public function getIdDestino()
    {
        return $this->idDestino;
    }

    /**
     * Set the value of idDestino
     *
     * @return  self
     */
    public function setIdDestino($idDestino)
    {
        $this->idDestino = $idDestino;

        return $this;
    }

    /**
     * Get the value of idUsuarioDestino
     */
    public function getIdUsuarioDestino()
    {
        return $this->idUsuarioDestino;
    }

    /**
     * Set the value of idUsuarioDestino
     *
     * @return  self
     */
    public function setIdUsuarioDestino($idUsuarioDestino)
    {
        $this->idUsuarioDestino = $idUsuarioDestino;

        return $this;
    }

    /**
     * Get the value of fechaInicio
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set the value of fechaInicio
     *
     * @return  self
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get the value of fechaFin
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set the value of fechaFin
     *
     * @return  self
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of fechaRespuesta
     */
    public function getFechaRespuesta()
    {
        return $this->fechaRespuesta;
    }

    /**
     * Set the value of fechaRespuesta
     *
     * @return  self
     */
    public function setFechaRespuesta($fechaRespuesta)
    {
        $this->fechaRespuesta = $fechaRespuesta;

        return $this;
    }

    /**
     * Get the value of estatus
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set the value of estatus
     *
     * @return  self
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }
}
