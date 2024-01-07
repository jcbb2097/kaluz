
$(document).ready(function(){

    $('#tPersonas').DataTable(
    {
        "scrollX": true,
    	"pageLength": 10,
        "language": 
        {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
        "order": [[ 0, "asc" ]]
        //"ordering": false

    });
});


