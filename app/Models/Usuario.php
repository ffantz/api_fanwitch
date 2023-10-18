<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use Uuid;
    use Traits\Scope;

    protected $table = 'usuario';
    // protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nome",
        "username",
        "email",
        "data_nascimento",
        "email_verified_at",
        "avatar",
        "status",
    ];

    /**
     * Attributes that are mass assignable.
     *
     * @var  array
     */
    protected $hidden = [
        'password'
    ];
}
