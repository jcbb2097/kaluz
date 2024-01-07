<?php

include_once("Catalogo.class.php");

class RespuestaPregunta {

    private $Id_Respuesta_Pregunta;
    private $Id_Pregunta;
    private $Tipo_Respuesta;
    private $Detalle_Select;
    private $Detalle_Inicial;
    private $Detalle_Final;
    private $Detalle_Radio;
    private $Estatus;
    
    public function getRespuestaPregunta() {
        $catalogo = new Catalogo();
        $consultaPregunta = "select * FROM k_respuesta_pregunta WHERE idRespuestaPregunta = ".$this->Id_Respuesta_Pregunta;
        $resultPregunta = $catalogo->obtenerLista($consultaPregunta);
        //echo "<br><br>$consultaPregunta<br><br>";
        while ($row = mysqli_fetch_array($resultPregunta)) {
            $this->Id_Respuesta_Pregunta = $row['idRespuestaPregunta'];
            $this->Id_Pregunta = $row['idPregunta'];
            $this->Tipo_Respuesta = $row['tipoRespuesta'];
            $this->Detalle_Select = $row['detalleSelect'];
            $this->Detalle_Inicial = $row['detalleInicial'];
            $this->Detalle_Final = $row['detalleFinal'];
            $this->Detalle_Radio = $row['detalleRadio'];
            $this->Estatus = $row['estatus'];
            return true;
        }
        return false;
    }

    public function nuevaRespuestaPregunta() {
        $catalogo = new Catalogo();
        $insert =  "insert into 
                    k_respuesta_pregunta(idPregunta,tipoRespuesta,detalleSelect,detalleInicial,detalleFinal,detalleRadio,estatus)
                    VALUES( $this->Id_Pregunta,
                            $this->Tipo_Respuesta,
                            '$this->Detalle_Select',
                            $this->Detalle_Inicial,
                            $this->Detalle_Final,
                            '$this->Detalle_Radio',
                            $this->Estatus);";
        $this->Id_Respuesta_Pregunta = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_Respuesta_Pregunta == 0 || $this->Id_Respuesta_Pregunta == null) {
            return false;
        }
        return true;
    }

    public function editarRespuestaPregunta() {
        $catalogo = new Catalogo();
        $update = " update k_respuesta_pregunta 
                    SET idPregunta = $this->Id_Pregunta,
                        tipoRespuesta = $this->Tipo_Respuesta,
                        detalleSelect = '$this->Detalle_Select',
                        detalleInicial = $this->Detalle_Inicial,
                        detalleFinal = $this->Detalle_Final,
                        detalleRadio = '$this->Detalle_Radio',
                        estatus = $this->Estatus
                    WHERE idRespuestaPregunta = ".$this->Id_Respuesta_Pregunta;
        $query = $catalogo->ejecutaConsultaActualizacion($update, 'k_respuesta_pregunta', 'idRespuestaPregunta ='.$this->Id_Respuesta_Pregunta);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarRespuestaPregunta() {
        $catalogo = new Catalogo();
        $delete = "delete FROM k_respuesta_pregunta  WHERE idRespuestaPregunta = ".$this->Id_Respuesta_Pregunta;
        $query = $catalogo->ejecutaConsultaActualizacion($delete, 'k_respuesta_pregunta', 'idRespuestaPregunta ='.$this->Id_Respuesta_Pregunta);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function PeriodoActual($año) {
        $id_periodo = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT p.Id_Periodo FROM c_periodo as p WHERE p.Periodo=$año";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $id_periodo = $row['Id_Periodo'];
        }
        return $id_periodo;
    }

    function getId_Respuesta_Pregunta() {
        return $this->Id_Respuesta_Pregunta;
    }

    function getId_Pregunta() {
        return $this->Id_Pregunta;
    }

    function getTipo_Respuesta() {
        return $this->Tipo_Respuesta;
    }

    function getDetalle_Select() {
        return $this->Detalle_Select;
    }

    function getDetalle_Inicial() {
        return $this->Detalle_Inicial;
    }

    function getDetalle_Final() {
        return $this->Detalle_Final;
    }

    function getDetalle_Radio() {
        return $this->Detalle_Radio;
    }

    function getEstatus() {
        return $this->Estatus;
    }

    function setId_Respuesta_Pregunta($Id_Respuesta_Pregunta) {
        $this->Id_Respuesta_Pregunta = $Id_Respuesta_Pregunta;
    }

    function setId_Pregunta($Id_Pregunta) {
        $this->Id_Pregunta = $Id_Pregunta;
    }

    function setTipo_Respuesta($Tipo_Respuesta) {
        $this->Tipo_Respuesta = $Tipo_Respuesta;
    }

    function setDetalle_Select($Detalle_Select) {
        $this->Detalle_Select = $Detalle_Select;
    }

    function setDetalle_Inicial($Detalle_Inicial) {
        $this->Detalle_Inicial = $Detalle_Inicial;
    }

    function setDetalle_Final($Detalle_Final) {
        $this->Detalle_Final = $Detalle_Final;
    }

    function setDetalle_Radio($Detalle_Radio) {
        $this->Detalle_Radio = $Detalle_Radio;
    }

    function setEstatus($Estatus) {
        $this->Estatus = $Estatus;
    }

}
