<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$IdLibro = "";
$where = "";
$Id = "";
$pagina = "";
$Id_usuario = "";
$EJE = "";
$resulConsulta = "";



if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) {
  $nombreUsuario = $_GET['nombreUsuario'];
  $Id_usuario = $_GET['idUsuario'];
  echo '<input type="hidden" id="Id_usuario" name="Id_usuario" value="' . $Id_usuario . '"/>';
} else {
  $user = "User_desconocido";
}

$año = "";
	
    //$Id= $_GET['IdLibro'];


$anio = "";
$id_registro = "";
$OnClick2 = "";


?>

<html lang="es">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<!----add jquery link---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<head>
  <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
  <link rel="stylesheet" type="text/css" href="../../../resources/css/aplicaciones/estilos.css" />

  <style type="text/css">
    $headerHeight: 300px;
    $toolbarHeight: 64px;

    * {
      box-sizing: border-box;
    }

    html {
      font-size: 62.5%;
      line-height: 1.4;
    }

    html,
    body {
      overflow-y: hidden;
      height: 100%;
      min-height: 100%;
      font-family: Roboto, sans-serif;
    }

    main {
      padding-top: $headerHeight;
      font-family: arial;
      background: #eee;
      min-height: 100%;
    }

    .app-header {
      display: block;
      background: #3f51b5;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      color: #fff;
      height: 50px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0);
    }

    .header-content {

      height: 100%;
      width: 100%;
    }

    .app-toolbar {
      width: 875px;
      height: 61px;
      padding: 0 16px;
      pointer-events: none;
      font-size: 20px;
      margin-bottom: 1px;
    }

    #large-toolbar {

      bottom: 0;
      transform-origin: left top;
      margin-bottom: 16px;
      width: 100%;
    }

    .small-title,
    .large-title {
      transform-origin: left top;
      white-space: nowrap;
      flex: 1;
      flex-basis: 0.000000001px;
      overflow: hidden;
      font-weight: 400;
      line-height: 1.5;
      position: relative;
    }

    .small-title {
      margin-left: 14px;
      // visibility: hidden;
      opacity: 0;
    }

    .large-title {
      will-change: transform, opacity;
      font-size: 56px;
      font-size: 2em;
      margin-left: 64px;
    }

    .icon-button {
      display: inline-block;
      position: relative;
      padding: 6px;
      outline: none;
      user-select: none;
      font-size: 0;
      line-height: 1;
      width: 40px;
      height: 40px;
      box-sizing: border-box !important;

      .icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
        vertical-align: middle;
        fill: currentcolor;
        stroke: none;
        width: 100%;
        height: 100%;
      }
    }

    .background-container {
      position: absolute;
      overflow: hidden;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
    }

    .background {
      pointer-events: none;
      position: absolute;
      background-size: cover;
      height: 100%;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      will-change: transform, opacity;
    }



    .container2 {
      margin-bottom: 25px;
      background-color: #FFFFFF;
      padding: 5px;
      width: 98%;
      height: 92%;

    }

    .containerCeldas {
      max-height: 100px;
      margin-bottom: 0;
      background-color: #f3f3f3;
      padding: 5px;
      width: 440px;
      height: 50px;
      font-size: 9px;
    }

    .containerCeldasEventos {
      margin-bottom: 1px;
      background-color: #f3f3f3;
      padding: 5px;
      width: 220px;
      height: 50px;
      font-size: 10px;
    }

    .containerCeldasGeI {
      margin-bottom: 0;
      background-color: #f3f3f3;
      padding: 5px;
      width: 99.2%;
      height: 310px;
      font-size: 10px;
    }

    .containerDifusion {
      margin-bottom: 0;
      background-color: #f3f3f3;
      padding: 5px;
      width: 99.2%;
      height: 160px;
      font-size: 10px;
    }

    .containerCeldasAcervo {
	overflow: scroll;
      margin-bottom: 0;
      background-color: #f3f3f3;
      padding: 5px;
      width: 99.2%;
      height: 102px;
      font-size: 10px;
    }

    .containerCeldaEje {
      margin-bottom: 0;
      background-color: #4c0108;
      padding: 5px;
      width: 220px;
      height: 50px;
      color: white;
      font-size: 10px;
    }

    .containerCeldaEjeClaro {
      margin-bottom: 1px;
      background-color: #6a2e26;
      font-size: 10px;
      padding: 5px;
      width: 220px;
      height: 50px;
      color: white;
    }

    table {

      width: 99.8%;
      height: 92%;
    }

    .tablaEjes {
      margin-top: 61px;
      width: 97%;
      height: 90.8%;
    }

    .tablaMetas {

      width: 98%;
      height: 90.8%;
    }
  </style>
  <style type="text/css">
    .boton_2 {
      text-decoration: none;

      font-family: arial;
      padding-left: 20px;
      padding-right: 20px;
      padding-top: 4px;
      padding-bottom: 4px;
      font-size: 12px;
      color: white;
      background-color: #03FF72;
      border-radius: 4px;
    }

    .boton_2:hover {
      color: #03FF72;
      background-color: #03FF72;
      text-decoration: none;
    }

    .anio {

      background-color: #f3f3f3;
      text-decoration: none;
      border-radius: 4px;
      font-family: arial;
      border: 0;
    }

    .botones {
      margin-top: 20px;
      margin-left: 350px;
    }

    .botones-izquierda {
      margin-bottom: 0;
      margin-top: 20px;
    }


    .boton_metasEntregaSexenal {
      text-decoration: none;
      font-family: arial;
      padding-left: 10px;
      padding-right: 10px;
      padding-top: 2px;
      padding-bottom: 2px;
      font-size: 10px;
      color: black;
      margin-right: 1px;
      margin-left: 1px;
      border-radius: 4px;
      border: 1px solid #000000;
    }

    .boton_metasEntregaSexenal.active {
      text-decoration: none;
      font-family: arial;
      padding-left: 10px;
      padding-right: 10px;
      padding-top: 2px;
      padding-bottom: 2px;
      font-size: 10px;
      color: white;
      background-color: #363636;
      margin-right: 1px;
      margin-left: 1px;
      border-radius: 4px;
      border: 1px solid #000000;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;

    }

    .main-container {

      overflow-y: hidden;
      margin-left: 5px;
      margin-top: 2px;
      margin-right: 20px;
      margin-bottom: 20px;
      width: 50%;
      height: 100%;

    }

    .nav-top ul {

      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      height: 90px;
      background-color: #f0f0f0;

    }

    li {
      float: left;
    }

    li a {
      display: block;
      text-decoration: none;
      text-align: center;
      line-height: 50px;
      color: #ccc;
      cursor: pointer;

    }


    li a img {

      width: 100px;
      height: 50px;
    }

    .containerMenu {

      display: none;

    }

    .containerMenu.actives {
      overflow-y: auto;
      margin-top: 50px;
      display: inherit;
      width: 900px;
      margin: auto;
      height: 642px;
      margin-bottom: 15px;
      position: fixed;
      background-color: white;
      border-left: 1px solid #eee;
      border-right: 1px solid #eee;

    }

    .containerMenuUpload {

      display: none;

    }

    .containerMenuUpload.actives {

      display: inherit;
      width: 900px;
      margin: auto;
      height: 250px;
      margin-bottom: 15px;
      position: fixed;
      background-color: white;
      border-left: 1px solid #eee;
      border-right: 1px solid #eee;

    }

    p {

      text-align: center;
      margin-top: 20px;
      font-size: 25px;
    }

    .nav-bottom {
      margin-top: 100px;
      width: 100%;
      max-width: 100%;
      position: fixed;
      margin-left: 2px;
      bottom: -10;


    }

    .nav-bottom ul {

      list-style-type: none;
      margin-left: 466px;
      width: 650px;
      padding: 0;
      overflow: hidden;
      height: 50px;
      background-color: #FFFFFF;

    }

    li1 {
      margin-right: 1px;
      float: left;
      width: 110px;

    }

    li2 {
      margin-right: 1px;
      float: left;
      width: 120px;

    }

    li3 {
      margin-right: 1px;
      float: left;
      width: 120px;

    }

    li4 {
      margin-right: 1px;
      float: left;
      width: 10px;

    }

    .tab.active {}




    .well6 {
      min-height: 50px;
      font-family: 'Muli-SemiBold';
      font-size: 11px;
      padding: 8px;
      margin-bottom: 5px;
      background-color: #60d023;
      border: 1px solid #60d023;
      border-radius: 0px;
      color: #fefefe;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    .well9 {
      min-height: 15px;
      font-family: 'Muli-SemiBold';
      font-size: 11px;
      padding: 8px;
      margin-bottom: 20px;
      background-color: white;
      border: 1px solid white;
      border-radius: 0px;
      color: #514e4e;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    /******************* TABLA *********************/
    /*general*/

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

    .table .table-body .tr-anidado {
      border-bottom: none;
      transition: all ease .9s;
      display: none;
    }

    .table .table-body .tr-anidado:hover {
      border-bottom: none;
      background-color: transparent;
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

    .table .table-body .tr-anidado>td {
      padding: 0;
    }



    .table .titulo {
      width: 245px;
    }

    .table.table-principal {
      width: 98%;
      height: 70%;
    }

    .table.table-Auditoria {
      width: 82%;
      height: 65px;

    }

    .table.table-principal .table-header {
      background-color: #444444;
      color: #ffffff;
    }

    .table.table-principal .table-header th {
      font-size: 10px;
      font-weight: 600;
      text-align: left;
      padding: 3px 8px 3px;
    }

    .table.table-principal .table-body th {
      background-color: #ffffff;
    }

    /*table anidada*/


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




    figure.jsx-3352531170 {
      cursor: pointer;
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

      top: 10px;
      display: none;
      font-size: 6px;
    }

    figure.jsx-3352531170:hover .caption.jsx-3352531170 {
      display: block;
    }
  </style>


  <title>::.Logros.::</title>

</head>

<body>
  
  <div style='float: Left; background-color:#e8b509;' id="small-toolbar" class="app-toolbar">
    <h5>Museo del Palacio
      <br>De Bellas Artes </h5>
    <h2 style="margin-left: 330px; position:absolute; top:0; background-color:#e8b509;">Logros <span id="myText">2020</span></h2>
  </div>
  <div class="container2" id="container2">
    <table>

      <tr>
        <td>
          <div class="containerCeldasGeI"><?php
		  
                                          $consultaLogroMeta = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=1 and Tipo=1";
                                          $resultConsultaMeta = $catalogo->obtenerLista($consultaLogroMeta);
                                          while ($row = mysqli_fetch_array($resultConsultaMeta)) {
                                            $id_registro = $row['IdResumenMuseo'];
                                            $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                            echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                          }
                                          ?></div>
        </td>
        <td>
          <div class="containerCeldasGeI"><?php
                                          $consultaLogroMeta = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=1 and Tipo=2";
                                          $resultConsultaMeta = $catalogo->obtenerLista($consultaLogroMeta);
                                          while ($row = mysqli_fetch_array($resultConsultaMeta)) {
                                            $id_registro = $row['IdResumenMuseo'];
                                            $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                            echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                          }
                                          ?></div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="containerCeldasAcervo"> <?php
		
                                              $consultaLogroMeta2 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=2 and Tipo=1 ";
                                              echo $consultaLogroMeta2;
											  $resultConsultaMeta2 = $catalogo->obtenerLista($consultaLogroMeta2);
                                              while ($row = mysqli_fetch_array($resultConsultaMeta2)) {
                                                $id_registro = $row['IdResumenMuseo'];
                                                $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                              }
                                              ?></div>
        </td>
        <td>
          <div class="containerCeldasAcervo"> <?php

                                              $consultaLogroMeta2 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=2 and Tipo=2 ";
                                              $resultConsultaMeta2 = $catalogo->obtenerLista($consultaLogroMeta2);
                                              while ($row = mysqli_fetch_array($resultConsultaMeta2)) {

                                                $id_registro = $row['IdResumenMuseo'];
                                                $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                              }
                                              ?></div>
        </td>
      </tr>
      <tr>
        <td>
          <div class="containerDifusion"><?php
                                          $consultaLogroMeta3 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=3 and Tipo=1";
                                          $consultaLogroMeta3 = $catalogo->obtenerLista($consultaLogroMeta3);
                                          while ($row = mysqli_fetch_array($consultaLogroMeta3)) {
                                            $id_registro = $row['IdResumenMuseo'];
                                            $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                            echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                          }
                                          ?></div>
        </td>
        <td>
          <div class="containerDifusion"><?php
                                          $consultaLogroMeta3 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=3 and Tipo=2";
                                          $consultaLogroMeta3 = $catalogo->obtenerLista($consultaLogroMeta3);
                                          while ($row = mysqli_fetch_array($consultaLogroMeta3)) {

                                            $id_registro = $row['IdResumenMuseo'];
                                            $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                            echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                            echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                          }
                                          ?></div>
        </td>
      </tr>
      </tbody>

    </table>
  </div>


  <div class="main-container">
    <div class="containerMenu" id="Inicio">
      <div style='float: Left; background-color:#e8b509;' id="small-toolbar" class="app-toolbar">
        <h5>Museo del Palacio
          <br>De Bellas Artes </h5>
        <h2 style="margin-left: 330px; position:absolute; top:0; background-color:#e8b509;">Logros <span id="myText2">2020</span></h2>
      </div>
      <div class="container2" id="container2">
        <table>

          <tr>
            <td>
              <div class="containerCeldasGeI"><?php
                                              $consultaLogroMeta = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=1 and Tipo=1";
                                              $resultConsultaMeta = $catalogo->obtenerLista($consultaLogroMeta);
                                              while ($row = mysqli_fetch_array($resultConsultaMeta)) {
                                                $id_registro = $row['IdResumenMuseo'];
                                                $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                              }
                                              ?></div>
            </td>
            <td>
              <div class="containerCeldasGeI"><?php
                                              $consultaLogroMeta = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=1 and Tipo=2";
                                              $resultConsultaMeta = $catalogo->obtenerLista($consultaLogroMeta);
                                              while ($row = mysqli_fetch_array($resultConsultaMeta)) {
                                                $id_registro = $row['IdResumenMuseo'];
                                                $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                              }
                                              ?></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="containerCeldasAcervo"> <?php
                                                  $consultaLogroMeta2 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=2 and Tipo=1";
                                                  $resultConsultaMeta2 = $catalogo->obtenerLista($consultaLogroMeta2);
                                                  while ($row = mysqli_fetch_array($resultConsultaMeta2)) {
                                                    $id_registro = $row['IdResumenMuseo'];
                                                    $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                    echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                    echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                    echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                    echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                                  }
                                                  ?></div>
            </td>
            <td>
              <div class="containerCeldasAcervo"> <?php
                                                  $consultaLogroMeta2 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=2 and Tipo=2";
                                                  $resultConsultaMeta2 = $catalogo->obtenerLista($consultaLogroMeta2);
                                                  while ($row = mysqli_fetch_array($resultConsultaMeta2)) {

                                                    $id_registro = $row['IdResumenMuseo'];
                                                    $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                    echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                    echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                    echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                    echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                                  }
                                                  ?></div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="containerDifusion"><?php
                                              $consultaLogroMeta3 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=3 and Tipo=1";
                                              $consultaLogroMeta3 = $catalogo->obtenerLista($consultaLogroMeta3);
                                              while ($row = mysqli_fetch_array($consultaLogroMeta3)) {
                                                $id_registro = $row['IdResumenMuseo'];
                                                $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                              }
                                              ?></div>
            </td>
            <td>
              <div class="containerDifusion"><?php
                                              $consultaLogroMeta3 = "SELECT Etapa,Tipo,Titulo,Resumen,IdResumenMuseo,Descripcion from c_LogrosResumenMuseo where Etapa=3 and Tipo=2";
                                              $consultaLogroMeta3 = $catalogo->obtenerLista($consultaLogroMeta3);
                                              while ($row = mysqli_fetch_array($consultaLogroMeta3)) {

                                                $id_registro = $row['IdResumenMuseo'];
                                                $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=1&id=" . $id_registro;
                                                echo '    <figure class="jsx-3352531170 medium" style="margin-left: 405px; position:relative; top:4; ">
			<a href="' . $OnClickEditar . '"><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
			<span class="jsx-3352531170 caption"></span></a></figure>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Titulo'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div><br>';
                                                echo '<div style=" position:relative; top:0;" >' . $row['Descripcion'] . '<div>';
                                              }
                                              ?></div>
            </td>
          </tr>
          </tbody>

        </table>
      </div>
    </div>
    <div id="Home" class="containerMenu ">
      <div style='float: Left; background-color:#e8b509; width:884px;' id="small-toolbar" class="app-toolbar">
        <h2 style="margin-left: 330px; position:absolute; top:0; background-color:#e8b509;">Logros <span id="myText3">2020</span></h2>
      </div>
      <table class="tablaEjes">

        <tr>
		  <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=1";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>

        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=2";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=3";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=4";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=5";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=6";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=7";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEjeClaro" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEjeClaro" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=8";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEjeClaro" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEjeClaro" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=9";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
         <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=10";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>
        <tr>
          <?php
		   $row_cnt =0;
        $consultaLogroEje1 = "SELECT * from c_eventos where idEje=11";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		 $row_cnt = mysqli_num_rows($resultconsultaLogroE1);
		 if( $row_cnt>=4){
			while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		 }else{ 
				if($row_cnt<4){
				while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
         
		  echo ' 
        <td><div class="containerCeldaEje" >';
          echo '' . $row['Descripcion'] . '
		</div></td>
    ';
    // fin cambios jose carlos 13/07/2020
        }
		$contador_celdaNormal=4-$row_cnt;
		     for ($i = 1; $i <= $contador_celdaNormal; $i++) {
				echo ' <td>
            <div class="containerCeldasEventos"></div>
          </td>';
					}
		 }
		 }
         ?>
        </tr>

        </tbody>

      </table>
    </div>

    <div id="Search" class="containerMenu">


      <div style='float: Left; background-color:#e8b509; width:884px;' id="small-toolbar" class="app-toolbar">
        <h2 style="margin-left: 330px; position:absolute; top:0; background-color:#e8b509;">Logros <span id="myText4">2020</span></h2>
      </div>
      <table class="tablaMetas">
       <tr>
	   <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=1";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
			</tr>
       
        <tr>
           <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=2";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>




        <tr>
             <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=3";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>

        </tr>
        <tr>
         
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=4";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
        <tr>
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=5";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>

        </tr>
        <tr>
             <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=6";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
        <tr>
         
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=7";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
		<tr>
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=8";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
		 <tr>
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=9";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
		<tr>
             <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=10";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>

        </tr>
		<tr>
           <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=1 and idEje=11";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
        </tbody>

      </table>
 <table class="tablaMetas" style="margin-left:442px;position:absolute; top:62;">
       
	  <tr>
	   <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=1";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
			</tr>
       
        <tr>
           <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=2";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>




        <tr>
             <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=3";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>

        </tr>
        <tr>
         
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=4";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
        <tr>
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=5";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>

        </tr>
        <tr>
             <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=6";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
        <tr>
         
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=7";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
		<tr>
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=8";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
		 <tr>
            <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=9";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
		<tr>
             <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=10";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>

        </tr>
		<tr>
           <?php
	   $row_cntEje =0;
        $consultaLogroEje1 = "SELECT * from c_logrosResumenEje where Tipo=2 and idEje=11";
        $resultconsultaLogroE1 = $catalogo->obtenerLista($consultaLogroEje1);
		$row_cntEje = mysqli_num_rows($resultconsultaLogroE1);
		if($row_cntEje>0){
		 while ($row = mysqli_fetch_array($resultconsultaLogroE1)) {
          //cambios jose carlos 13/07/2020
          $OnClickEditar = "../../../vista/apps/Logros/Alta_logro.php?accion=editar&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $Id_usuario . "&tipo_de_resumen=2&id=" . $row['IdResumenEje'];
		  echo ' 
        <td><div class="containerCeldas" > 
		<figure class="jsx-3352531170 medium" style="margin-left: 410px;">';
          echo '<a href="' . $OnClickEditar . '">';
          echo '<img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
		<span class="jsx-3352531170 caption"></span></a></figure>
		 <div style=" position:relative; top:0;" >' . $row['Resumen'] . '<div>
		</div></td>	
    ';
    // fin cambios jose carlos 13/07/2020
        }
		}else{
		echo '<td>
            <div class="containerCeldas">
              <figure class="jsx-3352531170 medium" style="margin-left: 410px;">
                <a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default">
                  <span class="jsx-3352531170 caption"></span></a></figure>
				</td>';
		}
        ?>
        </tr>
        </tbody>

      </table>
    </div>

    <div id="Upload" class="containerMenuUpload">
      <div class="well6" style="background-color: #e8b509; border: 1px solid #e8b509; color: black;">1. Desarrollo de Proyectos para Equipamiento de espacios<br><a style="color:black;" href="">Administración</a><br> 5 metas - Actividad</div>
      <div class="row">
        <div class="well9">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt, asperiores. Odio natus distinctio maiores assumenda dolorem exercitationem placeat doloribus a quo beatae excepturi, autem nihil harum eaque veritatis cupiditate soluta!</div>
      </div>
      <table class="table table-Auditoria">
        <tbody class="table-body ">
          <tr class="nivel-1 acordeon">
            <td class="titulo">1 Auditorio segunda etapa</td>
            <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere maiores architecto, nobis consectetur ea facilis velit porro cum corporis nesciunt doloribus libero quisquam excepturi animi eveniet suscipit omnis blanditiis eum?</td>
            <td>
              <figure class="jsx-3352531170 medium" style="margin-right: 12px;"><a><img src="https://s3.amazonaws.com/sitiosie/icons/editar.svg" class="jsx-3352531170 icon default"><span class="jsx-3352531170 caption"></span></a></figure>
            </td>
          </tr>
        </tbody>
      </table>

      <table class="table table-principal">
        <thead class="table-header">
          <tr>
            <th class="logro"></th>
            <th class="MPBA">MPBA</th>
            <th class="INBA">INBA</th>
            <th class="Patronato">Patronato</th>
            <th class="Otros">Otros</th>
          </tr>
        </thead>
        <tbody class="table-body ">
          <tr class="nivel-1 acordeon">
            <td>Memoria descriptiva</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
          </tr>
          <tr class="nivel-1 acordeon">
            <td>Programa arquitectónico</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
          </tr>
          <tr class="nivel-1 acordeon">
            <td>Estudios preliminares</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
          </tr>
          <tr class="nivel-1 acordeon">
            <td>Estudios preliminares</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
            <td>$8.000.000.00</td>
          </tr>
        <tfoot>
          <tr class="table-header">
            <th class="logro">TOTALES</th>
            <th class="MPBA">$8.000.000.00</th>
            <th class="INBA">$8.000.000.00</th>
            <th class="Patronato">$8.000.000.00</th>
            <th class="Otros">$8.000.000.00</th>
          </tr>
        </tfoot>
        </tbody>
      </table>

    </div>


    <div class="nav-bottom">

      <div class="botones-izquierda">
        <br>
        <a href="../../../vista/apps/Logros/Alta_logro.php?accion=guardar&nombreUsuario=<?php echo $nombreUsuario; ?>&idUsuario=<?php echo $Id_usuario; ?>" class="boton_2" style="background-color: #e8b509;">Agregar</a>
        <select id="anio" name="anio" class="anio">
          <?php
          echo '<option value="2020" selected="selected">2020</option>';
          echo '<option value="2019" >2019</option>';
          echo '<option value="2018">2018</option>';
          echo '<option value="2017" >2017</option>';
          echo '<option value="2016">2016</option>';
          echo '<option value="2015">2015</option>';
          echo '<option value="2014">2014</option>';
          echo '<option value="2013" >2013</option>';
          echo '<option value="2012" >2012</option>';
          ?>
        </select>


      </div>
      <ul>
        <li class="li4"><a class="tab" href="Inicio">
            <i class="boton_metasEntregaSexenal active">Inicio</i>
          </a></li>
        <li class="li1"><a class="tab " href="Home">
            <i class="boton_metasEntregaSexenal">Eventos Relevantes</i>
          </a></li>

        <li class="li2"><a class="tab" href="Search"><i class="boton_metasEntregaSexenal">Resumen de ejes</i></a></li>

        <li class="li3"> <a class="tab" href="Upload"> <i class="boton_metasEntregaSexenal">Resumen financiero</i></a></li>


      </ul>

    </div>


  </div>
  
  <script>
    $(document).ready(function() {

      push = false;
      $('i').click(function() {
        $(".boton_metasEntregaSexenal").removeClass("active");
        $(this).addClass("active");
      });
      $('ul li a ').click(function() {
        document.getElementById('small-toolbar').style.display = "none";
        document.getElementById('container2').style.display = "none";



        $(".containerMenu").removeClass("actives");
        $(".containerMenuUpload").removeClass("actives");


        var contentId = $(this).attr("href");


        $('.containerMenu[id="' + contentId + '"]').addClass("actives");
        $('.containerMenuUpload[id="' + contentId + '"]').addClass("actives");

        if (!push)

          history.pushState({}, '', contentId);

        push = false;

        return false;

      });


      $(window).on("popstate", function() {

        push = true;

        var h = (window.location.href.indexOf("/") > -1) ? window.location.href.split("/").pop() : false;

        if (h == 'home.php') {

          $('ul li a[href="Home"]').click();


        } else {

          $('ul li a[href="' + h + '"]').click();


        }

      });




    });
    document.getElementById("anio").onchange = function(evt) {
      var anio = evt.target.value;
      document.getElementById("myText").innerHTML = anio;
      document.getElementById("myText2").innerHTML = anio;
      document.getElementById("myText3").innerHTML = anio;
      document.getElementById("myText4").innerHTML = anio;
	
	
	if( anio && anio != '' ){

        //Abrir conexión de AJAX
        $.ajax({
          url: 'logros.php', //URL donde está el archivo que busca a los usuarios
          method: 'GET', //Verbo de petición del protocolo
          data: {anio:anio}, //Información que se enviará al PHP
          success:function(respuesta){
            //Respuesta satisfactoria

            //Validar si se creó correctamente el JSON
            if( respuesta.success ){
              var i = 0;

              //Agregar opción por default a usuarios
              //Recorrer el nodo de información recopilada
              for (i; i < respuesta.data.length;) {

                //Armar la opción y agregarla al SELECT de usuarios
                let option = '<option value="' + respuesta.data[i].id + '">' + respuesta.data[i].usuario + '</option>';
                $('#anio').append(option);
                i++;
              }      

            }

            else{
              alert( respuesta.message );
            }
          },
          error:function(err){
            alert( err );
          }
        })
      }
    };
  </script>
</body>




</html>