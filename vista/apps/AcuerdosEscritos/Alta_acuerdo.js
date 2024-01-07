$(document).ready(function () {

    var form = "#formAcuerdoEscrito";
    var controller = "../../../WEB-INF/Controllers/AcuerdosEscritos/Controler_acuerdos.php";
    var cont = 0;

    $('#tAcuerdos thead tr').clone(true).appendTo('#tAcuerdos thead');
    $('#tAcuerdos thead tr:eq(1) th').each(function (i) {
        cont++;
        if (cont != 1) {
            var title = $(this).text();
            $(this).html('<input type="text" style="width : 90px;" placeholder="' + title + '" />');

            $('input', this).on('keyup change', function () {
                if ($('#tAcuerdos').DataTable().column(i).search() !== this.value) {
                    $('#tAcuerdos').DataTable()
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        }
    });

    $('#tAcuerdos').DataTable(
        {
            "language":
            {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            //"order": [[0, "asc"]]
            "ordering": false
        });
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
            descripcion: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Ingrese una descripción del acuerdo'
                    },
                    stringLength: {
                        message: 'La descripción sólo acepta máximo 250 caracteres',
                        max: 250
                    }
                }
            }, ano: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija el periodo del acuerdo'
                    }
                }
            }, fechac: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija la fecha'
                    }
                }
            }, persona: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija la persona que convoca'
                    }
                }
            }, categoria: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, Elija la categoría  del acuerdo'
                    }
                }
            }, Eje: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            ActvGlobal: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad '
                    }
                }
            },
            descripcionacuerdo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                }
            },
            tipoacuerdo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            responsableacuerdo:{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo0':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje0': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal0': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo0': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo0':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo1':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje1': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal1': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo1': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo1':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo2':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje2': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal2': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo2': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo2':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo3':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje3': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal3': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo3': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo3':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo4':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje4': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal4': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo4': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo4':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo5':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje5': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal5': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo5': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo5':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo6':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje6': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal6': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo6': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo6':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo7':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje7': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal7': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo7': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo7':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo8':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje8': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal8': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo8': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo8':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo9':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje9': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal9': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo9': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo9':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo10':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje10': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal10': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo10': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo10':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo11':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje11': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal11': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo11': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo11':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo12':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje12': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal12': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo12': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo12':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo13':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje13': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal13': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo13': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo13':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo14':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje14': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal14': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo14': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo14':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo15':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje15': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal15': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo15': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo15':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo16':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje16': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal16': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo16': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo16':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo17':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje17': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal17': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo17': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo17':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo18':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje18': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal18': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo18': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo18':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo19':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje19': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal19': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo19': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo19':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo20':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje20': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal20': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo20': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo20':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo21':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje21': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal21': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo21': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo21':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo22':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje22': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal22': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo22': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo22':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo23':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje23': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal23': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo23': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo23':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo24':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje24': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal24': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo24': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo24':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo25':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje25': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal25': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo25': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo25':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo26':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje26': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal26': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo26': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo26':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo27':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje27': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal27': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo27': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo27':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo28':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje28': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal28': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo28': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo28':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo29':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje29': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal29': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo29': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo29':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo30':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje30': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal30': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'responsableacuerdo30':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo31':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje31': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal31': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo31': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo31':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo32':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje32': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal32': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo32': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo32':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo33':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje33': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal33': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo33': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo33':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo34':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje34': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal34': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo34': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo34':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo35':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje35': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal35': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo35': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo35':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo36':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje36': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal36': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo36': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo36':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo37':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje37': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal37': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo37': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo37':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo38':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje38': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal38': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo38': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo38':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo39':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje39': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal39': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo39': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo39':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo40':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje40': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal40': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo40': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo40':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo41':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje41': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal41': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo41': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo41':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo42':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje42': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal42': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo42': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo42':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo43':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje43': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal43': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo43': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo43':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo44':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje44': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal44': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo44': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo44':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo45':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje45': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal45': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo45': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo45':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo46':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje46': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal46': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo46': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo46':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo47':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje47': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal47': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo47': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo47':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo48':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje48': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal48': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo48': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo48':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo49':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje49': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal49': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'tipoacuerdo49': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            },
            'responsableacuerdo49':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'descripcionacuerdo50':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, llene la descripción del acuerdo '
                    }
                 }
            },
            'Eje50': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un Eje'
                    }
                }
            },
            'ActvGlobal50': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione una Actividad'
                    }
                }
            },
            'responsableacuerdo50':{
                 validators: {
                     notEmpty: {
                        message: 'Por favor, seleccione un responsable del acuerdo '
                    }
                 }
            },
            'tipoacuerdo50': {
                validators: {
                    notEmpty: {
                        message: 'Por favor, seleccione un tipo de acuerdo '
                    }
                }
            }
        }
    });
   
    $("#guardar").click(function (event) {

        //limpiarMensaje();
        event.preventDefault();
        addDynamicValidator(form)
        if ($(form).bootstrapValidator('validate').has('.has-error').length === 0) {
            //console.log("todo validado");
            // cargando();
            var inputs = $("input[type=file]"),
                files = [];
            for (var i = 0; i < inputs.length; i++) {
                files.push(inputs.eq(i).prop("files")[0]);
            }

            var formData = new FormData();
            $.each(files, function (key, value) {
                formData.append(key, value);
            });
            formData.append('form', $(form).serialize());
            formData.append('accion', $("#accion").val());
            formData.append('id', $("#id").val());
            formData.append('usuario', $("#usuario").val());
            $.ajax({
                url: controller,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data, textStatus, jqXHR) {
                    if (data.toString().indexOf("Error:") === -1) {
                        //swal(data,"","success");
                        $.confirm({
                            icon: 'glyphicon glyphicon-ok-sign',
                            title: 'Confirmación',
                            content: data,
                            type: 'dark',
                            typeAnimated: true,
                            buttons:
                            {
                                aceptar:
                                {
                                    btnClass: 'btn-dark',
                                    action: function () {
                                        //$("#formEjes")[0].reset();
                                        // window.location.href = "Lista_acuerdos.php?nombreUsuario=" + $("#nombreUsuario").val() + "&tipoPerfil=" + $("#tipoPerfil").val() + "&idUsuario=" + $("#idUsuario").val();
                                        if ($("#tipo_acuerdo").val() == false && $("#ejeid").val() == false) {
                                            //window.location.href = "Lista_acuerdos.php?nombreUsuario=" + $("#nombreUsuario").val();
                                            window.location.href = "Acuerdopdf.class.php?nombreUsuario=" + $("#usuario").val() + "&IDacuerdoedit=" + $("#id").val() + "&idUsuario=" + $("#idUsuario").val();
                                        } else {
                                            window.location.href = "Vista.php?nombreUsuario=" + $("#nombreUsuario").val() + "&portada=1&tipo_acuerdo=" + $("#tipo_acuerdo").val() + "&ejeid=" + $("#ejeid").val();
                                        }
                                    }
                                }
                            }
                        });

                    } else {
                        // swal(data,'','error');
                        // $("#mensajes").html(data);
                        $.confirm({
                            icon: 'glyphicon glyphicon-remove-sign',
                            title: 'Error',
                            content: data,
                            type: 'red',
                            typeAnimated: true,
                            buttons:
                            {
                                aceptar:
                                {
                                    btnClass: 'btn-dark',
                                    action: function () {

                                    }
                                }
                            }
                        });
                    }
                    //finalizar();
                },
                error: function (data) {
                    console.log("Error al enviar");
                },
                complete: function () {
                }
            });

        } else {
            $.confirm({
                icon: 'glyphicon glyphicon-remove-sign',
                title: 'Error',
                content: 'No es posible guardar el registro, revise los campos obligatorios',
                type: 'red',
                typeAnimated: true,
                buttons:
                {
                    aceptar:
                    {
                        btnClass: 'btn-dark',
                        action: function () {

                        }
                    }
                }
            });
        }
    });

});


