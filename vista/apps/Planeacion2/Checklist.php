<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
include_once('../../../WEB-INF/Classes/ActividadArchivo.class.php');
include_once('Classes/Evidencias.class.php');

$catalogo = new Catalogo();
$cata = new actividades();
$Evidencia = new Evidencias();

$Check_padre = $_POST['id_check'];
$id_actividad = $_POST['id_actividad'];
$periodo = $_POST['periodo'];
$Perfil = $_POST['Perfil'];
$Id_usuario = $_POST['Id_usuario'];
$Nombre_usuario = $_POST['nombreUsuario'];
$Id_eje = $_POST['IdEje'];
$ACME = $_POST['tipo'];
$cate = "";
$Id_categoria = $_POST['cate'];
if (isset($_POST['subcate']) && $_POST['subcate'] != "" && $_POST['subcate'] > 0) {
    $Id_subcategoria = $_POST['subcate'];
    $cate = $Id_subcategoria;
} else {
    $Id_subcategoria = "";
    $cate = $Id_categoria;
}
$actividad_superior = $_POST['actividad_superior'];
$AGLOBAL = "";
$AGENEREAL = "";
$idcheck = "";
$num_check = 0;
if ($actividad_superior > 0) {
    $AGLOBAL = $actividad_superior;
    $AGENEREAL = $id_actividad;
} else {
    $AGLOBAL = $id_actividad;
    $AGENEREAL = $actividad_superior;
}
if ($ACME == 1) {
    $metastyle = '0px';
} else {
    $metastyle = '50px';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Checklist</title>
    <style>
        .Acciones2 {
            min-width: 25px !important;
            max-width: 25px !important;
        }

        .publicacion2 {
            min-width: 165px !important;
            max-width: 165px !important;
        }

        .numscheck {
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0px !important;
            max-width: 350px !important;
        }


        .avance2 {
            min-width: 25px !important;
            max-width: 25px !important;
        }

        .opciones2 {
            min-width: 40px !important;
            max-width: 40px !important;
        }

        .fecha2 {
            min-width: 35px !important;
            max-width: 35px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .encargado2 {
            min-width: 35px !important;
            max-width: 35px !important;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<script src="Js/Alta_check.js"></script>

<body>


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" id="">
            <table class="table table-bordered check" id="check">
                <thead class="table-header check">
                    <tr style="background-color: #5a274f;color: white;" class="check">
                        <th class="Acciones2 check"><i class="far fa-plus-square" onclick="alta_check(<?php echo $Check_padre; ?>,'guardar');" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" data-original-title="Añadir check"></i></th>
                        <th class="publicacion2 check">SubCheck</th>
                        <th class="opciones2 check">Evidencia</th>
                        <th class="avance2 check">Avance</th>
                        <th class="fecha2 check">F. planeada</th>
                        <th class="fecha2 check">F. final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta_check_hijos = "SELECT c.IdCheckList,ch.Avance,ch.Archivo,d.ruta,d.pdf,d.id_tipo,c.IdCheckListPadre,c.tipo,ch.Fecha_entrega_propuesta,ch.Fecha_entrega_final,
                    if(isnull(ch.IdEncargado),CONCAT( '-', SUBSTRING( p.Nombre, 1, 1 ), p.Apellido_Paterno, '(', ac.Nombre, ')' ),
                     CONCAT( '-', SUBSTRING( p1.Nombre, 1, 1 ), p1.Apellido_Paterno, '(', ac1.Nombre, ')' ) )
                      encargado,
                    CONCAT( 'Insumos: ', ac.Nombre ) area_insumo,ac.Id_Area AS id_area,c.automatico,ch.Visible,ca.idExposicion,
                CASE
                        WHEN ch.IdEncargado != '' THEN
                        ch.IdEncargado ELSE c.IdResponsable
                    END AS IdEncargado,
                CASE
                        WHEN ch.Nombre_alterno != '' THEN
                        ch.Nombre_alterno ELSE c.Nombre
                    END AS Nombre,ch.Entregable
                FROM
                    k_checklist_actividad ch
                    LEFT JOIN c_checkList c ON c.IdCheckList = ch.IdCheckList
                    LEFT JOIN c_documento d ON d.id_documento = ch.Archivo
                    LEFT JOIN c_personas p ON p.id_Personas = c.IdResponsable
                    LEFT JOIN c_area ac ON ac.Id_Area = p.idArea
                    LEFT JOIN c_categoriasdeejes ca ON ca.idCategoria = ch.IdCategoria
                    LEFT JOIN c_personas p1 ON p1.id_Personas = ch.IdEncargado
                    LEFT JOIN c_area ac1 ON ac1.Id_Area = p1.idArea
                WHERE
                    c.IdCheckListPadre = $Check_padre AND ch.Id_Periodo = $periodo AND ch.IdActividad = $id_actividad AND ch.IdCategoria = $cate
                ORDER BY
                    ch.Orden";
                    $id_encargado = 1;
                    $avance_checklist = 0;
                    $ruta = "";
                    $color = "";
                    $onclick_check = "";
                    $orden_check = 1;
                    //echo $consulta_check_hijos;
                    $resul_check = $catalogo->obtenerLista($consulta_check_hijos);
                    while ($row = mysqli_fetch_array($resul_check)) {
                        if ($row['Visible'] == 1) {
                            $active = "active";
                        } else {
                            $active = "desactive";
                        }
                        $id_encargado = $row['IdEncargado'];
                        if ($id_encargado == '') {
                            $id_encargado = 0;
                        }
                        //$n_encargado = $Evidencia->get_Encargado($id_encargado);
                        $n_encargado = $row['encargado'];
                        $n_ch = '<b>' . $orden_check . '</b>.-' . $row['Nombre'] . '' . $n_encargado;
                        $n_t = $orden_check . '.-' . $row['Nombre'] . $n_encargado;
                        $nombrecheck = "'" . $row['Nombre'] . "'";
                        $idcheck = $row['IdCheckList'];
                        $idcheckpadre = $row['IdCheckListPadre'];


                        $id_area = $row['id_area'];
                        $ruta = $row['ruta'] . $row['pdf'];
                        $tipo_entregable = "";
                        $avance_checklist = intval($row['Avance']);
                        if ($avance_checklist >= 1 && $avance_checklist <= 24) {
                            $color = "dfa739";
                            $tipo_entregable = 9;
                        } elseif ($avance_checklist >= 25 && $avance_checklist <= 49) {
                            $color = "#dfa739";//naranja
                            $tipo_entregable = 14;
                        } elseif ($avance_checklist >= 50 && $avance_checklist <= 99) {
                            $color = "#dbd909";//amarillo
                            $tipo_entregable = 10;
                        } elseif ($avance_checklist >= 100) {
                            $color = "#33ab15";//verde
                        } else {
                            $color = "red";
                            $tipo_entregable = 9;
                        }
                        if ($row['automatico'] == 0) {
                            $icono = '<i class="fas fa-file-archive" data-toggle="tooltip" data-placement="top" data-original-title="Ultimo archivo"></i>';
                        } else {
                            $icono = '<i class="fas fa-laptop-code" data-toggle="tooltip" data-placement="top" data-original-title="BD"></i>';
                        }

                        //<i class="fas fa-sitemap"></i>
                        if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                            $onclick_check = 'target="_blank" href="' . $row['ruta'] . '"';
                        } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                            $onclick_check = 'target="_blank" href="' . $ruta . '"';
                        } elseif ($row['automatico'] == 1) {
                            $onclick_check = 'onclick="muestradictamen(' . $row['idExposicion'] . ',' . $orden_check . ');"';
                        } else {
                            $onclick_check = '';
                        }
                        $onclick_versiones = "onclick='muestraTab(" . $row['IdCheckList'] . "," . $ACME . "," . $id_actividad . "," . $cate . "," . $periodo . ");'";
                        $onclick_form = 'href="../ArchivosEntregables/Alta_entregable_2.php?accion=guardar&tipoPerfil=' . $Perfil . '&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $Id_eje . '&ACME=' . $ACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' . $periodo . '&check=' . $idcheckpadre . '&subcheck=' . $idcheck . '&regreso=2&tipo_entregable=' . $tipo_entregable . '"';
                        $onclick_insumos = ' onclick="muestrainsumo2(' . $row['IdCheckList'] . ');"';
                        $onclick_asunto = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=' . $Perfil . '&nombreUsuario=' . $Nombre_usuario . '&idUsuario=' . $Id_usuario . '&plan=1&Id_eje=' . $Id_eje . '&ACME=' . $ACME . '&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL . '&AGENE=' . $AGENEREAL . '&periodo=' . $periodo . '&check=' . $idcheckpadre . '&subcheck=' . $idcheck . '&regreso=2&tipo_entregable=' . $tipo_entregable . '&id_encargado=' . $id_encargado . '&id_area=' . $id_area . '"';

                    ?>
                        <tr class="<?php echo $active ?>" id="check_re_<?php echo $num_check ?>" style="height: <?php echo $metastyle ?>;">
                            <td class="Acciones2">
                                <?php if ($row['Visible'] == 1) { ?>
                                    <span onclick="De_ativate_chech(<?php echo $idcheck ?>,2,<?php echo $periodo ?>,0,<?php echo $id_actividad ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-eye" data-toggle="tooltip" data-placement="top" data-original-title="ocultar check" style="color: purple;"></i></span>
                                <?php   } else { ?>
                                    <span onclick="De_ativate_chech(<?php echo $idcheck ?>,1,<?php echo $periodo ?>,0,<?php echo $id_actividad ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-eye-slash" data-toggle="tooltip" data-placement="top" data-original-title="ocultar check" style="color: purple;"></i></span>
                                <?php   } ?>
                                <span onclick="edita_check(<?php echo $idcheck ?>,'editar',<?php echo $id_encargado ?>);" style="display: inline-block;"><i class="fa fa-list-alt" data-toggle="tooltip" data-placement="top" data-original-title="Editar check" style="color: purple;"></i></span>

                                <?php if ($Id_usuario == 1064 || $Id_usuario == 5 || $Id_usuario == 1 || $Id_usuario == 1145) { ?>
                                    <span onclick="eliminar_check(<?php echo $idcheck ?>,<?php echo $id_actividad ?>,<?php echo $periodo ?>,<?php echo $cate ?>);" style="display: inline-block;"><i class="fas fa-trash-alt" data-toggle="tooltip" data-placement="top" data-original-title="Elimina check" style="color: purple;"></i></span>
                                <?php   } ?>


                            </td>
                            <td class="publicacion2">
                                <div>

                                  <span style="position: absolute;" onclick="muestra_insumos(1,<?php echo $idcheck; ?>,<?php echo $id_actividad ?>,<?php echo $cate ?>,<?php echo $periodo ?>,<?php echo $ACME ?>)"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de entrada"></i></span>
                                  <span onclick="alta_insumo(<?php echo $idcheck; ?>,<?php echo $id_actividad ?>,<?php echo $cate ?>,<?php echo $periodo ?>,<?php echo $ACME ?>,<?php echo $nombrecheck ?>,1)" style="position: absolute;margin-top: 18px;margin-left: -9px;" >&nbsp;&nbsp;<i  data-toggle="tooltip" data-placement="top" data-original-title="Añadir insumo entrada"><img src='./css/insumo.jpeg' width="16px" height="10px" /></i> </span>
                                      <p style="padding-left: 27px;padding-right: 15px;min-width: 0px !important;" class="numcheck" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $n_t; ?>"><?php echo $n_ch; ?></p>
                                      <span style="position: absolute;margin-left: -4px;" onclick="muestra_insumos(2,<?php echo $idcheck; ?>,<?php echo $id_actividad ?>,<?php echo $cate ?>,<?php echo $periodo ?>,<?php echo $ACME ?>)" ><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de salida"></i></span>
                                      <span onclick="alta_insumo(<?php echo $idcheck; ?>,<?php echo $id_actividad ?>,<?php echo $cate ?>,<?php echo $periodo ?>,<?php echo $ACME ?>,<?php echo $nombrecheck; ?>,2)" style="position: absolute;margin-top: 18px;margin-left: -9px;">&nbsp;&nbsp;<i  data-toggle="tooltip" data-placement="top" data-original-title="Añadir insumo salida"><img src='./css/insumo.jpeg' width="16px" height="10px" /></i> </span>
                                </div>
                                <div>
                                    <?php
                                    if($ACME == 2){
                                            $color_entregable = "color:#2132c8;font-size:.8em;";
                                          }else{
                                            $color_entregable = "color:purple;font-size:.8em;";
                                          }
                                    if ( $row['Entregable'] != '') { ?>
                                        <p class="breakAll narrow" style="<?php echo $color_entregable; ?>" ><?php echo $row['Entregable'] ?></p>
                                    <?php  } ?>
                                </div>

                      <!--           <span style="display: inline-block;"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de entrada"></i></span>
                                <span class="numscheck" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $n_t; ?>"><?php echo $n_ch; ?></span>
                                <span style="display: inline-block;"><i class="fas fa-arrow-right" data-toggle="tooltip" data-placement="top" data-original-title="Insumos de salida"></i></span>
                        -->     </td>
                            <td class="opciones2">
                                <span><a style="color: <?php echo $color ?>;display: inline-block;" <?php echo $onclick_check ?>><?php echo $icono ?></a></span>
                                <span><a style="display:inline-block; color: purple;" <?php echo $onclick_versiones; ?>><i data-toggle="tooltip" data-placement="top" data-original-title="versiones" class="fas fa-archive"></i></a></span>

                                <?php if ($row['id_tipo'] != 10) { ?>
                                    <span><a style="color: purple;display: inline-block;" <?php echo $onclick_form ?>><i data-toggle="tooltip" data-placement="top" data-original-title="Añadir entregable" class="fas fa-plus-circle"></i></a></span>
                                <?php } ?>
                                <span><a style="display: inline-block;color: purple;" <?php echo $onclick_asunto ?>><i data-toggle="tooltip" data-placement="top" data-original-title="Redactar asunto" class="far fa-edit"></i></a></span>
                                <!-- <span><a style="display:inline-block;color: purple;" <?php echo $onclick_insumos ?>><span><i data-toggle="tooltip" data-placement="top" data-original-title="Insumos" class="fas fa-coins"></i></a></span> -->
                                <?php if ($ACME == 1) { ?>
                                    <span><a style="display: inline-block;color:purple" onclick="setMeta(<?php echo $idcheck ?>,1,2);"><i data-toggle="tooltip" data-placement="top" data-original-title="Aplicar mejora" class="fab fa-maxcdn"></i></a></span>
                                <?php } ?>

                            </td>
                            <td class="avance2">
                                <progress id="file" style="width: 20px;" max="100" value="<?php echo $avance_checklist ?>"></progress><?php echo ' ' . $avance_checklist ?> %

                            </td>
                            <td class="fecha2">
                                <?php if ($row['Fecha_entrega_propuesta'] == null || $row['Fecha_entrega_propuesta'] == '') {
                                    echo 'sin fecha propuesta';
                                } else {
                                    echo $row['Fecha_entrega_propuesta'];
                                } ?>
                            </td>
                            <td class="fecha2">
                                <?php if ($row['Fecha_entrega_final'] == null || $row['Fecha_entrega_final'] == '') {
                                    echo 'sin finalizar';
                                } else {
                                    echo $row['Fecha_entrega_final'];
                                } ?>
                            </td>
                        </tr>
                    <?php $orden_check++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" id="muestraTabla">
        </div>

    </div>
</body>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });

    function muestraTab(Id_check, tipo, Id_actividad, Id_categoria, periodo) {
        var Id_check = Id_check;
        var tipo = tipo;
        var Id_actividad = Id_actividad;
        var Id_categoria = Id_categoria;
        var periodo = periodo;
        $.post("Versiones.php", {
            Id_actividad: Id_actividad,
            tipo: tipo,
            Id_check: Id_check,
            Id_categoria: Id_categoria,
            periodo: periodo,
        }, function(data) {
            $("#muestraTabla").html('');
            $("#muestraTabla").html(data);
        });
    }

    function muestrainsumo2(Id_check) {
        var Id_check = Id_check;
        $.post("Insumos.php", {
            Id_check: Id_check,
        }, function(data) {
            $("#muestraTabla").html('');
            $("#muestraTabla").html(data);
        });
    }

    function muestradictamen(idExposicion, tipo) {
        $.post("Dictamenes.php", {
            idExposicion: idExposicion,
            tipo: tipo,
        }, function(data) {
            $("#muestraTabla").html('');
            $("#muestraTabla").html(data);
        });

    }
    function muestra_insumos(tipo_insumo,idcheck,idact,categoria,periodo,acme){
      let titulo = "";
      let act = idact;
      let check = idcheck;

      if(tipo_insumo == 1){//entrada
        titulo = "insumos de entrada";
      }else{//salida
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
          acme:acme,
          tipo_insumo,tipo_insumo}, function(data) {
          $(".detalle_insumo").html('');
          $(".detalle_insumo").html(data);
      });
    }
    function alta_insumo(idcheck,idact,categoria,periodo,acme,nombrecheck,tipo_insumo){
      var titulo = "";
      if(tipo_insumo == 1)
        titulo = "Nuevo insumo de ENTRADA:"+nombrecheck;
      else{
        titulo = "Nuevo insumo de SALIDA:"+nombrecheck;
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
          acme:acme,
          tipo_insumo:tipo_insumo}, function(data) {
          $(".detalle_insumo_alta").html('');
          $(".detalle_insumo_alta").html(data);
      });
    }
</script>

</html>
