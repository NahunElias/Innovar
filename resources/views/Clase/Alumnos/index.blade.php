@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Establecer alumnos</h3>
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
                <div class="col-md-6">

                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Alumnos de la clase</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clases_alumnos_asignados_table" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Alumno</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
        
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Alumnos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="clases_alumnos_table" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Alumno</th>
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

@endsection
