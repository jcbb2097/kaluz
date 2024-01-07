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
$where = "";
if ((isset($_GET['check'])      && $_GET['check'] != ""))          { $check=$_GET['check']; }
if ((isset($_GET['periodo'])      && $_GET['periodo'] != ""))          { $periodo=$_GET['periodo']; }
if ((isset($_GET['Id_categoria'])      && $_GET['Id_categoria'] != ""))          {$Id_categoria =$_GET['Id_categoria'];}
if ((isset($_GET['act'])      && $_GET['act'] != "0"))          {$act = $_GET['act']; $where = " and kchac.IdActividad = $act " ;}

if (isset($_SESSION['user_session']) ){ $idUsuario = $_SESSION['user_session'];}

 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php $anio = 0;
        $resultanios = $catalogo->obtenerLista(" Select * from c_periodo where Id_Periodo = $periodo ");
        while ($row_a = mysqli_fetch_array($resultanios)){
          $anio = $row_a['Periodo'];
        } ?>

    <table id="selector_insumos" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
        <thead class="thead-dark" style="font-size: .7em;">
            <tr style="background-color: #5a274f;color: white;">
              <th style="padding:3px !important;">Eje</th>
              <th style="padding:3px !important;">Área</th>
              <th style="padding:3px !important;">Categoria</th>
              <th style="padding:3px !important;">Subcategoria</th>
              <th style="padding:3px !important;">Insumo de entrada</th>
              <th style="padding:3px !important;">Selección</th>

            </tr>
        </thead>
        <tbody>
          <?php


          //echo $insumos;
          $tablachecks = "SELECT act.IdEje,eje.Nombre as nombreje,ch.IdCheckList,kchac.Id_Periodo,kchac.IdActividad,if(ISNULL(kchac.Nombre_alterno),ch.Nombre,kchac.Nombre_alterno) as Nombre,if(ISNULL(ch.IdCheckListPadre),'padre',ch.IdCheckListPadre) AS tienepadre,
                            act.Nombre as nomact,act.Numeracion,act.IdTipoActividad,if(ISNULL(kchac.IdEncargado),ca1.Nombre,ca.Nombre) AS area_rec,
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
                    WHERE ch.IdCheckList <> $check AND kchac.Id_Periodo = $periodo AND kchac.Visible = 1  AND catan.Visible = 1 AND ( cat.idCategoria = $Id_categoria OR cat.idCategoriaPadre = $Id_categoria ) $where  ";
          $resultchecks = $catalogo->obtenerLista($tablachecks);
          //echo $tablachecks;
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




            echo '<tr style="font-size: .65em;">';
              echo '<td style="padding:3px !important;">'.$row['IdEje'].'.-'.$row['nombreje'].'</td>';
              echo '<td style="padding:3px !important;">'.$row['area_rec'].'</td>';
              echo '<td style="padding:3px !important;">'.$cat.'</td>';
              echo '<td style="padding:3px !important;">'.$subcat.'</td>';
              echo '<td style="padding:3px !important;">'.$row['Nombre'].'<br>('.$act_met.' '.$row['Numeracion'].'.-'.$row['nomact'].')</td>';
              echo '<td style="padding:3px !important;"><input type="checkbox" onclick="anade_insumo('.$row['IdCheckList'].','.$row['IdActividad'].','.$row['idCategoria'].','.$row['Id_Periodo'].')" name="check_'.$row['IdCheckList'].'" id="check_'.$row['IdCheckList'].'" value=""></td>';
            echo '</tr>';
          }
          ?>
        </tbody>


      </table>
  </body>
  <script type="text/javascript">
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

  </script>
</html>
