<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
session_start();
include_once ('../../../WEB-INF/Classes/Catalogo.class.php');
include_once ('../../../WEB-INF/Classes/ActividadesMetas.class.php');
include_once ('../../../WEB-INF/Classes/Entregable.class.php');
$catalogo = new Catalogo();
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
$MiIdUsr=$_SESSION['user_session'];

$editar = false;
$Nombre = "";
$numeracion="";
$Periodo = 14;
$IdArea = "";
$IdEje = "";
$IdTipoActividad = "";
$IdNivelActividad = "";
$IdActividadSuperior = "";
$Orden = "";
$IdResponsable = "";
$concepto = "";
$conceptom ="";
$IdActividad= "";
$nombreGlob ="";
$nombreGen ="";
$nombrePar ="";
$Idcategoria="";
$IdEntregable = "";
$NombreEntregable ="";
$tiene = "";//para visisualizar la actividad en la app de planeación de la tabla c_actividad

$IdGlob ="";
$IdGen ="";
$IdPar ="";
$styleGlob ="";
$styleGen ="";
$stylePar ="";
$styleTabla = "";
$user ="";
$Idscategoria="";
//$registro = array();
$categoria="";
$scategoria="";

//Nuevos para validar año visible
$obtenidosubvisible="";
$periodovisible="";

//echo "accion:".$_GET['accion'];
if ((isset($_GET['IdEje']) && $_GET['IdEje'] != "") && (isset($_GET['IdTipo']) && $_GET['IdTipo'] != "") && (isset($_GET['IdPeriodo']) && $_GET['IdPeriodo'] != "")) {
        $IdEje = $_GET['IdEje'];
        $IdTipo = $_GET['IdTipo'];
        $IdPeriodo = $_GET['IdPeriodo'];

        if ( $IdTipo == 1) {
          //echo "entra";
           $concepto = "Actividad";
           $conceptom = "actividad";
        }else{
          $concepto = "Meta";
          $conceptom = "meta";
        }
      
}
if(isset($_GET['categoria']) and $_GET['categoria']!=""){
   $categoria= $_GET['categoria'];
}
if(isset($_GET['scategoria']) and $_GET['scategoria']!=""){
   $scategoria= $_GET['scategoria'];
}
if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
    $user =$_GET['usuario'];
    if ((isset($_GET['usuario']) && $_GET['usuario'] != "")) {
      $user = $_GET['usuario'];
    }else{
          $user="User_desconocido";
    }
    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}
