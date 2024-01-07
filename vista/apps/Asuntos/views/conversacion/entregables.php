<!DOCTYPE html>
<html>
  <head>
    <title>Entregables</title>
<?php if($this->interno!='1') { ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../../resources/font/index.css"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <script src="https://use.fontawesome.com/779a643cc8.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<?php } ?>

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
    min-width: 120.2px;
    max-width: 120.2px;
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
    min-width: 60px;
    max-width: 60px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .c4 {
    min-width: 30px;
    max-width: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .cf {
    min-width: 60.2px;
    max-width: 60.2px;
    padding-left: -10px;
    text-align: center;
    /*overflow: hidden;
    text-overflow: ellipsis;*/
  }
  .ca {
    min-width: 60.2px;
    max-width: 60.2px;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
  }

  .cx {
    min-width: 30px;
    max-width: 30px;
    overflow: hidden;
    text-overflow: ellipsis;
    text-align: center;
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
  top: 0px;
  left: -5px;
  color: white !important;
    text-align: center;
    font-size: 11px;
    font-weight: 700;
    line-height: 1;
    text-shadow: 0 1px 0 #fff;
    opacity: .2;
    font-family: 'Muli', sans-serif;
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
  width: 100%;
  height: 380px;
  border: none;
}

.final {
  color:#33d62b;
}
.proceso {
  color:#e1b818;
}
.pre {
  color:#e18918;
}
.no {
  color:red;
}

</style>
</head>
<body>
  <div class="row">
  <div class="col-12">
    <button id="cerrarE" type="button" class="close crx" aria-label="Close">
      x
    </button>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <?php
      $cad1 = '';
      $totalInsumo = 0;
      $cont2 = 0;
      $auxIns = '';
      $auxEnt = '';
      if($this->aux == '1') {
        $auxEnt = 'd-none';
      } else if($this->aux == '2') {
        $auxIns = 'd-none';
      }
      $contador = isset($this->insumos) ? count($this->insumos) : 0;
          if(isset($this->insumos)) {
            foreach ($this->insumos as $ins) {
              
              $barc = '';
              $fechaTooltip = '';
              $expiro = '';

              
              $totalInsumo += $ins->getProgreso();
              if($ins->getProgreso()<=25)
                $barc = 'bar25';
              else if($ins->getProgreso()<=50) 
                $barc = 'bar50';
              else if($ins->getProgreso()<=75)
                $barc = 'bar75';
              else 
                $barc = 'bar100';

              if($ins->getProgreso()<50) {
                /*$fechaPreliminar = new DateTime($ins->getFechaInicioEstimada());
                $fechaCompleto = new DateTime($ins->getFechaFinEstimada());
                $fecha = new DateTime();
                $iPre = date_diff($fechaPreliminar, $fecha)->format('%a');
                $iCom = date_diff($fechaCompleto, $fecha)->format('%a');
                if($iPre->format('%a') >= 1) {
                  $expiro = 'has-expired';
                }
                $fechaTooltip = 'Días restantes para entrega preliminar: '.$iPre.'<br>Días restantes para entrega final: '.$iCom;
                */
              } else if($ins->getProgreso()<100) {
                /*$fechaCompleto = new DateTime($ins->getFechaFinEstimada());
                $fecha = new DateTime();
                $iCom = date_diff($fechaCompleto, $fecha)->format('%a');
                if($iCom->format('%a') >= 1) {
                  $expiro = 'has-expired';
                }
                $fechaTooltip = 'Días restantes para entrega final: '.$iCom;
                */
              } else {
                $f = explode(" ",$ins->getFechaFinEstimada());
                $fechaTooltip = 'La versión final se subió el '.$f[0];
                $cont2 +=1;
              }

              $fecha = explode(" ",$ins->getFechaFinEstimada());
              $cad1 = $cad1. '<tr id="tr'.$ins->getIdEntregable().'" class="row-ei process-row has-children ins-row">';
              $cad1 = $cad1. '<td id="'.$ins->getIdActividad().'" class="row-ei area c3" data-toggle="tooltip" data-placement="top" title="'.$ins->getActividad().'">'.$ins->getOrdenA().'</td>';
              
              $cad1 = $cad1. '<td class="row-ei c1" data-toggle="tooltip" data-placement="top" title="'.$ins->getDescripcion().'" onclick="abrirInsumos('.$ins->getIdEntregable().')">'.$ins->getDescripcion().'</td>';//.$ins->getExpInt().
              $cad1 = $cad1. '<td class="row-ei area inputs c2" data-toggle="tooltip" data-placement="top" title="'.$ins->getArea().' ('.$ins->getResponsable().')">'.$ins->getArea().'</td>';
              
              $cad1 = $cad1. '<td class="row-ei area cf" data-toggle="tooltip" data-placement="top" data-html= "true" title="'.$fechaTooltip.'">'.$fecha[0].'</td>';
              $cad1 = $cad1. '<td class="row-ei ca"><div class="progress rounded-0" style="height: 10px; font-size:8px; font-weight: bold; ">
                      <div class="progress-bar '.$barc.'" role="progressbar" style="width: '.$ins->getProgreso().'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$ins->getProgreso().'%</div>
                    </div></td>';
              //echo '<td class="row-ei area"><div class="p-ei progbox"><span class="p-ei">75 %</span><div class="p-ei line-container"><div class="p-ei progress" style="width: '.$ins->getProgreso().'%; background-color: rgb(128, 242, 13);"></div></div></div></td>';
              $cad1 = $cad1.'<td class="row-ei c4"><span class="badge badge-dark">'.$ins->getInsumos().'</span></td>';
              $cad1 = $cad1.'<td class="row-ei c4"><span class="badge badge-dark">'.$ins->getChk().'</span>';
              
              if($ins->getRuta()!= null) {
                $cad1 = $cad1. '<td class="row-ei cx"><a href="'.$ins->getRuta().'" target="_blank"><i class="fa fa-download '.$ins->getVersiones().'" aria-hidden="true"></i></a></td>';
              } else {
                $cad1 = $cad1. '<td class="row-ei cx"><i class="fa fa-download '.$ins->getVersiones().'" aria-hidden="true"></i></td>';  
              }
              
              $cad1 = $cad1. '<td class="row-ei cx"><i class="fa fa-files-o '.$ins->getVersiones().'" aria-hidden="true" onclick="abrirV('.$ins->getIdEntregable().',\''.$ins->getActividad().'\' , \''.$ins->getOrdenA().'\' , \''.$ins->getDescripcion().'\' , \''.$ins->getExpInt().'\');"></i></td>';
              $cad1 = $cad1. '<td class="row-ei cx"><i class="fa fa-paper-plane-o" aria-hidden="true" onclick="escribirAsunto('.$ins->getIdEntregable().','.$this->idAreaU.','.$this->idUsuario.')"></i></td>';
              $cad1 = $cad1. '<td class="row-ei cx"><i class="fa fa-reply" aria-hidden="true"></i></td>';
              $cad1 = $cad1. '</tr>';
            }
          }
          $totalInsumo = 0;
          if($contador != null || $contador != 0)
            $totalInsumo = $totalInsumo / $contador;
          $bc='';
           if($totalInsumo<=25)
                $bc = 'bar25';
              else if($totalInsumo<=50)
                $bc = 'bar50';
              else if($totalInsumo<=75)
                $bc = 'bar75';
              else
                $bc = 'bar100';
        ?>
    <table class="eitable <?php echo $auxIns;?>">
      <thead class="eitable">
        <tr class="eitable">
          <th class="eitable c3">Act.</th>
          <th class="eitable c1">Insumo</th>
          <th class="eitable c2">Área</th>
          <th class="eitable cf">Entrega</th>
          <th class="eitable ca">Avance</th>
          <th class="eitable c4">Ins.</th>
          <th class="eitable c4"><i class="fa fa-check-square-o" aria-hidden="true"></i></th>
          <th class="eitable cx" colspan="2"><?php echo $cont2.'/'.$contador;?></th>
          <th class="eitable cx" colspan="2"><div class="progress rounded-0" style="height: 10px; font-size:8px; font-weight: bold; "><div class="progress-bar <?php echo $bc;?>" role="progressbar" style="width: <?php echo $totalInsumo;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo (int)$totalInsumo;?>%</div></div></th>
          <!--<th class="eitable cx"></th>
          <th class="eitable cx"></th>-->
        </tr>
      </thead>
      <tbody class="eitable">
        <?php
          echo $cad1;
        ?>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <table class="eitable <?php echo $auxEnt;?>">
      <?php 
        $cadena = '';
        $totalEntregable = 0;
        $contador = count($this->entregables);
        $cont2 = 0;
        if(isset($this->entregables)) {
            foreach ($this->entregables as $ent) {
              $barc = '';
              $fechaTooltip = '';
              $expiro = '';
              $totalEntregable += $ent->getProgreso();
              if($ent->getProgreso()<=25)
                $barc = 'bar25';
              else if($ent->getProgreso()<=50)
                $barc = 'bar50';
              else if($ent->getProgreso()<=75)
                $barc = 'bar75';
              else
                $barc = 'bar100';

              if($ent->getProgreso()<50) {
                /*$fechaPreliminar = new DateTime($ins->getFechaInicioEstimada());
                $fechaCompleto = new DateTime($ins->getFechaFinEstimada());
                $fecha = new DateTime();
                $iPre = date_diff($fechaPreliminar, $fecha)->format('%a');
                $iCom = date_diff($fechaCompleto, $fecha)->format('%a');
                if($iPre->format('%a') >= 1) {
                  $expiro = 'has-expired';
                }
                $fechaTooltip = 'Días restantes para entrega preliminar: '.$iPre.'<br>Días restantes para entrega final: '.$iCom;
                */
              } else if($ent->getProgreso()<100) {
                /*$fechaCompleto = new DateTime($ins->getFechaFinEstimada());
                $fecha = new DateTime();
                $iCom = date_diff($fechaCompleto, $fecha)->format('%a');
                if($iCom->format('%a') >= 1) {
                  $expiro = 'has-expired';
                }
                $fechaTooltip = 'Días restantes para entrega final: '.$iCom;
                */
              } else {
                $f = explode(" ",$ent->getFechaFinEstimada());
                $fechaTooltip = 'La versión final se subió el '.$f[0];
                $cont2 += 1;
              }

              $fecha = explode(" ",$ent->getFechaFinEstimada());
              $cadena = $cadena.'<tr class="row-ei area process-row has-children">';
              if($this->entregables[0]->getIdEntregable() == $ent->getIdEntregable()) {
                $cadena = $cadena. '<td rowspan="'.($contador).'" class="row-ei area c3" ><span data-toggle="tooltip" data-placement="top" title="'.$ent->getActividad().'">'.$ent->getOrdenA().'</span></td>';
              }
              $cadena = $cadena. '<td class="row-ei c1" data-toggle="tooltip" data-placement="top" title="'.$ent->getDescripcion().'">'.$ent->getDescripcion().'</td>';
              $cadena = $cadena. '<td class="row-ei area inputs c2" data-toggle="tooltip" data-placement="top" title="'.$ent->getArea().' ('.$ent->getResponsable().')">'.$ent->getArea().'</td>';
              
              $cadena = $cadena. '<td class="row-ei area cf" data-toggle="tooltip" data-placement="top" title="'.$fechaTooltip.'">'.$fecha[0].'</td>';
              //$cadena = $cadena. '<td class="row-ei area"><div class="p-ei progbox"><span class="p-ei">75 %</span><div class="p-ei line-container"><div class="p-ei progress" style="width: 75%; background-color: rgb(128, 242, 13);"></div></div></div></td>';

              $cadena = $cadena. '<td class="row-ei ca"><div class="progress rounded-0" style="height: 10px; font-size:8px; font-weight: bold; ">
                      <div class="progress-bar '.$barc.'" role="progressbar" style="width: '.$ent->getProgreso().'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$ent->getProgreso().'%</div>
                    </div></td>';
               $cadena = $cadena. '<td class="row-ei c4">&nbsp;</td>';
              $cadena = $cadena. '<td class="row-ei c4"><span class="badge badge-dark">'.$ent->getChk().'</span></td>';
            
              if($ent->getRuta() != null) {
                $cadena = $cadena. '<td class="row-ei cx"><a href="'.$ent->getRuta().'" target="_blank"><i class="fa fa-download '.$ent->getVersiones().'" aria-hidden="true"></i></a></td>';
              } else {
                $cadena = $cadena. '<td class="row-ei cx"><i class="fa fa-download '.$ent->getVersiones().'" aria-hidden="true"></i></td>';
              }
              
              $cadena = $cadena. '<td class="row-ei cx"><i class="fa fa-files-o '.$ent->getVersiones().'" aria-hidden="true" onclick="abrirV('.$ent->getIdEntregable().',\''.$ent->getActividad().'\',\''.$ent->getOrdenA().'\',\''.$ent->getDescripcion().'\',\''.$ent->getExpInt().'\');"></i></td>';
              $cadena = $cadena. '<td class="row-ei cx"><i class="fa fa-reply" aria-hidden="true"></i></td>';
              //$cadena = $cadena. '<td class="row-ei cx"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></td>';
              $cadena = $cadena. '<td class="row-ei cx"></td>';
              $cadena = $cadena. '</tr>';
            }
          }
          $totalEntregable = 0;
          if($contador != null || $contador != 0)
            $totalEntregable = $totalEntregable / $contador;
          $bc='';
           if($totalEntregable<=25)
                $bc = 'bar25';
              else if($totalEntregable<=50)
                $bc = 'bar50';
              else if($totalEntregable<=75)
                $bc = 'bar75';
              else
                $bc = 'bar100';
          if(isset($this->valoresCK)) {
            foreach ($this->valoresCK as $ck) {
              $cadena = $cadena. '<tr class="row-ei process-row chk-row" >';
              $cadena = $cadena. '<td class="row-ei i-text" colspan="5"> ';
              if($ck->getValor() != '1')
                $cadena = $cadena. '<i class="fa fa-square-o" aria-hidden="true"></i> ';
              else 
                $cadena = $cadena. '<i class="fa fa-check-square-o" aria-hidden="true"></i> ';
              $cadena = $cadena. $ck->getNombre().'</td>';
              $cadena = $cadena. '<td class="row-ei"></td>';
              $cadena = $cadena. '<td class="row-ei"></td>';
              $cadena = $cadena. '<td class="row-ei"></td>';

              $cadena = $cadena. '<td class="row-ei"></td>';
              $cadena = $cadena. '<td class="row-ei"></td>';
              $cadena = $cadena. '</tr>'; 
            }
          }
      ?>
      <thead class="eitable">
        <?php
            $entr = "";
            if(isset($this->entregables[0]))
              $entr = '\''.$this->entregables[0]->getIdEntregableG().'\',\''.$this->entregables[0]->getEntregableG().'\',\''.$this->entregables[0]->getOrdenA().'\',\''.$this->entregables[0]->getActividad().'\',\''.$this->entregables[0]->getTipo().'\'';
          ?>
        <tr class="eitable">
          <th class="eitable c3">Act.</th>
          <th class="eitable c1">Entregable &nbsp;&nbsp;<i class="fab fa-connectdevelop" onclick="abreModal(<?php echo $entr;?>);"></i></th>
          <th class="eitable c2">Área</th>
          <th class="eitable cf">Entrega</th>
          <th class="eitable ca">Avance</th>
          <th class="eitable c4">&nbsp;</th>
          <th class="eitable c4"><i class="fa fa-check-square-o" aria-hidden="true"></i></th>
          <th class="eitable cx" colspan="2"><?php echo $cont2.'/'.$contador;?></th>
          
          <th class="eitable cx" colspan="2"><div class="progress rounded-0" style="height: 10px; font-size:8px; font-weight: bold; "><div class="progress-bar <?php echo $bc;?>" role="progressbar" style="width: <?php echo $totalEntregable;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo (int)$totalEntregable;?>%</div></div></th>
          <!--<th class="eitable cx"></th>-->
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



<div id="nuevoModal" class="modal fade"  role="dialog">
  <div class="modal-dialog modal-lg" style="max-width:800px !important;">
    <!-- Modal content-->
    <div class="modal-content modal-lg" style="width:100%;">
      <div class="modal-header" style="background-color: #212529;">
        <button type="button" class="close crx" data-dismiss="modal">&times;</button>
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content  modal-lg" style=" width: 838px; left: -168px;">
        
        <div class="modal-body datosModal">
          
        </div>
        <div class="modal-footer" style=" height: 34px">
          <button type="button" style="font-size:10px" class="btn btn-default crx" data-dismiss="modal">x</button>
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
      $( ".datosModal" ).html( data );
    });
  }

  function abrirV(idEntregable,actividad,ordenA,nombreEntregable,exp) {
    /*$.post("indexAct.php",{action:"archivos",idEntregable:idEntregable}, function( data ) {
      $( ".datosModal" ).html( data );
      $("#myModal").modal();
    });
    */
    $('#nuevoModal').modal('toggle');
    $('#cuerpo').attr("src","indexAct.php?action=archivos&idEntregable="+idEntregable+"&actividad="+actividad+"&orden="+ordenA+"&desc="+nombreEntregable+"&exp="+exp);
      
  }
 
$(document).ready(function(){
		$("#cerrarE").click(function(){
		    $(".cajaEI").html("");
		$(".cajaEI").hide(1000) ;
			
		});
    $('[data-toggle="tooltip"]').tooltip();
});


</script>
</body>
</html>
