@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Alumnos</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('alumno/create') }}" class="btn btn-sm btn-success">
                    Nuevo alumno
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="alumnos_table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Correo</th>
                        <th>Nombre completo</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Estatu</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($specialties as $specialty)
                    <tr>
                        <th scope="row">
                            {{ $specialty->name }}
                        </th>
                        <td>
                            {{ $specialty->description }}
                        </td>
                        <td>
                            <a href="{{ url('/specialties/'.$specialty->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                            <a href="" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/alumno.js') }}"></script>

@endsection

