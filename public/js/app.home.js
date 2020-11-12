$(document).ready(function () {
    var var_token = $('#_token').val()
    $.ajax({
        type: 'get',
        url: '/buscar/clientes',
        data: {
            _token: var_token
        },
        success: function (data) {
            $('#dash_clientes').html(data.clientes)
        },
    });

    $.ajax({
        type: 'get',
        url: '/buscar/produtos',
        data: {
            _token: var_token
        },
        success: function (data) {
            $('#dash_cardapios').html(data.produtos)
        },
    });

    $.ajax({
        type: 'get',
        url: '/buscar/pedidos/soma',
        data: {
            _token: var_token
        },
        success: function (data) {
            $('#dash_ganhos').append(data)
        }
    });

    $.ajax({
        type: 'get',
        url: '/soma/entradas/mes',
        data: {
            _token: var_token
        },
        success: function (data) {
            $('#dash_ganhos_mes').append(data)
        }
    });

    $.ajax({
        type: 'get',
        url: '/buscar/pedidos/status',
        data: {
            _token: var_token
        },
        success: function (data) {
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Aguardando", "Saiu p/Entrega", "Preparando", 'Entregue'],
                    datasets: [{
                        data: data,
                        backgroundColor: ['#4e73df', '#FA7921', '#f6c23e', '#1cc88a'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
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
        }
    });

    $.ajax({
        type: 'get',
        url: '/buscar/entradas/mes',
        success: function (data) {
            console.log(data);
            var ctx = document.getElementById("myBarChart");
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                    datasets: [{
                        label: "Receita",
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        data: data,
                    }],
                },
            });
        }
    });
});
