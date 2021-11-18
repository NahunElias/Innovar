<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Administrador']);
    }
    public function index(Request $request)
    {

        if($request->ajax())
        {

            $clases = DB::table('clases as c')
                        ->select(DB::raw('c.id,c.nombre as nom_clase,g.nombre as grupo'))
                        ->join('grupos as g','c.idgrupo','=','g.id')
                        ->get();
            

            return datatables()->of($clases)
                ->addColumn('profesor_Asig','Clase.Options.maestro_asignatura')
                // ->addColumn('profesor','Clase.Options.nombre_maestro')
                ->addColumn('action','Clase.Options.options')
                ->rawColumns(['action','profesor_Asig'])
                ->addIndexColumn()
                 ->make(true); 

        }

        return view('Clase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $grupos = DB::table('grupos')->get();

        return view('Clase.create',compact('grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nom_clase' => 'required',
            'grupo' => 'required',
 
        ];

        $messages = [
            'nom_clase.required' => 'Es necesario ingresar el Nombre de la clase.',
            'grupo.required' => 'Es necesario seleccionar el grupo.',

        ];

        $this->validate($request, $rules, $messages);

        try {

            DB::table('clases')->insert([
                "nombre" => $request->nom_clase,
                "idgrupo" => $request->grupo,
            ]);


            return response()->json([
                "message" => "ok"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
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
        // $asig_maestro = DB::table('maestros as m')
        //     ->select(DB::raw('am.id,as.nombre, m.primer_nom,m.apellido_p'))
        //     ->join('asign_maestro as am','m.id','=','am.idmaestro')
        //     ->join('asignaturas as as','am.idasignatura','=','as.id')
        //     ->get();

        $grupos = DB::table('grupos')->get();

        $clase = DB::table('clases')->where('id',$id)->get();

        return view('Clase.edit',compact('clase','grupos'));
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
        $rules = [
            'nom_clase' => 'required',
            'grupo' => 'required',
 
        ];

        $messages = [
            'nom_clase.required' => 'Es necesario ingresar el Nombre de la clase.',
            'grupo.required' => 'Es necesario seleccionar el grupo.',

        ];

        $this->validate($request, $rules, $messages);

        try {

            DB::table('clases')->where('id',$request->idclase)->update([
                "nombre" => $request->nom_clase,
                "idgrupo" => $request->grupo,
            ]);

            return response()->json([
                "message" => "ok"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
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
            DB::table('clases')->where('id',$request->id)->delete();

            return response()->json([
                "message" => "ok"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function clase_asignaturas($id)
    {
        $maestros = DB::table('maestros')->get();
        $asignaturas = DB::table('asignaturas')->get();

        return view('Clase.Asignaturas.index',compact('id','maestros','asignaturas'));
    }

    public function index_class_sub(Request $request)
    {
        if($request->ajax())
        {
            $maestro_clases = DB::table('maestros as m')
                ->select(DB::raw('ca.id,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,a.nombre'))
                ->join('clase_asignatura as ca','m.id','=','ca.idmaestro')
                ->join('asignaturas as a','a.id','=','ca.idasignatura')
                ->join('clases as c','c.id','=','ca.idclase')
                ->where('c.id',$request->idclase)
                ->get();


            return datatables()->of($maestro_clases)
                ->addColumn('profesor','Clase.Asignaturas.nombre_profesor')
                ->addColumn('action','Clase.Asignaturas.option')
                ->rawColumns(['action','profesor'])
                ->addIndexColumn()
                 ->make(true); 
        }
        return view('Clase.Asignaturas.index');
    }

    public function Agregar_asignaturas(Request $request)
    {
        try {
            DB::table('clase_asignatura')->insert([
                "idclase"  => $request->idclase,
                "idmaestro"  => $request->maestro_id,
                "idasignatura"  => $request->asignatura_id,
            ]);

            return response()->json([
                "message" => "ok"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function Quitar_asignaturas(Request $request)
    {
        try {
            DB::table('clase_asignatura')->where('id',$request->id)->delete();

            return response()->json([
                "message" => "ok"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function clase_alumnos($id)
    {
        return view('Clase.Alumnos.index',compact('id'));
    }

    public function alumnos_clase_asig_index(Request $request)
    {
        if($request->ajax())
        {
            $alumnos = DB::table('alumnos as a')
                        ->select(DB::raw('ac.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m'))
                        ->join('alumno_clase as ac','a.id','=','ac.idalumno')
                        ->where('ac.idclase',$request->idclase)
                        ->get();

            return datatables()->of($alumnos)
                        ->addColumn('nom_alumno','Clase.Alumnos.nombre')
                        ->addColumn('action','Clase.Alumnos.delete')
                        ->rawColumns(['action','nom_alumno'])
                        ->addIndexColumn()
                        ->make(true); 
        }

    }

    public function alumnos_general(Request $request)
    {

        if($request->ajax())
        {
            $alumnos = DB::table('alumnos as a')
            ->whereNotExists(function ($query) 
            {
                $query->select(DB::raw(1))
                    ->from('alumno_clase as ac')
                    ->whereRaw('a.id=ac.idalumno');
            })
            ->get();

            return datatables()->of($alumnos)
                ->addColumn('nom_alumno','Clase.Alumnos.nombre')
                ->addColumn('action','Clase.Alumnos.option')
                ->rawColumns(['action','nom_alumno'])
                ->addIndexColumn()
                ->make(true); 

        }

    }

    public function Add_alumnos(Request $request)
    {
        try {

            DB::table('alumno_clase')->insert([
                "idalumno" => $request->idalumno,
                "idclase"  => $request->idclase
            ]);

            return response()->json([
                "message" => "ok"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }

    public function Del_alumnos(Request $request)
    {
        try {

            DB::table('alumno_clase')->where('id',$request->id)->delete();

            return response()->json([
                "message" => "ok"
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }



}
