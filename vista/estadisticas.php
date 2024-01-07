<?php
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

$AnioActual=date("Y"); //Año actual para mostrar por default
$Aplicacion="Asuntos indicadores";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
$ejearea = 0;
$dias= 5;
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if (isset($_SESSION['user_session']) ){ $MiIdUsr = $_SESSION['user_session'];}
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
if ((isset($_GET['ejearea']) && $_GET['ejearea'] != ""))    { $ejearea=    $_GET['ejearea']; }
if ((isset($_GET['idejearea']) && $_GET['idejearea'] != ""))    { $idejearea=    $_GET['idejearea']; }
if ((isset($_GET['dias']) && $_GET['dias'] != ""))    { $dias=    $_GET['dias']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

if($ejearea == 2){
  $ideje = $idejearea;
  $cons = "select CONCAT(eje.idEje,'.-',eje.Nombre) AS nombre from c_eje eje where idEje = $ideje";
  $resu= $catalogo->obtenerLista($cons);
  while ($rs = mysqli_fetch_array($resu)){
    $nombre = ' eje '.$rs['nombre'];
  }
}

if($ejearea == 1){
  $idarea = $idejearea;
  $cons = "select ar.Nombre from c_area ar where ar.Id_Area = $idarea";
  $resu = $catalogo->obtenerLista($cons);
  while ($rs = mysqli_fetch_array($resu)){
    $nombre = '  <b>'.$rs['Nombre'].'</b>';
  }
}
?>
<script>
    var MiApp='<?php echo $Aplicacion; ?>';
    var MiTipoPerfil='<?php echo $MiTipoPerfil; ?>';
    var MiIdUsr='<?php echo $MiIdUsr; ?>';
    var MiNomUsr='<?php echo $MiNomUsr; ?>';
    var MiAnioAct='<?php echo $AnioActual; ?>';
    var nombrearea ='<?php echo $nombre; ?>';
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../resources/css/aplicaciones/estilos.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="../resources/css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../resources/js/bootstrap-select.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="../resources/js/bootstrap/bootstrapValidator.js"></script>
    <link rel="stylesheet" type="text/css" href="estilos_estadisticas.css"/>
    <title>::.Asuntos.::</title>
</head>
<body>
  <div class="well well-sm" style="margin-bottom:0px;"><a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> /
     <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Asuntos</a>
       <a href="vista.php?ejearea=<?php echo $ejearea; ?>&idejearea=<?php echo $idejearea; ?>" style="position:absolute; right: 50px; color:white;" > Regresar </a>
  </div>

  <?php
  $cons = "select (SELECT COUNT(*) total FROM k_conversacion con WHERE con.estatus NOT IN(3,4)) as total_abiertos ,
            (SELECT COUNT(*) total FROM k_conversacion con WHERE con.estatus  IN(3,4)) as total_resueltos ";
  $resu= $catalogo->obtenerLista($cons);
  while ($rs = mysqli_fetch_array($resu)){
    $total_abiertos = $rs['total_abiertos'];
    $total_res = $rs['total_resueltos'];
  }
   ?>
<div class="container-fluid">
  <div class="row">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-3 text-center"><h5>Asuntos abiertos : <b><?php echo $total_abiertos; ?></b> &nbsp;&nbsp;&nbsp; Resueltos:  <b style="color: rgb(91, 199, 69);"><?php echo $total_res; ?></b>  </h5></div>
      <div class="col-md-5 col-sm-5 col-xs-5 text-center" style="font-size: 21px;">Asuntos <?php echo $nombre; ?> </div>
      <div class="col-md-4 col-sm-4 col-xs-4"></div>

    </div>
    <legend id="AnioTitulo" style="text-align: center;margin-bottom:5px;"></legend>
  <div class="col-md-3 col-sm-3 col-xs-3">
            <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12" >


                    </div>
            </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <center style="font-size : 13px;">Enviados</center>
              <table class="table table-striped table-bordered" style="width:100%;margin-bottom: 0px !important;font-size: .7em;">
                <thead>
                  <?php
                  $cons = "select (SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus NOT IN(3,4)  AND con.idOrigen = $idejearea ) as total_enviados ,
                            (SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus  IN(3,4)  AND con.idOrigen = $idejearea) as total_env_cerrados";
                  $resu= $catalogo->obtenerLista($cons);
                  while ($rs = mysqli_fetch_array($resu)){
                    $total_enviados = $rs['total_enviados'];
                    $total_env_cerrados = $rs['total_env_cerrados'];
                  }
                  $total_sinact_creacion = 0;
                  $cons = "SELECT  if(MAX(conre.fecha)  = con.fechaInicio,'0','1') AS tuvoaccion
                           FROM k_conversacion con
                          JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion and conre.idArea = con.idOrigen
                          WHERE con.estatus NOT IN(3,4) AND con.idOrigen = $idejearea
                          GROUP BY con.idConversacion
                          HAVING tuvoaccion = 0";
                  $resu= $catalogo->obtenerLista($cons);
                  $total_sinact_creacion = mysqli_num_rows($resu);

                  $mas3diassinres = 0;
                  $menos3diasconres = 0;
                  $cons = "SELECT  DATEDIFF(NOW(),MAX(conre.fecha)) AS ultimaatencion,  if(MAX(conre.fecha)  = con.fechaInicio,'0','1') AS tuvoaccion
                          FROM k_conversacion con
                          JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion AND conre.idArea = con.idOrigen
                          WHERE con.estatus NOT IN(3,4) AND con.idOrigen = $idejearea
                          GROUP BY con.idConversacion
                          HAVING tuvoaccion = 1";
                  $resu= $catalogo->obtenerLista($cons);
                  while ($rs = mysqli_fetch_array($resu)){
                    if($rs['ultimaatencion'] > $dias){
                      $mas3diassinres++;
                    }else{
                      $menos3diasconres++;
                    }
                  }

                   ?>
                  <th style="width: 70%;">Origen  <?php echo $nombre; ?></th>
                  <th style="width: 30%;">Total (<a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,1,0,0)"><?php echo $total_enviados; ?></a>)&nbsp;&nbsp;&nbsp;
                  Res  <b style="color: rgb(76 177 56);"><?php echo $total_env_cerrados; ?></b>   </th>
                </thead>
                <tbody>
                  <tr>
                    <td style='padding:4px !important;'>Sin intervención del área emisora  </td>
                    <td style='padding:4px !important;'><a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,1,1,0)"><b ><?php echo $total_sinact_creacion;?></b></a> </td>
                  </tr>
                  <tr>
                    <td style='padding:4px !important;'> +  <?php echo $dias; ?> días sin respuesta: </td>
                    <td style='padding:4px !important;'><a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,1,2,<?php echo $dias; ?>)"><b><?php echo $mas3diassinres;?></b></a> </td>
                  </tr>
                  <tr>
                    <td style='padding:4px !important;'> -  <?php echo $dias; ?> días con respuesta : </td>
                    <td style='padding:4px !important;'><a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,1,3,<?php echo $dias; ?>)"><b><?php echo $menos3diasconres;?></b></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <center>Recibidos</center>
              <table class="table table-striped table-bordered" style="width:100%;margin-bottom: 0px !important;font-size: .7em;">
                <thead>
                  <?php
                  $cons = "select (SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus NOT IN(3,4)  AND con.idDestino = $idejearea AND con.idOrigen <> $idejearea) as total_recibidos ,
                            (SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus  IN(3,4)  AND con.idDestino = $idejearea) as total_rec_cerrados";
                  $resu= $catalogo->obtenerLista($cons);
                  while ($rs = mysqli_fetch_array($resu)){
                    $total_recibidos = $rs['total_recibidos'];
                    $total_rec_cerrados = $rs['total_rec_cerrados'];
                  }
                  $total_sinact_participacion = 0;
                  $cons = "SELECT   COUNT(*) AS total
                           FROM k_conversacion con
                          left JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion AND conre.idArea = con.idDestino
                          WHERE con.estatus NOT IN(3,4) AND con.idDestino = $idejearea AND con.idOrigen <> $idejearea AND conre.fecha IS null
                          GROUP BY con.idConversacion , conre.fecha";
                  $resu= $catalogo->obtenerLista($cons);
                  $total_sinact_participacion = mysqli_num_rows($resu);

                  $mas3diassinres = 0;
                  $menos3diasconres = 0;
                  $cons = "SELECT  DATEDIFF(NOW(),MAX(conre.fecha)) AS ultimaatencion
                           FROM k_conversacion con
                          JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion AND conre.idArea = con.idDestino
                          WHERE con.estatus NOT IN(3,4) AND con.idDestino = $idejearea AND con.idOrigen <> $idejearea
                          GROUP BY con.idConversacion";
                  $resu= $catalogo->obtenerLista($cons);
                  while ($rs = mysqli_fetch_array($resu)){
                    if($rs['ultimaatencion'] > $dias){
                      $mas3diassinres++;
                    }else{
                      $menos3diasconres++;
                    }
                  }

                   ?>
                  <th style="width: 70%;">Destino  <?php echo $nombre; ?></th>
                  <th style="width: 30%;">Total (<a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,2,0,0)"><?php  echo $total_recibidos; ?></a>) &nbsp;&nbsp;&nbsp;
                  Res  <b style="color: rgb(76 177 56);"><?php echo $total_rec_cerrados; ?></b> </th>
                </thead>
                <tbody>
                  <tr>
                    <td style='padding:4px !important;'>Nunca ha contestado : </td>
                    <td style='padding:4px !important;' ><a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,2,1,0)"><b><?php echo $total_sinact_participacion; ?></b></a> </td>
                  </tr>
                  <tr>
                    <td style='padding:4px !important;'> +  <?php echo $dias; ?> días sin respuesta: </td>
                    <td style='padding:4px !important;'><a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,2,2,<?php echo $dias; ?>)"><b><?php echo $mas3diassinres; ?></b></a> </td>
                  </tr>
                  <tr>
                    <td style='padding:4px !important;'> -  <?php echo $dias; ?> días con  respuesta : </td>
                    <td style='padding:4px !important;'><a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,2,3,<?php echo $dias; ?>)"><b><?php echo $menos3diasconres; ?></b></a> </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
              <?php
              $nuncacontestado = 0;$mas3diassinres = 0;$menos3diassinres = 0;$total_invarea = 0;
              $consultainvitados = "SELECT  if(ISNULL(conre.idRespuesta),'Nunca','si') AS hacontestado ,  DATEDIFF(NOW(),MAX(conre.fecha))  AS ultimaatencion
                           FROM k_conversacion con
                           JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                          left JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion AND conre.idArea = conva.idArea
                          WHERE con.estatus NOT IN(3,4) AND  conva.idArea = $idejearea
                          GROUP BY con.idConversacion ";
                          $resu= $catalogo->obtenerLista($consultainvitados);
                          while ($row = mysqli_fetch_array($resu)){
                              if($row['hacontestado'] == "Nunca"){
                                $nuncacontestado++;
                              }else{
                                if($row['ultimaatencion'] > $dias){
                                  $mas3diassinres++;
                                }else{
                                  $menos3diassinres++;
                                }
                              }
                              $total_invarea++;
                          }
                  $consultainvres = "SELECT  con.idConversacion
                           FROM k_conversacion con
                           JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                          WHERE con.estatus   IN(3,4) AND  conva.idArea = 5
                          GROUP BY con.idConversacion";
                  $resul = $catalogo->obtenerLista($consultainvres);
                  $total_inv_res = mysqli_num_rows($resul);
                          ?>
              <?php
              $total_ne_nr_ni = $total_abiertos - ($total_recibidos + $total_enviados + $total_invarea) ;
              if($total_ne_nr_ni < 0)$total_ne_nr_ni = 0;
               ?>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <center>Invitado</center>
              <table class="table table-striped table-bordered" style="width:100%;margin-bottom: 10px !important;font-size: .7em;">
                <thead>
                  <th style="width: 70%;"> <?php echo $nombre; ?> es invitado</th>
                  <th style="width: 30%;">Total (<a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,3,0,0)"><?php echo $total_invarea; ?></a>) &nbsp;&nbsp;&nbsp;
                  Res  <b style="color: rgb(76 177 56);"><?php echo $total_inv_res; ?></b> </th>
                </thead>
                <tbody>
                  <tr>
                    <td style='padding:4px !important;'>Nunca ha contestado :</td>
                    <td style='padding:4px !important;'> <a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,3,1,0)"><b> <?php echo $nuncacontestado; ?></b></a></td>
                  </tr>
                  <tr>
                    <td style='padding:4px !important;'> +  <?php echo $dias; ?> días sin respuesta:  </td>
                    <td style='padding:4px !important;'> <a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,3,2,<?php echo $dias; ?>)"><b><?php echo $mas3diassinres; ?></b></a></td>
                  </tr>
                  <tr>
                    <td style='padding:4px !important;'> -  <?php echo $dias; ?> días con respuesta : </td>
                    <td style='padding:4px !important;'> <a href="#" onclick="muestraDetalle_modal(1,<?php echo $idejearea; ?>,3,3,<?php echo $dias; ?>)"><b> <?php echo $menos3diassinres; ?></b></a></td>
                  </tr>
                </tbody>
              </table>
            </div>


          </div>

          <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">
              <?php $cons = "SELECT COUNT(*) total FROM k_conversacion con  WHERE con.estatus NOT IN(3,4)  AND con.idDestino not in ( $idejearea ) and con.idOrigen not in ( $idejearea ) ";
              $resu= $catalogo->obtenerLista($cons);
              while ($rs = mysqli_fetch_array($resu)){
                $total_novanarea = $rs['total'];
              }
              $si_invitaron =  $total_novanarea - $total_ne_nr_ni;
              ?>
              <span style="font-size: .85em">Asuntos abiertos donde <?php echo $nombre; ?> no es ni emisor, ni receptor: <b><?php echo $total_novanarea; ?></b></span>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <span style="font-size: .85em"><?php echo $nombre; ?> es invitado en : <b><?php echo $total_invarea;?></b> asuntos abiertos </span>
            </div>
          </div> -->
          <div class="row" style="margin-bottom: 50px;">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <span style="font-size: .85em"> Asuntos abiertos donde <?php echo $nombre; ?> no esta invitado : <b><?php echo $total_ne_nr_ni; ?></b></span>
            </div>
          </div>

          <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12">

                <label class="" for="dias" style="font-size: .8em"># días sin respuesta:</label>

                  <input  style="width: 14%;" type="number" name="dias" id="dias" value="<?php echo $dias; ?>">


                <button  type="button" name="button" id="filtrar">Filtrar</button>
            </div>
          </div><br>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- <button type="button" class="btn btn-sm rounded-0 mr-1 btnNew " onclick="nuevoAsunto();"><div class="tooltip2"><i style="font-size:18px;" class="far fa-edit"></i><span class="tooltiptext2">redactar asunto</span></div></button> -->
            </div>


          </div>

  </div>

  <div class="col-md-5 col-sm-5 col-xs-5">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12"  >
        <figure class="highcharts-figure"></figure>
        <div id="containerss" ></div>
       <!-- <div id="containerss2"></div>-->
      </div>
    </div>
    <div class="row" id="env_rec_inv">
      <div class="col-md-12 col-sm-12 col-xs-12"  >
        <figure class="highcharts-figure"></figure>
        <div id="containers2"></div>
       <!-- <div id="containerss2"></div>-->
      </div>
    </div>
    <div class="row" style="display : none;" id="grafica_invitados">
      <div class="col-md-12 col-sm-12 col-xs-12"  >
        <figure class="highcharts-figure"></figure>
        <div id="containers3"></div>
       <!-- <div id="containerss2"></div>-->
       <button type="button" name="button" onclick="regresa_grafica()">Regresar a gráfica principal</button>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-sm-4 col-xs-4">
    <div class="col-md-12 col-sm-12 col-xs-12" id="cuadro_tabla_detalle">
    <center>Intervenciones por área</center>
      <table class="table table-striped table-bordered" style="width:100%;font-size: .7em;" >
        <thead>
          <th> Nombre</th>
          <th>Total </th>
          <th>% </th>
        </thead>
        <tbody>
          <?php
          $total = 0;
          $resu= $catalogo->obtenerLista("SELECT  COUNT(*) AS total FROM k_conversacionRespuesta r JOIN c_area a ON a.Id_Area=r.idArea");
          while ($r = mysqli_fetch_array($resu)){
            $total = $r['total'];
          }
          $cons = "SELECT a.Nombre,a.Id_Area, COUNT(*) AS total
                      FROM k_conversacionRespuesta r
                      JOIN c_area a ON a.Id_Area=r.idArea
                      GROUP BY r.idArea
                      ORDER BY total desc";
          $resu= $catalogo->obtenerLista($cons);
          while ($rs = mysqli_fetch_array($resu)){
            $porcentaje = ($rs['total'] / $total) * 100;
            $color = "";
            if($rs['Id_Area'] == $idarea){
              $color = "style='background-color:#1d476e;color: white;'";
            }

            echo "<tr $color >";
            echo "<td style='padding:4px !important;'>".$rs['Nombre']."</td>";
              echo "<td style='padding:4px !important;'>".$rs['total']."</td>";
                echo "<td style='padding:4px !important;'>".round($porcentaje,1)." %</td>";
            echo "</tr>";
            //$total += $rs['total'];
          }
           ?>
        </tbody>
        <tfoot>
          <tr style="background-">
            <th></th>
            <th><?php echo $total; ?></th>
            <th>100%</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div style="top: 64px;" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="left: -6px;width: 624px;">
        <div class="modal-header h" style="padding: 7px 5px;">
          <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload(true);">&times;</button>
          <center>
            <span style="color:white;" id="titulo">Asuntos abiertos</span>
          </center>
           <a style="color:white;text-decoration:none;" class="resul"></a>
        </div>

        <div class="modal-body detalle" style="padding: 5px 5px;">

        </div>

      </div>
      </div>
  </div>

