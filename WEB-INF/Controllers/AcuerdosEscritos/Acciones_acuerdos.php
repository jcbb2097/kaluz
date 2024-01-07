<?php
include_once("../../Classes/Catalogo.class.php");
include_once('../../../WEB-INF/Classes/AcuerdoEscrito.class.php');
$catalogo = new Catalogo();
if (isset($_POST['Eje']) && $_POST['Eje'] != "") {
    $Eje = $_POST['Eje'];
    $Tipo = $_POST['tipo'];
    $Periodo = $_POST['Periodo'];
    $where = "";
    if ($Periodo == 9) {
        $where = "p.Id_Periodo=$Periodo";
    } else {
        $where = "p.Id_Periodo=9";
    }

    $consulta_actividad = "SELECT a.IdActividad,CONCAT(a.IdEje,'.',a.Orden,'. ',a.Nombre) Nombre FROM c_actividad as a
    LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
    LEFT JOIN c_periodo p on p.Periodo=ka.Anio
    WHERE a.IdEje=$Eje AND $where AND a.IdTipoActividad=$Tipo AND IdNivelActividad=1 AND ka.Visible=1 ORDER BY a.Orden";
    //echo $consulta_actividad;
    $s = "";
    $contador = 1;
    $resultado = $catalogo->obtenerLista($consulta_actividad);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['Ejecate']) && $_POST['Ejecate'] != "") {
    $Eje = $_POST['Ejecate'];
    $Tipo = $_POST['tipo'];
    $Periodo = $_POST['Periodo'];
    $Categoria = $_POST['Categoria'];
    $where = "";
    if ($Periodo == 9) {
        $where = "p.Id_Periodo=$Periodo";
    } else {
        $where = "p.Id_Periodo=9";
    }
    $consulta_actividadcategoria = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
    LEFT JOIN c_periodo p on p.Periodo=ka.Anio WHERE a.IdEje=$Eje AND a.IdNivelActividad=1 AND IdTipoActividad=$Tipo and $where AND a.Idcategoria=$Categoria AND ka.Visible=1 ORDER BY a.Orden";
    //echo $consulta_actividadcategoria;
    $s = "";
    $contador = 1;
    $resultado = $catalogo->obtenerLista($consulta_actividadcategoria);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['Ejeact']) && $_POST['Ejeact'] != "") {
    $Eje = $_POST['Ejeact'];
    $Tipo = $_POST['tipo'];
    $Periodo = $_POST['Periodo'];
    $where = "";
    if ($Periodo == 9) {
        $where = "p.Id_Periodo=$Periodo";
    } else {
        $where = "p.Id_Periodo=9";
    }
    $consulta_actividadcategoria = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) actividad FROM c_actividad a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
    LEFT JOIN c_periodo p on p.Periodo=ka.Anio WHERE a.IdEje=$Eje AND a.IdNivelActividad=1 AND IdTipoActividad=$Tipo and $where AND ka.Visible=1 ORDER BY a.Orden";
    //echo $consulta_actividadcategoria;
    $s = "";
    $contador = 1;
    $resultado = $catalogo->obtenerLista($consulta_actividadcategoria);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['SubCategoria']) && $_POST['SubCategoria'] != "") {
    $Tipo = $_POST['tipo'];
    $SubCategoria = $_POST['SubCategoria'];
    $Periodo = $_POST['Periodo'];
   echo $consulta_actividadcategoria = "SELECT
	a.IdActividad,CONCAT( aa.Numeracion, a.Nombre ) actividad 
FROM c_actividad a LEFT JOIN k_actividad_categoria aa on aa.IdActividad=a.IdActividad
WHERE aa.Idcategoria = $SubCategoria AND a.IdTipoActividad = $Tipo AND a.IdNivelActividad = 1 AND aa.IdPeriodo = $Periodo
ORDER BY aa.Orden";
    //echo $consulta_actividadcategoria;
    $s = "";
    $contador = 1;
    $resultado = $catalogo->obtenerLista($consulta_actividadcategoria);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['General']) && $_POST['General'] != "") {
    $actividad = "";
    $texto = "";
    $Periodo = "9";//$_POST['Periodo'];
    $cate = $_POST['Cate'];
    if (isset($_POST['actividad2'])) {
        $actividad = $_POST['actividad2'];
    }
    if (isset($_POST['text'])) {
        $texto = $_POST['text'];
    }
    $s = "";
    $consultaactividads = "SELECT 
	a.IdActividad,CONCAT( aa.Numeracion, a.Nombre ) AS Nombre 
	FROM c_actividad a LEFT JOIN k_actividad_categoria aa on aa.IdActividad=a.IdActividad
    WHERE a.IdActividadSuperior = $actividad AND aa.IdPeriodo = $Periodo AND aa.IdCategoria=$cate ORDER BY aa.Orden";
    echo $consultaactividads;
    $resultado = $catalogo->obtenerLista($consultaactividads);
    if (mysqli_num_rows($resultado) > 0) {
        echo ' <option value="0">Seleccione una opción</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>'  . $row['Nombre'] . '</option>';
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
} else if (isset($_POST['Particular']) && $_POST['Particular'] != "") {
    $actividad = $_POST['actividad3'];
    $texto = $_POST['text'];
    $Periodo = $_POST['Periodo'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    if ($Periodo == 9) {
        $where = "p.Id_Periodo=$Periodo";
    } else {
        $where = "p.Id_Periodo=9";
    }
    $consultaactividads = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) as Nombre FROM c_actividad as a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
    LEFT JOIN c_periodo p on p.Periodo=ka.Anio WHERE a.IdActividadSuperior=$actividad AND ka.Visible=1 and $where ORDER BY a.Orden";
    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>'  . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['SubActividad']) && $_POST['SubActividad'] != "") {
    $actividad = $_POST['actividad5'];
    $texto = $_POST['text'];
    $Periodo = $_POST['Periodo'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    if ($Periodo == 9) {
        $where = "p.Id_Periodo=$Periodo";
    } else {
        $where = "p.Id_Periodo=9";
    }
    $consultaactividads = "SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) as Nombre FROM c_actividad as a LEFT JOIN k_actividad_anios ka ON ka.IdActividad=a.IdActividad
    LEFT JOIN c_periodo p on p.Periodo=ka.Anio WHERE a.IdActividadSuperior=$actividad AND ka.Visible=1 and $where ORDER BY a.Orden";
    $resultado = $catalogo->obtenerLista($consultaactividads);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>'  . $row['Nombre'] . '</option>';
        $contador++;
    }
} else if (isset($_POST['tipoSelect']) && $_POST['tipoSelect'] != "") {
    $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
    $resultado = $catalogo->obtenerLista($consultagiro);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        $s = '';
        echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
    }
} else if (isset($_POST['expo']) && $_POST['expo'] != "") {
    $Periodo = $_POST['Periodo'];
    $consultaperiodo6 = "SELECT
    e.idExposicion,
    e.tituloFinal,
    p.Periodo
    FROM
    c_exposicionTemporal AS e
    INNER JOIN c_periodo AS p ON e.anio = p.Periodo

    ORDER BY
    e.tituloFinal ASC";
    //echo $consultaperiodo6;
    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado6)) {
        $s = '';
        echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
    }
} else if (isset($_POST['exposicion']) && $_POST['exposicion'] != "") {
    $consultaperiodo6 = "SELECT et.idExposicion as idExposicion,CONCAT ('(',et.anio,') ',et.tituloFinal) as tituloFinal
                                    FROM c_exposicionTemporal et
                                    where et.estatus=1 AND et.anio>1
                                    ORDER BY et.anio desc";
    $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
    echo '<option value = "">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado6)) {
        $s = '';
        echo '<option value = "' . $row['idExposicion'] . '" ' . $s . '>' . $row['tituloFinal'] . '</option>';
    }
}

