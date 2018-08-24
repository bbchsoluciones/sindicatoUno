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
                $('.cover').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        readURL(this);
    });

});


$("#crear").click(function (event) {
    event.preventDefault();
    var form = $('#news-form')[0];
    form = new FormData(form);
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

            try{
                console.log(response);
            $("#crear").prop("disabled", false);
            var json = JSON.parse(response);

              modalCrearNoticia(json);
            }catch(err){
                alert(err);
            }
            
        },
        error: function (e) {
            $("#crear").prop("disabled", false);

        }

    });



});

function selectNoticia() {
    //alert('mostrarMovimientos.js');
    var parametros = {
        "ajax": 'true',
        "selectNoticia": 'selectNoticia'
    };
  $.ajax({
      url: '../../../controller/NoticiaC.php',
      type: 'POST',
      data: parametros,
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