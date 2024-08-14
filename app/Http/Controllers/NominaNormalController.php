<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Matricula;

use Illuminate\Support\Facades\DB;

class NominaNormalController extends Controller
{
    public function generateNominaPDF()
    {
        $data = [
            [["REGIÓN:", "PUNO"], ["UGEL:", "06"], ["CETPRO:", "CEPRO HUANCANÉ"]],
            [["GESTIÓN PÚBLICA:", "X"], ["GESTIÓN PRIVADA:", "--"], ["CONVENIO:", "--"], ["CÓDIGO MODULAR:", "469452"]],
            [["RESOLUCIÓN DE CREACIÓN:", "RM N° 0194 - 1975 ED"], ["RESOLUCIÓN DE CONVERSIÓN:", "--"]],
            [["PROVINCIA:", "LIMA"], ["DISTRITO:", "LIMA"]],
            [["LUGAR:", "ATE"], ["DIRECCIÓN:", "Urbanización CERES II ETAPA"]],
            [["PROGRAMA DE ESTUDIOS:", "PELUQUERÍA Y BARBERÍA"]],
            [["MÓDULO:", "CORTE DE CABELLO, DISEÑO DE BARBA, PEINADO"], ["RES. DIRECTORAL DEL MÓDULO:", "RD N° 07592 - 2024 - UGEL 06"], ["CICLO:", "AUXILIAR TÉCNICO"]],
            [["FECHA DE INICIO:", "18/03/2024"], ["FECHA DE TÉRMINO:", "19/07/2024"], ["TURNO:", "NOCHE"], ["SECCIÓN:", "ÚNICA"]]
        ];

        $studentData = DB::table('matricula')
            ->join('estudiante', 'matricula.codigo_estudiante_id', '=', 'estudiante.codigo_estudiante')
            ->select(
                'matricula.codigo_estudiante_id as Codigo_Matricula',
                DB::raw("CONCAT(estudiante.apellido_paterno, ' ', estudiante.apellido_materno, ' ', estudiante.nombre) as Apellidos_Nombres"),
                'estudiante.sexo as Sexo',
                'estudiante.fecha_nacimiento as Fecha_Nacimiento'
            )
            ->get();


        $pdf = Pdf::loadView('pdf.nominaNormal', compact('data', 'studentData'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('nomina.pdf');
    }
}
