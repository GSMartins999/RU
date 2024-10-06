@extends('layouts.adminApp')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>

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

        <h2 class="mt-4 text-center">Formulário de Cardápio</h2>

        <form wire:submit.prevent="store" action="dashboard/store" method="POST" class="container mb-5">
            @csrf

            @if (session()->has('message'))
            <div class="alert alert-success" id="alert">
                {{ session('message') }}
            </div>
            @endif

            <div class="form-group-sm">
                <label for="prato_principal">Prato Principal: </label>
                <input id="prato_principal" name='prato_principal' type="text" wire:model="prato_principal" class="form-control" placeholder="Insira o prato principal">
            </div>

            <div class="form-group-sm">
                <label for="vegetariana">Vegetariana: </label>
                <input type="text" name='vegetariana' wire:model="vegetariana" class="form-control" id="Vegetariana" placeholder="Insira a opção vegetariana">
            </div>

            <div class="form-group-sm">
                <label for="vegana">Vegana: </label>
                <input type="text" name='vegana' wire:model="vegana" class="form-control" id="vegana" placeholder="Insira a opção vegana">
            </div>

            <div class="form-group-sm">
                <label for="guarnicao">Guarnição: </label>
                <input type="text" name='guarnicao' wire:model="guarnicao" class="form-control" id="guarnicao" placeholder="Insira a opção de guarnição">
            </div>

            <div class="form-group-sm">
                <label for="arroz">Arroz: </label>
                <input type="text" name='arroz' wire:model="arroz" class="form-control" id="arroz" placeholder="Insira a opção de arroz">
            </div>

            <div class="form-group-sm">
                <label for="feijao">Feijão: </label>
                <input type="text" name='feijao' wire:model="feijao" class="form-control" id="feijao" placeholder="Insira a opção de feijão">
            </div>

            <div class="form-group-sm">
                <label for="salada1">Salada 1: </label>
                <input type="text" name='salada1' wire:model="salada1" class="form-control" id="salada1" placeholder="Insira a opção de salada">
            </div>

            <div class="form-group-sm">
                <label for="salada2">Salada 2: </label>
                <input type="text" name='salada2' wire:model="salada2" class="form-control" id="salada2" placeholder="Insira a opção de salada">
            </div>

            <div class="form-group-sm">
                <label for="salada3">Salada 3: </label>
                <input type="text" name='salada3' wire:model="salada3" class="form-control" id="salada3" placeholder="Insira a opção de salada">
            </div>

            <div class="form-group-sm">
                <label for="salada4">Salada 4: </label>
                <input type="text" name='salada4' wire:model="salada4" class="form-control" id="salada4" placeholder="Insira a opção de salada">
            </div>

            <div class="form-group-sm">
                <label for="sobremesa">Sobremesa: </label>
                <input type="text" name='sobremesa' wire:model="sobremesa" class="form-control" id="sobremesa" placeholder="Insira a sobremesa">
            </div>

            <div class="form-group">
                <label for="data">Data: </label>
                <input type="date" name='data' wire:model="data" class="form-control" id="data" placeholder="Informe a data">
            </div>

            <button type="submit" class="btn btn-primary mb-2">Adicionar</button>
            <a href="{{ route('admin.viewcardapio') }}" class="btn btn-primary mb-2">Ver Cardápio</a>
            <div class="text-end mb-3 mt-3">
            <a href="{{ route('admin.reservas') }}" class="btn btn-primary">Ver Reservas</a>
            </div>


            <!-- Timer do alert -->
            <div>
                <script>
                    setTimeout(function() {
                        $("#alert").remove();
                    }, 5000);
                </script>
            </div>
        </form>
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