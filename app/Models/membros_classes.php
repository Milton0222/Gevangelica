<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membros_classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'membro_id',
        'classe_id'
    ];

    /**
     * Tabela Pivot para relacionamento many-to-many entre membros e classes.
     * 
     * Motivo: Permite que um membro esteja inscrito em múltiplas classes e uma classe tenha múltiplos membros.
     * Essa abordagem oferece flexibilidade para gerenciar a matrícula de membros em diferentes classes.
     * 
     * Exemplo de uso:
     * - $membro->classes()->attach($classe_id);        // Inscrever em uma classe
     * - $classe->membros()->sync([1, 2, 3]);           // Sincronizar membros da classe
     */

    /**
     * Relacionamento: Cada registro pertence a um membro.
     */
    public function membro()
    {
        return $this->belongsTo(membros::class, 'membro_id');
    }

    /**
     * Relacionamento: Cada registro pertence a uma classe.
     */
    public function classe()
    {
        return $this->belongsTo(classes::class, 'classe_id');
    }
}
