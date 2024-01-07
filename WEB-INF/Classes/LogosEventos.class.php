<?php

include_once("Catalogo.class.php");

class Logro_evento
{
    private $IdLogrosEventos;
    private $IdResumenEje;
    private $idEvento;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;

    public function getLogro_Evento()
    {
        $catalogo = new Catalogo();
        $consulta_logro = "SELECT * FROM c_logrosEventos as le WHERE le.IdLogrosEventos= " . $this->id_acuerdo_escrito;
        $result_logro = $catalogo->obtenerLista($consulta_logro);
        while ($row = mysqli_fetch_array($result_logro)) {
            $this->IdResumenEje = $row['IdResumenEje'];
            $this->idEvento = $row['idEvento'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            return true;
        }
        return false;
    }
    public function nuevoLogro_Evento() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_logrosEventos(IdResumenEje,idEvento,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
            VALUES( " . $this->IdResumenEje . "," . $this->idEvento . ",'$this->usuarioCreacion',now(),'$this->usuarioUltimaModificacion',now(),'$this->pantalla');";
        $this->IdResumenMuseo = $catalogo->insertarRegistro($insert);
         //echo "<br><br>$insert<br><br>"; 
        if ($this->IdResumenMuseo == 0 || $this->IdResumenMuseo == null) {
            return false;
        }
        return true;
    }
    public function editarLogro_Evento() {
    
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_logrosEventos SET  IdResumenEje=" . $this->IdResumenEje . ",idEvento=" . $this->idEvento . ",usuarioUltimaModificacion = '" . $this->usuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE c_logrosEventos.IdLogrosEventos = $this->IdLogrosEventos;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_logrosEventos', 'IdLogrosEventos = ' . $this->IdLogrosEventos);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminarLogro_Evento() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_logrosEventos WHERE IdLogrosEventos = $this->IdLogrosEventos;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_logrosEventos", "IdLogrosEventos = " . $this->IdLogrosEventos);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }



    function getIdLogrosEventos()
    {
        return $this->IdLogrosEventos;
    }

    function getIdResumenEje()
    {
        return $this->IdResumenEje;
    }

    function getIdEvento()
    {
        return $this->idEvento;
    }

    function getUsuarioCreacion()
    {
        return $this->usuarioCreacion;
    }

    function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    function getUsuarioUltimaModificacion()
    {
        return $this->usuarioUltimaModificacion;
    }

    function getFechaUltimaModificacion()
    {
        return $this->fechaUltimaModificacion;
    }

    function getPantalla()
    {
        return $this->pantalla;
    }

    function setIdLogrosEventos($IdLogrosEventos)
    {
        $this->IdLogrosEventos = $IdLogrosEventos;
    }

    function setIdResumenEje($IdResumenEje)
    {
        $this->IdResumenEje = $IdResumenEje;
    }

    function setIdEvento($idEvento)
    {
        $this->idEvento = $idEvento;
    }

    function setUsuarioCreacion($usuarioCreacion)
    {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setUsuarioUltimaModificacion($usuarioUltimaModificacion)
    {
        $this->usuarioUltimaModificacion = $usuarioUltimaModificacion;
    }

    function setFechaUltimaModificacion($fechaUltimaModificacion)
    {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;
    }

    function setPantalla($pantalla)
    {
        $this->pantalla = $pantalla;
    }
}
