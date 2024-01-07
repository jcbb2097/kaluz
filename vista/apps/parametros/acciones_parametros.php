<?php
	//Conexion a la BD
	include_once("../../../WEB-INF/Classes/Conexion.class.php");

	$db = new Conexion();

	$db->Conectar();
  if(isset($_REQUEST["action"])){
  	$ACTION = $_REQUEST["action"];
    if (isset($_POST['form'])) {
        $parametros = array();
        parse_str($_POST['form'], $parametros);
        $id = $parametros['id_par'];
        $param = $parametros['parametro'];
        $desc = $parametros['descripcion'];
        $valor = $parametros['valor'];
    }

    switch ($ACTION) {
      case 'eliminar':
          $id = $_POST['idparam'];
          $query_lista = "DELETE FROM c_parametros WHERE  IdParametro= $id;";

          $result1 = $db->Ejecutar($query_lista);

          if($result1 != 0){
            echo 1;
          }else{
            echo 0;
          }
        break;
      case 'modificar':

        $query_lista = "UPDATE c_parametros SET Parametro='$param' , Descripcion = '$desc', Valor = '$valor' WHERE  IdParametro = $id;";

        $result1 = $db->Ejecutar($query_lista);

        if($result1 != 0){
          echo 1;
        }else{
          echo 0;
        }
        break;
      case 'guardar':
          $query = "INSERT into c_parametros (Parametro,Descripcion,Valor) values('".$param."','".$desc."','".$valor."')";// inserta en log el cambio de contraseña
          $res = $db->Ejecutar($query);
          if($res != 0){
            echo 1;
          }else{
            echo 0;
          }
          break;
      default:

        break;
    }
  }

?>
<?php $db->Desconectar(); //Desconecta de la BD?>
