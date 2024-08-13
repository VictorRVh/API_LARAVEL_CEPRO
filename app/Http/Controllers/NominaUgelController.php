<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class NominaUgelController extends Controller
{
    public function generatePDF()
    {
        $headers = [
            'UGEL', 'CÓDIGO MODULAR', 'NOMBRE DEL CETPRO', 'PROGRAMA DE ESTUDIOS',
            'CICLO', 'N° DE RESOLUCIÓN', 'MÓDULO', 'TIPO DE DOCUMENTO',
            'N° DNI', 'APELLIDO PATERNO', 'APELLIDO MATERNO', 'NOMBRES',
            'SEXO', 'FECHA DE NACIMIENTO'
        ];

        $data = array_fill(0, 40, [
            '06', '469452', 'CEPRO HUANCANÉ', 'PELUQUERÍA Y BARBERÍA', 'AUXILIAR TÉCNICO',
            'RD N° 07592 - 2024 - UGEL 06', 'CORTE DE CABELLO, DISEÑO DE BARBA, PEINADO', 'DNI',
            '71090436', 'ANDRADE', 'MARICHIN', 'Azucena Lisbeth', 'F', '16/01/1956'
        ]);

        $pdf = Pdf::loadView('pdf.nominaUgel', compact('headers', 'data'))
                  ->setPaper('a4', 'landscape'); 

        return $pdf->stream('tabla_matricula.pdf');
    }
}
