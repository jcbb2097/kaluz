<?php

include_once("Catalogo.class.php");

class documento {

    private $id_acuerdo_escrito;
    private $id_usuario;
    private $Pdfcedulafiscal;
    private $Pdfid;
    private $descripcion;
    private $anio;
    private $id_tipo;
    private $id_area;
    private $id_Exposición;
    private $id_destino;
    private $id_destino2;
    private $fecha_convocado;
    private $fecha_realizado;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $estatus;
    private $pantalla;

    public function getAcuerdo() {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM c_acuerdospdf WHERE c_acuerdospdf.id_acuerdo_escrito = " . $this->id_acuerdo_escrito;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->id_usuario = $row['id_usuario'];
            $this->Pdfcedulafiscal = $row['pdf'];
            $this->Pdfid = $row['pdfid'];
            $this->descripcion = $row['descripcion'];
            $this->anio = $row['anio'];
            $this->id_tipo = $row['id_tipo'];
            $this->id_area = $row['id_area'];
            $this->id_destino = $row['id_destino'];
            $this->id_destino2 = $row['id_destino2'];
            $this->fecha_convocado = $row['fecha_convocado'];
            $this->fecha_realizado = $row['fecha_realizado'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            $this->estatus = $row['estatus'];
            return true;
        }
        return false;
    }

    public function nuevoAcuerdo() {
        $catalogo = new Catalogo(); 
        if($this->fecha_realizado != "NULL"){
            $this->fecha_realizado  = "'".$this->fecha_realizado. "'";
        }
        $idareaconvoca="";
        $obtenerareaconvoca="SELECT distinct a.Id_Area,a.Nombre FROM c_personas as p 
        JOIN c_area a ON a.Id_Area=p.idArea
        WHERE a.tipoArea=1 AND a.estatus=1 AND p.id_Personas=".$this->id_usuario;
        $resultconvoca = $catalogo->obtenerLista($obtenerareaconvoca);
        while ($row = mysqli_fetch_array($resultconvoca)) {
            $idareaconvoca=$row['Id_Area'];
        }

        $insert = "INSERT INTO c_acuerdospdf(id_usuario,pdf,descripcion,anio,id_tipo,id_area,id_destino,id_destino2,fecha_convocado,fecha_realizado,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla,estatus)
            VALUES( " . $this->id_usuario . ",'" . $this->Pdfcedulafiscal . "','" . $this->descripcion . "'," . $this->anio . "," . $this->id_tipo . "," . $idareaconvoca . "," . $this->id_destino . "," . $this->id_destino2 . ",'".$this->fecha_convocado."',".$this->fecha_realizado.",'$this->usuarioCreacion',now(),'$this->usuarioUltimaModificacion',now(),'$this->pantalla','$this->estatus');";
        $this->id_acuerdo_escrito = $catalogo->insertarRegistro($insert);
        //echo $insert; 

        //$this->AgregarAreaInvitada($idareaconvoca);
        if ($this->id_acuerdo_escrito == 0 || $this->id_acuerdo_escrito == null) {
            return false;
        }
        return true;
    }

    public function editaracuerdo() {
        $editarPDF = "";

        if ( $this->Pdfcedulafiscal != "SIN") {
            $editarPDF = "pdf='" . $this->Pdfcedulafiscal . "',";
        }
        if($this->fecha_realizado != "NULL"){
            $this->fecha_realizado  = "'".$this->fecha_realizado. "'";
        }
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_acuerdospdf SET " . $editarPDF . " descripcion='" . $this->descripcion . "',anio=" . $this->anio . ",id_usuario=".$this->id_usuario.",id_tipo=" . $this->id_tipo . ",id_area=" . $this->id_area . ",id_destino=" . $this->id_destino . ",id_destino2=" . $this->id_destino2 . ",estatus=" . $this->estatus . ",fecha_convocado='".$this->fecha_convocado."',fecha_realizado=".$this->fecha_realizado.",usuarioUltimaModificacion = '" . $this->usuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() WHERE c_acuerdospdf.id_acuerdo_escrito = $this->id_acuerdo_escrito;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_acuerdospdf', 'id_acuerdo_escrito = ' . $this->id_acuerdo_escrito);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarAcuerdo() {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_acuerdospdf WHERE id_acuerdo_escrito = $this->id_acuerdo_escrito;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_acuerdospdf", "id_acuerdo_escrito = " . $this->id_acuerdo_escrito);
        //echo "<br><br>$consulta<br><br>"; 
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function PeriodoActual($año){
        $id_periodo="";
        $catalogo = new Catalogo();
        $consulta="SELECT p.Id_Periodo FROM c_periodo as p WHERE p.Periodo=$año";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $id_periodo=$row['Id_Periodo'];
        }
    return $id_periodo;
    }

