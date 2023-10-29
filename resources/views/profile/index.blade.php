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
                    <label for="profile-image" style="cursor: pointer;">
                        <i class="fa-solid fa-circle-user" style="font-size: 128px;"></i>
                    </label>
                    <input type="file" id="profile-image" name="profile-image" accept="image/*" style="display: none;">
                </div>
            </div>
            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
            <p class="text-muted text-center">Software Engineer</p>
            <div class="card-body">
                <div class="form-group">
                    <label>Data de Nascimento:</label>
                    <p>{{ auth()->user()->date_of_birth }}</p>
                </div>
                <div class="form-group">
                    <label>Sexo:</label>
                    <p>{{ auth()->user()->gender }}</p>
                </div>
                <div class="form-group">
                    <label>Telefone para contato:</label>
                    <p>{{ auth()->user()->phone_number }}</p>
                </div>
                <div class="form-group">
                    <label>CEP:</label>
                    <p>{{ auth()->user()->cep }}</p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label>Rua (Logradouro):</label>
                        <p>{{ auth()->user()->street }}</p>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Nº:</label>
                        <p>{{ auth()->user()->number }}</p>
                    </div>
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


