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

if ((isset($_POST['check'])      && $_POST['check'] != ""))          { $check=$_POST['check'];  }
if ((isset($_POST['act'])      && $_POST['act'] != ""))          { $act=$_POST['act'];   }
if ((isset($_POST['categoria'])      && $_POST['categoria'] != ""))          { $categoria=$_POST['categoria'];    }
if ((isset($_POST['periodo'])      && $_POST['periodo'] != ""))          { $periodo=$_POST['periodo'];   }
if (isset($_SESSION['user_session']) ){ $idUsuario = $_SESSION['user_session']; }
if (isset($_POST['tipo_insumo']) ){ $tipo_insumo = $_POST['tipo_insumo']; }
if (isset($_POST['acme']) ){ $acme = $_POST['acme']; }
//faltya pasar si es act o meta

$color = "red";
 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title></title>
  </head>
  <body>
    <div class="" id="recargar_archivos">

    <table id="t_insumos" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr style="background-color: #5a274f;color: white;">
              <?php if($tipo_insumo == 1){
                echo "<th>Eje</th>
                      <th>Área</th>
                      <th>Insumo de entrada</th>";
              }else{
                echo "<th>Eje</th>
                      <th>Área</th>
                      <th>Check que usa entregable de salida</th>";
              } ?>
              <th>Avance</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
          <?php
          if($tipo_insumo == 1){
            $where .= " AND kchei.idChecklistEntregable = $check";
            $where .= " AND kchei.idActividadEntregable = $act" ;
            $where .= " AND kchei.idCategoriaEntregable = $categoria ";
            $where .= " AND kchei.idAnioInsumoUsado = $periodo";

            $insumos = " SELECT kchei.idChecklistInsumoUsado as check_,kchei.idActividadInsumoUsado as act_principal,kchei.idCategoriaInsumoUsado as cat_principal,kchei.idAnioInsumoUsado as periodo_insumo,
                			if(ISNULL(kchac.Nombre_alterno),ch.Nombre,kchac.Nombre_alterno) as Nombre,act.IdEje,
                			if(ISNULL(kchac.IdEncargado),ca1.Nombre,ca.Nombre) AS area_rec,
                      if(ISNULL(kchac.IdEncargado),ca1.Id_Area,ca.Id_Area) AS id_area_res,kchac.Avance,act.IdActividad,kchac.Archivo,d.ruta,d.pdf,d.id_tipo,ca.tipoArea,
                      cate.descCategoria as categoria_principal,subcate.descCategoria as subcategoria,
                      CASE WHEN kchac.IdEncargado != '' THEN kchac.IdEncargado ELSE ch.IdResponsable END AS IdEncargado
                      FROM k_checkListEntregableInsumo kchei
                      JOIN c_checkList ch ON ch.IdCheckList = kchei.idChecklistInsumoUsado
                      JOIN k_checklist_actividad kchac ON ch.IdCheckList = kchac.IdCheckList  AND kchac.IdCategoria = kchei.idCategoriaInsumoUsado AND kchac.IdActividad = kchei.idActividadInsumoUsado AND kchac.Id_Periodo = kchei.idAnioInsumoUsado
                      JOIN c_actividad act ON act.IdActividad = kchac.IdActividad
                      left JOIN c_personas p ON p.id_Personas = kchac.IdEncargado
                      left JOIN c_area ca ON ca.Id_Area = p.idArea
                      left JOIN c_personas p1 ON p1.id_Personas = ch.IdResponsable
                      left JOIN c_area ca1 ON ca1.Id_Area = p1.idArea
                      LEFT JOIN c_documento d ON d.id_documento = kchac.Archivo
                      left join c_categoriasdeejes cate on cate.idCategoria = kchei.idCategoriaInsumoUsado
                      left join c_categoriasdeejes subcate on subcate.idCategoria = cate.idCategoriaPadre
                      WHERE 1  $where ";
          }else{
            $where .= " AND kchei.idChecklistInsumoUsado = $check";
            $where .= " AND kchei.idActividadInsumoUsado = $act" ;
            $where .= " AND kchei.idCategoriaInsumoUsado = $categoria ";
            $where .= " AND kchei.idAnioInsumoUsado = $periodo";



            $insumos = " SELECT kchei.idChecklistEntregable as check_,kchei.idActividadEntregable as act_principal,kchei.idCategoriaEntregable as cat_principal,kchei.idAnioEntregable as periodo_insumo,
                			if(ISNULL(kchac.Nombre_alterno),ch.Nombre,kchac.Nombre_alterno) as Nombre,act.IdEje,
                			if(ISNULL(kchac.IdEncargado),ca1.Nombre,ca.Nombre) AS area_rec,
                      if(ISNULL(kchac.IdEncargado),ca1.Id_Area,ca.Id_Area) AS id_area_res,kchac.Avance,act.IdActividad,kchac.Archivo,d.ruta,d.pdf,d.id_tipo,
                      cate.descCategoria as categoria_principal,subcate.descCategoria as subcategoria,
                      ca.tipoArea,CASE WHEN kchac.IdEncargado != '' THEN kchac.IdEncargado ELSE ch.IdResponsable END AS IdEncargado
                      FROM k_checkListEntregableInsumo kchei
                      JOIN c_checkList ch ON ch.IdCheckList = kchei.idChecklistEntregable
                      JOIN k_checklist_actividad kchac ON ch.IdCheckList = kchac.IdCheckList AND kchac.IdActividad = kchei.idActividadEntregable AND kchac.IdCategoria = kchei.idCategoriaEntregable AND kchac.Id_Periodo = kchei.idAnioInsumoUsado
                      JOIN c_actividad act ON act.IdActividad = kchac.IdActividad
                      left JOIN c_personas p ON p.id_Personas = kchac.IdEncargado
                      left JOIN c_area ca ON ca.Id_Area = p.idArea
                      left JOIN c_personas p1 ON p1.id_Personas = ch.IdResponsable
                      left JOIN c_area ca1 ON ca1.Id_Area = p1.idArea
                      LEFT JOIN c_documento d ON d.id_documento = kchac.Archivo
                      left join c_categoriasdeejes cate on cate.idCategoria = kchei.idCategoriaEntregable
                      left join c_categoriasdeejes subcate on subcate.idCategoria = cate.idCategoriaPadre
                      WHERE 1  $where ";
          }

          //echo $insumos;
          $resultinsumos = $catalogo->obtenerLista($insumos);
          while ($row = mysqli_fetch_array($resultinsumos)) {

            $ruta = "";

            echo '<tr>';
            echo '<td>' . $row['IdEje'] . '</td>';
            echo '<td>' . $row['area_rec'] . '</td>';
            $ruta = $row['ruta'] . $row['pdf'];

            if($tipo_insumo == 1){
              $where_borrar = " ' ".str_replace("kchei.", "", $where)."  AND idChecklistInsumoUsado = ".$row['check_']."  AND idActividadInsumoUsado = ".$row['act_principal']."'";
            }else{
              $where_borrar = " ' ".str_replace("kchei.", "", $where)."  AND idChecklistEntregable =  ".$row['check_']."  AND idActividadEntregable =  ".$row['act_principal']."'";
            }


            $categoria_principal = $row['categoria_principal'] ;
            $subcategoria = "";
            if($row['subcategoria'] != "")
              $subcategoria = 'Sub: '.$row['subcategoria'] ;


            $id_area = $row['id_area_res'];



              if ($row['pdf'] == "link" && $row['Archivo'] != '') {
                    $onclick_check = 'target="_blank" href="' . $row['ruta'] . '"';
                } elseif ($row['pdf'] != "link" && $row['Archivo'] != '') {
                    $onclick_check = 'target="_blank" href="' . $ruta . '"';
                } else {
                    $onclick_check = "";
                }
                if($row['id_tipo'] == 10)//entregable final
                  $color = "#41e24a";
                  if($row['id_tipo'] == 9)//entregable inicial
                    $color = "#f4ac22";
                    if($row['id_tipo'] == 14)//entregable proceso
                      $color = "#deff3b;";

                if($onclick_check == "")
                  $color = "red";

                  $result_cat = $catalogo->obtenerLista("SELECT cat.idCategoria,cat.descCategoria,if(ISNULL(cat.idCategoriaPadre),'padre',cat.idCategoriaPadre) AS tienepadre , cat_padre.descCategoria AS padre
                                                          FROM c_categoriasdeejes cat
                                                          LEFT JOIN c_categoriasdeejes cat_padre ON cat.idCategoriaPadre = cat_padre.idCategoria
                                                          WHERE cat.idCategoria = ".$row['cat_principal']);
                  while ($row_cat = mysqli_fetch_array($result_cat)){
                    if($row_cat['tienepadre'] != "padre"){
                      $Id_categoria = $row_cat['tienepadre'];
                      $Id_subcategoria = $row_cat['idCategoria'];
                      $subcategoria= $categoria_principal;
                      $categoria_principal= $row_cat['padre'];

                    }else{
                      $Id_categoria = $row_cat['idCategoria'];
                      $Id_subcategoria = 0;
                    }
                  }
                  $result_act = $catalogo->obtenerLista("SELECT act.IdTipoActividad,act.IdActividad,act.numeracion,act.Nombre,if(ISNULL(act.IdActividadSuperior),'padre',act.IdActividadSuperior) AS tienepadre , act_padre.Nombre AS padre, act_padre.Numeracion as numpadre
                                                        FROM c_actividad act
                                                        LEFT JOIN c_actividad act_padre  ON act_padre.IdActividad = act.IdActividadSuperior
                                                        WHERE act.IdActividad = ".$row['act_principal']);
                  while ($row_act = mysqli_fetch_array($result_act)){
                    if($row_act['tienepadre'] != "padre"){//si tiene padre
                      $AGLOBAL = $row_act['tienepadre'];
                      $AGENEREAL = $row_act['IdActividad'];
                      $nomact = $row_act['numpadre'].'.-'.$row_act['padre'];
                    }else{//ya es el padre
                      $AGLOBAL = $row_act['IdActividad'];
                      $nomact = $row_act['numeracion'].'.-'.$row_act['Nombre'];
                      $AGENEREAL = 0;
                    }

                    if($row_act['IdTipoActividad'] == 1){
                      $act_met = "Act: ";
                    }else{
                      $act_met = "META: ";
                    }
                  }




              if($tipo_insumo == 1){

                $onclick_asunto = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=1&nombreUsuario=SN&idUsuario=' . $idUsuario .
                 '&plan=1&Id_eje=' . $row['IdEje'] . '&ACME='.$row['tipoArea'].'&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL .
                 '&AGENE=' . $AGENEREAL . '&periodo=' . $row['periodo_insumo'] . '&check=' . $row['check_'] . '&subcheck=0&regreso=2&tipo_entregable=' . $row['id_tipo'] .
                 '&id_encargado=' . $row['IdEncargado'] . '&id_area=' . $id_area . '"';

                echo '<td>' . $row['Nombre'] . '<br><span style="font-size:.8em;">(Cat: '.$categoria_principal.' '.$subcategoria.' <b> '.$act_met.$nomact.'</b>)</span></td>';
                echo '<td> <progress id="file" style="padding-left: 5px;width: 40px;" max="100" value="'.$row['Avance'].'"></progress> <span>'.$row['Avance'].' %</span> </td>';
                echo '<td>';
                  echo '<span>
                    <a '.$onclick_check .' style="display: inline-block;color:'.$color.'">
                      <i class="fas fa-file-archive" data-toggle="tooltip" data-placement="top" data-original-title="Último archivo"></i>
                    </a>
                      </span>';
                      echo '<span onclick="muestraversiones('."'".$row['Nombre']."'".','.$row['check_'].',1,'.$row['IdActividad'].','.$row['cat_principal'].','.$row['periodo_insumo'].');" style="display: inline-block;color:purple">
                        <i data-toggle="tooltip" data-placement="top" data-original-title="Versiones" class="fas fa-archive">
                        </i>
                      </span>
                      <span><a '.$onclick_asunto.' style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Redactar asunto" class="far fa-edit"></i></a></span>
                      <span onclick="borrar('.$where_borrar.')"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Borrar insumo" class="fa fa-trash"></i></span>';


                  echo '</td>';
              }else{
                $onclick_asunto = 'href="Alta_asunto.php?accion=guardar&tipoPerfil=1&nombreUsuario=SN&idUsuario=' . $idUsuario .
                 '&plan=1&Id_eje=' . $row['IdEje'] . '&ACME='.$row['tipoArea'].'&cate=' . $Id_categoria . '&subcate=' . $Id_subcategoria . '&AGBL=' . $AGLOBAL .
                 '&AGENE=' . $AGENEREAL . '&periodo=' . $row['periodo_insumo'] . '&check=' . $row['check_'] . '&subcheck=0&regreso=2&tipo_entregable=' . $row['id_tipo'] .
                 '&id_encargado=' . $row['IdEncargado'] . '&id_area=' . $id_area . '"';

                echo '<td>' . $row['Nombre'] . '<br><span style="font-size:.8em;">(Cat: '.$categoria_principal.' '.$subcategoria.' <b> '.$act_met.$nomact.'</b>)</span> </td>';
                echo '<td> <progress id="file" style="padding-left: 5px;width: 40px;" max="100" value="'.$row['Avance'].'"></progress> <span>'.$row['Avance'].' %</span> </td>';
                echo '<td>';

                      echo '<span>
                        <a '.$onclick_check .' style="display: inline-block;color:'.$color.'">
                          <i class="fas fa-file-archive" data-toggle="tooltip" data-placement="top" data-original-title="Último archivo"></i>
                        </a>
                      </span>';
                      echo '<span onclick="muestraversiones('."'".$row['Nombre']."'".','.$row['check_'].',1,'.$row['IdActividad'].','.$row['cat_principal'].','.$row['periodo_insumo'].');" style="display: inline-block;color:purple">
                        <i data-toggle="tooltip" data-placement="top" data-original-title="Versiones" class="fas fa-archive">
                        </i>
                      </span>
                      <span><a '.$onclick_asunto.'  style="display: inline-block;color:purple"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Redactar asunto" class="far fa-edit"></i></a></span>
                      <span onclick="borrar('.$where_borrar.')"><i data-toggle="tooltip" data-placement="bottom" data-original-title="Borrar insumo" class="fa fa-trash"></i></span>';




                 echo '</td>';
              }





            echo '<tr>';
          }
          ?>
        </tbody>


      </table>
    </div>
  </body>
  <script type="text/javascript">
  $(document).ready(function() {


      var table = $('#t_insumos').DataTable({
          "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
          },
          "order": [
              [1, "desc"]
          ],
          "scrollX": true,
          responsive: false,
          "searching": false,
          pageLength: 10,
          "scrollY": "370px",
          "scrollCollapse": true,
          "paging": false
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

   function borrar(where){
     $.post("borrar_insumo.php", {
         where:where
     }, function(data) {
       console.log("responde : "+data);
       if(data.indexOf("error") >= 0){//error
           alert("error en borrar insumo");
       }else{//correcto
         $.confirm({
             icon: 'glyphicon glyphicon-ok-sign',
             title: "Insumo borrado correctamente.",
             content: '',
             type: 'dark',
             buttons: {
                 aceptar: {
                     action: function() {
                         $('#modal_insumos_cross').click();
                     }

                 }
             }
         });

       }

     });
   }


  </script>
</html>
