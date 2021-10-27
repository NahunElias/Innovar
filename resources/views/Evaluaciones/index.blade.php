@extends('layouts.panel')
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Evaluación</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('evaluacion/'.$idclase_a.'/create') }}" class="btn btn-sm btn-success">
                    Nueva evaluación
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" id="clase_asignatura" value="{{ $idclase_a }}">
    <div class="card-body">
        <div class="table-responsive">
            <!--Tabla -->
            <table id="evaluacion_table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha inicial</th>
                        <th>Fecha final</th>
                        <th>Duración <small>(Minutos)</small></th>
                        <th>Estatu</th>
                        <th>Acción</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/evaluacion.js') }}"></script>
@endsection

