<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isPastor',
        'isAdmin',
        'isSecretario',
        'isLider',
        'isTesoureiro',
        'isMembro'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Relacionamento: Um usuário tem um único membro associado.
     * Motivo: Cada conta de usuário representa um usuário autenticado que pode ser ou não um membro da igreja.
     * A relação é one-to-one porque cada usuário tem apenas um perfil de membro.
     */
    public function membro()
    {
        return $this->hasOne(membros::class);
    }

    /**
     * Relacionamento: Um usuário pode registrar múltiplas contribuições.
     * Motivo: O usuário autenticado é responsável por registrar as contribuições dos membros no sistema.
     * Permite rastrear quem criou cada registro de contribuição.
     */
    public function contribuicoes()
    {
        return $this->hasMany(contribuicoes::class);
    }

    /**
     * Relacionamento: Um usuário pode ser professor de múltiplas classes.
     * Motivo: Um usuário com permissão de professor pode lecionar várias aulas/turmas diferentes.
     * Permite associar classes educacionais a seus respectivos professores.
     */
    public function classes()
    {
        return $this->hasMany(classes::class, 'professor_id');
    }

    /**
     * Relacionamento: Um usuário pode ser líder de múltiplos departamentos.
     * Motivo: Um líder pode coordenar vários departamentos dentro da estrutura da igreja.
     * Útil para gerenciar responsabilidades de liderança.
     */
    public function departamentos()
    {
        return $this->hasMany(departamentos::class, 'lider_id');
    }
}
