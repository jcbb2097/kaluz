<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * *clases que usa el archivo
 */

include_once __DIR__ . "/../../session.php";
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('Classes/Planeacion.class.php');
include_once('Classes/Evidencias.class.php');

$catalogo = new Catalogo();
$obj = new Planeacion();
$Evidencia = new Evidencias();

/**
 * *declaramos las variables que recibiremos al entrer al archivo
 * *las declaramos en caso de que al entrar al archivo no vengan o se encuentren vacias para ivitar
 * *errores
 * 
 */

$editar = false;
$Id_Actividad = "";
$Id_eje = "";
$Id_categoria = "";
$Id_subcategoria = "";
$texto_actividad = "";
$Id_Actividad_superior = "";
$AGLOBAL = "";
$AGENEREAL = "";
$Nombreeje = "";
$ano = "";
$filtro = 0;
$ActVisible = 1;
$Periodo = "";
$ACME = "";
$titulo = "";
$descripcion = "";
$fecha = "";
$porcentaje_avance = 0;
$Nombre_subcategoria = "";
$Objetivo = "";
$Perfil = "";
$Id_usuario = "";
$Nombre_usuario = "";
$actividad = "";
$cate = "";
$check_ver = '';
$color_v = "";
$onclick_insumos2 = "";
$onclick_asunto2 = "";

/**
 * esta parte no recuerdo para que sirve conforme valla recordadno cambiare este comentario 
 * Todo: revisar para que sirve esta variable de filtro
 */
if (isset($_GET['filtro']) && $_GET['filtro'] != "") {
    $filtro = $_GET['filtro'];
} else {
    $filtro = 0;
}

/**
 * aqui asiganamos por el metodo get las variables que creamos arriba a las que
 *  recivimos al entrar al archivo
 */

if (isset($_GET['accion']) && $_GET['accion'] != "") {
    $Id_Actividad = $_GET['Id_actividad']; //id de la actividad a la que entramos 
    $Id_categoria = $_GET['Id_categoria']; //id de la categoria
    $Id_subcategoria = $_GET['Id_subcategoria']; //en caso de tener id de la subcategoria
    $ACME = $_GET['ACME']; // 1 si es actividad, 2 si es meta
    $Periodo = $_GET['Periodo']; // id del periodo
    $Nombreeje = $_GET['Nombreeje']; // nombre del eje
    $ano = $_GET['ano']; // año en el que nos encontramos
    $Perfil = $_GET['Perfil']; // id del tipo perfil del que entra
    if (isset($_SESSION['user_session'])) {
        $Id_usuario = $_SESSION['user_session'];
    }
    $Nombre_usuario = $_GET['nombreUsuario']; //nombre del usuario

    /**
     * todo: no recuerdo para que cree esta variable 
     * revisarla
     */
    $check_ver = $_GET['check'];

    $Id_Actividad_superior = $_GET['Id_actividadsuperior']; // id de la actividad superior si la tiene


    /**
     * ?esta parte se realizo para aser bien las asignaciones de actividad y categoria para las consultas dentro del archivo
     */

    if ($Id_Actividad_superior > 0) {
        // en esta parte si el id es mayor que 0 eso significa que tiene una actividad superior asi que le asignamos de manera correcta
        $AGLOBAL = $Id_Actividad_superior;
        $AGENEREAL = $Id_Actividad;
        $actividad = $Id_Actividad;
    } else {
        // de manera contraria la actividad primaria sera la que entra
        $AGLOBAL = $Id_Actividad;
        $AGENEREAL = $Id_Actividad_superior;
        $actividad = $Id_Actividad;
    }
    //hacemos lo mismo para las categorias
    if ($Id_subcategoria > 0) {
        $cate = $Id_subcategoria;
    } else {
        $cate = $Id_categoria;
    }
}
// esta avriables nos pidieron para dependiendo el año asignar el color
$color_anio = "";
if ($ano == 2021) {
    $color_anio = '4ffa2d';
} else {
    $color_anio = 'ffef5e';
}
// aqui consultamos a base de datos el avance de la actividad o meta 
$avance = $obj->avance($actividad, $Periodo, $cate);
//aqui consultamos el nombre de la categoria 
$Nombre_categoria = $Evidencia->Categoria($Id_categoria, $ano, $Id_eje);
//en caso de existir la subcategoria obtenemos su nombre de esta
if ($Id_subcategoria > 0) {
    $Nombre_subcategoria = $Evidencia->Subcategoria($Id_subcategoria, $ano, $Id_eje);
}
//obtenemos la informacion de la actividad
$Actividad = $Evidencia->Actividad($actividad, $cate, $Periodo);

/**
 * ?si no mal recuerdo aqui obtenemos la informacion de la meta para poder aser el swich a meta si se desea
 */
if ($ACME == 1) {
    $IdMeta = $Evidencia->getMeta($Actividad[1], $cate, $Periodo);
    $metastyle = '0px';
} else {
    $metastyle = '50px';
}

$Id_eje = $Actividad[6]; //asiganamos el id del eje
$nombreac = "'" . $Actividad[1] . "'"; //asignamos el nombre de la actividad
$titulo = 'Planeación ' . $ano; //concatenamos el año a la planeacion


/**
 * ?aqui  creamos el clik para ir al achivo alta entregable 
 */
$onclick_form2 = '../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=' . $Perfil . '&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $Id_eje . '&ACME=' . $ACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' .
    $AGENEREAL . '&periodo=' . $Periodo . '&check=&subcheck=&regreso=2&tipo_entregable=' . $Actividad[11] . '&check_global=' . $Actividad[12];
/**
 * ?aqui  creamos el clik para ver las versiones de los entregables 
 */
