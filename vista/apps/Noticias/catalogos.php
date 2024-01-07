<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$Id = "";
$pagina = "";
$Id_usuario="";
if (isset($_GET['menu']) && $_GET['menu'] !="") {
    $pagina = $_GET['menu'];
    //$Id= $_GET['IdLibro'];
}

if ((isset($_GET['usuario']) && $_GET['usuario'] != "")) {
     $user = $_GET['usuario'];
     /*$Id_usuario=$_REQUEST['idUsuario'];
     echo '<input type="hidden" id="Id_usuario" name="Id_usuario" value="' . $Id_usuario . '"/>';*/
}else{
     $user="User_desconocido";
}

?>

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
    <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <script src="../../../resources/js/aplicaciones/Noticias/acciones.js"></script>
    <script src="../../../resources/js/aplicaciones/Noticias/catalogos.js"></script>
    <title>::.Catalogos.::</title>
    <style>

    .container {
            width: 100%;
            margin: 0 auto;
            padding-left: 0px;
            padding-right: 0px;
    }

    .dropdown {
      position: relative;
      display: inline-block;
      margin-left: 19px;
      padding-bottom: 4px;
      height: 30px;
      padding-top: 5px;
    }
    .sel{
      background-color: #4d4c57;
    }
    .sel .dropbtn{
     color:white;
    }
    .lbl {
            width: 100%;
            position: relative;
            display: block;
            background-color: #ffffff;
            border: none;
            height: 19px;
            font-family: 'Muli', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #4d4c57;
            padding: 0 0 0 2px;
            outline: none;
            margin-top: 3px;
    }
    .dropbtn {
  background-color: transparent;
  color: black;
  font-size: 11px;
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  font-weight: 500;
  border: none;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #cacaca;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: #525252;
  padding: 6px 8px;
  text-decoration: none;
  display: block;
}
.sub{
  font-size: 11px;
}

