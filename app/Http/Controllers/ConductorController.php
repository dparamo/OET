<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\conductores;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $conductor = conductores::orderBY('id','DESC')->paginate(5);

            return ['paginate'=>[
                'total' =>$conductor->total(),
                'current_page' =>$conductor->currentPage(),
                'per_page' =>$conductor->perPage(),
                'last_page' =>$conductor->lastPage(),
                'from' =>$conductor->firstItem(),
                'to' =>$conductor->lastPage(),
            ],'conductor'=>$conductor];
        }else{
            return view('conductor.inicio');
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
        $conductor = new conductores();
        $conductor->prop_fnombre = $request->prop_fnombre;
        $conductor->prop_Lnombre = $request->prop_Lnombre;
        $conductor->prop_apellidos = $request->prop_apellidos;
        $conductor->prop_cedula = $request->prop_cedula;
        $conductor->prop_direccion = $request->prop_direccion;
        $conductor->prop_telefono = $request->prop_telefono;
        $conductor->prop_Ciudad = $request->prop_Ciudad;
        $conductor->save();

        return $conductor;
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
        $conductor = conductores::find($id);
        $conductor->prop_fnombre = $request->prop_fnombre;
        $conductor->prop_Lnombre = $request->prop_Lnombre;
        $conductor->prop_apellidos = $request->prop_apellidos;
        $conductor->prop_cedula = $request->prop_cedula;
        $conductor->prop_direccion = $request->prop_direccion;
        $conductor->prop_telefono = $request->prop_telefono;
        $conductor->prop_Ciudad = $request->prop_Ciudad;
        $conductor->save();

        return $conductor;
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
        $conductor = conductores::find($id);
        $conductor->delete();
    }

    public function buscar(Request $request)
    {
        $prop_cedula = $request->prop_cedula;
        
        return conductores::search($prop_cedula)->orderBy('id')->get();
    }
}
