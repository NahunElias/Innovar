<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asignatura;

class AsignaturaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Administrador']);
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
 
            $asignaturas = Asignatura::all();
            
            return datatables()->of($asignaturas)
            ->addColumn('action','Asignatura.Options.option')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true); 
        }
        return view('Asignatura.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Asignatura.create');
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
            'nom_materia' => 'required',
            'des_asignatura' => 'required',
        ];

        $messages = [
            'nom_materia.required' => 'Es necesario ingresar el Nombre.',
            'des_asignatura.required' => 'Es necesario ingresar una descripción.',
        ];

        $this->validate($request, $rules, $messages);

        try {
            
            $asignatura = new Asignatura();

            $asignatura->nombre = $request->input('nom_materia');
            $asignatura->descripcion = $request->input('des_asignatura');
            $asignatura->save();

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
        $asignatura = Asignatura::find($id);

        return view('Asignatura.edit',compact('asignatura'));
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
            'nom_materia' => 'required',
            'des_asignatura' => 'required',
        ];

        $messages = [
            'nom_materia.required' => 'Es necesario ingresar el Nombre.',
            'des_asignatura.required' => 'Es necesario ingresar una descripción.',
        ];

        $this->validate($request, $rules, $messages);

        try {
            
            $asignatura = Asignatura::find($request->idasignatura);

            $asignatura->nombre = $request->input('nom_materia');
            $asignatura->descripcion = $request->input('des_asignatura');
            $asignatura->save();

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
            $asignatura = Asignatura::find($request->idasign);

            $asignatura->delete();

            return response()->json([
                "message" => "ok"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }


    }
}
