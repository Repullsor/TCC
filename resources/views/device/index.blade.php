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
                    <h1>Dispositivos</h1>
                    <a href="{{ route('device.create', auth()->user()->id) }}" class="btn btn-success">Criar</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dispositivos</h3>
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
                                    <th>Nº</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $key => $device)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $device->type }}</td>
                                        <td>{{ $device->brand }}</td>
                                        <td>{{ $device->model }}</td>
                                        <td class="text-center py-0 align-middle">
                                                <a href="{{ route('device.show', $device->id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('device.edit', $device->id) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('device.destroy', $device->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($devices->isEmpty())
                                    <tr>
                                        <td colspan="5">Nenhum dispositivo encontrado.</td>
                                    </tr>
                                @endif
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
        


    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
