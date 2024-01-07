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

	$host = $_SERVER["HTTP_HOST"];
	$MiIdUsr = "0";
	if (isset($_POST['usr']) ){ $MiIdUsr = $_POST['usr'];}
	$anio = 2020;
	$ejearea = "";
	if (isset($_POST['ejearea']) ){ $ejearea = $_POST["ejearea"];}
	$pos = strpos($host, "administro");
	if($pos === false)
		$sistema = "sie";
	else
		$sistema = "pruebassie/sie";
	$idEje = "";
	$idUsuario = "0";
	$idAreaUsuario = "0";
	$cadenafuncion = "";
	$cadenaTabla = "";
	$i = 1;
	$color = "";
	$ultimaAct = "";
	$onclick = "";
	$icon = "";
	$conver = "";
	$tipoA = "";
	$where = "";
	$group = "";
	$having = "";
	$campos_adicionales = "";
	$join = "";
	$idDestino = "";
	$areausr = "0";
	$puedecontestar = "0";
	$wherepuede = "";
	$evitar_repetidos = "";
	$ultimaAct_texto = "";
	$idcategoria = "";
	$resultado= $catalogo->obtenerLista("SELECT per.idArea from c_usuario usu JOIN c_personas per ON per.id_Personas = usu.IdPersona where usu.IdUsuario = $MiIdUsr");
	while ($row = mysqli_fetch_array($resultado)){
		$areausr = $row["idArea"];
	}
	//ejearea 0 , todos, 1 area , 2 eje
  //rec_env_inv 1 enviados, 2 recibidos , 3 invitados
	if(isset($_POST["rec_env_inv"]))
		$rec_env_inv = $_POST["rec_env_inv"];



	if($ejearea == 0)
		$where = "";

		if(isset($_POST["tipo"])){//este tipo es 1 ,2 ,3 ,4 problematica, solicitud, conocimiento , sugerencia
			$tipo = $_POST["tipo"];
			if($tipo == 0){
				$where .= " AND con.tipo in (1,2,3,4)";
			}else{
				$where .= " AND con.tipo = ".$tipo;
			}

		}
		if(isset($_POST["ejearea_detalle"]) && $_POST["ejearea_detalle"] != 0  && !isset($_POST["noinvitados"]) ){//este ejearea_detalle es para mostrar solo desde el cuadro principal para mostrar en especifico un segundo filtro por area o eje
			$ejearea_detalle = $_POST["ejearea_detalle"];
			if(isset($_POST["tipoejearea_detalle"]) ){//si especifica eje o area se pone el especificado
				if($_POST["tipoejearea_detalle"] == 1){//busca por area
					if($_POST["env_rec_det"] == 1)
						$where .= " AND con.idDestino  = ".$ejearea_detalle;
					if($_POST["env_rec_det"] == 2)
						$where .= " AND con.idOrigen  = ".$ejearea_detalle;
				}
				if($_POST["tipoejearea_detalle"] == 2)//busca por eje
					$where .= " AND conac.idEje  = ".$ejearea_detalle;
			}else{
				if($ejearea == 1){//si es area busca detalle por eje
					$where .= " AND conac.idEje  = ".$ejearea_detalle;
				}else {//si es eje busca detalle por area
				switch ($rec_env_inv) {
					case 1:
						 $ogdes = " con.idOrigen ";
						break;
					case 2:
							$ogdes = " con.idDestino ";
							$evitar_repetidos = " AND con.idOrigen <> $ejearea_detalle";
							break;
					case 3:
							$ogdes = " conva.idArea ";
							$wherepuede = " or conva.idArea = $areausr ";
							break;
					default:
						break;
				}
						$where .= " AND $ogdes = ".$ejearea_detalle ." $evitar_repetidos ";

				}
			}

		}
		if(isset($_POST["estatus"]) && $_POST["estatus"] != 0){//estatus  sin leer 1 , en conversacion 2 , 3 y 4 cerrado
			$estatus = $_POST["estatus"];
			if($estatus == 8){ //muestra todos
				$where .= " AND con.estatus in(1,2,3,4)";
			}else{
				if($estatus == 7){//muestra solo los abiertos
					$where .= " AND con.estatus in(1,2) ";
				}else{//  muestra en especifico los que vengan
					if($estatus == 3 || $estatus == 4)//cerrados
						$where .= " AND con.estatus in(3,4)";
					else
						$where .= " AND con.estatus = ".$estatus; //especifico
				}

			}


		}else{ //si no se especifica , abiertos en todos los demas casos
				$where .= " and con.estatus NOT IN(3,4) ";
		}

	if($ejearea == 1){
		$idarea = $_POST["ideje_area"];
		$categoria = $_POST["categoria"];
		$dias = $_POST["dias"];
		switch ($rec_env_inv) {
			case 1:
				 $ogdes = " con.idOrigen ";

				break;
			case 2:
					$ogdes = " con.idDestino ";
					$evitar_repetidos = " AND con.idOrigen <> $idarea";
					break;
			case 3:
					$ogdes = " conva.idArea ";
					$wherepuede = " or conva.idArea = $areausr ";
					break;
			default:
				break;
		}

			$where .= " AND $ogdes = ".$idarea." $evitar_repetidos ";


		if($categoria != 0 || $rec_env_inv == 3 ){//invitados o para los que buscamos que muestren totales de env y rec
			$group = " GROUP BY con.idConversacion ";
			$campos_adicionales = " DATEDIFF(NOW(),MAX(conre_1.fecha)) AS ultimaatencion,if(MAX(conre_1.fecha)  = con.fechaInicio,'0','1') AS tuvoaccion, ";
			$join = " JOIN k_conversacionRespuesta conre_1 ON con.idConversacion = conre_1.idConversacion AND conre_1.idArea = $ogdes ";
			if($rec_env_inv == 3){//solo para mostrar invitados
				$campos_adicionales = " if(ISNULL(conre_1.idRespuesta),'Nunca','si') AS hacontestado ,  ".$campos_adicionales;
				$join = " JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion AND conva.idArea NOT IN (con.idOrigen,con.idDestino)
				 					 left $join";
			}
		}
		switch ($categoria) {
			case 1:
				if($rec_env_inv == 3){
					$having = "HAVING hacontestado = 'Nunca' ";
				}elseif($rec_env_inv == 2){ //solo para los recibidos hacemos left join y añadimos la clausula where
					$join = " left $join";
					$where .= " AND conre_1.fecha IS null ";
				}else{
					$having = " HAVING tuvoaccion = 0 ";
				}

				break;
			case 2:
					if($rec_env_inv == 3){
						$having = "HAVING hacontestado = 'si' AND ultimaatencion > $dias ";
					}else{
						$having = " HAVING tuvoaccion = 1 AND ultimaatencion > $dias";
					}

				break;
			case 3:
				if($rec_env_inv == 3){
					$having = "HAVING hacontestado = 'si' AND ultimaatencion <= $dias";
				}else{
					$having = " HAVING tuvoaccion = 1 AND ultimaatencion <= $dias";
				}
				//$join .= " AND conre_1.idArea = con.idDestino ";
				break;

			default:
				break;
		}

	}
	if($ejearea == 2){
		$ideje = $_POST["ideje_area"];
		$where .= " AND conac.idEje = ".$ideje;
	}

	if(isset($_POST["noinvitados"])){//solo en el caso especifico de ser no invitados
		$idarea = $_POST["ideje_area"];
		$ejearea_detalle = $_POST["ejearea_detalle"];
		$cons = "		SELECT 0 AS  puedecontestar,con.estatus,con.idConversacion,con.idOrigen,con.idDestino,con.tipo,ca_ori.Nombre AS areaorigen,ca_des.Nombre AS areades,
						CONCAT(eje.idEje,' .- ',eje.Nombre) AS eje,eje.idEje,per_ori.id_Personas as personaorigen,per_des.id_Personas as personadestino,conre.respuesta,date_format(con.fechaInicio, '%d-%M-%Y %H:%i') as fechaInicio,con.asunto,
						concat(per_ori.Nombre,' ',per_ori.Apellido_Paterno,' ',per_ori.Apellido_Materno) as nombreUsuario_origen,
						concat(per_des.Nombre,' ',per_des.Apellido_Paterno,' ',per_des.Apellido_Materno) as nombreUsuario_destino,
						conac.idEE as idEntregableEspecifico,conac.idGlobal,conac.idGeneral,conac.idParticular,conac.idSub,conac.idCategoria
								  FROM k_conversacion con
								  JOIN k_conversacionActividad conac ON conac.idConversacion = con.idConversacion
								  JOIN k_conversacionRespuesta conre ON con.idConversacion = conre.idConversacion AND conre.orden = 1
								  JOIN c_eje eje on  eje.idEje = conac.idEje
								  left JOIN c_usuario usu_ori ON usu_ori.IdUsuario = con.idUsuarioOrigen
								   left JOIN c_personas per_ori on per_ori.id_Personas =  usu_ori.IdPersona
								   LEFT JOIN c_personas per_des on per_des.id_Personas =  con.idUsuarioDestino
                            JOIN c_area ca_ori ON ca_ori.Id_Area = con.idOrigen
						 			 JOIN c_area ca_des ON ca_des.Id_Area = con.idDestino
                             WHERE con.estatus NOT IN(3,4)  AND con.idDestino not IN ( $idarea ) and con.idOrigen not IN ( $idarea )  AND  con.idOrigen = $ejearea_detalle
									  AND con.idConversacion NOT IN (SELECT con.idConversacion FROM k_conversacion con
                             JOIN k_conversacionArea conva ON con.idConversacion = conva.idConversacion
									  AND conva.idArea NOT IN (con.idOrigen,con.idDestino) AND conva.idArea = $idarea
                             WHERE con.estatus NOT IN(3,4)  AND con.idDestino not IN ( $idarea ) and con.idOrigen not IN ( $idarea ) ) order by con.fechaInicio desc ";
	}else{// la consulta armada normal , en todos los casos menos en no invitados
		$cons = " SELECT  $campos_adicionales
							if(con.idOrigen = $areausr or con.idDestino = $areausr $wherepuede ,'1','0')AS puedecontestar,
							con.estatus,con.idConversacion,con.idOrigen,con.idDestino,con.tipo,ca_ori.Nombre AS areaorigen,ca_des.Nombre AS areades,
							CONCAT(eje.idEje,' .- ',eje.Nombre) AS eje,eje.idEje,per_ori.id_Personas as personaorigen,per_des.id_Personas as personadestino,conre.respuesta,date_format(con.fechaInicio, '%d-%M-%Y %H:%i') as fechaInicio,con.asunto,
							concat(per_ori.Nombre,' ',per_ori.Apellido_Paterno,' ',per_ori.Apellido_Materno) as nombreUsuario_origen,
							concat(per_des.Nombre,' ',per_des.Apellido_Paterno,' ',per_des.Apellido_Materno) as nombreUsuario_destino,
							conac.idEE as idEntregableEspecifico,conac.idGlobal,conac.idGeneral,conac.idParticular,conac.idSub,conac.idCategoria
							 FROM k_conversacion con
							 JOIN k_conversacionActividad conac ON conac.idConversacion = con.idConversacion
							 JOIN k_conversacionRespuesta conre ON con.idConversacion = conre.idConversacion AND conre.orden = 1

							 $join
							 JOIN c_eje eje on  eje.idEje = conac.idEje
							 left JOIN c_usuario usu_ori ON usu_ori.IdUsuario = con.idUsuarioOrigen
							left JOIN c_personas per_ori on per_ori.id_Personas =  usu_ori.IdPersona
							left JOIN c_personas per_des on per_des.id_Personas =  con.idUsuarioDestino
							 JOIN c_area ca_ori ON ca_ori.Id_Area = con.idOrigen
							 JOIN c_area ca_des ON ca_des.Id_Area = con.idDestino
							 WHERE 1 $where $group $having  order by con.fechaInicio desc ";
	}
