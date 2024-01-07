<?php
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$MiNomUsr="SinUsr";
$IdUser=999;
$IDAcuerdoEdit = "";
$id_acuerdo = "";

if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != "")) //Si el parametro existe se procesa
{   if ($_GET['nombreUsuario']!="0") {$MiNomUsr = "SinUsr";} //Si el parametro es diferente de 0 se busca el valor
    else { $MiNomUsr= "SinUsr"; } //Si el parametro es igual a 0 se buscan los NULOS
}

if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != "")) //Si el parametro existe se procesa
{   if ($_GET['idUsuario']!="0") {$IdUser = "".$_GET['idUsuario'];} //Si el parametro es diferente de 0 se busca el valor
    else { $IdUser= "SinUsr"; } //Si el parametro es igual a 0 se buscan los NULOS
}


if ((isset($_GET['IDacuerdoedit']) && $_GET['IDacuerdoedit'] != "")) //Si el parametro existe se procesa
{   if ($_GET['IDacuerdoedit']!="0") {$IDAcuerdoEdit = "".$_GET['IDacuerdoedit'];} //Si el parametro es diferente de 0 se busca el valor
    else { $IDAcuerdoEdit= "0"; } //Si el parametro es igual a 0 se buscan los NULOS
}
//echo $MiNomUsr."            ";
//echo $IDAcuerdoEdit;

$html = "";
ob_start();
?>
<html lang="en">
    <head>
        <style>
* {
box-sizing: border-box;
}
/**
Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
puede ser de altura y anchura completas.
**/
@page {
margin: 0cm 0cm;
}

/** Defina ahora los márgenes reales de cada página en el PDF **/
body {
/*background-color: red;*/
margin-top: 7cm;
margin-left: .5cm;
margin-right: .5cm;
margin-bottom: .5cm;
font-family: Arial, Helvetica, sans-serif;
/*background-color:#becdfe;*/
}

/** Definir las reglas del encabezado **/
header {
position: fixed;
top: 1cm;
left: .5cm;
right: .5cm;
height: 5cm;

/** Estilos extra personales **/
/*background-color: #03a9f4;*/
}

/* Create three equal columns that floats next to each other */
.column1  {
  float: left;
  width: 20%;
  padding: 5px;
  height: 80px; /* Should be removed. Only for demonstration */
  /*background-color:#becdfe;*/
}

 .column3 {
  float: right;
  width: 20%;
  padding: 10px;
  height: 100px; /* Should be removed. Only for demonstration */
  /*background-color: #ff6347;*/
}

.column2 {
  float: left;
  width: 60%;
  padding: 10px;
  height: 100px; /* Should be removed. Only for demonstration */
  /*background-color: #BDB76B;*/
}

 .column5 {
  float: left;
  width: 100%;
  height: 20px; /* Should be removed. Only for demonstration */
  /*background-color: #ff6347;*/
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.row2:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
  .column {
    width: 100%;
  }
}

h4{
    font-size: 5px;
    margin: 0;
    writing-mode: vertical-lr;
    text-align: center;
    line-height: .9;
}

.rotate{
    transform: rotate(0deg);
}

//Tabla firmas
.firmas {
    width: 100%;
    /*width: auto;*/
}

.firmas th, td{
    align: center;
    border: 1px solid white;
}

.firmas th{
    font-size: 10px;
    color: black;
    width: 1%;
    height: 20px;
    text-align: center;
}

.firmas td{
    height: 30px;
}

/*.firmas tr:hover{
    background-color: #B3D8F2;
    transition-duration: 0.5s;
}*/

//Tabla actividades
.tablaactividad {
    width: 100%;
    page-break-inside: auto;
    table-layout: fixed;
}

.tablaactividad th, td{
    align: center;
    border: 1px solid white;
}

.tablaactividad th{
    font-size: 6.5px;
    color: black;
    width: 10px;
    height: 10px;
    text-align: center;
}

.tablaactividad td{
    height: 120px;
    font-size: 6.5px;
}

.page-number:before {
  content: "Página " counter(page);
  font-size: 10px;
}

.page_break {
  page-break-before: always;
}

/** Definir las reglas del pie de página **/
footer {
position: fixed;
bottom: 0cm;
left: 0cm;
right: 0cm;
height: .5cm;

/** Estilos extra personales **/
/*background-color: #03a9f4;
color: white;*/
text-align: center;
line-height: 1.5cm;
}
        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
  <div class="row">
  <div class="column1">
    <?php
  //pruebas para abrir ventana emergente
