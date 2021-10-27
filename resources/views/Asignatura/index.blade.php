@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Asignaturas</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('asignatura/create') }}" class="btn btn-sm btn-success">
                    Nueva asignatura
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="asignaturas_table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
  
            </table>
        </div>
    </div>

</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/asignatura.js') }}"></script>

@endsection

