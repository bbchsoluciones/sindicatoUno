function movRegistrado() {
    $("#alertMovReg").html('<div class="alert alert-success" role="alert">' +
        'Registrado con éxito. <a href="moveManage.php" class="alert-link">Verifíque saldo</a>.' +
        '</div>').fadeIn().delay(1000).fadeOut();
}// movRegistrado()

function movActualizado(estado) {
    if(estado){
        $("#alertMov").html('<div class="alert alert-success" role="alert">' +
        'Monto actualizado con éxito.' +
        '</div>').fadeIn().delay(1000).fadeOut();
    }else{
        $("#alertMov").html('<div class="alert alert-warning" role="alert">' +
        'No se han registrado modificaciones.' +
        '</div>').fadeIn().delay(1000).fadeOut();
    }
    
}// movActualizado()

function movEliminado() {
    $("#alertMov").html('<div class="alert alert-danger" role="alert">' +
        'Movimiento eliminado con éxito.' +
        '</div>').fadeIn().delay(1000).fadeOut();
}// movEliminado()