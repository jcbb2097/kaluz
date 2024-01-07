<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Indicadores_opiniones
{
    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }


    public function titulo($Eje_area, $Id, $Tipo)
    {
        //funcion para el titulo del indicador
        $titulo = "";
        $Consulta = "";
        if ($Eje_area == 1) {
            $Consulta = "SELECT CONCAT('Indicador de Opiniones del área de ',a.Nombre) as titulo FROM c_area a WHERE a.Id_Area=$Id";
        } else {
            $Consulta = "SELECT CONCAT('Indicador de Opiniones del eje de ',e.Nombre) as titulo FROM c_eje e WHERE e.idEje=$Id";
        }
        $Result = $this->catalogo->obtenerLista($Consulta);
        while ($row = mysqli_fetch_array($Result)) {
            $titulo = $row['titulo'];
        }
        if ($Tipo == 1) {
            $titulo = $titulo . ' / Atendidas';
        } elseif ($Tipo == 2) {
            $titulo = $titulo . ' / Pendientes de atender';
        }
        return $titulo;
    }

    public function Total_Opiniones($Tipo, $Periodo, $Id)
    {
        $total = array();
        $where = "";
        $Total_O = "";
        $Total_T = "";
        $Total_A = "";
        if ($Periodo != 'Todos') {
            $where = "AND YEAR(op.Fecha)=$Periodo";
        }
        if ($Tipo == 1) {
            $Consulta_total = "SELECT COUNT(op.IdOpinion) Total FROM c_opiniones op
            JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad JOIN c_area a ON ca.IdArea = a.Id_Area
            WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) $where";
            $consulta_atendidas="SELECT COUNT(op.IdOpinion) atendidas FROM c_opiniones op
            JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad JOIN c_area a ON ca.IdArea = a.Id_Area
            WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) and op.IdEstatusOpinion=4 $where";
            $consulta_natendidas="SELECT COUNT(op.IdOpinion) Turn_ac FROM c_opiniones op
            JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad JOIN c_area a ON ca.IdArea = a.Id_Area
            WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) and op.IdEstatusOpinion in(1,2,3) $where";
        } else {
            $Consulta_total = "SELECT COUNT(op.IdOpinion) Total FROM c_opiniones op WHERE op.IdEjeTurnado=$Id $where";
            $consulta_atendidas = "SELECT COUNT(op.IdOpinion) atendidas FROM c_opiniones op WHERE op.IdEjeTurnado=$Id and op.IdEstatusOpinion =4 $where";
            $consulta_natendidas = "SELECT COUNT(op.IdOpinion) Turn_ac FROM c_opiniones op WHERE op.IdEjeTurnado=$Id and op.IdEstatusOpinion in(1,2,3) $where";
        }
       // echo$Consulta_total;
        $Result1 = $this->catalogo->obtenerLista($Consulta_total);
         $Result2 = $this->catalogo->obtenerLista($consulta_atendidas);
         $Result3 = $this->catalogo->obtenerLista($consulta_natendidas);
        while ($row = mysqli_fetch_array($Result1)) {
            $Total_O = $row['Total'];
        }
        while ($row = mysqli_fetch_array($Result2)) {
            $Total_A = $row['atendidas'];
        }
        while ($row = mysqli_fetch_array($Result3)) {
            $Total_T = $row['Turn_ac'];
        }
        array_push($total, $Total_O, $Total_T, $Total_A);
        //echo$Consulta;
        return $total;
    }
    public function Total_Opiniones_por_tipo($Tipo, $Periodo, $Id, $tipo)
    {
        $total = array();
        $where = "";
        $where2 = "";
        $Total_O = "";
        $Total_T = "";
        $Total_A = "";
        if ($Periodo != 'Todos') {
            $where = "AND YEAR(op.Fecha)=$Periodo";
        }
        if ($tipo == 1) {
            $where2 = " AND op.IdTipoOpinion=1";
        } elseif ($tipo == 2) {
            $where2 = " AND op.IdTipoOpinion=2";

        } else {
            $where2 = " AND op.IdTipoOpinion=3";
        }

        if ($Tipo == 1) {
            $Consulta_total = "SELECT COUNT(op.IdOpinion) Total FROM c_opiniones op
            JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad JOIN c_area a ON ca.IdArea = a.Id_Area
            WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) $where $where2";
            $consulta_atendidas = "SELECT COUNT(op.IdOpinion) atendidas FROM c_opiniones op
            JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad JOIN c_area a ON ca.IdArea = a.Id_Area
            WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) and op.IdEstatusOpinion=4 $where $where2";
            $consulta_natendidas = "SELECT COUNT(op.IdOpinion) Turn_ac FROM c_opiniones op
            JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad JOIN c_area a ON ca.IdArea = a.Id_Area
            WHERE ( ca.IdArea = $Id OR a.idAreaPadre = $Id ) and op.IdEstatusOpinion in(1,2,3) $where $where2";
        } else {
            $Consulta_total = "SELECT COUNT(op.IdOpinion) Total FROM c_opiniones op WHERE op.IdEjeTurnado=$Id $where $where2";
            $consulta_atendidas = "SELECT COUNT(op.IdOpinion) atendidas FROM c_opiniones op WHERE op.IdEjeTurnado=$Id and op.IdEstatusOpinion =4 $where $where2";
            $consulta_natendidas = "SELECT COUNT(op.IdOpinion) Turn_ac FROM c_opiniones op WHERE op.IdEjeTurnado=$Id and op.IdEstatusOpinion in(1,2,3) $where $where2";
        }
        // echo$consulta_natendidas;
        $Result1 = $this->catalogo->obtenerLista($Consulta_total);
        $Result2 = $this->catalogo->obtenerLista($consulta_atendidas);
        $Result3 = $this->catalogo->obtenerLista($consulta_natendidas);
        while ($row = mysqli_fetch_array($Result1)) {
            $Total_O = $row['Total'];
        }
        while ($row = mysqli_fetch_array($Result2)) {
            $Total_A = $row['atendidas'];
        }
        while ($row = mysqli_fetch_array($Result3)) {
            $Total_T = $row['Turn_ac'];
        }
        array_push($total, $Total_O, $Total_T, $Total_A);
        //echo$Consulta;
        return $total;
    }
    public function getAreas()
    {
        $consultaareas = "SELECT a.Id_Area ,a.Nombre FROM c_area a WHERE a.estatus = 1 and a.tipoArea = 1";
        $Result = $this->catalogo->obtenerLista($consultaareas);
        return $Result;
    }
    public function Opiniones_indicador($area, $eje, $estatus, $tipo,$periodo)
    {
        $areas = $area;
        $op_por_area = "";
        $tiempo="";
        if ($periodo != 'Todos') {
            $tiempo = "AND YEAR(op.Fecha)=$periodo";
        }
        if ($tipo != "") $where_tipo = "and op.IdTipoOpinion =  $tipo";
        else $where_tipo = "";
        $consulta = "SELECT Id_Area FROM c_area WHERE idAreaPadre =  $area ";
        $Result = $this->catalogo->obtenerLista($consulta);
        while ($row1 = mysqli_fetch_assoc($Result)) { //buscamos las subareas
            $areas .= "," . $row1['Id_Area'];
        }
        $consulta2 = "select COUNT(op.IdOpinion) conteo from c_opiniones op
                                   JOIN c_actividad ca ON  op.IdActTurnada = ca.IdActividad
                                   JOIN  c_area  a ON  ca.IdArea = a.Id_Area
                                   WHERE  op.IdEstatusOpinion $estatus AND op.IdEjeTurnado= $eje AND a.Id_Area in ($areas) $where_tipo $tiempo";
     // echo$consulta2."<br>";
        $Result2 = $this->catalogo->obtenerLista($consulta2);
        while ($row = mysqli_fetch_assoc($Result2)) {
            $op_por_area = $row['conteo'];
        }

        return $op_por_area;
    }
    public function Usuario($id_usuario)
    {
        $id_persona = "";
        $useer = $id_usuario;
        $consulta = "SELECT
        p.id_Personas,
        CONCAT( p.Nombre, ' ', p.Apellido_Paterno, ' ', p.Apellido_Materno ) AS nombre ,
        u.IdUsuario,
        u.Usuario 
    FROM
        c_personas p
        INNER JOIN c_usuario u ON u.IdPersona = p.id_Personas 
    WHERE
        u.IdUsuario = $useer";
        //echo$consulta."<br>";
        $Result2 = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($Result2)) {
            $id_persona = $row['id_Personas'];
        }
        return $id_persona;
    }
    public function porcentajes($eje,$periodo,$tipo)
    {
        $data = array();
        $F = 0;
        $S = 0;
        $Q = 0;
        $tiempo="";
        $tiempo2="";
        $por="";
        $por2="";
        if ($periodo != 'Todos') {
            $tiempo = "AND YEAR(op.Fecha)=$periodo";
            $tiempo2 = "AND YEAR(o.Fecha)=$periodo";
        }
        if ($tipo==2) {
            $por="AND o.IdEstatusOpinion =4";
            $por2="AND op.IdEstatusOpinion =4";
        }elseif($tipo==3){
            $por="AND o.IdEstatusOpinion in(1,2,3)";
            $por2="AND op.IdEstatusOpinion in(1,2,3)";
        }
        $consulta = "SELECT
        COUNT( op.IdOpinion ) total,
        (SELECT COUNT( o.IdOpinion ) FROM c_opiniones o 
        WHERE o.IdEstatusOpinion = 4 AND o.IdEjeTurnado = $eje
        $tiempo2 $por) AS resueltas ,
        (SELECT COUNT( o.IdOpinion ) FROM c_opiniones o 
        WHERE o.IdEstatusOpinion in (1,2,3) AND o.IdEjeTurnado = $eje
        $tiempo2 $por) AS n_resueltas
    FROM
        c_opiniones AS op 
    WHERE
        op.IdEjeTurnado = $eje $tiempo $por2";
        //echo$consulta;
        $result = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($result)) {
            $F = $row['total'];
            $S = $row['resueltas'];
            $Q = $row['n_resueltas'];
        }
        array_push($data, $F, $S, $Q);
        return $data;
    }
    public function Por_eje($area, $eje,$periodo,$tipo)
    {
        $op_por_area = "";
        $tiempo="";
        $por="";
        if ($periodo != 'Todos') {
            $tiempo = "AND YEAR(op.Fecha)=$periodo";
        }
        if ($tipo==2) {
            $por="AND op.IdEstatusOpinion =4";
        }elseif($tipo==3){
            $por="AND op.IdEstatusOpinion in(1,2,3)";
        }
        $areas = $area;
        $consulta = "SELECT Id_Area FROM c_area WHERE idAreaPadre =  $area ";
        $result_ = $this->catalogo->obtenerLista($consulta);
        while ($row1 = mysqli_fetch_assoc($result_)) { //buscamos las subareas
            $areas .= "," . $row1['Id_Area'];
        }
        $consulta = "SELECT
        COUNT( op.IdOpinion ) conteo 
    FROM
        c_opiniones op
        JOIN c_actividad ca ON op.IdActTurnada = ca.IdActividad
        JOIN c_area a ON ca.IdArea = a.Id_Area 
    WHERE
        op.IdEjeTurnado = $eje
        AND a.Id_Area in ($areas) $tiempo $por";
        //echo$consulta;
        $result= $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($result)) {
            $op_por_area = $row['conteo'];
        }
        // echo$op_por_area;
        return $op_por_area;
    }

}