.dropdown-content a:hover {background-color: #dedede;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover {cursor: pointer;}

.tbl-header{
  background-color: #4d4c57;
  color:white;
  border-collapse: collapse;
}
.tbl-header, .tbl-td, .tbl-th{
  border: 1px solid #4d4c57;
  text-align: center;
}
.tbl-td, .tbl-th{
  padding: 4px;
}
.tbl-ind{
  width: 98%;
}
.avance  {

}
.td1{
  max-width: 80px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.td2{
  max-width: 110px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}


.grande{
  min-width: 80px;
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
    max-width: 40px;
}

.progress.jsx-3213596737 {
    height: 102%;
    border-radius: 1.1px;
    -webkit-transition: width 1s ease-in, background-color 1s ease-in;
    transition: width 1s ease-in, background-color 1s ease-in;
}
.progress{
  margin-bottom: 0px !important;
}

span.jsx-3213596737 {
    color: #4D4D57;
    font-family: 'Muli', sans-serif;
    font-size: 10px;
    padding-right: 3px;
}
figure{
  cursor: pointer;
}

.pendiente.jsx-3213596737 {
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: start;
    -ms-flex-pack: justify;
    justify-content: start;
    min-width: 100px;
}

.pendiente.jsx-3213596737 .progress {
    width: 6px;
    height: 6px;
}
.progreso{

}
#tabla{
    margin: auto;
}

body{
        overflow-x: hidden;
}

/*label, input {
    width:200px;
    display:block;
    float:left;
    margin-bottom:10px;
}
label {
    width:145px;
    text-align:right;
    padding-right:10px;
    margin-top:2px;
}*/


br {
    clear:left;
}

.dmenuact{
  border-bottom: 1px solid #4d4d57;
  margin-left: 4px;
}
.menuact{
  padding-top: 3px;
  padding-bottom: 3px;
  margin-right: 6px;
  cursor: pointer;
}
.bac{
  background-color: #4d4d57;
  border-radius: 5px 5px 0px 0px;
}
.pnum{
  color:black;
  font-weight:500;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
}
.ptit{
  color:black;
  font-family: 'Muli', sans-serif;
  font-size: 11px;
  font-weight:200;
  text-decoration: underline black;
  margin: 0;
}
.bac > .pnum{
  color:white;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
}
.bac > .ptit{
  color:white;
  font-family: 'Muli', sans-serif;
  font-size: 11px;
  font-weight:200;
  text-decoration: underline white;
  margin: 0;
}
.acsub{
  margin-right: 6px;
}
.ppor{
  margin-left: -13px !important;
  font-family: 'Muli', sans-serif;
  font-size: 9px;
  margin: 0;
  color: #00000075;
}
.barraact{
  min-width: 157%;
  margin-left: -13px;
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
    min-width: 60px;
    }
.modal-avances{
  border-radius: 50px;
}
.avances-image{
    width: 100%;
    border-radius: 50px 50px 0px 0px;
}
.avances-header-container{
  padding: 0px;
}
.avances-titulo{

  margin-top: -1px;
  font-family: 'Muli-Regular';
  font-size: 14px;
  color: white;
}
.avances-contenido{
  font-family: 'Muli-Regular';
  font-size: 11px;
  color: #e6e6e6bf;
}
.avances-body{
  margin-top: -3px;
  background-color: #404040;
}
.avances-footer-orange{
  padding: 3px;
  border-top: none;
  text-align: center;
  background: rgb(250,220,45);
  background: linear-gradient(90deg, rgba(250,220,45,1) 0%, rgba(255,255,255,1) 38%);
  border-radius: 0px 0px 50px 50px;

}
.avances-footer-green{
  padding: 3px;
  border-top: none;
  text-align: center;
  background: rgb(39,182,58);
  background: linear-gradient(90deg, rgba(39,182,58,1) 0%, rgba(255,255,255,1) 88%);
  border-radius: 0px 0px 50px 50px;

}
.avances-footer-content{
  padding-top: 5px;
  font-family: 'Muli-Regular';
  font-size: 15px;
  color: red;
}
.modal-sm{
  width: 232px;
}

.sel2{
  background-color: white;
  color: #000;
}

    </style>


</head>

<body>
<input type="hidden" name="usuario" id="usuario" value="<?php echo ($user); ?>">
<input type="hidden" name="menu" id="menu" value="<?php echo ($pagina); ?>">
<!-- <div class="well well-sm"><a style="color:#fefefe;" href="../../aplicaciones.php?tipoPerfil=1">Aplicaciones</a> / <a style="color:#fefefe;" href="Lista_noticias.php">Noticias</a> / <a style="color:#fefefe;" href="javascript:window.location.reload(true)">Catálogos</a></div> -->
<!--Indicadores > -->
<div class="row" style="margin-top:0px !important;margin-left: 5px !important;">
<table class="tbl-ind">
  <thead class="tbl-header">
      <tr>
          <th class="tbl-th" id="lugarN" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_lugarNoticia.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(1);">Lugar de Noticia</th>
          <th class="tbl-th" id="tipoN" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_tipoNoticia.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(2);">Tipo de Noticia</th>
          <th class="tbl-th" id="soporteN" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_soporteNoticia.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(3);">Soporte de Noticia</th>
          <th class="tbl-th" id="tipoMn" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_tipoMedio.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(4);">Tipo de Medio</th>
          <th class="tbl-th" id="genero" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_generoNoticia.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(5);">Género</th>
          <th class="tbl-th" id="medioN" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_medio.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(6);">Medio</th>
          <th class="tbl-th" id="etapaN" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_etapa.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(7);">Etapa</th>
          <th class="tbl-th" id="califN" style="cursor:pointer;" onclick="cambiarContenido('#contenido','Lista_calificacion.php?&nombreUsuario=<?php echo $user;?>');cambiarColorcatalogo(8);">Calificación</th>
      </tr>
  </thead>
</table>
</div>
<br>
<div id="contenido">
  
</div>
<!-- Fin Indicadores Globales -->
<?php 
/*if(isset($_REQUEST['id_t']) and $_REQUEST['id_t']!=""){
   $id_t=$_REQUEST['id_t'].".php";
*/
?>
<script type="text/javascript">
/*cambiarContenido('#contenido','<?php //echo $id_t;?>?nombreUsuario=<?php //echo $user;?>&?idUsuario=<?php //echo $Id_usuario;?>&?<?php //echo $id_t;?>'); 
cambiarColorMenu('<?php //echo $id_t;?>?');
*/
</script>
<?php

/*}*/
?>
</body>


</html>
