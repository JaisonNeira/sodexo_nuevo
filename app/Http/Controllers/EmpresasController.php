<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\empresa;

class EmpresasController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $total = empresa::count();

        $empresas = empresa::where('empr_estado', '=', '1')->get();

        return view('empresas.index', compact('empresas', 'total'));

    }

    public function create(request $request)
    {

        $request->validate([
            'empr_nit' => 'required|unique:empresas',
            'empr_nombre' => 'required|unique:empresas'
        ]);

        $datosEmpresa = request()->except('_token');
        empresa::insert($datosEmpresa);

        return redirect('/empresas')->with('rgcmessage', 'Empresa cargada con exito!...');
    }

    public function destroy($id)
    {
        //empresa::where('empr_id', $id)->delete();
        empresa::where('empr_id', $id)->update(['empr_estado' => '0']);
        return redirect('/empresas')->with('msjdelete', 'Empresa borrada correctamente!...');
    }

    public function update(request $request, $id)
    {

        $datosEmpresa = request()->except(['_token','_method']);
        empresa::where('empr_id','=', $id)->update($datosEmpresa);


        Session::flash('msjupdate', '¡La empresa se a actualizado correctamente!...');
        return redirect('/empresas');
    }
}
