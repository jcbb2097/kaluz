<?php

include_once("Catalogo.class.php");

class CuestionarioAplicado {

    private $Id_Cuestionario_Aplicado;
    private $Id_Cuestionario;
    private $Modo_Aplicacion;
    private $Fecha_Aplicacion;
    private $Nombre;
    private $Correo;
    private $Procedencia;
    private $Procedencia1;
    private $Procedencia2;
    
    public function getCuestionarioAplicado() {
        $catalogo = new Catalogo();
        $resultAplicado = $catalogo->obtenerLista("select * FROM k_cuestionario_aplicado WHERE idCuestionarioAplicado = ".$this->Id_Cuestionario_Aplicado);
        while ($row = mysqli_fetch_array($resultAplicado)) {
            $this->Id_Cuestionario_Aplicado = $row['idCuestionarioAplicado'];
            $this->Id_Cuestionario = $row['idCuestionario'];
            $this->Modo_Aplicacion = $row['modoAplicacion'];
            $this->Fecha_Aplicacion = $row['fechaAplicacion'];
            $this->Nombre = $row['nombre'];
            $this->Correo = $row['correo'];
            $this->Procedencia = $row['procedencia'];
            $this->Procedencia1 = $row['procedencia1'];
            $this->Procedencia2 = $row['procedencia2'];
            return true;
        }
        return false;
    }

    public function nuevoCuestionarioAplicado() {
        $catalogo = new Catalogo();
        $insert = "insert into k_cuestionario_aplicado(idCuestionario,modoAplicacion,fechaAplicacion,nombre,correo,procedencia,procedencia1,procedencia2)
            VALUES( $this->Id_Cuestionario,
                    '$this->Modo_Aplicacion',
                    '$this->Fecha_Aplicacion',
                    '$this->Nombre',
                    '$this->Correo',
                    '$this->Procedencia',
                    $this->Procedencia1,
                    $this->Procedencia2);";
        $this->Id_Cuestionario_Aplicado = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_Cuestionario_Aplicado == 0 || $this->Id_Cuestionario_Aplicado == null) {
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

    public function eliminarCuestionarioAplicado() {
        $catalogo = new Catalogo();
        $delete = "delete FROM k_cuestionario_aplicado idCuestionarioAplicado = ".$this->Id_Cuestionario_Aplicado;
        $query = $catalogo->ejecutaConsultaActualizacion($delete, 'k_cuestionario_aplicado', 'idCuestionarioAplicado ='.$this->Id_Cuestionario_Aplicado);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_Cuestionario_Aplicado() {
        return $this->Id_Cuestionario_Aplicado;
    }

    function getId_Cuestionario() {
        return $this->Id_Cuestionario;
    }

    function getModo_Aplicacion() {
        return $this->Modo_Aplicacion;
    }

    function getFecha_Aplicacion() {
        return $this->Fecha_Aplicacion;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getCorreo() {
        return $this->Correo;
    }

    function getProcedencia() {
        return $this->Procedencia;
    }

    function getProcedencia1() {
        return $this->Procedencia1;
    }

    function getProcedencia2() {
        return $this->Procedencia2;
    }

    function setId_Cuestionario_Aplicado($Id_Cuestionario_Aplicado) {
        $this->Id_Cuestionario_Aplicado = $Id_Cuestionario_Aplicado;
    }

    function setId_Cuestionario($Id_Cuestionario) {
        $this->Id_Cuestionario = $Id_Cuestionario;
    }

    function setModo_Aplicacion($Modo_Aplicacion) {
        $this->Modo_Aplicacion = $Modo_Aplicacion;
    }

    function setFecha_Aplicacion($Fecha_Aplicacion) {
        $this->Fecha_Aplicacion = $Fecha_Aplicacion;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    function setProcedencia($Procedencia) {
        $this->Procedencia = $Procedencia;
    }

    function setProcedencia1($Procedencia1) {
        $this->Procedencia1 = $Procedencia1;
    }

    function setProcedencia2($Procedencia2) {
        $this->Procedencia2 = $Procedencia2;
    }

}
