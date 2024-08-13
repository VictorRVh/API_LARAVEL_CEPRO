<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>NÓMINA DE MATRÍCULA</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 40px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        .subtitle {
            text-align: center;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #D3D3D3;
        }

        .table td {
            background-color: #FFFFFF;
        }

        .header {
            font-weight: bold;
            text-align: left;
        }

        .image-container {
            margin-left: 200px;
        }

    </style>
</head>

<body>
    <div class="image-container">
        <img src="{{ public_path('img/minedu.jpg') }}" alt="Logo" class="image-left" style="width: 200px;">
    </div>

    <div class="title">NÓMINA DE MATRÍCULA 2024</div>
    <div class="subtitle">EDUCACIÓN TÉCNICO PRODUCTIVA</div>

    <h3 class="subtitle">DATOS DEL CENTRO DE EDUCACIÓN TÉCNICO PRODUCTIVA</h3>

    <table class="table">
        @foreach($data as $row)
        @foreach($row as $cell)
        <tr>
            <td class="header">{{ $cell[0] }}</td>
            <td>{{ $cell[1] }}</td>
        </tr>
        @endforeach
        @endforeach
    </table>

    <h3 class="subtitle">LISTA DE ESTUDIANTES</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nº Ord.</th>
                <th>Código de Matrícula</th>
                <th>APELLIDOS Y NOMBRES (Orden Alfabético)</th>
                <th>SEXO (H - M)</th>
                <th>Fecha de Nacimiento</th>
                <th>Condición (G - P - B)</th>
                <th>Nº de Unidades Didacticas</th>
                <th>Nº de Creditos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentData as $student)
            <tr>
                @foreach($student as $item)
                <td>{{ $item }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>