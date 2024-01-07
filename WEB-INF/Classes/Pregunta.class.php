<?php

include_once("Catalogo.class.php");

class Pregunta {

    private $Id_Pregunta;
    private $Id_Cuestionario;
    private $Tipo_Respuesta;
    private $Descripcion;
    private $Obligatorio;
    
    public function getPregunta() {
        $catalogo = new Catalogo();
        $consultaPregunta = "select * FROM k_preguntas WHERE idPregunta = ".$this->Id_Pregunta;
        $resultPregunta = $catalogo->obtenerLista($consultaPregunta);
        while ($row = mysqli_fetch_array($resultPregunta)) {
            $this->Id_Pregunta = $row['idPregunta'];
            $this->Id_Cuestionario = $row['idCuestionario'];
            $this->Tipo_Respuesta = $row['tipoRespuesta'];
            $this->Descripcion = $row['descripcion'];
            $this->Obligatorio = $row['obligatorio'];
            return true;
        }
        return false;
    }

    public function nuevaPregunta() {
        $catalogo = new Catalogo();
        $insert = "insert into k_preguntas(idCuestionario,tipoRespuesta,descripcion,obligatorio)
            VALUES( $this->Id_Cuestionario,
                    $this->Tipo_Respuesta,
                    '$this->Descripcion',
                    $this->Obligatorio);";
        $this->Id_Pregunta = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_Pregunta == 0 || $this->Id_Pregunta == null) {
            return false;
        }
        return true;
    }

    public function editarPregunta() {
        $catalogo = new Catalogo();
        $update = " update k_preguntas 
                    SET idCuestionario = $this->Id_Cuestionario,
                        tipoRespuesta = $this->Tipo_Respuesta,
                        descripcion = '$this->Descripcion',
                        obligatorio = $this->Obligatorio
                    WHERE idPregunta = ".$this->Id_Pregunta;
        $query = $catalogo->ejecutaConsultaActualizacion($update, 'k_preguntas', 'idPregunta ='.$this->Id_Pregunta);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarPregunta() {
        $catalogo = new Catalogo();
        $delete = "delete FROM k_preguntas WHERE idPregunta = ".$this->Id_Pregunta;
        $query = $catalogo->ejecutaConsultaActualizacion($delete, 'k_preguntas', 'idPregunta ='.$this->Id_Pregunta);
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

    function getId_Pregunta() {
        return $this->Id_Pregunta;
    }

    function getId_Cuestionario() {
        return $this->Id_Cuestionario;
    }

    function getTipo_Respuesta() {
        return $this->Tipo_Respuesta;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function getObligatorio() {
        return $this->Obligatorio;
    }

    function setId_Pregunta($Id_Pregunta) {
        $this->Id_Pregunta = $Id_Pregunta;
    }

    function setId_Cuestionario($Id_Cuestionario) {
        $this->Id_Cuestionario = $Id_Cuestionario;
    }

    function setTipo_Respuesta($Tipo_Respuesta) {
        $this->Tipo_Respuesta = $Tipo_Respuesta;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    function setObligatorio($Obligatorio) {
        $this->Obligatorio = $Obligatorio;
    }

}
