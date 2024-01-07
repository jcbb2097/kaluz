<?php

include_once("Catalogo.class.php");

class Horasextras
{

    private $Id_horasextras;
    private $IdEquipoTrabajo;
    private $IdConcepto;
    private $IdConcepto2;
    private $IdConcepto3;
    private $IdConcepto4;
    private $IdArea;
    private $IdProyecto;
    private $Justificación;
    private $Tiempo;
    private $Costos;
    private $Fecha;
    private $Usuariocreacion;
    private $Fechacreacion;
    private $Usuarioultimacreacion;
    private $Fechaultimamodificacion;
    private $Pantalla;
    private $Periodo;
    private $expo;
    private $categoria;
    private $subcategoria;
    private $tipoactividad;

    public function getRegistro($Id_horasextras)
    {
        $catalogo = new Catalogo();
        if (isset($this->empresa)) {
            $catalogo->setEmpresa($this->empresa);
        }
        $consulta = "SELECT * FROM `c_horasextras` WHERE Id_horasextras = $Id_horasextras;";
        $result = $catalogo->obtenerLista($consulta);
        while ($rs = mysqli_fetch_array($result)) {
            $this->Id_horasextras = $rs['Id_horasextras'];
            $this->IdEquipoTrabajo = $rs['Id_persona'];
            $this->IdConcepto = $rs['IdConcepto'];
            $this->IdConcepto2 = $rs['IdConcepto2'];
            $this->IdConcepto3 = $rs['IdConcepto3'];
            $this->IdConcepto4 = $rs['IdConcepto4'];
            $this->IdArea = $rs['IdArea'];
            $this->IdProyecto = $rs['IdEje'];
            $this->Justificación = $rs['Justificación'];
            $this->Tiempo = $rs['Tiempo'];
            $this->Costos = $rs['Costos'];
            $this->Fecha = $rs['Fecha'];
            $this->Pantalla = $rs['Pantalla'];
            $this->Periodo = $rs['Id_periodo'];
            $this->expo = $rs['IdExposicion'];
            $this->categoria = $rs['Idcategoria'];
            $this->subcategoria = $rs['Idscategoria'];
            $this->tipoactividad = $rs['IdTipoActividad'];
            return true;
        }
        return false;
    }

    public function agregarHorasextras()
    {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_horasextras (Id_persona,IdConcepto,IdConcepto2,IdConcepto3,IdConcepto4,IdArea,IdEje,Justificación,Tiempo,Costos,Fecha,Usuariocreacion,FechaCreacion,Usuarioultimacreacion,FechaUltimaModificacion,Pantalla,Id_periodo, IdExposicion,Idcategoria,Idscategoria,IdTipoActividad) 
                    VALUES ($this->IdEquipoTrabajo,$this->IdConcepto,$this->IdConcepto2,$this->IdConcepto3,$this->IdConcepto4,$this->IdArea,$this->IdProyecto,'$this->Justificación',$this->Tiempo,$this->Costos,'$this->Fecha','$this->Usuariocreacion',now(),'$this->Usuarioultimacreacion',now(),'$this->Pantalla',$this->Periodo, $this->expo,$this->categoria, $this->subcategoria,$this->tipoactividad);";
        // echo$insert;
        $this->Id_horasextras = $catalogo->insertarRegistro($insert);
        if ($this->Id_horasextras == 0 || $this->Id_horasextras == null) {
            return false;
        }
        return true;
    }

    public function editarHorasextras()
    {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_horasextras SET Id_periodo=$this->Periodo,Id_persona = $this->IdEquipoTrabajo,IdConcepto = $this->IdConcepto,IdConcepto2 = $this->IdConcepto2,IdConcepto3 = $this->IdConcepto3,IdConcepto4 = $this->IdConcepto4,Justificación='$this->Justificación',Fecha='$this->Fecha',Tiempo='$this->Tiempo',Costos='$this->Costos',Usuarioultimacreacion='$this->Usuarioultimacreacion',IdArea='$this->IdArea',IdEje='$this->IdProyecto',FechaUltimaModificacion = now(), IdExposicion=$this->expo,Idcategoria=$this->categoria,Idscategoria=$this->subcategoria,IdTipoActividad=$this->tipoactividad WHERE Id_horasextras = $this->Id_horasextras;";
        //echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_horasextras', 'Id_horasextras = ' . $this->Id_horasextras);
        if ($query == 1) {
            return true;
        }
        return false;
    }

