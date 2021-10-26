@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Editar clase</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('clase') }}" class="btn btn-sm btn-danger">
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

        <form id="form_clase_edit" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input type="hidden" name="idclase" value="{{ $clase[0]->id }}">
                            <div class="form-group">
                                <label for="nom_clase">Nombre de la clase</label>
                                <input type="text" id="nom_clase" name="nom_clase" class="form-control" value="{{ $clase[0]->nombre }}" required>
                            </div>
                        </div>
                        <div class="col-md-3"></div>

  

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="grupo">Grupo</label>
                                <select name="grupo" id="grupo" class="form-control">
                                    <option selected disabled>Seleccionar</option>
                                    @foreach ($grupos as $g)
                                        <option value="{{ $g->id }}" @if($g->id == $clase[0]->idgrupo) {{ "selected" }}  @endif>{{ $g->nombre }}</option>
                                    @endforeach
                                </select>
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
<script src="{{ asset('js/clase.js') }}"></script>
@endsection
