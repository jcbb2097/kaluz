<?php

include_once("Catalogo.class.php");

class asunto_area
{
    private $idConversacion;
    private $idArea;
    private $orden;
    private $estatus;
    private $respuestas;
    private $respuestas2;
    private $respuestasInv;
    private $fechaAlta;
    private $fechaSalida;

    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }
    public function nuevoAsuntoArea()
    {
        $insert = "INSERT INTO k_conversacionArea(idConversacion,idArea,orden,estatus,respuestas,fechaAlta)
            VALUES( " . $this->idConversacion . "," . $this->idArea . "," . $this->orden . "," . $this->estatus . "," . $this->respuestas . ",now());";
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

    /**
     * Get the value of respuestas
     */
    public function getRespuestas()
    {
        return $this->respuestas;
    }

    /**
     * Set the value of respuestas
     *
     * @return  self
     */
    public function setRespuestas($respuestas)
    {
        $this->respuestas = $respuestas;

        return $this;
    }

    /**
     * Get the value of respuestas2
     */
    public function getRespuestas2()
    {
        return $this->respuestas2;
    }

    /**
     * Set the value of respuestas2
     *
     * @return  self
     */
    public function setRespuestas2($respuestas2)
    {
        $this->respuestas2 = $respuestas2;

        return $this;
    }

    /**
     * Get the value of respuestasInv
     */
    public function getRespuestasInv()
    {
        return $this->respuestasInv;
    }

    /**
     * Set the value of respuestasInv
     *
     * @return  self
     */
    public function setRespuestasInv($respuestasInv)
    {
        $this->respuestasInv = $respuestasInv;

        return $this;
    }

    /**
     * Get the value of fechaAlta
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set the value of fechaAlta
     *
     * @return  self
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get the value of fechaSalida
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set the value of fechaSalida
     *
     * @return  self
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }
}
