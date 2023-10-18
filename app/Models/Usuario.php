<?php
namespace App\Models;

class Usuario
{
    use Uuid;

    protected $table = 'usuario';
    protected $guarded = ['id'];

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
}
