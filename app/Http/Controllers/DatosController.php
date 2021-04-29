<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Datos;
use App\Models\hoteles;

class DatosController extends Controller
{
    public function index()//todos
    {
   // $hoteles=Hoteles::with ('idusuario')->select('nombre')->where('idusuario',auth()->id())->get();

    $datos=Datos::get()->toJson(JSON_PRETTY_PRINT);
    return response($datos,200);
   //   return hoteles::all();
    }


    public function store(Request $request){
        $idh=$request->id;
    
        $user = Hoteles::select('idusuario')->where('idhotel','=',$idh)->get()->first();

        $datos = new Datos;
		$datos->temperatura=$request->temperatura;
		$datos->humedad=$request->humedad;
        $datos->presion=$request->presion;
        $datos->hotel_idhotel=$request->id;     
        $datos->id_users=$user->idusuario;
        $datos->save(); 
 
        
        return response ()->json (
          [            "message"=>"Dato Insertado"],201);
    }

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
       
        if (Datos::where('iddatos',$id)->exists()){
            $idh=$request->id;    
        $user = Hoteles::select('idusuario')->where('idhotel','=',$idh)->get()->first();
            $datos=Datos::find($id);
            $datos->temperatura=$request->temperatura;
            $datos->humedad=$request->humedad;
            $datos->presion=$request->presion;
            $datos->hotel_idhotel=$request->id;     
            $datos->id_users=$user->idusuario;
            $datos->save(); 
          //  return $hoteles;
       
        
        return response()->json([

            "message"=> "Dato Actualizado"
        ],200);
    }
   else{

    return response()->json([
        "message" => "No existe el ID"
    ],404);
   }
	
		
		
    }

   



}
