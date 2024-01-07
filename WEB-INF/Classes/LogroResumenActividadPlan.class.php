<?php
include_once("Catalogo.class.php");
class Logro_actividad
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
    /*----------------------------------------------------------------------------------------------------*/
    public function getLogro()
    {
        $catalogo = new Catalogo();
        $consulta_logro = "SELECT * FROM c_logrosActividadesPLAN as la WHERE la.IdLogroActividad=" . $this->IdLogroAct;
        $result_logro = $catalogo->obtenerLista($consulta_logro);
        while ($row = mysqli_fetch_array($result_logro)) {
            $this->IdEje = $row['IdEje'];
            $this->Titulo = $row['Titulo'];
            $this->IdActividad = $row['IdActividad'];
            $this->Fecha_objetiva = $row['Fecha_objetiva'];
            $this->IdArea = $row['IdArea'];
            $this->usuarioCreacion = $row['usuarioCreacion'];
            $this->fechaCreacion = $row['fechaCreacion'];
            $this->usuarioUltimaModificacion = $row['usuarioUltimaModificacion'];
            $this->fechaUltimaModificacion = $row['fechaUltimaModificacion'];
            $this->pantalla = $row['pantalla'];
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function nuevoLogro()
    {
        $catalogo = new Catalogo();
        $insert = "INSERT INTO c_logrosActividadesPLAN (IdEje,Titulo,IdActividad,Fecha_objetiva,IdArea,
                    usuarioCreacion,fechaCreacion,usuarioUltimaModificacion,fechaUltimaModificacion,pantalla)
                    VALUES (" . $this->IdEje . ",'" . $this->Titulo . "',$this->IdActividad,'" . $this->Fecha_objetiva . "'," . $this->IdArea . ",
                            '" . $this->usuarioCreacion . "',now(),'" . $this->usuarioUltimaModificacion . "',now(),'" . $this->pantalla . "');";
        $this->IdLogroAct = $catalogo->insertarRegistro($insert);
        //echo "<br><br>$insert<br><br>";
        if ($this->IdLogroAct == 0 || $this->IdLogroAct == null) {
            return false;
        }
        return true;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function editarLogro()
    {
        $catalogo = new Catalogo();
        $consulta = "
                    UPDATE c_logrosActividadesPLAN SET
                    Titulo='" . $this->Titulo . "',
                    usuarioUltimaModificacion='" . $this->usuarioUltimaModificacion . "',
                    FechaUltimaModificacion=NOW()
                    where IdLogroActividad = $this->IdLogroAct
                    ";

        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_logrosActividadesPLAN', 'IdLogroActividad=' . $this->IdLogroAct);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    public function eliminarLogro()
    {
        $catalogo = new Catalogo();
        $consulta = "DELETE FROM c_logrosActividadesPLAN WHERE IdLogroActividad = $this->IdLogroAct;";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, "c_logrosActividadesPLAN", "IdLogroActividad=" . $this->IdLogroAct);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }

    /*----------------------------------------------------------------------------------------------------*/

    public function avance($IdActividad, $periodo)
    {
        $total_check = 0;
        $total_check_v = 0;
        $avance = 0;
        $catalogo = new Catalogo();
        $consulta = "SELECT c.IdCheckList,ca.Avance FROM k_checklist_actividad ca left JOIN c_checkList c ON c.IdCheckList = ca.IdCheckList LEFT JOIN c_documento d on d.id_documento=ca.Archivo WHERE ca.IdActividad=$IdActividad AND ca.Id_Periodo=$periodo AND Nivel=1";
        //echo$consulta;
        $resultado = $catalogo->obtenerLista($consulta);
        while ($row = mysqli_fetch_array($resultado)) {
            $total_check++;
            $total_check_v = $total_check_v += $row['Avance'];
        }
        if ($total_check > 0) {
            $avance = $total_check_v  / $total_check;
        }

        return $avance;
    }

    /*----------------------------------------------------------------------------------------------------*/


    public function Actividades($Idcate, $tipo, $nivel)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $ids = array();
        $consulta_sub = "SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Idcate  order by orden";
        $resul = $catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
            for ($i = 0; $i < count($ids); $i++) {
                $consulta_acti = "SELECT COUNT(a.IdActividad) actividades FROM c_actividad a WHERE a.Idcategoria=$ids[$i] AND a.IdTipoActividad=$tipo AND a.visible_plan=1 AND a.IdNivelActividad=$nivel";
                //echo "<br>QryAct1:".$consulta_acti;
                $resul_Ac = $catalogo->obtenerLista($consulta_acti);
                while ($row2 = mysqli_fetch_array($resul_Ac)) {
                    $avance = $avance += $row2['actividades'];
                }
            }
        } else {
            $consulta_acti = "SELECT COUNT(a.IdActividad) actividades FROM c_actividad a WHERE a.Idcategoria=$Idcate AND a.IdTipoActividad=$tipo AND a.visible_plan=1 AND a.IdNivelActividad=$nivel";
            //echo "<br>QryAct2:".$consulta_acti;
            $resul_Ac = $catalogo->obtenerLista($consulta_acti);
            while ($row2 = mysqli_fetch_array($resul_Ac)) {
                $avance = $avance += $row2['actividades'];
            }
        }

        return $avance;
    }

    /*----------------------------------------------------------------------------------------------------*/


    public function Entregables($Idcate, $tipo)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $ids = array();
        $consulta_sub = "SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Idcate order by orden";
        $resul = $catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
            for ($i = 0; $i < count($ids); $i++) {
                $consulta_acti = "SELECT COUNT( a.IdActividad ) actividades FROM c_actividad a LEFT JOIN k_archivoactividad ka on ka.id_actividad=a.IdActividad LEFT JOIN c_documento d on d.id_documento=ka.id_archivo
                WHERE a.Idcategoria = $ids[$i] AND a.IdTipoActividad = $tipo AND d.id_tipo=10";
                //echo$consulta_acti;
                $resul_Ac = $catalogo->obtenerLista($consulta_acti);
                while ($row2 = mysqli_fetch_array($resul_Ac)) {
                    $avance = $avance += $row2['actividades'];
                }
            }
        } else {
            $consulta_acti = "SELECT COUNT( a.IdActividad ) actividades FROM c_actividad a LEFT JOIN k_archivoactividad ka on ka.id_actividad=a.IdActividad LEFT JOIN c_documento d on d.id_documento=ka.id_archivo
            WHERE a.Idcategoria = $Idcate AND a.IdTipoActividad = $tipo AND d.id_tipo=10";
            //echo $consulta_acti;
            $resul_Ac = $catalogo->obtenerLista($consulta_acti);
            while ($row2 = mysqli_fetch_array($resul_Ac)) {
                $avance = $avance += $row2['actividades'];
            }
        }

        return $avance;
    }
    /*----------------------------------------------------------------------------------------------------*/

    //validaciones para la tabla
    public function subcate($Idcate)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $consulta_acti = "SELECT COUNT(c.idCategoria) sub FROM c_categoriasdeejes c WHERE c.idCategoriaPadre=$Idcate order by orden";
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['sub'];
        }
        return $avance;
    }

    public function ac_general($Id_actividad, $ACME)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $consulta_acti = "SELECT COUNT(a.IdActividad) total FROM c_actividad a WHERE a.IdActividadSuperior=$Id_actividad AND a.IdNivelActividad=2 AND a.IdTipoActividad=$ACME AND a.visible_plan=1";
        //echo $consulta_acti;
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['total'];
        }
        return $avance;
    }


    //fin de validaciones para la tabla
    /*----------------------------------------------------------------------------------------------------*/


    public function totales_categoria($Idcate, $tipo)
    {
        $catalogo = new Catalogo();
        $entregables = 0;
        $entregables_com = 0;
        $totales = array();
        $ids = array();
        $consulta_sub = "SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Idcate order by orden";
        $resul = $catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
            for ($i = 0; $i < count($ids); $i++) {
                $consulta_acti = "SELECT
                a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad,pl.IdLogroActividad,ce.idCategoria,ce.idCategoriaPadre,(
                SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
                WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1) check_list ,(
                SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
                WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1 and ka.Avance=100) check_list_com
            FROM c_actividad a LEFT JOIN c_logrosActividadesPLAN pl ON pl.IdActividad = a.IdActividad LEFT JOIN c_categoriasdeejes ce ON ce.idCategoria = a.Idcategoria 
            WHERE a.Idcategoria = $ids[$i] AND a.IdTipoActividad = $tipo";
                //echo$consulta_acti;
                $resul_Ac = $catalogo->obtenerLista($consulta_acti);
                while ($row2 = mysqli_fetch_array($resul_Ac)) {
                    $entregables = $entregables += $row2['check_list'];
                    $entregables_com = $entregables_com += $row2['check_list_com'];
                }
            }
            array_push($totales, $entregables, $entregables_com);
        } else {
            $consulta_acti = "SELECT
            a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad,pl.IdLogroActividad,ce.idCategoria,ce.idCategoriaPadre,(
            SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
            WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1) check_list ,(
            SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
            WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1 and ka.Avance=100) check_list_com
        FROM c_actividad a LEFT JOIN c_logrosActividadesPLAN pl ON pl.IdActividad = a.IdActividad LEFT JOIN c_categoriasdeejes ce ON ce.idCategoria = a.Idcategoria 
        WHERE a.Idcategoria = $Idcate AND a.IdTipoActividad = $tipo";
            //echo $consulta_acti;
            $resul_Ac = $catalogo->obtenerLista($consulta_acti);
            while ($row2 = mysqli_fetch_array($resul_Ac)) {
                $entregables = $entregables += $row2['check_list'];
                $entregables_com = $entregables_com += $row2['check_list_com'];
            }
            array_push($totales, $entregables, $entregables_com);
        }
        return $totales;
    }
    /*----------------------------------------------------------------------------------------------------*/

    public function subcategoria($Idcate)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $consulta_acti = "SELECT COUNT(c.idCategoria) sub FROM c_categoriasdeejes c WHERE c.idCategoriaPadre=$Idcate order by orden";
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['sub'];
        }
        return $avance;
    }

    /*--------cbc--15feb-----------------------------------------------*/
    public function Entregables_categoria($Idcate, $tipo)
    {
        //echo "<br>[Entregable_categoria:".$Idcate."]";
        $periodo=9; //esta variable no existe hay que crearla!!!!!!! 9=al año 2021
        $catalogo = new Catalogo();
        $entregables = 0;
        $entregables_com = 0;
        $entregables_conAvance=0; //agregado por cbc para guardar solo los entregables con avance.
        $totales = array();
        $ids = array();
        $consulta_sub = "SELECT ce.idCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Idcate  order by orden";

        $resul = $catalogo->obtenerLista($consulta_sub);
        if (mysqli_num_rows($resul) > 0) {
            while ($row = mysqli_fetch_array($resul)) {
                array_push($ids, $row['idCategoria']);
            }
            $IdsDeCategoria="";//se inicializa variable que contendrá los ID de categoria que se usarán en el query cbc
            for ($i = 0; $i < count($ids); $i++) {
                /*$consulta_acti = "SELECT
                a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad,pl.IdLogroActividad,ce.idCategoria,ce.idCategoriaPadre,(
                SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
                WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1) check_list ,(
                SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
                WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1 and ka.Avance=100) check_list_com
                FROM c_actividad a LEFT JOIN c_logrosActividadesPLAN pl ON pl.IdActividad = a.IdActividad LEFT JOIN c_categoriasdeejes ce ON ce.idCategoria = a.Idcategoria 
                WHERE a.Idcategoria = $ids[$i] AND a.IdTipoActividad = $tipo and a.visible_plan=1";
                
                //echo$consulta_acti;
                $resul_Ac = $catalogo->obtenerLista($consulta_acti);
                while ($row2 = mysqli_fetch_array($resul_Ac)) {
                    $entregables = $entregables += $row2['check_list'];
                    $entregables_com = $entregables_com += $row2['check_list_com'];
                }
                */
                $micoma="";
                if ($i==0) {$miComa="";} else {$miComa=",";} //Solo la primera vez se concatena la coma cbc
                $IdsDeCategoria.=$miComa.$ids[$i]; //Se concatena el ID de Categoria cbc
            }//for
                //Cambiada por cbarron 9feb2022 para calcular diferente avance
                //se usa subquery para traer los entregables que tienen avance mayor a CERO
                $consulta_acti = "SELECT 
                
                (SELECT COUNT(*)
                    FROM k_checklist_actividad cha
                    JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                    JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                    JOIN c_categoriasdeejes ce ON ce.idCategoria=a.Idcategoria
                    WHERE 
                    (a.visible_plan=1 AND a.Periodo=$periodo) AND 
                    ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1)) AND ce.idCategoria IN ($IdsDeCategoria) AND a.IdTipoActividad=$tipo AND cha.Avance>0
                
                ) AS  check_list_conAvance,
                COUNT(*) AS check_list, avg(cha.Avance) check_list_com
                FROM k_checklist_actividad cha
                JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                JOIN c_categoriasdeejes ce ON ce.idCategoria=a.Idcategoria
                WHERE 
                (a.visible_plan=1 AND a.Periodo=$periodo) AND 
                ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1)) AND ce.idCategoria in ($IdsDeCategoria) AND a.IdTipoActividad=$tipo;
                ";
                //echo "<br>Qry1:".$consulta_acti;
                $resul_Ac = $catalogo->obtenerLista($consulta_acti);
                while ($row2 = mysqli_fetch_array($resul_Ac)) {
                    $entregables = $entregables += $row2['check_list'];
                    $entregables_com = $entregables_com += $row2['check_list_com'];
                    $entregables_conAvance = $row2['check_list_conAvance'];
                }

            array_push($totales, $entregables, $entregables_com, $entregables_conAvance);
        } else {
            /*$consulta_acti = "SELECT
            a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad,pl.IdLogroActividad,ce.idCategoria,ce.idCategoriaPadre,(
            SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
            WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1) check_list ,(
            SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList
            WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1 and ka.Avance=100) check_list_com
            FROM c_actividad a LEFT JOIN c_logrosActividadesPLAN pl ON pl.IdActividad = a.IdActividad LEFT JOIN c_categoriasdeejes ce ON ce.idCategoria = a.Idcategoria 
            WHERE a.Idcategoria = $Idcate AND a.IdTipoActividad = $tipo and a.visible_plan=1";
            */

            $consulta_acti = "SELECT 
                            
            (SELECT COUNT(*)
                FROM k_checklist_actividad cha
                JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                JOIN c_categoriasdeejes ce ON ce.idCategoria=a.Idcategoria
                WHERE 
                (a.visible_plan=1 AND a.Periodo=$periodo) AND 
                ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1)) AND ce.idCategoria IN ($Idcate) AND a.IdTipoActividad=$tipo AND cha.Avance>0

            ) AS  check_list_conAvance,
            COUNT(*) AS check_list, avg(cha.Avance) check_list_com
            FROM k_checklist_actividad cha
            JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
            JOIN c_actividad a ON a.IdActividad=cha.IdActividad
            JOIN c_categoriasdeejes ce ON ce.idCategoria=a.Idcategoria
            WHERE 
            (a.visible_plan=1 AND a.Periodo=$periodo) AND 
            ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1)) AND ce.idCategoria in ($Idcate) AND a.IdTipoActividad=$tipo;
            ";

            //echo "<br>Qry2:".$consulta_acti;
            $resul_Ac = $catalogo->obtenerLista($consulta_acti);
            while ($row2 = mysqli_fetch_array($resul_Ac)) {
                $entregables = $entregables += $row2['check_list'];
                $entregables_com = $entregables_com += $row2['check_list_com'];
                $entregables_conAvance = $row2['check_list_conAvance'];
            }
            array_push($totales, $entregables, $entregables_com, $entregables_conAvance);
        }
        return $totales;
    }

    /*---------cbc------------------------------------------------*/
    public function actividad_general($Id_actividad, $ACME)
    {
        $catalogo = new Catalogo();
        $avance = 0;
        $consulta_acti = "SELECT COUNT(a.IdActividad) total FROM c_actividad a WHERE a.IdActividadSuperior=$Id_actividad AND a.IdNivelActividad=2 AND a.IdTipoActividad=$ACME AND a.visible_plan=1";
        //echo$consulta_acti;
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $avance = $row2['total'];
        }
        return $avance;
    }
    public function Total_entregables($Id_actividad, $ACME, $Periodo)
    {
        $catalogo = new Catalogo();
        $entregables = array();
        $consulta_actividad_general = "SELECT
        COUNT( ca.IdCheckList ) Total_check,

        (SELECT avg(ca2.Avance) 
        FROM k_checklist_actividad ca2 
        INNER JOIN c_actividad a2 ON a2.IdActividad=ca2.IdActividad 
        INNER JOIN c_checkList ch2 ON ch2.IdCheckList=ca2.IdCheckList
        WHERE a2.IdActividad=$Id_actividad AND a2.IdTipoActividad=$ACME  
        AND ca2.Id_Periodo=$Periodo AND ch2.Nivel=1 AND a2.visible_plan=1) Total_check_a, 

        (SELECT COUNT( ca3.IdCheckList) 
        FROM k_checklist_actividad ca3 
        INNER JOIN c_actividad a3 ON a3.IdActividad=ca3.IdActividad 
        INNER JOIN c_checkList ch3 on ch3.IdCheckList=ca3.IdCheckList 
        WHERE ca3.Avance >0 AND a3.IdActividad=$Id_actividad AND a3.IdTipoActividad=$ACME  
        AND ca3.Id_Periodo=$Periodo AND ch3.Nivel=1 AND a3.visible_plan=1) Total_check_b 

        FROM  k_checklist_actividad AS ca
        INNER JOIN c_actividad a ON a.IdActividad = ca.IdActividad
        INNER JOIN c_checkList ch on ch.IdCheckList=ca.IdCheckList
        WHERE a.IdActividad=$Id_actividad AND a.IdTipoActividad= $ACME AND ca.Id_Periodo=$Periodo AND ch.Nivel=1 and a.visible_plan=1";

$consulta_actividad_general = "SELECT
COUNT( ca.IdCheckList ) Total_check,

(SELECT avg(ca2.Avance) 
FROM k_checklist_actividad ca2 
INNER JOIN c_actividad a2 ON a2.IdActividad=ca2.IdActividad 
INNER JOIN c_checkList ch2 ON ch2.IdCheckList=ca2.IdCheckList
WHERE (a2.IdActividad=$Id_actividad OR a2.IdActividadSuperior=$Id_actividad) AND 
(
  (a2.IdTipoActividad=$ACME AND a2.visible_plan=1) AND 
  ((ch2.Nivel=2) OR (ch2.Nivel=1 AND ch2.Tipo=1))
)
) Total_check_a, 

(SELECT COUNT( ca3.IdCheckList) 
FROM k_checklist_actividad ca3 
INNER JOIN c_actividad a3 ON a3.IdActividad=ca3.IdActividad 
INNER JOIN c_checkList ch3 on ch3.IdCheckList=ca3.IdCheckList 
WHERE ca3.Avance >0 AND (a3.IdActividad=$Id_actividad OR a3.IdActividadSuperior=$Id_actividad ) AND 
(
  (a3.IdTipoActividad=$ACME AND a3.visible_plan=1) AND 
  ((ch3.Nivel=2) OR (ch3.Nivel=1 AND ch3.Tipo=1))
)
) Total_check_b 

FROM  k_checklist_actividad AS ca
INNER JOIN c_actividad a ON a.IdActividad = ca.IdActividad
INNER JOIN c_checkList ch on ch.IdCheckList=ca.IdCheckList
WHERE (a.IdActividad=$Id_actividad OR a.IdActividadSuperior=$Id_actividad) AND 
(
  (a.IdTipoActividad=$ACME AND a.visible_plan=1) AND 
  ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1)) 
)";

        $resul_Ac = $catalogo->obtenerLista($consulta_actividad_general);
        //echo "<br>QryTotEnt:".$consulta_actividad_general;
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            array_push($entregables, $row2['Total_check'], $row2['Total_check_a'],$row2['Total_check_b'] );
        }
        return $entregables;
    }
    //funcion para obtener el total de las actividades generales
    public function Id_general($Id_actividad, $ACME)
    {
        $catalogo = new Catalogo();
        $avance = array();
        $consulta_acti = "SELECT a.IdActividad FROM c_actividad a WHERE a.IdActividadSuperior=$Id_actividad AND a.IdNivelActividad=2 AND a.IdTipoActividad=$ACME AND a.visible_plan=1";
        //echo$consulta_acti;
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            array_push($avance, $row2['IdActividad']);
        }
        return $avance;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //funcion para obtener el total de las actividades generales
    public function Entregables_subcategoria($Idcate, $tipo)
    {
        $catalogo = new Catalogo();
        $totales = 0;
        $consulta_acti = "SELECT 
        COUNT(a.IdActividad) check_ac
        FROM
            c_categoriasdeejes ce 
            LEFT JOIN c_actividad a on a.Idcategoria=ce.idCategoria 
            LEFT JOIN k_checklist_actividad ca on ca.IdActividad=a.IdActividad
            WHERE ce.idCategoria=$Idcate AND a.IdTipoActividad=$tipo";
        //echo $consulta_acti;
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $totales = $row2['check_ac'];
        }


        return $totales;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //funcion para activar o desactivar AC_ME
    public function Activa_padre($Id, $tipo)
    {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_actividad as a set a.visible_plan=$tipo WHERE a.IdActividad=$Id";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_actividad', 'IdActividad=' . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //funcion para activar o desactivar AC_ME
    public function Activa_hijo($Id, $tipo)
    {
        $catalogo = new Catalogo();
        $consulta = "UPDATE c_actividad as a set a.visible_plan=$tipo WHERE  a.IdActividadSuperior=$Id";
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_actividad', 'IdActividad=' . $this->IdActividad);
        //echo "<br><br>$consulta<br><br>";
        if ($query == 1) {
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------*/
    //funcion para sacar los entregables del eje
    public function Entregables_eje($eje, $tipo,$Periodo)
    {
        $catalogo = new Catalogo();
        $entregables = 0;
        $entregables_com = 0;
        $totales = array();
        /*$consulta_acti = "SELECT
        (SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList LEFT JOIN c_actividad ac on ac.IdActividad=ka.IdActividad
        WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1 AND ka.Id_Periodo=$Periodo AND ac.IdTipoActividad=$tipo) check_list ,(
        SELECT COUNT( ka.IdCheckList ) FROM k_checklist_actividad ka LEFT JOIN c_checkList ch on ch.IdCheckList=ka.IdCheckList LEFT JOIN c_actividad ac on ac.IdActividad=ka.IdActividad
        WHERE ka.IdActividad = a.IdActividad AND ch.Nivel=1 and ka.Avance=100 AND ka.Id_Periodo=$Periodo AND ac.IdTipoActividad=$tipo) check_list_com
        FROM c_actividad a LEFT JOIN c_logrosActividadesPLAN pl ON pl.IdActividad = a.IdActividad LEFT JOIN c_categoriasdeejes ce ON ce.idCategoria = a.Idcategoria 
        WHERE ce.idEje=$eje AND a.IdTipoActividad = $tipo and a.visible_plan=1 AND a.Periodo=$Periodo";
        */

        //Consulta modificada por cbarron para considerar todos avances y no solo los de 100% 28ene2022
        //Numero de Checs y SubChecks (check_list) , y su avance promedio (check_list_com) por eje, xTipo(Act/Meta), visible, xAño
        $consulta_acti = "SELECT COUNT(*) AS check_list, avg(cha.Avance) check_list_com
        FROM k_checklist_actividad cha
        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
        WHERE 
        (a.IdEje=$eje AND a.IdTipoActividad=$tipo AND a.visible_plan=1 AND a.Periodo=$Periodo) AND 
        ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1));";


        //echo $consulta_acti;
        $resul_Ac = $catalogo->obtenerLista($consulta_acti);
        while ($row2 = mysqli_fetch_array($resul_Ac)) {
            $entregables = $entregables += $row2['check_list'];
            $entregables_com = $entregables_com += $row2['check_list_com'];
        }
        array_push($totales, $entregables, $entregables_com);
        return $totales;
    }



    function getIdLogroAct()
    {
        return $this->IdLogroAct;
    }

    function getIdEje()
    {
        return $this->IdEje;
    }

    function getIdActividad()
    {
        return $this->IdActividad;
    }

    function getTitulo()
    {
        return $this->Titulo;
    }

    function getResumen()
    {
        return $this->Resumen;
    }

    function getDescripcion()
    {
        return $this->Descripcion;
    }

    function getIdArea()
    {
        return $this->IdArea;
    }

    function getFecha_objetiva()
    {
        return $this->Fecha_objetiva;
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

    function setIdLogroAct($IdLogroAct)
    {

        $this->IdLogroAct = $IdLogroAct;
    }

    function setIdEje($IdEje)
    {
        $this->IdEje = $IdEje;
    }

    function setIdActividad($IdActividad)
    {
        $this->IdActividad = $IdActividad;
    }

    function setTitulo($Titulo)
    {
        $this->Titulo = $Titulo;
    }

    function setResumen($Resumen)
    {
        $this->Resumen = $Resumen;
    }

    function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

    function setIdArea($IdArea)
    {
        $this->IdArea = $IdArea;
    }

    function setFecha_objetiva($Fecha_objetiva)
    {
        $this->Fecha_objetiva = $Fecha_objetiva;
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

    public function getIdActividad_2()
    {
        return $this->IdActividad_2;
    }

    public function setIdActividad_2($IdActividad_2)
    {
        $this->IdActividad_2 = $IdActividad_2;

        return $this;
    }
}
