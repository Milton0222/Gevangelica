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
}
