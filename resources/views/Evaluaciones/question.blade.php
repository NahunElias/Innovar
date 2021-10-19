@extends('layouts.panel')

@section('content')
<div class="card shadow">
    <div class="card-header border-0">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="mb-0">{{ "Evaluación: ".$evaluacion[0]->nombre." " }}<span class="badge badge-info">Preguntas</span></h3>
                <h3 class="mb-0">{{ "Puntos: " }}<span class="badge badge-primary"><div id="puntos_total"></div></span></h3>
            </div>
            <div class="col text-right">
            <a href="{{ url('evaluacion/'.$evaluacion[0]->idclase_asig) }}" class="btn btn-sm btn-danger">
                    Cancelar y volver
            </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-3"
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        <i class="far fa-question-circle"></i> Preguntas
                    </button>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            <div class="row">
                <input type="hidden" id="idexamen" value="{{ $evaluacion[0]->id }}">
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="evaluacion_questions_table" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th>Valor</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Crear preguntas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Pregunta</label>
                    <input type="text" name="question" id="question" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Valor</label>
                    <input type="number" name="question_valor" id="question_valor" class="form-control" step=".50">
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
            <button class="btn btn-primary" type="button" onclick="Add_Questions()">Agregar</button></div>
        </div>
    </div>
</div>
<div class="modal fade" id="pregunta_respuesta" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Respuestas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="content_respuesta"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>
@endsection
@section('custom_script')
<script src="{{ asset('js/pregunta.js') }}"></script>
@endsection