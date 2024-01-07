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
$estilo = "";
$tipo_muestra = 0;
if ((isset($_GET['idasunto'])      && $_GET['idasunto'] != ""))          { $idasunto=$_GET['idasunto']; }
if ((isset($_GET['check'])      && $_GET['check'] != ""))          { $check=$_GET['check']; }
if (isset($_SESSION['user_session']) ){ $idUsuario = $_SESSION['user_session'];}
if (isset($_GET['tipo_muestra']) ){ $tipo_muestra = $_GET['tipo_muestra'];}

if($tipo_muestra ==  2){//solo entregables
    $where = " and chek.IdCheckList =  $check and d.id_tipo in(9,10,14) ";
    $estilo = "display: none;";
}

 ?>



<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="col-md-12 col-sm-12 col-xs-12" style="<?php echo $estilo; ?>" >
      <label class="col-md-4 col-sm-4 col-xs-4 control-label " for="descripcion" style="text-align: right;" >Tipo Archivo:</label>
      <div class="col-md-8 col-sm-8 col-xs-8">
        <select id="filtro_tipo_arch" class="form-control" name="filtro_tipo_arch" onchange="tipoarch();">
          <option value="1">Relacionados a asunto</option>
          <option value="2">Todos</option>
          <option value="3">Entregables</option>
          <option value="4">Compartidos</option>
          <option value="5">Normatividad</option>
        </select>
      </div>

    </div>

    <div class="" id="recargar_archivos">

    <table id="t_entregableasunto" class="table table-striped table-bordered dataTable display" cellspacing="0" width="100%">
        <thead class="thead-dark">
            <tr style="background-color: #5a274f;color: white;">

                <th>Descripción</th>
                <th>Tipo</th>
                <th>Área</th>
                <th>Fecha subida</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $Entregables = "SELECT 	d.id_documento,d.fechaCreacion,
          d.descripcion,d.ruta,d.pdf,a.Nombre AS area,per.Periodo,
          t.tipo,t.id_tipo,chek.Nombre as checklist,cate.descCategoria as categoria,
          d.id_usuario as baja_mod,
          CONCAT( ac.Numeracion, ac.Nombre ) actividad,
          ac.IdTipoActividad,
          CONCAT( e.orden, '.-', e.Nombre ) eje
      FROM c_documento AS d
      INNER JOIN c_area AS a ON a.Id_Area = d.id_area
      INNER JOIN c_tipo_documento AS t ON t.id_tipo = d.id_tipo
      LEFT JOIN k_archivoactividad k_ar ON d.id_documento = k_ar.id_archivo
      LEFT JOIN c_exposicionTemporal expo ON k_ar.id_exposicion = expo.idExposicion
      LEFT JOIN c_periodo per ON d.anio = per.Id_Periodo
      LEFT JOIN c_actividad ac on ac.IdActividad=k_ar.id_actividad
      LEFT JOIN c_eje e on e.idEje=k_ar.id_proyecto
      LEFT JOIN c_categoriasdeejes cate ON cate.idCategoria=d.IdCategoriadeEje
    LEFT JOIN c_checkList chek on chek.IdCheckList=d.Id_check
      WHERE d.Asunto = $idasunto $where ";
          //echo $Entregables;
          $resultEntregable = $catalogo->obtenerLista($Entregables);
          while ($row = mysqli_fetch_array($resultEntregable)) {
              $id_archivo = $row['id_documento'];
              if ($row['Periodo'] >= '2021') {
                  $ruta_edita = "Alta_entregable_2.php?accion=editar2&id=" . $id_archivo . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario."&regreso=1&plan=2";
              } else {
                  $ruta_edita = "Alta_entregable.php?accion=editar2&id=" . $id_archivo . "&tipoPerfil=1&nombreUsuario=" . $nombreUsuario . "&idUsuario=" . $idUsuario."&regreso=1&plan=2";
              }
              $editar = "onclick='edita($idUsuario,13,\"$ruta_edita\")'";
              $eliminar = "onclick='elimina($idUsuario,13,$id_archivo);'";

              echo '<tr>';
              echo '<td>' . $row['descripcion'] . '</td>';
              $ruta = $row['ruta'] . $row['pdf'];
              if ($row['id_tipo'] == 3) {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
              } else if ($row['id_tipo'] == 4) {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-book"></i></a></td>';
              } else if ($row['id_tipo'] == 5) {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-film"></i></a></td>';
              } else if ($row['id_tipo'] == 6) {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-volume-up"></i></a></td>';
              } else if ($row['id_tipo'] == 7) {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-tasks"></i></a></td>';
              } else if ($row['id_tipo'] == 8) {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;color:black;"><i class="glyphicon glyphicon-picture"></i></a></td>';
              } else if ($row['id_tipo'] == 9 || $row['id_tipo'] == 10 || $row['id_tipo'] == 14) {
                  if ($row['pdf'] == "link") { //si es un link a un archivo
                      echo '<td><a target="_blank" href="' . $row['ruta'] . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-link"></i></a></td>';
                  } else {
                      echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
                  }
              } else {
                  echo '<td><a target="_blank" href="' . $ruta . '" style="text-decoration:none;">' . $row['tipo'] . '<i class="glyphicon glyphicon-file"></i></a></td>';
              }
              echo '<td>' . $row['area'] . '</td>';
              echo '<td>' . $row['fechaCreacion'] . '</td>';
              // echo '<td>';
              // // if ($row['baja_mod'] == $MiIdUsr)   //solo si son archivos del usuario los puede borrar o editar
              //     //echo '<a style="color:purple;cursor:pointer" ' . $eliminar . '><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;<a style="color:purple;cursor:pointer" ' . $editar . '><span class="glyphicon glyphicon-pencil"></span></a>';
              // echo '</td>';
          }
          ?>
        </tbody>

      </table>
      </div>
  </body>
  <script type="text/javascript">
  $(document).ready(function() {


      var table = $('#t_entregableasunto').DataTable({
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

  function tipoarch(){

    $("#recargar_archivos").load("recargar_archivos.php?idasunto=<?php echo $idasunto; ?>&tipo="+$("#filtro_tipo_arch").val()+"&check=<?php echo $check; ?>");
  }
  </script>
</html>
