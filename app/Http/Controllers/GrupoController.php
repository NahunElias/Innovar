<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;

class GrupoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Administrador']);
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
 
            $grupos = Grupo::all();
            
            return datatables()->of($grupos)
            ->addColumn('action','Grupo.Options.option')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true); 
        }
        return view('Grupo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Grupo.create');
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
            'nom_grupo' => 'required',
        ];

        $messages = [
            'nom_grupo.required' => 'Es necesario ingresar el Nombre.',
        ];

        $this->validate($request, $rules, $messages);

        try {
            
            $grupo = new Grupo();

            $grupo->nombre = $request->input('nom_grupo');
            $grupo->save();

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
        $grupo = Grupo::find($id);

        return view('Grupo.edit',compact('grupo'));
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
            'nom_grupo' => 'required',
        ];

        $messages = [
            'nom_grupo.required' => 'Es necesario ingresar el Nombre.',
        ];

        $this->validate($request, $rules, $messages);

        try {
            
            $grupo = Grupo::find($request->idgrupo);

            $grupo->nombre = $request->input('nom_grupo');
            $grupo->save();

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
            $grupo = Grupo::find($request->idgrupo);

            $grupo->delete();

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
