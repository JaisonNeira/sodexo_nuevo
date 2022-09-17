<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\curso;

class CursosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $total = curso::where('cur_estado', '=', '1')->count();

        $cursos = curso::where('cur_estado', '=', '1')->get();

        return view('cursos.index', compact('cursos', 'total'));

    }

    public function create(request $request)
    {

        $request->validate([
            'cur_nombre' => 'required|unique:cursos'
        ]);

        $datosCurso = request()->except('_token');
        curso::insert($datosCurso);

        return redirect('/cursos')->with('rgcmessage', 'Curso cargado con exito!...');
    }

    public function destroy($id)
    {
        //curso::where('cur_id', $id)->delete();
        curso::where('cur_id', $id)->update(['cur_estado' => '0']);
        return redirect('/cursos')->with('msjdelete', 'Curso borrado correctamente!...');
    }

    public function update(request $request, $id)
    {

        $datosCurso = request()->except(['_token','_method']);
        curso::where('cur_id','=', $id)->update($datosCurso);


        Session::flash('msjupdate', '¡La curso se a actualizado correctamente!...');
        return redirect('/cursos');
    }
}
