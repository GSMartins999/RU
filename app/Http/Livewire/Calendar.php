<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva; // Certifique-se de importar o modelo correto
use Carbon\Carbon;

class Calendar extends Component
{
    public $almoco = false;
    public $janta = false;
    public $start; // Data selecionada
    public $events = [];
    public $reservas; // Para armazenar as reservas

    public function mount()
    {
        $this->reservas = Reserva::where('start', '>=', now())->get();
        $this->events = $this->formatEvents($this->reservas);
    }

    public function formatEvents($reservas)
    {
        $today = Carbon::now()->format('Y-m-d'); // Formato da data atual

        return $reservas->map(function ($reserva) use ($today) {
            return [
                'title' => ($reserva->almoco ? 'Almoço' : '') . ($reserva->janta ? ' e Janta' : ''),
                'start' => $reserva->start,
                'id' => $reserva->id,
                'classNames' => $reserva->start === $today ? ['today-event'] : [], // Classe para o dia atual
            ];
        })->toArray();
    }


    public function store()
    {
        // Valida as entradas
        $this->validate([
            'start' => 'required|date|after_or_equal:today',
            'almoco' => 'required_without:janta',
            'janta' => 'required_without:almoco',
        ]);

        // Se não houver refeições selecionadas, adicione um erro
        if (!$this->almoco && !$this->janta) {
            $this->addError('refeicao', 'Por favor, selecione pelo menos uma refeição.');
            return; // Saia do método para evitar a criação da reserva
        }

        // Cria a reserva
        Reserva::create([
            'user_id' => auth()->id(),
            'start' => $this->start,
            'almoco' => $this->almoco ? 1 : 0,
            'janta' => $this->janta ? 1 : 0,
        ]);

        // Mensagem de sucesso
        session()->flash('message', 'Refeição agendada com sucesso!');

        // Atualiza as reservas e eventos
        $this->mount(); // Atualiza o calendário
    }


    public function destroy($id)
    {
        // Encontra a reserva pelo ID
        $reserva = Reserva::find($id);
        if ($reserva && $reserva->user_id == auth()->id()) {
            // Cancela a reserva
            $reserva->delete();
            session()->flash('message', 'Refeição cancelada com sucesso!');
        } else {
            session()->flash('message', 'Você não pode cancelar esta reserva.');
        }

        // Redireciona para atualizar a página
        return redirect()->to('/reservas');
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
