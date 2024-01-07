<?php
include_once("Catalogo.class.php");
class ArchivoCompartido
{

    private $id_documento;
    private $id_usuario;
    private $Pdfcedulafiscal;
    private $descripcion;
    private $anio;
    private $id_tipo;
    private $id_area;
    private $id_Exposición;
    private $id_destino;
    private $id_destino2;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;
    private $actividad;
    private $IdCategoriadeEje;
    private $Id_check;
    private $ruta;
    private $origenasuntos;

    public function getAcuerdo()
    {
        $catalogo = new Catalogo();
        $consultaAcuerdo = "SELECT * FROM c_documento WHERE c_documento.id_documento = " . $this->id_documento;
        $resultAcuerdo = $catalogo->obtenerLista($consultaAcuerdo);
        while ($row = mysqli_fetch_array($resultAcuerdo)) {
            $this->id_usuario = $row['id_usuario'];
            $this->ruta = $row['ruta'];
            $this->Pdfcedulafiscal = $row['pdf'];
            $this->descripcion = $row['descripcion'];
            $this->IdCategoriadeEje = $row['IdCategoriadeEje'];
            $this->anio = $row['anio'];
            $this->id_tipo = $row['id_tipo'];
            $this->id_area = $row['id_area'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            $this->Id_check = $row['Id_check'];
            return true;
        }
        return false;
    }

    public function nuevoAcuerdo()
    {
        $catalogo = new Catalogo();
        $campoasuntos = "";
        if($this->origenasuntos != "" && $this->origenasuntos != 0){
          $campoasuntos = ",Asunto";
          $this->origenasuntos = ",".$this->origenasuntos;
        }else{
          $this->origenasuntos = "";
        }
        $insert = "INSERT INTO c_documento(id_usuario,ruta,pdf,descripcion,anio,id_tipo,id_area,usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla,IdCategoriadeEje,Id_check".$campoasuntos.")
            VALUES(  $this->id_usuario ,'" . $this->ruta . "','" . $this->Pdfcedulafiscal . "','" . $this->descripcion . "'," . $this->anio . "," . $this->id_tipo . "," . $this->id_area . ",'$this->usuarioCreacion',now(),'$this->usuarioUltimaModificacion',now(),'$this->pantalla'," . $this->IdCategoriadeEje . "," . $this->Id_check . "".$this->origenasuntos." );";
        $this->id_documento =$catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->id_documento == 0 || $this->id_documento == null) {
            return false;
        }
        return true;
    }
    public function nuevo_detalle_acuerdo()
    {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO k_entregableEspecifVersion(IdEntregableEspecifico,IdArchivoPreliminar)
          VALUES( (SELECT  ee.IdEntregEspecifico
                    FROM c_entregable e, c_entregableEspecifico ee
                    WHERE ee.IdEntregable=e.IdEntregable
                    AND e.idActividad=$this->actividad
                    LIMIT 1) ,$this->id_documento);";
        $catalogo->insertarRegistro($insert);
        //xecho "<br><br>$insert<br><br>";
    }

