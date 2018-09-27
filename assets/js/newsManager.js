$(function () {
    if ($('body').hasClass('newsManage')) {
        selectNoticia();
    }

    $(document).on('change', '.custom-file :file', function () {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.custom-file :file').on('fileselect', function (event, label) {
        
        var text = $('.custom-file-label'),
            log = label;
        if (text.length) {
            text.text(log);
        } else {
            if (log) alert(log);
        }

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.img-fluid').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

});

$("#crear").click(function (event) {
    limpiarCampo(".msj", "small");
    event.preventDefault();
    var form = $('#news-form')[0];
    form = new FormData(form);
    form.append("registrar_noticia",1);
    $("#crear").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/NoticiaC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                $("#crear").prop("disabled", false);
                var json = JSON.parse(response);
                if (json['clase'] === "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validacion_camposNews(json, indice);
                    });
                } else {
                    limpiarFormulario('#news-form');
                    limpiarCampo(".custom-file-label", "label");
                    limpiarCampo(".dataNews", "input");
                    $(".img-fluid").attr("src", "../../../assets/images/1280x720.png")
                    tinyMCE.activeEditor.setContent("");
                }
                modalInformacion(json);

            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#crear").prop("disabled", false);

        }

    });



});


$("#close_newsE").click(function (event){
    event.preventDefault();
    cerrarNoticiaOverlay();
});
$("#cancel_news").click(function (event){
    event.preventDefault();
    cerrarNoticiaOverlay();
});

function cerrarNoticiaOverlay(){
    $(".card-body").css("min-height","auto");
    $(".overlay_newsE").addClass("d-none");
}
function buscarN(id){
    limpiarCampo(".msj", "small");
    limpiarCampo("#mensaje","#mensaje");
    limpiarFormulario("#news-update-form");
    limpiarCampo(".custom-file-label", "label");
    $('html, body').animate({
        scrollTop: 0
    }, 0);
    var parametros = {
        "id_noticia": id,
        "detalle": 1
    };
    $.ajax({
        url: '../../../controller/NoticiaC.php',
        type: 'GET',
        data: parametros,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                $(".card-body").css("min-height","1000px");
                $("#id_noticia").val(json.noticia[0].id_noticia);
                $("#imagen_noticia").attr("src",json.noticia[0].url_foto_noticia);
                $("#titulo_noticia").val(json.noticia[0].titulo);
                $("#cuerpo").val(json.noticia[0].cuerpo);
                tinyMCE.activeEditor.setContent(json.noticia[0].cuerpo);
                if(json.noticia[0].publicada=="publicada"){
                    json.noticia[0].publicada="on";
                }else{
                    json.noticia[0].publicada="off";
                }
                $('#estado_noticia').bootstrapToggle(json.noticia[0].publicada);
                $(".overlay_newsE").removeClass("d-none");

            } catch (err) {
               
            }

        }
    });
}
$("#update_news").click(function (e){
    e.preventDefault();
    limpiarCampo(".msj", "small");
    limpiarCampo("#mensaje","#mensaje");
    var form = $('#news-update-form')[0];
    form = new FormData(form);
    form.append("actualizar_noticia",1);
    $("#update_news").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/NoticiaC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            try {
                $("#update_news").prop("disabled", false);
                $('html, body').animate({ scrollTop: 0}, 0);
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    Object.keys(json).forEach(function (indice) {
                        validacion_camposNews(json, indice);
                    });
                    $("#mensaje").html('<div class="alert alert-' + json['clase'] + '" role="alert">' +
                    '<strong>' + json['tituloN'] + '</strong> ' + json['mensaje'] + '' +
                    '</div>');
                } else {
                    limpiarFormulario('#news-update-form');
                    limpiarCampo(".custom-file-label", "label");
                    limpiarCampo(".dataNews", "input");
                    $(".img-fluid").attr("src", "../../../assets/images/1280x720.png")
                    tinyMCE.activeEditor.setContent("");
                    $(".overlay_newsE").addClass("d-none");
                    selectNoticia();
                    modalInformacion(json);
                    
                }
                

            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#update_news").prop("disabled", false);

        }

    });

});
function eliminarN(id) {
    var nombre = "noticia";
    var funcion = "eliminarNoticia('"+id+"')";
    modalConfirmarEliminar(nombre,funcion);
}
function eliminarNoticia(id) {
    $("#eliminarN").prop("disabled", true);
    var parametros = {
        "id_noticia": id,
        "eliminar_noticia": 1
    }
    $.ajax({
        type: 'GET',
        url: '../../../controller/NoticiaC.php',
        data: parametros,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                if(json.clase=="success"){
                    selectNoticia();
                }
                modalInformacion(json);
                
                $("#eliminarN").prop("disabled", false);
            } catch (err) {

                $("#eliminarN").prop("disabled", false);
            }
        }
    });
}

