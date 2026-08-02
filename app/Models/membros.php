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
        'situacao',
        'cargo',
        'email',
        'user_id'
    ];

    /**
     * Relacionamento: Um membro pertence a um usuário.
     * Motivo: Cada membro pode ter um login no sistema através de um usuário autenticado.
     * Estabelece a relação entre os dados do membro e sua conta de acesso.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento: Um membro pode realizar múltiplas contribuições.
     * Motivo: Um membro da igreja pode contribuir financeiramente várias vezes.
     * Permite rastrear o histórico financeiro de cada membro.
     */
    public function contribuicoes()
    {
        return $this->hasMany(contribuicoes::class, 'membro_id');
    }

    /**
     * Relacionamento: Um membro pode estar matriculado em múltiplas classes.
     * Motivo: Os membros podem participar de diferentes classes educacionais simultaneamente.
     * Relacionamento many-to-many através da tabela membros_classes.
     */
    public function classes()
    {
        return $this->belongsToMany(classes::class, 'professor_id');
    }

     /**
     * Relacionamento: Um membro pode ser líder de múltiplos departamentos.
     * Motivo: Um líder pode coordenar vários departamentos dentro da estrutura da igreja.
     * Útil para gerenciar responsabilidades de liderança.
     */
    public function departamentos()
    {
        return $this->hasMany(departamentos::class, 'lider_id');
    }
}
