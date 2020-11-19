<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'Usuarios';
    
    protected $fillable = [
        'user_nome',
        'user_email',
        'user_senha',
        'user_permissao'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = false;
}
