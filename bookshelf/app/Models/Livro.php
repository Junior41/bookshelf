<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'autor',
        'codigo',
        'editora',
        'capa',
        'avaliacao',
        'quantidadeExemplares',
        'quantidadePag',
        'categoria_id',
    ];

    protected $primaryKey = 'codigo';
    protected $keyType = 'string';


    public function categoria(){
        return $this->hasOne(Categoria::class, 'categoria_id');
    }
}
