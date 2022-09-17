<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\encargado;

class EncargadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total = encargado::where('enc_estado', '=', '1')->count();

        $encargados = encargado::where('enc_estado', '=', '1')->get();

        return view('encargados.index', compact('encargados', 'total'));
    }

    public function create(request $request)
    {
        $request->validate([
            'enc_cedula' => 'required|unique:encargados',
            'enc_nombre' => 'required'
        ]);

        $datosEncargados = request()->except('_token');
        encargado::insert($datosEncargados);

        return redirect('/encargados')->with('rgcmessage', 'encargado cargado con exito!...');
    }

    public function destroy($id)
    {
        //encargado::where('enc_id', $id)->delete();
        encargado::where('enc_id', $id)->update(['enc_estado' => '0']);
        return redirect('/encargados')->with('msjdelete', 'encargado borrado correctamente!...');
    }

    public function update(request $request, $id)
    {
        $datosEncargados = request()->except(['_token', '_method']);
        encargado::where('enc_id', '=', $id)->update($datosEncargados);

        Session::flash('msjupdate', '¡La encargado se a actualizado correctamente!...');
        return redirect('/encargados');
    }
}
