<?php

include_once("Catalogo.class.php");

class RespuestaAplicado {

    private $Id_Respuesta_Aplicado;
    private $Id_Cuestionario_Aplicado;
    private $Id_Pregunta;
    private $Tipo_Respuesta;
    private $Detalle1; //Detalle para repuesta de select o radio Tipo INT
    private $Detalle2; //Detalle para repuesta abierta Tipo VArCHAR
    private $Detalle3; //Detalle para id de opcion de calificacion y bueno y malo Tipo INT 
    private $Detalle4; //Detalle para repuesta valor de calificacion y bueno y malo Tipo INT 
    
    public function getRespuestaAplicado() {
        $catalogo = new Catalogo();
        $resultAplicado = $catalogo->obtenerLista("select * FROM k_respuesta_aplicado WHERE idRespuestaAplicado = ".$this->Id_Respuesta_Aplicado);
        while ($row = mysqli_fetch_array($resultAplicado)) {
            $this->Id_Respuesta_Aplicado = $row['idRespuestaAplicado'];
            $this->Id_Cuestionario_Aplicado = $row['idCuestionarioAplicado'];
            $this->Id_Pregunta = $row['idPregunta'];
            $this->Tipo_Respuesta = $row['tipoRespuesta'];
            $this->Detalle1 = $row['detalle1'];
            $this->Detalle2 = $row['detalle2'];
            $this->Detalle3 = $row['detalle3'];
            $this->Detalle4 = $row['detalle4'];
            return true;
        }
        return false;
    }

    public function nuevoRespuestaAplicado() {
        $catalogo = new Catalogo();
        $insert = "insert into k_respuesta_aplicado(idCuestionarioAplicado,idPregunta,tipoRespuesta,detalle1,detalle2,detalle3,detalle4)
            VALUES( $this->Id_Cuestionario_Aplicado,
                    $this->Id_Pregunta,
                    $this->Tipo_Respuesta,
                    $this->Detalle1,
                    '$this->Detalle2',
                    $this->Detalle3,
                    $this->Detalle4);";
        $this->Id_Respuesta_Aplicado = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_Respuesta_Aplicado == 0 || $this->Id_Respuesta_Aplicado == null) {
            return false;
        }
        return true;
    }

    public function editarCuestionarioAplicado() {
        $catalogo = new Catalogo();
        $update = " update k_cuestionario_aplicado
                    SET idCuestionario = $this->Id_Cuestionario,
                        modoAplicacion = $this->Modo_Aplicacion,
                        fechaAplicacion = $this->Fecha_Aplicacion
                    WHERE idCuestionarioAplicado = ".$this->Id_Cuestionario_Aplicado;
        $query = $catalogo->ejecutaConsultaActualizacion($update, 'k_cuestionario_aplicado', 'idCuestionarioAplicado ='.$this->Id_Cuestionario_Aplicado);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarPregunta() {
        $catalogo = new Catalogo();
        $delete = "delete FROM k_cuestionario_aplicado idCuestionarioAplicado = ".$this->Id_Cuestionario_Aplicado;
        $query = $catalogo->ejecutaConsultaActualizacion($delete, 'k_cuestionario_aplicado', 'idCuestionarioAplicado ='.$this->Id_Cuestionario_Aplicado);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_Respuesta_Aplicado() {
        return $this->Id_Respuesta_Aplicado;
    }

    function getId_Cuestionario_Aplicado() {
        return $this->Id_Cuestionario_Aplicado;
    }

    function getId_Pregunta() {
        return $this->Id_Pregunta;
    }

    function getTipo_Respuesta() {
        return $this->Tipo_Respuesta;
    }

    function getDetalle1() {
        return $this->Detalle1;
    }

    function getDetalle2() {
        return $this->Detalle2;
    }

    function getDetalle3() {
        return $this->Detalle3;
    }

    function getDetalle4() {
        return $this->Detalle4;
    }

    function setId_Respuesta_Aplicado($Id_Respuesta_Aplicado) {
        $this->Id_Respuesta_Aplicado = $Id_Respuesta_Aplicado;
    }

    function setId_Cuestionario_Aplicado($Id_Cuestionario_Aplicado) {
        $this->Id_Cuestionario_Aplicado = $Id_Cuestionario_Aplicado;
    }

    function setId_Pregunta($Id_Pregunta) {
        $this->Id_Pregunta = $Id_Pregunta;
    }

    function setTipo_Respuesta($Tipo_Respuesta) {
        $this->Tipo_Respuesta = $Tipo_Respuesta;
    }

    function setDetalle1($Detalle1) {
        $this->Detalle1 = $Detalle1;
    }

    function setDetalle2($Detalle2) {
        $this->Detalle2 = $Detalle2;
    }

    function setDetalle3($Detalle3) {
        $this->Detalle3 = $Detalle3;
    }

    function setDetalle4($Detalle4) {
        $this->Detalle4 = $Detalle4;
    }

}
