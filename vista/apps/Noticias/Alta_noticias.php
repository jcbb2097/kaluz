<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include_once __DIR__."/../../../source/dao/clases/LoggedinTime.php";
include_once __DIR__."/../../../source/controller/UsuarioController.php";
include_once __DIR__."/../../../source/controller/EjeController.php";
include_once __DIR__."/../../../source/controller/AreaController.php";
include_once __DIR__."/../../../source/controller/NoticiaController.php";

if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}


include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("../../../WEB-INF/Classes/Noticias.class.php");
$catalogo = new Catalogo();
$obj = new Noticias();

//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiTipoPerfil=1;
$MiIdUsr=$_SESSION['user_session'];
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil'])    && $_GET['tipoPerfil'] != ""))    { $MiTipoPerfil=$_GET['tipoPerfil'];    }
if ((isset($_GET['idUsuario'])     && $_GET['idUsuario'] != ""))     { $MiIdUsr=     $_GET['idUsuario'];     }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$editar = false;
$eje = "";
$area = "";
$actividad = "";
$fnoticia = "";
$titulo = "";
$autor = "";
$resumen = "";
$url = "";
$contadorUrl = 1;
$lugarn = "";
$tnoticia = "";
$snoticia = "";
$tmedio = "";
$genero = "";
$medio = "";
$etapa = "";
$calif = "";
$fpub = "";
$fview = "";
$expo = "";
$evento = "";
$archivo = "";
$precio = "";
$comercial = "";
$precioreal= "";
$analisis = "";
$Idcategoria = "";
$Variable1 = "";
$Origen = "";


if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    echo '<input type="hidden" id="usuario" name="usuario" value="' . $_GET['usuario'] . '" />';
    $user = $_GET['usuario'];
    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}

