<?php
	//Conexion a la BD
	include_once("../WEB-INF/Classes/Conexion.class.php");

	$db = new Conexion();

	$db->Conectar();
  if(isset($_POST["token"])){
  	$token = $_POST["token"];
  }
  if(isset($_POST["cadena"])){
  	$cadena = $_POST["cadena"];
  }

  $token_d = base64_decode($token);
  //comprobar si existe el correo en bd
  $query_lista = "UPDATE c_usuario SET Password='$cadena' WHERE  IdUsuario = $token_d;";

  $result1 = $db->Ejecutar($query_lista);

  if($result1 != 0){
		$query = "INSERT into k_usuarioLog (idUsuario,Accion) values(".$token_d.",3)";// inserta en log el cambio de contraseña

	  $res = $db->Ejecutar($query);
    echo '<div style="margin-bottom: -21px;" class="alert alert-success" > <span class="glyphicon glyphicon-info-sign" id="data_result" ><span style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;">Se actualizo correctamente la contraseña</span>  </span></div>';
    //ir a login
  }else{
    echo '<div style="margin-bottom: -21px;" class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign" id="data_result " > <span style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;">No se pudo completar el cambio de contraseña </span> </span></div>';

  }


?>
<?php $db->Desconectar(); //Desconecta de la BD?>
