<?php


session_start();
if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}
//header("Cache-Control: no-cache, no-store, must-revalidate");
// header("Cache-Control: no-cache, must-revalidate");


include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();


if (isset($_GET['Id_eje']) && $_GET['Id_eje'] != "") {
    $Eje = $_GET['Id_eje'];
} else {
    $Eje = "";
}
if (isset($_GET['ACME']) && $_GET['ACME'] != "") {
    $ACME = $_GET['ACME'];
} else {
    $ACME = "";
}
if (isset($_GET['cate']) && $_GET['cate'] != "") {
    $Categoria = $_GET['cate'];
} else {
    $Categoria = "";
}
if (isset($_GET['subcate']) && $_GET['subcate'] != "") {
    $Subcategoria = $_GET['subcate'];
} else {
    $Subcategoria = "";
}
if (isset($_GET['AGBL']) && $_GET['AGBL'] != "") {
    $Actividad_global = $_GET['AGBL'];
} else {
    $Actividad_global = "";
}
if ($Subcategoria > 0) {
    $cate = $Subcategoria;
} else {
    $cate = $Categoria;
}
if (isset($_GET['check']) && $_GET['check'] != "") {
    $Check = $_GET['check'];
} else {
    $Check = "";
}
if (isset($_GET['subcheck']) && $_GET['subcheck'] != "") {
    $Subcheck = $_GET['subcheck'];
} else {
    $Subcheck = "";
}
if (isset($_GET['periodo']) && $_GET['periodo'] != "") {
    $periodo2 = $_GET['periodo'];
} else {
    $periodo2 = "";
}
if (isset($_GET['tipo_entregable']) && $_GET['tipo_entregable'] != "") {
    $Tipo_entregable = $_GET['tipo_entregable'];
} else {
    $Tipo_entregable = "";
}
if (isset($_GET['idUsuario']) && $_GET['idUsuario'] != "") {
    $id_usuario = $_GET['idUsuario'];
} else {
    $id_usuario = "";
}
if (isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != "") {
    $tipoPerfil = $_GET['tipoPerfil'];
} else {
    $tipoPerfil = "";
}
if (isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "") {
    $nombreUsuario = $_GET['nombreUsuario'];
} else {
    $nombreUsuario = "";
}
if (isset($_GET['AGENE']) && $_GET['AGENE'] != "" && $_GET['AGENE'] != 0) {
    $Actividad_general = $_GET['AGENE'];
} else {
    $Actividad_general = 0;
}
if (isset($_GET['id_area']) && $_GET['id_area'] != "") {
    $id_area = $_GET['id_area'];
} else {
    $id_area = "";
}
if (isset($_GET['id_encargado']) && $_GET['id_encargado'] != "") {
    $id_encargado = $_GET['id_encargado'];
} else {
    $id_encargado = "";
}
if (isset($_GET['origen']) && $_GET['origen'] != "") {
    $origen = $_GET['origen'];
} else {
    $origen = 0;
}
if (isset($_GET['areaor']) && $_GET['areaor'] != "") {
    $areaor = $_GET['areaor'];
} else {
    $areaor = 0;
}
if (isset($_GET['ejeareaor']) && $_GET['ejeareaor'] != "") {
    $ejearea = $_GET['ejeareaor'];
} else {
    $ejearea = 0;
}



$nombre_check = "";
$Area = "";
$actividad = "";
$meta = "";
$Actividad = "";
$general_ver = "";
$subcheck_ver = "";
$check_ver = "";
$id_area_origen = "";
$encargado_AG = "";
$encargado_AGE = "";
$encargado_Check = "";
$encargado_Subcheck = "";
$estilo_info_check = "";
$estilo_info_subcheck = "";
$estilo_dan_check = "";
$estilo_dan_subcheck = "";
if ($Subcheck == 0) {
    $subcheck_ver = 'style="display: none;"';
    $check_ver = 'style="display: ;"';
    $estilo_info_check = "info";
    $estilo_info_subcheck = "";
    $estilo_dan_check = "danger";
    $estilo_dan_subcheck = "";
} else {
    $estilo_info_check = "";
    $subcheck_ver = 'style="display: none;"';
    $estilo_info_subcheck = "info";
    $estilo_dan_check = "";
    $estilo_dan_subcheck = "danger";
}
if ($ACME == 1) {
    $actividad = "checked";
} else {
    $meta = "checked";
}
if ($Actividad_general > 0) {
    $Actividad = $Actividad_general;
} else {
    $Actividad = $Actividad_global;
    //$general_ver = 'style="display: none;"';
}


