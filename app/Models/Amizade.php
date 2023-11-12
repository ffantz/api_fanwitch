<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Amizade extends BaseModel
{
    use Uuid;
    use HasCompositePrimaryKey;

    protected $table = 'amizade';
    public $incrementing = false;
    protected $primaryKey = [ "id_usuario", "id_usuario_adicionado" ];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_usuario",
        "id_usuario_adicionado",
        "status",
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
