@extends('layouts.panel')
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Nueva evaluación</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('evaluacion/'.$idclase_a) }}" class="btn btn-sm btn-danger">
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
        <form id="form_evaluacion" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-row">
                        <input type="hidden" name="idclase" value="{{ $idclase_a }}">
                        <div class="form-group col-md-6">
                            <label for="nombre_eval">Nombre</label>
                            <input type="text" name="nombre_eval" id="nombre_eval" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pass_eval">Contraseña</label>
                            <input type="text" name="pass_eval" id="pass_eval" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estatu_eval">Estatu</label>
                            <select name="estatu_eval" id="estatu_eval" class="form-control">
                                <option value="">Seleccionar estado de la evaluación</option>
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="duracion">Duración <small>(Minutos)</small></label>
                            <input type="number" name="duracion" id="duracion" class="form-control" min="1">
                        </div>      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="edit-descripcion">Descripción</label>
                            <textarea name="descripcion" id="edit-descripcion" rows="10" cols="100">
                            </textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_ini">Fecha inicio</label>
                            <input type="datetime-local" name="fecha_ini" id="fecha_ini" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fecha_fin">Fecha final</label>
                            <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </form>
    </div>
</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/eval_option.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script>
        ClassicEditor
            .create( document.querySelector( '#edit-descripcion' ) )
            .catch( error => {
                console.error( error );
            } );
</script>
@endsection