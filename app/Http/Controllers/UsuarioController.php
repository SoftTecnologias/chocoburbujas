<?php

namespace App\Http\Controllers;

use App\Dam;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Dam::all();
        return Response::json($usuarios);
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
       $id = DB::table('dam')->insertGetId([
           'nombre' => $request->input('nombre'),
           'email' => $request->input('email'),
           'password' => bcrypt($request->input('password')),
           'username' => $request->input('username')
       ]);

       return Response::json(['code'=>200,'msg'=>'Se inserto el registro con el id: '.$id, 'detail' => 'OK']);
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
        $user = Dam::findOrFail($id);
        return Response::json($user);

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
        $user = Dam::findOrFail($id);
        $up = [
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'username' => $request->input('username')
        ];

        $user->fill($up);
        $user->save();

        return Response::json(['code'=>200, 'msg' => 'Se ha actualizado correctamente el usuario','detail'=>'ok' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Dam::findOrFail($id);
        $user ->delete();

        return Response::json(['code'=>200,'msg'=>"El usuario ha sido eliminado",'detail' => 'ok']);
    }
}
