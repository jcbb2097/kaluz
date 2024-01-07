<?php

include_once("../../../WEB-INF/Classes/Catalogo.class.php");

class Indicadores_opiniones
{


    public function getAreas()
    {
        $catalogo = new Catalogo();
        $consultaareas = "SELECT a.Id_Area ,a.Nombre FROM c_area a WHERE a.estatus = 1 and a.tipoArea = 1";
        $result = $catalogo->obtenerLista($consultaareas);
        return $result;
    }

    public function pendientes()
    {
        //trae las opiniones pendientes por atender
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) pendientes from c_opiniones where  IdEstatusOpinion = 3";
        $result = $catalogo->obtenerLista($consulta);
        // echo "<br><br>$insert<br><br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $this->pendientes = $row['pendientes'];
        }
        return $this->pendientes;
    }

    public function atendidas()
    {
        //trae las opiniones atendidas
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) atendidas from c_opiniones where  IdEstatusOpinion = 4";
        //echo "<br><br>$consulta<br><br>";
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($result)) {
            $this->atendidas = $row['atendidas'];
        }
        return $this->atendidas;
    }
    public function totales()
    {
        //trae las opiniones 
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) totales from c_opiniones ";
        $result = $catalogo->obtenerLista($consulta);
        // echo "<br><br>$insert<br><br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $this->totales = $row['totales'];
        }
        return $this->totales;
    }

    public function total_turnado_actividad()
    {
        //trae las opiniones turnadas a actividad
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) totales from c_opiniones where IdEstatusOpinion in(3,4)";
        $result = $catalogo->obtenerLista($consulta);
        // echo "<br><br>$insert<br><br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $this->totales = $row['totales'];
        }
        return $this->totales;
    }

    public function pendientes_t_act()
    {
        //trae las opiniones pendientes a turnar a actividad
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) totales from c_opiniones where IdEstatusOpinion = 2";
        $result = $catalogo->obtenerLista($consulta);
        // echo "<br><br>$insert<br><br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['totales'];
        }
        return $total;
    }
    public function avance_t_eje()
    {
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) totales from c_opiniones where IdEstatusOpinion > 1";
        $result = $catalogo->obtenerLista($consulta);
        // echo "<br><br>$insert<br><br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['totales'];
        }
        return $total;
    }
    public function pendientes_t_eje()
    {
        $catalogo = new Catalogo();
        $consulta = "SELECT COUNT(*) totales from c_opiniones where IdEstatusOpinion = 1";
        $result = $catalogo->obtenerLista($consulta);
        // echo "<br><br>$insert<br><br>";
        while ($row = mysqli_fetch_assoc($result)) {
            $total = $row['totales'];
        }
        return $total;
    }

    public function Total_por_tipo($tipo)
    {
        $where = "";
        $data = array();
        $F = 0;
        $S = 0;
        $Q = 0;
        $catalogo = new Catalogo();
        if ($tipo == 1) {
            $where = ">1";
        } elseif ($tipo == 2) {
            $where = "=1";
        } elseif ($tipo == 3) {
            $where = "in(3,4)";
        } elseif ($tipo == 4) {
            $where = "=2";
        } elseif ($tipo == 5) {
            $where = "in(4)";
        } elseif ($tipo == 6) {
            $where = "in(3)";
        }
        $consulta = "SELECT DISTINCT
        ( SELECT COUNT( * ) totales FROM c_opiniones WHERE IdEstatusOpinion  $where AND IdTipoOpinion = 1 ) AS f,
        ( SELECT COUNT( * ) totales FROM c_opiniones WHERE IdEstatusOpinion  $where AND IdTipoOpinion = 2 ) AS s,
        ( SELECT COUNT( * ) totales FROM c_opiniones WHERE IdEstatusOpinion  $where AND IdTipoOpinion = 3 ) AS q 
    FROM
        c_opiniones";
        // echo$consulta;
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($result)) {
            $F = $row['f'];
            $S = $row['s'];
            $Q = $row['q'];
        }
        array_push($data, $F, $S, $Q);
        return $data;
    }
    public function Opiniones_indicador($area,$eje,$estatus,$tipo)
    {
        $catalogo = new Catalogo();
        $areas = $area;
        $op_por_area="";
        if($tipo != "")$where_tipo = "and op.IdTipoOpinion =  $tipo";else $where_tipo = "";
        $consulta = "SELECT Id_Area FROM c_area WHERE idAreaPadre =  $area ";
        $result_ = $catalogo->obtenerLista($consulta);
        while ($row1 = mysqli_fetch_assoc($result_)) {//buscamos las subareas
            $areas .= ",".$row1['Id_Area'];
        }
        $consulta = "select COUNT(op.IdOpinion) conteo from c_opiniones op
                                   JOIN c_actividad ca ON  op.IdActTurnada = ca.IdActividad
                                   JOIN  c_area  a ON  ca.IdArea = a.Id_Area
                                   WHERE  op.IdEstatusOpinion $estatus AND op.IdEjeTurnado= $eje AND a.Id_Area in ($areas) $where_tipo";
                                   //echo$consulta."<br>";
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($result)) {
            $op_por_area = $row['conteo'];
        }
       
        return $op_por_area;
      }
      public function Usuario($id_usuario){
        $id_persona="";
        $useer=$id_usuario;
        $catalogo = new Catalogo();
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
        $result = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_assoc($result)) {
            $id_persona = $row['id_Personas'];
        }
        return $id_persona;
    }
  
    
}
