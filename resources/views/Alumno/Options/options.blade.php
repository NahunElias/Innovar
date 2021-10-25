<td>
    <a href="{{ url('/alumno/'.$id.'/edit') }}" class="btn btn-datatable btn-icon btn-transparent-dark mr-2" data-toggle="tooltip" data-placement="top" title="Editar"><i class="far fa-edit"></i></a>

    @if ($estatu == 'A')
        <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Estatu_usuario({{ $id }})" data-toggle="tooltip" data-placement="top" title="Desactivar"><i class="fas fa-ban"></i></button>
    @else
        <button class="btn btn-datatable btn-icon btn-transparent-dark" onclick="Estatu_usuario({{ $id }})" data-toggle="tooltip" data-placement="top" title="Activar"><i class="far fa-check-circle"></i></button>
    @endif
</td>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>