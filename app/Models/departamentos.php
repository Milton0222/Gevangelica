<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departamentos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'lider_id'
    ];

    /**
     * Relacionamento: Um departamento tem um líder (usuário).
     * Motivo: Cada departamento da igreja possui um líder responsável.
     * O líder é um usuário autenticado que gerencia o departamento.
     */
    public function lider()
    {
        return $this->belongsTo(User::class, 'lider_id');
    }

    /**
     * Relacionamento: Um departamento pode utilizar múltiplas salas.
     * Motivo: Os departamentos usam diferentes salas para suas atividades.
     * Relacionamento many-to-many através da tabela salas_departamentos.
     * Permite gerenciar o uso de espaços pelos departamentos com agenda.
     */
    public function salas()
    {
        return $this->belongsToMany(salas::class, 'salas_departamentos', 'depa_id', 'sala_id')
            ->withPivot('data', 'hora_inicio', 'hora_fim', 'finalidade')
            ->withTimestamps();
    }
}