</div>
</div>
<input type="hidden" name="idusr" id="idusr" value="<?php echo $MiIdUsr; ?>">
</body>
<?php
$grafica1 =array();
$grafica2 =array();
$grafica3 =array();
$totalarea =  $total_enviados + $total_recibidos ;
array_push($grafica1,"{ name: ' No invitado ', y: $total_ne_nr_ni ,key: 'otrareas'   , color : '#3f98d1'},");
array_push($grafica1,"{ name: ' Invitados ', y: $total_invarea ,key: 'invitados_area'   , color : '#8bbdde'},");
array_push($grafica1,"{ name: ' $nombre  (enviados+recibidos)', y: $totalarea ,key: 'area'   , color : '#1d476e'},");


array_push($grafica2,"{ name: ' Enviados ', y: $total_enviados ,key: 'enviados'   , color : '#d9d4d4'},");
array_push($grafica2,"{ name: ' Recibidos ', y: $total_recibidos ,key: 'recibidos'   , color : '#91e64f'},");
array_push($grafica2,"{ name: ' Invitados ', y: $total_invarea ,key: 'invitados'   , color : '#ded18b'},");

$resu= $catalogo->obtenerLista("SELECT    con.idOrigen,ca.Nombre, count(con.idConversacion) total
                           FROM k_conversacion con
                           JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
                           JOIN c_area ca ON ca.Id_Area = con.idOrigen
                          WHERE con.estatus NOT IN(3,4) AND  conva.idArea = $idejearea
                          GROUP BY con.idOrigen");
while ($r = mysqli_fetch_array($resu)){
  array_push($grafica3,"{ name: ' ".$r['Nombre']." ', y: ".$r['total']." ,key: ''  },");
}
 ?>
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
            "order": false,
            "paging": false
            //"ordering": false
        });
});

