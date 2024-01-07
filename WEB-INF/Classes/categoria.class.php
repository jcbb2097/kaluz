<?php

include_once("Catalogo.class.php");

class categorias {

    private $id_tipo;
    private $tipo;
    private $activo;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;

    public function getcategoria() {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM c_tipo_documento WHERE c_tipo_documento.id_tipo = " . $this->id_tipo;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            
            $this->tipo = $row['tipo'];
            $this->activo = $row['activo'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            return true;
        }
        return false;
    }

    public function nuevaCategoria() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_tipo_documento(tipo,activo,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
            VALUES( '" . $this->tipo . "'," . $this->activo . ",'$this->usuarioCreacion',now(),'$this->usuarioUltimaModificacion',now(),'$this->pantalla');";
        $this->id_tipo = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>"; 
        if ($this->id_tipo == 0 || $this->id_tipo == null) {
            return false;
        }
        return true;
    }

    public function editarCategoria() {
  
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_tipo_documento SET tipo='" . $this->tipo . "',activo=" . $this->activo . ",usuarioUltimaModificacion = '" . $this->usuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE c_tipo_documento.id_tipo = $this->id_tipo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_tipo_documento', 'id_tipo = ' . $this->id_tipo);
          //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarCategoria() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_tipo_documento WHERE id_tipo = $this->id_tipo;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_tipo_documento", "id_tipo = " . $this->id_tipo);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function getId_tipo() {
        return $this->id_tipo;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getActivo() {
        return $this->activo;
    }

    function getUsuarioCreacion() {
        return $this->usuarioCreacion;
    }

    function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    function getUsuarioUltimaModificacion() {
        return $this->usuarioUltimaModificacion;
    }

    function getFechaUltimaModificacion() {
        return $this->fechaUltimaModificacion;
    }

    function getPantalla() {
        return $this->pantalla;
    }

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function setUsuarioCreacion($usuarioCreacion) {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }

    function setUsuarioUltimaModificacion($usuarioUltimaModificacion) {
        $this->usuarioUltimaModificacion = $usuarioUltimaModificacion;
    }

    function setFechaUltimaModificacion($fechaUltimaModificacion) {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;
    }

    function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
    }

}
