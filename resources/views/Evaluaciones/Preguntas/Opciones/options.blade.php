<td>
    <button class="btn btn-green btn-icon" data-toggle="modal" data-target="#pregunta_respuesta" type="button" onclick="Respuestas({{ $id }})">
        <i class="far fa-comment-dots" data-toggle="tooltip" data-placement="top" title="Respuestas"></i>
    </button>
    <button class="btn btn-green btn-icon" type="button" onclick="Delete_Question({{ $id }})" data-toggle="tooltip" data-placement="top" title="Eliminar pregunta">
        <i class="fas fa-eraser"></i>
    </button>
</td>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>