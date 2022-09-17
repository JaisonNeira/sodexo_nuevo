<?php

namespace App\Exports;

use App\Models\Calificacione;
use DB;
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
            'Codigo calificacion',
            'Cedula empleado',
            'Nombre empleado',
            'Cargo',
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
        $calificaciones = Calificacione::select(
            'calificaciones.cal_codigo',
            'empleados.emp_cedula',
            'empleados.emp_nombre',
            'empleados.emp_cargo',
            'cursos.cur_nombre',
            'sed_nombre',
            'enc_nombre',
            'empr_nit',
            'empr_nombre',
            'calificaciones.cal_calificacion',
            'calificaciones.cal_puntaje',
            'calificaciones.created_at'
        )
            ->leftjoin('empleados', 'empleados.emp_id', '=', 'calificaciones.emp_id')
            ->leftjoin('sedes', 'empleados.sed_id', '=', 'sedes.sed_id')
            ->leftjoin('empresas', 'empleados.empr_id', '=', 'empresas.empr_id')
            ->leftjoin('cursos', 'calificaciones.cur_id', '=', 'cursos.cur_id')
            ->leftjoin('encargados', 'encargados.enc_id', '=', 'calificaciones.enc_id')
            ->where('calificaciones.created_at', '>=', $this->f_ini)
            ->where('calificaciones.created_at', '<=', $this->f_fin)
            ->get();

        return $calificaciones;
    }
}
