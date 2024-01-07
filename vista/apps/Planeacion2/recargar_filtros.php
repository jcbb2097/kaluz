
<?php

include_once('../../../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
$nombreUsuario = "";
$idUsuario = "";
$where = "";
if ((isset($_GET['eje'])      && $_GET['eje'] != ""))          { $eje=$_GET['eje']; }
if ((isset($_GET['periodo'])      && $_GET['periodo'] != ""))          { $periodo=$_GET['periodo'];   }
if ((isset($_GET['Id_categoria'])      && $_GET['Id_categoria'] != ""))          {$Id_categoria =$_GET['Id_categoria'];}
if ((isset($_GET['Id_subcategoria'])      && $_GET['Id_subcategoria'] != ""))          {$Id_subcategoria =$_GET['Id_subcategoria'];}
if ((isset($_GET['Id_act'])      && $_GET['Id_act'] != ""))          {$Id_act =$_GET['Id_act'];}
if ((isset($_GET['actmet'])      && $_GET['actmet'] != ""))          {$acme =$_GET['actmet'];}



 ?>
          <?php

          $anio = 0;
              $resultanios = $catalogo->obtenerLista(" Select * from c_periodo where Id_Periodo = $periodo ");
              while ($row_a = mysqli_fetch_array($resultanios)){
                $anio = $row_a['Periodo'];
              }


          //echo $insumos;
          if ((isset($_GET['eje'])      && $_GET['eje'] != "0")){
            echo '<option value="0">Selecciona una categoria</option>';
            $select = " SELECT  cat.idEje,cat.descCategoria AS tienepadre_desc ,
			               cat.idCategoria AS tienepadre_id
                    FROM  c_categoriasdeejes cat
                    JOIN  k_categoriasdeejes_anios catan ON catan.idCategoria  = cat.idCategoria AND catan.Visible = 1
                    WHERE   catan.Anio = $anio AND cat.idEje = $eje  and catan.ACME = $acme  ORDER BY  cat.orden  ";

                    $resultselect = $catalogo->obtenerLista($select);
                    while ($row_cat = mysqli_fetch_array($resultselect)) {

                      if(strlen($row_cat['tienepadre_desc']) > 120)
                        $row_cat['tienepadre_desc'] = substr($row_cat['tienepadre_desc'], 0, 120);
                      echo "<option value='".$row_cat['tienepadre_id']."' $sel>".$row_cat['idEje'].".-".$row_cat['tienepadre_desc']."</option>";
                    }
          }
          if ((isset($_GET['Id_categoria'])      && $_GET['Id_categoria'] != "0")){

            echo '<option value="0">Selecciona una subcategoria</option>';
            // SELECT  eje.idEje,cat.descCategoria AS descCategoria ,
            //         cat.idCategoria AS idCategoria
            //         FROM c_checkList ch
            //         JOIN k_checklist_actividad kchac ON ch.IdCheckList = kchac.IdCheckList
            //         JOIN c_categoriasdeejes cat ON cat.idCategoria = kchac.IdCategoria
            //         LEFT JOIN k_categoriasdeejes_anios catan ON catan.idCategoria = cat.idCategoria AND catan.Anio = $anio
            //         LEFT JOIN c_categoriasdeejes cat_padre ON cat_padre.idCategoria = cat.idCategoriaPadre
            //         left JOIN c_actividad act ON act.IdActividad = kchac.IdActividad
            //         left join c_eje as eje on eje.IdEje = act.IdEje
            //         WHERE   kchac.Id_Periodo = $periodo  AND catan.Visible = 1 AND cat.idCategoriaPadre = $Id_categoria GROUP BY cat.idCategoriaPadre ORDER BY idEje , cat.orden
            //
            $resultcat = $catalogo->obtenerLista("SELECT  cat.descCategoria,cat.idCategoria
                                                      FROM  c_categoriasdeejes cat
                                                      JOIN  k_categoriasdeejes_anios catan ON catan.idCategoria  = cat.idCategoria AND catan.Visible = 1
                                                      WHERE   catan.Anio = $anio and cat.idCategoriaPadre = $Id_categoria and catan.ACME = $acme ORDER BY  cat.orden ");

            while ($row_scat = mysqli_fetch_array($resultcat)){
              $sel  = "";
              if(strlen($row_scat['descCategoria']) > 120)
                $row_scat['descCategoria'] = substr($row_scat['descCategoria'], 0, 120);
              echo "<option value='".$row_scat['idCategoria']."' >"." ".$row_scat['descCategoria']."</option>";
            }
          }
          if ((isset($_GET['Id_subcategoria'])      && $_GET['Id_subcategoria'] != "0") && !isset($_GET['Id_act']) ){
            echo '<option value="0">Selecciona una Actividad Global</option>';
            $resultcat = $catalogo->obtenerLista("SELECT act.IdActividad,CONCAT(cat.Numeracion ,' ',act.Nombre) AS nombre,
                                                  if(act.IdTipoActividad = 1 ,' Act ',' Meta ') actmet
                                                  FROM c_actividad act
                                                  JOIN k_actividad_categoria cat ON cat.IdActividad = act.IdActividad
                                                   WHERE cat.IdCategoria = $Id_subcategoria  and act.IdNivelActividad = 1  and act.IdTipoActividad = $acme AND cat.IdPeriodo = $periodo

                                                   ORDER BY act.Orden");

            while ($row_scat = mysqli_fetch_array($resultcat)){
              $sel  = "";
              if(strlen($row_scat['nombre']) > 120)
                $row_scat['nombre'] = substr($row_scat['nombre'], 0, 120);
              echo "<option value='".$row_scat['IdActividad']."' >"." ".$row_scat['nombre']."(".$row_scat['actmet'].")</option>";
            }
          }
          if ((isset($_GET['Id_act'])      && $_GET['Id_act'] != "0")){
            echo '<option value="0">Selecciona una Actividad General</option>';
            $resultcat = $catalogo->obtenerLista("SELECT act.IdActividad,CONCAT(cat.Numeracion ,' ',act.Nombre) AS nombre,act.IdActividadSuperior ,cat.IdCategoria,
                                                  if(act.IdTipoActividad = 1 ,' Act ',' Meta ') actmet
                                                  FROM c_actividad act
                                                  JOIN k_actividad_categoria cat ON cat.IdActividad = act.IdActividad
                                                   WHERE   act.IdNivelActividad = 2   AND act.IdActividadSuperior = $Id_act AND act.IdTipoActividad = $acme  AND cat.IdCategoria = $Id_subcategoria AND cat.IdPeriodo = $periodo 
                                                   ORDER BY act.Orden " );

            while ($row_scat = mysqli_fetch_array($resultcat)){
              $sel  = "";
              if(strlen($row_scat['nombre']) > 120)
                $row_scat['nombre'] = substr($row_scat['nombre'], 0, 120);
              echo "<option value='".$row_scat['IdActividad']."' >"." ".$row_scat['nombre']."</option>";
            }
          }


          ?>

</html>
