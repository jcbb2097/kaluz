<!DOCTYPE html>
<html>
  <head>
  	<meta charset="utf-8">
    <title>Entregables</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style type="text/css">
.invTable {
	background-color:#f9f9f9;
    font-size: 10px;
}
table.invTable td {
    border: solid;
    border-width: 1px;
    border-color: #d0d0d0;
    font-family: 'Muli', sans-serif;
    padding: 0.3rem;
    white-space: nowrap;
    word-break: keep-all;
}
.cnt-sm {
    height: 26px; 
    line-height: 20px !important;
    font-size:10px !important;
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    border-radius: 0px;
}
.s3 {
    min-width: 150.75px;
    max-width: 150.75px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.crx{
	position: relative;
  top: 0px;
  left: -5px;
  color: white !important;
    text-align: center;
    font-size: 11px;
    font-weight: 700;
    line-height: 1;
    text-shadow: 0 1px 0 #fff;
    opacity: .2;
    font-family: 'Muli', sans-serif;
}
</style>
</head>
<body>
	<div class="row mx-0 px-0" style = "background-color:#585066; width: 542.7px;" >
  		<div class="col-12">
			<form id="form2" name="form" method="post" action="index.php?ac=9">
				<div class="row">
					<div class="col-8">
			  			Invitados
			  		</div>
				  <div class="col-4">
				    <button id="cerrarE" type="button" class="close crx" aria-label="Close">
				    x
				  </button>
				  </div>
				</div>
				<div class="row">
					<div class="col-6">
						<table class="table invTable">
							<?php
								foreach ($this->invitados as $inv) {
									$aux = '';
									if($inv->getOrden()=='1') {
										$aux = '(Emisor)';
									} else if($inv->getOrden()=='2') {
										$aux = '(Receptor)';
									}
									$nombreArea = $inv->getArea();
									if($inv->getEstatus()=='2') {
										$nombreArea = '<del>'.$nombreArea.'</del>';
										echo '<tr><td id="invEN'.$inv->getIdArea().'">'.$inv->getOrden().'</td><td>'.$nombreArea.' '.$aux.'</td></tr>';
									} else {
										echo '<tr><td id="invE'.$inv->getIdArea().'">'.$inv->getOrden().'</td><td>'.$nombreArea.' '.$aux.'</td></tr>';
									}
									
								}
							?>
						</table>
					</div>
					<div class="col-6">
				            	<div style="display:inline-block; width:60.3px;">Agregar:</div> 
			                    <select id="invA" class="form-control form-control-sm cnt-sm s3" style="font-size:12px; display:inline-block;">
			                        <option value="-" selected>Seleccione un área</option>
			                        <?php 
			                        foreach ($this->areas as $area) {
			                            $item = new Area();
			                            $item = $area;
			                            echo '<option value="'.$item->getIdArea().'">'.$item->getNombre().'</option>';
			                        }
			                        ?>
			                    </select>
			                    <div id="involucrados"></div>
			                    <!--<button id="agregarAreas" class="btn btn-info btn-sm"><i class="material-icons">person_add</i></button>-->
			                    <button id="guardarCambios" type="button" class="btn btn-success cnt-sm">
								  	guardar
								</button>
				    </div>
				    
				</div>
				<input type="hidden" name="idConversacion" value="<?php echo $this -> idConversacion; ?>">
				<input type="hidden" name="anio" value="<?php echo $this -> anio; ?>">
		        <input type="hidden" name="idArea" value="<?php echo $this -> idArea; ?>">
		        <input type="hidden" name="idAreaU" value="<?php echo $this -> idAreaU; ?>">
		        <input type="hidden" name="idUsuario" value="<?php echo $this -> idUsuario; ?>">
		        <input type="hidden" name="opcion" value="<?php echo $this -> opcion; ?>">
		        <input type="hidden" name="tipo" value="<?php echo $this -> tipo; ?>">
		        <input type="hidden" name="idEje" value="<?php echo $this -> idEje; ?>">
			</form>
		</div>
	</div>


<script type="text/javascript">
	$("#cerrarInv").click(function(){
		$("#cajaI").html("");
    	$("#cajaI").hide();
  	});
	
	$("#invA").on("change", function(e) {
        e.preventDefault();
		// && $("#invA").val() != "<?php echo $this->idAreaU; ?>" 
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

    function eliminar(am){
        $("#areaI"+am).remove();
        $("#invA"+am).remove();
    }

    $(document).ready(function(){
		$("#cerrarE").click(function(){
		    
		$(".cajaEI").hide(1000) ;
			
		});
    $('[data-toggle="tooltip"]').tooltip();


    $('#guardarCambios').click(function() {
        $(this).closest('form').submit();
        //$.post("index.php",$("#form1").serialize()+"&ac=3");
    });
});
</script>
	</body>
</html>