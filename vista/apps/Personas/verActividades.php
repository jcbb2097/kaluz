<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombre = isset($_GET['accion']) ? $_GET['accion'] : null;
include_once("../../../WEB-INF/Classes/Personas.class.php");

$MiPersona = isset($_GET['idPer']) ? $_GET['idPer'] : null;

$Aplicacion="Personas";
$MiTipoPerfil=1;//Si no trae parametros de usr le pone estos por default, pero si los trae los usa de los parametros GET
$MiIdUsr=999;
$MiNomUsr="SinUsr";
if ((isset($_GET['tipoPerfil']) && $_GET['tipoPerfil'] != ""))          { $MiTipoPerfil=$_GET['tipoPerfil']; }
if ((isset($_GET['idUsuario']) && $_GET['idUsuario'] != ""))            { $MiIdUsr=     $_GET['idUsuario']; }
if ((isset($_GET['nombreUsuario']) && $_GET['nombreUsuario'] != ""))    { $MiNomUsr=    $_GET['nombreUsuario']; }
$MiNomUsr=str_replace(" ", "%20", $MiNomUsr);
$MisParam="tipoPerfil=".$MiTipoPerfil."&idUsuario=".$MiIdUsr."&nombreUsuario=".$MiNomUsr; //Para pasar parametros a la siguiente liga

$AnioActual=date("Y"); //Año actual para mostrar por default
$AnioActual=date("2020");
$VarWhere= " ";

$FiltroAnio=" ";
if (isset($_GET['F_IdAnio']) && $_GET['F_IdAnio'] != "")
{
    if ($_GET['F_IdAnio']=="Sin información")
        { $FiltroAnio= " "; }
    elseif ($_GET['F_IdAnio']=="Todos") //Para todos los años
        { $FiltroAnio= " "; }
    else { $FiltroAnio= " AND pa.AnioLaborado=".$AnioActual." "; }
}

$FiltroEje=""; //Se inicializa la variable
if ((isset($_GET['F_IdEje']) && $_GET['F_IdEje'] != "")) //Si el parametro existe se procesa
{   if ($_GET['F_IdEje']!="0") {$FiltroEje =" AND p.idEje=".$_GET['F_IdEje'];} //Si el parametro es diferente de 0 se busca el valor
    else {  $FiltroEje="  AND isnull(p.idEje)"; } //Si el parametro es igual a 0 se buscan los NULOS
}

$FiltroArea="";
if ((isset($_GET['F_IdArea']) && $_GET['F_IdArea'] != ""))
{   if ($_GET['F_IdArea']!="0") {$FiltroArea =" AND p.idArea=".$_GET['F_IdArea'];}
    else {  $FiltroArea=" AND isnull(p.idArea)"; }
}

$FiltroClasif="";
if ((isset($_GET['F_IdClasif']) && $_GET['F_IdClasif'] != ""))
{   if ($_GET['F_IdClasif']!="0") {$FiltroClasif =" AND ce.IdClasificacionEmpleado=".$_GET['F_IdClasif'];}
    else {  $FiltroClasif="  AND isnull(ce.IdClasificacionEmpleado)"; }
}

