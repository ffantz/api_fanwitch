<?php
namespace App\Models;

class Canal
{
    use Uuid;

    protected $table = 'canal';
    protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_usuario",
        "nome_canal",
        "username",
        "status",
        "avatar",
        "foto_capa",
    ];
}