// echo $cons;
  $result= $catalogo->obtenerLista($cons);
  while ($rs = mysqli_fetch_array($result)){
		$puedecontestar = $rs['puedecontestar'];
		$estatus = $rs['estatus'];
		$idDestino = $rs['idDestino'];
		$idOrigen  = $rs['idOrigen'];
		$idconv = $rs['idConversacion'];
		$idcategoria = $rs['idCategoria'];
		$tipoasunto = $rs['tipo'];
		$personaorigen = $rs['personaorigen'];
		$personadestino = $rs['personadestino'];
		$entregable_especifico = $rs['idEntregableEspecifico'];
		if(isset($rs['nombreUsuario_origen']) || $rs['nombreUsuario_origen'] != "")
			$usuario_enviado_por = $rs['nombreUsuario_origen'];
		else
			$usuario_enviado_por = "sin informacion";
		if(isset($rs['nombreUsuario_destino']) || $rs['nombreUsuario_destino'] != "")
			$usuario_recibido_por = $rs['nombreUsuario_destino'];
		else
			$usuario_recibido_por = "sin informacion";
		$eje = $rs['eje'];
		$id_eje = $rs['idEje'];
		$areaorigen = $rs['areaorigen'];
		$areadestino = $rs['areades'];
		$asuntodesc = $rs['asunto'];
		$respuestadesc = $rs['respuesta'];
		$fecha = $rs['fechaInicio'];

		if($estatus == 1){
			$color = "background-color: #d8534f;";
			//$icon = "<i onclick='responder(".$idconv.")' style='cursor:pointer;' class='fas fa-user-edit'></i>";

			$icon = "";//se tiene que poder contestar pero no hay mensajes
			$conver = "<i onclick='conversacion(".$idconv.",".$idDestino.",".$idOrigen.",".$rs['estatus'].",".$puedecontestar.")' style='cursor:pointer;' class='far fa-comments'></i>";

		}else if($rs['estatus'] == 2){
			$color = "background-color: #efd707;";
			//$icon = "<i onclick='responder(".$idconv.")'  style='cursor:pointer;' class='fas fa-user-edit'></i>";
			$icon = "";
			$conver = "<i onclick='conversacion(".$idconv.",".$idDestino.",".$idOrigen.",".$rs['estatus'].",".$puedecontestar.")' style='cursor:pointer;' class='far fa-comments'></i>";
		}else{
			$color = "background-color: #5bb75b;";
			$icon = "";
			$resp = "";
			$conver = "<i onclick='conversacion(".$idconv.",".$idDestino.",".$idOrigen.",".$rs['estatus'].",0)' style='cursor:pointer;' class='far fa-comments'></i>";
		}




		if(isset($rs['idSub']) && $rs['idSub'] != 0 && $rs['idSub'] != ""){
			$ultimaAct = $rs['idSub'];
		}else if(isset($rs['idParticular']) && $rs['idParticular'] != 0 && $rs['idParticular'] != "")
		{
			$ultimaAct = $rs['idParticular'];
		}else if(isset($rs['idGeneral']) && $rs['idGeneral'] != 0 && $rs['idGeneral'] != "")
		{
			$ultimaAct = $rs['idGeneral'];
		}
		else {
			$ultimaAct = $rs['idGlobal'];
		}
		$consulta_act = "SELECT concat(ca.Numeracion,'-',ca.Nombre)as nombre FROM c_actividad ca WHERE ca.IdActividad = $ultimaAct";
		$resultado_act= $catalogo->obtenerLista($consulta_act);
	  while ($row_act = mysqli_fetch_array($resultado_act)){
			$ultimaAct_texto = $row_act['nombre'];
		}
		//sacar avances
		//eje
		$consulta_avance = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
													FROM k_checklist_actividad cha
													JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
													JOIN c_actividad a ON a.IdActividad=cha.IdActividad
													LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
													LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
													LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
													WHERE (a.Anio=2021)
													AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
													AND chani.Visible<>0 AND chani.Anio=2021
													AND acani.Visible<>0 AND acani.Anio=2021
													AND caani.Visible<>0 AND caani.Anio=2021
													AND a.IdEje =  $id_eje ";

			$resul_avance = $catalogo->obtenerLista($consulta_avance);
			while ($row_avance = mysqli_fetch_array($resul_avance)){
				$avance_eje = $row_avance['total'];
			}
			//act
			$consulta_avance_act = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
                                        FROM k_checklist_actividad cha
                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
                                        WHERE (a.Anio=2021)
                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
                                        AND chani.Visible<>0 AND chani.Anio=2021
                                        AND acani.Visible<>0 AND acani.Anio=2021
                                        AND caani.Visible<>0 AND caani.Anio=2021
                                        AND a.IdActividad =  $ultimaAct ";

				$resul_avance_act = $catalogo->obtenerLista($consulta_avance_act);
				while ($row_avance_act = mysqli_fetch_array($resul_avance_act)){
					$avance_act = $row_avance_act['total'];
				}
				//area_origen
				$consulta_avance_ar_or = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
	                                        FROM k_checklist_actividad cha
	                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
	                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
	                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
	                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
	                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
	                                        WHERE (a.Anio=2021)
	                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
	                                        AND chani.Visible<>0 AND chani.Anio=2021
	                                        AND acani.Visible<>0 AND acani.Anio=2021
	                                        AND caani.Visible<>0 AND caani.Anio=2021
	                                        AND a.IdArea =  $idOrigen ";

					$resul_avance_ar_or = $catalogo->obtenerLista($consulta_avance_ar_or);
					while ($row_avance_ar_or = mysqli_fetch_array($resul_avance_ar_or)){
						$avance_ar_or = $row_avance_ar_or['total'];
					}
					//area_destino
					$consulta_avance_ar_des = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
		                                        FROM k_checklist_actividad cha
		                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
		                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
		                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
		                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
		                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
		                                        WHERE (a.Anio=2021)
		                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
		                                        AND chani.Visible<>0 AND chani.Anio=2021
		                                        AND acani.Visible<>0 AND acani.Anio=2021
		                                        AND caani.Visible<>0 AND caani.Anio=2021
		                                        AND a.IdArea =  $idDestino ";

						$resul_avance_ar_des = $catalogo->obtenerLista($consulta_avance_ar_des);
						while ($row_avance_ar_des = mysqli_fetch_array($resul_avance_ar_des)){
							$avance_ar_des = $row_avance_ar_des['total'];
						}
						//persona_envia
						if($personaorigen != null || $personaorigen != ""){
						$consulta_avance_per_or = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
                                        FROM k_checklist_actividad cha
                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
                                        LEFT JOIN c_personas cp ON cp.id_Personas = ch.IdResponsable
                                        WHERE (a.Anio=2021)
                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
                                        AND chani.Visible<>0 AND chani.Anio=2021
                                        AND acani.Visible<>0 AND acani.Anio=2021
                                        AND caani.Visible<>0 AND caani.Anio=2021
                                        AND cp.id_Personas =  $personaorigen ";

							$resul_avance_per_or = $catalogo->obtenerLista($consulta_avance_per_or);
							while ($row_avance_per_or = mysqli_fetch_array($resul_avance_per_or)){
								$avance_per_or = $row_avance_per_or['total'];
							}
							$avance_per_or = $avance_per_or."%";
						}else{
							$avance_per_or = "s/n";
						}
							//persona_recibe
							if($personadestino != null || $personadestino != ""){


							$consulta_avance_per_des = "  SELECT  if(AVG(chani.Avance) IS NULL,0,ROUND(AVG(chani.Avance),1)) total
	                                        FROM k_checklist_actividad cha
	                                        JOIN c_checkList ch ON ch.IdCheckList=cha.IdCheckList
	                                        JOIN c_actividad a ON a.IdActividad=cha.IdActividad
	                                        LEFT JOIN k_checkList_anios chani ON chani.IdCheckList=cha.IdCheckList
	                                        LEFT JOIN k_actividad_anios acani ON acani.IdActividad=cha.IdActividad
	                                        LEFT JOIN k_categoriasdeejes_anios caani ON caani.idCategoria=a.Idcategoria
	                                        LEFT JOIN c_personas cp ON cp.id_Personas = ch.IdResponsable
	                                        WHERE (a.Anio=2021)
	                                        AND ((ch.Nivel=2) OR (ch.Nivel=1 AND ch.Tipo=1))
	                                        AND chani.Visible<>0 AND chani.Anio=2021
	                                        AND acani.Visible<>0 AND acani.Anio=2021
	                                        AND caani.Visible<>0 AND caani.Anio=2021
	                                        AND cp.id_Personas =  $personadestino ";

								$resul_avance_per_des = $catalogo->obtenerLista($consulta_avance_per_des);
								while ($row_avance_per_des = mysqli_fetch_array($resul_avance_per_des)){
									$avance_per_des = $row_avance_per_des['total'];
								}
								$avance_per_des = $avance_per_des."%";
							}else{
								$avance_per_des = "s/n";
							}



		//$ultimaAct = "";
		// if($entregable_especifico > 0 ){
		// 	$onclick = "<p style='cursor:pointer' onclick='entregables(".$entregable_especifico.")' >Insumos y Entregables</p>";
		// }else{
		// 	$onclick = "";
		// }

		//query para cat y SubCategoría
		$desc_categoria = "Sin informacion";
		$desc_subcategoria =  "Sin informacion";
		if($idcategoria != ""){
			$consulta_catsubcat = "  SELECT cate.descCategoria AS cat1desc, cate.idCategoriaPadre, cate2.descCategoria as cat2desc  FROM c_categoriasdeejes cate
																		left JOIN c_categoriasdeejes cate2 ON cate.idCategoriaPadre = cate2.idCategoria
																		 WHERE cate.idCategoria = $idcategoria ";

				$resul_catsubcat = $catalogo->obtenerLista($consulta_catsubcat);
				while ($row_catsubcat = mysqli_fetch_array($resul_catsubcat)){
					if($row_catsubcat['idCategoriaPadre'] != ""){//es subcat y tiene cat padre
						$desc_categoria = $row_catsubcat['cat2desc'];
						$desc_subcategoria = $row_catsubcat['cat1desc'];
					}else{//ya es la categoria
						$desc_categoria = $row_catsubcat['cat1desc'];
						$desc_subcategoria = "No aplica";
					}
				}
		}


		if($tipoasunto == 1){
			$tipoA ="Solicitud";
		}else if($tipoasunto == 2){
			$tipoA ="Conocimiento";
		}else if($tipoasunto == 3){
			$tipoA ="Sugerencia";
		}else{
			$tipoA ="Problemática";
		}

		$cadenaTabla .= "<tr><th style='width: 25px;".$color."' scope='row'>".$i."<br><br>".$conver."<br><br>".$icon."<br><br></th><td id='td_conv_$idconv' ><b>".$tipoA."</b><br>Enviado por : ".$areaorigen."<span style='color: #526ee7'>[Av $avance_ar_or%]</span> (".$usuario_enviado_por."<span style='color: #526ee7'>[Av $avance_per_or]</span>)<br>para: ".$areadestino."
		 <span style='color: #526ee7'>[Av $avance_ar_des%]</span>(".$usuario_recibido_por."<span style='color: #526ee7'>[Av $avance_per_des]</span>)<br><div style='font-size: 8.5px;'>".$eje."<span style='color: #526ee7'>[Av $avance_eje%]</span>  <br>".
		 "Categoria:  $desc_categoria <br>".
		 "Subcategoria: $desc_subcategoria <br>".
		$ultimaAct_texto."<span style='color: #526ee7'>[Av $avance_act%]</span></div> <div class='respuesta'><b style='text-decoration: underline #607D8B;'><i class='glyphicon glyphicon-check' style='font-size: 9px;''></i>".$asuntodesc."</b><br>".$respuestadesc." <div class='fecha'>".$fecha."</div></div> <div class='divResponde' id='responde".$i."'></div></td></tr>";//<td>".$onclick."</td>

		if($estatus <= 2){
		$cadenafuncion .= "function respondeAsunto".$i."(){ $('#responde".$i."').css('display','block');  $('#responde".$i."').html(\"<form><div class='form-group'><textarea style='font-size: 10px;border-radius: 0px;resize: none;' class='form-control' rows='4' maxlength='400' id='comment'></textarea><button style='padding: 1px 6px;font-size: 11px;border-radius: 0px;background-color: #4d4d57;color: white;margin-top: 5px;' type='submit' class='btn btn-default'>Enviar</button></div></form>\"); }";
		}else{
			$cadenafuncion = "";
		}
		$i++;

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<title>::.SIE.::</title>
	<link rel="stylesheet" type="text/css" href="../../../resources/font/index.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<!-- <link rel="stylesheet" type="text/css" href="../Asuntos/libs/css/chat.css"/> -->
   <script src="https://use.fontawesome.com/779a643cc8.js"></script>
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	 <link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>
<body>

	<div class="divIndicador" id="indicadores" style="display: none;">
							<!--<div id="bloqueT" class="ibloque">Indicadores</div>-->
		</div>

<div style="margin-top: 5px;" class="table-wrapper-scroll-y my-custom-scrollbar">
	<table id="table" class="table table-bordered  mb-0">
		<thead></thead>
		<tbody><?php echo $cadenaTabla; ?></tbody>
	</table>
</div>

<div class="responder" id="contestar_barra" style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;display:none;">

		<textarea name="mensaje" id="mensaje" class="form-control type_msg" placeholder="Responde..." style="font-size: 12px; font-family: 'Muli', sans-serif; border-radius: 0px; grid-column: 1 / 2; grid-row: 1 / 3;" maxlength="600"></textarea>

		<span id="enviar2" class="send_btn rounded-0 bg-info" style="width: 30.15px !important;padding-left: 5px;font-size: 20px;grid-column: 2 / 3;grid-row: 1 / 2;padding-top: 2px;"><i class="fas fa-location-arrow"></i></span>

		<span id="adjuntar" class="input-group-text rounded-0" style="width: 30.15px !important;cursor: pointer; grid-column: 2 / 3; grid-row: 2 / 3;padding-top: 4px; padding-left: 7px; font-size: 15px;    background-color: #e9ecef;"><i class="fas fa-paperclip"></i>
		</span>
</div>

<div id="invitados_seccion" style="display: none;background-color: #585066;padding: 10px;" >

</div>


<iframe scrolling="no" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+1)+'px';"  name="myiframe" id="myiframe" src="" style="border: 0;width: 616px;margin-left: 1px;">

