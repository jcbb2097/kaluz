$('document').ready(function()
{
	/* validar */
	$("#login-form").validate(
	{
		rules:
		{
			pass:
			{
				required: true,
			},
			user:
			{
				required: true,
			},
		},
		messages:
		{
            pass:
			{
                required: "Ingresa tu contraseña"
            },
            user: "Ingresa tu usuario",
		},
		submitHandler: submitForm
    });

    function submitForm()
    {
		var data = $("#login-form").serialize();
		var origen = $("#login-origen").val();
		$.ajax({
			type : 'POST',
			url  : '../source/dao/clases/ValidarLogin.php',
			data : data,
			beforeSend: function()
			{
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span>');
				$("#btn-login_asuntos").html('<span class="glyphicon glyphicon-transfer"></span>');
			},
			success :  function(response)
			{
				let obj = JSON.parse(response);
				if(obj.estatus=="1"){
									$("#gif").html('<img src="../resources/img/load.gif" /> &nbsp;');
									if(origen == 0){
										setTimeout(' window.location.href = "index.php"; ',2000);
									}else{
										setTimeout(' window.location.href = "apps/Asuntos_indicadores/estadisticas.php?ejearea=1&idejearea='+obj.area+'" ',2000);
									}
								}else{
									$("#result").fadeIn(1000, function()
									{
										$("#result").html('<div style="margin-bottom: -21px;" class="alert  alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+obj.estatus+' !</div>');
										$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Entrar');
										$("#btn-login_asuntos").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Entrar');
									});
								}
			}
		});
		return false;
	}
    /* login submit */
});

function recuperar(){
	$(".h").css('background-color',"#c2c2c2");
			$("#myModal").modal({backdrop: false});

				$("#titulo_modal").html('Recuperar contraseña ');
				$.post("recuperar_contrasena.php",{}, function(data) {
      $(".detalle").html('');
      $(".detalle").html(data);
      });
}
function asuntos_l(){
	$("#login-origen").val("1");
	$("#login-form").submit();

}
