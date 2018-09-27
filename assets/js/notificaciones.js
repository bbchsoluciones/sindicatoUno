// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('007aa358a604a98ed413', {
    cluster: 'us2',
    forceTLS: true
});
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function (data) {
    listar_notificaciones();
    $.notify({
        icon: data.image,
        title: data.title,
        message: data.message,
        url: data.url
    },{
        type: 'minimalist',
        delay: 5000,
        icon_type: 'image',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<img data-notify="icon" class="rounded-circle float-left">' +
            '<span data-notify="title">{1}</span>' +
            '<span data-notify="message">{2}</span>' +
        '</div>'
    });
});
$(function () {
    listar_notificaciones();
});

function listar_notificaciones() {
    limpiarCampo("#notificaciones");
    limpiarCampo("#contador_notificaciones");
    var parametros = {
        "notificaciones": 1
    };
    $.ajax({
        data: parametros,
        url: '../../../controller/NotificacionesC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                var separador = null;
                var noti = null;
                if (json.mensaje) {
                    $("#notificaciones").html('<div class="px-3 descripcion animated fadeIn">' + json.mensaje + '</div>');
                }
                if (json.length > 0) {
                    $(".fa-bell").addClass("animated swing");
                    $("#contador_notificaciones").addClass("animated swing").html(json.length);
                }
                
                for (var i = 0; i < json.length; i++) {
                    if (i < 4) {
                        if (i < 3 && i < json.length-1) {
                            separador = '<div class="dropdown-divider"></div>';
                        } else {
                            separador = "";
                        }
                        $("#notificaciones").append('<a class="dropdown-item notificacion_items" href="imageApproval.php">' +
                            '<span class=""><img class="rounded-circle" src="' + json[i].url_foto_perfil + '"/></span>' +
                            '<span class="pl-3 pr-1"> ' +
                            '<div class="descripcion">' + json[i].descripcion + '</div>' +
                            '<div class="fecha">' + json[i].fecha + '</div>' +
                            '</span>' +
                            '</a>' + separador);
                    }
                }

                if(json.length>4){
                    if((json.length-4)===0){
                        noti='Notificación';
                    }else{
                        noti="Notificaciones";
                    }
                    $("#notificaciones").append('<div class="dropdown-divider"></div>'+
                        '<a class="dropdown-item notificacion_items" href="imageApproval.php">' +
                        '<span class="text-success">+'+((json.length)-4)+'</span>' +
                        '<span class="pl-3 pr-1"> ' +
                        '<div class="descripcion">'+noti+'</div>' +
                        '</span>' +
                        '</a>');
                }

            } catch (err) {
                //
            }

        }
    });
}