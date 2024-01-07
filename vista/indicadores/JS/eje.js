let listadoeje;
let listadoprueba;
let Eje={
    ObtenerListadoEjes:()=>{
        $("#eje").html("");
        $("#conteoTotales").html("");
    let obj;
    return promise = new Promise((resolve, reject) => {
        $.post("./Conexiones/SelectEje.php",
            (data, status) => {
                if (status == "success") {

                    let obj = JSON.parse(data);
                    let eje=" <th>Área/ Eje</th><th></th>";
                  //  let rows="<th>Total Eje /Total Área</th> <th id='idTotalEjeActividad'></th>";
                    $.each(obj, function (i, item) {
                        eje+="<th>"+item.idEje+".-"+item.Nombre+"</th>";
                    //    rows += "<th idEje='"+item.idEje+"' id='td"+item.idEje+"'>0</th>";

                    });

                    $("#eje").append(eje);
                    //$("#conteoTotales").append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    },2000);


},

TotalEje:(fecha)=>{
    $("#conteoTotales").html("");
    //$("#eje").html("");
    let promes = new Promise((resolve, reject) => {
    //let eje=" <th>Área/ Eje</th><th></th>";
    let rows="<th>Total Eje /Total Área</th> <th id='idTotalEjeActividad'></th>";
        $.post("./Conexiones/SelectEjeTotal.php",
          {fecha:fecha},
            (data, status) => {
                if (status == "success") {

                    let obj = JSON.parse(data);

                    $.each(obj, function (i, item) {
                        //eje+="<th>"+item.Nombre+"</th>";
                        rows += "<th idEje='"+item.IdEje+"' id='td"+item.IdEje+"'>"

                       /* if(item.conteo!=0)
                        {*/
                            rows+="<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"&Anio="+fecha+"&IdEstatus=2' target='_blank'>"+item.conteo+"</a>";
                       /* }
                            else
                            {
                                rows+=item.conteo;
                            } */

                        rows+="</th>";
                    });
                    $("#conteoTotales").append(rows);
                    //$("#eje").append(eje);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });

    promes.then(()=>{ reportes.totalEjeActividad(fecha); });
},

EjeAtendidas:()=>{


        let  obj;
        let promes = new Promise((resolve, reject) => {

            $.post("./Conexiones/SelectTotalAtendidas.php",
                (data, status) => {
                    if (status == "success") {

                    obj = JSON.parse(data);


                    $.each(obj, function (i, item) {


                       /* if(item.conteo!=0)
                        {*/
                            $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"' target='_blank'>"+item.conteo+"</a>");
                       /* }
                            else
                            {
                                $("#td"+item.IdEje).html(item.conteo);
                            } */

                    });

                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });



},

EjeAtendidasFelicitacion:()=>{
    $("#td1").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=1 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td2").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=2 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td3").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=3 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td4").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=4 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td5").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=5 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td6").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=6 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td7").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=7 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td8").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=8 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td9").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=9 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td10").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=10&IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td11").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=11&IdStatus=4&IdTipo=1' target='_blank'>0</a>");


        let  obj;
        let id=1;
        let promes = new Promise((resolve, reject) => {

            $.post("./Conexiones/SelectTotalEjeAtendidasVariable.php",
            {id:id},
                (data, status) => {
                    if (status == "success") {

                    obj = JSON.parse(data);


                    $.each(obj, function (i, item) {


                       /* if(item.conteo!=0)
                        {*/
                            $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"' target='_blank'>"+item.conteo+"</a>");
                       /* }
                            else
                            {
                                $("#td"+item.IdEje).html(item.conteo);
                            } */

                    });

                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });



},

EjeAtendidasSolicitud:()=>{

    $("#td1").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=1 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td2").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=2 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td3").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=3 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td4").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=4 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td5").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=5 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td6").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=6 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td7").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=7 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td8").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=8 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td9").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=9 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td10").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=10&IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td11").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=11&IdStatus=4&IdTipo=2' target='_blank'>0</a>");

    let  obj;
    let id=2;
    let promes = new Promise((resolve, reject) => {

        $.post("./Conexiones/SelectTotalEjeAtendidasVariable.php",
        {id:id},
            (data, status) => {
                if (status == "success") {

                obj = JSON.parse(data);


                $.each(obj, function (i, item) {


                   /* if(item.conteo!=0)
                    {*/
                        $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"&IdStatus=4&IdTipo=2' target='_blank'>"+item.conteo+"</a>");
                   /* }
                        else
                        {
                            $("#td"+item.IdEje).html(item.conteo);
                        } */

                });

                    resolve();
                }
                else {
                    reject();
                }
            });
    });



},

EjeAtendidasQueja:()=>{

    $("#td1").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=1 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td2").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=2 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td3").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=3 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td4").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=4 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td5").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=5 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td6").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=6 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td7").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=7 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td8").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=8 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td9").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=9 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td10").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=10&IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td11").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=11&IdStatus=4&IdTipo=3' target='_blank'>0</a>");

    let  obj;
    let id=3;
    let promes = new Promise((resolve, reject) => {

        $.post("./Conexiones/SelectTotalEjeAtendidasVariable.php",
        {id:id},
            (data, status) => {
                if (status == "success") {

                obj = JSON.parse(data);


                $.each(obj, function (i, item) {


                   /* if(item.conteo!=0)
                    {*/
                        $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"' target='_blank'>"+item.conteo+"</a>");
                   /* }
                        else
                        {
                            $("#td"+item.IdEje).html(item.conteo);
                        } */

                });

                    resolve();
                }
                else {
                    reject();
                }
            });
    });



},
EjePendientes:()=>{

    Eje.ObtenerListadoEjes().then(()=>{
        let  obj;
        let promes = new Promise((resolve, reject) => {

            $.post("./Conexiones/SelectTotalEjePendientes.php",
                (data, status) => {
                    if (status == "success") {

                    obj = JSON.parse(data);

                    $.each(obj, function (i, item) {

                       /* if(item.conteo!=0)
                        {*/
                            $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"' target='_blank'>"+item.conteo+"</a>");
                       /* }
                            else
                            {
                                $("#td"+item.IdEje).html(item.conteo);
                            } */

                    });

                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });

    });

},
EjePendienteFelicitacion:()=>{
    $("#td1").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=1 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td2").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=2 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td3").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=3 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td4").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=4 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td5").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=5 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td6").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=6 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td7").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=7 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td8").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=8 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td9").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=9 &IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td10").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=10&IdStatus=4&IdTipo=1' target='_blank'>0</a>");
    $("#td11").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=11&IdStatus=4&IdTipo=1' target='_blank'>0</a>");


        let  obj;
        let id=1;
        let promes = new Promise((resolve, reject) => {

            $.post("./Conexiones/SelectTotalEjePendienteVariable.php",
            {id:id},
                (data, status) => {
                    if (status == "success") {

                    obj = JSON.parse(data);


                    $.each(obj, function (i, item) {


                       /* if(item.conteo!=0)
                        {*/
                            $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"&IdStatus=4&IdTipo=1' target='_blank'>"+item.conteo+"</a>");
                       /* }
                            else
                            {
                                $("#td"+item.IdEje).html(item.conteo);
                            } */

                    });

                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });



},

EjePendienteSolicitud:()=>{

    $("#td1").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=1 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td2").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=2 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td3").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=3 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td4").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=4 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td5").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=5 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td6").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=6 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td7").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=7 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td8").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=8 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td9").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=9 &IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td10").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=10&IdStatus=4&IdTipo=2' target='_blank'>0</a>");
    $("#td11").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=11&IdStatus=4&IdTipo=2' target='_blank'>0</a>");

    let  obj;
    let id=2;
    let promes = new Promise((resolve, reject) => {

        $.post("./Conexiones/SelectTotalEjePendienteVariable.php",
        {id:id},
            (data, status) => {
                if (status == "success") {

                obj = JSON.parse(data);


                $.each(obj, function (i, item) {


                   /* if(item.conteo!=0)
                    {*/
                        $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"&IdStatus=4&IdTipo=2' target='_blank'>"+item.conteo+"</a>");
                   /* }
                        else
                        {
                            $("#td"+item.IdEje).html(item.conteo);
                        } */

                });

                    resolve();
                }
                else {
                    reject();
                }
            });
    });



},

