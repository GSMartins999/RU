<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva;
use Carbon\Carbon;

class Calendar extends Component
{
    public $almoco = false;
    public $janta = false;
    public $start; 
    public $events = [];
    public $reservas; 

    public function mount()
    {
        $this->reservas = Reserva::where('start', '>=', now())->get();
        $this->events = $this->formatEvents($this->reservas);
    }

    public function formatEvents($reservas)
    {
        $today = Carbon::now()->format('Y-m-d'); 

        return $reservas->map(function ($reserva) use ($today) {
            return [
                'title' => ($reserva->almoco ? 'Almoço' : '') . ($reserva->janta ? ' e Janta' : ''),
                'start' => $reserva->start,
                'id' => $reserva->id,
                'classNames' => $reserva->start === $today ? ['today-event'] : [], 
            ];
        })->toArray();
    }

    public function store()
    {
        if (Carbon::parse($this->start)->isPast()) {
            $this->emit('mensagem', 'Não é possível agendar refeições para datas que já passaram.', 'erro');
            return;
        }
    
        $this->validate([
            'start' => 'required|date|after_or_equal:today',
            'almoco' => 'required_without:janta',
            'janta' => 'required_without:almoco',
        ]);
        
        if (!$this->almoco && !$this->janta) {
            $this->emit('mensagem', 'Selecione pelo menos uma refeição para agendar.', 'erro');
            return;
        }
    
        $reservaAlmocoExistente = Reserva::where('user_id', auth()->id())
            ->where('start', $this->start)
            ->where('almoco', 1)
            ->exists();
    
        $reservaJantaExistente = Reserva::where('user_id', auth()->id())
            ->where('start', $this->start)
            ->where('janta', 1)
            ->exists();
    
        if ($this->almoco && $reservaAlmocoExistente) {
            $this->emit('mensagem', 'Você já fez uma reserva para o almoço neste dia.', 'erro');
            return;
        }
    
        if ($this->janta && $reservaJantaExistente) {
            $this->emit('mensagem', 'Você já fez uma reserva para a janta neste dia.', 'erro');
            return;
        }
    
        try {
            Reserva::create([
                'user_id' => auth()->id(),
                'start' => $this->start,
                'almoco' => $this->almoco ? 1 : 0,
                'janta' => $this->janta ? 1 : 0,
            ]);
    

            $this->emit('mensagem', 'Refeição agendada com sucesso!', 'sucesso');
    

            $this->almoco = false;
            $this->janta = false;
            $this->start = null;
    

            return redirect()->to('/reservas'); 
            
    
        } catch (\Exception $e) {
            $this->handleError($e, 'Erro ao agendar a refeição.');
        }
    }
    
    
    
    public function destroy($id)
    {
        try {
            $reserva = Reserva::find($id);

            if ($reserva && $reserva->user_id == auth()->id()) {
                $reserva->delete();
                $this->emit('mensagem', 'Refeição cancelada com sucesso!', 'sucesso');
            } else {
                $this->emit('mensagem', 'Você não pode cancelar esta reserva.', 'erro');
            }

            $this->emit('reservas-atualizadas');
            return redirect()->to('/reservas');
        } catch (\Exception $e) {
            $this->handleError($e, 'Erro ao cancelar a refeição.');
        }
    }

    protected function handleError($exception, $defaultMessage)
    {

        \Log::error($exception);

        $this->emit('mensagem', $defaultMessage . ' ' . $exception->getMessage(), 'erro');
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
