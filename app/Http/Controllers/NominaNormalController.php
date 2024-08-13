<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $studentData = [
            ["01", "71090436", "ANDRADE MARICHIN, Azucena Lisbeth", "M", "16/01/1956", "G", "06", "20"],
            ["02", "40903648", "ARCE BASILIO, Elba Celia", "M", "12/08/1954", "G", "06", "20"],
            ["03", "6160967", "BENTOCILLA NAVARRO, Emma Ana", "M", "18/10/1954", "G", "06", "20"],
            ["04", "07507489", "CANCHA LLACOLLA, Carla", "M", "01/09/1960", "G", "06", "20"],
            ["05", "08432894", "CANDIA TAIPE, Dionicia", "M", "31/01/1962", "G", "06", "20"]
        ];

        $pdf = Pdf::loadView('pdf.nominaNormal', compact('data', 'studentData'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('nomina.pdf');
    }
}
