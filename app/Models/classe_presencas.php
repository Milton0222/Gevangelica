<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classe_presencas extends Model
{
    use HasFactory;

    protected $fillable = ['tipo','classe_id','membro_id'];
}
