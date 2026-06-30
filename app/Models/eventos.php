<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
        'data',
        'local',
        'hora',
        'estado',
        'finalidade',
        'tema'
    ];

    /**
     * Relacionamento: Um evento pode ter múltiplas classes/turmas.
     * Motivo: Um evento da igreja (como acampamento, retiro, seminário) pode ter várias classes oferecidas.
     * Facilita a organização hierárquica: eventos contêm classes que contêm membros.
     */
    public function classes()
    {
        return $this->hasMany(classes::class, 'evento_id');
    }
}