EjePendienteQueja:()=>{

    $("#td1").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=1 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td2").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=2 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td3").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=3 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td4").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=4 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td5").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=5 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td6").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=6 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td7").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=7 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td8").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=8 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td9").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=9 &IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td10").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=10&IdStatus=4&IdTipo=3' target='_blank'>0</a>");
    $("#td11").html("<a href='../Opiniones/ListaOpiniones.php?IdEje=11&IdStatus=4&IdTipo=3' target='_blank'>0</a>");

    let  obj;
    let id=3;
    let promes = new Promise((resolve, reject) => {

        $.post("./Conexiones/SelectTotalEjePendienteVariable.php",
        {id:id},
            (data, status) => {
                if (status == "success") {

                obj = JSON.parse(data);


                $.each(obj, function (i, item) {


                   /* if(item.conteo!=0)
                    {*/
                        $("#td"+item.IdEje).html("<a href='../Opiniones/ListaOpiniones.php?IdEje="+item.IdEje+"IdStatus=4&IdTipo=3' target='_blank'>"+item.conteo+"</a>");
                   /* }
                        else
                        {
                            $("#td"+item.IdEje).html(item.conteo);
                        } */

                });

                    resolve();
                }
                else {
                    reject();
                }
            });
    });



}
}




$(document).ready(function () {

    let fmetricas=$("#fechaMetricas").val();
    Eje.ObtenerListadoEjes();
    Eje.TotalEje(fmetricas);

    $("#fechaMetricas").change(function(){
        fmetricas=$("#fechaMetricas").val();
        areas.TotalArea(fmetricas);
    });

    });