$( "#filtrar" ).click(function() {
  var dias = $( "#dias" ).val() ;
    window.location.href = "estadisticas.php?ejearea=<?php echo $ejearea; ?>&idejearea=<?php echo $idejearea; ?>&dias="+dias;
});

Highcharts.chart('containerss', {
  chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
  },
  title: {
      text: 'Asuntos SIE'
  },
  accessibility: {
      point: {
          valueSuffix: '%'
      }
  },
  plotOptions: {
      pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          point: {
            events: {
                click: function () {
                      if(this.options.key == "otrareas"){
                        console.log("otrareas");
                        $("#cuadro_tabla_detalle").load("detalle_grafica.php?tipo=otrasareas&idareaje=<?php echo $idejearea; ?>");

                      }else{
                        if(this.options.key == "invitados_area"){
                          console.log("invitados_area");
                          $("#cuadro_tabla_detalle").load("detalle_grafica.php?tipo=invitados_area&idareaje=<?php echo $idejearea; ?>");
                        }else{
                          console.log("area");
                          $("#cuadro_tabla_detalle").load("detalle_grafica.php?tipo=area&idareaje=<?php echo $idejearea; ?>");
                        }

                      }
                }
            }
          },
          dataLabels: {
              enabled: false
          },
          showInLegend: true
      }
  },
  series: [{
      name: '',
      colorByPoint: true,
      data: [
        <?php
          foreach ($grafica1 as $clave => $valor) {
            echo  $valor;
          }
        ?>
      ]
  }]
});