if ($editar == true) {

	$obj = new ActividadesMetas();
  $objE = new Entregable();

  $objE->getEntregableByActividad($_GET['id']);
  //$NombreEntregable = $objE->getNombre();
  $IdEntregable =$objE->getIdEntregable();
	$obj->setIdActividad($_GET['id']);
	$obj->obtenerActividadMeta();
	//$id= $obj->getActivofijo();
  $Idcategoria= $obj->getIdcategoria();
  $Idscategoria= $obj->getIdscategoria();
  $Nombre = $obj->getNombre();
	$Periodo = $obj->getPeriodo();
	$IdArea = $obj->getIdArea();
	$IdEje = $obj->getIdEje();
  $numeracion= $obj->getNumeracion();
	$IdTipoActividad = $obj->getIdTipoActividad();
	$IdNivelActividad =$obj->getIdNivelActividad();
	$IdActividadSuperior=$obj->getIdActividadSuperior();
	$Orden=$obj->getOrden();
	$IdResponsable= $obj->getIdResponsable();
  $tiene= $obj->gettiene();
  $NombreEntregable = $obj->getnombreentregable();

  if($IdNivelActividad == 1){

    //$obj->getIdActividad ();
    $nombreGlob = "";
    $nombreGen ="";
    $nombrePar ="";
    $IdGlob ="";
    $IdGen ="";
    $IdPar ="";
    $styleGlob ="style='display: none'";
    $styleGen ="style='display: none'";
    $stylePar ="style='display: none'";
  }elseif ($IdNivelActividad == 2) {
    $obj->obtenerASupGeneral();
    $nombreGlob= $obj->getNombreGlobal();
    $IdGlob =$obj->getIdActividadGlobal();
    $styleGlob ="style='display: block'";
    $styleGen ="style='display: none'";
    $stylePar ="style='display: none'";

   }elseif ($IdNivelActividad == 3) {
    $obj->obtenerASupParticular();
    $nombreGlob = $obj->getNombreGlobal();
    $nombreGen = $obj->getNombreGeneral();
    $IdGlob =$obj->getIdActividadGlobal();
    $IdGen = $obj->getIdActividadGeneral();
    $styleGlob ="style='display: block'";
    $styleGen ="style='display: block'";
    $stylePar ="style='display: none'";
  }elseif ($IdNivelActividad == 5){
    $obj->obtenerASupSub();
    $nombreGlob = $obj->getNombreGlobal();
    $nombreGen = $obj->getNombreGeneral();
    $nombrePar= $obj->getNombreParticular();
    $IdGlob =$obj->getIdActividadGlobal();
    $IdGen = $obj->getIdActividadGeneral();
    $IdPar = $obj->getIdActividadParticular();
    $styleGlob ="style='display: block'";
    $styleGen ="style='display: block'";
    $stylePar ="style='display: block'";

  }
}
?>


<!DOCTYPE html>
<html lang="es">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>::.FORMULARIO ACTIVIDADES METAS.::</title>

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
        <script src="../../../resources/js/aplicaciones/ActividadesMetas/alta_actividadesMetas.js"></script>

    </head>
    <script type="text/javascript">
    function llenar(){
    var periodo = $('#IdPeriodo').val();
    var eje = $('#IdEje').val();
        
    $.post( "Consultacategorias.php?Ano=" + periodo + "&Eje=" + eje,{},function(data) {
    if(data != ""){
    $('#categoría').html(data);
    }
    });
    }

    function llenarsub(){
    var categoria = $('#categoría').val();
    $.post( "Consultacategorias.php?Categoria=" + categoria,{},function(data) {
    if(data != ""){
    $('#scategoría').html(data);
    }
    });
    }

    function llenarglobal(){
    var ejeglobal = $('#IdEje').val();
    var periodo1 = $('#IdPeriodo').val();
    var actividadmeta = $('#IdTipo').val();
    $.post( "Consultacategorias.php?EjeGlobal=" + ejeglobal + "&AnoGlobal=" + periodo1 + "&ActividadMeta=" + actividadmeta,{},function(data) {
    if(data != ""){
    $('#amGlobal').html(data);
    }
    });
    }

    function llenarglobalcategoria(){
    var ejeglobal1 = $('#IdEje').val();
    var periodo11 = $('#IdPeriodo').val();
    var categoria2 = $('#categoría').val();
    var actividadmeta1 = $('#IdTipo').val();
    $.post( "Consultacategorias.php?EjeGlobal1=" + ejeglobal1 + "&AnoGlobal1=" + periodo11 + "&Categoria1=" + categoria2 + "&ActividadMeta1=" + actividadmeta1,{},function(data) {
    if(data != ""){
    $('#amGlobal').html(data);
    }
    });
    }

    function llenarglobalsubcategoria(){
    var categoria3 = $('#scategoría').val();
    var actividadmeta2 = $('#IdTipo').val();
    $.post( "Consultacategorias.php?Categoria3=" + categoria3 + "&ActividadMeta2=" + actividadmeta2,{},function(data) {
    if(data != ""){
    $('#amGlobal').html(data);
    }
    });
    }

    function llenargeneral(){
    var actividadglobal = $('#amGlobal').val();
    var ejeparaglobal = $('#IdEje').val();
    var actividadmetageneral = $('#IdTipo').val();
    $.post( "Consultacategorias.php?ejeparaglobal=" + ejeparaglobal + "&actividadglobal=" + actividadglobal + "&actividadmetageneral=" + actividadmetageneral,{},function(data) {
    if(data != ""){
    $('#amGeneral').html(data);
    }
    });
    }

    function limpiardesdeeje(){
  $('#scategoría').html("");
  $('#amGeneral').html("");
  }

  function limpiardesdeglobal(){
  $('#amGeneral').html("");
  }
