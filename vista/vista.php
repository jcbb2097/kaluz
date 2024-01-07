<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$tot = 0;
$categorias = array();
$total = array();

$AnioActual=date("Y"); //Año actual para mostrar por default
$Aplicacion="Asuntos indicadores";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
$ejearea = 0;
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if (isset($_SESSION['user_session']) ){ $MiIdUsr = $_SESSION['user_session'];}
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
if ((isset($_GET['idejearea']) && $_GET['idejearea'] != ""))    { $idejearea=    $_GET['idejearea']; }
if ((isset($_GET['ejearea']) && $_GET['ejearea'] != ""))    { $ejearea=    $_GET['ejearea']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga
$array_problematica = array(0,0,0);
$array_solicitud = array(0,0,0);
$array_conocimiento = array(0,0,0);
$array_sugerencia = array(0,0,0);
$tipos  =array (4,1,2,3);
$pocentajes = array();
$muestrainfo = "";
$avance = 0;
if($ejearea == 2 )//eje
  $muestrainfo = "muestradetalle($idejearea,1,1)";
if($ejearea == 1){//area
  $muestrainfo = "muestradetalle($idejearea,2,1)";
  $_GET['verpor'] = 2;
}
if ((isset($_GET['verpor']) && $_GET['verpor'] != "") && !isset($_GET['ejearea'])){
    $ejearea = 1;
}else{
  if(!isset($_GET['ejearea']))
    $ejearea = 2;
}


?>
<script>
    var nombrearea ='';
</script>

<script>
    var MiApp='<?php echo $Aplicacion; ?>';
    var MiTipoPerfil='<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr='<?php echo $MiIdUsr; ?>';
    var MiNomUsr='<?php echo $MiNomUsr; ?>';
    var MiAnioAct='<?php echo $AnioActual; ?>';
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../resources/css/aplicaciones/estilos.css" />

    <script src="../resources/js/bootstrap/bootstrapValidator.js"></script>
    <script src="../resources/js/aplicaciones/Noticias/funciones.js"></script>
    <style media="screen">
      .celdas{
        padding: 1px !important;
        text-align: center;
        font-size: .8em;
      }
    </style>
    <title>::.Asuntos.::</title>
</head>

<body>
  <div class="well well-sm" style="background-color: #cccac9 !important;border: 0px !important;color: black;font-family : 'Muli-Bold';margin-bottom: 2px;padding: 2px;" >
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4 text-center">

      </div>
      <div class="col-md-4 col-sm-4 col-xs-4 text-center">
        <span  id="AnioTitulo" >Asuntos  <span id="envrecib">enviados</span> por <?php if(isset($_GET['verpor']) &&  $_GET['verpor']== 2)echo 'Área';else echo 'Eje'?></span>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4 text-center">
        <!--<label class="control-label " for="descripcion" style="text-align: right;" >Ver_por:</label>
            <select id="verpor"  name="selecc" onchange="verpor();">
                <option value="1">Eje</option>
                <?php
                $selected  = "";
                if(isset($_GET['verpor'])){
                  $selected = "selected";
                } ?>
                <option value="2" <?php // echo $selected; ?>>Área</option>
                <option value="4">Entregable Específico</option>
            </select>-->
            <?php  if(isset($_GET['verpor']) &&  $_GET['verpor']== 2){ ?>

            <label class="control-label" for="descripcion" >Tipo: </label>
                <select id="tipo" class="" name="anio" onchange="mostrardetalle()" >
                  <option value="" >Seleccione una opción</option>
                  <option value="1" selected>Enviados</option>
                  <option value="2">Recibidos</option>
                  <option value="3">Invitado</option>

                </select>
                <?php
              }else{
                echo '<input type="hidden" name="tipo" id="tipo" value="1">';
              }
                 ?>

      </div>
    </div>

  </div>

<div class="container-fluid">
    <div class="row">
        <!-- <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group form-group-sm">
              <div class="col-md-2 col-sm-2 col-xs-2">
                  <label class="col-md-4 col-sm-4 col-xs-4 control-label " for="descripcion" style="text-align: right;" >Ver_por:</label>
                  <div class="col-md-8 col-sm-8 col-xs-8">
                      <select id="verpor" class="form-control" name="selecc" onchange="verpor();">
                          <option value="1">Eje</option>
                          <?php
                          $selected  = "";
                          if(isset($_GET['verpor'])){
                            $selected = "selected";
                          } ?>
                          <option value="2" <?php echo $selected; ?>>Área</option>
                          <option value="4">Entregable Específico</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-2">
                <label class="col-md-4 col-sm-4 col-xs-4  control-label" for="descripcion" >Tipo: </label>
                <div class="col-md-8 col-sm-8 col-xs-8">
                    <select id="tipo" class="form-control" name="anio" onchange="mostrardetalle()" >
                      <option value="" >Seleccione una opción</option>
                      <option value="1" selected>Enviados</option>
                      <option value="2">Recibidos</option>
                      <option value="3">Invitado</option>

                    </select>
                </div>
              </div>
            </div>

        </div>
        <legend  id="AnioTitulo" style="text-align: center;">Asuntos  <span id="envrecib">enviados</span> por <?php if(isset($_GET['verpor']) &&  $_GET['verpor']== 2)echo 'Área';else echo 'Eje'?></legend>
    </div> -->
    <?php
      $totales_consulta = "SELECT COUNT(*) AS total , con.tipo , con.estatus  FROM k_conversacion con
                          GROUP BY con.tipo , con.estatus";
      $res = $catalogo->obtenerLista($totales_consulta);
      while ($rows = mysqli_fetch_array($res)){
        switch ($rows['tipo']) {
          case 1://solicitud
            if($rows['estatus'] == '1')
              $array_solicitud[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_solicitud[1] = $rows['total'] ;
            else
              $array_solicitud[2] += $rows['total']  ;
            break;
          case 2://conocimiento
            if($rows['estatus'] == '1')
              $array_conocimiento[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_conocimiento[1] = $rows['total'] ;
            else
              $array_conocimiento[2] += $rows['total']  ;
              break;
          case 3://sugerencia
            if($rows['estatus'] == '1')
              $array_sugerencia[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_sugerencia[1] = $rows['total'] ;
            else
              $array_sugerencia[2] += $rows['total']  ;
              break;
          case 4://Problematica
            if($rows['estatus'] == '1')
              $array_problematica[0] = $rows['total'] ;
            elseif($rows['estatus'] == '2')
              $array_problematica[1] = $rows['total'] ;
            else
              $array_problematica[2] += $rows['total']  ;
            break;
        }
      }
      $array_problematica[3] = $array_problematica[0]+$array_problematica[1]+$array_problematica[2];
      $array_solicitud[3] = $array_solicitud[0]+$array_solicitud[1]+$array_solicitud[2];
      $array_conocimiento[3] = $array_conocimiento[0]+$array_conocimiento[1]+$array_conocimiento[2];
      $array_sugerencia[3] = $array_sugerencia[0]+$array_sugerencia[1]+$array_sugerencia[2];
      $total = $array_problematica[3]+$array_solicitud[3]+$array_conocimiento[3]+$array_sugerencia[3];
      if($total == 0){
       $pocentajes[1] = 0;
       $pocentajes[2] = 0;
       $pocentajes[3] = 0;
       $pocentajes[4] = 0;
     }else{
       $pocentajes[1] = ($array_problematica[3] * 100) / $total;
       $pocentajes[2] = ($array_solicitud[3] * 100) / $total;
       $pocentajes[3] = ($array_conocimiento[3] * 100) / $total;
       $pocentajes[4] = ($array_sugerencia[3] * 100) / $total;
     }

     ?>
    <div class="row">
        <div >


                <div class="col-md-12 col-sm-12 col-xs-12" id="recargar">
                <table id="tablaasuntos" class="table table-striped table-bordered" style="width:100%;margin-top: 2px!important;">
                <thead class="thead-dark">
                    <tr style="padding: 1px !important;">
                        <th style="border-right: solid;" class="celdas"><?php if(isset($_GET['verpor']) &&  $_GET['verpor']== 2)echo 'Área';else echo 'Eje'?></th>
                        <!-- <th style='background-color: #000000;'></th> -->
                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Pr &nbsp;(<?php echo $array_problematica[3].") (".round($pocentajes[1], 2); ?>%) </th>

                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Sol &nbsp;(<?php echo $array_solicitud[3].") (".round($pocentajes[2], 2); ?>%)</th>

                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Con &nbsp;(<?php echo $array_conocimiento[3].") (".round($pocentajes[3], 2); ?>%)</th>

                        <th style="border-right: solid;" class="celdas" scope="col" colspan="3">Sug &nbsp;(<?php echo $array_sugerencia[3].") (".round($pocentajes[4], 2); ?>%)</th>
                        <th  class="celdas" >Total (<?php echo $total; ?>)</th>
                    </tr>
                    <tr>
                      <th style="border-right: solid;" class="celdas"></th>
                      <th style="background-color: #76c65a;" class="celdas"><span >Res </span></th><!-- (<?php echo $array_problematica[2]; ?>) -->
                      <th style="background-color: #fbf44e;" class="celdas"><span >Conv </span></th><!-- (<?php echo $array_problematica[1]; ?>) -->
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas"><span >Snleer </span></th><!-- (<?php echo $array_problematica[0]; ?>) -->
                      <th style="background-color: #76c65a;" class="celdas"><span >Res </span></th><!-- (<?php echo $array_solicitud[2]; ?>) -->
                      <th style="background-color: #fbf44e;" class="celdas"><span >Conv </span></th><!-- (<?php echo $array_solicitud[1]; ?>) -->
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas"><span >Snleer </span></th><!-- (<?php echo $array_solicitud[0]; ?>) -->
                      <th style="background-color: #76c65a;" class="celdas"><span >Res </span></th><!-- (<?php echo $array_conocimiento[2]; ?>) -->
                      <th style="background-color: #fbf44e;" class="celdas"><span >Conv </span></th><!-- (<?php echo $array_conocimiento[1]; ?>) -->
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas"><span>Snleer </span></th><!-- (<?php echo $array_conocimiento[0]; ?>) -->
                      <th style="background-color: #76c65a;" class="celdas"><span >Res </span></th><!-- (<?php echo $array_sugerencia[2]; ?>) -->
                      <th style="background-color: #fbf44e;" class="celdas"><span >Conv </span></th><!-- (<?php echo $array_sugerencia[1]; ?>) -->
                      <th style="background-color: #e65f5f;border-right: solid" class="celdas"><span >Snleer  </span></th><!-- (<?php echo $array_sugerencia[0]; ?>) -->
                      <th></th>

                    </tr>

                </thead>
                <tbody>

                <?php
                $consulta = " SELECT concat(eje.idEje,'.-',eje.Nombre) AS nombre , eje.idEje
                          from c_eje eje order by eje.idEje";

                if(isset($_GET['verpor']) &&  $_GET['verpor']== 2){//area
                  $consulta = "  SELECT area.Nombre AS nombre , area.Id_Area
                            from c_area area WHERE area.estatus = 1  order by area.Id_Area";
                }

                $resulteje = $catalogo->obtenerLista($consulta);
                $cont = 0;
                while ($rs = mysqli_fetch_array($resulteje)) {
                  $cont++;
                  if(isset($_GET['verpor']) &&  $_GET['verpor']== 2){
                    $id = $rs['Id_Area'];
                    $where_avance = "a.IdArea = $id";
                  }else{
                    $id = $rs['idEje'];
                    $where_avance = "a.IdEje = $id";
                  }
                  //$AnioActual cambiar año por eso
                  $consulta_avance = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
                                        FROM k_checklist_actividad cha
                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
                                        WHERE (a.Anio=2021)
                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
                                        AND chani.Visible<>0 AND chani.Anio=2021
                                        AND acani.Visible<>0 AND acani.Anio=2021
                                        AND caani.Visible<>0 AND caani.Anio=2021
                                        AND $where_avance ";

                    $resul_avance = $catalogo->obtenerLista($consulta_avance);
                    while ($row_avance = mysqli_fetch_array($resul_avance)){
                      $avance = $row_avance['total'];
                    }


                    echo  "<tr id='".$id."'>";
                    //<a href='estadisticas.php?ejearea=$ejearea&idejearea=$id'><i class='fa fa-bar-chart fa-3' aria-hidden='true'></i></a>
                    if(isset($_GET['verpor']) &&  $_GET['verpor']== 2)
                      echo "<td onclick='muestradetalle(".$id.",2,1)' style='cursor:pointer;border-right: solid;' class='celdas'><b>".$rs['nombre']."&nbsp;&nbsp;&nbsp;&nbsp; </b> ($avance%)</td>";
                    else
                      echo "<td onclick='muestradetalle(".$id.",1,1)' style='cursor:pointer;border-right: solid;' class='celdas'><b>".$rs['nombre']." </i></b> ($avance%)</td>";
                    //  echo "<td style='background-color: #000000;'></td>";
                      $total_fila = 0;
                      $pendientes_fila = 0;
                      foreach ($tipos as $key) {

                                      if(isset($_GET['verpor']) &&  $_GET['verpor']== 2){
                                        $datos = "SELECT
                                                 (SELECT  COUNT(*) AS total
                                                 from k_conversacion con
                                                      WHERE con.tipo = $key AND con.estatus = 1 AND con.idOrigen = $id) AS sinleer,

                                                  (SELECT  COUNT(*) AS total
                                                 from k_conversacion con
                                                      WHERE con.tipo = $key AND con.estatus = 2 AND con.idOrigen = $id) AS enconv,

                                                (SELECT  COUNT(*) AS total
                                                 from k_conversacion con
                                                      WHERE con.tipo = $key AND con.estatus IN (3,4) AND con.idOrigen = $id) AS resuelto	";
                                      }else{
                                        $datos = "SELECT
                                                 (SELECT  COUNT(*) AS total
                                                 from k_conversacion con JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                                                      WHERE con.tipo = $key AND con.estatus = 1 AND conac.idEje = $id) AS sinleer,

                                                  (SELECT  COUNT(*) AS total
                                                 from k_conversacion con JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                                                      WHERE con.tipo = $key AND con.estatus = 2 AND conac.idEje = $id) AS enconv,

                                                (SELECT  COUNT(*) AS total
                                                 from k_conversacion con JOIN k_conversacionActividad conac ON con.idConversacion = conac.idConversacion
                                                      WHERE con.tipo = $key AND con.estatus IN (3,4) AND conac.idEje = $id) AS resuelto";
                                      }
                        $resdatos = $catalogo->obtenerLista($datos);

                        while ($rs1 = mysqli_fetch_array($resdatos)){
                            $color_amarillo = "";
                            $color_rojo = "";
                            if($rs1['enconv'] > 0)
                              $color_amarillo = "background-color: #fbf44e;";
                            if($rs1['sinleer'] > 0)
                                $color_rojo = "background-color: #e07878;";

                            echo "<td class='celdas' ><a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",1,0,0,".$key.",3,0)'>".$rs1['resuelto']."</a></td>";
                            echo "<td style='$color_amarillo' class='celdas'><a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",1,0,0,".$key.",2,0)'>".$rs1['enconv']."</a></td>";
                            echo "<td style='border-right: solid;$color_rojo' class='celdas'><a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",1,0,0,".$key.",1,0)'>".$rs1['sinleer']."</a></td>";
                            //echo "<td style='background-color: #000000;'></td>";
                            $total_fila += $rs1['resuelto'] + $rs1['enconv'] + $rs1['sinleer'];
                            $pendientes_fila += $rs1['enconv'] + $rs1['sinleer'];
                        }
                      }
                      $porcentaje = round(($total_fila * 100) / $total,1);
                  echo "<td  class='celdas'><a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",1,0,0,0,8,0)'>$total_fila </a>  ($porcentaje%) /  <a style='cursor: pointer;' onclick='muestraDetalle_modal(".$ejearea.",".$id.",1,0,0,0,7,0)'> $pendientes_fila </a> </td>";
                  echo  "</tr>";

                }
            ?>
          </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th scope="col">Total</th>

                            <th scope="col"><?php echo ''.$tot.''; ?></th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
            <br><br><br>
            <div class="col-md-12 col-sm-12 col-xs-12" id="tabla_recargar" style="display : none;">

            </div>
            <input type="hidden" name="eje" id="eje" value="">
            <input type="hidden" name="area" id="area" value="">

            <div style="top: 33px;" class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="left: -6px;width: 624px;">
                  <div class="modal-header h" style="padding: 7px 5px;">
                    <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload(true);">&times;</button>
                    <center>
                      <span style="color:white;"  id="titulo">Asuntos abiertos</span>
                    </center>
                     <a style="color:white;text-decoration:none;" class="resul"></a>
                  </div>

                  <div class="modal-body detalle" style="padding: 5px 5px;">

                  </div>

                </div>
                </div>
            </div>
            <input type="hidden" name="idusr" id="idusr" value="<?php echo $MiIdUsr; ?>">
            <input type="hidden" name="asunto" id="asunto" value="">
            <input type="hidden" name="nombreusr" id="nombreusr" value="">
            <input type="hidden" name="ideje" id="ideje" value="">
            <input type="hidden" name="categoria" id="categoria" value="">
            <input type="hidden" name="acme" id="acme" value="">
            <input type="hidden" name="subcategoria" id="subcategoria" value="">
            <input type="hidden" name="act_glob" id="act_glob" value="">
            <input type="hidden" name="act_gen" id="act_gen" value="">
            <input type="hidden" name="periodo" id="periodo" value="">
            <input type="hidden" name="tipoentregable" id="tipoentregable" value="9">
            <input type="hidden" name="check" id="check" value="">


        </div>
    </div>
