<?php
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();

    $idConversacion = "";
    $mensaje = "";
    $idUsuario = "";
    $areausr = "";
    $estatus = "";
    $esreceptor = "";
    $act_estatus = "";
  	if (isset($_POST['idConversacion']) ){ $idConversacion = $_POST['idConversacion'];}
    if (isset($_POST['mensaje']) ){ $mensaje = $_POST['mensaje'];}
    if (isset($_POST['idUsuario']) ){ $idUsuario = $_POST['idUsuario'];}
    if (isset($_POST['areausr']) ){ $areausr = $_POST['areausr'];}

    if($idConversacion != "" && $mensaje != "" && $idUsuario != "" ){

      $consulta_estatus = " SELECT con.estatus,if(con.idDestino = $areausr,1,0) AS esreceptor FROM k_conversacion con where idConversacion = $idConversacion ";
      $result_estatus = $catalogo->obtenerLista($consulta_estatus);
                while ($row = mysqli_fetch_array($result_estatus)){
                  $estatus = $row['estatus'];
                  $esreceptor = $row['esreceptor'];
                }

        if($estatus == 1 && $esreceptor == 1){//actualiza el estatus en caso de ser el receptor y que el asunto este en no leido
          $act_estatus = " ,estatus = 2 ";
        }

        //update en k_conversacion
        $consulta = "UPDATE k_conversacion SET fechaRespuesta = NOW() $act_estatus  where idConversacion = $idConversacion";
        //echo $consulta;
        $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_conversacion', 'idConversacion = ' . $idConversacion);

        //insert en 'k_conversacionRespuesta' => ,

        $insert = "INSERT INTO k_conversacionRespuesta (idConversacion,respuesta, idUsuario, idArea, fecha, orden) VALUES ($idConversacion,  ' $mensaje ', $idUsuario, $areausr, NOW(), (SELECT MAX(res.orden)+1 AS nuevoorden FROM k_conversacionRespuesta res WHERE res.idConversacion = $idConversacion) )";
        $ID_NUEVO = $catalogo->insertarRegistro($insert);

        $cons = " SELECT conva.idArea,if(conva.idArea = con.idOrigen,'Emisor',if(conva.idArea = con.idDestino,'Receptor','Invitado')) as tipo, if(conva.idArea = $areausr,'1','0') AS area_cntesta
                  FROM k_conversacionArea conva
                  JOIN k_conversacion con ON con.idConversacion = conva.idConversacion
                  WHERE conva.idConversacion = $idConversacion ORDER BY area_cntesta desc";
        $tipo_area_usr = "";
        $res = $catalogo->obtenerLista($cons);
                  while ($rs = mysqli_fetch_array($res)){
                    if($areausr == $rs['idArea']){
                      $tipo_area_usr = $rs['tipo'];
                      $consulta = "UPDATE k_conversacionArea SET respuestas = 0 , respuestas2 = 0 ,respuestasInv = 0   where idConversacion = $idConversacion and idArea = ".$rs['idArea'];
                    }else{
                      if($tipo_area_usr == "Emisor"){
                        $consulta = "UPDATE k_conversacionArea SET respuestas = 1 , respuestas2 = 0 ,respuestasInv = 0   where idConversacion = $idConversacion  and idArea = ".$rs['idArea'];
                      }
                      if($tipo_area_usr == "Receptor"){
                        $consulta = "UPDATE k_conversacionArea SET respuestas = 0 , respuestas2 = 1 ,respuestasInv = 0   where idConversacion = $idConversacion  and idArea = ".$rs['idArea'];
                      }
                      if($tipo_area_usr == "Invitado"){
                        $consulta = "UPDATE k_conversacionArea SET respuestas = 0 , respuestas2 = 0 ,respuestasInv = 1   where idConversacion = $idConversacion  and idArea = ".$rs['idArea'];
                      }
                    }
                    $query = $catalogo->ejecutaConsultaActualizacion($consulta, 'k_conversacionArea', 'idConversacion = ' . $idConversacion);
                  }



        if($ID_NUEVO > 0){
          echo "Insertado con exito";
        }else{
          echo "ocurrio un error al insertar";
        }

    }else{
      echo "Hubo un error con los datos";
    }




 ?>
