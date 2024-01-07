function ejeColor(idEje, altura) {
    var padre = $(window.parent.document);
    var idEje = idEje;
    var altura = altura;
    $(padre).find("p.nEje" + idEje).css("background-color", "#5d2852");
    $(padre).find(".franja").css("height", altura);
    $(padre).find("p.ejeColor" + idEje).css({
        "background-color": "#5d2852"
    });
    if (idEje == 1) {
        $(padre).find("p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 2) {
        $(padre).find("p.nEje1,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 3) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 4) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 5) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 6) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje7,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 7) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje8,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor8,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 8) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje9,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor9,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 9) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje10,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor10,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 10) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje11").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor11").css({
            "background-color": "#a9a9ae"
        });
    }
    if (idEje == 11) {
        $(padre).find("p.nEje1,p.nEje2,p.nEje3,p.nEje4,p.nEje5,p.nEje6,p.nEje7,p.nEje8,p.nEje9,p.nEje10").css("background-color", "#4d4d57");
        $(padre).find("p.ejeColor1,p.ejeColor2,p.ejeColor3,p.ejeColor4,p.ejeColor5,p.ejeColor6,p.ejeColor7,p.ejeColor8,p.ejeColor9,p.ejeColor10").css({
            "background-color": "#a9a9ae"
        });
    }
}