<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasCompositePrimaryKey;

class UsuarioHasCanal extends BaseModel
{
    use HasCompositePrimaryKey;

    protected $table = 'usuario_has_canal';
    public $incrementing = false;
    protected $primaryKey = [ "id_canal", "id_usuario" ];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id_canal",
        "id_usuario",
        "moderador",
        "administrador",
        "inscrito",
        "recomendado",
    ];

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id', 'id_usuario');
    }
    public function canal()
    {
        return $this->hasOne(Canal::class, 'id', 'id_canal');
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
