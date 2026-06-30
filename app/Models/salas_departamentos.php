<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salas_departamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'hora_inicio',
        'hora_fim',
        'finalidade',
        'sala_id',
        'depa_id'
    ];
}
