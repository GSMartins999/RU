<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Reservas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh; 
            display: flex; 
            flex-direction: column;
            justify-content: flex-start; 
            align-items: center; 
            background-color: #f8f9fa;
        }
        
        h2 {
            margin-top: 30px; 
        }

        .table {
            width: 95%; 
            margin-top: 20px; 
        }

        .table td, .table th {
            padding: 15px; 
        }

        .btn-secondary {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h2>Reservas</h2>
        
        <div>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Data</th>
                        <th>Total Almoço</th>
                        <th>Total Jantar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($reserva->data)->format('d/m/Y') }}</td>
                        <td>{{ $reserva->total_almoco }}</td>
                        <td>{{ $reserva->total_janta }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-lg" style="text-decoration: none; color: white;">Voltar para Dashboard</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
