let areas={
    CallMetricasTodas:(id,fecha)=>{
        let rows="";
        promise=  new Promise((resolve, reject) => {
               $.post("./Conexiones/SelectCallMetricas.php",{
                id:id,
                fecha:fecha
            },
                (data, status) => {
                    if (status == "success") {

                        let obj = JSON.parse(data);
                        let cont=0;

                        $.each(obj, function (i, item) {
                            let eje=1;

                            $.each(item, function (j, item2) {
                                rows+="<td idArea="+id+" idEje="+(eje)+">";
                               // if(item2!=0)
                               /* {*/
                                    rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdEstatus=2' target='_blank'>"+item2+"</a>"+"</td>"
                             /*   }
                                    else{
                                        rows+=item2+"</td>"
                                    } */
                                    eje+=1;
                                });


                        });
                        $("#tbl"+id).append(rows);
                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });
        promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasAtendidas:(id,fecha,nombre)=>{

    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasAtendidas.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {

                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                           // if(item2!=0)
                           // {
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdEstatus=4&IdTipo=4' target='_blank'>"+item2+"</a>"+"</td>"
                           // }
                            //    else{
                            //        rows+=item2+"</td>"
                             //   }
                                eje+=1;
                            });

                            let row=[];
                            row.push(nombre);
                            $.each(item, function (j, item2) {
                               row.push(parseInt(item2));
                            });

                            matriz.push(row);

                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasPendientes:(id,fecha,nombre)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasPendientes.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {

                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        let row=[];
                        row.push(nombre);
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                          /*  if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdEstatus=1&IdTipo=4' target='_blank'>"+item2+"</a>"+"</td>"
                           /* }
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                                row.push(parseInt(item2));
                            });

                            matriz.push(row);

                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return null;});
},
CallMetricasTotalFelicitacion:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasTotalFelicitacion.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                           /* if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=1' target='_blank'>"+item2+"</a>"+"</td>"
                           /* }
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasTotalSolicitud:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasTotalSolicitud.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                           /* if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=2IdTipo=4' target='_blank'>"+item2+"</a>"+"</td>"
                            /*}
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasTotalQueja:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasTotalQueja.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                            /*if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdEstatus=5&IdTipo=3' target='_blank'>"+item2+"</a>"+"</td>"
                           /* }
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasAtendidasFelicitacion:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasAtendidasFelicitacion.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                            /*if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=1&IdEstatus=4' target='_blank'>"+item2+"</a>"+"</td>"
                            /*}
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasAtendidasSolicitud:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasAtendidasSolicitud.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                            /*if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=2&IdEstatus=4' target='_blank'>"+item2+"</a>"+"</td>"
                            /*}
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasAtendidasQueja:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasAtendidasQueja.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                            /*if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=3&IdEstatus=4' target='_blank'>"+item2+"</a>"+"</td>"
                           /* }
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasPendientesFelicitacion:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasPendientesFelicitacion.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                           /* if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=1&IdEstatus=1' target='_blank'>"+item2+"</a>"+"</td>"
                            /*}
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasPendientesSolicitud:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasPendientesSolicitud.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                           /* if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=2&IdEstatus=1' target='_blank'>"+item2+"</a>"+"</td>"
                           /* }
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
CallMetricasPendientesQueja:(id,fecha)=>{
    let rows="";
    promise=  new Promise((resolve, reject) => {
           $.post("./Conexiones/SelectCallMetricasPendientesQueja.php",{
            id:id,
            fecha:fecha
        },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        let eje=1;
                        $.each(item, function (j, item2) {
                            rows+="<td idArea="+id+" idEje="+(eje)+">";

                           /* if(item2!=0)
                            {*/
                                rows+="<a href='../Opiniones/ListaOpiniones.php?IdArea="+id+"&IdEje="+eje+"&IdTipo=3&IdEstatus=1' target='_blank'>"+item2+"</a>"+"</td>"
                           /* }
                                else{
                                    rows+=item2+"</td>"
                                } */
                                eje+=1;
                            });
                    });
                    $("#tbl"+id).append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });
    });
    promise.then(()=>{return rows}).catch(()=>{return});
},
TotalArea: (fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
    var total_por_area = 0;
        $.post("./Conexiones/SelectTotalArea.php",
        { fecha: fecha },
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {

                        areas.CallMetricasTodas(item.Id_Area,fecha);
                        rows+="<tr Id_Area='"+item.Id_Area+"' id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  id='IdTotalArea"+item.Id_Area+"'     class='border_color' scope='row'>"
                        total_por_area+=parseInt(item.conteo);
                       /* if(item.conteo!=0)
                        {*/
                            rows+="<a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.Id_Area+"&Anio="+fecha+"' target='_blank'><a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>"+item.conteo+"</a></a>";
                       /* }
                            else{
                                rows+=item.conteo;
                            } */

                        rows+="</td>";
                        rows+="</tr>"



                    });
                    rows+="";
                    reportes.set_opiniones_sin_area(total_por_area);
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},