if (strpos($_SERVER['HTTP_HOST'], "administro") === false) {
//kaluz para abrir ventana emergente
    if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
        //sie
        ?>
        <img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/sie/vista/apps/AcuerdosEscritos/logopdf.png" style="width:400px; height:80px;">
        <?php
    }else{
        ?>
        <img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/sie/vista/apps/AcuerdosEscritos/logopdf.png" style="width:400px; height:40px;">
        <?php
    }
}else{
    ?>
<img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/pruebassie/sie/vista/apps/AcuerdosEscritos/logopdf.png" style="width:400px; height:80px;">
<?php
}
?>
    <br>
  </div>
  <?php
  if (strpos($_SERVER['HTTP_HOST'], "kaluz") == false) {
    ?>
      <div class="column2"><center><h5 style="text-alig:bottom">Reunión de acuerdos<br>
     Museo del Palacio de Bellas Artes</h5></center></div>
  <?php
  }else{
  ?>
  <div class="column2"><center><h5 style="text-alig:bottom">Reunión de acuerdos<br>
     Museo Kaluz</h5></center></div>
    <?php
    }
    if($IDAcuerdoEdit != "0"){
    $consultaultimoregistro = "SELECT MAX(id_acuerdo_escrito) AS id FROM c_acuerdospdf WHERE id_acuerdo_escrito=$IDAcuerdoEdit";
    $result = $catalogo->obtenerLista($consultaultimoregistro);
    while ($row = mysqli_fetch_array($result)) {
    $id_acuerdo = $row['id'];
    }
    }else{
    $consultaultimoregistro = "SELECT MAX(id_acuerdo_escrito) AS id FROM c_acuerdospdf";
    $result = $catalogo->obtenerLista($consultaultimoregistro);
    while ($row = mysqli_fetch_array($result)) {
    $id_acuerdo = $row['id'];
    }
    }
    ?>


  <h6><div class="page-number"><br>
  <?php
    if($IDAcuerdoEdit != "0"){
    $consultafecha = "SELECT fecha_convocado AS fecha FROM c_acuerdospdf WHERE id_acuerdo_escrito=$IDAcuerdoEdit limit 1";
    $result1 = $catalogo->obtenerLista($consultafecha);
    while ($row = mysqli_fetch_array($result1)) {
    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
    $d = $row['fecha'];
    $fecha = strftime("%d de %B de %Y", strtotime($d));
    echo 'Fecha: '.$fecha;
    }
    } else{
    $consultafecha = "SELECT fecha_convocado AS fecha FROM c_acuerdospdf WHERE id_acuerdo_escrito=$id_acuerdo limit 1";
    $result1 = $catalogo->obtenerLista($consultafecha);
    while ($row = mysqli_fetch_array($result1)) {
    setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
    $d = $row['fecha'];
    $fecha = strftime("%d de %B de %Y", strtotime($d));
    echo 'Fecha: '.$fecha;
    }
    }
    ?>
  <!--<br>-->
  <?php
    /*if($IDAcuerdoEdit != "0"){
    $consultaeje = "SELECT CONCAT(ej.idEje,'. ',ej.Nombre) AS eje
    FROM c_acuerdospdf AS p
    LEFT JOIN k_acuerdoactividad AS acu on acu.id_acuerdo=p.id_acuerdo_escrito
    LEFT JOIN c_eje AS ej ON ej.idEje=acu.id_proyecto
    where id_acuerdo_escrito=$IDAcuerdoEdit limit 1";
    $result2 = $catalogo->obtenerLista($consultaeje);
    while ($row = mysqli_fetch_array($result2)) {
    echo 'Eje: '.$row['eje'];
    }
    }else{
    $consultaeje = "SELECT CONCAT(ej.idEje,'. ',ej.Nombre) AS eje
    FROM c_acuerdospdf AS p
    LEFT JOIN k_acuerdoactividad AS acu on acu.id_acuerdo=p.id_acuerdo_escrito
    LEFT JOIN c_eje AS ej ON ej.idEje=acu.id_proyecto
    where id_acuerdo_escrito=$id_acuerdo limit 1";
    $result2 = $catalogo->obtenerLista($consultaeje);
    while ($row = mysqli_fetch_array($result2)) {
    echo 'Eje: '.$row['eje'];
    }
    }*/
    ?>
  <br>
  <?php
    if($IDAcuerdoEdit != "0"){
    $consultaconvoca = "SELECT concat(b.Nombre,' ',b.Apellido_Paterno,' ',b.Apellido_Materno) AS convoca
    FROM c_acuerdospdf AS p
    LEFT JOIN k_acuerdoactividad AS acu on acu.id_acuerdo=p.id_acuerdo_escrito
    LEFT JOIN c_eje AS ej ON ej.idEje=acu.id_proyecto
    LEFT JOIN c_personas AS b ON b.id_Personas = p.id_usuario
    WHERE p.id_acuerdo_escrito=$IDAcuerdoEdit limit 1";
    $result3 = $catalogo->obtenerLista($consultaconvoca);
    while ($row = mysqli_fetch_array($result3)) {
    echo 'Convoca: '.$row['convoca'];
    }
    }else{
    $consultaconvoca = "SELECT concat(b.Nombre,' ',b.Apellido_Paterno,' ',b.Apellido_Materno) AS convoca
    FROM c_acuerdospdf AS p
    LEFT JOIN k_acuerdoactividad AS acu on acu.id_acuerdo=p.id_acuerdo_escrito
    LEFT JOIN c_eje AS ej ON ej.idEje=acu.id_proyecto
    LEFT JOIN c_personas AS b ON b.id_Personas = p.id_usuario
    WHERE p.id_acuerdo_escrito=$id_acuerdo limit 1";
    $result3 = $catalogo->obtenerLista($consultaconvoca);
    while ($row = mysqli_fetch_array($result3)) {
    echo 'Convoca: '.$row['convoca'];
    }
    }
    ?>
    <br>
  </h6></div>