if ($editar == true) {
    $obj = new Noticias();
    $obj->setidNoticia($_GET['id']);
    $obj->getNoticias();
    $fnoticia = date('Y-m-d', strtotime($obj->getfnoticia()));
    //echo "FECHA NOTICIA: " . $fnoticia;
    if ($fnoticia == '1970-01-01') {
        $fnoticia = "";
    }
    $titulo = $obj->gettitulo();
    $analisis = $obj->getAnalisis();
    $autor = $obj->getautor();
    $resumen = $obj->getresumen();
    $url = $obj->geturl();
    $lugarn = $obj->getlugarn();
    $tnoticia = $obj->gettnoticia();
    $snoticia = $obj->getsnoticia();
    $tmedio = $obj->gettmedio();
    $genero = $obj->getgenero();
    $medio = $obj->getmedio();
    $etapa = $obj->getetapa();
    $calif = $obj->getcalif();
    $fpub = date('Y-m-d', strtotime($obj->getfpub()));
    if ($fpub == '1970-01-01') {
        $fpub = "";
    }
    $fview = date('Y-m-d', strtotime($obj->getfview()));
    if ($fview == '1970-01-01') {
        $fview = "";
    }
    $eje = $obj->getidEje();
    // $Idcategoria = $obj->getCategoria();
    $area = $obj->getidArea();
    $actividad = $obj->getidAct();
    $expo = $obj->getExpo();
    $evento = $obj->getEvento();
    $archivo = $obj->getArchivo();
    $rura = $obj->getRutaArchivo();
    $precio = $obj->getPrecio();
    $comercial = $obj->getComercial();
    $precioreal = $obj->getPrecioReal();
    $Variable1 = $obj->getVariable1();
    $Origen = $obj->getOrigen();

    /*echo "act ". $actividad;
    echo "<br>expo ". $expo;*/
    //echo $archivo;
    //echo $rura;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::.FORMULARIO NOTICIAS.::</title>
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
    <script src="../../../resources/js/bootstrap/bootstrap-multiselect.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/Alta_Noticias.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/funciones.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/acciones.js"></script>
<style media="screen">
.form-group {
  margin-bottom: 5px !important;
}
label {
    font-size: .7em !important;
}

select {
    font-size: .7em !important;
}
</style>
</head>
<body>
    <div class="well well-sm">
        <a style="color:#fefefe;" href="../../aplicaciones.php?<?php echo $MisParam; ?>">Aplicaciones</a> /
        <a style="color:#fefefe;" href="Lista.php?<?php echo $MisParam; ?>">Noticias</a> /
        <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Agregar Noticia</a>
    </div>
    <div class="well2 wr">
      <a style="color:#fefefe; cursor: pointer;" href="vista.php?<?php echo $MisParam; ?>"> Indicadores</a> /
      <a style="color:#fefefe; cursor: pointer;" href="Lista.php?<?php echo $MisParam; ?>">Lista Noticias</a> /
      <a style="color:#fefefe; cursor: pointer;" onclick="cambiarContenido('#catalogo','catalogos.php?usuario=<?php echo $MiNomUsr;?>');">Catálogos</a> /
      <a style="color:#fefefe; cursor: pointer;" href="Alta_noticias.php?accion=guardar&usuario=<?php echo $MiNomUsr;?>&<?php echo $MisParam; ?>">Agregar +</a>
     </div>
    <div id="container-fluid" >
        <div class="row" >
            <div class="col-md-12 col-sm-12 col-xs-12" id="catalogo">
                <form class="form-horizontal" id="formNoticias" name="formNoticias">
                    <legend>Datos de la Noticia</legend>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState"> * Eje</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="eje" class="form-control" name="eje" onchange="cargaractE();">
                                <?php
                                    $consultaeje = "SELECT * FROM c_eje";
                                    $resultado = $catalogo->obtenerLista($consultaeje);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idEje'] == $eje) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idEje'] . '" ' . $s . '>' . $row['idEje'] . '. ' .$row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group form-group-sm">
                      <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="categoría">* Categoría:</label>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        <select id="categoría" name="categoría"  class="form-control" onchange="llenaract()">
                          <option value="">Seleccione una opción</option>
                          <?php
                          if ($editar == true && $Idcategoria != ""){

                          }
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
                    </div> -->
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="inputState">Actividad</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select name="actividad" id="actividad" class="form-control">
                                <?php
                                if ($editar == true && $actividad != "") {
                                    $consultaAct = " SELECT act.IdActividad,CONCAT(act.Numeracion,' ',act.Nombre) Nombre FROM c_actividad act WHERE act.IdTipoActividad = 1 AND act.IdEje = $eje ";
                                    $resultado = $catalogo->obtenerLista($consultaAct);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['IdActividad'] == $actividad) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['IdActividad'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                }
                                if($editar == true && $actividad == ""){
                                  echo '<option value="" >Sin actividad</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Exposición</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="expo" class="form-control" name="expo">
                                <?php
                                    $consultaeje = "SELECT et.idExposicion,CONCAT ('(',et.anio,') ',et.tituloFinal) as tituloFinal
                                FROM c_exposicionTemporal et
                                where et.estatus=1 AND et.anio>1
                                ORDER BY et.anio desc";
                                    $resultado = $catalogo->obtenerLista($consultaeje);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idExposicion'] == $expo) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idExposicion'] . '" ' . $s . '>' .$row['tituloFinal'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Área</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="area" class="form-control" name="area">
                                <?php
                                    $consultaeje = "SELECT * FROM c_area WHERE estatus = 1  ORDER BY orden asc ";
                                    $resultado = $catalogo->obtenerLista($consultaeje);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_Area'] == $area) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_Area'] . '" ' . $s . '>' .$row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="fnoticia">* Fecha de la Noticia</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="fnoticia" name="fnoticia" class="form-control" type="date" value="<?php echo $fnoticia ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="titulo">* Titulo</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <!-- <input  id="titulo" name="titulo" class="form-control" type="text" placeholder="Titulo" value="<?php echo $titulo; ?>"/> -->
                            <textarea name="titulo" id="titulo" cols="96" rows="2"><?php echo $titulo; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="analisis"> Análisis</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <textarea name="analisis" id="analisis" cols="96" rows="2"><?php echo $analisis; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <!-- <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Autor</label> -->
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Autor</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="autor" class="form-control" name="autor">
                                <?php
                                    $consultaA = "SELECT p.id_Personas, CONCAT(p.Nombre, ' ',p.Apellido_Paterno, ' ',p.Apellido_Materno) AS NombreC, r.id_Rol
                                        FROM c_personas p
                                        INNER JOIN c_rolPersona r ON r.id_Persona = p.id_Personas
                                        WHERE r.id_Rol = 138
                                        ORDER BY NombreC";
                                    $resultado = $catalogo->obtenerLista($consultaA);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_Personas'] == $autor) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Personas'] . '" ' . $s . '>' . $row['NombreC'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="resumen">Resumen</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <textarea name="resumen" id="resumen" cols="96" rows="3"><?php echo $resumen; ?></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="url">URL</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="url" name="url" class="form-control" type="text" placeholder="http://www.ejemplo.com" value="<?php echo $url; ?>"/>
                        </div>
                    </div> -->
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="url0">URL</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="url0" name="url0" class="form-control" type="text" placeholder="http://www.ejemplo.com" value="<?php echo $url; ?>"/>
                        </div>
                        <!--<label class="col-md-1 col-sm-1 col-xs-1  control-label" for="url"><button id="mas" name="mas" type="button" class="btn btn-xs" onclick="nuevaURL();"><i class="glyphicon glyphicon-plus"></i></button></label>-->
                    </div>
                    <!--<div id="nuevaUrl">
                    </div>-->
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Lugar de Noticia</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="lugarn" class="form-control" name="lugarn">
                                <?php
                                    $consultaTn = "SELECT * FROM c_lugarNoticia";
                                    $resultado = $catalogo->obtenerLista($consultaTn);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idLugarNoticia'] == $lugarn) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idLugarNoticia'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Tipo de Noticia</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="tnoticia" class="form-control" name="tnoticia">
                                <?php
                                    $consulta = "SELECT * FROM c_tipo_noticia ORDER BY Descripcion";
                                    $resultado = $catalogo->obtenerLista($consulta);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_tipo'] == $tnoticia) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_tipo'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Soporte de Noticia</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="snoticia" class="form-control" name="snoticia">
                                <?php
                                    $consultaA = "SELECT * FROM c_soporteNoticia";
                                    $resultado = $catalogo->obtenerLista($consultaA);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['IdSoporte'] == $snoticia) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['IdSoporte'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Tipo de Medio</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="tmedio" class="form-control" name="tmedio" onchange="llenamedios()">
                                <?php
                                    $consultaA = "SELECT * FROM c_tipoMedio ORDER BY Nombre";
                                    $resultado = $catalogo->obtenerLista($consultaA);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idTipoMedio'] == $tmedio) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idTipoMedio'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Medio</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="medio" class="form-control" name="medio">
                                <?php
                                //if ($editar == true && $medio != ""){
                                  $consultaA = "SELECT * FROM c_medio ORDER BY Nombre";
                                  $resultado = $catalogo->obtenerLista($consultaA);
                                  echo '<option value="">Seleccione una opción</option>';
                                  while ($row = mysqli_fetch_array($resultado)) {
                                      $s = '';
                                      if ($row['idMedio'] == $medio) {
                                          $s = 'selected="selected"';
                                      }
                                      echo '<option value="' . $row['idMedio'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                  }
                                //}
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Género</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="genero" class="form-control" name="genero">
                                <?php
                                    $consultaA = "SELECT * FROM c_genero_noticia ORDER BY Descripcion";
                                    $resultado = $catalogo->obtenerLista($consultaA);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_genero'] == $genero) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_genero'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">* Etapa</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="etapa" class="form-control" name="etapa">
                                <?php
                                    $consultaTn = "SELECT * FROM c_etapa";
                                    $resultado = $catalogo->obtenerLista($consultaTn);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idEtapa'] == $etapa) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idEtapa'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Calificación</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="calif" class="form-control" name="calif">
                                <?php
                                    $consultaA = "SELECT * FROM c_calificacion";
                                    $resultado = $catalogo->obtenerLista($consultaA);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idCalificacion'] == $calif) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idCalificacion'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Evento Relacionado</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="evento" class="form-control" name="evento">
                                <?php
                                    $consultaA = "SELECT * FROM c_eventos ORDER BY Descripcion";
                                    $resultado = $catalogo->obtenerLista($consultaA);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['idEvento'] == $evento) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['idEvento'] . '" ' . $s . '>' . $row['Descripcion'] . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="fpub"> * Fecha de Publicación</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="fpub" name="fpub" class="form-control" type="date" value="<?php echo $fpub; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="fview">Fecha de Visualización</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="fview" name="fview" class="form-control" type="date" value="<?php echo $fview; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="fview">Impacto</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="fcomercial" name="fcomercial" class="form-control" type="number" step="any"  value="<?php echo $comercial; ?>"/>
                        </div>
                    </div>
                     <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="fview">Valor comercial</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="fprecio" name="fprecio" class="form-control" type="number" step="any"  value="<?php echo $precio; ?>"/>
                        </div>
                    </div>
                     <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="fview">Valor comercial real</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="fprecioreal" name="fprecioreal" class="form-control" type="number" step="any"  value="<?php echo $precioreal; ?>"/>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Origen </label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="Origen" class="form-control" name="Origen">+
                              <option value="">Seleccione una opción</option>
                              <?php
                              $sel_mus = "";$sel_otro = "";
                              if ($editar == true && $Origen != ""){
                                  switch ($Origen) {
                                    case 'Museo': $sel_mus = "Selected "; break;
                                    case 'Otro': $sel_otro = "Selected "; break;
                                    default: break;
                                  }
                            }
                              echo '<option value="Museo" '.$sel_mus.'>Museo</option>';
                              echo '<option value="Otro" '.$sel_otro.'>Otro</option>';
                               ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Variable1</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <select id="Variable1" class="form-control" name="Variable1">
                              <option value="">Seleccione una opción</option>
                              <?php
                              $selcul = "";$selculcom= "";$social= "";$socialcom= "";$politico = "";$politicocomercial= "";
                              if ($editar == true && $Variable1 != ""){

                              switch ($Variable1) {
                                case 'Cultura': $selcul = "selected"; break;
                                case 'Cultura-Comercial': $selculcom = "selected"; break;
                                case 'Social': $social = "selected"; break;
                                case 'Social-Comercial': $socialcom = "selected"; break;
                                case 'Político': $politico = "selected"; break;
                                case 'Político-Comercial': $politicocomercial = "selected"; break;
                                default: break;
                              }
                            }
                              echo '<option value="Cultura" '.$selcul.'>Cultura</option>';
                              echo '<option value="Cultura-Comercial" '.$selculcom.'>Cultura-Comercial</option>';
                              echo '<option value="Social" '.$social.'>Social</option>';
                              echo '<option value="Social-Comercial" '.$socialcom.'>Social-Comercial</option>';
                              echo '<option value="Político" '.$politico.'>Político</option>';
                              echo '<option value="Político-Comercial" '.$politicocomercial.'>Político-Comercial</option>';
                               ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="archivo">Archivo</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="archivo" name="archivo" class="form-control" type="file" value="<?php echo $archivo; ?>"/>
                            <?php
                            if ($editar == true && $archivo != "") {

                                $ruta = '../../../resources/aplicaciones/Noticias/' . $archivo;
                                echo '<a target="_blank" href="' . $ruta . '" ><i class="glyphicon glyphicon-file"></i> Archivo</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group form-group-sm" style="display: none;">
                        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="archivo">Archivo</label>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <input  id="archivonombre" name="archivonombre" class="form-control" type="text" value="<?php echo $archivo; ?>"/>
                        </div>
                    </div>

                    <?php
                    echo '<input type="hidden" id="tamanoUrl" name="tamanoUrl" value="' . $contadorUrl . '"/>';
                    ?>

                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                            <!-- <button type="cancel" class="btn btn-default btn-xs" id="cancelar" onclick="javascript:window.location='Lista_noticias.php">Cancelar</button> -->
                            <!--<a href="Lista_noticias_2020.php?F_Anio=20&tipoPerfil=1&idUsuario=2&nombreUsuario=Carlos%20Barrón" class="btn btn-default btn-xs">Regresar</a>-->
                            <button type="button" class="btn btn-default btn-xs" id="back">Regresar</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<script>
    var back = document.getElementById('back'); // Suponiendo que la identificación del elemento del botón de retorno está de vuelta
    back.onclick = function() {
        history.back(); // Regresa a la página anterior, también se puede escribir como history.go (-1)
    };
</script>
</body>
</html>
