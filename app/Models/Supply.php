<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $table = 'supplies';

    protected $fillable = [
        'type',
        'name',
        'social_name',
        'cpf',
        'cnpj',
        'phone',
        'cep',
        'address',
        'address_number',
        'state',
        'city',
    ];
}