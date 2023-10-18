<?php
namespace App\Models;

class Notificacoes
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
