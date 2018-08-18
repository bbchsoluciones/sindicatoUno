$(function () {
    if ($('body').hasClass('newNews')) {
        tinymce.init({
            selector: "#cuerpo",
            plugins: "autolink, code, textcolor colorpicker, emoticons, fullscreen, image, media, preview,searchreplace,table",
            toolbar: "table,forecolor backcolor, emoticons, fullscreen, image,preview,link unlink | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | undo redo | formatselect",
            language: 'es',
            themes: "modern",
            height : "300",
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

function limpiarCampos(id_contenedor, elemento) {
    switch (elemento) {
        case "input":
            $(id_contenedor).find(elemento).not(".disabled").val("");
            break;
        case "select":
            $(id_contenedor).find(elemento).not(".ex").empty();
            $(id_contenedor).find(elemento).not(".ex").append(' <option selected>Seleccionar una...</option>');
            break;
        case "img":
            $(id_contenedor).find(elemento).attr("src", "../../../assets/images/500x500.png");
            break;
        case "span":
            $(id_contenedor).find(elemento).text("");
            break;
        case "div":
            $(id_contenedor).find(elemento).text("");
            break;
        default:
            break;

    }
}

function limpiarCampo(id_contenedor, elemento) {
    switch (elemento) {
        case "input":
            $(id_contenedor).val("");
            break;
        case "select":
            $(id_contenedor).empty();
            $(id_contenedor).append(' <option selected>Seleccionar una...</option>');
            break;
        case "img":
            $(id_contenedor).attr("src", "../../../assets/images/500x500.png");
            break;
        case "span":
            $(id_contenedor).text("");
            break;
        case "div":
            $(id_contenedor).text("");
            break;
        default:
            break;

    }
}

function limpiarSeleccionados(id_contenedor,elemento){
    $(id_contenedor).find(elemento).prop('selectedIndex', 0)
}
function limpiarSeleccionado(id_contenedor){
    $(id_contenedor).prop('selectedIndex', 0)
}
// fin limpiar