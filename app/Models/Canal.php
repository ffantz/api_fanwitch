<?php

namespace App\Models;

use DateTimeInterface;
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

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id', 'id_usuario');
    }

    public function seguidores()
    {
        return $this->hasMany(UsuarioHasCanal::class, 'id_canal', 'id');
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