    public function agregarAreaInvitada(){
        $idconsulta="";
        $idareaconvoca="";
        $catalogo = new Catalogo();
        $consulta="SELECT MAX(id_acuerdo_escrito) AS id FROM c_acuerdospdf";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $idconsulta=$row['id'];
        }

        
        $obtenerareaconvoca="SELECT distinct a.Id_Area,a.Nombre FROM c_personas as p 
        JOIN c_area a ON a.Id_Area=p.idArea
        WHERE a.tipoArea=1 AND a.estatus=1 AND p.id_Personas=".$this->id_usuario;
        $resultconvoca = $catalogo->obtenerLista($obtenerareaconvoca);
        while ($row2 = mysqli_fetch_array($resultconvoca)) {
            $idareaconvoca=$row2['Id_Area'];
        }

        $insert2 = "INSERT INTO k_acuerdoarea(id_Acuerdo,id_Area_invitada,firma)
            VALUES( " . $idconsulta . "," . $idareaconvoca . ",null);";
        $this->id_acuerdo_escrito = $catalogo->insertarRegistro($insert2);
    if ($this->id_acuerdo_escrito == 0 || $this->id_acuerdo_escrito == null) {
            return false;
        }
        return true;
    }


    function getId_acuerdo_escrito() {
        return $this->id_acuerdo_escrito;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getPdfcedulafiscal() {
        return $this->Pdfcedulafiscal;
    }

    function getPdfid() {
        return $this->Pdfid;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getAnio() {
        return $this->anio;
    }

    function getId_tipo() {
        return $this->id_tipo;
    }

    function getId_area() {
        return $this->id_area;
    }

    function getId_Exposición() {
        return $this->id_Exposición;
    }

    function getId_destino() {
        return $this->id_destino;
    }

    function getId_destino2() {
        return $this->id_destino2;
    }

    function getFecha_convocado() {
        return $this->fecha_convocado;
    }

    function getFecha_realizado() {
        return $this->fecha_realizado;
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

    function getEstatus() {
        return $this->estatus;
    }

    function getPantalla() {
        return $this->pantalla;
    }

    function setId_acuerdo_escrito($id_acuerdo_escrito) {
        $this->id_acuerdo_escrito = $id_acuerdo_escrito;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setPdfcedulafiscal($Pdfcedulafiscal) {
        $this->Pdfcedulafiscal = $Pdfcedulafiscal;
    }

    function setPdfid($Pdfid) {
        $this->Pdfid = $Pdfid;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setAnio($anio) {
        $this->anio = $anio;
    }

    function setId_tipo($id_tipo) {
        $this->id_tipo = $id_tipo;
    }

    function setId_area($id_area) {
        $this->id_area = $id_area;
    }

    function setId_Exposición($id_Exposición) {
        $this->id_Exposición = $id_Exposición;
    }

    function setId_destino($id_destino) {
        $this->id_destino = $id_destino;
    }

    function setId_destino2($id_destino2) {
        $this->id_destino2 = $id_destino2;
    }

    function setFecha_convocado($fecha_convocado) {
        $this->fecha_convocado = $fecha_convocado;
    }

    function setFecha_realizado($fecha_realizado) {
        $this->fecha_realizado = $fecha_realizado;
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

    function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    function setPantalla($pantalla) {
        $this->pantalla = $pantalla;
    }

}
