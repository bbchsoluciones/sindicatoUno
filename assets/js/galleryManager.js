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
    }else{
        $(".fa-star").click(function() {
            $(this).toggleClass("far fa");
            if($(this).hasClass("far")){
                $("#destacado").val(0);
            }else{
                $("#destacado").val(1);
            }
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
    var num = 0;
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