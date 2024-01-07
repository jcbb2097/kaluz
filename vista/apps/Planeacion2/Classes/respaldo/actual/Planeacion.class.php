<?php

include_once __DIR__ . "/../../../../WEB-INF/Classes/Catalogo.class.php";
//clase principal de Planeacion
class Planeacion
{
    private $IdLogroAct;
    private $IdEje;
    private $Titulo;
    private $Resumen;
    private $Descripcion;
    private $IdActividad;
    private $Fecha_objetiva;
    private $IdArea;
    private $usuarioCreacion;
    private $fechaCreacion;
    private $usuarioUltimaModificacion;
    private $fechaUltimaModificacion;
    private $pantalla;
    private $IdActividad_2;


    public function __construct()
    {
        $this->catalogo = new Catalogo();
    }

    /*----------------------------------------------------------------------------------------------------*/
    //funcion para sacar los entregables de la vista por eje
    public function Vista_entregables_eje($Eje, $Tipo, $Id_periodo, $Periodo)
    {
        $entregables = 0;
        $totales = array();
        $Avance = 0;
        $total_avance = 0;
        $totalEntregable = 0;
        $ids = $this->get_categorias_eje($Eje, $Tipo, $Periodo);

        for ($i = 0; $i < count($ids); $i++) {
            $idcategoria = $this->get_categorias($ids[$i], $Tipo, $Periodo);
            $Resultados = $this->Entregables_categoria($idcategoria, $Tipo, $Id_periodo, $Periodo);
            $entregables = $entregables += $Resultados[0];
            $Avance = $Avance += $Resultados[2];
            $totalEntregable = $totalEntregable += $Resultados[1];
        }
        if(count($ids) == 0){
          $total_avance = 0;
        }else{
          $total_avance = $Avance / count($ids);
        }

        array_push($totales, $entregables, $total_avance, $totalEntregable);
        return $totales;
    }