</iframe>
<input type="hidden" name="idconv" id="idconv" value="">
<input type="hidden" name="idusr" id="idusr" value="<?php echo $MiIdUsr; ?>">
<input type="hidden" name="areausr" id="areausr" value="<?php echo $areausr; ?>">
</body>



<script>
 let array_css = [];
$('document').ready(function(){
	$('#table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            $('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

});

$( "#enviar2" ).click(function() {
		responder();
});
$( "#adjuntar" ).click(function() {
		adjuntarArchivo();
});

$("#Modal_insumos").draggable({
    handle: ".modal-header"
});



function entregables(idEntregableEspecifico){
	var idEntregableEspecifico = idEntregableEspecifico;
	var idUsuario = $( "#idusr" ).val() ;
	$(".h").css('background-color',"#4d4d57");
  $("#Modal_insumos").modal({backdrop: false});
	$("#titulo_modal_insumos").html("Insumos");

  $.post("../Planeacion/Insumos.php?accion=guardar&idEntregable="+idEntregableEspecifico,{idUsuario:idUsuario}, function(data) {
    $(".detalleinsumos").html('');
    $(".detalleinsumos").html(data);
  });
	//$('iframe#myiframe').attr('src','/<?php echo $sistema; ?>/vista/apps/Planeacion/Insumos.php?accion=guardar&idEntregable='+idEntregableEspecifico);
}

function responder(){
	var idConversacion = $( "#idconv" ).val() ;
	var idUsuario = $( "#idusr" ).val() ;
	var areausr = $( "#areausr" ).val() ;
	var mensaje = $( "#mensaje" ).val() ;
	var iframe = document.getElementById("myiframe");
  var html = "";

	if(idUsuario == 0 ){
		alert("Error :  sesion caducada, debe volver a iniciar sesión para proceder.");
	}else{
		$.post("inserta_respuesta.php", {idConversacion:idConversacion,mensaje: mensaje,idUsuario:idUsuario,areausr:areausr},function(data, status) {
						if (status == "success") {
										if(data.indexOf("exito")){
											//alert(" Respuesta enviada con éxito. ");
											$('#contestar_barra').hide();
											iframe.contentWindow.document.open();
											iframe.contentWindow.document.write(html);
											iframe.contentWindow.document.close();
										}
						}else{
							alert("Ocurrio un error");
						}
				});
	}

}


function conversacion(idConversacion,idDestino,idOrigen,estatus,puedecontestar){
	var idConversacion = idConversacion;
	var idDestino = idDestino;
	var idOrigen = idOrigen;
	$('#idconv').val(idConversacion);

	if(estatus < 3 && puedecontestar == 1){//solo mostramos los que no esten ya cerrados ,y los que pueda contestar
		$('#mensaje').val("");
		$('#contestar_barra').show();
	}
	llenar_indicadores(idConversacion);
	reset_diseno();
	array_css.push(idConversacion);
	$('#td_conv_'+idConversacion).css("color", "white");
	$('#td_conv_'+idConversacion).css("background", "#464456");

	$('iframe#myiframe').attr('src','/<?php echo $sistema; ?>/vista/indicadores/asuntos/ejeArea/conversacion.php?idConversacion='+idConversacion+'&idDestino='+idDestino+'&idOrigen='+idOrigen);
}

function llenar_indicadores(id_conversacion){
	var usr = $('#idusr').val();
	$("#indicadores").load("llena_indicadores.php?idconv="+id_conversacion+"&usr="+usr);
	$('#indicadores').show();
}

function llenar_invitados(id_conversacion){
	var usr = $('#idusr').val();
	$("#invitados_seccion").load("llena_invitados.php?idconv="+id_conversacion+"&usr="+usr);
	$('#invitados_seccion').show();
}
function filtrarM(tipo) {
	var obj, i;
	console.log("entra : "+tipo);
	if(tipo==1) {

		obj = window.frames['myiframe'].document.getElementsByClassName("msj");
		for (i = 0; i < obj.length; i++) {
			obj[i].parentNode.removeAttribute('style');
		}
		obj = window.frames['myiframe'].document.getElementsByClassName("msj_inv");
		for (i = 0; i < obj.length; i++) {
			obj[i].parentNode.removeAttribute('style');
		}
	} else if(tipo == 2) {


		obj = window.frames['myiframe'].document.getElementsByClassName("msj");
		for (i = 0; i < obj.length; i++) {
			obj[i].parentNode.removeAttribute('style');
		}
		obj = window.frames['myiframe'].document.getElementsByClassName("msj_inv");
		for (i = 0; i < obj.length; i++) {
			obj[i].parentNode.style.setProperty('display', 'none');
		}
	} else if(tipo == 3) {
	// $('.btnAct3').addClass('active');
	// $('.btnAct2').removeClass('active');
	// $(".btnAct1").removeClass('active');
	// $('.btnAct4').removeClass('active');

		obj = window.frames['myiframe'].document.getElementsByClassName("msj");
		for (i = 0; i < obj.length; i++) {
			obj[i].parentNode.style.setProperty('display', 'none');
		}
		obj = window.frames['myiframe'].document.getElementsByClassName("msj_inv");
		for (i = 0; i < obj.length; i++) {
			obj[i].parentNode.removeAttribute('style');
		}
	}
}

function reset_diseno(){
	if(array_css.length > 0){
		array_css.forEach( function(valor, indice, array) {
			$('#td_conv_'+valor).css("color", "black");
			$('#td_conv_'+valor).css("background", "#ffffff");
		});
	}
}

function terminarAsunto(idconv){



			$.confirm({
				title: 'Confirmación',
				content: '¿Desea terminar el asunto?',
				autoClose: 'cancelar|8000',
				type: 'dark',
				typeAnimated: true,
				buttons: {
					aceptar: {
						btnClass: 'btn-dark',
						action: function() {
							$.post("termina_asunto.php", {idConversacion:idconv},function(data, status) {
											if (status == "success") {
															if(data.indexOf("exito")){

																	window.location.reload(true);
															}
											}else{
												alert("Ocurrio un error");
											}
									});
						}
					},
					cancelar: function() {
						$.alert('Cancelado!');
					}
				}
			});

}
$("#cerrarInv").click(function(){
	$("#cajaI").html("");
		$("#cajaI").hide();
	});



	function eliminar(am){
			$("#areaI"+am).remove();
			$("#invA"+am).remove();
	}
	function cerrar_invitados(){
		$("#invitados_seccion").hide() ;
	}

	$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();



});

function muestra_archivos(asunto,tipo_muestra){
	var asunto = asunto;
	var idUsuario = $( "#idusr" ).val() ;
	var check = $( "#check" ).val();
	if(check == undefined || check == ""){
		check = 0;
	}

	$(".h").css('background-color',"#4d4d57");
  $("#Modal_insumos").modal({backdrop: false});
	$("#titulo_modal_insumos").html("Archivos relacionado a asunto");

  $.post("Archivos.php?&idasunto="+asunto+"&check="+check+"&tipo_muestra="+tipo_muestra,{idUsuario:idUsuario}, function(data) {
    $(".detalleinsumos").html('');
    $(".detalleinsumos").html(data);
  });
	//$('iframe#myiframe').attr('src','/<?php echo $sistema; ?>/vista/apps/Planeacion/Insumos.php?accion=guardar&idEntregable='+idEntregableEspecifico);
}

<?php echo $cadenafuncion; ?>
</script>
</html>
