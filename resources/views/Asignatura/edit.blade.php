@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar asignatura</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('asignatura') }}" class="btn btn-sm btn-danger">
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

        <form id="form_asignatura_edit" method="post">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="idasignatura" value="{{ $asignatura->id }}">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_materia">Nombre de la materia</label>
                                <input type="text" id="nom_materia" name="nom_materia" class="form-control" value="{{ $asignatura->nombre }}" required>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="des_asignatura">Descripción</label>
                                <textarea name="des_asignatura" id="des_asignatura" cols="30" rows="5" class="form-control">{{ $asignatura->descripcion }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
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
<script src="{{ asset('js/asignatura.js') }}"></script>

@endsection