</div>
<div class="row2" style="margin-top: -50px; margin-bottom: 50px;">
<div class="column5">
    <h7 style="font-size: 12px;">
    <?php
    if($IDAcuerdoEdit != "0"){
    $consultaconvoca = "SELECT acu.descripcion as des FROM c_acuerdospdf acu
    WHERE acu.id_acuerdo_escrito=$IDAcuerdoEdit";
    $result3 = $catalogo->obtenerLista($consultaconvoca);
    while ($row = mysqli_fetch_array($result3)) {
    echo '<b style="font-weight: normal; margin-top: -100px; margin-bottom: 100px;">'.$row['des'].'</b>';
    }
    }else{
    $consultaconvoca = "SELECT acu.descripcion as des FROM c_acuerdospdf acu
    WHERE acu.id_acuerdo_escrito=$id_acuerdo";
    $result3 = $catalogo->obtenerLista($consultaconvoca);
    while ($row = mysqli_fetch_array($result3)) {
    echo '<b style="font-weight: normal; margin-top: -100px; margin-bottom: 100px;">'.$row['des'].'</b>';
    }
    }
    ?>
</h7>
</div>
</div>
<br>
<center>
<table class="firmas" style="width: 100%">
  <tr>
    <th style="border: 1px solid black;" class="rotate"><h4>AREA</h4></th>
    <?php
    if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
    if($IDAcuerdoEdit != "0"){
    /*$consultaareas = "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre FROM c_area AS ar
      where ar.tipoArea=1 AND ar.estatus=1 limit 27";*/
    $consultaareas = "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre,
(SELECT Id_Area_invitada FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area and id_Acuerdo=$IDAcuerdoEdit) AS invitada,
(SELECT id_area FROM c_acuerdospdf WHERE id_area=ar.Id_Area and id_acuerdo_escrito=$IDAcuerdoEdit) AS convoca
FROM c_area AS ar
where ar.tipoArea=1 AND ar.estatus=1 limit 27";
    $resultareas = $catalogo->obtenerLista($consultaareas);
    while ($row1 = mysqli_fetch_array($resultareas)) {

    if ($row1['Id_Area'] == $row1['convoca']) {
        echo '<th style="border: 1px solid black; color: black; background-color: #D2B4DE;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>'; 
    }else{
        if ($row1['Id_Area'] == $row1['invitada']) {
            echo '<th style="border: 1px solid black; color: black; background-color: #F9E79F;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';  
        }else{
            echo '<th style="border: 1px solid black" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';
        }
    }
    
    }

    }else{

    
    $consultaareas = "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre,
(SELECT Id_Area_invitada FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area and id_Acuerdo=$id_acuerdo) AS invitada,
(SELECT id_area FROM c_acuerdospdf WHERE id_area=ar.Id_Area and id_acuerdo_escrito=$id_acuerdo) AS convoca
FROM c_area AS ar
where ar.tipoArea=1 AND ar.estatus=1 limit 27";
    $resultareas = $catalogo->obtenerLista($consultaareas);
    while ($row1 = mysqli_fetch_array($resultareas)) {

    if ($row1['Id_Area'] == $row1['convoca']) {
        echo '<th style="border: 1px solid black; color: black; background-color: #D2B4DE;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>'; 
    }else{
        if ($row1['Id_Area'] == $row1['invitada']) {
            echo '<th style="border: 1px solid black; color: black; background-color: #F9E79F;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';  
        }else{
            echo '<th style="border: 1px solid black" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';
        }
    }
    
    }

    }
    }else{
    if($IDAcuerdoEdit != "0"){
    $consultaareas = "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre,
(SELECT Id_Area_invitada FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area and id_Acuerdo=$IDAcuerdoEdit) AS invitada,
(SELECT id_area FROM c_acuerdospdf WHERE id_area=ar.Id_Area and id_acuerdo_escrito=$IDAcuerdoEdit) AS convoca
FROM c_area AS ar
where ar.tipoArea=1 AND ar.estatus=1 limit 27";
    $resultareas = $catalogo->obtenerLista($consultaareas);
    while ($row1 = mysqli_fetch_array($resultareas)) {

    if ($row1['Id_Area'] == $row1['convoca']) {
        echo '<th style="border: 1px solid black; color: black; background-color: #D2B4DE;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>'; 
    }else{
        if ($row1['Id_Area'] == $row1['invitada']) {
            echo '<th style="border: 1px solid black; color: black; background-color: #F9E79F;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';  
        }else{
            echo '<th style="border: 1px solid black" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';
        }
    }
    
    }

    }else{

$consultaareas = "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre,
(SELECT Id_Area_invitada FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area and id_Acuerdo=$id_acuerdo) AS invitada,
(SELECT id_area FROM c_acuerdospdf WHERE id_area=ar.Id_Area and id_acuerdo_escrito=$id_acuerdo) AS convoca
FROM c_area AS ar
where ar.tipoArea=1 AND ar.estatus=1 limit 27";
    $resultareas = $catalogo->obtenerLista($consultaareas);
    while ($row1 = mysqli_fetch_array($resultareas)) {

    if ($row1['Id_Area'] == $row1['convoca']) {
        echo '<th style="border: 1px solid black; color: black; background-color: #D2B4DE;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>'; 
    }else{
        if ($row1['Id_Area'] == $row1['invitada']) {
            echo '<th style="border: 1px solid black; color: black; background-color: #F9E79F;" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';  
        }else{
            echo '<th style="border: 1px solid black" class="rotate"><h4>'.$row1['nombre'].'</h4></th>';
        }
    }
    
    }

    }
    }
    ?>
    <!--<th style="border: 1px solid black" class="rotate"><h4>Dirección</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Jefa de oficina</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Relaciones públicas</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Proyectos especiales</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Sistemas</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Fotografía</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Subdirección técnica</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Indicadores</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Exhibición</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Registro y control de obra</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Mediación y Programas públicos</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Difusión</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Museografía</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Arquitectura</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Diseño</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Editorial</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Investigación</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Administración</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Programación y Presupuesto</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Recursos humanos</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Recursos financieros</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Recursos materiales</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Jurídico</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Seguridad</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>Custodios</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>AAMPBA</h4></th>
    <th style="border: 1px solid black" class="rotate"><h4>INBAL</h4></th>-->
  </tr>
  <?php
  if($IDAcuerdoEdit != "0"){

  //valida servidor consulta sie o kaluz
  if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
  $consultafirmas= "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre,(SELECT COUNT(*) FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area AND id_Acuerdo=$IDAcuerdoEdit) AS tiene,(SELECT firma FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area AND id_Acuerdo=$IDAcuerdoEdit) AS firma FROM c_area AS ar
      where ar.tipoArea=1 AND ar.estatus=1 limit 27";
  //echo $consultafirmas;

  $resultfirma = $catalogo->obtenerLista($consultafirmas);
  echo '<tr>';
  echo '<td style="border: 1px solid black" class="rotate"><h4>FIRMA</h4></td>';
  while ($row = mysqli_fetch_array($resultfirma)) {

    if ($row['Id_Area'] == $row['Id_Area']) {
        if ($row['firma'] == "") {
            echo '<td style="border: 1px solid black"></td>';
        }else{
            if (strpos($_SERVER['HTTP_HOST'], "administro") === false) {
       ?>
    <td style="border: 1px solid black"><img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/sie/vista/apps/AcuerdosEscritos/firmaspdf/<?php echo $row['firma'];?>" style="width:30px; height:30px;"></td>
    <?php
    }else{
    ?>
    <td style="border: 1px solid black"><img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/pruebassie/sie/vista/apps/AcuerdosEscritos/firmaspdf/<?php echo $row['firma'];?>" style="width:30px; height:30px;"></td>  
    <?php
    }
    }
    }
}
}else{
   $consultafirmas= "SELECT ar.Id_Area as Id_Area,ar.Nombre as nombre,(SELECT COUNT(*) FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area AND id_Acuerdo=$IDAcuerdoEdit) AS tiene,(SELECT firma FROM k_acuerdoarea WHERE id_Area_invitada=ar.Id_Area AND id_Acuerdo=$IDAcuerdoEdit) AS firma FROM c_area AS ar
      where ar.tipoArea=1 AND ar.estatus=1 limit 24";
  //echo $consultafirmas;

  $resultfirma = $catalogo->obtenerLista($consultafirmas);
  echo '<tr>';
  echo '<td style="border: 1px solid black" class="rotate"><h4>FIRMA</h4></td>';
  while ($row = mysqli_fetch_array($resultfirma)) {

    if ($row['Id_Area'] == $row['Id_Area']) {
        if ($row['firma'] == "") {
            echo '<td style="border: 1px solid black"></td>';
        }else{
       ?>
    <td style="border: 1px solid black"><img src="https://<?php echo $_SERVER['HTTP_HOST'];?>/sie/vista/apps/AcuerdosEscritos/firmaspdf/<?php echo $row['firma'];?>" style="width:30px; height:30px;"></td>
    <?php
    }
    }
}
}
echo '</tr>';
echo '</table>';
echo '</center>';
echo '<br>';
}else{
    if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
?>
  <tr>
    <td style="border: 1px solid black" class="rotate"><h4>FIRMA</h4></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
  </tr>
</table>
</center>
<?php
}else{
?>
<tr>
    <td style="border: 1px solid black" class="rotate"><h4>FIRMA</h4></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
    <td style="border: 1px solid black"></td>
  </tr>
</table>
</center>
<?php
}
}
?>
        </header>

        <footer>
            <div class="page-number"></div>
        </footer>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        <main>
            <?php
    $count = 0;
    $style = "";
    if($IDAcuerdoEdit != "0"){
    $consultaactividad = "SELECT concat(ej.idEje,'. ',ej.Nombre) as eje,caeje.descCategoria AS categoria,caejesub.descCategoria AS subcategoria, a.DescAcuerdo AS descripcion,a.TipoAcuerdo AS tipoacuerdo,
        a.resolucion AS resolucion, p.IdTipoActividad as tipoactividad,
        CONCAT(p.Numeracion,' ',p.Nombre) as NombreGlobal,
        CONCAT(o.Numeracion,' ',o.Nombre) as NombreGeneral,
        IF(a.estatus=1,'realizado','sin realizar') estatus, a.id_actividad1, a.id_actividad2, a.id_actividad3,a.id_actividad4,
        che.Nombre AS Checklist, subche.Nombre AS Subchecklist, a.firma
        FROM k_acuerdoactividad AS a
        LEFT JOIN c_actividad AS p ON p.IdActividad = a.id_actividad1
        LEFT JOIN c_actividad AS o ON o.IdActividad = a.id_actividad2
        LEFT JOIN c_eje AS ej ON ej.idEje=a.id_proyecto
        LEFT JOIN c_categoriasdeejes caeje ON caeje.idCategoria=a.id_categoria
        LEFT JOIN c_categoriasdeejes caejesub ON caejesub.idCategoria=a.id_subcategoria
        LEFT JOIN c_checkList che ON che.IdCheckList=a.Id_check
        LEFT JOIN c_checkList subche ON subche.IdCheckList=a.subcheck
        WHERE a.id_Acuerdo=$IDAcuerdoEdit";
    $resultfinal = $catalogo->obtenerLista($consultaactividad);
    while ($row = mysqli_fetch_array($resultfinal)) {
    if ($count == 1) {
    $style= "page-break-before: always;";
    }else{

    }
    echo '<center>';
    echo '<table class="tablaactividad" style="width: 100%; border: 1px solid black; page-break-inside: auto; '.$style.'">';
    echo '<tr>';
    echo '<th style="border: 1px solid black; width:40px;" >EJE</th>';
    //echo '<th style="border: 1px solid black" >META</th>';
    //echo '<th style="border: 1px solid black; color: white; background-color: black;" >ACTIVIDAD</th>';
    if ($row['tipoactividad'] == "2") {
        echo '<th style="border: 1px solid black; color: white; background-color: black; width:10px;">META</th>';
        echo '<th style="border: 1px solid black; width: 10px; width:10px;">ACTIVIDAD</th>';
    }else if ($row['tipoactividad'] == "1"){
        echo '<th style="border: 1px solid black; width: 10px;" >META</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: black; width: 10px;" >ACTIVIDAD</th>';
    }

    if($row['tipoacuerdo'] == "Conocimiento"){
        echo '<th style="border: 1px solid black;">PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: #a670f4;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "Solicitud"){
        echo '<th style="border: 1px solid black;">PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: #e0df2f;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';

    }else if($row['tipoacuerdo'] == "Sugerencia"){
        echo '<th style="border: 1px solid black;">PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: #b5b5b5;">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "Problemática"){
        echo '<th style="border: 1px solid black; color: white; background-color: #ff5454;" >PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "NULL"){
        echo '<th style="border: 1px solid black;" >PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';

    }
    echo '<th style="border: 1px solid black; width:190px;" >RESOLUCIÓN</th>';
    echo '<th style="border: 1px solid black; width:50px;">Firma</th>';
    echo '</tr>';

    echo '<tr>';
    echo '<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;">'.$row['eje'].'<br>'.$row['categoria'].'<br>'.$row['subcategoria'].'</td>';
    echo '<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;" colspan="2">'.$row['NombreGlobal'].'<br>'.$row['NombreGeneral'].'<br>'.$row['Checklist'].'<br>'.$row['Subchecklist'].'</td>';
    echo nl2br('<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;" colspan="4">'.$row['descripcion'].'</td>');
    //echo '<td style="border: 1px solid black" colspan="4">'.$row['descripcion'].'</td>';
    echo nl2br('<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;">'.$row['resolucion'].'</td>');
    if (strpos($_SERVER['HTTP_HOST'], "administro") === false) {
        if($row['firma'] == ""){
            echo nl2br('<td style="border: 1px solid RED; word-break:break-all; word-wrap:break-word;"> SIN FIRMA</td>');
        }else {
            echo nl2br('<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;"><img src="https://' . $_SERVER['HTTP_HOST'].'/sie/vista/apps/AcuerdosEscritos/firmaspdf/'. $row['firma'] .'" style="width:30px; height:30px;"></td>');
        }
       
    }  else {
        if($row['firma'] == ""){
            echo nl2br('<td style="border: 1px solid RED; word-break:break-all; word-wrap:break-word;"> SIN FIRMA</td>');
        }else {
            echo nl2br('<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;"><img src="https://' . $_SERVER['HTTP_HOST'].'/pruebassie/sie/vista/apps/AcuerdosEscritos/firmaspdf/'. $row['firma'] .'" style="width:30px; height:30px;"></td>');
        }
       
    }
    
    echo '</tr>';
    echo '</table>';
    echo '</center>';
    $count++;
     ?>
<?php
}
}else{
    $count1 = 0;
    $style = "";
    $consultaactividad = "SELECT concat(ej.idEje,'. ',ej.Nombre) as eje,caeje.descCategoria AS categoria,caejesub.descCategoria AS subcategoria, a.DescAcuerdo AS descripcion,a.TipoAcuerdo AS tipoacuerdo,
        a.resolucion AS resolucion, p.IdTipoActividad as tipoactividad,
        CONCAT(p.Numeracion,' ',p.Nombre) as NombreGlobal,
        CONCAT(o.Numeracion,' ',o.Nombre) as NombreGeneral,
        IF(a.estatus=1,'realizado','sin realizar') estatus, a.id_actividad1, a.id_actividad2, a.id_actividad3,a.id_actividad4,
        che.Nombre AS Checklist, subche.Nombre AS Subchecklist
        FROM k_acuerdoactividad AS a
        LEFT JOIN c_actividad AS p ON p.IdActividad = a.id_actividad1
        LEFT JOIN c_actividad AS o ON o.IdActividad = a.id_actividad2
        LEFT JOIN c_eje AS ej ON ej.idEje=a.id_proyecto
        LEFT JOIN c_categoriasdeejes caeje ON caeje.idCategoria=a.id_categoria
        LEFT JOIN c_categoriasdeejes caejesub ON caejesub.idCategoria=a.id_subcategoria
        LEFT JOIN c_checkList che ON che.IdCheckList=a.Id_check
        LEFT JOIN c_checkList subche ON subche.IdCheckList=a.subcheck
        WHERE a.id_Acuerdo=$id_acuerdo";
    $resultfinal = $catalogo->obtenerLista($consultaactividad);
    while ($row = mysqli_fetch_array($resultfinal)) {
    if ($count1 == 1) {
    $style= "page-break-before: always;";
    }
    echo '<center>';
    echo '<table class="tablaactividad" style="width: 100%; border: 1px solid black page-break-inside: auto; '.$style.'">';
    echo '<tr>';
    echo '<th style="border: 1px solid black; width:40px;" >EJE</th>';
    //echo '<th style="border: 1px solid black" >META</th>';
    //echo '<th style="border: 1px solid black; color: white; background-color: black;" >ACTIVIDAD</th>';
    if ($row['tipoactividad'] == "2") {
        echo '<th style="border: 1px solid black; color: white; background-color: black; width:10px;">META</th>';
        echo '<th style="border: 1px solid black; width: 10px;">ACTIVIDAD</th>';
    }else if ($row['tipoactividad'] == "1"){
        echo '<th style="border: 1px solid black; width:10px;" >META</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: black; width: 10px;" >ACTIVIDAD</th>';
    }
    if($row['tipoacuerdo'] == "Conocimiento"){
        echo '<th style="border: 1px solid black;">PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: #a670f4;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "Solicitud"){
        echo '<th style="border: 1px solid black">PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: #e0df2f;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "Sugerencia"){
        echo '<th style="border: 1px solid black;">PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black; color: white; background-color: #b5b5b5;">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "Problemática"){
        echo '<th style="border: 1px solid black; color: white; background-color: #ff5454;" >PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';
    }else if($row['tipoacuerdo'] == "NULL"){
        echo '<th style="border: 1px solid black;" >PROBLEMÁTICA</th>';
        echo '<th style="border: 1px solid black;">SOLICITUD</th>';
        echo '<th style="border: 1px solid black;">CONOCIMIENTO</th>';
        echo '<th style="border: 1px solid black;">SUGERENCIA</th>';

    }
    echo '<th style="border: 1px solid black; width:190px;" >RESOLUCIÓN</th>';
    echo '</tr>';

    echo '<tr>';
    echo '<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;">'.$row['eje'].'<br>'.$row['categoria'].'<br>'.$row['subcategoria'].'</td>';
    echo '<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;" colspan="2">'.$row['NombreGlobal'].'<br>'.$row['NombreGeneral'].'<br>'.$row['Checklist'].'<br>'.$row['Subchecklist'].'</td>';
    echo nl2br('<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;" colspan="4">'.$row['descripcion'].'</td>');
    //echo '<td style="border: 1px solid black" colspan="4">'.$row['descripcion'].'</td>';
    echo nl2br('<td style="border: 1px solid black; word-break:break-all; word-wrap:break-word;">'.$row['resolucion'].'</td>');
    echo '</tr>';
    echo '</table>';
    echo '</center>';
    $count1++;
}
}
?>
</main>
</body>
</html>
<?php
//echo $consultaultimoregistro;
//echo $consultafecha;
//echo $consultaconvoca;
//echo $consultaeje;
//echo $consultaactividad;