$FiltroTipo="";
if ((isset($_GET['F_IdTipoCont']) && $_GET['F_IdTipoCont'] != ""))
{   if ($_GET['F_IdTipoCont']!="0") {$FiltroTipo =" AND p.id_TipoPersona=".$_GET['F_IdTipoCont'];}
    else {  $FiltroTipo="  AND isnull(p.id_TipoPersona)"; }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />


    <title>::.PERSONAS.::</title>
    <style>
  	.cuerpo {
      width: 100%;
      height: 350px;
      border: none;
  }

  	</style>
</head>
<body>
        <div class="container-fluid">
          <?php
              $cont_act = 0;
              $insumos = 0;
              $usado_c_insumo = 0;
              $array_ejes_act = array();
              $array_ejes_insumos = array();
              $array_act_insumos = array();

              $array_ejes_usados_insumos = array();
              $array_act_usados_insumos = array();
              $consulta ="SELECT   concat(p.Nombre, ' ',p.Apellido_Paterno) AS responsable,
      										ar.Nombre AS NombreArea FROM c_personas p
      										LEFT JOIN c_area ar ON p.idArea=ar.Id_Area
      										WHERE p.id_Personas = $MiPersona ";
                        $result = $catalogo->obtenerLista($consulta);
                    while ($row = mysqli_fetch_array($result)){
                      $responsable = $row["responsable"];
                      $area = $row["NombreArea"];
                    }
                     ?>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size: .9em;">
            <p id="indicadores_1"><b>Responsable : </b><?php echo $responsable; ?></p>
            <p id="indicadores_2"><b>Insumos  </b></p>
            <p id="indicadores_3"><b>Entregables  </b></p>
            <p><b>Área : </b><?php echo $area; ?></p>
          </div>
          </div>
            <div class="row" style="overflow: auto;height: 550px;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <table id="tPersonas" class="table table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>Insumos</th>
							<th>Actividades</th>
							<th>Usado como insumo por</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $consulta = "  SELECT

							(
							SELECT GROUP_CONCAT(
              act3.IdEje,'|',are3.Nombre,'|',
							'INSUMO: ',insumo.Nombre,
							'<BR>',act3.Numeracion,act3.Nombre,
							'<b><BR>[',are3.Nombre,']</b>',
							'<BR><p style=\"color : blue\">[',per3.Nombre,' ',per3.Apellido_Paterno,']</p>'
							SEPARATOR '<BR>')

							FROM k_entregableinsumo kei2
							JOIN c_entregable ent2 ON ent2.IdEntregable=kei2.IdEntregable
							JOIN c_actividad act2 ON act2.IdActividad=ent2.idActividad
							JOIN c_entregable insumo ON insumo.IdEntregable=kei2.IdInsumo
							JOIN c_actividad act3 ON act3.IdActividad=insumo.idActividad
							JOIN c_area are3 ON are3.Id_Area=act3.IdArea
							JOIN c_personas per3 ON per3.id_Personas=act3.IdResponsable
							WHERE act2.IdActividad=a.IdActividad
							GROUP BY kei2.IdEntregable
            )AS Insumos,a.IdEje,


							concat('<b>',a.Numeracion,' ',a.Nombre,(case a.cap3000 WHEN 1 then '[EN CONTRATO]' WHEN 2 then '[EN CONTRATO Y SIE]' ELSE '' END),'</b>') as miAct,  concat(p.Nombre, ' ',p.Apellido_Paterno) AS responsable,
										ar.Nombre AS NombreArea,CONCAT(a.Numeracion,' ',a.Nombre) AS descact ,en.IdEntregable,tiene_archivo(a.IdActividad) AS tiene_archivo,
										CASE when (LOCATE(' ',en.Nombre)>0 AND LOCATE(' ',en.Nombre)<20 ) THEN en.Nombre ELSE LEFT(en.Nombre,30) END  AS NombreEntregable,

										(
										SELECT GROUP_CONCAT(act.IdEje,'|',are.Nombre,'|',act.Numeracion,act.Nombre,'<BR><b>[',are.Nombre,']</b>','<BR><p style=\"color : blue\">[',per.Nombre,' ',per.Apellido_Paterno,']</p>'  SEPARATOR '<BR>')
										FROM k_entregableinsumo kei
										JOIN c_entregable ent ON ent.IdEntregable=kei.IdEntregable
										JOIN c_actividad act ON act.IdActividad=ent.idActividad
										JOIN c_area are ON are.Id_Area=act.IdArea
										JOIN c_personas AS per ON per.id_Personas=act.IdResponsable
										WHERE kei.IdInsumo=en.IdEntregable
										GROUP by kei.IdInsumo
										) AS UsadoComoInsumo, a.cap3000

										FROM c_actividad a
										JOIN c_personas p ON p.id_Personas=a.IdResponsable
										LEFT JOIN c_area ar ON ar.Id_Area=a.IdArea
										LEFT JOIN c_entregable en ON en.idActividad=a.IdActividad
										WHERE a.idTipoActividad=1 and a.anio=2020 AND a.idEje<12 and a.IdResponsable='.$MiPersona.'
                            ";
                           // echo $consulta;
                            $ValUser = "'".$MiNomUsr."'";
                            $resultPersonas=$catalogo->obtenerLista($consulta);
                        while ($rowPersonas = mysqli_fetch_array($resultPersonas)) {

                            $cont_act++;
                            $insumos_texto = "";
                            $icono = "";
                            $UsadoComoInsumo = "";
                            $insumos += substr_count($rowPersonas['Insumos'],'INSUMO:');//cuenta insumos

                            if(!in_array($rowPersonas['IdEje'],$array_ejes_act))//verificar eje de act
                                array_push($array_ejes_act,$rowPersonas['IdEje']);

                            $usado_c_insumo += substr_count($rowPersonas['UsadoComoInsumo'],'<b>');//cuenta usados como insumo


                            if(isset($rowPersonas['Insumos']) && $rowPersonas['Insumos'] != ""){
                              $insumos_datos = explode("</p><BR>",$rowPersonas['Insumos']);
                              foreach($insumos_datos as $insumo){
                                $insumos_datos = explode("|",$insumo);
                                if(!in_array($insumos_datos[0],$array_ejes_insumos))//verificar eje de insumo
                                    array_push($array_ejes_insumos,$insumos_datos[0]);

                                if(!in_array($insumos_datos[1],$array_act_insumos))//verificar act de insumo
                                    array_push($array_act_insumos,$insumos_datos[1]);
                                $insumos_texto .=  $insumos_datos[2]."</p><BR>";
                              }

                            }
                            if(isset($rowPersonas['UsadoComoInsumo']) && $rowPersonas['UsadoComoInsumo'] != ""){
                              $usados_insumos_datos = explode("</p><BR>",$rowPersonas['UsadoComoInsumo']);
                              foreach($usados_insumos_datos as $insumo){
                                $usados_insumos_datos = explode("|",$insumo);
                                if(!in_array($usados_insumos_datos[0],$array_ejes_usados_insumos))//verificar eje de insumo
                                    array_push($array_ejes_usados_insumos,$usados_insumos_datos[0]);

                                if(!in_array($usados_insumos_datos[1],$array_act_usados_insumos))//verificar act de insumo
                                    array_push($array_act_usados_insumos,$usados_insumos_datos[1]);
                                $UsadoComoInsumo .=  $usados_insumos_datos[2]."</p><BR>";
                              }

                            }

                            //
                            if($rowPersonas['tiene_archivo'] == 1)
                              $icono = '<i style="cursor:pointer;" class="fas fa-folder-open" onclick="muestra_entregables('.$rowPersonas['IdEntregable'].',\''.$rowPersonas['descact'].'\',\''.$rowPersonas['NombreEntregable'].'\')"></i>';
                            echo '<tr>';
                            echo '<td>'.str_replace("_"," ",$insumos_texto).'</td>';
										//Si es capitulo 3000 pone fondo cyan
										if ($rowPersonas['cap3000']=='1') {echo '<td style="background:cyan;" >'.$rowPersonas['miAct'].' <br> ENTREGABLE: '.$rowPersonas['NombreEntregable'].$icono.'</td>';}
										elseif ($rowPersonas['cap3000']=='2') {echo '<td style="background:orange;" >'.$rowPersonas['miAct'].' <br> ENTREGABLE: '.$rowPersonas['NombreEntregable'].$icono.'</td>';}
										else {echo '<td>'.$rowPersonas['miAct'].' <br> ENTREGABLE: '.$rowPersonas['NombreEntregable'].$icono.'</td>';}

              							echo '<td>'.str_replace("_"," ",$UsadoComoInsumo).'</td>';
                            echo '</tr>';
                        }
                        sort($array_ejes_act);
                        sort($array_ejes_insumos);
                        ?>
                    </tbody>
                </table>

				</div>
            </div>
            <input type="hidden" id="total" value="<?php echo $cont_act; ?>">
            <input type="hidden" id="insumos" value="<?php echo $insumos; ?>">
            <input type="hidden" id="usado_c_insumo" value="<?php echo $usado_c_insumo; ?>">
            <input type="hidden" id="ejes_act_num" value="<?php echo count($array_ejes_act); ?>">
            <input type="hidden" id="ejes_act" value="<?php echo implode(', ',$array_ejes_act); ?>">
            <input type="hidden" id="ejes_ins_num" value="<?php echo count($array_ejes_insumos); ?>">
            <input type="hidden" id="ejes_ins" value="<?php echo implode(', ',$array_ejes_insumos); ?>">
            <input type="hidden" id="act_ins_num" value="<?php echo count($array_act_insumos); ?>">
            <input type="hidden" id="act_ins" value="<?php echo implode(', ',$array_act_insumos); ?>">

            <input type="hidden" id="ejes_us_ins_num" value="<?php echo count($array_ejes_usados_insumos); ?>">
            <input type="hidden" id="ejes_us_ins" value="<?php echo implode(', ',$array_ejes_usados_insumos); ?>">
            <input type="hidden" id="act_us_ins_num" value="<?php echo count($array_act_usados_insumos); ?>">
            <input type="hidden" id="act_us_ins" value="<?php echo implode(', ',$array_act_usados_insumos); ?>">
        </div>
        <!-- <div class="modal fade" id="myModal7" role="dialog">
            <div class="modal-dialog ">
              <div class="modal-content" >
                <div class="modal-header" style="padding: 0px;">
                  <button type="button" class="close" data-number="2">&times;</button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body detalle299">
        			<iframe  id="frmFrame" class="cuerpo" src=""></iframe>
                </div>

              </div>
            </div>
         </div> -->
         <div style="top: 20px;width: 650px;" class="modal fade" id="myModal7" role="dialog">
         	<div class="modal-dialog">
         		<!-- Modal content-->
         		<div class="modal-content" >
         			<div class="modal-header h" style="padding: 7px ;">
         				<button type="button" class="close" data-number="2">&times;</button>
         				Archivos
         			</div>
              <div class="modal-body detalle299">
            <iframe  id="frmFrame" class="cuerpo" src=""></iframe>
              </div>
         		</div>
             </div>
         </div>
</body>
<script>
$(document).ready(function() {
 var act_totales = "<b style=\"color : blue\">"+$("#total").val()+"</b>";
 var insumos = "<b style=\"color : blue\">"+$("#insumos").val()+"</b>";
 var usado_c_insumo = "<b style=\"color : blue\">"+$("#usado_c_insumo").val()+"</b>";
 var ejes_act_num = "<b style=\"color : blue\">"+$("#ejes_act_num").val()+"</b>";
 var ejes_act = "<b style=\"color : blue\">"+$("#ejes_act").val()+"</b>";
 var ejes_insumos_num = "<b style=\"color : blue\">"+$("#ejes_ins_num").val()+"</b>";
 var ejes_insumos = "<b style=\"color : blue\">"+$("#ejes_ins").val()+"</b>";
 var act_ins_num = "<b style=\"color : blue\">"+$("#act_ins_num").val()+"</b>";
 var act_ins = "<b style=\"color : blue\">"+$("#act_ins").val()+"</b>";
 var ejes_us_ins_num = "<b style=\"color : blue\">"+$("#ejes_us_ins_num").val()+"</b>";
 var ejes_us_ins = "<b style=\"color : blue\">"+$("#ejes_us_ins").val()+"</b>";
 var act_us_ins_num = "<b style=\"color : blue\">"+$("#act_us_ins_num").val()+"</b>";
 var act_us_ins = "<b style=\"color : blue\">"+$("#act_us_ins").val()+"</b>";



 $("#indicadores_1").append(" [ "+act_totales+" actividades que participan en  "+ejes_act_num+" ejes  ("+ejes_act+")]");
 $("#indicadores_1").append(" [ "+insumos+" insumos]");
 $("#indicadores_1").append(" [ "+usado_c_insumo+" veces usados como insumos]");
 $("#indicadores_2").append(" vienen de  "+ejes_insumos_num+" ejes ("+ejes_insumos+")");
 $("#indicadores_2").append(" de  "+act_ins_num+" áreas ("+act_ins+")");
 $("#indicadores_3").append(" impactan en  "+ejes_us_ins_num+" ejes ("+ejes_us_ins+")");
 $("#indicadores_3").append(" de  "+act_us_ins_num+" áreas ("+act_us_ins+")");


});
function muestra_entregables(id_ent,act,desc_ent){

  $("#myModal7").modal("show");
	$('#frmFrame').attr("src","../../apps/Asuntos/indexAct.php?action=archivos&idEntregable="+id_ent+"&actividad="+act+"&desc="+desc_ent);
}
$("button[data-number=2]").click(function(){
	$("#myModal7").modal("hide");
});
</script>
</html>
