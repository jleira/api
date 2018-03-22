<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Auth;
use DB;


class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
        public function empresasactivas()
    {
         $results=DB::table('empresas')->select('id','nombre')->get();
        return response($results,200); 
    }

    public function nuevacategoria(Request $request)
    {
    $this->validate($request, [
            'nombre' => 'required',
    ]);
    $validador=DB::table('categorias')->where('id_empresa',Auth::user()->id_empresa)->where('nombre',$request->nombre)->first();
        if(($validador)){
            $this->validate($request, [
                'nombre' => 'required|unique:categorias,nombre',
        ]);
    
       }
       if(!$request->has('descripcion')){
        $request->descripcion="";
       }
       if(!$request->has('referencia')){
        $request->referencia="";
       }
       $categoriaid = DB::table('categorias')->where('id_empresa',Auth::user()->id_empresa)->max('id_categoria');

       DB::table('categorias')->insert(
        [
        'id_empresa' => Auth::user()->id_empresa,
        'id_categoria' => $categoriaid+1, 
        'nombre' => $request->nombre,
        'referencia' => $request->referencia,
        'descripcion'=> $request->descripcion        
        ]
    );
    return response('Categoria creada exitosamente',200);
    }

    //
}
