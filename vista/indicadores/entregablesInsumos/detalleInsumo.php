<?php 
	include_once __DIR__."/../../../source/controller/EntregableController.php";

	$idArea = $_POST["idDestino"];
  $nivel = $_POST["tipo"];
  $idEje = $_POST["idEje"];
  $estatus = $_POST["estatus"];
  //echo $nivel.'<br>';
	$actEntregable = new EntregableController();
	$entregables = $actEntregable -> mostrarListadoInsumos($idArea,$nivel,$idEje,$estatus);

?>
<style type="text/css">
table.eitable {
	background-color:#f9f9f9;
	/*width: 610px;*/
	font-size: 10px;
}
table.eitable .has-children {
	cursor: pointer;
}
table.eitable td, table.eitable th {
/*border: none;*/
	font-family: 'Muli', sans-serif;
	padding: 0.3rem;
	white-space: nowrap;
	word-break: keep-all;
}
table.eitable td {
	border: solid;
	border-width: 1px;
	border-color: #d0d0d0;
}
table.eitable th.eitable {
	font-size: 10px;
	color: #ffffff;
	background-color: #444444;/*#4D4D57;*/
	min-height: 20px;
	/*max-width: 80px;*/
	border: none;
	text-align: left;
}
.c1 {
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c2 {
    min-width: 200px;
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c3 {
    min-width: 70px;
    max-width: 70px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c4 {
    min-width: 100px;
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c5 {
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c6 {
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c7 {
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c8 {
    min-width: 200px;
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.c9 {
    min-width: 30px;
    max-width: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.cuerpo {
  width: 100%;
  height: 380px;
  border: none;
}
</style>
<div style="max-height: 570px; overflow-y: auto;">
	<table class="eitable">
      <thead class="eitable">
        <tr class="eitable">
          <th class="eitable c1">No.</th>
          <th class="eitable c2">Actividad</th>
          <th class="eitable c3">Área</th>
          <th class="eitable c4">Encargado</th>
          <th class="eitable c5">Preliminar</th>
          <th class="eitable c6">Proceso</th>
          <th class="eitable c7">Final</th>
          <th class="eitable c8">Descripción</th>
          <th class="eitable c9"></th>
        </tr>
      </thead>
      <tbody class="eitable">
        <?php

			foreach ($entregables as $ent) {
				echo '<tr>';
				echo '<td class="row-ei c1">'.$ent->getOrden().'</td>';
        echo '<td class="row-ei c2">'.$ent->getActividad().'</td>';
				echo '<td class="row-ei c3">'.$ent->getArea().'</td>';
				echo '<td class="row-ei c4">'.$ent->getEncargado().'</td>';
				$v='';
				$p='';
				$f='';
				if($ent->getPreliminar()>0) {
					$p='<i class="fa fa-check" aria-hidden="true" style="color:orange;"></i>';
				}
        if($ent->getProceso()>0) {
          $v='style="background-color:yellow;"';
        }
				if($ent->getFinal()>0) {
					$f='<i class="fa fa-check" aria-hidden="true" style="color:#5cb85c;"></i>';
				}

				echo '<td class="row-ei c5">'.$p.'</td>';
				echo '<td class="row-ei c6" '.$v.'>'.$ent->getProceso().'</td>';
				echo '<td class="row-ei c7">'.$f.'</td>';

				echo '<td class="row-ei c8">'.$ent->getDescripcion().'</td>';
				echo '<td class="row-ei c9"><i style="cursor:point;" class="fa fa-files-o" aria-hidden="true" onclick="abrirV('.$ent->getIdEE().',\''.$ent->getActividad().'\',\''.$ent->getOrden().'\',\''.$ent->getDescripcion().'\',\''.$ent->getExpInt().'\');"></i></td>';
				echo '</tr>';
			}

		?>
      </tbody>
    </table>

    <div id="nuevoModal" class="modal fade"  role="dialog">
      <div class="modal-dialog modal-lg" style="max-width:800px !important;">
        <!-- Modal content-->
        <div class="modal-content modal-lg" style="width:100%;">
          <div class="modal-header" style="background-color: #212529;">
            <button type="button" class="close crx" data-number="2">&times;</button>
          </div>
          <div class="modal-body">
            <iframe class="cuerpo" id="cuerpo" src=""></iframe>
          </div>
        </div>
      </div>
    </div>

</div>
<script type="text/javascript">
  function abrirV(idEntregable,actividad,ordenA,nombreEntregable,exp) {
    //$('#nuevoModal').modal('toggle');
    $("#nuevoModal").modal({backdrop: false});
    $('#cuerpo').attr("src","../../apps/Asuntos/indexAct.php?action=archivos&idEntregable="+idEntregable+"&actividad="+actividad+"&orden="+ordenA+"&desc="+nombreEntregable+"&exp="+exp);
  }
  $("button[data-number=2]").click(function(){
      $('#nuevoModal').modal('hide');
  });
</script>