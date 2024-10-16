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
        $string = trim($this->query);
        $string = str_replace([',', '.'], '', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $queries = explode(' ', $string);

        $resultados = Producto::query();
        foreach ($queries as $query) {
            if (!empty($query)) {
                $resultados->where('name', 'LIKE', '%' . $query . '%');
            }
        }

        $resultados = $resultados->take(5)->get()->toArray();
        $this->dataresults = array_values($resultados);
        //dd($resultados, $this->query);
    }

    public function selectItem($id = null)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $this->query = $producto->name;
        }
    }

    public function render()
    {
        return view('livewire.searchproducto');
    }
}
