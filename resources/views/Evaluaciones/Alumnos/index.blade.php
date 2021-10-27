@extends('layouts.panel')
@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Evaluación: <small>{{ '"'.$evaluacion[0]->nombre.'"' }}</small></h3>
                <h5 class="mb-0">Puntos: <small>{{ $suma }}</small></h5>
            </div>
            <div class="col text-right">
                <a href="{{ url('evaluacion/'.$evaluacion[0]->idclase_asig) }}" class="btn btn-sm btn-danger">
                    Cancelar y volver
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" id="clase_asignatura" value="{{ $evaluacion[0]->id }}">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="evaluacion_table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Puntos obtenidos</th>
                        <th>Tiempo <small>(Restante)</small></th>
                        <th>Retardo</th>
                        <th>Fecha de finalización</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/evaluacion_alumno.js') }}"></script>
@endsection
