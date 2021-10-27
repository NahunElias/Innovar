<td>
    <button 
        class="btn btn-datatable btn-icon btn-transparent-dark mr-2" 
        data-toggle="modal" 
        data-target="#exampleModal" 
        data-backdrop="static" 
        data-keyboard="false"
        onclick="Entrega({{ $id }})"
    >
        <i 
            data-toggle="tooltip" 
            data-placement="top" 
            title="Ver entrega"
            class="far fa-eye"
        >
        </i>
    </button>
    <button 
    class="btn btn-datatable btn-icon btn-transparent-dark mr-2" 
    data-toggle="modal" 
    data-target="#mdCalificacion" 
    data-backdrop="static" 
    data-keyboard="false"
    onclick="EntregaCal({{ $id }})"
    >
        <i 
            class="fas fa-sort-numeric-up-alt"
            data-toggle="tooltip" 
            data-placement="top" 
            title="Calificar"
        >
        </i>
    </button>

    @if ($reenviar)
        <button
            class="btn btn-datatable btn-icon btn-transparent-dark mr-2" 
            disabled
        >
        
        <i class="fas fa-reply"></i>
    </button>
    @else
        <button
            class="btn btn-datatable btn-icon btn-transparent-dark mr-2" 
            onclick="HabilitarReenvio({{ $id }})"
        >
            
            <i class="fas fa-reply"></i>
        </button>
    @endif


</td>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>