    public function editaracuerdo()
    {
        $editarPDF = "";
        $editarruta = "";
        if ($this->Pdfcedulafiscal != 0 || $this->Pdfcedulafiscal != "" || $this->Pdfcedulafiscal != null) {
            $editarPDF = "pdf='" . $this->Pdfcedulafiscal . "'" . ",";
        }
        if ($this->ruta != 0 || $this->ruta != "" || $this->ruta != null) {
            $editarruta = "ruta='" . $this->ruta . "'" . ",";
        }
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_documento SET $editarruta $editarPDF  descripcion='" . $this->descripcion . "',anio=" . $this->anio . ",id_tipo=" . $this->id_tipo . ",id_area=" . $this->id_area . ",usuarioUltimaModificacion = '" . $this->usuarioUltimaModificacion . "', FechaUltimaModificacion = NOW() , IdCategoriadeEje=" . $this->IdCategoriadeEje . ",Id_check=".$this->Id_check." WHERE c_documento.id_documento = $this->id_documento;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_documento', 'id_documento = ' . $this->id_documento);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarAcuerdo()
    {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_documento WHERE id_documento = $this->id_documento;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_documento", "id_documento = " . $this->id_documento);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function eliminardetalle_doc()
    {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM k_entregableEspecifVersion WHERE IdArchivoPreliminar = $this->id_documento;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "k_entregableEspecifVersion", "IdArchivoPreliminar = " . $this->id_documento);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function PeriodoActual($año)
    {
        $id_periodo = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT p.Id_Periodo FROM c_periodo as p WHERE p.Periodo=$año";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $id_periodo = $row['Id_Periodo'];
        }
        return $id_periodo;
    }

    public function Entregable_final($Id_actividad, $tipo, $IdCategoriadeEje, $Id_check,$id_periodo)
    {
        $existe = "";
        $catalogo = new Catalogo();
        $consulta = "";
        if ($Id_check > 0) {
            $consulta = "SELECT COUNT(d.id_documento) total FROM c_documento d LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento WHERE ka.id_actividad=$Id_actividad and d.id_tipo=$tipo and d.IdCategoriadeEje=$IdCategoriadeEje AND d.Id_check=$Id_check and d.anio=$id_periodo";
        } else {
            $consulta = "SELECT COUNT(d.id_documento) total FROM c_documento d LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento WHERE ka.id_actividad=$Id_actividad and d.id_tipo=$tipo and d.IdCategoriadeEje=$IdCategoriadeEje and d.anio=$id_periodo";
        }
        //echo $consulta;
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $existe = $row['total'];
        }
        return $existe;
    }
    public function ruta_guardar($tipo)
    {
        $existe = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT d.Ruta FROM c_tipo_documento d WHERE d.id_tipo=$tipo";
        //echo$consulta;
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $existe = $row['Ruta'];
        }
        return $existe;
    }

    public function validar_eliminar($tipo_entregable, $Id_check, $id_periodo, $id_actividad)
    {
        $existe = 1;
        $Inicial = "";
        $Final = "";
        $proceso = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT ka.Inicial,ka.Proceso,ka.Final FROM k_checklist_actividad ka
        WHERE ka.Id_Periodo=$id_periodo AND ka.IdCheckList=$Id_check AND ka.IdActividad=$id_actividad";

        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $Inicial = $row['Inicial'];
            $proceso = $row['Proceso'];
            $Final = $row['Final'];
        }
        if ($tipo_entregable == 9 && $proceso == 0 && $Final == 0) {
            $existe = 0;
        } elseif ($tipo_entregable == 10 && $proceso == 0 && $Inicial == 0) {
            $existe = 0;
        } elseif ($tipo_entregable == 14 && $Final == 0) {
            $existe = 0;
        }

        return $existe;
    }
    function getId_documento()
    {
        return $this->id_documento;
    }

    function getId_usuario()
    {
        return $this->id_usuario;
    }

    function getPdfcedulafiscal()
    {
        return $this->Pdfcedulafiscal;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getAnio()
    {
        return $this->anio;
    }

    function getId_tipo()
    {
        return $this->id_tipo;
    }

    function getId_area()
    {
        return $this->id_area;
    }

    function getId_Exposición()
    {
        return $this->id_Exposición;
    }

    function getId_destino()
    {
        return $this->id_destino;
    }

    function getId_destino2()
    {
        return $this->id_destino2;
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

    function setId_documento($id_documento)
    {
        $this->id_documento = $id_documento;
    }

    function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    function setPdfcedulafiscal($Pdfcedulafiscal)
    {
        $this->Pdfcedulafiscal = $Pdfcedulafiscal;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setAnio($anio)
    {
        $this->anio = $anio;
    }

    function setId_tipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;
    }

    function setId_area($id_area)
    {
        $this->id_area = $id_area;
    }

    function setId_Exposición($id_Exposición)
    {
        $this->id_Exposición = $id_Exposición;
    }

    function setId_destino($id_destino)
    {
        $this->id_destino = $id_destino;
    }

    function setId_destino2($id_destino2)
    {
        $this->id_destino2 = $id_destino2;
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
    function setorigenasunto($origenasunto)
    {
        $this->origenasuntos = $origenasunto;
    }

    function setId_actividad1($actividad)
    {
        $this->actividad = $actividad;
    }

    public function getRuta()
    {
        return $this->ruta;
    }
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }

    /**
     * Get the value of IdCategoriadeEje
     */
    public function getIdCategoriadeEje()
    {
        return $this->IdCategoriadeEje;
    }

    /**
     * Set the value of IdCategoriadeEje
     *
     * @return  self
     */
    public function setIdCategoriadeEje($IdCategoriadeEje)
    {
        $this->IdCategoriadeEje = $IdCategoriadeEje;

        return $this;
    }

    /**
     * Get the value of Id_check
     */
    public function getId_check()
    {
        return $this->Id_check;
    }

    /**
     * Set the value of Id_check
     *
     * @return  self
     */
    public function setId_check($Id_check)
    {
        $this->Id_check = $Id_check;

        return $this;
    }
}
