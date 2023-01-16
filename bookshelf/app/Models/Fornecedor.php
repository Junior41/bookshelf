<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'CNPJ',
        'status',
        'endereco',
        'nome',
    ];

    protected $primaryKey = 'CNPJ';
    protected $keyType = 'string';
}
