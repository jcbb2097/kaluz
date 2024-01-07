<?php

/*if ((!isset($_COOKIE['user']) || $_COOKIE['user'] == "") || (!isset($_COOKIE['IdSession']) || strlen($_COOKIE['IdSession']) != 15)) {
    header("Location: ../../../index.php");
}*/
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

include_once '../../Classes/Catalogo.class.php';
$catalogo = new Catalogo();

if(isset($_POST['anio']) && $_POST['anio'] != "" && isset($_POST['nivel']) && $_POST['nivel'] == 1){
    
    $consultaAreas = "SELECT IdArea,Nombre FROM c_area;";
    $resultConsultaAreas = $catalogo->obtenerLista($consultaAreas);
    $orden = 1;
    $total = 0;
    $between = "(FechaCreacion between '".$_POST['anio']."-01-01 00:00:00' and '".$_POST['anio']."-12-31 23:59:59')";
    $areasGrafica = array();
    $totalGrafica = array ();
    
    echo '<table width="400" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
	<tr class="titulo_tabla" align="center"> 
    <td>Orden</td>
	<td colspan="2" >Acuerdos Enviados por Área/Empleado/Clasificación</td>
</tr>';
    
    while ($row = mysqli_fetch_array($resultConsultaAreas)) {
        echo '<tr>';
    echo '<td class="contenido_tabla">'.$orden.'</td>';
	echo '<td class="contenido_tabla"><a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'indicadores/AcuerdosEnviadosPorAreaDetalle.php?area='.$row['IdArea'].'&nombre='.$row['Nombre'].'\');">'.$row['Nombre'].'</a></td>';
        array_push($areasGrafica, $row['Nombre']);
        $consultaTotal= 'SELECT COUNT(IdAreaCreaAcuerdo) as total FROM c_acuerdo WHERE IdAreaCreaAcuerdo = '.$row['IdArea'].' AND '.$between.';';
        $resultConsultaTotal = $catalogo->obtenerLista($consultaTotal);
        while ($row1 = mysqli_fetch_array($resultConsultaTotal)) {
           echo '<td class="contenido_tabla" align="center">'.$row1['total'].'</td>';
           $total = $total + $row1['total'];
           array_push($totalGrafica, $row1['total']);
        }
        $orden++;
       echo '</tr>';
    }
    
    echo '<tr class="titulo_tabla" align="center">';
    echo '<td colspan="2">Total</td><td>'.$total.'</td>';
    echo '</tr>';
    
    echo '</table>';
    echo '<br>';
    
    $areas = "";
    $totales = "";
     for($i=0;$i<count($areasGrafica);$i++){
         $areas = $areas."'".$areasGrafica[$i]."'";
         if($i+1< count($areasGrafica)){
             $areas = $areas.",";
         }
     }
     
      for($i=0;$i<count($totalGrafica);$i++){
         $totales = $totales.$totalGrafica[$i];
         if($i+1< count($totalGrafica)){
             $totales = $totales.",";
         }
     }
     
        
        echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Acuerdos Enviados por Área/Empleado/Clasificación ".$_POST['anio']."'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: [".$areas."]
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Acuerdos enviados',
        data: [".$totales."]
    }]
});</script>";
        
        
}else if(isset($_POST['anio']) && $_POST['anio'] != "" && isset($_POST['nivel']) && $_POST['nivel'] == 2){
    $consultaEmpleados = "SELECT IdEquipoTrabajo,Nombre,APaterno,AMaterno,IdArea FROM c_equipoTrabajo WHERE IdArea = ".$_POST['idArea'].";";
    $resultConsultaEmpleados = $catalogo->obtenerLista($consultaEmpleados);
    $orden = 1;
    $total = 0;
    $between = "(a.FechaCreacion between '".$_POST['anio']."-01-01 00:00:00' and '".$_POST['anio']."-12-31 23:59:59')";
    $empGrafica = array();
    $totalGrafica = array ();
    
    echo '<table width="400" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
	<tr class="titulo_tabla" align="center"> 
    <td>Empleado</td>
    <td></td>
	<td colspan="2" >Acuerdos Enviados</td>
</tr>';
    
    while ($row2 = mysqli_fetch_array($resultConsultaEmpleados)) {
         echo '<tr>';
    echo '<td class="contenido_tabla">'.$orden.'</td>';
	echo '<td class="contenido_tabla"><a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'indicadores/AcuerdosEnviadosPorEmpleadoDetalle.php?area='.$_POST['idArea'].'&idEquipoTrabajo='.$row2['IdEquipoTrabajo'].'&nombre='.str_replace(' ', '.',$row2['Nombre']).'&paterno='.str_replace(' ', '.',$row2['APaterno']).'&materno='.str_replace(' ', '.',$row2['AMaterno']).'&nombreArea='.$_POST['nombreArea'].'\');">'.$row2['Nombre'].' '.$row2['APaterno'].' '.$row2['AMaterno'].'</a></td>';
        array_push($empGrafica, $row2['Nombre'].' '.$row2['APaterno'].' '.$row2['AMaterno']);
        $consultaTotal= 'SELECT COUNT(IdAcuerdo) AS total FROM c_acuerdo AS a LEFT JOIN c_usuario AS u ON a.IdUsuario = u.IdUsuario LEFT JOIN c_equipoTrabajo AS e ON u.IdEquipoTrabajo = e.IdEquipoTrabajo WHERE u.IdEquipoTrabajo = '.$row2['IdEquipoTrabajo'].' AND a.IdAreaCreaAcuerdo = e.IdArea AND '.$between.';';
        //echo $consultaTotal;
        $resultConsultaTotal = $catalogo->obtenerLista($consultaTotal);
        while ($row1 = mysqli_fetch_array($resultConsultaTotal)) {
           echo '<td class="contenido_tabla" align="center">'.$row1['total'].'</td>';
           $total = $total + $row1['total'];
           array_push($totalGrafica, $row1['total']);
        }
        $orden++;
       echo '</tr>';
    }
    echo '<tr class="titulo_tabla" align="center">';
    echo '<td colspan="2">Total</td><td>'.$total.'</td>';
    echo '</tr>';
    
    echo '</table>';
    echo '<br>';
    
    $emp = "";
    $totales = "";
     for($i=0;$i<count($empGrafica);$i++){
         $emp = $emp."'".$empGrafica[$i]."'";
         if($i+1< count($empGrafica)){
             $emp = $emp.",";
         }
     }
     
      for($i=0;$i<count($totalGrafica);$i++){
         $totales = $totales.$totalGrafica[$i];
         if($i+1< count($totalGrafica)){
             $totales = $totales.",";
         }
     }
     
        echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Acuerdos Enviados por ".$_POST['nombreArea']." en el año ".$_POST['anio']."'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: [".$emp."]
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Acuerdos enviados',
        data: [".$totales."]
    }]
});</script>";
    
}else if(isset($_POST['anio']) && $_POST['anio'] != "" && isset($_POST['nivel']) && $_POST['nivel'] == 3){
    
     $consultaTipos = "SELECT IdTipoAcuerdo,Nombre FROM c_tipoAcuerdo;";
    $resultConsultaTipos = $catalogo->obtenerLista($consultaTipos);
    $orden = 1;
    $total = 0;
    $between = "(a.FechaCreacion between '".$_POST['anio']."-01-01 00:00:00' and '".$_POST['anio']."-12-31 23:59:59')";
    $tiposGrafica = array();
    $totalGrafica = array ();
    
    echo '<table width="400" border="1" bordercolorlight="#999999" cellpadding="0" cellspacing="0">
	<tr class="titulo_tabla" align="center"> 
    <td>Clasificación</td>
    <td></td>
	<td colspan="2" >Acuerdos Enviados</td>
</tr>';
    
    while ($row2 = mysqli_fetch_array($resultConsultaTipos)) {
         echo '<tr>';
    echo '<td class="contenido_tabla">'.$orden.'</td>';
	echo '<td class="contenido_tabla"><a style="cursor:pointer;" onclick="cambiarContenidos(\'#contenidos\',\'indicadores/AcuerdosEnviadosPorClasificacionDetalle.php?tipoAcuerdo='.$row2['IdTipoAcuerdo'].'&nombreAcuerdo='.$row2['Nombre'].'&idArea='.$_POST['idArea'].'&equipoTrabajo='.$_POST['idEmp'].'&nombreEmp='.$_POST['nombreEmp'].'&nombreArea='.$_POST['nombreArea'].'\');">'.$row2['Nombre'].'</a></td>';
        array_push($tiposGrafica, $row2['Nombre']);
        $consultaTotal= 'SELECT COUNT(IdAcuerdo) AS total FROM c_acuerdo AS a LEFT JOIN c_tipoAcuerdo AS t ON t.IdTipoAcuerdo = a.IdTipoAcuerdo LEFT JOIN c_usuario AS u ON a.IdUsuario = u.IdUsuario LEFT JOIN c_equipoTrabajo AS e
        ON e.IdEquipoTrabajo = u.IdEquipoTrabajo WHERE e.IdEquipoTrabajo = '.$_POST['idEmp'].' AND a.IdAreaCreaAcuerdo = '.$_POST['idArea'].' AND t.IdTipoAcuerdo = '.$row2['IdTipoAcuerdo'].' AND '.$between.';';
        //echo $consultaTotal;
        $resultConsultaTotal = $catalogo->obtenerLista($consultaTotal);
        while ($row1 = mysqli_fetch_array($resultConsultaTotal)) {
           echo '<td class="contenido_tabla" align="center">'.$row1['total'].'</td>';
           $total = $total + $row1['total'];
           array_push($totalGrafica, $row1['total']);
        }
        $orden++;
       echo '</tr>';
    }
    echo '<tr class="titulo_tabla" align="center">';
    echo '<td colspan="2">Total</td><td>'.$total.'</td>';
    echo '</tr>';
    
    echo '</table>';
    echo '<br>';
    
    $tipos = "";
    $totales = "";
     for($i=0;$i<count($tiposGrafica);$i++){
         $tipos = $tipos."'".$tiposGrafica[$i]."'";
         if($i+1< count($tiposGrafica)){
             $tipos = $tipos.",";
         }
     }
     
      for($i=0;$i<count($totalGrafica);$i++){
         $totales = $totales.$totalGrafica[$i];
         if($i+1< count($totalGrafica)){
             $totales = $totales.",";
         }
     }
    
    
             echo "<script>Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Acuerdos Enviados por ".$_POST['nombreEmp']." en el año ".$_POST['anio']."'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: [".$tipos."]
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Acuerdos enviados',
        data: [".$totales."]
    }]
});</script>";
     
}else if(isset($_POST['anio']) && $_POST['anio'] != "" && isset($_POST['nivel']) && $_POST['nivel'] == 4){
    
    $between = "(a.FechaCreacion between '".$_POST['anio']."-01-01 00:00:00' and '".$_POST['anio']."-12-31 23:59:59')";
     $consultaComentarios = 'SELECT a.Descripcion,ar.Nombre AS area,p.Nombre AS proyecto,a.IdConcepto FROM c_acuerdo AS a LEFT JOIN c_area AS ar ON a.IdArea = ar.IdArea 
LEFT JOIN c_proyecto AS p ON a.IdProyecto = p.IdProyecto
LEFT JOIN c_concepto AS c ON a.IdConcepto = c.IdConcepto  LEFT JOIN c_tipoAcuerdo AS t ON t.IdTipoAcuerdo = a.IdTipoAcuerdo '
             . 'LEFT JOIN c_usuario AS u ON a.IdUsuario = u.IdUsuario LEFT JOIN c_equipoTrabajo AS e ON e.IdEquipoTrabajo = u.IdEquipoTrabajo WHERE e.IdEquipoTrabajo = '.$_POST['idEmp'].' AND a.IdAreaCreaAcuerdo = '.$_POST['idArea'].' AND t.IdTipoAcuerdo = '.$_POST['tipoAcuerdo'].' AND '.$between.';';
    $resultConsultaComentarios = $catalogo->obtenerLista($consultaComentarios);
    //echo $consultaComentarios;
    
    echo '<table width=100% border="0" cellspacing="2" cellpadding="0" align="center">

  <tr bgcolor="black">
  <td height="15" bgcolor="#666666">
    <font color="#D8D8D8" class="verdana10 Estilo3">Acuerdos Enviados </font> </td>
    

  <td height="15" bgcolor="#666666" colspan="4">
    <font color="#D8D8D8" class="verdana10 Estilo3">Miembro que env&iacute;a </font> </td>
 </tr>
    <tr bgcolor="white">  
    <td ><font class="verdana10">Comentarios</font></span></td>
    <td ><font class="verdana10">Miembro destino</font></span></td>
    <td ><font class="verdana10">Actividad general</font></span></td>
    <td ><font class="verdana10">Actividad particular</font></span></td>
    <td ><font class="verdana10">Subactividad</font></span></td>
  </tr>';
    $blanco = "white";
    $gris = "#D0D3D4";
    $color = 2;
    while ($row3 = mysqli_fetch_array($resultConsultaComentarios)) {
        if($color % 2 == 0){
        echo '<tr bgcolor="'.$blanco.'">';    
        }else{
            echo '<tr bgcolor="'.$gris.'">';
        }
          
        echo' <td ><font class="verdana10">'.$row3['Descripcion'].'</font></span></td>';
                
        if($row3['area'] != null  && $row3['area'] != ""){
          echo  '<td ><font class="verdana10">'.$row3['area'].'</font></span></td>';
        }else{
          echo  '<td ><font class="verdana10">'.$row3['proyecto'].'</font></span></td>';  
        }
        
        $actividadGeneral = "";
        $actividadParticular = "";
        $subactividad = "";
        
        $consultaConceptos = "SELECT Nombre,IdNivelConcepto,IdConceptoSuperior FROM c_concepto WHERE IdConcepto = ".$row3['IdConcepto'];
        //echo $consultaConceptos;
        $resultConsultaConceptos = $catalogo->obtenerLista($consultaConceptos);
        
        while ($row4 = mysqli_fetch_array($resultConsultaConceptos)) {
                if($row4['IdNivelConcepto'] == 2){
                        $actividadGeneral = $row4['Nombre'];
                }else if($row4['IdNivelConcepto'] == 3){
                        $actividadParticular = $row4['Nombre'];
                }else if($row4['IdNivelConcepto'] == 5){
                        $subactividad = $row4['Nombre'];
                }
                
                if($row4['IdConceptoSuperior'] != null && $row4['IdConceptoSuperior'] != "" ){
                    $consultaPadre = "SELECT Nombre,IdNivelConcepto,IdConceptoSuperior FROM c_concepto WHERE IdConcepto = ".$row4['IdConceptoSuperior'];
                     $resultPadre = $catalogo->obtenerLista($consultaPadre);
                     while ($row5 = mysqli_fetch_array($resultPadre)) {
                                    if($row5['IdNivelConcepto'] == 2){
                                   $actividadGeneral = $row5['Nombre'];
                                        }else if($row5['IdNivelConcepto'] == 3){
                                                $actividadParticular = $row5['Nombre'];
                                        }else if($row5['IdNivelConcepto'] == 5){
                                                $subactividad = $row5['Nombre'];
                                        }
                     }
                     
                     if($row5['IdConceptoSuperior'] != null && $row5['IdConceptoSuperior'] != ""){
                         
                         $consultaPadre2 = "SELECT Nombre,IdNivelConcepto,IdConceptoSuperior FROM c_concepto WHERE IdConcepto = ".$row5['IdConceptoSuperior'];
                         $resultPadre2 = $catalogo->obtenerLista($consultaPadre2);
                         while ($row6 = mysqli_fetch_array($resultPadre2)) {
                             if($row6['IdNivelConcepto'] == 2){
                                   $actividadGeneral = $row6['Nombre'];
                                        }else if($row6['IdNivelConcepto'] == 3){
                                                $actividadParticular = $row6['Nombre'];
                                        }else if($row6['IdNivelConcepto'] == 5){
                                                $subactividad = $row6['Nombre'];
                                        }
                         }
                     }
                  
                    }
                    

            }
        
        
            echo '<td ><font class="verdana10">'.$actividadGeneral.'</font></span></td>
            <td ><font class="verdana10">'.$actividadParticular.'</font></span></td>
            <td ><font class="verdana10">'.$subactividad.'</font></span></td>
          </tr>';
            $color++;
    }
    echo '</table>';
}