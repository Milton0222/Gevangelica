<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    use HasFactory;
    protected $fillable = [
        'grupo',
        'frequencia',
        'evento_id',
        'professor_id'
    ];

    /**
     * Relacionamento: Uma classe pertence a um evento.
     * Motivo: As classes estão associadas a eventos específicos da igreja.
     * Permite organizar as classes por eventos (por exemplo, acampamento, retiro).
     */
    public function evento()
    {
        return $this->belongsTo(eventos::class, 'evento_id');
    }

    /**
     * Relacionamento: Uma classe tem um professor (usuário).
     * Motivo: Cada classe possui um professor responsável que é um usuário do sistema.
     * Facilita identificar quem está ministrando cada classe.
     */
    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    /**
     * Relacionamento: Uma classe pode ter múltiplos membros matriculados.
     * Motivo: Várias pessoas podem estar na mesma classe simultaneamente.
     * Relacionamento many-to-many através da tabela membros_classes.
     */
    public function membros()
    {
        return $this->belongsToMany(membros::class, 'membros_classes', 'classe_id', 'membro_id');
    }
}