</script>
    <body>
      <div class="well well-sm">
        <a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1&nombreUsuario=SinUsr&idUsuario=<?php echo $MiIdUsr; ?>">Aplicaciones</a>
        <!--/ <a style="color:#fefefe;" href="filtro_ActividadesMetas.php?nombreUsuario=<?php echo($user); ?> ">Filtro actividades y metas</a> -->/ 
        <a style="color:#fefefe;" href="lista_actividadesMetas.php?nombreUsuario=<?php echo($user.'&IdEje='.$IdEje.'&IdTipo='.	$IdTipoActividad.'&IdPeriodo='.$Periodo.'&categoria='.$categoria.'&scategoria='.$scategoria); ?>">Actividades y Metas</a> 
        / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar Actividades y Metas</a></div>
      <div class="well2 wr">
        <a style="color:#fefefe; cursor: pointer;" href="../Insumos/vista.php">Insumos</a> / 
        <!--<a style="color:#fefefe; cursor: pointer;" href="../Categorias/vista.php">Categorías y subcategorías</a> / -->
        <a style="color:#fefefe;" href="lista_actividadesMetas.php?nombreUsuario=<?php echo($user.'&IdEje='.$IdEje.'&IdTipo='.  $IdTipoActividad.'&IdPeriodo='.$Periodo.'&categoria='.$categoria.'&scategoria='.$scategoria); ?>"> Lista de Actividades y Metas</a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar +</a>
      </div>
      <div id="container-fluid">

        <div class="row">
          <!--<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-4 col-sm-4 col-xs-4 alert alert-info" style="width: 50%;">
                <strong>Los campos obligatorios</strong> estan marcados con *
            </div>
          </div> -->
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="form-horizontal" id="formAM" name="formAM">
            <div class="form-group form-group-sm" style="display:none;">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="IdPeriodo"> Periodo:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                <select id="IdPeriodo" name="IdPeriodo"  class="form-control" onchange="llenar();llenarglobal();limpiardesdeeje();">
                   <?php
                      //if (isset($_GET['IdPeriodo'])){
                        $consultaPeriodo = "SELECT Id_Periodo, Periodo FROM `c_periodo` WHERE Periodo=2021 ORDER BY Periodo ASC;";
                        $resultPeriodo= $catalogo->obtenerLista($consultaPeriodo);
                        while ($row =mysqli_fetch_array($resultPeriodo)){
                          if ($Periodo == $row['Id_Periodo']){
                            $selected = "selected";
                           }else{
                             $selected ="";
                           }
                           echo "<option value='".$row['Id_Periodo']."' ".$selected.">".$row['Periodo']."</option>";

                         
                        }
                      //}
                    ?>
                    </select>
                 <!-- <input type="hidden" id="IdPeriodo" name="IdPeriodo"  class="form-control" value="<?php echo($Periodo); ?>" />-->
                </div>
              </div>

              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label"  for="IdEje"> Eje: </label>
                 <div class="col-md-6 col-sm-6 col-xs-6">
                 <select id="IdEje" name="IdEje"  class="form-control" onchange="llenar();llenarglobal();limpiardesdeeje();">
                    <option value="">Seleccione</option>
                   <?php
                      //if (isset($_GET['IdPeriodo'])){
                        $consultaPeriodo = "SELECT idEje, CONCAT(orden,'. ',Nombre) AS Eje FROM `c_eje`  ORDER BY orden ASC;";
                        $resultPeriodo= $catalogo->obtenerLista($consultaPeriodo);
                        while ($row =mysqli_fetch_array($resultPeriodo)){
                          if ($IdEje == $row['idEje']){
                            $selected = "selected";
                           }else{
                             $selected ="";
                           }
                           echo "<option value='".$row['idEje']."' ".$selected.">".$row['Eje']."</option>";

                         
                        }
                      //}
                    ?>
                    </select>

                  <!--<input type="hidden" id="IdEje" name="IdEje"  class="form-control" value="<?php echo($IdEje); ?>" />-->
                </div>
              </div>

              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="IdTipo" >* Actividad/Meta:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="IdTipo" name="IdTipo"  class="form-control" onchange="llenar();llenarglobal();limpiardesdeeje();">
                    <option value="">Seleccione</option>
                    <?php
                           if ($IdTipoActividad == 1) {
                                    echo '<option value="1" selected="selected">Actividad</option>';
                                    echo '<option value="2">Meta</option>';
                                } else {
                                    echo '<option value="1">Actividad</option>';
                                    echo '<option value="2" selected="selected">Meta</option>';
                                } 
                    ?>
                  </select>
                </div>
              </div>
          
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="categoría">* Categoría:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="categoría" name="categoría"  class="form-control" onchange="llenarsub();llenarglobalcategoria();">
                    <option value="">Seleccione</option>
                    <?php
                      $consultaEmpUsa = "SELECT idCategoria, descCategoria FROM c_categoriasdeejes WHERE IdEje='".$IdEje."' and nivelCategoria=1 ORDER BY descCategoria";
                          $resultEmpUsa = $catalogo->obtenerLista($consultaEmpUsa);
                           while ($row = mysqli_fetch_array($resultEmpUsa)) {
                           		if ($Idcategoria == $row['idCategoria']){
                      			   $selected = "selected";
  	                      		}else{
  	                      			$selected ="";
  	                      		}
                             	echo "<option value='".$row['idCategoria']."' ".$selected.">".$row['descCategoria']."</option>";
                           }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="scategoría"> Subcategoría:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="scategoría" name="scategoría"  class="form-control" onchange="llenarglobalsubcategoria();">
                    <option value="">Seleccione</option>
                    <?php
                      $consultaEmpUsa = "SELECT idCategoria, descCategoria FROM c_categoriasdeejes WHERE IdEje='".$IdEje."' AND nivelCategoria=2 AND idCategoriaPadre='$Idcategoria' ORDER BY descCategoria;";
                          $resultEmpUsa = $catalogo->obtenerLista($consultaEmpUsa);
                           while ($row = mysqli_fetch_array($resultEmpUsa)) {
                           		if ($Idscategoria == $row['idCategoria']){
                      			   $selected = "selected";
  	                      		}else{
  	                      			$selected ="";
  	                      		}
                             	echo "<option value='".$row['idCategoria']."' ".$selected.">".$row['descCategoria']."</option>";
                           }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nivel">* Nivel:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="nivel" name="nivel" class="form-control" onchange="mostrarAM(this.value)">
                    <option value="" >Seleccione</option>

                    <?php

                      $consultaNivel = "SELECT IdNivel,Nombre AS Nivel FROM `c_nivelActividadMeta` WHERE IdNivel<3;";
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
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amGlobal">* <?php echo $concepto; ?> Global:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">

                  <select id="amGlobal" name="amGlobal" class="form-control" onchange="llenargeneral();limpiardesdeglobal();">
                    <option value="" >Seleccione</option>

                  <?php
                  if ($editar == true) {
                      $consultaGlob="SELECT a.IdActividad, CONCAT(a.Numeracion,a.Nombre) as actividad FROM c_actividad a WHERE a.IdEje=$IdEje AND a.IdNivelActividad=1 AND IdTipoActividad=$IdTipoActividad ORDER BY a.Orden";
                    	/*$consultaGlob="SELECT IdActividad,CONCAT(ce.orden,'.',ca.orden,'. ',ca.Nombre) AS actividad
										FROM `c_actividad` AS ca
										INNER JOIN c_eje AS ce ON ce.idEje = ca.IdEje
										WHERE ca.Periodo=".$Periodo." AND ca.IdEje='".$IdEje."' AND ca.IdNivelActividad=1 AND ca.IdTipoActividad='".	$IdTipoActividad."' ORDER BY ce.orden,ca.Orden;";*/
                          $resultGlob= $catalogo->obtenerLista($consultaGlob);
                            while ($row =mysqli_fetch_array($resultGlob)){
                              if($IdGlob == $row['IdActividad']){
                                 $s="selected";
                              }else{
                                 $s="";
                              }
                              echo "<option value='".$row['IdActividad']."'".$s.">".$row['actividad']."</option>";
                            }
                          }
                    ?>
                </select>
                </div>
              </div>
              <div class="form-group form-group-sm" id="damGen" <?php echo $styleGen;?> >
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amGeneral">* <?php echo $concepto; ?> General:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="amGeneral" name="amGeneral" class="form-control" onchange="obtenerActividadParticular(this.value)">
                    <option value="" >Seleccione</option>
                    <?php
                    if ($editar == true) {
                    /*if($editar == true){
                      echo "<option value='".$IdGen."' selected>".$nombreGen." </option>";
                    }*/
                    if ($IdGlob == "") {
                      // code...
                    }else{
                    $consultaperiodo8 = "SELECT a.IdActividad,CONCAT( a.Numeracion, a.Nombre ) actividad 
                                        FROM c_actividad a 
                                        WHERE a.IdEje = $IdEje AND a.IdNivelActividad = 2 AND a.IdTipoActividad =$IdTipoActividad AND a.IdActividadSuperior=$IdGlob
                                        ORDER BY a.Orden";
                                $resultado8 = $catalogo->obtenerLista($consultaperiodo8);
                                while ($row = mysqli_fetch_array($resultado8)) {
                                    $s = '';
                                    if ($row['IdActividad'] == $IdGen) {
                                        $s = 'selected = "selected"';
                                    }
                                    echo '<option value = "' . $row['IdActividad'] . '" ' . $s . '>' . $row['actividad'] . '</option>';
                                }
                              }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm" id="damPar" style="display:none;"> <?php echo $stylePar;?> >
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="amParticular">* <?php echo $concepto; ?>  Particular:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="amParticular" name="amParticular" class="form-control">
                    <option value="" >Seleccione la <?php echo $conceptom; ?> particular</option>
                    <?php
                    if($editar == true){
                      echo "<option value='".$IdPar."' selected>".$nombrePar." </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombreAM">* Nombre: <?php echo $conceptom;?> </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <input type="text" id="nombreAM" name="nombreAM"  class="form-control" value="<?php echo($Nombre); ?>" />
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="nombreAM">* Numeración: </label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <input type="text" id="numeracion" name="numeracion"  class="form-control" value="<?php echo($numeracion); ?>" />
                </div>
              </div>

              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="orden">* Orden:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <input type="number" id="orden" name="orden"  class="form-control" value="<?php echo($Orden); ?>" />
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="area">* Área:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <select id="area" name="area"  class="form-control">
                     <option value="">Seleccione</option>
                  	<?php
                    	 $consultaArea="SELECT Id_Area,Nombre as area FROM `c_area` WHERE estatus=1 ORDER BY Nombre;";

                      $resultArea = $catalogo->obtenerLista($consultaArea);
                       while ($row = mysqli_fetch_array($resultArea)){
                       	 	if ($IdArea == $row['Id_Area']) {
                      			  $selected = "selected";
                      		}else{
                      				$selected ="";
                      		}
                         echo "<option value='".$row['Id_Area']."' ".$selected.">".$row['area']."</option>";
                       }
                    ?>
                    </select>
                </div>
              </div>


  

              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="responsable"> Responsable:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <select id="responsable" name="responsable"  class="form-control">
                    <option value="">Seleccione</option>
                    <?php
                      $consultaEmpUsa = "SELECT id_Personas,CONCAT(Nombre,' ',Apellido_Paterno,' ',Apellido_Materno
                                            ) AS Empleado FROM c_personas WHERE id_TipoPersona = 1 ORDER BY Empleado";
                          $resultEmpUsa = $catalogo->obtenerLista($consultaEmpUsa);
                           while ($row = mysqli_fetch_array($resultEmpUsa)) {
                           		if ($IdResponsable == $row['id_Personas']){
                      			   $selected = "selected";
  	                      		}else{
  	                      			$selected ="";
  	                      		}
                             	echo "<option value='".$row['id_Personas']."' ".$selected.">".$row['Empleado']."</option>";
                           }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group form-group-sm">
                <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="entregable">Entregable:</label>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <input type="text" id="entregable" name="entregable"  class="form-control" value="<?php echo($NombreEntregable); ?>" />
                </div>
              </div>

              <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Visible Planeación:</label>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <select id="tiene" class="form-control" name="tiene" style="width: 425px;">
                            <?php 
                                if ($tiene == 1) {
                                    echo '<option value="1" selected="selected">Si</option>';
                                    echo '<option value="0" >No</option>';
                                } else {
                                    echo '<option value="1" >Si</option>';
                                    echo '<option value="0" selected="selected">No</option>';
                                }
                                ?>
                        </select>
                    </div>
                </div>

              <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Año visible:</label>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                    <select id="aniovisible[]" class="form-control" name="aniovisible[]" style="width: 425px;" multiple required>
                        <?php
                        if ($editar== false) {
                            $consultaanio = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 AND Periodo>'2020' ORDER BY Periodo desc;";
                        $resultado1 = $catalogo->obtenerLista($consultaanio);
                        while ($row = mysqli_fetch_array($resultado1)) {
                        $s = '';
                        if ($row['Periodo'] == $periodovisible) {
                        $s = 'selected = "selected"';
                        }
                        echo '<option value = "' . $row['Periodo'] . '" ' . $s . '>' . $row['Periodo'].'</option>';
                        }
                        }else{
                        $todosanios="";
                        $consultanueva = "SELECT GROUP_CONCAT(Anio) as Anio FROM k_actividad_anios WHERE IdActividad=".$_GET['id'];
                        $resultado90 = $catalogo->obtenerLista($consultanueva);
                        while ($row1 = mysqli_fetch_array($resultado90)) {
                            $todosanios=$row1['Anio'];
                        }

                        if ($todosanios=="") {
                        $consultaanio = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 AND Periodo>'2020' ORDER BY Periodo desc;";
                        $resultado1 = $catalogo->obtenerLista($consultaanio);
                        while ($row = mysqli_fetch_array($resultado1)) {
                        $s = '';
                        if ($row['Periodo'] == $periodovisible) {
                        $s = 'selected = "selected"';
                        }
                        echo '<option value = "' . $row['Periodo'] . '" ' . $s . '>' . $row['Periodo'].'</option>';
                        }
                        }else{
                        $consultaanio = "SELECT Id_Periodo,Periodo FROM `c_periodo` WHERE Vista=1 AND Periodo>'2020' ORDER BY Periodo desc;";
                        $resultado1 = $catalogo->obtenerLista($consultaanio);
                        while ($row = mysqli_fetch_array($resultado1)) {
                        $s = '';
                        $datos= explode( ',', $todosanios);
                        $num_anios = count($datos);
                        for ($i=0; $i < $num_anios; $i++) { 
                            $datos1= explode( ',', $todosanios);
                            if ($row['Periodo'] == $datos1[$i]) {
                            $s = 'selected = "selected"';
                        }
                        }
                        echo '<option value = "' . $row['Periodo'] . '" ' . $s . '>' . $row['Periodo'].'</option>';
                        }
                        }
                        }
                        ?>
                    </select>
                    <FONT SIZE=1>
                <?php 
                if ($editar==false) {
                    
                }else{
                $Visiblevariable1="";
                $obtenervisibleaniosub11 = "SELECT Anio,Visible FROM k_actividad_anios WHERE IdActividad=".$_GET['id'];
                $resultado921 = $catalogo->obtenerLista($obtenervisibleaniosub11);
                while ($row921 = mysqli_fetch_array($resultado921)) {
                            if ($row921['Visible'] == 1) {
                               $Visiblevariable1="Si";
                            }else{
                               $Visiblevariable1="No";
                            }
                            echo '<b>Año:</b>'.$row921['Anio']." <b> Visible:</b>".$Visiblevariable1."  ";
                }
                }
                ?>
               </FONT>
                     </div>
                     </div> 

                    <div class="form-group form-group-sm">
                    <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="AÑO">Visible:</label>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <select id="tieneanios" class="form-control" name="tieneanios" style="width: 425px">
                            <?php 
                            if ($editar == true) {
                            $obtenidosubvisible="";
                            $obtenervisibleaniosub = "SELECT Visible FROM k_actividad_anios WHERE IdActividad=".$_GET['id'];
                            $resultado91 = $catalogo->obtenerLista($obtenervisibleaniosub);
                            while ($row91 = mysqli_fetch_array($resultado91)) {
                            $obtenidosubvisible = $row91['Visible'];
                            }
                                if ($obtenidosubvisible == 1) {
                                    echo '<option value="0" >No</option>';
                                    echo '<option value="1" selected="selected">Si</option>';
                                } else {
                                    echo '<option value="0" selected="selected">No</option>';
                                    echo '<option value="1" >Si</option>';
                                }
                            }else{
                              if ($obtenidosubvisible == 1) {
                                    echo '<option value="0" >No</option>';
                                    echo '<option value="1" selected="selected">Si</option>';
                                } else {
                                    echo '<option value="0" selected="selected">No</option>';
                                    echo '<option value="1" >Si</option>';
                                }
                            }
                                ?>
                        </select>
                    </div>
                </div>  

              </div>
              <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2">

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                  <a href="lista_actividadesMetas.php" class="btn btn-default btn-xs">Regresar</a>
                </div>

              </div>
             <!-- <input type="hidden" id="IdTipo" name="IdTipo"  class="form-control" value="<?php echo(	$IdTipoActividad); ?>" />-->
              <input type="hidden" id="IdEntregable" name="IdEntregable"  class="form-control" value="<?php echo($IdEntregable); ?>" />
            </form>
          </div>
        </div>
        <br>
        <div class="row" style="display: none;">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="class=center-block">
              <div class="form-group form-group-sm">
                <div class="col-md-2 col-sm-2 col-xs-2">

                  <!--<button type="button" class="btn btn-default btn-xs" id="guardar">agregar Insumo</button>-->
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                  <?php
                      if($IdEntregable != ""){
                        $IdEntregableI="'".$IdEntregable."'";
                        //$IdEje="'".$_GET['IdEje']."'";
                        //$IdPeriodo="'".$_GET['IdPeriodo']."'";
                        $IdActividad ="'".$_GET['id']."'";
                        $us = "'".$user."'";
                        $tipo = "'".	$IdTipoActividad."'";
                        echo '<button type="button" class="btn btn-default btn-xs" id="Insumo" onclick="agregarInsumos('.$IdEntregableI.','.$IdEje.','.$Periodo.','.$IdActividad.','.$us.','.$tipo.')'.'">agregar Insumo</button>';
                      }
                  ?>
                  <!--<button type="button" class="btn btn-default btn-xs" id="Insumo">agregar Insumo</button>-->
                </div>
              </div>
              <?php

              if($IdEntregable != ""){
                  $styleTabla ="style='display: block'";
                }else{
                  $styleTabla ="style='display: none'";
                }
              ?>
              <div class="form-group form-group-sm" <?php echo $styleTabla; ?>>

              <div class="col-md-10 col-sm-10 col-xs-10">
              <table id="tAM" class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Insumo</th>
                                <th>Actividad de donde procede el insumo</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                          if($IdEntregable != ""){
                             $consulta ="SELECT
										kei.IdEntregableInsumo,
										ca.IdActividad,
										kei.IdEntregable,
										kei.IdInsumo,
										ce.Nombre AS Entregable,
										ceI.Nombre AS Insumo,
										ca.Nombre AS Actividad,
										caI.Orden AS  OAI,
										caI.Nombre AS AInsumo,
									  caI.IdNivelActividad AS NivelAI,
									/*	CASE
											WHEN caI.IdNivelActividad = 1
													THEN CONCAT(cp.orden,'.',caI.Orden,'. ',caI.Nombre)
											WHEN caI.IdNivelActividad = 2
													THEN CONCAT(cp.orden,'.',ccDos.Orden,'.',caI.Orden,'. ',caI.Nombre)
											WHEN caI.IdNivelActividad = 3
													THEN CONCAT(cp.orden,'.',ccTres.Orden,'.',ccDos.Orden,'.',caI.Orden,'. ',caI.Nombre)
											WHEN caI.IdNivelActividad = 5
													THEN CONCAT(cp.orden,'.',ccCuatro.Orden,'.',ccTres.Orden,'.',ccDos.Orden,'.',caI.Orden,'. ',caI.Nombre)
										END AS*/ 
                    caI.Numeracion as Actividad_Procedente,
										caI.Nombre as cn
									FROM
										`k_entregableinsumo` AS kei
									INNER JOIN c_entregable AS ce ON ce.IdEntregable = kei.IdEntregable
									INNER JOIN c_entregable AS ceI ON ceI.IdEntregable = kei.IdInsumo
									INNER JOIN k_entregableActividad AS kea ON kea.IdEntregable = ce.IdEntregable
									INNER JOIN k_entregableActividad AS keI ON keI.IdEntregable = ceI.IdEntregable
									INNER JOIN c_actividad AS ca ON ca.IdActividad = kea.IdActividad
									INNER JOIN c_actividad AS caI ON caI.IdActividad = keI.IdActividad
									INNER JOIN c_eje AS cp ON cp.idEje = caI.IdEje
									LEFT JOIN c_actividad AS ccDos ON ccDos.IdActividad = caI.IdActividadSuperior
									LEFT JOIN c_actividad AS ccTres ON ccTres.IdActividad = ccDos.IdActividadSuperior
									LEFT JOIN c_actividad AS ccCuatro ON ccCuatro.IdActividad = ccTres.IdActividadSuperior
									WHERE
										ca.IdActividad =".$IdActividad." ORDER BY caI.IdNivelActividad";

                            //echo $consulta;

                            $resultConsulta = $catalogo->obtenerLista($consulta);

                            while ($row = mysqli_fetch_array($resultConsulta)) {
                                echo '<tr>';
                                echo '<td><a style="color:purple;cursor:pointer" onclick="eliminarInsumo('.$row['IdEntregableInsumo'].')"><span class="glyphicon glyphicon-trash"></td>';

                                echo '<td>' . $row['Insumo'] . '</td>';
                                echo '<td>'.$row['cn']. '</td>';
                                //echo '<td>' . $row['area'] . '</td>';
                            }
                          }
                          ?>
                         </tbody>
                    </table>
                  </div>
            </div><!--aqui-->
          </div>
        </div>
      </div>
    </body>
</html>
