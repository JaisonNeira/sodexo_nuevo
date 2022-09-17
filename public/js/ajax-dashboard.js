window.onload = function () {

    var meses = [];
    var promedio = [];

    function nombreMes(numero) {
        if (numero == 1) {
            return "Enero"
        }
        if (numero == 2) {
            return "Febrero"
        }
        if (numero == 3) {
            return "Marzo"
        }
        if (numero == 4) {
            return "Abril"
        }
        if (numero == 5) {
            return "Mayo"
        }
        if (numero == 6) {
            return "Junio"
        }
        if (numero == 7) {
            return "Julio"
        }
        if (numero == 8) {
            return "Agosto"
        }
        if (numero == 9) {
            return "Septiembre"
        }
        if (numero == 10) {
            return "Octubre"
        }
        if (numero == 11) {
            return "Noviembre"
        }
        if (numero == 12) {
            return "Diciembre"
        }
    }

    /* GRAFICO DE BARRA */
    $.ajax({
        url: '/gb/dashboard',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        },
        success: function (response) {
            var datos = response.p6m;
            for (var i = 0; i < datos.length; i++) {
                var mes = nombreMes(datos[i].mes);
                meses.push(mes);
                promedio.push(datos[i].promedio);
            }
            graficaBarra();
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });

    function graficaBarra() {
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [{
                    label: "Revenue",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: promedio,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        },
                        maxBarThickness: 25,
                    }],
                    /* yAxes: [{
                        ticks: {
                            min: 20,
                            max: 100,
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function (value, index, values) {
                                return number_format(value) + '%';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }], */
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function (tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + '%';
                        }
                    }
                },
            }
        });

    }
    /* GRAFICO CIRCULAR */

    $.ajax({
        url: '/gc/dashboard',
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            console.log('enviada');
        },
        complete: function () {
            console.log('completada');
        },
        success: function (response) {
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["debajo del 40%", "sobre el 40%", "Sobre el 60%", "Sobre el 70%", "Sobre el 80%", "Sobre el 90%"],
                    datasets: [{
                        data: [response.d_40,response.s_40, response.s_60, response.s_70, response.s_80, response.s_90],
                        backgroundColor: ['#1ac89a','#4e73df', '#1cc88a', '#36b9cc', '#33b9ac', '#f6c23e'],
                        hoverBackgroundColor: ['#1ac89a', '#4e73df', '#1cc88a', '#36b9cc', '#33b9ac', '#f6c23e'],
                        hoverBorderColor: "rgb(128, 128, 128)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        },
        error: function (jqXHR) {
            console.log('error!');
        }
    });






}