$html=ob_get_clean();
//echo $html;
include_once('libreria/dompdf/autoload.inc.php');
//require_once('/libreria/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

//$dompdf->loadhtml('Hola PDF');
$dompdf->loadhtml($html);

//$dompdf->setPaper('letter');
$dompdf->setPaper('A4','landscape');

$dompdf->render();

//$dompdf->stream("archivo.pdf",array("Attachment" => false));
if($IDAcuerdoEdit != "0"){
$valorpdf="";
$urladjuntopdf="";
file_put_contents("../../../resources/aplicaciones/PDF/AcuerdosEscritos/".$IDAcuerdoEdit.date("H:i:s").".pdf", $dompdf->output());

$extension = $IDAcuerdoEdit.date("H:i:s").".pdf";
//echo $extension;
$consulta = "UPDATE c_acuerdospdf SET pdfid = '".$extension."' where id_acuerdo_escrito=$IDAcuerdoEdit";
//echo $consulta;
$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_acuerdospdf', 'id_acuerdo_escrito = ' . $IDAcuerdoEdit);

//url de pdf adjunto
$adjuntopdf ="SELECT pdf FROM c_acuerdospdf WHERE id_acuerdo_escrito=".$IDAcuerdoEdit;
$resultadjuntopdf = $catalogo->obtenerLista($adjuntopdf);
while ($rowadjuntopdf = mysqli_fetch_array($resultadjuntopdf)) {
      $valorpdf=$rowadjuntopdf['pdf'];
    }
$url = "Alta_acuerdo.php?accion=editar&id=".$IDAcuerdoEdit."&usuario=SinUsr&tipoPerfil=1&nombreUsuario=".$MiNomUsr."&idUsuario=".$IdUser."&portada=1&tipo_acuerdo=&ejeid=&tipoPerfil=1";

//pruebas para abrir ventana emergente
if (strpos($_SERVER['HTTP_HOST'], "administro") === false) {
//kaluz para abrir ventana emergente
    if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
        //sie
        $irpdf= "https://siemuseo.com/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$IDAcuerdoEdit.date("H:i:s").".pdf";
        $urladjuntopdf= "https://siemuseo.com/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$valorpdf.date("H:i:s")."";
    }else{
        $irpdf= "https://siekaluz.com/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$IDAcuerdoEdit.date("H:i:s").".pdf";
        $urladjuntopdf= "https://siekaluz.com//sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$valorpdf.date("H:i:s")."";
    }
}else{
$irpdf= "https://administro.mx/pruebassie/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$IDAcuerdoEdit.date("H:i:s").".pdf";
$urladjuntopdf= "https://administro.mx/pruebassie/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$valorpdf.date("H:i:s")."";
}
?>
<script type="text/javascript">
    <?php
    echo 'window.open("'.$irpdf.'", "_blank");';
    if ($valorpdf != "") {
    echo 'window.open("'.$urladjuntopdf.'", "_blank");';
    }else{
    }
   // echo 'window.location.href = "'.$url.'" ';
    ?>
