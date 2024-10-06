<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::selectRaw('date(start) as data, sum(almoco) as total_almoco, sum(janta) as total_janta')
            ->groupBy('data')
            ->get();
    
        return view('admin.reservas.index', compact('reservas'));
    }
    
}
