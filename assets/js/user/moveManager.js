$(function () {
    if ($('body').hasClass('moveManage')) {
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
                //console.log(json);
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
function selectMovimiento() {

    var parametros = {
        "ajax": 'true',
        "func": 'selectMov'
    };

    table = $('#tableMov').DataTable( {
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Ver _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "No hay movimientos registrados",
            "sInfo":           "_START_ / _END_ (_TOTAL_ registros)",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "ajax": {
            "url": "../../../controller/MovimientoC.php",
            "type": "POST",
            "data": parametros
        },
        "columns": [
            { "data": "id_movimiento"},
            { "data": "tipo_movimiento" },
            { "data": "categoria_movimiento"},
            { "data": "nombre_movimiento" },
            { "data": "descripcion_movimiento"},
            { "data": "monto_movimiento" },
            { "data": "fecha_movimiento" }
            
        ],
        "order": [[ 6, "desc" ]]
    } );


}
function graficoIngreso() {// no olvidar recibir parametros
    
    var id_tipo = $('#categoriaTM option:selected').val();
    if (id_tipo === "0") {       
        
        var anio = $('#anioIngreso option:selected').val();
        var parametros = {
            "id_tipo": id_tipo,
            "anio": anio
        };

        $.ajax({
            url: '../../../controller/MovimientoC.php',
            type: 'POST',
            data: parametros,
            success: function (response) {
                try {
                    $('#contenedorGraficoIngreso').html('<canvas class="border rounded" id="graficoIngreso"></canvas>');        
                    
                    var json = JSON.parse(response);
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
                   

                    var data = {
                        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        datasets: [{
                          label: json.data[0].tipo_movimiento,
                          backgroundColor: "rgba(82, 251, 4, 0.6)",
                          borderColor: "rgba(48, 146, 2, 1)",
                          borderWidth: 2,
                          hoverBackgroundColor: "rgba(62, 191, 3, 0.6)",
                          hoverBorderColor: "rgba(48, 146, 2, 1)",
                          data: ingresos,
                        }]
                      };
                      
                      var options = {
                        title: {
                            display: true,
                            text: json.data[0].tipo_movimiento + ' AÑO ' + json.data[0].anio,
                            fontSize: 25
                        },
                        maintainAspectRatio: false,
                        scales: {
                          yAxes: [{
                            stacked: true,
                            gridLines: {
                              display: true,
                            }
                          }],
                          xAxes: [{
                            gridLines: {
                              display: false
                            }
                          }]
                        }
                      };
                      
                      Chart.Bar('graficoIngreso', {
                        options: options,
                        data: data
                      });

                } catch (err) {
                    $('#contenedorGraficoIngreso').html('<div class="col-12 text-center">Sin resultados</div>');
                    $('#contenedorBotonesIngreso').empty();
                }

            }

        });

    } else {
        var id_categoria = $('#categoriaTM option:selected').val();
    
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
                    $('#contenedorGraficoIngreso').html('<canvas class=" border rounded" id="graficoIngreso"></canvas>');
                    
                    var json = JSON.parse(response);
                    
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
                    
                    var data = {
                        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        datasets: [{
                          label: json.data[0].categoria_movimiento,
                          backgroundColor: "rgba(82, 251, 4, 0.6)",
                          borderColor: "rgba(48, 146, 2, 1)",
                          borderWidth: 2,
                          hoverBackgroundColor: "rgba(62, 191, 3, 0.6)",
                          hoverBorderColor: "rgba(48, 146, 2, 1)",
                          data: ingresos,
                        }]
                      };
                      
                      var options = {
                        title: {
                            display: true,
                            text: json.data[0].categoria_movimiento + ' AÑO ' + json.data[0].anio,
                            fontSize: 25
                        },
                        maintainAspectRatio: false,
                        scales: {
                          yAxes: [{
                            stacked: true,
                            gridLines: {
                              display: true,
                            }
                          }],
                          xAxes: [{
                            gridLines: {
                              display: false
                            }
                          }]
                        }
                      };
                      
                      Chart.Bar('graficoIngreso', {
                        options: options,
                        data: data
                      });


                } catch (err) {
                    $('#contenedorGraficoIngreso').html('<div class="col-12 text-center">Sin resultados</div>');
                    $('#contenedorBotonesIngreso').empty();

                    
                }

            }

        });
   }// cierra else
}// graficoIngreso()
function graficoEgreso(){// no olvidar recibir parametros

    var id_tipo = $('#categoriaTM option:selected').val();
    if (id_tipo === "0") {

        id_tipo=1;
        var anio = $('#anioIngreso option:selected').val();
        var parametros = {
            "id_tipo": id_tipo,
            "anio": anio
        };

        $.ajax({
            url: '../../../controller/MovimientoC.php',
            type: 'POST',
            data: parametros,
            success: function (response) {
                try {
                    $('#contenedorGraficoEgreso').html('<canvas class=" border rounded" id="graficoEgreso"></canvas>');                 
                    var json = JSON.parse(response);
                    
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
                    

                    var data = {
                        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        datasets: [{
                          label: json.data[0].tipo_movimiento,
                          backgroundColor: "rgba(196, 3, 3, 0.54)",
                          borderColor: "rgba(236, 4, 4, 0.85)",
                          borderWidth: 2,
                          hoverBackgroundColor: "rgba(196, 3, 3, 0.73)",
                          hoverBorderColor: "rgba(236, 4, 4, 0.85)",
                          data: ingresos,
                        }]
                      };
                      
                      var options = {
                        title: {
                            display: true,
                            text: json.data[0].tipo_movimiento + ' AÑO ' + json.data[0].anio,
                            fontSize: 25
                        },
                        maintainAspectRatio: false,
                        scales: {
                          yAxes: [{
                            stacked: true,
                            gridLines: {
                              display: true,
                            }
                          }],
                          xAxes: [{
                            gridLines: {
                              display: false
                            }
                          }]
                        }
                      };
                      
                      Chart.Bar('graficoEgreso', {
                        options: options,
                        data: data
                      });

                } catch (err) {
                    $('#contenedorGraficoEgreso').html('<div class="col-12 text-center">Sin resultados</div>');                 
                    $('#contenedorBotonesEgreso').empty();
                }

            }

        });

    } else {

        var id_categoria = $('#categoriaTM option:selected').val();
    
        
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
                $('#contenedorGraficoEgreso').html('<canvas class=" border rounded" id="graficoEgreso"></canvas>');                    
                
                var json = JSON.parse(response);
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

                var data = {
                    labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    datasets: [{
                      label: json.data[0].categoria_movimiento,
                      backgroundColor: "rgba(196, 3, 3, 0.54)",
                      borderColor: "rgba(236, 4, 4, 0.85)",
                      borderWidth: 2,
                      hoverBackgroundColor: "rgba(196, 3, 3, 0.73)",
                      hoverBorderColor: "rgba(236, 4, 4, 0.85)",
                      data: ingresos,
                    }]
                  };
                  
                  var options = {
                    title: {
                        display: true,
                        text: json.data[0].categoria_movimiento+' AÑO '+json.data[0].anio,
                        fontSize: 25
                    },
                    maintainAspectRatio: false,
                    scales: {
                      yAxes: [{
                        stacked: true,
                        gridLines: {
                          display: true,
                        }
                      }],
                      xAxes: [{
                        gridLines: {
                          display: false
                        }
                      }]
                    }
                  };
                  
                  Chart.Bar('graficoEgreso', {
                    options: options,
                    data: data
                  });
            } catch (err) {
                $('#contenedorGraficoEgreso').html('<div class="col-12 text-center">Sin resultados</div>');                 
                $('#contenedorBotonesEgreso').empty();
            }

        }
       
    });


   }// cierra else

    
}// graficoEgreso()
