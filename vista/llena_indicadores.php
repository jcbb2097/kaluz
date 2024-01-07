<?php
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
	if (isset($_GET['idconv']) ){ $idconv = $_GET['idconv'];}
  if (isset($_GET['usr']) ){ $MiIdUsr = $_GET['usr'];}
  $hoy = date('Y-m-d');
  $mensajes = 0;
  $puedecontestar = 0;
	$areausr = 0;
	$ideje = "";
	$check = "";
	$categoria = "";
	$subcategoria = "";
	$act_glob = "";
	$acme = "";
	$act_gen = "";
	$periodo = "9";


  $resultado= $catalogo->obtenerLista("SELECT per.idArea,CONCAT(per.Nombre,' ',per.Apellido_Paterno) AS nombre from c_usuario usu JOIN c_personas per ON per.id_Personas = usu.IdPersona where usu.IdUsuario = $MiIdUsr");
	while ($row = mysqli_fetch_array($resultado)){
		$areausr = $row["idArea"];
		$nombreusr = $row["nombre"];
	}
	if($areausr == 0){
		echo '<script>
	  	alert("La sesion ha caducado, para un correcto funcionamiento inicie sesion nuevamente.");
	  </script>';
	}
	$resultado= $catalogo->obtenerLista("SELECT if(con.idOrigen = $areausr or con.idDestino = $areausr ,'1','0')AS puedecontestar,conac.idEE as idEntregableEspecifico,conac.idEje
																			, conac.idChecklist, kcha.IdActividad , ca.Idcategoria , cae.descCategoria , cae.nivelCategoria ,ca.IdTipoActividad,
																			if(cae.idCategoriaPadre IS NULL ,'padre',cae2.Idcategoria ) AS categoria_padre,
																			if(ca.IdNivelActividad = 1, 'global','general') nivel , ca.IdActividad as act1, ca2.IdActividad AS act2
                                        FROM  k_conversacion con
																				JOIN k_conversacionActividad conac ON conac.idConversacion = con.idConversacion
																				LEFT JOIN k_checklist_actividad kcha ON conac.idChecklist = kcha.IdCheckList
																				LEFT JOIN c_actividad ca ON ca.IdActividad = kcha.IdActividad
																				LEFT JOIN c_categoriasdeejes cae ON cae.idCategoria = ca.Idcategoria
																				LEFT JOIN c_categoriasdeejes cae2 ON cae2.idCategoria = cae.idCategoriaPadre
																				LEFT JOIN c_actividad ca2 ON ca2.IdActividad = ca.IdActividadSuperior
																				  WHERE con.idConversacion = $idconv");
  while ($row = mysqli_fetch_array($resultado)){
    $puedecontestar = $row["puedecontestar"];
		$entregable_especifico = $row['idEntregableEspecifico'];
		$ideje = $row['idEje'];
		$check = $row['idChecklist'];
		$acme = $row['IdTipoActividad'];
		if($row["nivelCategoria"] != null && $row["nivelCategoria"] == 2){
			$categoria = $row["categoria_padre"];
			$subcategoria = $row["Idcategoria"];
		}else{
			$categoria = $row["categoria_padre"];
		}
		if($row["nivel"] == 'global'){
			$act_glob = $row["act1"];
		}else{
			$act_glob = $row["act2"];
			$act_gen = $row["act1"];
		}
  }

  $resultado= $catalogo->obtenerLista("SELECT con.idConversacion ,con.fechaInicio,estatus FROM  k_conversacion con WHERE con.idConversacion = $idconv");
	while ($row = mysqli_fetch_array($resultado)){
		$estatus = $row["estatus"];
    $fecha_inicio = $row["fechaInicio"];
    $diferencia_dias = date_diff(date_create($fecha_inicio), date_create($hoy));
    $diferencia_dias = $diferencia_dias->format(' %a');
	}
  $resultado= $catalogo->obtenerLista("SELECT count(conres.idConversacion) as mensajes FROM  k_conversacionRespuesta conres WHERE conres.idConversacion = $idconv");
	while ($row = mysqli_fetch_array($resultado)){
		$mensajes = $row["mensajes"];
	}

  $res_abiertos = $catalogo->obtenerLista("SELECT con.idConversacion,conre.idRespuesta , MAX(conre.fecha) fecha,if(con.idOrigen = conre.idArea,'Emisor',if(con.idDestino = conre.idArea,'Receptor','Invitado')) AS tipoer
                          FROM k_conversacion con
                          JOIN k_conversacionRespuesta conre ON conre.idConversacion = con.idConversacion
                          WHERE con.idConversacion = $idconv
                          GROUP BY tipoer
                          ORDER BY fecha");
  $dias_receptor = "";
  $dias_emisor = "";

  while ($row = mysqli_fetch_array($res_abiertos)){
          $fecha = $row["fecha"];
          $tipoer = $row["tipoer"];
          if($tipoer == "Emisor"){

            $dias_emisor = date_diff(date_create($fecha), date_create($hoy));
            $dias_emisor = $dias_emisor->format(' %a');
            if($dias_emisor > 3)
              $dias_emisor = "Inact E<span style='color: #da5930'>".$dias_emisor."</span>";
            else
              $dias_emisor = "Inact E<span style='color: #9ce336'>".$dias_emisor."</span>";
          }else {
            if($tipoer == "Receptor"){
              $dias_receptor = date_diff(date_create($fecha), date_create($hoy));
              $dias_receptor = $dias_receptor->format(' %a');
              if($dias_receptor > 3)
                $dias_receptor = " R<span style='color: #da5930'>".$dias_receptor."</span>";
              else
                $dias_receptor = " R<span style='color: #9ce336'>".$dias_receptor."</span>";
            }

          }
   }

   if($dias_receptor == ""){
     $dias_receptor = date_diff(date_create($fecha_inicio), date_create($hoy));
     $dias_receptor = $dias_receptor->format(' %a');
     if($dias_receptor > 3)
       $dias_receptor = " R<span style='color: #da5930'>".$dias_receptor."</span>";
     else
       $dias_receptor = " R<span style='color: #9ce336'>".$dias_receptor."</span>";
   }

  if($estatus < 3 )
    $mensaje_abierto = " $diferencia_dias días abierto ";
  else{
    $mensaje_abierto = " Asunto cerrado ";
    $dias_emisor = "";
    $dias_receptor = "";
  }

	$resultado= $catalogo->obtenerLista("SELECT count(doc.id_documento) AS total FROM 	c_documento doc	WHERE doc.Asunto = $idconv");
	while ($row = mysqli_fetch_array($resultado)){
		$num_archivos = $row["total"];
	}
 ?>
 <div id="ibloque1" class="ibloque">
    <?php if($puedecontestar == 1){
        echo '<i class="far fa-thumbs-up" onclick="terminarAsunto('.$idconv.');" style="cursor: pointer;"></i>';

    } ?>

 </div>
 <div id="ibloque2" class="ibloque"></div>
 <div id="ibloque3" class="ibloque"><span style="font-size: .8em;"> <?php echo $mensaje_abierto."<br>".$dias_emisor." ".$dias_receptor; ?>  </span></div>
 <div id="ibloque4" class="ibloque"> <?php echo $mensajes; ?> mensaje(s)</div>
 <div id="ibloque5" class="ibloque" onclick="entregables(<?php echo $entregable_especifico; ?>);">I-E: 0% <i class="fas fa-search"></i></div>
 <div id="ibloque6" class="ibloque" onclick="abrirEntregables('1');">I : 0% <span class="badge badge-ent" style="background-color:red; color:white;">1</span></div>
 <div id="ibloque7" class="ibloque" onclick="abrirEntregables('2');">E: 0% <span class="badge badge-ent" style="background-color:red; color:white;">1</span></div>
 <div id="ibloque8" class="ibloque"></div>
 <div id="ibloque9" class="ibloque">
   <i class="fas fa-users" onclick="llenar_invitados(<?php echo $idconv; ?>);" style="cursor: pointer;"></i><br>
                    <!--<i class="fas fa-door-open" onclick="salirAsunto();" style="cursor: pointer;"></i>-->
               </div>
							 <div id="ibloque10" class="ibloque" style="cursor:pointer;" onclick="muestra_archivos(<?php echo $idconv; ?>)">
								 <center>
										 <i class="far fa-folder-open" style="position:relative; top:2px; left:4px; font-size:20px;\"></i>
										 <span id="compartidosN" class="badge badge-dark" style="position:relative; top:2px; left:-10px; z-index:2;font-size: .8em;"><?php echo $num_archivos; ?></span>
									 	<span class="tooltipF" style="position:relative !important;font-size: .7em;">Archivos de asunto</span>
								</center>
							 </div>
							 <div id="ibloque11" class="ibloque toolF" >
								 <button style="font-size:7px!important;" class="btnF btnAct1 btn btn-panel rounded-0 mr-1 active" onclick="filtrarM(1);">Todos</button>
							 </div>
							 <div id="ibloque12" class="ibloque toolF" style="cursor:pointer;">
								 <button style="font-size:7px!important;" class="btnF btnAct1 btn btn-panel rounded-0 mr-1 active" onclick="filtrarM(2);">Directos</button>
							    <!-- <i class="fas fa-folder-open" style="position:relative; top:2px; left:4px; font-size:20px;\"></i><span id="normativosN" class="badge badge-light" style="position:relative; top:2px; left:-10px; z-index:2;font-size: .8em;">0</span>
							   <span class="tooltipF" style="position:relative !important;">Archivos de normatividad</span> -->
							 </div>
							 <div id="ibloque13" class="ibloque">
							 	<button style="font-size:7px!important;    padding: 6px 8px !important;" class="btnF btnAct1 btn btn-panel rounded-0 mr-1 active" onclick="filtrarM(3);">Invitados</button>
							 </div>

 <script type="text/javascript">
	 $( "#nombreusr" ).val("<?php echo $nombreusr;?>");
	$( "#asunto" ).val("<?php echo $idconv;?>");
 $( "#ideje" ).val("<?php echo $ideje;?>");
 $( "#acme" ).val("<?php echo $acme;?>");
 $( "#categoria" ).val("<?php echo $categoria;?>");
 $( "#subcategoria" ).val("<?php echo $subcategoria;?>");
 $( "#act_glob" ).val("<?php echo $act_glob;?>");
 $( "#act_gen" ).val("<?php echo $act_gen;?>");
 $( "#periodo" ).val("<?php echo $periodo;?>");
 $( "#check" ).val("<?php echo $check;?>");

 </script>
