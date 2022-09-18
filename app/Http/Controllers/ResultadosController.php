<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Session;
use App\Exports\CalificacionesExport;
use App\Models\Calificacione;
use App\Models\curso;
use App\Models\encargado;

/* SELECT e.*, c.* FROM empleados e INNER JOIN calificacion c WHERE c.emp_id = e.emp_id AND c.created_at > '1900-01-01' AND c.created_at < '2022-12-31' */

/* SELECT MONTH(created_at), AVG(cal_calificacion) FROM calificaciones WHERE created_at BETWEEN date_sub(now(), interval 5 month) AND NOW() GROUP BY MONTH(created_at) ORDER BY cal_id DESC */


class ResultadosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cursos = curso::where('cur_estado', '=', '1')->get();
        $encargados = encargado::where('enc_estado', '=', '1')->get();

        return view('resultados_r', compact('cursos', 'encargados'));
    }

    public function Ver_mas(request $request){

        $sql = "SELECT emp.emp_cedula, emp.emp_nombre, emp.emp_apellidos, cal.cal_puntaje,
        emp.emp_cargo, cal.cal_codigo, cur.cur_nombre, enc.enc_nombre, cal.cal_calificacion
        FROM calificaciones AS cal
        LEFT JOIN empleados AS emp ON cal.emp_id = emp.emp_id
        LEFT JOIN cursos AS cur ON cur.cur_id = cal.cur_id
        LEFT JOIN encargados AS enc ON enc.enc_id = cal.enc_id
        WHERE cal.cal_id = ".$request->cal_id;

        $data = DB::select($sql);
        echo json_encode(
            array(
                "success" => true,
                "cal_puntaje" => $data[0]->cal_puntaje,
                "emp_cedula" => $data[0]->emp_cedula,
                "emp_nombre" => $data[0]->emp_nombre.' '.$data[0]->emp_apellidos,
                "emp_cargo" => $data[0]->emp_cargo,
                "cal_codigo" => $data[0]->cal_codigo,
                "cur_nombre" => $data[0]->cur_nombre,
                "enc_nombre" => $data[0]->enc_nombre,
                "cal_calificacion" => $data[0]->cal_calificacion,
            )
        );

    }

    public function buscarDatosActualizar(request $request)
    {

        $sql = "SELECT cal.cal_id, cal.cal_codigo, cal.cal_calificacion, cal.cal_puntaje, emp.emp_id, emp.emp_nombre,
         cur.cur_id, cur.cur_nombre, enc.enc_id, enc.enc_nombre, cal.created_at
        FROM calificaciones cal
        INNER JOIN empleados AS emp ON emp.emp_id = cal.emp_id
        LEFT JOIN cursos AS cur ON cur.cur_id = cal.cur_id
        LEFT JOIN encargados AS enc ON enc.enc_id = cal.enc_id
        WHERE cal.cal_id = " . $request->cal_id;

        $calificacion = DB::select($sql);
        $cursos = curso::where('cur_estado', '=', '1')->get();
        $encargados = encargado::where('enc_estado', '=', '1')->get();

        echo json_encode(
            array(
                "success" => true,
                "datos" => $calificacion,
                "cursos" => $cursos,
                "encargados" => $encargados
            )
        );

    }

    public function ActualizarDatos(request $request)
    {

        $datosCalificacion = request()->except(['_token', '_method', 'cal_id']);
        $update = Calificacione::where('cal_id', '=', $request->cal_id)->update($datosCalificacion);

        if ($update == 1) {
            Session::flash('msjupdate', '¡La calificacion se a actualizado correctamente!...');
            return redirect('/resultados/recientes');
        }

        Session::flash('msjdelete', '¡Algo fallo, intentelo nuevamente!...');
        return redirect('/resultados/recientes');

    }

    /* DASHBOARD */
    public function graficaBarra()
    {

        /* PROMEDIO DE CALIFICACIONES DE LOS ULTIMOS 6 MESES */
        $p6m_sql = "SELECT MONTH(created_at) AS mes, AVG(cal_calificacion) AS promedio
        FROM calificaciones
        WHERE created_at BETWEEN date_sub(now(), interval 6 month) AND NOW()
        GROUP BY MONTH(created_at) ORDER BY mes ASC";

        $p6m = DB::select($p6m_sql);

        echo json_encode(
            array(
                "success" => true,
                "p6m" => $p6m
            )
        );

    }

    public function graficaCircular()
    {

        $debajo_40 = Calificacione::where('cal_calificacion', '<', '40.0')->count();
        $sobre_40 = Calificacione::where('cal_calificacion', '>', '40.0')->where('cal_calificacion', '<=', '60.0')->count();
        $sobre_60 = Calificacione::where('cal_calificacion', '>', '60.0')->where('cal_calificacion', '<=', '70.0')->count();
        $sobre_70 = Calificacione::where('cal_calificacion', '>', '70.0')->where('cal_calificacion', '<=', '80.0')->count();
        $sobre_80 = Calificacione::where('cal_calificacion', '>', '80.0')->where('cal_calificacion', '<=', '90.0')->count();
        $sobre_90 = Calificacione::where('cal_calificacion', '>', '90.0')->count();

        echo json_encode(
            array(
                "success" => true,
                "d_40" => $debajo_40,
                "s_40" => $sobre_40,
                "s_60" => $sobre_60,
                "s_70" => $sobre_70,
                "s_80" => $sobre_80,
                "s_90" => $sobre_90
            )
        );

    }

    /* EXPORTAR */
    public function export(request $request)
    {

        $sql = "SELECT emp.emp_id, emp.emp_cedula, emp.emp_nombre, emp.emp_apellidos, emp.emp_cargo, cur.cur_id,
         cur.cur_nombre, sed.sed_id, sed.sed_nombre, enc.enc_id, enc.enc_nombre, empr.empr_id,
          empr.empr_nit, empr.empr_nombre, cal.cal_id, cal.cal_calificacion, cal.created_at
        FROM empleados emp
        LEFT JOIN calificaciones cal ON cal.emp_id = emp.emp_id
        LEFT JOIN sedes sed ON emp.sed_id = sed.sed_id
        LEFT JOIN empresas empr ON emp.empr_id = empr.empr_id
        LEFT JOIN cursos cur ON cal.cur_id = cur.cur_id
        LEFT JOIN encargados enc ON enc.enc_id = cal.enc_id
        WHERE emp.emp_estado = 1
        AND cal.created_at >= '" . $request->fecha_inicio . "' AND cal.created_at <= '" . $request->fecha_fin . "'";

        $datos = DB::select($sql);

        if (count($datos) > 0) {

            $f_ini = $request->fecha_inicio;
            $f_fin = $request->fecha_fin;

            return Excel::download(new CalificacionesExport($f_ini, $f_fin), 'Calificaciones.xlsx');
        }

        return redirect()->back()->with('noregistromessage', 'No se encontraron examenes entre las fecha: ' . $request->fecha_inicio . ' y ' . $request->fecha_fin . '!...');

    }

    public function download_pdf($id)
    {
        $sql = "SELECT emp.emp_id, emp.emp_cedula, emp.emp_nombre, emp.emp_apellidos, emp.emp_cargo, cur.cur_id,
         cur.cur_nombre, sed.sed_id, sed.sed_nombre, enc.enc_id, enc.enc_nombre, empr.empr_id,
          empr.empr_nit, empr.empr_nombre, cal.cal_id, cal.cal_codigo, cal.cal_puntaje, cal.cal_calificacion, cal.created_at
        FROM empleados emp
        LEFT JOIN calificaciones cal ON cal.emp_id = emp.emp_id
        LEFT JOIN sedes sed ON emp.sed_id = sed.sed_id
        LEFT JOIN empresas empr ON emp.empr_id = empr.empr_id
        LEFT JOIN cursos cur ON cal.cur_id = cur.cur_id
        LEFT JOIN encargados enc ON enc.enc_id = cal.enc_id
        WHERE cal.cal_id = ".$id;

        $calificacion = DB::select($sql);

        $sql2 = "SELECT res.res_id, pre.pre_id, res.res_respuesta, pre.pre_nombre, pre.pre_consejo
        FROM resultados AS res
        INNER JOIN preguntas AS pre ON res.res_pregunta = pre.pre_id
        WHERE res.cal_id = ".$id."
        ORDER BY pre.pre_id ASC";

        $respuestas = DB::select($sql2);

        $pdf = PDF::loadView('pdf', compact('calificacion', 'respuestas'));

        return $pdf->download('reporte.pdf');
    }



    /* AJAXS TABLAS */
    public function tablaindex()
    {

        $sql = 'SELECT emp.emp_id, emp.emp_cedula, emp.emp_nombre, emp.emp_apellidos, emp.emp_cargo, cur.cur_id,
        cur.cur_nombre, sed.sed_id, sed.sed_nombre, enc.enc_id, enc.enc_nombre, empr.empr_id,
        empr.empr_nit, empr.empr_nombre, cal.cal_id, cal.cal_calificacion, cal.cal_puntaje, cal.created_at
        FROM empleados emp
        LEFT JOIN calificaciones cal ON cal.emp_id = emp.emp_id
        LEFT JOIN sedes sed ON emp.sed_id = sed.sed_id
        LEFT JOIN empresas empr ON emp.empr_id = empr.empr_id
        LEFT JOIN cursos cur ON cal.cur_id = cur.cur_id
        LEFT JOIN encargados enc ON enc.enc_id = cal.enc_id
        WHERE cal.created_at >= "1900-01-01"
        AND cal.created_at <= "2152-12-31"
        AND emp.emp_estado = 1';

        $datos = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "data" => $datos
            )
        );

    }

    public function tabladatos(request $request)
    {

        $sql = "SELECT emp.emp_id, emp.emp_cedula, emp.emp_nombre, emp.emp_apellidos, emp.emp_cargo, cur.cur_id,
        cur.cur_nombre, sed.sed_id, sed.sed_nombre, enc.enc_id, enc.enc_nombre, empr.empr_id,
        empr.empr_nit, empr.empr_nombre, cal.cal_id, cal.cal_calificacion, cal.cal_puntaje ,cal.created_at
        FROM empleados emp
        LEFT JOIN calificaciones cal ON cal.emp_id = emp.emp_id
        LEFT JOIN sedes sed ON emp.sed_id = sed.sed_id
        LEFT JOIN empresas empr ON emp.empr_id = empr.empr_id
        LEFT JOIN cursos cur ON cal.cur_id = cur.cur_id
        LEFT JOIN encargados enc ON enc.enc_id = cal.enc_id
        WHERE emp.emp_estado = 1
        AND cal.created_at >= '" . $request->fecha_inicio . "'
        AND cal.created_at <= '" . $request->fecha_final . "'";

        $datos = DB::select($sql);

        echo json_encode(
            array(
                "success" => true,
                "data" => $datos
            )
        );

    }

    public function BusquedaAvanzada(request $request)
    {

        if ($request->emp_cedula == null || $request->cur_id == null || $request->enc_id == null) {

            echo json_encode(
                array(
                    "success" => false,
                    "data" => []
                )
            );

        } else {

            $sql = 'SELECT emp.emp_id, emp.emp_cedula, emp.emp_nombre, emp.emp_apellidos, emp.emp_cargo, cur.cur_id,
            cur.cur_nombre, sed.sed_id, sed.sed_nombre, enc.enc_id, enc.enc_nombre, empr.empr_id,
            empr.empr_nit, empr.empr_nombre, cal.cal_id, cal.cal_calificacion, cal.cal_puntaje, cal.created_at
            FROM empleados emp
            LEFT JOIN calificaciones cal ON cal.emp_id = emp.emp_id
            LEFT JOIN sedes sed ON emp.sed_id = sed.sed_id
            LEFT JOIN empresas empr ON emp.empr_id = empr.empr_id
            LEFT JOIN cursos cur ON cal.cur_id = cur.cur_id
            LEFT JOIN encargados enc ON enc.enc_id = cal.enc_id
            WHERE emp.emp_estado = 1
            AND emp.emp_cedula = ' . $request->emp_cedula . '
            AND cur.cur_id = ' . $request->cur_id . '
            AND enc.enc_id = ' . $request->enc_id;

            $datos = DB::select($sql);

            echo json_encode(
                array(
                    "success" => true,
                    "data" => $datos
                )
            );

        }
    }
}
