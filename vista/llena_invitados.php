<?php
session_start();
include_once('../WEB-INF/Classes/Catalogo.class.php');
$catalogo = new Catalogo();
if (isset($_GET['idconv']) ){ $idconv = $_GET['idconv'];}
if (isset($_GET['usr']) ){ $MiIdUsr = $_GET['usr'];}


 ?>


	<div class="row " >
  		<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
					<div class="col-md-8 col-sm-8 col-xs-8">
			  			Invitados
			  		</div>
				  <div class="col-md-4 col-sm-4 col-xs-4">
				    <button id="cerrarE" type="button" class="close crx" aria-label="Close" onclick="cerrar_invitados()">
				    x
				  </button>
				  </div>
				</div>
        <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6">

						<table class="table invTable">
							<tbody>
                <?php
                $cons = " SELECT conva.idArea,ca.Nombre,if(conva.idArea = con.idOrigen,'(Emisor)',if(conva.idArea = con.idDestino,'(Receptor)','')) as tipo FROM k_conversacionArea conva
                          JOIN c_area ca ON ca.Id_Area = conva.idArea
                          JOIN k_conversacion con ON con.idConversacion = conva.idConversacion
                          WHERE conva.idConversacion = $idconv";
                          $contador = 1;
                          $rec_em = "";
                          $res = $catalogo->obtenerLista($cons);
                          while ($rs = mysqli_fetch_array($res)){
                            if($rec_em == $rs['tipo'] && $rs['tipo'] != '')
                              $rs['tipo'] = "(Receptor)" ;
                            echo '<tr>';
                            echo '<td>'.$contador.'</td>';
                            echo '<td>'.$rs['Nombre'].' '.$rs['tipo'].'</td>';
                            echo '</tr>';
                            $rec_em = $rs['tipo'];
                            $contador++;
                          }
                 ?>
              </tbody>
            </table>

        </div>

			<form id="form2" name="form" method="post" action="../Asuntos/index.php?ac=9">


					<div class="col-6">
				            	<div style="display:inline-block; width:60.3px;">Agregar:</div>
			                    <select id="invA" class="form-control form-control-sm cnt-sm s3" style="font-size:12px; display:inline-block;">
			                        <option value="-" selected>Seleccione un área</option>
                              <?php
                                  $consulta = " SELECT ca.Id_Area,ca.Nombre FROM c_area ca WHERE ca.estatus= 1 ";
                                  $resul = $catalogo->obtenerLista($consulta);
                                  while ($rs = mysqli_fetch_array($resul)){
                                    echo '<option value="'.$rs["Id_Area"].'">'.$rs["Nombre"].'</option>';
                                  }
                               ?>
			                     </select>
			                    <div id="involucrados"></div>

			                    <button id="guardarCambios" type="button" class="btn btn-success cnt-sm">
								  	guardar
								</button>
				    </div>

            <input type="hidden" name="idConversacion" id="idConversacion" value="<?php echo $idconv; ?>">
			</form>
      </div>
		</div>
	</div>
  <script type="text/javascript">
  $("#invA").on("change", function(e) {
        e.preventDefault();
    // && $("#invA").val() != "5"
        if($("#invA").val() != "-" && $("#invA"+$("#invA").val()).length == 0 && $("#invE"+$("#invA").val()).length == 0 && $("#invEN"+$("#invA").val()).length == 0) {
            $('#involucrados').append('<span id="areaI'+$("#invA").val()+'" class="badge badge-dark disable-select">'+$("#invA option:selected").text()+' <i class="material-icons text-warning" onclick="eliminar('+$("#invA").val()+')" style="font-size:13px;">backspace</i></span>' );
            $('#involucrados').append('<input id="invA'+$("#invA").val()+'" name="invitados[]" value="'+$("#invA").val()+'" type="hidden">');
            $('#invA option').prop('selected', function() {return this.defaultSelected;});
        } else if($("#invA").val() != "-" && $("#invA"+$("#invA").val()).length == 0 && $("#invE"+$("#invA").val()).length == 0 && $("#invEN"+$("#invA").val()).length != 0) {
          $('#involucrados').append('<span id="areaI'+$("#invA").val()+'" class="badge badge-primary disable-select">'+$("#invA option:selected").text()+' <i class="material-icons text-warning" onclick="eliminar('+$("#invA").val()+')" style="font-size:13px;">backspace</i></span>' );
            $('#involucrados').append('<input id="invA'+$("#invA").val()+'" name="invitadosR[]" value="'+$("#invA").val()+'" type="hidden">');
            $('#invA option').prop('selected', function() {return this.defaultSelected;});
        } else {
            alert("Ya fue agregado o no es posible agregar");
        }
    });
    $('#guardarCambios').click(function() {

      $.ajax({
        type: $('#form2').attr('method'),
        url: $('#form2').attr('action'),
        data: $('#form2').serialize(),
        success: function (data) {
          console.log('Datos enviados !!!');
          $("#invitados_seccion").hide() ;
         }
      });
  			//$.post("index.php",$("#form1").serialize()+"&ac=3");
  	});
  </script>
