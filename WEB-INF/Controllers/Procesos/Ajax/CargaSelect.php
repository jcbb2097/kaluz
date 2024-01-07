<?php

include_once '../../Classes/Catalogo.class.php';
include_once '../../Classes/Concepto.class.php';
$catalogo = new Catalogo();
$concepto = new Concepto();

if (isset($_GET['acuerdo'])) {
    $seleccione = "";
    $rs2 = null;
    $st2 = null;
    $x = isset($_GET["x"]) ? $_GET["x"] : 0;
    $orden = 0;
    $type = isset($_GET["type"]) ? $_GET["type"] : 0;
    $Q = isset($_GET["Q"]) ? $_GET["Q"] : null;
    $Q2 = isset($_GET["Q2"]) ? $_GET["Q2"] : null;
    $Q3 = isset($_GET["Q3"]) ? $_GET["Q3"] : null;
    $Q4 = isset($_GET["Q4"]) ? $_GET["Q4"] : null;
    $ano = isset($_GET["ano"]) ? $_GET["ano"] : null;
    $SQL_Select = $SQL_Sub = $txt = $valor = "";

    switch ($x) {
        /* case 1:
          $SQL_Select = "SELECT id_proyarea AS id_proyecto, descripcion, orden FROM COM_PROYAREA WHERE prioridad in(1,81) AND estado = 1 AND orden <> 100 ORDER BY orden";
          $result = $catalogo->obtenerLista($SQL_Select);
          while ($rs = mysql_fetch_array($result)) {
          $orden = 0;
          echo '<option value="' . $rs['id_proyecto'] . '">' . $rs['orden'] . '. ' . $rs['descripcion'] . '</option>';
          $SQL_Sub = "SELECT s.id_hijo,a.descripcion FROM COM_SUBAREAS s,COM_PROYAREA a WHERE a.id_proyarea=s.id_hijo AND s.id_padre=" . $rs['id_proyecto'] . " ORDER BY orden";
          $result2 = $catalogo->obtenerLista($SQL_Sub);
          while ($rs2 = mysql_fetch_array($result2)) {
          $orden++;
          echo '<option value="' . $rs2['id_hijo'] . '">' . $rs2['orden'] . '.' . $orden . '. ' . $rs2['descripcion'] . '</option>';
          }
          }
          break; */
        case 2:/* Muestra los proyectos */
            $SQL_Select = "SELECT IdProyecto, orden, Nombre FROM `c_proyecto` ORDER BY orden;";
            echo '<option value="">--Eje--</option>';
            $result = $catalogo->obtenerLista($SQL_Select);
            while ($rs = mysql_fetch_array($result)) {
                echo '<option value="' . $rs['IdProyecto'] . '">' . $rs['orden'] . '. ' . $rs['Nombre'] . '</option>';
            }
            break;
        case 3://Actividades generales o exposiciones.
            $SQL_Select = "SELECT e.id_exposicion, e.nombre, p.orden
                FROM `c_exposicion` AS e
                LEFT JOIN c_proyecto AS p ON p.IdProyecto = e.IdProyecto
                WHERE e.IdProyecto = $Q AND (YEAR(e.FechaInicio) = $ano OR YEAR(e.FechaFin) = $ano) 
                ORDER BY nombre;";
            //echo $SQL_Select;
            $result = $catalogo->obtenerLista($SQL_Select);
            if (mysql_num_rows($result) > 0) {//Si tiene ejes
                echo ("&&--&&");
                echo ("<option value=''>--Exposición--</option>");
                while ($rs = mysql_fetch_array($result)) {
                    echo ("<option value='" . $rs['id_exposicion'] . "'>" . $rs['orden'] . ". " . $rs['nombre'] . "</option>");
                }
            } else {
                $SQL_Select = "SELECT c.IdConcepto, c.Orden, c.Nombre, p.orden AS ordenproy "
                        . "FROM c_concepto AS c "
                        . "LEFT JOIN c_proyecto AS p ON p.IdProyecto = c.IdProyecto "
                        . "WHERE c.IdProyecto = $Q AND c.IdNivelConcepto = 2 AND c.IdTipoConcepto = 1 AND c.Anio = $ano "
                        . "ORDER BY Orden;";
                $txt = $type == 1 ? "Actividad General" : ($type == 2 ? "Meta" : null);
                echo '<option value="">--Actividad--</option>';
                $result = $catalogo->obtenerLista($SQL_Select);
                while ($rs = mysql_fetch_array($result)) {
                    echo '<option value="' . $rs['IdConcepto'] . '">' . $rs['ordenproy'] . '.' . $rs['Orden'] . '.' . $rs['Nombre'] . '</option>';
                }
                $SQL_Select = "SELECT c.IdConcepto, c.Orden, c.Nombre, p.orden AS ordenproy "
                        . "FROM c_concepto AS c "
                        . "LEFT JOIN c_proyecto AS p ON p.IdProyecto = c.IdProyecto "
                        . "WHERE c.IdProyecto = $Q AND c.IdNivelConcepto = 2 AND c.IdTipoConcepto = 2 AND c.Anio = $ano "
                        . "ORDER BY Orden;";
                $txt = $type == 1 ? "Actividad General" : ($type == 2 ? "Meta" : null);
                echo "&&__&&";
                echo '<option value="">--Meta--</option>';
                $result = $catalogo->obtenerLista($SQL_Select);
                while ($rs = mysql_fetch_array($result)) {
                    echo '<option value="' . $rs['IdConcepto'] . '">'.$rs['ordenproy'].'.' . $rs['Orden'] . '.' . $rs['Nombre'] . '</option>';
                }
            }
            break;
        case 4://Actividades particulares
            $SQL_Select = "SELECT p.orden AS ordenproy, cg.Orden AS ordenag, cp.Orden AS orden, cp.IdConcepto, cp.Nombre
                FROM `c_concepto` AS cp
                LEFT JOIN c_concepto AS cg ON cg.IdConcepto = cp.IdConceptoSuperior
                LEFT JOIN c_proyecto AS p ON p.IdProyecto = cg.IdProyecto
                WHERE p.IdProyecto = $Q AND cg.IdConcepto = $Q2 AND cp.Nombre NOT LIKE 'Acuerdos%'
                GROUP BY cp.IdConcepto
                ORDER BY p.orden, cg.Orden, cp.Orden;";
            $txt = $type == 1 ? "Actividad Particular" : ($type == 2 ? "Área que Participa" : null);
            $valor = $type == 1 ? "0" : "";
            $seleccione = "--Submeta/Subactividad--";
            if ($_GET["tres"] != null && $_GET["tres"] == "a") {
                $seleccione = "--Subactividad--";
            } else if ($_GET["tres"] != null && $_GET["tres"] == "m") {
                $seleccione = "--Submeta--";
            }

            echo '<option value="' . $valor . '">' . $seleccione . '</option>';
            $result = $catalogo->obtenerLista($SQL_Select);
            while ($rs = mysql_fetch_array($result)) {
                echo '<option value="' . $rs['IdConcepto'] . '">' . $rs['ordenproy'] . '.' . $rs['ordenag'] . '.' . $rs['orden'] . ' ' . $rs['Nombre'] . '</option>';
            }
            break;
        case 5://Subactividades
            $where = "";
            $idGeneral = "";
            if ($Q2 != null && $Q2 != "") {
                $where = " AND cg.IdConcepto='$Q2' ";
            } else if ($Q4 != null && $Q4 != "") {
                $where = " AND cg.IdConcepto='$Q4' ";
            }
            $SQL_Select = "SELECT p.orden AS ordenproy, cg.Orden AS ordenag, cp.Orden AS ordenpart, cs.Orden AS orden, cs.IdConcepto, cs.Nombre
                FROM `c_concepto` AS cs
                LEFT JOIN c_concepto AS cp ON cp.IdConcepto = cs.IdConceptoSuperior
                LEFT JOIN c_concepto AS cg ON cg.IdConcepto = cp.IdConceptoSuperior
                LEFT JOIN c_proyecto AS p ON p.IdProyecto = cg.IdProyecto
                WHERE p.IdProyecto = $Q AND cp.IdConcepto = $Q3 $where 
                GROUP BY cs.IdConcepto
                ORDER BY p.orden, cg.Orden, cp.Orden, cs.Orden;";
            
            $txt = $type == 1 ? "Subactividad" : ($type == 2 ? "Meta Particular" : null);
            $seleccione = "--SubSubmeta/SubSubactividad--";
            if ($Q2 != null && $Q2 != "") {
                $seleccione = "--SubSubactividad--";
            } else if ($Q4 != null && $Q4 != "") {
                $seleccione = "--SubSubmeta--";
            }
            echo '<option value="">' . $seleccione . '</option>';

            $result = $catalogo->obtenerLista($SQL_Select);
            while ($rs = mysql_fetch_array($result)) {
                echo '<option value="' . $rs['IdConcepto'] . '">' . $rs['ordenproy'] . '.' . $rs['ordenag'] . '.' . $rs['ordenpart'] . '.' . $rs['orden'] . ' ' . $rs['Nombre'] . '</option>';
            }
            break;
        case 6://Actividades generales de exposiciones
            $SQL_Select = "SELECT p.orden AS porden, c.IdConcepto, c.Nombre AS concepto, c.Orden
                FROM `k_exposicionconcepto` AS kec
                LEFT JOIN c_concepto AS c ON c.IdConcepto = kec.id_concepto
                LEFT JOIN c_proyecto AS p ON p.IdProyecto = c.IdProyecto
                LEFT JOIN c_area AS a ON a.IdArea = c.IdArea
                WHERE kec.id_exposicion = $Q AND c.Anio = $ano AND c.IdTipoConcepto = 1 GROUP BY c.IdConcepto ORDER BY Orden;";

            $txt = $type == 1 ? "Actividad General" : (type == 2 ? "Meta" : null);
            echo '<option value="">--Actividad--</option>';
            $result = $catalogo->obtenerLista($SQL_Select);
            while ($rs = mysql_fetch_array($result)) {
                echo '<option value="' . $rs['IdConcepto'] . '">' . $rs['porden'] . '.' . $rs['Orden'] . '.' . $rs['concepto'] . '</option>';
            }
            $SQL_Select = "SELECT p.orden AS porden, c.IdConcepto, c.Nombre AS concepto, c.Orden
                FROM `k_exposicionconcepto` AS kec
                LEFT JOIN c_concepto AS c ON c.IdConcepto = kec.id_concepto
                LEFT JOIN c_proyecto AS p ON p.IdProyecto = c.IdProyecto
                LEFT JOIN c_area AS a ON a.IdArea = c.IdArea
                WHERE kec.id_exposicion = $Q AND c.Anio = $ano AND c.IdTipoConcepto = 2 GROUP BY c.IdConcepto ORDER BY Orden;";
            $txt = $type == 1 ? "Actividad General" : ($type == 2 ? "Meta" : null);

            echo "&&__&&";
            echo "<option value=''>--Meta--</option>";
            $result = $catalogo->obtenerLista($SQL_Select);
            while ($rs = mysql_fetch_array($result)) {
                echo '<option value="' . $rs['IdConcepto'] . '">' . $rs['porden'] . '.' . $rs['Orden'] . '.' . $rs['concepto'] . '</option>';
            }
            break;
        case 7:/*Muestra áreas*/
            $SQL_Select = "SELECT IdArea,Nombre FROM c_area;";
             echo '<option value="">--&Aacute;rea--</option>';
            $result = $catalogo->obtenerLista($SQL_Select);
            while ($rs = mysql_fetch_array($result)) {
                echo '<option value="' . $rs['IdArea'] . '">'. $rs['Nombre'] .'</option>';
            }
            break;
        case 8: /*actividades generales areas*/
            $SQL_Select = "SELECT e.id_exposicion, e.nombre, p.orden
                FROM `c_exposicion` AS e
                LEFT JOIN c_proyecto AS p ON p.IdProyecto = e.IdProyecto
                WHERE e.IdProyecto = $Q AND (YEAR(e.FechaInicio) = $ano OR YEAR(e.FechaFin) = $ano) 
                ORDER BY nombre;";
            //echo $SQL_Select;
            $result = $catalogo->obtenerLista($SQL_Select);
            if (mysql_num_rows($result) > 0) {//Si tiene ejes
                echo ("&&--&&");
                echo ("<option value=''>--Exposición--</option>");
                while ($rs = mysql_fetch_array($result)) {
                    echo ("<option value='" . $rs['id_exposicion'] . "'>" . $rs['orden'] . ". " . $rs['nombre'] . "</option>");
                }
            } else {
                $SQL_Select = "SELECT c.IdConcepto, c.Orden, c.Nombre, a.orden AS ordenproy "
                        . "FROM c_concepto AS c "
                        . "LEFT JOIN c_area AS a ON a.IdArea = c.IdArea "
                        . "WHERE c.IdArea = $Q AND c.IdNivelConcepto = 2 AND c.IdTipoConcepto = 1 AND c.Anio = $ano "
                        . "ORDER BY Orden;";
                
                $txt = $type == 1 ? "Actividad General" : ($type == 2 ? "Meta" : null);
                echo '<option value="">--Actividad--</option>';
                $result = $catalogo->obtenerLista($SQL_Select);
                while ($rs = mysql_fetch_array($result)) {
                    echo '<option value="' . $rs['IdConcepto'] . '">' . $rs['ordenproy'] . '.' . $rs['Orden'] . '.' . $rs['Nombre'] . '</option>';
                    
                }
                $SQL_Select = "SELECT c.IdConcepto, c.Orden, c.Nombre, a.orden AS ordenproy "
                        . "FROM c_concepto AS c "
                        . "LEFT JOIN c_area AS a ON a.IdArea = c.IdArea"
                        . "WHERE c.IdArea = $Q AND c.IdNivelConcepto = 2 AND c.IdTipoConcepto = 2 AND c.Anio = $ano "
                        . "ORDER BY Orden;";
                $txt = $type == 1 ? "Actividad General" : ($type == 2 ? "Meta" : null);
                echo "&&__&&";
                echo '<option value="">--Meta--</option>';
                $result = $catalogo->obtenerLista($SQL_Select);
                while ($rs = mysql_fetch_array($result)) {
                    echo '<option value="' . $rs['IdConcepto'] . '">'.$rs['ordenproy'].'.' . $rs['Orden'] . '.' . $rs['Nombre'] . '</option>';
                }
            }
            break;
    }
}else if(isset ($_POST['eje']) && isset ($_POST['select']) && $_POST['select'] == "alex1"){
    if($_POST['eje'] != ""){
   /* $consultaActividades = "SELECT c_concepto.IdConcepto,c_concepto.IdProyecto,c_concepto.Nombre,c_concepto.Periodo,sie_cat_periodos.CPE_PERIODO
                            FROM c_concepto
                            INNER JOIN sie_cat_periodos ON c_concepto.Periodo = sie_cat_periodos.CPE_ID_PERIODO 
                            WHERE c_concepto.IdProyecto=".$_POST['eje']." AND sie_cat_periodos.CPE_ESTATUS=1
                            ORDER BY
                            c_concepto.Orden ASC;";*/
    $consultaActividades="SELECT cc.IdConcepto,cc.Nombre,cc.Anio,cc.Periodo,cc.IdProyecto,cc.Orden FROM c_concepto AS cc
                            INNER JOIN c_proyecto AS cp ON cp.IdProyecto = cc.IdProyecto
                            WHERE cp.IdProyecto=".$_POST['eje']." 
                            ORDER BY
                                    cc.Orden ASC";    
    echo "<br><br>Consulta1:$consultaActividades<br><b>";
    $resultActividades = $catalogo->obtenerLista($consultaActividades);
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultActividades)) {
        echo '<option value="'.$row['IdConcepto'].'">'.$row['Nombre'].'</option>';
    }
    }else{
        echo '<option value="">Selecciona una opción</option>';
    }
}else if(isset ($_POST['autor']) && isset ($_POST['select']) && $_POST['select'] == "alex2"){
    if($_POST['autor'] != ""){
    $consulta = "SELECT ka.IdInstitucion,ci.Nombre FROM k_autorInstitucion AS ka INNER JOIN c_institucion AS ci ON ci.IdInstitucion = ka.IdInstitucion
                    WHERE ka.IdAutor = ".$_POST['autor'].";";
    $result = $catalogo->obtenerLista($consulta);
    while ($row1 = mysql_fetch_array($result)) {
        $s = '';
        if($row1['IdInstitucion'] == $_POST['editar']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row1['IdInstitucion'].'" '.$s.'>'.$row1['Nombre'].'</option>';
    }
    }else{
        echo '<option value="">Selecciona una opción</option>';
    }
}else if(isset ($_POST['eje']) && isset ($_POST['select']) && $_POST['select'] == "alex3"){
    
   /*$consultaActividades = "SELECT c_concepto.IdConcepto,c_concepto.IdProyecto,c_concepto.Nombre,c_concepto.Periodo,sie_cat_periodos.CPE_PERIODO
                            FROM c_concepto
                            INNER JOIN sie_cat_periodos ON c_concepto.Periodo = sie_cat_periodos.CPE_ID_PERIODO 
                            WHERE c_concepto.IdProyecto=".$_POST['eje']." AND sie_cat_periodos.CPE_ESTATUS=1
                            ORDER BY
                            c_concepto.Orden ASC;";*/
    $consultaActividades="SELECT cc.IdConcepto,cc.Nombre,cc.Anio,cc.Periodo,cc.IdProyecto,cc.Orden FROM c_concepto AS cc
                            INNER JOIN c_proyecto AS cp ON cp.IdProyecto = cc.IdProyecto
                            WHERE cp.IdProyecto=".$_POST['eje']." 
                            ORDER BY
                                    cc.Orden ASC";
    echo "<br><br>Consulta2:$consultaActividades<br><b>";
    $resultActividades = $catalogo->obtenerLista($consultaActividades);
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultActividades)) {
        $s = '';
        if($row['IdConcepto'] == $_POST['actividad']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row['IdConcepto'].'" '.$s.'>'.$row['Nombre'].'</option>';
    }
    
}else if(isset ($_POST['categoria']) && isset ($_POST['select']) && $_POST['select'] == "jordan1"){
    
    if($_POST['categoria'] != ""){
    $consultaAplicacion= "SELECT IdAplicacion,Id_categoria, Nombre FROM `c_aplicacion` WHERE Id_categoria=".$_POST['categoria'].";"; 
    echo "<br><br>Consulta1:$consultaAplicacion<br><b>";
    $resultAplicacion = $catalogo->obtenerLista($consultaAplicacion);
    
        while ($row = mysql_fetch_array($resultAplicacion)) {
            echo '<option value="'.$row['IdAplicacion'].'">'.$row['Nombre'].'</option>';
        }
    }
}else if(isset ($_POST['categoria']) && isset ($_POST['select']) && $_POST['select'] == "jordan2"){
    
   $consultaAplicacion= "SELECT IdAplicacion,Id_categoria, Nombre FROM `c_aplicacion` WHERE Id_categoria=".$_POST['categoria'].";"; 
    echo "<br><br>Consulta2:$consultaAplicacion<br><b>";
    $resultAplicacion = $catalogo->obtenerLista($consultaAplicacion);
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultAplicacion)) {
        $s = '';
        if($row['IdAplicacion'] == $_POST['aplicacion']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row['IdAplicacion'].'" '.$s.'>'.$row['Nombre'].'</option>';
    }
}else if(isset($_POST['periodo']) && isset ($_POST['select']) && $_POST['select'] == "jordan3") {
   if($_POST['periodo'] != ""){ 
    $consultaEje="SELECT cp.IdProyecto,cp.Nombre,cp.orden, cp.id_periodo_proyecto FROM c_proyecto AS cp
                                        INNER JOIN sie_cat_periodos AS scp ON scp.CPE_ID_PERIODO = cp.id_periodo_proyecto
                                        WHERE cp.id_periodo_proyecto=".$_POST['periodo'].
                                        " ORDER BY orden;";
    //echo'<br>'.$consultaEje.'<br>';
    $resultEjes = $catalogo->obtenerLista($consultaEje);
    echo '<option value="">Selecciona una opción</option>';
        while ($row = mysql_fetch_array($resultEjes)) {
        echo '<option value="'.$row['IdProyecto'].'">'.$row['Nombre'].'</option>';
    }
    }else{
        echo '<option value="">Selecciona una opción</option>';
    }
 
}else if (isset($_POST['periodo']) && isset ($_POST['select']) && $_POST['select'] == "jordan4") {
    
    $consultaEje="SELECT cp.IdProyecto,cp.Nombre,cp.orden, cp.id_periodo_proyecto FROM c_proyecto AS cp
                                        INNER JOIN sie_cat_periodos AS scp ON scp.CPE_ID_PERIODO = cp.id_periodo_proyecto
                                        WHERE cp.id_periodo_proyecto=".$_POST['periodo'].
                                        " ORDER BY orden;";
    //echo "<br><br>Consulta2:$consultaEje<br><b>";
    $resultEjes = $catalogo->obtenerLista($consultaEje);
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultEjes)) {
        $s = '';
        if($row['IdProyecto'] == $_POST['eje']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row['IdProyecto'].'" '.$s.'>'.$row['Nombre'].'</option>';
    }
}else if(isset ($_POST['aplicacion']) && isset ($_POST['select']) && $_POST['select'] == "jordan5"){
    
    if($_POST['aplicacion'] != ""){
    $consultaMenuAplicacion= "SELECT IdMenuAplicacion, IdAplicacion, NombreMenu FROM `c_menuaplicacion` WHERE IdAplicacion=".$_POST['aplicacion'].";"; 
    echo "<br><br>Consulta1:$consultaMenuAplicacion<br><b>";
    $resultMenuAplicacion = $catalogo->obtenerLista($consultaMenuAplicacion);
        
        while ($row = mysql_fetch_array($resultMenuAplicacion)) {
            echo '<option value="'.$row['IdMenuAplicacion'].'">'.$row['NombreMenu'].'</option>';
        }
    }
}else if(isset ($_POST['aplicacion']) && isset ($_POST['select']) && $_POST['select'] == "jordan6"){
    
  $consultaMenuAplicacion= "SELECT IdMenuAplicacion, IdAplicacion, NombreMenu FROM `c_menuaplicacion` WHERE IdAplicacion=".$_POST['aplicacion'].";"; 
    echo "<br><br>Consulta2:$consultaMenuAplicacion<br><b>";
    $resultMenuAplicacion = $catalogo->obtenerLista($consultaMenuAplicacion);
    
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultMenuAplicacion)) {
        $s = '';
        if($row['IdMenuAplicacion'] == $_POST['menu']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row['IdMenuAplicacion'].'" '.$s.'>'.$row['NombreMenu'].'</option>';
    }
}else if(isset ($_POST['menu']) && isset ($_POST['select']) && $_POST['select'] == "jordan7"){
    
    if($_POST['menu'] != ""){
    $consultaSubMenu= "SELECT IdSubMenuAplicacion, IdSubMenuAplicacion, nom_sub FROM `c_submenuaplicacion` WHERE IdMenuAplicacion=".$_POST['menu'].";"; 
    echo "<br><br>Consulta1:$consultaSubMenu<br><b>";
    $resultSubMenuAplicacion = $catalogo->obtenerLista($consultaSubMenu);
        
        while ($row = mysql_fetch_array($resultSubMenuAplicacion)) {
            echo '<option value="'.$row['IdSubMenuAplicacion'].'">'.$row['nom_sub'].'</option>';
        }
    }
}else if(isset ($_POST['menu']) && isset ($_POST['select']) && $_POST['select'] == "jordan8"){
    
  $consultaSubMenu= "SELECT IdSubMenuAplicacion, IdSubMenuAplicacion, nom_sub FROM `c_submenuaplicacion` WHERE IdMenuAplicacion=".$_POST['menu'].";"; 
    echo "<br><br>Consulta2:$consultaSubMenu<br><b>";
    $resultSubMenuAplicacion = $catalogo->obtenerLista($consultaSubMenu);
    
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultSubMenuAplicacion)) {
        $s = '';
        if($row['IdSubMenuAplicacion'] == $_POST['submenu']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row['IdSubMenuAplicacion'].'" '.$s.'>'.$row['nom_sub'].'</option>';
    }
}else if(isset ($_POST['submenu']) && isset ($_POST['select']) && $_POST['select'] == "jordan9"){
    
    if($_POST['submenu'] != ""){
    $consultaSubSubMenu= "SELECT IdSubSubMenu,IdSubMenu,Nombre FROM `c_subsubmenuaplicacion` WHERE IdSubMenu=".$_POST['submenu'].";"; 
    echo "<br><br>Consulta3:$consultaSubSubMenu<br><b>";
    $resultSubSubMenuAplicacion = $catalogo->obtenerLista($consultaSubSubMenu);
        
        while ($row = mysql_fetch_array($resultSubSubMenuAplicacion)) {
            echo '<option value="'.$row['IdSubSubMenu'].'">'.$row['Nombre'].'</option>';
        }
    }
}else if(isset ($_POST['submenu']) && isset ($_POST['select']) && $_POST['select'] == "jordan10"){
    
  $consultaSubSubMenu= "SELECT IdSubSubMenu,IdSubMenu,Nombre FROM `c_subsubmenuaplicacion` WHERE IdSubMenu=".$_POST['submenu'].";"; 
    echo "<br><br>Consulta4:$consultaSubSubMenu<br><b>";
    $resultSubSubMenuAplicacion = $catalogo->obtenerLista($consultaSubSubMenu);
    
    echo '<option value="">Selecciona una opción</option>';
    while ($row = mysql_fetch_array($resultSubSubMenuAplicacion)) {
        $s = '';
        if($row['IdSubSubMenu'] == $_POST['subsubmenu']){
            $s = 'selected = "selected"';
        }
        echo '<option value="'.$row['IdSubSubMenu'].'" '.$s.'>'.$row['Nombre'].'</option>';
    }
}        
    