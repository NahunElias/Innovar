<td>
    <a href="{{ url('/evaluacion/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_Eval({{ $id }})" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></button>
    <a href="{{ url('/evaluacion/'.$id.'/questions') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="tooltip" data-placement="top" title="Preguntas"><i class="fas fa-question"></i></a>
    <a href="{{ url('/evaluacion/'.$id.'/alumnos') }}" class="btn btn-datatable btn-icon btn-transparent-dark" data-toggle="tooltip" data-placement="top" title="Evaluaciones de alumnos"><i class="fas fa-user-edit"></i></a>
</td>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>