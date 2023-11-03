<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@extends('adminlte::page')

@section('title', 'Edit Profile')

@section('content')

    <style>
        .error-message {
            color: #ff0000;
            font-weight: bold;
            background-color: transparent;
            border: none;
            padding: 0;
        }

        .mandatory {
            color: #ff0000;
        }
    </style>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h1>Editar Perfil</h1>
                    <a href="{{ route('profile.index') }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="card card-primary card-outline col-md-6 mx-auto">
                <div class="card-body box-profile">
                    <!-- Conteúdo da primeira coluna -->
                    <div>
                        <div>
                            <div class="text-center">
                                <label for="profile-image" style="cursor: pointer;">
                                    <i class="fa-solid fa-circle-user" style="font-size: 100px;"></i>
                                </label>
                                <input type="file" id="profile-image" name="profile-image" accept="image/*"
                                    style="display: none;">
                            </div>
                        </div>
                        <div>
                            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                            {{-- <p class="text-muted text-center">Software Engineer</p> --}}
                        </div>
                        <hr>
                    </div>
                    <!-- Conteúdo da segunda coluna -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nome<strong class="mandatory">*</strong>:</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', auth()->user()->name) }}">
                                    @if ($errors->has('name'))
                                        <div class="error-message">
                                            <strong class="error-message">* {{ $errors->first('name') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ auth()->user()->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="date_of_birth">Data de Nascimento<strong class="mandatory">*</strong>:</label>
                                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth_formatted) }}">
                                    @if ($errors->has('date_of_birth'))
                                        <div class="error-message">
                                            <strong>* {{ $errors->first('date_of_birth') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="gender">Sexo<strong class="mandatory">*</strong>:</label>
                                    <div class="input-group">
                                        <select class="form-control custom-select" id="gender" name="gender" required>
                                            <option value=" "></option>
                                            <option value="Feminino" {{ (old('gender', $user->gender) == 'Feminino') ? 'selected' : '' }}>Feminino</option>
                                            <option value="Masculino" {{ (old('gender', $user->gender) == 'Masculino') ? 'selected' : '' }}>Masculino</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('gender'))
                                        <div class="alert alert-danger error-message">
                                            * {{ $errors->first('gender') }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="height">Altura (m):</label>
                                    <input type="number" class="form-control" id="height" name="height"
                                        value="{{ auth()->user()->height }}">
                                </div>

                                <div class="form-group">
                                    <label for="weight">Peso (kg):</label>
                                    <input type="number" class="form-control" id="weight" name="weight"
                                        value="{{ auth()->user()->weight }}">
                                </div>

                                <div class="form-group">
                                    <label for="cpf">CPF<strong class="mandatory">*</strong>:</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf"
                                        value="{{ auth()->user()->cpf }}">
                                    @if ($errors->has('cpf'))
                                        <div class="alert alert-danger error-message">
                                            * {{ $errors->first('cpf') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Telefone para contato<strong class="mandatory">*</strong>:</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                                    @if ($errors->has('phone_number'))
                                        <div class="error-message">
                                            <strong>* {{ $errors->first('phone_number') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Conteúdo da terceira coluna -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cep">CEP:</label>
                                    <input type="text" class="form-control" id="cep" name="cep"
                                        value="{{ auth()->user()->cep }}">
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="street">Rua (Logradouro):</label>
                                        <input type="text" class="form-control" id="street" name="street"
                                            value="{{ auth()->user()->street }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="number">Nº:</label>
                                        <input type="text" class="form-control" id="number" name="number"
                                            value="{{ auth()->user()->number }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="neighborhood">Bairro:</label>
                                    <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                                        value="{{ auth()->user()->neighborhood }}">
                                </div>

                                <div class="form-group">
                                    <label for="city">Cidade:</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ auth()->user()->city }}">
                                </div>

                                <div class="form-group">
                                    <label for="state">Estado:</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="{{ auth()->user()->state }}">
                                </div>

                                <div class="form-group">
                                    <label for="allergies"> Alergias:</label>
                                    <input type="text" class="form-control" id="allergies" name="allergies"
                                        value="{{ auth()->user()->allergies }}">
                                </div>

                                <div class="form-group">
                                    <label for="medical_conditions">Condições médicas:</label>
                                    <input type="text" class="form-control" id="medical_conditions"
                                        name="medical_conditions" value="{{ auth()->user()->medical_conditions }}">
                                </div>
                                <strong class="mandatory">* Campos obrigatórios</strong>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
                        $('#street').val(data.logradouro);
                        $('#neighborhood').val(data.bairro);
                        $('#city').val(data.localidade);
                        $('#state').val(data.uf);
                        $('#number').val(data.numero);
                    } else {
                        alert('CEP não encontrado.');
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#phone_number').inputmask("(99) 99999-9999");
    });
</script>

<script>
    $(document).ready(function() {
        $('#cpf').inputmask("999.999.999-99", {
            clearMaskOnLostFocus: false
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#date_of_birth').inputmask("99/99/9999");

        $('#date_of_birth').datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out',
                'Nov', 'Dez'
            ],
            dayNames: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira',
                'Sexta-feira', 'Sábado'
            ],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
            isRTL: false
        });
    });
</script>


