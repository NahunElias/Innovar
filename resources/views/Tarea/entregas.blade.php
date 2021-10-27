@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">Entregas</h3>
            </div>
            <div class="col text-right">
                <a href="{{ url('tarea/'.$idclase_a) }}" class="btn btn-sm btn-danger">
                        Regresar
                </a>
            </div>
        </div>
    </div>
    <input type="hidden" id="idtarea" value="{{ $id }}">
    <div class="card-body">
        <div class="table-responsive">
            <!-- Projects table -->
            <table id="entregas_table" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Calificación</th>
                        <th>Calificado</th>
                        <th>Fecha de entrega</th>
                        <th>Acción</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>

</div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Entrega</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="content_modal">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="mdCalificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Entrega</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="content_modal_calificacion">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>


@section('custom_script')
<script src="{{ asset('js/entregas.js') }}"></script>

@endsection