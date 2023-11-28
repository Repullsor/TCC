{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@extends('adminlte::page')

@section('title', 'Profile')

@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>Editar Perfil</h1>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="card card-primary card-outline col-md-6 mx-auto">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <label for="profile-image" style="cursor: pointer;">
                            <i class="fa-solid fa-circle-user" style="font-size: 128px;"></i>
                        </label>
                        <input type="file" id="profile-image" name="profile-image" accept="image/*" style="display: none;">
                    </div>
                </div>
        
                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                <p class="text-muted text-center">Software Engineer</p>
                <form>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nome">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sobrenome:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Sobrenome">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="E-mail">
                        </div>

                        <div class="form-group">
                            <label for="dob">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                placeholder="Selecione a data de nascimento" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo:</label>
                            <div class="input-group">
                                <select class="form-control custom-select" id="sexo" name="sexo" required>
                                    <option value=""></option>
                                    <option value="feminino">Feminino</option>
                                    <option value="masculino">Masculino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="celular">Telefone para contato:</label>
                            <input type="text" class="form-control telefone" id="celular" name="celular"
                                placeholder="(00) 90000-0000" data-mask="(99) 99999-9999">

                        </div>

                        <div class="form-group">
                            <label for="cep">CEP:</label>
                            <input type="text" class="form-control" id="cep" name="cep"
                                placeholder="(XXXXX-XXX)" pattern="\d{5}-\d{3}">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="logradouro">Rua (Logradouro):</label>
                                <input type="text" class="form-control" id="logradouro" name="logradouro">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="numero">Nº:</label>
                                <input type="text" class="form-control" id="numero" name="numero">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bairro">Bairro:</label>
                            <input type="text" class="form-control" id="bairro" name="bairro">
                        </div>

                        <div class="form-group">
                            <label for="cidade">Cidade:</label>
                            <input type="text" class="form-control" id="cidade" name="cidade">
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" class="form-control" id="estado" name="estado">
                        </div>

                        <div class="form-group">
                            <label>Alergias:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Condições médicas:</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </form>
                <a href="#" class="btn btn-primary btn-block"><b>Salvar</b></a>
            </div>
        </div>
        </div>

    </section>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>

<script type="text/javascript">
    $(function() {
        $('#datetimepicker14').datetimepicker({
            allowMultidate: true,
            multidateSeparator: ','
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.telefone').mask('(99) 99999-9999');
    });
</script>

<script>
    $(document).ready(function() {
        var cepInput = $('#cep');

        cepInput.on('input', function() {
            var unformatted = cepInput.val().replace(/\D/g, '');
            var formatted = unformatted.replace(/(\d{5})(\d{3})/, '$1-$2');
            cepInput.val(formatted);

            if (unformatted.length == 8) {
                $.getJSON('https://viacep.com.br/ws/' + unformatted + '/json/', function(data) {
                    if (!("erro" in data)) {
                        $('#logradouro').val(data.logradouro);
                        $('#bairro').val(data.bairro);
                        $('#cidade').val(data.localidade);
                        $('#estado').val(data.uf);
                        $('#numero').val(data.numero);
                    } else {
                        alert('CEP não encontrado.');
                    }
                });
            }
        });
    });
</script>

 --}}
