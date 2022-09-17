<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\resultado;
use App\Models\Calificacione;
use Illuminate\Support\Facades\Validator;

class RespuestaController extends Controller
{
    
    public function post_respuesta(request $request){

        $data = $request->all();

        $validator = Validator::make($data, [
            'res_respuesta' => 'required'
        ]);

        if ($validator->fails()) {

            return  response([
                'errors' => $validator->errors(),
                'message' => 'Validacion fallida'
            ], 400);

        }
        //SEPARAMOS LA PREGUNTA Y LA RESPUESTA EN DOS VARIABLES DIFERENTES
        //1 1 CORRECTO
        //2 0 INCORRECTO
        $datos = $request->res_respuesta;
        list($res_pregunta, $res_respuesta, $codigo_vr) = explode(" ", $datos);

        //BUSCAMOS EL ULTIMO LOGIN DE LAS GAFAS (CALIFICACION) Y LE EXTRAEMOS EL ID
        $sql = 'SELECT cal.cal_id
        FROM calificaciones AS cal
        Where cal.codigo_vr = "'.$codigo_vr.'"
        ORDER by cal.created_at DESC
        limit 1';

        $calificacion = DB::select($sql);

        if(count($calificacion) == 0){
            return response()->json([
                'mensaje' => 'Las gafas '.$codigo_vr.' no han tenido calificaciones reportadas'
            ]);
        }

        $cal_id = $calificacion[0]->cal_id;

        //VALIDAMOS SI YA RESPONDIO ESTA PREGUNTA
        $res_validador = resultado::where('cal_id', '=', $cal_id)->where('res_pregunta', '=', $res_pregunta)->get();

        if(count($res_validador) != 0){
            return response()->json([
                'mensaje' => 'ya respondio la pregunta: '.$res_pregunta
            ]);
        }

        //CREAMOS LA RESPUESTA Y LA CONECTAMOS CON LA CALIFICACION
        $resultado = new resultado();
        $resultado->cal_id = $cal_id;
        $resultado->res_pregunta = $res_pregunta;
        $resultado->res_respuesta = $res_respuesta;
        $resultado->save();


        //CALIFICACION
        $calificacion = Calificacione::where('cal_id', '=', $cal_id)->get();

        $cal_sql1 = 'SELECT COUNT(*) AS cant_pre
        FROM resultados AS res
        WHERE res.cal_id = '.$cal_id.'
        AND res_estado = 1';

        $cp = DB::select($cal_sql1);

        $cant_pre = $cp[0]->cant_pre;

        $cal_sql2 = 'SELECT SUM(res.res_respuesta) AS suma_correctas
        FROM resultados AS res
        WHERE res.cal_id = '.$cal_id.'
        AND res_estado = 1';

        $cpc = DB::select($cal_sql2);

        $cant_pre_correctas = $cpc[0]->suma_correctas;

        $calificacion = round($cant_pre_correctas/9*100);

        $cal_puntaje = $cant_pre_correctas.'/'.$cant_pre;

        Calificacione::where('cal_id', $cal_id)->update(['cal_calificacion' => $calificacion]);
        Calificacione::where('cal_id', $cal_id)->update(['cal_puntaje' => $cal_puntaje]);

        return response()->json([
            'mensaje' => 'respuesta y calificacion guardada con exito!',
            'v' => $calificacion
        ]);

    }
    
    
    //public function post_respuesta(request $request){

        //$data = $request->all();

        //$validator = Validator::make($data, [
            //'res_respuesta' => 'required',
          //  'Codigo' => 'required'
        //]);

        //if ($validator->fails()) {

            //return  response([
              //  'errors' => $validator->errors(),
            //    'message' => 'Validacion fallida'
          //  ], 400);

        //}
        //1 1 CORRECTO
        //2 0 INCORRECTO
        //$datos = $request->res_respuesta;
        //list($res_pregunta, $res_respuesta) = explode(" ", $datos);
 
        //if($request->Codigo != null){
            
        //    $cal_id = Calificacione::select('cal_id')->where('cal_codigo', $request->cal_codigo)->get();

        //    $resultado = new resultado();
        //    $resultado->cal_id = $cal_id[0]['cal_id'];
        //    $resultado->res_pregunta = $res_pregunta;
        //    $resultado->res_respuesta = $res_respuesta;
        //    $resultado->save();
        
            
        //}else{
        //    $resultado = new resultado();
        //    $resultado->res_pregunta = $request->Codigo;
        //    $resultado->res_respuesta = $res_respuesta;
        //    $resultado->save();
        //}
        
        //return response()->json([
          //  'mensaje' => 'respuesta guardada con exito!'
      //  ]);    

    //}

    /* public function respuesta(){

        $data = $request->all();

        $validator = Validator::make($data, [
            'res_respuesta' => 'required'
        ]);

        if ($validator->fails()) {

            return  response([
                'errors' => $validator->errors(),
                'message' => 'Validacion fallida'
            ], 400);

        }
        //1 1 CORRECTO
        //2 0 INCORRECTO
        $datos = $request->res_respuesta;
        list($cal_codigo, $pregunta, $res_respuesta) = explode(" ", $datos);

        $p_validador = Resultado::where("cal_id", "=" ,$cal_codigo)->where("res_pregunta","=",$pregunta)->get();

        $respuesta = new respuesta();
        $respuesta->pregunta = $pregunta;
        $respuesta->res_respuesta = $res_respuesta;
        $respuesta->save();

        return response()->json([
            'mensaje' => 'respuesta guardada con exito!',
        ]);

    } */

}
