<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
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
                    <h1>Perfil</h1>
                    <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-primary">Editar</a>
                </div>
            </div>
        </div>
    </section>

    <div class="d-flex justify-content-center">
        <div class="card card-primary card-outline col-md-6 mx-auto">
            <div class="card-body box-profile">
                <div class="text-center">
                    @if (file_exists(public_path('caminho/para/sua/imagem.jpg')))
                        <img src="caminho/para/sua/imagem.jpg" alt="Imagem do Perfil" style="max-width: 128px; max-height: 128px;">
                    @else
                        <i class="fa-solid fa-circle-user" style="font-size: 128px;"></i>
                    @endif
                </div>
                <hr>
            </div>
            

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Informações Pessoais -->
                        <h4>Informações Pessoais</h4>

                        <div class="form-group">
                            <label>CPF:</label>
                            <p>{{ $user->cpf }}</p>
                        </div>
                        <div class="form-group">
                            <label>Data de Nascimento:</label>
                            <p>{{ $user->date_of_birth_formatted }}</p>
                        </div>
                        <div class="form-group">
                            <label>Sexo:</label>
                            <p>{{ auth()->user()->gender }}</p>
                        </div>
                        <div class="form-group">
                            <label>Altura (m):</label>
                            <p>{{ auth()->user()->height }}</p>
                        </div>
                        <div class="form-group">
                            <label>Peso (kg):</label>
                            <p>{{ auth()->user()->weight }}</p>
                        </div>
                        <!-- Informações de Contato -->
                        <h4>Informações de Contato</h4>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                        <div class="form-group">
                            <label>Telefone para contato:</label>
                            <p>{{ auth()->user()->phone_number }}</p>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <!-- Informações de Endereço -->
                        <h4>Endereço</h4>
                        <div class="form-group">
                            <label>CEP:</label>
                            <p>{{ auth()->user()->cep }}</p>
                        </div>
                        <div class="form-group">
                            <label>Rua (Logradouro):</label>
                            <p>{{ auth()->user()->street }}, {{ auth()->user()->number }}</p>
                        </div>
                        <div class="form-group">
                            <label>Bairro:</label>
                            <p>{{ auth()->user()->neighborhood }}</p>
                        </div>
                        <div class="form-group">
                            <label>Cidade:</label>
                            <p>{{ auth()->user()->city }}</p>
                        </div>
                        <div class="form-group">
                            <label>Estado:</label>
                            <p>{{ auth()->user()->state }}</p>
                        </div>
                        <!-- Informações de Endereço -->
                        <h4>Informações Médicas</h4>
                        <div class="form-group">
                            <label>Alergias:</label>
                            <p>{{ auth()->user()->allergies }}</p>
                        </div>
                        <div class="form-group">
                            <label>Condições médicas:</label>
                            <p>{{ auth()->user()->medical_conditions }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </section>

    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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
