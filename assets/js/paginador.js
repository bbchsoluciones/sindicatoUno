function paginador(totalRegistros, paginaActual, registrosPorPagina) {
    var rango = 5;
    var start = 0;
    var end = 0;
    var cantPaginas = Math.ceil(totalRegistros / registrosPorPagina);
    var idpagina = "";
    $(".pagination").empty();
    if (paginaActual > 1) {
        // boton pagina anterior
        $(".pagination").append("<li class='page-item'>" +
            "<a class='page-link' aria-label='Previous' href='javascript:void(0)' onclick='cambiarPagina(" + (paginaActual - 1) + ")'>" +
            "<span aria-hidden='true'>&laquo;</span>" +
            "<span class='sr-only'>Previous</span>" +
            "</a>" +
            "</li>"
        );

    } else {

        $(".pagination").append("<li class='page-item disabled'>" +
            "<a class='page-link' aria-label='Previous' href='javascript:void(0)'>" +
            "<span aria-hidden='true'>&laquo;</span>" +
            "<span class='sr-only'>Previous</span>" +
            "</a>" +
            "</li>"
        );

    }
    if (cantPaginas > rango) {
        start = (paginaActual <= rango) ? 1 : (paginaActual - rango);
        end = (cantPaginas - paginaActual >= rango) ? (paginaActual + rango) : cantPaginas;
    } else {
        start = 1;
        end = cantPaginas;
    }
    // listado de botones + boton activo

    for (i = start; i <= end; i++) {
        idpagina = "pagina" + i;
        $(".pagination").append("<li class='page-item'><a class='page-link' aria-label='Previous' href='javascript:void(0)' onclick='cambiarPagina(" + i + ")' id='pagina" + i + "'>" + i + "</a></li>");
        if (parseInt($('#' + idpagina).text()) === paginaActual) {
            $(".page-item").removeClass("active activeP");
            $('#' + idpagina).parent().addClass("active activeP");
        }
    }

    // boton pagina siguiente
    if (paginaActual < cantPaginas) { //*********4
        $(".pagination").append("<li class='page-item'>" +
            "<a class='page-link' aria-label='Next' href='javascript:void(0)' onclick='cambiarPagina(" + (paginaActual + 1) + ")'>" +
            "<span aria-hidden='true'>&raquo;</span>" +
            "<span class='sr-only'>Next</span>" +
            "</a>" +
            "</li>");
    } else {
        $(".pagination").append("<li class='page-item disabled'>" +
            "<a class='page-link' aria-label='Next' href='javascript:void(0)'>" +
            "<span aria-hidden='true'>&raquo;</span>" +
            "<span class='sr-only'>Next</span>" +
            "</a>" +
            "</li>");
    }
}


// ir pagina
function cambiarPagina(pagina) {
    //console.log("ACCION: "+$("#accion").text()+" OBJETO: "+$("#objeto").text()+" PAGINA: "+pagina);
    if ($("#accion").text() != "" && $("#accion").text() === "todo") {
        mostrarTrabajadores(pagina);
    } else if ($("#accion").text() != "" && $("#accion").text() != "todo") {
        if ($("#accion").text() === "buscar") {
            buscarTrabajador(pagina,$("#accion").text(),$("#objeto").text());
        } else {
            ordenarTrabajadores(pagina,$("#accion").text(),$("#objeto").text());
        }
    }
}

// fin ir pagina