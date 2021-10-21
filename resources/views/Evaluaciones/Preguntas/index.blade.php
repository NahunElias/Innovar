<div class="row">
    <div class="col-md-12">
        <h5 class="mb-0" style="text-align: center;">{{ $pregunta[0]->pregunta." " }}<span class="badge badge-info"> {{ "valor: ".$pregunta[0]->valor }}</span></h5>
        <br>
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="pregunta_id" id="pregunta_id" value="{{ $pregunta[0]->id }}">
                <div class="form-group">
                    <label for="">Respuesta</label>
                    <input type="text" name="respuesta_" id="respuesta_" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Correcto</label>
                    <select name="estatu_respuesta" id="estatu_respuesta" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
                <button class="btn btn-success" onclick="Add_Answers()">Agregar</button>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table id="evaluacion_answers_table" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Respuesta</th>
                                <th>Correcto</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>