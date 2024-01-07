$(document).ready(function(){

$('#action_menu_btn').click(function(){
	$('.action_menu').toggle();
});


	$('li').click(function(e) {
	        e.preventDefault();
	        $('li').removeClass('active');
	        $(this).addClass('active');
			$('li').removeClass('clDis');
			$(this).addClass('clDis');
	});

	$('#enviar').click(function() {
        $(this).closest('form').submit();
        // Will also work, but might fail if nesting is changed:
        // $(this).parent().submit();
    });
});
	
	