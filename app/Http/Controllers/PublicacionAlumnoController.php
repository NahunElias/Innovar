<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PublicacionAlumnoController extends Controller
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

        // dd($alumno);
        foreach ($alumno as $a) {
            if ($a->iduser == $iduser) {
                $bandera = true;
                break;
            }
        }

        if($bandera){
            return view('Estudiante.Publicacion.index', compact('idclase'));
        }else{
            abort(403, 'No puedes acceder a estas publicaciones.');
        }

    }

    public function index_public_clase(Request $request)
    {
        if ($request->ajax()) {
            $clase_asigna = DB::table('publicacions as p')
                ->select(DB::raw('p.id,p.nombre,p.descripcion,tp.nombre as tipo'))
                ->join('tipo_publicacions as tp', 'p.idtipo', '=', 'tp.id')
                ->join('clase_asignatura as ca', 'ca.id', '=', 'p.idclase_asig')
                ->where('ca.id', $request->idclase)
                ->get();

            return datatables()->of($clase_asigna)
                ->addColumn('action', 'Estudiante.Publicacion.Options.action')
                // ->addColumn('descripcion','Anuncio.Options.descripcion')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function verPublicacion($id)
    {
        $iduser = Auth::id();
        $bandera = false;

        $publicacion = DB::table('publicacions as p')
            ->select(DB::raw('p.id,p.nombre,p.descripcion,p.created_at,tp.nombre as tipo,c.nombre as nom_clase,a.nombre as asignatura,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,p.idclase_asig'))
            ->join('tipo_publicacions as tp', 'p.idtipo', '=', 'tp.id')
            ->join('clase_asignatura as ca', 'p.idclase_asig', '=', 'ca.id')
            ->join('clases as c', 'ca.idclase', '=', 'c.id')
            ->join('maestros as m', 'ca.idmaestro', '=', 'm.id')
            ->join('asignaturas as a', 'ca.idasignatura', '=', 'a.id')
            ->where('p.id', $id)
            ->get();

    
            $alumno = DB::table('alumnos as a')
                ->select(DB::raw('a.iduser'))
                ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
                ->join('clase_asignatura as ca', 'ca.idclase', '=', 'ac.idclase')
                ->where('ca.id', '=', $publicacion[0]->idclase_asig)
                ->get();
    
            // dd($alumno);
            foreach ($alumno as $a) {
                if ($a->iduser == $iduser) {
                    $bandera = true;
                    break;
                }
            }
    
            if($bandera){
                return view('Estudiante.Publicacion.ver_publicacion', compact('publicacion'));
            }else{
                abort(403, 'No puedes acceder.');
            }

    }

    public function Comentarios(Request $request)
    {
        $comentarios = DB::table('coments_publics as cp')
            ->select(DB::raw('cp.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,cp.comentario,cp.created_at,a.iduser,u.imagen'))
            ->join('alumno_clase as ac', 'cp.idalumno_clase', '=', 'ac.id')
            ->join('alumnos as a', 'ac.idalumno', '=', 'a.id')
            ->join('users as u', 'a.iduser', '=', 'u.id')
            ->where('cp.idpublicacion', $request->id)
            ->get();

        return view('Estudiante.Publicacion.Options.comentarios', compact('comentarios'));
    }

    public function Add_comentario(Request $request)
    {
        try {
            $id = Auth::id();
            $alumno = DB::table('alumnos')->where('iduser', $id)->get();
            $alumno_clase = DB::table('alumno_clase')->where('idalumno', $alumno[0]->id)->get();

            DB::table('coments_publics')->insert([
                "comentario" => $request->comentario,
                "idalumno_clase" => $alumno_clase[0]->id,
                "idpublicacion" => $request->idpublic,
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

    public function Del_comentario(Request $request)
    {
        try {

            DB::table('coments_publics')->where('id', $request->id)->update(['comentario' => 'Comentario eliminado']);

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