/* function selectNoticia() {
    $("tbody").empty();
    clearTable('#tablaNoticias');
    var parametros = {
        "ajax": 'true',
        "selectNoticia": 'selectNoticia'
    };
    $.ajax({
        url: '../../../controller/NoticiaC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            try {

                var tabla = $("#tablaNoticias").DataTable({
                    destroy: true,
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Ver _MENU_ registros",
                        "sZeroRecords":    "No se encontraron noticias",
                        "sEmptyTable":     "No hay noticias registradas",
                        "sInfo":           "_START_ / _END_ (_TOTAL_ registros)",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
                var json = JSON.parse(response);
                for (i = 0; i < json.data.length; i++) {
                    tabla.row.add([
                        json.data[i].id_noticia,
                        '<div class="rowNews"><img class="cover_miniatura" src="' + json.data[i].url_foto_noticia + '"></img></div>',
                        (json.data[i].titulo).substring(0, 25)+"...",
                        json.data[i].publicada,
                        json.data[i].fecha_publicacion,
                        json.data[i].nombres_trabajador,
                        '<div class="row justify-content-center">' +
                        '<button onClick="buscarN(' + json.data[i].id_noticia + ')" class="btn btn-success mr-2"><i class="fas fa-pen-alt"></i></button>' +
                        '<button id="eliminarN" onClick="eliminarN(' + json.data[i].id_noticia + ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>' +
                        '</div>',
                    ]).draw(false).order([5, 'desc']);
                }

            } catch (err) {
                $("tbody").empty();
            }

        }
    });

} */

function selectNoticia() {    
    var parametros = {
        "ajax": 'true',
        "selectNoticia": 'selectNoticia'
    };
    table = $('#tablaNoticias').DataTable( {
        destroy: true,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Ver _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay movimientos registrados",
            "sInfo":           "_START_ / _END_ (_TOTAL_ registros)",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "ajax": {
            "url": "../../../controller/NoticiaC.php",
            "type": "POST",
            "data": parametros
        },
        "columns": [
            { "data": "id_noticia"},
            {
                "render": function (data, type, data, meta) {
                    return '<div class="rowNews"><img class="cover_miniatura" src="' + data.url_foto_noticia + '"></img></div>';
                }
            },
            {
                "render": function (data, type, data, meta) {
                    return (data.titulo).substring(0, 25)+"...";
                }
            },
            { "data": "publicada" },
            { "data": "fecha_publicacion"},
            { "data": "nombres_trabajador"},
            {
                "render": function (data, type, data, meta) {
                    return '<div class="row justify-content-center">' +
                    '<button onClick="buscarN(' + data.id_noticia + ')" class="btn btn-success mr-2"><i class="fas fa-pen-alt"></i></button>' +
                    '<button id="eliminarN" onClick="eliminarN(' + data.id_noticia + ')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>' +
                    '</div>';
                }
            }
            
        ],
        "order": [[ 0, "desc" ]]
    } );
}

function validacion_camposNews(array, indice) {
    $(".dataNews").each(function () {
        if ($(this).attr("name") === indice) {
            $(this).closest(".form-group").append(" <small class='msj text-danger'>" + array[indice] + "</small>");
        }
    });
}