<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Indicador_entregable
{
    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function Total_categoria($categoria, $periodo)
    {
        $total = array();
        $Total_p = "";
        $Total_ac = "";
        $Total_a = "";
        $consulta = "SELECT COUNT(DISTINCT d.id_usuario) persona
        ,(SELECT COUNT(DISTINCT e.id_area) FROM c_documento e WHERE e.anio=$periodo AND e.IdCategoriadeEje=$categoria)area,
        (SELECT COUNT(DISTINCT ka.id_actividad) FROM k_archivoactividad ka INNER JOIN c_documento i on i.id_documento=ka.id_archivo WHERE i.anio=$periodo AND i.IdCategoriadeEje=$categoria ) actividad
        FROM c_documento d WHERE d.anio=$periodo AND d.IdCategoriadeEje=$categoria";
        $Result1 = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($Result1)) {
            $Total_p = $row['persona'];
            $Total_ac = $row['actividad'];
            $Total_a = $row['area'];
        }
        array_push($total, $Total_ac, $Total_a, $Total_p);
        //echo$Consulta;
        return $total;
    }
    public function getAreas()
    {
        $consultaareas = "SELECT a.Id_Area ,a.Nombre FROM c_area a WHERE a.estatus = 1 and a.tipoArea = 1";
        $Result = $this->catalogo->obtenerLista($consultaareas);
        return $Result;
    }
    public function Entregables_indicador($periodo, $area, $eje, $categoria, $tipo)
    {
        $where_periodo = "";
        $where_categoria = "";
        $where_tipo = "";
        $op_por_area = "";

        if ($tipo == 9 || $tipo == 10 || $tipo == 14) {
            $where_tipo = " AND d.id_tipo in($tipo)";
        } elseif ($tipo == 1) {
            $where_tipo = " AND d.id_tipo in(9,10,14)";
        }
        if ($periodo != 'todos') {
            $where_periodo = " AND d.anio=$periodo";
        }
        if ($categoria > 0) {
            $where_categoria = " AND d.IdCategoriadeEje=$categoria";
        }
        $consulta = "SELECT
        COUNT( d.id_documento ) conteo 
    FROM
        c_documento d
        LEFT JOIN k_archivoactividad ka ON ka.id_archivo = d.id_documento
        INNER JOIN c_area a on a.Id_Area=d.id_area
        WHERE  ka.id_proyecto=$eje and ( d.id_area = $area OR a.idAreaPadre = $area ) $where_tipo $where_periodo $where_categoria";
        //echo$consulta;
        $Result2 = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($Result2)) {
            $op_por_area = $row['conteo'];
        }
        return $op_por_area;
    }
    public function Total_entregables($periodo, $eje, $categoria, $tipo)
    {
        $where_periodo = "";
        $where_categoria = "";
        $where_tipo = "";
        $where_eje = "";
        $Totales = array();
        $Total_entregables=0;
        $Total_entregables_pre=0;
        $Total_entregables_Pro=0;
        $Total_entregables_Final=0;


        if ($periodo != 'todos') {
            $where_periodo = " AND d.anio=$periodo";
        }
        if ($categoria > 0) {
            $where_categoria = " AND d.IdCategoriadeEje=$categoria";
        }
        if ($eje > 0) {
            $where_eje = " AND ka.id_proyecto=$eje";
        }
        $consulta = "SELECT
        COUNT( d.id_documento ) total,
    (SELECT COUNT(d.id_documento) FROM c_documento d LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento  WHERE d.id_tipo=9 $where_eje $where_periodo $where_categoria)preliminar,
    (SELECT COUNT(d.id_documento) FROM c_documento d LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento  WHERE d.id_tipo=10 $where_eje $where_periodo $where_categoria )final,
    (SELECT COUNT(d.id_documento) FROM c_documento d LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento  WHERE d.id_tipo=14 $where_eje $where_periodo $where_categoria)proceso	
    FROM c_documento d 
        LEFT JOIN k_archivoactividad ka on ka.id_archivo=d.id_documento
    WHERE d.id_tipo IN (9,10,14) $where_eje $where_periodo $where_categoria";
        $Result2 = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($Result2)) {
            $Total_entregables = $row['total'];
            $Total_entregables_Final = $row['final'];
            $Total_entregables_pre = $row['preliminar'];
            $Total_entregables_Pro = $row['proceso'];
            array_push($Totales,$Total_entregables,$Total_entregables_Final,$Total_entregables_pre,$Total_entregables_Pro);
        }
        //echo$consulta;
        return $Totales;
    }
}
