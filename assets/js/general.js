$(function () {
    if ($('body').hasClass('newNews') || $('body').hasClass('newsManage')) {
        tinymce.init({
            selector: "#cuerpo",
            plugins: "autoresize,autolink, code, textcolor colorpicker, fullscreen, image, media, preview,searchreplace,table",
            toolbar: "fontselect,fontsizeselect,table,forecolor backcolor, fullscreen, image,preview,link unlink | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | undo redo | formatselect",
            language: 'es',
            fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
            font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace',
            themes: "modern",
            height: "300",
            width: '100%',
            min_width: 400,
            image_title: true,
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
            // images_upload_url: 'postAcceptor.php',
            // here we add custom filepicker only to Image dialog
            file_picker_types: 'image',
            // and here's our custom image picker
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                // Note: In modern browsers input[type="file"] is functional without 
                // even adding it to the DOM, but that might not be the case in some older
                // or quirky browsers like IE, so you might want to add it to the DOM
                // just in case, and visually hide it. And do not forget do remove it
                // once you do not need it anymore.

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        // Note: Now we need to register the blob in TinyMCEs image blob
                        // registry. In the next release this part hopefully won't be
                        // necessary, as we are looking to handle it internally.
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        // call the callback and populate the Title field with the file name
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },

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

function limpiarCampos(id_contenedor, elemento, excepcion) {

    if (elemento == "input") {
        $(id_contenedor).find(elemento).not(excepcion).val("");
    } else if (elemento == "select") {
        $(id_contenedor).find(elemento).not(excepcion).empty();
        $(id_contenedor).find(elemento).not(excepcion).append(' <option value="0" selected>Seleccionar una...</option>');
    } else {
        $(id_contenedor).find(elemento).empty();
    }

}

function limpiarCamposContacto(id_contenedor, elemento, excepcion) {

    if (elemento == "input") {
        $(id_contenedor).find(elemento).not(excepcion).val("");
    } else if (elemento == "select") {
        $(id_contenedor).find(elemento).not(excepcion).empty();
        $(id_contenedor).find(elemento).not(excepcion).append(' <option value="asunto" selected="">Asunto</option>' +
            '<option value="integracion">Integración al Sindicato</option>' +
            '<option value="reclamo">Reclamo</option>' +
            '<option value="sugerencia">Sugerencia</option>' +
            '<option value="felicitacion">Felicitaciones</option>');
    } else {
        $(id_contenedor).find(elemento).empty();
    }

}

function limpiarCampo(id_contenedor, elemento) {

    if (elemento == "input") {
        $(id_contenedor).val("");
    } else if (elemento == "select") {
        $(id_contenedor).empty();
        $(id_contenedor).append(' <option value="0" selected>Seleccionar una...</option>');
    } else if (elemento == "img") {
        $(id_contenedor).attr("src", "../../../assets/images/1280x720.png");
    } else if (elemento == "label") {
        $(id_contenedor).text("Seleccionar Archivo");
    } else {
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