<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\sede;

class SedesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $total = sede::where('sed_estado', '=', '1')->count();

        $sedes = sede::where('sed_estado', '=', '1')->get();

        return view('sedes.index', compact('sedes', 'total'));

    }

    public function create(request $request)
    {

        $request->validate([
            'sed_nombre' => 'required|unique:sedes'
        ]);

        $datosSede = request()->except('_token');
        sede::insert($datosSede);

        return redirect('/sedes')->with('rgcmessage', 'Sede cargada con exito!...');
    }

    public function destroy($id)
    {
        //sede::where('sed_id', $id)->delete();
        sede::where('sed_id', $id)->update(['sed_estado' => '0']);
        return redirect('/sedes')->with('msjdelete', 'Sede borrada correctamente!...');
    }

    public function update(request $request, $id)
    {

        $datosSede = request()->except(['_token','_method']);
        sede::where('sed_id','=', $id)->update($datosSede);


        Session::flash('msjupdate', '¡La sede se a actualizado correctamente!...');
        return redirect('/sedes');
    }
}