//checklist
else if (isset($_POST['check']) && $_POST['check'] != "") {
    $actividad = $_POST['actividad3'];
    $Periodo = "9";//$_POST['Periodo'];
    $texto = "";
    $cate = $_POST['Cate'];

    $s = "";

    $consultacheck = "SELECT a.IdCheckList,aa.Nombre
    FROM
        k_checklist_actividad a
        LEFT JOIN c_checkList aa ON aa.IdCheckList = a.IdCheckList
        WHERE a.IdActividad=$actividad AND a.IdCategoria=$cate AND a.Id_Periodo=$Periodo AND aa.Nivel=1 ORDER BY a.Orden";
    $resultado = $catalogo->obtenerLista($consultacheck);
    echo$consultacheck;
    if (mysqli_num_rows($resultado) > 0) {
        echo '<option value="">Seleccione</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            echo '<option value="' . $row['IdCheckList'] . '" ' . $s . '>'  . $row['Nombre'] . '</option>';
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
}

//subchecklist
else if (isset($_POST['Subcheck']) && $_POST['Subcheck'] != "") {
    $actividad = $_POST['actividad5'];
    $Periodo = "9";//$_POST['Periodo'];
    $check = $_POST['checklist'];
    $texto = "";
    $cate = $_POST['Cate'];

    $s = "";
    if ($Periodo == 9) {
        $where = "p.Id_Periodo=$Periodo";
    } else {
        $where = "p.Id_Periodo=9";
    }
    echo $consultasubcheck = "SELECT a.IdCheckList,aa.Nombre FROM k_checklist_actividad a 
    LEFT JOIN c_checkList aa ON aa.IdCheckList = a.IdCheckList 
    WHERE a.IdActividad=$actividad AND a.IdCategoria=$cate AND a.Id_Periodo=$Periodo AND aa.IdCheckListPadre=$check ORDER BY a.Orden";
    $resultado = $catalogo->obtenerLista($consultasubcheck);
    if (mysqli_num_rows($resultado) > 0) {
        echo '<option value="">Seleccione subcbc</option>';
        while ($row = mysqli_fetch_array($resultado)) {
            echo '<option value="' . $row['IdCheckList'] . '" ' . $s . '>'  . $row['Nombre'] . '</option>';
        }
    } else {
        echo ' <option value="0">No aplica</option>';
    }
}

//acuerdo estatus
else if (isset($_POST['acuerdoestatus']) && $_POST['acuerdoestatus'] != "") {
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultasubcheck = "SELECT aest.Id_acuerdoestatus AS Id_acuerdoestatus, aest.Descripcion AS des FROM c_acuerdoestatus AS aest where Id_acuerdoestatus = 1";
    $resultado = $catalogo->obtenerLista($consultasubcheck);
   // echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['Id_acuerdoestatus'] . '" ' . $s . '>'  . $row['des'] . '</option>';
        $contador++;
    }
}

