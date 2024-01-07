<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once ('../../../WEB-INF/Classes/Catalogo.class.php');
include_once ('../../../WEB-INF/Classes/ActividadesMetas.class.php');
include_once ('../../../WEB-INF/Classes/Entregable.class.php');
$catalogo = new Catalogo();

$user = "";
$editar = false;
$Nombre = "";
$IdPeriodo = "";
$IdEje = "";
$IdActividad = "";
$IdTipo = "";
$IdEntregable = "";
$NombreEntregable ="";

$IdInsumo ="";

$styleGlob ="";
$styleGen ="";
$stylePar ="";
$IdNivelActividad="";
//echo"<br>Eje:".$_GET['IdEje'];
//echo"<br>Tipo:".$IdTipo = $_GET['IdTipo'];
//echo"<br>Periodo:".$IdPeriodo = $_GET['IdPeriodo'];
//echo"<br>accion:".$_GET['accion'];


//echo($user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'&id='.$IdActividad);
  if ((isset($_GET['IdEje']) && $_GET['IdEje'] != "") && (isset($_GET['IdTipo']) && $_GET['IdTipo'] != "") && (isset($_GET['IdPeriodo']) && $_GET['IdPeriodo'] != "") && (isset($_GET['IdActividad']) && $_GET['IdActividad'] != "") && (isset($_GET['IdEntregable']) && $_GET['IdEntregable'] != "")) {
          $IdEje = $_GET['IdEje'];
          $IdTipo = $_GET['IdTipo'];
          $IdPeriodo = $_GET['IdPeriodo'];
          $IdActividad = $_GET['IdActividad'];
          $IdEntregable = $_GET['IdEntregable'];


          if ( $IdTipo == 1) {
            //echo "entra";
             $concepto = "Actividad";
             $conceptom = "actividad";
          }else{
            $concepto = "Meta";
            $conceptom = "meta";
          }
  }
  if (isset($_GET['accion']) && $_GET['accion'] != "") {
      echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
      echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
      $user =$_GET['usuario'];
      if ($_GET['accion'] == "editar") {
          $editar = true;
          echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
      } else {
          echo '<input type="hidden" id="id" name="id" value="0"/>';
      }
  }
