<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


@extends('adminlte::page')

@section('title', 'Glicemia')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>Glicemia</h1>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
        
                <!-- Campo de Importação de Arquivo -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Importar Arquivo</h3>
                    </div>
                    <div class="card-body text-center"> <!-- Adicionado text-center para centralizar o conteúdo -->
                        <!-- Formulário de Importação -->
                        <form action="" method="post" enctype="multipart/form-data" id="importForm">
                            @csrf
                            <div class="row">
                                <div class="form-group col ml-5 mt-3">
                                    <label for="file"><i class="fas fa-file-upload"></i> Selecione um Arquivo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="file" id="file" class="custom-file-input" onchange="displayFileName()">
                                            <label class="custom-file-label" for="file">Escolher arquivo</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-6 mt-5">
                                    <label></label>
                                    <button type="button" class="btn btn-success" onclick="submitForm()">
                                        <i class="fas fa-cloud-upload-alt"></i> Importar Dados
                                    </button>
                                </div>
                            </div>
                        </form>
                    
                        <!-- Área para Exibir Dados do Arquivo -->
                        <div id="fileData" class="mt-3">
                            <!-- Os dados do arquivo importado serão exibidos aqui -->
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
                    <div class="card-body p-0" style="display: block;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Nível de Glicose</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1, $day = 7; $i <= 10; $i++, $day++)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ \Carbon\Carbon::createFromDate(2023, 11, $day)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::createFromTime(rand(0, 23), rand(0, 59))->format('H:i') }}</td>
                                        <td>{{ rand(80, 120) }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
        

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function submitForm() {
        // Simula o envio do formulário para ilustração
        // Aqui você deve adicionar a lógica real de upload e processamento do arquivo no backend
        alert('Formulário enviado! Aqui você deve lidar com o upload e processamento do arquivo.');

        // Atualiza a área de exibição de dados do arquivo (exemplo)
        updateFileData('Exemplo de dados do arquivo...');
    }

    function updateFileData(data) {
        // Atualiza a área de exibição de dados do arquivo
        document.getElementById('fileData').innerHTML = data;
    }
</script>
<script>
    // Função para exibir o nome do arquivo após a seleção
    function displayFileName() {
        var fileName = document.getElementById('file').files[0].name;
        document.getElementById('fileData').innerHTML = '<p>Arquivo selecionado: ' + fileName + '</p>';
    }
</script>