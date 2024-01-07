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
    $Year = date("Y");
    $id_check_entregable = "";
    $idact_entregable = "";
    $id_cat_entregable = "";
    $idanio_entregable = "";
    $insumos = "";

    if (isset($_POST['tipo_insumo']) ){ $tipo_insumo = $_POST['tipo_insumo'];}
  	if (isset($_POST['id_check_entregable']) ){ $id_check_entregable = $_POST['id_check_entregable'];}
    if (isset($_POST['idact_entregable']) ){ $idact_entregable = $_POST['idact_entregable'];}
    if (isset($_POST['id_cat_entregable']) ){ $id_cat_entregable = $_POST['id_cat_entregable'];}
    if (isset($_POST['idanio_entregable']) ){ $idanio_entregable = $_POST['idanio_entregable'];}
    if (isset($_POST['insumos']) ){ $insumos = $_POST['insumos'];}



    if($insumos != "" && $idanio_entregable != "" && $id_check_entregable != "" ){


        $insumo = explode(",", $insumos);

        foreach ($insumo as $datos) {
          //echo $datos." hola ";
          if($datos != ""){
            //echo $datos." hola ";
            $dato = explode("|",$datos);

            if($tipo_insumo == 1){
              $insert = "INSERT INTO k_checkListEntregableInsumo
              (idChecklistInsumoUsado, idActividadInsumoUsado, idCategoriaInsumoUsado, idAnioInsumoUsado, idChecklistEntregable, idActividadEntregable, idCategoriaEntregable,idAnioEntregable, Anio, FechaInsumoRequerido)
              VALUES (".$dato[0].", ".$dato[1].", ".$dato[2].", ".$dato[3].", ".$id_check_entregable.", ".$idact_entregable.", ".$id_cat_entregable.", ".$idanio_entregable.", ".$Year.", now());";
            }else{
              $insert = "INSERT INTO k_checkListEntregableInsumo
              (idChecklistEntregable, idActividadEntregable, idCategoriaEntregable,idAnioEntregable,idChecklistInsumoUsado, idActividadInsumoUsado, idCategoriaInsumoUsado, idAnioInsumoUsado,  Anio, FechaInsumoRequerido)
              VALUES (".$dato[0].", ".$dato[1].", ".$dato[2].", ".$dato[3].", ".$id_check_entregable.", ".$idact_entregable.", ".$id_cat_entregable.", ".$idanio_entregable.", ".$Year.", now());";
            }


            //echo "insert : ".$insert;
            $ID_NUEVO = $catalogo->insertarRegistro($insert);
            //echo "resultado : ".$ID_NUEVO;
          }


        }



        if(strpos($ID_NUEVO,"error") === false){
          echo "Insertado con exito";
        }else{
          echo "ocurrio un error al insertar";
        }

    }else{
      echo "Hubo un error con los datos";
    }
 ?>
