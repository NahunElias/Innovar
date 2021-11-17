<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Profesor']);
    }
    public function index($id)
    {
        $idclase_a = $id;
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
            ->select(DB::raw('m.iduser'))
            ->join('clase_asignatura as ca', 'ca.idmaestro', '=', 'm.id')
            ->where('ca.id', '=', $idclase_a)
            ->get();

        foreach ($maestro as $m) {
            if ($m->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera)
        {
            return view('Tareas.index', compact('idclase_a'));
        }else{
            abort(403, 'No puedes acceder a estas tareas.');
        }


    }

    public function index_tareas_maestro(Request $request)
    {
        if ($request->ajax()) {
            $tareas_asig = DB::table('tareas as t')
                ->select(DB::raw('t.id,t.nombre,t.descripcion,t.fecha_ini,t.fecha_fin,t.estatu'))
                ->where('t.idclase_asig', $request->idclase)
                ->get();

            return datatables()->of($tareas_asig)
                ->addColumn('action', 'Tareas.Options.options')
                ->addColumn('descripcion', 'Tareas.Options.descripcion')
                ->rawColumns(['action', 'descripcion'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $idclase_a = $id;
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
                        ->select(DB::raw('m.iduser'))
                        ->join('clase_asignatura as ca','ca.idmaestro','=','m.id')
                        ->where('ca.id','=',$idclase_a)
                        ->get();

        // dd($maestro);
        foreach ($maestro as $m) {
            if($m->iduser == $iduser)
            {
                $bandera = true;
                break;
            }
        }
        if($bandera){
            return view('Tareas.create', compact('idclase_a'));
        }else{
            abort(403, 'No puedes acceder.');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if ($request->hasFile('archivo')) {

                $file = $request->file('archivo');
                $namefile = time() . $file->getClientOriginalName();
                $file->move('Archivos', $namefile);
            } else {
                $namefile = "";
            }

            DB::table('tareas')->insert([

                "nombre"  => $request->nombre,
                "descripcion" => $request->descripcion,
                "archivo" => $namefile,
                "estatu"  => "1",
                "fecha_ini" => $request->fecha_ini,
                "fecha_fin" => $request->fecha_fin,
                "idclase_asig" => $request->idclase,
                "created_at" => date('Y-m-d H:i:s')

            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $request->idclase
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = DB::table('tareas')->where('id', $id)->get();
        $iduser = Auth::id();
        $bandera = false;

        $maestro = DB::table('maestros as m')
                        ->select(DB::raw('m.iduser'))
                        ->join('clase_asignatura as ca','ca.idmaestro','=','m.id')
                        ->where('ca.id','=',$tarea[0]->idclase_asig)
                        ->get();

        // dd($maestro);
        foreach ($maestro as $m) {
            if($m->iduser == $iduser)
            {
                $bandera = true;
                break;
            }
        }
        if($bandera){
            return view('Tareas.edit', compact('tarea'));
        }else{
            abort(403, 'No puedes acceder.');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $tarea = DB::table('tareas')->where('id', $request->idtarea)->get();

            if ($request->hasFile('archivo')) {

                $file = $request->file('archivo');
                $namefile = time() . $file->getClientOriginalName();
                $file->move('Archivos', $namefile);
            } else {

                $namefile = $tarea[0]->archivo;
            }

            DB::table('tareas')->where('id', $request->idtarea)->update([

                "nombre"  => $request->nombre,
                "descripcion" => $request->descripcion,
                "archivo" => $namefile,
                "estatu"  => "1",
                "fecha_ini" => $request->fecha_ini,
                "fecha_fin" => $request->fecha_fin,
            ]);

            return response()->json([
                "message" => "ok",
                "data_id" => $request->idclase
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            $tarea = Tarea::find($request->id);

            $tarea->delete();

            return response()->json([
                "message" => "ok"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ], 200);
        }
    }

    public function Entregas($id)
    {
        $tarea = DB::table('tareas')->where('id', $id)->get();
        $idclase_a = $tarea[0]->idclase_asig;
        return view('Tareas.entregas', compact('id', 'idclase_a'));
    }

    public function Entregas_index(Request $request)
    {
        if ($request->ajax()) {
            $entregas = DB::table('entregas as e')
                ->select(DB::raw('e.id,e.nombre,e.archivo,e.descripcion,e.calificacion,e.estatu,e.created_at,e.reenviar,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m'))
                ->join('alumno_clase as ac', 'e.idalumno_clase', '=', 'ac.id')
                ->join('alumnos as a', 'ac.idalumno', '=', 'a.id')
                ->where('e.idtarea', $request->idtarea)
                ->get();

            return datatables()->of($entregas)
                ->addColumn('alumno', 'Tareas.Options_entregas.alumno')
                ->addColumn('action', 'Tareas.Options_entregas.options')
                ->addColumn('estatu', 'Tareas.Options_entregas.estatu')
                ->rawColumns(['action', 'estatu', 'alumno'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function Entrega($id)
    {
        $entrega = DB::table('entregas')->where('id', $id)->get();

        $tarea = DB::table('tareas as t')
            ->select(DB::raw('t.id,t.nombre,t.descripcion,t.archivo,t.estatu,t.fecha_ini,t.fecha_fin,t.idclase_asig,c.nombre as nom_clase,a.nombre as asignatura,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m'))
            ->join('clase_asignatura as ca', 't.idclase_asig', '=', 'ca.id')
            ->join('clases as c', 'ca.idclase', '=', 'c.id')
            ->join('maestros as m', 'ca.idmaestro', '=', 'm.id')
            ->join('asignaturas as a', 'ca.idasignatura', '=', 'a.id')
            ->where('t.id', $entrega[0]->idtarea)
            ->get();

        return view('Tareas.Options_entregas.Modal.index', compact('tarea', 'entrega'));
    }

    public function Add_Coment_Entrega(Request $request)
    {
        try {

            $id = Auth::id();
            $maestro = DB::table('maestros')->where('iduser', $id)->get();

            DB::table('coment_entregas')->insert([

                "mensaje" => $request->mensaje,
                "identrega" => $request->identrega,
                "idmaestro" => $maestro[0]->id,
                "created_at" => date('Y-m-d H:i:s'),

            ]);

            return response()->json([
                "message" => "ok"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function Del_Coment_Entrega(Request $request)
    {
        try {

            DB::table('coment_entregas')->where('id', $request->id)->delete();

            return response()->json([
                "message" => "ok"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function Calificacion($id)
    {
        $entrega = DB::table('entregas')->where('id', $id)->get();

        return view('Tareas.Options_entregas.Modal.calificacion', compact('entrega'));
    }

    public function Calificar(Request $request)
    {
        try {

            DB::table('entregas')->where('id', $request->identrega)->update([

                "calificacion" => $request->cal,
                "estatu" => '0',

            ]);

            return response()->json([
                "message" => "ok"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function Reenviar(Request $request)
    {
        try {

            DB::table('entregas')->where('id', $request->id)->update([

                "reenviar" => '1',
            ]);

            return response()->json([
                "message" => "ok"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

}
