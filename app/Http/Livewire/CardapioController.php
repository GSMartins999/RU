<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cardapio;
use Illuminate\Http\Request;

class CardapioController extends Component
{
    public $prato_principal;
    public $vegetariana;
    public $vegana;
    public $guarnicao;
    public $arroz;
    public $feijao;
    public $salada1;
    public $salada2;
    public $salada3;
    public $salada4;
    public $sobremesa;
    public $data;
    public $cardapios;

    protected $rules = [
        'prato_principal' => 'required',
        'vegetariana' => 'required',
        'vegana' => 'required',
        'guarnicao' => 'required',
        'arroz' => 'required',
        'feijao' => 'required',
        'salada1' => 'required',
        'salada2' => 'required',
        'salada3' => 'required',
        'salada4' => 'required',
        'sobremesa' => 'required',
        'data' => 'required',
    ];

    public readonly Cardapio $cardapio;

    public function __construct()
    {
        $this->cardapio = new Cardapio();
    }

    public function mount()
    {
        $this->cardapios = Cardapio::all();
    }

    public function render()
    {
        return view('livewire.cardapio-controller');
    }

    public function store(Request $request)
    {
        $this->validate();

        $cardapio = new Cardapio();
        $cardapio->prato_principal = $this->prato_principal;
        $cardapio->vegetariana = $this->vegetariana;
        $cardapio->vegana = $this->vegana;
        $cardapio->guarnicao = $this->guarnicao;
        $cardapio->arroz = $this->arroz;
        $cardapio->feijao = $this->feijao;
        $cardapio->salada1 = $this->salada1;
        $cardapio->salada2 = $this->salada2;
        $cardapio->salada3 = $this->salada3;
        $cardapio->salada4 = $this->salada4;
        $cardapio->sobremesa = $this->sobremesa;
        $cardapio->data = $this->data;

        $cardapio->save();

        $this->cardapios = Cardapio::all();

        session()->flash('message', 'Cardápio cadastrado com sucesso!');
    }

    public function show()
    {
        $this->cardapios = Cardapio::all();
        return view('admin.viewcardapio', ['cardapios' => $this->cardapios]);
    }


    public function edit($id)
    {
        // Faz um "select" no banco buscando o cardápio pelo ID
        $cardapio = Cardapio::findOrFail($id);

        // Retorna a view e os dados do cardápio
        return view('admin.editar', ['cardapio' => $cardapio]);
    }



    public function update(Request $request, $id)
    {
        $request->validate($this->rules); // Validação antes de processar
    
        // Encontre o cardápio
        $cardapio = Cardapio::findOrFail($id);
    
        // Atualize os campos diretamente
        $cardapio->prato_principal = $request->input('prato_principal');
        $cardapio->vegetariana = $request->input('vegetariana');
        $cardapio->vegana = $request->input('vegana');
        $cardapio->guarnicao = $request->input('guarnicao');
        $cardapio->arroz = $request->input('arroz');
        $cardapio->feijao = $request->input('feijao');
        $cardapio->salada1 = $request->input('salada1');
        $cardapio->salada2 = $request->input('salada2');
        $cardapio->salada3 = $request->input('salada3');
        $cardapio->salada4 = $request->input('salada4');
        $cardapio->sobremesa = $request->input('sobremesa');
        $cardapio->data = $request->input('data');
    
        // Salvar
        $cardapio->save();
    
        session()->flash('message', 'Cardápio atualizado com sucesso!');
        return redirect()->route('admin.viewcardapio');
    }
}
