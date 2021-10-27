@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar maestro</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('maestro') }}" class="btn btn-sm btn-danger">
                    Cancelar y volver
            </a>
            </div>
        </div>
    </div>
    <div class="card-body">

        @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
        @endif

        <form id="form_maestros_edit" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="idmaestro" value="{{ $maestro[0]->idmaestro }}">
                            <input type="hidden" name="iduser" value="{{ $maestro[0]->id }}">
                            <div class="form-group">
                                <label for="nom_user">Nombre de usuario</label>
                                <input type="text" id="nom_user" name="nom_user" class="form-control" value="{{ $maestro[0]->name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email_user">Correo electrónico</label>
                                <input type="email" id="email_user" name="email_user" class="form-control" value="{{ $maestro[0]->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_pass">Nueva contraseña</label>
                                <input type="password" id="user_pass" name="user_pass" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image_user">Imagen de perfil</label>
                                <input type="file" id="image_user" name="image_user" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="primer_nom">Primer nombre</label>
                                <input type="text" id="primer_nom" name="primer_nom" class="form-control" value="{{ $maestro[0]->primer_nom }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="segundo_nom">Segundo nombre</label>
                                <input type="text" id="segundo_nom" name="segundo_nom" class="form-control" value="{{ $maestro[0]->segundo_nom }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_p">Apellido paterno</label>
                                <input type="text" id="apellido_p" name="apellido_p" class="form-control" value="{{ $maestro[0]->apellido_p }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellido_m">Apellido materno</label>
                                <input type="text" id="apellido_m" name="apellido_m" class="form-control" value="{{ $maestro[0]->apellido_m }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control" value="{{ $maestro[0]->direccion }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="form-control" value="{{ $maestro[0]->telefono }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Guardar
            </button>

        </form>
    </div>
</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/maestro.js') }}"></script>

@endsection