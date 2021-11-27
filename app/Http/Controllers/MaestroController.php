<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Maestro;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MaestroController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Administrador']);
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $maestros = DB::table('maestros as m')
                        ->select(DB::raw('u.id,u.name,u.email,u.imagen,u.estatu,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,m.direccion,m.telefono'))
                        ->join('users as u','u.id','=','m.iduser')
                        ->get();
            
            return datatables()->of($maestros)
            ->addColumn('Foto_perfil','Maestro.Options.foto_perfil')
            ->addColumn('Nombre_completo','Maestro.Options.nombre')
            ->addColumn('action','Maestro.Options.options')
            ->addColumn('estatu','Maestro.Options.estatu')
            ->rawColumns(['Foto_perfil','Nombre_completo','action','estatu'])
            ->addIndexColumn()
            ->make(true); 
        }
        return view('Maestro.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Maestro.create');
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
            'nom_user' => 'required',
            'email_user' => 'required',
            'user_pass' => 'required',
            'image_user' => 'required',
            'primer_nom' => 'required',
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ];

        $messages = [
            'nom_user.required' => 'Es necesario ingresar el Nombre.',
            'email_user.required' => 'Es necesario ingresar el correo.',
            'user_pass.required' => 'Es necesario ingresar la contraseña.',
            'image_user.required' => 'Es necesario ingresar la imagen.',
            'primer_nom.required' => 'Es necesario ingresar el primer nombre.',
            'apellido_p.required' => 'Es necesario ingresar el apellido paterno.',
            'apellido_m.required' => 'Es necesario seleccionar el apellido materno.',
            'direccion.required' => 'Es necesario ingresar la dirección.',
            'telefono.required' => 'Es necesario seleccionar el teléfono.'
        ];

        $this->validate($request, $rules, $messages);
        try {


            $user = new User();
            if($request->hasFile('image_user')){

                $file = $request->file('image_user');
                $nameimg = time().$file->getClientOriginalName();
                $file->move('images',$nameimg);
            }

            $user->name = $request->input('nom_user');
            $user->email = $request->input('email_user');
            $user->imagen = $nameimg;
            $user->estatu = 'A';
            $user->password = Hash::make($request->input('user_pass'));
            $user->save();

            $usuario = User::where('email',$request->input('email_user'))->get();
            $user = User::find($usuario[0]->id);

            $user->assignRole('Profesor');
            $maestro = new Maestro();

            $maestro->primer_nom = $request->input('primer_nom');
            $maestro->segundo_nom = $request->input('segundo_nom');
            $maestro->apellido_p = $request->input('apellido_p');
            $maestro->apellido_m = $request->input('apellido_m');
            $maestro->direccion = $request->input('direccion');
            $maestro->telefono = $request->input('telefono');
            $maestro->iduser = $usuario[0]->id;

            $maestro->save();

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
        $maestro = DB::table('maestros as m')
            ->select(DB::raw('m.id as idmaestro,u.id,u.name,u.email,u.imagen,m.primer_nom,m.segundo_nom,m.apellido_p,m.apellido_m,m.direccion,m.telefono'))
            ->join('users as u','u.id','=','m.iduser')
            ->where('u.id',$id)
            ->get();

        return view('Maestro.edit',compact('maestro'));
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
            'nom_user' => 'required',
            'email_user' => 'required',
            'primer_nom' => 'required',
            'apellido_p' => 'required',
            'apellido_m' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ];

        $messages = [
            'nom_user.required' => 'Es necesario ingresar el Nombre.',
            'email_user.required' => 'Es necesario ingresar el correo.',
            'primer_nom.required' => 'Es necesario ingresar el primer nombre.',
            'apellido_p.required' => 'Es necesario ingresar el apellido paterno.',
            'apellido_m.required' => 'Es necesario seleccionar el apellido materno.',
            'direccion.required' => 'Es necesario ingresar la dirección.',
            'telefono.required' => 'Es necesario seleccionar el teléfono.'
        ];

        $this->validate($request, $rules, $messages);
        try {


            $user = User::find($request->iduser);

            if($request->hasFile('image_user')){

                $file = $request->file('image_user');
                $nameimg = time().$file->getClientOriginalName();
                $file->move('images',$nameimg);
                if($user->imagen != null)
                {
                    $image_path = 'images/'.$user->imagen;
                    unlink($image_path);
                }
            }else{
                $nameimg = $user->imagen;
            }

            if($request->user_pass != null)
            {
                $pass = Hash::make($request->user_pass);
            }else{
                $pass = $user->password;
            }


            $user->name = $request->input('nom_user');
            $user->email = $request->input('email_user');
            $user->imagen = $nameimg;
            $user->password = $pass;
            $user->save();

            $usuario = User::find($request->iduser);

            $maestro = Maestro::find($request->idmaestro);

            $maestro->primer_nom = $request->input('primer_nom');
            $maestro->segundo_nom = $request->input('segundo_nom');
            $maestro->apellido_p = $request->input('apellido_p');
            $maestro->apellido_m = $request->input('apellido_m');
            $maestro->direccion = $request->input('direccion');
            $maestro->telefono = $request->input('telefono');
            $maestro->iduser = $usuario->id;

            $maestro->save();

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

            $usuario = User::find($request->iduser);

            if($usuario->estatu == 'A')
            {
                DB::table('users')->where('id',$request->iduser)
                    ->update(['estatu' => "B"]);
            }else
            {
                DB::table('users')->where('id',$request->iduser)
                    ->update(['estatu' => "A"]);
            }

            return response()->json([
                "message" => "ok"
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th
            ],200);
        }
    }
    // public function create_roles()
    // {
    //     $role = Role::create(['name' => 'Alumno']);
    //     return "ok";
    // }

}
