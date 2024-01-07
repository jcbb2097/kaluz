<?php
session_start();
if(!isset($_SESSION['user_session']))
{
?>
<script>
    top.location.href="../../login.php";
    window.reload();
</script>
<?php
}

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombreUsuario = "";
$idUsuario = "";
$where = " " ;
$estilo = "";
$tipo_muestra = 0;

if ((isset($_POST['tipo_insumo'])      && $_POST['tipo_insumo'] != ""))          { $tipo_insumo=$_POST['tipo_insumo'];  }
if ((isset($_POST['check'])      && $_POST['check'] != ""))          { $check=$_POST['check'];  }
if ((isset($_POST['act'])      && $_POST['act'] != ""))          { $act=$_POST['act'];   }
if ((isset($_POST['categoria'])      && $_POST['categoria'] != ""))          { $categoria=$_POST['categoria'];    }
if ((isset($_POST['periodo'])      && $_POST['periodo'] != ""))          { $periodo=$_POST['periodo'];   }
if (isset($_SESSION['user_session']) ){ $idUsuario = $_SESSION['user_session']; }
if (isset($_POST['acme']) ){ $acme = $_POST['acme']; }
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title></title>
  </head>
  <body>
    <?php
    $anio = 0;
        $resultanios = $catalogo->obtenerLista(" Select * from c_periodo where Id_Periodo = $periodo ");
        while ($row_a = mysqli_fetch_array($resultanios)){
          $anio = $row_a['Periodo'];
        }


    $insumos = " SELECT act.IdEje,eje.Nombre as nombreje,ch.IdCheckList,if(ISNULL(kchac.Nombre_alterno),ch.Nombre,kchac.Nombre_alterno) as Nombre,if(ISNULL(ch.IdCheckListPadre),'padre',ch.IdCheckListPadre) AS tienepadre,
                      if(ISNULL(kchac1.Nombre_alterno),ch1.Nombre,kchac1.Nombre_alterno) as Nombre_padre
              FROM c_checkList ch
              JOIN k_checklist_actividad kchac ON ch.IdCheckList = kchac.IdCheckList AND kchac.IdActividad = $act  AND kchac.IdCategoria = $categoria AND kchac.Id_Periodo = $periodo
              left join c_checkList ch1 on ch.IdCheckListPadre = ch1.IdCheckList
              left join k_checklist_actividad kchac1 on ch1.IdCheckList = kchac1.IdCheckList AND kchac1.IdActividad = $act  AND kchac1.IdCategoria = $categoria AND kchac1.Id_Periodo = $periodo
              left JOIN c_actividad act ON act.IdActividad = kchac.IdActividad
              left join c_eje as eje on eje.IdEje = act.IdEje
              WHERE ch.IdCheckList =  $check  ";
              $resultinsumos = $catalogo->obtenerLista($insumos);
              while ($row = mysqli_fetch_array($resultinsumos)){
                $eje = $row['IdEje'];
                $nombre_deje = $row['nombreje'];
                if($row['tienepadre'] == "padre"){
                  $nombre_check = $row['Nombre'];
                  $subcheck = "0";
                  $nombre_subcheck = "";
                }else{
                  $check  = $row['tienepadre'];
                  $nombre_check = $row['Nombre_padre'];
                  $nombre_subcheck = $row['Nombre'];
                  $subcheck = $row['IdCheckList'];
                }

              }
              $result_cat = $catalogo->obtenerLista("SELECT cat.idCategoria,cat.descCategoria,if(ISNULL(cat.idCategoriaPadre),'padre',cat.idCategoriaPadre) AS tienepadre , cat_padre.descCategoria AS padre
                                                      FROM c_categoriasdeejes cat
                                                      LEFT JOIN c_categoriasdeejes cat_padre ON cat.idCategoriaPadre = cat_padre.idCategoria
                                                      WHERE cat.idCategoria = ".$categoria);
              while ($row_cat = mysqli_fetch_array($result_cat)){
                if($row_cat['tienepadre'] != "padre"){
                  $Id_categoria = $row_cat['tienepadre'];
                  $categoria_nombre = $row_cat['padre'];
                  $Id_subcategoria = $row_cat['idCategoria'];
                  $subcategoria_nombre = $row_cat['descCategoria'];
                }else{
                  $Id_categoria = $row_cat['idCategoria'];
                  $categoria_nombre = $row_cat['descCategoria'];
                  $Id_subcategoria = 0;
                  $subcategoria_nombre = "";
                }
              }
              $result_act = $catalogo->obtenerLista("SELECT act.IdActividad,act.Nombre,if(ISNULL(act.IdActividadSuperior),'padre',act.IdActividadSuperior) AS tienepadre , act_padre.Nombre AS padre
                                                    FROM c_actividad act
                                                    LEFT JOIN c_actividad act_padre  ON act_padre.IdActividad = act.IdActividadSuperior
                                                    WHERE act.IdActividad = ".$act);
              while ($row_act = mysqli_fetch_array($result_act)){
                if($row_act['tienepadre'] != "padre"){
                  $AGLOBAL = $row_act['tienepadre'];
                  $nombre_global = $row_act['padre'];
                  $AGENEREAL = $row_act['IdActividad'];
                  $nombre_general = $row_act['Nombre'];
                }else{
                  $AGLOBAL = $row_act['IdActividad'];
                  $nombre_global = $row_act['Nombre'];
                  $nombre_general = "";
                  $AGENEREAL = 0;
                }
              }


               ?>
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <label class="control-label" for="descripcion" style="font-size: .65em;"><span style="background-color:#d0d0d0;"><?php echo $eje." ".$nombre_deje; ?></span> </label>
                 <label class="control-label" for="descripcion" style="font-size: .65em;">CAT:  <span style="background-color:#d0d0d0;"><?php echo $categoria_nombre ; //$Id_categoria; ?> </span></label>
                 <?php if($subcategoria_nombre != ""){
                   ?>
                 <label class="control-label" for="descripcion" style="font-size: .65em;">SUB: <span style="background-color:#d0d0d0;"></b><?php echo $subcategoria_nombre;//$Id_subcategoria; ?> </span></label>
                 <?php
                   }
                 ?>
                 <label class="control-label" for="descripcion" style="font-size: .65em;">ACTGL: <span style="background-color:#d0d0d0;"><?php echo $nombre_global;//$AGLOBAL; ?> </span></label>
                 <?php if($nombre_general != ""){
                   ?>
                 <label class="control-label" for="descripcion" style="font-size: .65em;">ACTGEN: <span style="background-color:#d0d0d0;"> <?php echo $nombre_general;//$AGENEREAL; ?> </span></label>
                 <?php
                   }
                 ?>
                 <label class="control-label" for="descripcion" style="font-size: .65em;color:rgb(0, 55, 251);">CHECK: <span style="background-color:#d0d0d0;"> <?php echo $nombre_check;//$check; ?> </span></label>
                 <?php if($nombre_subcheck != ""){
                   ?>
                   <label class="control-label" for="descripcion" style="font-size: .65em;color:rgb(0, 55, 251);">SUBCHECK: <span style="background-color:#d0d0d0;"> <?php echo $nombre_subcheck;//$subcheck; ?> </span></label>
                 <?php
                   }
                 ?>
               </div>

    <input type="hidden" name="eje"  id="eje" value="<?php echo $eje; ?>">
    <input type="hidden" name="cat" id="cat" value="<?php echo  $Id_categoria; ?>">
    <input type="hidden" name="subcat" id="subcat" value="<?php echo $Id_subcategoria; ?>">
    <input type="hidden" name="actgl" id="actgl" value="<?php echo $AGLOBAL; ?>">
    <input type="hidden" name="actgen" id="actgen" value="<?php echo $AGENEREAL; ?>">
    <input type="hidden" name="idcheck" id="idcheck" value="<?php  echo $check; ?>">
    <input type="hidden" name="subcheck" id="subcheck" value="<?php echo $subcheck; ?>">
    <input type="hidden" name="periodo" id="periodo" value="<?php echo $periodo; ?>">
    <input type="hidden" name="tipo_insumo" id="tipo_insumo" value="<?php echo $tipo_insumo; ?>">

    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
      <div class="col-md-2 col-sm-2 col-xs-2" >

      </div>
      <div class="col-md-2 col-sm-2 col-xs-2" style="padding: 0px;" >
        <select class="form-control  " name="actmet" id="actmet" onchange="vacia_campos()" style="font-size: .7em;padding: 1px;height: 16px;">
          <option value="1" selected>Actividad</option>
          <option value="2">Meta</option>
        </select>
      </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
      <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion"  style="font-size: .7em;padding-left: 0px;">Eje : *</label>
      <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
          <select id="eje_recargar" class="form-control" name="eje_recargar" onchange="llena_cat()"  style="font-size: .7em;padding: 1px;height: 16px;">
            <option value="0">Selecciona un eje </option>
            <?php
            $resultcat = $catalogo->obtenerLista("SELECT  eje.idEje,eje.Nombre
                    FROM c_checkList ch
                    JOIN k_checklist_actividad kchac ON ch.IdCheckList = kchac.IdCheckList
                    JOIN c_categoriasdeejes cat ON cat.idCategoria = kchac.IdCategoria
                    LEFT JOIN c_categoriasdeejes cat_padre ON cat_padre.idCategoria = cat.idCategoriaPadre
                    left JOIN c_actividad act ON act.IdActividad = kchac.IdActividad
                    left join c_eje as eje on eje.IdEje = act.IdEje
                    WHERE   kchac.Id_Periodo = 14 AND kchac.Visible = 1 AND eje.idEje IS NOT null GROUP BY eje.idEje ORDER BY idEje , cat.orden            ");

            while ($row_eje = mysqli_fetch_array($resultcat)){
              $sel  = "";
              if($eje == $row_eje['idEje']){
                $sel = "selected = 'selected' ";
              }
              echo "<option value='".$row_eje['idEje']."' $sel>".$row_eje['idEje'].".-".$row_eje['Nombre']."</option>";
            }

             ?>

          </select>

      </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
      <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion"  style="font-size: .7em;padding-left: 0px;">Categoría : *</label>
      <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
          <select id="categoria_recargar" class="form-control" name="anio" onchange="llena_sub()"  style="font-size: .7em;padding: 1px;height: 16px;">
            <?php
            $resultcat = $catalogo->obtenerLista(" SELECT  cat.idEje,cat.descCategoria AS tienepadre_desc ,
			               cat.idCategoria AS tienepadre_id
                    FROM  c_categoriasdeejes cat
                    JOIN  k_categoriasdeejes_anios catan ON catan.idCategoria  = cat.idCategoria AND catan.Visible = 1
                    WHERE   catan.Anio = $anio AND cat.idEje = $eje  and catan.ACME = $acme  ORDER BY cat.idEje , cat.orden");

            while ($row_cat = mysqli_fetch_array($resultcat)){
              $sel  = "";
              if($Id_categoria == $row_cat['tienepadre_id']){
                $sel = "selected = 'selected' ";
              }
              if(strlen($row_cat['tienepadre_desc']) > 120)
                $row_cat['tienepadre_desc'] = substr($row_cat['tienepadre_desc'], 0, 120);
              echo "<option value='".$row_cat['tienepadre_id']."' $sel>".$row_cat['idEje'].".-".$row_cat['tienepadre_desc']."</option>";
            }

             ?>

          </select>

      </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
      <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="descripcion"  style="font-size: .7em;padding-left: 0px;">Subcategoría : </label>
      <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
          <select id="subcategoria_recargar" class="form-control" name="anio" onchange="llena_act()"  style="font-size: .7em;padding: 1px;height: 16px;">
            <option value="0">Selecciona una subcategoria</option>
            <?php
            $resultcat = $catalogo->obtenerLista("SELECT  cat.descCategoria,cat.idCategoria
                                                      FROM  c_categoriasdeejes cat
                                                      JOIN  k_categoriasdeejes_anios catan ON catan.idCategoria  = cat.idCategoria AND catan.Visible = 1
                                                      WHERE   catan.Anio = $anio and cat.idCategoriaPadre = $Id_categoria  and catan.ACME = 1 ORDER BY  cat.orden  ");

            while ($row_cat = mysqli_fetch_array($resultcat)){

              if(strlen($row_cat['descCategoria']) > 120)
                $row_cat['descCategoria'] = substr($row_cat['descCategoria'], 0, 120);
              echo "<option value='".$row_cat['idCategoria']."' >"."".$row_cat['descCategoria']."</option>";
            }

             ?>

          </select>

      </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12" >
        <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="actgl"  style="font-size: .7em;padding-left: 0px;">Act. Global : </label>
      <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
          <select id="global_recargar" class="form-control" name="global"   onchange="llena_gen()" style="font-size: .7em;padding: 1px;height: 16px;margin-bottom: 10px;">
            <option value="0">Selecciona una actividad global</option>
            <?php
            $resultcat = $catalogo->obtenerLista("SELECT act.IdActividad,CONCAT(cat.Numeracion ,' ',act.Nombre) AS nombre,
                                                  if(act.IdTipoActividad = 1 ,' Act ',' Meta ') actmet
                                                  FROM c_actividad act
                                                  JOIN k_actividad_categoria cat ON cat.IdActividad = act.IdActividad
                                                   WHERE cat.IdCategoria = $Id_categoria  and act.IdNivelActividad = 1 AND cat.IdPeriodo = $periodo
                                                   ORDER BY act.Orden");

            while ($row_scat = mysqli_fetch_array($resultcat)){
              $sel  = "";
              // if($Id_sub_categoria == $row_scat['idCategoria']){
              //   $sel = "selected = 'selected' ";
              // }
              if(strlen($row_scat['nombre']) > 120)
                $row_scat['nombre'] = substr($row_scat['nombre'], 0, 120);
              echo "<option value='".$row_scat['IdActividad']."' >"." ".$row_scat['nombre']."</option>";
            }

             ?>

          </select>

      </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 10px;">
      <label class="col-md-2 col-sm-2 col-xs-2  control-label" for="general"  style="font-size: .7em;padding-left: 0px;">Act. General : </label>
      <div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0px;">
          <select id="gen_recargar" class="form-control" name="general"   style="font-size: .7em;padding: 1px;height: 16px;margin-bottom: 10px;">
            <option value="0">Sin actividad general</option>

          </select>


          <button  type="button" name="filtrar" id="filtrar" onclick="recargar_checks()" style="right:20px;font-size: .8em;">Filtrar</button>

      </div>
    </div>


    <!-- <div class="row">
      <center>
        <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="palabra" style="font-size: .8em;">Buscar por palabra:</label>

            <input class="col-md-6 col-sm-6 col-xs-6" type="text" name="palabra" value="">

      </center>
    </div><br>
    <div class="row ">
      <center>
        <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="palabra" style="font-size: .8em;">Buscar por responsable:</label>

            <input class="col-md-6 col-sm-6 col-xs-6" type="text" name="palabra" value="">

      </center>
    </div><br>
    <div class="row">
      <center>
        <label class="col-md-3 col-sm-3 col-xs-3  control-label" for="palabra" style="font-size: .8em;">Buscar por area:</label>

            <input class="col-md-6 col-sm-6 col-xs-6" type="text" name="palabra" value="">

      </center>
    </div><br> -->




    <br><br>
    <div class="col-md-12 col-sm-12 col-xs-12" id="recargar_checks">

    <table id="selector_insumos" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
        <thead class="thead-dark" style="font-size: .65em;">
            <tr style="background-color: #5a274f;color: white;">
              <th style="padding:3px !important;">Eje</th>
              <th style="padding:3px !important;">Área</th>
              <th style="padding:3px !important;">Categoria</th>
              <th style="padding:3px !important;">Subcategoria</th>
              <th style="padding:3px !important;">Check de entrada</th>
              <th style="padding:3px !important;">Selección</th>

            </tr>
        </thead>
        <tbody>
          <?php


          //echo $insumos;
          $tablachecks = "SELECT act.IdEje,eje.Nombre as nombreje,ch.IdCheckList,kchac.Id_Periodo,kchac.IdActividad,act.IdTipoActividad,if(ISNULL(kchac.Nombre_alterno),ch.Nombre,kchac.Nombre_alterno) as Nombre,if(ISNULL(ch.IdCheckListPadre),'padre',ch.IdCheckListPadre) AS tienepadre,
                            act.Nombre as nomact,act.Numeracion,if(ISNULL(kchac.IdEncargado),ca1.Nombre,ca.Nombre) AS area_rec,
                            cat.idCategoria,cat.descCategoria,if(ISNULL(cat.idCategoriaPadre),'padre',cat.idCategoriaPadre) AS tienepadre_cat , cat_padre.descCategoria AS padre_cat
                    FROM c_checkList ch
                    JOIN k_checklist_actividad kchac ON ch.IdCheckList = kchac.IdCheckList
                    left JOIN c_actividad act ON act.IdActividad = kchac.IdActividad
                    left join c_eje as eje on eje.IdEje = act.IdEje
                    left JOIN c_personas p ON p.id_Personas = kchac.IdEncargado
                    left JOIN c_area ca ON ca.Id_Area = p.idArea
                    left JOIN c_personas p1 ON p1.id_Personas = ch.IdResponsable
                    left JOIN c_area ca1 ON ca1.Id_Area = p1.idArea
                    JOIN c_categoriasdeejes cat ON cat.idCategoria = kchac.IdCategoria
                    LEFT JOIN k_categoriasdeejes_anios catan ON catan.idCategoria = cat.idCategoria AND catan.Anio = $anio
                    LEFT JOIN c_categoriasdeejes cat_padre ON cat.idCategoriaPadre = cat_padre.idCategoria
                    WHERE ch.IdCheckList <> $check AND kchac.Id_Periodo = $periodo AND kchac.Visible = 1 AND catan.Visible = 1  AND ( cat.idCategoria = $Id_categoria OR cat.idCategoriaPadre = $Id_categoria )   ";
          $resultchecks = $catalogo->obtenerLista($tablachecks);
          while ($row = mysqli_fetch_array($resultchecks)) {
            $ruta = "";
            if($row['tienepadre_cat'] == "padre"){
              $cat = $row['descCategoria'];
              $subcat = "";

            }else{
              $cat = $row['padre_cat'];
              $subcat = $row['descCategoria'];

            }
            if($row['IdTipoActividad'] == 1){
              $act_met = "Act: ";
            }else{
              $act_met = "META: ";
            }
            //$row['Numeracion'].'.-'.

            echo '<tr style="font-size: .65em;">';
              echo '<td style="padding:3px !important;">'.$row['IdEje'].'.-'.$row['nombreje'].'</td>';
              echo '<td style="padding:3px !important;">'.$row['area_rec'].'</td>';
              echo '<td style="padding:3px !important;">'.$cat.'</td>';
              echo '<td style="padding:3px !important;">'.$subcat.'</td>';
              echo '<td style="padding:3px !important;">'.$row['Nombre'].'<br>('.$act_met.$row['Numeracion'].'.-'.$row['nomact'].')</td>';
              echo '<td style="padding:3px !important;"><input type="checkbox" onclick="anade_insumo('.$row['IdCheckList'].','.$row['IdActividad'].','.$row['idCategoria'].','.$row['Id_Periodo'].')" name="check_'.$row['IdCheckList'].'" id="check_'.$row['IdCheckList'].'" value=""></td>';
            echo '</tr>';
          }
          ?>
        </tbody>


      </table>
      </div>
      <center><button type="button" name="guardar_insumo" id="guardar_insumo" onclick="guardar()" style="right:20px;font-size: .8em;">Guardar</button></center>
      <input type="hidden" name="insumos" id="insumos" value="">

  </body>
  <script type="text/javascript">
  var array_insumos = [];

  $(document).ready(function() {

    var cont = 0;

    $('#selector_insumos thead tr').clone(true).appendTo('#selector_insumos thead');
    $('#selector_insumos thead tr:eq(1) th').each(function(i) {
          cont++;
          if (cont != 6) {


            var title = $(this).text();
            $(this).html('<input type="text" style="width : 85px;color: black;"  />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
          }else{
            $(this).html("");
          }

    });
      var table = $('#selector_insumos').DataTable({
        "aLengthMenu": [
                    [5, 10, 100],
                    [5, 10, 100] // change per page values here
                ],
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [
            [2, "asc"]
        ],

        "scrollX": "0px",
        "responsive": false,
        "pageLength": 10,
        "scrollY": "370px",
        "scrollCollapse": true,
        "paging": true
        //"ordering": false
      });

  });

  function muestraversiones(nombre_check, Id_check, tipo, Id_actividad, Id_categoria, periodo) { //checar que me vacia el modal anterior
      var titulo = "Entregables del " + tipo + ' ' + nombre_check;
      var Id_check = Id_check;
      var tipo = tipo;
      var Id_actividad = Id_actividad;
      var Id_categoria = Id_categoria;
      var periodo = periodo;
      $(".h").css('background-color', "#5a274f");
      $(".h").css('color', "white");
      $(".h").css('font-size', "11px");
      $("#myModal").modal({
          backdrop: false
      });
      $("#titulo_modal").html(titulo);
      $.post("Versiones.php", {
          Id_actividad: Id_actividad,
          tipo: tipo,
          Id_check: Id_check,
          Id_categoria: Id_categoria,
          periodo: periodo,

      }, function(data) {
          $(".detalle").html('');
          $(".detalle").html(data);
      });

  }

  function guardar(){
    let idchent = $("#idcheck").val();
    let idsubcheck = $("#subcheck").val();

    if(idsubcheck != "" && idsubcheck != 0){
      idchent = idsubcheck;
    }
    let idactent = $("#actgl").val();
    let idactgen = $("#actgen").val();
    if(idactgen != "" && idactgen != 0){
      idactent = idactgen;
    }
    let idcatent = $("#cat").val();
    let idsubcat = $("#subcat").val();
    if(idsubcat != "" && idsubcat != 0){
      idcatent = idsubcat;
    }
    let idanioent = $("#periodo").val();
    let tipo_insumo = $("#tipo_insumo").val();


    $.post("guardar_nuevo_insumo.php", {
        id_check_entregable: idchent,
        idact_entregable: idactent,
        id_cat_entregable: idcatent,
        idanio_entregable: idanioent,
        tipo_insumo : tipo_insumo,
        insumos : array_insumos.join()
    }, function(data) {
      if(data.indexOf("error") >= 0){//error
          alert("error en agregar insumo");
      }else{//correcto
        $.confirm({
            icon: 'glyphicon glyphicon-ok-sign',
            title: "Insumo agregado correctamente.",
            content: '',
            type: 'dark',
            buttons: {
                aceptar: {
                    action: function() {
                        $('#cerrar_insumos').click();
                    }

                }
            }
        });

      }

    });
  }

  function anade_insumo(idchins,actins,catins,perins){

    let insumos_existentes = $("#insumos").val();



    let insumonuevo = idchins+"|"+actins+"|"+catins+"|"+perins;

    console.log("anadiendo : "+insumonuevo);

    if(array_insumos.includes(insumonuevo)){
      console.log("quitando");
       quitar(insumonuevo);
    }else{
      console.log("insertando");
      array_insumos.push(insumonuevo);
    }

    console.log("mostrando : "+array_insumos.join());

  }
  function quitar(id){
    for (i = 0; i < array_insumos.length; i++) {
      if(array_insumos[i] == id){
        var removed = array_insumos.splice(i, 1);
      }


    }
  }
   function llena_cat(){
     var eje = $("#eje_recargar").val();
     var actmet = $("#actmet").val();
     $("#categoria_recargar").load("recargar_filtros.php?periodo=<?php echo $periodo; ?>&actmet="+actmet+"&eje="+eje);
     $("#subcategoria_recargar").val(0);
     $("#global_recargar").val(0);
     $("#gen_recargar").val(0);
   }

   function llena_sub(){
     var cat = $("#categoria_recargar").val();
     var actmet = $("#actmet").val();
     $("#subcategoria_recargar").load("recargar_filtros.php?periodo=<?php echo $periodo; ?>&actmet="+actmet+"&Id_categoria="+cat);

     $("#global_recargar").load("recargar_filtros.php?periodo=<?php echo $periodo; ?>&actmet="+actmet+"&Id_subcategoria="+cat);
   }
   function llena_act(){

     var sub = $("#subcategoria_recargar").val();
     var actmet = $("#actmet").val();
     $("#global_recargar").load("recargar_filtros.php?periodo=<?php echo $periodo; ?>&actmet="+actmet+"&Id_subcategoria="+sub);
   }
   function llena_gen(){
     var act = $("#global_recargar").val();
     var sub = $("#subcategoria_recargar").val();
     var cat = $("#categoria_recargar").val();
     var actmet = $("#actmet").val();
     if(sub != 0 )cat = sub;
     $("#gen_recargar").load("recargar_filtros.php?periodo=<?php echo $periodo; ?>&actmet="+actmet+"&Id_act="+act+"&Id_subcategoria="+cat);
   }




  function recargar_checks(){
    var cat = $("#categoria_recargar").val();
    var subcat = $("#subcategoria_recargar").val();
    var act = $("#global_recargar").val();
    var gen = $("#gen_recargar").val();
    var actmet = $("#actmet").val();
    if(subcat != 0 )cat = subcat;
    if(gen != 0 )act = gen;

    if(cat == 0){
      alert("Debe seleccionar un eje y una categoria para filtrar");
    }else{
      $("#recargar_checks").load("recargar_checks.php?check=<?php echo $check; ?>&periodo=<?php echo $periodo; ?>&Id_categoria="+cat+"&actmet="+actmet+"&act="+act);
    }


  }

  function vacia_campos(){
    $("#eje_recargar").val(0);
    $("#categoria_recargar").val(0);
    $("#subcategoria_recargar").val(0);
    $("#global_recargar").val(0);
    $("#gen_recargar").val(0);
  }


  </script>
</html>
