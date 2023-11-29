<?php
namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class TipoNotificacao extends BaseModel
{
    use Uuid;

    protected $table = 'tipo_notificacao';
    protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nome",
        "sigla",
        "status",
    ];

    public function notificacao()
    {
        return $this->hasMany(Notificacoes::class, 'id_tipo_notificacao');
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
