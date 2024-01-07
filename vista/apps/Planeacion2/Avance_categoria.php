<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('Classes/Planeacion.class.php');
$catalogo = new Catalogo();
$cate = new Planeacion();
$subcategoria = 0;
$categoria = 0;
$filtro = 0;
if (isset($_REQUEST['subcategoria']) && $_REQUEST['subcategoria'] != "") {
    $subcategoria = $_REQUEST["subcategoria"];
}
if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] != "") {
    $filtro = $_REQUEST["filtro"];
}
if (isset($_REQUEST['categoria']) && $_REQUEST['categoria'] != "") {
    $categoria = $_REQUEST["categoria"];
}
$nombreUsuario  = $_REQUEST['nombreUsuario'];
$Id_usuario    = $_REQUEST['Id_usuario'];
$Perfil         = $_REQUEST['Perfil'];
$total_entregables = 0;
$Total_actividades = 0;

$Periodo        = $_REQUEST["periodo"];
$where_eje      = $_REQUEST["IdEje"];
$where_tipo     = $_REQUEST["Tipo"];
$Nombreeje      = "'" . $_REQUEST["Nombreeje"] . "'";
$check          = $_REQUEST["check"];
$ano            = $_REQUEST["ano"];

$persona = "no";
$area = "no";

$ACME_titulo    = "";
$ACME_titulo2   = "";
if ($where_tipo == 1) {
    $ACME_titulo  = "#A.Global";
    $ACME_titulo2 = "#A.General";
} else {
    $ACME_titulo  = "#M.Global";
    $ACME_titulo2 = "#M.General";
}
$where_visible = "AND ca.Visible = 1";
if ($check == 1) {
    $where_visible = "";
    $visibilidad_acts = 0;//si trae check en 1 es para que se vean todas y por lo tanto no se pone el where de activo en el query
}else{
  $visibilidad_acts = 1;//si si trae 0 en check es normal y no salen los que estan ocultos
}


if ($subcategoria > 0) {

    $query_lista = "SELECT c.idCategoria,c.descCategoria,UPPER(if(isnull(ca.Nombre_alterno),c.descCategoria,ca.Nombre_alterno))categoria,ca.Visible
    FROM c_categoriasdeejes c
    INNER JOIN k_categoriasdeejes_anios ca ON ca.idCategoria = c.idCategoria INNER JOIN c_periodo p on p.Periodo=ca.Anio
    WHERE c.idEje = $where_eje AND c.idcategoria=$subcategoria $where_visible and p.Id_Periodo=$Periodo and ca.ACME=$where_tipo ORDER BY c.orden";
    $titulo_fot = 'Sub-Categoría';
} elseif ($categoria > 0 && $subcategoria == "" || $subcategoria == "0" && $categoria != 0) {
 $query_lista = "SELECT c.idCategoria,c.descCategoria,UPPER(if(isnull(ca.Nombre_alterno),c.descCategoria,ca.Nombre_alterno))categoria,ca.Visible
    FROM c_categoriasdeejes c
    INNER JOIN k_categoriasdeejes_anios ca ON ca.idCategoria = c.idCategoria INNER JOIN c_periodo p on p.Periodo=ca.Anio
    WHERE  c.idEje = $where_eje AND c.idcategoria=$categoria $where_visible and p.Id_Periodo=$Periodo and ca.ACME=$where_tipo ORDER BY c.orden";
    $titulo_fot = 'Categoría';
} elseif ($categoria == "0" && $subcategoria == "0" && $filtro == 0) {
    $query_lista = "SELECT c.idCategoria,c.descCategoria,UPPER(if(isnull(ca.Nombre_alterno),c.descCategoria,ca.Nombre_alterno))categoria,ca.Visible
    FROM c_categoriasdeejes c
    INNER JOIN k_categoriasdeejes_anios ca ON ca.idCategoria = c.idCategoria INNER JOIN c_periodo p on p.Periodo=ca.Anio
    WHERE  c.idEje = $where_eje AND c.nivelCategoria =1 $where_visible and p.Id_Periodo=$Periodo and ca.ACME=$where_tipo ORDER BY c.orden";
    $titulo_fot = 'Categoría';
} elseif ($filtro > 0) {

     $query_lista = "SELECT c.idCategoria,c.descCategoria,UPPER(if(isnull(ca.Nombre_alterno),c.descCategoria,ca.Nombre_alterno))categoria,ca.Visible
    FROM c_categoriasdeejes c
    INNER JOIN k_categoriasdeejes_anios ca ON ca.idCategoria = c.idCategoria INNER JOIN c_periodo p on p.Periodo=ca.Anio
    WHERE  c.idEje = $where_eje AND c.idcategoria=$filtro $where_visible and p.Id_Periodo=$Periodo and ca.ACME=$where_tipo ORDER BY c.orden";

    $titulo_fot = 'Categoría';
} else {
      $query_lista = "SELECT c.idCategoria,c.descCategoria,UPPER(if(isnull(ca.Nombre_alterno),c.descCategoria,ca.Nombre_alterno))categoria,ca.Visible
    FROM c_categoriasdeejes c
    INNER JOIN k_categoriasdeejes_anios ca ON ca.idCategoria = c.idCategoria INNER JOIN c_periodo p on p.Periodo=ca.Anio
    WHERE  c.idEje = $where_eje AND c.nivelCategoria =1 $where_visible and p.Id_Periodo=$Periodo and ca.ACME=$where_tipo ORDER BY c.orden";
    $titulo_fot = 'Categoría';
}
//echo $query_lista;
$Total_actividades_global = 0;
$Total_actividades_general = 0;
$total_entregables = 0;
$Total_avance = 0;
$porcentaje = 0;

