<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;
use App\Http\Requests\StoreBootcampRequest;
use App\Http\Resources\BootcampCollection;
use App\Http\Resources\BootcampResource;


class BootcampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //metodo que trae los objetos response
        //parametros: 1, data a enviar al client
        //2. codigo status http
        return response()->json(new BootcampCollection(Bootcamp::all())
                          ,200); 
       //echo "mostrar los bootcamps";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreBootcampRequest $request)
    {
            return response()->json( [
            "success" => true,
            "data" => new BootcampResource(
                Bootcamp::create($request->all())
                        )
                ] , 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        return response()->json( [
                                    "success" => true,
                                    "data" => new BootcampResource(Bootcamp::find($id))
                                ],200);
        //echo "mostrar un bootcamp especifico cuyo id sea $id";
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
       //1. localizar el bootcamp con id
       $b = Bootcamp::find($id);
       //2. actualizarlo con update
       $b->update($request->all());
       return response()->json( [
        "success" => true,
        "data" => new BootcampResource($b)
    ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = Bootcamp::find($id);
        $b->delete($id);
        return response()->json( [
            "success" => true,
            "data" => $b
        ],200);

       
    }
}
