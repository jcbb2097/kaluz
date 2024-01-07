<?php

include_once("Catalogo.class.php");

class Indicador_libro
{
    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    public function Planeacion($Libro, $Hoy)
    {
        $data = array();
        $Id_planeacion_pu = "";
        $Nombre_entregable = "";
        $Fecha_planeacion_pu = "";
        $fecha = "";
        $num_avance = "";
        $num_completadas = "";
        $porcentaje = "";
        $lapso = "";
        $Planeacion_publicacion = "SELECT
 cl.IdLibro,
 ceE.IdEntregEspecifico,
 ceE.Descripcion,
 DATE_FORMAT( ceE.FechaPlaneadaFinal, '%Y-%m-%d' ) AS fecha,
 TIMESTAMPDIFF( DAY, '$Hoy', DATE_FORMAT( ceE.FechaPlaneadaFinal, '%Y-%m-%d' ) ) AS dias_trascurridos,
 ( SELECT COUNT( kee.IdCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = cfl.IdEntregableFormatoLibro ) AS avance,
	( SELECT COUNT( kee.IdCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = cfl.IdEntregableFormatoLibro AND kee.Valor = 1 ) AS avance_completado,
	ROUND(
		( SELECT COUNT( kee.IdCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = cfl.IdEntregableFormatoLibro AND kee.Valor = 1 ) * 100 / ( SELECT COUNT( kee.IdCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = cfl.IdEntregableFormatoLibro ) 
	) AS porcentaje,
    CONCAT(doc.ruta,doc.pdf) as doc  
FROM
 c_libro AS cl
 LEFT JOIN c_formatoLibro AS cfl ON cfl.IdLibro = cl.IdLibro
 LEFT JOIN c_entregableEspecifico AS ceE ON ceE.IdEntregEspecifico = cfl.IdEntregableFormatoLibro
 LEFT JOIN c_entregable AS ce ON ce.IdEntregable = ceE.IdEntregable
 INNER JOIN c_actividad AS ac ON cl.IdActividad = ac.IdActividad 
 LEFT JOIN c_documento as doc ON doc.id_documento=ceE.IdArchFinal
WHERE cl.IdLibro=$Libro";
        // echo$Planeacion_publicacion;
        $Result_planeacion = $this->catalogo->obtenerLista($Planeacion_publicacion);
        while ($row = mysqli_fetch_array($Result_planeacion)) {
            $Id_planeacion_pu = $row['IdEntregEspecifico'];
            $Fecha_planeacion_pu = $row['fecha'];
            $lapso = $row['dias_trascurridos'];
            $Nombre_entregable = $row['Descripcion'];
            $num_avance = $row['avance'];
            $num_completadas = $row['avance_completado'];
            $porcentaje = $row['porcentaje'];
            $documento = $row['doc'];

            if ($Fecha_planeacion_pu != "") {
                $fecha = $Fecha_planeacion_pu;
            } else {
                $fecha = "Sin Fecha";
            }
        }
        array_push($data, $num_completadas, $num_avance, $lapso, $porcentaje, $fecha, $Id_planeacion_pu, $Nombre_entregable, $documento);
        return $data;
    }




    public function Textos($Libro, $Hoy, $tipo_texto)
    {
        $datos = array();
        $titulo_texto = "";
        $fecha_texto = "";
        $contador = 0;
        $fecha_actividad = "";
        $Id_texto = "";
        $lapso = "";
        $Id_entregable = "";
        $fecha = "";
        $num_avance = "";
        $num_completadas = "";
        $porcentaje = 0;
        $Consulta = "SELECT
        tl.IdTexto,
        CONCAT( pe.Apellido_Paterno, '-', tl.tituloTexto ) AS nombre,
        tl.IdEntregableTextoFinal,
        ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal ) AS total_avance,
        ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal AND kee.Valor = 1 ) AS total_avance_completado,
        ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal AND kee.Valor = 0 ) AS total_avance_no_completado,
        DATE_FORMAT( ee.FechaPlaneadaFinal, '%Y-%m-%d' ) AS fecha,
        TIMESTAMPDIFF( DAY, '$Hoy', DATE_FORMAT( ee.FechaPlaneadaFinal, '%Y-%m-%d' ) ) AS dias_trascurridos,
        ROUND(
            ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal AND kee.Valor = 1 ) * 100 / ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal ) 
        ) AS porcentaje,
        CONCAT(doc.ruta,doc.pdf) as doc
    FROM
        c_textosLibro AS tl
        LEFT JOIN c_entregableEspecifico AS ee ON ee.IdEntregEspecifico = tl.IdEntregableTextoFinal
        LEFT JOIN c_personas AS pe ON pe.id_Personas = tl.IdAutor
        LEFT JOIN c_documento as doc on doc.id_documento=ee.IdArchFinal 
    WHERE
        tl.IdLibro = $Libro
        AND tl.IdTipoTexto = $tipo_texto
    ORDER BY
        fecha DESC";
        // echo$Consulta;

