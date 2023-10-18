<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use Uuid;

    protected $table = 'mensagem';
    protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_usuario_remetente",
        "id_usuario_destinatario",
        "mensagem",
        "lida",
    ];
}
