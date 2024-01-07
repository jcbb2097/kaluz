const Notify=({
    Basic:(mensaje,tipo)=>{
        var notify = $.notify('<strong>' + mensaje + '</strong> ', {
            type: (tipo==1?'success':'danger'),
            allow_dismiss: true,
            z_index: 9999
        });
    },
    Error:(mensaje)=>{    
    $.notify(mensaje, "error");  
},
    Warning:(mensaje)=>{
        $.notify(mensaje, "warn");
    },
    Info:(mensaje)=>{
        $.notify(mensaje, "info");
    },
    Success:(mensaje)=>{
        $.notify(mensaje, "success");
    }
});