        $result = $this->catalogo->obtenerLista($Consulta);
        while ($row2 = mysqli_fetch_array($result)) {
            $titulo_texto = $row2['nombre'];
            $Id_texto = $row2['IdTexto'];
            $fecha_texto = $row2['fecha'];
            $Id_entregable = $row2['IdEntregableTextoFinal'];
            $lapso = $row2['dias_trascurridos'];
            $num_completadas = $row2['total_avance_completado'];
            $num_avance = $row2['total_avance'];
            $porcentaje = $row2['porcentaje'];
            $documento = $row2['doc'];


            if ($contador == 0) {
                if ($fecha_texto != '') {
                    $fecha_actividad = $fecha_texto;
                } else {
                    $fecha_actividad = "0000-00-00";
                }
            }

            if ($fecha_texto != '') {
                $fecha = $fecha_texto;
            } else {
                $fecha = "Sin fecha";
            }
            $datos[$titulo_texto] = [$num_completadas, $num_avance, $lapso, $porcentaje, $fecha, $Id_texto, $Id_entregable, $fecha_actividad, $documento];
            $contador++;
        }

        return $datos;
    }
	
	
    public function datos_libro($Id_libro)
    {
        $datos = array();
        $Consulta = "SELECT
        p.id_Personas as autor,
        fl.Titulo,
        fl.Tema,
        fl.LugarPublicacion,
        fl.IdEditorial,
        a.Id_Periodo,
        l.ISBN,
        l.ISSN,
        fl.IdTipoPublicacion
        
    FROM 
	c_libro AS l
        left JOIN c_formatoLibro AS fl ON fl.IdLibro = l.IdLibro 
        LEFT JOIN c_personas as p on p.id_Personas=fl.IdEditorPersona
        INNER JOIN c_periodo as a on a.Periodo=l.AnioPublicacion
    WHERE
        l.IdLibro = $Id_libro";
		
        $result = $this->catalogo->obtenerLista($Consulta);
        while ($row2 = mysqli_fetch_array($result)) {
            $autor = $row2['autor'];
            $titulo = $row2['Titulo'];
            $tema = $row2['Tema'];
            $editorial = $row2['IdEditorial'];
            $ano = $row2['Id_Periodo'];
            $ISBN = $row2['ISBN'];
            $ISSN = $row2['ISSN'];
            $tipo_publicacion = $row2['IdTipoPublicacion'];
            $lugar = $row2['LugarPublicacion'];
            array_push($datos, $autor, $titulo, $tema, $lugar, $editorial, $ano, $ISBN, $ISSN, $tipo_publicacion);
        }
        return $datos;
    }
	
	
    public function Insumo($Id_entregable)
    {
        $num_insumos = 0;
        $areas = array();
        $insumo = "";
        $consulta_insumo = "SELECT DISTINCT
                ari.Nombre as area ,
                COUNT(enti.IdEntregableInsumo) as insumo
            FROM
                c_entregable AS e
                LEFT JOIN c_entregableEspecifico AS ee ON ee.IdEntregable = e.IdEntregable
                LEFT JOIN c_actividad AS a ON a.IdActividad = e.idActividad
                LEFT JOIN k_entregableinsumo AS enti ON enti.IdEntregable = e.IdEntregable
                LEFT JOIN c_entregable AS ei ON ei.IdEntregable = enti.idInsumo
                LEFT JOIN c_actividad AS ai ON ai.IdActividad = ei.idActividad
                LEFT JOIN c_area AS ari ON ai.IdArea = ari.Id_Area 
            WHERE
                ee.IdEntregEspecifico = ari.Id_Area GROUP BY ari.Nombre";
				
        $Result_insumo = $this->catalogo->obtenerLista($consulta_insumo);
        while ($row = mysqli_fetch_array($Result_insumo)) {
            $num_insumos = $num_insumos + $row['insumo'];
            array_push($areas, $row['area']);
        }
        for ($i = 0; $i < count($areas); $i++) {
            if (count($areas) > 1) {
                $insumo =  $insumo . $areas[$i];
                if ($i + 1 < count($areas)) {
                    $insumo = $insumo . " , ";
                }
                if ($i + 1 < count($areas)) {
                    $insumo = $num_insumos . ' / ' . $insumo;
                }
            } else {
                $insumo = $num_insumos . ' / ' . $areas[$i];
            }
        }
        return $insumo;
    }
    public function Indicador_general($Id_libro, $id_eje)
    {
        $data = array();
        $where_1 = "";
        $where_2 = "";

        if ($Id_libro != "" && $id_eje == "") {

            $where_1 = " where l.IdLibro = $Id_libro";
            $where_2 = "  where cl.IdLibro = $Id_libro";
        } else if ($id_eje != "" && $Id_libro == "") {
            $where_1 = " where e.idEje = $id_eje";
            $where_2 = " where e.idEje = $id_eje";
        } else {

            $where_1 = "";
            $where_2 = "";
        }

        $consulta_numeros = "SELECT
        COUNT( cl.IdLibro ) AS total_libro,
        (
        SELECT
            COUNT( tl.IdTexto ) AS texto 
        FROM
            c_textosLibro AS tl
            INNER JOIN c_libro AS l ON l.IdLibro = tl.IdLibro
            INNER JOIN c_actividad AS ac ON l.IdActividad = ac.IdActividad
            INNER JOIN c_eje AS e ON e.idEje = ac.IdEje 
        " . $where_1 . "
        ) AS total_textos 
    FROM
        c_libro AS cl
        LEFT JOIN c_formatoLibro AS cfl ON cfl.IdLibro = cl.IdLibro
        LEFT JOIN c_entregableEspecifico AS ceE ON ceE.IdEntregEspecifico = cfl.IdEntregableFormatoLibro
        LEFT JOIN c_entregable AS ce ON ce.IdEntregable = ceE.IdEntregable
        INNER JOIN c_actividad AS ac ON cl.IdActividad = ac.IdActividad
        INNER JOIN c_eje AS e ON e.idEje = ac.IdEje
        " . $where_2 . "
    ";
        //echo $consulta_numeros;
        $Result = $this->catalogo->obtenerLista($consulta_numeros);
        while ($row = mysqli_fetch_array($Result)) {
            array_push($data, $row['total_libro'], $row['total_textos']);
        }
        return $data;
    }
    public function Porcentaje_libro($libro)
    {
        $avance_texto = 0;
        $avance_total = 0;
        $avance_completado_texto = 0;
        $avance_completado_total = 0;
        $porcentaje_texto = 0;
        $porcentaje_total = 0;
        $tipo_libro = "";
        $porcentajes = array();

        $consulta_textos = "SELECT
        ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal ) AS total_avance,
        ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal AND kee.Valor = 1 ) AS total_avance_completado,
        DATE_FORMAT( ee.FechaPlaneadaFinal, '%Y-%m-%d' ) AS fecha,
        TIMESTAMPDIFF( DAY, NOW(), DATE_FORMAT( ee.FechaPlaneadaFinal, '%Y-%m-%d' ) ) AS dias_trascurridos,
        ROUND(
            ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal AND kee.Valor = 1 ) * 100 / ( SELECT COUNT( kee.IdEntregEspecifCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = tl.IdEntregableTextoFinal ) 
        ) AS porcentaje
    FROM
        c_textosLibro AS tl
        LEFT JOIN c_entregableEspecifico AS ee ON ee.IdEntregEspecifico = tl.IdEntregableTextoFinal
        LEFT JOIN c_personas AS pe ON pe.id_Personas = tl.IdAutor
        LEFT JOIN c_documento AS doc ON doc.id_documento = ee.IdArchFinal 
    WHERE
        tl.IdLibro =$libro
    ORDER BY
        fecha DESC";

        $Result = $this->catalogo->obtenerLista($consulta_textos);
        while ($row1 = mysqli_fetch_array($Result)) {
            $avance_texto = $avance_texto + $row1['total_avance'];
            $avance_completado_texto = $avance_completado_texto + $row1['total_avance_completado'];
            $avance_total = $avance_total + $row1['total_avance'];
            $avance_completado_total = $avance_completado_total + $row1['total_avance_completado'];
        }
        if ($avance_texto != 0) {
            $porcentaje_texto = $avance_completado_texto * 100 / $avance_texto;
        }

        $consulta_libro = "SELECT
        cl.IdLibro,
        DATE_FORMAT( ceE.FechaPlaneadaFinal, '%Y-%m-%d' ) AS fecha,
        TIMESTAMPDIFF( DAY, NOW(), DATE_FORMAT( ceE.FechaPlaneadaFinal, '%Y-%m-%d' ) ) AS dias_trascurridos,
        ( SELECT COUNT( kee.IdCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = cfl.IdEntregableFormatoLibro ) AS avance,
           ( SELECT COUNT( kee.IdCheckList ) FROM k_entregableEspecifCheckList AS kee WHERE kee.IdEntregEspecif = cfl.IdEntregableFormatoLibro AND kee.Valor = 1 ) AS avance_completado,
           cl.IdEstado
       FROM
        c_libro AS cl
        LEFT JOIN c_formatoLibro AS cfl ON cfl.IdLibro = cl.IdLibro
        LEFT JOIN c_entregableEspecifico AS ceE ON ceE.IdEntregEspecifico = cfl.IdEntregableFormatoLibro
        LEFT JOIN c_entregable AS ce ON ce.IdEntregable = ceE.IdEntregable
        INNER JOIN c_actividad AS ac ON cl.IdActividad = ac.IdActividad 
        LEFT JOIN c_documento as doc ON doc.id_documento=ceE.IdArchFinal
       WHERE cl.IdLibro=$libro
       ";
        //echo $consulta_libro;
        $Result = $this->catalogo->obtenerLista($consulta_libro);
        while ($row2 = mysqli_fetch_array($Result)) {
            $avance_total = $avance_total + $row2['avance'];
            $avance_completado_total = $avance_completado_total + $row2['avance_completado'];
            $tipo_libro = $row2['IdEstado'];
        }
        if ($avance_texto != 0) {
            $porcentaje_total = $avance_completado_total * 100 / $avance_total;
        }
        $data_libro = round($porcentaje_total, 1, PHP_ROUND_HALF_UP);
        $data_textos = round($porcentaje_texto, 1, PHP_ROUND_HALF_UP);
        array_push($porcentajes, $data_libro, $data_textos, $tipo_libro);
        return $porcentajes;
    }
}
