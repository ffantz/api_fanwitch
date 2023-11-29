<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Notificacoes extends BaseModel
{
    use Uuid;

    protected $table = 'notificacoes';
    // protected $guarded = ['id'];

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
        "id_tipo_notificacao",
    ];

    public function tipoNotificacao()
    {
        return $this->hasOne(TipoNotificacao::class, 'id', 'id_tipo_notificacao');
    }

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
