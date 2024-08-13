<!DOCTYPE html>
<html>

<head>
    <title>Registro de Matrícula</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header,
        .table-container {
            width: 100%;
        }

        .header img {
            width: 140px;
            height: auto;
        }

        .header h1,
        .header h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #D3D3D3;
            width: auto;

        }

        .table th {
            width: calc(100% / var(--columns-count));
        }
    </style>


</head>

<body>
    <div class="header">
        <img src="{{ public_path('img/logoCepro.jpg') }}" alt="Logo">
        <h1>REGISTRO DE MATRÍCULA INSTITUCIONAL DEL PROGRAMA DE ESTUDIOS 2024-II</h1>
        <h2>EDUCACIÓN TÉCNICO-PRODUCTIVA</h2>
    </div>
    <div class="table-container">
        <table>
            <thead>
                <tr style="--columns-count: {{ count($headers) }};">
                    @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr>
                    @foreach ($row as $cell)
                    <td>{{ $cell }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>