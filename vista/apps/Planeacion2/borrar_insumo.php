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
    $where = "";

    if (isset($_POST['where']) ){ $where = $_POST['where'];}

    if($where != ""  ){

              $delete = "DELETE FROM k_checkListEntregableInsumo
               WHERE 1 $where ";
            //echo "delete : ".$delete;
            $ID_NUEVO = $catalogo->insertarRegistro($delete);
            //echo "resultado : ".$ID_NUEVO;

        if(strpos($ID_NUEVO,"error") === false){
          echo "Borrado con exito";
        }else{
          echo "ocurrio un error al borrar";
        }

    }else{
      echo "Hubo un error con los datos";
    }
 ?>
