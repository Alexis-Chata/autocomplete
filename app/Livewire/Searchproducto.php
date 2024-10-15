<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class Searchproducto extends Component
{
    public $query = '';
    public $dataresults = [];

    public function updatedQuery()
    {
        $resultados = Producto::where("name", 'LIKE', '%' . $this->query . '%')
            ->take(5)
            ->get()
            ->toArray();

        $this->dataresults = array_values($resultados);
        //dd($resultados, $this->query);
    }

    public function selectItem($id = null)
    {
        $cgrupo = Producto::find($id);
        if ($cgrupo) {
            $this->query = $cgrupo->name;
        }
    }

    public function render()
    {
        return view('livewire.searchproducto');
    }
}
