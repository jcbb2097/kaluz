<?php

include_once("Catalogo.class.php");

class Parametros {

    private $idParametro;
    private $descripcion;
    private $valor;
    private $activo;
    private $usuarioCreacion;
    private $usuarioModificacion;
    private $pantalla;
    private $empresa;

    public function getRegistroById($id) {
        $consulta = ("SELECT * FROM c_parametro WHERE IdParametro='" . $id . "'");
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        } $query = $catalogo->obtenerLista($consulta);
        
        echo "<br><br>".$consulta."<br><br>";
        
        while ($rs = mysql_fetch_array($query)) {
            $this->idParametro = $rs['IdParametro'];
            $this->descripcion = $rs['Descripcion'];
            $this->valor = $rs['Valor'];
            $this->activo = $rs['Activo'];
            return true;
        }
        return false;
    }

    public function newRegistro() {
        $consulta = ("INSERT INTO c_parametro(IdParametro,Descripcion,Valor,Activo,UsuarioCreacion,FechaCreacion,UsuarioUltimaModificacion,FechaUltimaModificacion,Pantalla)
            VALUES(0,'" . $this->descripcion . "','" . $this->valor . "'," . $this->activo . ",'" . $this->usuarioCreacion . "',now(),'" . $this->usuarioModificacion . "',now(),'" . $this->pantalla . "')");
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        } $query = $catalogo->obtenerLista($consulta);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function editRegistro() {
        $tabla = "c_parametro";
        $where = "IdParametro='" . $this->idParametro . "'";
        $consulta = ("UPDATE $tabla SET Descripcion = '" . $this->descripcion . "',Valor='" . $this->valor . "', 
			Activo = " . $this->activo . ",UsuarioUltimaModificacion = '" . $this->usuarioModificacion . "',FechaUltimaModificacion = now(),Pantalla = '" . $this->pantalla . "' 
			WHERE $where;");
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    function deleteRegistro() {
        $tabla = "c_parametro";
        $where = "IdParametro='" . $this->idParametro . "'";
        $consulta = ("DELETE FROM $tabla WHERE $where;");
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, $tabla, $where);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function getIdParametro() {
        return $this->idParametro;
    }

    public function setIdParametro($idParametro) {
        $this->idParametro = $idParametro;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    public function getUsuarioCreacion() {
        return $this->usuarioCreacion;
    }

    public function setUsuarioCreacion($usuarioCreacion) {
        $this->usuarioCreacion = $usuarioCreacion;
    }

    public function getUsuarioModificacion() {
        return $this->usuarioModificacion;
    }

    public function setUsuarioModificacion($usuarioModificacion) {
        $this->usuarioModificacion = $usuarioModificacion;
    }

    public function getPantalla() {
        return $this->pantalla;
    }

    public function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

}

?>
