<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membros extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'morada',
        'estado_civil',
        'genero',
        'telefone',
        'data_nascimento',
        'data_batismo',
        'situcao',
        'cargo',
        'user_id'
    ];
}
