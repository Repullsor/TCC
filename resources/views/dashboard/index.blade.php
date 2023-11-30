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
                            <h3 class="card-title">Gráficos de Saúde</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Gráfico de Glicose</h3>
                                        <button id="toggleGlucoseChart" class="btn btn-primary btn-sm float-end">Alternar
                                            Gráfico</button>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="glucoseChart"
                                            style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Gráfico de Pressão Arterial</h3>
                                        <button id="toggleBloodPressureChart"
                                            class="btn btn-primary btn-sm float-end">Alternar Gráfico</button>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="bloodPressureChart"
                                            style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    $(function() {
        @if (isset($glucoseLabels) && isset($glucoseValues))
        
            var glucoseData = {
                labels: {!! json_encode($glucoseLabels) !!},
                datasets: [{
                    label: 'Nível de Glicose',
                    data: {!! json_encode($glucoseValues) !!},
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)', // Cor padrão para a linha
                    borderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBorderColor: {!! json_encode($pointBorderColors) !!}, // Cores do contorno
                }]

            };

            var glucoseOptions = {
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
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y + ' mg/dL'; // Adicione a unidade desejada

                                // Adicione informações de data e hora se disponíveis
                                if (
                                    context.dataset.data[context.dataIndex].measurement_date &&
                                    context.dataset.data[context.dataIndex].measurement_time
                                ) {
                                    label += '\nData: ' + context.dataset.data[context.dataIndex]
                                        .measurement_date +
                                        '\nHora: ' + context.dataset.data[context.dataIndex]
                                        .measurement_time;
                                }

                                return label;
                            }
                        }
                    }
                }
            };

            var glucoseChart;

            var glucoseCtx = document.getElementById('glucoseChart').getContext('2d');
            glucoseChart = new Chart(glucoseCtx, {
                type: 'line',
                data: glucoseData,
                options: glucoseOptions
            });

            $('#toggleGlucoseChart').click(function() {
                // Certifique-se de que glucoseChart foi definido antes de acessar suas propriedades
                if (glucoseChart) {
                    glucoseChart.config.type = glucoseChart.config.type === 'line' ? 'bar' : 'line';
                    glucoseChart.update();
                }
            });
        @endif

        @if (isset($bloodPressureLabels) && isset($systolicValues) && isset($diastolicValues))
            var bloodPressureData = {
                labels: {!! json_encode($bloodPressureLabels) !!},
                datasets: [{
                    label: 'Pressão Sistólica',
                    data: {!! json_encode($systolicValues) !!},
                    fill: false,
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }, {
                    label: 'Pressão Diastólica',
                    data: {!! json_encode($diastolicValues) !!},
                    fill: false,
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            };

            var bloodPressureOptions = {
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
                            text: 'Pressão Arterial'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.parsed.y + ' mmHg'; // Adicione a unidade desejada

                                // Adicione informações de data e hora se disponíveis
                                if (
                                    context.dataset.data[context.dataIndex].measurement_date &&
                                    context.dataset.data[context.dataIndex].measurement_time
                                ) {
                                    label += '\nData: ' + context.dataset.data[context.dataIndex]
                                        .measurement_date +
                                        '\nHora: ' + context.dataset.data[context.dataIndex]
                                        .measurement_time;
                                }

                                return label;
                            }
                        }
                    }
                }
            };

            // Armazene a instância do gráfico em uma variável
            var bloodPressureChart;

            var bloodPressureCtx = document.getElementById('bloodPressureChart').getContext('2d');
            bloodPressureChart = new Chart(bloodPressureCtx, {
                type: 'line',
                data: bloodPressureData,
                options: bloodPressureOptions
            });

            $('#toggleBloodPressureChart').click(function() {
                // Certifique-se de que bloodPressureChart foi definido antes de acessar suas propriedades
                if (bloodPressureChart) {
                    bloodPressureChart.config.type = bloodPressureChart.config.type === 'line' ? 'bar' :
                        'line';
                    bloodPressureChart.update();
                }
            });
        @endif
    });
</script>
