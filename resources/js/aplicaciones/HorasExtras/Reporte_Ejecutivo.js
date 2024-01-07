
$(document).ready(function () {
    $('#tArea').DataTable(
        {
            "language":
            {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            },
            "order": [[0, "asc"]]
            //"ordering": false
        });
    $("tr.Galleta_Chica").hide();
    /*     $("tr.Galleta_Grande").click(function () { 
            id = $(this).closest('tr').attr('id');
            $(this).next("tr.Galleta_Chica").toggle();
            alert('entra');
    });  */
    $("tr.Galleta_Grande td").click(function () {
        var idOfParent = $(this).parents('tr').attr('id');
        $('tr.' + idOfParent).toggle('slow');
    });

});