    //id periodo a period
    public function periodo($Anio)
    {
        $consulta = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo p WHERE p.Periodo=$Anio OR p.Id_Periodo=$Anio";
        $periodo = array();
        $resul_Ac = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resul_Ac)) {
            array_push($periodo, $row['Id_Periodo'], $row['Periodo']);
        }

        return $periodo;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //id periodo a period
    public function Subcategorias_planeacion($Idcate, $Anio, $ACME,$visible)
    {
        $avance = 0;
        if($visible == 0){
          $wherevisible = "";
        }else{
          $wherevisible = "AND ca.Visible<>0";
        }
        $consulta_acti = "SELECT
        COUNT( c.idCategoria ) sub
    FROM
        c_categoriasdeejes c
        LEFT JOIN k_categoriasdeejes_anios ca on ca.idCategoria=c.idCategoria
        INNER JOIN c_periodo p on p.Periodo=ca.Anio
    WHERE
        c.idCategoriaPadre = $Idcate AND p.Id_Periodo=$Anio  AND ca.ACME=$ACME";
        //echo$consulta_acti.'<BR>';
        $resul_Ac = $this->catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['sub'];
        }
        return $avance;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //conseguir actividades G o ge para las categorias
    public function Actividades_planeacion($Idcate, $tipo, $nivel, $periodo,$visibilidad)
    {
        $avance = 0;
        $ids = array();
        array_push($ids, $Idcate);
        $consulta_sub = "SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Idcate  order by orden";
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        if($visibilidad == 1){
          $where_activo = " AND ca.Activo=1 ";
        }else{
          $where_activo = "  ";
        }

        $consulta = "SELECT COUNT(a.IdActividad)as acti
        FROM c_actividad a
        INNER JOIN k_actividad_categoria ca on ca.IdActividad=a.IdActividad
        WHERE  ca.IdPeriodo=$periodo $where_activo  AND a.IdNivelActividad=$nivel
        AND a.IdTipoActividad=$tipo AND ca.idCategoria in($IdsDeCategoria)";
        //echo$consulta.'<br>';
        $resul_Ac =  $this->catalogo->obtenerLista($consulta);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['acti'];
        }
        return $avance;
    }
    /*----------------------------------------------------------------------------------------------------*/

    //id periodo a period

    public function Entregables_categoria_planeacion($Id_categoria, $Tipo, $Id_Periodo, $Periodo)
    {
        $totales = array();
        $ids = $this->get_categorias($Id_categoria, $Tipo, $Periodo);
        $totales = $this->Entregables_categoria($ids, $Tipo, $Id_Periodo, $Periodo);
        //print_r($totales) . "<br>";
        return $totales;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function Entregables_categoria($Id_categoria, $Tipo, $Id_Periodo, $Periodo)
    {
        $resultados = array();
        $Total_entregables = 0;
        $Total_entregables_c = 0;
        $Avance = 0;
        $consulta = "SELECT
        COUNT(cha.IdCheckList) entregables,AVG(cha.Avance)avance,(SELECT
        COUNT(cha.IdCheckList) entregables FROM
        k_checklist_actividad cha
        INNER JOIN c_checkList ch ON ch.IdCheckList = cha.IdCheckList
        INNER JOIN c_actividad a on a.IdActividad=cha.IdActividad
        INNER JOIN k_categoriasdeejes_anios aa on aa.idCategoria=cha.IdCategoria
    WHERE
         cha.Visible = 1  AND cha.Id_Periodo = $Id_Periodo
        AND cha.IdCategoria IN ($Id_categoria ) AND (aa.ACME=$Tipo AND aa.Visible=1 AND aa.Anio=$Periodo)
        AND a.IdTipoActividad=$Tipo and cha.Avance=100 AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3))  )as entregables_com
    FROM
        k_checklist_actividad cha
        INNER JOIN c_checkList ch ON ch.IdCheckList = cha.IdCheckList
        INNER JOIN c_actividad a on a.IdActividad=cha.IdActividad
        INNER JOIN k_categoriasdeejes_anios aa on aa.idCategoria=cha.IdCategoria
    WHERE
       cha.Visible = 1 AND cha.Id_Periodo = $Id_Periodo  AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3))
        AND cha.IdCategoria IN ($Id_categoria) AND (aa.ACME=$Tipo AND aa.Visible=1 AND aa.Anio=$Periodo)
        AND a.IdTipoActividad=$Tipo";
        //echo '<br>'.$consulta.'<br>';

        $resul_Ac =  $this->catalogo->obtenerLista($consulta);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {

            $Total_entregables = $row2['entregables'];
            $Total_entregables_c = $row2['entregables_com'];
            if ($row2['avance'] > 0) {
                $Avance = $row2['avance'];
            }

            array_push($resultados, $Total_entregables, $Total_entregables_c, round($Avance));
        }
        return $resultados;
    }

    public function actividad_general_planeacion($Id_actividad, $ACME, $Periodo)
    {
        $avance = 0;
        $consulta_acti = "SELECT COUNT(a.IdActividad) total
      FROM c_actividad a

      WHERE a.IdActividadSuperior=$Id_actividad
      AND a.IdNivelActividad=2 AND a.IdTipoActividad=$ACME ;";
        //echo "<br>AcGe:".$consulta_acti;
        $resul_Ac = $this->catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['total'];
        }
        return $avance;
    }
    /*----------------------------------------------------------------------------------------------------*/
    /**
     * ?metodo para obtener el avance de la actividad o meta
     * 
     */
    public function avance($IdActividad, $periodo, $idcategoria)
    {
        $avance = 0;
        $consulta = "SELECT AVG(ca.Avance) avance  FROM k_checklist_actividad ca left JOIN c_checkList c ON c.IdCheckList = ca.IdCheckList LEFT JOIN c_documento d on d.id_documento=ca.Archivo WHERE ca.IdActividad=$IdActividad AND ca.Id_Periodo=$periodo AND ca.IdCategoria=$idcategoria  AND ca.Visible=1 AND ((c.Nivel=2) OR (c.Nivel=1 AND c.Tipo=1)or (c.Nivel=3)) ";
        //echo$consulta;
        $resultado = $this->catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            if ($row['avance'] > 0) {
                $avance = $row['avance'];
            }
        }
        return $avance;
    }


    public function get_categorias($idcategoria, $tipo, $anio)
    {
        $ids = array();
        array_push($ids, $idcategoria);
        $consulta_sub = "SELECT
        ca.idCategoria
    FROM
        c_categoriasdeejes ca
        LEFT JOIN k_categoriasdeejes_anios caa ON caa.idCategoria = ca.idCategoria
        WHERE caa.Visible=1 AND caa.ACME=$tipo AND caa.Anio=$anio AND ca.idCategoriaPadre=$idcategoria";
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }
    public function get_categorias_eje($ideje, $ACME, $idPeriodo)
    {
        $ids = array();
        $consulta_sub = "SELECT
        *
    FROM
        c_categoriasdeejes ce
        INNER JOIN k_categoriasdeejes_anios a ON a.idCategoria = ce.idCategoria
    WHERE
        ce.idEje = $ideje
        AND ce.nivelCategoria = 1 AND a.ACME=$ACME AND a.Anio=$idPeriodo AND a.Visible=1";
        //echo $consulta_sub;
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
        }

        return $ids;
    }

    public function get_actividad($id_actividad, $tipo, $periodo)
    {
        $ids = array();
        array_push($ids, $id_actividad);
        $consulta_sub = "SELECT
        a.IdActividad
    FROM
        c_actividad AS a
        left JOIN k_actividad_anios aa on aa.IdActividad=a.IdActividad
    WHERE
        a.IdActividadSuperior = $id_actividad
        AND a.IdTipoActividad = $tipo
     AND aa.Visible=1  AND aa.Anio=$periodo";
        //echo$consulta_sub;
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['IdActividad']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }
    public function get_check($id_check)
    {
        $ids = array();
        array_push($ids, $id_check);
        $consulta_sub = "SELECT ch.IdCheckList FROM c_checkList ch WHERE ch.IdCheckListPadre=$id_check";
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['IdCheckList']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function Entregables_actividad_planeacion($Id_categoria, $Tipo, $Id_Periodo, $Periodo, $Id_actividad)
    {
        //echo$Id_actividad;
        $totales = array();
        $ids = $this->get_actividad($Id_actividad, $Tipo, $Periodo);
        echo$ids;
        //echo$ids;
        $totales = $this->Entregables_actividad($Id_categoria, $ids, $Tipo, $Id_Periodo, $Periodo);
        return $totales;
    }
    /*----------------------------------------------------------------------------------------------------*/

    public function Entregables_actividad($Id_categoria, $Id_actividad, $Tipo, $Id_Periodo, $Periodo)
    {
        $entregables = 0;
        $entregables_com = 0;
        $avance = 0;
        $resultado = array();
        $consulta = "SELECT
        COUNT(cha.IdCheckList) entregables,AVG(cha.Avance)avance,(SELECT
        COUNT(cha.IdCheckList) entregables FROM k_checklist_actividad cha
            INNER JOIN k_actividad_categoria ac on ac.IdActividad=cha.IdActividad
            INNER JOIN c_actividad a on a.IdActividad=ac.IdActividad
            INNER JOIN c_checkList ch on ch.IdCheckList=cha.IdCheckList
            WHERE (a.IdTipoActividad=$Tipo) AND (ac.IdPeriodo=$Id_Periodo AND ac.Activo=1 AND ac.IdCategoria =$Id_categoria) AND
            (cha.Id_Periodo=$Id_Periodo AND cha.Visible=1 AND cha.IdCategoria =$Id_categoria AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3))   AND cha.Avance=100 AND cha.IdActividad in($Id_actividad)))as entregables_com
        FROM
            k_checklist_actividad cha
            INNER JOIN k_actividad_categoria ac on ac.IdActividad=cha.IdActividad
            INNER JOIN c_actividad a on a.IdActividad=ac.IdActividad
            INNER JOIN c_checkList ch on ch.IdCheckList=cha.IdCheckList
            WHERE (a.IdTipoActividad=$Tipo) AND (ac.IdPeriodo=$Id_Periodo AND ac.Activo=1 AND ac.IdCategoria =$Id_categoria) AND
            (cha.Id_Periodo=$Id_Periodo AND cha.Visible=1 AND cha.IdCategoria =$Id_categoria AND ((ch.Nivel = 2 ) OR ( ch.Nivel = 1 AND ch.Tipo = 1 )OR(ch.Nivel=3))   AND cha.IdActividad in($Id_actividad))";
        $resul_Ac =  $this->catalogo->obtenerLista($consulta);

        //echo$consulta;
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $entregables = $row2['entregables'];
            if ($row2['avance'] > 0) {
                $avance = $row2['avance'];
            }
            $entregables_com = $row2['entregables_com'];
            array_push($resultado, $entregables, $entregables_com, $avance);
        }
        return $resultado;
    }
    public function get_ACME($id_actividad)
    {
        $ids = array();
        array_push($ids, $id_actividad);
        $consulta_sub = "SELECT a.IdActividad FROM c_actividad a WHERE a.IdActividadSuperior=$id_actividad";
        $resul =  $this->catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['IdActividad']);
            }
        }
        $IdsDeCategoria = ""; //se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
        for ($i = 0; $i < count($ids); $i++) {
            $micoma = "";
            if ($i == 0) {
                $miComa = "";
            } else {
                $miComa = ",";
            } //Solo la primera vez se concatena la coma cbc
            $IdsDeCategoria .= $miComa . $ids[$i]; //Se concatena el ID de Categoria cbc
        }
        return $IdsDeCategoria;
    }
    //validacion de check
}
