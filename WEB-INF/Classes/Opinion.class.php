<?php

include_once("Catalogo.class.php");

class Opinion
{

    private $IdOpinion;
    private $Descripcion;
    private $Fecha;
    private $IdTipoOpinion;
    private $IdOrigenOpinion;
    private $IdEstatusOpinion;
    private $FechaTurnadoaEje;
    private $FechaTurnadoaAct;
    private $FechaAtencion;
    private $FechaUltimaModificacion;
    private $UsuarioUltimaModificacion;
    private $IdEjeTurnado;
    private $IdActTurnada;
    private $IdPersonaAtendio;
    private $IdUsuarioAtendio;
    private $TextoAtencion;
    private $Comentario;
    private $Incidencia_al_atender;
    private $Respuesta_opinion_atendida;


    public function Responder_opinion()
    {
        $catalogo = new Catalogo();
        $consulta = 'UPDATE c_opiniones o set o.FechaAtencion=NOW(),o.IdPersonaAtendio='.$this->IdPersonaAtendio.',o.IdUsuarioAtendio='.$this->IdUsuarioAtendio.',o.TextoAtencion="'.$this->TextoAtencion.'",o.Incidencia_al_atender='.$this->Incidencia_al_atender.',IdEstatusOpinion=4 WHERE o.IdOpinion='.$this->IdOpinion;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_opiniones', 'IdOpinion = ' . $this->IdOpinion);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Reasignar_opinion()
    {
        $catalogo = new Catalogo();
        $consulta = "";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_opiniones', 'IdOpinion = ' . $this->IdOpinion);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }


    /**
     * Get the value of IdOpinion
     */
    public function getIdOpinion()
    {
        return $this->IdOpinion;
    }

    /**
     * Set the value of IdOpinion
     *
     * @return  self
     */
    public function setIdOpinion($IdOpinion)
    {
        $this->IdOpinion = $IdOpinion;

        return $this;
    }

    /**
     * Get the value of Descripcion
     */
    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    /**
     * Set the value of Descripcion
     *
     * @return  self
     */
    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    /**
     * Get the value of Fecha
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * Set the value of Fecha
     *
     * @return  self
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    /**
     * Get the value of IdTipoOpinion
     */
    public function getIdTipoOpinion()
    {
        return $this->IdTipoOpinion;
    }

    /**
     * Set the value of IdTipoOpinion
     *
     * @return  self
     */
    public function setIdTipoOpinion($IdTipoOpinion)
    {
        $this->IdTipoOpinion = $IdTipoOpinion;

        return $this;
    }

    /**
     * Get the value of IdOrigenOpinion
     */
    public function getIdOrigenOpinion()
    {
        return $this->IdOrigenOpinion;
    }

    /**
     * Set the value of IdOrigenOpinion
     *
     * @return  self
     */
    public function setIdOrigenOpinion($IdOrigenOpinion)
    {
        $this->IdOrigenOpinion = $IdOrigenOpinion;

        return $this;
    }

    /**
     * Get the value of IdEstatusOpinion
     */
    public function getIdEstatusOpinion()
    {
        return $this->IdEstatusOpinion;
    }

    /**
     * Set the value of IdEstatusOpinion
     *
     * @return  self
     */
    public function setIdEstatusOpinion($IdEstatusOpinion)
    {
        $this->IdEstatusOpinion = $IdEstatusOpinion;

        return $this;
    }

    /**
     * Get the value of FechaTurnadoaEje
     */
    public function getFechaTurnadoaEje()
    {
        return $this->FechaTurnadoaEje;
    }

    /**
     * Set the value of FechaTurnadoaEje
     *
     * @return  self
     */
    public function setFechaTurnadoaEje($FechaTurnadoaEje)
    {
        $this->FechaTurnadoaEje = $FechaTurnadoaEje;

        return $this;
    }

    /**
     * Get the value of FechaTurnadoaAct
     */
    public function getFechaTurnadoaAct()
    {
        return $this->FechaTurnadoaAct;
    }

    /**
     * Set the value of FechaTurnadoaAct
     *
     * @return  self
     */
    public function setFechaTurnadoaAct($FechaTurnadoaAct)
    {
        $this->FechaTurnadoaAct = $FechaTurnadoaAct;

        return $this;
    }

    /**
     * Get the value of FechaAtencion
     */
    public function getFechaAtencion()
    {
        return $this->FechaAtencion;
    }

    /**
     * Set the value of FechaAtencion
     *
     * @return  self
     */
    public function setFechaAtencion($FechaAtencion)
    {
        $this->FechaAtencion = $FechaAtencion;

        return $this;
    }

    /**
     * Get the value of FechaUltimaModificacion
     */
    public function getFechaUltimaModificacion()
    {
        return $this->FechaUltimaModificacion;
    }

    /**
     * Set the value of FechaUltimaModificacion
     *
     * @return  self
     */
    public function setFechaUltimaModificacion($FechaUltimaModificacion)
    {
        $this->FechaUltimaModificacion = $FechaUltimaModificacion;

        return $this;
    }

    /**
     * Get the value of UsuarioUltimaModificacion
     */
    public function getUsuarioUltimaModificacion()
    {
        return $this->UsuarioUltimaModificacion;
    }

    /**
     * Set the value of UsuarioUltimaModificacion
     *
     * @return  self
     */
    public function setUsuarioUltimaModificacion($UsuarioUltimaModificacion)
    {
        $this->UsuarioUltimaModificacion = $UsuarioUltimaModificacion;

        return $this;
    }

    /**
     * Get the value of IdEjeTurnado
     */
    public function getIdEjeTurnado()
    {
        return $this->IdEjeTurnado;
    }

    /**
     * Set the value of IdEjeTurnado
     *
     * @return  self
     */
    public function setIdEjeTurnado($IdEjeTurnado)
    {
        $this->IdEjeTurnado = $IdEjeTurnado;

        return $this;
    }

    /**
     * Get the value of IdActTurnada
     */
    public function getIdActTurnada()
    {
        return $this->IdActTurnada;
    }

    /**
     * Set the value of IdActTurnada
     *
     * @return  self
     */
    public function setIdActTurnada($IdActTurnada)
    {
        $this->IdActTurnada = $IdActTurnada;

        return $this;
    }

    /**
     * Get the value of IdPersonaAtendio
     */
    public function getIdPersonaAtendio()
    {
        return $this->IdPersonaAtendio;
    }

    /**
     * Set the value of IdPersonaAtendio
     *
     * @return  self
     */
    public function setIdPersonaAtendio($IdPersonaAtendio)
    {
        $this->IdPersonaAtendio = $IdPersonaAtendio;

        return $this;
    }

    /**
     * Get the value of IdUsuarioAtendio
     */
    public function getIdUsuarioAtendio()
    {
        return $this->IdUsuarioAtendio;
    }

    /**
     * Set the value of IdUsuarioAtendio
     *
     * @return  self
     */
    public function setIdUsuarioAtendio($IdUsuarioAtendio)
    {
        $this->IdUsuarioAtendio = $IdUsuarioAtendio;

        return $this;
    }

    /**
     * Get the value of TextoAtencion
     */
    public function getTextoAtencion()
    {
        return $this->TextoAtencion;
    }

    /**
     * Set the value of TextoAtencion
     *
     * @return  self
     */
    public function setTextoAtencion($TextoAtencion)
    {
        $this->TextoAtencion = $TextoAtencion;

        return $this;
    }

    /**
     * Get the value of Comentario
     */
    public function getComentario()
    {
        return $this->Comentario;
    }

    /**
     * Set the value of Comentario
     *
     * @return  self
     */
    public function setComentario($Comentario)
    {
        $this->Comentario = $Comentario;

        return $this;
    }

    /**
     * Get the value of Incidencia_al_atender
     */
    public function getIncidencia_al_atender()
    {
        return $this->Incidencia_al_atender;
    }

    /**
     * Set the value of Incidencia_al_atender
     *
     * @return  self
     */
    public function setIncidencia_al_atender($Incidencia_al_atender)
    {
        $this->Incidencia_al_atender = $Incidencia_al_atender;

        return $this;
    }

    /**
     * Get the value of Respuesta_opinion_atendida
     */
    public function getRespuesta_opinion_atendida()
    {
        return $this->Respuesta_opinion_atendida;
    }

    /**
     * Set the value of Respuesta_opinion_atendida
     *
     * @return  self
     */
    public function setRespuesta_opinion_atendida($Respuesta_opinion_atendida)
    {
        $this->Respuesta_opinion_atendida = $Respuesta_opinion_atendida;

        return $this;
    }
}
