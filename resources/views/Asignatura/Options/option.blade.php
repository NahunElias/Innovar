<td>
    <a href="{{ url('/asignatura/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>
    <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Delete_asignatura({{ $id }})" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="far fa-trash-alt"></i></button>
</td>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>