$avance = 0;
$T_en = 0;
$T_en_c = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .table {
            border-collapse: collapse;
        }

        .table .table-body tr {
            border-bottom: 1px solid #B0AFB6;
            transition: all ease .2s;
        }

        .table .table-body tr:hover {
            border-bottom: 1px solid rgb(195, 193, 201);
            background-color: rgb(196, 196, 196);
        }

        .progress-bar-sub {
            background-color: #10b3ff !important;
        }

        .progress-bar-glo {
            background-color: #0081b4 !important;
        }

        .progress-bar-ge {
            background-color: #51bedf !important;
        }

        .progress {
            height: 6px;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: #f5f5f5;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
        }


        .table .table-body tr>td {
            font-size: 10px;
            font-weight: 600;
            padding: 4px 8px 3px;
            border-right: 1px solid #444444;
        }

        .table .table-body tr>td:last-child {
            border-right: none;
        }


        .table {
            margin-bottom: 0px !important;
        }



        .table .vobo {
            width: 41px;
        }


        .table .avance {
            width: 160px;

        }

        .table .opciones {
            width: 86px;
        }

        /*table principal*/

        .table.table-principal {
            width: 96%;
            margin: 0 auto;
        }

        .table.table-principal .table-header {
            background-color: rgb(90, 39, 79);
            color: white;
        }

        .table.table-principal .table-footer {
            background-color: rgb(90, 39, 79);
            color: white;
        }

        .table.table-principal .table-header th {
            font-size: 10px;
            font-weight: 600;
            text-align: center;
            padding: 3px 8px 3px;
        }

        .table.table-principal .table-body th {
            background-color: #ffffff;
        }

        /*table anidada*/

        .table.table-anidada {
            width: 100%;
        }

        /*columna publicacion de catalago*/

        .table .table-body .publicacion span:first-child {
            display: inline-block;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            width: 185px;
        }

        .table .table-body .publicacion2 {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            width: 175px;
        }

        .table .table-body .publicacion3 {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            width: 175px;
        }

        .table .table-body .publicacion span:last-child {
            float: right;
        }


        /*columna vobo*/

        .table .table-body .vobo {
            text-align: center;
            color: rgb(68, 68, 68);
        }

        /*columna avance*/

        .table .table-body .avance .progreso {
            display: inline-block;
            width: 45px;
        }

        .container.jsx-3213596737 {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            /* min-width: 100px;  */
        }

        .line-container.jsx-3213596737 {
            display: block;
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            height: 6px;
            border-radius: 1.1px;
            background-color: #bbbbbb;
            border: solid 0.1px #000000;
        }

        .progress.jsx-3213596737 {
            height: 102%;
            border-radius: 1.1px;
            -webkit-transition: width 1s ease-in, background-color 1s ease-in;
            transition: width 1s ease-in, background-color 1s ease-in;
        }



        /*columna opciones*/

        figure.jsx-3352531170 {
            cursor: pointer;
            position: relative;
            padding: 0;
            margin: 0;
            width: 13px;
            height: 13px;
            display: -webkit-inline-box;
            display: -webkit-inline-flex;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-align-items: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .icon.jsx-3352531170 {
            width: 13px;
            height: 13px;
        }

        .caption.jsx-3352531170 {
            position: absolute;
            top: 10px;
            display: none;
            font-size: 6px;
        }

        figure.jsx-3352531170:hover .caption.jsx-3352531170 {
            display: block;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="Js/Acciones_planeacion.js"></script>
</head>

<body>
    <div class="col-md-12 col-sm-12 col-xs-12">

        <table id="tabla_principal" class="table table-principal">
            <thead class="table-header">
                <tr>
                    <th class="publicacion"><?php echo $titulo_fot; ?></th>
                    <th class="responsable"><?php echo $ACME_titulo; ?></th>
                    <th class="responsable"><?php echo $ACME_titulo2; ?></th>
                    <th class="vobo">#Entregables</th>
                    <th class="avance">Avance</th>
                    <th class="opciones">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-body " id="table_principal_body">
                <?php $consulta = $catalogo->obtenerLista($query_lista);
                //echo $query_lista;
                while ($row = mysqli_fetch_array($consulta)) {

                    $actividades_global = 0;
                    $actividades_general = 0;
                    $Id_Categoria = $row['idCategoria'];

                    $row_filtro = 1;

                    if (isset($_REQUEST['persona'])) {
                        $persona = $_REQUEST["persona"];

                        #con subcategoria
                       $query_persona = "SELECT distinct a.IdActividad, ca.idCategoria, a.Nombre, a.visible_plan, cae.idCategoriaPadre  FROM c_actividad a
                        INNER JOIN k_actividad_categoria ca ON ca.IdActividad = a.IdActividad
                        INNER JOIN c_categoriasdeejes cae ON cae.Idcategoria = a.Idcategoria
                        WHERE cae.idCategoriaPadre = '$Id_Categoria' and a.IdResponsable = '$persona'";

                        $consultapersona = $catalogo->obtenerLista($query_persona);

                        $row_filtro = mysqli_fetch_row($consultapersona);

                        #actividad global
                        $query_personag = "SELECT a.IdActividad, ca.idCategoria FROM c_actividad a
                        INNER JOIN k_actividad_categoria ca ON ca.IdActividad = a.IdActividad
                        WHERE ca.idCategoria = '$Id_Categoria' and a.IdResponsable = '$persona'";

                        $consultapersonag = $catalogo->obtenerLista($query_personag);

                        $row_filtrog = mysqli_fetch_row($consultapersonag);
                    }

                    if (isset($_REQUEST['area'])) {
                        $area = $_REQUEST["area"];

                        #con subcategoria
                        $query_area = "SELECT distinct a.IdActividad, ca.idCategoria, a.Nombre, a.visible_plan, cae.idCategoriaPadre  FROM c_actividad a
                        INNER JOIN k_actividad_categoria ca ON ca.IdActividad = a.IdActividad
                        INNER JOIN c_categoriasdeejes cae ON cae.Idcategoria = a.Idcategoria
                        WHERE cae.idCategoriaPadre = '$Id_Categoria' and a.IdArea = '$area'";

                        $consultaarea = $catalogo->obtenerLista($query_area);

                        $row_filtro = mysqli_fetch_row($consultaarea);

                        #actividad global
                        $query_areag = "SELECT a.IdActividad, ca.idCategoria FROM c_actividad a
                        INNER JOIN k_actividad_categoria ca ON ca.IdActividad = a.IdActividad
                        WHERE ca.idCategoria = '$Id_Categoria' and a.IdArea = '$area'";

                        $consultaareag = $catalogo->obtenerLista($query_areag);

                        $row_filtrog = mysqli_fetch_row($consultaareag);
                    }

                    if($row_filtro > 0 or $row_filtrog > 0) {

                    $sucate_existe = $cate->Subcategorias_planeacion($Id_Categoria, $Periodo, $where_tipo,$visibilidad_acts); //Trae cuantas subcategorias tiene esta categoria.
                    if ($sucate_existe > 0) {
                        $vista = "'subcategoria'";
                    } else {
                        $vista = "'actividad_global'";
                    }
                    $entregables = $cate->Entregables_categoria_planeacion($Id_Categoria, $where_tipo, $Periodo, $ano);
                    //print_r($entregables);
                    $avance = $entregables[2];
                    $T_en = $T_en += $entregables[0];
                    $T_en_c = $T_en_c += $entregables[1];
                    $actividades_global = $cate->Actividades_planeacion($Id_Categoria, $where_tipo, 1, $Periodo,$visibilidad_acts);
                    $actividades_general = $cate->Actividades_planeacion($Id_Categoria, $where_tipo, 2, $Periodo,$visibilidad_acts);
                    $Total_actividades_global = $Total_actividades_global += $actividades_global;
                    $Total_actividades_general = $Total_actividades_general += $actividades_general;
                    if ($row['Visible'] == 1) {
                        $estilo  = '';
                        $onclick2 = "onclick='De_ativate_categoria(" . $Id_Categoria . ",2," . $Perfil . "," . $Periodo . "," . $ano . "," . $where_tipo . ")'";
                    } else {
                        $onclick2 = "onclick='De_ativate_categoria(" . $Id_Categoria . ",1," . $Perfil . "," . $Periodo . "," . $ano . "," . $where_tipo . ")'";
                        $estilo  = ' background-color:  grey; ';
                    }
                    $onclickNew = "";


                ?>
                    <tr id="row_<?php echo $Id_Categoria; ?>" class="nivel-1acordeon" style="<?php echo $estilo; ?>" onclick="Muestra_Sub_categoria(<?php echo $Id_Categoria ?>,<?php echo $where_tipo ?>,<?php echo $Periodo ?>,<?php echo $Nombreeje ?>,<?php echo $ano ?>,<?php echo $vista ?>,0,<?php echo $filtro ?>);ocultar_mostrar2(<?php echo $Id_Categoria ?>);" data-id="<?php echo $Id_Categoria ?>">
                        <td class="publicacion"><span data-toggle="tooltip" data-placement="bottom" title=""><?php echo $row['categoria']; ?></span> <span class="toggle-icon"><i id="left_<?php echo $Id_Categoria; ?>" class="fas fa-chevron-left" style="margin-top: 2px;"></i><i id="down_<?php echo $Id_Categoria; ?>" class="fas fa-chevron-down" style="display: none;"></i></span></td>
                        <td class="vobo"><?php echo $actividades_global; ?></td>
                        <td class="vobo"><?php echo $actividades_general; ?></td>
                        <td class="vobo"><?php echo $entregables[1]; ?> / <?php echo $entregables[0]; ?></td>
                        <td class="avance">
                            <progress id="file" max="100" value="<?php echo round($avance, 1); ?>" class="padre"></progress> <?php echo round($avance, 1); ?>%
                        </td>
                        <td class="opciones">
                            <?php if ($row['Visible'] == 1) { ?>
                                <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye"></i><span class="jsx-3352531170 caption"></span></figure>
                            <?php   } else { ?>
                                <figure class="jsx-3352531170 medium" style="margin-right: 0px;" <?php echo $onclick2; ?>><i class="fas fa-eye-slash"></i><span class="jsx-3352531170 caption"></span></figure>
                            <?php   } ?>
                            <figure class="jsx-3352531170 medium" style="margin-right: 12px;" <?php echo $onclickNew ?>><i class="fas fa-plus-circle"></i></figure>
                        </td>
                    </tr>
                <?php
                    $avance = 0;
                }
                }
                $Total_avance = $cate->Vista_entregables_eje($where_eje, $where_tipo, $Periodo, $ano);

                ?>
            </tbody>
            <tfoot class="table-header">
                <tr>
                    <th class="publicacion"><?php echo $titulo_fot; ?></th>
                    <th><?php echo $Total_actividades_global; ?></th>
                    <th><?php echo $Total_actividades_general; ?></th>
                    <th><?php echo $T_en; ?></th>
                    <th class="avance"><?php echo round($Total_avance[1], 1) ?>%</th>
                    <th class="opciones">Opciones</th>

                </tr>
            </tfoot>
        </table>
    </div>
    <input type="hidden" id="Id_usuario" value="<?php echo $Id_usuario ?>">
    <input type="hidden" id="nombreUsuario" value="<?php echo $nombreUsuario ?>">
    <input type="hidden" id="Perfil" value="<?php echo $Perfil ?>">
    <input type="hidden" id="check" value="<?php echo $check ?>">
    <input type="hidden" id="eje" value="<?php echo $where_eje ?>">
    <input type="hidden" id="anio" value="<?php echo $Periodo ?>">
    <input type="hidden" id="Nombreeje" value="<?php echo $Nombreeje ?>">
    <input type="hidden" id="ano" value="<?php echo $ano ?>">
    <input type="hidden" id="tipo" value="<?php echo $where_tipo ?>">
    <input type="hidden" id="filtro" value="<?php echo $filtro ?>">

</body>
<script>
    bandera_primer_clic = [];
    bandera_clic = [];

    function Muestra_Sub_categoria(Id_Categoria, Tipo, Periodo, nombre, ano, vista, Id_actividad, filtro) {

        var Id_Categoria = Id_Categoria;
        var ACME = Tipo;
        var Periodo = Periodo;
        var ano = ano;
        var nombre = nombre;
        var vista = vista;
        var Id_actividad = Id_actividad;
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var check = $('#check').val();
        var filtro = filtro;


        if (!bandera_primer_clic.includes("row_" + Id_Categoria)) {
            bandera_primer_clic.push("row_" + Id_Categoria);
            $.post("Sub_categoria.php", {

                    Id_Categoria: Id_Categoria,
                    check: check,
                    ACME: ACME,
                    Periodo: Periodo,
                    ano: ano,
                    Nombreeje: nombre,
                    vista: vista,
                    Id_usuario: Id_usuario,
                    nombreUsuario: nombreUsuario,
                    Perfil: Perfil,
                    Id_actividad: Id_actividad,
                    filtro: filtro,
                },
                function(data) {
                    $('#row_' + Id_Categoria).after(data);

                });
        } else {
            ocultar_mostrar(Id_Categoria);

        }

    }

    function Muestra_Sub_categoria2(Id_Categoria, Tipo, Periodo, nombre, ano, vista, Id_actividad, filtro) {
        var Id_Categoria = Id_Categoria;
        var ACME = Tipo;
        var Periodo = Periodo;
        var ano = ano;
        var nombre = nombre;
        var vista = vista;
        var Id_actividad = Id_actividad;
        var Id_usuario = $('#Id_usuario').val();
        var nombreUsuario = $('#nombreUsuario').val();
        var Perfil = $('#Perfil').val();
        var check = $('#check').val();
        var filtro = filtro;

        if (!bandera_primer_clic.includes("row_" + Id_Categoria + "_" + Id_actividad)) {
            bandera_primer_clic.push("row_" + Id_Categoria + "_" + Id_actividad);
            $.post("Sub_categoria.php", {
                    Id_Categoria: Id_Categoria,
                    check: check,
                    ACME: ACME,
                    Periodo: Periodo,
                    ano: ano,
                    Nombreeje: nombre,
                    vista: vista,
                    Id_usuario: Id_usuario,
                    nombreUsuario: nombreUsuario,
                    Perfil: Perfil,
                    Id_actividad: Id_actividad,
                    filtro: filtro,
                },
                function(data) {
                    $('#row_' + Id_Categoria + "_" + Id_actividad).after(data);

                });
        } else {
            ocultar_mostrar(Id_Categoria);

        }

    }

    function ocultar_mostrar(Id_Categoria) {
        var sig_row = $('.hija');
        sig_row.each(function(i) {
            if ($(this).data('id') == Id_Categoria) {
                $(this).toggle();
            }

        })
    }

    function ocultar_cate(Id_Categoria) {
        var sig_row = $('.hija');
        sig_row.each(function(i) {
            if ($(this).data('cate') == Id_Categoria) {
                $(this).toggle();
            }

        })
    }

    function ocultar_subcate(Id_Categoria) {
        var sig_row = $('.hija');
        sig_row.each(function(i) {
            if ($(this).data('subcate') == Id_Categoria) {
                $(this).toggle();
            }

        })
    }

    function ocultar_mostrar2(Id_Categoria) {
        let existe = bandera_clic.includes('row_' + Id_Categoria);
        if (existe == true) {
            var index = bandera_clic.indexOf('row_' + Id_Categoria);
            bandera_clic.splice(index, 1);
            $('#left_' + Id_Categoria).css("display", "");
            $('#down_' + Id_Categoria).css("display", "none");
        } else {
            bandera_clic.push("row_" + Id_Categoria);
            $('#left_' + Id_Categoria).css("display", "none");
            $('#down_' + Id_Categoria).css("display", "");
        }
    }




    function seleccionar() {
        $('#cate').html("");
        $('#subcate').html("");
        $("#muestra").prop("checked", false);
        $("#muestra").val(0);
        Categorias();
    }

    function Categorias() {
        var eje = $('#eje').val();
        var periodo = $('#anio').val();
        $('#cate').load("../../../WEB-INF/Controllers/ArchivosCompartidos/Acciones_archivo.php", {
            categoria: 'categoria',
            ideje: eje,
            anio: periodo
        }, function(data) {
            $(this).select();
        });
    }

    function alta_check(cate, subcate, ag, age) {

        var ano = $('#ano').val();
        var Perfil = $('#Perfil').val();
        var Id_usuario = $('#Id_usuario').val();
        var Nombre_usuario = $('#nombreUsuario').val();
        var Periodo = $('#anio').val();
        var IdEje = $('#eje').val();
        var Id_acGBL = ag;
        var Id_acGN = age;
        var Nombreeje = $('#Nombreeje').val();
        var cate = cate;
        var sucbate = subcate;
        var tipo = $('#tipo').val();
        url = '../check/Alta_check.php?accion=guardar&usuario=' + Id_usuario + '&idPeriodo=' + Periodo + '&idEje=' + IdEje + '&idActividad=' + Id_acGBL + '&idCategoria=' + cate + '&idSubCategoria=' + sucbate + '&idActGlo=' + Id_acGBL + '&idActGen=' + Id_acGN + '&regresar=1&Id_actividad=' + Id_acGN + '&Id_categoria=' + cate + '&Id_subcategoria=' + sucbate + '&ACME=' + tipo + '&Periodo=' + Periodo + '&Nombreeje=' + Nombreeje + '&ano=' + ano + '&Id_usuario=' + Id_usuario + '&nombreUsuario=' + Nombre_usuario + '&Perfil=' + Perfil + '&Id_actividadsuperior=' + Id_acGBL + '&check=0';
        $(location).attr('href', url);

    }

    function alta_actividad(cate, subcate, ag, age) {

        var ano = $('#ano').val();
        var Perfil = $('#Perfil').val();
        var Id_usuario = $('#Id_usuario').val();
        var Nombre_usuario = $('#nombreUsuario').val();
        var Periodo = $('#anio').val();
        var IdEje = $('#eje').val();
        var Id_acGBL = ag;
        var Id_acGN = age;
        var Nombreeje = $('#Nombreeje').val();
        var cate = cate;
        var sucbate = subcate;
        var tipo = $('#tipo').val();
        url = 'Alta_actividad.php?accion=guardar&usuario=' + Id_usuario + '&idPeriodo=' + Periodo + '&IdEje=' + IdEje + '&idCategoria=' + cate + '&idSubCategoria=' + sucbate + '&idActGlo=' + Id_acGBL + '&idActGen=' + Id_acGN + '&regresar=1&ACME=' + tipo + '&Periodo=' + Periodo + '&Nombreeje=' + Nombreeje + '&ano=' + ano + '&Id_usuario=' + Id_usuario + '&nombreUsuario=' + Nombre_usuario + '&Perfil=' + Perfil;
        $(location).attr('href', url);

    }
    $(function() {
        $.post("../Piezas/source/controller/DictamenFrontController.php", {
            action: "avance"
        }, function(data) {
            console.log("actualizo");
        });
    });
</script>

</html>
