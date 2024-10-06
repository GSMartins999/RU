@extends('layouts.adminApp')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização do Cardápio</title>

    <!-- Estilos para o preloader -->
    <style>
        /* Preloader - Tela de carregamento */
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Oculta o conteúdo da página até o carregamento estar completo */
        #content {
            display: none;
        }
    </style>
</head>

<body class="container-fluid">

    <!-- Preloader com animação Lottie -->
    <div id="preloader">
        <lottie-player
            src="https://lottie.host/ab8286f7-83fd-4462-8c06-9440ce06c379/AsMft4RBOD.json"
            background="transparent"
            speed="1"
            style="width: 300px; height: 300px"
            loop
            autoplay>
        </lottie-player>
    </div>

    <!-- Conteúdo da página -->
    <div id="content">
        <div class="text-end mb-3 mt-3">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger mb-2">Logout</button>
            </form>
        </div>

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

        <!-- Botão de Logout -->
        <div class="text-center mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-2">Voltar para Dashboard</a>
            <a href="{{ route('admin.reservas') }}" class="btn btn-primary mb-2">Ver Reservas</a>
        </div>

        <!-- Timer do alert -->
        <div>
            <script>
                setTimeout(function() {
                    $("#alert").remove();
                }, 2000);
            </script>
        </div>
    </div>

    <!-- Script para Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Script para ocultar o preloader quando o carregamento estiver completo -->
    <script>
        window.onload = function() {
            document.getElementById('preloader').style.display = 'none'; // Remove o preloader
            document.getElementById('content').style.display = 'block'; // Mostra o conteúdo da página
        };
    </script>

</body>

</html>