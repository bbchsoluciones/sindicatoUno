var storedFiles = [];
var count = 0;
$(function () {

    if ($('body').hasClass('newGallery')) {
        var dropZone = document.getElementById('drop-zone');

        var startUpload = function (files) {
            var file = ["drag", files];
            validateImage(file);
        }

        dropZone.ondrop = function (e) {
            e.preventDefault();
            this.className = 'upload-drop-zone';

            startUpload(e.dataTransfer.files)
        }

        dropZone.ondragover = function () {
            this.className = 'upload-drop-zone drop';
            return false;
        }

        dropZone.ondragleave = function () {
            this.className = 'upload-drop-zone';
            return false;
        }

        $("#js-upload-submit").click(function (e) {
            e.preventDefault();
            $('.progress-bar').css("width", 0);
            $('.label_upload').text("Seleccionar Archivos");
            limpiarCampo(".list-uploaded", "div");
            limpiarCampo(".img-preview", "div");
            $("#js-upload-submit").prop("disabled", true);
            var form = new FormData();
            var total = 100;
            var porcentaje = 0;
            var acum = 0;
            var lastE = 0;
            for (var i = 0; i < storedFiles.length; i++) {

                form.append("file", storedFiles[i]);

                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "../../../controller/GaleriaC.php",
                    processData: false, // Important!
                    contentType: false,
                    cache: false,
                    data: form,
                    success: function (response) {
                        try {
                            porcentaje += parseFloat(total / storedFiles.length)
                            for (acum; acum < porcentaje; acum++) {
                                $('.progress-bar').css("width", Math.ceil(acum / 10) * 10 + "%");
                            }
                            var json = JSON.parse(response);

                            $('.list-uploaded').append('<div class="row uploaded" id="msg-' + lastE + '">' +
                                '<div class="col-md-10 text-' + json.clase + '"><span><i class="fas fa-file-image pr-2"></i>Archivo: ' + json.imagen_nombre + '</span></div>' +
                                '<div class="col-md-2 text-' + json.clase + '"><span class="float-right"><i class="fas fa-' + json.icono + ' pr-2"></i>' + json.titulo + '</span></div>' +
                                '</div><hr/>');
                            lastE += 1;
                            if ($("#msg-" + (storedFiles.length - 1)).length) {
                                setTimeout(function () {
                                    $("#js-upload-submit").prop("disabled", false);
                                    count = 0;
                                    storedFiles.length = 0;
                                }, 800);

                            }

                        } catch (err) {
                            //alert(err);
                        }


                    },
                    error: function (e) {

                    }


                });


            } //end for


        });

        $(".input_upload").change(function () {
            var file = ["input", $(this)];
            validateImage(file);
        });
    } else {
        mostrar_galeria();
        var slideIndex = 1;

        $(".overlay-close").click(function () {
            $('.overlay-carousel').addClass("d-none");
            $('body').removeClass("no-scroll");
            $("#content-wrapper").removeClass("p-0");
            $(".container-fluid").removeClass("p-0");
        });
    }
});


function validateImage(input) {
    var files = [];
    if (input[0] == "input") {
        files = input[1][0].files;
    } else {
        files = input[1];
    }
    for (var i = 0; i < files.length; i++) {
        if (files[i].type == "image/png" || files[i].type == "image/jpg" || files[i].type == "image/jpeg") {
            count = count + 1;
            readURL(files, i);
            storedFiles.push(files[i]);
            $('.label_upload').text(count + " Archivos seleccionados.");
        }
    }
}

function readURL(files, i) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $(".img-preview").append('<div class="form-group my-0 mr-2 position-relative" id="imagen_' + i + '">' +
            '<div class="text-danger cursor" style="position:absolute;top:-10px;right:-3px;" onclick="removeImage(' + i + ')">' +
            '<i class="fa fa-times"></i>' +
            '</div>' +
            '<img src="' + e.target.result + '" alt="" class="rounded cover_img_preview img-thumbnail">' +
            '</div>').fadeIn();
    }
    reader.readAsDataURL(files[i]);

}

function removeImage(id) {
    var iterator = storedFiles.keys();
    for (let key of iterator) {
        if (key === id) {
            storedFiles.splice(key, 1);
            break;
        }
    }
    count = count - 1;
    if (count === 0) {
        $('.label_upload').text("Seleccionar Archivos");
    } else {
        $('.label_upload').text(count + " Archivos seleccionados.");
    }
    $("#imagen_" + id).remove();
    $('.img-preview').empty();
    for (var i = 0; i < storedFiles.length; i++) {
        readURL(storedFiles, i);
    }

}

