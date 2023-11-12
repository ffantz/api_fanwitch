<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends BaseModel
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

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
