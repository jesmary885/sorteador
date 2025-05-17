<?php

namespace App\Livewire;

use App\Models\Sorteador;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use GuzzleHttp\Client;

class InicioSorteador extends Component
{

    public $iniciado, $numero, $letra;

    public function mount(){

        $busqueda = Sorteador::where('user_id',Auth::User()->id)
            ->first();

        if($busqueda) $this->iniciado = 1;
        else $this->iniciado = 0;

    }

    public function finalizar(){

        $busquedas = Sorteador::get();

        foreach($busquedas as $busqueda){

            $busqueda->truncate();
        }

        $this->iniciado = 0;
    }


    public function generar(){

        if($this->iniciado == 0) $this->iniciado = 1;

        $this->numero = Sorteador::generarNumeroUnico();

        if($this->numero != 0){

            if($this->numero >= 1 && $this->numero <= 15) $this->letra = 'B';
            elseif($this->numero >= 16 && $this->numero <= 30)$this->letra = 'I';
            elseif($this->numero >= 31 && $this->numero <= 45)$this->letra = 'N';
            elseif($this->numero >= 46 && $this->numero <= 60)$this->letra = 'G';
            else $this->letra = 'O';

        }

        else{

            $this->emit('error','Se han agotado los números!. Haz clic en Finalizar para generar más números');

        }

        


    }

    public function render()
    {
        return view('livewire.inicio-sorteador');
    }
}
