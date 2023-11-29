<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasApiTokens;
    use Uuid;
    use Traits\Scope;

    protected $table = 'usuario';
    // protected $guarded = ['id'];

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nome",
        "username",
        "email",
        "data_nascimento",
        "descricao",
        "email_verified_at",
        "password",
        "avatar",
        "status",
    ];

    /**
     * Attributes that are mass assignable.
     *
     * @var  array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email-verified_at'
    ];

    public function canal()
    {
        return $this->hasOne(Canal::class, 'id_usuario');
    }

    public function amigos()
    {
        return $this->hasMany(Amizade::class, 'id_usuario_adicionado');
    }

    public function amigosAdicionados()
    {
        return $this->hasMany(Amizade::class, 'id_usuario');
    }

    public function notificacoes()
    {
        return $this->hasMany(Notificacoes::class, 'id_usuario');
    }

    public function seguindo()
    {
        return $this->belongsToMany(Canal::class, 'usuario_has_canal', 'id_usuario', 'id_canal')->withPivot([ 'moderador', 'administrador', 'inscrito', 'recomendado', ]);
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
