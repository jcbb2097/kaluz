<?php

include_once("Catalogo.class.php");

class Juridico {

    private $Id_juridico;
    private $Id_periodo;
    private $Id_Exposicion;
    private $Id_Instrumento;
    private $Id_subtipo;
    private $Tipo_contrato;
    private $Objeto;
    private $Fee_pago;
    private $Pago_seguro;
    private $Comite_transporte;
    private $Fecha_pago_contraparte;
    private $Num_obra;
    private $Borrador;
    private $Avance;
    private $Estatus;
    private $Archivo;
    private $Contraparte_gestor;
    private $Usuario_creacion;
    private $Fecha_creacion;
    private $Usuario_ultima_modificacion;
    private $Fecha_ultima_modificacion;
    private $Pantalla;
    private $Id_eje;
    private $Contraparte;
    private $Atraves;
    private $Act;
    private $Area;

    public function getJuridico() {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM c_juridico WHERE c_juridico.Id_juridico = " . $this->Id_juridico;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->Id_periodo = $row['Id_periodo'];
            $this->Id_Exposicion = $row['Id_Exposicion'];
            $this->Id_Instrumento = $row['Id_Instrumento'];
            $this->Id_subtipo = $row['Id_subtipo'];
            $this->Tipo_contrato = $row['Tipo_contrato'];
            $this->Objeto = $row['Objeto'];
            $this->Fee_pago = $row['Fee_pago'];
            $this->Pago_seguro = $row['Pago_seguro'];
            $this->Comite_transporte = $row['Comite_transporte'];
            $this->Fecha_pago_contraparte = $row['Fecha_pago_contraparte'];
            $this->Num_obra = $row['Num_obra'];
            $this->Borrador = $row['Borrador'];
            $this->Avance = $row['Avance'];
            $this->Estatus = $row['Estatus'];
            $this->Archivo = $row['Archivo'];
            $this->Contraparte_gestor = $row['Contraparte_gestor'];
            $this->Id_eje=$row['Id_eje'];
            $this->Contraparte=$row['Contraparte'];
            $this->Atraves=$row['Atraves'];
            $this->Act=$row['IdActividad'];
            $this->Area=$row['IdArea'];
            return true;
        }
        return false;
    }

    public function Nuevo_juridico() {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_juridico(Id_periodo,Id_Exposicion,Id_Instrumento,Id_subtipo,Tipo_contrato,
        Objeto,Fee_pago,Pago_seguro,Comite_transporte,Fecha_pago_contraparte,Num_obra,Borrador,Avance,Estatus,Archivo,Usuario_creacion,Fecha_creacion,Usuario_ultima_modificacion,
        Fecha_ultima_modificacion,Pantalla,Contraparte_gestor,Id_eje,Contraparte,Atraves,IdActividad,IdArea)
            VALUES(  $this->Id_periodo , $this->Id_Exposicion , $this->Id_Instrumento ,$this->Id_subtipo , $this->Tipo_contrato ,' $this->Objeto ',\" $this->Fee_pago \",\" $this->Pago_seguro \",
              '$this->Comite_transporte ',' $this->Fecha_pago_contraparte ',$this->Num_obra ,' $this->Borrador ', $this->Avance ,'$this->Estatus ','$this->Archivo ',' $this->Usuario_creacion ',now(),' $this->Usuario_ultima_modificacion ',now(),
             ' $this->Pantalla ','$this->Contraparte_gestor','$this->Id_eje','$this->Contraparte','$this->Atraves',$this->Act,$this->Area);";
        $this->Id_juridico = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->Id_juridico == 0 || $this->Id_juridico == null) {
            return false;
        }
        return true;
    }

    public function Editar_juridico() {
        $editarPDF = "";

        if ($this->Archivo != 0 || $this->Archivo != "" || $this->Archivo != null) {
            $editarPDF = "Archivo='" . $this->Archivo . "',";
        }
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_juridico SET " . $editarPDF . "Estatus='" . $this->Estatus . "',Id_periodo=" . $this->Id_periodo . ",Id_Exposicion="
                . $this->Id_Exposicion . ",Id_eje=".$this->Id_eje.",Id_Instrumento=" . $this->Id_Instrumento . ",Id_subtipo=" . $this->Id_subtipo . ",Contraparte_gestor='".$this->Contraparte_gestor."',Tipo_contrato=" . $this->Tipo_contrato . ",Objeto='"
                . $this->Objeto . "',Fee_pago=\"$this->Fee_pago \",Contraparte=".$this->Contraparte.",Atraves=".$this->Atraves.",Comite_transporte='" . $this->Comite_transporte . "',Fecha_pago_contraparte='" . $this->Fecha_pago_contraparte . "',Num_obra=" . $this->Num_obra . ",Borrador='" . $this->Borrador . "',Avance=" . $this->Avance . ",Estatus='" . $this->Estatus . "',Usuario_ultima_modificacion = '"
                . $this->Usuario_ultima_modificacion . "', Fecha_ultima_modificacion = NOW(), IdActividad=".$this->Act.", IdArea=".$this->Area." WHERE c_juridico.Id_juridico = $this->Id_juridico;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_juridico', 'Id_juridico = ' . $this->Id_juridico);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function Eliminar_juridico() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_juridico WHERE Id_juridico = $this->Id_juridico;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_juridico", "Id_juridico = " . $this->Id_juridico);
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
    function getId_juridico() {
        return $this->Id_juridico;
    }

    function getId_periodo() {
        return $this->Id_periodo;
    }

    function getId_Exposicion() {
        return $this->Id_Exposicion;
    }

    function getId_Instrumento() {
        return $this->Id_Instrumento;
    }

    function getId_subtipo() {
        return $this->Id_subtipo;
    }

    function getTipo_contrato() {
        return $this->Tipo_contrato;
    }

    function getObjeto() {
        return $this->Objeto;
    }

    function getFee_pago() {
        return $this->Fee_pago;
    }

    function getPago_seguro() {
        return $this->Pago_seguro;
    }

    function getComite_transporte() {
        return $this->Comite_transporte;
    }

    function getFecha_pago_contraparte() {
        return $this->Fecha_pago_contraparte;
    }

    function getNum_obra() {
        return $this->Num_obra;
    }

    function getBorrador() {
        return $this->Borrador;
    }

    function getAvance() {
        return $this->Avance;
    }

    function getEstatus() {
        return $this->Estatus;
    }

    function getArchivo() {
        return $this->Archivo;
    }

    function getContraparte_gestor() {
        return $this->Contraparte_gestor;
    }

    function getUsuario_creacion() {
        return $this->Usuario_creacion;
    }

    function getFecha_creacion() {
        return $this->Fecha_creacion;
    }

    function getUsuario_ultima_modificacion() {
        return $this->Usuario_ultima_modificacion;
    }

    function getFecha_ultima_modificacion() {
        return $this->Fecha_ultima_modificacion;
    }

    function getPantalla() {
        return $this->Pantalla;
    }

    function getId_eje() {
        return $this->Id_eje;
    }

    function getContraparte() {
        return $this->Contraparte;
    }

    function getAtraves() {
        return $this->Atraves;
    }

    function setId_juridico($Id_juridico) {
        $this->Id_juridico = $Id_juridico;
    }

    function setId_periodo($Id_periodo) {
        $this->Id_periodo = $Id_periodo;
    }

    function setId_Exposicion($Id_Exposicion) {
        $this->Id_Exposicion = $Id_Exposicion;
    }

    function setId_Instrumento($Id_Instrumento) {
        $this->Id_Instrumento = $Id_Instrumento;
    }

    function setId_subtipo($Id_subtipo) {
        $this->Id_subtipo = $Id_subtipo;
    }

    function setTipo_contrato($Tipo_contrato) {
        $this->Tipo_contrato = $Tipo_contrato;
    }

    function setObjeto($Objeto) {
        $this->Objeto = $Objeto;
    }

    function setFee_pago($Fee_pago) {
        $this->Fee_pago = $Fee_pago;
    }

    function setPago_seguro($Pago_seguro) {
        $this->Pago_seguro = $Pago_seguro;
    }

    function setComite_transporte($Comite_transporte) {
        $this->Comite_transporte = $Comite_transporte;
    }

    function setFecha_pago_contraparte($Fecha_pago_contraparte) {
        $this->Fecha_pago_contraparte = $Fecha_pago_contraparte;
    }

    function setNum_obra($Num_obra) {
        $this->Num_obra = $Num_obra;
    }

    function setBorrador($Borrador) {
        $this->Borrador = $Borrador;
    }

    function setAvance($Avance) {
        $this->Avance = $Avance;
    }

    function setEstatus($Estatus) {
        $this->Estatus = $Estatus;
    }

    function setArchivo($Archivo) {
        $this->Archivo = $Archivo;
    }

    function setContraparte_gestor($Contraparte_gestor) {
        $this->Contraparte_gestor = $Contraparte_gestor;
    }

    function setUsuario_creacion($Usuario_creacion) {
        $this->Usuario_creacion = $Usuario_creacion;
    }

    function setFecha_creacion($Fecha_creacion) {
        $this->Fecha_creacion = $Fecha_creacion;
    }

    function setUsuario_ultima_modificacion($Usuario_ultima_modificacion) {
        $this->Usuario_ultima_modificacion = $Usuario_ultima_modificacion;
    }

    function setFecha_ultima_modificacion($Fecha_ultima_modificacion) {
        $this->Fecha_ultima_modificacion = $Fecha_ultima_modificacion;
    }

    function setPantalla($Pantalla) {
        $this->Pantalla = $Pantalla;
    }

    function setId_eje($Id_eje) {
        $this->Id_eje = $Id_eje;
    }

    function setContraparte($Contraparte) {
        $this->Contraparte = $Contraparte;
    }

    function setAtraves($Atraves) {
        $this->Atraves = $Atraves;
    }

    function getAct() {
        return $this->Act;
    }
    function setAct($Act) {
        $this->Act = $Act;
    }

    function getArea() {
        return $this->Area;
    }
    function setArea($Area) {
        $this->Area = $Area;
    }


}
