<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


@extends('adminlte::page')

@section('title', 'Dispositivos')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>Criar Dispositivos</h1>
                    <a href="{{ route('device.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Novo Dispositivo</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('device.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="type">Tipo:</label>
                                    <select name="type" class="form-control select2" required>
                                        <option value="" selected disabled>Selecione um tipo de dispositivo</option>
                                        <option value="diabetes">Glicemia</option>
                                        <option value="blood_pressures">Pressão Arterial</option>
                                        {{-- Você pode adicionar opções dinâmicas aqui se necessário --}}
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="brand">Marca:</label>
                                    <input type="text" name="brand" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="model">Modelo:</label>
                                    <input type="text" name="model" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    
        <script>
            $(document).ready(function() {
                // Inicialize o plugin Select2
                $('.select2').select2({
                    tags: true, // Permite a adição de novas tags
                    tokenSeparators: [',', ' '], // Define os separadores de tags
                });
            });
        </script>
    
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>