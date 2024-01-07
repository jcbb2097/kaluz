let metrica = {
    cargaInicial: () => {

    },
    area: () => {

        let promise = new promise((resolve, reject) => {
            $.post("./Conexiones/SelectArea.php",
                (data, status) => {
                    if (status == "success") {

                        var obj = JSON.parse(data);

                        $.each(obj, function (i, item) {
                            rows += "<option value='" + item.Id_subarea + "'>" + item.nombre + "</option>";
                        });

                        $("#slctSubarea").append(rows);

                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });
    },
    eje: () => {

        let promise = new promise((resolve, reject) => {
            $.post("./Conexiones/SelectEje.php",
                (data, status) => {
                    if (status == "success") {

                        var obj = JSON.parse(data);

                        $.each(obj, function (i, item) {
                            rows += "<option value='" + item.Id_subarea + "'>" + item.nombre + "</option>";
                        });
                        $("#slctSubarea").append(rows);
                        resolve();
                    }
                    else {
                        reject();
                    }
                });
        });
    }


};



$(document).ready(function () {

//metricas.cargaInicial();






});