Highcharts.chart('containers2', {
  chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
  },
  title: {
      text: 'Enviados, recibidos'
  },
  tooltip: {
      pointFormat: '{series.name}:<b> {point.y}</b>'
  },
  accessibility: {
      point: {
          valueSuffix: '%'
      }
  },
  plotOptions: {
      pie: {
          allowPointSelect: true,
          cursor: 'pointer',
          point: {
            events: {
                click: function () {
                      if(this.options.key == "enviados"){
                        console.log("enviados");
                        $("#cuadro_tabla_detalle").load("detalle_grafica.php?tipo=enviados&idareaje=<?php echo $idejearea; ?>");

                      }else{
                        if(this.options.key == "invitados"){
                          console.log("invitados");
                          $("#cuadro_tabla_detalle").load("detalle_grafica.php?tipo=invitados&idareaje=<?php echo $idejearea; ?>");
                          $("#env_rec_inv").hide();
                          $("#grafica_invitados").show();

                        }else{
                          console.log("recibidos");
                          $("#cuadro_tabla_detalle").load("detalle_grafica.php?tipo=recibidos&idareaje=<?php echo $idejearea; ?>");
                        }

                      }
                }
            }
          },
          dataLabels: {
              enabled: false
          },
          showInLegend: true
      }
  },
  series: [{
      name: '',
      colorByPoint: true,
      data: [
        <?php
          foreach ($grafica2 as $clave => $valor) {
            echo  $valor;
          }
        ?>
      ]
  }]
});
Highcharts.chart('containers3', {
  chart: {
      type: 'pie',
  },
  title: {
      text: nombrearea+'  es invitado por ',
  },
  series: [{
      name: '',
      data: [
        <?php
          foreach ($grafica3 as $clave => $valor) {
            echo  $valor;
          }
        ?>
      ]
  }]
});