//echo($user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'&id='.$IdActividad);
?>
<!DOCTYPE html>
<html lang="es">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>::.FORMULARIO INSUMOS ENTREGABLES.::</title>

        <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
        <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link href="../../../resources/css/bootstrap-select.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="../../../resources/js/bootstrap-select.js"></script>

        <script src="../../../resources/js/sweetAlert.js"></script>
        <script src="../../../resources/js/bootstrap/bootstrapValidator.js"></script>
        <script src="../../../resources/js/aplicaciones/ActividadesMetas/alta_insumos.js"></script>

    </head>
    <body>
      <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a><!--/ <a style="color:#fefefe;" href="filtro_ActividadesMetas.php?nombreUsuario=<?php echo($user); ?> ">Filtro actividades y metas</a> -->/ <a style="color:#fefefe;" href="lista_actividadesMetas.php?nombreUsuario=<?php echo($user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo); ?>">Actividades y Metas</a> / <a style="color:#fefefe;" href="alta_actividadesMetas.php?accion=editar&usuario=<?php echo($user.'&IdEje='.$IdEje.'&IdTipo='.$IdTipo.'&IdPeriodo='.$IdPeriodo.'&id='.$IdActividad); ?>">Agregar Actividades y Metas</a> / Agregar Insumos</div>
      <div id="container-fluid">

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-4 col-sm-4 col-xs-4 " style="width: 50%;">
                <strong>Agregar Insumos</strong>
            </div>
          </div> 
        </div><br>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-horizontal" id="formInsumo" name="formInsumo">
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion"> Periodo:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                   <?php
                      if (isset($_GET['IdPeriodo'])){

                           $consultaPeriodo = "SELECT Periodo FROM `c_periodo` WHERE Id_Periodo=".$IdPeriodo." ORDER BY Periodo ASC;";

                          $resultPeriodo= $catalogo->obtenerLista($consultaPeriodo);
                            while ($row =mysqli_fetch_array($resultPeriodo)){
                              echo "<h4>".$row['Periodo']."</h4>";
                            }
                      }
                    ?>
                  <input type="hidden" id="IdPeriodo" name="IdPeriodo"  class="form-control" value="<?php echo($IdPeriodo); ?>" />
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="eje"> Eje: </label>
                 <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="eje" name="eje" class="form-control" onchange="obtenerActividadGlobal(this.value)">
                    <option value="" >Seleccione un eje</option>
                    <?php

                      $consultaEje= "SELECT IdEje,CONCAT(orden,'. ',Nombre) AS Eje FROM `c_eje` ORDER BY orden;";

                        $resultEje = $catalogo->obtenerLista($consultaEje);
                        $s="";
                        while ($row =mysqli_fetch_array($resultEje)){


                            /*if($IdEje == $row['IdEje']){
                              $s="selected";
                            }else{
                              $s="";
                            }*/
                              echo "<option value='".$row['IdEje']."' ".$s.">".$row['Eje']."</option>";
                        }
                   ?>
                   </select>

                </div>
              </div>

              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nivel">* Nivel</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="nivel" name="nivel" class="form-control" onchange="mostrarAM(this.value)">
                    <option value="" >Seleccione un nivel</option>

                    <?php

                      $consultaNivel = "SELECT IdNivel,Nombre AS Nivel FROM `c_nivelActividadMeta`;";
                          $resultNivel= $catalogo->obtenerLista($consultaNivel);


                          while ($row =mysqli_fetch_array($resultNivel)){
                            if($IdNivelActividad == $row['IdNivel']){
                              $s="selected";
                            }else{
                              $s="";
                            }
                              echo "<option value='".$row['IdNivel']."' ".$s.">".$row['Nivel']."</option>";



                          }


                    ?>
                 </select>
                </div>
              </div>
              <div class="form-group form-group-sm" id="damGlob" <?php echo $styleGlob; ?> >
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amGlobal">* <?php echo $concepto; ?> global</label>
                <div class="col-md-6 col-sm-6 col-xs-6">

                  <select id="amGlobal" name="amGlobal" class="form-control" onchange="obtenerActividadGeneral(this.value); obtenerEntregable(this.value);">
                    <option value="" >Seleccione la <?php echo $conceptom; ?> global</option>

                  <?php

                      $consultaGlob="SELECT IdActividad,CONCAT(ce.orden,'.',ca.orden,'. ',ca.Nombre) AS actividad
                    FROM `c_actividad` AS ca
                    INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
                    WHERE ca.Periodo=".$IdPeriodo." AND ca.IdEje=".$IdEje." AND ca.IdNivelActividad=1 AND ca.IdTipoActividad=".$IdTipo." ORDER BY ce.orden,ca.Orden;";
                          $resultGlob= $catalogo->obtenerLista($consultaGlob);
                          $s="";
                            while ($row =mysqli_fetch_array($resultGlob)){
                              /*if($IdGlob == $row['IdActividad']){
                                 $s="selected";
                              }else{
                                 $s="";
                              }*/
                              echo "<option value='".$row['IdActividad']."'".$s.">".$row['actividad']."</option>";
                            }

                    ?>
                </select>
                </div>
              </div>
              <div class="form-group form-group-sm" id="damGen" <?php echo $styleGen;?> >
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amGeneral">* <?php echo $concepto; ?> general</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="amGeneral" name="amGeneral" class="form-control" onchange="obtenerActividadParticular(this.value); obtenerEntregable(this.value);">
                    <option value="" >Seleccione la <?php echo $conceptom; ?> general</option>
                    <?php
                    if($editar == true){
                      echo "<option value='".$IdGlob."' selected>".$nombreGen." </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm" id="damPar" <?php echo $stylePar;?> >
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amParticular">* <?php echo $concepto; ?> particular</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="amParticular" name="amParticular" class="form-control" onchange="obtenerSubActividad(this.value); obtenerEntregable(this.value);">
                    <option value="" >Seleccione la <?php echo $conceptom; ?> particular</option>
                    <?php
                    if($editar == true){
                      echo "<option value='".$IdPar."' selected>".$nombrePar." </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm" id="damSub" <?php echo $stylePar;?> >
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amSub">* Sub <?php echo $conceptom; ?></label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="amSub" name="amSub" class="form-control" onchange="obtenerEntregable(this.value);">
                    <option value="" >Seleccione la sub <?php echo $conceptom; ?></option>
                    <?php
                    /*if($editar == true){
                      echo "<option value='".$IdPar."' selected>".$nombrePar." </option>";
                    }*/
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="insumo">* Insumo</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select type="text" id="insumo" name="insumo"  class="form-control" >
                    <option value="">Seleccione un insumo</option>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2">

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                </div>

              </div>
              <input type="hidden" id="IdTipo" name="IdTipo"  class="form-control" value="<?php echo($IdTipo); ?>" />
              <input type="hidden" id="IdEntregable" name="IdEntregable"  class="form-control" value="<?php echo($IdEntregable); ?>" />
              <input type="hidden" id="IdActividad" name="IdActividad"  class="form-control" value="<?php echo($IdActividad); ?>" />

            </form>
          </div>
        </div>

      </div>
    </body>
</html>
