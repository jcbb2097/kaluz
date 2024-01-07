$(document).ready(function () {
    var form = "#formReporte";

    $(form).bootstrapValidator({
        err: {
            container: 'tooltip'
        },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Reporte: {
                validators: {
                    notEmpty: {
                        message: 'Por favor elija un indicador'
                    }

                }
            },
            fechai: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una fecha de inicio'
                    }
                }
            },
            fechaf: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una fecha final'
                    }
                }
            }
        }
    });
});

   $("#reporte").click(function() { 
        
         $("#reporte2").load("vistaReporte.php?Reporte="+$("#Reporte").val()+"&time="+$("#time").val()+"&fechaf="+$("#fechaf").val()+"&fechai="+$("#fechai").val());
  
  });  
         
 
   