    public function eliminarHorasextras()
    {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_horasextras WHERE Id_horasextras = $this->Id_horasextras;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_horasextras", "Id_horasextras = " . $this->Id_horasextras);
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
    public function periodo($id)
    {
        $id_periodo = "";
        $catalogo = new Catalogo();
        $consulta = "SELECT p.Periodo FROM c_periodo as p WHERE p.Id_Periodo=$id";
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $id_periodo = $row['Periodo'];
        }
        return $id_periodo;
    }
    public function Area_Persona($id_area,$año)
    {
        $catalogo = new Catalogo();
        $consulta_nombres = "SELECT DISTINCT
        CONCAT( p.Nombre, ' ', p.Apellido_Paterno, ' ', p.Apellido_Materno ) AS nombre 
    FROM
        c_horasextras AS ac,
        c_personas AS p
        WHERE ac.Id_persona=p.id_Personas AND ac.IdArea=" . $id_area;

        //echo $consulta_nombres;
        $resultado = $catalogo->obtenerLista($consulta_nombres);
        while ($row = mysqli_fetch_array($resultado)) {
            $data[$row['nombre']] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        }
        for ($contador = 0; $contador < 12; $contador++) {
            if ($contador == 0) {
                $fecha_inicial = date($año . '-01-01');
                $fecha_fin = date($año . '-01-31');
            } elseif ($contador == 1) {
                $fecha_inicial = date($año . '-02-01');
                $fecha_fin = date($año . '-02-28');
            } elseif ($contador == 2) {
                $fecha_inicial = date($año . '-03-01');
                $fecha_fin = date($año . '-03-31');
            } elseif ($contador == 3) {
                $fecha_inicial = date($año . '-04-01');
                $fecha_fin = date($año . '-04-30');
            } elseif ($contador == 4) {
                $fecha_inicial = date($año . '-05-01');
                $fecha_fin = date($año . '-05-31');
            } elseif ($contador == 5) {
                $fecha_inicial = date($año . '-06-01');
                $fecha_fin = date($año . '-06-30');
            } elseif ($contador == 6) {
                $fecha_inicial = date($año . '-07-01');
                $fecha_fin = date($año . '-07-31');
            } elseif ($contador == 7) {
                $fecha_inicial = date($año . '-08-01');
                $fecha_fin = date($año . '-08-30');
            } elseif ($contador == 8) {
                $fecha_inicial = date($año . '-09-01');
                $fecha_fin = date($año . '-09-31');
            } elseif ($contador == 9) {
                $fecha_inicial = date($año . '-10-01');
                $fecha_fin = date($año . '-10-30');
            } elseif ($contador == 10) {
                $fecha_inicial = date($año . '-11-01');
                $fecha_fin = date($año . '-11-30');
            } else {
                $fecha_inicial = date($año . '-12-01');
                $fecha_fin = date($año . '-12-31');
            }
            $consulta_tiempo = "SELECT DISTINCT khe.Tiempo,khe.Fecha,khe.IdArea,CONCAT( cc.Nombre, ' ', cc.Apellido_Paterno, ' ', cc.Apellido_Materno ) AS nombre 
            FROM c_horasextras AS khe INNER JOIN c_personas AS cc ON cc.id_Personas = khe.Id_persona
          WHERE	khe.Fecha > '$fecha_inicial' AND khe.Fecha < '$fecha_fin' and khe.IdArea=$id_area ORDER BY cc.Nombre ASC";
            $result_tiempo = $catalogo->obtenerLista($consulta_tiempo);
            //echo$consulta_tiempo.'<br>';
            if (mysqli_num_rows($result_tiempo) > 0) {
                while ($row2 = mysqli_fetch_array($result_tiempo)) {
                    $data[$row2['nombre']][$contador] += $row2['Tiempo'];
                }
            }
        }


        //print_r($data);
        return$data;
    }



