@extends('layouts.adminApp')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cardápio</title>
</head>

<body class="container-fluid">

    <h2 class="mt-4 text-center">Editar Cardápio</h2>



    <form action="{{ route('cardapio.update', $cardapio->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if (session()->has('message'))
        <div class="alert alert-success" id="alert">
            {{ session('message') }}
        </div>
        @endif

        <div class="form-group-sm">
            <label for="prato_principal">Prato Principal:</label>
            <input id="prato_principal" name='prato_principal' type="text" class="form-control" placeholder="Insira o prato principal" value="{{ $cardapio->prato_principal }}" required>
        </div>

        <div class="form-group-sm">
            <label for="vegetariana">Vegetariana:</label>
            <input type="text" class="form-control" id="vegetariana" name='vegetariana' value="{{ $cardapio->vegetariana }}" required>
        </div>

        <div class="form-group-sm">
            <label for="vegana">Vegana:</label>
            <input type="text" name='vegana' class="form-control" id="vegana" placeholder="Insira a opção vegana" value="{{ $cardapio->vegana }}" required>
        </div>

        <div class="form-group-sm">
            <label for="guarnicao">Guarnição:</label>
            <input type="text" name='guarnicao' class="form-control" id="guarnicao" placeholder="Insira a opção de guarnição" value="{{ $cardapio->guarnicao }}" required>
        </div>

        <div class="form-group-sm">
            <label for="arroz">Arroz:</label>
            <input type="text" name='arroz' class="form-control" id="arroz" placeholder="Insira a opção de arroz" value="{{ $cardapio->arroz }}" required>
        </div>

        <div class="form-group-sm">
            <label for="feijao">Feijão:</label>
            <input type="text" class="form-control" id="feijao" name="feijao" value="{{ $cardapio->feijao }}" required>
        </div>

        <div class="form-group-sm">
            <label for="salada1">Salada 1:</label>
            <input type="text" name='salada1' class="form-control" id="salada1" placeholder="Insira a opção de salada" value="{{ $cardapio->salada1 }}" required>
        </div>

        <div class="form-group-sm">
            <label for="salada2">Salada 2:</label>
            <input type="text" name='salada2' class="form-control" id="salada2" placeholder="Insira a opção de salada" value="{{ $cardapio->salada2 }}" required>
        </div>

        <div class="form-group-sm">
            <label for="salada3">Salada 3:</label>
            <input type="text" name='salada3' class="form-control" id="salada3" placeholder="Insira a opção de salada" value="{{ $cardapio->salada3 }}" required>
        </div>

        <div class="form-group-sm">
            <label for="salada4">Salada 4:</label>
            <input type="text" name='salada4' class="form-control" id="salada4" placeholder="Insira a opção de salada" value="{{ $cardapio->salada4 }}" required>
        </div>

        <div class="form-group-sm">
            <label for="sobremesa">Sobremesa:</label>
            <input type="text" name='sobremesa' class="form-control" id="sobremesa" placeholder="Insira a sobremesa" value="{{ $cardapio->sobremesa }}" required>
        </div>

        <div class="form-group">
            <label for="data">Data:</label>
            <input type="date" name='data' class="form-control" id="data" value="{{ $cardapio->data }}" required>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Atualizar Cardápio</button>
        <a href="{{ route('admin.viewcardapio') }}" class="btn btn-primary mb-2">Ver Cardápio</a>

        <div>
            <script>
                setTimeout(function() {
                    $("#alert").remove();
                }, 2000);
            </script>
        </div>

    </form>
    <div class="text-center mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-2">Voltar para Dashboard</a>
    </div>

</body>

</html>
