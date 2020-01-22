<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\propietarios;

class PropietarioController extends Controller
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
            $propietario = propietarios::orderBY('id','DESC')->paginate(5);

            return ['paginate'=>[
                'total' =>$propietario->total(),
                'current_page' =>$propietario->currentPage(),
                'per_page' =>$propietario->perPage(),
                'last_page' =>$propietario->lastPage(),
                'from' =>$propietario->firstItem(),
                'to' =>$propietario->lastPage(),
            ],'propietario'=>$propietario];
        }else{
            return view('propietario.inicio');
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
        $propietario = new propietarios();
        $propietario->prop_fnombre = $request->prop_fnombre;
        $propietario->prop_Lnombre = $request->prop_Lnombre;
        $propietario->prop_apellidos = $request->prop_apellidos;
        $propietario->prop_cedula = $request->prop_cedula;
        $propietario->prop_direccion = $request->prop_direccion;
        $propietario->prop_telefono = $request->prop_telefono;
        $propietario->prop_Ciudad = $request->prop_Ciudad;
        $propietario->save();

        return $propietario;
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
        $propietario = propietarios::find($id);
        $propietario->prop_fnombre = $request->prop_fnombre;
        $propietario->prop_Lnombre = $request->prop_Lnombre;
        $propietario->prop_apellidos = $request->prop_apellidos;
        $propietario->prop_cedula = $request->prop_cedula;
        $propietario->prop_direccion = $request->prop_direccion;
        $propietario->prop_telefono = $request->prop_telefono;
        $propietario->prop_Ciudad = $request->prop_Ciudad;
        $propietario->save();

        return $propietario;
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
        $propietario = propietarios::find($id);
        $propietario->delete();
    }

    public function buscar(Request $request)
    {
        $prop_cedula = $request->prop_cedula;
        
        return propietarios::search($prop_cedula)->orderBy('id')->get();
    }
}