function regresa_grafica(){
  $("#env_rec_inv").show();
  $("#grafica_invitados").hide();
}

function muestraDetalle_modal(ejearea,idejearea,rec_env_inv,categoria,dias){
  //tipo 0 , todos, 1 area , 2 eje
  //rec_env_inv 1 enviados, 2 recibidos , 3 invitados
  //categoria 0 total , 1 nunca tocaste nunca contestado, 2 +3 dias , 3 -3 dias
 var ejearea = ejearea;
 var ideje_area = idejearea;
 var rec_env_inv = rec_env_inv;
 var categoria = categoria;
 var dias = dias;
 var usr = $( "#idusr" ).val();

 $(".h").css('background-color',"#4d4d57");
 $("#myModal").modal({backdrop: false});
 let titulo = "";
  switch (rec_env_inv) {
   case 1:
     titulo = "Asuntos abiertos enviados por "+nombrearea;
     if(categoria == 1)
      titulo = "Asuntos abiertos enviados por "+nombrearea+" que nunca has contestado ";
     if(categoria == 2)
       titulo = "Asuntos abiertos enviados por "+nombrearea+" con mas de "+dias+" dias sin respuesta ";
     if(categoria == 3)
        titulo = "Asuntos abiertos enviados por "+nombrearea+" con menos de "+dias+" dias sin respuesta";
     break;
   case 2:
      titulo = "Asuntos abiertos recibidos por "+nombrearea;
      if(categoria == 1)
       titulo = "Asuntos abiertos recibidos por "+nombrearea+" que nunca has contestado ";
      if(categoria == 2)
        titulo = "Asuntos abiertos recibidos por "+nombrearea+" con mas de "+dias+" dias sin respuesta ";
      if(categoria == 3)
         titulo = "Asuntos abiertos recibidos por "+nombrearea+" con menos de "+dias+" dias sin respuesta";
      break;
   case 3:
      titulo = "Asuntos abiertos donde "+nombrearea+" es invitado";
      if(categoria == 1)
       titulo = "Asuntos abiertos donde "+nombrearea+" es invitado que nunca has contestado ";
      if(categoria == 2)
        titulo = "Asuntos abiertos donde "+nombrearea+" es invitado con mas de "+dias+" dias sin respuesta ";
      if(categoria == 3)
         titulo = "Asuntos abiertos donde "+nombrearea+" es invitado con menos de "+dias+" dias sin respuesta";
      break;
   default:
      break;
 }
 $("#titulo").html(titulo);

 $.post("lista_asuntos.php",{ejearea:ejearea,ideje_area:ideje_area,rec_env_inv:rec_env_inv,categoria:categoria,dias:dias,usr:usr}, function(data) {
   $(".detalle").html('');
   $(".detalle").html(data);
 });

}


