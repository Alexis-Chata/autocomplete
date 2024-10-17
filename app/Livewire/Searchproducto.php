<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class Searchproducto extends Component
{
    public $query_producto = '';
    public $dataresults_producto = [];

    public function updatedQueryProducto()
    {
        $string = trim($this->query_producto);
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
        $this->dataresults_producto = array_values($resultados);
        // dd($resultados, $this->query_producto);
    }

    public function selectItem_producto($id = null)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $this->query_producto = $producto->name;
        }
    }

    public function render()
    {
        return view('livewire.searchproducto');
    }
}
