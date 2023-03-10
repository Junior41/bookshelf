<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'CPF',
        'status',
        'endereco',
    ];

    protected $primaryKey = 'CPF';
    protected $keyType = 'string';

}