$nombre_area = "";
$consula_area = "SELECT
a.Id_Area,
a.Nombre
FROM
	c_usuario u
	INNER JOIN c_personas p ON p.id_Personas = u.IdPersona
	INNER JOIN c_area a on a.Id_Area=p.idArea
	WHERE u.IdUsuario=$id_usuario";
$resultado_area = $catalogo->obtenerLista($consula_area);
while ($row = mysqli_fetch_array($resultado_area)) {
    $nombre_area = $row['Nombre'];
    $id_area_origen = $row['Id_Area'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" type="text/css" href="css/estilos_asuntos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/estilos_asuntos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <script src="../../../resources/js/aplicaciones/Asuntos/Alta_asuntos.js?1600"></script>
    <title>::.FORMULARIO ASUNTOS.::</title>

</head>

<body>

    <div class="well2 "><a onclick="back();" style="color:#fefefe;">Asuntos / <a style="color:#fefefe;" href="javascript:window.location.reload(true)"> <?php echo $nombre_area; ?></a></b>
      <?php if($origen == 2) {
      ?>
        <a href="../Asuntos_indicadores/estadisticas.php?ejearea=<?php echo $ejearea; ?>&idejearea=<?php echo $areaor; ?>" style="position:absolute; right: 50px; color:white;" > Regresar a indicadores </a>
      <?php
        }
       ?>
    </div>
    <div class="well2 wr">
        Redacta un nuevo asunto
    </div>
    <div id="container-fluid" class="junto" style="font-family: 'Muli', sans-serif;">
        <form class="form-horizontal" id="formasunto" name="formasunto">
          <input type="hidden" name="origen" id="origen" value="<?php echo $origen; ?>">
            <div class="form-group form-group-sm" style="position: relative;top: -20px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btnTipo btn btn-danger btn-sm" style="background-color: #999898;">
                            <input type="radio" class="check" name="prob" id="prob" value="4" autocomplete="off">Problemática
                        </label>
                        <label class="btnTipo btn btn-secondary btn-sm " style="background-color: #999898;">
                            <input type="radio" class="check" name="sol" id="sol" value="1" autocomplete="off">Solicitud
                        </label>
                        <label class="btnTipo btn btn-secondary btn-sm" style="background-color: #999898;">
                            <input type="radio" class="check" name="con" id="con" value="2" autocomplete="off">Conocimiento
                        </label>
                        <label class="btnTipo btn btn-secondary btn-sm" style="background-color: #999898;">
                            <input type="radio" class="check" name="sug" id="sug" value="3" autocomplete="off">Sugerencia
                        </label>
                        <input type="hidden" name="tipo" id="checkeck" value="">
                        <input type="hidden" name="accion" id="accion" value="nuevo_asunto">
                        <input type="hidden" name="accion" id="actmet" value="1">
                    </div>
                </div>
            </div>
            <div class="form-group form-group-sm" style="position: relative;top: -35px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btnTipo btn btn-secondary btn-sm active"  style="background-color: #999898;"  onclick="actividadmeta(1)">

                            <input type="radio" name="actm" value="0" autocomplete="off" <?php echo $actividad;  ?>>Actividades

                        </label>
                        <label class="btnTipo btn btn-secondary btn-sm"  style="background-color: #999898;" onclick="actividadmeta(2)">
                            <input type="radio" name="actm" id="metas" value="0" autocomplete="off" <?php echo $meta; ?> >Metas
                        </label>
                        <input type="hidden" name="acme" id="acme" value="<?php echo $ACME; ?>">
                        <select id="ano" class="form-control" name="ano" onchange="" style="display: none;">
                            <option value="">Seleccione un Periodo</option>
                            <?php
                            $Ano = "SELECT p.Id_Periodo,p.Periodo FROM c_periodo as p WHERE p.CPE_ESTATUS=1 ORDER BY p.Periodo DESC";
                            $resulaño = $catalogo->obtenerLista($Ano);
                            while ($row = mysqli_fetch_array($resulaño)) {
                                if ($periodo2 == $row['Id_Periodo']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option value='" . $row['Id_Periodo'] . "' " . $selected . ">" . $row['Periodo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group form-group-sm" style="position: relative;top: -50px;">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="eje" name="eje" class="form-control form-control-sm cnt-sm" onChange="llenacategoria(1)" style="width: 181px;">
                        <option value='0' selected>Seleccione un Eje</option>
                        <?php
                        $consultagiro = "SELECT e.idEje,e.Nombre FROM c_eje as e ";
                        $resultado = $catalogo->obtenerLista($consultagiro);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            if ($row['idEje'] == $Eje) {
                                $s = 'selected="selected"';
                            }
                            echo '<option value = "' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                </div>
            </div>
            <div class="form-group form-group-sm" style="position: relative;top: -65px;">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="cate" name="cate" class="form-control form-control-sm cnt-sm" onChange="llenacategoria(2)" style="width: 181px;">
                        <option value='0' selected>Seleccione una categoría</option>
                        <?php
                        $consultagiro = "SELECT ce.idCategoria,ce.descCategoria
                        FROM c_categoriasdeejes ce
                        INNER JOIN k_categoriasdeejes_anios cea on cea.idCategoria=ce.idCategoria
                        INNER JOIN c_periodo p on p.Periodo=cea.Anio
                        WHERE ce.nivelCategoria=1 AND p.Id_Periodo=$periodo2 AND ce.idEje=$Eje ORDER BY ce.orden";
                        $resultado = $catalogo->obtenerLista($consultagiro);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            if ($row['idCategoria'] == $Categoria) {
                                $s = 'selected="selected"';
                            }
                            echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3" style="position: relative;right: 51px;">
                    <select id="subcate" name="subcate" class="form-control form-control-sm cnt-sm" onChange="llenaactividades(2)" style="width: 181px;">
                        <?php
                        if ($Subcategoria > 1) {
                            $consultagiro = "SELECT ce.idCategoria,ce.descCategoria FROM c_categoriasdeejes ce WHERE ce.idCategoriaPadre=$Categoria ORDER BY ce.orden ";
                            $resultado = $catalogo->obtenerLista($consultagiro);
                            echo '<option value="0">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado)) {
                                $s = '';
                                if ($row['idCategoria'] == $Subcategoria) {
                                    $s = 'selected="selected"';
                                }
                                echo '<option value="' . $row['idCategoria'] . '" ' . $s . '>' . $row['descCategoria'] . '</option>';
                            }
                        } else {
                            echo '<option value="0">Sin subcategoria</option>';
                        }
                        ?>

                    </select>
                </div>
                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="position: relative;left: 10px;">Para:</label>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <select id="area" name="area" class="form-control form-control-sm cnt-sm" onchange="llenapersonas()" style="width: 181px;left: 0px;position: absolute;" >
                        <option value='0' >Seleccione un Área</option>
                        <?php
                        $consultaperiodo = "SELECT a.Id_Area,a.Nombre FROM c_area as a WHERE a.estatus=1 ORDER BY a.Nombre";
                        $resultado = $catalogo->obtenerLista($consultaperiodo);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            if ($row['Id_Area'] == $id_area) {
                                $s = 'selected="selected"';
                            }
                            echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3" style="position: absolute;top: 0px;right: -22px;">
                    <select id="usuario" name="usuario" class="form-control form-control-sm cnt-sm" onChange="llena_area_usr()" style="width: 181px;" >
                        <option value='0' >Seleccione un usuario</option>
                        <?php
                        $consultaperiodo = "SELECT p.id_Personas,CONCAT( p.Nombre, ' ', p.Apellido_Paterno, ' ', p.Apellido_Materno ) encargado
                        FROM c_personas p
                            INNER JOIN c_area AS a ON a.Id_Area = p.idArea
                            JOIN c_usuario usu ON usu.IdPersona = p.id_Personas
                            WHERE  p.Activo=1 ORDER BY p.Nombre";
                        $resultado = $catalogo->obtenerLista($consultaperiodo);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $s = '';
                            if ($row['id_Personas'] == $id_encargado) {
                                $s = 'selected="selected"';
                            }
                            echo '<option value="' . $row['id_Personas'] . '" ' . $s . '>' . $row['encargado'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group form-group-sm" style="position: relative;top: -80px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="actTable">
                        <thead class="actTable">
                            <tr class="actTable" style="height: 26px;">
                                <th class="actTable nc1">&nbsp;&nbsp;&nbsp;Nombre</th>
                                <th class="actTable nc2">Encargado</th>
                                <th class="actTable nc3">Insumo(s)</th>
                                <th id="tipo" class="actTable nc4">Entregable(s)</th>
                                <th class="actTable nc5">.</th>
                            </tr>
                        </thead>
                        <tbody class="actTable">
                            <tr id="trGlobal">
                                <td class="nc1">
                                    <select id="AGlobal" name="AGlobal" class="form-control form-control-sm cnt-sm s1 d-none " onChange="llenageneral()" style="height: 24.5px !important">
                                        <?php
                                        if ($Subcategoria > 0) {
                                            $where = "AND ac.Idcategoria=$Subcategoria";
                                        } else {
                                            $where = "AND ac.Idcategoria=$Categoria";
                                        }
                                        $consultaperiodo6 = "SELECT
                                        a.IdActividad,
                                        CONCAT( ac.Numeracion, a.Nombre ) actividad
                                    FROM
                                        c_actividad a
                                        LEFT JOIN k_actividad_categoria ac ON ac.IdActividad = a.IdActividad
                                    WHERE
                                        ( a.IdNivelActividad = 1 AND IdTipoActividad = $ACME )
                                        AND ac.IdPeriodo = $periodo2 $where ORDER BY ac.Orden";
                                        // echo $consultaperiodo6;
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "0">Seleccione una Actividad global</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $Actividad_global) {
                                                $s = 'selected = "selected"';
                                            }
                                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                            $encargado_AG = $row['encargado'];
                                        }

                                        ?>
                                    </select>
                                </td>
                                <td id="1c2" class="nc2" data-toggle="tooltip" data-placement="top" title=""><?php echo $encargado_AG; ?></td>
                                <td id="1c3" class="nc3"></td>
                                <td id="1c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""></td>
                                <td id="1c5" class="nc5"></td>
                            </tr>
                            <tr id="trGeneral" <?php echo $general_ver; ?>>
                                <td class="nc1">
                                    <select id="AGeneral" name="AGeneral" class="form-control form-control-sm d-none cnt-sm s1" onChange="llenacheck()" style="height: 24.5px !important">
                                        <?php
                                        $consultaperiodo6 = "SELECT
                                        a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad,
                                        CONCAT(SUBSTRING( p.Nombre, 1, 1 ),p.Apellido_Paterno,
                                            '(',SUBSTRING( ac.Nombre, 1, 2 ),')' ) encargado
                                    FROM
                                        k_actividad_categoria aa
                                        INNER JOIN c_actividad a ON a.IdActividad = aa.IdActividad
                                        LEFT JOIN c_personas p ON p.id_Personas = a.IdResponsable
                                        LEFT JOIN c_area ac ON ac.Id_Area = p.idArea
                                        WHERE a.IdActividadSuperior=$Actividad_global AND aa.IdCategoria=$cate AND aa.IdPeriodo=$periodo2 ORDER BY aa.Orden";
                                        //echo $consultaperiodo6;
                                        $resultado6 = $catalogo->obtenerLista($consultaperiodo6);
                                        echo '<option value = "0">Seleccione una Actividad general</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdActividad'] == $Actividad_general) {
                                                $s = 'selected = "selected"';
                                            }
                                            echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                            $encargado_AGE = $row['encargado'];
                                        }

                                        ?>
                                    </select>
                                </td>
                                <td id="2c2" class="nc2" data-toggle="tooltip" data-placement="top" title=""><?php echo $encargado_AGE ?></td>
                                <td id="2c3" class="nc3"></td>
                                <td id="2c4" class="nc4" data-toggle="tooltip" data-placement="top" title=""></td>
                                <td id="2c5" class="nc5"></td>
                            </tr>
                            <tr id="trChecklist" <?php echo $check_ver; ?>>
                                <td class="nc1 ">
                                    <select id="Checklist" name='Checklist' class="form-control form-control-sm d-none cnt-sm s1 <?php echo $estilo_info_check ?>" onChange='llenadatoscheck()' style="height: 24.5px !important">
                                        <option value='0'>Selecciona un check</option>
                                        <?php
                                        if ($Subcategoria > 0) {
                                            $where = "AND kchac.Idcategoria=$Subcategoria";
                                        } else {
                                            $where = "AND kchac.Idcategoria=$Categoria";
                                        }
                                        $consultacheck = "SELECT ch.IdCheckList,ch.Nombre,CONCAT(SUBSTRING(p.Nombre,1,1),p.Apellido_Paterno,'(',SUBSTRING(ca.Nombre,1,2),')') encargado,kchac.Nombre_alterno,
                                                                  if(ISNULL(kchac.IdEncargado),CONCAT(SUBSTRING(p1.Nombre, 1, 1),' ',p1.Apellido_Paterno),CONCAT(SUBSTRING(p.Nombre, 1, 1),' ',p.Apellido_Paterno)) AS nombrepersona,
                                                                  if(ISNULL(kchac.IdEncargado),SUBSTRING(ca1.Nombre, 1, 2),SUBSTRING(ca.Nombre, 1, 2)) AS area_rec
                                                          FROM c_checkList ch
                                                          INNER JOIN k_checklist_actividad kchac ON kchac.IdCheckList = ch.IdCheckList
                                                          LEFT JOIN c_personas p on p.id_Personas=kchac.IdEncargado
                                	                        LEFT JOIN c_area ca on ca.Id_Area=p.idArea
                                                          left JOIN c_personas p1 ON p1.id_Personas = ch.IdResponsable
                                                          left JOIN c_area ca1 ON ca1.Id_Area = p1.idArea
                                                              WHERE kchac.IdActividad=$Actividad AND kchac.Id_Periodo=$periodo2 AND (ch.Nivel = 1 OR ch.Nivel = 3) $where";
                                        //echo $consultacheck;
                                        $resultado6 = $catalogo->obtenerLista($consultacheck);
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';
                                            if ($row['IdCheckList'] == $Check) {
                                                $s = 'selected = "selected"';
                                                if ($Subcheck == 0) {
                                                    if ($row['Nombre_alterno'] == "") {
                                                        $nombre_check = $row['Nombre'];
                                                    } else {
                                                        $nombre_check = $row['Nombre_alterno'];
                                                    }
                                                }
                                                $encargado_Check = $row['encargado'];
                                                $encargado_area = $row['area_rec'];
                                            }

                                            echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                        }

                                        ?>
                                    </select>
                                </td>
                                <td id="3c2" class="nc2 <?php echo $estilo_info_check ?>" data-toggle="tooltip" data-placement="top" title=""><?php echo $encargado_Check ?></td>
                                <td id="3c3" class="nc3 <?php echo $estilo_dan_check ?>"></td>
                                <td id="3c4" class="nc4 <?php echo $estilo_info_check ?>" data-toggle="tooltip" data-placement="top" title=""></td>
                                <td id="3c5" class="nc5 "></td>
                            </tr>
                            <tr id="trsubchecklist" <?php echo $subcheck_ver; ?>>
                                <td class="nc1">
                                    <select id="subchecklist" name='subchecklist' class="form-control form-control-sm d-none cnt-sm s1 <?php echo $estilo_info_subcheck ?>" onChange='' style="height: 24.5px !important">
                                        <?php
                                        if ($Subcategoria > 0) {
                                            $where = "AND che.Idcategoria=$Subcategoria";
                                        } else {
                                            $where = "AND che.Idcategoria=$Categoria";
                                        }
                                        $consultacheck = "SELECT
                                    ch.IdCheckList,
                                    ch.Nombre,CONCAT(SUBSTRING(p.Nombre,1,1),p.Apellido_Paterno,'(',SUBSTRING(a.Nombre,1,2),')') encargado,che.Nombre_alterno
                                FROM
                                    c_checkList ch
                                    INNER JOIN k_checklist_actividad che ON che.IdCheckList = ch.IdCheckList
                                    LEFT JOIN c_personas p on p.id_Personas=ch.IdResponsable
	                                LEFT JOIN c_area a on a.Id_Area=p.idArea
                                    WHERE che.IdActividad=$Actividad AND che.Id_Periodo=$periodo2 AND ch.Nivel=2 AND ch.IdCheckListPadre=$Check $where";
                                        echo $consultacheck;
                                        $resultado6 = $catalogo->obtenerLista($consultacheck);
                                        echo '<option value = "">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado6)) {
                                            $s = '';

                                            if ($row['IdCheckList'] == $Subcheck) {
                                                $s = 'selected = "selected"';
                                                $encargado_Subcheck = $row['encargado'];
                                            }
                                            if ($Subcheck != 0 && $row['IdCheckList'] == $Subcheck) {
                                                if ($row['Nombre_alterno'] == "") {
                                                    $nombre_check = $row['Nombre'];
                                                } else {
                                                    $nombre_check = $row['Nombre_alterno'];
                                                }
                                            }
                                            echo '<option value = "' . $row['IdCheckList'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td id="4c2" class="nc2 <?php echo $estilo_info_subcheck ?>" data-toggle="tooltip" data-placement="top" title=""><?php echo $encargado_Subcheck ?></td>
                                <td id="4c3" class="nc3 <?php echo $estilo_dan_subcheck ?>"></td>
                                <td id="4c4" class="nc4 <?php echo $estilo_info_subcheck ?>" data-toggle="tooltip" data-placement="top" title=""></td>
                                <td id="4c5" class="nc5 "></td>
                            </tr>
                        </tbody>
                        <tfoot class="actTable">
                            <tr class="actTable">
                                <th class="actTable nc1">&nbsp;&nbsp;&nbsp;</th>
                                <th class="actTable nc2"></th>
                                <th class="actTable nc3"></th>
                                <th id="tipo" class="actTable nc4"></th>
                                <th class="actTable nc5"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $id_usuario; ?>" />
            <input type="hidden" id="nombreUsuario" name="nombreUsuario" value="<?php echo $nombreUsuario; ?>" />
            <input type="hidden" id="tipoPerfil" name="tipoPerfil" value="<?php echo $tipoPerfil; ?>" />
            <input type="hidden" id="IdAreaOrigen" name="IdAreaOrigen" value="<?php echo $id_area_origen; ?>" />
            <input type="hidden" id="tamanoAreas" name="tamanoAreas" value="0">
            <input type="hidden" name="areaor" id="areaor" value="<?php echo $areaor; ?>">
            <div class="form-group form-group-sm" style="position: relative;top: -94px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <B><input id="tituloAsunto" name="titulo" class="form-control form-control-sm rounded-0" type="text" placeholder="Escribe el asunto" maxlength="120" style="font-size: 12px;background-color: #32c9e16e;" value="<?php echo $nombre_check; ?>"></B>
                </div>
            </div>
            <div class="form-group form-group-sm" style="position: relative;top:-108px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <textarea id="mensaje" name="mensaje" class="form-control type_msg bg-white" placeholder="Escribe....." maxlength="500" style="font-size:12px;width: 870px;"></textarea>
                </div>
            </div>
            <div class="form-group form-group-sm" style="position: relative;top:-123px;">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <button type="button" class="btn btn-default btn-xs" id="back" style="background-color: gray;color: white;width: 40px;"><span><i class="fas fa-arrow-left"></i></span></button>
                    <button type="button" class="btn btn-default btn-xs" id="guardar" style="position: absolute;top: -78px;left: 885px;width: 34px;height: 41px;background-color: #17a2b8;"><span><i class="fas fa-paper-plane" style="color: white;"></i></span></button>
                    <button type="button" id="adjuntar" class="btn btn-default btn-xs" style="position: absolute;top: -37px;left: 885px;width: 34px;height: 36px; font-size: 15px;    background-color: #e9ecef;"><i class="fas fa-paperclip"></i>
                		</button>
                </div>
                <label class="col-md-1 col-sm-1 col-xs-1  control-label" for="AÑO" style="position: relative;left: 213px;">invitados:</label>
                <select id="invA" class="form-control form-control-sm cnt-sm s3"  style="font-size:12px; display:inline-block; min-width: 150.75px !important; border-color: #eadfba;position: relative;left: 224px;">
                    <option value="-" selected>Seleccione un área</option>
                    <?php
                    $consultaperiodo = "SELECT a.Id_Area,a.Nombre FROM c_area as a WHERE a.estatus=1 ORDER BY a.Nombre";
                    $resultado = $catalogo->obtenerLista($consultaperiodo);
                    echo ' <option value = "">Seleccione un Área</option>';
                    while ($row = mysqli_fetch_array($resultado)) {
                        $s = '';
                        if ($row['Id_Area'] == $Area) {
                            $s = 'selected="selected"';
                        }
                        echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                    }
                    ?>
                </select>
                <!--<button id="agregarAreas" class="btn btn-info btn-sm cnt-sm"><i class="material-icons">person_add</i></button>-->

            </div>
            <div class="row" style="width:361.8px; float:right;">
                <div id="involucrados" class="col-12" style="position: absolute;top: 438px;">

                </div>
            </div>
    </div>

    <div style="top: -5px;" class="modal fade" id="Modal_altaarchivo" role="dialog">
        <div class="modal-dialog" style="top: 20px;" >
            <!-- Modal content-->
            <div class="modal-content" style="left: -62px;width: 624px;">
                <div class="modal-header h" style="padding: 7px 5px;">
                    <button type="button" class="close" data-dismiss="modal" id="cerrar_archivos" style="color: white;">&times;</button>
                    <span style="font-size: 1.1em;color: white;" >Adjuntar archivo</span>
                </div>

                <div class="modal-body detallearchivo" style="padding: 10px;">
                  <iframe style='display:none' id='frame' width="100%" height="15%" frameborder='0'></iframe>
                  <iframe style='display:none' id='frame_archivos' width="100%" height="25%" frameborder='0'></iframe>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
    back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
    };
    $('.check').change(function() {
        var check = $(this).val();
        $("#checkeck").val(check);
    });
    $("#invA").on("change", function(e) {
        invarea();
    });
    $("#area").on("click", function(e) {
        var checklist = $('#Checklist').val();
        if(checklist == 0 ){
          alert("El area y usuario se podran cambiar hasta una vez seleccionado el check");
        }
    });
    $("#usuario").on("click", function(e) {
        var checklist = $('#Checklist').val();
        if(checklist == 0 ){
          alert("El area y usuario se podran cambiar hasta una vez seleccionado el check");
        }
    });

    function invarea() {
        var contadorFila = $("#tamanoAreas").val();
        var area = $('#area').val();
        if ($("#invA").val() != "-" && $("#invA").val() != "<%=idProy%>" && $("#invA" + $("#invA").val()).length == 0 && $("#invA").val() != area) {
            $('#involucrados').append('<span id="areaI' + $("#invA").val() + '" class="badge badge-dark disable-select">' + $("#invA option:selected").text() + ' <i class="glyphicon glyphicon-remove" onclick="eliminarArea(' + $("#invA").val() + ')" style="font-size:9px;"></i></span>');
            $('#involucrados').append('<input id="invA' + $("#invA").val() + '" name="invitados' + contadorFila + '" value="' + $("#invA").val() + '" type="hidden">');
            contadorFila++;
            $("#tamanoAreas").val(contadorFila);
        } else {
            alert('El Área ya fue agregada o es el Área destino');
        }
    }

    function eliminarArea(am) {
        var contadorFila = $("#tamanoAreas").val();
        $("#areaI" + am).remove();
        $("#invA" + am).remove();
        contadorFila--;
        $("#tamanoAreas").val(contadorFila);
    }

    function eliminar(am) {
        $("#areaI" + am).remove();
        $("#invA" + am).remove();
    }
</script>

</html>
