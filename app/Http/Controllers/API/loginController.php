<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\empleado;
use App\Models\Calificacione;

class loginController extends Controller
{
    
    public function login(request $request){

        $data = $request->all();

        $validator = Validator::make($data, [
            'Cedula' => 'required',
            'Nombre' => 'required',
            'Apellido' => 'required',
            'Operacion' => 'required',
            'Codigo_vr' => 'required'
        ]);

        if ($validator->fails()) {

            return  response([
                'errors' => $validator->errors(),
                'message' => 'Validacion fallida'
            ], 400);

        }

        $emp_validator = empleado::where('emp_cedula', '=', $request->Cedula)->get();

        if(count($emp_validator) === 1){

            $emp_id = $emp_validator[0]['emp_id'];

        }else{

            $empleado = new empleado();
            $empleado->emp_cedula = $request->Cedula;
            $empleado->emp_nombre = $request->Nombre;
            $empleado->emp_apellidos = $request->Apellido;
            $empleado->emp_cargo = $request->Operacion;
            $empleado->save();

            $emp = empleado::select('emp_id')->where('emp_cedula', $empleado->emp_cedula)->get();
            $emp_id = $emp[0]->emp_id;

        }

        $fecha = date('mdY', time());
        $hora = date('his', time());

        $cal_codigo = $request->Codigo_vr."-".$request->Cedula.$fecha.$hora;

        $calificacion = new Calificacione();
        $calificacion->cal_codigo = $cal_codigo;
        $calificacion->codigo_vr = $request->Codigo_vr;
        $calificacion->emp_id = $emp_id;
        $calificacion->save();

        return response()->json([
            'msj' => 'nice'
        ]);


    }
    
    
    //public function login(request $request){

        //$data = $request->all();

        //$validator = Validator::make($data, [
            //'Cedula' => 'required',
            //'Nombre' => 'required',
            //'Apellido' => 'required',
          //  'Operacion' => 'required'
        //]);

        //if ($validator->fails()) {

            //return  response([
              //  'errors' => $validator->errors(),
            //    'message' => 'Validacion fallida'
          //  ], 400);

        //}

        //$emp_validator = empleado::where('emp_cedula', '=', $request->Cedula)->get();

        //if(count($emp_validator) === 1){

          //  $emp_id = $emp_validator[0]['emp_id'];

        //}else{

            //$empleado = new empleado();
            //$empleado->emp_cedula = $request->Cedula;
            //$empleado->emp_nombre = $request->Nombre;
            //$empleado->emp_apellidos = $request->Apellido;
            //$empleado->emp_cargo = $request->Operacion;
          //  $empleado->save();

        //    $emp = empleado::select('emp_id')->where('emp_cedula', $empleado->emp_cedula)->get();
          //  $emp_id = $emp[0]->emp_id;

        //}

        //$fecha = date('m-d-Y', time());
        //$hora = date('h:i:s', time());
        //$cal_codigo = $request->Cedula."-".$fecha."-".$hora;

        //$cal_codigo = $request->cal_codigo;

        //$calificacion = new Calificacione();
        //$calificacion->cal_codigo = $cal_codigo;
        //$calificacion->emp_id = $emp_id;
        //$calificacion->save();

        //return response()->json([
        //    'codigo' => 'nashe'
      //  ]);


    //}
}
