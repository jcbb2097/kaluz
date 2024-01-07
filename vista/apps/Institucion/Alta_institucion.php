<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

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
if(isset($_SESSION["user_session"])) 
{
    if(isLoginSessionExpired()) 
    {
?>
<script>
    top.location.href="../../logout.php?session_expired=1";
</script>
<?php
    }
}

include_once("../../../WEB-INF/Classes/Catalogo.class.php");
include_once("../../../WEB-INF/Classes/Institucion2.class.php");

$editar = false;
$nombre = "";
$Pais = "";
$Sector = "";
$Giro = "";
$Subgiro = "";
$Estado = "";
$Dependencia = "";
$calle = "";
$numeroe = "";
$numeroi = "";
$colonia = "";
$ciudad = "";
$CP = "";
$Correo = "";
$La="";
$Lo="";
$Telefono = "";
$Ex = "";
$Face = "";
$Insta = "";
$Twi = "";
$Web = "";
$PDF = "";
$DOC = "";
$rfc = "";
$Foto = "";
$alcaidia= "";
$catalogo = new Catalogo();
$registro = array();
if (isset($_GET['accion']) && $_GET['accion'] != "") {
    echo '<input type="hidden" id="accion" name="accion" value="' . $_GET['accion'] . '" />';
    if ($_GET['accion'] == "editar") {
        $editar = true;
        echo '<input type="hidden" id="id" name="id" value="' . $_GET['id'] . '"/>';
    } else {
        echo '<input type="hidden" id="id" name="id" value="0"/>';
    }
}
if ($editar == true) {
    $obj = new Institucion2();
    $obj->setId_institucion($_GET['id']);
    $obj->getInstitucion($_GET['id']);
    $nombre = $obj->getNombre();
    $Foto = $obj->getFoto();
    $Pais = $obj->getId_pais();
    $Sector = $obj->getId_sector();
    $Giro = $obj->getId_giro();
    $Subgiro = $obj->getId_subgiro();
    $Dependencia = $obj->getId_dependencia();
    $calle = $obj->getCalle();
    $numeroe = $obj->getNumeroe();
    $numeroi = $obj->getNumeroi();
    $colonia = $obj->getColonia();
    $ciudad = $obj->getId_ciudad();
    $Estado = $obj->getId_estado();
    $alcaidia=$obj->getId_Municipio();
    $CP = $obj->getCodigopostal();
    $Correo = $obj->getCorreo();
    $Telefono = $obj->getTelefono();
    $Ex = $obj->getExtension();
    $PDF = $obj->getPdfcedulafiscal();
    $DOC = $obj->getDocumentofiscal();
    $rfc = $obj->getRfc();
    $Face = $obj->getFacebook();
    $Insta = $obj->getInstagram();
    $Twi = $obj->getTwitter();
    $Web = $obj->getPaginaweb();
    $La = $obj->getLatitud();
    $Lo = $obj->getLongitud();

    $arrayRol = $obj->obtenerRol();
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <title>Instituciones</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="resources/js/paginas/Institucion/Alta_institucion.js"></script>
        <script src="resources/js/paginas/Institucion/funciones.js"></script> -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>::.FORMULARIO INSTITUCIONES.::</title>
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
        <script src="../../../resources/js/aplicaciones/Institucion/Alta_institucion.js"></script>
        <script src="../../../resources/js/aplicaciones/Institucion/funciones.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#rol').multiselect({
                  nonSelectedText:'No aplica'
                });
            });
        </script>
    </head>
    <body>
        <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_instirucion.php">Instituciones</a> / Agregar institución</div>
        <div id="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" id="formInstirucion" name="formInstirucion">
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="institucion">* Nombre:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="institucion" name="institucion" class="form-control" type="text" placeholder="nombre" value="<?php echo $nombre; ?>"/>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="foto">Logo:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="file" id="foto" name="foto" class="form-control" accept="image/* .pdf"/>
                                <?php
                                if ($editar == true && $Foto != "") {
                                    echo '<a target="_blank" href="../../../' . $Foto . '" class="glyphicon glyphicon-file">Foto</a>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Sector</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Sector" class="form-control" name="Sector" onchange=" cargargiro();" >
                                    <?php

                                    $consultasector = "SELECT Id_sector,nombre FROM `c_sector` where Id_sector>0";
                                    $resultado = $catalogo->obtenerLista($consultasector);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_sector'] == $Sector) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_sector'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Giro:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Giro" class="form-control" name="Giro" onchange="cargarsubgiro();">
                                    <?php
                                     if ($editar == true && $Giro != "") {
                                    $consultagiro = "SELECT Id_giro,nombre FROM `c_giro`";
                                    $resultado = $catalogo->obtenerLista($consultagiro);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_giro'] == $Giro) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_giro'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                    }
                                  }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Subgiro:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="SubGiro" class="form-control" name="SubGiro">
                                    <?php
                                    if ($editar == true && $Subgiro != "") {
                                    $consultasubgiro = "SELECT
                                    s.Id_subgiro2,
                                    s.Id_subgiro,
                                    c_subgiro.nombre
                                    FROM k_subgiro AS s INNER JOIN c_subgiro ON s.Id_subgiro2 = c_subgiro.Id_subgiro WHERE s.Id_subgiro=$Subgiro

                                    ";
                                    $resultado = $catalogo->obtenerLista($consultasubgiro);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_subgiro'] == $Subgiro) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_subgiro'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                    }
                                  }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2 control-label" for="rol">Asignar Rol</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select name="rol[]" id="rol" class="rol" multiple="multiple">
                                    <?php
                                        $consultarol = "SELECT * FROM c_rol";
                                        $resultado = $catalogo->obtenerLista($consultarol);
                                        //echo '<option value="">Seleccione una opción</option>';
                                        while ($row = mysqli_fetch_array($resultado)) {
                                            $s = '';
                                            if (in_array($row['id_Rol'], $arrayRol)) {
                                                $s = "selected";
                                            }
                                            echo '<option value="' . $row['id_Rol'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState" >Dependencia:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Dependencia" class="form-control" name="Dependencia">
                                    <?php
                                    $consultadependencia = "SELECT Id_institucion,nombre FROM `c_institucion` order by Nombre asc;";
                                    $resultado = $catalogo->obtenerLista($consultadependencia);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['Id_institucion'] == $Dependencia) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['Id_institucion'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <legend>&nbsp;Dirección </legend>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">País:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Pais" class="form-control" name="Pais" onchange="cargarDF();">
                                    <?php

                                    $consultaPais = "SELECT id_Pais,Nombre
                                        FROM `c_pais`
                                        WHERE Activo=1
                                        ORDER BY
                                        c_pais.Nombre ASC
                                        ";
                                    $resultado = $catalogo->obtenerLista($consultaPais);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_Pais'] == $Pais) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Pais'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Estado:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="Estado" class="form-control" name="Estado" onchange="cargaralcaldia();">
                                  <?php
                                   if ($editar == true && $Estado != "") {
                                  $consultaestado = "SELECT
                                    c_estado.id_Estado,
                                    c_estado.Nombre
                                    FROM `c_estado`
                                     ";
                                  $resultado = $catalogo->obtenerLista($consultaestado);
                                  echo '<option value="">Seleccione una opción</option>';
                                  while ($row = mysqli_fetch_array($resultado)) {
                                      $s = '';
                                      if ($row['id_Estado'] == $Estado) {
                                          $s = 'selected="selected"';
                                      }
                                      echo '<option value="' . $row['id_Estado'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                  }
                              }
                                  ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Ciudad">Ciudad:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Ciudad" name="Ciudad" class="form-control" type="text" placeholder="Ciudad" value="<?php echo $ciudad; ?>" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Municipio/Alcaldía:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="alcaldia" class="form-control" name="alcaldia" onchange="">
                                    <?php
                                    if ($editar == true && $alcaidia != "") {
                                    $consultaalcaldia = "SELECT
                                        c_municipio.id_Municipio,
                                        c_municipio.Nombre
                                        FROM `c_municipio`
                                        ";
                                    $resultado = $catalogo->obtenerLista($consultaalcaldia);
                                    echo '<option value="">Seleccione una opción</option>';
                                    while ($row = mysqli_fetch_array($resultado)) {
                                        $s = '';
                                        if ($row['id_Municipio'] == $alcaidia) {
                                            $s = 'selected="selected"';
                                        }
                                        echo '<option value="' . $row['id_Municipio'] . '" ' . $s . '>' . $row['Nombre'] . '</option>';
                                    }
                                }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="date">Colonia:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <textarea class="form-control" rows="2" cols="30" id="Colonia" name="Colonia"><?php echo $colonia; ?>   </textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="date">Calle:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <textarea class="form-control" rows="2" cols="30" id="Calle" name="Calle"><?php echo$calle; ?>  </textarea>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="NumeroE">Num. Ext:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="NumeroE" name="NumeroE" class="form-control" type="number" step=".1" value="<?php echo $numeroe; ?>" />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Numeroi">Num. Int</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Numeroi" name="Numeroi" class="form-control" type="number" step="1" value="<?php echo$numeroi; ?>"/>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="codigopostal">Código Postal</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="codigopostal" name="codigopostal" class="form-control" type="text" placeholder="código postal" maxlength="6" value="<?php echo $CP; ?>"/>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Latitud" >Latitud</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input id="Latitud"type="text" name="Latitud" class="form-control" aria-describedby="latitud" placeholder="Latitud" value="<?php echo$La; ?> " ></div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="longitud" >Longitud</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input id="Longitud" name="Longitud" type="text" autofocus="inputStates" class="form-control" placeholder="Longitud" value="<?php echo$Lo; ?> " ></div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="mail">Correo</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Mail" name="Mail" class="form-control" type="email" placeholder="nombre@hosting.com" size="30" value="<?php echo$Correo; ?> " />
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Telefono">Teléfono</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Telefono" name="Telefono" class="form-control" type="tel" placeholder="teléfono con prefijo" maxlength="20" value="<?php echo$Telefono;?>"/></div>
                        </div>  
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Extension">Extensión</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Extension" name="Extension" class="form-control" type="tel" placeholder="Extension" maxlength="5" value="<?php echo$Ex; ?> " />
                            </div>
                        </div>
                        <legend>&nbsp;Administración</legend>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="inputState">Documento Fiscal:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="DF" class="form-control" name="DF" onchange="" >
                            <?php
                             if ($editar == true && $DOC != "") {
                            $consultaestado = "SELECT
                                Id_docf,
                                nombre
                                FROM
                                c_documentofiscal
                                ";

                            $resultado = $catalogo->obtenerLista($consultaestado);
                            echo '<option value="">Seleccione una opción</option>';
                            while ($row = mysqli_fetch_array($resultado)) {
                                $s = '';
                                if ($row['Id_docf'] == $DOC) {
                                    $s = 'selected="selected"';
                                }
                                echo '<option value="' . $row['Id_docf'] . '" ' . $s . '>' . $row['nombre'] . '</option>';
                            }
                             }
                            ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="pdf">PDF Cédula fiscal:</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input type="file" id="pdf" name="pdf" class="form-control" accept=".pdf" />
                                    <?php
                                    if ($editar == true && $PDF != "") {
                                        echo '<a target="_blank" href="../../../' . $PDF . '" class="glyphicon glyphicon-file">PDF</a>';
                                    }
                                    ?>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="RFC">RFC</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="RFC" name="RFC" class="form-control" type="text" placeholder="RFC" maxlength="13" value="<?php echo$rfc;?>"/>
                            </div>
                        </div>
                        <legend>&nbsp;Redes Sociales</legend>
                        <div class="form-group form-group-sm"><br>
                            
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Facebook">Facebook</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Facebook" name="Facebook" class="form-control" type="text" placeholder="Facebook" maxlength="50" value="<?php echo$Face;?>"/></div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Instagram">Instagram</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Instagram" name="Instagram" class="form-control" type="text" placeholder="Instagram" maxlength="50" value="<?php echo$Insta;?>"/></div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Twitter">Twitter</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Twitter" name="Twitter" class="form-control" type="text" placeholder="Twitter" maxlength="50" value="<?php echo$Twi;?>"/></div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="Web">Página web</label>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <input  id="Web" name="Web" class="form-control" type="text" placeholder="www.ejemplo.com" size="50" value="<?php echo $Web; ?>" /></div>
                        </div>
                    
                    <div class="form-group form-group-sm">
                        <div class="col-md-2 col-sm-2 col-xs-2">
                  
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <button type="button" class="btn btn-default btn-xs" id="guardar">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- <div style="float:right;">
            <button id="regresarHX" name="regresarHX" onclick="cambiarContenidos('#contenidos', 'Institucion/Lista_instirucion.php?accion=regresar');" type="button" class="btn btn-primary btn-lg">
                <span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Regresar</button>
        </div> -->
    </div>
</body>
</html>
