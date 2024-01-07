<?php
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

    $idConversacion = "";
  	if (isset($_POST['idConversacion']) ){ $idConversacion = $_POST['idConversacion'];}

    if($idConversacion != ""){

        //update en k_conversacion
        $consulta = "UPDATE k_conversacion SET fechaFin = NOW() , estatus = 3  where idConversacion = $idConversacion";
        //echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_conversacion', 'idConversacion = ' . $idConversacion);

        if($query > 0){
          echo "cerrado con exito";
        }else{
          echo "ocurrio un error al cerrar";
        }

    }else{
      echo "Hubo un error con los datos";
    }




 ?>