</script>
<?php
}else{
$valorpdf1="";
$urladjuntopdf1="";
file_put_contents("../../../resources/aplicaciones/PDF/AcuerdosEscritos/".$id_acuerdo.date("H:i:s").".pdf", $dompdf->output());

$extension = $id_acuerdo.date("H:i:s").".pdf";
//echo $extension;
$consulta = "UPDATE c_acuerdospdf SET pdfid = '".$extension."' where id_acuerdo_escrito=$id_acuerdo";
//echo $consulta;
$query = $catalogo->ejecutaConsultaActualizacion($consulta, 'c_acuerdospdf', 'id_acuerdo_escrito = ' . $id_acuerdo);

$adjuntopdf1 ="SELECT pdf FROM c_acuerdospdf WHERE id_acuerdo_escrito=".$id_acuerdo;
$resultadjuntopdf1 = $catalogo->obtenerLista($adjuntopdf1);
while ($rowadjuntopdf1 = mysqli_fetch_array($resultadjuntopdf1)) {
      $valorpdf1=$rowadjuntopdf1['pdf'];
    }
$urlnuevo = "Alta_acuerdo.php?accion=editar&id=".$id_acuerdo."&usuario=SinUsr&tipoPerfil=1&nombreUsuario=".$MiNomUsr."&idUsuario=".$IdUser."&portada=1&tipo_acuerdo=&ejeid=&tipoPerfil=1";

//pruebas para abrir ventana emergente
if (strpos($_SERVER['HTTP_HOST'], "administro") === false) {
//kaluz para abrir ventana emergente
    if (strpos($_SERVER['HTTP_HOST'], "kaluz") === false) {
        //sie
        $irpdfnuevo= "https://siemuseo.com/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$id_acuerdo.date("H:i:s"). ".pdf";
        $urladjuntopdf1= "https://siemuseo.com/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$valorpdf1.date("H:i:s")."";
    }else{
        $irpdfnuevo= "https://siekaluz.com/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$id_acuerdo.date("H:i:s").".pdf";
        $urladjuntopdf1= "https://siekaluz.com//sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$valorpdf1."";
    }
}else{
$irpdfnuevo= "https://administro.mx/pruebassie/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$id_acuerdo.date("H:i:s").".pdf";
$urladjuntopdf1= "https://administro.mx/pruebassie/sie/resources/aplicaciones/PDF/AcuerdosEscritos/".$valorpdf1.date("H:i:s")."";
}

//echo $irpdfnuevo;
?>
<script type="text/javascript">
    <?php
    echo 'window.open("'.$irpdfnuevo.'", "_blank");';
    if ($valorpdf1 != "") {
    echo 'window.open("'.$urladjuntopdf1.'", "_blank");';
    }else{
    }
  //  echo 'window.location.href = "'.$urlnuevo.'" ';
    ?>
</script>
<?php
}
?>
<br><br><br>
<!--<div class="footer">
  <p>Pie de pagina</p>
</div>-->

</body>
</html>
