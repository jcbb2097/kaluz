
<style type="text/css">
  table.eitable {
    
    background-color:#f9f9f9;
    width: 630px;
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
  table.eitable th.eitable {
    font-size: 10px;
    color: #ffffff;
    background-color: #4D4D57;
    min-height: 20px;
    max-width: 80px;
    border: none;
    text-align: left;
  }
  table.eitable .has-expired {
    color: #ff0000 !important;
  }
   table.eitable td.i-text {
    /*padding-left: 25px !important;*/
  }
  /*table.eitable td i {
    font-size: 14px;
  }*/
  table.eitable tr.ins-row{
    background-color: rgb(243, 243, 243) !important;
  }
  table.eitable tr.ins2-row{
    background-color: rgb(230, 230, 230) !important;
  }
  table.eitable tr.chk-row{
    background-color: rgb(202, 202, 202) !important;
  }


  /*.process-row.row-ei td.row-ei {
    font-size: 9px;
    font-weight: 900;
    height: 23px;
    box-shadow: 0 0.4px 0 #787878, 0.1px 0 0 #4D4D57;
  }*/

  /*.process-row.row-ei td.activity.row-ei {
    color: #4D4D57;
  }*/

  .process-row.row-ei td.area.row-ei {
    color: #0093a3;
  }

  /*.process-row.row-ei td.inputs.row-ei, .process-row.row-ei td.input-output.row-ei {
    font-weight: normal;
  }*/

  .progbox.p-ei {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    /*-webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    min-width: 30px;*/
    max-width: 50px;
    min-width: 50px;
  }

  .line-container.p-ei {
    display: block;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    height: 8px;
    border-radius: 1.1px;
    background-color: #dcdcdc;
    /*border: solid 0.1px #000000;*/
    position: relative;
    left:-30px;
    min-width: 50px;
  }

  .progress.p-ei {
    height: 100%;
    border-radius: 1.1px;
    -webkit-transition: width 1s ease-in, background-color 1s ease-in;
    transition: width 1s ease-in, background-color 1s ease-in;
  }

  span.p-ei {
    min-width: 30px;
    font-family: 'Muli', sans-serif;
    font-size: 9px;
    position: relative;
    top:0px;
    left: 15px;
    z-index: 10;
  }

  .c1 {
    min-width: 150px;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .c2 {
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .c3 {
    min-width: 40px;
    max-width: 40px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .c4 {
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  figure.icon-ei {
    position: relative;
    padding: 0;
    margin: 0;
    width: 10px;
    height: 10px;
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

  .icon.icon-ei {
    width: 10px;
    height: 10px;
  }

  .caption.icon-ei {
    position: absolute;
    top: 10px;
    display: none;
    font-size: 6px;
  }

  figure.icon-ei:hover .caption.icon-ei {
    display: block;
  }

  .large.icon-ei {
    width: 15px;
    height: 15px;
  }

  .large.icon-ei .icon.icon-ei {
    width: 15px;
    height: 15px;
  }
  
  .crx{
	position: relative;
    top: -3px;
    left: 17px;
}

.bar25 {
  background-color: #d67b2b !important;
}
.bar50 {
  background-color: #d6c72b !important;
}
.bar75 {
  background-color: #c1d62b !important;
}
.bar100 {
  background-color: #33d62b !important;
}

.cuerpo {
  width: 580px;
  height: 380px;
  border: none;
}

.nuevoModal {
  width: 620px !important;
  height: 420px !important;
}

</style>

<div class="row my-0 py-0">
  <div class="col-12 my-0 py-0">
    <table class="eitable mt-0 mb-1 py-0">
      <thead class="eitable">
        <tr class="eitable">
          <th class="eitable c1">Insumo</th>
          <th class="eitable c2">Responsable</th>
          <th class="eitable c3">A/M</th>
          <th class="eitable" style="width: 60px;">Entrega</th>
          <th class="eitable" style="width: 60px !important;">Avances</th>
          <th class="eitable c4">Info</th>
          <th class="eitable"></th>
          <th class="eitable"></th>
          <th class="eitable"></th>
        </tr>
      </thead>
      <tbody class="eitable">
        <?php
          if(isset($this->insumos)) {
            foreach ($this->insumos as $ins) {
              $barc = '';
              if($ins->getProgreso()<=25)
                $barc = 'bar25';
              else if($ins->getProgreso()<=50)
                $barc = 'bar50';
              else if($ins->getProgreso()<=75)
                $barc = 'bar75';
              else
                $barc = 'bar100';

              $fechaTooltip = '';
              if($ins->getEstatus()=='0') {
                $fechaPreliminar = new DateTime($ins->getFechaInicioEstimada());
                $fechaCompleto = new DateTime($ins->getFechaFinEstimada());
                $fecha = new DateTime();
                $iPre = date_diff($fechaPreliminar, $fecha)->format('%a');
                $iCom = date_diff($fechaCompleto, $fecha)->format('%a');
                /*if($interval->format('%a') >= 1)
                }*/
                $fechaTooltip = 'Días restantes para entrega preliminar: '.$iPre.'<br>Días restantes para entrega final: '.$iCom;
              } else if($ins->getEstatus()=='1') {

              } else if($ins->getEstatus()=='2') {

              }

              $fecha = explode(" ",$ins->getFechaFinEstimada());
              echo '<tr id="tr'.$ins->getIdEntregable().'" class="row-ei process-row has-children ins-row">';
              echo '<td class="row-ei c1" onclick="abrirInsumos('.$ins->getIdEntregable().')">'.$ins->getDescripcion().' '.$ins->getExpInt().'</td>';
              echo '<td class="row-ei area inputs c2" data-toggle="tooltip" data-placement="top" title="'.$ins->getArea().' ('.$ins->getResponsable().')">'.$ins->getArea().'</td>';
              echo '<td id="'.$ins->getIdActividad().'" class="row-ei area c3" data-toggle="tooltip" data-placement="top" title="'.$ins->getActividad().'">'.$ins->getOrdenA().'</td>';
              echo '<td class="row-ei area has-expired" data-toggle="tooltip" data-placement="top" data-html= "true" title="'.$fechaTooltip.'">'.$fecha[0].'</td>';
              echo '<td class="row-ei"><div class="progress rounded-0" style="height: 10px; font-size:8px; font-weight: bold; ">
                      <div class="progress-bar '.$barc.'" role="progressbar" style="width: '.$ins->getProgreso().'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$ins->getProgreso().'%</div>
                    </div></td>';
              //echo '<td class="row-ei area"><div class="p-ei progbox"><span class="p-ei">75 %</span><div class="p-ei line-container"><div class="p-ei progress" style="width: '.$ins->getProgreso().'%; background-color: rgb(128, 242, 13);"></div></div></div></td>';
              echo '<td class="row-ei c4"><span class="badge badge-dark"><i class="fa fa-briefcase" aria-hidden="true"></i> '.$ins->getInsumos().'</span><span class="badge badge-dark"><i class="fa fa-check-square-o" aria-hidden="true"></i> '.$ins->getChk().'</span></td>';
              if($ins->getRuta()!= null) {
                echo '<td class="row-ei"><a href="https://www.administro.mx/siekaluz/sie/resources/aplicaciones/imagenes/ArchivosCompartidos/'.$ins->getRuta().'" target="_blank"><i class="fa fa-download" aria-hidden="true" style="font-color:#337ab7;"></i></a></td>';
              } else {
                echo '<td class="row-ei"><i class="fa fa-download" aria-hidden="true"></i></td>';  
              }
              
              echo '<td class="row-ei"><i class="fa fa-files-o" aria-hidden="true"></i></td>';
              echo '<td class="row-ei"><i class="fa fa-paper-plane-o" aria-hidden="true" onclick="escribirAsunto('.$ins->getIdEntregable().','.$this->idAreaU.','.$this->idUsuario.')"></i>&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i></td>';
              
              echo '</tr>';
            }
          }
        ?>
      </tbody>
    </table>
  </div>
  <div class="col-12 my-0 py-0">
    <table class="eitable mt-0 mb-1 py-0">
      <?php 
        $cadena = '';
        $contador = count($this->entregables);

        if(isset($this->entregables)) {
            foreach ($this->entregables as $ent) {
              $fecha = explode(" ",$ent->getFechaFinEstimada());
              $cadena = $cadena.'<tr class="row-ei area process-row has-children">';
              $cadena = $cadena. '<td class="row-ei c1">'.$ent->getDescripcion().' '.$ent->getExpInt().'</td>';
              $cadena = $cadena. '<td class="row-ei area inputs c2">'.$ent->getResponsable().'('.$ent->getArea().')</td>';
              $cadena = $cadena. '<td class="row-ei area c3">'.$ent->getOrdenA().'</td>';
              $cadena = $cadena. '<td class="row-ei area has-expired">'.$fecha[0].'</td>';
              $cadena = $cadena. '<td class="row-ei area"><div class="p-ei progbox"><span class="p-ei">75 %</span><div class="p-ei line-container"><div class="p-ei progress" style="width: 75%; background-color: rgb(128, 242, 13);"></div></div></div></td>';
              $cadena = $cadena. '<td class="row-ei c4"><span class="badge badge-dark"><i class="fa fa-check-square-o" aria-hidden="true"></i>'.'</span></td>';

              if($ent->getRuta() != null) {
                $cadena = $cadena. '<td class="row-ei"><a href="https://www.administro.mx/siekaluz/sie/resources/aplicaciones/imagenes/ArchivosCompartidos/'.$ent->getRuta().'" target="_blank"><i class="fa fa-download" aria-hidden="true" style="font-color:#337ab7;"></i></a></td>';
              } else {
                $cadena = $cadena. '<td class="row-ei"><i class="fa fa-download" aria-hidden="true"></i></td>';
              }
              
              $cadena = $cadena. '<td class="row-ei"><i class="fa fa-files-o" aria-hidden="true"></i></td>';
              $cadena = $cadena. '<td class="row-ei"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i></td>';
              $cadena = $cadena. '</tr>';
            }
          }
          if(isset($this->valoresCK)) {
            foreach ($this->valoresCK as $ck) {
              $cadena = $cadena. '<tr class="row-ei process-row has-children chk-row" >';
              $cadena = $cadena. '<td class="row-ei i-text">*'.$ck->getNombre().'</td>';
              $cadena = $cadena. '<td class="row-ei area inputs"></td>';
              $cadena = $cadena. '<td class="row-ei area has-expired"></td>';
              $cadena = $cadena. '<td class="row-ei area"></td>';
              $cadena = $cadena. '<td class="row-ei"></td>';
              $cadena = $cadena. '</tr>'; 
            }
          }
      ?>
      <thead class="eitable">
        <tr class="eitable">
          <th class="eitable c1">Entregable</th>
          <th class="eitable c2">Responsable</th>
          <th class="eitable c3">A/M </th>
          <th class="eitable" style="width: 60px;">Entrega</th>
          <th class="eitable" style="width: 60px !important;">Avances</th>
          <th class="eitable c4">Info</th>
          <th class="eitable">0/<?php echo $contador;?></th>
          <?php
            $entr = "";
            if(isset($this->entregables[0]))
              $entr = '\''.$this->entregables[0]->getIdEntregableG().'\',\''.$this->entregables[0]->getEntregableG().'\',\''.$this->entregables[0]->getOrdenA().'\',\''.$this->entregables[0]->getActividad().'\',\''.$this->entregables[0]->getTipo().'\'';
          ?>
          <th class="eitable"><i class="fab fa-connectdevelop" onclick="abreModal(<?php echo $entr;?>);"></i></th>
          <th class="eitable"></th>
        </tr>
      </thead>
      <tbody class="eitable">
        <?php
          echo $cadena;
        ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <button id="cerrarE" type="button" class="close text-white crx" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
</div>

<div id="nuevoModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title">Escribir nuevo asunto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <iframe class="cuerpo" id="cuerpo" src=""></iframe>
        </div>
        <!--<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>-->
      </div>
      
    </div>
  </div>

  <!--MODAL-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content  modal-xl" style=" width: 838px; left: -168px;">
        
        <div class="modal-body">
          
        </div>
        <div class="modal-footer" style=" height: 34px">
          <button type="button" style="font-size:10px" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>


<script type="text/javascript">

  function abrirInsumos(idEntregable) {
    $.post("indexAct.php",{action:'insumos',idEntregable:idEntregable}, function( data ) {
      //alert(data);
      $(".detalle").remove();
      $("#tr"+idEntregable).after(data);
    });
  }

  function escribirAsunto(idEntregable,idAreaU,idUsuario) {
    //$.post("indexAct.php",{action:'nuevo',idEntregable:idEntregable,idArea:idAreaU,idUsuario:idUsuario}, function( data ) {
      //alert(data);
      $('#cuerpo').attr("src","index.php?ac=8&idEntregable="+idEntregable+"&idUsuario="+idUsuario+"&idAreaU="+idAreaU);
      $('#nuevoModal').modal('toggle');

    //});
  }

  function abreModal(idInsumo,nombreEntregable,numeroActividad,nombreActividad,nombreEje){
    $("#myModal").modal();
    var idInsumo = idInsumo;
    var numeroActividad = numeroActividad;
    var nombreActividad = nombreActividad;
    var nombreEje = nombreEje;
    var nombreEntregable = nombreEntregable;
    
    $.post("smooth.php",{idInsumo:idInsumo,nombreEntregable:nombreEntregable,numeroActividad:numeroActividad,nombreActividad:nombreActividad,nombreEje:nombreEje}, function( data ) {
      $( ".modal-body" ).html( data );
    });
  }
 
$(document).ready(function(){
		$("#cerrarE").click(function(){
		    
		$(".cajaEI").hide(1000) ;
			
		});
    $('[data-toggle="tooltip"]').tooltip();
});


</script>
