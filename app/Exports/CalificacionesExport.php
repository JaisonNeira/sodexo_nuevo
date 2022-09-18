<?php

namespace App\Exports;

use App\Models\Calificacione;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CalificacionesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $f_ini;
    protected $f_fin;

    public function __construct($fecha_inicial, $fecha_final)
    {
        $this->f_ini = $fecha_inicial;
        $this->f_fin = $fecha_final;
    }

    public function headings(): array
    {
        return [
            'Cedula empleado',
            'Nombre empleado',
            'Operacion',
            'Curso',
            'Sede',
            'Encargado',
            'Nit Empresa',
            'Nombre Empresa',
            'Calificacion',
            'Puntaje',
            'Fecha creacion'
        ];
    }
    public function collection()
    {

        $sql = 'SELECT emp.emp_cedula, CONCAT(emp.emp_nombre, " ",emp.emp_apellidos) AS emp_nombre, emp.emp_cargo,
        cur.cur_nombre, sed.sed_nombre, enc.enc_nombre,
        empr.empr_nit, empr.empr_nombre, CONCAT(cal.cal_calificacion, "%") AS cal_calificacion, cal.cal_puntaje, cal.created_at
        FROM empleados emp
        LEFT JOIN calificaciones cal ON cal.emp_id = emp.emp_id
        LEFT JOIN sedes sed ON emp.sed_id = sed.sed_id
        LEFT JOIN empresas empr ON emp.empr_id = empr.empr_id
        LEFT JOIN cursos cur ON cal.cur_id = cur.cur_id
        LEFT JOIN encargados enc ON enc.enc_id = cal.enc_id
        WHERE cal.created_at >= "'.$this->f_ini.'"
        AND cal.created_at <= "'.$this->f_fin.'"';

        $calificaciones = DB::select($sql);

        return collect($calificaciones);
    }
}
