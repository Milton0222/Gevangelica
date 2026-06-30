<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salas extends Model
{
    use HasFactory;
    protected $fillable = [
        'n_sala',
        'estado'
    ];

    /**
     * Relacionamento: Uma sala pode ser usada por múltiplos departamentos.
     * Motivo: As salas do templo são recursos compartilhados entre diferentes departamentos.
     * Relacionamento many-to-many através da tabela salas_departamentos.
     * Inclui dados de agendamento como data, hora de início/fim e finalidade.
     */
    public function departamentos()
    {
        return $this->belongsToMany(departamentos::class, 'salas_departamentos', 'sala_id', 'depa_id')
            ->withPivot('data', 'hora_inicio', 'hora_fim', 'finalidade')
            ->withTimestamps();
    }
}
