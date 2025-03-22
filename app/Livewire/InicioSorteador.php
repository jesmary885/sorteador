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

        $busquedas = Sorteador::where('user_id',Auth::User()->id)
        ->get();

        foreach($busquedas as $busqueda){

            $busqueda->delete();
        }

        $this->iniciado = 0;
    }


    public function generar(){

        if($this->iniciado == 0){



            try {

                $client = new Client(['base_uri' => 'http://67.205.168.133/sorteador/resetear/2',]);

                try {

                    $client = new Client(['base_uri' => 'http://67.205.168.133/',]);

                    $resultado = $client->request('GET', 'sorteador/sacar_numero/2');

                    if($resultado->getStatusCode() == 200){

                        $this->iniciado = 1;

                        $n=json_decode($resultado->getBody(),true);

                        $busqueda_s = Sorteador::where('user_id',Auth::User()->id)
                            ->where('numero',$n['numero'])
                            ->first();

                        if(!$busqueda_s){

                            $this->numero = $n['numero'];

                            if($this->numero >= 1 && $this->numero <= 15) $this->letra = 'B';
                            elseif($this->numero >= 16 && $this->numero <= 30)$this->letra = 'I';
                            elseif($this->numero >= 31 && $this->numero <= 45)$this->letra = 'N';
                            elseif($this->numero >= 46 && $this->numero <= 60)$this->letra = 'G';
                            else $this->letra = 'O';

                            $register = new Sorteador();
                            $register->user_id =  auth()->user()->id;
                            $register->letra = $this->letra;
                            $register->numero = $this->numero;
                            $register->save();

                        }
                        else{
                            notyf()
                            ->position('x', 'center')
                            ->position('y', 'center')
                            ->dismissible(true)
                            ->addError('¡Ficha duplicada en este sorteo!');

                        }
                    }
                }
    
                catch (\GuzzleHttp\Exception\RequestException $e) {
                    $error['error'] = $e->getMessage();
                    $error['request'] = $e->getRequest();
        
                    if($e->hasResponse()){
                        if ($e->getResponse()->getStatusCode() !== '200'){
                            $error['response'] = $e->getResponse(); 
                        }
                    }
                }

            }

            catch (\GuzzleHttp\Exception\RequestException $e) {
                $error['error'] = $e->getMessage();
                $error['request'] = $e->getRequest();
    
                if($e->hasResponse()){
                    if ($e->getResponse()->getStatusCode() !== '200'){
                        $error['response'] = $e->getResponse(); 
                    }
                }
            }
        }

        else{

            try {

                $client = new Client(['base_uri' => 'http://67.205.168.133/',]);

                $resultado = $client->request('GET', 'sorteador/sacar_numero/2');

                if($resultado->getStatusCode() == 200){

                    $n=json_decode($resultado->getBody(),true);

                        $busqueda_s = Sorteador::where('user_id',Auth::User()->id)
                            ->where('numero',$n['numero'])
                            ->first();

                        if(!$busqueda_s){

                            $this->numero = $n['numero'];

                            if($this->numero >= 1 && $this->numero <= 15) $this->letra = 'B';
                            elseif($this->numero >= 16 && $this->numero <= 30)$this->letra = 'I';
                            elseif($this->numero >= 31 && $this->numero <= 45)$this->letra = 'N';
                            elseif($this->numero >= 46 && $this->numero <= 60)$this->letra = 'G';
                            else $this->letra = 'O';

                            $register = new Sorteador();
                            $register->user_id = auth()->user()->id;
                            $register->letra = $this->letra;
                            $register->numero = $this->numero;
                            $register->save();

                        }

                }

            }

            catch (\GuzzleHttp\Exception\RequestException $e) {
                $error['error'] = $e->getMessage();
                $error['request'] = $e->getRequest();
    
                if($e->hasResponse()){
                    if ($e->getResponse()->getStatusCode() !== '200'){
                        $error['response'] = $e->getResponse(); 
                    }
                }
            }
        }

    }

    public function render()
    {
        return view('livewire.inicio-sorteador');
    }
}
