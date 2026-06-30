<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contribuicoes extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'obs',
        'valor',
        'membro_id',
        'user_id'
    ];

    /**
     * Relacionamento: Uma contribuição pertence a um membro.
     * Motivo: Cada registro de contribuição financeira deve estar associado a um membro específico da igreja.
     * Permite rastrear o histórico de contribuições por membro.
     */
    public function membro()
    {
        return $this->belongsTo(membros::class, 'membro_id');
    }

    /**
     * Relacionamento: Uma contribuição foi registrada por um usuário.
     * Motivo: O usuário autenticado é responsável por registrar a contribuição no sistema.
     * Permite rastrear quem fez o lançamento e quando para fins de auditoria.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
