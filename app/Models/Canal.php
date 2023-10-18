<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Canal extends Model
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
