<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');

//clase principal de Planeacion
class Evidencias
{

    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function Categoria($Id_categoria, $Periodo)
    {
        $nombre = "";
        $Consulta = "SELECT ce.idCategoria,if(isnull(cea.Nombre_alterno),ce.descCategoria,cea.Nombre_alterno) descCategoria
        FROM c_categoriasdeejes ce
        INNER JOIN k_categoriasdeejes_anios cea on cea.idCategoria=ce.idCategoria
        WHERE ce.nivelCategoria=1 AND cea.Visible=1 AND cea.Anio=$Periodo AND ce.idCategoria=$Id_categoria
        ORDER BY ce.orden";
        $resul_Ac =  $this->catalogo->obtenerLista($Consulta);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $nombre = $row2['descCategoria'];
        }
        return $nombre;
    }
    public function Subcategoria($Id_categoria, $Periodo)
    {
        $nombre = "";
        $Consulta = "SELECT ce.idCategoria,if(isnull(cea.Nombre_alterno),ce.descCategoria,cea.Nombre_alterno) descCategoria
        FROM c_categoriasdeejes ce
        LEFT JOIN k_categoriasdeejes_anios cea on cea.idCategoria=ce.idCategoria
        WHERE  cea.Visible=1 AND cea.Anio=$Periodo AND ce.idCategoria=$Id_categoria
        ORDER BY ce.orden";
        //echo$Consulta;
        $resul_Ac =  $this->catalogo->obtenerLista($Consulta);
        if (mysqli_num_rows($resul_Ac) > 0) {
            while ($row2 = mysqli_fetch_array($resul_Ac)) {
                $nombre =  $row2['descCategoria'];
            }
        } else {
            $nombre = "";
        }
        return $nombre;
    }

    /**
     * Aqui obtenemos toda la informacion con respecto a la actividad
     *
     */
    public function Actividad($Id_actividad, $idCategoria, $idPeriodo)
    {
        $Actividad = array();
        $texto_actividad = "";
        $nombreEncargado = "";
        $textoEntregable = "";
        $link_entregable = "";
        $color = "";
        $tipoEntregable = "";
        $visible = "";

        $Consulta = "SELECT a.IdActividad,if(isnull(aa.Nombre_alterno),a.Nombre,aa.Nombre_alterno) as nombreMeta ,

            CONCAT( '-', SUBSTRING( p.Nombre, 1, 1 ), p.Apellido_Paterno, '(', ar.Nombre, ')' ) encargado,

            if(ISNULL(ch.IdEncargado),ca1.Nombre,ca2.Nombre) AS area_rec,
            if(ISNULL(ch.IdEncargado),CONCAT(SUBSTRING(p1.Nombre, 1, 1),' ',p1.Apellido_Paterno),CONCAT(SUBSTRING(p2.Nombre, 1, 1),' ',p2.Apellido_Paterno)) AS nombrepersona,

            CASE WHEN a.IdTipoActividad = 1 THEN 'Actividad' ELSE 'Meta' END AS tipoActividad,
            CASE WHEN a.IdNivelActividad = 2 THEN 'General' ELSE 'Global' END AS nivelActividad,
            CASE WHEN a.IdNivelActividad = 2 THEN '3614' ELSE '3613' END AS idCheck,
            CASE WHEN ch.Visible != 1 THEN 'desactive' ELSE 'active' END AS class,
            CASE WHEN ch.IdEncargado != '' THEN ch.IdEncargado ELSE a.IdResponsable END AS IdEncargado,
            p_check.id_Personas as encargado_check,ar_check.Id_Area as areaenc_check,
             ch.Entregable  AS nombre_entregable,
            ar.Id_Area,catej.idEje IdEje,CONCAT( aa.Numeracion, if(isnull(aa.Nombre_alterno),a.Nombre,aa.Nombre_alterno)  ) nombreActividad,a.IdActividadSuperior,aa.Archivo,d.ruta,d.pdf,d.id_tipo,ch.Visible
            FROM k_checklist_actividad ch
	INNER JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList
	INNER JOIN c_actividad a on a.IdActividad=ch.IdActividad
	LEFT JOIN c_personas p ON p.id_Personas = a.IdResponsable
	LEFT JOIN c_area ar ON ar.Id_Area = a.IdArea

  left JOIN c_personas p2 ON p2.id_Personas = ch.IdEncargado
  left JOIN c_area ca2 ON ca2.Id_Area = p2.idArea
  left JOIN c_personas p1 ON p1.id_Personas = c.IdResponsable
  left JOIN c_area ca1 ON ca1.Id_Area = p1.idArea

  LEFT JOIN c_personas p_check ON p_check.id_Personas = ch.IdEncargado
  LEFT JOIN c_area ar_check ON ar_check.Id_Area = p_check.IdArea
	LEFT JOIN k_actividad_categoria aa ON aa.IdActividad = a.IdActividad
	LEFT JOIN c_documento d ON d.id_documento = aa.Archivo
  LEFT JOIN c_categoriasdeejes catej ON catej.idCategoria = ch.IdCategoria
	WHERE ((c.Nivel = 3 ) OR ( c.Nivel = 1 )) AND ch.Id_Periodo =$idPeriodo AND ch.IdCategoria=$idCategoria AND ch.IdActividad = $Id_actividad AND 	aa.IdActividad = $Id_actividad
    AND aa.IdCategoria = $idCategoria AND aa.IdPeriodo = $idPeriodo ";
        //echo $Consulta;
        $resul_Ac =  $this->catalogo->obtenerLista($Consulta);
        while ($row = mysqli_fetch_array($resul_Ac)) {
            $texto_actividad = $row['tipoActividad'] . ' ' . $row['nivelActividad'];
            $nombreACME = $row['nombreMeta'];
            $idCheck = $row['idCheck'];

            $nombreEncargado = $row['nombrepersona'] . "(" . $row['area_rec'] . ")";

            $ruta = $row['ruta'] . $row['pdf'];
            $tipoAnterior = $row['id_tipo'];
            $activo = $row['Visible'];
            if ($row['nombre_entregable'] != '') {
                $textoEntregable = $row['nombre_entregable'];
            } else {
                $textoEntregable = 'Sin Info';
            }
            if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                $link_entregable = 'target="_blank" href="' . $row['ruta'] . '"';
            } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                $link_entregable = 'target="_blank" href="' . $ruta . '"';
            } else {
                $link_entregable = "";
            }
            if ($row['id_tipo'] == 9) {
                $color = "dfa739";
                $tipoEntregable = 14;
            } elseif ($row['id_tipo'] == 14) {
                $color = "#dbd909";
                $tipoEntregable = 10;
            } elseif ($row['id_tipo'] == 10) {
                $color = "#33ab15";
                $tipoEntregable = 0;
            } else {
                $color = "red";
                $tipoEntregable = 9;
            }
            array_push($Actividad, $texto_actividad, $nombreACME, $nombreEncargado, $textoEntregable, $row['IdActividad'], $row['IdActividadSuperior'], $row['IdEje'], $row['Id_Area'], $link_entregable, $color, $tipoAnterior, $tipoEntregable, $idCheck, $activo, $row['class'], $row['encargado_check'], $row['areaenc_check']);
            //print_r($Actividad);
        }
        return $Actividad;
    }

    public function get_Avance($Id_periodo, $Id_categoria, $Id_actividad, $Id_check)
    {
        $avance = 0;
        $consulta = "SELECT a.Avance FROM k_checklist_actividad as a WHERE a.Id_Periodo=$Id_periodo AND a.IdActividad=$Id_actividad AND a.IdCategoria=$Id_categoria AND a.IdCheckList=$Id_check";
        $resul_Ac =  $this->catalogo->obtenerLista($consulta);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['Avance'];
        }
        return $avance;
    }

    public function actualizarAvance2022($Id_periodo, $Id_categoria, $Id_actividad, $Id_check, $id_tipo)
    {
        $avance = 0;
        if ($id_tipo == 9) {
            $avance = 25;
        } elseif ($id_tipo == 14) {
            $avance = 50;
        }
        $consulta = "update k_checklist_actividad a set a.Avance=$avance WHERE a.Id_Periodo=$Id_periodo AND a.IdActividad=$Id_actividad AND a.IdCheckList=$Id_check AND a.IdCategoria=$Id_categoria";
        $query = $this->catalogo->ejecutaConsultaActualizacion($consulta, 'k_actividad_categoria', 'IdCategoria = ' . $this->IdCategoria);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    public function get_Encargado($IdEncargado)
    {
        $encargado = "";
        $consulta = "SELECT p.id_Personas, CONCAT( '-', SUBSTRING( p.Nombre, 1, 1 ), p.Apellido_Paterno, '(', ac.Nombre, ')' ) encargado FROM c_personas p INNER JOIN c_area ac on ac.Id_Area=p.idArea WHERE p.id_Personas=$IdEncargado";
        //echo $consulta;
        $resul_Ac =  $this->catalogo->obtenerLista($consulta);
        if (mysqli_num_rows($resul_Ac) > 0) {
            while ($row = mysqli_fetch_array($resul_Ac)) {
                $encargado = $row['encargado'];
            }
        } else {
            $encargado = '-sin info';
        }

        return $encargado;
    }
    public function getMeta($nombreAct, $idCategoria, $Periodo)
    {
        $idActividad = "";
        $consulta = "SELECT aa.IdActividad FROM k_actividad_categoria aa INNER JOIN c_actividad a on a.IdActividad=aa.IdActividad WHERE a.Nombre LIKE '%$nombreAct%' AND aa.IdCategoria=$idCategoria AND aa.IdPeriodo=$Periodo AND a.IdTipoActividad=2";
        // echo $consulta;
        $resul_Ac =  $this->catalogo->obtenerLista($consulta);

        if (mysqli_num_rows($resul_Ac) > 0) {
            while ($row = mysqli_fetch_array($resul_Ac)) {
                $idActividad = $row['IdActividad'];
            }
        } else {
            $idActividad = 'sin info';
        }
        return $idActividad;
    }
}
