<?php
namespace App\Models;

use App\Models\Traits\HasCompositePrimaryKey;

class UsuarioHasCanal
{
    use Uuid;
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
}