$onclick_versiones2 = 'onclick="muestraversiones(' . $nombreac . ',' . $Actividad[12] . ' ,' . $ACME . ', ' . $Actividad[4] . ',' . $cate . ', ' . $Periodo . ')"';
/**
 * ?aqui  creamos el clik para los asuntos 
 */
$onclick_asunto2 = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=' . $Perfil . '&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $Id_eje . '&ACME=' .
    $ACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' .
    $Periodo . '&check=' . $Actividad[12] . '&subcheck=0&regreso=2&tipo_entregable=' . $Actividad[11] . '&id_encargado=' . $Actividad[15] . '&id_area=' . $Actividad[16] . '"';
/**
 * ?aqui  creamos el clik para los checks
 */
$onclick_check2 = $Actividad[8];
$acen = $Actividad[1] . '-' . $Actividad[2];

?>

<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="css/Planeacion_avance.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="../../../resources/js/aplicaciones/Permisos.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="Js/Alta_check.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
    <style media="screen">
        .numcheck_glob {
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 120px !important;
            max-width: 120px !important;
        }
    </style>
    <title>::.FORMULARIO Logros.::</title>


</head>

<body>
    <?php echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    $id_encargado_global = "";
    $id_encargado_global = $Actividad[15];
    if ($id_encargado_global == '') {
        $id_encargado_global = 0;
    }
    ?>
    <div id="container-fluid">
        <div class="well23 "><a onclick="back();" style="color:#fefefe;"><?php echo $Nombreeje ?> / <a style="color:#<?php echo $color_anio; ?>;" href="javascript:window.location.reload(true)"><?php echo $titulo; ?></a></b>
        </div>
        <form class="form-horizontal" id="formlogro" name="formlogro">
            <div class="form-group form-group-sm">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-bordered check" id="check">
                        <thead class="table-header check">
                            <tr class="check">
                                <th class="check A1">Categoría</th>
                                <th class="check A2">Subcategoría</th>
                                <th class="check A3"><?php echo $Actividad[0] ?></th>
                                <th class="check A5">Entregable</th>
                                <th class="check A6">Acciones</th>
                                <th class="check A7">Avance</th>

                            </tr>
                        </thead>
                        <tbody class="check">
                            <tr class="<?php echo $Actividad[14]; ?>">
                                <th class="A1" style="padding-left: 5px;overflow: hidden;text-overflow: ellipsis;vertical-align: middle;">

                                    <span class="ca" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $Nombre_categoria ?>"><?php echo $Nombre_categoria ?></span>
                                    <br>
                                    <?php if ($Actividad[13] == 1) { ?>
                                        <span onclick="De_ativate_chech(<?php echo $Actividad[12] ?>,2,<?php echo $Periodo ?>,0,<?php echo $Actividad[4] ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" data-original-title="ocultar check" style="color: purple;"></i></span>
                                    <?php   } else { ?>
                                        <span onclick="De_ativate_chech(<?php echo $Actividad[12] ?>,1,<?php echo $Periodo ?>,0,<?php echo $Actividad[4] ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-eye-slash" data-toggle="tooltip" data-placement="top" data-original-title="Activar check" style="color: purple;"></i></span>
                                    <?php   } ?>
                                    <span onclick="edita_check(<?php echo $Actividad[12] ?>,'check',<?php echo $id_encargado_global ?>);" style="display: inline-block;margin-left: 1px;"><i class="fa fa-list-alt" data-toggle="tooltip" data-placement="top" data-original-title="Editar check global" style="color: purple;"></i></span>

                                </th>
                                <th class="A2" style="padding-left: 5px;overflow: hidden;text-overflow: ellipsis;vertical-align: middle;">
                                    <span class="subca" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $Nombre_subcategoria ?>"> <?php echo $Nombre_subcategoria ?></span>
                                </th>
                                <th class="A3" style="padding-left: 5px;overflow: hidden;text-overflow: ellipsis;vertical-align: middle;">

                                    <span class="ca" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $acen ?>"><?php echo $acen ?></span>
                                </th>

                                <th class="A5" style="padding-left: 5px;overflow: hidden;text-overflow: ellipsis;vertical-align: middle;">

                                    <span style="position: absolute;" onclick="muestra_insumos(1,<?php echo $Actividad[12]; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>)"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de entrada"></i></span>
                                    <span onclick="alta_insumo(<?php echo $Actividad[12]; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>,'<?php echo "Check global act :" . $acen; ?>',1)" style="position: absolute;margin-top: 18px;margin-left: -9px;">&nbsp;&nbsp;<i data-toggle="tooltip" data-placement="top" data-original-title="Añadir insumo entrada"><img src='./css/insumo.jpeg' width="16px" height="10px" /></i> </span>
                                    <?php if ($ACME == 2) {
                                        $color_entregable = "color:#2132c8;font-size:.8em;";
                                    } else {
                                        $color_entregable = "color:purple;font-size:.8em;";
                                    }
                                    ?>
                                    <span class="numcheck_glob" data-toggle="tooltip" data-placement="bottom" style="padding-left: 18px;<?php echo $color_entregable; ?>" data-original-title="<?php echo $Actividad[3] ?>"><?php echo $Actividad[3] ?></span>
                                    <span style="position: absolute;" onclick="muestra_insumos(2,<?php echo $Actividad[12]; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>)"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de salida"></i></span>
                                    <span onclick="alta_insumo(<?php echo $Actividad[12]; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>,'<?php echo "Check global act :" . $acen; ?>',2)" style="position: absolute;margin-top: 18px;margin-left: -9px;">&nbsp;&nbsp;<i data-toggle="tooltip" data-placement="top" data-original-title="Añadir insumo salida"><img src='./css/insumo.jpeg' width="16px" height="10px" /></i> </span>
                                </th>
                                <th class="A6" style="overflow: hidden;text-overflow: ellipsis;vertical-align: middle;">
                                    <span><a <?php echo $onclick_check2 ?> style="display: inline-block;color:<?php echo $Actividad[9] ?>;"><i class="fas fa-file-archive" data-toggle="tooltip" data-placement="bottom" data-original-title="Último archivo"></i></a></span>
                                    <span><a <?php echo $onclick_versiones2 ?> style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Versiones" class="fas fa-archive"></i></a></span>
                                    <?php if ($Actividad[10] != 10) { ?>
                                        <span><a style="color: purple;display: inline-block;" href="<?php echo $onclick_form2 ?>"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Añadir entregable" class="fas fa-plus-circle"></i></a></span>
                                    <?php } ?>
                                    <span><a <?php echo $onclick_asunto2 ?> style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Redactar asunto" class="far fa-edit"></i><a></span>
                                    <!-- <span><a <?php echo $onclick_insumos2 ?> style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Insumos" class="fas fa-coins"></i></a></span> -->

                                </th>
                                <th class="A7" style="padding-left: 5px;overflow: hidden;text-overflow: ellipsis;vertical-align: middle;">
                                    <progress id="file" style="padding-left: 5px;width: 20px;" max="100" value="<?php echo round($avance, 1); ?>"></progress> <span><?php echo round($avance, 1); ?> %</span>
                                </th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="check">
                                <th class="check"></th>
                                <th class="check"></th>
                                <th class="check"></th>
                                <th class="check"></th>
                                <th class="check"></th>
                                <th class="check"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-bordered check" id="check">
                        <thead class="table-header check">
                            <tr class="check">
                                <th class="check nc1">
                                    <p style="cursor: pointer;position: absolute;top: 10;left: 36;"><i class="far fa-plus-square" onclick="alta_check(0,'check');" data-toggle="tooltip" data-placement="top" data-original-title="Añadir check"></i></p>
                                </th>
                                <th class="check nc2">Check</th>
                                <th class="check nc3">F. planeada</th>
                                <th class="check nc4">F. final</th>
                                <th class="check nc5">Acciones</th>
                                <th class="check nc6">Avance <?php echo round($avance) ?> %</th>
                            </tr>
                        </thead>
                        <tbody class="check">
                            <?php
                            $consulta_entregable = "SELECT
                            c.IdCheckList,
                            if(isnull(ca.IdEncargado),CONCAT( '-', SUBSTRING( p.Nombre, 1, 1 ), p.Apellido_Paterno, '(', ac.Nombre, ')' ),
									 CONCAT( '-', SUBSTRING( p1.Nombre, 1, 1 ), p1.Apellido_Paterno, '(', ac1.Nombre, ')' ) )
									  encargado,
                            ca.Archivo,c.Nivel,c.tipo,ca.Avance,d.ruta,d.pdf,d.id_tipo,
                            ca.Fecha_entrega_propuesta,ca.Orden,ca.Fecha_entrega_final,
                            CONCAT( 'Insumos: ', ac.Nombre ) area_insumo,ac.Id_Area AS id_area,c.automatico,ca.Visible,ca.Nombre_alterno,
                        CASE
                                WHEN ca.IdEncargado != '' THEN
                                ca.IdEncargado ELSE c.IdResponsable
                            END AS IdEncargado,
                        CASE
                                WHEN ca.Nombre_alterno != '' THEN
                                ca.Nombre_alterno ELSE c.Nombre
                            END AS Nombre,ca.Entregable
                        FROM k_checklist_actividad ca
                            LEFT JOIN c_checkList c ON c.IdCheckList = ca.IdCheckList
                            LEFT JOIN c_documento d ON d.id_documento = ca.Archivo
                            LEFT JOIN c_personas p ON p.id_Personas = c.IdResponsable
                            LEFT JOIN c_personas p1 ON p1.id_Personas = ca.IdEncargado
                            LEFT JOIN c_area ac ON ac.Id_Area = p.idArea
                            LEFT JOIN c_area ac1 ON ac1.Id_Area = p1.idArea
                        WHERE ca.IdActividad = $Id_Actividad AND ca.Id_Periodo = $Periodo
                            AND Nivel = 1 AND ca.IdCategoria =$cate
                        ORDER BY ca.Orden";
                            //echo $consulta_entregable;
                            $resultado_entregable = $catalogo->obtenerLista($consulta_entregable);
                            $orden_check = 1;
                            $num_check = 0;
                            $avance_checklist = 0;
                            $id_encargado = "";
                            $ruta = "";
                            $tipo = "'check'";
                            $color = "red";
                            while ($row = mysqli_fetch_array($resultado_entregable)) {
                                if ($row['Visible'] == 1) {
                                    $active = "active";
                                } else {
                                    $active = "desactive";
                                }
                                $n_check_v = $row['Nombre'];
                                $n_check_v = preg_replace("[\n|\r|\n\r]", "", $n_check_v);
                                $id_encargado = $row['IdEncargado'];
                                if ($id_encargado == '') {
                                    $id_encargado = 0;
                                }
                                //$n_encargado = $Evidencia->get_Encargado($id_encargado);
                                $n_encargado = $row['encargado'];
                                $nombrecheck = "'" . $n_check_v . "'";
                                $idcheck = $row['IdCheckList'];
                                $check_hijos = 0;
                                $id_area = $row['id_area'];
                                $ruta = $row['ruta'] . $row['pdf'];
                                $avance_checklist = intval($row['Avance']);
                                if ($row['tipo'] == 2) {
                                    $consulta_check_hijos = "SELECT COUNT(ch.IdCheckList) numcheck FROM k_checklist_actividad ch INNER JOIN c_checkList c on c.IdCheckList=ch.IdCheckList WHERE c.IdCheckListPadre=$idcheck AND ch.Id_Periodo=$Periodo AND ch.IdActividad=$Id_Actividad AND ch.IdCategoria=$cate";
                                    //echo$consulta_check_hijos;
                                    $resultado_check_hijo = $catalogo->obtenerLista($consulta_check_hijos);
                                    while ($row2 = mysqli_fetch_array($resultado_check_hijo)) {
                                        $check_hijos = $row2['numcheck'];
                                    }
                                    $icono = '<i class="fas fa-bars"></i>';
                                    $onclick_check = ' onclick="muestraDetalle(' . $nombrecheck . ',' . $idcheck . ',' . $Periodo . ',' . $Id_Actividad . ',' . $check_hijos . ');"';
                                } else {
                                    if ($row['automatico'] == 0) {
                                        $icono = '<i class="fas fa-file-archive" data-toggle="tooltip" data-placement="top" data-original-title="Último archivo"></i>';
                                    } else {
                                        $icono = '<i class="fas fa-laptop-code" data-toggle="tooltip" data-placement="top" data-original-title="BD"></i>';
                                    }
                                    if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                                        $onclick_check = 'target="_blank" href="' . $row['ruta'] . '"';
                                    } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                                        $onclick_check = 'target="_blank" href="' . $ruta . '"';
                                    } else {
                                        $onclick_check = "";
                                    }
                                }
                                if ($check_hijos > 0) {
                                    $n_t = $orden_check . '.-' . $n_check_v . ' (' . $check_hijos . ')' . $n_encargado;
                                    $n_ch = '<b> ' . $orden_check . '.-' . $n_check_v . ' (' . $check_hijos . ')</b>' . $n_encargado;
                                } else {
                                    $n_ch = '<b> ' . $orden_check . '.-' . $n_check_v . '</b>' . $n_encargado;
                                    $n_t = $orden_check . '.-' . $n_check_v . '' . $n_encargado;
                                }
                                $nombrecheck2 = "'" . $orden_check . '.-' . $n_check_v . ' (' . $check_hijos . ")" . "'";
                                $tipo_entregable = "";

                                if ($avance_checklist >= 1 && $avance_checklist <= 24) {
                                    $color = "dfa739";
                                    $tipo_entregable = 9;
                                } elseif ($avance_checklist >= 25 && $avance_checklist <= 49) {
                                    $color = "#dfa739";
                                    $tipo_entregable = 14;
                                } elseif ($avance_checklist >= 50 && $avance_checklist <= 99) {
                                    $color = "#dbd909";
                                    $tipo_entregable = 10;
                                } elseif ($avance_checklist >= 100) {
                                    $color = "#33ab15";
                                } else {
                                    $color = "red";
                                    $tipo_entregable = 9;
                                }
                                $AI = "'Alta_asunto.php?accion=guardar&tipoPerfil=" . $Perfil . "&nombreUsuario=" . $Nombre_usuario . "&idUsuario=" . $Id_usuario . "&plan=1&Id_eje=" . $Id_eje . "&ACME=" . $ACME . "&cate=" . $Id_categoria . "&subcate=" . $Id_subcategoria . "&AGBL=" . $AGLOBAL . "&AGENE=" . $AGENEREAL . "&periodo=" . $Periodo . "&check=" . $idcheck . "&subcheck=0&regreso=2&tipo_entregable=" . $tipo_entregable . "&id_encargado=" . $id_encargado . "&id_area=" . $id_area . "'";
                                $onclick_versiones = ' onclick="muestraversiones(' . $nombrecheck . ',' . $idcheck . ',' . $ACME . ',' . $Id_Actividad . ',' . $cate . ',' . $Periodo . ');"';
                                $onclick_insumos = ' onclick="muestrainsumos(' . $nombrecheck2 . ',' . $idcheck . ',' . $AI . ');"';
                                $onclick_form = 'href="../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=' . $Perfil . '&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $Id_eje . '&ACME=' . $ACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' . $Periodo . '&check=' . $idcheck . '&subcheck=&regreso=2&tipo_entregable=' . $tipo_entregable . '"';
                                $onclick_asunto = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=' . $Perfil . '&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $Id_eje . '&ACME=' . $ACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' . $Periodo . '&check=' . $idcheck . '&subcheck=0&regreso=2&tipo_entregable=' . $tipo_entregable . '&id_encargado=' . $id_encargado . '&id_area=' . $id_area . '"';


                            ?>
                                <tr class="<?php echo $active; ?>" id="check_re_<?php echo $num_check ?>" style="height: <?php echo $metastyle ?>;">
                                    <th class="nc1" style="padding-left: 5px;">


                                        <?php if ($row['Visible'] == 1) { ?>
                                            <span onclick="De_ativate_chech(<?php echo $idcheck ?>,2,<?php echo $Periodo ?>,<?php echo $check_hijos ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" data-original-title="ocultar check" style="color: purple;"></i></span>
                                        <?php   } else { ?>
                                            <span onclick="De_ativate_chech(<?php echo $idcheck ?>,1,<?php echo $Periodo ?>,<?php echo $check_hijos ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-eye-slash" data-toggle="tooltip" data-placement="top" data-original-title="ocultar check" style="color: purple;"></i></span>
                                        <?php   } ?>
                                        <span onclick="edita_check(<?php echo $idcheck ?>,'check',<?php echo $id_encargado ?>);" style="display: inline-block;"><i class="fa fa-list-alt" data-toggle="tooltip" data-placement="top" data-original-title="Editar check" style="color: purple;"></i></span>
                                        <?php if ($Id_usuario == 1064 || $Id_usuario == 5 || $Id_usuario == 1 || $Id_usuario == 1145) { ?>
                                            <span onclick="eliminar_check(<?php echo $idcheck ?>,<?php echo $Id_Actividad ?>,<?php echo $Periodo ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" data-original-title="Elimina check" style="color: purple;"></i></span>
                                        <?php   } ?>

                                    </th>
                                    <th class="nc2" style="padding-left: 2px;">
                                        <div>
                                            <span style="position: absolute;" onclick="muestra_insumos(1,<?php echo $idcheck; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>)"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de entrada"></i></span>
                                            <span style="position: absolute;margin-top: 18px;margin-left: -7px;" onclick="alta_insumo(<?php echo $idcheck; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>,'<?php echo $n_check_v; ?>',1)" style="display: inline-block;">&nbsp;&nbsp;<i data-toggle="tooltip" data-placement="top" data-original-title="Añadir insumo entrada"><img src='./css/insumo.jpeg' width="16px" height="10px" /></i> </span>
                                            <p style="padding-left: 27px;" class="numcheck" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $n_t; ?>"><?php echo $n_ch; ?></p>
                                            <span style="position: absolute;" onclick="muestra_insumos(2,<?php echo $idcheck; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>)"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de salida"></i></span>
                                            <span onclick="alta_insumo(<?php echo $idcheck; ?>,<?php echo $Id_Actividad ?>,<?php echo $cate ?>,<?php echo $Periodo ?>,<?php echo $ACME ?>,'<?php echo $n_check_v; ?>',2)" style="position: absolute;margin-top: 18px;margin-left: -9px;">&nbsp;&nbsp;<i data-toggle="tooltip" data-placement="top" data-original-title="Añadir insumo salida"><img src='./css/insumo.jpeg' width="16px" height="10px" /></i> </span>
                                        </div>
                                        <div>
                                            <?php
                                            if ($ACME == 2) {
                                                $color_entregable = "color:#2132c8;font-size:.8em;";
                                            } else {
                                                $color_entregable = "color:purple;font-size:.8em;";
                                            }

                                            if ($row['Entregable'] != '') { ?>
                                                <p class="breakAll narrow" style="<?php echo $color_entregable; ?>"><?php echo $row['Entregable'] ?></p>
                                            <?php  } ?>
                                        </div>

                                    </th>
                                    <th class="nc5">
                                        <?php if ($row['Fecha_entrega_propuesta'] == null || $row['Fecha_entrega_propuesta'] == '') {
                                            echo 'sin fecha propuesta';
                                        } else {
                                            echo $row['Fecha_entrega_propuesta'];
                                        } ?>
                                    </th>
                                    <th class="nc6">
                                        <?php if ($row['Fecha_entrega_final'] == null || $row['Fecha_entrega_final'] == '') {
                                            echo 'sin finalizar';
                                        } else {
                                            echo $row['Fecha_entrega_final'];
                                        }
                                        ?></th>
                                    <th class="nc3">
                                        <?php if ($row['Archivo'] != '' && $row['tipo'] == 1) { ?>
                                            <span><a <?php echo $onclick_check ?> style="display: inline-block;color:<?php echo $color ?>;"><?php echo $icono; ?></a></span>
                                        <?php  } elseif ($row['Archivo'] == '' && $row['tipo'] == 1) { ?>
                                            <span><a <?php echo $onclick_check ?> style="display: inline-block;color:<?php echo $color ?>;"><?php echo $icono; ?></a></span>
                                        <?php  } elseif ($row['Archivo'] == '' && $row['tipo'] == 2) { ?>
                                            <span><a <?php echo $onclick_check ?> style="display: inline-block;color:<?php echo $color ?>;"><?php echo $icono; ?></a></span>
                                        <?php } elseif ($row['Archivo'] != '' && $row['tipo'] == 2) { ?>
                                            <span><a <?php echo $onclick_check ?> style="display: inline-block;color:<?php echo $color ?>;"><?php echo $icono; ?></a></span>
                                        <?php } ?>
                                        <?php if ($row['tipo'] == 1) { ?>
                                            <span <?php echo $onclick_versiones ?> style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="top" data-original-title="Versiones" class="fas fa-archive"></i></span>
                                            <?php if ($row['id_tipo'] != 10 && $row['automatico'] == 0) { ?>
                                                <span><a style="color: purple;display: inline-block;" <?php echo $onclick_form ?>><i data-toggle="tooltip" data-placement="top" data-original-title="Añadir entregable" class="fas fa-plus-circle"></i></a></span>
                                            <?php } ?>
                                        <?php } ?>

                                        <span><a <?php echo $onclick_asunto ?> style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="top" data-original-title="Redactar asunto" class="far fa-edit"></i><a></span>
                                        <!-- <span><a <?php echo $onclick_insumos ?> style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="top" data-original-title="Insumos" class="fas fa-coins"></i></a></span> -->
                                        <?php if ($ACME == 1) { ?>
                                            <span><a style="display: inline-block;color:purple" onclick="setMeta(<?php echo $idcheck ?>,<?php echo $row['tipo'] ?>,1);"><i data-toggle="tooltip" data-placement="top" data-original-title="Aplicar mejora" class="fab fa-maxcdn"></i></a></span>
                                        <?php } ?>
                                    </th>
                                    <th class="nc4">
                                        <progress id="file" style="width: 32px;" max="100" value="<?php echo $avance_checklist ?>"></progress> <span><?php echo $avance_checklist ?> %</span>
                                    </th>

                                </tr>
                                <tr class="active insumo" id="check_re_insu_<?php echo $num_check ?>">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            <?php
                                $num_check++;
                                $orden_check++;
                                $check_hijos = "";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="check">
                                <th class="check nc1"></th>
                                <th class="check nc2"></th>
                                <th class="check nc3"></th>
                                <th class="check nc4"></th>
                                <th class="check nc5"></th>
                                <th class="check nc6"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
            <input type="hidden" id="Periodo" name="Periodo" value="<?php echo $Periodo ?>" />
            <input type="hidden" id="fecha_check" name="fecha_check" value="<?php echo $fecha ?>" />
            <input type="hidden" id="tipo" name="tipo" value="<?php echo $ACME ?>" />
            <input type="hidden" id="Nombreeje" name="Nombreeje" value="<?php echo $Nombreeje ?>" />
            <input type="hidden" id="ano" name="ano" value="<?php echo $ano ?>" />
            <input type="hidden" id="Perfil" name="Perfil" value="<?php echo $Perfil ?>" />
            <input type="hidden" id="Id_usuario" name="Id_usuario" value="<?php echo $Id_usuario ?>" />
            <input type="hidden" id="nombreUsuario" name="nombreUsuario" value="<?php echo $Nombre_usuario ?>" />
            <input type="hidden" id="check_ver" name="check_ver" value="<?php echo $check_ver ?>" />
            <input type="hidden" id="categoria" name="categoria" value="<?php echo $Id_categoria ?>" />
            <input type="hidden" id="subcategoria" name="subcategoria" value="<?php echo $Id_subcategoria ?>" />
            <input type="hidden" id="actividadg" name="actividadg" value="<?php echo $AGENEREAL ?>" />
            <input type="hidden" id="actividadblo" name="actividadblo" value="<?php echo $AGLOBAL ?>" />
            <input type="hidden" id="activ" name="activ" value="<?php echo $actividad ?>" />
            <input type="hidden" id="eje" name="eje" value="<?php echo $Actividad[6] ?>" />
            <input type="hidden" id="filtro" name="filtro" value="<?php echo $filtro  ?>" />
            <input type="hidden" id="actividad_superior" name="actividad_superior" value="<?php echo $Id_Actividad_superior  ?>" />
            <input type="hidden" id="acmeta" name="acmeta" value="<?php echo $IdMeta  ?>" />
            <div class="form-group form-group-sm">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button type="button" style="float: left; background-color:  #e8b509 ;" class="btn btn-default btn-xs" id="regresar" onclick="back();">Regresar</button>
                </div>

            </div>
        </form>
    </div>

    <div style="top: -73px;" class="modal fade check" id="modal_insumos_alta" role="dialog">

        <div class="modal-dialog" style="top: 170px;position: absolute;left: 25px;width: 784px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header h" style="padding: 7px 5px;font-size: 11px;">
                    <button type="button" class="close" id="cerrar_insumos" data-dismiss="modal" style="color: white;font-size: 15px;">&times;</button>
                    <span style="font-size: 11px;color: white;" id="titulo_insumos_alta"></span>
                </div>
                <div class="modal-body detalle_insumo_alta" style="padding: 10px;"></div>
            </div>
        </div>
    </div>
    <div style="top: -73px;" class="modal fade check" id="modal_insumos" role="dialog">

        <div class="modal-dialog" style="top: 170px;position: absolute;left: 25px;width: 784px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header h" style="padding: 7px 5px;font-size: 11px;">
                    <button type="button" class="close" data-dismiss="modal" id="modal_insumos_cross" style="color: white;font-size: 15px;">&times;</button>
                    <span style="font-size: 11px;color: white;" id="titulo_insumos"></span>
                </div>
                <div class="modal-body detalle_insumo" style="padding: 10px;"></div>
            </div>
        </div>
    </div>
    <div style="top: -73px;" class="modal fade check" id="myModal" role="dialog">

        <div class="modal-dialog" style="top: 150px;position: absolute;left: 20px;width: 784px;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header h" style="padding: 7px 5px;font-size: 11px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white;font-size: 15px;">&times;</button>
                    <span style="font-size: 11px;color: white;" id="titulo_modal"></span>
                </div>
                <div class="modal-body detalle" style="padding: 10px;"></div>
            </div>
        </div>
    </div>



