<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">


@extends('adminlte::page')

@section('title', 'Glicemia')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>Glicemia</h1>
                    <button type="button" id="btnDownload" class="btn btn-primary" onclick="downloadPlanilha()">
                        <i class="fa fa-download"></i> Baixar Planilha
                    </button>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Importar Arquivo</h3>
                    </div>
                    <div class="card-body text-center">
                        <!-- Formulário de Importação -->
                        <form action="{{ route('diabetes.import') }}" method="post" enctype="multipart/form-data"
                            id="importForm">
                            @csrf
                            <div class="row">
                                <div class="form-group col ml-5 mt-3">
                                    <label for="file"><i class="fas fa-file-upload"></i> Selecione um Arquivo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file" id="file" class="custom-file-input"
                                                onchange="displayFileName()">
                                            <label class="custom-file-label" for="file" id="fileNameLabel">Escolher
                                                arquivo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mt-5">
                                    <label></label>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-cloud-upload-alt"></i> Importar Dados
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="fileData" class="mt-3">
                            <!-- Exibir mensagens de sucesso ou erro -->
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <!-- Tabela de Dispositivos -->
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Dados Importados</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                {{-- <i class="fas fa-minus"></i> --}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        @if ($formattedDiabetesData->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Nível de Glicose</th>
                                        <th>Classificação</th>
                                        <th>Ações</th> <!-- Adicionado esta coluna -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formattedDiabetesData as $key => $data)
                                        <tr>
                                            <td>{{ $formattedDiabetesData->count() - $key }}</td>
                                            <td>{{ $data->measurement_date }}</td>
                                            <td>{{ $data->measurement_time }}</td>
                                            <td>{{ $data->glucose_level }}</td>
                                            <td>{{ $data->classification }}</td>
                                            <td>
                                                <form action="{{ route('diabetes.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Nenhum dado de diabetes encontrado para este usuário.</p>
                        @endif
                    </div>


                </div>


            </div>
        </div>


    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function displayFileName() {
            var fileName = $('#file').val().split('\\').pop(); // Obtém apenas o nome do arquivo, removendo o caminho
            $('#fileNameLabel').text(fileName); // Atualiza o conteúdo da etiqueta com o nome do arquivo
        }
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            var alertSuccess = "{{ Session::get('success') }}"
            var alertError = "{{ Session::get('error') }}"
            var alertInfo = "{{ Session::get('info') }}"
            var alertWarning = "{{ Session::get('warning') }}"

            if (alertSuccess) {
                toastr.success(alertSuccess);
            }

            if (alertError) {
                toastr.error(alertError);
            }

            if (alertInfo) {
                toastr.info(alertInfo);
            }

            if (alertWarning) {
                toastr.warning(alertWarning);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nenhum resultado encontrado",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros no total)",
                    "search": "Pesquisar:",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    },
                }
            });
        });
    </script>
    <script>
        function downloadPlanilha() {
            // Seus dados da planilha
            var dados = [{
                    glucose_level: 100,
                    measurement_date: '2023-01-01',
                    measurement_time: '12:00'
                },
                // Adicione mais dados conforme necessário
            ];

            // Cria um objeto CSV a partir dos dados
            var csv = 'glucose_level,measurement_date,measurement_time\n';
            dados.forEach(function(item) {
                csv += item.glucose_level + ',' + item.measurement_date + ',' + item.measurement_time + '\n';
            });

            // Cria um elemento de link temporário
            var link = document.createElement('a');
            link.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
            link.target = '_blank';
            link.download = 'planilha.csv';

            // Adiciona o link ao corpo do documento
            document.body.appendChild(link);

            // Simula um clique no link para iniciar o download
            link.click();

            // Remove o link do corpo do documento
            document.body.removeChild(link);
        }
    </script>
