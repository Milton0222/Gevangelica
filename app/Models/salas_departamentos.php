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

    /**
     * Tabela Pivot para relacionamento many-to-many entre salas e departamentos.
     * 
     * Motivo: Permite que múltiplos departamentos usem as mesmas salas em horários diferentes.
     * Armazena informações de agendamento como data, horário e finalidade do uso.
     * Isso evita conflito de uso dos espaços e gerencia a ocupação das salas.
     * 
     * Exemplo de uso:
     * - $departamento->salas()->attach($sala_id, ['data' => now(), 'hora_inicio' => '09:00', ...]);
     * - $sala->departamentos()->wherePivot('data', today())->get();  // Obter agendamentos de hoje
     */

    /**
     * Relacionamento: Cada agendamento pertence a uma sala.
     */
    public function sala()
    {
        return $this->belongsTo(salas::class, 'sala_id');
    }

    /**
     * Relacionamento: Cada agendamento pertence a um departamento.
     */
    public function departamento()
    {
        return $this->belongsTo(departamentos::class, 'depa_id');
    }
}
