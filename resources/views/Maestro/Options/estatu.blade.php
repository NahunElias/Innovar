@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Maestros</h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('maestro/create') }}" class="btn btn-sm btn-success">
                    Nuevo maestro
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="maestros_table" class="table table-bordered" width="100%" cellspacing="0">
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
<div class="modal fade" id="maestro_asignatura" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Asignaturas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="content_asignaturas"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>
@section('custom_script')
<script src="{{ asset('js/maestro.js') }}"></script>

@endsection

