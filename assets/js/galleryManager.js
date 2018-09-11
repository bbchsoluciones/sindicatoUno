var storedFiles = [];
var count = 0;
$(function () {


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
        $("#js-upload-submit").prop("disabled", true);
        var form = new FormData();
        var total = 100;
        var porcentaje = 0;
        var acum = 0;
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
                timeout: 600000,
                success: function (response) {
                    try {
                        if(i===0){
                            porcentaje = 0;
                        }else{
                            porcentaje +=parseFloat(total / storedFiles.length)
                        }
                        for (acum; acum < porcentaje; acum++) {
                            $('.progress-bar').css("width", Math.ceil(acum / 10) * 10 + "%");
                        }
                        var json = JSON.parse(response);
                        $('.list-group').append(' <a href="#" class="list-group-item list-group-item-' + json.imagen.clase + '"><span class="badge alert-' + json.imagen.clase + ' pull-right">' + json.imagen.titulo + '</span>' + json.imagen.imagen_nombre + '</a>');
                    } catch (err) {
                        //alert(err);
                    }

                },
                error: function (e) {

                }

            });


        }
        $("#js-upload-submit").prop("disabled", false);

    });

    $(".input_upload").change(function () {
        var file = ["input", $(this)];
        validateImage(file);
    });

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
            readURL(files, i, count);
        }
    }
}

function readURL(files, i, count) {
    $('.label_upload').text(count + " Archivos seleccionados.");
    storedFiles.push(files[i]);
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
}