<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vehiculos;
use App\Models\propietarios;
use App\Models\conductores;

class VehiculoController extends Controller
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
            $vehiculo = vehiculos::orderBY('id','DESC')->paginate(5);
            $propietario = propietarios::all();
            $conductor = conductores::all();
            return ['paginate'=>[
                'total' =>$vehiculo->total(),
                'current_page' =>$vehiculo->currentPage(),
                'per_page' =>$vehiculo->perPage(),
                'last_page' =>$vehiculo->lastPage(),
                'from' =>$vehiculo->firstItem(),
                'to' =>$vehiculo->lastPage(),
            ],'vehiculo'=>$vehiculo,'propietario'=>$propietario,'conductor'=>$conductor];
        }else{
            return view('vehiculo.inicio');
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
        $vehiculo = new vehiculos();
        $vehiculo->vehi_placa = $request->vehi_placa;
        $vehiculo->vehi_color = $request->vehi_color;
        $vehiculo->vehi_marca = $request->vehi_marca;
        $vehiculo->vehi_tipo_vehiculo = $request->vehi_tipo_vehiculo;
        $vehiculo->id_propietario = $request->id_propietario;
        $vehiculo->id_conductor = $request->id_conductor;
        $vehiculo->save();

        return $vehiculo;
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
        $vehiculo = vehiculos::find($id);
        $vehiculo->vehi_placa = $request->vehi_placa;
        $vehiculo->vehi_color = $request->vehi_color;
        $vehiculo->vehi_marca = $request->vehi_marca;
        $vehiculo->vehi_tipo_vehiculo = $request->vehi_tipo_vehiculo;
        $vehiculo->id_propietario = $request->id_propietario;
        $vehiculo->id_conductor = $request->id_conductor;
        $vehiculo->save();

        return $vehiculo;
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
        $vehiculo = vehiculos::find($id);
        $vehiculo->delete();
    }

    public function buscar(Request $request)
    {
        $vehi_placa = $request->vehi_placa;
        
        return vehiculos::search($vehi_placa)->orderBy('id')->get();
    }
}
