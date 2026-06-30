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
}
