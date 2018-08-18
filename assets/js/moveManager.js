$(function () {
    if ($('body').hasClass('moveNew')) {
        mostrarTipoMovimiento();          
        limpiarCampo("#tipo_movimiento", "select");
    }else if ($('body').hasClass('moveManage')) {
        selectMovimiento();
        mostrarFondo();
    }else if ($('body').hasClass('barChartEntry')) {
        mostrarCategoriaMovimiento(0); 
        graficoIngreso(); 
    }else if ($('body').hasClass('barChartExit')) {
        mostrarCategoriaMovimiento(1);      
        graficoEgreso();      
        
    }
});
//Variables
var monto_anterior;

//Eventos
$("#tipo_movimiento").change(function () {
    limpiarCampo("#categoriaTM", "select");
    limpiarCampo("#nombreTM", "select");
    if ($.isNumeric($(this).val())) {
        mostrarCategoriaMovimiento($(this).val());
    }

});
$("#categoriaTM").change(function () {
    limpiarCampo("#nombreTM", "select");
    if ($.isNumeric($(this).val())) {
        mostrarNombreMovimiento($(this).val());
    }
});

//Funciones
function mostrarTipoMovimiento() {
    $.ajax({
        url: '../../../controller/TipoMovimientoC.php',
        type: 'GET',
        success: function (response) {
            try {
                var json = JSON.parse(response);
                for (i = 0; i < json.tipo_movimiento[0].length; i++) {
                    $('#tipo_movimiento').append('<option value="' + json.tipo_movimiento[0][i].id_tipo_movimiento + '">' + json.tipo_movimiento[0][i].tipo_movimiento + '</option>');

                }

            } catch (err) {
                //alert(err);
            }

        }
    });

}
function mostrarCategoriaMovimiento(id_tipo) {
    console.log(id_tipo);
    $.ajax({
        url: '../../../controller/CategoriaMovimientoC.php',
        type: 'GET',
        data: "id_tm=" + id_tipo,
        success: function (response) {
            try {
                //$(".breadcrumb").children().remove();
                //$(".breadcrumb").append('<div>'+response+'</div>"');
                var json = JSON.parse(response);
                for (i = 0; i < json.categoriaTM[0].length; i++) {
                    $('#categoriaTM').append('<option value="' + json.categoriaTM[0][i].id_categoria_movimiento + '">' + json.categoriaTM[0][i].categoria_movimiento + '</option>');
                }
            } catch (err) {
                alert(err);
                $('#categoriaTM').html(' <option selected>Seleccionar una...</option>');
                $('#nombreTM').html(' <option selected>Seleccionar una...</option>');
            }

        }

    });
}
function mostrarNombreMovimiento(id_categoria_movimiento) {
    $.ajax({
        url: '../../../controller/NombreMovimientoC.php',
        type: 'GET',
        data: "id_categoriatm=" + id_categoria_movimiento,
        success: function (response) {
            try {
                //$(".breadcrumb").children().remove();
                //$(".breadcrumb").append('<div>'+response+'</div>"');
                var json = JSON.parse(response);
                $("#nombreTM").empty();
                $('#nombreTM').append(' <option selected>Seleccionar una...</option>');
                for (i = 0; i < json.nombreTM[0].length; i++) {
                    $('#nombreTM').append('<option value="' + json.nombreTM[0][i].id_nombre_movimiento + '">' + json.nombreTM[0][i].nombre_movimiento + '</option>');
                }
            } catch (err) {
                //alert(err);
                $('#nombreTM').html(' <option selected>Seleccionar una...</option>');
            }

        }
    });
}
function mostrarFondo() {

    $.ajax({
        url: '../../../controller/FondoC.php',
        type: 'POST',
        success: function (response) {
            try {

                var json = JSON.parse(response);
                console.log(json);
                //alert('Saldo: '+json.monto[0][0].monto_fondo);
                $('#montoIngresos').html("$"+numberFormat(json.monto[0][0].ingreso));
                $('#montoEgresos').html("$"+numberFormat(json.monto[0][0].egreso));
                $('#saldoMovimiento').html("$"+numberFormat(json.monto[0][0].fondo));

            } catch (err) {
                alert(err);
            }

        }

    });

}
function insertMovimiento() {
    
    var monto = $("#monto").val();
    var id_nom = $("#nombreTM").val();
    var fecha = $("#datepickerMov").val();

    if (monto==="0" || monto===""){
        camposVacios();
    }else{

        var parametros = {
            "monto": monto,
            "id_nom": id_nom,
            "run": 193412130,
            "fecha":fecha
        };
        
        $.ajax({
            url: '../../../controller/MovimientoC.php',
            type: 'POST',
            data: parametros,
            success: function (response) {
                try {               
                   
                   if(response=="true"){
                       registradoMovimiento();
                       
    
                   }else{
                       noRegistradoMovimiento();
                   }
    
                } catch (err) {
                    alert(err);
                }
    
            }
           
        });
    }
}
function selectMovimiento() {

    var parametros = {
        "ajax": 'true',
        "func": 'selectMov'
    };

    $.ajax({
        url: '../../../controller/MovimientoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {

            clearTable('#tableMov');
            try {
                var json = JSON.parse(response);
                console.log('JSON: '+json);


                for (i = 0; i < json.data.length; i++) {
                    addRowMovimiento(
                        "#tableMov",
                        json.data[i].id_movimiento,
                        json.data[i].tipo_movimiento,
                        json.data[i].categoria_movimiento,
                        json.data[i].nombre_movimiento,
                        json.data[i].monto_movimiento,
                        json.data[i].fecha_movimiento,
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
function updateMovimiento(folio) {



    var idMonto="#montoRow"+folio;
    var monto_nuevo = $(idMonto).val();

    if(monto_anterior==monto_nuevo){

        informarActualizarMovimientoFalse();
        deshabilitar(folio);

    }else{

        //alert('folio: '+folio+' nuevo monto: '+monto);
    deshabilitar(folio);

    var parametros = {
        "id_mov": folio,
        "monto_nuevo": monto_nuevo
    };
    
     $.ajax({
        url: '../../../controller/MovimientoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            try {
               
               if(response=="true"){
                    informarActualizarMovimientoTrue();
                   //alert('Modificado');
                   selectMovimiento();
                   mostrarFondo();
               }else{
                    alert('NO Modificado');
               }

            } catch (err) {
                alert(err);
            }

        }
       
    });  


    }// cierra else

    
  

}
function deleteMovimiento(id_mov) {
    var parametros = {
        "ajax": 'true',
        "id_mov": id_mov
    };
    
    $.ajax({
        url: '../../../controller/MovimientoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            try {
               //$(".breadcrumb").children().remove();
               //$(".breadcrumb").append('<div>'+response+'</div>"');
               
               if(response=="true"){
                   //alert('SI eliminado');
                   selectMovimiento();
                   mostrarFondo();
               }else{
                   
                    alert('NO eliminado');
               }

            } catch (err) {
                alert(err);
            }

        }
       
    });
  

}
function habilitar(folio){


    var idMonto="#montoRow"+folio;
    var idBtnSave="#btnSave"+folio;
    var idBtnEdit="#btnEdit"+folio;
    var idBtnDelete="#btnDelete"+folio;

    monto_anterior = $(idMonto).val();

    $(idMonto).prop('disabled', false);
    $(idMonto).focus();
    $(idBtnSave).prop('disabled', false);
    $(idBtnEdit).prop('disabled', true);
    $(idBtnDelete).prop('disabled', true);
    
}
function deshabilitar(folio){

    var idMonto="#montoRow"+folio;
    var idBtnSave="#btnSave"+folio;
    var idBtnEdit="#btnEdit"+folio;
    var idBtnDelete="#btnDelete"+folio;

    $(idMonto).prop('disabled', true);
    $(idBtnSave).prop('disabled', true);
    $(idBtnEdit).prop('disabled', false);
    $(idBtnDelete).prop('disabled', false);
    


} 
function graficoIngreso() {// no olvidar recibir parametros
    var id_categoria = $('#categoriaTM option:selected').val();
    if (id_categoria === "0") {

        $('#contenedorGraficoIngreso').html('<div class="col-12 text-center">Sin resultados</div>');
        graficoVacio('', '');

    } else {
        $('#contenedorGraficoIngreso').html('<canvas id="graficoIngreso"></canvas>');

        var categoria = $('#categoriaTM option:selected').text();
        var anio = $('#anioIngreso option:selected').val();
        var parametros = {
            "id_categoria": id_categoria,
            "anio": anio
        };

        $.ajax({
            url: '../../../controller/MovimientoC.php',
            type: 'POST',
            data: parametros,
            success: function (response) {
                try {
                    var json = JSON.parse(response);
                    //console.log(json);
                    //alert(json.data[2].monto_movimiento);
                    var x;
                    var ingresos = [];
                    var enero = [0];
                    var febrero = [0];
                    var marzo = [0];
                    var abril = [0];
                    var mayo = [0];
                    var junio = [0];
                    var julio = [0];
                    var agosto = [0];
                    var septiembre = [0];
                    var octubre = [0];
                    var noviembre = [0];
                    var diciembre = [0];

                    for (x = 0; x < json.data.length; x++) {
                        //alert(numberFormat(json.egreso[0][x].monto.toString()));
                        switch (json.data[x].mes) {
                            case "1":
                                if (enero.length === 0) { //push
                                    enero.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    enero[0] = (parseInt(enero[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "2":
                                if (febrero.length === 0) { //push
                                    febrero.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    febrero[0] = (parseInt(febrero[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "3":
                                if (marzo.length === 0) { //push
                                    marzo.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    marzo[0] = (parseInt(marzo[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "4":
                                if (abril.length === 0) { //push
                                    abril.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    abril[0] = (parseInt(abril[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "5":
                                if (mayo.length === 0) { //push
                                    mayo.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    mayo[0] = (parseInt(mayo[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "6":
                                if (junio.length === 0) { //push
                                    junio.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    junio[0] = (parseInt(junio[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "7":
                                if (julio.length === 0) { //push
                                    julio.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    julio[0] = (parseInt(julio[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "8":
                                if (agosto.length === 0) { //push
                                    agosto.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    agosto[0] = (parseInt(agosto[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "9":
                                if (septiembre.length === 0) { //push
                                    septiembre.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    septiembre[0] = (parseInt(septiembre[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "10":
                                if (octubre.length === 0) { //push
                                    octubre.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    octubre[0] = (parseInt(octubre[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "11":
                                if (noviembre.length === 0) { //push
                                    noviembre.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    noviembre[0] = (parseInt(noviembre[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                            case "12":
                                if (diciembre.length === 0) { //push
                                    diciembre.push(parseInt(json.data[x].monto_movimiento));
                                } else {//sumar
                                    diciembre[0] = (parseInt(diciembre[0]) + parseInt(json.data[x].monto_movimiento));
                                }
                                break;
                        }
                    }

                    ingresos.push(enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre);
                    console.log(ingresos);





                    var ctx = document.getElementById('graficoIngreso').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'bar',

                        // The data for our dataset
                        data: {
                            labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                            datasets: [{
                                label: json.data[0].categoria_movimiento,
                                backgroundColor: 'rgba(38, 183, 6, 0.66)',
                                data: ingresos,
                                borderWidth: 2,
                                hoverBorderWidth: 2,
                                hoverBorderColor: 'green'
                            }]
                        },

                        // Configuration options go here
                        options: {
                            title: {
                                display: true,
                                text: json.data[0].categoria_movimiento + ' AÑO ' + json.data[0].anio,
                                fontSize: 25
                            }
                        }
                    });


                } catch (err) {
                    graficoVacio(categoria, anio);
                    $('#contenedorGraficoIngreso').html('<div class="col-12 text-center">Sin resultados</div>');
                }

            }

        });


    }// cierra else

}// graficoIngreso()
function graficoEgreso(){// no olvidar recibir parametros
    var id_categoria = $('#categoriaTM option:selected').val();
    if(id_categoria==="0"){

        $('#contenedorGraficoEgreso').html('<div class="col-12 text-center">Sin resultados</div>');
        graficoVacio('','');

    }else{
        $('#contenedorGraficoEgreso').html('<canvas id="graficoEgreso"></canvas>');
        
        var categoria = $('#categoriaTM option:selected').text();
    var anio = $('#anioIngreso option:selected').val();
    var parametros = {
        "id_categoria": id_categoria,
        "anio": anio
    };
    
    $.ajax({
        url: '../../../controller/MovimientoC.php',
        type: 'POST',
        data: parametros,
        success: function (response) {
            try {
                var json = JSON.parse(response);
                //console.log(json);
                //alert(json.data[2].monto_movimiento);
                var x;
                var ingresos = [];
                var enero = [0];
                var febrero = [0];
                var marzo = [0];
                var abril = [0];
                var mayo = [0];
                var junio = [0];
                var julio = [0];
                var agosto = [0];
                var septiembre = [0];
                var octubre = [0];
                var noviembre = [0];
                var diciembre = [0];

                for (x = 0; x < json.data.length; x++) {
                    //alert(numberFormat(json.egreso[0][x].monto.toString()));
                    switch (json.data[x].mes) {
                        case "1":
                            if (enero.length === 0) { //push
                                enero.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                enero[0] = (parseInt(enero[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "2":
                            if (febrero.length === 0) { //push
                                febrero.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                febrero[0] = (parseInt(febrero[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "3":
                            if (marzo.length === 0) { //push
                                marzo.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                marzo[0] = (parseInt(marzo[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "4":
                            if (abril.length === 0) { //push
                                abril.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                abril[0] = (parseInt(abril[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "5":
                            if (mayo.length === 0) { //push
                                mayo.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                mayo[0] = (parseInt(mayo[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "6":
                            if (junio.length === 0) { //push
                                junio.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                junio[0] = (parseInt(junio[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "7":
                            if (julio.length === 0) { //push
                                julio.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                julio[0] = (parseInt(julio[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "8":
                            if (agosto.length === 0) { //push
                                agosto.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                agosto[0] = (parseInt(agosto[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "9":
                            if (septiembre.length === 0) { //push
                                septiembre.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                septiembre[0] = (parseInt(septiembre[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "10":
                            if (octubre.length === 0) { //push
                                octubre.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                octubre[0] = (parseInt(octubre[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "11":
                            if (noviembre.length === 0) { //push
                                noviembre.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                noviembre[0] = (parseInt(noviembre[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                        case "12":
                            if (diciembre.length === 0) { //push
                                diciembre.push(parseInt(json.data[x].monto_movimiento));
                            } else {//sumar
                                diciembre[0] = (parseInt(diciembre[0]) + parseInt(json.data[x].monto_movimiento));
                            }
                            break;
                    }
                }

                ingresos.push(enero, febrero, marzo, abril, mayo, junio, julio, agosto, septiembre, octubre, noviembre, diciembre);
                console.log(ingresos);

                var ctx = document.getElementById('graficoEgreso').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'bar',

                    // The data for our dataset
                    data: {
                        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        datasets: [{
                            label: json.data[0].categoria_movimiento,
                            backgroundColor: 'rgba(236, 70, 70, 0.69)',
                            data: ingresos,
                            borderWidth:2,
                            borderColor: 'red',
                            hoverBorderWidth:2,
                            hoverBorderColor:'#000'
                        }]
                    },

                    // Configuration options go here
                    options: {
                        title:{
                            display:true,
                            text:json.data[0].categoria_movimiento+' AÑO '+json.data[0].anio,
                            fontSize:25
                        }
                    }
                }); 
               

            } catch (err) {
                graficoVacio(categoria,anio);
                $('#contenedorGraficoEgreso').html('<div class="col-12 text-center">Sin resultados</div>');
            }

        }
       
    });


    }// cierra else
    
}// graficoEgreso()