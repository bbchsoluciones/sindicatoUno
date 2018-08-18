$(function () {
    if ($('body').hasClass('barChartExit')) {
        mostrarCategoriaMovimiento(1);  
        //graficoIngreso($('#categoriaTM option:selected').val(),$('#anioIngreso option:selected').val());      
        graficoEgreso();      
        
    }
});

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
        url: '../../../controller/MovimientoGraficoIngresoC.php',
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
    














    

    /* let myChart = document.getElementById('graficoIngreso').getContext('2d');

    let ingresosChart = new Chart(myChart, {
        type:'bar',
        data:{
            labels:['boston', 'blabla', 'blablabla'],
            datasets:[{
                label:'Population',
                data:[
                    50765,
                    25876,
                    75678
                ]
            }]
        },
        options:{}
    }); */






}// graficoIngreso()