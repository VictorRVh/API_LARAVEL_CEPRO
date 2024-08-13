<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 50px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            text-decoration: underline;
            text-align: center;
            margin: 20px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }


        .signatures-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 200px;
        }

        .signature {
            width: 200px; 
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin: 50px 0 0 0;
            height: 15px;
        }


    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('img/logoCepro.jpg') }}" alt="Logo">
        <h1>NÓMINA DE ESPECIALIDAD</h1>
        <h2>FICHA DE MATRICULA</h2>
    </div>

    <div>
        @foreach (array_chunk($cetproData, 9) as $chunk)
        <table class="table">
            <tbody>
                @foreach ($chunk as $row)
                <tr>
                    <td style="background-color: #D3D3D3; width: 120px;">{{ $row[0] }}</td>
                    <td style="width: 180px;">{{ $row[1] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>

    <div>
        <h3 class="section-title">UNIDADES DIDÁCTICAS</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Unidades Didácticas</th>
                    <th>Créditos</th>
                    <th>Horas</th>
                    <th>Condición</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit['num'] }}</td>
                    <td>{{ $unit['name'] }}</td>
                    <td>{{ $unit['credit'] }}</td>
                    <td>{{ $unit['hours'] }}</td>
                    <td>{{ $unit['condition'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="signatures">
        <div class="signatures-container">
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-label">Sello / Firma del Director</div>
            </div>
            <!-- <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-label">Firma del Estudiante</div>
            </div> -->
        </div>
    </div>

</body>

</html>