    function getId_horasextras()
    {
        return $this->Id_horasextras;
    }

    function getIdEquipoTrabajo()
    {
        return $this->IdEquipoTrabajo;
    }

    function getIdConcepto()
    {
        return $this->IdConcepto;
    }

    function getIdConcepto2()
    {
        return $this->IdConcepto2;
    }

    function getIdConcepto3()
    {
        return $this->IdConcepto3;
    }

    function getIdConcepto4()
    {
        return $this->IdConcepto4;
    }

    function getIdArea()
    {
        return $this->IdArea;
    }

    function getIdProyecto()
    {
        return $this->IdProyecto;
    }

    function getJustificación()
    {
        return $this->Justificación;
    }

    function getTiempo()
    {
        return $this->Tiempo;
    }

    function getCostos()
    {
        return $this->Costos;
    }

    function getFecha()
    {
        return $this->Fecha;
    }

    function getUsuariocreacion()
    {
        return $this->Usuariocreacion;
    }

    function getFechacreacion()
    {
        return $this->Fechacreacion;
    }

    function getUsuarioultimacreacion()
    {
        return $this->Usuarioultimacreacion;
    }

    function getFechaultimamodificacion()
    {
        return $this->Fechaultimamodificacion;
    }

    function getPantalla()
    {
        return $this->Pantalla;
    }

    function getPeriodo()
    {
        return $this->Periodo;
    }

    function getExpo()
    {
        return $this->expo;
    }

    function getcategoria()
    {
        return $this->categoria;
    }

    function getsubcategoria()
    {
        return $this->subcategoria;
    }

    function gettipoactividad()
    {
        return $this->tipoactividad;
    }

    function setId_horasextras($Id_horasextras)
    {
        $this->Id_horasextras = $Id_horasextras;
    }

    function setIdEquipoTrabajo($IdEquipoTrabajo)
    {
        $this->IdEquipoTrabajo = $IdEquipoTrabajo;
    }

    function setIdConcepto($IdConcepto)
    {
        $this->IdConcepto = $IdConcepto;
    }

    function setIdConcepto2($IdConcepto2)
    {
        $this->IdConcepto2 = $IdConcepto2;
    }

    function setIdConcepto3($IdConcepto3)
    {
        $this->IdConcepto3 = $IdConcepto3;
    }

    function setIdConcepto4($IdConcepto4)
    {
        $this->IdConcepto4 = $IdConcepto4;
    }

    function setIdArea($IdArea)
    {
        $this->IdArea = $IdArea;
    }

    function setIdProyecto($IdProyecto)
    {
        $this->IdProyecto = $IdProyecto;
    }

    function setJustificación($Justificación)
    {
        $this->Justificación = $Justificación;
    }

    function setTiempo($Tiempo)
    {
        $this->Tiempo = $Tiempo;
    }

    function setCostos($Costos)
    {
        $this->Costos = $Costos;
    }

    function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    function setUsuariocreacion($Usuariocreacion)
    {
        $this->Usuariocreacion = $Usuariocreacion;
    }

    function setFechacreacion($Fechacreacion)
    {
        $this->Fechacreacion = $Fechacreacion;
    }

    function setUsuarioultimacreacion($Usuarioultimacreacion)
    {
        $this->Usuarioultimacreacion = $Usuarioultimacreacion;
    }

    function setFechaultimamodificacion($Fechaultimamodificacion)
    {
        $this->Fechaultimamodificacion = $Fechaultimamodificacion;
    }

    function setPantalla($Pantalla)
    {
        $this->Pantalla = $Pantalla;
    }

    function setPeriodo($Periodo)
    {
        $this->Periodo = $Periodo;
    }

    function setExpo($expo)
    {
        $this->expo = $expo;
    }

    function setcategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    function setsubcategoria($subcategoria)
    {
        $this->subcategoria = $subcategoria;
    }

    function settipoactividad($tipoactividad)
    {
        $this->tipoactividad = $tipoactividad;
    }
}
