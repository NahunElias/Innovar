<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TareaAlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Alumno']);
    }
    public function index($id)
    {
        $idclase = $id;
        $iduser = Auth::id();
        $bandera = false;

        $alumno = DB::table('alumnos as a')
            ->select(DB::raw('a.iduser'))
            ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
            ->join('clase_asignatura as ca', 'ca.idclase', '=', 'ac.idclase')
            ->where('ca.id', '=', $idclase)
            ->get();

        foreach ($alumno as $a) {
            if ($a->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera){
            return view('Estudiante.Tarea.index', compact('idclase'));
        }else{
            abort(403, 'No puedes acceder a estas tareas.');
        }


    }

    public function index_tarea_clase(Request $request)
    {
        if ($request->ajax()) {
            $clase_asigna = DB::table('tareas as t')
                ->select(DB::raw('t.id,t.nombre,t.estatu'))
                ->join('clase_asignatura as ca', 'ca.id', '=', 't.idclase_asig')
                ->where('ca.id', $request->idclase)
                ->get();

            return datatables()->of($clase_asigna)
                ->addColumn('action', 'Estudiante.Tarea.Options.options')
                ->addColumn('estatu', 'Estudiante.Tarea.Options.estatu')
                ->rawColumns(['action', 'estatu'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function verTarea($id)
    {
        $iduser = Auth::id();
        $bandera = false;

        $tarea = DB::table('tareas as t')
            ->select(DB::raw('t.id,t.nombre,t.descripcion,t.archivo,t.estatu,t.fecha_ini,t.fecha_fin,t.idclase_asig,c.nombre as nom_clase,a.nombre as asignatura,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m'))
            ->join('clase_asignatura as ca', 't.idclase_asig', '=', 'ca.id')
            ->join('clases as c', 'ca.idclase', '=', 'c.id')
            ->join('maestros as m', 'ca.idmaestro', '=', 'm.id')
            ->join('asignaturas as a', 'ca.idasignatura', '=', 'a.id')
            ->where('t.id', $id)
            ->get();

            $alumno = DB::table('alumnos as a')
                ->select(DB::raw('a.iduser'))
                ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
                ->join('clase_asignatura as ca', 'ca.idclase', '=', 'ac.idclase')
                ->where('ca.id', '=', $tarea[0]->idclase_asig)
                ->get();
    
            // dd($alumno);
            foreach ($alumno as $a) {
                if ($a->iduser == $iduser) {
                    $bandera = true;
                    break;
                }
            }
    
            if($bandera){
                return view('Estudiante.Tarea.verTarea', compact('tarea'));
            }else{
                abort(403, 'No puedes acceder.');
            }


    }

    public function Tarea_Options(Request $request)
    {
        $entrega = DB::table('entregas')
            ->where('idtarea', $request->id)
            ->get();
        $idtarea = $request->id;
        return view('Estudiante.Tarea.tarea_option', compact('entrega', 'idtarea'));
    }

    public function Send_Tarea(Request $request)
    {
        try {

            $id = Auth::id();
            $alumno = DB::table('alumnos')->where('iduser', $id)->get();
            $alumno_clase = DB::table('alumno_clase')->where('idalumno', $alumno[0]->id)->get();

            if ($request->hasFile('fileEntrega')) {

                $file = $request->file('fileEntrega');
                $namefile = time() . $file->getClientOriginalName();
                $file->move('Archivos', $namefile);
            } else {
                $namefile = "";
            }

            DB::table('entregas')->insert([

                "nombre" => $request->nom_entrega,
                "descripcion" => $request->entrega_descripcion,
                "archivo" => $namefile,
                "calificacion" => 0,
                "estatu" => 1,
                "reenviar" => '0',
                "idalumno_clase" => $alumno_clase[0]->id,
                "idtarea" => $request->idtarea,
                "created_at" => date('Y-m-d H:i:s')

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

    public function Del_Entrega(Request $request)
    {
        try {

            $entrega = DB::table('entregas')->where('id', $request->id)->get();

            if ($entrega[0]->archivo != null) {
                $file_path = 'Archivos/' . $entrega[0]->archivo;
                unlink($file_path);
            }

            DB::table('entregas')->where('id', $request->id)->delete();

            return response()->json([
                "message" => "ok"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ]);
        }
    }

    public function VerReenvio(Request $request)
    {
        $entrega = DB::table('entregas')->where('id',$request->id)->get();
        return view('Estudiante.Tarea.reenvio', compact('entrega'));
    }

    public function Reenviar_Tarea(Request $request)
    {
        try {

            $entrega = DB::table('entregas')->where('id',$request->identrega)->get();

            if ($request->hasFile('fileEntrega')) {

                $file = $request->file('fileEntrega');
                $namefile = time() . $file->getClientOriginalName();
                $file->move('Archivos', $namefile);
                if($entrega[0]->archivo != null)
                {
                    $file_path = 'Archivos/'.$entrega[0]->archivo;
                    unlink($file_path);
                }

            } else {
                $namefile = $entrega[0]->archivo;
            }

            DB::table('entregas')->where('id',$request->identrega)->update([

                "nombre" => $request->nom_entrega,
                "descripcion" => $request->entrega_descripcion,
                "archivo" => $namefile,
                "estatu" => 1,
                "reenviar" => '0',
                "created_at" => date('Y-m-d H:i:s')
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}