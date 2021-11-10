<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:Administrador']);
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {

            $alumnos = DB::table('alumnos as a')
                        ->select(DB::raw('u.id,u.name,u.email,u.imagen,u.estatu,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,a.direccion,a.telefono'))
                        ->join('users as u','u.id','=','a.iduser')
                        ->get();

            return datatables()->of($alumnos)
            ->addColumn('Foto_perfil','Alumno.Options.foto_perfil')
            ->addColumn('Nombre_completo','Alumno.Options.nombre')
            ->addColumn('action','Alumno.Options.options')
            ->addColumn('estatu','Alumno.Options.estatu')
            ->rawColumns(['Foto_perfil','Nombre_completo','action','estatu'])
            ->addIndexColumn()
            ->make(true); 
        }
        return view('Alumno.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Alumno.create');
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

            $user->assignRole('Alumno');
            $alumno = new Alumno();

            $alumno->primer_nom = $request->input('primer_nom');
            $alumno->segundo_nom = $request->input('segundo_nom');
            $alumno->apellido_p = $request->input('apellido_p');
            $alumno->apellido_m = $request->input('apellido_m');
            $alumno->direccion = $request->input('direccion');
            $alumno->telefono = $request->input('telefono');
            $alumno->iduser = $usuario[0]->id;

            $alumno->save();

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
        $alumno = DB::table('alumnos as a')
            ->select(DB::raw('a.id as idalumno,u.id,u.name,u.email,u.imagen,a.primer_nom,a.segundo_nom,a.apellido_p,a.apellido_m,a.direccion,a.telefono'))
            ->join('users as u','u.id','=','a.iduser')
            ->where('u.id',$id)
            ->get();

        return view('Alumno.edit',compact('alumno'));

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

            $alumno = Alumno::find($request->idalumno);

            $alumno->primer_nom = $request->input('primer_nom');
            $alumno->segundo_nom = $request->input('segundo_nom');
            $alumno->apellido_p = $request->input('apellido_p');
            $alumno->apellido_m = $request->input('apellido_m');
            $alumno->direccion = $request->input('direccion');
            $alumno->telefono = $request->input('telefono');
            $alumno->iduser = $usuario->id;

            $alumno->save();

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
}
|