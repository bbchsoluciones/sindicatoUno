$("#iniciar_sesion").click(function (event) {
    event.preventDefault();
    limpiarCampo("#mensaje", "div");
    var form = $('#form_login')[0];
    form = new FormData(form);
    $("#iniciar_sesion").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "../../controller/LoginC.php",
        processData: false, // Important!
        contentType: false,
        cache: false,
        data: form,
        timeout: 600000,
        success: function (response) {
            console.log(response);
            $("#iniciar_sesion").prop("disabled", false);
            var json = JSON.parse(response);
            $('html, body').animate({
                scrollTop: 0
            }, 0);
            if (json.pagina != null || json.pagina !== undefined) {
                window.location = json.pagina;
            } else if (json.clase != null || json.clase !== undefined) {
                $("#mensaje").html('<div class="rounded-0 alert alert-' + json['clase'] + '" role="alert">' +
                    '<strong>' + json['titulo'] + '</strong> ' + json['mensaje'] + '' +
                    '</div>').fadeIn().delay(5000).fadeOut();
                limpiarCampo("#pass", "input");
            }

        },
        error: function (e) {
            $("#iniciar_sesion").prop("disabled", false);

        }

    });

});