</body>
<script>
    $('document').ready(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    /**
     * ?funcion para mostrar el detall
     */
    function muestraDetalle(nombre_check, id_check, periodo, id_actividad, num_hijos) {
        var id_check = id_check;
        var periodo = periodo;
        var id_actividad = id_actividad;
        var num_hijos = num_hijos;
        var titulo;
        var Perfil = $('#Perfil').val();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var IdEje = $('#eje').val();
        var tipo = $('#tipo').val();
        var cate = $('#categoria').val();
        var subcate = $('#subcategoria').val();
        var actividad_s = $('#actividad_superior').val();
        $(".h").css('background-color', "#5a274f");
        $(".h").css('color', "white");

        $("#myModal").modal({
            backdrop: false
        });
        if (num_hijos > 0) {
            titulo = nombre_check + ' (' + num_hijos + ')';
        } else {
            titulo = nombre_check;
        }
        $("#titulo_modal").html(titulo);
        $.post("Checklist.php", {
            id_check: id_check,
            periodo: periodo,
            id_actividad: id_actividad,
            Perfil: Perfil,
            Id_usuario: Id_usuario,
            nombreUsuario: nombreUsuario,
            IdEje: IdEje,
            tipo: tipo,
            cate: cate,
            subcate: subcate,
            actividad_superior: actividad_s,

        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });

    }

    /**
     * ?funcion para mostrar veriones de la actividad
     * !no se usa pero lo dejare aqui por cualuier cosa
     * 
     */

    function muestraversionesActividad(nombre_check, tipo, Id_actividad, Id_categoria, periodo) {

        var titulo = "Entregables de " + nombre_check;
        var tipo = tipo;
        var Id_actividad = Id_actividad;
        var Id_categoria = Id_categoria;
        var periodo = periodo;
        $(".h").css('background-color', "#5a274f");
        $(".h").css('color', "white");
        $(".h").css('font-size', "11px");
        $("#myModal").modal({
            backdrop: false
        });
        $("#titulo_modal").html(titulo);
        $.post("VersionesAcme.php", {
            Id_actividad: Id_actividad,
            tipo: tipo,
            Id_categoria: Id_categoria,
            periodo: periodo,

        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });

    }

    /**
     * ?funcion para mostrar las versiones
     */

    function muestraversiones(nombre_check, Id_check, tipo, Id_actividad, Id_categoria, periodo) {
        var titulo = "Entregables del " + tipo + ' ' + nombre_check;
        var Id_check = Id_check;
        var tipo = tipo;
        var Id_actividad = Id_actividad;
        var Id_categoria = Id_categoria;
        var periodo = periodo;
        $(".h").css('background-color', "#5a274f");
        $(".h").css('color', "white");
        $(".h").css('font-size', "11px");
        $("#myModal").modal({
            backdrop: false
        });
        $("#titulo_modal").html(titulo);
        $.post("Versiones.php", {
            Id_actividad: Id_actividad,
            tipo: tipo,
            Id_check: Id_check,
            Id_categoria: Id_categoria,
            periodo: periodo,

        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });

    }

    /**
     * ?mostar los insumos
     */

    function muestrainsumos(nombre_check, id_check, click) {
        var titulo = "Insumos de" + ' ' + nombre_check;
        var Id_check = id_check;
        var Click = click;

        $(".h").css('background-color', "#5a274f");
        $(".h").css('color', "white");
        $(".h").css('font-size', "11px");
        $("#myModal").modal({
            backdrop: false
        });
        $("#titulo_modal").html(titulo);
        $.post("Insumos.php", {
            Id_check: Id_check,
            Click: Click,
        }, function(data) {
            $(".detalle").html('');
            $(".detalle").html(data);
        });

    }

    /**
     * ?funcion para regresar a la pantalla anterior
     */

    function back() {
        const IdEje = $('#eje').val();
        const Periodo = $('#Periodo').val();
        const tipo = $('#tipo').val();
        const Nombreeje = $('#Nombreeje').val();
        const ano = $('#ano').val();
        const Perfil = $('#Perfil').val();
        const Id_usuario = $('#Id_usuario').val();
        const Nombre_usuario = $('#Nombre_usuario').val();
        const check = $('#check_ver').val();
        const cate = $('#categoria').val();
        const subcate = $('#subcategoria').val();
        const filtro = $('#filtro').val();
        url = "Planeacion_avance_acme.php?IdEje=" + IdEje + "&Periodo=" + Periodo + "&tipo=" + tipo + "&nombreeje=" + Nombreeje + "&ano=" + ano + "&nombreUsuario=" + Nombre_usuario + "&Id_usuario=" + Id_usuario + "&Perfil=" + Perfil + "&check=" + check + "&filtro=" + filtro;
        $(location).attr('href', url);
    }

    /**
     * ?funcion para dar de alta un check
     */

    function alta_check(id, tipocheck) {
        var ano = $('#ano').val();
        var Perfil = $('#Perfil').val();
        var Id_usuario = $('#Id_usuario').val();
        var Nombre_usuario = $('#nombreUsuario').val();
        var Periodo = $('#Periodo').val();
        var IdEje = $('#eje').val();
        var Id_acGBL = $('#actividadg').val();
        var Id_acGN = $('#actividadblo').val();
        var Nombreeje = $('#Nombreeje').val();
        var cate = $('#categoria').val();
        var sucbate = $('#subcategoria').val();
        var tipo = $('#tipo').val();
        if (id == 0) {
            url = '../check/Alta_check.php?accion=guardar&usuario=' + Id_usuario + '&idPeriodo=' + Periodo + '&idEje=' + IdEje + '&idActividad=' + Id_acGBL + '&idCategoria=' + cate + '&idSubCategoria=' + sucbate + '&idActGlo=' + Id_acGBL + '&idActGen=' + Id_acGN + '&regresar=1&Id_actividad=' + Id_acGN + '&Id_categoria=' + cate + '&Id_subcategoria=' + sucbate + '&ACME=' + tipo + '&Periodo=' + Periodo + '&Nombreeje=' + Nombreeje + '&ano=' + ano + '&Id_usuario=' + Id_usuario + '&nombreUsuario=' + Nombre_usuario + '&Perfil=' + Perfil + '&Id_actividadsuperior=' + Id_acGBL + '&idCheck=0' + '&tipocheck=' + tipocheck;
            $(location).attr('href', url);

        } else {
            url = '../check/Alta_check.php?accion=guardar&usuario=' + Id_usuario + '&idPeriodo=' + Periodo + '&idEje=' + IdEje + '&idActividad=' + Id_acGBL + '&idCategoria=' + cate + '&idSubCategoria=' + sucbate + '&idActGlo=' + Id_acGBL + '&idActGen=' + Id_acGN + '&regresar=1&Id_actividad=' + Id_acGN + '&Id_categoria=' + cate + '&Id_subcategoria=' + sucbate + '&ACME=' + tipo + '&Periodo=' + Periodo + '&Nombreeje=' + Nombreeje + '&ano=' + ano + '&Id_usuario=' + Id_usuario + '&nombreUsuario=' + Nombre_usuario + '&Perfil=' + Perfil + '&Id_actividadsuperior=' + Id_acGBL + '&idCheck=' + id + '&tipocheck=' + tipocheck;
            $(location).attr('href', url);
        }
    }

    /**
     * ?funcion para editar un check
     */

    function edita_check(id, tipocheck, responsable) {
        var ano = $('#ano').val();
        var Perfil = $('#Perfil').val();
        var Id_usuario = $('#Id_usuario').val();
        var Nombre_usuario = $('#nombreUsuario').val();
        var Periodo = $('#Periodo').val();
        var IdEje = $('#eje').val();
        var Id_acGBL = $('#actividadg').val();
        var Id_acGN = $('#actividadblo').val();
        var Nombreeje = $('#Nombreeje').val();
        var cate = $('#categoria').val();
        var sucbate = $('#subcategoria').val();
        var tipo = $('#tipo').val();
        var idresponsable = responsable;
        url = '../check/Alta_check.php?accion=editar&usuario=' + Id_usuario + '&idPeriodo=' + Periodo + '&idEje=' + IdEje + '&idActividad=' + Id_acGBL + '&idCategoria=' + cate + '&idSubCategoria=' + sucbate + '&idActGlo=' + Id_acGBL + '&idActGen=' + Id_acGN + '&regresar=1&Id_actividad=' + Id_acGN + '&Id_categoria=' + cate + '&Id_subcategoria=' + sucbate + '&ACME=' + tipo + '&Periodo=' + Periodo + '&Nombreeje=' + Nombreeje + '&ano=' + ano + '&Id_usuario=' + Id_usuario + '&nombreUsuario=' + Nombre_usuario + '&Perfil=' + Perfil + '&Id_actividadsuperior=' + Id_acGBL + '&check=' + id + '&tipocheck=' + tipocheck + '&idResponsable=' + idresponsable + '&id=' + id;
        $(location).attr('href', url);

    }

    /**
     * ?funcion para hacer el swicht entre meta
     */

    function setMeta(idCheck, tipo, subcheck) {
        var Id_actividad = $('#acmeta').val();
        var Id_categoria = $('#categoria').val();
        var Id_subcategoria = $('#subcategoria').val();
        var ACME = 2;
        var Periodo = $('#Periodo').val();
        var accion = 'editar';
        var nombre = $('#Nombreeje').val();
        var ano = $('#ano').val();
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var Id_actividadsuperior = $('#actividad_superior').val();
        var check = idCheck;
        var tipo = tipo;
        var subcheck = subcheck;
        var filtro = 0;
        if (Id_subcategoria > 0) {
            Categoria = Id_subcategoria;
        } else {
            Categoria = Id_categoria;
        }
        url = "Alta_logro_modal.php?Id_actividad=" + Id_actividad + "&Id_categoria=" + Id_categoria + "&Id_subcategoria=" + Id_subcategoria + "&ACME=" + ACME + "&Periodo=" + Periodo + "&accion=" + accion + "&Nombreeje=" + nombre + "&ano=" + ano + "&Id_usuario=" + Id_usuario + "&nombreUsuario=" + nombreUsuario + "&Perfil=" + Perfil + "&Id_actividadsuperior=" + Id_actividadsuperior + "&check=" + check + '&filtro=' + filtro;
        $.confirm({
            icon: 'glyphicon glyphicon-minus-sign',
            title: '¿Desea agregar a meta?',
            content: '',
            autoClose: 'cancelar|8000',
            type: 'dark',
            typeAnimated: true,
            buttons: {
                aceptar: {
                    btnClass: 'btn-dark',
                    action: function() {
                        $.post('Controllers/Controller_check.php', {
                            id: check,
                            accion: "agregarmeta",
                            Id_actividad: Id_actividad,
                            Id_periodo: Periodo,
                            Id_categoria: Categoria,
                            tipo: tipo,
                            subcheck: subcheck
                        }, function(data) {
                            if (data.toString().indexOf("Error:") === -1) {
                                //$.dialog(data);
                                $.confirm({
                                    icon: 'glyphicon glyphicon-ok-sign',
                                    title: data,
                                    content: '',
                                    type: 'dark',
                                    buttons: {
                                        aceptar: {
                                            action: function() {
                                                $(location).attr('href', url);

                                            }

                                        }
                                    }
                                });
                                //location.reload();
                            } else {
                                $.confirm({
                                    icon: 'glyphicon glyphicon-remove-sign',
                                    title: data,
                                    content: '',
                                    type: 'red',
                                    buttons: {
                                        aceptar: {
                                            action: function() {
                                                location.reload();
                                            }

                                        }
                                    }
                                });
                                //$.dialog(data);
                            }
                            //location.reload();
                        });
                    }
                },
                cancelar: function() {
                    //$.alert('Cancelado!');
                }
            }
        });
    }

    /**
     * ?funcion para mostar insumos
     */

    function muestra_insumos(tipo_insumo, idcheck, idact, categoria, periodo, acme) {
        let titulo = "";
        let act = idact;
        let check = idcheck;

        if (tipo_insumo == 1) { //entrada
            titulo = "insumos de entrada";
        } else { //salida
            titulo = "Insumos de salida"
        }

        $(".h").css('background-color', "#5a274f");
        $(".h").css('color', "white");
        $(".h").css('font-size', "11px");
        $("#modal_insumos").modal({
            backdrop: false
        });
        $("#titulo_insumos").html(titulo);
        $.post("Insumos_planeacion.php", {
            act: act,
            check: check,
            categoria: categoria,
            periodo: periodo,
            acme: acme,
            tipo_insumo,
            tipo_insumo
        }, function(data) {
            $(".detalle_insumo").html('');
            $(".detalle_insumo").html(data);
        });
    }

    /**@abstract
     * ?funcion para agregar insumo
     */

    function alta_insumo(idcheck, idact, categoria, periodo, acme, nombrecheck, tipo_insumo) {
        var titulo = "";
        if (tipo_insumo == 1)
            titulo = "Nuevo insumo de ENTRADA: " + nombrecheck;
        else {
            titulo = "Nuevo insumo de SALIDA:" + nombrecheck;
        }
        let act = idact;
        let check = idcheck;
        $(".h").css('background-color', "#5a274f");
        $(".h").css('color', "white");
        $(".h").css('font-size', "11px");
        $("#modal_insumos_alta").modal({
            backdrop: false
        });
        $("#titulo_insumos_alta").html(titulo);
        $.post("nuevo_insumo.php", {
            act: act,
            check: check,
            categoria: categoria,
            periodo: periodo,
            acme: acme,
            tipo_insumo: tipo_insumo
        }, function(data) {
            $(".detalle_insumo_alta").html('');
            $(".detalle_insumo_alta").html(data);
        });
    }
</script>


</html>