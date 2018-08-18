$(document).ready(function () {
    selectNoticia();
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
                $('.cover').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });
});
function modalCrearNoticia(json){
    $("#aceptarMsg").removeClass("btn-danger");
    $("#aceptarMsg").removeClass("btn-success");
    $("#titleMsg").text(json.titulo);
    $("#cuerpoMsg").html(json.mensaje);
    $("#aceptarMsg").text("Aceptar");
    $("#aceptarMsg").addClass("btn-" + json.clase);
    $('#msg').modal('show');
}

$("#crear").click(function (event) {
    event.preventDefault();
    var form = $('#news-form')[0];
    form = new FormData(form);
    $("#crear").prop("disabled", true);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../../../controller/NoticiaRegisterC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            console.log(response);
            $("#crear").prop("disabled", false);
            var json = JSON.parse(response);
            
              modalCrearNoticia(json);
        },
        error: function (e) {
            $("#crear").prop("disabled", false);

        }

    });



});

function selectNoticia() {
    //alert('mostrarMovimientos.js');
  $.ajax({
      url: '../../../controller/NoticiaMostrarC.php',
      type: 'GET',
      success: function (response) {

        clearTable('#tableNot');
        try {
            var json = JSON.parse(response);
            
            for (i = 0; i < json.data.length; i++) {
                addRowNoticia(
                    "#tableNot",
                    json.data[i].id_noticia,
                    json.data[i].url_foto_noticia,
                    json.data[i].titulo,
                    json.data[i].publicada,
                    json.data[i].fecha_publicacion,
                    json.data[i].nombres_trabajador
                );
            }
        }
        catch (err) {
            $("#cuerpoTabla").empty();
        }

      }
  });

}