function muestraDetalle_modal_extra(ejearea,idejearea,rec_env_inv,categoria,dias,tipo,estatus,ejearea_detalle,tipoejearea_detalle,env_rec_det){
  //ejearea  1 area , 2 eje
  //rec_env_inv 1 enviados, 2 recibidos , 3 invitados
  //categoria 0 total , 1 nunca tocaste nunca contestado, 2 +3 dias , 3 -3 dias
  // tipo 1 ,2 ,3 ,4 problematica, solicitud, conocimiento , sugerencia
  //estatus  sin leer 1 , en conversacion 2 , 3 y 4 cerrado
 //ejearea_detalle ES ID DEL EJE O AREA A BUSCAR A DETALLE
 //tipoejearea_detalle SI EL DETALLE ES UN AREA O UN Eje
 // SI EL DETALLE ES AREA BUSCAS ENVIADOS, O RECIBIDOS
 var ejearea = ejearea;
 var ideje_area = idejearea;
 var rec_env_inv = rec_env_inv;
 var categoria = categoria;
 var dias = dias;
 var usr = $( "#idusr" ).val();
 var estatus = estatus;
 var tipo = tipo;

 $(".h").css('background-color',"#4d4d57");
 $("#myModal").modal({backdrop: false});
 let titulo = "";
  switch (rec_env_inv) {
   case 1:
     titulo = "Asuntos abiertos enviados por "+nombrearea;
     break;
   case 2:
      titulo = "Asuntos abiertos recibidos por "+nombrearea;
      break;
   case 3:
      titulo = "Asuntos abiertos donde "+nombrearea+" es invitado";
      break;
   default:
      break;
 }
 $("#titulo").html(titulo);

 $.post("lista_asuntos.php",{ejearea:ejearea,ideje_area:ideje_area,rec_env_inv:rec_env_inv,categoria:categoria,dias:dias,usr:usr,tipo:tipo,estatus:estatus,ejearea_detalle:ejearea_detalle,tipoejearea_detalle:tipoejearea_detalle,env_rec_det:env_rec_det}, function(data) {
   $(".detalle").html('');
   $(".detalle").html(data);
 });

}
function muestraDetalle_noinvitados(ideje_area,ejearea_detalle){
  //muestra e detalle de los no invitados
  var usr = $( "#idusr" ).val();
 $(".h").css('background-color',"#4d4d57");
 $("#myModal").modal({backdrop: false});
 $("#titulo").html("Asuntos abiertos donde "+nombrearea+" no fue invitado");
 $.post("lista_asuntos.php",{ideje_area:ideje_area,usr:usr,ejearea_detalle:ejearea_detalle,noinvitados:1}, function(data) {
   $(".detalle").html('');
   $(".detalle").html(data);
 });

}
function nuevoAsunto(){
  var usr = $( "#idusr" ).val();
 $(".h").css('background-color',"#4d4d57");
 $("#myModal").modal({backdrop: false});
 $("#titulo").html("Redactar nuevo asunto");
 $.post("nuevo_asunto.php",{noinvitados:1}, function(data) {
   $(".detalle").html('');
   $(".detalle").html(data);
 });
}


</script>

</html>
