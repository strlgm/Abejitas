<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\hoteles;
use Auth;


class HotelController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   // $hoteles=Hoteles::with ('idusuario')->select('nombre')->where('idusuario',auth()->id())->get();

    
    $hoteles=Hoteles::get()->toJson(JSON_PRETTY_PRINT);
    return response($hoteles,200);
   //   return hoteles::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
		$hoteles = new Hoteles;
		$hoteles->nombre= $request->nombre;
		$hoteles->idpais= $request->idpais;
        $hoteles->idusuario= $request->idusuario;
        $hoteles->save();
        
        return response()->json([

            "message"=>"Hotel creado"
        ],201);
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		/*	$hoteles = new hoteles;
		$hoteles->nombre= $request->nombre;
		$hoteles->ubicacion= $request->ubicacion;
		$hoteles->save();
        return $hoteles;*/
        $hoteles = new Hoteles;
		$hoteles->nombre=$request->nombre;
		$hoteles->idpais=$request->idpais;
        $hoteles->idusuario= Auth::id();
        $hoteles->save();
        
        return response()->json([

            "message"=>"Hotel creado"
        ],201);
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

      /*  if(Hoteles::where('idhotel',$id)->exists()){
           $hoteles=Hoteles::where('idhotel',$id)->get()->toJson(JSON_PRETTY_PRINT);
           return response ($hoteles,200);
       } 
        else{
            return response ()->json([
                "message"=>"El hotel no existe"
            ],404);
        } */


           $hotel= Hoteles::findOrFail($id);
           $pais= $hotel->paises->paisnombre;
           return response($hotel,200);
	
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
       
        if (Hoteles::where('idhotel',$id)->exists()){
            $hoteles=Hoteles::find($id);
            $hoteles->nombre=$request->nombre;
	     	$hoteles->idpais=$request->idpais;
            $hoteles->idusuario= Auth::id();
            $hoteles->save();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (Hoteles::where('id_hotel',$id)->exists()){
            $hoteles=Hoteles::find($id);
            $hoteles->delete();
          //  return $hoteles;
       
        
        return response()->json([

            "message"=> "Hotel eliminado"
        ],200);
    }
   else{

    return response()->json([
        "message" => "No existe el ID"
    ],404);
   }
    }
    //creado provisional
    public function idras(Request $request)
    {
        $mac=$request->idm;

        if (Hoteles::where('macwifi',$mac)->exists()){
            
            $hotel= Hoteles::select('idhotel','nombre')->where('macwifi','=',$mac)->first();

            return response ()->json (
                array(
                    "message"=> "El hotel ya existe", 
                    'hotel' => $hotel,
                   
                )
            );


        }

        else{

	    $hoteles = new Hoteles;
		$hoteles->nombre='HProvisional';
        $hoteles->macwifi=$request->idm;
		$hoteles->idpais=42;
        $hoteles->idusuario=0;
        $hoteles->save();

        

        
        $hotel= Hoteles::where('macwifi','=',$mac)->first();
        return response ()->json ($hotel);
 
        }

      /*   hoteln = DB::table('hotel')->get();
        return $products; */
        
       /*  return response()->json([
            "message"=>"Hotel creado"
        ],201); */
    }

   
    public function datosHotel($id) {
       
        $hotel = Hoteles::find($id);
        $datos= $hotel->datos;
       // $hoteles=$usuario::with(['hoteles','hoteles.paises'])
        //->join('Pais','hotel.idpais','=','Pais.id')
       // ->get();
  
        return response($hotel,200);
  
       
  
      }



}
