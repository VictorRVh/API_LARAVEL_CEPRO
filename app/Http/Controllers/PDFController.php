<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generateNominaPDF()
    {
        $data = [
            'cetproData' => [
                [" CETPRO:", "CEPRO HUANCANÉ"],
                ["Código Modular:", "469452"],
                ["Departamento:", "PUNO"],
                ["Distrito:", "HUANCANÉ"],
                ["Programa de estudios:", "PELUQUERÍA Y BARBERÍA"],
                ["Módulo Formativo:", "CORTE DE CABELLO, DISEÑO DE BARBA, PEINADO"],
                ["Nivel Formativo:", "AUXILIAR TÉCNICO"],
                ["Tipo de Plan de estudios:", "MODULAR"],
                ["Apellidos y nombres:", "CANDIA TAIPE, Dionicia"],
                ["DRE:", "LIMA"],
                ["Tipo de Gestión:", "Pública"],
                ["Provincia:", "LIMA"],
                ["Resolución Directorial:", "RD N° 07592 - 2024 - UGEL 06"],
                ["Período Lectivo:", "2024"],
                ["Período de Clase:", "18/03/2024 al 19/07/2024"],
                ["Período Académico:", "2024-II"],
                ["Número de Documento:", "08432894"],
                ["Código de Recibo:", "REC123456"]
            ],
            'units' => [
                ['num' => '01', 'name' => 'CORTE DE CABELLO', 'credit' => 4, 'hours' => 96, 'condition' => 'G'],
                ['num' => '02', 'name' => 'DISEÑO Y CORTE DE BARBA', 'credit' => 3, 'hours' => 64, 'condition' => 'G'],
                ['num' => '03', 'name' => 'PEINADOS', 'credit' => 3, 'hours' => 80, 'condition' => 'G'],
                ['num' => '04', 'name' => 'COMUNICACIÓN PARA EL DESARROLLO PERSONAL Y PROFESIONAL', 'credit' => 2, 'hours' => 48, 'condition' => 'G'],
                ['num' => '05', 'name' => 'APLICACIONES DE HERRAMIENTAS INFORMÁTICAS', 'credit' => 2, 'hours' => 48, 'condition' => 'G'],
                ['num' => '06', 'name' => 'EXPERIENCIAS FORMATIVAS EN SITUACIÓN REAL DE TRABAJO', 'credit' => 6, 'hours' => 192, 'condition' => 'G']
            ]
        ];

        $pdf = Pdf::loadView('pdf.nomina', $data);
        return $pdf->stream('nomina.pdf');
    }
}