//responsable acuerdo
else if (isset($_POST['responsableacuerdo']) && $_POST['responsableacuerdo'] != "") {
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultasubcheck = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=148
                                ORDER BY nombre";
    $resultado = $catalogo->obtenerLista($consultasubcheck);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {
        echo '<option value="' . $row['id_Personas'] . '" ' . $s . '>'  . $row['nombre'] . '</option>';
        $contador++;
    }
}


//responsable de la actividad global o general
else if (isset($_POST['responsableactividad']) && $_POST['responsableactividad'] != "") {
    $actividad = $_POST['actividad10'];
    $Periodo = $_POST['Periodo'];
    $check = $_POST['checklist'];
    $subcheck = $_POST['subchecklist'];
    $texto = "";
    $Periodo = $_POST['Periodo'];
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultapersonas = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=148
                                ORDER BY nombre";
    $resultado = $catalogo->obtenerLista($consultapersonas);
    echo '<option value="">Seleccione</option>';
    while ($row = mysqli_fetch_array($resultado)) {

        $consultapersonas10 = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
    FROM c_actividad AS a
    LEFT JOIN c_personas p ON p.id_Personas=a.IdResponsable
    left JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
    WHERE rp.id_Rol=148 AND a.IdActividad=$actividad
    ORDER BY nombre";
        $resultado10 = $catalogo->obtenerLista($consultapersonas10);
        while ($row10 = mysqli_fetch_array($resultado10)) {
            $s = '';
            if ($row10['id_Personas'] == $row['id_Personas']) {
                $s = 'selected = "selected"';
            }
            //echo '<option value="' . $row['id_Personas'] . '" ' . $s . '>'  . $row['nombre'] . '</option>';
        }
        echo '<option value="' . $row['id_Personas'] . '" ' . $s . '>'  . $row['nombre'] . '</option>';
        $contador++;
    }
}

//responsable del check o subcheck
else if (isset($_POST['responsablechecklist']) && $_POST['responsablechecklist'] != "") {
    $actividad = $_POST['actividad11'];
    $Periodo = $_POST['Periodo'];
    $check = $_POST['checklist'];
    $subcheck = $_POST['subchecklist'];
    $texto = "";
    $Periodo = $_POST['Periodo'];
    $texto = $_POST['text'];
    $contador = 1;
    $men = explode(" ", $texto);
    $s = "";
    $consultapersonas12 = "SELECT distinct p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
                                FROM c_personas as p
                                JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
                                WHERE rp.id_Rol=148
                                ORDER BY nombre";
    $resultado12 = $catalogo->obtenerLista($consultapersonas12);
    echo '<option value="">Seleccione</option>';
    while ($row12 = mysqli_fetch_array($resultado12)) {

        $consultapersonas13 = "SELECT DISTINCT p.id_Personas, CONCAT(p.Nombre,' ',p.Apellido_Paterno,' ',p.Apellido_Materno)as nombre
    FROM c_checkList AS c
    LEFT JOIN c_personas p ON p.id_Personas=c.IdResponsable
    JOIN c_rolPersona rp ON p.id_Personas=rp.id_Persona
    WHERE rp.id_Rol=148 AND c.IdCheckList=$actividad
    ORDER BY nombre";
        $resultado13 = $catalogo->obtenerLista($consultapersonas13);
        while ($row13 = mysqli_fetch_array($resultado13)) {
            $s = '';
            if ($row13['id_Personas'] == $row12['id_Personas']) {
                $s = 'selected = "selected"';
            }
            //echo '<option value="' . $row12['id_Personas'] . '" ' . $s . '>'  . $row12['nombre'] . '</option>';
        }
        echo '<option value="' . $row12['id_Personas'] . '" ' . $s . '>'  . $row12['nombre'] . '</option>';

        $contador++;
    }
}
