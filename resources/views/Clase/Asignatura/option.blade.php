<td>
    <button class="btn btn-danger" onclick="Quitar_asignaturas({{ $id }})" data-toggle="tooltip" data-placement="top" title="Quitar"><i class="fas fa-minus-circle"></i></button>
</td>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>