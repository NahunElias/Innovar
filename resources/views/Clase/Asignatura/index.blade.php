@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Establecer asignaturas</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('clase') }}" class="btn btn-sm btn-danger">
                    Cancelar y volver
            </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <input type="hidden" id="idclase" value="{{ $id }}">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Datos</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="asignadura_id">Asignatura</label>
                                <select name="asignadura_id" id="asignadura_id" class="form-control">
                                    <option value="" selected disabled>Seleccionar</option>
                                    @foreach ($asignaturas as $a)
                                        <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="maestro_id">Maestro</label>
                                <select name="maestro_id" id="maestro_id" class="form-control">
                                    <option value="" selected disabled>Seleccionar</option>
                                    @foreach ($maestros as $m)
                                        <option value="{{ $m->id }}">{{ $m->primer_nom." ".$m->segundo_nom." ".$m->apellido_p." ".$m->apellido_m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success" onclick="Agregar_asignaturas()">Aceptar</button>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Asignaturas de la clase</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table id="clases_asignaturas_table" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Profesor</th>
                                            <th>Asignatura</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/clase.js') }}"></script>
<script>
    $('#asignadura_id').select2();
    $('#maestro_id').select2();
</script>
@endsection
