<?php
namespace App\Models;

use App\Models\Traits\HasCompositePrimaryKey;

class Amizade
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
}