function eliminar(Id) {
    //var con = "'"+controller+"'";
    $.confirm({
        icon: 'glyphicon glyphicon-minus-sign',
        title: '¿Desea eliminar el registro?',
        content: 'No podrás revertir los cambios',
        autoClose: 'cancelar|8000',
        type: 'dark',
        typeAnimated: true,
        buttons:
        {
            aceptar:
            {
                btnClass: 'btn-dark',
                action: function () {
                    $.post('../../../WEB-INF/Controllers/AcuerdosEscritos/Controler_acuerdos.php', { id: Id, accion: "eliminar" }, function (data) {
                        if (data.toString().indexOf("Error:") === -1) {
                            //$.dialog(data);
                            $.confirm({
                                icon: 'glyphicon glyphicon-ok-sign',
                                title: data,
                                content: '',
                                type: 'dark',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
                                            location.reload();
                                        }

                                    }
                                }
                            });
                            //location.reload();
                        } else {
                            $.confirm({
                                icon: 'glyphicon glyphicon-remove-sign',
                                title: data,
                                content: '',
                                type: 'red',
                                buttons:
                                {
                                    aceptar:
                                    {
                                        action: function () {
                                            location.reload();
                                        }

                                    }
                                }
                            });
                            //$.dialog(data);
                        }
                        //location.reload();
                    });
                }
            },
            cancelar: function () {
                //$.alert('Cancelado!');
            }
        }
    });
}


function addDynamicValidator(formId) {
    let form = $(formId).data('bootstrapValidator');
    let contador = $('#tamanoArt').val();
    const requiredLabels = ["descripcionacuerdo", "tipoacuerdo", "Eje" , "cate", "ActvGlobal","responsableacuerdo"];
    //Dynamic valitation
    for (let i = 0; i < contador; i++) {
        for (const label of requiredLabels) {
            let target = `#${label}${i}`;
            //removeField es para eliminar form.bootstrapValidator('removeField', campo1);
            form.addField($(target));
        }
    }

}