TotalAreaAtendidas:()=>{


    $.post("./Conexiones/SelectAreaTotalAtendidas.php",
    (data, status) => {
        if (status == "success") {
            let obj = JSON.parse(data);
            $.each(obj, function (i, item) {
                        $("#IdTotalArea"+item.Id_Area).html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=1&IdEstatus=3' target='_blank'>"+item.conteo+"</a>");
            });
        }
        else {
        }
    });



},
TotalAreaBase:()=>{


        $("#IdTotalArea1").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=1&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea2").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=2&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea3").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=3&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea4").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=4&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea5").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=5&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea6").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=6&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea7").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=7&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea8").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=8&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea9").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=9&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea10").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=10&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea11").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=11&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea12").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=12&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea13").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=13&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea14").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=14&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea15").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=15&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea16").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=16&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea17").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=17&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea18").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=18&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea19").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=19&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea20").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=20&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea21").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=21&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea22").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=22&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea23").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=23&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea24").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=24&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea25").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=25&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea26").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=26&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea27").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=27&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea42").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=42&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea43").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=43&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea44").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=44&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea45").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=45&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea46").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=46&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea47").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=47&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");
        $("#IdTotalArea1000").html("<a  href='../Opiniones/ListaOpiniones.php?IdArea=1000&IdTipo=4&IdEstatus=5' target='_blank'>0</a>");


},
TotalAtendidas:(fecha)=>{
    $("#bodyMetricas").html("");
    let rows=" ";
    let promise = new Promise((resolve,reject)=>{

        $.post("./Conexiones/SelectAreaBase.php",
        (data, status) => {
            if (status == "success") {
                matriz=[];
                let obj = JSON.parse(data);
                matriz=[];
                $.each(obj, function (i, item) {

                    areas.CallMetricasAtendidas(item.Id_Area,fecha,item.Nombre);
                    rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                    rows += "<td id='IdTotalArea"+item.Id_Area+"'  class='border_color' scope='row'><a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>0</a></td>";
                    rows+="</tr>"

                });

               rows+="";
                $("#bodyMetricas").append(rows);
                resolve();
            }
            else {
                reject();
            }
        });


    });

    promise.then(()=>{

        $.post("./Conexiones/SelectAreaAtendidas.php",
        {fecha:fecha},
        (data, status) => {
            if (status == "success") {
                let obj = JSON.parse(data);
                $.each(obj, function (i, item) {

                    $("#IdTotalArea"+item.IdArea).html("<a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>"+item.conteo+"</a>");
                });
            }
        });
    });



},
TotalPendientes:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";

    let promise = new Promise((resolve,reject)=>{
        $.post("./Conexiones/SelectAreaBase.php",

            (data, status) => {
                if (status == "success") {
                    matriz=[];
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {

                        areas.CallMetricasPendientes(item.Id_Area,fecha,item.Nombre);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  id='IdTotalArea"+item.Id_Area+"'  class='border_color' scope='row'><a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>0</a></td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                    resolve();
                }
                else {
                    reject();
                }
            });

        });

        promise.then(()=>{

            $.post("./Conexiones/SelectAreaPendientes.php",
            {fecha:fecha},
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {

                        $("#IdTotalArea"+item.IdArea).html("<a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>0</a>");
                    });
                }
            });

        });
},
TotalFelicitacion:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasTotalFelicitacion(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'><a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>0</a></td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
TotalSolicitud:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasTotalFelicitacion(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'><a  href='../Opiniones/ListaOpiniones.php?IdArea="+item.IdArea+"' target='_blank'>0</a></td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
TotalQueja:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasTotalFelicitacion(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
AtendidasFelicitacion:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasAtendidasFelicitacion(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
AtendidasSolicitud:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasAtendidasSolicitud(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
AtendidasQueja:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasAtendidasSolicitud(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
PendientesFelicitacion:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasPendientesFelicitacion(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
PendientesSolicitud:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasPendientesSolicitud(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
},
PendientessQueja:(fecha)=>{
    $("#bodyMetricas").html("");

    let rows=" ";
        $.post("./Conexiones/SelectAreaBase.php",
            (data, status) => {
                if (status == "success") {
                    let obj = JSON.parse(data);
                    $.each(obj, function (i, item) {
                        areas.CallMetricasPendientesSolicitud(item.Id_Area,fecha);
                        rows+="<tr id='tbl"+item.Id_Area+"'><td  class='border_color' scope='row'>"+item.Nombre+"</td>";
                        rows += "<td  class='border_color' scope='row'>"+item.conteo+"</td>";
                        rows+="</tr>"
                    });
                    rows+="";
                    $("#bodyMetricas").append(rows);
                }
                else {
                }
            });
}

}

$(document).ready(function () {

  let  fmetricas=$("#fechaMetricas").val();
    $("#columnchart_values").html("");
    $("#columnchart_values2").html("");
    areas.TotalArea(fmetricas);

  /*  $("input[type='radio']").change(function(){


    //    if($('#Todos').is(':checked') && $('#Todos2').is(':checked'))
      //  {



        //}

        /*if($('#Atendidas').is(':checked') && $('#Todos2').is(':checked'))
        {
            areas.TotalAtendidas(fmetricas);
            areas.TotalAreaBase();
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");

            Eje.EjeAtendidas();

            areas.TotalAreaAtendidas(fmetricas);
        }
        if($('#Pendientes').is(':checked') && $('#Todos2').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            Eje.EjePendientes();
            areas.TotalPendientes(fmetricas);

        }
        if($('#Todos').is(':checked') && $('#Felicitacion').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            areas.TotalFelicitacion(fmetricas);
            Eje.TotalEje();
        }
        if($('#Todos').is(':checked') && $('#Solicitud').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            areas.TotalSolicitud(fmetricas);
            Eje.TotalEje();
        }
        if($('#Todos').is(':checked') && $('#Queja').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            areas.TotalQueja(fmetricas);
            Eje.TotalEje();
        }
        if($('#Atendidas').is(':checked') && $('#Felicitacion').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            areas.AtendidasFelicitacion(fmetricas);
            Eje.EjeAtendidasFelicitacion();
        }
        if($('#Atendidas').is(':checked') && $('#Solicitud').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            areas.AtendidasSolicitud(fmetricas);
            Eje.EjeAtendidasSolicitud();
        }
        if($('#Atendidas').is(':checked') && $('#Queja').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            areas.AtendidasQueja(fmetricas);
            Eje.EjeAtendidasQueja();
        }
        if($('#Pendientes').is(':checked') && $('#Felicitacion').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            Eje.EjePendienteFelicitacion();
            areas.PendientesFelicitacion(fmetricas);
        }
        if($('#Pendientes').is(':checked') && $('#Solicitud').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            Eje.EjePendienteSolicitud();
            areas.PendientesSolicitud(fmetricas);
        }
        if($('#Pendientes').is(':checked') && $('#Queja').is(':checked'))
        {
            $("#columnchart_values").html("");
            $("#columnchart_values2").html("");
            Eje.EjePendienteQueja();
            areas.PendientessQueja(fmetricas);
        }

    });*/

});
