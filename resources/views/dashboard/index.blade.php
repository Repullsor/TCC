<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>Dashboards</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gráfico de Linha</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart"
                                style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gráfico de Barras (Média Diária)</h3>
                </div>
                <div class="card-body">
                    <div id="barChartDaily"
                        style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></div>
                </div>
            </div>
        </div>

        <!-- ... Outras estatísticas ... -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $(function () {
            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawBarChart);

            function drawBarChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Dias');
                data.addColumn('number', 'Média Diária');
                data.addRows([
                    @foreach($labels as $key => $label)
                        ['{{ $label }}', {{ $values[$key] }}],
                    @endforeach
                ]);

                var options = {
                    title: 'Média Diária dos Níveis de Glicose',
                    hAxis: {
                        title: 'Dias',
                        titleTextStyle: { color: 'green' }
                    },
                    vAxis: {
                        title: 'Média Diária',
                        minValue: 0
                    }
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('barChartDaily'));
                chart.draw(data, options);
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <script>
        $(function() {
            var data = {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Nível de Glicose',
                    data: {!! json_encode($values) !!},
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            };

            var options = {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Dias'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nível de Glicose'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            };

            var ctx = document.getElementById('lineChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: data,
                options: options
            });
        });
    </script>
@endsection
