function enviarCorreo(){   
    var name = $('#name').val();
    var email = $('#email').val();
    var asunto = $('#asunto').val();
    var message = $('#message').val();
    valida(name, email, asunto, message);
    if($('#name_error').text() === "" && $('#email_error').text() === "" && $('#asunto_error').text() === "" && $('#message_error').text() === ""){
        //todo ok
        $('#loadContact').removeClass('d-none');        
        $('#enviar').html('Enviando...');
        $('#enviar').prop('disabled', true);
        $('#name').prop('disabled', true);
        $('#email').prop('disabled', true);
        $('#asunto').prop('disabled', true);
        $('#message').prop('disabled', true);
        var parametros = {
            "name": name,
            "email": email,
            "asunto": asunto,
            "message": message
        };    
        $.ajax({
            url: '../../controller/ContactoC.php',
            type: 'POST',
            data: parametros,
            success: function (response) {     
                console.log(response);
                if(response === "true"){
                    alertContacto(true);
                    $('#loadContact').addClass('d-none');        
                    $('#enviar').html('Enviar');
                    $('#enviar').prop('disabled', false);
                    $('#name').prop('disabled', false);
                    $('#email').prop('disabled', false);
                    $('#asunto').prop('disabled', false);
                    $('#message').prop('disabled', false);
                    limpiarCamposContacto("#contacto", "input");
                    limpiarCamposContacto("#contacto", "select");
                    $('#message').val('');
                }else{
                    alertContacto(false);
                    $('#loadContact').addClass('d-none');        
                    $('#enviar').html('Enviar');
                    $('#enviar').prop('disabled', false);
                    $('#name').prop('disabled', false);
                    $('#email').prop('disabled', false);
                    $('#asunto').prop('disabled', false);
                    $('#message').prop('disabled', false);
                }   
            }    
        });
    }else{
        //fatal
    }    
}
function mover(elemento) {
    $('html,body').animate({
        scrollTop: $(elemento).offset().top
    }, 0);
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function valida(name, email, asunto, message){
    if(name == "" || name == null || name.trim() == ""){
        $('#name_error').html('Complete nombre');
    }else{
        $('#name_error').empty();
    }
    if(email == "" || email == null || email.trim() == ""){
        $('#email_error').html('Complete email');
    }else{                  
        if (validateEmail(email)) {
            $('#email_error').empty();
        } else {
            $('#email_error').html('Email incorrecto');
        }        
    }
    if(asunto == "" || asunto == null || asunto.trim() == "" || asunto.trim() == "asunto"){
        $('#asunto_error').html('Selecione un asunto');
    }else{
        $('#asunto_error').empty();
    }
    if(message == "" || message == null || message.trim() == ""){
        $('#message_error').html('Escriba un mensaje');
    }else{
        $('#message_error').empty();
    }
}