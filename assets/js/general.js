$(function () {
    if ($('body').hasClass('newNews') || $('body').hasClass('newsManage')) {
        tinymce.init({
            selector: "#cuerpo",
            plugins: "autolink, code, textcolor colorpicker, fullscreen, image, media, preview,searchreplace,table",
            toolbar: "fontselect,fontsizeselect,table,forecolor backcolor, fullscreen, image,preview,link unlink | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | undo redo | formatselect",
            language: 'es',
            fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
            font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace',
            themes: "modern",
            height: "300",
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }


        });

    }
});

$("#genPass").on("click", function () {
    var number = 1000 + Math.floor(Math.random() * 5000);
    $("#password").val(number);
});


// Limpiar inputs/select

function limpiarCampos(id_contenedor,elemento,excepcion) {

       if(elemento == "input"){
            $(id_contenedor).find(elemento).not(excepcion).val("");
        }else if(elemento == "select"){
            $(id_contenedor).find(elemento).not(excepcion).empty();
            $(id_contenedor).find(elemento).not(excepcion).append(' <option value="0" selected>Seleccionar una...</option>');
        }else{
            $(id_contenedor).find(elemento).empty();
        }

}
function limpiarCamposContacto(id_contenedor,elemento,excepcion) {

    if(elemento == "input"){
         $(id_contenedor).find(elemento).not(excepcion).val("");
     }else if(elemento == "select"){
         $(id_contenedor).find(elemento).not(excepcion).empty();
         $(id_contenedor).find(elemento).not(excepcion).append(' <option value="asunto" selected="">Asunto</option>'+
         '<option value="integracion">Integración al Sindicato</option>'+
         '<option value="reclamo">Reclamo</option>'+
         '<option value="sugerencia">Sugerencia</option>'+
         '<option value="felicitacion">Felicitaciones</option>');
     }else{
         $(id_contenedor).find(elemento).empty();
     }

}

function limpiarCampo(id_contenedor, elemento) {

    if(elemento == "input"){
        $(id_contenedor).val("");
    }else if(elemento == "select"){
        $(id_contenedor).empty();
        $(id_contenedor).append(' <option value="0" selected>Seleccionar una...</option>');
    }else if(elemento== "img"){
        $(id_contenedor).attr("src", "../../../assets/images/1280x720.png");
    }else if(elemento== "label"){
        $(id_contenedor).text("Seleccionar Archivo");
    }else{
        $(id_contenedor).empty();
    }
}

function limpiarSeleccionados(id_contenedor) {
    $(id_contenedor).find("select").prop('selectedIndex', 0);
}

function limpiarSeleccionado(id_contenedor) {
    $(id_contenedor).prop('selectedIndex', 0);
}

function limpiarFormulario(id_contenedor) {
    $(id_contenedor)[0].reset();
}
// fin limpiar