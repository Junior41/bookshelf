<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'estadoConservacao',
        'CPFSocio',
        'CNPJFornecedor',
    ];

}
