@extends('layouts.adminApp')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização do Cardápio</title>
</head>

<body class="container-fluid">

    <h2 class="mt-4 text-center">Cardápios Cadastrados</h2>

    @if (session()->has('message'))
    <div class="alert alert-success" id="alert">
        {{ session('message') }}
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Prato Principal</th>
                <th>Vegetariana</th>
                <th>Vegana</th>
                <th>Guarnição</th>
                <th>Arroz</th>
                <th>Feijão</th>
                <th>Salada 1</th>
                <th>Salada 2</th>
                <th>Salada 3</th>
                <th>Salada 4</th>
                <th>Sobremesa</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cardapios as $cardapio)
            <tr>
                <td>{{ $cardapio->prato_principal }}</td>
                <td>{{ $cardapio->vegetariana }}</td>
                <td>{{ $cardapio->vegana }}</td>
                <td>{{ $cardapio->guarnicao }}</td>
                <td>{{ $cardapio->arroz }}</td>
                <td>{{ $cardapio->feijao }}</td>
                <td>{{ $cardapio->salada1 }}</td>
                <td>{{ $cardapio->salada2 }}</td>
                <td>{{ $cardapio->salada3 }}</td>
                <td>{{ $cardapio->salada4 }}</td>
                <td>{{ $cardapio->sobremesa }}</td>
                <td>{{ $cardapio->data }}</td>
                <td>
                    <a href="{{ route('cardapio.edit', $cardapio->id) }}" class="btn btn-warning btn-sm">Editar</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Timer do alert -->
    <div>
        <script>
            setTimeout(function() {
                $("#alert").remove();
            }, 2000);
        </script>
    </div>

    <div class="text-center mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-2">Voltar para Dashboard</a>
    </div>

</body>

</html>