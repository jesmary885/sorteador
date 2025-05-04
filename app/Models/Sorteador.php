<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use RuntimeException;

class Sorteador extends Model
{
     use HasFactory;

     protected $table = 'sorteadors';

    protected $guarded = ['id','created_at','updated_at'];

    public static function generarNumeroUnico(): int
    {
        // 1. Obtener todos los números ya sorteados
        $numerosSorteados = self::pluck('numero')->toArray();

        // 2. Generar números disponibles (del 1 al 70 que no estén en la BD)
        $numerosDisponibles = array_diff(range(1, 75), $numerosSorteados);

        // 3. Verificar si hay números disponibles
        if (empty($numerosDisponibles)) {

            return $numeroAleatorio = 0;
       
        }

        // 4. Seleccionar un número aleatorio
        $numeroAleatorio = array_rand(array_flip($numerosDisponibles), 1);

        // 5. Guardar el número en la BD
        self::create(['numero' => $numeroAleatorio]);

        return $numeroAleatorio;
    }


    public function user(){
        return $this->belongsTo(User::class);
    }
}