function mostrar_galeria() {
    limpiarCampo("#list-images", "div");
    var parametros = {
        "listado": "1"
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/GaleriaC.php',
        type: 'GET',
        success: function (response) {
            try {

                var json = JSON.parse(response);
                var favorito = null;
                var c = 0;
                var destacado = 0;
                var totalDestacado = parseInt(json.total);
                for (var i = 0; i < json.galeria.length; i++) {
                    c += 1;
                    destacado = parseInt(json.galeria[i].destacado);
                    if (destacado === 1) {
                        favorito = '<button class="destacado btn btn-primary" id="top_' + i + '" onclick="fav(' + i + ')">';
                        favorito += '<i class="fa fa-star pl-2"></i>';
                        favorito += '</button>';
                        $("#destacado_" + i).val(1);
                    } else if (destacado !== 1 && totalDestacado < 5) {
                        favorito = '<button class="destacado btn btn-primary" id="top_' + i + '" onclick="fav(' + i + ')">';
                        favorito += '<i class="far fa-star pl-2"></i>';
                        favorito += '</button>';
                        $("#destacado_" + i).val(0);
                    } else {
                        favorito = "";
                    }
                    $("#list-images").append('<div class="col-md-4 p-2">' +
                        '<input id="destacado_' + i + '" type="text" class="d-none" value="">' +
                        '<input id="id_foto_galeria_' + i + '" type="text" class="d-none" value="' + json.galeria[i].id_foto_galeria + '">' +
                        '<div class="card normal" style="background: url(' + json.galeria[i].url_foto_galeria + ') top center no-repeat">' +
                        '<a class="cursor" onclick="currentSlide(' + i + ')">' +
                        '<div class="overlay-card animated fadeIn" style="display:none">' +
                        '<div class="container h-100">' +
                        '<div class="row align-items-center h-100">' +
                        '<div class="col-8 mx-auto">' +
                        '<div class="text-center"><i class="fa fa-search-plus animated zoomIn"></i></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</a>' +
                        favorito +
                        '<button class="del-img btn btn-danger" id="trash_' + i + '" onclick="eliminar_confirmar(' + i + ",'" + json.galeria[i].nombre_imagen + "'" + ')"><i class="fa fa-trash pr-2"></i></button>' +
                        '<span class="name bg-info text-light">' + json.galeria[i].nombre_imagen + '</span>' +
                        '</div>' +
                        '</div>');
                    $(".slidesContainer").append('<div class="mySlides animated fadeIn" id="slide_' + i + '">' +
                        '<div class="numbertext">' + c + ' / ' + json.galeria.length + '</div>' +
                        '<img src="' + json.galeria[i].url_foto_galeria + '">' +
                        '</div>');
                }

            } catch (err) {}

        }
    });
}


function fav(id) {
    $($("#top_" + id)).find("i").toggleClass("far fa");
    if ($("#top_" + id).find("i").hasClass("far")) {
        $("#destacado_" + id).val(0);
    } else {
        $("#destacado_" + id).val(1);
    }
    actualizar_destacado(id);
}

function actualizar_destacado(id) {
    $("#top_" + id).prop("disabled", true);
    var parametros = {
        id_foto_galeria: $("#id_foto_galeria_" + id).val(),
        destacado: $("#destacado_" + id).val(),
        modificar_destacado: 1
    }
    $.ajax({
        data: parametros,
        url: "../../../controller/GaleriaC.php",
        type: "GET",
        success: function (response) {
            try {
                $("#top_" + id).prop("disabled", false);
                mostrar_galeria();
                var json = JSON.parse(response);
                if (json['clase'] == "danger") {
                    modalInformacion(json);
                }

            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#top_" + id).prop("disabled", false);

        }

    });
}

function eliminar_confirmar(id, nombre) {
    var nombre = nombre;
    var funcion = "eliminar_imagen('" + id + "')";
    modalConfirmarEliminarImagenG(nombre, funcion);
}

function eliminar_imagen(id) {
    $("#trash_" + id).prop("disabled", true);
    var parametros = {
        id_foto_galeria: $("#id_foto_galeria_" + id).val(),
        eliminar_imagen: 1
    }
    $.ajax({
        data: parametros,
        url: "../../../controller/GaleriaC.php",
        type: "GET",
        success: function (response) {
            try {
                $("#trash_" + id).prop("disabled", false);
                mostrar_galeria();
                var json = JSON.parse(response);
                modalInformacion(json);


            } catch (err) {
                //alert(err);
            }

        },
        error: function (e) {
            $("#trash_" + id).prop("disabled", false);

        }

    });
}
// Next/previous controls
function plusSlides(n) {
    slideIndex += n;
    showSlides(slideIndex);
}

// Thumbnail image controls    
function currentSlide(n) {
    $('body').addClass("no-scroll");
    $('.overlay-carousel').removeClass("d-none");

    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = $(".mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    if (n < 0) {
        slides[slides.length - 1].style.display = "block";
        slideIndex = slides.length - 1;
    } else if (n > slides.length - 1) {
        slides[0].style.display = "block";
        slideIndex = 0;
    } else if (n >= 0 && n < slides.length) {
        slides[n].style.display = "block";
    }

}