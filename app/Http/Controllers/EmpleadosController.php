<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\empleado;
use App\Models\empresa;
use App\Models\sede;

class EmpleadosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $total = empleado::where('emp_estado', '=', '1')->count();

        $sql = "SELECT emp.*, empr.empr_id ,empr.empr_nombre, sed.sed_id, sed.sed_nombre
        FROM empleados AS emp
        LEFT JOIN empresas AS empr ON emp.empr_id = empr.empr_id
        LEFT JOIN sedes AS sed ON emp.sed_id = sed.sed_id
        WHERE emp.emp_estado = 1";

        $empleados = DB::select($sql);

        $empresas = empresa::where('empr_estado', '=', '1')->get();
        $sedes = sede::where('sed_estado', '=', '1')->get();

        return view('empleados.index', compact('empleados', 'total', 'sedes', 'empresas'));

    }

    public function create(request $request)
    {
        $request->validate([
            'emp_cedula' => 'required|unique:empleados',
            'emp_nombre' => 'required',
            'emp_apellidos' => '',
            'empr_id' => 'required',
            'emp_cargo' => 'required',
            'sed_id' => 'required'
        ]);

        $datosEmpresa = request()->except('_token');
        empleado::insert($datosEmpresa);

        return redirect('/empleados')->with('rgcmessage', 'Empresa cargada con exito!...');
    }

    public function destroy($id)
    {
        //empleado::where('emp_id', $id)->delete();
        empleado::where('emp_id', $id)->update(['emp_estado' => '0']);
        return redirect('/empleados')->with('msjdelete', 'Empresa borrada correctamente!...');
    }

    public function update(request $request, $id)
    {
        $datosEmpresa = request()->except(['_token','_method']);
        empleado::where('emp_id','=', $id)->update($datosEmpresa);

        Session::flash('msjupdate', '¡La empleado se a actualizado correctamente!...');
        return redirect('/empleados');
    }
}
