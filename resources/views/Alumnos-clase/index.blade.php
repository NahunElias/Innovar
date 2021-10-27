@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Alumnos - clase</h3>
            </div>
            <div class="col text-right">

            </div>
        </div>
    </div>
    <input type="hidden" id="idclase" value="{{ $idclase }}">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="alumnos_clase" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

</div>
@endsection



@section('custom_script')
    <script src="{{ asset('js/alumnos_clase.js') }}"></script>

@endsection

