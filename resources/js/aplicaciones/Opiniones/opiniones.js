$('document').ready(function () {

	
    
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

	$('.a').click(function (e) {
		e.preventDefault();
		$('.a').removeClass('resalta');
		$(this).addClass('resalta');
	});


	$('.b').click(function (e) {
		e.preventDefault();
		$('.b').removeClass('resaltaEstatus');
		$(this).addClass('resaltaEstatus');
	});


});
function muestraDetalle(idArea, idEje, estatus, tipo) {

	$(".h").css('background-color', "#4d4d57");
	$("#myModal").modal({
		backdrop: false
	});
	console.log("estatus : " + estatus);
	$.post("Lista_opiniones.php", {
		IdEje: idEje,
		IdArea: idArea,
		actividad: 1,
		IdEstatus_igual: estatus,
		IdTipo: tipo
	}, function(data) {
		$(".detalle").html('');
		$(".detalle").html(data);
	});

}