</div>
<input type="hidden" name="idusuario"  id="idusuario"  value="<?php echo $MiIdUsr; ?>">
</body>
<script>

$(document).ready(function () {

    var form = "#formIntervalo";
    var controller = "Controller_intervalo.php";

    $('#tablaasuntos').DataTable(
        {
            "language":
            {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            bAutoWidth: false,
                aoColumns : [
                  { sWidth: '17.2%'},
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.66%' },
                  { sWidth: '5.76%' },
                  { sWidth: '14.7%' }
                  //  { sWidth: '30%' }
                ],
            "order": false,
            "paging": false,
            "searching": false,
            "bInfo": false,
            "ordering": false
        });
});

function verpor(){
  let verpor = $("#verpor").val();
  if(verpor == 2)
    location.href="vista.php?verpor=2";
  else{
    location.href="vista.php";
  }
}
 function muestradetalle(ejearea,tipoverpor,moctabla){
   var param = "";
   var num = 0;
   if(tipoverpor == 1){
     $("#eje").val(ejearea);
     $("#area").val(0);
     param = "&ideje="+ejearea;
     num = 13;
   }
    if(tipoverpor == 2){
        $("#area").val(ejearea);
        $("#eje").val(0);
        param = "&idarea="+ejearea;
        num = 1002;
    }

   //ocultar todos menos el eje que viene
   for (var i = 1; i < num; i++) {
     if(i != ejearea){
       if ( $("#"+i).length > 0 ) {
            $("#"+i).toggle();
        }
     }
   }
   param += "&usr="+$( "#idusuario" ).val();
   if(moctabla == 1){
     $("#tabla_recargar").toggle();
   }
   $("#tabla_recargar").load("tabla.php?tipo="+$("#tipo").val()+""+param);
 }


 function mostrardetalle(){
   var eje = $("#eje").val();
   var area = $("#area").val();

   if(eje > 0){
     param = "&ideje="+eje;
   }
    if(area > 0){
        param = "&idarea="+area;
    }
    param += "&usr="+$( "#idusuario" ).val();


      $("#recargar").load("tablaprincipal.php?tipo="+$("#tipo").val()+""+param);
      if($("#tipo").val() == 1)
              $("#envrecib").html("Enviados");
      if($("#tipo").val() == 2)
              $("#envrecib").html("Recibidos");
      if($("#tipo").val() == 3)
              $("#envrecib").html(" con invitaciones ");
    // }else{
    //
    //   $("#tabla_recargar").load("tabla.php?tipo="+$("#tipo").val()+""+param);
    // }

 }
 function adjuntarArchivo(){
   var usr = $( "#idusr" ).val();
   let nombreusr = $( "#nombreusr" ).val();
   let ideje = $( "#ideje" ).val();
   let act = $( "#acme" ).val();
   let categoria = $( "#categoria" ).val();
   let subcategoria = $( "#subcategoria" ).val();
   let act_glob = $( "#act_glob" ).val();
   let act_gen = $( "#act_gen" ).val();
   let periodo = $( "#periodo" ).val();
   let check = $( "#check" ).val();
   let tipoentregable = $( "#tipoentregable" ).val();
   let asunto = $( "#asunto" ).val();

   $(".h").css('background-color',"#4d4d57");
   $("#Modal_altaarchivo").modal({backdrop: false});

    var frame = $('#frame'); //   ../ArchivosEntregables/Alta_entregable_2.php
       var url = "tipo_archivo.php?accion=guardar&tipoPerfil=1&nombreUsuario="+nombreusr+"&idUsuario="+usr+"&plan=1&Id_eje="+ideje+"&ACME="+act+
   "&cate="+categoria+"&subcate="+subcategoria+"&AGBL="+act_glob+"&AGENE="+act_gen+"&periodo="+periodo+"&check="+check+"&subcheck=&regreso=&tipo_entregable="+tipoentregable+"&origen_asunto="+asunto;
   //
   frame.attr('src',url).show();
 }

 <?php echo $muestrainfo; ?>
</script>

</html>
