<?php
	//Conexion a la BD
	include_once("../WEB-INF/Classes/Conexion.class.php");
	include_once("../WEB-INF/Classes/Mail.class.php");
	$db = new Conexion();
	$mail = new Mail();
	$db->Conectar();
  if(isset($_POST["correo"])){
  	$correo = $_POST["correo"];
  }
  //comprobar si existe el correo en bd
  $query_lista = "SELECT usu.IdUsuario FROM c_usuario usu
  JOIN c_personas  p ON p.id_Personas = usu.IdPersona
  WHERE p.Correo = '$correo'";
  $usuario = "";
  $result1 = $db->Ejecutar($query_lista);

             while($row = mysqli_fetch_array($result1)){
               $usuario = $row['IdUsuario'];
             }
  if($usuario != ""){
		  //enviar correo
			$res = $mail->enviarMail_recuperar_password($usuario,$correo);
		if($res === true){
			echo '<div style="margin-bottom: -21px;" class="alert alert-success" > <span class="glyphicon glyphicon-info-sign" id="data_result" ><span style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;">Se envió un correo para recuperar contraseña a : "'.$_POST["correo"].' "</span>  </span></div>';
		}else{
			echo "Error : ".$res;
		}

  }else{
    echo '<div style="margin-bottom: -21px;" class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign" id="data_result " > <span style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif;">No existe ningún usuario relacionado al correo : "'.$_POST["correo"].'"</span> </span></div>';
    //echo " No existe ningun usuario relacionado a este correo : '".$_POST["correo"]."'";
		
  }


?>
<?php $db->Desconectar(); //Desconecta de la BD?>
