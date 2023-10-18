<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacoes extends Model
{
    use Uuid;

    protected $table = 'notificacoes';
    protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_usuario",
        "titulo",
        "texto",
        "lida",
    ];
}
