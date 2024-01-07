<?php

include_once("Catalogo.class.php");

class asunto_respuesta
{
    private $idRespuesta;
    private $idConversacion;
    private $respuesta;
    private $idUsuario;
    private $idArea;
    private $fecha;
    private $orden;

    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }
    
    public function nuevoAsuntoRespuesta()
    {
        $insert = "INSERT INTO k_conversacionRespuesta(idConversacion,respuesta,idUsuario,idArea,fecha,orden)
            VALUES( " . $this->idConversacion . ",'" . $this->respuesta . "'," . $this->idUsuario . "," . $this->idArea . ",now(),".$this->orden.");";
        $this->idConversacion = $this->catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->idConversacion == 0 || $this->idConversacion == null) {
            return false;
        }
        return true;
    }

    /**
     * Get the value of idRespuesta
     */
    public function getIdRespuesta()
    {
        return $this->idRespuesta;
    }

    /**
     * Set the value of idRespuesta
     *
     * @return  self
     */
    public function setIdRespuesta($idRespuesta)
    {
        $this->idRespuesta = $idRespuesta;

        return $this;
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
     * Get the value of respuesta
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set the value of respuesta
     *
     * @return  self
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of idArea
     */
    public function getIdArea()
    {
        return $this->idArea;
    }

    /**
     * Set the value of idArea
     *
     * @return  self
     */
    public function setIdArea($idArea)
    {
        $this->idArea = $idArea;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

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
}
