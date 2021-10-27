@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar grupo</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('grupo') }}" class="btn btn-sm btn-danger">
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

        <form id="form_grupo_edit" method="post">
            @csrf

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="idgrupo" value="{{ $grupo->id }}">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom_grupo">Nombre</label>
                                <input type="text" id="nom_grupo" name="nom_grupo" class="form-control" value="{{ $grupo->nombre }}" required>
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
<script src="{{ asset('js/grupo.js') }}"></script>

@endsection