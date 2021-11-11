<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Maestro;
use App\Models\User;

class AlumnoClasesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Profesor']);
    }

    public function index($id)
    {
        
        $iduser = Auth::id();
        $idclase = $id;
        $bandera = false;

        $maestro = DB::table('maestros as m')
                        ->select(DB::raw('m.iduser'))
                        ->join('clase_asignatura as ca','ca.idmaestro','=','m.id')
                        ->where('ca.idclase','=',$idclase)
                        ->get();

        // dd($maestro);
        foreach ($maestro as $m) {
            if($m->iduser == $iduser)
            {
                $bandera = true;
                break;
            }
        }
        if($bandera)
        {
            return view('Alumnos-clase.index',compact('idclase'));
        }else{
            abort(403, 'No puedes acceder a esta clase.');
        }


        // $user = User::find(Auth::id());
        // $this->authorize('alumnos',$user,$maestro[0]);
        
    }

    public function index_alumnos_clase(Request $request)
    {
        if($request->ajax())
        {
            $alumnos_clase = DB::table('alumnos as a')
            ->select(DB::raw('a.id,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,u.imagen,a.iduser,a.telefono,a.direccion'))
            ->join('alumno_clase as ac', 'ac.idalumno', '=', 'a.id')
            ->join('users as u','a.iduser','=','u.id')
            ->where('ac.idclase',$request->idclase)
            ->get();

            return datatables()->of($alumnos_clase)
                ->addColumn('nombre','Alumnos-clase.Options.options')
                ->addColumn('imagen','Alumnos-clase.Options.foto')
                ->rawColumns(['nombre','imagen'])
                ->addIndexColumn()
                ->make(true); 
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
