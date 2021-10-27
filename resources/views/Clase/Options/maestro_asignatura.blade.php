@php
    $maestro_asignatura = DB::table('maestros as m')
                                ->select(DB::raw('m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,a.nombre'))
                                ->join('clase_asignatura as ca','m.id','=','ca.idmaestro')
                                ->join('asignaturas as a','ca.idasignatura','=','a.id')
                                ->join('clases as c','ca.idclase','=','c.id')
                                ->where('c.id',$id)
                                ->get();
@endphp
<td>
    @if (!$maestro_asignatura->isEmpty())
        @foreach ($maestro_asignatura as $m)
            <p>{{ $m->primer_nom." ".$m->apellido_p." - ".$m->nombre }}</p>
        @endforeach  
    @else
        <p>No asignado</p>
    @endif
</td>